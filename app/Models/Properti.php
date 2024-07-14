<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Properti extends Model
{
    use HasFactory;

    protected $table = 'properti';

    protected $fillable = [
        'judul_produk',
        'deskripsi_produk',
        'harga',
        'status_ads',
        'status_payment',
    ];

    // Relationship with SpesifikasiProperti
    public function spesifikasi()
    {
        return $this->hasOne(SpesifikasiProperti::class, 'properti_id');
    }

    // Relationship with FotoProperti
    public function fotos()
    {
        return $this->hasMany(FotoProperti::class, 'properti_id');
    }
}
