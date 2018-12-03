    $(document).ready(function() {
            var options = {
                
                chart: {
                    type: 'pie',
                    renderTo: 'container2',
                    plotBackgroundColor: null,
                    backgroundColor:'transparent',
                    plotBorderWidth: null,
                    plotShadow: false,
            options3d: {
                enabled: true,
                alpha: 70,
                beta: 0
            }
                },
                title: {
                    text: ''
                },
                tooltip: {
                    pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
                },
                plotOptions: {
                    pie: {
                        allowPointSelect: true,
                        cursor: 'pointer',
                            depth: 55,
                        dataLabels: {
                            enabled: true,
                            color: '#000000',
                            connectorColor: '#000000'
                        }
                    }
                },
                credits: { 
                    enabled: false
                },
                
                exporting: { 
                    enabled: false 
                },
                
                series: [{
                    type: 'pie',
                    name: 'Pendapatan',
                    data: []
                }]
            }
            
            $.getJSON("index.php/c_grafik/jason", function(json) {
                options.series[0].data = json;
                chart = new Highcharts.Chart(options);
            });
            
        });   
   
