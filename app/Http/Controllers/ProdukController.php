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
    public function desainProduk(Request $request)
    {
        $kategori = Kategori::all();
        $produk = Produk::all();

        return view('produk', compact('kategori', 'produk'));
    }

    public function produk(Request $request)
    {
        $subpaket_id = $request->input('subpaket_id');
        $subpaket = Subpaket::findOrFail($subpaket_id);
        $kategori = Kategori::all();
        $produk = Produk::all();

        return view('produk', compact('kategori', 'produk', 'subpaket'));
    }

    /**
     * Menampilkan halaman pratinjau produk.
     * Menerima ID produk dari rute dan ID subpaket dari query string.
     */
    public function previewProduk($id, Request $request)
    {
        $produk = Produk::findOrFail($id);
        $subpaket_id = $request->input('subpaket_id');

        return view('preview_produk', compact('produk', 'subpaket_id'));
    }

    public function preview($id, Request $request)
    {
        $produk = Produk::findOrFail($id);
        $detailPakets = Subpaket::all();
        return view('preview_produk', compact('produk', 'detailPakets'));
    }


    public function index()
    {
        return view('admin.pages.produk.index', [
            'title' => 'index',
            'data' => Produk::orderBy('nama_produk')->get(),
            'kategori' => Kategori::all()
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'kategori_id' => 'required|exists:kategori_produks,id',
            'nama_produk' => 'required|unique:produks,nama_produk',
            'gambar_produk' => 'required',
            'fitur' => 'required|array',
            'fitur.*' => 'string',
        ]);

        $requestImg = $request->file('gambar_produk');
        $imageName = $request->nama_produk . '.' . $requestImg->extension();
        $requestImg->move(public_path('assets/img/'), $imageName);

        $data = new Produk();
        $data->kategori_id = $request->kategori_id;
        $data->nama_produk = $request->nama_produk;
        $data->gambar_produk = $imageName;
        $data->fitur = $request->fitur;

        if ($data->save()) {
            return redirect()->back()->with('success', 'Produk baru berhasil ditambahkan!');
        } else {
            return redirect()->back()->with('error', 'Produk gagal ditambahkan!');
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'kategori_id' => 'required|exists:kategori_produks,id',
            'nama_produk' => 'required',
            'fitur' => 'required|array',
            'fitur.*' => 'string'
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

        $data->kategori_id = $request->kategori_id;
        $data->nama_produk = $request->nama_produk;
        $data->gambar_produk = $imageName;
        $data->fitur = $request->fitur;

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

    public function prestore(Request $request, $id)
    {
        $produk = Produk::findOrFail($id);

        if ($request->hasFile('gambar')) {
            $request->validate([
                'gambar' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            ]);

            $file = $request->file('gambar');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('assets/img'), $filename);

            Preview::create([
                'produk_id' => $produk->id,
                'gambar' => $filename,
            ]);

            return back()->with('success', 'Preview produk berhasil ditambahkan!');
        }

        if ($request->hasFile('logo_baru')) {
            $request->validate([
                'logo_baru' => 'required|image|mimes:jpg,jpeg,png|max:2048',
                'nama_logo' => 'required|string|max:100',
            ]);

            $file = $request->file('logo_baru');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('assets/img/logo'), $filename);

            // Simpan ke tabel logos
            $logo = Logo::create([
                'nama_logo' => $request->nama_logo,
                'gambar_logo' => $filename,
            ]);

            // Hubungkan ke produk
            $produk->logos()->attach($logo->id);

            return back()->with('success', 'Logo baru berhasil ditambahkan ke produk!');
        }

        // Jika memilih logo yang sudah ada
        if ($request->filled('logo_id')) {
            $produk->logos()->attach($request->logo_id);
            return back()->with('success', 'Logo berhasil ditambahkan dari database!');
        }

        return back()->with('error', 'Tidak ada data yang ditambahkan!');
    }

    // Hapus preview produk
    public function predestroy($id)
    {
        $preview = Preview::findOrFail($id);

        // Hapus file fisik
        $path = public_path('assets/img/' . $preview->gambar);
        if (file_exists($path)) {
            unlink($path);
        }

        $preview->delete();

        return back()->with('success', 'Preview produk berhasil dihapus!');
    }
}
