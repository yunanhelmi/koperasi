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

				<div class="box box-danger" id="div_tambah_detail_jasa_simpananpihakketiga" style="display:none">
		          <legend style="text-align:center;">TAMBAH DETAIL JASA SIMPANAN PIHAK KETIGA</legend>
		          <form action="<?php echo base_url();?>index.php/transaksianggotacon/insert_detail_jasa_simpananpihakketiga" method="post" enctype="multipart/form-data" role="form">
		            <div class="box-body">
		              <div class="form-group col-xs-6">
		                <label for="exampleInputPassword1">Tanggal</label>
		                <div class="input-group date">
		                  <div class="input-group-addon">
		                    <i class="fa fa-calendar"></i>
		                  </div>
		                  <input type="text" class="form-control pull-right" name="jasa_waktu" id="jasa_waktu" value="<?php echo date("d-m-Y");?>" data-date-format="dd-mm-yyyy">
		                  <input type="hidden" class="form-control" value="<?php echo $simpananpihakketiga->id?>" id="jasa_id_simpananpihakketiga" name="jasa_id_simpananpihakketiga">
		                </div>
		              </div>
		              <div class="form-group col-xs-6">
		                <label for="exampleInputPassword1">Jenis</label>
		                <select id="jasa_jenis" name="jasa_jenis" class="form-control" style="width: 100%;">
		                  <option value='Penyesuaian Jasa'>Penyesuaian Jasa</option>
		                  <option value='Pencairan Hutang Jasa'>Pencairan Hutang Jasa</option>
		                  <option value='Pembayaran Biaya Jasa'>Pembayaran Biaya Jasa</option>
		                </select>
		              </div>
		              <div class="form-group col-xs-6">
		                <label for="exampleInputPassword1">Bulan-Tahun</label>
		                <input type="month" class="form-control" id="jasa_bulan_tahun" name="jasa_bulan_tahun" placeholder="">
		              </div>
		              <div class="form-group col-xs-6">
		                <label for="exampleInputPassword1">Jumlah</label>
		                <div class="input-group margin-bottom-sm">
		                  <span class="input-group-addon">Rp</span>
		                  <input type="text" class="form-control" value="" id="jasa_jumlah" name="jasa_jumlah" placeholder="0">
		                </div>
		                <div id="label_jasa_jumlah" class="alert-danger"></div>
		              </div>
		            </div>
		            <div class="box-footer">
		              <div class="col-xs-3">
		                <button type="submit" class="btn btn-primary">Simpan</button>
		              </div>
		            </div>
		          </form>
		        </div>

		        <div class="box box-danger" id="div_edit_detail_simpananpihakketiga">
					<legend style="text-align:center;">EDIT DETAIL JASA SIMPANAN PIHAK KETIGA</legend>
					<form action="<?php echo base_url();?>index.php/transaksianggotacon/update_detail_jasa_simpananpihakketiga" method="post" enctype="multipart/form-data" role="form">
						<div class="box-body">
							<div class="form-group col-xs-6">
								<label for="exampleInputPassword1">Tanggal</label>
								<div class="input-group date">
									<div class="input-group-addon">
										<i class="fa fa-calendar"></i>
									</div>
									<?php 
										$tgl = strtotime($edit_detail_jasa_simpananpihakketiga->waktu);
									?>
									<input type="text" class="form-control pull-right" name="edit_jasa_waktu" id="edit_jasa_waktu" value="<?php echo date("d-m-Y", $tgl);?>" data-date-format="dd-mm-yyyy">
                    				<input type="hidden" class="form-control" value="<?php echo $edit_detail_jasa_simpananpihakketiga->id?>" id="edit_jasa_id" name="edit_jasa_id">
                    				<input type="hidden" class="form-control" value="<?php echo $edit_detail_jasa_simpananpihakketiga->id_simpananpihakketiga?>" id="edit_jasa_id_simpananpihakketiga" name="edit_jasa_id_simpananpihakketiga">
								</div>
							</div>
							<div class="form-group col-xs-6">
	                          <label for="exampleInputPassword1">Jenis</label>
	                          <select id="edit_jasa_jenis" name="edit_jasa_jenis" class="form-control" style="width: 100%;">
	                            <option value='Penyesuaian Jasa' <?php echo $edit_detail_jasa_simpananpihakketiga->jenis == 'Penyesuaian Jasa' ? 'selected' : ''?> >Penyesuaian Jasa</option>
	                            <option value='Pencairan Hutang Jasa' <?php echo $edit_detail_jasa_simpananpihakketiga->jenis == 'Pencairan Hutang Jasa' ? 'selected' : ''?> >Pencairan Hutang Jasa</option>
	                            <option value='Pembayaran Biaya Jasa' <?php echo $edit_detail_jasa_simpananpihakketiga->jenis == 'Pembayaran Biaya Jasa' ? 'selected' : ''?> >Pembayaran Biaya Jasa</option>
	                          </select>
	                        </div>
	                        <div class="form-group col-xs-6">
	                          <label for="exampleInputPassword1">Bulan-Tahun</label>
	                          <input type="month" class="form-control" value="<?php echo $edit_detail_jasa_simpananpihakketiga->bulan_tahun?>" id="edit_jasa_bulan_tahun" name="edit_jasa_bulan_tahun" placeholder="">
	                        </div>
							<div class="form-group col-xs-6">
								<label for="exampleInputPassword1">Jumlah</label>
								<div class="input-group margin-bottom-sm">
									<span class="input-group-addon">Rp</span>
									<input type="text" class="form-control" value="<?php echo $edit_detail_jasa_simpananpihakketiga->jumlah?>" id="edit_jasa_jumlah" name="edit_jasa_jumlah" placeholder="0">
								</div>
								<div id="label_edit_jasa_jumlah" class="alert-danger"></div>
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

				<div class="box box-danger">
		          <legend style="text-align:center;">DETAIL JASA SIMPANAN PIHAK KETIGA</legend>
		          <div class="box-body">
		            <div class="form-group col-xs-6">
		                  <button onclick="tambahDetailJasaSimpananPihakKetiga()" type="submit" class="btn btn-success">Tambah Detail Jasa Simpanan Pihak Ketiga</button>
		                  </div>
		                  <div class="form-group col-xs-12">
		                  <br>
		                  </div>
		                  <table id="detail_jasa_simpananpihakketiga_table" class="table table-bordered table-hover"  width="100%">
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
		                    <th>Post</th>
		                  </tr>
		                </thead>
		                <tbody>
		                  <?php
		                    $no = 1;
		                    $total_debet = 0;
		                    $total_kredit = 0;
		                    $sisa_simpanan = array();
		                    for($i = 0; $i < sizeof($detail_jasa_simpananpihakketiga); $i++) {
		                  ?>
		                  <tr>
		                    <td style='text-align: center'><?php echo $no."."?></td>
		                    <?php 
		                      $date = strtotime( $detail_jasa_simpananpihakketiga[$i]['waktu'] );
		                      $tanggal = date( 'd F Y', $date );
		                      $bln_thn = strtotime( $detail_jasa_simpananpihakketiga[$i]['bulan_tahun'] );
		                      $bulan_tahun = date( 'M-Y', $bln_thn );
		                    ?>
		                    <td><?php echo $tanggal;?></td>
		                    <?php
		                      if($detail_jasa_simpananpihakketiga[$i]['jenis'] == 'Penyesuaian Jasa') {
		                        $total_debet += $detail_jasa_simpananpihakketiga[$i]['jumlah'];
		                    ?>
		                    <td style='text-align: left'><?php echo $detail_jasa_simpananpihakketiga[$i]['jenis']?> Bulan <?php echo $bulan_tahun;?></td>
		                    <td style='text-align: right'><?php echo "Rp " . number_format($detail_jasa_simpananpihakketiga[$i]['jumlah'],2,',','.');?></td>
		                    <td style='text-align: right'><?php echo "Rp " . number_format(0,2,',','.');?></td>
		                    <?php
		                      } else {
		                        $total_kredit += $detail_jasa_simpananpihakketiga[$i]['jumlah'];
		                    ?>
		                    <td style='text-align: left'><?php echo $detail_jasa_simpananpihakketiga[$i]['jenis']?></td>
		                    <td style='text-align: right'><?php echo "Rp " . number_format(0,2,',','.');?></td>
		                    <td style='text-align: right'><?php echo "Rp " . number_format($detail_jasa_simpananpihakketiga[$i]['jumlah'],2,',','.');?></td>
		                    <?php
		                      }
		                      $sisa_simpanan[$i] = $total_debet - $total_kredit;
		                    ?>
		                    <td style='text-align: right'><?php echo "Rp " . number_format($sisa_simpanan[$i],2,',','.');?></td>
		                    
		                    <?php 
		                    if($detail_jasa_simpananpihakketiga[$i]['status_post'] == 1) {
		                    ?>
		                    <td></td>
		                    <td></td>
		                    <td style='text-align: center'><a class="btn btn-primary" href="<?php echo site_url("transaksianggotacon/jasa_simpananpihakketiga_unpost_akuntansi/".$simpananpihakketiga->id."/".$detail_jasa_simpananpihakketiga[$i]['id']); ?>"><i class="fa fa-times"></i></a></td>
		                    <?php
		                    } else {
		                    ?>
		                    <td style='text-align: center'><a class="btn btn-warning" href="<?php echo site_url("transaksianggotacon/edit_detail_jasa_simpananpihakketiga/".$simpananpihakketiga->id."/".$detail_jasa_simpananpihakketiga[$i]['id']); ?>"><i class="fa fa-pencil-square-o"></i></a></td>
		                    <td style='text-align: center'><a class="btn btn-danger" onClick="getConfirmationJasa('<?php echo $simpananpihakketiga->id?>','<?php echo $detail_jasa_simpananpihakketiga[$i]['id']?>');"><i class="fa fa-trash-o"></i></a></td>
		                    <td style='text-align: center'><a class="btn btn-primary" href="<?php echo site_url("transaksianggotacon/jasa_simpananpihakketiga_post_akuntansi/".$simpananpihakketiga->id."/".$detail_jasa_simpananpihakketiga[$i]['id']); ?>"><i class="fa fa-upload"></i></a></td>
		                    <?php
		                    }
		                    ?>
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
    #detail_simpananpihakketiga_table td {
		text-align:center;
    }
    #detail_simpananpihakketiga_table_filter {
		text-align:right;
    }
    #detail_jasa_simpananpihakketiga_table td {
		text-align:center;
    }
    #detail_jasa_simpananpihakketiga_table_filter {
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

