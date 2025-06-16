<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class DataAnak extends Model
{
    use SoftDeletes;

    protected $table = 'data_anak';

    protected $primaryKey = 'id_data_anak'; // Revisi: pakai nama ID kustom
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'nik_anak',
        'nama_ibu',
        'nama_anak',
        'tempat_lahir',
        'tanggal_lahir',
        'umur',
        'jenis_kelamin',
        'id_data_orang_tua',
        'detail_anak',
    ];

    protected $dates = ['tanggal_lahir', 'deleted_at'];

    /**
     * Relasi ke model DataOrangTua
     */
    public function orangTua()
    {
        return $this->belongsTo(DataOrangTua::class, 'id_data_orang_tua', 'id_data_orang_tua');
    }

    /**
     * Accessor: Umur dalam format "X tahun Y bulan"
     */
    public function getUmurFormattedAttribute()
    {
        if ($this->tanggal_lahir) {
            $lahir = Carbon::parse($this->tanggal_lahir);
            return $lahir->diff(Carbon::now())->format('%y tahun %m bulan');
        }
        return null;
    }

    public function perkembangan()
    {
        return $this->hasMany(PerkembanganAnak::class, 'nik_anak', 'nik_anak');
    }

    public function imunisasi()
    {
        return $this->hasMany(Imunisasi::class, 'nik_anak', 'nik_anak');
    }
    
}
