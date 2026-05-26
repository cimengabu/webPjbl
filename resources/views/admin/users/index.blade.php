<x-app-layout title="Manajemen Pengguna">
    <!-- Header -->
    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 mb-6">
        <div>
            <h2 class="text-xl font-black text-white tracking-tight">Manajemen Pengguna</h2>
            <p class="text-gray-500 text-xs mt-1 font-medium">Kelola semua pengguna terdaftar di sistem EcoTrack</p>
        </div>
        <a href="{{ route('admin.users.create') }}"
            class="flex items-center gap-2 px-4 py-2 bg-red-600 hover:bg-red-500 text-white font-bold text-sm rounded-xl transition-all shadow-lg shadow-red-500/20">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
            Tambah Pengguna
        </a>
    </div>

    <!-- Filter & Search -->
    <form method="GET" action="{{ route('admin.users.index') }}" class="mb-4">
        <div class="flex gap-3">
            <div class="relative flex-1 max-w-sm">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                </div>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama atau email..."
                    class="w-full pl-9 pr-4 py-2 bg-white/5 border border-white/10 rounded-xl text-sm text-white placeholder-gray-600 focus:border-red-500/50 focus:outline-none transition-colors">
            </div>
            <button type="submit" class="px-4 py-2 bg-white/5 hover:bg-white/10 border border-white/10 rounded-xl text-sm text-gray-300 font-medium transition-colors">Filter</button>
            @if(request('search'))
                <a href="{{ route('admin.users.index') }}" class="px-4 py-2 text-gray-500 hover:text-gray-300 text-sm transition-colors">Reset</a>
            @endif
        </div>
    </form>

    <!-- Table -->
    <div class="bg-white/[0.03] border border-white/[0.06] rounded-2xl overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="border-b border-white/[0.06]">
                        <th class="text-left px-5 py-3.5 text-[10px] font-black uppercase tracking-widest text-gray-500">#</th>
                        <th class="text-left px-5 py-3.5 text-[10px] font-black uppercase tracking-widest text-gray-500">Nama</th>
                        <th class="text-left px-5 py-3.5 text-[10px] font-black uppercase tracking-widest text-gray-500">Email</th>
                        <th class="text-left px-5 py-3.5 text-[10px] font-black uppercase tracking-widest text-gray-500">Kontak</th>
                        <th class="text-right px-5 py-3.5 text-[10px] font-black uppercase tracking-widest text-gray-500">Total Poin</th>
                        <th class="text-left px-5 py-3.5 text-[10px] font-black uppercase tracking-widest text-gray-500">Bergabung</th>
                        <th class="text-right px-5 py-3.5 text-[10px] font-black uppercase tracking-widest text-gray-500">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/[0.04]">
                    @forelse($users as $user)
                        <tr class="hover:bg-white/[0.02] transition-colors group">
                            <td class="px-5 py-4 text-xs text-gray-600 font-mono">{{ $user->id }}</td>
                            <td class="px-5 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-full bg-gradient-to-br from-emerald-500/20 to-teal-500/20 border border-emerald-500/20 flex items-center justify-center text-emerald-400 text-xs font-black flex-shrink-0">
                                        {{ strtoupper(substr($user->name, 0, 2)) }}
                                    </div>
                                    <span class="text-sm font-bold text-white">{{ $user->name }}</span>
                                </div>
                            </td>
                            <td class="px-5 py-4 text-sm text-gray-400 font-mono">{{ $user->email }}</td>
                            <td class="px-5 py-4 text-sm text-gray-500">{{ $user->contact ?? '—' }}</td>
                            <td class="px-5 py-4 text-right">
                                <span class="text-sm font-black text-emerald-400">{{ number_format($user->total_points ?? 0, 0, ',', '.') }}</span>
                                <span class="text-[10px] text-gray-600 ml-1">pts</span>
                            </td>
                            <td class="px-5 py-4 text-xs text-gray-500 font-mono">{{ $user->created_at->format('d M Y') }}</td>
                            <td class="px-5 py-4">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('admin.users.edit', $user) }}"
                                        class="flex items-center gap-1 px-3 py-1.5 bg-blue-500/10 hover:bg-blue-500/20 border border-blue-500/20 hover:border-blue-500/40 text-blue-400 font-bold text-[11px] uppercase tracking-wide rounded-lg transition-all">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                        Edit
                                    </a>
                                    <form action="{{ route('admin.users.destroy', $user) }}" method="POST" onsubmit="return confirm('Hapus pengguna {{ $user->name }}? Tindakan ini tidak bisa dibatalkan.')">
                                        @csrf @method('DELETE')
                                        <button type="submit"
                                            class="flex items-center gap-1 px-3 py-1.5 bg-red-500/10 hover:bg-red-500/20 border border-red-500/20 hover:border-red-500/40 text-red-400 font-bold text-[11px] uppercase tracking-wide rounded-lg transition-all">
                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-5 py-12 text-center text-gray-600 text-sm">
                                <div class="flex flex-col items-center gap-2">
                                    <svg class="w-8 h-8 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                    Tidak ada pengguna ditemukan.
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($users->hasPages())
            <div class="px-5 py-4 border-t border-white/[0.06] flex items-center justify-between">
                <p class="text-xs text-gray-600">Menampilkan {{ $users->firstItem() }}–{{ $users->lastItem() }} dari {{ $users->total() }} pengguna</p>
                <div class="flex gap-2">{{ $users->withQueryString()->links() }}</div>
            </div>
        @endif
    </div>
</x-app-layout>
