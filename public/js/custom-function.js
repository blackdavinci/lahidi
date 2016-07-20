jQuery(document).ready(function($) {

	$('[data-toggle="tooltip"]').tooltip();

	// testimonial
	var TestiSlide = $('.bxslider');
	TestiSlide.bxSlider({
		auto: true,
		pager: false,
		controls: false,
		useCSS: false,
		speed: 2000,
		easing: 'easeOutElastic',
		mode: 'horizontal',
		controlDirections:true
	});

	$('#categorieTable').DataTable({
		language: {
		        url: '/../json/French.json'
		    }
	});

	$('#engagementTable').DataTable({
		language: {
		        url: '/../json/French.json'
		    }

	});

	$('#secteurTable').DataTable({
		language: {
		        url: '/../json/French.json'
		    }
	});
	
	$('#etatTable').DataTable({
		language: {
		        url: '/../json/French.json'
		    }
	});
	
	$('#userTable').DataTable({
		language: {
		        url: '/../json/French.json'
		    }
	});
	
	$('#articleTable').DataTable({
		language: {
		        url: '/../json/French.json'
		    }
	});

	$('.input-daterange').datepicker({
	    language: "fr",
	    format: "dd-mm-yyyy",
	    orientation: "top left"
	});
	
});