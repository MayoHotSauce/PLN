<div>
    <label class="block text-sm font-medium text-gray-400 mb-2">
        Tarif Listrik
    </label>
    <select name="tarif_id" 
            class="w-full bg-gray-700 border-0 rounded-lg text-white px-4 py-2.5 focus:ring-2 focus:ring-blue-500">
        <option value="">Pilih Tarif</option>
        @foreach($tarifs as $tarif)
            <option value="{{ $tarif->id }}" 
                    {{ old('tarif_id', $pelanggan->tarif_id ?? '') == $tarif->id ? 'selected' : '' }}>
                {{ $tarif->jenis_plg }} VA ({{ $tarif->jenis }})
            </option>
        @endforeach
    </select>
</div> 