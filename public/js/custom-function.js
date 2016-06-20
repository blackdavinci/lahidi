jQuery(document).ready(function($) {
	
	
	$('[data-toggle="tooltip"]').tooltip();

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

	$('#myTabs a').click(function (e) {
	  e.preventDefault()
	  $(this).tab('show')
	})
	
});