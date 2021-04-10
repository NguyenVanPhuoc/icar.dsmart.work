$(document).ready(function(){
	$('.toggle-cs').on('click', function(e) {
		e.preventDefault();
		$(this).closest('.list-item').find('.list-child').slideToggle();
	});
	if($('.check__checkbox_all').length > 0) {
		$('.check__checkbox_all').each(function() {
			var count = $(this).find('.list-child input[type="checkbox"]').length;
			var check = $(this).find('.list-child input[type="checkbox"]:checked').length;
			if(count == check) $(this).find('.parent-check').prop('checked', true);
		});
	}
	$('.check__checkbox_all .parent-check').on('change', function() {
		if($(this).prop('checked')) {
			$(this).closest('.check__checkbox_all').find('.list-child input[type="checkbox"]').prop('checked', true);
		}else{
			$(this).closest('.check__checkbox_all').find('.list-child input[type="checkbox"]').prop('checked', false);
		}
	});
	$('.check__checkbox_all .list-child input[type="checkbox"]').on('change', function() {
		var count = $(this).closest('.check__checkbox_all').find('.list-child input[type="checkbox"]').length;
		var check = $(this).closest('.check__checkbox_all').find('.list-child input[type="checkbox"]:checked').length;
		if(count == check) $(this).closest('.check__checkbox_all').find('.parent-check').prop('checked', true);
			else $(this).closest('.check__checkbox_all').find('.parent-check').prop('checked', false);
	});

	// Chart
	if($('.statistics-chart-canvas').length > 0){
      	$('.statistics-chart-canvas').each(function(){
          	var id = $(this).attr("id"),
              	data_type = $(this).parent().attr('data-type') ? $(this).parent().attr('data-type') : 'line',
              	barW = $(this).parent().attr('data-width') ? parseFloat($(this).parent().attr('data-width')) : 0.9,
              	grid = $(this).parent().attr('data-grid') ? true :false,
              	data_label = $(this).parent().attr('label') ? $.parseJSON($(this).parent().attr('label')) : ['Statistics', 'Statistics', 'Statistics'],
              	data_suffix = $(this).parent().attr('data-suffix') ? $(this).parent().attr('data-suffix') : '';
              	data_radius = $(this).parent().attr('radius') ? parseFloat($(this).parent().attr('radius')) : false;
              	elements = $(this).parent().attr('elements') ? parseInt($(this).parent().attr('elements')) : 1;
            	data_sets = [
	              	{
		                label               : data_label[0],
		                backgroundColor     : 'rgba(60, 141, 188, 0.9)',
		                borderColor         : 'rgba(60, 141, 188, 0.8)',
		                pointRadius          : data_radius,
		                pointColor          : '#3b8bba',
		                pointStrokeColor    : 'rgba(60, 141, 188, 0.8)',
		                pointHighlightFill  : '#fff',
		                pointHighlightStroke: 'rgba(60, 141, 188, 0.8)',
		                data                : $.parseJSON($('#'+id).parent().attr('data')),
	              	}
            	];
            if(elements >= 2) data_sets.push({
				                label               : data_label[1],
				                backgroundColor		: 'rgba(210, 214, 222, 0.9)',
				        		borderColor			: 'rgba(210, 214, 222, 0.8)',
				                pointRadius         : data_radius,
				                pointColor          : 'rgba(210, 214, 222, 0.8)',
				                pointStrokeColor    : '#c1c7d1',
				                pointHighlightFill  : '#fff',
				                pointHighlightStroke: 'rgba(220, 220, 220, 0.8)',
				                data                : $.parseJSON($('#'+id).parent().attr('data2')),
			              	});
            if(elements >= 3) data_sets.push({
				                label               : data_label[2],
				                backgroundColor     : 'rgba(245, 105, 84, 0.9)',
				                borderColor         : 'rgba(245, 105, 84, 0.8)',
				                pointRadius          : data_radius,
				                pointColor          : '#f56954',
				                pointStrokeColor    : 'rgba(245, 105, 84, 0.8)',
				                pointHighlightFill  : '#fff',
				                pointHighlightStroke: 'rgba(220, 53, 69, 0.8)',
				                data                : $.parseJSON($('#'+id).parent().attr('data3')),
			              	});
          	var salesChartCanvas = document.getElementById(id).getContext('2d');
          	var salesChartData = {
            	labels  : $.parseJSON($('#'+id).parent().attr('data-label')),
            	datasets: data_sets,
          	}
          	var salesChartOptions = {
	            maintainAspectRatio : false,
	            responsive : true,
	            legend: {
	              	display: true,
	            },
            	scales: {
              		xAxes: [{
                		gridLines : {
                  			display : grid,
                		},
                		barPercentage: barW
              		}],
              		yAxes: [{
		                gridLines : {
		                  	display : grid,
		                },
		                ticks: {
		                  	beginAtZero: true,
		                  	userCallback: function(label, index, labels) {
                    			if (Math.floor(label) === label) return data_suffix + addCommas(label) ;
                      				else return data_suffix + addCommas(label);
                  			},
                		}
              		}]
            	},
	            // tooltips: {
	            //   	callbacks: {
	            //     	label: function(tooltipItem, data, index) {
	            //     		console.log(index);
	            //       		return data.datasets[0].label + ': ' + addCommas(tooltipItem.yLabel) + data_suffix;
	            //    		}
	            //   	}
	            // },
	            hover: {
	              	mode: 'index',
	              	intersect: true,
	            }
	        }
      		// This will get the first returned node in the jQuery collection.
          	var salesChart = new Chart(salesChartCanvas, { 
              	type: data_type, 
              	data: salesChartData, 
              	options: salesChartOptions
            })
      	})
    }
});

function addCommas(nStr) {
    nStr += '';
    x = nStr.split('.');
    x1 = x[0];
    x2 = x.length > 1 ? '.' + x[1] : '';
    var rgx = /(\d+)(\d{3})/;
    while (rgx.test(x1)) {
        x1 = x1.replace(rgx, '$1' + ',' + '$2');
    }
    return x1 + x2;
}