<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    use HasFactory;

    protected $table = 'pelanggans';
    protected $primaryKey = 'no_kontrol';
    protected $keyType = 'string';
    public $incrementing = false;
    
    protected $fillable = [
        'no_kontrol',
        'nama',
        'alamat',
        'telepon',
        'jenis_plg'
    ];

    public function pemakaians()
    {
        return $this->hasMany(Pemakaian::class, 'no_kontrol', 'no_kontrol');
    }
}
