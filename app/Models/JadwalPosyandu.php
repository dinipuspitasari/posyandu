<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalPosyandu extends Model
{
    use HasFactory;

    protected $table = 'jadwal_posyandu';

    protected $primaryKey = 'id_jadwal_posyandu';  // Set primary key sesuai nama baru

    // Jika primary key bukan increment integer standar, tambahkan ini
    // protected $keyType = 'int';
    // public $incrementing = true;

    protected $fillable = [
        'nama_kegiatan',
        'tanggal',
        'waktu',
        'lokasi',
        'keterangan',
        'id_petugas',
    ];

    public function petugas()
    {
        return $this->belongsTo(Petugas::class, 'id_petugas');
    }
}

