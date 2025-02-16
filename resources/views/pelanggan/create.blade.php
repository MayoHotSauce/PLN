@extends('layouts.app')

@section('header', 'Tambah Pelanggan')

@section('content')
<div class="fade-in p-6">
    <div class="max-w-2xl mx-auto">
        <div class="bg-gray-800/50 rounded-xl shadow-sm p-6">
            <h2 class="text-xl font-semibold text-white mb-6">Tambah Pelanggan Baru</h2>

            <form action="{{ route('pelanggan.store') }}" method="POST" class="space-y-6">
                @csrf

                <!-- No Kontrol (Read Only) -->
                <div>
                    <label class="block text-sm font-medium text-gray-400 mb-2">
                        No Kontrol
                    </label>
                    <input type="text"
                           name="no_kontrol"
                           value="{{ $noKontrol }}"
                           class="w-full bg-gray-700/50 border-0 rounded-lg text-white px-4 py-2.5"
                           readonly>
                </div>

                <!-- Nama -->
                <div>
                    <label class="block text-sm font-medium text-gray-400 mb-2">
                        Nama
                    </label>
                    <input type="text"
                           name="nama"
                           value="{{ old('nama') }}"
                           class="w-full bg-gray-700 border-0 rounded-lg text-white px-4 py-2.5 focus:ring-2 focus:ring-blue-500"
                           required>
                    @error('nama')
                        <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Alamat -->
                <div>
                    <label class="block text-sm font-medium text-gray-400 mb-2">
                        Alamat
                    </label>
                    <textarea name="alamat"
                              class="w-full bg-gray-700 border-0 rounded-lg text-white px-4 py-2.5 focus:ring-2 focus:ring-blue-500"
                              required>{{ old('alamat') }}</textarea>
                    @error('alamat')
                        <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Telepon -->
                <div>
                    <label class="block text-sm font-medium text-gray-400 mb-2">
                        Telepon
                    </label>
                    <input type="text"
                           name="telepon"
                           value="{{ old('telepon') }}"
                           class="w-full bg-gray-700 border-0 rounded-lg text-white px-4 py-2.5 focus:ring-2 focus:ring-blue-500"
                           required>
                    @error('telepon')
                        <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Tarif -->
                <div>
                    <label class="block text-sm font-medium text-gray-400 mb-2">
                        Tarif Listrik
                    </label>
                    <select name="tarif_id" 
                            class="w-full bg-gray-700 border-0 rounded-lg text-white px-4 py-2.5 focus:ring-2 focus:ring-blue-500"
                            required>
                        <option value="">Pilih Tarif</option>
                        @foreach($tarifs as $tarif)
                            <option value="{{ $tarif->id }}" 
                                    {{ old('tarif_id') == $tarif->id ? 'selected' : '' }}>
                                {{ $tarif->jenis_plg }} VA ({{ $tarif->jenis }})
                            </option>
                        @endforeach
                    </select>
                    @error('tarif_id')
                        <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center space-x-3 pt-2">
                    <button type="submit" 
                            class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-all duration-200">
                        Simpan Pelanggan
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