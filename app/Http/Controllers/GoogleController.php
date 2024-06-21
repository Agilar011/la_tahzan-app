<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
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
            $googleUser = Socialite::driver('google')->user();

            // Cari pengguna berdasarkan email terlebih dahulu
            $user = User::where('email', $googleUser->email)->first();

            if ($user) {
                // Jika pengguna ditemukan tetapi tidak memiliki google_id, perbarui entri tersebut
                if (!$user->google_id) {
                    $user->google_id = $googleUser->id;
                    $user->save();
                }

                // Login pengguna yang ditemukan
                Auth::login($user);
            } else {
                // Jika pengguna tidak ditemukan, buat pengguna baru
                $newUser = User::create([
                    'name' => $googleUser->name,
                    'email' => $googleUser->email,
                    'google_id' => $googleUser->id,
                    'role' => 'customer', // Set role as 'customer'
                    'password' => encrypt('12345dummy')
                ]);

                Auth::login($newUser);
            }

            // Log role for debugging
            Log::info('User Role: ' . Auth::user()->role);

            // Redirect based on role
            return $this->redirectBasedOnRole();
        } catch (Exception $e) {
            Log::error('Google callback error: ' . $e->getMessage());
            dd($e->getMessage());
        }
    }

    protected function redirectBasedOnRole()
    {
        $user = Auth::user();
        Log::info('Redirecting user role: ' . $user->role); // Log role for debugging
        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }
        return redirect()->route('dashboard');
    }
}
