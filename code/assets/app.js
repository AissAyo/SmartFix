// // ✅ FIRST: Import jQuery and assign it globally
// import $ from 'jquery';
// window.$ = $;
// window.jQuery = $;

// // ✅ THEN: Import other libraries that rely on jQuery
import './js/bootstrap.min.js';
// import './js/adminlte.js'; // This one uses jQuery too

// // ✅ Stimulus
// import '@hotwired/stimulus';

import './js/jquery-3.6.0.min.js'
// import './js/map.js'
// import './js/theme.js'
// import './js/pricetable-toggler.js'
// import './js/client'

// // ✅ Other custom scripts (map, theme, etc.)
// // Ensure jQuery is available before importing map.js
// if (typeof window.jQuery === 'undefined') {
//     window.jQuery = $;
// }
// import './js/map.js';
// import './js/theme.js';
// import './js/pricetable-toggler.js';

// // ✅ Optional: Font Awesome
// // import '@fortawesome/fontawesome-free/js/all';

// // ✅ Correct CSS imports
// import './css/bootstrap-icons.css'; // Ensure the path is correct
// import './css/portfolio.css'; // Ensure the path is correct
// import "./css/sidebar.css"; // Ensure the path is correct
// Import jQuery and assign it globally
import $ from 'jquery';
window.$ = $;
window.jQuery = $;

// Import Bootstrap
import 'bootstrap';
import 'bootstrap/dist/css/bootstrap.min.css';

// Import other libraries
import './js/adminlte.js';
import '@hotwired/stimulus';

// Import custom scripts
import './js/theme.js';
import './js/map.js';
import './plugins/wow/wow.min.js';
import './plugins/swiper/swiper-bundle.min.js';
import './plugins/odometer/appear.js';
import './plugins/odometer/odometer.js';
import './plugins/fancybox/jquery.fancybox.min.js';
import './plugins/flatpickr/flatpickr.min.js';
import './plugins/nice-select/jquery.nice-select.min.js';
import './js/pricetable-toggler.js';
import './js/client';

// Initialize Bootstrap components
import 'bootstrap/js/dist/collapse';
import 'bootstrap/js/dist/dropdown';
import 'bootstrap/js/dist/modal';
















// Initialize tooltips
document.addEventListener('DOMContentLoaded', () => {
    const tooltips = document.querySelectorAll('[data-bs-toggle="tooltip"]');
    tooltips.forEach(tooltip => new bootstrap.Tooltip(tooltip));
});