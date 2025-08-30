<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function index()
    {
        return view('admin.pages.kategori.index', [
            'title' => 'index',
            'data' => Kategori::orderBy('nama_kategori')->get(),
        ]);
    }

    public function store(Request $request) {
        $request->validate([
            'nama_kategori' => 'required|unique:kategori_produks,nama_kategori',
        ]);

        $data = new Kategori();
        $data->nama_kategori = $request->nama_kategori;

        if ($data->save()) {
            return redirect()->back()->with('success', 'Kategori baru berhasil ditambahkan!');
        } else {
            return redirect()->back()->with('error', 'Nama kategori gagal ditambahkan!');
        }
    }

    public function update(Request $request, $id) {
        $request->validate([
            'nama_kategori' => 'required|unique:kategori_produks,nama_kategori',
        ]);

        $data = Kategori::findOrFail($id);
        $data->nama_kategori = $request->nama_kategori;

        if ($data->save()) {
            return redirect()->back()->with('success', 'Nama kategori berhasil diupdate!');
        } else {
            return redirect()->back()->with('error', 'Nama kategori gagal diupdate!');
        }
    }

    public function destroy($id) {
        $data = Kategori::findOrFail($id);
        if ($data->delete()) {
            return redirect()->back()->with('success', 'Kategori berhasil dihapus!');
        } else {
            return redirect()->back()->with('error', 'Kategori gagal dihapus!');
        }
    }
}
