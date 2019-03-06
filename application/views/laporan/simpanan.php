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
        <li class="active"><a href="<?php echo base_url(); ?>index.php/laporansimpanancon/index"><i class="fa fa-money"></i> Simpanan</a></li>
      </ol>
    </section>

    <section class="content">
    	<div class="row">
    		<div class="col-md-12 pull-left">
    			<div class="box box-danger">
    				<legend style="text-align:center;">LAPORAN SIMPANAN POKOK</legend>
    				<form action="<?php echo base_url();?>index.php/laporansimpanancon/excel_simpananpokok" method="post" enctype="multipart/form-data" role="form">
						<div class="box-body">
							<div class="form-group col-xs-3">
								<label for="exampleInputPassword1">Dari</label>
								<div class="input-group date">
									<div class="input-group-addon">
										<i class="fa fa-calendar"></i>
									</div>
									<input type="text" class="form-control pull-right" name="dari_simpananpokok" id="dari_simpananpokok" value="" data-date-format="dd-mm-yyyy">
								</div>
							</div>
							<div class="form-group col-xs-3">
								<label for="exampleInputPassword1">Sampai</label>
								<div class="input-group date">
									<div class="input-group-addon">
										<i class="fa fa-calendar"></i>
									</div>
									<input type="text" class="form-control pull-right" name="sampai_simpananpokok" id="sampai_simpananpokok" value="" data-date-format="dd-mm-yyyy">
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
    				<legend style="text-align:center;">LAPORAN SIMPANAN WAJIB</legend>
    				<form action="<?php echo base_url();?>index.php/laporansimpanancon/excel_simpananwajib" method="post" enctype="multipart/form-data" role="form">
						<div class="box-body">
							<div class="form-group col-xs-3">
								<label for="exampleInputPassword1">Dari</label>
								<div class="input-group date">
									<div class="input-group-addon">
										<i class="fa fa-calendar"></i>
									</div>
									<input type="text" class="form-control pull-right" name="dari_simpananwajib" id="dari_simpananwajib" value="" data-date-format="dd-mm-yyyy">
								</div>
							</div>
							<div class="form-group col-xs-3">
								<label for="exampleInputPassword1">Sampai</label>
								<div class="input-group date">
									<div class="input-group-addon">
										<i class="fa fa-calendar"></i>
									</div>
									<input type="text" class="form-control pull-right" name="sampai_simpananwajib" id="sampai_simpananwajib" value="" data-date-format="dd-mm-yyyy">
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
    				<legend style="text-align:center;">LAPORAN SIMPANAN KHUSUS</legend>
    				<form action="<?php echo base_url();?>index.php/laporansimpanancon/excel_simpanankhusus" method="post" enctype="multipart/form-data" role="form">
						<div class="box-body">
							<div class="form-group col-xs-3">
								<label for="exampleInputPassword1">Dari</label>
								<div class="input-group date">
									<div class="input-group-addon">
										<i class="fa fa-calendar"></i>
									</div>
									<input type="text" class="form-control pull-right" name="dari_simpanankhusus" id="dari_simpanankhusus" value="" data-date-format="dd-mm-yyyy">
								</div>
							</div>
							<div class="form-group col-xs-3">
								<label for="exampleInputPassword1">Sampai</label>
								<div class="input-group date">
									<div class="input-group-addon">
										<i class="fa fa-calendar"></i>
									</div>
									<input type="text" class="form-control pull-right" name="sampai_simpanankhusus" id="sampai_simpanankhusus" value="" data-date-format="dd-mm-yyyy">
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
    				<legend style="text-align:center;">LAPORAN SIMPANAN DANSOS ANGGOTA</legend>
    				<form action="<?php echo base_url();?>index.php/laporansimpanancon/excel_simpanandanasosial" method="post" enctype="multipart/form-data" role="form">
						<div class="box-body">
							<div class="form-group col-xs-3">
								<label for="exampleInputPassword1">Dari</label>
								<div class="input-group date">
									<div class="input-group-addon">
										<i class="fa fa-calendar"></i>
									</div>
									<input type="text" class="form-control pull-right" name="dari_simpanandanasosial" id="dari_simpanandanasosial" value="" data-date-format="dd-mm-yyyy">
								</div>
							</div>
							<div class="form-group col-xs-3">
								<label for="exampleInputPassword1">Sampai</label>
								<div class="input-group date">
									<div class="input-group-addon">
										<i class="fa fa-calendar"></i>
									</div>
									<input type="text" class="form-control pull-right" name="sampai_simpanandanasosial" id="sampai_simpanandanasosial" value="" data-date-format="dd-mm-yyyy">
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
    				<legend style="text-align:center;">LAPORAN SIMPANAN KANZUN</legend>
    				<form action="<?php echo base_url();?>index.php/laporansimpanancon/excel_simpanankanzun" method="post" enctype="multipart/form-data" role="form">
						<div class="box-body">
							<div class="form-group col-xs-3">
								<label for="exampleInputPassword1">Dari</label>
								<div class="input-group date">
									<div class="input-group-addon">
										<i class="fa fa-calendar"></i>
									</div>
									<input type="text" class="form-control pull-right" name="dari_simpanankanzun" id="dari_simpanankanzun" value="" data-date-format="dd-mm-yyyy">
								</div>
							</div>
							<div class="form-group col-xs-3">
								<label for="exampleInputPassword1">Sampai</label>
								<div class="input-group date">
									<div class="input-group-addon">
										<i class="fa fa-calendar"></i>
									</div>
									<input type="text" class="form-control pull-right" name="sampai_simpanankanzun" id="sampai_simpanankanzun" value="" data-date-format="dd-mm-yyyy">
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
    				<legend style="text-align:center;">LAPORAN SIMPANAN PIHAK KETIGA</legend>
    				<form action="<?php echo base_url();?>index.php/laporansimpanancon/excel_simpananpihakketiga" method="post" enctype="multipart/form-data" role="form">
						<div class="box-body">
							<div class="form-group col-xs-3">
								<label for="exampleInputPassword1">Dari</label>
								<div class="input-group date">
									<div class="input-group-addon">
										<i class="fa fa-calendar"></i>
									</div>
									<input type="text" class="form-control pull-right" name="dari_simpananpihakketiga" id="dari_simpananpihakketiga" value="" data-date-format="dd-mm-yyyy">
								</div>
							</div>
							<div class="form-group col-xs-3">
								<label for="exampleInputPassword1">Sampai</label>
								<div class="input-group date">
									<div class="input-group-addon">
										<i class="fa fa-calendar"></i>
									</div>
									<input type="text" class="form-control pull-right" name="sampai_simpananpihakketiga" id="sampai_simpananpihakketiga" value="" data-date-format="dd-mm-yyyy">
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

