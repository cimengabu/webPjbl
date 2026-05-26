<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-4">
            <x-back-button fallback="{{ route('dashboard') }}" />
            <h2 class="font-black text-3xl text-emerald-400 leading-tight tracking-tight">
                {{ __('Profil & Pencapaian') }}
            </h2>
        </div>
    </x-slot>

    <!-- Dark Theme Background matching Dashboard -->
    <div class="py-12 bg-[#050B14] min-h-screen relative text-white selection:bg-emerald-500 selection:text-white">
        <!-- Decorative blobs -->
        <div class="absolute top-0 left-0 w-full h-full overflow-hidden pointer-events-none z-0 opacity-30">
            <div class="absolute -top-[10%] -left-[10%] w-[40%] h-[40%] rounded-full bg-emerald-900/50 blur-[100px]"></div>
            <div class="absolute top-[40%] -right-[10%] w-[30%] h-[50%] rounded-full bg-blue-900/40 blur-[120px]"></div>
        </div>

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8 relative z-10">

            <!-- Profile Header Card -->
            <div class="bg-white/5 backdrop-blur-xl rounded-[2.5rem] shadow-2xl border border-white/10 overflow-hidden group hover:border-emerald-500/30 transition-all duration-500">
                <div class="bg-gradient-to-r from-emerald-900 via-teal-900 to-slate-900 h-40 relative overflow-hidden">
                    @if($user->background_photo_path)
                        <img src="{{ asset('storage/' . $user->background_photo_path) }}" alt="Background" class="absolute inset-0 w-full h-full object-cover opacity-50 mix-blend-overlay">
                    @endif
                    <div class="absolute inset-0 opacity-10" style="background-image: radial-gradient(circle at 2px 2px, white 1px, transparent 0); background-size: 20px 20px;"></div>
                </div>
                <div class="px-8 pb-10 flex flex-col md:flex-row items-center md:items-end justify-between gap-6 -mt-20 relative z-10">
                    <div class="flex flex-col md:flex-row items-center md:items-end gap-6 text-center md:text-left">
                        <div class="w-40 h-40 bg-[#050B14] rounded-full p-2 shadow-2xl border border-white/10 group-hover:scale-105 transition-transform duration-500">
                            @if($user->profile_photo_path)
                                <img src="{{ asset('storage/' . $user->profile_photo_path) }}" alt="{{ $user->name }}" class="w-full h-full object-cover rounded-full shadow-inner">
                            @else
                                <div class="w-full h-full bg-gradient-to-br from-emerald-800 to-teal-800 rounded-full flex items-center justify-center text-6xl font-black text-white shadow-inner">
                                    {{ strtoupper(substr($user->name, 0, 1)) }}
                                </div>
                            @endif
                        </div>
                        <div class="mb-3">
                            <h3 class="text-4xl font-black text-white tracking-tight">{{ $user->name }}</h3>
                            <p class="text-emerald-400 font-medium flex items-center justify-center md:justify-start gap-2 mt-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                                {{ $user->email }}
                                <span class="text-gray-600">|</span>
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                                {{ $user->contact ?? 'Belum ada kontak' }}
                            </p>
                        </div>
                    </div>
                    
                    <div class="flex flex-col items-center md:items-end mb-4">
                        <span class="text-xs font-extrabold text-gray-400 uppercase tracking-[0.2em] mb-2">Pencapaian Anda</span>
                        <div class="px-6 py-3 rounded-2xl bg-white/5 backdrop-blur-sm border border-white/10 text-emerald-400 font-black text-lg shadow-xl flex items-center gap-3 transform hover:-translate-y-1 transition-all duration-300">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                            {{ $badge }}
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Points Card -->
                <div class="bg-gradient-to-br from-emerald-600 to-teal-800 rounded-[2.5rem] shadow-2xl text-white p-10 relative overflow-hidden group hover:shadow-[0_20px_40px_rgb(16,185,129,0.2)] transition-all duration-500 border border-emerald-500/20">
                    <div class="absolute bottom-0 right-0 p-8 opacity-10 transform translate-x-4 translate-y-4 group-hover:-translate-y-2 transition-transform duration-500">
                        <svg class="w-40 h-40" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/></svg>
                    </div>
                    <div class="relative z-10">
                        <div class="flex items-center gap-3 mb-4">
                            <div class="w-10 h-10 rounded-full bg-white/10 flex items-center justify-center backdrop-blur-sm">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                            </div>
                            <p class="text-emerald-200 font-black uppercase tracking-widest text-sm">Total Eco-Points</p>
                        </div>
                        <h2 class="text-7xl font-black mb-2 tracking-tighter">{{ number_format($totalPoints, 0, ',', '.') }}</h2>
                        <p class="text-emerald-100/70 mb-8 font-medium text-lg max-w-[80%]">Tukarkan poin Anda dengan berbagai hadiah menarik di Bank Sampah terdekat.</p>
                        
                        <button onclick="openWithdrawModal()" class="bg-[#050B14] text-emerald-400 border border-emerald-500/50 px-8 py-4 rounded-2xl font-black text-lg hover:bg-emerald-900/50 transition-colors active:scale-95 w-full flex items-center justify-center gap-2">
                            <span>Tarik Saldo Poin</span>
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                        </button>
                    </div>
                </div>

                <!-- Transaction History -->
                <div class="lg:col-span-2 bg-white/5 backdrop-blur-xl rounded-[2.5rem] border border-white/10 p-10">
                    <div class="flex items-center justify-between mb-8">
                        <h3 class="text-2xl font-black text-white flex items-center gap-3 tracking-tight">
                            <div class="w-10 h-10 rounded-xl bg-emerald-900/50 flex items-center justify-center text-emerald-400 border border-emerald-500/20">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
                            </div>
                            Riwayat Penyetoran
                        </h3>
                    </div>
                    
                    @if($history->isEmpty())
                        <div class="text-center py-16 bg-white/5 rounded-3xl border border-dashed border-white/20">
                            <div class="w-20 h-20 bg-white/5 rounded-full flex items-center justify-center mx-auto mb-4 text-emerald-500">
                                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path></svg>
                            </div>
                            <p class="text-gray-400 font-medium text-lg">Belum ada aktivitas penyetoran.</p>
                            <a href="{{ route('home') }}" class="mt-4 inline-block bg-emerald-600 text-white px-6 py-2 rounded-xl font-bold hover:bg-emerald-500 transition-colors">Mulai Setor Sekarang</a>
                        </div>
                    @else
                        <div class="overflow-x-auto rounded-2xl border border-white/10">
                            <table class="w-full text-left border-collapse">
                                <thead>
                                    <tr class="bg-white/5">
                                        <th class="px-6 py-4 text-xs uppercase text-gray-400 font-black tracking-widest border-b border-white/10">Tanggal</th>
                                        <th class="px-6 py-4 text-xs uppercase text-gray-400 font-black tracking-widest border-b border-white/10">Jenis Sampah</th>
                                        <th class="px-6 py-4 text-xs uppercase text-gray-400 font-black tracking-widest border-b border-white/10">Berat</th>
                                        <th class="px-6 py-4 text-xs uppercase text-gray-400 font-black tracking-widest border-b border-white/10 text-right">Poin</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-white/10 bg-transparent">
                                    @foreach($history as $record)
                                        <tr class="hover:bg-white/5 transition-colors group">
                                            <td class="px-6 py-5 text-sm text-gray-400 font-medium">{{ $record->created_at->format('d M Y') }}</td>
                                            <td class="px-6 py-5 text-sm font-bold text-white">{{ $record->item_name }}</td>
                                            <td class="px-6 py-5 text-sm text-gray-300 font-medium">
                                                <span class="bg-white/10 text-gray-300 px-2 py-1 rounded-md">{{ $record->weight }} Kg</span>
                                            </td>
                                            <td class="px-6 py-5 text-right">
                                                <span class="inline-block bg-emerald-500/20 text-emerald-400 border border-emerald-500/30 px-4 py-1.5 rounded-full text-sm font-black group-hover:scale-105 transition-transform">
                                                    +{{ number_format($record->points, 0, ',', '.') }}
                                                </span>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Account Settings Section -->
            <div class="pt-8 mt-12">
                <div class="flex items-center gap-4 mb-8">
                    <h3 class="text-3xl font-black text-white tracking-tight">Pengaturan Akun</h3>
                    <div class="h-1 flex-1 bg-gradient-to-r from-emerald-600/50 to-transparent rounded-full"></div>
                </div>
                
                <!-- NOTE: The internal update forms from Breeze have hardcoded white backgrounds and gray text. 
                     We add a dark overlay / inversion strategy or leave them in their white cards to maintain readability -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="space-y-8">
                        <!-- Update Profile Form -->
                        <div class="bg-white/5 backdrop-blur-xl text-white p-8 shadow-2xl border border-white/10 rounded-[2.5rem]">
                            @include('profile.partials.update-profile-information-form')
                        </div>

                        <!-- Update Profile Photos Form -->
                        <div class="bg-white/5 backdrop-blur-xl text-white p-8 shadow-2xl border border-white/10 rounded-[2.5rem]">
                            @include('profile.partials.update-profile-photos-form')
                        </div>
                    </div>
                    
                    <div class="space-y-8">
                        <!-- Update Password Form -->
                        <div class="bg-white/5 backdrop-blur-xl text-white p-8 shadow-2xl border border-white/10 rounded-[2.5rem]">
                            @include('profile.partials.update-password-form')
                        </div>

                        <!-- Delete User Form -->
                        <div class="bg-red-900/20 backdrop-blur-xl text-white p-8 shadow-2xl border border-red-500/30 rounded-[2.5rem]">
                            @include('profile.partials.delete-user-form')
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    {{-- Withdraw Modal --}}
    <div id="modal-withdraw" class="fixed inset-0 bg-black/90 backdrop-blur-md hidden items-center justify-center z-50 p-4 transition-all opacity-0 duration-300">
        <div class="bg-zinc-900 border border-emerald-500/30 p-8 rounded-[2.5rem] w-full max-w-md shadow-[0_0_100px_rgba(16,185,129,0.2)] transform scale-95 transition-transform duration-300" id="modal-withdraw-content">
            <div class="text-center mb-6">
                <div class="w-20 h-20 bg-emerald-500/10 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-10 h-10 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <h3 class="text-2xl font-black italic text-white uppercase tracking-tighter mb-2">Tarik Saldo</h3>
                <p class="text-emerald-400 text-sm font-bold">1 Poin = Rp 1</p>
                <p class="text-gray-400 text-xs mt-1">Poin Anda saat ini: {{ number_format($totalPoints, 0, ',', '.') }} PTS (Setara Rp {{ number_format($totalPoints, 0, ',', '.') }})</p>
            </div>
            
            <form action="{{ route('withdraws.store') }}" method="POST" class="space-y-4 text-left">
                @csrf
                <div>
                    <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-1">Jumlah Poin ditarik</label>
                    <input type="number" name="amount" required max="{{ $totalPoints }}" min="50" class="w-full bg-white/5 border border-white/10 p-3 rounded-xl text-white focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500" placeholder="Minimal 50 PTS">
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-1">Pilih Bank / e-Wallet</label>
                    <select name="method" required class="w-full bg-[#050B14] border border-white/10 p-3 rounded-xl text-white focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500">
                        <option value="BCA">Bank BCA</option>
                        <option value="Mandiri">Bank Mandiri</option>
                        <option value="BRI">Bank BRI</option>
                        <option value="BNI">Bank BNI</option>
                        <option value="GoPay">GoPay</option>
                        <option value="OVO">OVO</option>
                        <option value="DANA">DANA</option>
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-1">Nomor Rekening / HP</label>
                    <input type="text" name="account_number" required class="w-full bg-white/5 border border-white/10 p-3 rounded-xl text-white focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500" placeholder="0812xxxx / 1234xxxx">
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-1">Atas Nama</label>
                    <input type="text" name="account_name" required class="w-full bg-white/5 border border-white/10 p-3 rounded-xl text-white focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500" placeholder="Nama Pemilik Rekening">
                </div>
                
                <div class="pt-4 flex items-center justify-end gap-3">
                    <button type="button" onclick="closeWithdrawModal()" class="text-gray-500 hover:text-white transition-colors font-bold text-xs uppercase tracking-widest px-4 py-2">Batal</button>
                    <button type="submit" class="bg-emerald-600 hover:bg-emerald-500 text-white font-black text-sm uppercase tracking-wider px-6 py-3 rounded-xl transition-colors shadow-[0_0_15px_rgba(16,185,129,0.3)]">Tarik Dana</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openWithdrawModal() {
            const modal = document.getElementById('modal-withdraw');
            const content = document.getElementById('modal-withdraw-content');
            modal.classList.remove('hidden');
            modal.classList.add('flex');
            setTimeout(() => {
                modal.classList.remove('opacity-0');
                content.classList.remove('scale-95');
                content.classList.add('scale-100');
            }, 10);
        }

        function closeWithdrawModal() {
            const modal = document.getElementById('modal-withdraw');
            const content = document.getElementById('modal-withdraw-content');
            modal.classList.add('opacity-0');
            content.classList.remove('scale-100');
            content.classList.add('scale-95');
            setTimeout(() => {
                modal.classList.add('hidden');
                modal.classList.remove('flex');
            }, 300);
        }

        window.onclick = function(event) {
            const modalWithdraw = document.getElementById('modal-withdraw');
            if (event.target == modalWithdraw) {
                closeWithdrawModal();
            }
        }
    </script>
</x-app-layout>
