<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ReviewController extends Controller
{
    
    public function index() {
       return view('admin.pages.ulasan.index', [
            'data' => Review::all(),
        ]); 
    }

    public function store(Request $request) {
        $data = new Review();
        $data->pemesanan_id = $request->pemesanan_id;
        $data->user_id = auth()->user()->id;
        $data->rating = $request->rating;
        $data->ulasan = $request->ulasan;

        if ($data->save()) {
            return redirect('riwayat-pesan')->with('success', 'Terima kasih atas ulasan anda!');
        } else {
            return redirect('riwayat-pesan')->with('error', 'Yahh! Anda belum bisa memberikan ulasan.');
        }
    } 

    public function destroy($id) {
        $data = Review::findOrFail($id);
        if ($data->delete()) {
            return redirect()->back()->with('success', 'Ulasan berhasil dihapus!');
        } else {
            return redirect()->back()->with('error', 'Ulasan gagal dihapus!');
        }
    }
}
