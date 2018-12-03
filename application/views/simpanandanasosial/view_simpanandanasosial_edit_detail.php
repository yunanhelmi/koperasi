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
			Simpanan Dana Sosial
		</h1>
		<ol class="breadcrumb">
			<li><a href="<?php echo base_url(); ?>index.php/simpanandanasosialcon"><i class="fa fa-users"></i> Simpanan Dana Sosial</a></li>
			<li class="active"><a href="<?php echo base_url(); ?>index.php/simpanandanasosialcon/create_simpanandanasosial"><i class="fa fa-table"></i>Simpanan Dana Sosial</a></li>
		</ol>
	</section>
	<section class="content">
		<div class="row">
			<div class="col-md-12 pull-left">
				<div class="box box-danger">
					<legend style="text-align:center;">VIEW SIMPANAN DANA SOSIAL</legend>
					<div class="box-body">
						<div class="form-group col-xs-6">
		                  	<label for="exampleInputEmail1">Nama Anggota</label>
		                  	<p><?php echo $simpanandanasosial->nama_nasabah;?></p>
		                </div>
		                <div class="form-group col-xs-6">
		                  	<label for="exampleInputEmail1">Nomor Anggota</label>
		                  	<p><?php echo $simpanandanasosial->nomor_nasabah;?></p>
		                </div>
		                <div class="form-group col-xs-6">
		                  	<label for="exampleInputEmail1">NIK Anggota</label>
		                  	<p><?php echo $simpanandanasosial->nik_nasabah;?></p>
		                </div>
		                <div class="form-group col-xs-6">
							<label for="exampleInputPassword1">Tanggal</label>
							<?php 
								$date = strtotime( $simpanandanasosial->waktu );
								$mydate = date( 'd F Y', $date );
							?>
							<p><?php echo $mydate;?></p>
						</div>
						<div class="form-group col-xs-6">
                    		<label for="exampleInputPassword1">Total</label>
                    		<p><?php echo "Rp " . number_format($simpanandanasosial->total,2,',','.');?></p>
                		</div>
					</div>
				</div>
				<div class="box box-danger" id="div_tambah_detail_simpanandanasosial" style="display:none">
					<legend style="text-align:center;">TAMBAH DETAIL SIMPANAN DANA SOSIAL</legend>
					<form action="<?php echo base_url();?>index.php/simpanandanasosialcon/insert_detail_simpanandanasosial" method="post" enctype="multipart/form-data" role="form">
						<div class="box-body">
							<div class="form-group col-xs-6">
								<label for="exampleInputPassword1">Tanggal</label>
								<div class="input-group date">
									<div class="input-group-addon">
										<i class="fa fa-calendar"></i>
									</div>
									<input type="text" class="form-control pull-right" name="waktu" id="waktu" value="<?php echo date("d-m-Y");?>" data-date-format="dd-mm-yyyy">
                    				<input type="hidden" class="form-control" value="<?php echo $simpanandanasosial->id?>" id="id_simpanandanasosial" name="id_simpanandanasosial">
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
				<div class="box box-danger" id="div_edit_detail_simpanandanasosial">
					<legend style="text-align:center;">EDIT DETAIL SIMPANAN DANA SOSIAL</legend>
					<form action="<?php echo base_url();?>index.php/simpanandanasosialcon/update_detail_simpanandanasosial" method="post" enctype="multipart/form-data" role="form">
						<div class="box-body">
							<div class="form-group col-xs-6">
								<label for="exampleInputPassword1">Tanggal</label>
								<div class="input-group date">
									<div class="input-group-addon">
										<i class="fa fa-calendar"></i>
									</div>
									<?php 
										$tgl = strtotime($edit_detail_simpanandanasosial->waktu);
									?>
									<input type="text" class="form-control pull-right" name="edit_waktu" id="edit_waktu" value="<?php echo date("d-m-Y", $tgl);?>" data-date-format="dd-mm-yyyy">
                    				<input type="hidden" class="form-control" value="<?php echo $edit_detail_simpanandanasosial->id?>" id="edit_id" name="edit_id">
                    				<input type="hidden" class="form-control" value="<?php echo $edit_detail_simpanandanasosial->id_simpanandanasosial?>" id="edit_id_simpanandanasosial" name="edit_id_simpanandanasosial">
								</div>
							</div>
							<div class="form-group col-xs-6">
	                          <label for="exampleInputPassword1">Jenis</label>
	                          <select id="edit_jenis" name="edit_jenis" class="form-control" style="width: 100%;">
	                            <option value='Setoran' <?php echo $edit_detail_simpanandanasosial->jenis == 'Setoran' ? 'selected' : ''?> >Setoran</option>
	                            <option value='Tarikan' <?php echo $edit_detail_simpanandanasosial->jenis == 'Tarikan' ? 'selected' : ''?> >Tarikan</option>
	                          </select>
	                        </div>
							<div class="form-group col-xs-6">
								<label for="exampleInputPassword1">Jumlah</label>
								<div class="input-group margin-bottom-sm">
									<span class="input-group-addon">Rp</span>
									<input type="text" class="form-control" value="<?php echo $edit_detail_simpanandanasosial->jumlah?>" id="edit_jumlah" name="edit_jumlah" placeholder="0">
								</div>
								<div id="label_edit_jumlah" class="alert-danger"></div>
							</div>
						</div>
						<div class="box-footer">
							<div class="col-xs-3">
								<button type="submit" class="btn btn-primary">Update</button>
							</div>
						</div>
					</form>
				</div>
				<div class="box box-danger">
					<legend style="text-align:center;">DETAIL SIMPANAN DANA SOSIAL</legend>
					<div class="box-body">
						<div class="form-group col-xs-6">
			        		<button onclick="tambahDetailSimpananDanaSosial()" type="submit" class="btn btn-success">Tambah Detail Simpanan Dana Sosial</button>
			            </div>
			            <div class="form-group col-xs-12">
			        		<br>
			            </div>
			            <table id="detail_simpanandanasosial_table" class="table table-bordered table-hover"  width="100%">
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
                            for($i = 0; $i < sizeof($detail_simpanandanasosial); $i++) {
                          ?>
                          <tr>
                            <td style='text-align: center'><?php echo $no."."?></td>
                            <?php 
                              $date = strtotime( $detail_simpanandanasosial[$i]['waktu'] );
                              $tanggal = date( 'd F Y', $date );
                            ?>
                            <td><?php echo $tanggal;?></td>
                            <?php
                              if($detail_simpanandanasosial[$i]['jenis'] == 'Setoran') {
                                $total_debet += $detail_simpanandanasosial[$i]['jumlah'];
                            ?>
                            <td style='text-align: left'>Setoran</td>
                            <td style='text-align: right'><?php echo "Rp " . number_format($detail_simpanandanasosial[$i]['jumlah'],2,',','.');?></td>
                            <td style='text-align: right'><?php echo "Rp " . number_format(0,2,',','.');?></td>
                            <?php
                              } else if($detail_simpanandanasosial[$i]['jenis'] == 'Tarikan') {
                                $total_kredit += $detail_simpanandanasosial[$i]['jumlah'];
                            ?>
                            <td style='text-align: left'>Tarikan</td>
                            <td style='text-align: right'><?php echo "Rp " . number_format(0,2,',','.');?></td>
                            <td style='text-align: right'><?php echo "Rp " . number_format($detail_simpanandanasosial[$i]['jumlah'],2,',','.');?></td>
                            <?php
                              }
                              $sisa_simpanan[$i] = $total_debet - $total_kredit;
                            ?>
                            <td style='text-align: right'><?php echo "Rp " . number_format($sisa_simpanan[$i],2,',','.');?></td>
                            <td style='text-align: center'><a class="btn btn-warning" href="<?php echo site_url("transaksianggotacon/edit_detail_simpanandanasosial/".$simpanandanasosial->id."/".$detail_simpanandanasosial[$i]['id']); ?>"><i class="fa fa-pencil-square-o"></i></a></td>
                            <td style='text-align: center'><a class="btn btn-danger" onClick="getConfirmation('<?php echo $simpanandanasosial->id?>','<?php echo $detail_simpanandanasosial[$i]['id']?>');"><i class="fa fa-trash-o"></i></a></td>
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
    #detail_simpanandanasosial_table td {
		text-align:center;
    }
    #detail_simpanandanasosial_table_filter {
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

