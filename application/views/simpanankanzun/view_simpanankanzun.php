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
			Simpanan Kanzun
		</h1>
		<ol class="breadcrumb">
			<li><a href="<?php echo base_url(); ?>index.php/simpanankanzuncon"><i class="fa fa-users"></i> Simpanan Kanzun</a></li>
			<li class="active"><a href="<?php echo base_url(); ?>index.php/simpanankanzuncon/create_simpanankanzun"><i class="fa fa-table"></i>Simpanan Kanzun</a></li>
		</ol>
	</section>
	<section class="content">
		<div class="row">
			<div class="col-md-12 pull-left">
				<div class="box box-danger">
					<legend style="text-align:center;">VIEW SIMPANAN KANZUN</legend>
					<div class="box-body">
						<div class="form-group col-xs-6">
		                  	<label for="exampleInputEmail1">Nama Anggota</label>
		                  	<p><?php echo $simpanankanzun->nama_nasabah;?></p>
		                </div>
		                <div class="form-group col-xs-6">
		                  	<label for="exampleInputEmail1">Nomor Anggota</label>
		                  	<p><?php echo $simpanankanzun->nomor_nasabah;?></p>
		                </div>
		                <div class="form-group col-xs-6">
		                  	<label for="exampleInputEmail1">NIK Anggota</label>
		                  	<p><?php echo $simpanankanzun->nik_nasabah;?></p>
		                </div>
		                <div class="form-group col-xs-6">
							<label for="exampleInputPassword1">Tanggal</label>
							<?php 
								$date = strtotime( $simpanankanzun->waktu );
								$mydate = date( 'd F Y', $date );
							?>
							<p><?php echo $mydate;?></p>
						</div>
						<div class="form-group col-xs-6">
                    		<label for="exampleInputPassword1">Total</label>
                    		<p><?php echo "Rp " . number_format($simpanankanzun->total,2,',','.');?></p>
                		</div>
					</div>
				</div>
				<div class="box box-danger" id="div_tambah_detail_simpanankanzun" style="display:none">
					<legend style="text-align:center;">TAMBAH DETAIL SIMPANAN KANZUN</legend>
					<form action="<?php echo base_url();?>index.php/simpanankanzuncon/insert_detail_simpanankanzun" method="post" enctype="multipart/form-data" role="form">
						<div class="box-body">
							<div class="form-group col-xs-6">
								<label for="exampleInputPassword1">Tanggal</label>
								<div class="input-group date">
									<div class="input-group-addon">
										<i class="fa fa-calendar"></i>
									</div>
									<input type="text" class="form-control pull-right" name="waktu" id="waktu" value="<?php echo date("d-m-Y");?>" data-date-format="dd-mm-yyyy">
                    				<input type="hidden" class="form-control" value="<?php echo $simpanankanzun->id?>" id="id_simpanankanzun" name="id_simpanankanzun">
								</div>
							</div>
							<div class="form-group col-xs-6">
	                          <label for="exampleInputPassword1">Jenis</label>
	                          <select id="jenis" name="jenis" class="form-control" style="width: 100%;">
	                            <option value='Setoran'>Setoran</option>
	                            <option value='Tarikan'>Tarikan</option>
	                          </select>
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
					<legend style="text-align:center;">DETAIL SIMPANAN KANZUN</legend>
					<div class="box-body">
						<div class="form-group col-xs-6">
			        		<button onclick="tambahDetailSimpananKanzun()" type="submit" class="btn btn-success">Tambah Detail Simpanan Kanzun</button>
			            </div>
			            <div class="form-group col-xs-12">
			        		<br>
			            </div>
			            <table id="detail_simpanankanzun_table" class="table table-bordered table-hover"  width="100%">
                        <thead>
                          <tr>
                            <th>No.</th>
                            <th>Tanggal</th>
                            <th>Keterangan</th>
                            <th>Debet</th>
                            <th>Kredit</th>
                            <th>Saldo</th>
                            <th>Edit</th>
                            <th>Delete</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                            $no = 1;
                            $total_debet = 0;
                            $total_kredit = 0;
                            $sisa_simpanan = array();
                            for($i = 0; $i < sizeof($detail_simpanankanzun); $i++) {
                          ?>
                          <tr>
                            <td style='text-align: center'><?php echo $no."."?></td>
                            <?php 
                              $date = strtotime( $detail_simpanankanzun[$i]['waktu'] );
                              $tanggal = date( 'd F Y', $date );
                            ?>
                            <td><?php echo $tanggal;?></td>
                            <?php
                              if($detail_simpanankanzun[$i]['jenis'] == 'Setoran') {
                                $total_debet += $detail_simpanankanzun[$i]['jumlah'];
                            ?>
                            <td style='text-align: left'>Setoran</td>
                            <td style='text-align: right'><?php echo "Rp " . number_format($detail_simpanankanzun[$i]['jumlah'],2,',','.');?></td>
                            <td style='text-align: right'><?php echo "Rp " . number_format(0,2,',','.');?></td>
                            <?php
                              } else if($detail_simpanankanzun[$i]['jenis'] == 'Tarikan') {
                                $total_kredit += $detail_simpanankanzun[$i]['jumlah'];
                            ?>
                            <td style='text-align: left'>Tarikan</td>
                            <td style='text-align: right'><?php echo "Rp " . number_format(0,2,',','.');?></td>
                            <td style='text-align: right'><?php echo "Rp " . number_format($detail_simpanankanzun[$i]['jumlah'],2,',','.');?></td>
                            <?php
                              }
                              $sisa_simpanan[$i] = $total_debet - $total_kredit;
                            ?>
                            <td style='text-align: right'><?php echo "Rp " . number_format($sisa_simpanan[$i],2,',','.');?></td>
                            <td style='text-align: center'><a class="btn btn-warning" href="<?php echo site_url("transaksianggotacon/edit_detail_simpanankanzun/".$simpanankanzun->id."/".$detail_simpanankanzun[$i]['id']); ?>"><i class="fa fa-pencil-square-o"></i></a></td>
                            <td style='text-align: center'><a class="btn btn-danger" onClick="getConfirmation('<?php echo $simpanankanzun->id?>','<?php echo $detail_simpanankanzun[$i]['id']?>');"><i class="fa fa-trash-o"></i></a></td>
                          </tr>
                          <?php $no++;}?>
                          <tr>
                            <td colspan='3'><strong>TOTAL</strong></td>
                            <td style='text-align: right'><strong><?php echo "Rp " . number_format($total_debet,2,',','.');?></strong></td>
                            <td style='text-align: right'><strong><?php echo "Rp " . number_format($total_kredit,2,',','.');?></strong></td>
                          </tr>
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
    #detail_simpanankanzun_table td {
		text-align:center;
    }
    #detail_simpanankanzun_table_filter {
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

function getConfirmation(id_simpanankanzun, id_detail_simpanankanzun){
    var retVal = confirm("Apakah anda yakin akan menghapus data tersebut? Jika dihapus, maka total simpanan kanzun anggota yang bersangkutan akan disesuaikan.");
    var controller = 'simpanankanzuncon';
    var base_url = '<?php echo site_url(); //you have to load the "url_helper" to use this function ?>';
    if( retVal == true ){
      window.location.href= base_url + controller + '/delete_detail_simpanankanzun/' + id_simpanankanzun + '/' + id_detail_simpanankanzun;
      //console.log(base_url + '/' + controller + '/delete_nasabah/' + id)
    }
}

function tambahDetailSimpananKanzun() {
	document.getElementById("div_tambah_detail_simpanankanzun").style.display = "block";
}

$(function () {
    $('#detail_simpanankanzun_table').DataTable({
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

