@extends('layouts.app')

@section('header', 'Input Pemakaian Listrik')

@section('content')
<form action="{{ route('pemakaian.store') }}" method="POST" class="max-w-2xl">
    @csrf
    
    <div class="grid grid-cols-2 gap-4 mb-4">
        <div>
            <label for="tahun" class="block text-gray-700 text-sm font-bold mb-2">Tahun</label>
            <select name="tahun" 
                    id="tahun" 
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('tahun') border-red-500 @enderror"
                    required>
                <option value="">Pilih Tahun</option>
                @for($i = date('Y'); $i >= date('Y')-5; $i--)
                    <option value="{{ $i }}" {{ old('tahun') == $i ? 'selected' : '' }}>{{ $i }}</option>
                @endfor
            </select>
            @error('tahun')
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="bulan" class="block text-gray-700 text-sm font-bold mb-2">Bulan</label>
            <select name="bulan" 
                    id="bulan" 
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('bulan') border-red-500 @enderror"
                    required>
                <option value="">Pilih Bulan</option>
                @foreach(range(1, 12) as $bulan)
                    <option value="{{ $bulan }}" {{ old('bulan') == $bulan ? 'selected' : '' }}>
                        {{ date('F', mktime(0, 0, 0, $bulan, 1)) }}
                    </option>
                @endforeach
            </select>
            @error('bulan')
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
            @enderror
        </div>
    </div>

    <div class="mb-4">
        <label for="no_kontrol" class="block text-gray-700 text-sm font-bold mb-2">No Kontrol</label>
        <select name="no_kontrol" 
                id="no_kontrol" 
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('no_kontrol') border-red-500 @enderror"
                required>
            <option value="">Pilih No Kontrol</option>
            @foreach($pelanggans as $pelanggan)
                <option value="{{ $pelanggan->no_kontrol }}" {{ old('no_kontrol') == $pelanggan->no_kontrol ? 'selected' : '' }}>
                    {{ $pelanggan->no_kontrol }} - {{ $pelanggan->nama }}
                </option>
            @endforeach
        </select>
        @error('no_kontrol')
            <p class="text-red-500 text-xs italic">{{ $message }}</p>
        @enderror
    </div>

    <div class="grid grid-cols-2 gap-4 mb-4">
        <div>
            <label for="meter_awal" class="block text-gray-700 text-sm font-bold mb-2">Meter Awal</label>
            <input type="number" 
                   name="meter_awal" 
                   id="meter_awal" 
                   class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('meter_awal') border-red-500 @enderror"
                   value="{{ old('meter_awal') }}"
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
                   value="{{ old('meter_akhir') }}"
                   required>
            @error('meter_akhir')
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
            @enderror
        </div>
    </div>

    <div class="flex items-center justify-between">
        <button type="submit" 
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
            Simpan
        </button>
        <a href="{{ route('pemakaian.index') }}" 
           class="text-gray-600 hover:text-gray-800">
            Batal
        </a>
    </div>
</form>

@push('scripts')
<script>
    // Auto-calculate usage when meter values change
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