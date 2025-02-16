@extends('layouts.app')

@section('header', 'Data Pelanggan')

@section('content')
<div class="mb-6">
    <a href="{{ route('pelanggan.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
        Tambah Pelanggan
    </a>
</div>

<div class="overflow-x-auto">
    <table class="min-w-full bg-white">
        <thead class="bg-gray-100">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No Kontrol</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Alamat</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Telepon</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jenis</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200">
            @foreach($pelanggans as $pelanggan)
            <tr>
                <td class="px-6 py-4 whitespace-nowrap">{{ $pelanggan->no_kontrol }}</td>
                <td class="px-6 py-4 whitespace-nowrap">{{ $pelanggan->nama }}</td>
                <td class="px-6 py-4">{{ $pelanggan->alamat }}</td>
                <td class="px-6 py-4 whitespace-nowrap">{{ $pelanggan->telepon }}</td>
                <td class="px-6 py-4 whitespace-nowrap">{{ $pelanggan->jenis_plg }}</td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="flex space-x-2">
                        <a href="{{ route('pelanggan.edit', $pelanggan->no_kontrol) }}" 
                           class="text-blue-600 hover:text-blue-900">Edit</a>
                        <form action="{{ route('pelanggan.destroy', $pelanggan->no_kontrol) }}" 
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
    {{ $pelanggans->links() }}
</div>
@endsection 