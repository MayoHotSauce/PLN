@extends('layouts.app')

@section('header', 'Edit Tarif')

@section('content')
<div class="fade-in p-6">
    <div class="max-w-2xl mx-auto">
        <div class="bg-gray-800/50 rounded-xl shadow-sm p-6">
            <h2 class="text-xl font-semibold text-white mb-6">Edit Tarif</h2>
            
            <form action="{{ route('tarif.update', $tarif->id) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')
                
                <div>
                    <label class="block text-sm font-medium text-gray-400 mb-2">
                        Daya (VA)
                    </label>
                    <input type="number" 
                           name="daya" 
                           value="{{ old('daya', $tarif->daya) }}"
                           class="w-full bg-gray-700 border-0 rounded-lg text-white px-4 py-2.5 focus:ring-2 focus:ring-blue-500"
                           required>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-400 mb-2">
                        Tarif per KWH
                    </label>
                    <input type="number" 
                           name="tarif_per_kwh" 
                           value="{{ old('tarif_per_kwh', $tarif->tarif_per_kwh) }}"
                           class="w-full bg-gray-700 border-0 rounded-lg text-white px-4 py-2.5 focus:ring-2 focus:ring-blue-500"
                           required>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-400 mb-2">
                        Beban
                    </label>
                    <input type="number" 
                           name="beban" 
                           value="{{ old('beban', $tarif->beban) }}"
                           class="w-full bg-gray-700 border-0 rounded-lg text-white px-4 py-2.5 focus:ring-2 focus:ring-blue-500"
                           required>
                </div>

                <div class="flex items-center space-x-3">
                    <button type="submit" 
                            class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-all duration-200">
                        Simpan Perubahan
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