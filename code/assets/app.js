// ✅ FIRST: Import jQuery and assign it globally
import $ from 'jquery';
window.$ = $;
window.jQuery = $;

// ✅ THEN: Import other libraries that rely on jQuery
import './js/bootstrap.min.js';
import './js/adminlte.js'; // This one uses jQuery too

// ✅ Stimulus
import '@hotwired/stimulus';

// ✅ Other custom scripts (map, theme, etc.)
import './js/map.js';
import './js/theme.js';
import './js/pricetable-toggler.js';

// ✅ Optional: Font Awesome
// import '@fortawesome/fontawesome-free/js/all';

// ✅ Correct CSS imports
import './css/bootstrap-icons.css'; // Ensure the path is correct
import './css/portfolio.css'; // Ensure the path is correct
import "./css/sidebar.css"; // Ensure the path is correct
