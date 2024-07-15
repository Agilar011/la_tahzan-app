<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UmrahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Buat data dummy untuk diisi ke dalam tabel otomotif
        $data = [
            [
                'judul_produk' => 'Produk Umrah 1',
                'deskripsi_produk' => 'Deskripsi produk Umrah 1',
                'harga' => 34000000, // contoh harga dalam satuan rupiah
                'status_ads' => 'show',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'judul_produk' => 'Produk Umrah 2',
                'deskripsi_produk' => 'Deskripsi produk Umrah 2',
                'harga' => 36000000,
                'status_ads' => 'show',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'judul_produk' => 'Produk Umrah 3',
                'deskripsi_produk' => 'Deskripsi produk Umrah 3',
                'harga' => 40000000,
                'status_ads' => 'show',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // tambahkan data lainnya sesuai kebutuhan
        ];

        // Masukkan data ke dalam tabel otomotif
        DB::table('umrah')->insert($data);
    }
}
