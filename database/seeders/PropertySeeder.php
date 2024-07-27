<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PropertySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Buat data dummy untuk diisi ke dalam tabel property
        $data = [
            [
                'judul_produk' => 'Produk Property 1',
                'deskripsi_produk' => 'Deskripsi produk property 1',
                'harga' => 150000000, // contoh harga dalam satuan rupiah
                'status_ads' => 'show',
                'status_payment' => 'paid',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'judul_produk' => 'Produk Property 2',
                'deskripsi_produk' => 'Deskripsi produk property 2',
                'harga' => 140000000,
                'status_ads' => 'show',
                'status_payment' => 'paid',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'judul_produk' => 'Produk Property 3',
                'deskripsi_produk' => 'Deskripsi produk property 3',
                'harga' => 130000000,
                'status_ads' => 'show',
                'status_payment' => 'paid',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'judul_produk' => 'Produk Property 4',
                'deskripsi_produk' => 'Deskripsi produk property 4',
                'harga' => 120000000,
                'status_ads' => 'show',
                'status_payment' => 'paid',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'judul_produk' => 'Produk Property 5',
                'deskripsi_produk' => 'Deskripsi produk property 5',
                'harga' => 110000000,
                'status_ads' => 'show',
                'status_payment' => 'paid',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'judul_produk' => 'Produk Property 6',
                'deskripsi_produk' => 'Deskripsi produk property 6',
                'harga' => 100000000,
                'status_ads' => 'show',
                'status_payment' => 'paid',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'judul_produk' => 'Produk Property 7',
                'deskripsi_produk' => 'Deskripsi produk property 7',
                'harga' => 90000000,
                'status_ads' => 'show',
                'status_payment' => 'paid',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'judul_produk' => 'Produk Property 8',
                'deskripsi_produk' => 'Deskripsi produk property 8',
                'harga' => 80000000,
                'status_ads' => 'show',
                'status_payment' => 'paid',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'judul_produk' => 'Produk Property 9',
                'deskripsi_produk' => 'Deskripsi produk property 9',
                'harga' => 70000000,
                'status_ads' => 'show',
                'status_payment' => 'paid',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'judul_produk' => 'Produk Property 10',
                'deskripsi_produk' => 'Deskripsi produk property 10',
                'harga' => 60000000,
                'status_ads' => 'show',
                'status_payment' => 'paid',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // tambahkan data lainnya sesuai kebutuhan
        ];

        // Masukkan data ke dalam tabel property
        DB::table('properti')->insert($data);
    }
}
