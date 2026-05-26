<x-app-layout title="Tulis Artikel">
    <div class="max-w-4xl">
        <div class="flex items-center gap-4 mb-6">
            <a href="{{ route('admin.articles.index') }}" class="w-8 h-8 flex items-center justify-center rounded-xl bg-white/5 hover:bg-white/10 border border-white/10 text-gray-400 hover:text-white transition-all">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            </a>
            <div>
                <h2 class="text-xl font-black text-white tracking-tight">Tulis Artikel Edukasi</h2>
                <p class="text-gray-500 text-xs mt-0.5">Buat konten baru untuk mengedukasi pengguna EcoTrack</p>
            </div>
        </div>

        <form action="{{ route('admin.articles.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
            @csrf
            <div class="bg-white/[0.03] border border-white/[0.06] rounded-2xl p-6 space-y-5">

                <div>
                    <label class="block text-[10px] font-black uppercase tracking-widest text-gray-500 mb-2">Judul Artikel <span class="text-red-500">*</span></label>
                    <input type="text" name="title" value="{{ old('title') }}" required
                        class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-2.5 text-sm text-white placeholder-gray-600 focus:border-red-500/50 focus:outline-none focus:ring-2 focus:ring-red-500/10 transition-all"
                        placeholder="Masukkan judul artikel yang menarik...">
                    @error('title')<p class="text-red-400 text-xs mt-1">{{ $message }}</p>@enderror
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                    <div>
                        <label class="block text-[10px] font-black uppercase tracking-widest text-gray-500 mb-2">Gambar Banner</label>
                        <input type="file" name="image" accept="image/*"
                            class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-2 text-sm text-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-xs file:font-black file:bg-white/10 file:text-white hover:file:bg-white/20 transition-all cursor-pointer">
                        <p class="text-[10px] text-gray-500 mt-1.5">Format: JPG, PNG, WEBP (Maks 2MB)</p>
                        @error('image')<p class="text-red-400 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="block text-[10px] font-black uppercase tracking-widest text-gray-500 mb-2">Status Publikasi <span class="text-red-500">*</span></label>
                        <select name="status" required
                            class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-2.5 text-sm text-white focus:border-red-500/50 focus:outline-none focus:ring-2 focus:ring-red-500/10 transition-all appearance-none">
                            <option value="Published" class="bg-gray-900" {{ old('status') == 'Published' ? 'selected' : '' }}>Published (Langsung Tayang)</option>
                            <option value="Draft" class="bg-gray-900" {{ old('status') == 'Draft' ? 'selected' : '' }}>Draft (Simpan Sementara)</option>
                        </select>
                        @error('status')<p class="text-red-400 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>
                </div>

                <div>
                    <label class="block text-[10px] font-black uppercase tracking-widest text-gray-500 mb-2">Konten Artikel <span class="text-red-500">*</span></label>
                    <textarea name="content" rows="12" required
                        class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-sm text-white placeholder-gray-600 focus:border-red-500/50 focus:outline-none focus:ring-2 focus:ring-red-500/10 transition-all font-mono leading-relaxed"
                        placeholder="Tulis isi konten edukasi di sini... (Mendukung tag HTML dasar)"></textarea>
                    @error('content')<p class="text-red-400 text-xs mt-1">{{ $message }}</p>@enderror
                </div>
            </div>

            <div class="flex items-center justify-end gap-3">
                <a href="{{ route('admin.articles.index') }}" class="px-5 py-2.5 bg-white/5 hover:bg-white/10 border border-white/10 text-gray-300 font-bold text-sm rounded-xl transition-all">Batal</a>
                <button type="submit" class="px-5 py-2.5 bg-red-600 hover:bg-red-500 text-white font-black text-sm rounded-xl transition-all shadow-lg shadow-red-500/20">
                    Simpan Artikel
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
