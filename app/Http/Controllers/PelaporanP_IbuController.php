<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\p_ibu;
use Carbon\Carbon;
use Dompdf\Dompdf;
use Illuminate\Support\Facades\DB;

class PelaporanP_IbuController extends Controller
{
    public function index(Request $request)
    {
        // Ambil parameter filter dari request
        $alamat = $request->input('alamat');
        $usia_min = $request->input('usia_min');
        $usia_max = $request->input('usia_max');
        $created_month = $request->input('created_month');

        // Query data pemeriksaan ibu dengan kondisi filter
        $query = p_ibu::query();

        if ($alamat && $alamat != '--Pilih Alamat--') {
            $query->where('alamat', $alamat);
        }

        if ($created_month) {
            $start_date = Carbon::parse($created_month)->startOfMonth();
            $end_date = Carbon::parse($created_month)->endOfMonth();
            $query->whereBetween('created_at', [$start_date, $end_date]);
        }

        $data_pemeriksaan_ibu = $query->get();

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

        return view('pelaporan.pemeriksaan_ibu', compact('data_pemeriksaan_ibu', 'desa_patrang', 'alamat', 'usia_min', 'usia_max', 'created_month'));
    }

    public function generateIbuPdf(Request $request)
    {
        // Ambil data yang sama seperti pada method index
        $alamat = $request->input('alamat');
        $usia_min = $request->input('usia_min');
        $usia_max = $request->input('usia_max');
        $created_month = $request->input('created_month');

        // Query data pemeriksaan ibu dengan kondisi filter
        $query = p_ibu::query();

        if ($alamat && $alamat != '--Pilih Alamat--') {
            $query->where('alamat', $alamat);
        }

        if ($created_month) {
            $start_date = Carbon::parse($created_month)->startOfMonth();
            $end_date = Carbon::parse($created_month)->endOfMonth();
            $query->whereBetween('created_at', [$start_date, $end_date]);
        }

        $data_pemeriksaan_ibu = $query->get();

        // Load view into DomPDF
        $html = view('pelaporan.pemeriksaan_ibu_pdf', compact('data_pemeriksaan_ibu'))->render();

        // Initialize DomPDF
        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'Landscape');
        $dompdf->render();

        // Output the generated PDF to Browser
        return $dompdf->stream('laporan-pemeriksaan-ibu.pdf');
    }
}
