<?php

namespace App\Http\Controllers;

use App\Models\Tarif;
use Illuminate\Http\Request;

class TarifController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tarifs = Tarif::latest()->get();
        return view('tarif.index', compact('tarifs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tarif.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'daya' => 'required|numeric|min:0',
            'tarif_per_kwh' => 'required|numeric|min:0',
            'beban' => 'required|numeric|min:0',
        ]);

        try {
            // Konversi nama field sesuai database
            Tarif::create([
                'jenis_plg' => $validated['daya'],         // daya disimpan sebagai jenis_plg
                'tarif_kwh' => $validated['tarif_per_kwh'], // tarif_per_kwh disimpan sebagai tarif_kwh
                'biaya_beban' => $validated['beban']       // beban disimpan sebagai biaya_beban
            ]);

            return redirect()
                ->route('tarif.index')
                ->with('success', 'Tarif berhasil ditambahkan');
        } catch (\Exception $e) {
            return back()
                ->withInput()
                ->with('error', 'Gagal menyimpan tarif. Silakan coba lagi. Error: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tarif $tarif)
    {
        return view('tarif.edit', compact('tarif'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tarif $tarif)
    {
        $request->validate([
            'jenis_plg' => 'required',
            'biaya_beban' => 'required|numeric',
            'tarif_kwh' => 'required|numeric'
        ]);

        $tarif->update($request->all());
        return redirect()->route('tarif.index')
            ->with('success', 'Tarif berhasil diupdate.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tarif $tarif)
    {
        $tarif->delete();
        return redirect()->route('tarif.index')
            ->with('success', 'Tarif berhasil dihapus.');
    }
}
