// No conflict for WordPress
var $j = jQuery.noConflict();

$j(function () {
	$j('.footable').footable({
	   breakpoints: {
        tiny: 100,
        medium: 555,
        big: 2048
    }
    });
});