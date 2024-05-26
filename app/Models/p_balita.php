<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class p_balita extends Model
{
    use HasFactory;
    protected $table = 'dt_p_balita';
    protected $primaryKey = 'id_p_balita';
    public $timestamps = true;

    protected $fillable = ['id_p_balita', 'nik_balita', 'nama_balita', 'berat_badan', 'panjang_badan', 'lingkar_kepala', 'lingkar_lengan', 'jenis_imunisasi', 'alamat'];

    public function balita()
    {
        return $this->belongsTo(balita::class, 'nik_balita', 'nik_balita');
    }
}
