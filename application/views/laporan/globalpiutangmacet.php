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
        <li class="active"><a href="<?php echo base_url(); ?>index.php/laporanglobalpiutangmacetcon/index"><i class="fa fa-book"></i> Global Piutang Macet</a></li>
      </ol>
    </section>

    <section class="content">
    	<div class="row">
    		<div class="col-md-12 pull-left">
    			<div class="box box-danger">
    				<legend style="text-align:center;">LAPORAN GLOBAL PIUTANG MACET</legend>
    				<form action="<?php echo base_url();?>index.php/laporanglobalpiutangmacetcon/html" method="post" enctype="multipart/form-data" role="form" target="_blank">
						<div class="box-body">
							<div class="form-group col-xs-3">
								<label for="exampleInputPassword1">Per Tanggal</label>
								<div class="input-group date">
									<div class="input-group-addon">
										<i class="fa fa-calendar"></i>
									</div>
									<input type="text" class="form-control pull-right" name="tanggal" id="tanggal" value="" data-date-format="dd-mm-yyyy">
								</div>
							</div>
							<div class="form-group col-xs-3" id="div_status">
		                        <label for="exampleInputPassword1">Status</label>
		                        <select id="status" name="status" class="form-control" style="width: 100%;">
									<option value='all'>- SEMUA -</option>
									<option value='1' >Kuning 1</option>
									<option value='2' >Kuning 2</option>
									<option value='3' >Merah</option>
		                        </select>
		                    </div>
			            </div>
			            <div class="box-footer">
			            	<!--<div class="col-xs-3">
				            	<div class="form-group pull-left">
									<a class="btn btn-primary" onClick="view_laporan();"><i class="fa fa-eye"></i> Tampilkan</a>
								</div>
							</div>-->
							<div class="col-xs-3">
				            	<div class="form-group pull-left">
									<button type="submit" class="btn btn-success" name="excel"><i class="fa fa-eye"></i> Tampilkan</button>
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

function view_laporan() {
	var tanggal = $('#tanggal').val();
	if(tanggal == '' || tanggal == null ) {
		alert("Tanggal Tidak Boleh Kosong");
	} else {
		tanggal = tanggal.split("-");
		tgl = '';
		for(i = tanggal.length - 1; i >= 0; i--) {
			if(i == 0) {
				tgl = tgl + tanggal[i];	
			} else {
				tgl = tgl + tanggal[i] + "-";	
			}
		}

		var controller = 'laporanpiutangcon';
		var base_url = '<?php echo site_url(); //you have to load the "url_helper" to use this function ?>';
		window.location.href = base_url + '/' + controller + '/view/' + tgl;
	}
	
}

$(document).ready(function() {
	$('#tanggal').datepicker({}).on('changeDate', function(ev){});
});

</script>