<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class balita extends Model
{
    use HasFactory;
    protected $table = 'dt_balita';
    public $timestamps = true;

    protected $fillable = ['nik_balita', 'nama_balita', 'tgl_balita', 'usia', 'nik_ibu', 'nama_ibu', 'jenis_kelamin', 'alamat'];

    public function ibu()
    {
        return $this->belongsTo(ibu::class, 'nik_ibu', 'nik_ibu');
    }

    public function data_p_balita()
    {
        return $this->hasMany(p_balita::class, 'nik_balita', 'nik_balita');
    }
}
