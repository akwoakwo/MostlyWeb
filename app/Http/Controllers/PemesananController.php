<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Subpaket;
use App\Models\Pemesanan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Pembayaran;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use GuzzleHttp\Client;
use App\Models\Review;

class PemesananController extends Controller
{
    public function pemesanan($subpaket_id, Request $request)
    {
        $subpaket = Subpaket::findOrFail($subpaket_id);
        $produk = null;
        
        if ($request->has('produk_id')) {
            $produk = Produk::findOrFail($request->input('produk_id'));
        }

        // Tampilkan halaman pemesanan dengan data subpaket dan produk (jika ada)
        return view('pemesanan', [
            'title' => 'pemesanan',
            'subpaket' => $subpaket,
            'produk' => $produk,
        ]);
    }

    public function store(Request $request)
    {
        // Redirect jika belum login
        if (!Auth::check()) {
            return redirect()->route('index')->with('info', '<p>Anda harus <a class="btn me-2 fw-bold" href="#" data-bs-toggle="modal" data-bs-target="#loginModal">masuk</a> untuk membuat pesanan.</p>');
        }

        // Pengecekan pesanan pending
        $pendingOrder = Pemesanan::where('user_id', Auth::id())
                                 ->where('status_pembayaran', 'pending')
                                 ->first();

        if ($pendingOrder) {
            return back()->with('info', 'Anda memiliki pesanan yang belum selesai. Silakan selesaikan pembayaran atau batalkan pesanan tersebut sebelum membuat yang baru.');
        }

        // Validasi kustom: Pastikan produk_id ada jika opsi 'produk' dipilih
        if ($request->input('opsiDesain') === 'produk' && !$request->has('produk_id')) {
            return back()->with('error', 'Anda harus memilih desain produk terlebih dahulu.');
        }


        $request->validate([
            'subpaket_id' => 'required|exists:detail_pakets,id',
            'produk_id' => 'nullable|exists:produks,id',
            'nama_domain' => 'nullable|string|max:255',
            'ekstensi_domain' => 'nullable|string|max:10',
            'catatan' => 'nullable|string',
        ]);

        if($request->input('nama_domain')) {
            // Gabungkan nama domain dan ekstensinya
            $fullDomain = $request->input('nama_domain') . $request->input('ekstensi_domain');
        }else{
            $fullDomain = null;
        }
        
        
        // Ambil data subpaket untuk mendapatkan harga
        $subpaket = Subpaket::findOrFail($request->input('subpaket_id'));
        
        try {
            DB::beginTransaction();
            
            // Buat nomor invoice acak
            $invoiceNumber = 'INV-' . Str::upper(Str::random(8)) . '-' . time();

            // Atur produk_id menjadi null jika opsi custom dipilih
            $produkId = $request->input('produk_id');
            if ($request->input('opsiDesain') == 'custom') {
                $produkId = null;
            }
            
            $pemesanan = Pemesanan::create([
                'user_id' => Auth::id(),
                'subpaket_id' => $request->input('subpaket_id'),
                'produk_id' => $produkId,
                'catatan' => $request->input('catatan'),
                'domain' => $fullDomain,
                'total_harga' => $subpaket->harga,
                'status_pembayaran' => 'pending',
                'invoice_number' => $invoiceNumber,
            ]);
            
            DB::commit();
            
            return redirect()->route('pemesanan.detail', $pemesanan->invoice_number)
                             ->with('success', 'Pemesanan berhasil dibuat, silakan lanjutkan pembayaran.');
            
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan saat membuat pemesanan: ' . $e->getMessage());
        }
    }

    public function detail($invoice_number)
    {
        $pemesanan = Pemesanan::where('invoice_number', $invoice_number)
                              ->with(['user', 'subpaket', 'produk'])
                              ->firstOrFail();

        // Pastikan hanya pemilik yang bisa melihat detail pesanan
        if ($pemesanan->user_id !== Auth::id()) {
            return redirect()->route('user')->with('error', 'Anda tidak memiliki akses ke halaman ini.');
        }

        return view('detail_pemesanan', compact('pemesanan'));
    }

    public function cancel($invoice_number)
    {
        $pemesanan = Pemesanan::where('invoice_number', $invoice_number)
                              ->where('user_id', Auth::id())
                              ->firstOrFail();

        try {
            DB::beginTransaction();
            $pemesanan->delete();
            DB::commit();
            return redirect()->route('user')->with('success', 'Pemesanan berhasil dibatalkan.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan saat membatalkan pemesanan: ' . $e->getMessage());
        }
    }

