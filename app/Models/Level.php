<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
    use HasFactory;

    protected $table = 'levels';

    protected $primaryKey = 'id_level';

    protected $fillable = [
        'name_level',
    ];

    /**
     * Relasi ke petugas
     */
    public function petugas()
    {
        return $this->hasMany(Petugas::class, 'id_level');
    }
}