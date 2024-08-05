<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class dataWareHouse extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_otomotif',
        'id_properti',
        'id_umrah',
        'id_spesifikasi_umrah',
        'id_spesifikasi_otomotif',
        'id_spesifikasi_properti',
        'judul_produk',
        'deskripsi_produk',
        'jenis_produk',  //category
        //umrah
        'agen',
        'maskapai',
        'hotel',
        'durasi',
        //otomotif
        'subtype', //ngerangkap sama properti
        'cc',
        'tahun_pembuatan',
        'brand',
        //property
        'kota',
        'provinsi',
        'luas_tanah',
        'luas_bangunan',
        'kamar_tidur',
        'kamar_mandi',
    ];

    public function umrah()
    {
        return $this->belongsTo(Umrah::class, 'id_umrah');
    }

    public function otomotif()
    {
        return $this->belongsTo(Otomotif::class, 'id_otomotif');
    }

    public function properti()
    {
        return $this->belongsTo(Properti::class, 'id_properti');
    }

    public function spesifikasiUmrah()
    {
        return $this->hasOne(SpesifikasiUmrah::class, 'id', 'id_spesifikasi_umrah');
    }

    public function spesifikasiOtomotif()
    {
        return $this->hasOne(SpesifikasiOtomotif::class, 'id', 'id_spesifikasi_otomotif');
    }

    public function spesifikasiProperti()
    {
        return $this->hasOne(SpesifikasiProperti::class, 'id', 'id_spesifikasi_properti');
    }


}
