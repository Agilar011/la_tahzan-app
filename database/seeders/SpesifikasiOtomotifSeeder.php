<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\SpesifikasiOtomotif;
use Illuminate\Support\Facades\DB;


class SpesifikasiOtomotifSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $data = [
            [
                'otomotif_id' => 1,
                'user_id' => 1,
                'transmisi' => 'manual',
                'type' => 'sedan',
                'subtype' => 'sedan',
                'kilometer' => '1000',
                'kapasitas_mesin' => '1000cc',
                'tahun_pembuatan' => '2021-01-01',
                'brand' => 'honda',
                'bpkb' => 'ya',
                'stnk' => 'ya',
                'seller' => 'seller 1',
                'phone' => '08123456789',
                'address' => 'Jl. Jalan No. 1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'otomotif_id' => 2,
                'user_id' => 2,
                'transmisi' => 'matic',
                'type' => 'sedan',
                'subtype' => 'sedan',
                'kilometer' => '2000',
                'kapasitas_mesin' => '2000cc',
                'tahun_pembuatan' => '2021-01-01',
                'brand' => 'toyota',
                'bpkb' => 'ya',
                'stnk' => 'ya',
                'seller' => 'seller 2',
                'phone' => '08123456789',
                'address' => 'Jl. Jalan No. 2',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'otomotif_id' => 3,
                'user_id' => 3,
                'transmisi' => 'manual',
                'type' => 'sedan',
                'subtype' => 'sedan',
                'kilometer' => '3000',
                'kapasitas_mesin' => '3000cc',
                'tahun_pembuatan' => '2021-01-01',
                'brand' => 'suzuki',
                'bpkb' => 'ya',
                'stnk' => 'ya',
                'seller' => 'seller 3',
                'phone' => '08123456789',
                'address' => 'Jl. Jalan No. 3',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'otomotif_id' => 4,
                'user_id' => 4,
                'transmisi' => 'matic',
                'type' => 'sedan',
                'subtype' => 'sedan',
                'kilometer' => '4000',
                'kapasitas_mesin' => '4000cc',
                'tahun_pembuatan' => '2021-01-01',
                'brand' => 'mitsubishi',
                'bpkb' => 'ya',
                'stnk' => 'ya',
                'seller' => 'seller 4',
                'phone' => '08123456789',
                'address' => 'Jl. Jalan No. 4',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'otomotif_id' => 5,
                'user_id' => 5,
                'transmisi' => 'manual',
                'type' => 'sedan',
                'subtype' => 'sedan',
                'kilometer' => '5000',
                'kapasitas_mesin' => '5000cc',
                'tahun_pembuatan' => '2021-01-01',
                'brand' => 'nissan',
                'bpkb' => 'ya',
                'stnk' => 'ya',
                'seller' => 'seller 5',
                'phone' => '08123456789',
                'address' => 'Jl. Jalan No. 5',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'otomotif_id' => 6,
                'user_id' => 6,
                'transmisi' => 'matic',
                'type' => 'sedan',
                'subtype' => 'sedan',
                'kilometer' => '6000',
                'kapasitas_mesin' => '6000cc',
                'tahun_pembuatan' => '2021-01-01',
                'brand' => 'honda',
                'bpkb' => 'ya',
                'stnk' => 'ya',
                'seller' => 'seller 6',
                'phone' => '08123456789',
                'address' => 'Jl. Jalan No. 6',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'otomotif_id' => 7,
                'user_id' => 7,
                'transmisi' => 'manual',
                'type' => 'sedan',
                'subtype' => 'sedan',
                'kilometer' => '7000',
                'kapasitas_mesin' => '7000cc',
                'tahun_pembuatan' => '2021-01-01',
                'brand' => 'toyota',
                'bpkb' => 'ya',
                'stnk' => 'ya',
                'seller' => 'seller 7',
                'phone' => '08123456789',
                'address' => 'Jl. Jalan No. 7',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'otomotif_id' => 8,
                'user_id' => 8,
                'transmisi' => 'matic',
                'type' => 'sedan',
                'subtype' => 'sedan',
                'kilometer' => '8000',
                'kapasitas_mesin' => '8000cc',
                'tahun_pembuatan' => '2021-01-01',
                'brand' => 'suzuki',
                'bpkb' => 'ya',
                'stnk' => 'ya',
                'seller' => 'seller 8',
                'phone' => '08123456789',
                'address' => 'Jl. Jalan No. 8',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'otomotif_id' => 9,
                'user_id' => 9,
                'transmisi' => 'manual',
                'type' => 'sedan',
                'subtype' => 'sedan',
                'kilometer' => '9000',
                'kapasitas_mesin' => '9000cc',
                'tahun_pembuatan' => '2021-01-01',
                'brand' => 'mitsubishi',
                'bpkb' => 'ya',
                'stnk' => 'ya',
                'seller' => 'seller 9',
                'phone' => '08123456789',
                'address' => 'Jl. Jalan No. 9',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'otomotif_id' => 10,
                'user_id' => 10,
                'transmisi' => 'matic',
                'type' => 'sedan',
                'subtype' => 'sedan',
                'kilometer' => '10000',
                'kapasitas_mesin' => '10000cc',
                'tahun_pembuatan' => '2021-01-01',
                'brand' => 'nissan',
                'bpkb' => 'ya',
                'stnk' => 'ya',
                'seller' => 'seller 10',
                'phone' => '08123456789',
                'address' => 'Jl. Jalan No.
                    10',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        DB::table('spesifikasi_otomotif')->insert($data);

    }
}
