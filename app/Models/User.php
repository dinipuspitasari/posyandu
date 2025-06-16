<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'nik',
        'no_kk',
        'no_telp',
        'alamat',
        'id_level',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function level()
    {
        return $this->belongsTo(Level::class);
    }
}