<style type="text/css">
table.table-bordered{
  border:1px solid silver;
  margin-top:20px;
}
table.table-bordered > thead > tr > th{
  border:1px solid silver;
}
table.table-bordered > tbody > tr > td{
  border:1px solid silver;
}
.table th {
   text-align: center;   
}
#keuangan_table_filter {
  text-align:right;
}
</style>

<script>

$(document).ready(function() {
	$('#dari_simpananpokok').datepicker({}).on('changeDate', function(ev){});
	$('#sampai_simpananpokok').datepicker({}).on('changeDate', function(ev){});

	$('#dari_simpananwajib').datepicker({}).on('changeDate', function(ev){});
	$('#sampai_simpananwajib').datepicker({}).on('changeDate', function(ev){});

	$('#dari_simpanankhusus').datepicker({}).on('changeDate', function(ev){});
	$('#sampai_simpanankhusus').datepicker({}).on('changeDate', function(ev){});

	$('#dari_simpanandanasosial').datepicker({}).on('changeDate', function(ev){});
	$('#sampai_simpanandanasosial').datepicker({}).on('changeDate', function(ev){});

	$('#dari_simpanankanzun').datepicker({}).on('changeDate', function(ev){});
	$('#sampai_simpanankanzun').datepicker({}).on('changeDate', function(ev){});

	$('#dari_simpananpihakketiga').datepicker({}).on('changeDate', function(ev){});
	$('#sampai_simpananpihakketiga').datepicker({}).on('changeDate', function(ev){});
});

</script>