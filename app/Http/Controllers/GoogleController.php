<?php
//abcde
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Exception;

class GoogleController extends Controller
{
    public function googlepage()
    {
        return Socialite::driver('google')->redirect();
    }

    public function googlecallback()
    {
        try {
            $user = Socialite::driver('google')->user();

            // Cari pengguna berdasarkan email terlebih dahulu
            $finduser = User::where('email', $user->email)->first();

            if ($finduser) {
                // Jika pengguna ditemukan tetapi tidak memiliki google_id, perbarui entri tersebut
                if (!$finduser->google_id) {
                    $finduser->google_id = $user->id;
                    $finduser->save();
                }

                // Login pengguna yang ditemukan
                Auth::login($finduser);
            } else {
                // Jika pengguna tidak ditemukan, buat pengguna baru
                $newUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'google_id' => $user->id,
                    'role' => 'customer', // Set role as 'customer'
                    'password' => encrypt('12345dummy')
                ]);

                Auth::login($newUser);
            }

            return redirect()->intended('dashboard');
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
}
