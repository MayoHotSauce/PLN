<?php

namespace App\Http\Controllers;

use App\Models\Pemakaian;
use App\Models\Pelanggan;
use App\Models\Tarif;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PemakaianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tahun = request('tahun', date('Y'));
        $bulan = request('bulan');
        
        // Convert bulan dari nama ke angka jika diperlukan
        if ($bulan && !is_numeric($bulan)) {
            $bulan = date('n', strtotime("1 $bulan"));
        }
        
        $query = Pemakaian::with('pelanggan')
            ->where('tahun', $tahun);
        
        if ($bulan) {
            $query->where('bulan', (int)$bulan);
        }

        $pemakaians = $query
            ->orderBy('created_at', 'desc')
            ->paginate(10)
            ->withQueryString();

        // Debug
        \Log::info('Filter Query:', [
            'tahun' => $tahun,
            'bulan' => $bulan,
            'sql' => $query->toSql(),
            'bindings' => $query->getBindings()
        ]);

        return view('pemakaian.index', compact('pemakaians'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pelanggans = Pelanggan::all();
        $tahun = now()->year;
        $bulan = now()->month; // Menggunakan angka bulan (1-12)
        
        return view('pemakaian.create', compact('pelanggans', 'tahun', 'bulan'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'tahun' => 'required',
            'bulan' => 'required|numeric|between:1,12',
            'pelanggan_id' => 'required|exists:pelanggans,no_kontrol',
            'meter_awal' => 'required|numeric',
            'meter_akhir' => 'required|numeric|gt:meter_awal',
        ]);

        // Ambil data pelanggan beserta tarifnya
        $pelanggan = Pelanggan::with('tarif')->find($validated['pelanggan_id']);
        
        // Cek apakah pelanggan dan tarif ada
        if (!$pelanggan || !$pelanggan->tarif) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Data tarif pelanggan tidak ditemukan. Silakan set tarif pelanggan terlebih dahulu.');
        }

        // Hitung jumlah pemakaian
        $jumlah_pakai = $validated['meter_akhir'] - $validated['meter_awal'];

        // Hitung biaya pemakaian (hanya dari KWH)
        $biaya_pemakaian = $jumlah_pakai * $pelanggan->tarif->tarif_kwh;
        
        // Ambil biaya beban dari tarif
        $biaya_beban = $pelanggan->tarif->biaya_beban;

        // Hitung total bayar
        $total_bayar = $biaya_pemakaian + $biaya_beban;

        Pemakaian::create([
            'tahun' => $validated['tahun'],
            'bulan' => (int)$validated['bulan'],
            'no_kontrol' => $pelanggan->no_kontrol,
            'meter_awal' => $validated['meter_awal'],
            'meter_akhir' => $validated['meter_akhir'],
            'jumlah_pakai' => $jumlah_pakai,
            'biaya_pemakaian' => $biaya_pemakaian,
            'biaya_beban' => $biaya_beban,
            'total_bayar' => $total_bayar,
            'status_pembayaran' => 'belum_bayar'
        ]);

        return redirect()
            ->route('pemakaian.index')
            ->with('success', 'Data pemakaian berhasil ditambahkan');
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

    public function pay(Pemakaian $pemakaian)
    {
        if ($pemakaian->status_pembayaran === Pemakaian::STATUS_LUNAS) {
            return back()->with('error', 'Tagihan ini sudah lunas.');
        }

        DB::beginTransaction();
        try {
            $pemakaian->update([
                'status_pembayaran' => Pemakaian::STATUS_LUNAS,
                'tanggal_bayar' => now()
            ]);
            
            DB::commit();
            return back()->with('success', 'Pembayaran berhasil dikonfirmasi.');
        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('Payment Error: ' . $e->getMessage());
            return back()->with('error', 'Terjadi kesalahan saat memproses pembayaran.');
        }
    }
}
