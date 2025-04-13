// ✅ FIRST: Import jQuery and assign it globally
import $ from 'jquery';
window.$ = $;
window.jQuery = $;

// ✅ THEN: Import other libraries that rely on jQuery
import 'bootstrap';
import './js/adminlte'; // This one uses jQuery too

// ✅ ChartJS and plugins
import Chart from 'chart.js/auto';
import zoomPlugin from 'chartjs-plugin-zoom';
Chart.register(zoomPlugin);
import '@symfony/ux-chartjs';

// ✅ Stimulus
import '@hotwired/stimulus';

// ✅ Other custom scripts (map, theme, etc.)
import './js/map.js';
import './js/theme.js';
import './js/pricetable-toggler.js';

// ✅ Optional: Font Awesome
// import '@fortawesome/fontawesome-free/js/all';
