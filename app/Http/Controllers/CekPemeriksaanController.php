<?php

namespace App\Http\Controllers;

use App\Models\balita;
use Illuminate\Http\Request;
use App\Models\ibu;
use App\Models\p_ibu;
use App\Models\p_balita;
use Carbon\Carbon;

class CekPemeriksaanController extends Controller
{
    public function cekNIK(Request $request)
    {
        $request->validate([
            'nik_ibu' => 'required|string|max:16',
        ]);

        // Set locale to Indonesian
        Carbon::setLocale('id');

        $nik_ibu = $request->input('nik_ibu');

        // Contoh query ke database
        $dataIbu = ibu::with(['data_balita.data_p_balita'])->where('nik_ibu', $nik_ibu)->first();

        if ($dataIbu) {
            return view('cek_nik', [
                'dataIbu' => $dataIbu,
                'data_p_ibu' => p_ibu::where('nik_ibu', $nik_ibu)->get(),
                'dataBalita' => $dataIbu->data_balita,
                'data_p_balita' => $dataIbu->data_balita->pluck('data_p_balita')->flatten()
            ]);
        } else {
            return view('cek_nik', [
                'dataIbu' => null,
                'data_p_ibu' => collect(),
                'dataBalita' => collect(),
                'data_p_balita' => collect()
            ]);
        }
    }
}
