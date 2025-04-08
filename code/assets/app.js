

// js

import './js/bootstrap.min.js'
import './js/jquery-3.6.0.min.js'
import './js/map.js'
import './js/theme.js'
import './js/pricetable-toggler.js'
import '@symfony/ux-chartjs'; // This is necessary

// font awesome


import { Chart } from 'chart.js';
import zoomPlugin from 'chartjs-plugin-zoom';

Chart.register(zoomPlugin);  // Register the plugin with Chart.js

// document.addEventListener('chartjs:init', function (event) {
//     const Chart = event.detail.Chart;
//     Chart.register(zoomPlugin);
// });

// ...