<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-4">
            <x-back-button fallback="{{ route('home') }}" />
            <h2 class="font-black text-3xl text-white tracking-tight">
                {{ __('Peta Bank Sampah') }}
            </h2>
        </div>
    </x-slot>

    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>
    
    <!-- Dark Theme Override for Leaflet -->
    <style>
        .leaflet-container {
            background: #050B14;
            font-family: 'Space Grotesk', sans-serif;
        }
        .leaflet-layer,
        .leaflet-control-zoom-in,
        .leaflet-control-zoom-out,
        .leaflet-control-attribution {
            filter: invert(100%) hue-rotate(180deg) brightness(95%) contrast(90%);
        }
        .leaflet-popup-content-wrapper, .leaflet-popup-tip {
            background: rgba(5, 11, 20, 0.95) !important;
            backdrop-filter: blur(10px) !important;
            border: 1px solid rgba(16, 185, 129, 0.3) !important;
            color: white !important;
            box-shadow: 0 10px 25px rgba(0,0,0,0.5) !important;
        }
        .leaflet-popup-close-button {
            color: #10b981 !important;
        }
        /* Custom scrollbar for the list */
        .custom-scrollbar::-webkit-scrollbar {
            width: 6px;
        }
        .custom-scrollbar::-webkit-scrollbar-track {
            background: rgba(255, 255, 255, 0.05); 
            border-radius: 10px;
        }
        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: rgba(16, 185, 129, 0.5); 
            border-radius: 10px;
        }
        .custom-scrollbar::-webkit-scrollbar-thumb:hover {
            background: rgba(16, 185, 129, 0.8); 
        }
    </style>

    <div class="py-12 min-h-screen">
        <div class="max-w-[100rem] mx-auto sm:px-6 lg:px-8">
            <div class="flex flex-col lg:flex-row gap-8 h-[calc(100vh-12rem)] min-h-[700px]">
                
                <!-- Left Panel: Locator and List -->
                <div class="w-full lg:w-1/3 flex flex-col gap-6">
                    <!-- Title & Action -->
                    <div class="bg-white/5 backdrop-blur-xl border border-white/10 p-6 shadow-2xl rounded-3xl">
                        <div class="flex items-start gap-4 mb-6">
                            <div class="w-12 h-12 bg-emerald-500/20 border border-emerald-500/30 rounded-xl flex items-center justify-center text-emerald-400 shrink-0 shadow-[0_0_15px_rgba(16,185,129,0.2)]">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                            </div>
                            <div>
                                <h3 class="text-xl font-black text-white tracking-tight">Temukan Pusat Daur Ulang Terdekat</h3>
                                <p class="text-emerald-400/80 text-xs font-medium mt-1">Gunakan peta interaktif atau fitur deteksi lokasi untuk mencari bank sampah terdekat.</p>
                            </div>
                        </div>

                        <!-- Locate Button & Filters -->
                        <div class="space-y-4">
                            <button id="btn-locate" onclick="findNearby()" class="w-full bg-emerald-500/20 hover:bg-emerald-500/30 border border-emerald-500/50 text-emerald-400 py-3 rounded-xl text-sm font-bold transition-all flex items-center justify-center gap-2 shadow-[0_0_15px_rgba(16,185,129,0.2)]">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                Deteksi Lokasi Saya
                            </button>

                            <div class="flex items-center gap-2">
                                <span class="text-xs font-bold text-gray-400 uppercase tracking-widest">Radius:</span>
                                <select id="radius-select" onchange="if(userCurrentLat) findNearby()" class="bg-[#050B14] border border-white/10 text-white text-xs rounded-lg px-3 py-1.5 focus:border-emerald-500 focus:ring focus:ring-emerald-500/20 outline-none transition-all flex-1">
                                    <option value="1">1 km</option>
                                    <option value="3">3 km</option>
                                    <option value="5">5 km</option>
                                    <option value="10" selected>10 km</option>
                                    <option value="20">20 km</option>
                                    <option value="50">50 km</option>
                                    <option value="100">100 km</option>
                                    <option value="500">500 km</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Nearby List -->
                    <div class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-3xl flex-1 flex flex-col overflow-hidden shadow-2xl">
                        <div class="p-4 border-b border-white/10 bg-white/5 flex justify-between items-center">
                            <h4 class="text-sm font-black text-white uppercase tracking-widest">Daftar Lokasi</h4>
                            <span id="result-count" class="text-xs text-emerald-400 font-bold bg-emerald-500/10 px-2 py-1 rounded-md">{{ count($centers) }} Total</span>
                        </div>
                        <div id="centers-list" class="flex-1 overflow-y-auto p-4 space-y-3 custom-scrollbar">
                            <!-- List item template -->
                            <div class="text-center py-8 text-gray-500 text-sm">
                                Klik "Deteksi Lokasi Saya" untuk melihat bank sampah terdekat, atau jelajahi peta.
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Panel: Map -->
                <div class="w-full lg:w-2/3 flex flex-col">
                    <div class="bg-white/5 backdrop-blur-xl border border-white/10 overflow-hidden shadow-2xl rounded-3xl flex-1 flex flex-col relative">
                        <!-- Top Floating Bar for Report -->
                        <div class="absolute top-4 right-4 z-[400]">
                            @auth
                                <button onclick="openReportModal()" class="bg-red-500/90 hover:bg-red-500 backdrop-blur-md border border-red-500 text-white px-4 py-2.5 rounded-xl text-sm font-bold transition-all shadow-[0_5px_20px_rgba(239,68,68,0.4)] flex items-center gap-2">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                                    Lapor Fasilitas
                                </button>
                            @else
                                <a href="{{ route('login') }}" class="bg-red-500/90 hover:bg-red-500 backdrop-blur-md border border-red-500 text-white px-4 py-2.5 rounded-xl text-sm font-bold transition-all shadow-[0_5px_20px_rgba(239,68,68,0.4)] flex items-center gap-2">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                                    Lapor Fasilitas
                                </a>
                            @endauth
                        </div>

                        <!-- Map -->
                        <div id="map" class="w-full h-full z-10" style="min-height: 500px;"></div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    {{-- Report Modal --}}
    <div id="modal-report" class="fixed inset-0 bg-black/90 backdrop-blur-md hidden items-center justify-center z-[1000] p-4 transition-all opacity-0 duration-300">
        <div class="bg-zinc-900 border border-red-500/30 p-8 rounded-[2.5rem] w-full max-w-md shadow-[0_0_100px_rgba(239,68,68,0.2)] transform scale-95 transition-transform duration-300" id="modal-report-content">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-2xl font-black italic text-white uppercase tracking-tighter">Lapor Fasilitas</h3>
                <button onclick="closeReportModal()" class="text-gray-500 hover:text-white transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>
            
            <form action="{{ route('reports.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-[10px] font-black uppercase tracking-widest text-red-400 mb-2">Lokasi / Nama Bank Sampah</label>
                    <input type="text" name="location" required placeholder="Contoh: Bank Sampah Melati" class="w-full bg-[#050B14] border border-white/10 rounded-2xl p-4 text-white focus:border-red-500 focus:ring focus:ring-red-500/20 outline-none transition-all">
                </div>
                
                <div>
                    <label class="block text-[10px] font-black uppercase tracking-widest text-red-400 mb-2">Deskripsi Masalah</label>
                    <textarea name="description" required rows="3" placeholder="Fasilitas tutup, penuh, rusak, dll..." class="w-full bg-[#050B14] border border-white/10 rounded-2xl p-4 text-white focus:border-red-500 focus:ring focus:ring-red-500/20 outline-none transition-all"></textarea>
                </div>

                <div>
                    <label class="block text-[10px] font-black uppercase tracking-widest text-red-400 mb-2">Foto Bukti</label>
                    <input type="file" name="photo" accept="image/*" required class="w-full bg-[#050B14] border border-white/10 rounded-2xl p-4 text-white focus:border-red-500 focus:ring focus:ring-red-500/20 outline-none transition-all file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-bold file:bg-red-500/20 file:text-red-400 hover:file:bg-red-500/30">
                </div>
                
                <div class="pt-4">
                    <button type="submit" class="w-full bg-red-600 text-white font-black py-4 rounded-2xl uppercase tracking-[0.2em] hover:bg-red-500 transition-all shadow-[0_0_20px_rgba(239,68,68,0.3)] active:scale-95 text-sm">
                        Kirim Laporan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Leaflet JS -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    <script>
        // Global variables
        let map;
        let userMarker;
        let userCircle;
        let userCurrentLat = null;
        let userCurrentLng = null;
        let centerMarkers = [];
        let allCenters = @json($centers);

        document.addEventListener('DOMContentLoaded', function() {
            // Initialize the map
            map = L.map('map').setView([-0.7893, 113.9213], 5);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
                attribution: '© OpenStreetMap'
            }).addTo(map);

            // Tampilkan semua data awal di list & map
            renderCentersList(allCenters, false);
            renderMarkers(allCenters);
        });

        // Icon Definitions
        function getCustomIcon(isBank) {
            var color = isBank ? '#10b981' : '#eab308'; 
            var shadowColor = isBank ? 'rgba(16,185,129,0.8)' : 'rgba(234,179,8,0.8)';
            return L.divIcon({
                className: 'custom-div-icon',
                html: "<div style='background-color:" + color + "; width:16px; height:16px; border-radius:50%; border:3px solid #050b14; box-shadow: 0 0 15px " + shadowColor + ";'></div>",
                iconSize: [20, 20],
                iconAnchor: [10, 10]
            });
        }

        function getUserIcon() {
            return L.divIcon({
                className: 'user-div-icon',
                html: "<div style='background-color:#3b82f6; width:16px; height:16px; border-radius:50%; border:3px solid #fff; box-shadow: 0 0 15px rgba(59,130,246,0.8);'></div>",
                iconSize: [20, 20],
                iconAnchor: [10, 10]
            });
        }

        // Tampilkan Marker di Peta
        function renderMarkers(centersData) {
            // Clear existing markers
            centerMarkers.forEach(m => map.removeLayer(m));
            centerMarkers = [];

            centersData.forEach(function(center) {
                var materialsArray = [];
                if (center.accepted_materials) {
                    if (Array.isArray(center.accepted_materials)) {
                        materialsArray = center.accepted_materials;
                    } else if (typeof center.accepted_materials === 'string') {
                        try { materialsArray = JSON.parse(center.accepted_materials); } catch(e) { materialsArray = [center.accepted_materials]; }
                    }
                }
                var materialsList = materialsArray.length ? materialsArray.join(', ') : '-';
                
                var lat = parseFloat(center.latitude);
                var lng = parseFloat(center.longitude);
                
                let mapsQuery = encodeURIComponent(center.name + ' ' + center.address);
                
                if (center.name.includes("Kitiran Emas")) {
                    mapsQuery = "Bank+Sampah+Kitiran+Emas+Purwosari+Surakarta";
                } else if (center.name.includes("Kamulyan")) {
                    mapsQuery = "Bank+Sampah+Kamulyan+Kestalan+Surakarta";
                } else if (center.name.includes("Merti Bumi")) {
                    mapsQuery = "Bank+Sampah+Merti+Bumi+Kadipiro+Surakarta";
                } else if (center.name.includes("Guyub Rukun")) {
                    mapsQuery = "Bank+Sampah+Guyub+Rukun+Dibal+Boyolali";
                } else if (center.name.includes("Mekar Asri")) {
                    mapsQuery = "Bank+Sampah+Mekar+Asri+Mojosongo+Surakarta";
                } else if (center.name.includes("Induk Jakarta Selatan")) {
                    mapsQuery = "Bank+Sampah+Induk+Jakarta+Selatan+Mampang+Prapatan";
                }
                
                var popupContent = `
                    <div style="min-width: 220px; padding: 4px;">
                        <h4 style="margin: 0 0 4px 0; color: #34d399; font-weight: 900; font-size: 16px; text-transform: uppercase; letter-spacing: 0.05em;">${center.name}</h4>
                        <p style="margin: 0 0 12px 0; color: #9ca3af; font-size: 12px; line-height: 1.4;">${center.address}</p>
                        <div style="background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); padding: 8px; border-radius: 8px; margin-bottom: 12px;">
                            <p style="margin: 0 0 4px 0; font-size: 10px; font-weight: 800; color: #6ee7b7; text-transform: uppercase; letter-spacing: 0.1em;">Menerima:</p>
                            <p style="margin: 0; font-size: 12px; color: #e5e7eb; font-weight: 500;">${materialsList}</p>
                        </div>
                        <a href="https://www.google.com/maps/search/?api=1&query=${mapsQuery}" target="_blank" style="display: block; background: linear-gradient(to right, #10b981, #0d9488); color: #050b14; text-align: center; padding: 8px 0; border-radius: 8px; text-decoration: none; font-size: 12px; font-weight: 900; text-transform: uppercase; letter-spacing: 0.1em; transition: all 0.3s;">Rute ke Sini</a>
                    </div>
                `;

                var isBank = center.name.toLowerCase().includes('bank');
                var marker = L.marker([lat, lng], {
                    icon: getCustomIcon(isBank)
                }).bindPopup(popupContent);
                
                // Simpan data ID di marker untuk interaksi
                marker.centerId = center.id;
                marker.addTo(map);
                centerMarkers.push(marker);
            });
        }

        // Render List di Sidebar
        function renderCentersList(centersData, showDistance = false) {
            const listContainer = document.getElementById('centers-list');
            const countLabel = document.getElementById('result-count');
            
            listContainer.innerHTML = '';
            countLabel.textContent = `${centersData.length} Ditemukan`;

            if (centersData.length === 0) {
                listContainer.innerHTML = `
                    <div class="text-center py-8 text-gray-500 text-sm">
                        Tidak ada bank sampah yang ditemukan di radius ini.
                    </div>
                `;
                return;
            }

            centersData.forEach(center => {
                var materialsArray = [];
                if (center.accepted_materials) {
                    if (Array.isArray(center.accepted_materials)) {
                        materialsArray = center.accepted_materials;
                    } else if (typeof center.accepted_materials === 'string') {
                        try { materialsArray = JSON.parse(center.accepted_materials); } catch(e) { materialsArray = [center.accepted_materials]; }
                    }
                }
                var materialsList = materialsArray.length ? materialsArray.join(', ') : '-';
                
                var lat = parseFloat(center.latitude);
                var lng = parseFloat(center.longitude);

                var isBank = center.name.toLowerCase().includes('bank');
                var colorClass = isBank ? 'text-emerald-400 bg-emerald-500/10 border-emerald-500/30' : 'text-yellow-400 bg-yellow-500/10 border-yellow-500/30';
                var iconType = isBank ? 'Bank' : 'Layanan';
                
                var distBadge = '';
                if (showDistance && center.distance_km !== undefined) {
                    distBadge = `<div class="bg-gray-800 text-gray-300 text-[10px] font-bold px-2 py-1 rounded border border-gray-700">${center.distance_km} km</div>`;
                }

                const itemHTML = `
                    <div class="bg-[#050B14] border border-white/5 p-4 rounded-2xl hover:border-emerald-500/30 transition-all cursor-pointer group shadow-lg" onclick="focusOnCenter(${lat}, ${lng}, ${center.id})">
                        <div class="flex justify-between items-start mb-2">
                            <h5 class="font-bold text-white group-hover:text-emerald-400 transition-colors text-sm pr-2 leading-tight">${center.name}</h5>
                            <div class="flex gap-1 shrink-0">
                                ${distBadge}
                                <span class="${colorClass} border text-[10px] font-bold px-2 py-1 rounded uppercase">${iconType}</span>
                            </div>
                        </div>
                        <p class="text-gray-400 text-xs mb-3 line-clamp-2 leading-relaxed">${center.address}</p>
                        
                        <div class="flex items-center justify-between mt-auto">
                             <div class="flex-1 overflow-hidden">
                                <p class="text-[10px] text-gray-500 font-medium uppercase tracking-wider mb-0.5">Menerima</p>
                                <p class="text-xs text-gray-300 truncate">${materialsList}</p>
                            </div>
                            <div class="w-8 h-8 rounded-full bg-emerald-500/10 flex items-center justify-center group-hover:bg-emerald-500 group-hover:text-white text-emerald-500 transition-colors shrink-0 ml-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                            </div>
                        </div>
                    </div>
                `;
                listContainer.insertAdjacentHTML('beforeend', itemHTML);
            });
        }

        // Fokus ke titik di peta
        function focusOnCenter(lat, lng, centerId) {
            map.flyTo([lat, lng], 15, { duration: 1.5 });
            
            // Cari marker dan buka popupnya
            const marker = centerMarkers.find(m => m.centerId === centerId);
            if (marker) {
                setTimeout(() => {
                    marker.openPopup();
                }, 1500);
            }
        }

        // Deteksi Lokasi dan Cari Terdekat
        function findNearby() {
            const btn = document.getElementById('btn-locate');
            const radius = document.getElementById('radius-select').value;
            
            const listContainer = document.getElementById('centers-list');
            
            if (!navigator.geolocation) {
                listContainer.innerHTML = `
                    <div class="text-center py-8 text-red-500 text-sm bg-red-500/10 rounded-xl m-2 border border-red-500/20">
                        <strong>Fitur GPS tidak didukung.</strong><br>Browser Anda tidak mendukung deteksi lokasi.
                    </div>
                `;
                return;
            }

            btn.innerHTML = `<svg class="animate-spin -ml-1 mr-2 h-5 w-5 text-emerald-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg> Mencari...`;

            navigator.geolocation.getCurrentPosition(
                (position) => {
                    userCurrentLat = position.coords.latitude;
                    userCurrentLng = position.coords.longitude;
                    const accuracy = position.coords.accuracy;

                    // Update User Marker
                    if (userMarker) {
                        map.removeLayer(userMarker);
                        map.removeLayer(userCircle);
                    }
                    
                    const latlng = [userCurrentLat, userCurrentLng];
                    
                    userCircle = L.circle(latlng, {
                        color: '#3B82F6',
                        fillColor: '#3B82F6',
                        fillOpacity: 0.1,
                        radius: accuracy > 500 ? 500 : accuracy // Cap accuracy radius for visual clarity
                    }).addTo(map);
                    
                    userMarker = L.marker(latlng, {icon: getUserIcon()})
                                  .addTo(map)
                                  .bindPopup("<div style='color:#3b82f6; font-weight:bold;'>Lokasi Anda Saat Ini</div>");
                    
                    // Fetch Data API
                    fetch(`/api/recycling-centers/nearby?lat=${userCurrentLat}&lng=${userCurrentLng}&radius=${radius}`, {
                        headers: {
                            'Accept': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    })
                        .then(res => {
                            if (!res.ok) throw new Error('Network response was not ok');
                            return res.json();
                        })
                        .then(data => {
                            if (data.success) {
                                renderCentersList(data.centers, true);
                                renderMarkers(data.centers);
                                
                                // Auto zoom to show user and nearest (if any)
                                if (data.centers.length > 0) {
                                    // Bounding box yg mencakup user + centers
                                    const bounds = L.latLngBounds([latlng]);
                                    data.centers.forEach(c => bounds.extend([parseFloat(c.latitude), parseFloat(c.longitude)]));
                                    map.fitBounds(bounds, { padding: [50, 50], maxZoom: 14 });
                                } else {
                                    map.setView(latlng, 13);
                                }
                            }
                        })
                        .catch(err => {
                            console.error("Fetch Error: ", err);
                            document.getElementById('centers-list').innerHTML = `
                                <div class="text-center py-8 text-red-500 text-sm bg-red-500/10 rounded-xl m-2 border border-red-500/20">
                                    <strong>Gagal terhubung ke server.</strong><br>Pastikan internet lancar atau refresh halaman ini.
                                </div>
                            `;
                        })
                        .finally(() => {
                            btn.innerHTML = `<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg> Perbarui Lokasi Saya`;
                        });
                },
                (error) => {
                    btn.innerHTML = `<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg> Deteksi Lokasi Saya`;
                    document.getElementById('centers-list').innerHTML = `
                        <div class="text-center py-8 text-yellow-500 text-sm bg-yellow-500/10 rounded-xl m-2 border border-yellow-500/20">
                            <strong>Akses Lokasi Ditolak/Gagal.</strong><br>Izinkan akses lokasi pada browser Anda agar fitur ini berfungsi.
                        </div>
                    `;
                },
                { enableHighAccuracy: true, timeout: 10000, maximumAge: 0 }
            );
        }

        // Report Modal Functions
        function openReportModal() {
            const modal = document.getElementById('modal-report');
            const content = document.getElementById('modal-report-content');
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

        function closeReportModal() {
            const modal = document.getElementById('modal-report');
            const content = document.getElementById('modal-report-content');
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
            const modalReport = document.getElementById('modal-report');
            if (event.target == modalReport) {
                closeReportModal();
            }
        }
    </script>
</x-app-layout>
