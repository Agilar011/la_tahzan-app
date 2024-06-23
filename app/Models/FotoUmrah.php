<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FotoUmrah extends Model
{
    use HasFactory;

    protected $table = 'foto_umrah';
    protected $fillable = ['umrah_id', 'path'];

    public function umrah()
    {
        return $this->belongsTo(Umrah::class);
    }
}



