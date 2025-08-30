<?php

namespace App\Http\Controllers;

use App\Models\Logo;
use App\Models\Paket;
use App\Models\Produk;
use App\Models\Kategori;
use App\Models\Subpaket;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PaketController extends Controller
{
    public function index()
    {
        return view('admin.paket.index', [
            'title' => 'index',
            'paket' => Paket::all(),
            'subpaket' => Subpaket::all(),
        ]);
    }
}
