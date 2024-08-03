<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Official Admin',
            'phone' => '1234567890',
            'birthday' => '1990-01-01',
            'age' => '30',
            'gender' => 'Pria',
            'email' => 'adimas@admin.com',
            'ktp' => '1234567890',
            'password' => Hash::make('password'),
            'google_id' => null,
            'role' => 'admin',
        ]);

        // Seeder ini akan membuat 10 user dengan KTP unik dan password urut
        $ktpBase = 1234567890; // KTP dasar untuk dijadikan basis
        $passwordBase = 'password'; // Password dasar untuk dijadikan basis
        $usersCount = 10; // Jumlah user yang ingin dibuat

        for ($i = 1; $i <= $usersCount; $i++) {
            $user = User::create([
                'name' => 'Official Customer',
                'phone' => '1234567891',
                'birthday' => '1990-01-01',
                'age' => '30',
                'gender' => 'Pria',
                'email' => 'user' . $i . '@admin.com',
                'ktp' => $ktpBase + $i,
                'password' => Hash::make($passwordBase . $i),
                'google_id' => null,
                'role' => 'customer',
            ]);
        }


    }

}
