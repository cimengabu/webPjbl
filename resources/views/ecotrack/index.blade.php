<x-app-layout>
    {{-- Header Opsional (Jika ingin muncul di bagian @isset($header) di layout) --}}
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('EcoTrack Dashboard') }}
        </h2>
    </x-slot>

    <div class="w-full min-h-screen px-6 md:px-12 py-12 space-y-10 bg-black text-white font-sans">

        @if(session('success'))
            <div id="alert-success" class="bg-emerald-500 text-black p-4 rounded-xl font-black text-xs uppercase mb-6 animate-pulse flex justify-between">
                <span>{{ session('success') }}</span>
                <button onclick="document.getElementById('alert-success').remove()">✕</button>
            </div>
        @endif

        <div class="relative overflow-hidden rounded-[2rem] bg-gradient-to-br from-emerald-500/10 to-blue-500/5 border border-white/10 p-12">
            <div class="relative z-10 flex flex-col md:flex-row items-center justify-between gap-10">
                <div class="space-y-6">
                    <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-emerald-500/10 border border-emerald-500/20">
                        <span class="text-[10px] font-black uppercase tracking-widest text-emerald-400">Node: Active</span>
                    </div>
                    <h1 class="text-6xl font-black italic tracking-tighter leading-none">UPDATED <span class="text-emerald-400">TO</span></h1>
                    <div class="inline-block bg-white text-black px-8 py-2 rounded-2xl text-5xl font-black shadow-xl italic skew-x-[-6deg]">
                        {{ $latestUpdate->version ?? 'V2.25' }}
                    </div>
                    <p class="text-gray-500 font-mono text-xs border-l-2 border-emerald-500/30 pl-4 uppercase">
                        // AI_INTEGRATED: WASTE_SCANNER_V2 | SMART_PICKUP_ENABLED
                    </p>
                </div>

                <div class="bg-white/5 backdrop-blur-xl border border-emerald-500/30 p-8 rounded-[2rem] text-center w-full md:w-80 shadow-[0_0_40px_rgba(16,185,129,0.1)]">
                    <p class="text-gray-500 text-[10px] font-black uppercase tracking-widest mb-2">Total Eco-Points</p>
                    <h2 class="text-5xl font-black text-emerald-400">12.450 <span class="text-xs text-white">PTS</span></h2>
                    <button onclick="openWithdrawModal()" 
                        class="mt-4 w-full bg-emerald-500 text-black font-black py-2 rounded-xl text-xs hover:bg-emerald-400 transition-all uppercase active:scale-95 shadow-[0_0_15px_rgba(16,185,129,0.3)] hover:shadow-[0_0_25px_rgba(16,185,129,0.5)]">
                        Withdraw Saldo
                    </button>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-5 gap-6">
            <div class="bg-white/5 border border-white/10 p-6 rounded-2xl">
                <p class="text-gray-500 text-[10px] uppercase font-black tracking-widest">Total Sampah</p>
                <p class="text-4xl font-black mt-1">458 <span class="text-sm font-light">Kg</span></p>
            </div>

            <div class="bg-white/5 border border-white/10 p-6 rounded-2xl">
                <p class="text-gray-500 text-[10px] uppercase font-black tracking-widest">AI Efficiency</p>
                <p class="text-4xl font-black mt-1 text-blue-400">94%</p>
            </div>

            <a href="{{ route('recycling-centers.index') }}" 
                class="bg-emerald-600 hover:bg-emerald-500 text-white rounded-2xl font-black text-lg transition-all flex flex-col items-center justify-center p-4 text-center shadow-[0_10px_30px_rgba(16,185,129,0.3)] active:scale-95">
                <span class="text-[10px] opacity-70 uppercase mb-1">Find Nearest Location</span>
                PETA BANK SAMPAH
            </a>

            <a href="https://wa.me/628123456789?text=Saya%20ingin%20request%20penjemputan%20sampah" target="_blank"
                class="bg-blue-600 hover:bg-blue-500 text-white rounded-2xl font-black text-lg transition-all flex flex-col items-center justify-center p-4 text-center active:scale-95">
                <span class="text-[10px] opacity-70 uppercase mb-1">Pick-up Service</span>
                TRUCK REQUEST
            </a>

            <button onclick="openModal()" 
                class="bg-emerald-500 hover:bg-emerald-400 text-black rounded-2xl font-black text-lg transition-all flex flex-col items-center justify-center p-4 active:scale-95">
                <span class="text-[10px] opacity-70 uppercase mb-1">Administrator</span>
                + NEW DEPOSIT
            </button>
        </div>

        <div class="space-y-4">
            <h3 class="text-sm font-black uppercase tracking-[0.3em] text-gray-500 italic">Katalog Harga Bank Sampah</h3>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                @php $prices = [
                    ['label' => 'Plastik PET', 'price' => 'Rp 3.500/kg'],
                    ['label' => 'Kardus/Kertas', 'price' => 'Rp 2.000/kg'],
                    ['label' => 'Logam/Besi', 'price' => 'Rp 6.000/kg'],
                    ['label' => 'Elektronik', 'price' => 'AI CHECK'],
                ] @endphp
                @foreach($prices as $item)
                    <div class="p-4 bg-white/5 border border-white/5 rounded-xl flex justify-between items-center hover:border-emerald-500/50 transition-colors">
                        <span class="text-xs font-bold">{{ $item['label'] }}</span>
                        <span class="{{ $item['price'] == 'AI CHECK' ? 'text-blue-400 italic' : 'text-emerald-400' }} font-mono text-xs">{{ $item['price'] }}</span>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="bg-white/5 border border-white/10 rounded-3xl overflow-hidden">
            <div class="p-6 bg-white/5 border-b border-white/10">
                <h2 class="font-black italic text-sm tracking-widest uppercase text-white">Live Monitoring Dashboard</h2>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead class="bg-white/5 text-emerald-400 text-[10px] font-black uppercase tracking-widest">
                        <tr>
                            <th class="p-8">Subject</th>
                            <th class="p-8">Security QR</th>
                            <th class="p-8 text-center">Status Protocol</th>
                            <th class="p-8 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-white/5">
                        @foreach($tracks as $track)
                            <tr class="hover:bg-emerald-500/5 transition-all group">
                                <td class="p-8 font-bold text-xl uppercase tracking-tighter">{{ $track->item_name }}</td>
                                <td class="p-8 font-mono text-gray-500">{{ $track->qr_code }}</td>
                                <td class="p-8 text-center">
                                    <span class="px-4 py-1 rounded-full text-[10px] font-black uppercase tracking-widest {{ $track->status == 'AI Optimized' ? 'bg-emerald-500/20 text-emerald-400 border border-emerald-500/30' : 'bg-blue-500/20 text-blue-400 border border-blue-500/30' }}">
                                        {{ $track->status }}
                                    </span>
                                </td>

                                <td class="p-8 text-right">
                                    <form action="{{ route('ecotrack.destroy', $track->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500/30 group-hover:text-red-500 font-black text-[10px] uppercase italic transition-colors">
                                            Terminate
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- Withdraw Modal --}}
    <div id="modal-withdraw" class="fixed inset-0 bg-black/90 backdrop-blur-md hidden items-center justify-center z-50 p-4 transition-all opacity-0 duration-300">
        <div class="bg-zinc-900 border border-emerald-500/30 p-8 rounded-[2.5rem] w-full max-w-sm shadow-[0_0_100px_rgba(16,185,129,0.2)] text-center transform scale-95 transition-transform duration-300" id="modal-withdraw-content">
            <div class="w-20 h-20 bg-emerald-500/10 rounded-full flex items-center justify-center mx-auto mb-6">
                <svg class="w-10 h-10 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            </div>
            <h3 class="text-2xl font-black italic text-white uppercase tracking-tighter mb-2">Tarik Saldo</h3>
            <p class="text-gray-400 text-sm mb-6">Pilih metode penarikan untuk Eco-Points Anda.</p>
            
            <div class="space-y-3 mb-8">
                <button onclick="processWithdraw('Bank Transfer')" class="w-full bg-white/5 border border-white/10 p-4 rounded-2xl hover:bg-emerald-500/20 hover:border-emerald-500/50 transition-all flex items-center gap-4 group">
                    <div class="bg-white/10 p-2 rounded-lg group-hover:bg-emerald-500/30 transition-colors">
                        <svg class="w-5 h-5 text-gray-300 group-hover:text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path></svg>
                    </div>
                    <div class="text-left">
                        <p class="text-white font-bold text-sm">Bank Transfer</p>
                        <p class="text-gray-500 text-xs">BCA, Mandiri, BNI</p>
                    </div>
                </button>
                <button onclick="processWithdraw('E-Wallet')" class="w-full bg-white/5 border border-white/10 p-4 rounded-2xl hover:bg-emerald-500/20 hover:border-emerald-500/50 transition-all flex items-center gap-4 group">
                    <div class="bg-white/10 p-2 rounded-lg group-hover:bg-emerald-500/30 transition-colors">
                        <svg class="w-5 h-5 text-gray-300 group-hover:text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
                    </div>
                    <div class="text-left">
                        <p class="text-white font-bold text-sm">E-Wallet</p>
                        <p class="text-gray-500 text-xs">GoPay, OVO, Dana</p>
                    </div>
                </button>
            </div>

            <button onclick="closeWithdrawModal()" class="text-gray-500 hover:text-white transition-colors font-bold text-xs uppercase tracking-widest">Batalkan</button>
        </div>
    </div>

    <script>
        // Modal functions for Deposit
        function openModal() {
            const modal = document.getElementById('modal-add');
            modal.classList.remove('hidden');
            modal.classList.add('flex');
            // small delay for transition
            setTimeout(() => {
                modal.classList.remove('opacity-0');
            }, 10);
        }

        function closeModal() {
            const modal = document.getElementById('modal-add');
            modal.classList.add('opacity-0');
            setTimeout(() => {
                modal.classList.add('hidden');
                modal.classList.remove('flex');
            }, 300);
        }

        // Modal functions for Withdraw
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

        function processWithdraw(method) {
            closeWithdrawModal();
            setTimeout(() => {
                alert(`Permintaan Withdraw via ${method} sedang diproses sistem. Silakan periksa notifikasi Anda.`);
            }, 350);
        }

        window.onclick = function(event) {
            const modalAdd = document.getElementById('modal-add');
            const modalWithdraw = document.getElementById('modal-withdraw');
            if (event.target == modalAdd) {
                closeModal();
            }
            if (event.target == modalWithdraw) {
                closeWithdrawModal();
            }
        }
    </script>
</x-app-layout>