@extends('layouts.app')

@section('header', 'Dashboard')

@section('content')
<div class="fade-in p-6">
    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
        <!-- Total Pelanggan -->
        <div class="bg-blue-600 rounded-xl p-6 text-white">
            <div class="flex justify-between items-center">
                <div>
                    <h3 class="text-lg font-medium mb-2">Total Pelanggan</h3>
                    <p class="text-3xl font-bold">{{ $totalPelanggan }}</p>
                    <p class="text-sm mt-2">
                        <span class="text-blue-200">↗ Bertambah {{ $pelangganBaru }} bulan ini</span>
                    </p>
                </div>
                <div class="text-blue-200">
                    <i class="fas fa-users text-3xl"></i>
                </div>
            </div>
        </div>

        <!-- Tagihan Bulan Ini -->
        <div class="bg-emerald-600 rounded-xl p-6 text-white">
            <div class="flex justify-between items-center">
                <div>
                    <h3 class="text-lg font-medium mb-2">Tagihan Bulan Ini</h3>
                    <p class="text-3xl font-bold">{{ $totalTagihan }}</p>
                    <p class="text-sm mt-2">
                        <span class="text-emerald-200">{{ $tagihanDibayar }} tagihan telah dibayar</span>
                    </p>
                </div>
                <div class="text-emerald-200">
                    <i class="fas fa-file-invoice text-3xl"></i>
                </div>
            </div>
        </div>

        <!-- Total Pendapatan -->
        <div class="bg-amber-600 rounded-xl p-6 text-white">
            <div class="flex justify-between items-center">
                <div>
                    <h3 class="text-lg font-medium mb-2">Total Pendapatan</h3>
                    <p class="text-3xl font-bold">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</p>
                    <p class="text-sm mt-2">
                        <span class="text-amber-200">↗ {{ $persentasePendapatan }}% dari bulan lalu</span>
                    </p>
                </div>
                <div class="text-amber-200">
                    <i class="fas fa-money-bill-wave text-3xl"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Pembayaran Terbaru Table -->
    <div class="bg-gray-800/50 rounded-xl shadow-sm">
        <div class="p-6">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-semibold text-white">Pembayaran Terbaru</h2>
                <a href="{{ route('pemakaian.index') }}" class="text-blue-400 hover:text-blue-300">Lihat Semua</a>
            </div>
            
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="text-left text-gray-400 text-sm">
                            <th class="pb-4">NO KONTROL</th>
                            <th class="pb-4">NAMA PELANGGAN</th>
                            <th class="pb-4">PERIODE</th>
                            <th class="pb-4">TOTAL BAYAR</th>
                            <th class="pb-4">STATUS</th>
                        </tr>
                    </thead>
                    <tbody class="text-white">
                        @foreach($pembayaranTerbaru as $pembayaran)
                        <tr class="border-t border-gray-700">
                            <td class="py-4">{{ $pembayaran->no_kontrol }}</td>
                            <td>{{ $pembayaran->pelanggan->nama }}</td>
                            <td>{{ date('F Y', mktime(0, 0, 0, $pembayaran->bulan, 1, $pembayaran->tahun)) }}</td>
                            <td>Rp {{ number_format($pembayaran->total_bayar, 0, ',', '.') }}</td>
                            <td>
                                <span class="px-3 py-1 rounded-full text-xs 
                                    {{ $pembayaran->status_pembayaran === 'lunas' ? 'bg-green-500/20 text-green-500' : 'bg-red-500/20 text-red-500' }}">
                                    {{ ucfirst($pembayaran->status_pembayaran) }}
                                </span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
