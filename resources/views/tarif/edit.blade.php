@extends('layouts.app')

@section('header', 'Edit Tarif')

@section('content')
<form action="{{ route('tarif.update', $tarif->id) }}" method="POST" class="max-w-2xl">
    @csrf
    @method('PUT')
    
    <div class="mb-4">
        <label for="jenis_plg" class="block text-gray-700 text-sm font-bold mb-2">Jenis Pelanggan</label>
        <select name="jenis_plg" 
                id="jenis_plg" 
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('jenis_plg') border-red-500 @enderror"
                required>
            <option value="R1" {{ old('jenis_plg', $tarif->jenis_plg) == 'R1' ? 'selected' : '' }}>R1 - Rumah Tangga</option>
            <option value="R2" {{ old('jenis_plg', $tarif->jenis_plg) == 'R2' ? 'selected' : '' }}>R2 - Rumah Tangga Menengah</option>
            <option value="B1" {{ old('jenis_plg', $tarif->jenis_plg) == 'B1' ? 'selected' : '' }}>B1 - Bisnis</option>
            <option value="I1" {{ old('jenis_plg', $tarif->jenis_plg) == 'I1' ? 'selected' : '' }}>I1 - Industri</option>
        </select>
        @error('jenis_plg')
            <p class="text-red-500 text-xs italic">{{ $message }}</p>
        @enderror
    </div>

    <div class="mb-4">
        <label for="biaya_beban" class="block text-gray-700 text-sm font-bold mb-2">Biaya Beban</label>
        <div class="flex">
            <span class="inline-flex items-center px-3 text-sm text-gray-900 bg-gray-200 border border-r-0 border-gray-300 rounded-l-md">
                Rp
            </span>
            <input type="number" 
                   name="biaya_beban" 
                   id="biaya_beban" 
                   class="shadow appearance-none border rounded-r-lg w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('biaya_beban') border-red-500 @enderror"
                   value="{{ old('biaya_beban', $tarif->biaya_beban) }}"
                   required>
        </div>
        @error('biaya_beban')
            <p class="text-red-500 text-xs italic">{{ $message }}</p>
        @enderror
    </div>

    <div class="mb-4">
        <label for="tarif_kwh" class="block text-gray-700 text-sm font-bold mb-2">Tarif per KWH</label>
        <div class="flex">
            <span class="inline-flex items-center px-3 text-sm text-gray-900 bg-gray-200 border border-r-0 border-gray-300 rounded-l-md">
                Rp
            </span>
            <input type="number" 
                   name="tarif_kwh" 
                   id="tarif_kwh" 
                   class="shadow appearance-none border rounded-r-lg w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('tarif_kwh') border-red-500 @enderror"
                   value="{{ old('tarif_kwh', $tarif->tarif_kwh) }}"
                   required>
        </div>
        @error('tarif_kwh')
            <p class="text-red-500 text-xs italic">{{ $message }}</p>
        @enderror
    </div>

    <div class="flex items-center justify-between">
        <button type="submit" 
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
            Update
        </button>
        <a href="{{ route('tarif.index') }}" 
           class="text-gray-600 hover:text-gray-800">
            Batal
        </a>
    </div>
</form>
@endsection 