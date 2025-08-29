<?php

namespace App\Http\Controllers;

use App\Models\Paket;
use App\Models\Subpaket;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PaketController extends Controller
{
    public function paket()
    {
        return view('index', [
            'title' => 'index',
            'paket' => Paket::all(),
            'subpaket' => Subpaket::all(),
        ]);
    }

    public function index()
    {
        return view('admin.paket.index', [
            'title' => 'index',
            'paket' => Paket::all(),
            'subpaket' => Subpaket::all(),
        ]);
    }
}
