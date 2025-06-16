<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Imunisasi extends Model
{
    use HasFactory;

    protected $table = 'imunisasi'; // Nama tabel di database
    
    protected $primaryKey = 'id_imunisasi';

    public $incrementing = true;      

    protected $keyType = 'int';  

    protected $fillable = [
        'name',
    ];

    public function getRouteKeyName()
    {
        return 'id_imunisasi';
    }
}
