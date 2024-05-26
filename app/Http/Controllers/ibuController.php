<?php

namespace App\Http\Controllers;

use App\Models\ibu;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use PhpParser\Node\Stmt\Return_;

class ibuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index(Request $request)
    {
        // Ambil semua data pemeriksaan ibu tanpa melakukan pencarian
        $data_ibu = ibu::orderBy('nik_ibu', 'desc')->get();

        return view('ibu.ibu')->with('data_ibu', $data_ibu);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('ibu.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Session::flash('nik_ibu', $request->nik_ibu);
        Session::flash('nama_ibu', $request->nama_ibu);
        Session::flash('tgl_ibu', $request->tgl_ibu);
        Session::flash('usia', $request->usia);
        Session::flash('nama_suami', $request->nama_suami);
        Session::flash('alamat', $request->alamat);

        $request->validate([
            'nik_ibu' => 'required|numeric|digits:16|unique:dt_ibu,nik_ibu',
            'nama_ibu' => 'required|string|max:255',
            'tgl_ibu' => 'required|date',
            'usia' => 'numeric',
            'nama_suami' => 'nullable',
            'alamat' => 'required|not_in:--Pilih Alamat--',
        ]);

        $data_ibu = [
            'nik_ibu' => $request->nik_ibu,
            'nama_ibu' => $request->nama_ibu,
            'tgl_ibu' => $request->tgl_ibu,
            'usia' => $this->hitungUsia($request->tgl_ibu), // Menggunakan metode hitungUsia
            'nama_suami' => $request->nama_suami,
            'alamat' => $request->alamat,
        ];

        ibu::create($data_ibu);

        return redirect()->to('ibu')->with('success', 'Data ibu berhasil disimpan.');
    }

    /**
     * Hitung usia berdasarkan tanggal lahir.
     */
    private function hitungUsia($tgl_lahir)
    {
        $tanggal_lahir = Carbon::createFromFormat('Y-m-d', $tgl_lahir);
        return $tanggal_lahir->diffInYears(Carbon::now());
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data_ibu = ibu::where('nik_ibu', $id)->first();
        return view('ibu.edit')->with('data_ibu', $data_ibu);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama_ibu' => 'required|string|max:255',
            'tgl_ibu' => 'required|date',
            'usia' => 'numeric',
            'nama_suami' => 'nullable',
            'alamat' => 'required',
        ]);

        $data_ibu = [
            'nama_ibu' => $request->nama_ibu,
            'tgl_ibu' => $request->tgl_ibu,
            'usia' => $this->hitungUsia($request->tgl_ibu), // Menggunakan metode hitungUsia
            'nama_suami' => $request->nama_suami,
            'alamat' => $request->alamat,
        ];

        ibu::where('nik_ibu', $id)->update($data_ibu);

        return redirect()->to('ibu')->with('success', 'Data ibu berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        ibu::where('nik_ibu', $id)->delete();
        return redirect()->to('ibu')->with('success', 'Data ibu berhasil dihapus.');
    }
}
