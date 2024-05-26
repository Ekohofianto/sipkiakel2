<?php

namespace App\Http\Controllers;

use App\Models\Balita;
use App\Models\Ibu;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class BalitaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $data_balita = Balita::orderBy('nik_balita', 'desc')->get();

        return view('balita.balita')->with('data_balita', $data_balita);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Ambil data ibu untuk dropdown
        $data_ibu = Ibu::all();

        return view('balita.create', ['data_ibu' => $data_ibu]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Session::flash('nik_balita', $request->nik_balita);
        Session::flash('nama_balita', $request->nama_balita);
        Session::flash('tgl_balita', $request->tgl_balita);
        Session::flash('usia', $request->usia);
        Session::flash('jenis_kelamin', $request->jenis_kelamin);
        Session::flash('nik_ibu', $request->nik_ibu);
        Session::flash('nama_ibu', $request->nama_ibu);
        Session::flash('alamat', $request->alamat);

        $request->validate([
            'nik_balita' => 'required|numeric|digits:16|unique:dt_balita,nik_balita',
            'nama_balita' => 'required|string|max:255',
            'tgl_balita' => 'required|date',
            'usia' => 'numeric',
            'jenis_kelamin' => 'required',
            'nik_ibu' => 'required|numeric|digits_between:1,16',
            'nama_ibu' => 'required',
            'alamat' => 'required',
        ]);

        $data_balita = [
            'nik_balita' => $request->nik_balita,
            'nama_balita' => $request->nama_balita,
            'tgl_balita' => $request->tgl_balita,
            'usia' => $this->hitungUsia($request->tgl_balita), // Menggunakan metode hitungUsia
            'jenis_kelamin' => $request->jenis_kelamin,
            'nik_ibu' => $request->nik_ibu,
            'nama_ibu' => $request->nama_ibu,
            'alamat' => $request->alamat,
        ];

        Balita::create($data_balita);

        return redirect()->to('balita')->with('success', 'Data Balita berhasil disimpan.');
    }

    /**
     * Hitung usia berdasarkan tanggal lahir.
     */
    private function hitungUsia($tgl_lahir)
    {
        $tanggal_lahir = Carbon::createFromFormat('Y-m-d', $tgl_lahir);
        return $tanggal_lahir->diffInWeeks(Carbon::now());
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        // Ambil data balita yang akan diedit
        $data_balita = Balita::where('nik_balita', $id)->first();

        // Ambil data ibu untuk dropdown
        $data_ibu = Ibu::all();

        return view('balita.edit', compact('data_balita', 'data_ibu'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_balita' => 'required|string|max:255',
            'tgl_balita' => 'required|date',
            'usia' => 'numeric',
            'jenis_kelamin' => 'required',
            'nik_ibu' => 'nullable',
            'nama_ibu' => 'required',
            'alamat' => 'required',
        ]);

        $data_balita = [
            'nama_balita' => $request->nama_balita,
            'tgl_balita' => $request->tgl_balita,
            'usia' => $this->hitungUsia($request->tgl_balita), // Menggunakan metode hitungUsia
            'jenis_kelamin' => $request->jenis_kelamin,
            'nik_ibu' => $request->nik_ibu,
            'nama_ibu' => $request->nama_ibu,
            'alamat' => $request->alamat,
        ];

        Balita::where('nik_balita', $id)->update($data_balita);

        return redirect()->to('balita')->with('success', 'Data balita berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Balita::where('nik_balita', $id)->delete();
        return redirect()->to('balita')->with('success', 'Data balita berhasil dihapus.');
    }
}
