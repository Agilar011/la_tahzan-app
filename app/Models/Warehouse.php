<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Warehouse extends Model
{
    use HasFactory;

    protected $table = 'warehouse';

    protected $fillable = [
        'judul_produk',
        'deskripsi_produk',
        'kategori',
        'harga',
        'status_ads',
        'status_payment',
    ];

    public $timestamps = true;

    public function spesifikasi()
    {
        return $this->hasOne(SpesifikasiOtomotif::class, 'warehouse_id');
    }

    public function fotos()
    {
        return $this->hasMany(FotoOtomotif::class, 'warehouse_id');
    }
}
