<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\p_balita;
use Carbon\Carbon;
use Dompdf\Dompdf;
use Illuminate\Support\Facades\DB;

class PelaporanP_BalitaController extends Controller
{
    public function index(Request $request)
    {
        // Ambil parameter filter dari request
        $alamat = $request->input('alamat');
        $created_month = $request->input('created_month');

        // Query data pemeriksaan balita dengan kondisi filter
        $query = p_balita::query();

        if ($alamat && $alamat != '--Pilih Alamat--') {
            $query->where('alamat', $alamat);
        }

        if ($created_month) {
            $start_date = Carbon::parse($created_month)->startOfMonth();
            $end_date = Carbon::parse($created_month)->endOfMonth();
            $query->whereBetween('created_at', [$start_date, $end_date]);
        }

        $data_pemeriksaan_balita = $query->get();

        // Daftar alamat
        $desa_patrang = [
            '--Pilih Alamat--',
            'Blimbing',
            'Jenggawah',
            'Jepun',
            'Kalirejo',
            'Karangnongko',
            'Kemuning',
            'Kepel',
            'Kranji',
            'Kunir',
            'Mangli',
            'Mlandingan',
            'Patrang',
            'Plumbon',
            'Pucangsewu',
            'Rowobangun',
            'Sumberbendo',
            'Talun',
            'Tlogoagung',
            'Tlogomas',
            'Wuluhan',
        ];

        return view('pelaporan.pemeriksaan_balita', compact('data_pemeriksaan_balita', 'desa_patrang', 'alamat', 'created_month'));
    }

    public function generateBalitaPdf(Request $request)
    {
        // Ambil data yang sama seperti pada method index
        $alamat = $request->input('alamat');
        $created_month = $request->input('created_month');

        // Query data pemeriksaan balita dengan kondisi filter
        $query = p_balita::query();

        if ($alamat && $alamat != '--Pilih Alamat--') {
            $query->where('alamat', $alamat);
        }

        if ($created_month) {
            $start_date = Carbon::parse($created_month)->startOfMonth();
            $end_date = Carbon::parse($created_month)->endOfMonth();
            $query->whereBetween('created_at', [$start_date, $end_date]);
        }

        $data_pemeriksaan_balita = $query->get();

        // Load view into DomPDF
        $html = view('pelaporan.pemeriksaan_balita_pdf', compact('data_pemeriksaan_balita'))->render();

        // Initialize DomPDF
        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'Landscape');
        $dompdf->render();

        // Output the generated PDF to Browser
        return $dompdf->stream('laporan-pemeriksaan-balita.pdf');
    }
}
