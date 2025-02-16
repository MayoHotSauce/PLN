@extends('layouts.app')

@section('header', 'Edit Pelanggan')

@section('content')
<form action="{{ route('pelanggan.update', $pelanggan->no_kontrol) }}" method="POST" class="max-w-2xl">
    @csrf
    @method('PUT')
    
    <div class="mb-4">
        <label for="no_kontrol" class="block text-gray-700 text-sm font-bold mb-2">No Kontrol</label>
        <input type="text" 
               name="no_kontrol" 
               id="no_kontrol" 
               class="bg-gray-100 shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
               value="{{ $pelanggan->no_kontrol }}"
               readonly>
    </div>

    <div class="mb-4">
        <label for="nama" class="block text-gray-700 text-sm font-bold mb-2">Nama</label>
        <input type="text" 
               name="nama" 
               id="nama" 
               class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('nama') border-red-500 @enderror"
               value="{{ old('nama', $pelanggan->nama) }}"
               required>
        @error('nama')
            <p class="text-red-500 text-xs italic">{{ $message }}</p>
        @enderror
    </div>

    <div class="mb-4">
        <label for="alamat" class="block text-gray-700 text-sm font-bold mb-2">Alamat</label>
        <textarea name="alamat" 
                  id="alamat" 
                  class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('alamat') border-red-500 @enderror"
                  required>{{ old('alamat', $pelanggan->alamat) }}</textarea>
        @error('alamat')
            <p class="text-red-500 text-xs italic">{{ $message }}</p>
        @enderror
    </div>

    <div class="mb-4">
        <label for="telepon" class="block text-gray-700 text-sm font-bold mb-2">Telepon</label>
        <input type="text" 
               name="telepon" 
               id="telepon" 
               class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('telepon') border-red-500 @enderror"
               value="{{ old('telepon', $pelanggan->telepon) }}"
               required>
        @error('telepon')
            <p class="text-red-500 text-xs italic">{{ $message }}</p>
        @enderror
    </div>

    <div class="mb-4">
        <label for="jenis_plg" class="block text-gray-700 text-sm font-bold mb-2">Jenis Pelanggan</label>
        <select name="jenis_plg" 
                id="jenis_plg" 
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('jenis_plg') border-red-500 @enderror"
                required>
            <option value="R1" {{ old('jenis_plg', $pelanggan->jenis_plg) == 'R1' ? 'selected' : '' }}>R1 - Rumah Tangga</option>
            <option value="R2" {{ old('jenis_plg', $pelanggan->jenis_plg) == 'R2' ? 'selected' : '' }}>R2 - Rumah Tangga Menengah</option>
            <option value="B1" {{ old('jenis_plg', $pelanggan->jenis_plg) == 'B1' ? 'selected' : '' }}>B1 - Bisnis</option>
            <option value="I1" {{ old('jenis_plg', $pelanggan->jenis_plg) == 'I1' ? 'selected' : '' }}>I1 - Industri</option>
        </select>
        @error('jenis_plg')
            <p class="text-red-500 text-xs italic">{{ $message }}</p>
        @enderror
    </div>

    <div class="flex items-center justify-between">
        <button type="submit" 
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
            Update
        </button>
        <a href="{{ route('pelanggan.index') }}" 
           class="text-gray-600 hover:text-gray-800">
            Batal
        </a>
    </div>
</form>
@endsection 