function label_edit_jumlah() {
    var edit_jumlah = $('#edit_jumlah').val();
    $("#label_edit_jumlah").html('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Rp&nbsp;&nbsp;&nbsp;&nbsp&nbsp;&nbsp;&nbsp;&nbsp'+formatRupiah(Math.floor(edit_jumlah)));
}

function getConfirmation(id_simpanandanasosial, id_detail_simpanandanasosial){
    var retVal = confirm("Apakah anda yakin akan menghapus data tersebut? Jika dihapus, maka total simpanan dana sosial anggota yang bersangkutan akan disesuaikan.");
    var controller = 'simpanandanasosialcon';
    var base_url = '<?php echo site_url(); //you have to load the "url_helper" to use this function ?>';
    if( retVal == true ){
      window.location.href= base_url + controller + '/delete_detail_simpanandanasosial/' + id_simpanandanasosial + '/' + id_detail_simpanandanasosial;
      //console.log(base_url + '/' + controller + '/delete_nasabah/' + id)
    }
}

function tambahDetailSimpananDanaSosial() {
	document.getElementById("div_edit_detail_simpanandanasosial").style.display = "none";
	document.getElementById("div_tambah_detail_simpanandanasosial").style.display = "block";
}

$(function () {
    $('#detail_simpanandanasosial_table').DataTable({
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
    $('#edit_waktu').datepicker({}).on('changeDate', function(ev){});

    label_jumlah();
    label_edit_jumlah();

    $('#jumlah').keyup(function() {
        label_jumlah();
    });

    $('#edit_jumlah').keyup(function() {
        label_edit_jumlah();
    });
});
</script>