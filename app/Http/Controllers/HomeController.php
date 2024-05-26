<?php

namespace App\Http\Controllers;

use App\Models\balita;
use App\Models\User;
use App\Models\ibu;
use App\Models\p_balita;
use App\Models\p_ibu;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $users = User::count(); // Menghitung total pengguna
        $total_ibu = ibu::count(); // Menghitung total data ibu
        $total_balita = balita::count(); // Menghitung total data balita
        $total_p_ibu = p_ibu::count(); // Menghitung total data pemeriksaan_ibu
        $total_p_balita = p_balita::count(); // Menghitung total data pemeriksaan_balita

        $widget = [
            'users' => $users,
            'total_ibu' => $total_ibu,
            'total_balita' => $total_balita,
            'total_p_ibu' => $total_p_ibu,
            'total_p_balita' => $total_p_balita,
        ];

        // Group and count data by month
        $totalIbuMonthly = DB::table('dt_ibu')
            ->select(DB::raw('DATE_FORMAT(created_at, "%Y-%m") as month'), DB::raw('count(*) as total_ibu'))
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        $totalBalitaMonthly = DB::table('dt_balita')
            ->select(DB::raw('DATE_FORMAT(created_at, "%Y-%m") as month'), DB::raw('count(*) as total_balita'))
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        $totalPIbuMonthly = DB::table('dt_p_ibu')
            ->select(DB::raw('DATE_FORMAT(created_at, "%Y-%m") as month'), DB::raw('count(*) as total_p_ibu'))
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        $totalPBalitaMonthly = DB::table('dt_p_balita')
            ->select(DB::raw('DATE_FORMAT(created_at, "%Y-%m") as month'), DB::raw('count(*) as total_p_balita'))
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        return view('home', compact(
            'widget',
            'totalIbuMonthly',
            'totalBalitaMonthly',
            'totalPIbuMonthly',
            'totalPBalitaMonthly'
        ));
    }
}
