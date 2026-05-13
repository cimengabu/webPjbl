<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-gray-800 leading-tight">
            {{ __('Dashboard Utama') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">

            <!-- Welcome Section -->
            <div class="bg-gradient-to-r from-emerald-500 to-teal-600 rounded-2xl shadow-xl overflow-hidden text-white">
                <div class="p-8 sm:p-10 flex items-center justify-between">
                    <div>
                        <h3 class="text-3xl font-bold mb-2">Selamat Datang, {{ Auth::user()->name }}! 🌿</h3>
                        <p class="text-emerald-100 text-lg">Siap untuk membuat dampak positif hari ini?</p>
                    </div>
                    <div class="hidden sm:block">
                        <svg class="w-24 h-24 text-white opacity-20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                </div>
            </div>

            <!-- Ringkasan Aktivitas -->
            <div>
                <h4 class="text-xl font-bold text-gray-800 mb-4 flex items-center gap-2">
                    <svg class="w-6 h-6 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                    Ringkasan Aktivitas
                </h4>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Points -->
                    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 flex items-center hover:shadow-md transition-shadow">
                        <div class="rounded-full bg-emerald-100 p-4 mr-6">
                            <svg class="w-8 h-8 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500 mb-1">Total Poin Terkumpul</p>
                            <p class="text-3xl font-bold text-gray-800">1,250 <span class="text-lg font-medium text-emerald-500">Pts</span></p>
                        </div>
                    </div>
                    <!-- Streak -->
                    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 flex items-center hover:shadow-md transition-shadow">
                        <div class="rounded-full bg-amber-100 p-4 mr-6">
                            <svg class="w-8 h-8 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 18.657A8 8 0 016.343 7.343S7 9 9 10c0-2 .5-5 2.986-7C14 5 16.09 5.777 17.656 7.343A7.975 7.975 0 0120 13a7.975 7.975 0 01-2.343 5.657z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.879 16.121A3 3 0 1012.015 11L11 14H9c0 .768.293 1.536.879 2.121z"></path></svg>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500 mb-1">Keaktifan Harian (Streak)</p>
                            <p class="text-3xl font-bold text-gray-800">5 <span class="text-lg font-medium text-amber-500">Hari🔥</span></p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Preview Fitur Utama -->
            <div>
                <h4 class="text-xl font-bold text-gray-800 mb-4 flex items-center gap-2">
                    <svg class="w-6 h-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                    Akses Cepat
                </h4>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Penjemputan Sampah -->
                    <a href="#" class="group block bg-white rounded-xl shadow-sm border border-gray-100 p-6 hover:shadow-lg hover:border-emerald-200 transition-all duration-300 transform hover:-translate-y-1">
                        <div class="flex items-start justify-between">
                            <div>
                                <div class="bg-emerald-100 text-emerald-600 rounded-lg p-3 inline-block mb-4 group-hover:bg-emerald-500 group-hover:text-white transition-colors">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"></path></svg>
                                </div>
                                <h5 class="text-lg font-bold text-gray-800 mb-2">Penjemputan Sampah</h5>
                                <p class="text-gray-500 text-sm">Jadwalkan penjemputan sampah daur ulang Anda langsung dari rumah.</p>
                            </div>
                            <svg class="w-6 h-6 text-gray-300 group-hover:text-emerald-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                        </div>
                    </a>

                    <!-- Pencarian Lokasi -->
                    <a href="{{ route('recycling-centers.index') }}" class="group block bg-white rounded-xl shadow-sm border border-gray-100 p-6 hover:shadow-lg hover:border-blue-200 transition-all duration-300 transform hover:-translate-y-1">
                        <div class="flex items-start justify-between">
                            <div>
                                <div class="bg-blue-100 text-blue-600 rounded-lg p-3 inline-block mb-4 group-hover:bg-blue-500 group-hover:text-white transition-colors">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                </div>
                                <h5 class="text-lg font-bold text-gray-800 mb-2">Pencarian Lokasi Drop-off</h5>
                                <p class="text-gray-500 text-sm">Temukan bank sampah atau titik kumpul daur ulang terdekat di area Anda.</p>
                            </div>
                            <svg class="w-6 h-6 text-gray-300 group-hover:text-blue-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                        </div>
                    </a>
                </div>
            </div>

            <!-- Edukasi Singkat -->
            <div>
                <h4 class="text-xl font-bold text-gray-800 mb-4 flex items-center gap-2">
                    <svg class="w-6 h-6 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                    Edukasi Lingkungan
                </h4>
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden flex flex-col md:flex-row hover:shadow-md transition-shadow">
                    <div class="md:w-1/3 bg-gray-200 relative h-48 md:h-auto">
                        <!-- Placeholder for image, using gradient and icon for now -->
                        <div class="absolute inset-0 bg-gradient-to-br from-green-400 to-blue-500 opacity-90"></div>
                        <div class="absolute inset-0 flex items-center justify-center text-white">
                            <svg class="w-16 h-16 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        </div>
                    </div>
                    <div class="p-6 md:w-2/3 flex flex-col justify-center">
                        <span class="text-xs font-bold text-indigo-500 uppercase tracking-wider mb-2">Artikel Terbaru</span>
                        <h5 class="text-xl font-bold text-gray-800 mb-3">5 Cara Mudah Mengurangi Sampah Plastik di Rumah</h5>
                        <p class="text-gray-600 text-sm mb-4 line-clamp-2">Langkah kecil di rumah bisa berdampak besar bagi bumi. Mulai dari mengganti botol minum hingga cara memilah sampah yang benar. Pelajari tips praktis yang bisa Anda terapkan mulai hari ini.</p>
                        <a href="#" class="text-emerald-600 font-medium text-sm flex items-center hover:text-emerald-700 transition-colors">
                            Baca Selengkapnya
                            <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
