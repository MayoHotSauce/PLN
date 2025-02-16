@extends('layouts.guest')

@section('content')
<div class="min-h-screen flex items-center justify-center p-6">
    <div class="w-full max-w-md fade-in">
        <!-- Header -->
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-white mb-2">Cek Tagihan Listrik</h1>
            <p class="text-gray-400">Masukkan nomor kontrol untuk melihat tagihan Anda</p>
        </div>

        <!-- Search Form -->
        <div class="bg-gray-800/50 rounded-2xl p-6 shadow-lg mb-6">
            <form action="{{ route('cek-tagihan.search') }}" method="GET" class="space-y-4">
                <div>
                    <label for="no_kontrol" class="block text-sm font-medium text-gray-400 mb-2">
                        Nomor Kontrol
                    </label>
                    <input type="text" 
                           id="no_kontrol" 
                           name="no_kontrol" 
                           value="{{ request('no_kontrol') }}"
                           class="w-full bg-gray-700 border-0 rounded-lg text-white px-4 py-3 focus:ring-2 focus:ring-blue-500"
                           placeholder="Masukkan nomor kontrol Anda"
                           required>
                </div>
                <button type="submit" 
                        class="w-full bg-blue-600 text-white rounded-lg px-4 py-3 hover:bg-blue-700 transition-colors duration-200">
                    Cek Tagihan
                </button>
            </form>
        </div>

        <!-- Result Section -->
        @if(isset($pemakaian) && $pemakaian && $pemakaian->pelanggan)
            <div class="bg-gray-800/50 rounded-2xl p-6 shadow-lg slide-in">
                <div class="space-y-6">
                    <!-- Customer Info -->
                    <div>
                        <h3 class="text-lg font-semibold text-white mb-4">Informasi Pelanggan</h3>
                        <div class="grid grid-cols-2 gap-4 text-sm">
                            <div class="text-gray-400">Nama</div>
                            <div class="text-white">{{ $pemakaian->pelanggan->nama }}</div>
                            <div class="text-gray-400">No Kontrol</div>
                            <div class="text-white">{{ $pemakaian->no_kontrol }}</div>
                        </div>
                    </div>

                    <!-- Usage Info -->
                    <div>
                        <h3 class="text-lg font-semibold text-white mb-4">Detail Pemakaian</h3>
                        <div class="grid grid-cols-2 gap-4 text-sm">
                            <div class="text-gray-400">Periode</div>
                            <div class="text-white">{{ date('F Y', mktime(0, 0, 0, $pemakaian->bulan, 1, $pemakaian->tahun)) }}</div>
                            <div class="text-gray-400">Meter Awal</div>
                            <div class="text-white">{{ number_format($pemakaian->meter_awal) }}</div>
                            <div class="text-gray-400">Meter Akhir</div>
                            <div class="text-white">{{ number_format($pemakaian->meter_akhir) }}</div>
                            <div class="text-gray-400">Pemakaian</div>
                            <div class="text-white">{{ number_format($pemakaian->jumlah_pakai) }} KWH</div>
                        </div>
                    </div>

                    <!-- Payment Info -->
                    <div>
                        <h3 class="text-lg font-semibold text-white mb-4">Informasi Tagihan</h3>
                        <div class="grid grid-cols-2 gap-4 text-sm">
                            <div class="text-gray-400">Total Tagihan</div>
                            <div class="text-white font-semibold">Rp {{ number_format($pemakaian->total_bayar) }}</div>
                            <div class="text-gray-400">Status</div>
                            <div>
                                @if($pemakaian->status_pembayaran === 'lunas')
                                    <span class="px-3 py-1 text-xs rounded-full inline-flex items-center bg-green-500/20 text-green-400">
                                        <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                        </svg>
                                        Lunas
                                    </span>
                                @else
                                    <span class="px-3 py-1 text-xs rounded-full inline-flex items-center bg-red-500/20 text-red-400">
                                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                        Belum Lunas
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @elseif(request('no_kontrol'))
            <div class="bg-red-500/10 border border-red-500/20 rounded-xl p-4 text-center slide-in">
                <p class="text-red-400">
                    Nomor kontrol tidak ditemukan atau belum memiliki tagihan
                </p>
            </div>
        @endif
    </div>
</div>
@endsection 