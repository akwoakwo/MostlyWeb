<?php

namespace App\Http\Controllers;

use App\Models\Logo;
use App\Models\Produk;
use App\Models\Preview;
use App\Models\Kategori;
use App\Models\Logoproduk;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProdukController extends Controller
{
    public function produk()
    {
        return view('produk', [
            'title' => 'produk',
            'kategori' => Kategori::all(),
            'produk' => Produk::all(),
        ]);
    }

    public function preview($id)
    {
        $produk = Produk::with(['previews', 'logos'])->findOrFail($id);

        return view('preview_produk', [
            'title' => 'preview',
            'produk' => $produk,
        ]);
    }
}

