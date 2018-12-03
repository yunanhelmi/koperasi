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
	<!-- Untuk LPG 3 Kg -->
	  <div class="row">
		  <div class="col-md-6">
          <!-- general form elements -->
			  <div class="box box-success">
				<div class="box-header" style="text-align:center">
					<h3><strong>LPG 3 Kg</strong></h3>
				</div>
				<div class="box-body">
					<div class="row">
						<form action="<?php echo base_url();?>index.php/homecon/index" method="post" enctype="multipart/form-data" role="form">
							<div class="col-md-3">
								<label>Tahun</label>
								<select name="tahunlpg3kiri" class="form-control select2" style="width: 100%;">
								<?php for ($i = 0; $i < sizeof($tahunlpg3); $i++) {?>
								  <option <?php if($tahunlpg3[$i]['tahun'] == $tahunlpg3kiri) echo "selected";?> value="<?php echo $tahunlpg3[$i]['tahun']?>"><?php echo $tahunlpg3[$i]['tahun']?></option>
								<?php }?>
								</select>
							</div>
							<div class="col-md-3">
								<label>Bulan</label>
								<select name="bulanlpg3kiri" class="form-control select2" style="width: 100%;">
								  <?php for ($i = 0; $i < sizeof($bulan); $i++) {?>
								  <option <?php if($bulan[$i] == $bulanlpg3kiri) echo "selected";?> value="<?php echo $bulan[$i]?>"><?php echo ucfirst($bulan[$i])?></option>
								  <?php }?>
								</select>
							</div>
							<div class="col-md-3 pull-right">
								<label>&nbsp;</label>
								<button type="submit" class="btn btn-primary" name="tampil"><i class="fa fa-eye"></i> Tampilkan</button>
							</div>
						</form>
					</div>
					<br>
					<div class="row">
						<div align="center" class="highcharts-container" id="lpg3chartkiri"></div>
					</div>
					<br>
					<div class="row">
						<div class="col-md-12" >
						<table class="table table-bordered table-hover">
							<thead>
								<tr>
									<th><center>Realisasi Per <?php echo ucfirst($bulanlpg3kiri)." ".$tahunlpg3kiri;?></center></th>
									<th><center>Target Per <?php echo ucfirst($bulanlpg3kiri)." ".$tahunlpg3kiri;?></center></th>
									<th><center>Persentasi Pencapaian <?php echo ucfirst($bulanlpg3kiri)." ".$tahunlpg3kiri;?></center></th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td><center><?php echo number_format((float)$datalpg3realisasikiri, 2, '.', '');?></center></td>
									<td><center><?php echo number_format((float)$datalpg3targetkiri, 2, '.', '');?></center></td>
									<td><center><?php echo number_format((float)$datalpg3persentasekiri, 2, '.', '');?> %</center></td>
								</tr>
							</tbody>
						</table>
						</div>
					</div>
				</div>
			  </div>
            </div>
			<div class="col-md-6">
			<div class="box box-success">
				<div class="box-header" style="text-align:center">
					<h3><strong>LPG 3 Kg</strong></h3>
				</div>
				<div class="box-body">
					<div class="row">
						<form action="<?php echo base_url();?>index.php/homecon/index" method="post" enctype="multipart/form-data" role="form">
							<div class="col-md-3">
								<label>Tahun</label>
								<select name="tahunlpg3kanan" class="form-control select2" style="width: 100%;">
								<?php for ($i = 0; $i < sizeof($tahunlpg3); $i++) {?>
								  <option <?php if($tahunlpg3[$i]['tahun'] == $tahunlpg3kanan) echo "selected";?> value="<?php echo $tahunlpg3[$i]['tahun']?>"><?php echo $tahunlpg3[$i]['tahun']?></option>
								<?php }?>
								</select>
							</div>
							<div class="col-md-3">
								<label>Bulan</label>
								<select name="bulanlpg3kanan" class="form-control select2" style="width: 100%;">
								  <?php for ($i = 0; $i < sizeof($bulan); $i++) {?>
								  <option <?php if($bulan[$i] == $bulanlpg3kanan) echo "selected";?> value="<?php echo $bulan[$i]?>"><?php echo ucfirst($bulan[$i])?></option>
								  <?php }?>
								</select>
							</div>
							<div class="col-md-3 pull-right">
								<label>&nbsp;</label>
								<button type="submit" class="btn btn-primary" name="tampil"><i class="fa fa-eye"></i> Tampilkan</button>
							</div>
						</form>
					</div>
					<br>
					<div class="row">
						<div align="center" class="highcharts-container" id="lpg3chartkanan"></div>
					</div>
					<br>
					<div class="row">
						<div class="col-md-12" >
						<table class="table table-bordered table-hover">
							<thead>
								<tr>
									<th><center>Realisasi Per <?php echo ucfirst($bulanlpg3kanan)." ".$tahunlpg3kanan;?></center></th>
									<th><center>Target Per <?php echo $tahunlpg3kanan;?></center></th>
									<th><center>Persentasi Pencapaian</center></th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td><center><?php echo number_format((float)$datalpg3realisasikanan, 2, '.', '');?></center></td>
									<td><center><?php echo number_format((float)$datalpg3targetkanan, 2, '.', '');?></center></td>
									<td><center><?php echo number_format((float)$datalpg3persentasekanan, 2, '.', '');?> %</center></td>
								</tr>
							</tbody>
						</table>
						</div>
					</div>
				</div>
			</div>
		</div>
		</div>
		<!-- Untuk LPG 12 Kg -->
		<div class="row">
		  <div class="col-md-6">
          <!-- general form elements -->
			  <div class="box box-success">
				<div class="box-header" style="text-align:center">
					<h3><strong>LPG 12 Kg</strong></h3>
				</div>
				<div class="box-body">
					<div class="row">
						<form action="<?php echo base_url();?>index.php/homecon/index" method="post" enctype="multipart/form-data" role="form">
							<div class="col-md-3">
								<label>Tahun</label>
								<select name="tahunlpg12kiri" class="form-control select2" style="width: 100%;">
								<?php for ($i = 0; $i < sizeof($tahunlpg12); $i++) {?>
								  <option <?php if($tahunlpg12[$i]['tahun'] == $tahunlpg12kiri) echo "selected";?> value="<?php echo $tahunlpg12[$i]['tahun']?>"><?php echo $tahunlpg12[$i]['tahun']?></option>
								<?php }?>
								</select>
							</div>
							<div class="col-md-3">
								<label>Bulan</label>
								<select name="bulanlpg12kiri" class="form-control select2" style="width: 100%;">
								  <?php for ($i = 0; $i < sizeof($bulan); $i++) {?>
								  <option <?php if($bulan[$i] == $bulanlpg12kiri) echo "selected";?> value="<?php echo $bulan[$i]?>"><?php echo ucfirst($bulan[$i])?></option>
								  <?php }?>
								</select>
							</div>
							<div class="col-md-3 pull-right">
								<label>&nbsp;</label>
								<button type="submit" class="btn btn-primary" name="tampil"><i class="fa fa-eye"></i> Tampilkan</button>
							</div>
						</form>
					</div>
					<br>
					<div class="row">
						<div align="center" class="highcharts-container" id="lpg12chartkiri"></div>
					</div>
					<br>
					<div class="row">
						<div class="col-md-12" >
						<table class="table table-bordered table-hover">
							<thead>
								<tr>
									<th><center>Realisasi Per <?php echo ucfirst($bulanlpg12kiri)." ".$tahunlpg12kiri;?></center></th>
									<th><center>Target Per <?php echo ucfirst($bulanlpg12kiri)." ".$tahunlpg12kiri;?></center></th>
									<th><center>Persentasi Pencapaian <?php echo ucfirst($bulanlpg12kiri)." ".$tahunlpg12kiri;?></center></th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td><center><?php echo number_format((float)$datalpg12realisasikiri, 2, '.', '');?></center></td>
									<td><center><?php echo number_format((float)$datalpg12targetkiri, 2, '.', '');?></center></td>
									<td><center><?php echo number_format((float)$datalpg12persentasekiri, 2, '.', '');?> %</center></td>
								</tr>
							</tbody>
						</table>
						</div>
					</div>
				</div>
			  </div>
            </div>
			<div class="col-md-6">
			<div class="box box-success">
				<div class="box-header" style="text-align:center">
					<h3><strong>LPG 12 Kg</strong></h3>
				</div>
				<div class="box-body">
					<div class="row">
						<form action="<?php echo base_url();?>index.php/homecon/index" method="post" enctype="multipart/form-data" role="form">
							<div class="col-md-3">
								<label>Tahun</label>
								<select name="tahunlpg12kanan" class="form-control select2" style="width: 100%;">
								<?php for ($i = 0; $i < sizeof($tahunlpg12); $i++) {?>
								  <option <?php if($tahunlpg12[$i]['tahun'] == $tahunlpg12kanan) echo "selected";?> value="<?php echo $tahunlpg12[$i]['tahun']?>"><?php echo $tahunlpg12[$i]['tahun']?></option>
								<?php }?>
								</select>
							</div>
							<div class="col-md-3">
								<label>Bulan</label>
								<select name="bulanlpg12kanan" class="form-control select2" style="width: 100%;">
								  <?php for ($i = 0; $i < sizeof($bulan); $i++) {?>
								  <option <?php if($bulan[$i] == $bulanlpg12kanan) echo "selected";?> value="<?php echo $bulan[$i]?>"><?php echo ucfirst($bulan[$i])?></option>
								  <?php }?>
								</select>
							</div>
							<div class="col-md-3 pull-right">
								<label>&nbsp;</label>
								<button type="submit" class="btn btn-primary" name="tampil"><i class="fa fa-eye"></i> Tampilkan</button>
							</div>
						</form>
					</div>
					<br>
					<div class="row">
						<div align="center" class="highcharts-container" id="lpg12chartkanan"></div>
					</div>
					<br>
					<div class="row">
						<div class="col-md-12" >
						<table class="table table-bordered table-hover">
							<thead>
								<tr>
									<th><center>Realisasi Per <?php echo ucfirst($bulanlpg12kanan)." ".$tahunlpg12kanan;?></center></th>
									<th><center>Target Per <?php echo $tahunlpg12kanan;?></center></th>
									<th><center>Persentasi Pencapaian</center></th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td><center><?php echo number_format((float)$datalpg12realisasikanan, 2, '.', '');?></center></td>
									<td><center><?php echo number_format((float)$datalpg12targetkanan, 2, '.', '');?></center></td>
									<td><center><?php echo number_format((float)$datalpg12persentasekanan, 2, '.', '');?> %</center></td>
								</tr>
							</tbody>
						</table>
						</div>
					</div>
				</div>
			</div>
		</div>
		</div>
		<!-- Untuk LPG 50 Kg -->
		<div class="row">
		  <div class="col-md-6">
          <!-- general form elements -->
			  <div class="box box-success">
				<div class="box-header" style="text-align:center">
					<h3><strong>LPG 50 Kg</strong></h3>
				</div>
				<div class="box-body">
					<div class="row">
						<form action="<?php echo base_url();?>index.php/homecon/index" method="post" enctype="multipart/form-data" role="form">
							<div class="col-md-3">
								<label>Tahun</label>
								<select name="tahunlpg50kiri" class="form-control select2" style="width: 100%;">
								<?php for ($i = 0; $i < sizeof($tahunlpg50); $i++) {?>
								  <option <?php if($tahunlpg50[$i]['tahun'] == $tahunlpg50kiri) echo "selected";?> value="<?php echo $tahunlpg50[$i]['tahun']?>"><?php echo $tahunlpg50[$i]['tahun']?></option>
								<?php }?>
								</select>
							</div>
							<div class="col-md-3">
								<label>Bulan</label>
								<select name="bulanlpg50kiri" class="form-control select2" style="width: 100%;">
								  <?php for ($i = 0; $i < sizeof($bulan); $i++) {?>
								  <option <?php if($bulan[$i] == $bulanlpg50kiri) echo "selected";?> value="<?php echo $bulan[$i]?>"><?php echo ucfirst($bulan[$i])?></option>
								  <?php }?>
								</select>
							</div>
							<div class="col-md-3 pull-right">
								<label>&nbsp;</label>
								<button type="submit" class="btn btn-primary" name="tampil"><i class="fa fa-eye"></i> Tampilkan</button>
							</div>
						</form>
					</div>
					<br>
					<div class="row">
						<div align="center" class="highcharts-container" id="lpg50chartkiri"></div>
					</div>
					<br>
					<div class="row">
						<div class="col-md-12" >
						<table class="table table-bordered table-hover">
							<thead>
								<tr>
									<th><center>Realisasi Per <?php echo ucfirst($bulanlpg50kiri)." ".$tahunlpg50kiri;?></center></th>
									<th><center>Target Per <?php echo ucfirst($bulanlpg50kiri)." ".$tahunlpg50kiri;?></center></th>
									<th><center>Persentasi Pencapaian <?php echo ucfirst($bulanlpg50kiri)." ".$tahunlpg50kiri;?></center></th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td><center><?php echo number_format((float)$datalpg50realisasikiri, 2, '.', '');?></center></td>
									<td><center><?php echo number_format((float)$datalpg50targetkiri, 2, '.', '');?></center></td>
									<td><center><?php echo number_format((float)$datalpg50persentasekiri, 2, '.', '');?> %</center></td>
								</tr>
							</tbody>
						</table>
						</div>
					</div>
				</div>
			  </div>
            </div>
			<div class="col-md-6">
			<div class="box box-success">
				<div class="box-header" style="text-align:center">
					<h3><strong>LPG 50 Kg</strong></h3>
				</div>
				<div class="box-body">
					<div class="row">
						<form action="<?php echo base_url();?>index.php/homecon/index" method="post" enctype="multipart/form-data" role="form">
							<div class="col-md-3">
								<label>Tahun</label>
								<select name="tahunlpg50kanan" class="form-control select2" style="width: 100%;">
								<?php for ($i = 0; $i < sizeof($tahunlpg50); $i++) {?>
								  <option <?php if($tahunlpg50[$i]['tahun'] == $tahunlpg50kanan) echo "selected";?> value="<?php echo $tahunlpg50[$i]['tahun']?>"><?php echo $tahunlpg50[$i]['tahun']?></option>
								<?php }?>
								</select>
							</div>
							<div class="col-md-3">
								<label>Bulan</label>
								<select name="bulanlpg50kanan" class="form-control select2" style="width: 100%;">
								  <?php for ($i = 0; $i < sizeof($bulan); $i++) {?>
								  <option <?php if($bulan[$i] == $bulanlpg50kanan) echo "selected";?> value="<?php echo $bulan[$i]?>"><?php echo ucfirst($bulan[$i])?></option>
								  <?php }?>
								</select>
							</div>
							<div class="col-md-3 pull-right">
								<label>&nbsp;</label>
								<button type="submit" class="btn btn-primary" name="tampil"><i class="fa fa-eye"></i> Tampilkan</button>
							</div>
						</form>
					</div>
					<br>
					<div class="row">
						<div align="center" class="highcharts-container" id="lpg50chartkanan"></div>
					</div>
					<br>
					<div class="row">
						<div class="col-md-12" >
						<table class="table table-bordered table-hover">
							<thead>
								<tr>
									<th><center>Realisasi Per <?php echo ucfirst($bulanlpg50kanan)." ".$tahunlpg50kanan;?></center></th>
									<th><center>Target Per <?php echo $tahunlpg50kanan;?></center></th>
									<th><center>Persentasi Pencapaian</center></th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td><center><?php echo number_format((float)$datalpg50realisasikanan, 2, '.', '');?></center></td>
									<td><center><?php echo number_format((float)$datalpg50targetkanan, 2, '.', '');?></center></td>
									<td><center><?php echo number_format((float)$datalpg50persentasekanan, 2, '.', '');?> %</center></td>
								</tr>
							</tbody>
						</table>
						</div>
					</div>
				</div>
			</div>
		</div>
		</div>
		<!-- Untuk BG 5.5 Kg -->
		<div class="row">
		  <div class="col-md-6">
          <!-- general form elements -->
			  <div class="box box-success">
				<div class="box-header" style="text-align:center">
					<h3><strong>Bright Gas 5.5 Kg</strong></h3>
				</div>
				<div class="box-body">
					<div class="row">
						<form action="<?php echo base_url();?>index.php/homecon/index" method="post" enctype="multipart/form-data" role="form">
							<div class="col-md-3">
								<label>Tahun</label>
								<select name="tahunbg5_5kiri" class="form-control select2" style="width: 100%;">
								<?php for ($i = 0; $i < sizeof($tahunbg5_5); $i++) {?>
								  <option <?php if($tahunbg5_5[$i]['tahun'] == $tahunbg5_5kiri) echo "selected";?> value="<?php echo $tahunbg5_5[$i]['tahun']?>"><?php echo $tahunbg5_5[$i]['tahun']?></option>
								<?php }?>
								</select>
							</div>
							<div class="col-md-3">
								<label>Bulan</label>
								<select name="bulanbg5_5kiri" class="form-control select2" style="width: 100%;">
								  <?php for ($i = 0; $i < sizeof($bulan); $i++) {?>
								  <option <?php if($bulan[$i] == $bulanbg5_5kiri) echo "selected";?> value="<?php echo $bulan[$i]?>"><?php echo ucfirst($bulan[$i])?></option>
								  <?php }?>
								</select>
							</div>
							<div class="col-md-3 pull-right">
								<label>&nbsp;</label>
								<button type="submit" class="btn btn-primary" name="tampil"><i class="fa fa-eye"></i> Tampilkan</button>
							</div>
						</form>
					</div>
					<br>
					<div class="row">
						<div align="center" class="highcharts-container" id="bg5_5chartkiri"></div>
					</div>
					<br>
					<div class="row">
						<div class="col-md-12" >
						<table class="table table-bordered table-hover">
							<thead>
								<tr>
									<th><center>Realisasi Per <?php echo ucfirst($bulanbg5_5kiri)." ".$tahunbg5_5kiri;?></center></th>
									<th><center>Target Per <?php echo ucfirst($bulanbg5_5kiri)." ".$tahunbg5_5kiri;?></center></th>
									<th><center>Persentasi Pencapaian <?php echo ucfirst($bulanbg5_5kiri)." ".$tahunbg5_5kiri;?></center></th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td><center><?php echo number_format((float)$databg5_5realisasikiri, 2, '.', '');?></center></td>
									<td><center><?php echo number_format((float)$databg5_5targetkiri, 2, '.', '');?></center></td>
									<td><center><?php echo number_format((float)$databg5_5persentasekiri, 2, '.', '');?> %</center></td>
								</tr>
							</tbody>
						</table>
						</div>
					</div>
				</div>
			  </div>
            </div>
			<div class="col-md-6">
			<div class="box box-success">
				<div class="box-header" style="text-align:center">
					<h3><strong>Bright Gas 5.5 Kg</strong></h3>
				</div>
				<div class="box-body">
					<div class="row">
						<form action="<?php echo base_url();?>index.php/homecon/index" method="post" enctype="multipart/form-data" role="form">
							<div class="col-md-3">
								<label>Tahun</label>
								<select name="tahunbg5_5kanan" class="form-control select2" style="width: 100%;">
								<?php for ($i = 0; $i < sizeof($tahunbg5_5); $i++) {?>
								  <option <?php if($tahunbg5_5[$i]['tahun'] == $tahunbg5_5kanan) echo "selected";?> value="<?php echo $tahunbg5_5[$i]['tahun']?>"><?php echo $tahunbg5_5[$i]['tahun']?></option>
								<?php }?>
								</select>
							</div>
							<div class="col-md-3">
								<label>Bulan</label>
								<select name="bulanbg5_5kanan" class="form-control select2" style="width: 100%;">
								  <?php for ($i = 0; $i < sizeof($bulan); $i++) {?>
								  <option <?php if($bulan[$i] == $bulanbg5_5kanan) echo "selected";?> value="<?php echo $bulan[$i]?>"><?php echo ucfirst($bulan[$i])?></option>
								  <?php }?>
								</select>
							</div>
							<div class="col-md-3 pull-right">
								<label>&nbsp;</label>
								<button type="submit" class="btn btn-primary" name="tampil"><i class="fa fa-eye"></i> Tampilkan</button>
							</div>
						</form>
					</div>
					<br>
					<div class="row">
						<div align="center" class="highcharts-container" id="bg5_5chartkanan"></div>
					</div>
					<br>
					<div class="row">
						<div class="col-md-12" >
						<table class="table table-bordered table-hover">
							<thead>
								<tr>
									<th><center>Realisasi Per <?php echo ucfirst($bulanbg5_5kanan)." ".$tahunbg5_5kanan;?></center></th>
									<th><center>Target Per <?php echo $tahunbg5_5kanan;?></center></th>
									<th><center>Persentasi Pencapaian</center></th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td><center><?php echo number_format((float)$databg5_5realisasikanan, 2, '.', '');?></center></td>
									<td><center><?php echo number_format((float)$databg5_5targetkanan, 2, '.', '');?></center></td>
									<td><center><?php echo number_format((float)$databg5_5persentasekanan, 2, '.', '');?> %</center></td>
								</tr>
							</tbody>
						</table>
						</div>
					</div>
				</div>
			</div>
		</div>
		</div>
		<!-- Untuk BG 12 Kg -->
		<div class="row">
		  <div class="col-md-6">
          <!-- general form elements -->
			  <div class="box box-success">
				<div class="box-header" style="text-align:center">
					<h3><strong>Bright Gas 12 Kg</strong></h3>
				</div>
				<div class="box-body">
					<div class="row">
						<form action="<?php echo base_url();?>index.php/homecon/index" method="post" enctype="multipart/form-data" role="form">
							<div class="col-md-3">
								<label>Tahun</label>
								<select name="tahunbg12kiri" class="form-control select2" style="width: 100%;">
								<?php for ($i = 0; $i < sizeof($tahunbg12); $i++) {?>
								  <option <?php if($tahunbg12[$i]['tahun'] == $tahunbg12kiri) echo "selected";?> value="<?php echo $tahunbg12[$i]['tahun']?>"><?php echo $tahunbg12[$i]['tahun']?></option>
								<?php }?>
								</select>
							</div>
							<div class="col-md-3">
								<label>Bulan</label>
								<select name="bulanbg12kiri" class="form-control select2" style="width: 100%;">
								  <?php for ($i = 0; $i < sizeof($bulan); $i++) {?>
								  <option <?php if($bulan[$i] == $bulanbg12kiri) echo "selected";?> value="<?php echo $bulan[$i]?>"><?php echo ucfirst($bulan[$i])?></option>
								  <?php }?>
								</select>
							</div>
							<div class="col-md-3 pull-right">
								<label>&nbsp;</label>
								<button type="submit" class="btn btn-primary" name="tampil"><i class="fa fa-eye"></i> Tampilkan</button>
							</div>
						</form>
					</div>
					<br>
					<div class="row">
						<div align="center" class="highcharts-container" id="bg12chartkiri"></div>
					</div>
					<br>
					<div class="row">
						<div class="col-md-12" >
						<table class="table table-bordered table-hover">
							<thead>
								<tr>
									<th><center>Realisasi Per <?php echo ucfirst($bulanbg12kiri)." ".$tahunbg12kiri;?></center></th>
									<th><center>Target Per <?php echo ucfirst($bulanbg12kiri)." ".$tahunbg12kiri;?></center></th>
									<th><center>Persentasi Pencapaian <?php echo ucfirst($bulanbg12kiri)." ".$tahunbg12kiri;?></center></th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td><center><?php echo number_format((float)$databg12realisasikiri, 2, '.', '');?></center></td>
									<td><center><?php echo number_format((float)$databg12targetkiri, 2, '.', '');?></center></td>
									<td><center><?php echo number_format((float)$databg12persentasekiri, 2, '.', '');?> %</center></td>
								</tr>
							</tbody>
						</table>
						</div>
					</div>
				</div>
			  </div>
            </div>
			<div class="col-md-6">
			<div class="box box-success">
				<div class="box-header" style="text-align:center">
					<h3><strong>Bright Gas 12 Kg</strong></h3>
				</div>
				<div class="box-body">
					<div class="row">
						<form action="<?php echo base_url();?>index.php/homecon/index" method="post" enctype="multipart/form-data" role="form">
							<div class="col-md-3">
								<label>Tahun</label>
								<select name="tahunbg12kanan" class="form-control select2" style="width: 100%;">
								<?php for ($i = 0; $i < sizeof($tahunbg12); $i++) {?>
								  <option <?php if($tahunbg12[$i]['tahun'] == $tahunbg12kanan) echo "selected";?> value="<?php echo $tahunbg12[$i]['tahun']?>"><?php echo $tahunbg12[$i]['tahun']?></option>
								<?php }?>
								</select>
							</div>
							<div class="col-md-3">
								<label>Bulan</label>
								<select name="bulanbg12kanan" class="form-control select2" style="width: 100%;">
								  <?php for ($i = 0; $i < sizeof($bulan); $i++) {?>
								  <option <?php if($bulan[$i] == $bulanbg12kanan) echo "selected";?> value="<?php echo $bulan[$i]?>"><?php echo ucfirst($bulan[$i])?></option>
								  <?php }?>
								</select>
							</div>
							<div class="col-md-3 pull-right">
								<label>&nbsp;</label>
								<button type="submit" class="btn btn-primary" name="tampil"><i class="fa fa-eye"></i> Tampilkan</button>
							</div>
						</form>
					</div>
					<br>
					<div class="row">
						<div align="center" class="highcharts-container" id="bg12chartkanan"></div>
					</div>
					<br>
					<div class="row">
						<div class="col-md-12" >
						<table class="table table-bordered table-hover">
							<thead>
								<tr>
									<th><center>Realisasi Per <?php echo ucfirst($bulanbg12kanan)." ".$tahunbg12kanan;?></center></th>
									<th><center>Target Per <?php echo $tahunbg12kanan;?></center></th>
									<th><center>Persentasi Pencapaian</center></th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td><center><?php echo number_format((float)$databg12realisasikanan, 2, '.', '');?></center></td>
									<td><center><?php echo number_format((float)$databg12targetkanan, 2, '.', '');?></center></td>
									<td><center><?php echo number_format((float)$databg12persentasekanan, 2, '.', '');?> %</center></td>
								</tr>
							</tbody>
						</table>
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
	var colors = ['#696969', '#9ACD32', '#4682B4', '#800080', '#FF69B4', '#FF4500', '#000'];
    // Chart untuk LPG 3 Kg
	jQuery(function(){
		new Highcharts.Chart({
			chart: {
				renderTo: 'lpg3chartkiri',
				type: 'column',
				width: 500,
				shadow: true
			},
			title: {
				text: 'Target Vs Realisasi',
				x: -20
			},
			subtitle: {
				text: 'Bulan <?php echo ucfirst($bulanlpg3kiri)?> Tahun <?php echo ucfirst($tahunlpg3kiri)?>',
				x: -20
			},
			xAxis: {
				categories: ['<?php echo ucfirst($bulanlpg3kiri)?>']
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
						name: 'Realisasi Sales',
						data: [<?php echo $datalpg3realisasikiri; ?>],
						color: colors[1]
					}, {
						name: 'Target Sales',
						data: [<?php echo $datalpg3targetkiri; ?>],
						color: colors[0]
					}]
		});
	});
	jQuery(function(){
		new Highcharts.Chart({
			chart: {
				renderTo: 'lpg3chartkanan',
				type: 'column',
				width: 500,
				shadow: true
			},
			title: {
				text: 'Realisasi Akumulasi Per Bulan Vs Target Per Tahun',
				x: -20
			},
			subtitle: {
				text: 'Bulan <?php echo ucfirst($bulanlpg3kanan)?> Tahun <?php echo ucfirst($tahunlpg3kanan)?>',
				x: -20
			},
			xAxis: {
				categories: ['Realisasi Akumulasi Per Bulan <?php echo ucfirst($bulanlpg3kanan)?> Vs Target Per Tahun <?php echo $tahunlpg3kanan?>']
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
						name: 'Realisasi Akumulasi Per Bulan <?php echo ucfirst($bulanlpg3kanan)?>',
						data: [<?php echo $datalpg3realisasikanan; ?>],
						color: colors[1]
					}, {
						name: 'Target Per Tahun <?php echo $tahunlpg3kanan?>',
						data: [<?php echo $datalpg3targetkanan; ?>],
						color: colors[0]
					}]
		});
	});
	
	// Chart untuk LPG 12 Kg
	jQuery(function(){
		new Highcharts.Chart({
			chart: {
				renderTo: 'lpg12chartkiri',
				type: 'column',
				width: 500,
				shadow: true
			},
			title: {
				text: 'Target Vs Realisasi',
				x: -20
			},
			subtitle: {
				text: 'Bulan <?php echo ucfirst($bulanlpg12kiri)?> Tahun <?php echo ucfirst($tahunlpg12kiri)?>',
				x: -20
			},
			xAxis: {
				categories: ['<?php echo ucfirst($bulanlpg12kiri)?>']
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
						name: 'Realisasi Sales',
						data: [<?php echo $datalpg12realisasikiri; ?>],
						color: colors[2]
					}, {
						name: 'Target Sales',
						data: [<?php echo $datalpg12targetkiri; ?>],
						color: colors[0]
					}]
		});
	});
	jQuery(function(){
		new Highcharts.Chart({
			chart: {
				renderTo: 'lpg12chartkanan',
				type: 'column',
				width: 500,
				shadow: true
			},
			title: {
				text: 'Realisasi Akumulasi Per Bulan Vs Target Per Tahun',
				x: -20
			},
			subtitle: {
				text: 'Bulan <?php echo ucfirst($bulanlpg12kanan)?> Tahun <?php echo ucfirst($tahunlpg12kanan)?>',
				x: -20
			},
			xAxis: {
				categories: ['Realisasi Akumulasi Per Bulan <?php echo ucfirst($bulanlpg12kanan)?> Vs Target Per Tahun <?php echo $tahunlpg12kanan?>']
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
						name: 'Realisasi Akumulasi Per Bulan <?php echo ucfirst($bulanlpg12kanan)?>',
						data: [<?php echo $datalpg12realisasikanan; ?>],
						color: colors[2]
					}, {
						name: 'Target Per Tahun <?php echo $tahunlpg12kanan?>',
						data: [<?php echo $datalpg12targetkanan; ?>],
						color: colors[0]
					}]
		});
	});
	
	// Chart untuk LPG 50 Kg
	jQuery(function(){
		new Highcharts.Chart({
			chart: {
				renderTo: 'lpg50chartkiri',
				type: 'column',
				width: 500,
				shadow: true
			},
			title: {
				text: 'Target Vs Realisasi',
				x: -20
			},
			subtitle: {
				text: 'Bulan <?php echo ucfirst($bulanlpg50kiri)?> Tahun <?php echo ucfirst($tahunlpg50kiri)?>',
				x: -20
			},
			xAxis: {
				categories: ['<?php echo ucfirst($bulanlpg50kiri)?>']
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
						name: 'Realisasi Sales',
						data: [<?php echo $datalpg50realisasikiri; ?>],
						color: colors[5]
					}, {
						name: 'Target Sales',
						data: [<?php echo $datalpg50targetkiri; ?>],
						color: colors[0]
					}]
		});
	});
	jQuery(function(){
		new Highcharts.Chart({
			chart: {
				renderTo: 'lpg50chartkanan',
				type: 'column',
				width: 500,
				shadow: true
			},
			title: {
				text: 'Realisasi Akumulasi Per Bulan Vs Target Per Tahun',
				x: -20
			},
			subtitle: {
				text: 'Bulan <?php echo ucfirst($bulanlpg50kanan)?> Tahun <?php echo ucfirst($tahunlpg50kanan)?>',
				x: -20
			},
			xAxis: {
				categories: ['Realisasi Akumulasi Per Bulan <?php echo ucfirst($bulanlpg50kanan)?> Vs Target Per Tahun <?php echo $tahunlpg50kanan?>']
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
						name: 'Realisasi Akumulasi Per Bulan <?php echo ucfirst($bulanlpg50kanan)?>',
						data: [<?php echo $datalpg50realisasikanan; ?>],
						color: colors[5]
					}, {
						name: 'Target Per Tahun <?php echo $tahunlpg50kanan?>',
						data: [<?php echo $datalpg50targetkanan; ?>],
						color: colors[0]
					}]
		});
	});
	
	// Chart untuk BG 5.5 Kg
	jQuery(function(){
		new Highcharts.Chart({
			chart: {
				renderTo: 'bg5_5chartkiri',
				type: 'column',
				width: 500,
				shadow: true
			},
			title: {
				text: 'Target Vs Realisasi',
				x: -20
			},
			subtitle: {
				text: 'Bulan <?php echo ucfirst($bulanbg5_5kiri)?> Tahun <?php echo ucfirst($tahunbg5_5kiri)?>',
				x: -20
			},
			xAxis: {
				categories: ['<?php echo ucfirst($bulanbg5_5kiri)?>']
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
						name: 'Realisasi Sales',
						data: [<?php echo $databg5_5realisasikiri; ?>],
						color: colors[4]
					}, {
						name: 'Target Sales',
						data: [<?php echo $databg5_5targetkiri; ?>],
						color: colors[0]
					}]
		});
	});
	jQuery(function(){
		new Highcharts.Chart({
			chart: {
				renderTo: 'bg5_5chartkanan',
				type: 'column',
				width: 500,
				shadow: true
			},
			title: {
				text: 'Realisasi Akumulasi Per Bulan Vs Target Per Tahun',
				x: -20
			},
			subtitle: {
				text: 'Bulan <?php echo ucfirst($bulanbg5_5kanan)?> Tahun <?php echo ucfirst($tahunbg5_5kanan)?>',
				x: -20
			},
			xAxis: {
				categories: ['Realisasi Akumulasi Per Bulan <?php echo ucfirst($bulanbg5_5kanan)?> Vs Target Per Tahun <?php echo $tahunbg5_5kanan?>']
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
						name: 'Realisasi Akumulasi Per Bulan <?php echo ucfirst($bulanbg5_5kanan)?>',
						data: [<?php echo $databg5_5realisasikanan; ?>],
						color: colors[4]
					}, {
						name: 'Target Per Tahun <?php echo $tahunbg5_5kanan?>',
						data: [<?php echo $databg5_5targetkanan; ?>],
						color: colors[0]
					}]
		});
	});
	
	// Chart untuk BG 12 Kg
	jQuery(function(){
		new Highcharts.Chart({
			chart: {
				renderTo: 'bg12chartkiri',
				type: 'column',
				width: 500,
				shadow: true
			},
			title: {
				text: 'Target Vs Realisasi',
				x: -20
			},
			subtitle: {
				text: 'Bulan <?php echo ucfirst($bulanbg12kiri)?> Tahun <?php echo ucfirst($tahunbg12kiri)?>',
				x: -20
			},
			xAxis: {
				categories: ['<?php echo ucfirst($bulanbg12kiri)?>']
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
						name: 'Realisasi Sales',
						data: [<?php echo $databg12realisasikiri; ?>],
						color: colors[3]
					}, {
						name: 'Target Sales',
						data: [<?php echo $databg12targetkiri; ?>],
						color: colors[0]
					}]
		});
	});
	jQuery(function(){
		new Highcharts.Chart({
			chart: {
				renderTo: 'bg12chartkanan',
				type: 'column',
				width: 500,
				shadow: true
			},
			title: {
				text: 'Realisasi Akumulasi Per Bulan Vs Target Per Tahun',
				x: -20
			},
			subtitle: {
				text: 'Bulan <?php echo ucfirst($bulanbg12kanan)?> Tahun <?php echo ucfirst($tahunbg12kanan)?>',
				x: -20
			},
			xAxis: {
				categories: ['Realisasi Akumulasi Per Bulan <?php echo ucfirst($bulanbg12kanan)?> Vs Target Per Tahun <?php echo $tahunbg12kanan?>']
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
						name: 'Realisasi Akumulasi Per Bulan <?php echo ucfirst($bulanbg12kanan)?>',
						data: [<?php echo $databg12realisasikanan; ?>],
						color: colors[3]
					}, {
						name: 'Target Per Tahun <?php echo $tahunbg12kanan?>',
						data: [<?php echo $databg12targetkanan; ?>],
						color: colors[0]
					}]
		});
	});
	</script>
