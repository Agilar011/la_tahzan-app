<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OtomotifSeeder extends Seeder
{
    public function run()
    {
        // Buat data dummy untuk diisi ke dalam tabel otomotif
        $data = [
            [
                'judul_produk' => 'Produk Otomotif 1',
                'deskripsi_produk' => 'Deskripsi produk otomotif 1',
                'harga' => 150000000, // contoh harga dalam satuan rupiah
                'status_ads' => 'show',
                'status_payment' => 'paid',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'judul_produk' => 'Produk Otomotif 2',
                'deskripsi_produk' => 'Deskripsi produk otomotif 2',
                'harga' => 140000000,
                'status_ads' => 'show',
                'status_payment' => 'paid',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'judul_produk' => 'Produk Otomotif 3',
                'deskripsi_produk' => 'Deskripsi produk otomotif 3',
                'harga' => 130000000,
                'status_ads' => 'show',
                'status_payment' => 'paid',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'judul_produk' => 'Produk Otomotif 4',
                'deskripsi_produk' => 'Deskripsi produk otomotif 4',
                'harga' => 120000000,
                'status_ads' => 'show',
                'status_payment' => 'paid',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'judul_produk' => 'Produk Otomotif 5',
                'deskripsi_produk' => 'Deskripsi produk otomotif 5',
                'harga' => 110000000,
                'status_ads' => 'show',
                'status_payment' => 'paid',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'judul_produk' => 'Produk Otomotif 6',
                'deskripsi_produk' => 'Deskripsi produk otomotif 6',
                'harga' => 100000000,
                'status_ads' => 'show',
                'status_payment' => 'paid',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'judul_produk' => 'Produk Otomotif 7',
                'deskripsi_produk' => 'Deskripsi produk otomotif 7',
                'harga' => 90000000,
                'status_ads' => 'show',
                'status_payment' => 'paid',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'judul_produk' => 'Produk Otomotif 8',
                'deskripsi_produk' => 'Deskripsi produk otomotif 8',
                'harga' => 80000000,
                'status_ads' => 'show',
                'status_payment' => 'paid',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'judul_produk' => 'Produk Otomotif 9',
                'deskripsi_produk' => 'Deskripsi produk otomotif 9',
                'harga' => 70000000,
                'status_ads' => 'show',
                'status_payment' => 'paid',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'judul_produk' => 'Produk Otomotif 10',
                'deskripsi_produk' => 'Deskripsi produk otomotif 10',
                'harga' => 60000000,
                'status_ads' => 'show',
                'status_payment' => 'paid',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // tambahkan data lainnya sesuai kebutuhan
        ];

        // Masukkan data ke dalam tabel otomotif
        DB::table('otomotif')->insert($data);
    }
}
