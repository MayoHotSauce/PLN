@extends('layouts.app')

@section('header', 'Edit Pemakaian Listrik')

@section('content')
<form action="{{ route('pemakaian.update', $pemakaian->id) }}" method="POST" class="max-w-2xl">
    @csrf
    @method('PUT')
    
    <div class="grid grid-cols-2 gap-4 mb-4">
        <div>
            <label for="tahun" class="block text-gray-700 text-sm font-bold mb-2">Tahun</label>
            <input type="text" 
                   value="{{ $pemakaian->tahun }}" 
                   class="bg-gray-100 shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight"
                   readonly>
        </div>

        <div>
            <label for="bulan" class="block text-gray-700 text-sm font-bold mb-2">Bulan</label>
            <input type="text" 
                   value="{{ date('F', mktime(0, 0, 0, $pemakaian->bulan, 1)) }}" 
                   class="bg-gray-100 shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight"
                   readonly>
        </div>
    </div>

    <div class="mb-4">
        <label for="no_kontrol" class="block text-gray-700 text-sm font-bold mb-2">Pelanggan</label>
        <input type="text" 
               value="{{ $pemakaian->pelanggan->no_kontrol }} - {{ $pemakaian->pelanggan->nama }}" 
               class="bg-gray-100 shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight"
               readonly>
    </div>

    <div class="grid grid-cols-2 gap-4 mb-4">
        <div>
            <label for="meter_awal" class="block text-gray-700 text-sm font-bold mb-2">Meter Awal</label>
            <input type="number" 
                   name="meter_awal" 
                   id="meter_awal" 
                   class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('meter_awal') border-red-500 @enderror"
                   value="{{ old('meter_awal', $pemakaian->meter_awal) }}"
                   required>
            @error('meter_awal')
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="meter_akhir" class="block text-gray-700 text-sm font-bold mb-2">Meter Akhir</label>
            <input type="number" 
                   name="meter_akhir" 
                   id="meter_akhir" 
                   class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('meter_akhir') border-red-500 @enderror"
                   value="{{ old('meter_akhir', $pemakaian->meter_akhir) }}"
                   required>
            @error('meter_akhir')
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
            @enderror
        </div>
    </div>

    <div class="flex items-center justify-between">
        <button type="submit" 
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
            Update
        </button>
        <a href="{{ route('pemakaian.index') }}" 
           class="text-gray-600 hover:text-gray-800">
            Batal
        </a>
    </div>
</form>

@push('scripts')
<script>
    document.getElementById('meter_awal').addEventListener('change', calculateUsage);
    document.getElementById('meter_akhir').addEventListener('change', calculateUsage);

    function calculateUsage() {
        const meterAwal = parseInt(document.getElementById('meter_awal').value) || 0;
        const meterAkhir = parseInt(document.getElementById('meter_akhir').value) || 0;
        
        if (meterAkhir < meterAwal) {
            alert('Meter akhir tidak boleh lebih kecil dari meter awal!');
            document.getElementById('meter_akhir').value = '';
        }
    }
</script>
@endpush
@endsection 