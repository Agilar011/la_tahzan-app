<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpesifikasiUmrah extends Model
{
    use HasFactory;

    protected $table = 'spesifikasi_umrah';
    protected $fillable = [
        'umrah_id', 'agen_travel', 'nomor_telefon_agen',
        'maskapai', 'hotel', 'tanggal_keberangkatan', 'durasi'
    ];

    public function umrah()
    {
        return $this->belongsTo(Umrah::class);
    }
}

