<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use App\Models\Tarif;
use Illuminate\Http\Request;

class PelangganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pelanggans = Pelanggan::latest()->paginate(10);
        return view('pelanggan.index', compact('pelanggans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Generate nomor kontrol otomatis
        $lastPelanggan = Pelanggan::orderBy('no_kontrol', 'desc')->first();
        $lastNumber = $lastPelanggan ? intval(substr($lastPelanggan->no_kontrol, 3)) : 0;
        $noKontrol = 'PLN' . str_pad($lastNumber + 1, 3, '0', STR_PAD_LEFT);
        
        $tarifs = Tarif::all();
        return view('pelanggan.create', compact('tarifs', 'noKontrol'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required',
            'alamat' => 'required',
            'telepon' => 'required',
            'tarif_id' => 'required|exists:tarifs,id'
        ]);

        // Tambahkan no_kontrol ke data yang akan disimpan
        $validated['no_kontrol'] = $request->no_kontrol;

        Pelanggan::create($validated);

        return redirect()
            ->route('pelanggan.index')
            ->with('success', 'Pelanggan berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Pelanggan $pelanggan)
    {
        return view('pelanggan.show', compact('pelanggan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pelanggan $pelanggan)
    {
        $tarifs = Tarif::all();
        return view('pelanggan.edit', compact('pelanggan', 'tarifs'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pelanggan $pelanggan)
    {
        $request->validate([
            'nama' => 'required',
            'alamat' => 'required',
            'telepon' => 'required',
            'jenis_plg' => 'required'
        ]);

        $pelanggan->update($request->all());
        return redirect()->route('pelanggan.index')
            ->with('success', 'Pelanggan berhasil diupdate.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pelanggan $pelanggan)
    {
        $pelanggan->delete();
        return redirect()->route('pelanggan.index')
            ->with('success', 'Pelanggan berhasil dihapus.');
    }
}
