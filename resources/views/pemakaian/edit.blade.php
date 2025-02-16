@extends('layouts.app')

@section('header', 'Edit Pemakaian Listrik')

@section('content')
<div class="fade-in p-6">
    <div class="max-w-2xl mx-auto">
        <div class="bg-gray-800/50 rounded-xl shadow-sm p-6">
            <h2 class="text-xl font-semibold text-white mb-6">Edit Data Pemakaian</h2>
            
            <form action="{{ route('pemakaian.update', $pemakaian->id) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-400 mb-2">
                            Tahun
                        </label>
                        <select name="tahun" 
                                class="w-full bg-gray-700 border-0 rounded-lg text-white px-4 py-2.5 focus:ring-2 focus:ring-blue-500"
                                required>
                            @foreach(range(date('Y'), 2020) as $year)
                                <option value="{{ $year }}" {{ old('tahun', $pemakaian->tahun) == $year ? 'selected' : '' }}>
                                    {{ $year }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-400 mb-2">
                            Bulan
                        </label>
                        <select name="bulan" 
                                class="w-full bg-gray-700 border-0 rounded-lg text-white px-4 py-2.5 focus:ring-2 focus:ring-blue-500"
                                required>
                            @foreach(range(1, 12) as $month)
                                <option value="{{ $month }}" {{ old('bulan', $pemakaian->bulan) == $month ? 'selected' : '' }}>
                                    {{ date('F', mktime(0, 0, 0, $month, 1)) }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-400 mb-2">
                        Pelanggan
                    </label>
                    <select name="pelanggan_id" 
                            class="w-full bg-gray-700 border-0 rounded-lg text-white px-4 py-2.5 focus:ring-2 focus:ring-blue-500"
                            required>
                        @foreach($pelanggans as $pelanggan)
                            <option value="{{ $pelanggan->id }}" 
                                    {{ old('pelanggan_id', $pemakaian->pelanggan_id) == $pelanggan->id ? 'selected' : '' }}
                                    data-no-kontrol="{{ $pelanggan->no_kontrol }}">
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
                           name="no_kontrol" 
                           id="no_kontrol"
                           value="{{ old('no_kontrol', $pemakaian->no_kontrol) }}"
                           readonly
                           class="w-full bg-gray-700/50 border-0 rounded-lg text-gray-400 px-4 py-2.5">
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-400 mb-2">
                            Meter Awal
                        </label>
                        <input type="number" 
                               name="meter_awal" 
                               value="{{ old('meter_awal', $pemakaian->meter_awal) }}"
                               class="w-full bg-gray-700 border-0 rounded-lg text-white px-4 py-2.5 focus:ring-2 focus:ring-blue-500"
                               required>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-400 mb-2">
                            Meter Akhir
                        </label>
                        <input type="number" 
                               name="meter_akhir" 
                               value="{{ old('meter_akhir', $pemakaian->meter_akhir) }}"
                               class="w-full bg-gray-700 border-0 rounded-lg text-white px-4 py-2.5 focus:ring-2 focus:ring-blue-500"
                               required>
                    </div>
                </div>

                <div class="flex items-center space-x-3">
                    <button type="submit" 
                            class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-all duration-200">
                        Simpan Perubahan
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

@push('scripts')
<script>
document.querySelector('select[name="pelanggan_id"]').addEventListener('change', function() {
    const selectedOption = this.options[this.selectedIndex];
    document.getElementById('no_kontrol').value = selectedOption.dataset.noKontrol || '';
});
</script>
@endpush
@endsection 