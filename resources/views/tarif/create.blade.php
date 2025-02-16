@extends('layouts.app')

@section('header', 'Tambah Tarif')

@section('content')
<div class="fade-in p-6">
    <div class="max-w-2xl mx-auto">
        @if(session('error'))
            <div class="mb-4 bg-red-500/10 border border-red-500/20 rounded-lg p-4">
                <p class="text-red-400">{{ session('error') }}</p>
            </div>
        @endif

        <div class="bg-gray-800/50 rounded-xl shadow-sm p-6">
            <h2 class="text-xl font-semibold text-white mb-6">Tambah Tarif Baru</h2>
            
            <form action="{{ route('tarif.store') }}" method="POST" class="space-y-6">
                @csrf
                
                <div>
                    <label class="block text-sm font-medium text-gray-400 mb-2">
                        Daya (VA)
                        <span class="text-xs text-gray-500 ml-1">
                            (Contoh: 450, 900, 1300, 2200, 3500, dst)
                        </span>
                    </label>
                    <input type="number" 
                           name="daya" 
                           value="{{ old('daya') }}"
                           class="w-full bg-gray-700 border-0 rounded-lg text-white px-4 py-2.5 focus:ring-2 focus:ring-blue-500"
                           placeholder="Masukkan besaran daya dalam VA"
                           required>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-400 mb-2">
                        Tarif per KWH
                        <span class="text-xs text-gray-500 ml-1">
                            (Biaya per Kilowatt Hour)
                        </span>
                    </label>
                    <input type="number" 
                           name="tarif_per_kwh" 
                           value="{{ old('tarif_per_kwh') }}"
                           class="w-full bg-gray-700 border-0 rounded-lg text-white px-4 py-2.5 focus:ring-2 focus:ring-blue-500"
                           placeholder="Masukkan tarif per KWH dalam Rupiah"
                           required>
                    <p class="mt-1 text-xs text-gray-500">
                        Contoh: 1.352 per KWH, masukkan: 1352
                    </p>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-400 mb-2">
                        Biaya Beban
                        <span class="text-xs text-gray-500 ml-1">
                            (Biaya admin/beban tetap per bulan)
                        </span>
                    </label>
                    <input type="number" 
                           name="beban" 
                           value="{{ old('beban') }}"
                           class="w-full bg-gray-700 border-0 rounded-lg text-white px-4 py-2.5 focus:ring-2 focus:ring-blue-500"
                           placeholder="Masukkan biaya beban dalam Rupiah"
                           required>
                    <p class="mt-1 text-xs text-gray-500">
                        Contoh: Rp 3.500, masukkan: 3500
                    </p>
                </div>

                <div class="flex items-center space-x-3 pt-2">
                    <button type="submit" 
                            class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-all duration-200">
                        Simpan Tarif
                    </button>
                    <a href="{{ route('tarif.index') }}" 
                       class="px-4 py-2 text-gray-400 hover:text-gray-300 transition-colors">
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection 