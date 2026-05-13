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
                    <button onclick="alert('Permintaan Withdraw Terkirim! Saldo akan diproses ke rekening terdaftar.')" 
                        class="mt-4 w-full bg-emerald-500 text-black font-black py-2 rounded-xl text-xs hover:bg-emerald-400 transition-all uppercase active:scale-95">
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

    {{-- Modal & Script tetap di dalam x-app-layout agar ikut ter-render --}}
    <div id="modal-add" class="fixed inset-0 bg-black/90 backdrop-blur-md hidden items-center justify-center z-50 p-4 transition-all">
        <div class="bg-zinc-900 border border-emerald-500/30 p-8 rounded-[2.5rem] w-full max-w-md shadow-[0_0_100px_rgba(16,185,129,0.2)]">
            <div class="flex justify-between items-center mb-8">
                <h3 class="text-2xl font-black italic text-emerald-400 uppercase tracking-tighter">New Entry</h3>
                <button onclick="closeModal()" class="text-gray-500 hover:text-white transition-colors font-bold">CLOSE ×</button>
            </div>
            
            <form action="{{ route('ecotrack.store') }}" method="POST" class="space-y-6">
                @csrf
                <div>
                    <label class="block text-[10px] font-black uppercase text-gray-500 mb-2 tracking-widest">Item Name</label>
                    <input type="text" name="item_name" required placeholder="Contoh: Plastik HDPE" 
                        class="w-full bg-black border border-white/10 rounded-2xl p-4 text-sm text-white focus:border-emerald-500 outline-none transition-all">
                </div>
                <div>
                    <label class="block text-[10px] font-black uppercase text-gray-500 mb-2 tracking-widest">QR Reference</label>
                    <input type="text" name="qr_code" required placeholder="REF-XXXXX" 
                        class="w-full bg-black border border-white/10 rounded-2xl p-4 text-sm text-white focus:border-emerald-500 outline-none font-mono">
                </div>
                <div>
                    <label class="block text-[10px] font-black uppercase text-gray-500 mb-2 tracking-widest">Protocol Status</label>
                    <select name="status" class="w-full bg-black border border-white/10 rounded-2xl p-4 text-sm text-white outline-none focus:border-emerald-500 appearance-none">
                        <option value="AI Optimized">AI Optimized</option>
                        <option value="Manual Check">Manual Check</option>
                    </select>
                </div>
                <button type="submit" class="w-full bg-emerald-500 text-black font-black py-5 rounded-2xl uppercase tracking-[0.3em] hover:bg-emerald-400 transition-all shadow-[0_10px_20px_rgba(16,185,129,0.2)] active:scale-95">
                    EXECUTE DEPOSIT
                </button>
            </form>
        </div>
    </div>

    <script>
        function openModal() {
            const modal = document.getElementById('modal-add');
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }

        function closeModal() {
            const modal = document.getElementById('modal-add');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }

        window.onclick = function(event) {
            const modal = document.getElementById('modal-add');
            if (event.target == modal) {
                closeModal();
            }
        }
    </script>
</x-app-layout>