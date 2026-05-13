<x-app-layout>
    <x-slot name="header">
        <h2 class="font-black text-3xl text-white tracking-tight">
            {{ __('Peta Bank Sampah') }}
        </h2>
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
    </style>

    <div class="py-12 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            <div class="bg-white/5 backdrop-blur-xl border border-white/10 overflow-hidden shadow-2xl sm:rounded-[2.5rem]">
                <div class="p-8 text-white">
                    <div class="flex items-center gap-4 mb-6">
                        <div class="w-12 h-12 bg-emerald-500/20 border border-emerald-500/30 rounded-xl flex items-center justify-center text-emerald-400 shadow-[0_0_15px_rgba(16,185,129,0.2)]">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        </div>
                        <div>
                            <h3 class="text-2xl font-black text-white tracking-tight">Temukan Pusat Daur Ulang Terdekat</h3>
                            <p class="text-emerald-400/80 text-sm font-medium mt-1">Gunakan peta interaktif di bawah ini untuk mencari lokasi bank sampah terdekat beserta jenis sampah yang mereka terima.</p>
                        </div>
                    </div>
                    
                    <!-- Peta Container -->
                    <div id="map" class="shadow-2xl border border-white/10 rounded-2xl overflow-hidden" style="height: 600px; width: 100%; z-index: 1;"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Leaflet JS -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize the map centered around Jakarta (default focus)
            var map = L.map('map').setView([-6.200000, 106.816666], 11);

            // Set up the OSM layer
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
                attribution: '© OpenStreetMap contributors'
            }).addTo(map);

            // Fetch centers data passed from Controller
            var centers = @json($centers);

            centers.forEach(function(center) {
                var materialsList = center.accepted_materials.join(', ');
                
                var popupContent = `
                    <div style="min-width: 220px; padding: 4px;">
                        <h4 style="margin: 0 0 4px 0; color: #34d399; font-weight: 900; font-size: 16px; text-transform: uppercase; letter-spacing: 0.05em;">${center.name}</h4>
                        <p style="margin: 0 0 12px 0; color: #9ca3af; font-size: 12px; line-height: 1.4;">${center.address}</p>
                        <div style="background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); padding: 8px; border-radius: 8px; margin-bottom: 12px;">
                            <p style="margin: 0 0 4px 0; font-size: 10px; font-weight: 800; color: #6ee7b7; text-transform: uppercase; letter-spacing: 0.1em;">Menerima:</p>
                            <p style="margin: 0; font-size: 12px; color: #e5e7eb; font-weight: 500;">${materialsList}</p>
                        </div>
                        <a href="https://www.google.com/maps/dir/?api=1&destination=${center.latitude},${center.longitude}" target="_blank" style="display: block; background: linear-gradient(to right, #10b981, #0d9488); color: #050b14; text-align: center; padding: 8px 0; border-radius: 8px; text-decoration: none; font-size: 12px; font-weight: 900; text-transform: uppercase; letter-spacing: 0.1em; transition: all 0.3s;">Rute ke Sini</a>
                    </div>
                `;

                // Create a custom pulsing marker icon
                var customIcon = L.divIcon({
                    className: 'custom-div-icon',
                    html: "<div style='background-color:#10b981; width:16px; height:16px; border-radius:50%; border:3px solid #050b14; box-shadow: 0 0 15px rgba(16,185,129,0.8);'></div>",
                    iconSize: [20, 20],
                    iconAnchor: [10, 10]
                });

                L.marker([center.latitude, center.longitude], {icon: customIcon})
                 .addTo(map)
                 .bindPopup(popupContent);
            });
            
            // Optional: Coba deteksi lokasi user jika diizinkan browser
            map.locate({setView: true, maxZoom: 12});
            
            map.on('locationfound', function(e) {
                L.circle(e.latlng, {
                    color: '#3B82F6',
                    fillColor: '#3B82F6',
                    fillOpacity: 0.1,
                    radius: e.accuracy / 2
                }).addTo(map);
                
                var userIcon = L.divIcon({
                    className: 'user-div-icon',
                    html: "<div style='background-color:#3b82f6; width:14px; height:14px; border-radius:50%; border:2px solid #fff; box-shadow: 0 0 15px rgba(59,130,246,0.8);'></div>",
                    iconSize: [18, 18],
                    iconAnchor: [9, 9]
                });

                L.marker(e.latlng, {icon: userIcon}).addTo(map).bindPopup("<div style='color:#3b82f6; font-weight:bold;'>Lokasi Anda</div>").openPopup();
            });
        });
    </script>
</x-app-layout>
