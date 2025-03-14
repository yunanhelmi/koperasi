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
        <li class="active"><a href="<?php echo base_url(); ?>index.php/laporanaruskascon/index"><i class="fa fa-money"></i> Arus Kas</a></li>
      </ol>
    </section>

    <section class="content">
    	<div class="row">
    		<div class="col-md-12 pull-left">
    			<div class="box box-danger">
    				<legend style="text-align:center;">LAPORAN ARUS KAS</legend>
    				<form action="<?php echo base_url();?>index.php/laporanaruskascon/html" method="post" enctype="multipart/form-data" role="form" target="_blank">
						<div class="box-body">
							<div class="form-group col-xs-3">
								<label for="exampleInputPassword1">Dari</label>
								<div class="input-group date">
									<div class="input-group-addon">
										<i class="fa fa-calendar"></i>
									</div>
									<input type="text" class="form-control pull-right" name="dari" id="dari" value="" data-date-format="dd-mm-yyyy">
								</div>
							</div>
							<div class="form-group col-xs-3">
								<label for="exampleInputPassword1">Sampai</label>
								<div class="input-group date">
									<div class="input-group-addon">
										<i class="fa fa-calendar"></i>
									</div>
									<input type="text" class="form-control pull-right" name="sampai" id="sampai" value="" data-date-format="dd-mm-yyyy">
								</div>
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

<script>

function view_laporan() {
	var dari = $('#dari').val();
	var sampai = $('#sampai').val();
	if(dari == '' || dari == null ) {
		alert("Tanggal Dari Tidak Boleh Kosong");
	} else if (sampai == '' || sampai == null) {
		alert("Tanggal Sampai Tidak Boleh Kosong");
	} else {
		dari = dari.split("-");
		tgl_dari = '';
		for(i = dari.length - 1; i >= 0; i--) {
			if(i == 0) {
				tgl_dari = tgl_dari + dari[i];	
			} else {
				tgl_dari = tgl_dari + dari[i] + "-";	
			}
		}

		sampai = sampai.split("-");
		tgl_sampai = '';
		for(i = sampai.length - 1; i >= 0; i--) {
			if(i == 0) {
				tgl_sampai = tgl_sampai + sampai[i];	
			} else {
				tgl_sampai = tgl_sampai + sampai[i] + "-";	
			}
		}

		var controller = 'laporanaruskascon';
		var base_url = '<?php echo site_url(); //you have to load the "url_helper" to use this function ?>';
		window.location.href = base_url + '/' + controller + '/view/' + tgl_dari + '/' + tgl_sampai;
	}
	
}

$(document).ready(function() {
	$('#dari').datepicker({}).on('changeDate', function(ev){});
	$('#sampai').datepicker({}).on('changeDate', function(ev){});
});

</script>