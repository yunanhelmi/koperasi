<script src="<?php echo base_url(); ?>assets/js/jquery-1.11.3.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/js/highcharts.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/js/exporting.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/js/data.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/js/canvas-tools.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/js/export-csv.js" type="text/javascript"></script>
<?php

function rupiah($angka){
  $hasil_rupiah = "Rp " . number_format($angka,2,',','.');
  return $hasil_rupiah;
}

?>
<!-- Content Wrapper. Contains page content -->
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        &nbsp;
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>index.php/transaksianggotacon"><i class="fa fa-users"></i> Transaksi Anggota</a></li>
        <li><a href="<?php echo base_url()."index.php/transaksianggotacon/pinjaman/".$nasabah->id; ?>" ><i class="fa fa-credit-card"></i> Pinjaman</a></li>
        <li class="active"><i class="fa fa-user"></i> Edit</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="row">
        <div class="col-md-3">

          <!-- Profile Image -->
          <div class="box box-danger">
            <div class="box-body box-profile">
              <?php
              if($nasabah->file_foto != null || $nasabah->file_foto != "") {
                $path = explode("./", $nasabah->file_foto );
              } else {
                $path[1] = '';
              }
                
              ?>
              <img class="profile-user-img img-responsive img-circle"style="width:200px;height:200px;" src=<?php echo base_url().$path[1]; ?> alt="User profile picture">

              <h3 class="profile-username text-center"><?php echo $nasabah->nama; ?></h3>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
          <div class="nav-tabs-custom">
            <div class="box box-danger">
            <legend style="text-align:center;">DATA ANGGOTA</legend>
              <div class="box-body">
                <form class="form-horizontal">
                  <div class="form-group">
                    <label for="inputName" class="col-sm-3 control-label">Nama</label>
                    <div class="col-sm-9">
                      <?php echo '<input type="text" class="form-control" name="nama" id="nama"   readonly value="'.$nasabah->nama.'">'; ?>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputName" class="col-sm-3 control-label">Nomor Nasabah</label>
                    <div class="col-sm-9">
                      <?php echo '<input type="text" class="form-control" name="nomor_nasabah" id="nomor_nasabah"   readonly value="'.$nasabah->nomor_koperasi.'">'; ?>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputEmail" class="col-sm-3 control-label">NIK</label>
                    <div class="col-sm-9">
                      <?php echo '<input type="text" class="form-control" name="nik" id="nik" readonly value="'.$nasabah->nik.'">'; ?>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputEmail" class="col-sm-3 control-label">No. HP / Telepon</label>
                    <div class="col-sm-9">
                      <?php echo '<input type="text" class="form-control" name="telpon" id="telpon" readonly value="'.$nasabah->telpon.'">'; ?>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputEmail" class="col-sm-3 control-label">Pekerjaan</label>
                    <div class="col-sm-9">
                      <?php echo '<input type="text" class="form-control" name="pekerjaan" id="pekerjaan" readonly value="'.$nasabah->pekerjaan.'">'; ?>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputName" class="col-sm-3 control-label">Alamat</label>
                    <div class="col-sm-9">
                      <?php echo '<input type="textarea" class="form-control" name="alamat" id="alamat" readonly value="'.$nasabah->alamat.'">'; ?>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputExperience" class="col-sm-3 control-label">Kota/Kab</label>
                    <div class="col-sm-9">
                      <?php echo '<input type="text" class="form-control" name="kota" id="kota" readonly value="'.$nasabah->kota.'">'; ?>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputSkills" class="col-sm-3 control-label">Kecamatan</label>
                    <div class="col-sm-9">
                      <?php echo '<input type="text" class="form-control" name="kecamatan" id="kecamatan" readonly value="'.$nasabah->kecamatan.'">'; ?>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputSkills" class="col-sm-3 control-label">Kelurahan/Desa</label>
                    <div class="col-sm-9">
                      <?php echo '<input type="text" class="form-control" name="kelurahan" id="kelurahan" readonly value="'.$nasabah->kelurahan.'">'; ?>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputSkills" class="col-sm-3 control-label">Dusun</label>
                    <div class="col-sm-9">
                      <?php echo '<input type="text" class="form-control" name="dusun" id="dusun" readonly value="'.$nasabah->dusun.'">'; ?>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputSkills" class="col-sm-3 control-label">RW</label>
                    <div class="col-sm-9">
                      <?php echo '<input type="text" class="form-control" name="rw" id="rw" readonly value="'.$nasabah->rw.'">'; ?>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputSkills" class="col-sm-3 control-label">RT</label>
                    <div class="col-sm-9">
                      <?php echo '<input type="text" class="form-control" name="rt" id="rt" readonly value="'.$nasabah->rt.'">'; ?>
                    </div>
                  </div>
                </form>
              </div>
              <!-- /.box-body -->
          </div>
          <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
      <div class="col-md-12">
        <div class="nav-tabs-custom">
          <ul class="nav nav-tabs">
            <li class="active"><a href="#pinjaman" data-toggle="tab">Pinjaman</a></li>
            <?php
              if(substr($nasabah->nomor_koperasi, 0, 1) == "1") {
            ?>
            <li><a href="#simpanan_pokok" data-toggle="tab">Simpanan Pokok</a></li>
            <?php
              } else if(substr($nasabah->nomor_koperasi, 0, 1) == "2") {
            ?>
            <li><a href="#simpanan_pokok" data-toggle="tab">Simpanan Pokok Istimewa</a></li>
            <?php
              }
            ?>       
            <li><a href="#simpanan_wajib" data-toggle="tab">Simpanan Wajib</a></li>
            <li><a href="#simpanan_khusus" data-toggle="tab">Simpanan Khusus</a></li>
            <?php
              if(substr($nasabah->nomor_koperasi, 0, 1) == "1") {
            ?>
            <li><a href="#simpanan_dana_sosial" data-toggle="tab">Simpanan Dansos Anggota</a></li>
            <?php
              } else if(substr($nasabah->nomor_koperasi, 0, 1) == "2") {
            ?>
            <li><a href="#simpanan_dana_sosial" data-toggle="tab">Simpanan Dansos Anggota Istimewa</a></li>
            <?php
              }
            ?>
            <li><a href="#simpanan_kanzun" data-toggle="tab">Simpanan Kanzun</a></li>
            <!--<li><a href="#simpanan_3th" data-toggle="tab">Simpanan 3 Th</a></li>-->
            <li><a href="#simpanan_pihak_ketiga" data-toggle="tab">Simpanan Pihak Ketiga</a></li>
            <li><a href="#aset_kekayaan" data-toggle="tab">Aset Kekayaan</a></li>
            <li><a href="#berkas" data-toggle="tab">Scan Berkas</a></li>
          </ul>
          <div class="tab-content">
            <div class="active tab-pane" id="pinjaman">

              
              <legend style="text-align:center;">EDIT PINJAMAN</legend>
              <form action="<?php echo base_url()."index.php/transaksianggotacon/update_pinjaman";?>" method="post" enctype="multipart/form-data" role="form">
                <div class="box-body">
                  <div class="form-group col-xs-6">
                    <label for="exampleInputEmail1">Nama Anggota</label>
                    <input type="text" class="form-control" id="nama_nasabah" name="nama_nasabah" placeholder="Nama Nasabah" value="<?php echo $pinjaman->nama_nasabah;?>" readonly>
                    <input type="hidden" class="form-control" id="id_pinjaman" name="id_pinjaman" value="<?php echo $pinjaman->id?>">
                    <input type="hidden" class="form-control" id="id_nasabah" name="id_nasabah" value="<?php echo $pinjaman->id_nasabah;?>">
                  </div>
                  <div class="form-group col-xs-6">
                    <label for="exampleInputPassword1">Nomor Anggota</label>
                    <input type="text" class="form-control" id="nomor_nasabah" name="nomor_nasabah" placeholder="Nomor Anggota" value="<?php echo $pinjaman->nomor_nasabah;?>" readonly>
                  </div>
                  <div class="form-group col-xs-6">
                    <label for="exampleInputPassword1">NIK</label>
                    <input type="text" class="form-control" id="nik_nasabah" name="nik_nasabah" placeholder="NIK Anggota" value="<?php echo $pinjaman->nik_nasabah;?>" readonly>
                  </div>
                  <div class="form-group col-xs-6">
                    <label for="exampleInputPassword1">Jenis Pinjaman</label>
                    <select id="jenis_pinjaman" name="jenis_pinjaman" class="form-control" style="width: 100%;">
                      <option value='Musiman' <?php echo $pinjaman->jenis_pinjaman == 'Musiman' ? 'selected' : ''?> >Musiman</option>
                    <option value='Angsuran' <?php echo $pinjaman->jenis_pinjaman == 'Angsuran' ? 'selected' : ''?> >Angsuran</option>
                    </select>
                  </div>
                  <!-- <div class="form-group col-xs-6">
                    <label for="exampleInputPassword1">Jaminan</label>
                    <input type="text" class="form-control" id="jaminan" name="jaminan" value="<?php echo $pinjaman->jaminan?>" placeholder="Jaminan">
                  </div> -->
                  <div class="form-group col-xs-6">
                    <label for="exampleInputPassword1">Jaminan</label>
                    <select id="jaminan" name="jaminan[]" class="form-control select2" multiple="multiple" data-placeholder="Pilih Jaminan"
                        style="width: 100%;" required="">
                      <?php 
                        for($i = 0; $i < sizeof($aset_kekayaan); $i++) {
                          if($aset_kekayaan[$i]['jenis_aset'] == 'sertifikat') {
                      ?>
                            <option value="<?php echo $aset_kekayaan[$i]['id']?>" <?php echo $aset_kekayaan[$i]['selected'] == 1 ? 'selected':'' ?>><?php echo $aset_kekayaan[$i]['jenis_aset']." ".$aset_kekayaan[$i]['nama_pemilik']." ".$aset_kekayaan[$i]['no_sertifikat']." ".$aset_kekayaan[$i]['jenis_tanah']." ".$aset_kekayaan[$i]['luas']." ".$aset_kekayaan[$i]['lokasi_tanah'] ?></option>
                      <?php
                          } else if($aset_kekayaan[$i]['jenis_aset'] == 'bpkb') {
                      ?>
                            <option value="<?php echo $aset_kekayaan[$i]['id']?>" <?php echo $aset_kekayaan[$i]['selected'] == 1 ? 'selected':'' ?>><?php echo $aset_kekayaan[$i]['jenis_aset']." ".$aset_kekayaan[$i]['merek']." ".$aset_kekayaan[$i]['jenis_motor']." ".$aset_kekayaan[$i]['tahun']." ".$aset_kekayaan[$i]['atas_nama']." ".$aset_kekayaan[$i]['no_pol']?></option>
                      <?php
                          }
                        }
                      ?>
                    </select>
                  </div>
                  <div class="form-group col-xs-6">
                    <label for="exampleInputPassword1">Tanggal Pinjaman</label>
                    <div class="input-group date">
                      <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                      </div>
                      <?php $date = strtotime($pinjaman->waktu);?>
                      <input type="text" class="form-control pull-right" name="waktu" id="waktu" value="<?php echo date("d-m-Y",$date);?>" data-date-format="dd-mm-yyyy">
                    </div>
                  </div>
                  <div class="form-group col-xs-6">
                    <label for="exampleInputPassword1">Jatuh Tempo</label>
                    <?php $jatuh_tempo = strtotime($pinjaman->jatuh_tempo)?>
                    <input type="text" class="form-control" value="<?php echo date("d-m-Y",$jatuh_tempo);?>" id="jatuh_tempo" name="jatuh_tempo" placeholder="Jatuh Tempo">
                  </div>
                  <div class="form-group col-xs-6">
                    <label for="exampleInputPassword1">Jumlah Pinjaman</label>
                    <div class="input-group margin-bottom-sm">
                      <span class="input-group-addon">Rp</span>
                      <input type="text" class="form-control" value="<?php echo $pinjaman->jumlah_pinjaman?>" id="jumlah_pinjaman" name="jumlah_pinjaman" placeholder="Jumlah Pinjaman">
                    </div>
                    <div id="label_jumlah_pinjaman" class="alert-danger"></div> 
                  </div>
                  <div class="form-group col-xs-6">
                    <label for="exampleInputPassword1">Jumlah Angsuran</label>
                    <input type="text" class="form-control" value="<?php echo $pinjaman->jumlah_angsuran?>" id="jumlah_angsuran" name="jumlah_angsuran" placeholder="Jumlah Angsuran">
                  </div>
                  <div class="form-group col-xs-6">
                    <label for="exampleInputPassword1">Angsuran Perbulan</label>
                    <div class="input-group margin-bottom-sm">
                      <span class="input-group-addon">Rp</span>
                      <input type="text" class="form-control" value="<?php echo $pinjaman->angsuran_perbulan?>" id="angsuran_perbulan" name="angsuran_perbulan" placeholder="0">
                    </div>
                    <div id="label_angsuran_perbulan" class="alert-danger"></div> 
                  </div>
                  <div class="form-group col-xs-6">
                    <label for="exampleInputPassword1">Jasa Perbulan</label>
                    <div class="input-group margin-bottom-sm">
                      <span class="input-group-addon">Rp</span>
                      <input type="text" class="form-control" value="<?php echo $pinjaman->jasa_perbulan?>" id="jasa_perbulan" name="jasa_perbulan" placeholder="0">
                    </div>
                    <div id="label_jasa_perbulan" class="alert-danger"></div> 
                  </div>
                  <div class="form-group col-xs-6">
                    <label for="exampleInputPassword1">Total Angsuran Perbulan</label>
                    <div class="input-group margin-bottom-sm">
                      <span class="input-group-addon">Rp</span>
                      <input type="text" class="form-control" value="<?php echo $pinjaman->total_angsuran_perbulan?>" id="total_angsuran_perbulan" name="total_angsuran_perbulan" placeholder="0">
                    </div>
                    <div id="label_total_angsuran_perbulan" class="alert-danger"></div> 
                  </div>
                  <div class="form-group col-xs-6">
                    <label for="exampleInputPassword1">Keterangan</label>
                    <!-- <input type="text" class="form-control" id="keterangan" name="keterangan" placeholder="Keterangan" value="<?php echo $pinjaman->keterangan?>"> -->
                    <textarea class="form-control" id="keterangan" name="keterangan" placeholder="Keterangan"><?php echo $pinjaman->keterangan?></textarea>
                  </div>
                  <div class="form-group col-xs-6">
                    <label for="exampleInputPassword1">Uang Kurang</label>
                    <div class="input-group margin-bottom-sm">
                      <span class="input-group-addon">Rp</span>
                      <input type="text" class="form-control" value="<?php echo $pinjaman->uang_kurang?>" id="uang_kurang" name="uang_kurang" placeholder="0">
                    </div>
                    <div id="label_uang_kurang" class="alert-danger"></div> 
                  </div>
                  <div class="form-group col-xs-6">
                    <label for="exampleInputPassword1">Janji</label>
                    <input type="text" class="form-control" id="janji" name="janji" placeholder="" value="<?php echo $pinjaman->janji?>">
                  </div>
                  <div class="form-group col-xs-6">
                    <label for="exampleInputPassword1">Status Pinjaman</label>
                    <select id="status_pinjaman" name="status_pinjaman" class="form-control" style="width: 100%;">
                      <option value='Baru' <?php echo $pinjaman->status_pinjaman == 'Baru' ? 'selected' : ''?> >Baru</option>
                    <option value='Perpanjangan' <?php echo $pinjaman->status_pinjaman == 'Perpanjangan' ? 'selected' : ''?> >Perpanjangan</option>
                    </select>
                  </div>
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                  <div class="col-xs-3">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                  </div>
                  <div class="col-xs-3">
                    <a class="btn btn-primary btn-warning" href="<?php echo site_url("transaksianggotacon/pinjaman/".$nasabah->id); ?>">Batal</a>
                  </div>
                </div>
              </form>


            </div>
            <div class="tab-pane" id="simpanan_pokok">
              <div class="box-header" style="text-align:left" >
                <h3>
                  <?php
                    if(substr($nasabah->nomor_koperasi, 0, 1) == "1") {
                  ?>
                  <a class="btn btn-primary btn-success" href="<?php echo site_url("transaksianggotacon/create_simpananpokok/".$nasabah->id); ?>">Tambahkan Simpanan Pokok Baru</a>
                  <?php
                    } else if(substr($nasabah->nomor_koperasi, 0, 1) == "2") {
                  ?>
                  <a class="btn btn-primary btn-success" href="<?php echo site_url("transaksianggotacon/create_simpananpokok/".$nasabah->id); ?>">Tambahkan Simpanan Pokok Istimewa Baru</a>
                  <?php
                    }
                  ?>     
                </h3>
              </div> 
              <div class="box-body">
                <table id="simpananpokok_table" class="table table-bordered table-hover"  width="100%">
                  <thead>
                    <tr>
                      <th>No.</th>
                      <th>Nama</th>
                      <th>Nomor Anggota</th>
                      <th>NIK</th>
                      <th>Tanggal</th>
                      <th>Jumlah</th>
                      <th>View</th>
                      <th>Edit</th>
                      <th>Delete</th>
                      <th>Post</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      $no = 1;
                      $total_simpananpokok = 0;
                      for($i = 0; $i < sizeof($simpananpokok); $i++) {
                    ?>
                    <tr>
                      <td style='text-align: center'><?php echo $no."."?></td>
                      <td><?php echo $simpananpokok[$i]['nama_nasabah']?></td>
                      <td><?php echo $simpananpokok[$i]['nomor_nasabah']?></td>
                      <td><?php echo $simpananpokok[$i]['nik_nasabah']?></td>
                      <?php $date = strtotime($simpananpokok[$i]['waktu']);?>
                      <td><?php echo date("d-m-Y",$date)?></td>
                      <td><?php echo rupiah($simpananpokok[$i]['jumlah'])?></td>
                      <td style='text-align: center'><a class="btn btn-primary" href="<?php echo site_url("transaksianggotacon/view_simpananpokok/".$simpananpokok[$i]['id']); ?>"><i class="fa fa-eye"></i></a></td>
                      <?php 
                      if($simpananpokok[$i]['jenis'] == 'Setoran') {
                        $total_simpananpokok += $simpananpokok[$i]['jumlah'];
                      } else if($simpananpokok[$i]['jenis'] == 'Tarikan') {
                        $total_simpananpokok -= $simpananpokok[$i]['jumlah'];
                      }
                      if($simpananpokok[$i]['status_post'] == 1) {
                      ?>
                      <td></td>
                      <td></td>
                      <td style='text-align: center'><a class="btn btn-primary" href="<?php echo site_url("transaksianggotacon/simpananpokok_unpost_akuntansi/".$simpananpokok[$i]['id']); ?>"><i class="fa fa-times"></i></a></td>
                      <?php
                      } else {
                      ?>
                      <td style='text-align: center'><a class="btn btn-warning" href="<?php echo site_url("transaksianggotacon/edit_simpananpokok/".$simpananpokok[$i]['id']); ?>"><i class="fa fa-pencil-square-o"></i></a></td>
                      <td style='text-align: center'><a class="btn btn-danger" onClick="getConfirmationSimpananpokok('<?php echo $simpananpokok[$i]['id']?>');"><i class="fa fa-trash-o"></i></a></td>
                      <td style='text-align: center'><a class="btn btn-primary" href="<?php echo site_url("transaksianggotacon/simpananpokok_post_akuntansi/".$simpananpokok[$i]['id']); ?>"><i class="fa fa-upload"></i></a></td>
                      <?php
                      }
                      ?>
                    </tr>
                    <?php $no++;}?>
                    <tr>
                      <td colspan="6"><strong>Total</strong></td>
                      <td><strong><?php echo rupiah($total_simpananpokok)?></strong></td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
            <div class="tab-pane" id="simpanan_wajib">
              <div class="box-header" style="text-align:left" >
                <h3>
                  <a class="btn btn-primary btn-success" href="<?php echo site_url("transaksianggotacon/create_simpananwajib/".$nasabah->id); ?>">Tambahkan Simpanan Wajib Baru</a>
                </h3>
              </div> 
              <div class="box-body">
                <table id="simpananwajib_table" class="table table-bordered table-hover"  width="100%">
                  <thead>
                    <tr>
                      <th>No.</th>
                      <th>Nama</th>
                      <th>Nomor Anggota</th>
                      <th>NIK</th>
                      <th>Tanggal</th>
                      <th>Jumlah</th>
                      <th>View</th>
                      <th>Edit</th>
                      <th>Delete</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      $no = 1;
                      $total_simpananwajib = 0;
                      for($i = 0; $i < sizeof($simpananwajib); $i++) {
                    ?>
                    <tr>
                      <td style='text-align: center'><?php echo $no."."?></td>
                      <td><?php echo $simpananwajib[$i]['nama_nasabah']?></td>
                      <td><?php echo $simpananwajib[$i]['nomor_nasabah']?></td>
                      <td><?php echo $simpananwajib[$i]['nik_nasabah']?></td>
                      <?php $date = strtotime($simpananwajib[$i]['waktu']);?>
                      <td><?php echo date("d-m-Y",$date)?></td>
                      <td><?php echo rupiah($simpananwajib[$i]['total'])?></td>
                      <td style='text-align: center'><a class="btn btn-primary" href="<?php echo site_url("transaksianggotacon/view_simpananpokok/".$simpananwajib[$i]['id']); ?>"><i class="fa fa-eye"></i></a></td>
                      <td style='text-align: center'><a class="btn btn-warning" href="<?php echo site_url("transaksianggotacon/edit_simpananpokok/".$simpananwajib[$i]['id']); ?>"><i class="fa fa-pencil-square-o"></i></a></td>
                      <td style='text-align: center'><a class="btn btn-danger" onClick="getConfirmationSimpananwajib('<?php echo $simpananwajib[$i]['id']?>');"><i class="fa fa-trash-o"></i></a></td>
                    </tr>
                    <?php 
                        $no++;
                        $total_simpananwajib += $simpananwajib[$i]['total'];
                      }
                    ?>
                    <tr>
                      <td colspan="5"><strong>Total</strong></td>
                      <td><strong><?php echo rupiah($total_simpananwajib)?></strong></td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
            <div class="tab-pane" id="simpanan_khusus">
              <div class="box-header" style="text-align:left" >
                <h3>
                  <a class="btn btn-primary btn-success" href="<?php echo site_url("transaksianggotacon/create_simpanankhusus/".$nasabah->id); ?>">Tambahkan Simpanan Khusus Baru</a>
                </h3>
              </div> 
              <div class="box-body">
                <table id="simpanankhusus_table" class="table table-bordered table-hover"  width="100%">
                  <thead>
                    <tr>
                      <th>No.</th>
                      <th>Nama</th>
                      <th>Nomor Anggota</th>
                      <th>NIK</th>
                      <th>Tanggal</th>
                      <th>Jumlah</th>
                      <th>View</th>
                      <th>Edit</th>
                      <th>Delete</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      $no = 1;
                      $total_simpanankhusus = 0;
                      for($i = 0; $i < sizeof($simpanankhusus); $i++) {
                    ?>
                    <tr>
                      <td style='text-align: center'><?php echo $no."."?></td>
                      <td><?php echo $simpanankhusus[$i]['nama_nasabah']?></td>
                      <td><?php echo $simpanankhusus[$i]['nomor_nasabah']?></td>
                      <td><?php echo $simpanankhusus[$i]['nik_nasabah']?></td>
                      <?php $date = strtotime($simpanankhusus[$i]['waktu']);?>
                      <td><?php echo date("d-m-Y",$date)?></td>
                      <td><?php echo rupiah($simpanankhusus[$i]['total'])?></td>
                      <td style='text-align: center'><a class="btn btn-primary" href="<?php echo site_url("transaksianggotacon/view_simpananpokok/".$simpanankhusus[$i]['id']); ?>"><i class="fa fa-eye"></i></a></td>
                      <td style='text-align: center'><a class="btn btn-warning" href="<?php echo site_url("transaksianggotacon/edit_simpananpokok/".$simpanankhusus[$i]['id']); ?>"><i class="fa fa-pencil-square-o"></i></a></td>
                      <td style='text-align: center'><a class="btn btn-danger" onClick="getConfirmationSimpanankhusus('<?php echo $simpanankhusus[$i]['id']?>');"><i class="fa fa-trash-o"></i></a></td>
                    </tr>
                    <?php 
                        $no++;
                        $total_simpanankhusus += $simpanankhusus[$i]['total'];
                      }
                    ?>
                    <tr>
                      <td colspan="5"><strong>Total</strong></td>
                      <td><strong><?php echo rupiah($total_simpanankhusus)?></strong></td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
            <div class="tab-pane" id="simpanan_dana_sosial">
              <div class="box-header" style="text-align:left" >
                <h3>
                  <a class="btn btn-primary btn-success" href="<?php echo site_url("transaksianggotacon/create_simpanandanasosial/".$nasabah->id); ?>">Tambahkan Simpanan Dansos Anggota Baru</a>
                </h3>
              </div> 
              <div class="box-body">
                <table id="simpanandanasosial_table" class="table table-bordered table-hover"  width="100%">
                  <thead>
                    <tr>
                      <th>No.</th>
                      <th>Nama</th>
                      <th>Nomor Anggota</th>
                      <th>NIK</th>
                      <th>Tanggal</th>
                      <th>Jumlah</th>
                      <th>View</th>
                      <th>Edit</th>
                      <th>Delete</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      $no = 1;
                      $total_simpanandanasosial = 0;
                      for($i = 0; $i < sizeof($simpanandanasosial); $i++) {
                    ?>
                    <tr>
                      <td style='text-align: center'><?php echo $no."."?></td>
                      <td><?php echo $simpanandanasosial[$i]['nama_nasabah']?></td>
                      <td><?php echo $simpanandanasosial[$i]['nomor_nasabah']?></td>
                      <td><?php echo $simpanandanasosial[$i]['nik_nasabah']?></td>
                      <?php $date = strtotime($simpanandanasosial[$i]['waktu']);?>
                      <td><?php echo date("d-m-Y",$date)?></td>
                      <td><?php echo rupiah($simpanandanasosial[$i]['total'])?></td>
                      <td style='text-align: center'><a class="btn btn-primary" href="<?php echo site_url("transaksianggotacon/view_simpanandanasosial/".$simpanandanasosial[$i]['id']); ?>"><i class="fa fa-eye"></i></a></td>
                      <td style='text-align: center'><a class="btn btn-warning" href="<?php echo site_url("transaksianggotacon/edit_simpanandanasosial/".$simpanandanasosial[$i]['id']); ?>"><i class="fa fa-pencil-square-o"></i></a></td>
                      <td style='text-align: center'><a class="btn btn-danger" onClick="getConfirmationSimpanandanasosial('<?php echo $simpanandanasosial[$i]['id']?>');"><i class="fa fa-trash-o"></i></a></td>
                    </tr>
                    <?php 
                        $no++;
                        $total_simpanandanasosial += $simpanandanasosial[$i]['total']; 
                      }
                    ?>
                    <tr>
                      <td colspan="5"><strong>Total</strong></td>
                      <td><strong><?php echo rupiah($total_simpanandanasosial)?></strong></td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
            <div class="tab-pane" id="simpanan_kanzun">
              <div class="box-header" style="text-align:left" >
                <h3>
                  <a class="btn btn-primary btn-success" href="<?php echo site_url("transaksianggotacon/create_simpanankanzun/".$nasabah->id); ?>">Tambahkan Simpanan Kanzun Baru</a>
                </h3>
              </div> 
              <div class="box-body">
                <table id="simpanankanzun_table" class="table table-bordered table-hover"  width="100%">
                  <thead>
                    <tr>
                      <th>No.</th>
                      <th>Nama</th>
                      <th>Nomor Anggota</th>
                      <th>NIK</th>
                      <th>Tanggal</th>
                      <th>Jumlah</th>
                      <th>View</th>
                      <th>Edit</th>
                      <th>Delete</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      $no = 1;
                      $total_simpanankanzun = 0;
                      for($i = 0; $i < sizeof($simpanankanzun); $i++) {
                    ?>
                    <tr>
                      <td style='text-align: center'><?php echo $no."."?></td>
                      <td><?php echo $simpanankanzun[$i]['nama_nasabah']?></td>
                      <td><?php echo $simpanankanzun[$i]['nomor_nasabah']?></td>
                      <td><?php echo $simpanankanzun[$i]['nik_nasabah']?></td>
                      <?php $date = strtotime($simpanankanzun[$i]['waktu']);?>
                      <td><?php echo date("d-m-Y",$date)?></td>
                      <td><?php echo rupiah($simpanankanzun[$i]['total'])?></td>
                      <td style='text-align: center'><a class="btn btn-primary" href="<?php echo site_url("transaksianggotacon/view_simpanankanzun/".$simpanankanzun[$i]['id']); ?>"><i class="fa fa-eye"></i></a></td>
                      <td style='text-align: center'><a class="btn btn-warning" href="<?php echo site_url("transaksianggotacon/edit_simpanankanzun/".$simpanankanzun[$i]['id']); ?>"><i class="fa fa-pencil-square-o"></i></a></td>
                      <td style='text-align: center'><a class="btn btn-danger" onClick="getConfirmationSimpanankanzun('<?php echo $simpanankanzun[$i]['id']?>');"><i class="fa fa-trash-o"></i></a></td>
                    </tr>
                    <?php 
                        $no++;
                        $total_simpanankanzun += $simpanankanzun[$i]['total'];
                      }
                    ?>
                    <tr>
                      <td colspan="5"><strong>Total</strong></td>
                      <td><strong><?php echo rupiah($total_simpanankanzun)?></strong></td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
            <div class="tab-pane" id="simpanan_3th">
              
              <div class="box-header" style="text-align:left" >
                <h3>
                  <a class="btn btn-primary btn-success" href="<?php echo site_url("transaksianggotacon/create_simpanan3th/".$nasabah->id); ?>">Tambahkan Simpanan 3 Th Baru</a>
                </h3>
              </div> 
              <div class="box-body">
                <table id="simpanan3th_table" class="table table-bordered table-hover"  width="100%">
                  <thead>
                    <tr>
                      <th>No.</th>
                      <th>Nama</th>
                      <th>Nomor Anggota</th>
                      <th>NIK</th>
                      <th>Tanggal</th>
                      <th>Jumlah</th>
                      <th>View</th>
                      <th>Edit</th>
                      <th>Delete</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      $no = 1;
                      for($i = 0; $i < sizeof($simpanan3th); $i++) {
                    ?>
                    <tr>
                      <td style='text-align: center'><?php echo $no."."?></td>
                      <td><?php echo $simpanan3th[$i]['nama_nasabah']?></td>
                      <td><?php echo $simpanan3th[$i]['nomor_nasabah']?></td>
                      <td><?php echo $simpanan3th[$i]['nik_nasabah']?></td>
                      <?php $date = strtotime($simpanan3th[$i]['waktu']);?>
                      <td><?php echo date("d-m-Y",$date)?></td>
                      <td><?php echo rupiah($simpanan3th[$i]['total'])?></td>
                      <td style='text-align: center'><a class="btn btn-primary" href="<?php echo site_url("transaksianggotacon/view_simpanan3th/".$simpanan3th[$i]['id']); ?>"><i class="fa fa-eye"></i></a></td>
                      <td style='text-align: center'><a class="btn btn-warning" href="<?php echo site_url("transaksianggotacon/edit_simpanan3th/".$simpanan3th[$i]['id']); ?>"><i class="fa fa-pencil-square-o"></i></a></td>
                      <td style='text-align: center'><a class="btn btn-danger" onClick="getConfirmationSimpanan3th('<?php echo $simpanan3th[$i]['id']?>');"><i class="fa fa-trash-o"></i></a></td>
                    </tr>
                    <?php $no++;}?>
                  </tbody>
                </table>
              </div>

            </div>


            <div class="tab-pane" id="simpanan_pihak_ketiga">
              <div class="box-header" style="text-align:left" >
                <h3>
                  <a class="btn btn-primary btn-success" href="<?php echo site_url("transaksianggotacon/create_simpananpihakketiga/".$nasabah->id); ?>">Tambahkan Simpanan Pihak Ketiga Baru</a>
                </h3>
              </div> 
              <div class="box-body">
                <table id="simpananpihakketiga_table" class="table table-bordered table-hover"  width="100%">
                  <thead>
                    <tr>
                      <th>No.</th>
                      <th>Nama</th>
                      <th>Nomor Anggota</th>
                      <th>NIK</th>
                      <th>Tanggal</th>
                      <th>Jumlah</th>
                      <th>View</th>
                      <th>Edit</th>
                      <th>Delete</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      $no = 1;
                      $total_simpananpihakketiga = 0;
                      for($i = 0; $i < sizeof($simpananpihakketiga); $i++) {
                    ?>
                    <tr>
                      <td style='text-align: center'><?php echo $no."."?></td>
                      <td><?php echo $simpananpihakketiga[$i]['nama']?></td>
                      <td><?php echo $simpananpihakketiga[$i]['nomor_nasabah']?></td>
                      <td><?php echo $simpananpihakketiga[$i]['nik']?></td>
                      <?php $date = strtotime($simpananpihakketiga[$i]['waktu']);?>
                      <td><?php echo date("d-m-Y",$date)?></td>
                      <td><?php echo rupiah($simpananpihakketiga[$i]['total'])?></td>
                      <td style='text-align: center'><a class="btn btn-primary" href="<?php echo site_url("transaksianggotacon/view_simpananpihakketiga/".$simpananpihakketiga[$i]['id']); ?>"><i class="fa fa-eye"></i></a></td>
                      <td style='text-align: center'><a class="btn btn-warning" href="<?php echo site_url("transaksianggotacon/edit_simpananpihakketiga/".$simpananpihakketiga[$i]['id']); ?>"><i class="fa fa-pencil-square-o"></i></a></td>
                      <td style='text-align: center'><a class="btn btn-danger" onClick="getConfirmationSimpananpihakketiga('<?php echo $simpananpihakketiga[$i]['id']?>');"><i class="fa fa-trash-o"></i></a></td>
                    </tr>
                    <?php 
                        $no++;
                        $total_simpananpihakketiga += $simpananpihakketiga[$i]['total'];
                      }
                    ?>
                    <tr>
                      <td colspan="5"><strong>Total</strong></td>
                      <td><strong><?php echo rupiah($total_simpananpihakketiga) ?></strong></td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>

            <div class="tab-pane" id="aset_kekayaan">
              <div class="box-header" style="text-align:left" >
                <h3>
                  <a class="btn btn-primary btn-success" href="<?php echo site_url("transaksianggotacon/create_aset_kekayaan/".$nasabah->id); ?>">Tambahkan Aset Kekayaan</a>
                </h3>
              </div> 
              <div class="box-body">
                <table id="aset_kekayaan_table" class="table table-bordered table-hover"  width="100%">
                  <thead>
                    <tr>
                      <th>No.</th>
                      <th>Jenis Aset</th>
                      <th>Keterangan</th>
                      <th>Link Gambar</th>
                      <th>Edit</th>
                      <th>Delete</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      if($aset_kekayaan != NULL){
                        $no = 1;
                        for($i = 0; $i < sizeof($aset_kekayaan); $i++) {
                    ?>
                        <tr>
                          <td><?php echo $no ?></td>
                          <td><?php echo strtoupper($aset_kekayaan[$i]['jenis_aset']) ?></td>
                    <?php
                          if($aset_kekayaan[$i]['jenis_aset'] == 'sertifikat') {
                    ?> 
                            <td style="word-wrap: break-word; text-align: left;"><?php echo strtoupper($aset_kekayaan[$i]['jenis_aset']).'. Nama Pemilik: '.$aset_kekayaan[$i]['nama_pemilik'].' No. Sertifikat: '.$aset_kekayaan[$i]['no_sertifikat'].' Luas(m2): '.$aset_kekayaan[$i]['luas'].' Jenis Tanah: '.$aset_kekayaan[$i]['jenis_tanah'].' Lokasi Tanah: '.$aset_kekayaan[$i]['lokasi_tanah'] ?></td>
                    <?php
                          } else if($aset_kekayaan[$i]['jenis_aset'] == 'bpkb') {
                    ?>
                            <td style="word-wrap: break-word; text-align: left;"><?php echo strtoupper($aset_kekayaan[$i]['jenis_aset']).'. Atas Nama: '.$aset_kekayaan[$i]['atas_nama'].' No. Polisi: '.$aset_kekayaan[$i]['no_pol'].' Merek: '.$aset_kekayaan[$i]['merek'].' Jenis: '.$aset_kekayaan[$i]['jenis_motor'].' Tahun: '.$aset_kekayaan[$i]['tahun'] ?></td>
                    <?php
                          }
                    ?>
                          <td style='text-align: center'><a href="<?php echo base_url(); ?>files/uploads/aset_kekayaan/<?php echo $aset_kekayaan[$i]['file_img']; ?>" target="_blank">lihat</a></td>
                          <td style='text-align: center'><a class="btn btn-warning" href="<?php echo site_url("transaksianggotacon/edit_asetkekayaan/".$aset_kekayaan[$i]['id']); ?>"><i class="fa fa-pencil-square-o"></i></a></td>
                          <td style='text-align: center'><a class="btn btn-danger" onClick="getConfirmationAsetkekayaan('<?php echo $aset_kekayaan[$i]['id']?>');"><i class="fa fa-trash-o"></i></a></td>
                        </tr>
                    <?php
                        }
                        $no++;
                      }
                    ?>
                  </tbody>
                </table>
              </div>
            </div>
            <div class="tab-pane" id="berkas">
              <div class="box-header" style="text-align:left" >
                <h3>
                  <a class="btn btn-primary btn-success" href="<?php echo site_url("transaksianggotacon/create_berkas/".$nasabah->id); ?>">Tambahkan Scan Berkas</a>
                </h3>
              </div> 
              <div class="box-body">
                <table id="berkas_table" class="table table-bordered table-hover"  width="100%">
                  <thead>
                    <tr>
                      <th>No.</th>
                      <th>Nama</th>
                      <th>Link Gambar</th>
                      <th>Edit</th>
                      <th>Delete</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      if($berkas != NULL){
                        $no = 1;
                        for($i = 0; $i < sizeof($berkas); $i++) {
                    ?>
                        <tr>
                          <td><?php echo $no ?></td>
                          <td><?php echo $berkas[$i]['nama_berkas'] ?></td>
                          <td style='text-align: center'><a class="btn btn-primary" href="<?php echo base_url(); ?>files/uploads/berkas/<?php echo $berkas[$i]['file_berkas']; ?>" target="_blank"><i class="fa fa-eye"></i></a></td>
                          <td style='text-align: center'><a class="btn btn-warning" href="<?php echo site_url("transaksianggotacon/edit_berkas/".$berkas[$i]['id']); ?>"><i class="fa fa-pencil-square-o"></i></a></td>
                          <td style='text-align: center'><a class="btn btn-danger" onClick="getConfirmationBerkas('<?php echo $berkas[$i]['id']?>');"><i class="fa fa-trash-o"></i></a></td>
                        </tr>
                    <?php
                        }
                        $no++;
                      }
                    ?>
                  </tbody>
                </table>
              </div>
            </div>


          </div>
        </div>
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->


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
    .table td {
       text-align: center;   
    }
    #pinjaman_table_filter {
      text-align:right;
    }
    #simpananpokok_table_filter {
      text-align:right;
    }
    #simpananwajib_table_filter {
      text-align:right;
    }
    #simpanankhusus_table_filter {
      text-align:right;
    }
    #simpanandanasosial_table_filter {
      text-align:right;
    }
    #simpanankanzun_table_filter {
      text-align:right;
    }
    #simpanan3th_table_filter {
      text-align:right;
    }
    #simpananpihakketiga_table_filter {
      text-align:right;
    }
  </style>

  <script type="text/javascript">
  function getConfirmationPinjaman(id){
    var retVal = confirm("Apakah anda yakin akan menghapus data tersebut ? Jika dihapus, maka detail angsuran anggota yang bersangkutan juga akan terhapus.");
    var controller = 'transaksianggotacon';
    var base_url = '<?php echo site_url(); //you have to load the "url_helper" to use this function ?>';
    if( retVal == true ){
      window.location.href= base_url + '/' + controller + '/delete_pinjaman/' + id;
      //console.log(base_url + '/' + controller + '/delete_nasabah/' + id)
    }
  }

  function getConfirmationSimpananpokok(id){
    var retVal = confirm("Apakah anda yakin akan menghapus data tersebut ? Jika dihapus, maka detail simpanan pokok anggota yang bersangkutan juga akan terhapus.");
    var controller = 'transaksianggotacon';
    var base_url = '<?php echo site_url(); //you have to load the "url_helper" to use this function ?>';
    if( retVal == true ){
      window.location.href= base_url + '/' + controller + '/delete_simpananpokok/' + id;
      //console.log(base_url + '/' + controller + '/delete_nasabah/' + id)
    }
  }

  function getConfirmationSimpananwajib(id){
    var retVal = confirm("Apakah anda yakin akan menghapus data tersebut ? Jika dihapus, maka detail simpanan wajib anggota yang bersangkutan juga akan terhapus.");
    var controller = 'transaksianggotacon';
    var base_url = '<?php echo site_url(); //you have to load the "url_helper" to use this function ?>';
    if( retVal == true ){
      window.location.href= base_url + '/' + controller + '/delete_simpananwajib/' + id;
      //console.log(base_url + '/' + controller + '/delete_nasabah/' + id)
    }
  }

  function getConfirmationSimpanankhusus(id){
    var retVal = confirm("Apakah anda yakin akan menghapus data tersebut ? Jika dihapus, maka detail simpanan khusus anggota yang bersangkutan juga akan terhapus.");
    var controller = 'transaksianggotacon';
    var base_url = '<?php echo site_url(); //you have to load the "url_helper" to use this function ?>';
    if( retVal == true ){
      window.location.href= base_url + '/' + controller + '/delete_simpanankhusus/' + id;
      //console.log(base_url + '/' + controller + '/delete_nasabah/' + id)
    }
  }

  function getConfirmationSimpanandanasosial(id){
    var retVal = confirm("Apakah anda yakin akan menghapus data tersebut ? Jika dihapus, maka detail simpanan dana sosial anggota yang bersangkutan juga akan terhapus.");
    var controller = 'transaksianggotacon';
    var base_url = '<?php echo site_url(); //you have to load the "url_helper" to use this function ?>';
    if( retVal == true ){
      window.location.href= base_url + '/' + controller + '/delete_simpanandanasosial/' + id;
      //console.log(base_url + '/' + controller + '/delete_nasabah/' + id)
    }
  }

  function getConfirmationSimpanankanzun(id){
    var retVal = confirm("Apakah anda yakin akan menghapus data tersebut ? Jika dihapus, maka detail simpanan kanzun anggota yang bersangkutan juga akan terhapus.");
    var controller = 'transaksianggotacon';
    var base_url = '<?php echo site_url(); //you have to load the "url_helper" to use this function ?>';
    if( retVal == true ){
      window.location.href= base_url + '/' + controller + '/delete_simpanankanzun/' + id;
      //console.log(base_url + '/' + controller + '/delete_nasabah/' + id)
    }
  }

  function getConfirmationSimpanan3th(id){
    var retVal = confirm("Apakah anda yakin akan menghapus data tersebut ? Jika dihapus, maka detail simpanan 3 th anggota yang bersangkutan juga akan terhapus.");
    var controller = 'transaksianggotacon';
    var base_url = '<?php echo site_url(); //you have to load the "url_helper" to use this function ?>';
    if( retVal == true ){
      window.location.href= base_url + '/' + controller + '/delete_simpanan3th/' + id;
      //console.log(base_url + '/' + controller + '/delete_nasabah/' + id)
    }
  }

  function getConfirmationSimpananpihakketiga(id){
    var retVal = confirm("Apakah anda yakin akan menghapus data tersebut ? Jika dihapus, maka detail simpanan 3 th anggota yang bersangkutan juga akan terhapus.");
    var controller = 'transaksianggotacon';
    var base_url = '<?php echo site_url(); //you have to load the "url_helper" to use this function ?>';
    if( retVal == true ){
      window.location.href= base_url + '/' + controller + '/delete_simpananpihakketiga/' + id;
      //console.log(base_url + '/' + controller + '/delete_nasabah/' + id)
    }
  }

  function getConfirmationAsetkekayaan(id){
    var retVal = confirm("Apakah anda yakin akan menghapus data tersebut ?");
    var controller = 'transaksianggotacon';
    var base_url = '<?php echo site_url(); //you have to load the "url_helper" to use this function ?>';
    if( retVal == true ){
      window.location.href= base_url + '/' + controller + '/delete_asetkekayaan/' + id;
      //console.log(base_url + '/' + controller + '/delete_nasabah/' + id)
    }
  }

  function getConfirmationBerkas(id){
    var retVal = confirm("Apakah anda yakin akan menghapus data tersebut ?");
    var controller = 'transaksianggotacon';
    var base_url = '<?php echo site_url(); //you have to load the "url_helper" to use this function ?>';
    if( retVal == true ){
      window.location.href= base_url + '/' + controller + '/delete_berkas/' + id;
      //console.log(base_url + '/' + controller + '/delete_nasabah/' + id)
    }
  }

  function isLeapYear(year) {
      return (((year % 4 === 0) && (year % 100 !== 0)) || (year % 400 === 0));   
  }

  function getDaysInMonth(year, month) {
      return [31, (isLeapYear(year) ? 29 : 28), 31, 30, 31, 30, 31, 31, 30, 31, 30, 31][month];
  }

  function pad(s) { 
      return (s < 10) ? '0' + s : s; 
  }

  function convertDate(inputFormat) {
    var d = new Date(inputFormat);
    return [pad(d.getDate()), pad(d.getMonth()+1), d.getFullYear()].join('-');
  }

  function addMonths(date, value) {
    var CurrentDate = new Date(date);
    date = CurrentDate.getDate();

    CurrentDate.setDate(1);
    CurrentDate.setMonth(CurrentDate.getMonth() + value);

    var year = CurrentDate.getFullYear();
    var month = CurrentDate.getMonth();
    var tgl = getDaysInMonth(year, month);
    CurrentDate.setDate(Math.min(date, tgl));

    var res = CurrentDate.toISOString().substring(0, 10);
    var res1 = convertDate(res);

    return res1;
  }

  </script>

  <script>
      function formatRupiah(nilaiUang2)
      {
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

      function label_jumlah_pinjaman() {
        var jumlah_pinjaman=$('#jumlah_pinjaman').val();
        $("#label_jumlah_pinjaman").html('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Rp&nbsp;&nbsp;&nbsp;&nbsp&nbsp;&nbsp;&nbsp;&nbsp'+formatRupiah(Math.floor(jumlah_pinjaman)));
      }

      function label_angsuran_perbulan() {
        var angsuran_perbulan = $('#angsuran_perbulan').val();
        $("#label_angsuran_perbulan").html('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Rp&nbsp;&nbsp;&nbsp;&nbsp&nbsp;&nbsp;&nbsp;&nbsp'+formatRupiah(Math.floor(angsuran_perbulan)));
      }  

      function label_jasa_perbulan() {
        var jasa_perbulan = $('#jasa_perbulan').val();
        $("#label_jasa_perbulan").html('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Rp&nbsp;&nbsp;&nbsp;&nbsp&nbsp;&nbsp;&nbsp;&nbsp'+formatRupiah(Math.floor(jasa_perbulan)));
      }

      function label_total_angsuran_perbulan() {
        var total_angsuran_perbulan = $('#total_angsuran_perbulan').val();
        $("#label_total_angsuran_perbulan").html('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Rp&nbsp;&nbsp;&nbsp;&nbsp&nbsp;&nbsp;&nbsp;&nbsp'+formatRupiah(Math.floor(total_angsuran_perbulan)));
      }

      function label_uang_kurang() {
        var uang_kurang = $('#uang_kurang').val();
        $("#label_uang_kurang").html('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Rp&nbsp;&nbsp;&nbsp;&nbsp&nbsp;&nbsp;&nbsp;&nbsp'+formatRupiah(Math.floor(uang_kurang)));
      }

      function hitung_angsuran_perbulan() {
        //var e = document.getElementById("jenis_pinjaman");
        //if(e.options[e.selectedIndex].value == "Angsuran") {
          if($('#jumlah_pinjaman').val() != "" && $('#jumlah_pinjaman').val() != NaN && $('#jumlah_pinjaman').val() != null) {
            var jumlah_pinjaman = parseInt($('#jumlah_pinjaman').val());
          } else {
            var jumlah_pinjaman = 0;
          }
          if($('#jumlah_angsuran').val() != "" && $('#jumlah_angsuran').val() != NaN && $('#jumlah_angsuran').val() != null) {
            var jumlah_angsuran = parseInt($('#jumlah_angsuran').val());
          } else {
            var jumlah_angsuran = 1;
          }
          var angsuran_perbulan = jumlah_pinjaman / jumlah_angsuran;
          $('#angsuran_perbulan').val(angsuran_perbulan);
          label_angsuran_perbulan();
          hitung_total_angsuran_perbulan();  
        //}
      }

      function hitung_jasa_perbulan() {
        var e = document.getElementById("jenis_pinjaman");
        if(e.options[e.selectedIndex].value == "Angsuran") {
          if($('#jumlah_pinjaman').val() != "" && $('#jumlah_pinjaman').val() != NaN && $('#jumlah_pinjaman').val() != null) {
            var jumlah_pinjaman = parseInt($('#jumlah_pinjaman').val());
          } else {
            var jumlah_pinjaman = 0;
          }
          var jasa_perbulan = (jumlah_pinjaman * 2) / 100;
          $('#jasa_perbulan').val(jasa_perbulan);
          label_jasa_perbulan();
          hitung_total_angsuran_perbulan();
        } else if(e.options[e.selectedIndex].value == "Musiman") {
          if($('#jumlah_pinjaman').val() != "" && $('#jumlah_pinjaman').val() != NaN && $('#jumlah_pinjaman').val() != null) {
            var jumlah_pinjaman = parseInt($('#jumlah_pinjaman').val());
          } else {
            var jumlah_pinjaman = 0;
          }
          var jasa_perbulan = (jumlah_pinjaman * 3) / 100;
          $('#jasa_perbulan').val(jasa_perbulan);
          label_jasa_perbulan();
          hitung_total_angsuran_perbulan();
        }
      }

      function hitung_total_angsuran_perbulan() {
        //var e = document.getElementById("jenis_pinjaman");
        //if(e.options[e.selectedIndex].value == "Angsuran") {
          if($('#angsuran_perbulan').val() != "" && $('#angsuran_perbulan').val() != NaN && $('#angsuran_perbulan').val() != null) {
            var angsuran_perbulan = parseInt($('#angsuran_perbulan').val());
          } else {
            var angsuran_perbulan = 0;
          }
          if($('#jasa_perbulan').val() != "" && $('#jasa_perbulan').val() != NaN && $('#jasa_perbulan').val() != null) {
            var jasa_perbulan = parseInt($('#jasa_perbulan').val());
          } else {
            var jasa_perbulan = 0;
          }
          var total_angsuran_perbulan = angsuran_perbulan + jasa_perbulan;
          $('#total_angsuran_perbulan').val(total_angsuran_perbulan);
          label_total_angsuran_perbulan();
        //}
      }

      function hitung_jatuh_tempo() {
        var tanggal_pinjaman = $('#waktu').val();
        tanggal_pinjaman = tanggal_pinjaman.split("-").reverse().join("-");
        console.log(tanggal_pinjaman);
        if($('#jenis_pinjaman').val() == 'Musiman') {
          var jatuh_tempo = addMonths(tanggal_pinjaman, 4);
          $('#jatuh_tempo').val(jatuh_tempo);
        } else if($('#jenis_pinjaman').val() == 'Angsuran') {
          var jatuh_tempo = addMonths(tanggal_pinjaman, 1);
          $('#jatuh_tempo').val(jatuh_tempo);
        }
      }

      $(document).ready(function(){
        $('.select2').select2();
        $('#waktu').datepicker({}).on('changeDate', function(ev){});

        $( "#id_nasabah" ).change(function() {
          $.ajax({
            type: "POST",
            url: "<?php echo base_url('pinjamancon/pickNasabah') ;?>",
            data: { id_nasabah: $( "#id_nasabah" ).val() },
            cache: true,
            success:
              function(result)
              {
                var nik = result.split("||");
                $( "#nama_nasabah" ).val(nik[0]);
                $( "#nik_nasabah" ).val(nik[1]);
                console.log(nik[1]);
              }
            });
        });

        label_jumlah_pinjaman();
        label_angsuran_perbulan();
        label_jasa_perbulan();
        label_total_angsuran_perbulan();
        label_uang_kurang();

        $('#jenis_pinjaman').change(function() {
          hitung_jasa_perbulan();
          hitung_jatuh_tempo();
        });

        $('#jumlah_pinjaman').keyup(function() {
          label_jumlah_pinjaman();
          hitung_angsuran_perbulan();
          hitung_jasa_perbulan();
        });

        $('#jumlah_angsuran').keyup(function() {
          hitung_angsuran_perbulan();
          hitung_total_angsuran_perbulan();
        });

        $('#waktu').change(function() {
          hitung_jatuh_tempo();
        });

        $('#uang_kurang').keyup(function() {
          label_uang_kurang();
        });

      });

    </script>
