$(function () {
    var chart;
    $(document).ready(function() {
		
		var options = {
	            chart: {
	                renderTo: 'coba',
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