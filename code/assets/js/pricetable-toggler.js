(function ($) {
	'use strict';
	
	$(document).ready(function () {

        // Pricetable Toggler
        var $monthlyFilter = $("#filt-monthly"),
            $yearlyFilter = $("#filt-yearly"),
            $switcher = $("#switcher"),
            $monthly = $("#monthly"),
            $yearly = $("#yearly");

        // Only initialize if all required elements exist
        if ($monthlyFilter.length && $yearlyFilter.length && $switcher.length && $monthly.length && $yearly.length) {
            $monthlyFilter.on("click", function(){
                $switcher.prop("checked", false);
                $monthlyFilter.addClass("toggler--is-active");
                $yearlyFilter.removeClass("toggler--is-active");
                $monthly.removeClass("d-none");
                $yearly.addClass("d-none");
            });

            $yearlyFilter.on("click", function(){
                $switcher.prop("checked", true);
                $yearlyFilter.addClass("toggler--is-active");
                $monthlyFilter.removeClass("toggler--is-active");
                $monthly.addClass("d-none");
                $yearly.removeClass("d-none");
            });

            $switcher.on("click", function(){
                $yearlyFilter.toggleClass("toggler--is-active");
                $monthlyFilter.toggleClass("toggler--is-active");
                $monthly.toggleClass("d-none");
                $yearly.toggleClass("d-none");
            });
        }

    });      
})(jQuery);