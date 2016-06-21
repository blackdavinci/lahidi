jQuery(document).ready(function($) {


                  $('#container').highcharts({
                      chart: {
                          type: 'bar'
                      },
                      title: {
                          text: 'Fruit Consumption'
                      },
                      xAxis: {
                          categories: ['Apples', 'Bananas', 'Oranges']
                      },
                      yAxis: {
                          title: {
                              text: 'Fruit eaten'
                          }
                      },
                      series: [{
                          name: 'Jane',
                          data: [1, 0, 4]
                      }, {
                          name: 'John',
                          data: [5, 7, 3]
                      }]
                  });
        
     
	
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
	});

	// HIGHCHARTS FUNCTION




	
});