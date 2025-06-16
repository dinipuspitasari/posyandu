<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\DataAnak;

class PerkembanganAnak extends Model
{
    use HasFactory;

    protected $table = 'perkembangan_anak';

    protected $primaryKey = 'id_perkembangan_anak';

    protected $fillable = [
        'nik_anak',
        'nama_anak',
        'tanggal_posyandu',
        'berat_badan',
        'keterangan_berat_badan',
        'tinggi_badan',
        'lingkar_lengan_atas',
        'keterangan_lingkar_lengan',
        'lingkar_kepala',
        'id_imunisasi',
        'pemberian',
        'mt_pangan_lokal',
        'asi_eksklusif',
        'edukasi',
        'rujuk',
    ];

    // Relasi ke imunisasi
    public function imunisasi()
    {
        // return $this->belongsTo(Imunisasi::class, 'id_imunisasi');
        return $this->belongsTo(Imunisasi::class, 'id_imunisasi', 'id_imunisasi');
    }

    // Relasi ke data anak menggunakan nik_anak sebagai foreign key
    public function anak()
    {
        return $this->belongsTo(DataAnak::class, 'nik_anak', 'nik_anak');
        // return $this->belongsTo(DataAnak::class, 'id_data_anak', 'id_data_anak');
    }

}
