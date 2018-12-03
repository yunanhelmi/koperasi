<script src="<?php echo base_url(); ?>assets/js/jquery-1.11.3.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/js/highcharts.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/js/exporting.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/js/data.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/js/canvas-tools.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/js/export-csv.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/bower_components/select2/dist/js/select2.full.min.js"></script>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/bower_components/select2/dist/css/select2.min.css">

<div class="content-wrapper">
	<section class="content-header">
		<h1>
			Simpanan Pihak Ketiga
		</h1>
		<ol class="breadcrumb">
			<li><a href="<?php echo base_url(); ?>index.php/simpananpihakketigacon"><i class="fa fa-users"></i> Simpanan Pihak Ketiga</a></li>
			<li class="active"><a href="<?php echo base_url(); ?>index.php/simpananpihakketigacon/create_simpananpihakketiga"><i class="fa fa-table"></i>Simpanan Pihak Ketiga</a></li>
		</ol>
	</section>
	<section class="content">
		<div class="row">
			<div class="col-md-12 pull-left">
				<div class="box box-danger">
					<legend style="text-align:center;">VIEW SIMPANAN PIHAK KETIGA</legend>
					<div class="box-body">
						<div class="form-group col-xs-6">
		                  	<label for="exampleInputEmail1">Nama</label>
		                  	<p><?php echo $simpananpihakketiga->nama;?></p>
		                </div>
		                <div class="form-group col-xs-6">
		                  	<label for="exampleInputEmail1">NIK</label>
		                  	<p><?php echo $simpananpihakketiga->nik;?></p>
		                </div>
		                <div class="form-group col-xs-6">
		                  	<label for="exampleInputEmail1">No. HP / Telepon</label>
		                  	<p><?php echo $simpananpihakketiga->telpon;?></p>
		                </div>
		                <div class="form-group col-xs-6">
		                  	<label for="exampleInputEmail1">Pekerjaan</label>
		                  	<p><?php echo $simpananpihakketiga->pekerjaan;?></p>
		                </div>
		                <div class="form-group col-xs-6">
		                  	<label for="exampleInputEmail1">Alamat</label>
		                  	<p><?php echo $simpananpihakketiga->alamat;?></p>
		                </div>
		                <div class="form-group col-xs-6">
		                  	<label for="exampleInputEmail1">Kota/Kab</label>
		                  	<p><?php echo $simpananpihakketiga->kota;?></p>
		                </div>
		                <div class="form-group col-xs-6">
		                  	<label for="exampleInputEmail1">Kecamatan</label>
		                  	<p><?php echo $simpananpihakketiga->kecamatan;?></p>
		                </div>
		                <div class="form-group col-xs-6">
		                  	<label for="exampleInputEmail1">Kelurahan</label>
		                  	<p><?php echo $simpananpihakketiga->kelurahan;?></p>
		                </div>
		                <div class="form-group col-xs-6">
		                  	<label for="exampleInputEmail1">Dusun</label>
		                  	<p><?php echo $simpananpihakketiga->dusun;?></p>
		                </div>
		                <div class="form-group col-xs-6">
		                  	<label for="exampleInputEmail1">RW</label>
		                  	<p><?php echo $simpananpihakketiga->rw;?></p>
		                </div>
		                <div class="form-group col-xs-6">
		                  	<label for="exampleInputEmail1">RT</label>
		                  	<p><?php echo $simpananpihakketiga->rt;?></p>
		                </div>
		                <div class="form-group col-xs-6">
							<label for="exampleInputPassword1">Tanggal</label>
							<?php 
								$date = strtotime( $simpananpihakketiga->waktu );
								$mydate = date( 'd F Y', $date );
							?>
							<p><?php echo $mydate;?></p>
						</div>
						<div class="form-group col-xs-6">
                    		<label for="exampleInputPassword1">Total</label>
                    		<p><?php echo "Rp " . number_format($simpananpihakketiga->total,2,',','.');?></p>
                		</div>
					</div>
				</div>
				<div class="box box-danger" id="div_tambah_detail_simpananpihakketiga" style="display:none">
					<legend style="text-align:center;">TAMBAH DETAIL SIMPANAN PIHAK KETIGA</legend>
					<form action="<?php echo base_url();?>index.php/simpananpihakketigacon/insert_detail_simpananpihakketiga" method="post" enctype="multipart/form-data" role="form">
						<div class="box-body">
							<div class="form-group col-xs-6">
								<label for="exampleInputPassword1">Tanggal</label>
								<div class="input-group date">
									<div class="input-group-addon">
										<i class="fa fa-calendar"></i>
									</div>
									<input type="text" class="form-control pull-right" name="waktu" id="waktu" value="<?php echo date("d-m-Y");?>" data-date-format="dd-mm-yyyy">
                    				<input type="hidden" class="form-control" value="<?php echo $simpananpihakketiga->id?>" id="id_simpananpihakketiga" name="id_simpananpihakketiga">
								</div>
							</div>
							<div class="form-group col-xs-6">
								<label for="exampleInputPassword1">Jumlah</label>
								<div class="input-group margin-bottom-sm">
									<span class="input-group-addon">Rp</span>
									<input type="text" class="form-control" value="" id="jumlah" name="jumlah" placeholder="0">
								</div>
								<div id="label_jumlah" class="alert-danger"></div>
							</div>
						</div>
						<div class="box-footer">
							<div class="col-xs-3">
								<button type="submit" class="btn btn-primary">Simpan</button>
							</div>
						</div>
					</form>
				</div>
				<div class="box box-danger">
					<legend style="text-align:center;">DETAIL SIMPANAN PIHAK KETIGA</legend>
					<div class="box-body">
						<div class="form-group col-xs-6">
			        		<button onclick="tambahDetailSimpananPihakKetiga()" type="submit" class="btn btn-success">Tambah Detail Simpanan Pihak Ketiga</button>
			            </div>
			            <div class="form-group col-xs-12">
			        		<br>
			            </div>
			            <table id="detail_simpananpihakketiga_table" class="table table-bordered table-hover"  width="100%">
			            	<thead>
                				<tr>
				                    <th>No.</th>
				                    <th>Tanggal</th>
				                    <th>Jumlah</th>
				                    <th>Edit</th>
				                    <th>Delete</th>
                    			</tr>
                			</thead>
                			<tbody>
                    			<?php
				                    $no = 1;
				                    for($i = 0; $i < sizeof($detail_simpananpihakketiga); $i++) {
                  				?>
                    			<tr>
				                    <td style='text-align: center'><?php echo $no."."?></td>
				                    <?php 
										$date = strtotime( $detail_simpananpihakketiga[$i]['waktu'] );
										$tanggal = date( 'd F Y', $date );
									?>
				                    <td><?php echo $tanggal;?></td>
				                    <td><?php echo "Rp " . number_format($detail_simpananpihakketiga[$i]['jumlah'],2,',','.');?></td>
				                    <td style='text-align: center'><a class="btn btn-warning" href="<?php echo site_url("simpananpihakketigacon/edit_detail_simpananpihakketiga/".$simpananpihakketiga->id."/".$detail_simpananpihakketiga[$i]['id']); ?>"><i class="fa fa-pencil-square-o"></i></a></td>
				                    <td style='text-align: center'><a class="btn btn-danger" onClick="getConfirmation('<?php echo $simpananpihakketiga->id?>','<?php echo $detail_simpananpihakketiga[$i]['id']?>');"><i class="fa fa-trash-o"></i></a></td>
                    			</tr>
                  				<?php $no++;}?>
                			</tbody>
			            </table>
					</div>
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
    #detail_simpananpihakketiga_table td {
		text-align:center;
    }
    #detail_simpananpihakketiga_table_filter {
		text-align:right;
    }
