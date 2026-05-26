<x-app-layout>
    <x-slot name="header">
        <h2 class="font-black text-3xl text-red-500 leading-tight tracking-tight">
            {{ __('Pusat Kontrol Admin') }}
        </h2>
    </x-slot>

    <div class="py-12 min-h-screen text-white bg-[#050B14]">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8 relative z-10">

            @if(session('success'))
                <div id="alert-success"
                    class="bg-emerald-500 text-black p-4 rounded-xl font-black text-xs uppercase mb-6 animate-pulse flex justify-between">
                    <span>{{ session('success') }}</span>
                    <button onclick="document.getElementById('alert-success').remove()">✕</button>
                </div>
            @endif

            <!-- Admin Overview Banner -->
            <div
                class="bg-white/5 border border-red-500/30 rounded-[2.5rem] shadow-2xl p-8 relative overflow-hidden group">
                <div
                    class="absolute -top-[50%] -left-[20%] w-[50%] h-[150%] rounded-full bg-red-900/10 blur-[120px] pointer-events-none">
                </div>
                <div class="flex items-center justify-between relative z-10">
                    <div>
                        <h3 class="text-3xl font-black mb-1 uppercase tracking-tighter">Sistem Administrasi EcoTrack
                        </h3>
                        <p class="text-red-400/80 text-sm font-semibold">// Otorisasi: Administrator Utama | Kelola
                            Permintaan Pengguna</p>
                    </div>
                    <div
                        class="w-16 h-16 bg-red-500/10 rounded-full flex items-center justify-center border border-red-500/30 text-red-500">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z">
                            </path>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Tabbed Control Panels -->
            <div class="bg-white/5 border border-white/10 rounded-[2.5rem] overflow-hidden shadow-2xl">
                <!-- Navigation -->
                <div class="flex flex-wrap border-b border-white/10 bg-white/5">
                    <button onclick="switchAdminTab('panel-pickups')" id="btn-panel-pickups"
                        class="admin-tab-btn px-8 py-5 text-sm font-black uppercase tracking-wider transition-colors border-b-2 border-red-500 text-red-500">
                        Kelola Penjemputan
                    </button>
                    <button onclick="switchAdminTab('panel-withdrawals')" id="btn-panel-withdrawals"
                        class="admin-tab-btn px-8 py-5 text-sm font-black uppercase tracking-wider transition-colors border-b-2 border-transparent text-gray-400 hover:text-white">
                        Kelola Penarikan
                    </button>
                    <button onclick="switchAdminTab('panel-reports')" id="btn-panel-reports"
                        class="admin-tab-btn px-8 py-5 text-sm font-black uppercase tracking-wider transition-colors border-b-2 border-transparent text-gray-400 hover:text-white">
                        Laporan Fasilitas
                    </button>
                    <button onclick="switchAdminTab('panel-deposits')" id="btn-panel-deposits"
                        class="admin-tab-btn px-8 py-5 text-sm font-black uppercase tracking-wider transition-colors border-b-2 border-transparent text-gray-400 hover:text-white">
                        Log Deposit Sistem
                    </button>
                </div>

                <!-- Content -->
                <div class="p-8">

                    <!-- Panel Pickups -->
                    <div id="panel-pickups" class="admin-tab-content block overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr
                                    class="border-b border-white/10 text-[10px] font-black uppercase tracking-widest text-red-400">
                                    <th class="pb-4 pr-4">User</th>
                                    <th class="pb-4 pr-4">Tanggal Diajukan</th>
                                    <th class="pb-4 pr-4">Rencana Jemput</th>
                                    <th class="pb-4 pr-4">Alamat Penjemputan</th>
                                    <th class="pb-4 pr-4 text-right">Berat Est. (Kg)</th>
                                    <th class="pb-4 pr-4 text-center">Status</th>
                                    <th class="pb-4 text-right">Tindakan</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-white/5">
                                @forelse($pickups as $pickup)
                                                            <tr class="hover:bg-white/5 transition-colors">
                                                                <td class="py-4 pr-4 text-sm font-bold text-white">
                                                                    {{ $pickup->user->name ?? 'Guest User' }}</td>
                                                                <td class="py-4 pr-4 text-sm text-gray-500 font-mono">
                                                                    {{ $pickup->created_at->format('Y-m-d') }}</td>
                                                                <td class="py-4 pr-4 text-sm text-gray-300 font-mono">
                                                                    {{ \Carbon\Carbon::parse($pickup->pickup_date)->format('Y-m-d') }}</td>
                                                                <td class="py-4 pr-4 text-sm text-gray-400 max-w-xs truncate"
                                                                    title="{{ $pickup->address }}">{{ $pickup->address }}</td>
                                                                <td class="py-4 pr-4 text-sm text-right font-bold text-white">
                                                                    {{ number_format($pickup->weight, 1, ',', '.') }}</td>
                                                                <td class="py-4 pr-4 text-center">
                                                                    <span class="px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-wider border {{ 
                                                                            match ($pickup->status) {
                                        'Pending' => 'bg-amber-500/20 text-amber-400 border-amber-500/30',
                                        'Scheduled' => 'bg-blue-500/20 text-blue-400 border-blue-500/30',
                                        'Completed' => 'bg-emerald-500/20 text-emerald-400 border-emerald-500/30',
                                        'Cancelled' => 'bg-red-500/20 text-red-400 border-red-500/30',
                                        default => 'bg-gray-500/20 text-gray-400 border-gray-500/30'
                                    }
                                                                        }}">
                                                                        {{ $pickup->status }}
                                                                    </span>
                                                                </td>
                                                                <td class="py-4 text-right text-sm">
                                                                    <div class="flex items-center justify-end gap-2">
                                                                        @if($pickup->status === 'Pending')
                                                                            <form action="{{ route('admin.pickups.status', $pickup->id) }}"
                                                                                method="POST">
                                                                                @csrf @method('PATCH')
                                                                                <input type="hidden" name="status" value="Scheduled">
                                                                                <button type="submit"
                                                                                    class="bg-blue-600 hover:bg-blue-500 text-white font-bold text-[10px] uppercase px-3 py-1 rounded transition-all">Jadwalkan</button>
                                                                            </form>
                                                                            <form action="{{ route('admin.pickups.status', $pickup->id) }}"
                                                                                method="POST">
                                                                                @csrf @method('PATCH')
                                                                                <input type="hidden" name="status" value="Cancelled">
                                                                                <button type="submit"
                                                                                    class="bg-red-900/50 hover:bg-red-800 text-red-400 border border-red-500/30 font-bold text-[10px] uppercase px-3 py-1 rounded transition-all">Batalkan</button>
                                                                            </form>
                                                                        @elseif($pickup->status === 'Scheduled')
                                                                            <form action="{{ route('admin.pickups.status', $pickup->id) }}"
                                                                                method="POST">
                                                                                @csrf @method('PATCH')
                                                                                <input type="hidden" name="status" value="Completed">
                                                                                <button type="submit"
                                                                                    class="bg-emerald-600 hover:bg-emerald-500 text-white font-bold text-[10px] uppercase px-3 py-1 rounded transition-all">Selesai</button>
                                                                            </form>
                                                                            <form action="{{ route('admin.pickups.status', $pickup->id) }}"
                                                                                method="POST">
                                                                                @csrf @method('PATCH')
                                                                                <input type="hidden" name="status" value="Cancelled">
                                                                                <button type="submit"
                                                                                    class="bg-red-900/50 hover:bg-red-800 text-red-400 border border-red-500/30 font-bold text-[10px] uppercase px-3 py-1 rounded transition-all">Batalkan</button>
                                                                            </form>
                                                                        @else
                                                                            <span class="text-gray-500 italic text-xs">No actions</span>
                                                                        @endif
                                                                    </div>
                                                                </td>
                                                            </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="py-8 text-center text-gray-500 text-sm">Tidak ada permintaan
                                            penjemputan sampah.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Panel Withdrawals -->
                    <div id="panel-withdrawals" class="admin-tab-content hidden overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr
                                    class="border-b border-white/10 text-[10px] font-black uppercase tracking-widest text-red-400">
                                    <th class="pb-4 pr-4">User</th>
                                    <th class="pb-4 pr-4">Tanggal Pengajuan</th>
                                    <th class="pb-4 pr-4">Metode</th>
                                    <th class="pb-4 pr-4 text-right">Jumlah Poin</th>
                                    <th class="pb-4 pr-4 text-center">Status</th>
                                    <th class="pb-4 text-right">Tindakan</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-white/5">
                                @forelse($withdrawals as $withdraw)
                                                            <tr class="hover:bg-white/5 transition-colors">
                                                                <td class="py-4 pr-4 text-sm font-bold text-white">
                                                                    {{ $withdraw->user->name ?? 'Guest User' }}</td>
                                                                <td class="py-4 pr-4 text-sm text-gray-500 font-mono">
                                                                    {{ $withdraw->created_at->format('Y-m-d H:i') }}</td>
                                                                <td class="py-4 pr-4 text-sm text-gray-300">{{ $withdraw->method }}</td>
                                                                <td class="py-4 pr-4 text-sm text-right font-black text-emerald-400">
                                                                    {{ number_format($withdraw->amount, 0, ',', '.') }} PTS</td>
                                                                <td class="py-4 pr-4 text-center">
                                                                    <span class="px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-wider border {{ 
                                                                            match ($withdraw->status) {
                                        'Pending' => 'bg-amber-500/20 text-amber-400 border-amber-500/30',
                                        'Completed' => 'bg-emerald-500/20 text-emerald-400 border-emerald-500/30',
                                        'Rejected' => 'bg-red-500/20 text-red-400 border-red-500/30',
                                        default => 'bg-gray-500/20 text-gray-400 border-gray-500/30'
                                    }
                                                                        }}">
                                                                        {{ $withdraw->status }}
                                                                    </span>
                                                                </td>
                                                                <td class="py-4 text-right text-sm">
                                                                    <div class="flex items-center justify-end gap-2">
                                                                        @if($withdraw->status === 'Pending')
                                                                            <form action="{{ route('admin.withdraws.status', $withdraw->id) }}"
                                                                                method="POST">
                                                                                @csrf @method('PATCH')
                                                                                <input type="hidden" name="status" value="Completed">
                                                                                <button type="submit"
                                                                                    class="bg-emerald-600 hover:bg-emerald-500 text-white font-bold text-[10px] uppercase px-3 py-1 rounded transition-all">Selesaikan</button>
                                                                            </form>
                                                                            <form action="{{ route('admin.withdraws.status', $withdraw->id) }}"
                                                                                method="POST">
                                                                                @csrf @method('PATCH')
                                                                                <input type="hidden" name="status" value="Rejected">
                                                                                <button type="submit"
                                                                                    class="bg-red-900/50 hover:bg-red-800 text-red-400 border border-red-500/30 font-bold text-[10px] uppercase px-3 py-1 rounded transition-all">Tolak
                                                                                    & Refund</button>
                                                                            </form>
                                                                        @else
                                                                            <span class="text-gray-500 italic text-xs">No actions</span>
                                                                        @endif
                                                                    </div>
                                                                </td>
                                                            </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="py-8 text-center text-gray-500 text-sm">Tidak ada permintaan
                                            penarikan saldo poin.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Panel Reports -->
                    <div id="panel-reports" class="admin-tab-content hidden overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr
                                    class="border-b border-white/10 text-[10px] font-black uppercase tracking-widest text-red-400">
                                    <th class="pb-4 pr-4">User</th>
                                    <th class="pb-4 pr-4">Tanggal Laporan</th>
                                    <th class="pb-4 pr-4">Lokasi Bank Sampah</th>
                                    <th class="pb-4 pr-4">Deskripsi Masalah</th>
                                    <th class="pb-4 pr-4">Foto Bukti</th>
                                    <th class="pb-4 pr-4 text-center">Status</th>
                                    <th class="pb-4 text-right">Tindakan</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-white/5">
                                @forelse($reports as $report)
                                                            <tr class="hover:bg-white/5 transition-colors">
                                                                <td class="py-4 pr-4 text-sm font-bold text-white">{{ $report->user_name }}</td>
                                                                <td class="py-4 pr-4 text-sm text-gray-500 font-mono">
                                                                    {{ $report->created_at->format('Y-m-d') }}</td>
                                                                <td class="py-4 pr-4 text-sm text-white font-bold">{{ $report->location }}</td>
                                                                <td class="py-4 pr-4 text-sm text-gray-400 max-w-xs truncate"
                                                                    title="{{ $report->description }}">{{ $report->description }}</td>
                                                                <td class="py-4 pr-4 text-sm">
                                                                    @if($report->photo)
                                                                        <a href="{{ route('photo.viewer', ['url' => asset('storage/' . $report->photo)]) }}"
                                                                            class="text-red-400 hover:text-red-300 hover:underline font-bold text-xs uppercase tracking-wider flex items-center gap-1">
                                                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                                                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                                                                </path>
                                                                            </svg>
                                                                            Lihat Foto
                                                                        </a>
                                                                    @else
                                                                        <span class="text-gray-500">Tidak ada</span>
                                                                    @endif
                                                                </td>
                                                                <td class="py-4 pr-4 text-center">
                                                                    <span class="px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-wider border {{ 
                                                                            match ($report->status) {
                                        'pending' => 'bg-amber-500/20 text-amber-400 border-amber-500/30',
                                        'process' => 'bg-blue-500/20 text-blue-400 border-blue-500/30',
                                        'resolved' => 'bg-emerald-500/20 text-emerald-400 border-emerald-500/30',
                                        default => 'bg-gray-500/20 text-gray-400 border-gray-500/30'
                                    }
                                                                        }}">
                                                                        {{ $report->status }}
                                                                    </span>
                                                                </td>
                                                                <td class="py-4 text-right text-sm">
                                                                    <div class="flex items-center justify-end gap-2">
                                                                        @if($report->status === 'pending')
                                                                            <form action="{{ route('admin.reports.status', $report->id) }}"
                                                                                method="POST">
                                                                                @csrf @method('PATCH')
                                                                                <input type="hidden" name="status" value="process">
                                                                                <button type="submit"
                                                                                    class="bg-blue-600 hover:bg-blue-500 text-white font-bold text-[10px] uppercase px-3 py-1 rounded transition-all">Proses</button>
                                                                            </form>
                                                                            <form action="{{ route('admin.reports.status', $report->id) }}"
                                                                                method="POST">
                                                                                @csrf @method('PATCH')
                                                                                <input type="hidden" name="status" value="resolved">
                                                                                <button type="submit"
                                                                                    class="bg-emerald-600 hover:bg-emerald-500 text-white font-bold text-[10px] uppercase px-3 py-1 rounded transition-all">Selesaikan</button>
                                                                            </form>
                                                                        @elseif($report->status === 'process')
                                                                            <form action="{{ route('admin.reports.status', $report->id) }}"
                                                                                method="POST">
                                                                                @csrf @method('PATCH')
                                                                                <input type="hidden" name="status" value="resolved">
                                                                                <button type="submit"
                                                                                    class="bg-emerald-600 hover:bg-emerald-500 text-white font-bold text-[10px] uppercase px-3 py-1 rounded transition-all">Selesaikan</button>
                                                                            </form>
                                                                        @else
                                                                            <span class="text-gray-500 italic text-xs">No actions</span>
                                                                        @endif
                                                                    </div>
                                                                </td>
                                                            </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="py-8 text-center text-gray-500 text-sm">Tidak ada laporan
                                            fasilitas bank sampah.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Panel Deposits -->
                    <div id="panel-deposits" class="admin-tab-content hidden overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr
                                    class="border-b border-white/10 text-[10px] font-black uppercase tracking-widest text-red-400">
                                    <th class="pb-4 pr-4">User</th>
                                    <th class="pb-4 pr-4">Tanggal Deposit</th>
                                    <th class="pb-4 pr-4">Nama Barang</th>
                                    <th class="pb-4 pr-4">Security QR</th>
                                    <th class="pb-4 pr-4 text-right">Berat (Kg)</th>
                                    <th class="pb-4 pr-4 text-right">Poin Diberikan</th>
                                    <th class="pb-4 pr-4 text-center">Status</th>
                                    <th class="pb-4 text-right">Tindakan</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-white/5">
                                @forelse($deposits as $deposit)
                                                            <tr class="hover:bg-white/5 transition-colors">
                                                                <td class="py-4 pr-4 text-sm font-bold text-white">
                                                                    {{ $deposit->user->name ?? 'Guest User' }}</td>
                                                                <td class="py-4 pr-4 text-sm text-gray-500 font-mono">
                                                                    {{ $deposit->created_at->format('Y-m-d H:i') }}</td>
                                                                <td class="py-4 pr-4 text-sm font-black uppercase tracking-tight text-white">
                                                                    {{ $deposit->item_name }}</td>
                                                                <td class="py-4 pr-4 text-sm text-gray-500 font-mono">{{ $deposit->qr_code }}</td>
                                                                <td class="py-4 pr-4 text-sm text-right font-bold text-white">
                                                                    {{ number_format($deposit->weight, 1, ',', '.') }}</td>
                                                                <td class="py-4 pr-4 text-sm text-right font-black text-emerald-400">
                                                                    +{{ number_format($deposit->points, 0, ',', '.') }}</td>
                                                                <td class="py-4 pr-4 text-center">
                                                                    <span class="px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-wider border {{ 
                                                                            match ($deposit->status) {
                                        'Pending' => 'bg-amber-500/20 text-amber-400 border-amber-500/30',
                                        'AI Optimized' => 'bg-blue-500/20 text-blue-400 border-blue-500/30',
                                        'Verified' => 'bg-indigo-500/20 text-indigo-400 border-indigo-500/30',
                                        'Completed' => 'bg-emerald-500/20 text-emerald-400 border-emerald-500/30',
                                        'Rejected' => 'bg-red-500/20 text-red-400 border-red-500/30',
                                        default => 'bg-gray-500/20 text-gray-400 border-gray-500/30'
                                    }
                                                                        }}">
                                                                        {{ $deposit->status }}
                                                                    </span>
                                                                </td>
                                                                <td class="py-4 text-right text-sm">
                                                                    <div class="flex items-center justify-end gap-2">
                                                                        <form action="{{ route('admin.deposits.status', $deposit->id) }}"
                                                                            method="POST">
                                                                            @csrf @method('PATCH')
                                                                            <select name="status" onchange="this.form.submit()"
                                                                                class="bg-[#050B14] text-xs font-bold uppercase tracking-wider text-white border border-white/10 rounded p-1 outline-none focus:border-red-500">
                                                                                <option value="Pending" {{ $deposit->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                                                                                <option value="AI Optimized" {{ $deposit->status == 'AI Optimized' ? 'selected' : '' }}>AI Optimized</option>
                                                                                <option value="Verified" {{ $deposit->status == 'Verified' ? 'selected' : '' }}>Verified</option>
                                                                                <option value="Completed" {{ $deposit->status == 'Completed' ? 'selected' : '' }}>Completed</option>
                                                                                <option value="Rejected" {{ $deposit->status == 'Rejected' ? 'selected' : '' }}>Rejected</option>
                                                                            </select>
                                                                        </form>
                                                                        <form action="{{ route('ecotrack.destroy.auth', $deposit->id) }}"
                                                                            method="POST"
                                                                            onsubmit="return confirm('Apakah Anda yakin ingin menghapus data deposit ini?')"
                                                                            class="inline-block ml-2">
                                                                            @csrf @method('DELETE')
                                                                            <button type="submit"
                                                                                class="text-red-500 hover:text-red-400 font-black text-[10px] uppercase italic transition-colors">
                                                                                Hapus Log
                                                                            </button>
                                                                        </form>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="py-8 text-center text-gray-500 text-sm">Tidak ada data
                                            deposit terdaftar di sistem.</td>
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
        function switchAdminTab(panelId) {
            // Hide all tab contents
            const contents = document.querySelectorAll('.admin-tab-content');
            contents.forEach(content => {
                content.classList.add('hidden');
                content.classList.remove('block');
            });

            // Show current tab content
            const activeContent = document.getElementById(panelId);
            activeContent.classList.remove('hidden');
            activeContent.classList.add('block');

            // Reset active button styling
            const buttons = document.querySelectorAll('.admin-tab-btn');
            buttons.forEach(button => {
                button.classList.remove('border-red-500', 'text-red-500');
                button.classList.add('border-transparent', 'text-gray-400');
            });

            // Set current button active styling
            const activeButton = document.getElementById('btn-' + panelId);
            activeButton.classList.remove('border-transparent', 'text-gray-400');
            activeButton.classList.add('border-red-500', 'text-red-500');
        }
    </script>
</x-app-layout>