<script src="<?php echo base_url(); ?>assets/js/jquery-1.11.3.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/js/highcharts.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/js/exporting.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/js/data.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/js/canvas-tools.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/js/export-csv.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/js/bootstrap-typeahead.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/bower_components/select2/dist/js/select2.full.min.js"></script>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/bower_components/select2/dist/css/select2.min.css">
<!-- Content Wrapper. Contains page content -->

<div class="content-wrapper">
	<section class="content-header">
      <h1>
        &nbsp;
      </h1>
      <ol class="breadcrumb">
        <li> <i class="fa fa-book"></i> Laporan</li>
        <li class="active"><a href="<?php echo base_url(); ?>index.php/laporanhariancon/index"><i class="fa fa-book"></i> Harian</a></li>
      </ol>
    </section>

    <section class="content">
    	<div class="row">
    		<div class="col-md-12 pull-left">
    			<div class="box box-danger">
    				<legend style="text-align:center;">LAPORAN HARIAN PINJAMAN</legend>
    				<form action="<?php echo base_url();?>index.php/laporanhariancon/excel_pinjaman" method="post" enctype="multipart/form-data" role="form">
						<div class="box-body">
							<div class="form-group col-xs-3">
								<label for="exampleInputPassword1">Tanggal</label>
								<div class="input-group date">
									<div class="input-group-addon">
										<i class="fa fa-calendar"></i>
									</div>
									<input type="text" class="form-control pull-right" name="tanggal_pinjaman" id="tanggal_pinjaman" value="" data-date-format="dd-mm-yyyy">
								</div>
							</div>
			            </div>
			            <div class="box-footer">
							<div class="col-xs-3">
				            	<div class="form-group pull-left">
									<button type="submit" class="btn btn-success" name="excel"><i class="fa fa-file-excel-o"></i> Download Excel</button>
								</div>
							</div>
						</div>  
					</form>
    			</div>
    			<div class="box box-danger">
    				<legend style="text-align:center;">LAPORAN HARIAN SIMPANAN POKOK</legend>
    				<form action="<?php echo base_url();?>index.php/laporanhariancon/excel_simpananpokok" method="post" enctype="multipart/form-data" role="form">
						<div class="box-body">
							<div class="form-group col-xs-3">
								<label for="exampleInputPassword1">Tanggal</label>
								<div class="input-group date">
									<div class="input-group-addon">
										<i class="fa fa-calendar"></i>
									</div>
									<input type="text" class="form-control pull-right" name="tanggal_simpananpokok" id="tanggal_simpananpokok" value="" data-date-format="dd-mm-yyyy">
								</div>
							</div>
			            </div>
			            <div class="box-footer">
							<div class="col-xs-3">
				            	<div class="form-group pull-left">
									<button type="submit" class="btn btn-success" name="excel"><i class="fa fa-file-excel-o"></i> Download Excel</button>
								</div>
							</div>
						</div>  
					</form>
    			</div>
    			<div class="box box-danger">
    				<legend style="text-align:center;">LAPORAN HARIAN SIMPANAN WAJIB</legend>
    				<form action="<?php echo base_url();?>index.php/laporanhariancon/excel_simpananwajib" method="post" enctype="multipart/form-data" role="form">
						<div class="box-body">
							<div class="form-group col-xs-3">
								<label for="exampleInputPassword1">Tanggal</label>
								<div class="input-group date">
									<div class="input-group-addon">
										<i class="fa fa-calendar"></i>
									</div>
									<input type="text" class="form-control pull-right" name="tanggal_simpananwajib" id="tanggal_simpananwajib" value="" data-date-format="dd-mm-yyyy">
								</div>
							</div>
			            </div>
			            <div class="box-footer">
							<div class="col-xs-3">
				            	<div class="form-group pull-left">
									<button type="submit" class="btn btn-success" name="excel"><i class="fa fa-file-excel-o"></i> Download Excel</button>
								</div>
							</div>
						</div>  
					</form>
    			</div>
    			<div class="box box-danger">
    				<legend style="text-align:center;">LAPORAN HARIAN SIMPANAN KHUSUS</legend>
    				<form action="<?php echo base_url();?>index.php/laporanhariancon/excel_simpanankhusus" method="post" enctype="multipart/form-data" role="form">
						<div class="box-body">
							<div class="form-group col-xs-3">
								<label for="exampleInputPassword1">Tanggal</label>
								<div class="input-group date">
									<div class="input-group-addon">
										<i class="fa fa-calendar"></i>
									</div>
									<input type="text" class="form-control pull-right" name="tanggal_simpanankhusus" id="tanggal_simpanankhusus" value="" data-date-format="dd-mm-yyyy">
								</div>
							</div>
			            </div>
			            <div class="box-footer">
							<div class="col-xs-3">
				            	<div class="form-group pull-left">
									<button type="submit" class="btn btn-success" name="excel"><i class="fa fa-file-excel-o"></i> Download Excel</button>
								</div>
							</div>
						</div>  
					</form>
    			</div>
    			<div class="box box-danger">
    				<legend style="text-align:center;">LAPORAN HARIAN SIMPANAN DANSOS ANGGOTA</legend>
    				<form action="<?php echo base_url();?>index.php/laporanhariancon/excel_simpanandanasosial" method="post" enctype="multipart/form-data" role="form">
						<div class="box-body">
							<div class="form-group col-xs-3">
								<label for="exampleInputPassword1">Tanggal</label>
								<div class="input-group date">
									<div class="input-group-addon">
										<i class="fa fa-calendar"></i>
									</div>
									<input type="text" class="form-control pull-right" name="tanggal_simpanandanasosial" id="tanggal_simpanandanasosial" value="" data-date-format="dd-mm-yyyy">
								</div>
							</div>
			            </div>
			            <div class="box-footer">
							<div class="col-xs-3">
				            	<div class="form-group pull-left">
									<button type="submit" class="btn btn-success" name="excel"><i class="fa fa-file-excel-o"></i> Download Excel</button>
								</div>
							</div>
						</div>  
					</form>
    			</div>
    			<div class="box box-danger">
    				<legend style="text-align:center;">LAPORAN HARIAN SIMPANAN KANZUN</legend>
    				<form action="<?php echo base_url();?>index.php/laporanhariancon/excel_simpanankanzun" method="post" enctype="multipart/form-data" role="form">
						<div class="box-body">
							<div class="form-group col-xs-3">
								<label for="exampleInputPassword1">Tanggal</label>
								<div class="input-group date">
									<div class="input-group-addon">
										<i class="fa fa-calendar"></i>
									</div>
									<input type="text" class="form-control pull-right" name="tanggal_simpanankanzun" id="tanggal_simpanankanzun" value="" data-date-format="dd-mm-yyyy">
								</div>
							</div>
			            </div>
			            <div class="box-footer">
							<div class="col-xs-3">
				            	<div class="form-group pull-left">
									<button type="submit" class="btn btn-success" name="excel"><i class="fa fa-file-excel-o"></i> Download Excel</button>
								</div>
							</div>
						</div>  
					</form>
    			</div>
    			<div class="box box-danger">
    				<legend style="text-align:center;">LAPORAN HARIAN SIMPANAN PIHAK KETIGA</legend>
    				<form action="<?php echo base_url();?>index.php/laporanhariancon/excel_simpananpihakketiga" method="post" enctype="multipart/form-data" role="form">
						<div class="box-body">
							<div class="form-group col-xs-3">
								<label for="exampleInputPassword1">Tanggal</label>
								<div class="input-group date">
									<div class="input-group-addon">
										<i class="fa fa-calendar"></i>
									</div>
									<input type="text" class="form-control pull-right" name="tanggal_simpananpihakketiga" id="tanggal_simpananpihakketiga" value="" data-date-format="dd-mm-yyyy">
								</div>
							</div>
			            </div>
			            <div class="box-footer">
							<div class="col-xs-3">
				            	<div class="form-group pull-left">
									<button type="submit" class="btn btn-success" name="excel"><i class="fa fa-file-excel-o"></i> Download Excel</button>
								</div>
							</div>
						</div>  
					</form>
    			</div>
    			<div class="box box-danger">
    				<legend style="text-align:center;">LAPORAN SIMPANAN 3 TH</legend>
    				<form action="<?php echo base_url();?>index.php/laporanhariancon/excel_simpanan3th" method="post" enctype="multipart/form-data" role="form">
						<div class="box-body">
							<div class="form-group col-xs-3">
								<label for="exampleInputPassword1">Tanggal</label>
								<div class="input-group date">
									<div class="input-group-addon">
										<i class="fa fa-calendar"></i>
									</div>
									<input type="text" class="form-control pull-right" name="tanggal_simpanan3th" id="tanggal_simpanan3th" value="" data-date-format="dd-mm-yyyy">
								</div>
							</div>
			            </div>
			            <div class="box-footer">
							<div class="col-xs-3">
				            	<div class="form-group pull-left">
									<button type="submit" class="btn btn-success" name="excel"><i class="fa fa-file-excel-o"></i> Download Excel</button>
								</div>
							</div>
						</div>  
					</form>
    			</div>
    		</div>
    	</div>
    </section>
</div>

<script>

$(document).ready(function() {
	$('#tanggal_pinjaman').datepicker({}).on('changeDate', function(ev){});
	$('#tanggal_simpananpokok').datepicker({}).on('changeDate', function(ev){});
	$('#tanggal_simpananwajib').datepicker({}).on('changeDate', function(ev){});
	$('#tanggal_simpanankhusus').datepicker({}).on('changeDate', function(ev){});
	$('#tanggal_simpanandanasosial').datepicker({}).on('changeDate', function(ev){});
	$('#tanggal_simpanankanzun').datepicker({}).on('changeDate', function(ev){});
	$('#tanggal_simpananpihakketiga').datepicker({}).on('changeDate', function(ev){});
	$('#tanggal_simpanan3th').datepicker({}).on('changeDate', function(ev){});
});

</script>