</style>

<script>
function formatRupiah(nilaiUang2) {
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

function label_jumlah() {
    var jumlah = $('#jumlah').val();
    $("#label_jumlah").html('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Rp&nbsp;&nbsp;&nbsp;&nbsp&nbsp;&nbsp;&nbsp;&nbsp'+formatRupiah(Math.floor(jumlah)));
}

function getConfirmation(id_simpananpihakketiga, id_detail_simpananpihakketiga){
    var retVal = confirm("Apakah anda yakin akan menghapus data tersebut? Jika dihapus, maka total simpanan pihak ketiga yang bersangkutan akan disesuaikan.");
    var controller = 'simpananpihakketigacon';
    var base_url = '<?php echo site_url(); //you have to load the "url_helper" to use this function ?>';
    if( retVal == true ){
      window.location.href= base_url + controller + '/delete_detail_simpananpihakketiga/' + id_simpananpihakketiga + '/' + id_detail_simpananpihakketiga;
      //console.log(base_url + '/' + controller + '/delete_nasabah/' + id)
    }
}

function tambahDetailSimpananPihakKetiga() {
	document.getElementById("div_tambah_detail_simpananpihakketiga").style.display = "block";
}

$(function () {
    $('#detail_simpananpihakketiga_table').DataTable({
      'paging'      : true,
      'lengthChange': true,
      'searching'   : true,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : true
    })
})

$(document).ready(function(){
	$('.select2').select2();

    $('#waktu').datepicker({}).on('changeDate', function(ev){});

    label_jumlah();

    $('#jumlah').keyup(function() {
        label_jumlah();
    });
});
</script>

