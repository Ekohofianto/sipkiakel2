<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ibu extends Model
{
    use HasFactory;
    protected $fillable = ['nik_ibu', 'nama_ibu', 'tgl_ibu', 'usia', 'nama_suami', 'alamat', 'tgl'];
    protected $table = 'dt_ibu';
    public $timestamps = true;

    public function data_p_ibu()
    {
        return $this->hasMany(p_ibu::class, 'nik_ibu', 'nik_ibu');
    }
    public function data_balita()
    {
        return $this->hasMany(balita::class, 'nik_ibu', 'nik_ibu');
    }
}
