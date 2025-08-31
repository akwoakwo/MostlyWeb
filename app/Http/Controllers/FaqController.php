<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    public function index() {
       return view('admin.pages.FAQ.index', [
            'data' => Faq::all(),
        ]); 
    }

      public function store(Request $request) {
        $request->validate([
            'pertanyaan' => 'required',
            'jawaban' => 'required'
        ]);

        $data = new FAQ();
        $data->pertanyaan = $request->pertanyaan;
        $data->jawaban = $request->jawaban;

        if ($data->save()) {
            return redirect()->back()->with('success', 'Data baru berhasil ditambahkan!');
        } else {
            return redirect()->back()->with('error', 'Data gagal ditambahkan!');
        }
    }

    public function update(Request $request, $id) {
        $request->validate([
            'pertanyaan' => 'required',
            'jawaban' => 'required'
        ]);

        $data = FAQ::findOrFail($id);
        $data->pertanyaan = $request->pertanyaan;
        $data->jawaban = $request->jawaban;

        if ($data->save()) {
            return redirect()->back()->with('success', 'Data berhasil diupdate!');
        } else {
            return redirect()->back()->with('error', 'Data gagal diupdate!');
        }
    }

    public function destroy($id) {
        $data = FAQ::findOrFail($id);
        if ($data->delete()) {
            return redirect()->back()->with('success', 'Data berhasil dihapus!');
        } else {
            return redirect()->back()->with('error', 'Data gagal dihapus!');
        }
    }
}
