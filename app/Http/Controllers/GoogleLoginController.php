<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class GoogleLoginController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    // public function handleGoogleCallback()
    // {
    //     try {
    //         // Ambil data user dari Google
    //         $googleUser = Socialite::driver('google')->user();

    //         // Cek apakah user sudah ada di database
    //         $user = User::where('google_id', $googleUser->id)->first();

    //         if ($user) {
    //             // Jika user sudah ada, lakukan login
    //             Auth::login($user);
    //             return redirect()->route('index'); // Ganti dengan halaman tujuan
    //         } else {
    //             // Jika user belum ada, buat user baru di database
    //             $newUser = User::create([
    //                 'name' => $googleUser->name,
    //                 'email' => $googleUser->email,
    //                 'google_id' => $googleUser->id,
    //                 'avatar' => $googleUser->avatar,
    //                 'role' => 'customer', // Atur role default
    //                 'password' => null, // Password tidak diperlukan
    //             ]);

    //             // Langsung login dengan user baru
    //             Auth::login($newUser);
    //             return redirect()->route('index'); // Ganti dengan halaman tujuan
    //         }
    //     } catch (\Exception $e) {
    //         // Tangani error jika ada masalah
    //         return redirect('/')->with('error', 'Login dengan Google gagal. Silakan coba lagi.');
    //     }
    // }

    public function handleGoogleCallback()
    {
        $googleUser = Socialite::driver('google')->user();

        $user = User::where('google_id', $googleUser->id)->first();

        if ($user) {
            Auth::login($user);
            return redirect()->route('index');
        } else {
            $newUser = User::create([
                'name' => $googleUser->name,
                'email' => $googleUser->email,
                'google_id' => $googleUser->id,
                'avatar' => $googleUser->avatar,
                'role' => 'customer',
                'password' => null,
            ]);

            Auth::login($newUser);
            return redirect()->route('index');
        }
    }
}
