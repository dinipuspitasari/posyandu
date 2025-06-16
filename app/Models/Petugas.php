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
        'email',
        'password',
        'id_level',
    ];

    protected $hidden = [
        'password',
    ];

    /**
     * Hash password secara otomatis saat diset
     */
//    public function setPasswordAttribute($value)
// {
//     if (!empty($value)) {
//         $this->attributes['password'] = 
//             (strlen($value) === 60 && str_starts_with($value, '$2y$'))
//                 ? $value // sudah hash, jangan hash lagi
//                 : Hash::make($value);
//     }
// }
   public function setPasswordAttribute($value)
    {
        if ($value) {
            $this->attributes['password'] = Hash::make($value);
        }
    }

    /**
     * Relasi ke tabel levels
     */
    public function level()
    {
        return $this->belongsTo(Level::class, 'id_level');
    }
}
