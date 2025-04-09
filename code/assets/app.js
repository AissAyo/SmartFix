

// js

import 'jquery';
import $ from 'jquery';
window.$ = $;
window.jQuery = $;
import 'bootstrap';

import '@symfony/ux-chartjs'; // Correct way to import Symfony UX packages
import '@hotwired/stimulus';
import Chart from 'chart.js/auto';
import zoomPlugin from 'chartjs-plugin-zoom';
import '@symfony/ux-chartjs';
Chart.register(zoomPlugin);

import './js/map.js'
import './js/theme.js'
import './js/pricetable-toggler.js'
import './js/adminlte'
// import  './js/adminlte.js.map'
// import  './js/adminlte.min.js.map'
// import  './js/adminlte.min.js'


// font awesome





// document.addEventListener('chartjs:init', function (event) {
//     const Chart = event.detail.Chart;
//     Chart.register(zoomPlugin);
// });

// ...