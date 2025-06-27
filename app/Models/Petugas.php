<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Hash;

class Petugas extends Authenticatable
{
    use Notifiable, SoftDeletes;

    protected $table = 'petugas';
    
    protected $primaryKey = 'id_petugas';

    protected $fillable = [
        'nama',
        'id_level',
    ];
    
    //Relasi ke tabel levels
    public function level()
    {
        return $this->belongsTo(Level::class, 'id_level');
    }
}
