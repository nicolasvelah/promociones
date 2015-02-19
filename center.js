$(document).ready(function(){
	ultimo_elemento = jQuery('.promociones .row').last();
	totalWidth = 0;

	ultimo_elemento.children().each(function() {
		  this_width = jQuery(this).width();
	      totalWidth = totalWidth + jQuery(this).width();
	      jQuery(this).css('width', this_width);
	});

	ultimo_elemento.css('width', totalWidth);
});