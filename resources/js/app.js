// Memasukkan fungsi bootstrap langsung agar tidak perlu import file luar
import axios from 'axios';
window.axios = axios;
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

// Fungsi asli app.js
import Alpine from 'alpinejs';
window.Alpine = Alpine;
Alpine.start();