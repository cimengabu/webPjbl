<x-app-layout title="Bank Sampah">
    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 mb-6">
        <div>
            <h2 class="text-xl font-black text-white tracking-tight">Manajemen Lokasi Bank Sampah</h2>
            <p class="text-gray-500 text-xs mt-1 font-medium">Kelola titik lokasi yang tampil di Peta Daur Ulang</p>
        </div>
        <a href="{{ route('admin.recycling-centers.create') }}"
            class="flex items-center gap-2 px-4 py-2 bg-red-600 hover:bg-red-500 text-white font-bold text-sm rounded-xl transition-all shadow-lg shadow-red-500/20">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
            Tambah Lokasi
        </a>
    </div>

    <!-- Filter -->
    <form method="GET" action="{{ route('admin.recycling-centers.index') }}" class="mb-4">
        <div class="flex gap-3">
            <div class="relative flex-1 max-w-sm">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                </div>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama atau alamat..."
                    class="w-full pl-9 pr-4 py-2 bg-white/5 border border-white/10 rounded-xl text-sm text-white placeholder-gray-600 focus:border-red-500/50 focus:outline-none transition-colors">
            </div>
            <button type="submit" class="px-4 py-2 bg-white/5 hover:bg-white/10 border border-white/10 rounded-xl text-sm text-gray-300 font-medium transition-colors">Cari</button>
            @if(request('search'))
                <a href="{{ route('admin.recycling-centers.index') }}" class="px-4 py-2 text-gray-500 hover:text-gray-300 text-sm transition-colors">Reset</a>
            @endif
        </div>
    </form>

    <div class="bg-white/[0.03] border border-white/[0.06] rounded-2xl overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="border-b border-white/[0.06]">
                        <th class="text-left px-5 py-3.5 text-[10px] font-black uppercase tracking-widest text-gray-500">Bank Sampah</th>
                        <th class="text-left px-5 py-3.5 text-[10px] font-black uppercase tracking-widest text-gray-500">Koordinat</th>
                        <th class="text-left px-5 py-3.5 text-[10px] font-black uppercase tracking-widest text-gray-500">Material Diterima</th>
                        <th class="text-right px-5 py-3.5 text-[10px] font-black uppercase tracking-widest text-gray-500">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/[0.04]">
                    @forelse($centers as $center)
                        <tr class="hover:bg-white/[0.02] transition-colors">
                            <td class="px-5 py-4">
                                <div class="flex items-start gap-3">
                                    <div class="w-8 h-8 rounded-full bg-emerald-500/20 border border-emerald-500/20 flex items-center justify-center text-emerald-400 mt-0.5 flex-shrink-0">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.243-4.243a8 8 0 1111.314 0zM15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                    </div>
                                    <div>
                                        <p class="text-sm font-bold text-white">{{ $center->name }}</p>
                                        <p class="text-[11px] text-gray-500 mt-0.5 max-w-[250px] truncate">{{ $center->address }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-5 py-4 text-[11px] text-gray-400 font-mono">
                                <span class="block">Lat: {{ $center->latitude }}</span>
                                <span class="block">Lng: {{ $center->longitude }}</span>
                            </td>
                            <td class="px-5 py-4">
                                <div class="flex flex-wrap gap-1 max-w-[200px]">
                                    @if($center->accepted_materials && is_array($center->accepted_materials))
                                        @foreach(array_slice($center->accepted_materials, 0, 3) as $material)
                                            <span class="inline-block px-2 py-0.5 bg-white/5 border border-white/10 rounded-md text-[10px] text-gray-400">{{ $material }}</span>
                                        @endforeach
                                        @if(count($center->accepted_materials) > 3)
                                            <span class="inline-block px-2 py-0.5 bg-white/5 border border-white/10 rounded-md text-[10px] text-gray-500">+{{ count($center->accepted_materials) - 3 }}</span>
                                        @endif
                                    @else
                                        <span class="text-[10px] text-gray-600">Belum diatur</span>
                                    @endif
                                </div>
                            </td>
                            <td class="px-5 py-4">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('admin.recycling-centers.edit', $center) }}"
                                        class="flex items-center gap-1 px-3 py-1.5 bg-blue-500/10 hover:bg-blue-500/20 border border-blue-500/20 text-blue-400 font-bold text-[11px] uppercase tracking-wide rounded-lg transition-all">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                        Edit
                                    </a>
                                    <form action="{{ route('admin.recycling-centers.destroy', $center) }}" method="POST" onsubmit="return confirm('Hapus titik lokasi ini?')">
                                        @csrf @method('DELETE')
                                        <button type="submit"
                                            class="flex items-center gap-1 px-3 py-1.5 bg-red-500/10 hover:bg-red-500/20 border border-red-500/20 text-red-400 font-bold text-[11px] uppercase tracking-wide rounded-lg transition-all">
                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-5 py-12 text-center text-gray-600 text-sm">
                                <div class="flex flex-col items-center gap-2">
                                    <svg class="w-8 h-8 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.243-4.243a8 8 0 1111.314 0zM15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                    Tidak ada lokasi ditemukan.
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($centers->hasPages())
            <div class="px-5 py-4 border-t border-white/[0.06] flex items-center justify-between">
                <p class="text-xs text-gray-600">Menampilkan {{ $centers->firstItem() }}–{{ $centers->lastItem() }} dari {{ $centers->total() }} lokasi</p>
                <div>{{ $centers->withQueryString()->links() }}</div>
            </div>
        @endif
    </div>
</x-app-layout>