    public function checkout(Request $request)
    {
        $pemesanan = Pemesanan::where('invoice_number', $request->invoice_number)
                                ->with(['user', 'subpaket'])
                                ->firstOrFail();

        // Konfigurasi Midtrans
        $midtransServerKey = config('midtrans.server_key');
        $midtransIsProduction = config('midtrans.is_production');

        $params = [
            'transaction_details' => [
                'order_id' => $pemesanan->invoice_number,
                'gross_amount' => $pemesanan->total_harga,
            ],
            'customer_details' => [
                'first_name' => $pemesanan->user->name,
                'email' => $pemesanan->user->email,
                'phone' => $pemesanan->user->phone,
            ],
            'item_details' => [
                [
                    'id' => $pemesanan->subpaket->id,
                    'price' => $pemesanan->subpaket->harga,
                    'quantity' => 1,
                    'name' => $pemesanan->subpaket->nama_subpaket,
                ]
            ]
        ];

        $client = new Client();
        $response = $client->post('https://app.sandbox.midtrans.com/snap/v1/transactions', [
            'headers' => [
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
                'Authorization' => 'Basic ' . base64_encode($midtransServerKey . ':')
            ],
            'json' => $params
        ]);

        $responseData = json_decode($response->getBody()->getContents(), true);

        // Simpan snap token ke tabel pemesanan
        $pemesanan->token_midtrans = $responseData['token'];
        $pemesanan->save();

        return response()->json(['snap_token' => $responseData['token']]);
    }

    /**
     * Menangani notifikasi webhook dari Midtrans.
     */
    public function paymentNotification(Request $request)
    {
        $midtransServerKey = env('MIDTRANS_SERVER_KEY');
        $hashed = hash('sha512', $request->order_id . $request->status_code . $request->gross_amount . $midtransServerKey);

        if ($hashed !== $request->signature_key) {
            return response()->json(['status' => 'error', 'message' => 'Invalid signature key'], 403);
        }

        $pemesanan = Pemesanan::where('invoice_number', $request->order_id)->first();
        if (!$pemesanan) {
            return response()->json(['status' => 'error', 'message' => 'Order not found'], 404);
        }

        if ($request->transaction_status == 'capture' || $request->transaction_status == 'settlement') {
            try {
                DB::beginTransaction();

                // Update status dan metode pembayaran di tabel pemesanan
                $pemesanan->update([
                    'status_pembayaran' => 'success',
                    'metode_pembayaran' => $request->payment_type
                ]);

                // Tambahkan data ke tabel pembayaran
                Pembayaran::create([
                    'pemesanan_id' => $pemesanan->id,
                    'transaction_id_midtrans' => $request->transaction_id,
                    'order_id_midtrans' => $request->order_id,
                    'total_amount' => $request->gross_amount,
                    'payment_method' => $request->payment_type,
                    'issuer' => $request->issuer ?? null,
                    'acquirer' => $request->acquirer ?? null,
                    'reference_number' => $request->reference_number ?? null,
                    'status' => $request->transaction_status,
                    'transaction_time' => $request->transaction_time,
                ]);

                DB::commit();
                return response()->json(['status' => 'success', 'message' => 'Payment status and payment data updated']);

            } catch (\Exception $e) {
                DB::rollBack();
                return response()->json(['status' => 'error', 'message' => 'Failed to update payment status and payment data: ' . $e->getMessage()], 500);
            }
        }

        return response()->json(['status' => 'success', 'message' => 'No action needed']);
    }

    /**
     * Menampilkan halaman terima kasih setelah pembayaran berhasil.
     */
    public function thankYou($invoice_number)
    {
        $pemesanan = Pemesanan::where('invoice_number', $invoice_number)
                               ->with(['user', 'subpaket', 'produk'])
                               ->firstOrFail();

        return view('terima_kasih', compact('pemesanan'));
    }

    public function resi($invoice_number)
    {
        $pemesanan = Pemesanan::where('invoice_number', $invoice_number)
                               ->with(['user', 'subpaket.paket', 'produk', 'pembayaran'])
                               ->firstOrFail();

        if ($pemesanan->user_id !== Auth::id()) {
            return redirect()->route('user')->with('error', 'Anda tidak memiliki akses ke halaman ini.');
        }

        return view('resi', compact('pemesanan'));
    }

    public function index() {
       return view('customer.riwayat_pesan', [
            'data' => Pemesanan::where('user_id',  Auth::id())->get(),
        ]); 
    }

    public function show($id) {
       return view('customer.review_pesan', [
            'data' => Pemesanan::findOrFail($id),
        ]);
    }


    public function adminPemesanan()
    {
        // Ambil semua data pemesanan, urutkan berdasarkan tanggal terbaru
        // Gunakan eager loading untuk mengambil data user dan paket
        $pemesanan = Pemesanan::with(['user', 'subpaket.paket'])->latest()->get();
        // Kirim data ke view
        return view('admin.pages.pemesanan.index', compact('pemesanan'));
    }

    /**
     * Menampilkan detail pemesanan tertentu.
     */
    public function adminShowPemesanan($id)
    {
        // Cari data pemesanan berdasarkan ID
        // Gunakan eager loading untuk mengambil relasi yang diperlukan
        $pemesanan = Pemesanan::with([
            'user',
            'subpaket',
            'produk', // Asumsikan ada relasi 'produk'
            'pembayaran', // Asumsikan ada relasi 'pembayaran'
        ])->findOrFail($id);

        // Kirim data ke view
        return view('admin.pages.pemesanan.show', compact('pemesanan'));
    }
}
