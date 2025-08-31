<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.pages.data-admin.index', [
            'title' => 'index',
            'data' => User::where('role','admin')->get(),
        ]);
    }

    public function create() {
        return view('admin.pages.data-admin.create');
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users,email',
            'phone' => 'required',
            'role' => 'required',
            'password' => 'required',
            'gambar' => 'required',
        ]);

        $requestImg = $request->file('gambar');
        $imageName = $request->name.'.' . $requestImg->extension();
        $requestImg->move(public_path('assets/img/'), $imageName);

        $data = new User();
        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->role = $request->role;
        $data->password = Hash::make($request->password);
        $data->gambar = $imageName;

        if ($data->save()) {
            return redirect('/data-admin')->with('success', 'Data baru berhasil ditambahkan!');
        } else {
            return redirect('/data-admin')->with('error', 'data gagal ditambahkan!');
        }
    }


    public function edit($id) {
        return view('admin.pages.data-admin.edit',[
            'data' => User::findOrFail($id),
        ]);
    }

    public function update(Request $request, $id) {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'role' => 'required',
        ]);

        $data = User::findOrFail($id);

        if ($request->hasFile('gambar')) {
            // Hapus file foto sebelumnya dari penyimpanan
            if ($data->gambar && file_exists(public_path('assets/img/' . $data->gambar))) {
                unlink(public_path('assets/img/' . $data->gambar));
            }
            $requestImg = $request->file('gambar');
            $imageName = $request->nama_logo .'.' . $requestImg->extension();
            $requestImg->move(public_path('assets/img/'), $imageName);    
        } else {
            $imageName = $data->gambar;
        }

        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->role = $request->role;
        if ($request->filled('password')) {
            $data->password = Hash::make($request->password);
        }
        $data->gambar = $imageName;

        if ($data->save()) {
            return redirect('/data-admin')->with('success', 'Data baru berhasil diupdate!');
        } else {
            return redirect('/data-admin')->with('error', 'data gagal diupdate!');
        }
    }

    public function destroy($id) {
        $data = User::findOrFail($id);

        if ($data->gambar) {
            $fotoPath = public_path('assets/img/' . $data->gambar);

            if (file_exists($fotoPath)) {
                unlink($fotoPath);
            }
        }

        if ($data->delete()) {
            return redirect()->back()->with('success', 'Data berhasil dihapus!');
        } else {
            return redirect()->back()->with('error', 'Data gagal dihapus!');
        }
    }
}
