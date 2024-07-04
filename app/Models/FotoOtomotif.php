<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FotoOtomotif extends Model
{
    use HasFactory;

    protected $table = 'foto_otomotif';

    protected $fillable = [
        'otomotif_id', 'path'
    ];

    public function otomotif()
    {
        return $this->belongsTo(Otomotif::class, 'otomotif_id');
    }
}
