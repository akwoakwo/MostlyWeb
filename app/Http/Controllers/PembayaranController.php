<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use Illuminate\Http\Request;

class PembayaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
        /**
     * Menampilkan daftar semua pembayaran.
     */
    public function index(Request $request)
    {
        $query = $this->getPembayaranData($request);
        $pembayaran = $query->get();
        $totalPembayaran = $pembayaran->sum('total_amount');

        return view('admin.pages.pembayaran.index', compact('pembayaran', 'totalPembayaran'));
    }

    /**
     * Menampilkan halaman cetak pembayaran.
     */
    public function cetak(Request $request)
    {
        $query = $this->getPembayaranData($request);
        $pembayaran = $query->get();
        $totalPembayaran = $pembayaran->sum('total_amount');

        return view('admin.pages.pembayaran.report', compact('pembayaran', 'totalPembayaran'));
    }

    /**
     * Helper function untuk mengambil data pembayaran.
     */
    private function getPembayaranData(Request $request)
    {
        $query = Pembayaran::with([
            'pemesanan.user', 
            'pemesanan.subpaket.paket'
        ])->where('status', 'settlement');
        
        if ($request->has('start_date') && $request->has('end_date')) {
            $startDate = $request->input('start_date');
            $endDate = $request->input('end_date') . ' 23:59:59'; // Tambahkan waktu agar mencakup akhir hari
            
            $query->whereBetween('created_at', [$startDate, $endDate]);
        }
        
        return $query->latest();
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Pembayaran $pembayaran)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pembayaran $pembayaran)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pembayaran $pembayaran)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pembayaran $pembayaran)
    {
        //
    }
}
