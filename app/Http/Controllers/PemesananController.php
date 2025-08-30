<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Subpaket;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
}
