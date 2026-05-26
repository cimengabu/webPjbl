<x-app-layout title="Manajemen Artikel">
    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 mb-6">
        <div>
            <h2 class="text-xl font-black text-white tracking-tight">Manajemen Artikel</h2>
            <p class="text-gray-500 text-xs mt-1 font-medium">Kelola konten artikel edukasi lingkungan</p>
        </div>
        <a href="{{ route('admin.articles.create') }}"
            class="flex items-center gap-2 px-4 py-2 bg-red-600 hover:bg-red-500 text-white font-bold text-sm rounded-xl transition-all shadow-lg shadow-red-500/20">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
            Tulis Artikel
        </a>
    </div>

    <!-- Filter -->
    <form method="GET" action="{{ route('admin.articles.index') }}" class="mb-4">
        <div class="flex gap-3 flex-wrap">
            <div class="relative flex-1 min-w-[200px] max-w-sm">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                </div>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari judul artikel..."
                    class="w-full pl-9 pr-4 py-2 bg-white/5 border border-white/10 rounded-xl text-sm text-white placeholder-gray-600 focus:border-red-500/50 focus:outline-none transition-colors">
            </div>
            <select name="status" class="px-3 py-2 bg-white/5 border border-white/10 rounded-xl text-sm text-gray-300 focus:border-red-500/50 focus:outline-none transition-colors">
                <option value="">Semua Status</option>
                <option value="Published" {{ request('status') == 'Published' ? 'selected' : '' }}>Published</option>
                <option value="Draft" {{ request('status') == 'Draft' ? 'selected' : '' }}>Draft</option>
            </select>
            <button type="submit" class="px-4 py-2 bg-white/5 hover:bg-white/10 border border-white/10 rounded-xl text-sm text-gray-300 font-medium transition-colors">Filter</button>
            @if(request('search') || request('status'))
                <a href="{{ route('admin.articles.index') }}" class="px-4 py-2 text-gray-500 hover:text-gray-300 text-sm transition-colors">Reset</a>
            @endif
        </div>
    </form>

    <div class="bg-white/[0.03] border border-white/[0.06] rounded-2xl overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="border-b border-white/[0.06]">
                        <th class="text-left px-5 py-3.5 text-[10px] font-black uppercase tracking-widest text-gray-500">Artikel</th>
                        <th class="text-left px-5 py-3.5 text-[10px] font-black uppercase tracking-widest text-gray-500">Konten</th>
                        <th class="text-center px-5 py-3.5 text-[10px] font-black uppercase tracking-widest text-gray-500">Status</th>
                        <th class="text-left px-5 py-3.5 text-[10px] font-black uppercase tracking-widest text-gray-500">Dibuat</th>
                        <th class="text-right px-5 py-3.5 text-[10px] font-black uppercase tracking-widest text-gray-500">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/[0.04]">
                    @forelse($articles as $article)
                        <tr class="hover:bg-white/[0.02] transition-colors">
                            <td class="px-5 py-4">
                                <div class="flex items-center gap-3">
                                    @if($article->image)
                                        <img src="{{ asset('storage/' . $article->image) }}" alt="{{ $article->title }}"
                                            class="w-10 h-10 rounded-lg object-cover flex-shrink-0 border border-white/10">
                                    @else
                                        <div class="w-10 h-10 rounded-lg bg-white/5 border border-white/10 flex items-center justify-center flex-shrink-0">
                                            <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                        </div>
                                    @endif
                                    <div>
                                        <p class="text-sm font-bold text-white leading-tight max-w-[220px] truncate">{{ $article->title }}</p>
                                        <p class="text-[10px] text-gray-600 font-mono mt-0.5">ID #{{ $article->id }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-5 py-4 text-sm text-gray-500 max-w-[250px]">
                                <p class="truncate">{{ Str::limit(strip_tags($article->content), 80) }}</p>
                            </td>
                            <td class="px-5 py-4 text-center">
                                <span class="inline-flex px-2.5 py-1 rounded-lg text-[10px] font-black uppercase tracking-wider border
                                    {{ $article->status === 'Published'
                                        ? 'bg-emerald-500/10 text-emerald-400 border-emerald-500/20'
                                        : 'bg-amber-500/10 text-amber-400 border-amber-500/20' }}">
                                    {{ $article->status }}
                                </span>
                            </td>
                            <td class="px-5 py-4 text-xs text-gray-500 font-mono whitespace-nowrap">{{ $article->created_at->format('d M Y') }}</td>
                            <td class="px-5 py-4">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('articles.show', $article->id) }}" target="_blank"
                                        class="flex items-center gap-1 px-3 py-1.5 bg-white/5 hover:bg-white/10 border border-white/10 text-gray-400 font-bold text-[11px] uppercase tracking-wide rounded-lg transition-all">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                        Lihat
                                    </a>
                                    <a href="{{ route('admin.articles.edit', $article) }}"
                                        class="flex items-center gap-1 px-3 py-1.5 bg-blue-500/10 hover:bg-blue-500/20 border border-blue-500/20 text-blue-400 font-bold text-[11px] uppercase tracking-wide rounded-lg transition-all">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                        Edit
                                    </a>
                                    <form action="{{ route('admin.articles.destroy', $article) }}" method="POST" onsubmit="return confirm('Hapus artikel ini?')">
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
                            <td colspan="5" class="px-5 py-12 text-center text-gray-600 text-sm">
                                <div class="flex flex-col items-center gap-2">
                                    <svg class="w-8 h-8 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                    Tidak ada artikel ditemukan.
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($articles->hasPages())
            <div class="px-5 py-4 border-t border-white/[0.06] flex items-center justify-between">
                <p class="text-xs text-gray-600">Menampilkan {{ $articles->firstItem() }}–{{ $articles->lastItem() }} dari {{ $articles->total() }} artikel</p>
                <div>{{ $articles->withQueryString()->links() }}</div>
            </div>
        @endif
    </div>
</x-app-layout>
