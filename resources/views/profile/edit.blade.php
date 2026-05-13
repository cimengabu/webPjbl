<x-app-layout>
    <x-slot name="header">
        <h2 class="font-black text-3xl text-emerald-400 leading-tight tracking-tight">
            {{ __('Profil & Pencapaian') }}
        </h2>
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
                    <div class="absolute inset-0 opacity-10" style="background-image: radial-gradient(circle at 2px 2px, white 1px, transparent 0); background-size: 20px 20px;"></div>
                </div>
                <div class="px-8 pb-10 flex flex-col md:flex-row items-center md:items-end justify-between gap-6 -mt-20 relative z-10">
                    <div class="flex flex-col md:flex-row items-center md:items-end gap-6 text-center md:text-left">
                        <div class="w-40 h-40 bg-[#050B14] rounded-full p-2 shadow-2xl border border-white/10 group-hover:scale-105 transition-transform duration-500">
                            <div class="w-full h-full bg-gradient-to-br from-emerald-800 to-teal-800 rounded-full flex items-center justify-center text-6xl font-black text-white shadow-inner">
                                {{ strtoupper(substr($user->name, 0, 1)) }}
                            </div>
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
                        
                        <button onclick="openRedeemModal()" class="bg-[#050B14] text-emerald-400 border border-emerald-500/50 px-8 py-4 rounded-2xl font-black text-lg hover:bg-emerald-900/50 transition-colors active:scale-95 w-full flex items-center justify-center gap-2">
                            <span>Redeem Points</span>
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
                    <!-- Update Profile Form -->
                    <div class="bg-white text-gray-800 p-8 shadow-2xl border border-white/10 rounded-[2.5rem]">
                        @include('profile.partials.update-profile-information-form')
                    </div>
                    
                    <div class="space-y-8">
                        <!-- Update Password Form -->
                        <div class="bg-white text-gray-800 p-8 shadow-2xl border border-white/10 rounded-[2.5rem]">
                            @include('profile.partials.update-password-form')
                        </div>

                        <!-- Delete User Form -->
                        <div class="bg-red-50 text-gray-800 p-8 shadow-2xl border border-red-100 rounded-[2.5rem]">
                            @include('profile.partials.delete-user-form')
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    {{-- Redeem Modal --}}
    <div id="modal-redeem" class="fixed inset-0 bg-black/90 backdrop-blur-md hidden items-center justify-center z-50 p-4 transition-all opacity-0 duration-300">
        <div class="bg-zinc-900 border border-emerald-500/30 p-8 rounded-[2.5rem] w-full max-w-sm shadow-[0_0_100px_rgba(16,185,129,0.2)] text-center transform scale-95 transition-transform duration-300" id="modal-redeem-content">
            <div class="w-20 h-20 bg-emerald-500/10 rounded-full flex items-center justify-center mx-auto mb-6">
                <svg class="w-10 h-10 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7"></path></svg>
            </div>
            <h3 class="text-2xl font-black italic text-white uppercase tracking-tighter mb-2">Tukar Poin</h3>
            <p class="text-gray-400 text-sm mb-6">Pilih hadiah yang ingin Anda tukarkan dengan Eco-Points Anda.</p>
            
            <div class="space-y-3 mb-8 text-left">
                <button onclick="processRedeem('Voucher Belanja Rp 50.000')" class="w-full bg-white/5 border border-white/10 p-4 rounded-2xl hover:bg-emerald-500/20 hover:border-emerald-500/50 transition-all flex items-center justify-between group">
                    <div>
                        <p class="text-white font-bold text-sm">Voucher Belanja</p>
                        <p class="text-emerald-400 font-mono text-xs">Rp 50.000</p>
                    </div>
                    <span class="text-xs font-black text-gray-500 group-hover:text-emerald-400 bg-white/5 px-2 py-1 rounded">5.000 PTS</span>
                </button>
                <button onclick="processRedeem('Token Listrik Rp 100.000')" class="w-full bg-white/5 border border-white/10 p-4 rounded-2xl hover:bg-emerald-500/20 hover:border-emerald-500/50 transition-all flex items-center justify-between group">
                    <div>
                        <p class="text-white font-bold text-sm">Token Listrik</p>
                        <p class="text-emerald-400 font-mono text-xs">Rp 100.000</p>
                    </div>
                    <span class="text-xs font-black text-gray-500 group-hover:text-emerald-400 bg-white/5 px-2 py-1 rounded">10.000 PTS</span>
                </button>
                <button onclick="processRedeem('Paket Sembako')" class="w-full bg-white/5 border border-white/10 p-4 rounded-2xl hover:bg-emerald-500/20 hover:border-emerald-500/50 transition-all flex items-center justify-between group">
                    <div>
                        <p class="text-white font-bold text-sm">Paket Sembako</p>
                        <p class="text-emerald-400 font-mono text-xs">Premium</p>
                    </div>
                    <span class="text-xs font-black text-gray-500 group-hover:text-emerald-400 bg-white/5 px-2 py-1 rounded">15.000 PTS</span>
                </button>
            </div>

            <button onclick="closeRedeemModal()" class="text-gray-500 hover:text-white transition-colors font-bold text-xs uppercase tracking-widest">Batalkan</button>
        </div>
    </div>

    <script>
        function openRedeemModal() {
            const modal = document.getElementById('modal-redeem');
            const content = document.getElementById('modal-redeem-content');
            modal.classList.remove('hidden');
            modal.classList.add('flex');
            setTimeout(() => {
                modal.classList.remove('opacity-0');
                content.classList.remove('scale-95');
                content.classList.add('scale-100');
            }, 10);
        }

        function closeRedeemModal() {
            const modal = document.getElementById('modal-redeem');
            const content = document.getElementById('modal-redeem-content');
            modal.classList.add('opacity-0');
            content.classList.remove('scale-100');
            content.classList.add('scale-95');
            setTimeout(() => {
                modal.classList.add('hidden');
                modal.classList.remove('flex');
            }, 300);
        }

        function processRedeem(item) {
            closeRedeemModal();
            setTimeout(() => {
                alert(`Permintaan penukaran ${item} sedang diproses. Hadiah akan dikirimkan ke kontak Anda.`);
            }, 350);
        }

        window.onclick = function(event) {
            const modalRedeem = document.getElementById('modal-redeem');
            if (event.target == modalRedeem) {
                closeRedeemModal();
            }
        }
    </script>
</x-app-layout>
