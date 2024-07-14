<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpesifikasiProperti extends Model
{
    use HasFactory;

    protected $table = 'spesifikasi_properti';

    protected $fillable = [
        'properti_id',
        'user_id',
        'alamat',
        'kota',
        'provinsi',
        'jenis_properti',
        'luas_tanah',
        'luas_bangunan',
        'jumlah_kamar_tidur',
        'jumlah_kamar_mandi',
        'fasilitas',
        'sertifikat',
    ];

    // Relationship with Properti
    public function properti()
    {
        return $this->belongsTo(Properti::class, 'properti_id');
    }
}
