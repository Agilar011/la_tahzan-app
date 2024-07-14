<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FotoProperti extends Model
{
    use HasFactory;

    protected $table = 'foto_properti';

    protected $fillable = [
        'properti_id',
        'path',
    ];

    // Relationship with Properti
    public function properti()
    {
        return $this->belongsTo(Properti::class, 'properti_id');
    }
}
