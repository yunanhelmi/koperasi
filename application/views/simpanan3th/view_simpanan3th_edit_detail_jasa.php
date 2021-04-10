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
			Simpanan 3 Th
		</h1>
		<ol class="breadcrumb">
			<li><a href="<?php echo base_url(); ?>index.php/simpanan3thmastercon"><i class="fa fa-users"></i> Simpanan 3 Th</a></li>
      <li><a href="<?php echo base_url(); ?>index.php/simpanan3thmastercon/transaksi_simpanan3thmaster/<?php echo $simpanan3thmaster->id ?>"><i class="fa fa-credit-card"></i>Transaksi Simpanan 3 Th</a></li>
      <li class="active"><a href="<?php echo base_url(); ?>index.php/simpanan3thcon/view_simpanan3th/<?php echo $simpanan3th->id ?>"><i class="fa fa-eye"></i> Detail Simpanan 3 Th Anggota</a></li>
		</ol>
	</section>
	<section class="content">
		<div class="row">
			<div class="col-md-12 pull-left">
				<div class="box box-danger">
					<legend style="text-align:center;">VIEW SIMPANAN 3 TH</legend>
					<div class="box-body">
						<div class="form-group col-xs-6">
		                  	<label for="exampleInputEmail1">Nama Anggota</label>
		                  	<p><?php echo $simpanan3th->nama_nasabah;?></p>
		                </div>
		                <div class="form-group col-xs-6">
		                  	<label for="exampleInputEmail1">Nomor Anggota</label>
		                  	<p><?php echo $simpanan3th->nomor_nasabah;?></p>
		                </div>
		                <div class="form-group col-xs-6">
		                  	<label for="exampleInputEmail1">NIK Anggota</label>
		                  	<p><?php echo $simpanan3th->nik_nasabah;?></p>
		                </div>
		                <div class="form-group col-xs-6">
		                  	<label for="exampleInputEmail1">Nama Simpanan</label>
		                  	<p><?php echo $simpanan3th->nama_simpanan;?></p>
		                </div>
		                <div class="form-group col-xs-6">
							<label for="exampleInputPassword1">Tanggal</label>
							<?php 
								$date = strtotime( $simpanan3th->waktu );
								$mydate = date( 'd F Y', $date );
							?>
							<p><?php echo $mydate;?></p>
						</div>
						<div class="form-group col-xs-6">
                    		<label for="exampleInputPassword1">Total</label>
                    		<p><?php echo "Rp " . number_format($simpanan3th->total,2,',','.');?></p>
                		</div>
                		<div class="form-group col-xs-6">
			                <label for="exampleInputPassword1">Jasa Total</label>
			                <p><?php echo "Rp " . number_format($simpanan3th->jasa_total,2,',','.');?></p>
			            </div>
					</div>
				</div>
				<div class="box box-danger" id="div_tambah_detail_simpanan3th" style="display:none">
					<legend style="text-align:center;">TAMBAH DETAIL SIMPANAN 3 TH</legend>
					<form action="<?php echo base_url();?>index.php/simpanan3thcon/insert_detail_simpanan3th" method="post" enctype="multipart/form-data" role="form">
						<div class="box-body">
							<div class="form-group col-xs-6">
								<label for="exampleInputPassword1">Tanggal</label>
								<div class="input-group date">
									<div class="input-group-addon">
										<i class="fa fa-calendar"></i>
									</div>
									<input type="text" class="form-control pull-right" name="waktu" id="waktu" value="<?php echo date("d-m-Y");?>" data-date-format="dd-mm-yyyy">
                    				<input type="hidden" class="form-control" value="<?php echo $simpanan3th->id?>" id="id_simpanan3th" name="id_simpanan3th">
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
					<legend style="text-align:center;">DETAIL SIMPANAN 3 TH</legend>
					<div class="box-body">
						<div class="form-group col-xs-6">
			        		<button onclick="tambahDetailSimpanan3th()" type="submit" class="btn btn-success">Tambah Detail Simpanan 3 Th</button>
			            </div>
			            <div class="form-group col-xs-12">
			        		<br>
			            </div>
			            <table id="detail_simpanan3th_table" class="table table-bordered table-hover"  width="100%">
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
                            for($i = 0; $i < sizeof($detail_simpanan3th); $i++) {
                          ?>
                          <tr>
                            <td style='text-align: center'><?php echo $no."."?></td>
                            <?php 
                              $date = strtotime( $detail_simpanan3th[$i]['waktu'] );
                              $tanggal = date( 'd F Y', $date );
                              $bln_thn = strtotime( $detail_simpanan3th[$i]['bulan_tahun'] );
                      			$bulan_tahun = date( 'M-Y', $bln_thn );
                            ?>
                            <td><?php echo $tanggal;?></td>
                            <?php
                              if($detail_simpanan3th[$i]['jenis'] == 'Setoran') {
                                $total_debet += $detail_simpanan3th[$i]['jumlah'];
                            ?>
                            <td style='text-align: left'>Setoran Bulan <?php echo $bulan_tahun;?></td>
                            <td style='text-align: right'><?php echo "Rp " . number_format($detail_simpanan3th[$i]['jumlah'],2,',','.');?></td>
                            <td style='text-align: right'><?php echo "Rp " . number_format(0,2,',','.');?></td>
                            <?php
                              } else if($detail_simpanan3th[$i]['jenis'] == 'Tarikan') {
                                $total_kredit += $detail_simpanan3th[$i]['jumlah'];
                            ?>
                            <td style='text-align: left'>Tarikan</td>
                            <td style='text-align: right'><?php echo "Rp " . number_format(0,2,',','.');?></td>
                            <td style='text-align: right'><?php echo "Rp " . number_format($detail_simpanan3th[$i]['jumlah'],2,',','.');?></td>
                            <?php
                              }
                              $sisa_simpanan[$i] = $total_debet - $total_kredit;
                            ?>
                            <td style='text-align: right'><?php echo "Rp " . number_format($sisa_simpanan[$i],2,',','.');?></td>
                            
                          	<?php 
		                    if($detail_simpanan3th[$i]['status_post'] == 1) {
		                    ?>
		                    <td></td>
		                    <td></td>
		                    <td style='text-align: center'><a class="btn btn-primary" href="<?php echo site_url("simpanan3thcon/unpost_akuntansi/".$simpanan3th->id."/".$detail_simpanan3th[$i]['id']); ?>"><i class="fa fa-times"></i></a></td>
		                    <?php
		                    } else {
		                    ?>
		                    <td style='text-align: center'><a class="btn btn-warning" href="<?php echo site_url("transaksianggotacon/edit_detail_simpanan3th/".$simpanan3th->id."/".$detail_simpanan3th[$i]['id']); ?>"><i class="fa fa-pencil-square-o"></i></a></td>
                            <td style='text-align: center'><a class="btn btn-danger" onClick="getConfirmation('<?php echo $simpanan3th->id?>','<?php echo $detail_simpanan3th[$i]['id']?>');"><i class="fa fa-trash-o"></i></a></td>
		                    <td style='text-align: center'><a class="btn btn-primary" href="<?php echo site_url("simpanan3thcon/post_akuntansi/".$simpanan3th->id."/".$detail_simpanan3th[$i]['id']); ?>"><i class="fa fa-upload"></i></a></td>
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


				<div class="box box-danger" id="div_tambah_detail_jasa_simpanan3th" style="display:none">
		          <legend style="text-align:center;">TAMBAH DETAIL JASA SIMPANAN 3 TH</legend>
		          <form action="<?php echo base_url();?>index.php/simpanan3thcon/insert_detail_jasa_simpanan3th" method="post" enctype="multipart/form-data" role="form">
		            <div class="box-body">
		              <div class="form-group col-xs-6">
		                <label for="exampleInputPassword1">Tanggal</label>
		                <div class="input-group date">
		                  <div class="input-group-addon">
		                    <i class="fa fa-calendar"></i>
		                  </div>
		                  <input type="text" class="form-control pull-right" name="jasa_waktu" id="jasa_waktu" value="<?php echo date("d-m-Y");?>" data-date-format="dd-mm-yyyy">
		                  <input type="hidden" class="form-control" value="<?php echo $simpanan3th->id?>" id="jasa_id_simpanan3th" name="jasa_id_simpanan3th">
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
				<div class="box box-danger" id="div_edit_detail_simpanan3th">
					<legend style="text-align:center;">EDIT DETAIL JASA SIMPANAN 3 TH</legend>
					<form action="<?php echo base_url();?>index.php/simpanan3thcon/update_detail_jasa_simpanan3th" method="post" enctype="multipart/form-data" role="form">
						<div class="box-body">
							<div class="form-group col-xs-6">
								<label for="exampleInputPassword1">Tanggal</label>
								<div class="input-group date">
									<div class="input-group-addon">
										<i class="fa fa-calendar"></i>
									</div>
									<?php 
										$tgl = strtotime($edit_detail_jasa_simpanan3th->waktu);
									?>
									<input type="text" class="form-control pull-right" name="edit_jasa_waktu" id="edit_jasa_waktu" value="<?php echo date("d-m-Y", $tgl);?>" data-date-format="dd-mm-yyyy">
                    				<input type="hidden" class="form-control" value="<?php echo $edit_detail_jasa_simpanan3th->id?>" id="edit_jasa_id" name="edit_jasa_id">
                    				<input type="hidden" class="form-control" value="<?php echo $edit_detail_jasa_simpanan3th->id_simpanan3th?>" id="edit_jasa_id_simpanan3th" name="edit_jasa_id_simpanan3th">
								</div>
							</div>
							<div class="form-group col-xs-6">
	                          <label for="exampleInputPassword1">Jenis</label>
	                          <select id="edit_jasa_jenis" name="edit_jasa_jenis" class="form-control" style="width: 100%;">
	                            <option value='Penyesuaian Jasa' <?php echo $edit_detail_jasa_simpanan3th->jenis == 'Penyesuaian Jasa' ? 'selected' : ''?> >Penyesuaian Jasa</option>
	                            <option value='Pencairan Hutang Jasa' <?php echo $edit_detail_jasa_simpanan3th->jenis == 'Pencairan Hutang Jasa' ? 'selected' : ''?> >Pencairan Hutang Jasa</option>
	                            <option value='Pembayaran Biaya Jasa' <?php echo $edit_detail_jasa_simpanan3th->jenis == 'Pembayaran Biaya Jasa' ? 'selected' : ''?> >Pembayaran Biaya Jasa</option>
	                          </select>
	                        </div>
	                        <div class="form-group col-xs-6">
	                          <label for="exampleInputPassword1">Bulan-Tahun</label>
	                          <input type="month" class="form-control" value="<?php echo $edit_detail_jasa_simpanan3th->bulan_tahun?>" id="edit_jasa_bulan_tahun" name="edit_jasa_bulan_tahun" placeholder="">
	                        </div>
							<div class="form-group col-xs-6">
								<label for="exampleInputPassword1">Jumlah</label>
								<div class="input-group margin-bottom-sm">
									<span class="input-group-addon">Rp</span>
									<input type="text" class="form-control" value="<?php echo $edit_detail_jasa_simpanan3th->jumlah?>" id="edit_jasa_jumlah" name="edit_jasa_jumlah" placeholder="0">
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
		          <legend style="text-align:center;">DETAIL JASA SIMPANAN 3 TH</legend>
		          <div class="box-body">
		            <div class="form-group col-xs-6">
		                  <button onclick="tambahDetailJasaSimpanan3th()" type="submit" class="btn btn-success">Tambah Detail Jasa Simpanan 3 Th</button>
		                  </div>
		                  <div class="form-group col-xs-12">
		                  <br>
		                  </div>
		                  <table id="detail_jasa_simpanan3th_table" class="table table-bordered table-hover"  width="100%">
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
		                    for($i = 0; $i < sizeof($detail_jasa_simpanan3th); $i++) {
		                  ?>
		                  <tr>
		                    <td style='text-align: center'><?php echo $no."."?></td>
		                    <?php 
		                      $date = strtotime( $detail_jasa_simpanan3th[$i]['waktu'] );
		                      $tanggal = date( 'd F Y', $date );
		                      $bln_thn = strtotime( $detail_jasa_simpanan3th[$i]['bulan_tahun'] );
		                      $bulan_tahun = date( 'M-Y', $bln_thn );
		                    ?>
		                    <td><?php echo $tanggal;?></td>
		                    <?php
		                      if($detail_jasa_simpanan3th[$i]['jenis'] == 'Penyesuaian Jasa') {
		                        $total_debet += $detail_jasa_simpanan3th[$i]['jumlah'];
		                    ?>
		                    <td style='text-align: left'><?php echo $detail_jasa_simpanan3th[$i]['jenis']?> Bulan <?php echo $bulan_tahun;?></td>
		                    <td style='text-align: right'><?php echo "Rp " . number_format($detail_jasa_simpanan3th[$i]['jumlah'],2,',','.');?></td>
		                    <td style='text-align: right'><?php echo "Rp " . number_format(0,2,',','.');?></td>
		                    <?php
		                      } else {
		                        $total_kredit += $detail_jasa_simpanan3th[$i]['jumlah'];
		                    ?>
		                    <td style='text-align: left'><?php echo $detail_jasa_simpanan3th[$i]['jenis']?></td>
		                    <td style='text-align: right'><?php echo "Rp " . number_format(0,2,',','.');?></td>
		                    <td style='text-align: right'><?php echo "Rp " . number_format($detail_jasa_simpanan3th[$i]['jumlah'],2,',','.');?></td>
		                    <?php
		                      }
		                      $sisa_simpanan[$i] = $total_debet - $total_kredit;
		                    ?>
		                    <td style='text-align: right'><?php echo "Rp " . number_format($sisa_simpanan[$i],2,',','.');?></td>
		                    
		                    <?php 
		                    if($detail_jasa_simpanan3th[$i]['status_post'] == 1) {
		                    ?>
		                    <td></td>
		                    <td></td>
		                    <td style='text-align: center'><a class="btn btn-primary" href="<?php echo site_url("simpanan3thcon/jasa_simpanan3th_unpost_akuntansi/".$simpanan3th->id."/".$detail_jasa_simpanan3th[$i]['id']); ?>"><i class="fa fa-times"></i></a></td>
		                    <?php
		                    } else {
		                    ?>
		                    <td style='text-align: center'><a class="btn btn-warning" href="<?php echo site_url("simpanan3thcon/edit_detail_jasa_simpanan3th/".$simpanan3th->id."/".$detail_jasa_simpanan3th[$i]['id']); ?>"><i class="fa fa-pencil-square-o"></i></a></td>
		                    <td style='text-align: center'><a class="btn btn-danger" onClick="getConfirmationJasa('<?php echo $simpanan3th->id?>','<?php echo $detail_jasa_simpanan3th[$i]['id']?>');"><i class="fa fa-trash-o"></i></a></td>
		                    <td style='text-align: center'><a class="btn btn-primary" href="<?php echo site_url("simpanan3thcon/jasa_simpanan3th_post_akuntansi/".$simpanan3th->id."/".$detail_jasa_simpanan3th[$i]['id']); ?>"><i class="fa fa-upload"></i></a></td>
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
    #detail_simpanan3th_table td {
		text-align:center;
    }
    #detail_simpanan3th_table_filter {
		text-align:right;
    }

    #detail_jasa_simpanan3th_table td {
		text-align:center;
    }
    #detail_jasa_simpanan3th_table_filter {
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
    console.log(jumlah);
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

function getConfirmation(id_simpanan3th, id_detail_simpanan3th){
    var retVal = confirm("Apakah anda yakin akan menghapus data tersebut? Jika dihapus, maka total simpanan 3 th anggota yang bersangkutan akan disesuaikan.");
    var controller = 'simpanan3thcon';
    var base_url = '<?php echo site_url(); //you have to load the "url_helper" to use this function ?>';
    if( retVal == true ){
      window.location.href= base_url + '/'  + controller + '/delete_detail_simpanan3th/' + id_simpanan3th + '/' + id_detail_simpanan3th;
      //console.log(base_url + '/' + controller + '/delete_nasabah/' + id)
    }
}

function getConfirmationJasa(id_simpanan3th, id_detail_jasa_simpanan3th){
    var retVal = confirm("Apakah anda yakin akan menghapus data tersebut? Jika dihapus, maka jasa total simpanan 3 th anggota yang bersangkutan akan disesuaikan.");
    var controller = 'simpanan3thcon';
    var base_url = '<?php echo site_url(); //you have to load the "url_helper" to use this function ?>';
    if( retVal == true ){
      window.location.href= base_url + '/'  + controller + '/delete_detail_jasa_simpanan3th/' + id_simpanan3th + '/' + id_detail_jasa_simpanan3th;
    }
}

function tambahDetailSimpanan3th() {
	document.getElementById("div_edit_detail_simpanan3th").style.display = "none";
	document.getElementById("div_tambah_detail_simpanan3th").style.display = "block";
}

function tambahDetailJasaSimpanan3th() {
	document.getElementById("div_edit_detail_jasa_simpanan3th").style.display = "none";
	document.getElementById("div_tambah_detail_jasa_simpanan3th").style.display = "block";
}

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