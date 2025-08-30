<?php

namespace App\Http\Controllers;

use App\Models\Logo;
use App\Models\User;
use App\Models\Paket;
use App\Models\Produk;
use App\Models\Kategori;
use App\Models\Subpaket;
use App\Models\Faq;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function index()
    {
        return view('index', [
            'title' => 'index',
            'paket' => Paket::all(),
            'subpaket' => Subpaket::all(),
            'logo' => Logo::all(),
            'kategori' => Kategori::take(6)->get(),
            'produk' => Produk::all(),
            'ulasan' => Review::all(),
            'faq' => Faq::all(),
        ]);
    }

    // Register
    public function register(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'phone'     => 'required|string|max:255',
            'email'    => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $user = User::create([
            'name'     => $request->name,
            'phone'    => $request->phone,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => 'customer',
        ]);

        Auth::login($user);

        return redirect()->route('index')->with('success', 'Registrasi berhasil, selamat datang!');
    }

    // Login
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials, $request->remember)) {
            $request->session()->regenerate();

            $user = Auth::user();

            if ($user->role === 'admin') {
                return redirect()->route('dashboard')->with('success', 'Login berhasil sebagai Admin');
            } elseif ($user->role === 'customer') {
                return redirect()->route('index')->with('success', 'Login berhasil');
            }
        }

        return back()->withErrors([
            'email' => 'Email atau password salah',
        ])->onlyInput('email');
    }

    // Logout
    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }

    // Tampilkan Profil Customer
    public function profile()
    {
        $user = Auth::user();
        return view('customer.profil', compact('user'));
    }

    // Update Profil
    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'name'   => 'required|string|max:255',
            'phone'  => 'nullable|string|max:20',
            'email'  => 'required|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:6',
            'gambar'   => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        // Update field dasar
        $user->name  = $validated['name'];
        $user->phone = $validated['phone'] ?? null;
        $user->email = $validated['email'];

        // Update password jika diisi
        if (!empty($validated['password'])) {
            $user->password = Hash::make($validated['password']);
        }

        // Upload foto jika ada
        $user->update($request->only(['gambar']));
        if($request->has(('gambar'))){
            $request->file('gambar')->move('assets/img/', $request->file('gambar')->getClientOriginalName());
            $user->gambar = $request->file('gambar')->getClientOriginalName();
            $user->save();
        }

        $user->save();

        return back()->with('success', 'Profil berhasil diperbarui.');
    }

    public function dashboard()
    {
        return view('admin.dashboard');
    }
}
