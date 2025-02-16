<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tarif extends Model
{
    use HasFactory;

    protected $table = 'tarifs';
    
    protected $fillable = [
        'jenis_plg',
        'biaya_beban',
        'tarif_kwh'
    ];

    // Helper function untuk mendapatkan golongan tarif
    public static function getGolonganTarif($daya)
    {
        // Konversi daya ke integer untuk memastikan perbandingan yang benar
        $daya = (int) $daya;
        
        if ($daya <= 900) {
            return 'R1';  // Rumah Tangga 1 (≤ 900 VA)
        } elseif ($daya <= 2200) {
            return 'R2';  // Rumah Tangga 2 (> 900 VA - 2200 VA)
        } elseif ($daya <= 3500) {
            return 'R3';  // Rumah Tangga 3 (> 2200 VA - 3500 VA)
        } elseif ($daya <= 6600) {
            return 'B1';  // Bisnis 1 (≤ 6600 VA)
        } elseif ($daya <= 200000) {
            return 'B2';  // Bisnis 2 (> 6600 VA - 200 kVA)
        } else {
            return 'I3';  // Industri (> 200 kVA)
        }
    }

    // Accessor untuk menampilkan jenis berdasarkan daya
    public function getJenisAttribute()
    {
        return self::getGolonganTarif($this->jenis_plg);
    }

    // Relasi ke Pelanggan
    public function pelanggans()
    {
        return $this->hasMany(Pelanggan::class);
    }
}
