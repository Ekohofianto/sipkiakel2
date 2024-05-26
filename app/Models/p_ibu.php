<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class p_ibu extends Model
{
    use HasFactory;

    protected $table = 'dt_p_ibu';
    protected $primaryKey = 'id_p_ibu';
    public $timestamps = true;

    protected $fillable = ['id_p_ibu', 'nik_ibu', 'nama_ibu', 'berat_b', 'tinggi_b', 'tekanan_d', 'riwayat_p', 'usia_kehamilan', 'alamat'];

    public function ibu()
    {
        return $this->belongsTo(ibu::class, 'nik_ibu', 'nik_ibu');
    }
}
