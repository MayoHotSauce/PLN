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
        $totalPelanggan = Pelanggan::count();
        $pelangganBaru = Pelanggan::whereMonth('created_at', now()->month)->count();
        
        $bulanIni = now()->month;
        $tahunIni = now()->year;
        
        // Hitung total tagihan (semua pemakaian)
        $totalTagihan = Pemakaian::count();
        
        // Hitung tagihan yang sudah dibayar
        $tagihanDibayar = Pemakaian::where('status_pembayaran', 'lunas')
            ->count();
        
        // Hitung total pendapatan (semua pembayaran yang lunas)
        $totalPendapatan = Pemakaian::where('status_pembayaran', 'lunas')
            ->sum('total_bayar');
        
        // Hitung pendapatan bulan lalu
        $pendapatanBulanLalu = Pemakaian::where('status_pembayaran', 'lunas')
            ->where(function($query) {
                $bulanLalu = now()->subMonth();
                $query->where('bulan', $bulanLalu->month)
                      ->where('tahun', $bulanLalu->year);
            })
            ->sum('total_bayar');
        
        // Hitung persentase perubahan
        $persentasePendapatan = $pendapatanBulanLalu > 0 
            ? round(($totalPendapatan - $pendapatanBulanLalu) / $pendapatanBulanLalu * 100, 1)
            : 0;
        
        // Ambil 5 pembayaran terbaru
        $pembayaranTerbaru = Pemakaian::with('pelanggan')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();
        
        return view('dashboard', compact(
            'totalPelanggan',
            'pelangganBaru',
            'totalTagihan',
            'tagihanDibayar',
            'totalPendapatan',
            'persentasePendapatan',
            'pembayaranTerbaru'
        ));
    }
} 