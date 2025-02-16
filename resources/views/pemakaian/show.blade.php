@extends('layouts.app')

@section('header', 'Detail Pemakaian Listrik')

@section('content')
<div class="max-w-2xl mx-auto">
    <!-- Info Pelanggan -->
    <div class="bg-white rounded-lg shadow-md p-6 mb-6">
        <h2 class="text-xl font-bold text-gray-800 mb-4">Informasi Pelanggan</h2>
        <div class="grid grid-cols-2 gap-4">
            <div>
                <p class="text-sm text-gray-600">No Kontrol</p>
                <p class="font-semibold">{{ $pemakaian->no_kontrol }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-600">Nama Pelanggan</p>
                <p class="font-semibold">{{ $pemakaian->pelanggan->nama }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-600">Alamat</p>
                <p class="font-semibold">{{ $pemakaian->pelanggan->alamat }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-600">Jenis Pelanggan</p>
                <p class="font-semibold">{{ $pemakaian->pelanggan->jenis_plg }}</p>
            </div>
        </div>
    </div>

    <!-- Info Pemakaian -->
    <div class="bg-white rounded-lg shadow-md p-6 mb-6">
        <h2 class="text-xl font-bold text-gray-800 mb-4">Detail Pemakaian</h2>
        <div class="grid grid-cols-2 gap-4">
            <div>
                <p class="text-sm text-gray-600">Periode</p>
                <p class="font-semibold">{{ date('F', mktime(0, 0, 0, $pemakaian->bulan, 1)) }} {{ $pemakaian->tahun }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-600">Status</p>
                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                    {{ $pemakaian->status_pembayaran === 'sudah_bayar' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                    {{ $pemakaian->status_pembayaran === 'sudah_bayar' ? 'Lunas' : 'Belum Lunas' }}
                </span>
            </div>
            <div>
                <p class="text-sm text-gray-600">Meter Awal</p>
                <p class="font-semibold">{{ number_format($pemakaian->meter_awal) }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-600">Meter Akhir</p>
                <p class="font-semibold">{{ number_format($pemakaian->meter_akhir) }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-600">Total Pemakaian</p>
                <p class="font-semibold">{{ number_format($pemakaian->jumlah_pakai) }} KWH</p>
            </div>
        </div>
    </div>

    <!-- Info Biaya -->
    <div class="bg-white rounded-lg shadow-md p-6 mb-6">
        <h2 class="text-xl font-bold text-gray-800 mb-4">Rincian Biaya</h2>
        <div class="space-y-2">
            <div class="flex justify-between">
                <span class="text-gray-600">Biaya Pemakaian</span>
                <span class="font-semibold">Rp {{ number_format($pemakaian->biaya_pemakaian, 0, ',', '.') }}</span>
            </div>
            <div class="flex justify-between">
                <span class="text-gray-600">Biaya Beban</span>
                <span class="font-semibold">Rp {{ number_format($pemakaian->biaya_beban_pemakai, 0, ',', '.') }}</span>
            </div>
            <div class="border-t pt-2 mt-2">
                <div class="flex justify-between">
                    <span class="font-bold">Total Tagihan</span>
                    <span class="font-bold">Rp {{ number_format($pemakaian->biaya_pemakaian + $pemakaian->biaya_beban_pemakai, 0, ',', '.') }}</span>
                </div>
            </div>
        </div>
    </div>

    <div class="flex justify-between">
        <a href="{{ route('pemakaian.index') }}" 
           class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
            Kembali
        </a>
        @if($pemakaian->status_pembayaran === 'belum_bayar')
            <button onclick="window.print()" 
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Cetak Tagihan
            </button>
        @endif
    </div>
</div>
@endsection 