<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-gray-800 leading-tight">
            {{ __('Peta Bank Sampah') }}
        </h2>
    </x-slot>

    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>
    
    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="bg-emerald-100 p-3 rounded-full text-emerald-600">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-gray-800">Temukan Pusat Daur Ulang Terdekat</h3>
                            <p class="text-gray-500 text-sm">Gunakan peta interaktif di bawah ini untuk mencari lokasi bank sampah terdekat beserta jenis sampah yang mereka terima.</p>
                        </div>
                    </div>
                    
                    <!-- Peta Container -->
                    <div id="map" class="shadow-inner border border-gray-200" style="height: 500px; width: 100%; border-radius: 0.75rem; z-index: 1;"></div>
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
                    <div style="min-width: 200px;">
                        <h4 style="margin: 0 0 4px 0; color: #059669; font-weight: bold; font-size: 14px;">${center.name}</h4>
                        <p style="margin: 0 0 8px 0; color: #4B5563; font-size: 12px; line-height: 1.4;">${center.address}</p>
                        <div style="background: #F3F4F6; padding: 6px; border-radius: 4px;">
                            <p style="margin: 0 0 2px 0; font-size: 12px; font-weight: 600; color: #1F2937;">Menerima:</p>
                            <p style="margin: 0; font-size: 12px; color: #4B5563;">${materialsList}</p>
                        </div>
                        <a href="https://www.google.com/maps/dir/?api=1&destination=${center.latitude},${center.longitude}" target="_blank" style="display: block; margin-top: 10px; background: #10B981; color: white; text-align: center; padding: 4px 0; border-radius: 4px; text-decoration: none; font-size: 12px; font-weight: bold;">Rute ke Sini</a>
                    </div>
                `;

                L.marker([center.latitude, center.longitude])
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
                
                L.circleMarker(e.latlng, {
                    color: '#FFFFFF',
                    fillColor: '#3B82F6',
                    fillOpacity: 1,
                    radius: 6,
                    weight: 2
                }).addTo(map).bindPopup("Lokasi Anda saat ini").openPopup();
            });
        });
    </script>
</x-app-layout>