function label_jasa_jumlah() {
    var jasa_jumlah = $('#jasa_jumlah').val();
    $("#label_jasa_jumlah").html('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Rp&nbsp;&nbsp;&nbsp;&nbsp&nbsp;&nbsp;&nbsp;&nbsp'+formatRupiah(Math.floor(jasa_jumlah)));
}

function label_edit_jumlah() {
    var edit_jumlah = $('#edit_jumlah').val();
    $("#label_edit_jumlah").html('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Rp&nbsp;&nbsp;&nbsp;&nbsp&nbsp;&nbsp;&nbsp;&nbsp'+formatRupiah(Math.floor(edit_jumlah)));
}

function label_edit_jasa_jumlah() {
    var edit_jasa_jumlah = $('#edit_jasa_jumlah').val();
    $("#label_edit_jasa_jumlah").html('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Rp&nbsp;&nbsp;&nbsp;&nbsp&nbsp;&nbsp;&nbsp;&nbsp'+formatRupiah(Math.floor(edit_jasa_jumlah)));
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

function getConfirmationJasa(id_simpanan3th, id_detail_jasa_simpananpihakketiga){
    var retVal = confirm("Apakah anda yakin akan menghapus data tersebut? Jika dihapus, maka jasa total simpanan 3 th anggota yang bersangkutan akan disesuaikan.");
    var controller = 'transaksianggotacon';
    var base_url = '<?php echo site_url(); //you have to load the "url_helper" to use this function ?>';
    if( retVal == true ){
      window.location.href= base_url + controller + '/delete_detail_jasa_simpananpihakketiga/' + id_simpanan3th + '/' + id_detail_jasa_simpanan3th;
    }
}

function tambahDetailSimpananPihakKetiga() {
	document.getElementById("div_edit_detail_simpananpihakketiga").style.display = "none";
	document.getElementById("div_tambah_detail_simpananpihakketiga").style.display = "block";
}

function tambahDetailJasaSimpananPihakKetiga() {
	document.getElementById("div_edit_detail_jasa_simpananpihakketiga").style.display = "none";
	document.getElementById("div_tambah_detail_jasa_simpananpihakketiga").style.display = "block";
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
    $('#edit_waktu').datepicker({}).on('changeDate', function(ev){});

    $('#jasa_waktu').datepicker({}).on('changeDate', function(ev){});
    $('#edit_jasa_waktu').datepicker({}).on('changeDate', function(ev){});

    label_jumlah();
    label_edit_jumlah();

    label_jasa_jumlah();
    label_edit_jasa_jumlah();

    $('#jumlah').keyup(function() {
        label_jumlah();
    });

    $('#edit_jumlah').keyup(function() {
        label_edit_jumlah();
    });

    $('#jasa_jumlah').keyup(function() {
        label_jasa_jumlah();
    });

    $('#edit_jasa_jumlah').keyup(function() {
        label_edit_jasa_jumlah();
    });
});
</script>