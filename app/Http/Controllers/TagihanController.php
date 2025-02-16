<?php

namespace App\Http\Controllers;

use App\Models\Pemakaian;
use Illuminate\Http\Request;

class TagihanController extends Controller
{
    public function index()
    {
        return view('cek-tagihan');
    }

    public function search(Request $request)
    {
        $noKontrol = $request->input('no_kontrol');
        
        if ($noKontrol) {
            $pemakaian = Pemakaian::with(['pelanggan.tarif'])
                ->where('no_kontrol', $noKontrol)
                ->whereYear('created_at', now()->year)
                ->whereMonth('created_at', now()->month)
                ->first();
                
            return view('cek-tagihan', compact('pemakaian'));
        }
        
        return view('cek-tagihan');
    }

    public function cekTagihan(Request $request)
    {
        $request->validate([
            'no_kontrol' => 'required|exists:pelanggans,no_kontrol'
        ]);

        $tagihan = Pemakaian::with('pelanggan')
            ->where('no_kontrol', $request->no_kontrol)
            ->where('status_pembayaran', 'belum_bayar')
            ->latest()
            ->first();

        if (!$tagihan) {
            return back()->with('info', 'Tidak ada tagihan yang belum dibayar untuk nomor kontrol ini.');
        }

        return view('tagihan.detail', compact('tagihan'));
    }
} 