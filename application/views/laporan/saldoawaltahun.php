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

<?php

function rupiah($angka){
  $hasil_rupiah = "Rp " . number_format($angka,2,',','.');
  return $hasil_rupiah;
}

?>

<div class="content-wrapper">
	<section class="content-header">
      <h1>
        &nbsp;
      </h1>
      <ol class="breadcrumb">
        <li> <i class="fa fa-book"></i> Laporan</li>
        <li class="active"><a href="<?php echo base_url(); ?>index.php/saldoawaltahuncon/index"><i class="fa fa-upload"></i> Saldo Awal Tahun</a></li>
      </ol>
    </section>

    <section class="content">
    	<div class="row">
    		<div class="col-md-12 pull-left">
    			<div class="box box-danger">
    				<legend style="text-align:center;">SALDO AWAL TAHUN</legend>
					<div class="box-body">
						<div class="form-group col-xs-3">
							<label for="exampleInputPassword1">Dari</label>
							<div class="input-group date">
								<div class="input-group-addon">
									<i class="fa fa-calendar"></i>
								</div>
								<?php
								if(isset($tgl_dari)) {
									$dari = date("d-m-Y", strtotime($tgl_dari));	
								} else {
									$dari = "";
								}
								?>
								<input type="text" class="form-control pull-right" name="dari" id="dari" value="<?php echo $dari; ?>" data-date-format="dd-mm-yyyy">
							</div>
						</div>
						<div class="form-group col-xs-3">
							<label for="exampleInputPassword1">Sampai</label>
							<div class="input-group date">
								<div class="input-group-addon">
									<i class="fa fa-calendar"></i>
								</div>
								<?php
								if(isset($tgl_sampai)) {
									$sampai = date("d-m-Y", strtotime($tgl_sampai));	
								} else {
									$sampai = "";
								}
								?>
								<input type="text" class="form-control pull-right" name="sampai" id="sampai" value="<?php echo $sampai; ?>" data-date-format="dd-mm-yyyy">
							</div>
						</div>
		            </div>
		            <div class="box-footer">
		            	<div class="col-xs-3">
			            	<div class="form-group pull-left">
								<a class="btn btn-primary" onClick="view_laporan();"><i class="fa fa-eye"></i> Tampilkan</a>
							</div>
						</div>
					</div>
    			</div>
    			<?php
    			if(isset($kode_aset) && isset($kode_hutang) && isset($kode_modal)) {
    			?>
    			<div class="box box-danger">
    				<legend style="text-align:center;">KOPPONTREN MAMBAUL MUBBASYIRIN SHIDDIQIYYAH</legend>
    				<div class="box-body">
						<table id="saldoawaltahun_table" class="table table-bordered table-hover"  width="50%">
							<thead>
								<tr>
									<th>NOMOR PERKIRAAN</th>
									<th>NAMA AKUN</th>
									<th>JUMLAH</th>
								</tr>
							</thead>
							<tbody>
								<?php
				                    for($i = 0; $i < sizeof($kode_aset); $i++) {
				                ?>
				                <tr>
				                	<td style='text-align: center'><?php echo $kode_aset[$i]['kode_akun']?></td>
				                	<td><?php echo $kode_aset[$i]['nama_akun']?></td>
				                	<td style='text-align: right'><?php echo rupiah($kode_aset[$i]['selisih'])?></td>
				                </tr>
				                <?php } ?>
				                <tr>
				                	<td colspan='2' style='text-align: center'><strong>TOTAL HARTA</strong></td>
				                	<td style='text-align: right'><strong><?php echo rupiah($total_aset)?></strong></td>
				                </tr>
				                <?php
				                    for($i = 0; $i < sizeof($kode_hutang); $i++) {
				                ?>
				                <tr>
				                	<td style='text-align: center'><?php echo $kode_hutang[$i]['kode_akun']?></td>
				                	<td><?php echo $kode_hutang[$i]['nama_akun']?></td>
				                	<td style='text-align: right'><?php echo rupiah($kode_hutang[$i]['selisih'])?></td>
				                </tr>
				                <?php } ?>
				                <tr>
				                	<td colspan='2' style='text-align: center'><strong>TOTAL HUTANG</strong></td>
				                	<td style='text-align: right'><strong><?php echo rupiah($total_hutang)?></strong></td>
				                </tr>
				                <?php
				                    for($i = 0; $i < sizeof($kode_modal); $i++) {
				                    	if($kode_modal[$i]['kode_akun'] == '305' || $kode_modal[$i]['kode_akun'] == '306') {
				                    		continue;
				                    	}
				                ?>
				                <tr>
				                	<td style='text-align: center'><?php echo $kode_modal[$i]['kode_akun']?></td>
				                	<td><?php echo $kode_modal[$i]['nama_akun']?></td>
				                	<td style='text-align: right'><?php echo rupiah($kode_modal[$i]['selisih'])?></td>
				                </tr>
				                <?php } ?>
				                <tr>
				                	<td colspan='2' style='text-align: center'><strong>TOTAL MODAL</strong></td>
				                	<td style='text-align: right'><strong><?php echo rupiah($total_modal)?></strong></td>
				                </tr>
							</tbody>
						</table>
    				</div>
    			</div>
    			<div class="box box-danger">
    				<div class="box-body">
    					<div class="form-group col-xs-3">
							<label for="exampleInputPassword1">Tanggal Post Saldo</label>
							<div class="input-group date">
								<div class="input-group-addon">
									<i class="fa fa-calendar"></i>
								</div>
								<?php
								if(isset($tgl_saldo)) {
									$tgl = date("d-m-Y", strtotime($tgl_saldo));	
								} else {
									$tgl = "";
								}
								?>
								<input type="text" class="form-control pull-right" name="tanggal_post_saldo" id="tanggal_post_saldo" value="<?php echo $tgl;?>" data-date-format="dd-mm-yyyy">
							</div>
						</div>
						<input type="hidden" class="form-control pull-right" name="tanggal_dari_post_saldo" id="tanggal_dari_post_saldo" value="<?php echo $tgl_dari;?>">
						<input type="hidden" class="form-control pull-right" name="tanggal_sampai_post_saldo" id="tanggal_sampai_post_saldo" value="<?php echo $tgl_sampai;?>">
    				</div>
    				<div class="box-footer">
    					<div class="col-xs-3">
			            	<div class="form-group pull-left">
								<a class="btn btn-primary" onClick="post_saldo();"><i class="fa fa-upload"></i> Post</a>
							</div>
						</div>
    				</div>
    			</div>
    			<?php
    			}
    			?>
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
#saldoawaltahun_table_filter {
  text-align:right;
}
</style>

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

		var controller = 'saldoawaltahuncon';
		var base_url = '<?php echo site_url(); //you have to load the "url_helper" to use this function ?>';
		window.location.href = base_url + '/' + controller + '/view/' + tgl_dari + '/' + tgl_sampai;
	}
	
}

function post_saldo() {
	var tgl_dari 	= $('#tanggal_dari_post_saldo').val();
	var tgl_sampai 	= $('#tanggal_sampai_post_saldo').val();
	var tanggal 	= $('#tanggal_post_saldo').val();
	tgl = tanggal.split("-");
	tgl_saldo = '';
	for(i = tgl.length - 1; i >= 0; i--) {
		if(i == 0) {
			tgl_saldo = tgl_saldo + tgl[i];	
		} else {
			tgl_saldo = tgl_saldo + tgl[i] + "-";	
		}
	}

	console.log(tgl_saldo);
	console.log(tgl_dari);
	console.log(tgl_sampai);

	var controller = 'saldoawaltahuncon';
	var base_url = '<?php echo site_url(); //you have to load the "url_helper" to use this function ?>';
	window.location.href = base_url + '/' + controller + '/post_saldo/' + tgl_dari + '/' + tgl_sampai + '/' + tgl_saldo;
}

$(document).ready(function() {
	$('#dari').datepicker({}).on('changeDate', function(ev){});
	$('#sampai').datepicker({}).on('changeDate', function(ev){});
	$('#tanggal_post_saldo').datepicker({}).on('changeDate', function(ev){});
});

</script>