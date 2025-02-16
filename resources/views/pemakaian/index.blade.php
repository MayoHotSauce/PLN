@extends('layouts.app')

@section('content')
<div class="p-6">
    <!-- Header Section -->
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-bold text-white">Data Pemakaian Listrik</h1>
            <p class="text-gray-400 mt-1">Kelola data pemakaian listrik pelanggan</p>
        </div>
        <a href="{{ route('pemakaian.create') }}" 
           class="inline-flex items-center px-4 py-2 bg-blue-600 rounded-lg text-white hover:bg-blue-700 transition-colors duration-200">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
            </svg>
            Tambah Pemakaian
        </a>
    </div>

    <!-- Filter Section -->
    <div class="bg-gray-800/50 rounded-xl p-4 mb-6">
        <form action="{{ route('pemakaian.index') }}" method="GET" class="flex flex-wrap gap-4">
            <div class="flex-1 min-w-[200px]">
                <label class="block text-sm text-gray-400 mb-2">Tahun</label>
                <select name="tahun" 
                        class="w-full bg-gray-700 border-0 rounded-lg text-white px-4 py-2.5 focus:ring-2 focus:ring-blue-500"
                        onchange="this.form.submit()">
                    @foreach(range(date('Y'), 2020) as $year)
                        <option value="{{ $year }}" {{ request('tahun', date('Y')) == $year ? 'selected' : '' }}>
                            {{ $year }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="flex-1 min-w-[200px]">
                <label class="block text-sm text-gray-400 mb-2">Bulan</label>
                <select name="bulan" 
                        class="w-full bg-gray-700 border-0 rounded-lg text-white px-4 py-2.5 focus:ring-2 focus:ring-blue-500"
                        onchange="this.form.submit()">
                    @foreach(range(1, 12) as $month)
                        <option value="{{ $month }}" {{ request('bulan', date('n')) == $month ? 'selected' : '' }}>
                            {{ date('F', mktime(0, 0, 0, $month, 1)) }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="flex items-end">
                <button type="submit" 
                        class="px-4 py-2.5 bg-gray-700 text-white rounded-lg hover:bg-gray-600 transition-colors duration-200">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/>
                    </svg>
                </button>
                <a href="{{ route('pemakaian.index') }}" 
                   class="ml-2 px-4 py-2.5 bg-gray-700 text-white rounded-lg hover:bg-gray-600 transition-colors duration-200">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                    </svg>
                </a>
            </div>
        </form>
    </div>

    @if(request('tahun') || request('bulan'))
    <div class="mb-4 flex items-center text-sm text-gray-400">
        <span class="mr-2">Filter aktif:</span>
        @if(request('tahun'))
            <span class="px-2 py-1 bg-gray-700 rounded-lg mr-2">Tahun: {{ request('tahun') }}</span>
        @endif
        @if(request('bulan'))
            <span class="px-2 py-1 bg-gray-700 rounded-lg">Bulan: {{ date('F', mktime(0, 0, 0, request('bulan'), 1)) }}</span>
        @endif
    </div>
    @endif

    <!-- Table Section -->
    <div class="bg-gray-800/50 rounded-xl overflow-hidden">
        <table class="w-full">
            <thead>
                <tr class="bg-gray-700/50">
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Periode</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">No Kontrol</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Nama Pelanggan</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-400 uppercase tracking-wider">Meter Awal</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-400 uppercase tracking-wider">Meter Akhir</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-400 uppercase tracking-wider">Pemakaian</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-400 uppercase tracking-wider">Total Tagihan</th>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-400 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-400 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-700/50">
                @forelse($pemakaians as $pemakaian)
                <tr class="hover:bg-gray-700/25 transition-colors duration-150">
                    <td class="px-6 py-4 whitespace-nowrap text-white">
                        {{ date('F Y', mktime(0, 0, 0, $pemakaian->bulan, 1, $pemakaian->tahun)) }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-white">{{ $pemakaian->no_kontrol }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-white">{{ $pemakaian->pelanggan->nama }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-right text-white">{{ number_format($pemakaian->meter_awal) }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-right text-white">{{ number_format($pemakaian->meter_akhir) }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-right text-white">{{ number_format($pemakaian->jumlah_pakai) }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-right text-white">Rp {{ number_format($pemakaian->total_bayar) }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-center">
                        @if($pemakaian->status_pembayaran === 'lunas')
                            <span class="px-3 py-1 text-xs rounded-full inline-flex items-center bg-green-500/20 text-green-400">
                                <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                                Lunas
                            </span>
                        @else
                            <span class="px-3 py-1 text-xs rounded-full inline-flex items-center bg-red-500/20 text-red-400">
                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                Belum Lunas
                            </span>
                        @endif
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-center">
                        <div class="flex justify-center space-x-2">
                            @if($pemakaian->status_pembayaran !== 'lunas')
                                <button type="button"
                                        onclick="confirmPayment({{ $pemakaian->id }}, '{{ number_format($pemakaian->total_bayar, 0, ',', '.') }}')"
                                        class="text-green-400 hover:text-green-300 transition-colors duration-200"
                                        title="Bayar">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/>
                                    </svg>
                                </button>
                            @endif
                            <a href="{{ route('pemakaian.edit', $pemakaian->id) }}" 
                               class="text-blue-400 hover:text-blue-300 transition-colors duration-200"
                               title="Edit">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                </svg>
                            </a>
                            <form action="{{ route('pemakaian.destroy', $pemakaian->id) }}" 
                                  method="POST" 
                                  class="inline"
                                  onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        class="text-red-400 hover:text-red-300 transition-colors duration-200"
                                        title="Hapus">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="9" class="px-6 py-4 text-center text-gray-400">
                        Tidak ada data pemakaian untuk periode ini
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    @if($pemakaians->hasPages())
    <div class="mt-4">
        {{ $pemakaians->links() }}
    </div>
    @endif

    <!-- Info Section -->
    <div class="mt-4 text-sm text-gray-400">
        Menampilkan {{ $pemakaians->count() }} dari {{ $pemakaians->total() }} data
    </div>
</div>

<!-- Payment Modal -->
<div id="paymentModal" class="fixed inset-0 bg-gray-900/50 items-center justify-center hidden z-50">
    <div class="bg-gray-800 rounded-xl p-6 max-w-md w-full mx-4">
        <h3 class="text-xl font-semibold text-white mb-4">Konfirmasi Pembayaran</h3>
        <p class="text-gray-300 mb-4">Total yang harus dibayar: <span id="paymentAmount" class="font-semibold"></span></p>
        
        <div class="flex justify-end space-x-3">
            <button type="button" 
                    onclick="closePaymentModal()"
                    class="px-4 py-2 bg-gray-700 text-white rounded-lg hover:bg-gray-600">
                Batal
            </button>
            <form id="paymentForm" method="POST" class="inline">
                @csrf
                @method('PATCH')
                <button type="submit" 
                        class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">
                    Konfirmasi Pembayaran
                </button>
            </form>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
function confirmPayment(id, amount) {
    const modal = document.getElementById('paymentModal');
    const form = document.getElementById('paymentForm');
    const amountText = document.getElementById('paymentAmount');
    
    form.action = `/pemakaian/${id}/pay`;
    amountText.textContent = `Rp ${amount}`;
    
    modal.classList.remove('hidden');
    modal.classList.add('flex');
}

function closePaymentModal() {
    const modal = document.getElementById('paymentModal');
    modal.classList.remove('flex');
    modal.classList.add('hidden');
}

// Close modal when clicking outside
document.getElementById('paymentModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closePaymentModal();
    }
});
</script>
@endpush 