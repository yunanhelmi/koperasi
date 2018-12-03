$(function () {
    //var chart;
    $(document).ready(function() {
		 var chart = new Highcharts.Chart('lpg12chart', {
			chart: {
	                renderTo: 'lpg12chart',
	                type: 'colummn',   
					//zoomType: 'xy'
	            },
	            title: {
	                text: 'Data LPG 12 Kg',
	                x: -20 //center
	            },
	            xAxis: {
	                categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun','Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
	            },
	            yAxis: {
	                title: {
	                    text: 'Jumlah (Satuan Metric Ton)'
	                },
	                plotLines: [{
	                    value: 0,
	                    width: 1,
	                    color: '#808080'
	                }]
	            },
				credits: { 
					enabled: false
				},
				
				exporting: { 
					enabled: true 
				},
				
	            legend: {
	                layout: 'vertical',
	                align: 'right',
	                verticalAlign: 'top',
	                x: -10,
	                y: 100,
	                borderWidth: 0
	            },
	            series: [{
							name: 'Target Sales',
							data: '<?php echo json_encode($data_target_chart); ?>'
						}, {
							name: 'Realisasi Sales',
							data: '<?php echo json_encode($data_realisasi_chart); ?>'
						}]
		});
		
		/*var options = {
	            chart: {
	                renderTo: 'lpg12chart',
	                type: 'colummn',   
					zoomType: 'xy'
	            },
	            title: {
	                text: 'Data LPG 12 Kg',
	                x: -20 //center
	            },
	            xAxis: {
	                categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun','Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
	            },
	            yAxis: {
	                title: {
	                    text: 'Jumlah (Satuan Metric Ton)'
	                },
	                plotLines: [{
	                    value: 0,
	                    width: 1,
	                    color: '#808080'
	                }]
	            },
				credits: { 
					enabled: false
				},
				
				exporting: { 
					enabled: true 
				},
				
	            legend: {
	                layout: 'vertical',
	                align: 'right',
	                verticalAlign: 'top',
	                x: -10,
	                y: 100,
	                borderWidth: 0
	            },
	            series: [{
							name: 'Target Sales',
							data: <?php echo json_encode($data_target_chart); ?>
						}, {
							name: 'Realisasi Sales',
							data: <?php echo json_encode($data_realisasi_chart); ?>
						}]
				
		}*/
	    
    
    });
    
});

// Programmatically-defined buttons
$(".chart-export").each(function() {
  var jThis = $(this),
      chartSelector = jThis.data("chartSelector"),
      chart = $(chartSelector).highcharts();

  $("*[data-type]", this).each(function() {
    var jThis = $(this),
        type = jThis.data("type");
    if(Highcharts.exporting.supports(type)) {
      jThis.click(function() {
        chart.exportChartLocal({ type: type });
      });
    }
    else {
      jThis.attr("disabled", "disabled");
    }
  });
});
