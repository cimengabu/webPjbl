<x-app-layout>
    <x-slot name="header">
        <h2 class="font-black text-3xl text-emerald-400 leading-tight tracking-tight">
            {{ __('Dashboard Utama') }}
        </h2>
    </x-slot>

    <div class="py-12 min-h-screen text-white relative bg-[#050B14]">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8 relative z-10">

            <!-- Welcome Section -->
            <div class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-[2.5rem] shadow-2xl overflow-hidden text-white group hover:border-emerald-500/30 transition-all duration-500">
                <div class="bg-gradient-to-r from-emerald-900/50 via-teal-900/30 to-slate-900/50 h-full relative">
                    <div class="absolute inset-0 opacity-10" style="background-image: radial-gradient(circle at 2px 2px, white 1px, transparent 0); background-size: 20px 20px;"></div>
                    <div class="p-10 relative z-10 flex items-center justify-between">
                        <div>
                            <h3 class="text-4xl font-black mb-2 tracking-tight">Selamat Datang, {{ explode(' ', Auth::user()->name)[0] }}! <span class="text-emerald-400">🌿</span></h3>
                            <p class="text-emerald-100/70 text-lg font-medium">Ini adalah pusat kendali aktivitas pelestarian lingkungan Anda.</p>
                        </div>
                        <div class="hidden sm:block">
                            <div class="w-24 h-24 bg-emerald-500/10 rounded-full flex items-center justify-center shadow-[0_0_30px_rgba(16,185,129,0.2)] group-hover:scale-105 transition-transform">
                                <svg class="w-12 h-12 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Stats Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Points -->
                <div class="bg-white/5 backdrop-blur-xl rounded-[2rem] border border-white/10 p-6 flex items-center hover:border-emerald-500/30 hover:bg-emerald-500/5 transition-all group">
                    <div class="rounded-xl bg-emerald-500/20 border border-emerald-500/30 p-4 mr-6 group-hover:scale-105 transition-transform shrink-0">
                        <svg class="w-8 h-8 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <div>
                        <p class="text-[10px] font-black text-gray-500 uppercase tracking-widest mb-1">Total Poin Anda</p>
                        <p class="text-2xl font-black text-white">{{ number_format(Auth::user()->total_points ?? 0, 0, ',', '.') }} <span class="text-xs font-bold text-emerald-500 uppercase tracking-widest">Pts</span></p>
                    </div>
                </div>

                <!-- Weight -->
                <div class="bg-white/5 backdrop-blur-xl rounded-[2rem] border border-white/10 p-6 flex items-center hover:border-blue-500/30 hover:bg-blue-500/5 transition-all group">
                    <div class="rounded-xl bg-blue-500/20 border border-blue-500/30 p-4 mr-6 group-hover:scale-105 transition-transform shrink-0">
                        <svg class="w-8 h-8 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3"></path></svg>
                    </div>
                    <div>
                        <p class="text-[10px] font-black text-gray-500 uppercase tracking-widest mb-1">Total Sampah Didaur Ulang</p>
                        <p class="text-2xl font-black text-white">{{ number_format($totalWeight, 1, ',', '.') }} <span class="text-xs font-bold text-blue-500 uppercase tracking-widest">Kg</span></p>
                    </div>
                </div>

                <!-- Carbon Offset -->
                <div class="bg-white/5 backdrop-blur-xl rounded-[2rem] border border-white/10 p-6 flex items-center hover:border-teal-500/30 hover:bg-teal-500/5 transition-all group">
                    <div class="rounded-xl bg-teal-500/20 border border-teal-500/30 p-4 mr-6 group-hover:scale-105 transition-transform shrink-0">
                        <svg class="w-8 h-8 text-teal-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path></svg>
                    </div>
                    <div>
                        <p class="text-[10px] font-black text-gray-500 uppercase tracking-widest mb-1">Estimasi CO₂ Dikurangi</p>
                        <p class="text-2xl font-black text-white">{{ number_format($carbonSaved, 1, ',', '.') }} <span class="text-xs font-bold text-teal-500 uppercase tracking-widest">Kg CO₂</span></p>
                    </div>
                </div>

                <!-- Streak -->
                <div class="bg-white/5 backdrop-blur-xl rounded-[2rem] border border-white/10 p-6 flex items-center hover:border-amber-500/30 hover:bg-amber-500/5 transition-all group">
                    <div class="rounded-xl bg-amber-500/20 border border-amber-500/30 p-4 mr-6 group-hover:scale-105 transition-transform shrink-0">
                        <svg class="w-8 h-8 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 18.657A8 8 0 016.343 7.343S7 9 9 10c0-2 .5-5 2.986-7C14 5 16.09 5.777 17.656 7.343A7.975 7.975 0 0120 13a7.975 7.975 0 01-2.343 5.657z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.879 16.121A3 3 0 1012.015 11L11 14H9c0 .768.293 1.536.879 2.121z"></path></svg>
                    </div>
                    <div>
                        <p class="text-[10px] font-black text-gray-500 uppercase tracking-widest mb-1">Keaktifan Harian</p>
                        <p class="text-2xl font-black text-white">{{ $streak }} <span class="text-xs font-bold text-amber-500 uppercase tracking-widest">Hari 🔥</span></p>
                    </div>
                </div>
            </div>

            <!-- Tabbed Activity Logs -->
            <div class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-[2.5rem] overflow-hidden shadow-2xl">
                <!-- Tabs Navigation -->
                <div class="flex flex-wrap border-b border-white/10 bg-white/5">
                    <button onclick="switchTab('tab-deposits')" id="btn-tab-deposits" class="tab-btn px-8 py-5 text-sm font-black uppercase tracking-wider transition-colors border-b-2 border-emerald-500 text-emerald-400">
                        Aktivitas Deposit
                    </button>
                    <button onclick="switchTab('tab-pickups')" id="btn-tab-pickups" class="tab-btn px-8 py-5 text-sm font-black uppercase tracking-wider transition-colors border-b-2 border-transparent text-gray-400 hover:text-white">
                        Jadwal Penjemputan
                    </button>
                    <button onclick="switchTab('tab-withdrawals')" id="btn-tab-withdrawals" class="tab-btn px-8 py-5 text-sm font-black uppercase tracking-wider transition-colors border-b-2 border-transparent text-gray-400 hover:text-white">
                        Penarikan Poin
                    </button>
                    <button onclick="switchTab('tab-reports')" id="btn-tab-reports" class="tab-btn px-8 py-5 text-sm font-black uppercase tracking-wider transition-colors border-b-2 border-transparent text-gray-400 hover:text-white">
                        Laporan Saya
                    </button>
                </div>

                <!-- Tabs Content -->
                <div class="p-8">
                    <!-- Tab Deposits -->
                    <div id="tab-deposits" class="tab-content block overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="border-b border-white/10 text-[10px] font-black uppercase tracking-widest text-emerald-400">
                                    <th class="pb-4 pr-4">Tanggal</th>
                                    <th class="pb-4 pr-4">Nama Barang</th>
                                    <th class="pb-4 pr-4">Security QR</th>
                                    <th class="pb-4 pr-4 text-right">Berat (Kg)</th>
                                    <th class="pb-4 text-right">Poin</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-white/5">
                                @forelse($deposits as $deposit)
                                    <tr class="hover:bg-white/5 transition-colors">
                                        <td class="py-4 pr-4 text-sm text-gray-400 font-mono">{{ $deposit->created_at->format('Y-m-d H:i') }}</td>
                                        <td class="py-4 pr-4 text-sm font-black uppercase tracking-tight text-white">{{ $deposit->item_name }}</td>
                                        <td class="py-4 pr-4 text-sm text-gray-500 font-mono">{{ $deposit->qr_code }}</td>
                                        <td class="py-4 pr-4 text-sm text-right font-bold text-white">{{ number_format($deposit->weight, 1, ',', '.') }}</td>
                                        <td class="py-4 text-sm text-right font-black text-emerald-400">+{{ number_format($deposit->points, 0, ',', '.') }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="py-8 text-center text-gray-500 text-sm">Belum ada aktivitas deposit sampah.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Tab Pickups -->
                    <div id="tab-pickups" class="tab-content hidden overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="border-b border-white/10 text-[10px] font-black uppercase tracking-widest text-blue-400">
                                    <th class="pb-4 pr-4">Tanggal Diajukan</th>
                                    <th class="pb-4 pr-4">Rencana Penjemputan</th>
                                    <th class="pb-4 pr-4">Alamat Penjemputan</th>
                                    <th class="pb-4 pr-4 text-right">Berat Est. (Kg)</th>
                                    <th class="pb-4 text-center">Status</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-white/5">
                                @forelse($pickups as $pickup)
                                    <tr class="hover:bg-white/5 transition-colors">
                                        <td class="py-4 pr-4 text-sm text-gray-400 font-mono">{{ $pickup->created_at->format('Y-m-d') }}</td>
                                        <td class="py-4 pr-4 text-sm font-bold text-white font-mono">{{ \Carbon\Carbon::parse($pickup->pickup_date)->format('Y-m-d') }}</td>
                                        <td class="py-4 pr-4 text-sm text-gray-400 max-w-xs truncate" title="{{ $pickup->address }}">{{ $pickup->address }}</td>
                                        <td class="py-4 pr-4 text-sm text-right font-bold text-white">{{ number_format($pickup->weight, 1, ',', '.') }}</td>
                                        <td class="py-4 text-center">
                                            @php
                                                $badgeClass = match($pickup->status) {
                                                    'Pending' => 'bg-amber-500/20 text-amber-400 border-amber-500/30',
                                                    'Scheduled' => 'bg-blue-500/20 text-blue-400 border-blue-500/30',
                                                    'Completed' => 'bg-emerald-500/20 text-emerald-400 border-emerald-500/30',
                                                    'Cancelled' => 'bg-red-500/20 text-red-400 border-red-500/30',
                                                    default => 'bg-gray-500/20 text-gray-400 border-gray-500/30',
                                                };
                                            @endphp
                                            <span class="px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-wider border {{ $badgeClass }}">
                                                {{ $pickup->status }}
                                            </span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="py-8 text-center text-gray-500 text-sm">Belum ada pengajuan penjemputan sampah.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Tab Withdrawals -->
                    <div id="tab-withdrawals" class="tab-content hidden overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="border-b border-white/10 text-[10px] font-black uppercase tracking-widest text-emerald-400">
                                    <th class="pb-4 pr-4">Tanggal Pengajuan</th>
                                    <th class="pb-4 pr-4">Metode (Rekening)</th>
                                    <th class="pb-4 pr-4 text-right">Nominal (Rp)</th>
                                    <th class="pb-4 text-center">Status</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-white/5">
                                @forelse($withdrawals as $withdraw)
                                    <tr class="hover:bg-white/5 transition-colors">
                                        <td class="py-4 pr-4 text-sm text-gray-400 font-mono">{{ $withdraw->created_at->format('Y-m-d H:i') }}</td>
                                        <td class="py-4 pr-4 text-sm font-bold text-white">
                                            {{ $withdraw->method }} 
                                            @if($withdraw->account_number)
                                                <span class="text-xs text-gray-400 block font-normal">{{ $withdraw->account_number }} a/n {{ $withdraw->account_name }}</span>
                                            @endif
                                        </td>
                                        <td class="py-4 pr-4 text-sm text-right font-black text-emerald-400">
                                            Rp {{ number_format($withdraw->amount_rp ?? (($withdraw->amount/10)*1000), 0, ',', '.') }}
                                            <span class="block text-[10px] text-gray-500 font-normal">({{ number_format($withdraw->amount, 0, ',', '.') }} PTS)</span>
                                        </td>
                                        <td class="py-4 text-center">
                                            @php
                                                $badgeClass = match($withdraw->status) {
                                                    'Pending' => 'bg-amber-500/20 text-amber-400 border-amber-500/30',
                                                    'Completed' => 'bg-emerald-500/20 text-emerald-400 border-emerald-500/30',
                                                    'Rejected' => 'bg-red-500/20 text-red-400 border-red-500/30',
                                                    default => 'bg-gray-500/20 text-gray-400 border-gray-500/30',
                                                };
                                            @endphp
                                            <span class="px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-wider border {{ $badgeClass }}">
                                                {{ $withdraw->status }}
                                            </span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="py-8 text-center text-gray-500 text-sm">Belum ada riwayat penarikan saldo poin.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Tab Reports -->
                    <div id="tab-reports" class="tab-content hidden overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="border-b border-white/10 text-[10px] font-black uppercase tracking-widest text-red-400">
                                    <th class="pb-4 pr-4">Tanggal Laporan</th>
                                    <th class="pb-4 pr-4">Lokasi Bank Sampah</th>
                                    <th class="pb-4 pr-4">Deskripsi Laporan</th>
                                    <th class="pb-4 pr-4">Foto Bukti</th>
                                    <th class="pb-4 text-center">Status</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-white/5">
                                @forelse($reports as $report)
                                    <tr class="hover:bg-white/5 transition-colors">
                                        <td class="py-4 pr-4 text-sm text-gray-400 font-mono">{{ $report->created_at->format('Y-m-d') }}</td>
                                        <td class="py-4 pr-4 text-sm font-bold text-white">{{ $report->location }}</td>
                                        <td class="py-4 pr-4 text-sm text-gray-400 max-w-xs truncate" title="{{ $report->description }}">{{ $report->description }}</td>
                                        <td class="py-4 pr-4 text-sm">
                                            @if($report->photo)
                                                <a href="{{ route('photo.viewer', ['url' => asset('storage/' . $report->photo)]) }}" class="text-blue-400 hover:text-blue-300 hover:underline font-bold text-xs uppercase tracking-wider flex items-center gap-1">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                                    Lihat Foto
                                                </a>
                                            @else
                                                <span class="text-gray-500">Tidak ada</span>
                                            @endif
                                        </td>
                                        <td class="py-4 text-center">
                                            @php
                                                $badgeClass = match($report->status) {
                                                    'pending' => 'bg-amber-500/20 text-amber-400 border-amber-500/30',
                                                    'process' => 'bg-blue-500/20 text-blue-400 border-blue-500/30',
                                                    'resolved' => 'bg-emerald-500/20 text-emerald-400 border-emerald-500/30',
                                                    default => 'bg-gray-500/20 text-gray-400 border-gray-500/30',
                                                };
                                            @endphp
                                            <span class="px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-wider border {{ $badgeClass }}">
                                                {{ $report->status }}
                                            </span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="py-8 text-center text-gray-500 text-sm">Belum ada laporan kendala fasilitas bank sampah.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <script>
        function switchTab(panelId) {
            // Hide all tab contents
            const contents = document.querySelectorAll('.tab-content');
            contents.forEach(content => {
                content.classList.add('hidden');
                content.classList.remove('block');
            });

            // Show current tab content
            const activeContent = document.getElementById(panelId);
            activeContent.classList.remove('hidden');
            activeContent.classList.add('block');

            // Reset active button styling
            const buttons = document.querySelectorAll('.tab-btn');
            buttons.forEach(button => {
                button.classList.remove('border-emerald-500', 'text-emerald-400', 'bg-white/5');
                button.classList.add('border-transparent', 'text-gray-400');
            });

            // Set current button active styling
            const activeButton = document.getElementById('btn-' + panelId);
            activeButton.classList.remove('border-transparent', 'text-gray-400');
            activeButton.classList.add('border-emerald-500', 'text-emerald-400', 'bg-white/5');
        }
    </script>
</x-app-layout>
