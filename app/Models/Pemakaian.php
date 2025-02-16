<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemakaian extends Model
{
    use HasFactory;

    const STATUS_LUNAS = 'lunas';
    const STATUS_BELUM_LUNAS = 'belum_lunas';

    protected $table = 'pemakaians';
    
    protected $fillable = [
        'tahun',
        'bulan',
        'no_kontrol',
        'meter_awal',
        'meter_akhir',
        'jumlah_pakai',
        'biaya_beban',
        'biaya_pemakaian',
        'total_bayar',
        'status_pembayaran',
        'tanggal_bayar'
    ];

    protected $dates = ['tanggal_bayar'];

    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class, 'no_kontrol', 'no_kontrol');
    }
}
