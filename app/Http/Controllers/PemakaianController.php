<?php

namespace App\Http\Controllers;

use App\Models\Pemakaian;
use App\Models\Pelanggan;
use App\Models\Tarif;
use Illuminate\Http\Request;

class PemakaianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pemakaians = Pemakaian::with('pelanggan')->latest()->paginate(10);
        return view('pemakaian.index', compact('pemakaians'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pelanggans = Pelanggan::all();
        return view('pemakaian.create', compact('pelanggans'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'tahun' => 'required|numeric',
            'bulan' => 'required|numeric|min:1|max:12',
            'no_kontrol' => 'required|exists:pelanggans,no_kontrol',
            'meter_awal' => 'required|numeric',
            'meter_akhir' => 'required|numeric|gt:meter_awal'
        ]);

        // Hitung jumlah pemakaian
        $jumlah_pakai = $request->meter_akhir - $request->meter_awal;

        // Ambil data pelanggan dan tarif
        $pelanggan = Pelanggan::find($request->no_kontrol);
        $tarif = Tarif::where('jenis_plg', $pelanggan->jenis_plg)->first();

        // Hitung biaya
        $biaya_pemakaian = $jumlah_pakai * $tarif->tarif_kwh;
        $biaya_beban_pemakai = $tarif->biaya_beban;

        // Buat array data pemakaian
        $data = $request->all();
        $data['jumlah_pakai'] = $jumlah_pakai;
        $data['biaya_pemakaian'] = $biaya_pemakaian;
        $data['biaya_beban_pemakai'] = $biaya_beban_pemakai;

        Pemakaian::create($data);
        return redirect()->route('pemakaian.index')
            ->with('success', 'Data pemakaian berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Pemakaian $pemakaian)
    {
        return view('pemakaian.show', compact('pemakaian'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pemakaian $pemakaian)
    {
        $pelanggans = Pelanggan::all();
        return view('pemakaian.edit', compact('pemakaian', 'pelanggans'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pemakaian $pemakaian)
    {
        $request->validate([
            'meter_awal' => 'required|numeric',
            'meter_akhir' => 'required|numeric|gt:meter_awal'
        ]);

        // Hitung ulang jumlah pemakaian dan biaya
        $jumlah_pakai = $request->meter_akhir - $request->meter_awal;
        
        $pelanggan = Pelanggan::find($pemakaian->no_kontrol);
        $tarif = Tarif::where('jenis_plg', $pelanggan->jenis_plg)->first();

        $biaya_pemakaian = $jumlah_pakai * $tarif->tarif_kwh;
        $biaya_beban_pemakai = $tarif->biaya_beban;

        $data = $request->all();
        $data['jumlah_pakai'] = $jumlah_pakai;
        $data['biaya_pemakaian'] = $biaya_pemakaian;
        $data['biaya_beban_pemakai'] = $biaya_beban_pemakai;

        $pemakaian->update($data);
        return redirect()->route('pemakaian.index')
            ->with('success', 'Data pemakaian berhasil diupdate.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pemakaian $pemakaian)
    {
        $pemakaian->delete();
        return redirect()->route('pemakaian.index')
            ->with('success', 'Data pemakaian berhasil dihapus.');
    }

    public function showCekTagihan()
    {
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
            return back()->with('error', 'Tidak ada tagihan yang belum dibayar untuk nomor kontrol ini.');
        }

        return view('welcome', compact('tagihan'));
    }
}
