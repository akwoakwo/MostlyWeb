<?php

namespace App\Http\Controllers;

use App\Models\Logo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LogoController extends Controller
{
  public function index()
    {
        return view('admin.pages.logo.index', [
            'title' => 'index',
            'data' => Logo::orderBy('nama_logo')->get(),
        ]);
    }

    public function store(Request $request) {
        $request->validate([
            'nama_logo' => 'required|unique:logos,nama_logo',
            'gambar_logo' => 'required',
        ]);

        $requestImg = $request->file('gambar_logo');
        $imageName = $request->nama_logo.'.' . $requestImg->extension();
        $requestImg->move(public_path('assets/'), $imageName);

        $data = new Logo();
        $data->nama_logo = $request->nama_logo;
        $data->gambar_logo = $imageName;

        if ($data->save()) {
            return redirect()->back()->with('success', 'Logo baru berhasil ditambahkan!');
        } else {
            return redirect()->back()->with('error', 'Logo gagal ditambahkan!');
        }
    }

    public function update(Request $request, $id) {
        $request->validate([
            'nama_logo' => 'required',
        ]);

        $data = Logo::findOrFail($id);

        if ($request->hasFile('gambar_logo')) {
            // Hapus file foto sebelumnya dari penyimpanan
            if ($data->gambar_logo && file_exists(public_path('assets/' . $data->gambar_logo))) {
                unlink(public_path('assets/' . $data->gambar_logo));
            }
            $requestImg = $request->file('gambar_logo');
            $imageName = $request->nama_logo .'.' . $requestImg->extension();
            $requestImg->move(public_path('assets/'), $imageName);    
        } else {
            $imageName = $data->gambar_logo;
        }

        $data->nama_logo = $request->nama_logo;
        $data->gambar_logo = $imageName;

        if ($data->save()) {
            return redirect()->back()->with('success', 'Logo berhasil diupdate!');
        } else {
            return redirect()->back()->with('error', 'Logo gagal diupdate!');
        }
    }

    public function destroy($id) {
        $data = Logo::findOrFail($id);

        if ($data->gambar_logo) {
            $fotoPath = public_path('assets/' . $data->gambar_logo);

            if (file_exists($fotoPath)) {
                unlink($fotoPath);
            }
        }

        if ($data->delete()) {
            return redirect()->back()->with('success', 'Logo berhasil dihapus!');
        } else {
            return redirect()->back()->with('error', 'Logo gagal dihapus!');
        }
    }
}
