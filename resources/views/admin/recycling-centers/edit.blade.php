<x-app-layout title="Edit Bank Sampah">
    <div class="max-w-3xl">
        <div class="flex items-center gap-4 mb-6">
            <a href="{{ route('admin.recycling-centers.index') }}" class="w-8 h-8 flex items-center justify-center rounded-xl bg-white/5 hover:bg-white/10 border border-white/10 text-gray-400 hover:text-white transition-all">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            </a>
            <div>
                <h2 class="text-xl font-black text-white tracking-tight">Edit Bank Sampah</h2>
                <p class="text-gray-500 text-xs mt-0.5">Perbarui informasi: <span class="text-white font-bold">{{ $recyclingCenter->name }}</span></p>
            </div>
        </div>

        <form action="{{ route('admin.recycling-centers.update', $recyclingCenter) }}" method="POST" class="space-y-5">
            @csrf @method('PUT')
            <div class="bg-white/[0.03] border border-white/[0.06] rounded-2xl p-6 space-y-5">

                <div>
                    <label class="block text-[10px] font-black uppercase tracking-widest text-gray-500 mb-2">Nama Bank Sampah / Fasilitas <span class="text-red-500">*</span></label>
                    <input type="text" name="name" value="{{ old('name', $recyclingCenter->name) }}" required
                        class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-2.5 text-sm text-white placeholder-gray-600 focus:border-red-500/50 focus:outline-none focus:ring-2 focus:ring-red-500/10 transition-all">
                    @error('name')<p class="text-red-400 text-xs mt-1">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label class="block text-[10px] font-black uppercase tracking-widest text-gray-500 mb-2">Alamat Lengkap <span class="text-red-500">*</span></label>
                    <textarea name="address" rows="3" required
                        class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-sm text-white placeholder-gray-600 focus:border-red-500/50 focus:outline-none focus:ring-2 focus:ring-red-500/10 transition-all leading-relaxed">{{ old('address', $recyclingCenter->address) }}</textarea>
                    @error('address')<p class="text-red-400 text-xs mt-1">{{ $message }}</p>@enderror
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5 border-t border-white/[0.06] pt-5">
                    <div>
                        <label class="block text-[10px] font-black uppercase tracking-widest text-gray-500 mb-2">Latitude <span class="text-red-500">*</span></label>
                        <input type="text" name="latitude" value="{{ old('latitude', $recyclingCenter->latitude) }}" required
                            class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-2.5 text-sm text-white font-mono placeholder-gray-600 focus:border-red-500/50 focus:outline-none focus:ring-2 focus:ring-red-500/10 transition-all">
                        @error('latitude')<p class="text-red-400 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="block text-[10px] font-black uppercase tracking-widest text-gray-500 mb-2">Longitude <span class="text-red-500">*</span></label>
                        <input type="text" name="longitude" value="{{ old('longitude', $recyclingCenter->longitude) }}" required
                            class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-2.5 text-sm text-white font-mono placeholder-gray-600 focus:border-red-500/50 focus:outline-none focus:ring-2 focus:ring-red-500/10 transition-all">
                        @error('longitude')<p class="text-red-400 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>
                </div>

                <div class="border-t border-white/[0.06] pt-5">
                    <label class="block text-[10px] font-black uppercase tracking-widest text-gray-500 mb-3">Material yang Diterima (Opsional)</label>
                    <div class="grid grid-cols-2 sm:grid-cols-3 gap-3">
                        @php
                            $materials = ['Plastik', 'Kertas', 'Kardus', 'Kaca', 'Logam/Kaleng', 'Elektronik', 'Minyak Jelantah', 'Organik'];
                            $currentMaterials = old('accepted_materials', $recyclingCenter->accepted_materials ?? []);
                        @endphp
                        @foreach($materials as $material)
                            <label class="flex items-center gap-2 p-3 rounded-xl border border-white/5 bg-white/[0.02] hover:bg-white/5 cursor-pointer transition-colors">
                                <input type="checkbox" name="accepted_materials[]" value="{{ $material }}"
                                    {{ in_array($material, $currentMaterials) ? 'checked' : '' }}
                                    class="w-4 h-4 rounded bg-white/10 border-transparent text-emerald-500 focus:ring-emerald-500/50 focus:ring-offset-0">
                                <span class="text-sm text-gray-300 font-medium">{{ $material }}</span>
                            </label>
                        @endforeach
                    </div>
                    @error('accepted_materials')<p class="text-red-400 text-xs mt-2">{{ $message }}</p>@enderror
                </div>

            </div>

            <div class="flex items-center justify-between gap-3">
                <form action="{{ route('admin.recycling-centers.destroy', $recyclingCenter) }}" method="POST" onsubmit="return confirm('Hapus titik lokasi ini secara permanen?')">
                    @csrf @method('DELETE')
                    <button type="submit" class="flex items-center gap-2 px-4 py-2.5 bg-red-500/10 hover:bg-red-500/20 border border-red-500/20 text-red-400 font-bold text-sm rounded-xl transition-all">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                        Hapus Lokasi
                    </button>
                </form>
                <div class="flex items-center gap-3">
                    <a href="{{ route('admin.recycling-centers.index') }}" class="px-5 py-2.5 bg-white/5 hover:bg-white/10 border border-white/10 text-gray-300 font-bold text-sm rounded-xl transition-all">Batal</a>
                    <button type="submit" class="px-5 py-2.5 bg-red-600 hover:bg-red-500 text-white font-black text-sm rounded-xl transition-all shadow-lg shadow-red-500/20">
                        Simpan Perubahan
                    </button>
                </div>
            </div>
        </form>
    </div>
</x-app-layout>
