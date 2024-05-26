<?php

namespace App\Http\Controllers;

use App\Models\p_ibu;
use App\Models\ibu;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class p_ibuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Ambil semua data pemeriksaan ibu tanpa melakukan pencarian
        $data_p_ibu = p_ibu::orderBy('id_p_ibu', 'desc')->get();

        return view('p_ibu.p_ibu')->with('data_p_ibu', $data_p_ibu);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Ambil data ibu untuk dropdown
        $data_ibu = ibu::all();

        return view('p_ibu.create', ['data_ibu' => $data_ibu]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Set nilai id_pemeriksaan secara manual
        $tanggal_waktu = Carbon::now();
        $id_pemeriksaan = $tanggal_waktu->format('YmdHis'); // Format: YmdHis (tahun, bulan, hari, jam, menit, detik)
        Session::flash('nik_ibu', $request->nik_ibu);
        Session::flash('nama_ibu', $request->nama_ibu);
        Session::flash('berat_b', $request->berat_b);
        Session::flash('tinggi_b', $request->tinggi_b);
        Session::flash('tekanan_d', $request->tekanan_d);
        Session::flash('riwayat_p', $request->riwayat_p);
        Session::flash('usia_kehamilan', $request->usia_kehamilan);
        Session::flash('alamat', $request->alamat);


        $request->validate([
            'nik_ibu' => 'required|numeric|digits_between:1,16',
            'nama_ibu' => 'required|string|max:255',
            'berat_b' => 'required|numeric',
            'tinggi_b' => 'required|numeric',
            'tekanan_d' => 'required|string|max:255',
            'riwayat_p' => 'nullable',
            'usia_kehamilan' => 'nullable',
            'alamat' => 'nullable',
        ]);

        // Konversi usia kehamilan dari bulan menjadi minggu
        $usia_kehamilan = $request->usia_kehamilan * 4;

        $data_p_ibu = [
            'id_p_ibu' => $id_pemeriksaan,
            'nik_ibu' => $request->nik_ibu,
            'nama_ibu' => $request->nama_ibu,
            'berat_b' => $request->berat_b,
            'tinggi_b' => $request->tinggi_b,
            'tekanan_d' => $request->tekanan_d,
            'riwayat_p' => $request->riwayat_p,
            'usia_kehamilan' => $usia_kehamilan, // Simpan usia kehamilan dalam minggu
            'alamat' => $request->alamat,
        ];

        p_ibu::create($data_p_ibu);

        return redirect()->to('p_ibu')->with('success', 'Data Pemeriksaan Ibu berhasil disimpan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Ambil data balita berdasarkan NIK balita
        $p_ibu = p_ibu::where('id_p_ibu', $id)->first();

        // Jika balita ditemukan
        if ($p_ibu) {
            // Ambil data ibu berdasarkan NIK ibu balita
            $ibu = ibu::where('nik_ibu', $p_ibu->nik_ibu)->first();

            // Jika ibu ditemukan
            if ($ibu) {
                // Anda dapat mengakses atribut-atribut ibu seperti ini:
                $nama_ibu = $ibu->nama_ibu;
            } else {
                // Jika ibu tidak ditemukan
                $nama_ibu = 'Ibu tidak ditemukan';
            }

            // Kembalikan view dengan data balita dan data ibu
            return view('p_ibu.detail', compact('p_ibu', 'nama_ibu'));
        } else {
            // Jika balita tidak ditemukan, redirect dengan pesan error
            return redirect()->to('p_ibu')->with('error', 'Ibu tidak ditemukan.');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Ambil data pemeriksaan ibu yang akan diedit
        $data_p_ibu = p_ibu::where('id_p_ibu', $id)->first();

        // Ambil data ibu untuk dropdown
        $data_ibu = ibu::all();

        return view('p_ibu.edit', compact('data_p_ibu', 'data_ibu'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nik_ibu' => 'required|numeric|digits_between:1,16',
            'nama_ibu' => 'required|string|max:255',
            'berat_b' => 'required|numeric',
            'tinggi_b' => 'required|numeric',
            'tekanan_d' => 'required|string|max:255',
            'riwayat_p' => 'nullable',
            'usia_kehamilan' => 'nullable',
            'alamat' => 'nullable',
        ]);

        $data_p_ibu = [
            'nik_ibu' => $request->nik_ibu,
            'nama_ibu' => $request->nama_ibu,
            'berat_b' => $request->berat_b,
            'tinggi_b' => $request->tinggi_b,
            'tekanan_d' => $request->tekanan_d,
            'riwayat_p' => $request->riwayat_p,
            'usia_kehamilan' => $request->usia_kehamilan,
            'alamat' => $request->alamat,
        ];

        p_ibu::where('id_p_ibu', $id)->update($data_p_ibu);

        return redirect()->to('p_ibu')->with('success', 'Data Pemeriksaan Ibu berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        p_ibu::where('id_p_ibu', $id)->delete();
        return redirect()->to('p_ibu')->with('success', 'Data Pemeriksaan Ibu berhasil dihapus.');
    }
}
