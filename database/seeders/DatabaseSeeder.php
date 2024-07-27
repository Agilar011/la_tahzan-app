<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
{
    $this->call([
        UserSeeder::class,
        OtomotifSeeder::class,
        SpesifikasiOtomotifSeeder::class,
        // seeder lainnya jika ada
    ]);
}

}
