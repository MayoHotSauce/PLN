@extends('layouts.app')

@section('content')
<div class="fade-in p-6">
    @if(session('success'))
        <div class="mb-4 bg-green-500/10 border border-green-500/20 rounded-lg p-4">
            <p class="text-green-400">{{ session('success') }}</p>
        </div>
    @endif

    <div class="flex justify-between items-center mb-6">
        <div>
            <h2 class="text-xl font-semibold text-white">Data Tarif Listrik</h2>
            <p class="text-sm text-gray-400">Kelola data tarif listrik</p>
        </div>
        <a href="{{ route('tarif.create') }}" 
           class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            Tambah Tarif
        </a>
    </div>

    <div class="bg-gray-800/50 rounded-xl shadow-sm overflow-hidden">
        <table class="w-full">
            <thead>
                <tr class="border-b border-gray-700">
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Daya</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Tarif per KWH</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Beban</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-400 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-700">
                @forelse($tarifs as $tarif)
                    <tr class="hover:bg-gray-700/50 transition-colors">
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-white">
                            {{ $tarif->jenis_plg }} VA
                            <span class="ml-2 px-2 py-1 text-xs rounded-full
                                {{ in_array($tarif->jenis, ['R1', 'R2', 'R3']) ? 'bg-blue-500/20 text-blue-400' : 
                                   (in_array($tarif->jenis, ['B1', 'B2']) ? 'bg-purple-500/20 text-purple-400' : 
                                    'bg-green-500/20 text-green-400') }}"
                                title="{{ $tarif->jenis_plg }} VA">
                                {{ $tarif->jenis }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-white">
                            Rp {{ number_format((float)$tarif->tarif_kwh, 0, ',', '.') }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-white">
                            Rp {{ number_format((float)$tarif->biaya_beban, 0, ',', '.') }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm">
                            <div class="flex justify-end space-x-3">
                                <a href="{{ route('tarif.edit', $tarif) }}" 
                                   class="text-blue-400 hover:text-blue-300 transition-colors">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                              d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                    </svg>
                                </a>
                                <form action="{{ route('tarif.destroy', $tarif) }}" 
                                      method="POST" 
                                      class="inline-block"
                                      onsubmit="return confirm('Apakah Anda yakin ingin menghapus tarif ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-400 hover:text-red-300 transition-colors">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                  d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-6 py-4 text-center text-gray-400">
                            Belum ada data tarif
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection 