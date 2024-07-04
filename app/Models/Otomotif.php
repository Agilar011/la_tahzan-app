<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Otomotif extends Model
{
    use HasFactory;

    protected $table = 'otomotif';

    protected $fillable = [
        'judul_produk', 'deskripsi_produk', 'harga', 'status_ads', 'status_payment', 'created_at'
    ];

    public $timestamps = true;

    public function spesifikasi()
    {
        return $this->hasOne(SpesifikasiOtomotif::class, 'otomotif_id');
    }

    public function fotos()
    {
        return $this->hasMany(FotoOtomotif::class, 'otomotif_id');
    }
}
