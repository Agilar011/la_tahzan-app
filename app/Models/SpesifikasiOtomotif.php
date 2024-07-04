<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpesifikasiOtomotif extends Model
{
    use HasFactory;

    protected $table = 'spesifikasi_otomotif';

    protected $fillable = [
        'otomotif_id', 'user_id', 'transmisi', 'type', 'subtype', 'kilometer', 'kapasitas_mesin',
        'tahun_pembuatan', 'brand', 'bpkb', 'stnk', 'seller', 'phone', 'address'
    ];

    public function otomotif()
    {
        return $this->belongsTo(Otomotif::class, 'otomotif_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
