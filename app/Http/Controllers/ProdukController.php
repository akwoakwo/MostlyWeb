<?php

namespace App\Http\Controllers;

use App\Models\Logo;
use App\Models\Produk;
use App\Models\Preview;
use App\Models\Kategori;
use App\Models\Subpaket;
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

    public function index()
    {
        return view('admin.pages.produk.index', [
            'title' => 'index',
            'data' => Produk::orderBy('nama_produk')->get(),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_produk' => 'required|unique:produks,nama_produk',
            'gambar_produk' => 'required',
        ]);

        $requestImg = $request->file('gambar_produk');
        $imageName = $request->nama_produk . '.' . $requestImg->extension();
        $requestImg->move(public_path('assets/img/'), $imageName);

        $data = new Produk();
        $data->nama_produk = $request->nama_produk;
        $data->gambar_produk = $imageName;

        if ($data->save()) {
            return redirect()->back()->with('success', 'Produk baru berhasil ditambahkan!');
        } else {
            return redirect()->back()->with('error', 'Produk gagal ditambahkan!');
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_produk' => 'required',
        ]);

        $data = Produk::findOrFail($id);

        if ($request->hasFile('gambar_produk')) {
            if ($data->gambar_produk && file_exists(public_path('assets/img' . $data->gambar_produk))) {
                unlink(public_path('assets/img/' . $data->gambar_produk));
            }
            $requestImg = $request->file('gambar_produk');
            $imageName = $request->nama_produk . '.' . $requestImg->extension();
            $requestImg->move(public_path('assets/img/'), $imageName);
        } else {
            $imageName = $data->gambar_produk;
        }

        $data->nama_produk = $request->nama_produk;
        $data->gambar_produk = $imageName;

        if ($data->save()) {
            return redirect()->back()->with('success', 'Produk berhasil diupdate!');
        } else {
            return redirect()->back()->with('error', 'Produk gagal diupdate!');
        }
    }

    public function destroy($id)
    {
        $data = Produk::findOrFail($id);

        if ($data->gambar_produk) {
            $fotoPath = public_path('assets/img/' . $data->gambar_produk);

            if (file_exists($fotoPath)) {
                unlink($fotoPath);
            }
        }

        if ($data->delete()) {
            return redirect()->back()->with('success', 'Produk berhasil dihapus!');
        } else {
            return redirect()->back()->with('error', 'Produk gagal dihapus!');
        }
    }

    public function show($id)
    {
        $produk = Produk::with(['previews', 'logos'])->findOrFail($id);
        return view('admin.pages.produk.show', compact('produk'));
    }

    public function prestore(Request $request)
    {
        $request->validate([
            'produk_id' => 'required|exists:produks,id',
            'gambar' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048'
        ]);

        $file = $request->file('gambar');
        $filename = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path('assets/img'), $filename);
        Preview::create([
            'produk_id' => $request->produk_id,
            'gambar' => $filename,
        ]);

        return back()->with('success', 'Preview berhasil ditambahkan');
    }

    public function predestroy($id)
    {
        $preview = Preview::findOrFail($id);

        // Buat path lengkap file
        $path = public_path('assets/img/' . $preview->gambar);

        if (file_exists($path)) {
            unlink($path);
        }

        // hapus dari database
        $preview->delete();

        return back()->with('success', 'Preview berhasil dihapus');
    }
}
