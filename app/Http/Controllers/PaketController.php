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
        return view('admin.pages.paket.index', [
            'title' => 'index',
            'paket' => Paket::all(),
            'subpaket' => Subpaket::all(),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_paket' => 'required|unique:pakets,nama_paket',
        ]);

        $data = new Paket();
        $data->nama_paket = $request->nama_paket;

        if ($data->save()) {
            return redirect()->back()->with('success', 'Paket baru berhasil ditambahkan!');
        } else {
            return redirect()->back()->with('error', 'Nama paket gagal ditambahkan!');
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_paket' => 'required|unique:pakets,nama_paket',
        ]);

        $data = Paket::findOrFail($id);
        $data->nama_paket = $request->nama_paket;

        if ($data->save()) {
            return redirect()->back()->with('success', 'Nama paket berhasil diupdate!');
        } else {
            return redirect()->back()->with('error', 'Nama paket gagal diupdate!');
        }
    }

    public function destroy($id)
    {
        $data = Paket::findOrFail($id);
        if ($data->delete()) {
            return redirect()->back()->with('success', 'Paket berhasil dihapus!');
        } else {
            return redirect()->back()->with('error', 'Paket gagal dihapus!');
        }
    }

    public function show($id)
    {
        return view('admin.pages.paket.show', [
            'title' => 'index',
            'paket' => Paket::findOrFail($id),
            'data' => Subpaket::where('paket_id', $id)->get(),
        ]);
    }

    public function substore(Request $request)
    {
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
            'benefit' => $request->benefit
        ]);

        return redirect()->back()->with('success', 'Sub Paket berhasil ditambahkan');
    }

    public function subupdate(Request $request, $id)
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
            'benefit' => $request->benefit
        ]);

        return redirect()->back()->with('success', 'Sub Paket berhasil diupdate');
    }
}
