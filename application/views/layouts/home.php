<script src="<?php echo base_url(); ?>assets/js/jquery-1.11.3.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/js/highcharts.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/js/exporting.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/js/data.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/js/canvas-tools.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/js/export-csv.js" type="text/javascript"></script>
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Home
      </h1>
      <ol class="breadcrumb">
        <li><i class="fa fa-home"></i> Home</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
	  <div class="row">
		<div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-success">
			<div class="box-body">
				<div class="row">
					<div class="col-md-6">
						<div class="highcharts-container" id="lpg3chart"></div>
					</div>
					<div class="col-md-6">
						<div class="highcharts-container" id="lpg3resumechart"></div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
						<div class="highcharts-container" id="lpg12chart"></div>
					</div>
					<div class="col-md-6">
						<div class="highcharts-container" id="lpg12resumechart"></div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
						<div class="highcharts-container" id="lpg50chart"></div>
					</div>
					<div class="col-md-6">
						<div class="highcharts-container" id="lpg50resumechart"></div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
						<div class="highcharts-container" id="bg5_5chart"></div>
					</div>
					<div class="col-md-6">
						<div class="highcharts-container" id="bg5_5resumechart"></div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
						<div class="highcharts-container" id="bg12chart"></div>
					</div>
					<div class="col-md-6">
						<div class="highcharts-container" id="bg12resumechart"></div>
					</div>
				</div>
            </div>
          </div>
		</div>
	  </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <script type="text/javascript">
	jQuery(function(){
		new Highcharts.Chart({
			chart: {
				renderTo: 'lpg3chart',
				type: 'column',
			},
			title: {
				text: 'Data Sales LPG 3 Kg PT Pertamina',
				x: -20
			},
			subtitle: {
				text: 'Tahun <?php echo $tahun_lpg3_chart?>',
				x: -20
			},
			xAxis: {
				categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
						'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
			},
			yAxis: {
				title: {
					text: 'Jumlah (Satuan Metric Ton)'
				}
			},
			credits: { 
					enabled: false
				},
			tooltip: {
	                pointFormat: '{series.name}: <b>{point.y:.2f}</b>'
	            },
			series: [{
						name: 'Target Sales',
						data: <?php echo $data_target_lpg3_chart; ?>
					}, {
						name: 'Realisasi Sales',
						data: <?php echo $data_realisasi_lpg3_chart; ?>
					}]
		});
	});
	
	jQuery(function(){
		new Highcharts.Chart({
			chart: {
				renderTo: 'lpg3resumechart',
				type: 'column',
			},
			title: {
				text: 'Target Vs Realisasi Tahun <?php echo $tahun_lpg3_chart?> Vs Realisasi Tahun <?php echo $thn_kemarin_lpg3?>',
				x: -20
			},
			xAxis: {
				categories: ['Data Sales']
			},
			yAxis: {
				title: {
					text: 'Jumlah (Satuan Metric Ton)'
				}
			},
			credits: { 
					enabled: false
				},
			tooltip: {
	                pointFormat: '{series.name}: <b>{point.y:.2f}</b>'
	            },
			series: [{
						name: 'Total Target <?php echo $tahun_lpg3_chart?>',
						data: [<?php echo $total_target_lpg3?>]
					}, {
						name: 'Total Realisasi <?php echo $tahun_lpg3_chart?>',
						data: [<?php echo $total_realisasi_lpg3?>]
					}, {
						name: 'Total Realisasi <?php echo $thn_kemarin_lpg3?>',
						data: [<?php echo $total_realisasi_lpg3_kemarin?>]
					}]
		});
	}); 
	
	jQuery(function(){
		new Highcharts.Chart({
			chart: {
				renderTo: 'lpg12chart',
				type: 'column',
			},
			title: {
				text: 'Data Sales LPG 12 Kg PT Pertamina',
				x: -20
			},
			subtitle: {
				text: 'Tahun <?php echo $tahun_lpg12_chart?>',
				x: -20
			},
			xAxis: {
				categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
						'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
			},
			yAxis: {
				title: {
					text: 'Jumlah (Satuan Metric Ton)'
				}
			},
			credits: { 
					enabled: false
				},
			tooltip: {
	                pointFormat: '{series.name}: <b>{point.y:.2f}</b>'
	            },
			series: [{
						name: 'Target Sales',
						data: <?php echo $data_target_lpg12_chart; ?>
					}, {
						name: 'Realisasi Sales',
						data: <?php echo $data_realisasi_lpg12_chart; ?>
					}]
		});
	});
	
	jQuery(function(){
		new Highcharts.Chart({
			chart: {
				renderTo: 'lpg12resumechart',
				type: 'column',
			},
			title: {
				text: 'Target Vs Realisasi Tahun <?php echo $tahun_lpg12_chart?> Vs Realisasi Tahun <?php echo $thn_kemarin_lpg12?>',
				x: -20
			},
			xAxis: {
				categories: ['Data Sales']
			},
			yAxis: {
				title: {
					text: 'Jumlah (Satuan Metric Ton)'
				}
			},
			credits: { 
					enabled: false
				},
			tooltip: {
	                pointFormat: '{series.name}: <b>{point.y:.2f}</b>'
	            },
			series: [{
						name: 'Total Target <?php echo $tahun_lpg12_chart?>',
						data: [<?php echo $total_target_lpg12?>]
					}, {
						name: 'Total Realisasi <?php echo $tahun_lpg12_chart?>',
						data: [<?php echo $total_realisasi_lpg12?>]
					}, {
						name: 'Total Realisasi <?php echo $thn_kemarin_lpg12?>',
						data: [<?php echo $total_realisasi_lpg12_kemarin?>]
					}]
		});
	}); 
	
	jQuery(function(){
		new Highcharts.Chart({
			chart: {
				renderTo: 'lpg50chart',
				type: 'column',
			},
			title: {
				text: 'Data Sales LPG 50 Kg PT Pertamina',
				x: -20
			},
			subtitle: {
				text: 'Tahun <?php echo $tahun_lpg50_chart?>',
				x: -20
			},
			xAxis: {
				categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
						'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
			},
			yAxis: {
				title: {
					text: 'Jumlah (Satuan Metric Ton)'
				}
			},
			credits: { 
					enabled: false
				},
			tooltip: {
	                pointFormat: '{series.name}: <b>{point.y:.2f}</b>'
	            },
			series: [{
						name: 'Target Sales',
						data: <?php echo $data_target_lpg50_chart; ?>
					}, {
						name: 'Realisasi Sales',
						data: <?php echo $data_realisasi_lpg50_chart; ?>
					}]
		});
	});
	
	jQuery(function(){
		new Highcharts.Chart({
			chart: {
				renderTo: 'lpg50resumechart',
				type: 'column',
			},
			title: {
				text: 'Target Vs Realisasi Tahun <?php echo $tahun_lpg50_chart?> Vs Realisasi Tahun <?php echo $thn_kemarin_lpg50?>',
				x: -20
			},
			xAxis: {
				categories: ['Data Sales']
			},
			yAxis: {
				title: {
					text: 'Jumlah (Satuan Metric Ton)'
				}
			},
			credits: { 
					enabled: false
				},
			tooltip: {
	                pointFormat: '{series.name}: <b>{point.y:.2f}</b>'
	            },
			series: [{
						name: 'Total Target <?php echo $tahun_lpg50_chart?>',
						data: [<?php echo $total_target_lpg50?>]
					}, {
						name: 'Total Realisasi <?php echo $tahun_lpg50_chart?>',
						data: [<?php echo $total_realisasi_lpg50?>]
					}, {
						name: 'Total Realisasi <?php echo $thn_kemarin_lpg50?>',
						data: [<?php echo $total_realisasi_lpg50_kemarin?>]
					}]
		});
	}); 
	
	jQuery(function(){
		new Highcharts.Chart({
			chart: {
				renderTo: 'bg5_5chart',
				type: 'column',
			},
			title: {
				text: 'Data Sales Bright Gas 5.5 Kg PT Pertamina',
				x: -20
			},
			subtitle: {
				text: 'Tahun <?php echo $tahun_bg5_5_chart?>',
				x: -20
			},
			xAxis: {
				categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
						'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
			},
			yAxis: {
				title: {
					text: 'Jumlah (Satuan Metric Ton)'
				}
			},
			credits: { 
					enabled: false
				},
			tooltip: {
	                pointFormat: '{series.name}: <b>{point.y:.2f}</b>'
	            },
			series: [{
						name: 'Target Sales',
						data: <?php echo $data_target_bg5_5_chart; ?>
					}, {
						name: 'Realisasi Sales',
						data: <?php echo $data_realisasi_bg5_5_chart; ?>
					}]
		});
	});
	
	jQuery(function(){
		new Highcharts.Chart({
			chart: {
				renderTo: 'bg5_5resumechart',
				type: 'column',
			},
			title: {
				text: 'Target Vs Realisasi Tahun <?php echo $tahun_bg5_5_chart?> Vs Realisasi Tahun <?php echo $thn_kemarin_bg5_5?>',
				x: -20
			},
			xAxis: {
				categories: ['Data Sales']
			},
			yAxis: {
				title: {
					text: 'Jumlah (Satuan Metric Ton)'
				}
			},
			credits: { 
					enabled: false
				},
			tooltip: {
	                pointFormat: '{series.name}: <b>{point.y:.2f}</b>'
	            },
			series: [{
						name: 'Total Target <?php echo $tahun_bg5_5_chart?>',
						data: [<?php echo $total_target_bg5_5?>]
					}, {
						name: 'Total Realisasi <?php echo $tahun_bg5_5_chart?>',
						data: [<?php echo $total_realisasi_bg5_5?>]
					}, {
						name: 'Total Realisasi <?php echo $thn_kemarin_bg5_5?>',
						data: [<?php echo $total_realisasi_bg5_5_kemarin?>]
					}]
		});
	}); 
	
	jQuery(function(){
		new Highcharts.Chart({
			chart: {
				renderTo: 'bg12chart',
				type: 'column',
			},
			title: {
				text: 'Data Sales Bright Gas 12 Kg PT Pertamina',
				x: -20
			},
			subtitle: {
				text: 'Tahun <?php echo $tahun_bg12_chart?>',
				x: -20
			},
			xAxis: {
				categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
						'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
			},
			yAxis: {
				title: {
					text: 'Jumlah (Satuan Metric Ton)'
				}
			},
			credits: { 
					enabled: false
				},
			tooltip: {
	                pointFormat: '{series.name}: <b>{point.y:.2f}</b>'
	            },
			series: [{
						name: 'Target Sales',
						data: <?php echo $data_target_bg12_chart; ?>
					}, {
						name: 'Realisasi Sales',
						data: <?php echo $data_realisasi_bg12_chart; ?>
					}]
		});
	});
	
	jQuery(function(){
		new Highcharts.Chart({
			chart: {
				renderTo: 'bg12resumechart',
				type: 'column',
			},
			title: {
				text: 'Target Vs Realisasi Tahun <?php echo $tahun_bg12_chart?> Vs Realisasi Tahun <?php echo $thn_kemarin_bg12?>',
				x: -20
			},
			xAxis: {
				categories: ['Data Sales']
			},
			yAxis: {
				title: {
					text: 'Jumlah (Satuan Metric Ton)'
				}
			},
			credits: { 
					enabled: false
				},
			tooltip: {
	                pointFormat: '{series.name}: <b>{point.y:.2f}</b>'
	            },
			series: [{
						name: 'Total Target <?php echo $tahun_bg12_chart?>',
						data: [<?php echo $total_target_bg12?>]
					}, {
						name: 'Total Realisasi <?php echo $tahun_bg12_chart?>',
						data: [<?php echo $total_realisasi_bg12?>]
					}, {
						name: 'Total Realisasi <?php echo $thn_kemarin_bg12?>',
						data: [<?php echo $total_realisasi_bg12_kemarin?>]
					}]
		});
	}); 
	</script>
