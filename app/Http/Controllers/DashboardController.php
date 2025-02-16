<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use App\Models\Pemakaian;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $now = Carbon::now();
        $lastMonth = Carbon::now()->subMonth();

        // Stats
        $totalPelanggan = Pelanggan::count();
        $pelangganBaru = Pelanggan::whereMonth('created_at', $now->month)
            ->whereYear('created_at', $now->year)
            ->count();

        $totalTagihan = Pemakaian::whereMonth('created_at', $now->month)
            ->whereYear('created_at', $now->year)
            ->count();
        
        $tagihanLunas = Pemakaian::whereMonth('created_at', $now->month)
            ->whereYear('created_at', $now->year)
            ->where('status_pembayaran', 'sudah_bayar')
            ->count();

        // Pendapatan (menggunakan biaya_pemakaian + biaya_beban)
        $totalPendapatan = Pemakaian::whereMonth('created_at', $now->month)
            ->whereYear('created_at', $now->year)
            ->where('status_pembayaran', 'sudah_bayar')
            ->sum(DB::raw('biaya_pemakaian + biaya_beban'));

        $pendapatanBulanLalu = Pemakaian::whereMonth('created_at', $lastMonth->month)
            ->whereYear('created_at', $lastMonth->year)
            ->where('status_pembayaran', 'sudah_bayar')
            ->sum(DB::raw('biaya_pemakaian + biaya_beban'));

        $persentasePendapatan = $pendapatanBulanLalu > 0 
            ? (($totalPendapatan - $pendapatanBulanLalu) / $pendapatanBulanLalu) * 100 
            : 0;

        // Recent payments
        $pembayaranTerbaru = Pemakaian::with('pelanggan')
            ->latest()
            ->take(5)
            ->get();

        return view('dashboard', compact(
            'totalPelanggan',
            'pelangganBaru',
            'totalTagihan',
            'tagihanLunas',
            'totalPendapatan',
            'persentasePendapatan',
            'pembayaranTerbaru'
        ));
    }
} 