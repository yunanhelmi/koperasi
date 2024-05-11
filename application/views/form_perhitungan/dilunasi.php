<script src="<?php echo base_url(); ?>assets/js/jquery-1.11.3.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/js/highcharts.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/js/exporting.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/js/data.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/js/canvas-tools.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/js/export-csv.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/bower_components/select2/dist/js/select2.full.min.js"></script>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/bower_components/select2/dist/css/select2.min.css">
<!-- Content Wrapper. Contains page content -->

<div class="content-wrapper">
	<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Form Perhitungan Jika Dilunasi
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
    	<div class="row">
    		<div class="col-md-12 pull-left">
    			<div class="box box-danger">
    				<legend style="text-align:center;">PINJAMAN BARU</legend>
    				<div class="box-body">
    					<div class="form-group col-xs-6">
		                  <label for="exampleInputPassword1">Jenis Pinjaman</label>
		                  <select id="jenis_pinjaman" name="jenis_pinjaman" class="form-control" style="width: 100%;">
		                    <option value='Musiman'>Musiman</option>
		                    <option value='Angsuran'>Angsuran</option>
		                  </select>
		                </div>
    					<div class="form-group col-xs-6">
		                  <label for="exampleInputPassword1">Sisa Pinjaman</label>
		                  <div class="input-group margin-bottom-sm">
		                    <span class="input-group-addon">Rp</span>
		                    <input type="text" class="form-control" id="sisa_pinjaman" name="sisa_pinjaman" placeholder="Sisa Pinjaman">
		                  </div>
		                  <div id="label_sisa_pinjaman" class="alert-danger"></div> 
		                </div>
		                <div class="form-group col-xs-6">
		                  <label for="exampleInputPassword1">Total Angsuran Perbulan</label>
		                  <div class="input-group margin-bottom-sm">
		                    <span class="input-group-addon">Rp</span>
		                    <input type="text" class="form-control" id="total_angsuran_perbulan" name="total_angsuran_perbulan" placeholder="0">
		                  </div>
		                  <div id="label_total_angsuran_perbulan" class="alert-danger"></div> 
		                </div>
    				</div>
    			</div>
    		</div>
    	</div>
    </section>
</div>


<script>
	function formatRupiah(nilaiUang2){
		var nilaiUang=nilaiUang2+"";
		var nilaiRupiah   = "";
		var jumlahAngka   = nilaiUang.length;

		while(jumlahAngka > 3)
		{

			sisaNilai = jumlahAngka-3;
			nilaiRupiah = "."+nilaiUang.substr(sisaNilai,3)+""+nilaiRupiah;

			nilaiUang = nilaiUang.substr(0,sisaNilai)+"";
			jumlahAngka = nilaiUang.length;
		}

		nilaiRupiah = nilaiUang+""+nilaiRupiah+",00";
		return nilaiRupiah;
	}

	function label_sisa_pinjaman() {
		var sisa_pinjaman=$('#sisa_pinjaman').val();
		$("#label_sisa_pinjaman").html('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Rp&nbsp;&nbsp;&nbsp;&nbsp&nbsp;&nbsp;&nbsp;&nbsp'+formatRupiah(Math.floor(sisa_pinjaman)));
	}

	$(document).ready(function(){
		label_sisa_pinjaman();

		$('#sisa_pinjaman').keyup(function() {
			label_sisa_pinjaman();
        });
	});
</script>