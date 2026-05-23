<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lihat Foto Laporan</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#050B14] text-white min-h-screen flex flex-col font-sans">
    <div class="p-4 border-b border-white/10 flex items-center bg-[#050B14]">
        <button onclick="goBack()" class="inline-flex items-center gap-2 px-6 py-2 rounded-full bg-white/10 hover:bg-white/20 text-white font-bold text-sm uppercase tracking-widest transition-colors cursor-pointer">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Kembali
        </button>
        <h1 class="ml-4 font-black italic text-gray-500 uppercase tracking-widest text-xs">Photo Viewer</h1>
    </div>
    <div class="flex-1 flex items-center justify-center p-8 relative overflow-hidden">
        <!-- Background elements -->
        <div class="absolute -top-[50%] -left-[20%] w-[50%] h-[150%] rounded-full bg-emerald-900/10 blur-[120px] pointer-events-none"></div>
        <div class="absolute top-[20%] -right-[20%] w-[50%] h-[150%] rounded-full bg-blue-900/10 blur-[120px] pointer-events-none"></div>
        
        <div class="relative z-10 w-full max-w-5xl h-full flex items-center justify-center">
            @if(request('url'))
                <img src="{{ request('url') }}" alt="Laporan Foto" class="max-w-full max-h-[85vh] rounded-xl object-contain shadow-[0_0_50px_rgba(16,185,129,0.15)] border border-white/10">
            @else
                <p class="text-gray-500 font-bold uppercase tracking-widest">URL Gambar Tidak Ditemukan</p>
            @endif
        </div>
    </div>

    <script>
        function goBack() {
            // Jika ada riwayat browser, balik ke halaman sebelumnya
            if (document.referrer && document.referrer !== window.location.href) {
                window.history.back();
            } else {
                // Fallback: arahkan ke dashboard
                window.location.href = '{{ url()->previous() !== url()->current() ? url()->previous() : route("dashboard") }}';
            }
        }
    </script>
</body>
</html>
