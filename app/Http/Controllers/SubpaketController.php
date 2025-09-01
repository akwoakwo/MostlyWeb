<?php

namespace App\Http\Controllers;

use App\Models\Paket;
use App\Models\Subpaket;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SubpaketController extends Controller
{
    public function show($id)
    {
        return view('admin.pages.paket.show', [
            'title' => 'index',
            'paket' => Paket::findOrFail($id),
            'data' => Subpaket::where('paket_id',$id)->get(),

        ]);
    }


    public function store(Request $request) {
        $request->validate([
            'paket_id' => 'required|exists:pakets,id',
            'nama_subpaket' => 'required|string|max:255',
            'harga' => 'required|numeric',
            'benefit' => 'required|array',
            'benefit.*' => 'string'
        ]);

        Subpaket::create([
            'paket_id' => $request->paket_id,
            'nama_subpaket' => $request->nama_subpaket,
            'harga' => $request->harga,
            'benefit' => json_encode($request->benefit, JSON_UNESCAPED_UNICODE) // encode ke JSON
        ]);

        return redirect()->back()->with('success', 'Sub Paket berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'paket_id' => 'required|exists:pakets,id',
            'nama_subpaket' => 'required|string|max:255',
            'harga' => 'required|numeric',
            'benefit' => 'required|array',
            'benefit.*' => 'string'
        ]);

        $subpaket = Subpaket::findOrFail($id);

        $subpaket->update([
            'paket_id' => $request->paket_id,
            'nama_subpaket' => $request->nama_subpaket,
            'harga' => $request->harga,
            'benefit' => json_encode($request->benefit, JSON_UNESCAPED_UNICODE)
        ]);

        return redirect()->back()->with('success', 'Sub Paket berhasil diupdate');
    }
}
