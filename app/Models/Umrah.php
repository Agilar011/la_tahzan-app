<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Umrah extends Model
{
    use HasFactory;

    protected $table = 'umrah';
    protected $fillable = ['judul_produk', 'deskripsi_produk', 'harga', 'status_ads'];

    public function spesifikasi()
    {
        return $this->hasOne(SpesifikasiUmrah::class);
    }

    public function fotos()
    {
        return $this->hasMany(FotoUmrah::class);
    }
}
