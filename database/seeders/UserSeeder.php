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
            'email' => 'user@admin.com',
            'ktp' => '1234567890',
            'password' => Hash::make('password'),
            'google_id' => null,
            'role' => 'admin',
        ]);
    }

}
