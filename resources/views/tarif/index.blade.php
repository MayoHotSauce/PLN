@extends('layouts.app')

@section('header', 'Data Tarif')

@section('content')
<div class="mb-6">
    <a href="{{ route('tarif.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
        Tambah Tarif
    </a>
</div>

<div class="overflow-x-auto">
    <table class="min-w-full bg-white">
        <thead class="bg-gray-100">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jenis Pelanggan</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Biaya Beban</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tarif per KWH</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200">
            @foreach($tarifs as $tarif)
            <tr>
                <td class="px-6 py-4 whitespace-nowrap">{{ $tarif->jenis_plg }}</td>
                <td class="px-6 py-4 whitespace-nowrap">Rp {{ number_format($tarif->biaya_beban, 0, ',', '.') }}</td>
                <td class="px-6 py-4 whitespace-nowrap">Rp {{ number_format($tarif->tarif_kwh, 0, ',', '.') }}</td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="flex space-x-2">
                        <a href="{{ route('tarif.edit', $tarif->id) }}" 
                           class="text-blue-600 hover:text-blue-900">Edit</a>
                        <form action="{{ route('tarif.destroy', $tarif->id) }}" 
                              method="POST" 
                              onsubmit="return confirm('Apakah anda yakin?');"
                              class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                    class="text-red-600 hover:text-red-900">Hapus</button>
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div class="mt-4">
    {{ $tarifs->links() }}
</div>
@endsection 