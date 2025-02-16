<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemakaian extends Model
{
    use HasFactory;

    protected $table = 'pemakaians';
    
    protected $fillable = [
        'tahun',
        'bulan',
        'no_kontrol',
        'meter_awal',
        'meter_akhir',
        'jumlah_pakai',
        'biaya_beban_pemakai',
        'biaya_pemakaian',
        'status_pembayaran'
    ];

    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class, 'no_kontrol', 'no_kontrol');
    }
}
