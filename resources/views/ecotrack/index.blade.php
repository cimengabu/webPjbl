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

        @if(session('error'))
            <div id="alert-error" class="bg-red-500 text-white p-4 rounded-xl font-black text-xs uppercase mb-6 animate-pulse flex justify-between">
                <span>{{ session('error') }}</span>
                <button onclick="document.getElementById('alert-error').remove()">✕</button>
            </div>
        @endif

        @guest
            {{-- Banner login untuk pengguna belum login --}}
            <div class="relative overflow-hidden rounded-2xl bg-gradient-to-r from-emerald-900/60 to-teal-900/40 border border-emerald-500/30 px-6 py-5 flex flex-col sm:flex-row items-center justify-between gap-4">
                <div class="absolute inset-0 opacity-5" style="background-image: radial-gradient(circle at 2px 2px, white 1px, transparent 0); background-size: 20px 20px;"></div>
                <div class="relative flex items-center gap-4">
                    <div class="w-10 h-10 rounded-full bg-emerald-500/20 border border-emerald-500/40 flex items-center justify-center text-emerald-400 flex-shrink-0">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <div>
                        <p class="font-black text-white text-sm uppercase tracking-wide">Login diperlukan untuk menggunakan fitur ini</p>
                        <p class="text-emerald-300/70 text-xs mt-0.5">Daftar & deposit sampah, tarik saldo, request penjemputan, dan masih banyak lagi.</p>
                    </div>
                </div>
                <div class="relative flex items-center gap-3 flex-shrink-0">
                    <a href="{{ route('register') }}" class="px-5 py-2 bg-emerald-500 hover:bg-emerald-400 text-black font-black text-xs uppercase tracking-widest rounded-xl transition-all active:scale-95">
                        Daftar Gratis
                    </a>
                    <a href="{{ route('login') }}" class="px-5 py-2 bg-white/10 hover:bg-white/20 text-white font-bold text-xs uppercase tracking-widest rounded-xl transition-all border border-white/20">
                        Masuk
                    </a>
                </div>
            </div>
        @endguest

        <div class="relative overflow-hidden rounded-[2rem] bg-gradient-to-br from-emerald-500/10 to-blue-500/5 border border-white/10 p-12">
            <div class="relative z-10 flex flex-col md:flex-row items-center justify-between gap-10">
                <div class="space-y-6">
                    <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-emerald-500/10 border border-emerald-500/20">
                        <span class="text-[10px] font-black uppercase tracking-widest text-emerald-400">Node: Active</span>
                    </div>
                    <h1 class="text-6xl font-black italic tracking-tighter leading-none">UPDATED <span class="text-emerald-400">TO</span></h1>
                    <div class="inline-block bg-white text-black px-8 py-2 rounded-2xl text-5xl font-black shadow-xl italic skew-x-[-6deg]">
                        {{ $latestUpdate->version_name ?? 'V2.25' }}
                    </div>
                    <p class="text-gray-500 font-mono text-xs border-l-2 border-emerald-500/30 pl-4 uppercase">
                        // AI_INTEGRATED: WASTE_SCANNER_V2 | SMART_PICKUP_ENABLED
                    </p>
                </div>

                <div class="bg-white/5 backdrop-blur-xl border border-emerald-500/30 p-8 rounded-[2rem] text-center w-full md:w-80 shadow-[0_0_40px_rgba(16,185,129,0.1)]">
                    <p class="text-gray-500 text-[10px] font-black uppercase tracking-widest mb-2">Total Eco-Points</p>
                    <h2 class="text-5xl font-black text-emerald-400">{{ number_format($totalPoints, 0, ',', '.') }} <span class="text-xs text-white">PTS</span></h2>
                    @auth
                        <button onclick="openWithdrawModal()"
                            class="mt-4 w-full bg-emerald-500 text-black font-black py-2 rounded-xl text-xs hover:bg-emerald-400 transition-all uppercase active:scale-95 shadow-[0_0_15px_rgba(16,185,129,0.3)] hover:shadow-[0_0_25px_rgba(16,185,129,0.5)]">
                            Withdraw Saldo
                        </button>
                    @else
                        <a href="{{ route('login') }}"
                            class="mt-4 w-full block text-center bg-emerald-500 text-black font-black py-2 rounded-xl text-xs hover:bg-emerald-400 transition-all uppercase active:scale-95 shadow-[0_0_15px_rgba(16,185,129,0.3)]">
                            Login untuk Withdraw
                        </a>
                    @endauth
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-5 gap-6">
            <div class="bg-white/5 border border-white/10 p-6 rounded-2xl">
                <p class="text-gray-500 text-[10px] uppercase font-black tracking-widest">Total Sampah</p>
                <p class="text-4xl font-black mt-1">{{ number_format($totalWeight, 1, ',', '.') }} <span class="text-sm font-light">Kg</span></p>
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

            @auth
                <button onclick="openPickupModal()"
                    class="bg-blue-600 hover:bg-blue-500 text-white rounded-2xl font-black text-lg transition-all flex flex-col items-center justify-center p-4 text-center active:scale-95">
                    <span class="text-[10px] opacity-70 uppercase mb-1">Pick-up Service</span>
                    TRUCK REQUEST
                </button>
            @else
                <a href="{{ route('login') }}"
                    class="bg-blue-600 hover:bg-blue-500 text-white rounded-2xl font-black text-lg transition-all flex flex-col items-center justify-center p-4 text-center active:scale-95">
                    <span class="text-[10px] opacity-70 uppercase mb-1">Pick-up Service</span>
                    TRUCK REQUEST
                </a>
            @endauth

            @auth
                <button onclick="openModal()"
                    class="bg-emerald-500 hover:bg-emerald-400 text-black rounded-2xl font-black text-lg transition-all flex flex-col items-center justify-center p-4 active:scale-95">
                    <span class="text-[10px] opacity-70 uppercase mb-1">Administrator</span>
                    + NEW DEPOSIT
                </button>
            @else
                <a href="{{ route('login') }}"
                    class="bg-emerald-500 hover:bg-emerald-400 text-black rounded-2xl font-black text-lg transition-all flex flex-col items-center justify-center p-4 active:scale-95">
                    <span class="text-[10px] opacity-70 uppercase mb-1">Login Required</span>
                    + NEW DEPOSIT
                </a>
            @endauth
        </div>

        <div class="space-y-4">
            <div class="flex items-center justify-between">
                <h3 class="text-sm font-black uppercase tracking-[0.3em] text-gray-500 italic">Katalog Harga Bank Sampah</h3>
                <span class="text-[10px] text-gray-600 uppercase tracking-widest font-bold">Harga referensi per Kg</span>
            </div>
            @php
            $categories = [
                [
                    'cat' => 'Plastik',
                    'color' => 'blue',
                    'icon' => 'M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z',
                    'items' => [
                        ['label' => 'Plastik PET (Botol)', 'price' => 'Rp 3.500/kg'],
                        ['label' => 'Plastik HDPE (Jerigen)', 'price' => 'Rp 2.500/kg'],
                        ['label' => 'Plastik PP (Ember)', 'price' => 'Rp 2.000/kg'],
                        ['label' => 'Plastik Kresek/LDPE', 'price' => 'Rp 1.000/kg'],
                        ['label' => 'Plastik ABS (Elektronik)', 'price' => 'Rp 3.000/kg'],
                        ['label' => 'Galon Plastik', 'price' => 'Rp 2.500/kg'],
                    ]
                ],
                [
                    'cat' => 'Kertas & Kardus',
                    'color' => 'amber',
                    'icon' => 'M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z',
                    'items' => [
                        ['label' => 'Kardus / Karton', 'price' => 'Rp 2.000/kg'],
                        ['label' => 'Koran & Majalah', 'price' => 'Rp 1.500/kg'],
                        ['label' => 'Kertas HVS / Buku', 'price' => 'Rp 1.800/kg'],
                        ['label' => 'Kertas Duplex', 'price' => 'Rp 1.200/kg'],
                        ['label' => 'Kertas Tissue (reject)', 'price' => 'Rp 500/kg'],
                        ['label' => 'Buku Pelajaran', 'price' => 'Rp 1.500/kg'],
                    ]
                ],
                [
                    'cat' => 'Logam & Besi',
                    'color' => 'gray',
                    'icon' => 'M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4',
                    'items' => [
                        ['label' => 'Besi / Baja Tua', 'price' => 'Rp 4.000/kg'],
                        ['label' => 'Aluminium', 'price' => 'Rp 15.000/kg'],
                        ['label' => 'Tembaga', 'price' => 'Rp 60.000/kg'],
                        ['label' => 'Kuningan', 'price' => 'Rp 35.000/kg'],
                        ['label' => 'Kaleng Besi', 'price' => 'Rp 1.500/kg'],
                        ['label' => 'Kaleng Aluminium', 'price' => 'Rp 12.000/kg'],
                    ]
                ],
                [
                    'cat' => 'Kaca & Elektronik',
                    'color' => 'emerald',
                    'icon' => 'M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z',
                    'items' => [
                        ['label' => 'Botol Kaca / Beling', 'price' => 'Rp 500/kg'],
                        ['label' => 'Kaca Jendela', 'price' => 'Rp 300/kg'],
                        ['label' => 'Elektronik (CPU, PCB)', 'price' => 'AI CHECK'],
                        ['label' => 'Handphone Rusak', 'price' => 'AI CHECK'],
                        ['label' => 'Baterai Bekas', 'price' => 'AI CHECK'],
                        ['label' => 'Kabel Listrik', 'price' => 'Rp 8.000/kg'],
                    ]
                ],
            ];
            @endphp
            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6">
                @foreach($categories as $cat)
                    @php
                        $colorMap = [
                            'blue'    => ['border' => 'border-blue-500/20',    'header' => 'bg-blue-500/10 text-blue-400',    'badge' => 'text-blue-400'],
                            'amber'   => ['border' => 'border-amber-500/20',   'header' => 'bg-amber-500/10 text-amber-400',   'badge' => 'text-amber-400'],
                            'gray'    => ['border' => 'border-gray-500/20',    'header' => 'bg-gray-500/10 text-gray-300',    'badge' => 'text-gray-300'],
                            'emerald' => ['border' => 'border-emerald-500/20', 'header' => 'bg-emerald-500/10 text-emerald-400', 'badge' => 'text-emerald-400'],
                        ];
                        $c = $colorMap[$cat['color']];
                    @endphp
                    <div class="bg-white/5 border {{ $c['border'] }} rounded-2xl overflow-hidden">
                        <div class="px-4 py-3 {{ $c['header'] }} font-black text-xs uppercase tracking-widest border-b border-white/5">
                            {{ $cat['cat'] }}
                        </div>
                        <div class="divide-y divide-white/5">
                            @foreach($cat['items'] as $item)
                                <div class="px-4 py-3 flex justify-between items-center hover:bg-white/5 transition-colors">
                                    <span class="text-xs font-medium text-gray-300">{{ $item['label'] }}</span>
                                    <span class="{{ $item['price'] === 'AI CHECK' ? 'text-blue-400 italic' : $c['badge'] }} font-mono text-xs font-bold whitespace-nowrap ml-2">{{ $item['price'] }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="space-y-4">
            <div class="flex items-center justify-between">
                <h3 class="text-sm font-black uppercase tracking-[0.3em] text-gray-500 italic">Edu-Articles</h3>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach($articles as $article)
                    <div class="bg-white/5 border border-white/10 rounded-2xl overflow-hidden hover:border-emerald-500/50 transition-all group">
                        @if($article->image)
                            <div class="h-40 overflow-hidden relative">
                                <div class="absolute inset-0 bg-emerald-500/20 mix-blend-overlay z-10 group-hover:bg-transparent transition-all"></div>
                                <img src="{{ $article->image }}" alt="{{ $article->title }}" class="w-full h-full object-cover filter grayscale group-hover:grayscale-0 transition-all duration-500 transform group-hover:scale-105">
                            </div>
                        @endif
                        <div class="p-6 space-y-3">
                            <span class="text-[10px] uppercase font-black tracking-widest text-emerald-400">Environment</span>
                            <h4 class="font-bold text-lg leading-tight group-hover:text-emerald-400 transition-colors">{{ $article->title }}</h4>
                            <p class="text-xs text-gray-500 line-clamp-2">{{ $article->content }}</p>
                            <a href="{{ route('articles.show', $article->id) }}"
                               class="inline-flex items-center gap-1 text-emerald-400 hover:text-emerald-300 text-xs font-black uppercase tracking-widest transition-colors mt-1">
                                Baca Selengkapnya
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                            </a>
                        </div>
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
                                    <span class="px-4 py-1 rounded-full text-[10px] font-black uppercase tracking-widest {{ 
                                        match($track->status) {
                                            'Pending' => 'bg-amber-500/20 text-amber-400 border border-amber-500/30',
                                            'AI Optimized' => 'bg-blue-500/20 text-blue-400 border border-blue-500/30',
                                            'Verified' => 'bg-indigo-500/20 text-indigo-400 border border-indigo-500/30',
                                            'Completed' => 'bg-emerald-500/20 text-emerald-400 border border-emerald-500/30',
                                            'Rejected' => 'bg-red-500/20 text-red-400 border border-red-500/30',
                                            default => 'bg-gray-500/20 text-gray-400 border border-gray-500/30'
                                        }
                                    }}">
                                        {{ $track->status }}
                                    </span>
                                </td>

                                <td class="p-8 text-right">
                                    @auth
                                        <form action="{{ route('ecotrack.destroy', $track->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-500/30 group-hover:text-red-500 font-black text-[10px] uppercase italic transition-colors">
                                                Terminate
                                            </button>
                                        </form>
                                    @endauth
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- Deposit Modal --}}
    <div id="modal-add" class="fixed inset-0 bg-black/90 backdrop-blur-md hidden items-center justify-center z-50 p-4 transition-all opacity-0 duration-300">
        <div class="bg-zinc-900 border border-emerald-500/30 p-8 rounded-[2.5rem] w-full max-w-md shadow-[0_0_100px_rgba(16,185,129,0.2)] transform scale-95 transition-transform duration-300" id="modal-add-content">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-2xl font-black italic text-white uppercase tracking-tighter">New Deposit</h3>
                <button onclick="closeModal()" class="text-gray-500 hover:text-white transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>
            
            <form action="{{ route('ecotrack.store') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-[10px] font-black uppercase tracking-widest text-emerald-400 mb-2">Item Name</label>
                    <input type="text" name="item_name" required placeholder="e.g. Botol Plastik, Kardus" class="w-full bg-[#050B14] border border-white/10 rounded-2xl p-4 text-white focus:border-emerald-500 focus:ring focus:ring-emerald-500/20 outline-none transition-all">
                </div>
                
                <div>
                    <label class="block text-[10px] font-black uppercase tracking-widest text-emerald-400 mb-2">Security QR (Auto-Generated)</label>
                    <input type="text" name="qr_code" required value="QR-{{ strtoupper(Str::random(8)) }}" readonly class="w-full bg-[#050B14]/50 border border-white/10 rounded-2xl p-4 text-gray-500 font-mono outline-none cursor-not-allowed">
                </div>

                <div>
                    <label class="block text-[10px] font-black uppercase tracking-widest text-emerald-400 mb-2">Weight (Kg)</label>
                    <input type="number" step="0.1" name="weight" required placeholder="0.0" class="w-full bg-[#050B14] border border-white/10 rounded-2xl p-4 text-white focus:border-emerald-500 focus:ring focus:ring-emerald-500/20 outline-none transition-all">
                </div>
                
                <div class="pt-4">
                    <button type="submit" class="w-full bg-gradient-to-r from-emerald-500 to-teal-600 text-black font-black py-4 rounded-2xl uppercase tracking-[0.2em] hover:from-emerald-400 hover:to-teal-500 transition-all shadow-[0_0_20px_rgba(16,185,129,0.3)] active:scale-95 text-sm">
                        Execute Deposit Protocol
                    </button>
                </div>
            </form>
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

    {{-- Pickup Modal --}}
    <div id="modal-pickup" class="fixed inset-0 bg-black/90 backdrop-blur-md hidden items-center justify-center z-50 p-4 transition-all opacity-0 duration-300">
        <div class="bg-zinc-900 border border-blue-500/30 p-8 rounded-[2.5rem] w-full max-w-md shadow-[0_0_100px_rgba(59,130,246,0.2)] transform scale-95 transition-transform duration-300" id="modal-pickup-content">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-2xl font-black italic text-white uppercase tracking-tighter">Truck Request</h3>
                <button onclick="closePickupModal()" class="text-gray-500 hover:text-white transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>
            
            <form action="{{ route('pickups.store') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-[10px] font-black uppercase tracking-widest text-blue-400 mb-2">Tanggal Penjemputan</label>
                    <input type="date" name="pickup_date" required class="w-full bg-[#050B14] border border-white/10 rounded-2xl p-4 text-white focus:border-blue-500 focus:ring focus:ring-blue-500/20 outline-none transition-all">
                </div>
                
                <div>
                    <label class="block text-[10px] font-black uppercase tracking-widest text-blue-400 mb-2">Estimasi Berat (Kg)</label>
                    <input type="number" step="0.1" name="weight" required placeholder="0.0" class="w-full bg-[#050B14] border border-white/10 rounded-2xl p-4 text-white focus:border-blue-500 focus:ring focus:ring-blue-500/20 outline-none transition-all">
                </div>

                <div>
                    <label class="block text-[10px] font-black uppercase tracking-widest text-blue-400 mb-2">Alamat Penjemputan</label>
                    <textarea name="address" required rows="3" placeholder="Masukkan alamat lengkap..." class="w-full bg-[#050B14] border border-white/10 rounded-2xl p-4 text-white focus:border-blue-500 focus:ring focus:ring-blue-500/20 outline-none transition-all"></textarea>
                </div>
                
                <div class="pt-4">
                    <button type="submit" class="w-full bg-blue-600 text-white font-black py-4 rounded-2xl uppercase tracking-[0.2em] hover:bg-blue-500 transition-all shadow-[0_0_20px_rgba(59,130,246,0.3)] active:scale-95 text-sm">
                        Request Pickup
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Modal functions for Deposit
        function openModal() {
            const modal = document.getElementById('modal-add');
            const content = document.getElementById('modal-add-content');
            modal.classList.remove('hidden');
            modal.classList.add('flex');
            // small delay for transition
            setTimeout(() => {
                modal.classList.remove('opacity-0');
                if(content) {
                    content.classList.remove('scale-95');
                    content.classList.add('scale-100');
                }
            }, 10);
        }

        function closeModal() {
            const modal = document.getElementById('modal-add');
            const content = document.getElementById('modal-add-content');
            modal.classList.add('opacity-0');
            if(content) {
                content.classList.remove('scale-100');
                content.classList.add('scale-95');
            }
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

        // Modal functions for Pickup
        function openPickupModal() {
            const modal = document.getElementById('modal-pickup');
            const content = document.getElementById('modal-pickup-content');
            modal.classList.remove('hidden');
            modal.classList.add('flex');
            setTimeout(() => {
                modal.classList.remove('opacity-0');
                if(content) {
                    content.classList.remove('scale-95');
                    content.classList.add('scale-100');
                }
            }, 10);
        }

        function closePickupModal() {
            const modal = document.getElementById('modal-pickup');
            const content = document.getElementById('modal-pickup-content');
            modal.classList.add('opacity-0');
            if(content) {
                content.classList.remove('scale-100');
                content.classList.add('scale-95');
            }
            setTimeout(() => {
                modal.classList.add('hidden');
                modal.classList.remove('flex');
            }, 300);
        }



        window.onclick = function(event) {
            const modalAdd = document.getElementById('modal-add');
            const modalWithdraw = document.getElementById('modal-withdraw');
            const modalPickup = document.getElementById('modal-pickup');
            if (event.target == modalAdd) {
                closeModal();
            }
            if (event.target == modalWithdraw) {
                closeWithdrawModal();
            }
            if (event.target == modalPickup) {
                closePickupModal();
            }
        }
    </script>
</x-app-layout>