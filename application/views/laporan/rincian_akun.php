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
        <li class="active"><a href="<?php echo base_url(); ?>index.php/laporankeuangancon/index"><i class="fa fa-money"></i> Keuangan</a></li>
      </ol>
    </section>

    <section class="content">
    	<div class="row">
    		<div class="col-md-12 pull-left">
    			<div class="box box-danger">
    				<legend style="text-align:center;">HISTORI RIWAYAT AKUN</legend>
    				<form action="<?php echo base_url();?>index.php/laporanrincianakuncon/html" method="post" enctype="multipart/form-data" role="form" target="_blank">
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
							<div class="form-group col-xs-3">
								<label for="exampleInputPassword1">Kode Akun</label>
								<div class="input-group ">
									<input type="text" class="form-control pull-right" name="kode_akun" id="kode_akun" placeholder="Kode Akun">
								</div>
							</div>
							<div class="form-group col-xs-3">
								<label for="exampleInputPassword1">Nama Akun</label>
								<div class="input-group ">
									<input type="text" class="form-control pull-right" name="nama_akun" id="nama_akun" readonly="">
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
	$('#dari').datepicker({}).on('changeDate', function(ev){});
	$('#sampai').datepicker({}).on('changeDate', function(ev){});


    var kode_akun = [<?php echo $kode_akun; ?>];

	$('#kode_akun').typeahead({
        source: function (query, process) {
        states2 = [];
        map2 = {};
        
        var source = [];
        $.each(kode_akun, function (i, state) {
          map2[state.stateName] = state;
          states2.push(state.stateName);
        });
       
        process(states2);
        
        },
        updater: function (item) {
            
        selectedState = map2[item].stateCode;
        selectedState2 = map2[item].stateDisplay;
        $("#nama_akun").val(selectedState);
        return selectedState2;
        },
        matcher: function (item) {
            if (item.toLowerCase().indexOf(this.query.trim().toLowerCase()) != -1) {
          return true;
        }
        },
        sorter: function (items) {
            return items.sort();
        },
        highlighter: function (item) {
        var regex = new RegExp( '(' + this.query + ')', 'gi' );
        return item.replace( regex, "<strong>$1</strong>" );
        
        },
    });
});

</script>