$(function () {
    var chart;
    $(document).ready(function() {
		
		var options = {
	            chart: {
	                renderTo: 'lina',
	                type: 'line',
	                marginRight: 130,
	                marginBottom: 25,   
					zoomType: 'xy'
	            },
	            title: {
	                text: 'Data Pemasukan PT Maju Mundur',
	                x: -20 //center
	            },
	            subtitle: {
	                text: 'Total Pemasukan Tiap Bulan',
	                x: -20
	            },
	            xAxis: {
	                categories: []
	            },
	            yAxis: {
	                title: {
	                    text: 'Jumlah'
	                },
	                plotLines: [{
	                    value: 0,
	                    width: 1,
	                    color: '#808080'
	                }]
	            },
	            tooltip: {
	                 
	                valueDecimals: 0,
					valuePrefix: 'Rp.'
	                
	            },
				credits: { 
					enabled: false
				},
				
				exporting: { 
					enabled: false 
				},
				
	            legend: {
	                layout: 'vertical',
	                align: 'right',
	                verticalAlign: 'top',
	                x: -10,
	                y: 100,
	                borderWidth: 0
	            },
	            series: []
				
		}
		
		$.getJSON('http://localhost/excel/index.php/data/viewColumn', function(json) {
                options.xAxis.categories = json[0]['data'];
                options.series[0] = json[1];
                options.series[1] = json[2];
                chart = new Highcharts.Chart(options);
            });
	    
    
    });
    
});