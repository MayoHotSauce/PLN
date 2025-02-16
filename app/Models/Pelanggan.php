<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    use HasFactory;

    protected $primaryKey = 'no_kontrol';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'no_kontrol',
        'nama',
        'alamat',
        'telepon',
        'tarif_id'
    ];

    public function pemakaians()
    {
        return $this->hasMany(Pemakaian::class, 'no_kontrol', 'no_kontrol');
    }

    public static function generateNoKontrol()
    {
        $lastPelanggan = self::orderBy('no_kontrol', 'desc')->first();
        
        if (!$lastPelanggan) {
            return 'PLN001';
        }

        $lastNumber = (int) substr($lastPelanggan->no_kontrol, 3);
        $newNumber = $lastNumber + 1;
        
        return 'PLN' . str_pad($newNumber, 3, '0', STR_PAD_LEFT);
    }

    // Relasi ke Tarif
    public function tarif()
    {
        return $this->belongsTo(Tarif::class);
    }

    // Accessor untuk mendapatkan jenis dari tarif
    public function getJenisAttribute()
    {
        return $this->tarif ? $this->tarif->jenis : null;
    }
}
