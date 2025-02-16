@extends('layouts.app')

@section('content')
<div class="fade-in p-6">
    <div class="max-w-2xl mx-auto">
        <div class="bg-gray-800/50 rounded-xl shadow-sm p-6">
            <h2 class="text-xl font-semibold text-white mb-6">Edit Pelanggan</h2>
            
            <form action="{{ route('pelanggan.update', $pelanggan->id) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')
                
                <div>
                    <label class="block text-sm font-medium text-gray-400 mb-2">
                        No Kontrol
                    </label>
                    <input type="text" 
                           name="no_kontrol" 
                           value="{{ old('no_kontrol', $pelanggan->no_kontrol) }}"
                           class="w-full bg-gray-700 border-0 rounded-lg text-white px-4 py-2.5 focus:ring-2 focus:ring-blue-500"
                           required>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-400 mb-2">
                        Nama
                    </label>
                    <input type="text" 
                           name="nama" 
                           value="{{ old('nama', $pelanggan->nama) }}"
                           class="w-full bg-gray-700 border-0 rounded-lg text-white px-4 py-2.5 focus:ring-2 focus:ring-blue-500"
                           required>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-400 mb-2">
                        Tarif
                    </label>
                    <select name="tarif_id" 
                            class="w-full bg-gray-700 border-0 rounded-lg text-white px-4 py-2.5 focus:ring-2 focus:ring-blue-500"
                            required>
                        @foreach($tarifs as $tarif)
                            <option value="{{ $tarif->id }}" 
                                {{ old('tarif_id', $pelanggan->tarif_id) == $tarif->id ? 'selected' : '' }}>
                                {{ $tarif->daya }} VA - Rp {{ number_format($tarif->tarif_per_kwh) }}/KWH
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-400 mb-2">
                        Alamat
                    </label>
                    <textarea name="alamat" 
                              rows="3"
                              class="w-full bg-gray-700 border-0 rounded-lg text-white px-4 py-2.5 focus:ring-2 focus:ring-blue-500"
                              required>{{ old('alamat', $pelanggan->alamat) }}</textarea>
                </div>

                <div class="flex items-center space-x-3">
                    <button type="submit" 
                            class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-all duration-200">
                        Simpan Perubahan
                    </button>
                    <a href="{{ route('pelanggan.index') }}" 
                       class="px-4 py-2 text-gray-400 hover:text-gray-300 transition-colors">
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection 