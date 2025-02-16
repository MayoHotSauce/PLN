<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Detail Tagihan - {{ config('app.name', 'PLN') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">
    <div class="min-h-screen py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-3xl mx-auto">
            <!-- Header dengan Logo -->
            <div class="text-center mb-8">
                <a href="/" class="inline-flex items-center">
                    <img class="h-12 w-auto" src="{{ asset('images/logo.png') }}" alt="PLN Logo">
                    <span class="ml-3 text-2xl font-bold text-gray-900">PLN</span>
                </a>
            </div>

            <!-- Card Detail Tagihan -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                <!-- Header Card -->
                <div class="px-6 py-4 bg-blue-600">
                    <h2 class="text-xl font-semibold text-white">Detail Tagihan Listrik</h2>
                </div>

                <!-- Informasi Pelanggan -->
                <div class="p-6 border-b border-gray-200 bg-gray-50">
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <p class="text-sm text-gray-600">Nomor Kontrol</p>
                            <p class="text-lg font-semibold text-gray-900">{{ $tagihan->no_kontrol }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Nama Pelanggan</p>
                            <p class="text-lg font-semibold text-gray-900">{{ $tagihan->pelanggan->nama }}</p>
                        </div>
                    </div>
                </div>

                <!-- Detail Pemakaian -->
                <div class="p-6 space-y-6">
                    <!-- Periode dan Status -->
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <p class="text-sm text-gray-600">Periode Tagihan</p>
                            <p class="text-lg font-medium text-gray-900">
                                {{ date('F Y', mktime(0, 0, 0, $tagihan->bulan, 1, $tagihan->tahun)) }}
                            </p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Status Pembayaran</p>
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium {{ $tagihan->status_pembayaran === 'lunas' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                {{ ucfirst($tagihan->status_pembayaran) }}
                            </span>
                        </div>
                    </div>

                    <!-- Rincian Pemakaian -->
                    <div class="bg-gray-50 rounded-lg p-4">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Rincian Pemakaian</h3>
                        <div class="space-y-3">
                            <div class="flex justify-between">
                                <span class="text-gray-600">Meter Awal</span>
                                <span class="font-medium">{{ number_format($tagihan->meter_awal) }} kWh</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Meter Akhir</span>
                                <span class="font-medium">{{ number_format($tagihan->meter_akhir) }} kWh</span>
                            </div>
                            <div class="flex justify-between pt-2 border-t">
                                <span class="text-gray-600">Total Pemakaian</span>
                                <span class="font-medium">{{ number_format($tagihan->jumlah_pakai) }} kWh</span>
                            </div>
                        </div>
                    </div>

                    <!-- Total Tagihan -->
                    <div class="bg-blue-50 rounded-lg p-4">
                        <div class="flex justify-between items-center">
                            <span class="text-lg font-medium text-blue-900">Total Tagihan</span>
                            <span class="text-2xl font-bold text-blue-600">
                                Rp {{ number_format($tagihan->total_bayar, 0, ',', '.') }}
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Footer Card -->
                <div class="px-6 py-4 bg-gray-50 text-center">
                    <a href="/" class="inline-flex items-center justify-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Kembali ke Beranda
                    </a>
                </div>
            </div>

            <!-- Catatan -->
            <div class="mt-6 text-center text-sm text-gray-600">
                <p>Jika ada pertanyaan, silakan hubungi call center PLN di 123</p>
            </div>
        </div>
    </div>
</body>
</html> 