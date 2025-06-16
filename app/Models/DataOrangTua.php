<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DataOrangTua extends Model
{
    use SoftDeletes;

    protected $table = 'data_orang_tua';

    protected $primaryKey = 'id_data_orang_tua'; // tambahkan ini

    protected $fillable = [
        'nik_ibu',
        'nama_ibu',
        'no_telpon',
        'alamat',
        'user_id',
    ];

    public function anak()
    {
        return $this->hasMany(DataAnak::class, 'id_data_orang_tua');
    }

    // DataOrangTua.php
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }


}
