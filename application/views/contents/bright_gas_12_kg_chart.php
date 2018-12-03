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
        Bright Gas 12 Kg 
        <small>View Chart</small>
      </h1>
      <ol class="breadcrumb">
        <li><i class="fa fa-free-code-camp"></i> Bright Gas 12 Kg</li>
        <li class="active"> <i class="fa fa-bar-chart"></i> View Chart</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
	    <div class="col-md-3 pull-left">
          <!-- general form elements -->
          <div class="box box-info">
			<form action="<?php echo base_url();?>index.php/bg12con/chart" method="post" enctype="multipart/form-data" role="form">
			<div class="box-body">
              <div class="form-group">
                <label>Pilih Tahun</label>
                <select name="tahun" class="form-control select2" style="width: 100%;">
				<?php for ($i = 0; $i < sizeof($tahun); $i++) {?>
                  <option <?php if($tahun[$i]['tahun'] == $thn_chart) echo "selected";?> value="<?php echo $tahun[$i]['tahun']?>"><?php echo $tahun[$i]['tahun']?></option>
				<?php }?>
				}
                </select>
              </div>
			  <div class="form-group pull-right">
                <button type="submit" class="btn btn-primary" name="tampil"><i class="fa fa-eye"></i> Tampilkan</button>
              </div> 
            </div>
			</form>
          </div>
		</div>
      </div>
      <!-- /.row -->
	  <div class="row">
		<div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-success">
			<div class="box-body">
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
	  <div class="row">
		<div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-warning">
		  <div class="box-header" style="text-align:center" >
              <h2 class="box-title">Target Sales Bright Gas 12 Kg Tahun <?php echo $thn_chart?></h2>
            </div>
			<div class="box-body">
              <table id="example1" class="display table-bordered table-hover"  width="100%" cellspacing="0" >
				<thead>
					<tr>
						<th><center>No.</center></th>
						<th><center>Nama Agen</center></th>
						<th><center>Lokasi</center></th>
						<th><center>Jan</center></th>
						<th><center>Feb</center></th>
						<th><center>Mar</center></th>
						<th><center>Apr</center></th>
						<th><center>Mei</center></th>
						<th><center>Jun</center></th>
						<th><center>Jul</center></th>
						<th><center>Ags</center></th>
						<th><center>Sep</center></th>
						<th><center>Okt</center></th>
						<th><center>Nov</center></th>
						<th><center>Des</center></th>
						<th><center>Total</center></th>
					</tr>
				</thead>
				<tbody>
					<?php
					$no = 1;
					$jumlah = array();
					for($i = 0; $i <= 12; $i++) {
						$jumlah[$i] = 0;
					}
					for($i = 0; $i < sizeof($data_target); $i++) {?>
					<tr>
						<td><?php echo $no?>.</td>
						<td><?php echo $data_target[$i]['nama_agen']?></td>
						<td><?php echo $data_target[$i]['lokasi']?></td>
						<td align="right"><?php echo number_format((float)$data_target[$i]['januari'], 2, '.', '');?></td>
						<td align="right"><?php echo number_format((float)$data_target[$i]['februari'], 2, '.', '');?></td>
						<td align="right"><?php echo number_format((float)$data_target[$i]['maret'], 2, '.', '');?></td>
						<td align="right"><?php echo number_format((float)$data_target[$i]['april'], 2, '.', '');?></td>
						<td align="right"><?php echo number_format((float)$data_target[$i]['mei'], 2, '.', '');?></td>
						<td align="right"><?php echo number_format((float)$data_target[$i]['juni'], 2, '.', '');?></td>
						<td align="right"><?php echo number_format((float)$data_target[$i]['juli'], 2, '.', '');?></td>
						<td align="right"><?php echo number_format((float)$data_target[$i]['agustus'], 2, '.', '');?></td>
						<td align="right"><?php echo number_format((float)$data_target[$i]['september'], 2, '.', '');?></td>
						<td align="right"><?php echo number_format((float)$data_target[$i]['oktober'], 2, '.', '');?></td>
						<td align="right"><?php echo number_format((float)$data_target[$i]['november'], 2, '.', '');?></td>
						<td align="right"><?php echo number_format((float)$data_target[$i]['desember'], 2, '.', '');?></td>
						<td align="right"><?php echo number_format((float)$data_target[$i]['total'], 2, '.', '');?></td>
						<?php 
						$no++;
						$jumlah[0] += $data_target[$i]['januari'];
						$jumlah[1] += $data_target[$i]['februari'];
						$jumlah[2] += $data_target[$i]['maret'];
						$jumlah[3] += $data_target[$i]['april'];
						$jumlah[4] += $data_target[$i]['mei'];
						$jumlah[5] += $data_target[$i]['juni'];
						$jumlah[6] += $data_target[$i]['juli'];
						$jumlah[7] += $data_target[$i]['agustus'];
						$jumlah[8] += $data_target[$i]['september'];
						$jumlah[9] += $data_target[$i]['oktober'];
						$jumlah[10] += $data_target[$i]['november'];
						$jumlah[11] += $data_target[$i]['desember'];
						$jumlah[12] += $data_target[$i]['total'];
						?>
					</tr>
					<?php }?>
				</tbody>
				<tfoot>
					<tr>
						<th colspan="3"><center>TOTAL</center></th>
						<th style="text-align:right"><?php echo number_format((float)$jumlah[0], 2, '.', '') ?></th>
						<th style="text-align:right"><?php echo number_format((float)$jumlah[1], 2, '.', '') ?></th>
						<th style="text-align:right"><?php echo number_format((float)$jumlah[2], 2, '.', '') ?></th>
						<th style="text-align:right"><?php echo number_format((float)$jumlah[3], 2, '.', '') ?></th>
						<th style="text-align:right"><?php echo number_format((float)$jumlah[4], 2, '.', '') ?></th>
						<th style="text-align:right"><?php echo number_format((float)$jumlah[5], 2, '.', '') ?></th>
						<th style="text-align:right"><?php echo number_format((float)$jumlah[6], 2, '.', '') ?></th>
						<th style="text-align:right"><?php echo number_format((float)$jumlah[7], 2, '.', '') ?></th>
						<th style="text-align:right"><?php echo number_format((float)$jumlah[8], 2, '.', '') ?></th>
						<th style="text-align:right"><?php echo number_format((float)$jumlah[9], 2, '.', '') ?></th>
						<th style="text-align:right"><?php echo number_format((float)$jumlah[10], 2, '.', '') ?></th>
						<th style="text-align:right"><?php echo number_format((float)$jumlah[11], 2, '.', '') ?></th>
						<th style="text-align:right"><?php echo number_format((float)$jumlah[12], 2, '.', '') ?></th>
					</tr>
				</tfoot>
			  </table>
            </div>
			<div class="box-footer">
              <form action="<?php echo base_url();?>index.php/bg12con/export_target" method="post" enctype="multipart/form-data" role="form">
				<div class="col-md-2 pull-right">
					<input type="hidden" name="tahun_target" value="<?php echo $thn_chart?>">
					<button type="submit" class="btn btn-success" name="tampil"><i class="fa fa-download"></i> Export Excel</button>
				</div>
			  </form>
            </div>
          </div>
		</div>
	  </div>
	  <div class="row">
		<div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-warning">
		  <div class="box-header" style="text-align:center" >
              <h2 class="box-title">Realisasi Sales Bright Gas 12 Kg Tahun <?php echo $thn_chart?></h2>
            </div>
			<div class="box-body">
              <table id="example2" class="display table-bordered table-hover"  width="100%" cellspacing="0" >
				<thead>
					<tr>
						<th><center>No.</center></th>
						<th><center>Nama Agen</center></th>
						<th><center>Lokasi</center></th>
						<th><center>Jan</center></th>
						<th><center>Feb</center></th>
						<th><center>Mar</center></th>
						<th><center>Apr</center></th>
						<th><center>Mei</center></th>
						<th><center>Jun</center></th>
						<th><center>Jul</center></th>
						<th><center>Ags</center></th>
						<th><center>Sep</center></th>
						<th><center>Okt</center></th>
						<th><center>Nov</center></th>
						<th><center>Des</center></th>
						<th><center>Total</center></th>
					</tr>
				</thead>
				<tbody>
					<?php
					$no = 1;
					$jumlah = array();
					for($i = 0; $i <= 12; $i++) {
						$jumlah[$i] = 0;
					}
					for($i = 0; $i < sizeof($data_realisasi); $i++) {?>
					<tr>
						<td><?php echo $no?>.</td>
						<td><?php echo $data_realisasi[$i]['nama_agen']?></td>
						<td><?php echo $data_realisasi[$i]['lokasi']?></td>
						<td align="right"><?php echo number_format((float)$data_realisasi[$i]['januari'], 2, '.', '');?></td>
						<td align="right"><?php echo number_format((float)$data_realisasi[$i]['februari'], 2, '.', '');?></td>
						<td align="right"><?php echo number_format((float)$data_realisasi[$i]['maret'], 2, '.', '');?></td>
						<td align="right"><?php echo number_format((float)$data_realisasi[$i]['april'], 2, '.', '');?></td>
						<td align="right"><?php echo number_format((float)$data_realisasi[$i]['mei'], 2, '.', '');?></td>
						<td align="right"><?php echo number_format((float)$data_realisasi[$i]['juni'], 2, '.', '');?></td>
						<td align="right"><?php echo number_format((float)$data_realisasi[$i]['juli'], 2, '.', '');?></td>
						<td align="right"><?php echo number_format((float)$data_realisasi[$i]['agustus'], 2, '.', '');?></td>
						<td align="right"><?php echo number_format((float)$data_realisasi[$i]['september'], 2, '.', '');?></td>
						<td align="right"><?php echo number_format((float)$data_realisasi[$i]['oktober'], 2, '.', '');?></td>
						<td align="right"><?php echo number_format((float)$data_realisasi[$i]['november'], 2, '.', '');?></td>
						<td align="right"><?php echo number_format((float)$data_realisasi[$i]['desember'], 2, '.', '');?></td>
						<td align="right"><?php echo number_format((float)$data_realisasi[$i]['total'], 2, '.', '');?></td>
						<?php
						$no++;
						$jumlah[0] += $data_realisasi[$i]['januari'];
						$jumlah[1] += $data_realisasi[$i]['februari'];
						$jumlah[2] += $data_realisasi[$i]['maret'];
						$jumlah[3] += $data_realisasi[$i]['april'];
						$jumlah[4] += $data_realisasi[$i]['mei'];
						$jumlah[5] += $data_realisasi[$i]['juni'];
						$jumlah[6] += $data_realisasi[$i]['juli'];
						$jumlah[7] += $data_realisasi[$i]['agustus'];
						$jumlah[8] += $data_realisasi[$i]['september'];
						$jumlah[9] += $data_realisasi[$i]['oktober'];
						$jumlah[10] += $data_realisasi[$i]['november'];
						$jumlah[11] += $data_realisasi[$i]['desember'];
						$jumlah[12] += $data_realisasi[$i]['total'];
						?>
					</tr>
					<?php }?>
				</tbody>
				<tfoot>
					<tr>
						<th colspan="3"><center>TOTAL</center></th>
						<th style="text-align:right"><?php echo number_format((float)$jumlah[0], 2, '.', '') ?></th>
						<th style="text-align:right"><?php echo number_format((float)$jumlah[1], 2, '.', '') ?></th>
						<th style="text-align:right"><?php echo number_format((float)$jumlah[2], 2, '.', '') ?></th>
						<th style="text-align:right"><?php echo number_format((float)$jumlah[3], 2, '.', '') ?></th>
						<th style="text-align:right"><?php echo number_format((float)$jumlah[4], 2, '.', '') ?></th>
						<th style="text-align:right"><?php echo number_format((float)$jumlah[5], 2, '.', '') ?></th>
						<th style="text-align:right"><?php echo number_format((float)$jumlah[6], 2, '.', '') ?></th>
						<th style="text-align:right"><?php echo number_format((float)$jumlah[7], 2, '.', '') ?></th>
						<th style="text-align:right"><?php echo number_format((float)$jumlah[8], 2, '.', '') ?></th>
						<th style="text-align:right"><?php echo number_format((float)$jumlah[9], 2, '.', '') ?></th>
						<th style="text-align:right"><?php echo number_format((float)$jumlah[10], 2, '.', '') ?></th>
						<th style="text-align:right"><?php echo number_format((float)$jumlah[11], 2, '.', '') ?></th>
						<th style="text-align:right"><?php echo number_format((float)$jumlah[12], 2, '.', '') ?></th>
					</tr>
				</tfoot>
			  </table>
            </div>
			<div class="box-footer">
              <form action="<?php echo base_url();?>index.php/bg12con/export_realisasi" method="post" enctype="multipart/form-data" role="form">
				<div class="col-md-2 pull-right">
					<input type="hidden" name="tahun_target" value="<?php echo $thn_chart?>">
					<button type="submit" class="btn btn-success" name="tampil"><i class="fa fa-download"></i> Export Excel</button>
				</div>
			  </form>
            </div>
          </div>
		</div>
	  </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <script type="text/javascript">
	$(document).ready(function(){
		$('#example1').dataTable(
		{
		  "ordering": true
		});
		$('#example2').dataTable(
		{
		  "ordering": true
		});
	});
  </script>
  <script type="text/javascript">
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
				text: 'Tahun <?php echo $thn_chart?>',
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
						data: <?php echo $data_target_chart; ?>
					}, {
						name: 'Realisasi Sales',
						data: <?php echo $data_realisasi_chart; ?>
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
				text: 'Target Vs Realisasi Tahun <?php echo $thn_chart?> Vs Realisasi Tahun <?php echo $thn_kemarin?>',
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
						name: 'Total Target <?php echo $thn_chart?>',
						data: [<?php echo $total_target?>]
					}, {
						name: 'Total Realisasi <?php echo $thn_chart?>',
						data: [<?php echo $total_realisasi?>]
					}, {
						name: 'Total Realisasi <?php echo $thn_kemarin?>',
						data: [<?php echo $total_realisasi_kemarin?>]
					}]
		});
	}); 
	</script>
