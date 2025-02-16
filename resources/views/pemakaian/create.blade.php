@extends('layouts.app')

@section('content')
<div class="fade-in p-6">
    <div class="max-w-2xl mx-auto">
        <div class="bg-gray-800/50 rounded-xl shadow-sm p-6">
            <h2 class="text-xl font-semibold text-white mb-6">Tambah Data Pemakaian</h2>
            
            <form action="{{ route('pemakaian.store') }}" method="POST" class="space-y-6">
                @csrf
                
                <div>
                    <label class="block text-sm font-medium text-gray-400 mb-2">
                        Tahun
                    </label>
                    <select name="tahun" 
                            class="w-full bg-gray-700 border-0 rounded-lg text-white px-4 py-2.5 focus:ring-2 focus:ring-blue-500">
                        @for($i = now()->year; $i >= now()->year - 5; $i--)
                            <option value="{{ $i }}" {{ old('tahun', $tahun) == $i ? 'selected' : '' }}>
                                {{ $i }}
                            </option>
                        @endfor
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-400 mb-2">
                        Bulan
                    </label>
                    <select name="bulan" 
                            class="w-full bg-gray-700 border-0 rounded-lg text-white px-4 py-2.5 focus:ring-2 focus:ring-blue-500">
                        @foreach(range(1, 12) as $month)
                            <option value="{{ $month }}" {{ old('bulan', $bulan) == $month ? 'selected' : '' }}>
                                {{ date('F', mktime(0, 0, 0, $month, 1)) }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-400 mb-2">
                        Pelanggan
                    </label>
                    <select name="pelanggan_id" 
                            class="w-full bg-gray-700 border-0 rounded-lg text-white px-4 py-2.5 focus:ring-2 focus:ring-blue-500"
                            onchange="updateNoKontrol(this)">
                        <option value="">Pilih Pelanggan</option>
                        @foreach($pelanggans as $pelanggan)
                            <option value="{{ $pelanggan->no_kontrol }}" 
                                    data-nokontrol="{{ $pelanggan->no_kontrol }}">
                                {{ $pelanggan->nama }} - {{ $pelanggan->no_kontrol }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-400 mb-2">
                        No Kontrol
                    </label>
                    <input type="text"
                           id="no_kontrol"
                           class="w-full bg-gray-700/50 border-0 rounded-lg text-white px-4 py-2.5"
                           readonly>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-400 mb-2">
                        Meter Awal
                    </label>
                    <input type="number"
                           name="meter_awal"
                           value="{{ old('meter_awal') }}"
                           class="w-full bg-gray-700 border-0 rounded-lg text-white px-4 py-2.5 focus:ring-2 focus:ring-blue-500"
                           required>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-400 mb-2">
                        Meter Akhir
                    </label>
                    <input type="number"
                           name="meter_akhir"
                           value="{{ old('meter_akhir') }}"
                           class="w-full bg-gray-700 border-0 rounded-lg text-white px-4 py-2.5 focus:ring-2 focus:ring-blue-500"
                           required>
                </div>

                <div class="flex items-center space-x-3">
                    <button type="submit" 
                            class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-all duration-200">
                        Simpan
                    </button>
                    <a href="{{ route('pemakaian.index') }}" 
                       class="px-4 py-2 text-gray-400 hover:text-gray-300 transition-colors">
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function updateNoKontrol(select) {
    const noKontrolInput = document.getElementById('no_kontrol');
    const selectedOption = select.options[select.selectedIndex];
    noKontrolInput.value = selectedOption.dataset.nokontrol || '';
}
</script>
@endsection 