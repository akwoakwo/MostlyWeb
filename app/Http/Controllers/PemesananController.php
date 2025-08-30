<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Subpaket;
use App\Models\Pemesanan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Review;

class PemesananController extends Controller
{
    public function pemesanan($id, Request $request)
    {
        $subpaket = Subpaket::findOrFail($id);
        $produk = null;

        if ($request->has('produk_id')) {
            $produk = Produk::find($request->produk_id);
        }

        return view('pemesanan', [
            'title' => 'pemesanan',
            'subpaket' => $subpaket,
            'produk' => $produk,
        ]);
    }

    public function index() {
       return view('customer.riwayat_pesan', [
            'data' => Pemesanan::where('user_id', auth()->user()->id)->get(),
        ]); 
    }

    public function show($id) {
       return view('customer.review_pesan', [
            'data' => Pemesanan::findOrFail($id),
        ]);
    }

    public function store(Request $request) {
        $data = new Review();
        $data->pemesanan_id = $request->pemesanan_id;
        $data->user_id = auth()->user()->id;
        $data->rating = $request->rating;
        $data->ulasan = $request->ulasan;

        if ($data->save()) {
            return redirect('riwayat-pesan')->with('success', 'Terima kasih atas ulasan anda!');
        } else {
            return redirect('riwayat-pesan')->with('error', 'Yahh! Anda belum bisa memberikan ulasan.');
        }
    } 
}
