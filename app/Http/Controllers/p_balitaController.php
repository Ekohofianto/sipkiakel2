<?php

namespace App\Http\Controllers;

use App\Models\p_balita;
use App\Models\balita;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class p_balitaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Ambil semua data pemeriksaan balita tanpa melakukan pencarian
        $data_p_balita = p_balita::orderBy('id_p_balita', 'desc')->get();

        return view('p_balita.p_balita')->with('data_p_balita', $data_p_balita);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Ambil data balita untuk dropdown
        $data_balita = balita::all();

        return view('p_balita.create', ['data_balita' => $data_balita]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Set nilai id_pemeriksaan secara manual
        $tanggal_waktu = Carbon::now();
        $id_pemeriksaan = $tanggal_waktu->format('YmdHis'); // Format: YmdHis (tahun, bulan, hari, jam, menit, detik)

        Session::flash('nik_balita', $request->nik_balita);
        Session::flash('nama_balita', $request->nama_balita);
        Session::flash('berat_badan', $request->berat_badan);
        Session::flash('panjang_badan', $request->panjang_badan);
        Session::flash('lingkar_kepala', $request->lingkar_kepala);
        Session::flash('lingkar_lengan', $request->lingkar_lengan);
        Session::flash('jenis_imunisasi', $request->jenis_imunisasi);
        Session::flash('alamat', $request->alamat);

        $request->validate([
            'nik_balita' => 'required|numeric|digits_between:1,16',
            'nama_balita' => 'required|string|max:255',
            'berat_badan' => 'required|numeric',
            'panjang_badan' => 'required|numeric',
            'lingkar_kepala' => 'required|numeric',
            'lingkar_lengan' => 'required|numeric',
            'jenis_imunisasi' => 'required|not_in:--Pilih Imunisasi--',
            'alamat' => 'nullable',
        ]);

        $data_p_balita = [
            'id_p_balita' => $id_pemeriksaan,
            'nik_balita' => $request->nik_balita,
            'nama_balita' => $request->nama_balita,
            'berat_badan' => $request->berat_badan,
            'panjang_badan' => $request->panjang_badan,
            'lingkar_kepala' => $request->lingkar_kepala,
            'lingkar_lengan' => $request->lingkar_lengan,
            'jenis_imunisasi' => $request->jenis_imunisasi,
            'alamat' => $request->alamat,
        ];

        p_balita::create($data_p_balita);

        return redirect()->to('p_balita')->with('success', 'Data Pemeriksaan Balita berhasil disimpan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Ambil data pemeriksaan balita berdasarkan ID
        $p_balita = p_balita::where('id_p_balita', $id)->first();

        // Jika pemeriksaan balita ditemukan
        if ($p_balita) {
            // Ambil data balita berdasarkan NIK balita
            $balita = balita::where('nik_balita', $p_balita->nik_balita)->first();

            // Jika balita ditemukan
            if ($balita) {
                // Anda dapat mengakses atribut-atribut balita seperti ini:
                $nama_balita = $balita->nama_balita;
            } else {
                // Jika balita tidak ditemukan
                $nama_balita = 'Balita tidak ditemukan';
            }

            // Kembalikan view dengan data pemeriksaan balita dan data balita
            return view('p_balita.detail', compact('p_balita', 'nama_balita'));
        } else {
            // Jika pemeriksaan balita tidak ditemukan, redirect dengan pesan error
            return redirect()->to('p_balita')->with('error', 'Pemeriksaan Balita tidak ditemukan.');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Ambil data pemeriksaan balita yang akan diedit
        $data_p_balita = p_balita::where('id_p_balita', $id)->first();

        // Ambil data balita untuk dropdown
        $data_balita = balita::all();

        return view('p_balita.edit', compact('data_p_balita', 'data_balita'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nik_balita' => 'required|numeric|digits_between:1,16',
            'nama_balita' => 'required|string|max:255',
            'berat_badan' => 'required|numeric',
            'panjang_badan' => 'required|numeric',
            'lingkar_kepala' => 'required|numeric',
            'lingkar_lengan' => 'required|numeric',
            'jenis_imunisasi' => 'required|not_in:--Pilih Imunisasi--',
            'alamat' => 'nullable',
        ]);

        $data_p_balita = [
            'nik_balita' => $request->nik_balita,
            'nama_balita' => $request->nama_balita,
            'berat_badan' => $request->berat_badan,
            'panjang_badan' => $request->panjang_badan,
            'lingkar_kepala' => $request->lingkar_kepala,
            'lingkar_lengan' => $request->lingkar_lengan,
            'jenis_imunisasi' => $request->jenis_imunisasi,
            'alamat' => $request->alamat,
        ];

        p_balita::where('id_p_balita', $id)->update($data_p_balita);

        return redirect()->to('p_balita')->with('success', 'Data Pemeriksaan Balita berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        p_balita::where('id_p_balita', $id)->delete();
        return redirect()->to('p_balita')->with('success', 'Data Pemeriksaan Balita berhasil dihapus.');
    }
}
