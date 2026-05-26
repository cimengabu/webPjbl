// Memasukkan fungsi bootstrap langsung agar tidak perlu import file luar
import axios from 'axios';
window.axios = axios;
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

// Fungsi asli app.js
import Alpine from 'alpinejs';
window.Alpine = Alpine;
Alpine.start();

import './bootstrap';

window.detectLocation = function () {
    if (!navigator.geolocation) {
        alert("Browser tidak mendukung deteksi lokasi.");
        return;
    }

    navigator.geolocation.getCurrentPosition(
        async function (position) {
            const lat = position.coords.latitude;
            const lng = position.coords.longitude;

            try {
                const response = await fetch(`/api/bank-sampah/nearby?lat=${lat}&lng=${lng}&radius=10000`);
                const data = await response.json();

                console.log(data);

                const result = document.getElementById('result');

                if (!result) return;

                if (data.length === 0) {
                    result.innerHTML = `<p>Tidak ada bank sampah terdekat.</p>`;
                    return;
                }

                result.innerHTML = data.map(item => `
                    <div style="border:1px solid #ddd; padding:12px; margin-bottom:10px; border-radius:8px;">
                        <h4>${item.nama}</h4>
                        <p>${item.alamat ?? '-'}</p>
                        <p>Jarak: ${(item.distance / 1000).toFixed(2)} km</p>
                        <a target="_blank" href="https://www.google.com/maps/dir/?api=1&destination=${item.latitude},${item.longitude}">
                            Buka Rute
                        </a>
                    </div>
                `).join('');

            } catch (error) {
                console.error(error);
                alert("Gagal mengambil data bank sampah.");
            }
        },
        function () {
            alert("Gagal mengambil lokasi. Pastikan izin lokasi aktif.");
        },
        {
            enableHighAccuracy: true,
            timeout: 10000,
            maximumAge: 0
        }
    );
};