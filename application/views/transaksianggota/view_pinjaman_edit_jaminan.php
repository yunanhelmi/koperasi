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
        <li class="active"><i class="fa fa-user"></i> View</li>
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
                    <label for="inputSkills" class="col-sm-3 control-label">RT</label>
                    <div class="col-sm-9">
                      <?php echo '<input type="text" class="form-control" name="rt" id="rt" readonly value="'.$nasabah->rt.'">'; ?>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputSkills" class="col-sm-3 control-label">RW</label>
                    <div class="col-sm-9">
                      <?php echo '<input type="text" class="form-control" name="rw" id="rw" readonly value="'.$nasabah->rw.'">'; ?>
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


              <div class="row">
               <div class="col-md-12 pull-left">
                  <!-- general form elements -->
                  <?php 
                    $date = strtotime( $pinjaman->waktu );
                  ?>
                  <div class="box box-danger">
                    <legend style="text-align:center;">DETAIL PINJAMAN</legend>

                    <div class="box-body">
                      <div class="form-group col-xs-3">
                        <label for="exampleInputEmail1">Nama Anggota</label>
                        <p><?php echo $pinjaman->nama_nasabah;?></p>
                      </div>
                      <div class="form-group col-xs-3">
                        <label for="exampleInputPassword1">Alamat</label>
                        <p><?php echo $pinjaman->kelurahan." ".$pinjaman->dusun;?></p>
                      </div>
                      <div class="form-group col-xs-3">
                        <label for="exampleInputPassword1">Jenis Pinjaman</label>
                        <p><?php echo $pinjaman->jenis_pinjaman;?></p>
                      </div>
                      <div class="form-group col-xs-3">
                        <label for="exampleInputPassword1">Jaminan</label>
                        <?php
                          $jaminan = json_decode($pinjaman->jaminan);
                          $test = @json_decode($pinjaman->jaminan);
                          if ($test)  {
                            $str_jaminan = '';
                            for($a = 0; $a < sizeof($jaminan); $a++) {
                              $str_jaminan .= $jaminan[$a]->keterangan;
                              $str_jaminan .= '; ';
                            }
                            $str_jaminan = substr($str_jaminan, 0, -2);
                          } else {
                            $str_jaminan = $pinjaman->jaminan;
                          }
                          
                        ?>
                        <p><?php echo $str_jaminan;?></p>
                      </div>
                      <div class="form-group col-xs-3">
                        <label for="exampleInputPassword1">Tanggal Pinjaman</label>
                        <?php 
                          $date = strtotime( $pinjaman->waktu );
                          $mydate = date( 'd-m-Y', $date );
                        ?>
                        <p><?php echo $mydate;?></p>
                      </div>
                      <div class="form-group col-xs-3">
                        <label for="exampleInputPassword1">Tanggal Jatuh Tempo</label>
                        <?php 
                            $jatuh_tempo = strtotime( $pinjaman->jatuh_tempo );
                            $jatuh_tempo1 = date( 'd-m-Y', $jatuh_tempo );
                          ?>
                          <p><?php echo $jatuh_tempo1;?></p>
                      </div>
                      <div class="form-group col-xs-3">
                        <label for="exampleInputPassword1">Jumlah Pinjaman Awal</label>
                        <p><?php echo "Rp " . number_format($pinjaman->jumlah_pinjaman,2,',','.');?></p>
                      </div>
                      <div class="form-group col-xs-3">
                        <label for="exampleInputPassword1">Jumlah Angsuran</label>
                        <p><?php echo $pinjaman->jumlah_angsuran;?></p>
                      </div>
                      <div class="form-group col-xs-3">
                        <label for="exampleInputPassword1">Sisa Pinjaman</label>
                        <p><?php echo "Rp " . number_format($pinjaman->sisa_angsuran,2,',','.');?></p>
                      </div>
                      <div class="form-group col-xs-3">
                        <label for="exampleInputPassword1">Angsuran Per Bulan</label>
                        <p><?php echo "Rp " . number_format($pinjaman->angsuran_perbulan,2,',','.');?></p>
                      </div>
                      <div class="form-group col-xs-3">
                        <label for="exampleInputPassword1">Jasa Per Bulan</label>
                        <p><?php echo "Rp " . number_format($pinjaman->jasa_perbulan,2,',','.');?></p>
                      </div>
                      <div class="form-group col-xs-3">
                        <label for="exampleInputPassword1">Total Angsuran Per Bulan</label>
                        <p><?php echo "Rp " . number_format($pinjaman->total_angsuran_perbulan,2,',','.');?></p>
                      </div>
                      <div class="form-group col-xs-3">
                        <label for="exampleInputPassword1">Keterangan</label>
                        <p><?php echo $pinjaman->keterangan;?></p>
                      </div>
                      <div class="form-group col-xs-3">
                        <label for="exampleInputPassword1">Lama Hari</label>
                        <?php
                          if($lama_hari_long != "LUNAS") {
                        ?>
                          <p><?php echo $lama_hari." (".$lama_hari_long->y." Tahun ".$lama_hari_long->m." Bulan ".$lama_hari_long->d." Hari)";?></p>
                        <?php
                          } else {
                        ?>
                          <p><?php echo $lama_hari?></p>
                        <?php
                          }
                        ?>
                      </div>
                      <div class="form-group col-xs-3">
                        <label for="exampleInputPassword1">Uang Kurang</label>
                        <p><?php echo "Rp " . number_format($pinjaman->uang_kurang,2,',','.');?></p>
                      </div>
                      <div class="form-group col-xs-6">
                        <label for="exampleInputPassword1">Janji</label>
                        <p><?php echo $pinjaman->janji;?></p>
                      </div>
                    </div>
                  </div>  

                  <div class="box box-danger">
                    <legend style="text-align:center;">DETAIL JAMINAN</legend>
                    <table id="detail_jaminan_table" class="table table-bordered table-hover"  width="100%" style="table-layout: fixed;">
                      <thead>
                        <tr>
                          <th style="width: 50px;">No.</th>
                          <th>Jaminan</th>
                          <th style="width: 70px;">Edit</th>
                          <th style="width: 70px;">Delete</th>
                        </tr>
                      </thead>
                      <tbody>
                          <?php
                            if($detail_jaminan != NULL){
                              $no = 0;
                              for($i = 0; $i < sizeof($detail_jaminan); $i++) {
                                if($detail_jaminan[$i]['jenis_jaminan'] == 'sertifikat') {
                                  $no++;
                          ?> 
                                <tr>
                                  <td><?php echo $no ?></td>
                                  <td style="word-wrap: break-word; text-align: left;"><?php echo strtoupper($detail_jaminan[$i]['jenis_jaminan']).'. Nama Pemilik: '.$detail_jaminan[$i]['nama_pemilik'].' No. Sertifikat: '.$detail_jaminan[$i]['no_sertifikat'].' Luas(m2): '.$detail_jaminan[$i]['luas'].' Jenis Tanah: '.$detail_jaminan[$i]['jenis_tanah'].' Lokasi Tanah: '.$detail_jaminan[$i]['lokasi_tanah'] ?></td>
                                  <td style='text-align: center'><a class="btn btn-warning" href="<?php echo site_url("transaksianggotacon/edit_detail_jaminan/".$pinjaman->id."/".$detail_jaminan[$i]['id']); ?>"><i class="fa fa-pencil-square-o"></i></a></td>
                                  <td style='text-align: center'><a class="btn btn-danger" onClick="getConfirmationDeleteJaminan('<?php echo $pinjaman->id?>','<?php echo $detail_jaminan[$i]['id']?>');"><i class="fa fa-trash-o"></i></a></td>
                                </tr>
                          <?php
                                } else if($detail_jaminan[$i]['jenis_jaminan'] == 'bpkb') {
                          ?>
                                <tr>
                                  <td><?php echo $no ?></td>
                                  <td style="word-wrap: break-word; text-align: left;"><?php echo strtoupper($detail_jaminan[$i]['jenis_jaminan']).'. Atas Nama: '.$detail_jaminan[$i]['atas_nama'].' No. Polisi: '.$detail_jaminan[$i]['no_pol'].' Merek: '.$detail_jaminan[$i]['merek'].' Jenis: '.$detail_jaminan[$i]['jenis'].' Tahun: '.$detail_jaminan[$i]['tahun'] ?></td>
                                  <td style='text-align: center'><a class="btn btn-warning" href="<?php echo site_url("transaksianggotacon/edit_detail_jaminan/".$pinjaman->id."/".$detail_jaminan[$i]['id']); ?>"><i class="fa fa-pencil-square-o"></i></a></td>
                                  <td style='text-align: center'><a class="btn btn-danger" onClick="getConfirmationDeleteJaminan('<?php echo $pinjaman->id?>','<?php echo $detail_jaminan[$i]['id']?>');"><i class="fa fa-trash-o"></i></a></td>
                                </tr>
                          <?php
                                }
                                $no++;
                              }
                            } else {
                          ?>
                          <tr>
                            <td></td>
                            <td style="word-wrap: break-word; text-align: left;"></td>
                            <td></td>
                            <td></td>
                          </tr>
                          <?php    
                            }
                          ?>
                        </tbody>
                    </table>
                    <br>
                    <div class="form-group col-xs-12">
                      <button onclick="tambahJaminan()" type="submit" class="btn btn-success" style="float: right;">Tambah Jaminan</button>
                    </div>
                  </div>
                  <br>
                  <br>
                  <br>
                  <div class="box box-danger" id="div_tambah_jaminan" style="display:none">
                    <legend style="text-align:center;">TAMBAH JAMINAN</legend>
                    <form action="<?php echo base_url()."index.php/transaksianggotacon/insert_detail_jaminan/".$nasabah->id;?>" method="post" enctype="multipart/form-data" role="form">
                    <div class="box-body">
                      <div class="form-group col-xs-6">
                        <label for="exampleInputPassword1">Jenis Jaminan</label>
                        <select id="jenis_jaminan" name="jenis_jaminan" class="form-control" style="width: 100%;">
                          <option value='sertifikat'>Sertifikat</option>
                          <option value='bpkb'>BPKB</option>
                        </select>
                        <input type="hidden" class="form-control" value="<?php echo $pinjaman->id?>" id="id_pinjaman" name="id_pinjaman">
                      </div>
                      <div class="form-group col-xs-6" id="div_nama_pemilik">
                        <label for="exampleInputPassword1">Nama Pemilik</label>
                        <input type="text" class="form-control" id="nama_pemilik" name="nama_pemilik" placeholder="">
                      </div>
                      <div class="form-group col-xs-6" id="div_no_sertifikat">
                        <label for="exampleInputPassword1">No. Sertifikat</label>
                        <input type="text" class="form-control" id="no_sertifikat" name="no_sertifikat" placeholder="">
                      </div>
                      <div class="form-group col-xs-6" id="div_luas">
                        <label for="exampleInputPassword1">Luas</label>
                        <input type="number" class="form-control" id="luas" name="luas" placeholder="">
                      </div>
                      <div class="form-group col-xs-6" id="div_jenis_tanah">
                        <label for="exampleInputPassword1">Jenis Tanah</label>
                        <select id="jenis_tanah" name="jenis_tanah" class="form-control" style="width: 100%;">
                          <option value='perumahan'>Perumahan</option>
                          <option value='pekarangan'>Pekarangan</option>
                          <option value='pertanian'>Pertanian</option>
                          <option value='perkebunan'>Perkebunan</option>
                        </select>
                      </div>
                      <div class="form-group col-xs-6" id="div_lokasi_tanah">
                        <label for="exampleInputPassword1">Lokasi Tanah</label>
                        <input type="text" class="form-control" id="lokasi_tanah" name="lokasi_tanah" placeholder="">
                      </div>
                      <div class="form-group col-xs-6" id="div_merek" style="display:none">
                        <label for="exampleInputPassword1">Merek</label>
                        <select id="merek" name="merek" class="form-control" style="width: 100%;">
                          <option value='HONDA'>HONDA</option>
                          <option value='YAMAHA'>YAMAHA</option>
                          <option value='SUZUKI'>SUZUKI</option>
                        </select>
                      </div>
                      <div class="form-group col-xs-6" id="div_jenis" style="display:none">
                        <label for="exampleInputPassword1">Jenis</label>
                        <input type="text" class="form-control" id="jenis_motor" name="jenis_motor" placeholder="">
                      </div>
                      <div class="form-group col-xs-6" id="div_tahun" style="display:none">
                        <label for="exampleInputPassword1">Tahun</label>
                        <input type="number" class="form-control" id="tahun" name="tahun" placeholder="">
                      </div>
                      <div class="form-group col-xs-6" id="div_atas_nama" style="display:none">
                        <label for="exampleInputPassword1">Atas Nama</label>
                        <input type="text" class="form-control" id="atas_nama" name="atas_nama" placeholder="">
                      </div>
                      <div class="form-group col-xs-6" id="div_no_pol" style="display:none">
                        <label for="exampleInputPassword1">No. Polisi</label>
                        <input type="text" class="form-control" id="no_pol" name="no_pol" placeholder="">
                      </div>
                    </div>
                    <div class="box-footer">
                        <div class="col-xs-3">
                          <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                        <div class="col-xs-3">
                          <button type="button" onclick="cancelTambahJaminan()" class="btn btn-warning">Batal</button>
                        </div>
                      </div>
                    </form>
                  </div>

                  <div class="box box-danger" id="div_edit_jaminan">
                    <legend style="text-align:center;">EDIT JAMINAN</legend>
                    <form action="<?php echo base_url()."index.php/transaksianggotacon/update_detail_jaminan/".$nasabah->id;?>" method="post" enctype="multipart/form-data" role="form">
                    <div class="box-body">
                      <div class="form-group col-xs-6">
                        <label for="exampleInputPassword1">Jenis Jaminan</label>
                        <select id="edit_jenis_jaminan" name="edit_jenis_jaminan" class="form-control" style="width: 100%;">
                          <option value='sertifikat' <?php echo $edit_detail_jaminan->jenis_jaminan == 'sertifikat' ? 'selected' : ''?> >Sertifikat</option>
                          <option value='bpkb' <?php echo $edit_detail_jaminan->jenis_jaminan == 'bpkb' ? 'selected' : ''?> >BPKB</option>
                        </select>
                        <input type="hidden" class="form-control" value="<?php echo $pinjaman->id?>" id="edit_id_pinjaman" name="edit_id_pinjaman">
                        <input type="hidden" class="form-control" value="<?php echo $edit_detail_jaminan->id?>" id="edit_id" name="edit_id">
                      </div>
                      <div class="form-group col-xs-6" id="div_edit_nama_pemilik">
                        <label for="exampleInputPassword1">Nama Pemilik</label>
                        <input type="text" class="form-control" value="<?php echo $edit_detail_jaminan->nama_pemilik;?>" id="edit_nama_pemilik" name="edit_nama_pemilik" placeholder="">
                      </div>
                      <div class="form-group col-xs-6" id="div_edit_no_sertifikat">
                        <label for="exampleInputPassword1">No. Sertifikat</label>
                        <input type="text" class="form-control" value="<?php echo $edit_detail_jaminan->no_sertifikat;?>" id="edit_no_sertifikat" name="edit_no_sertifikat" placeholder="">
                      </div>
                      <div class="form-group col-xs-6" id="div_edit_luas">
                        <label for="exampleInputPassword1">Luas</label>
                        <input type="number" class="form-control" value="<?php echo $edit_detail_jaminan->luas;?>" id="edit_luas" name="edit_luas" placeholder="">
                      </div>
                      <div class="form-group col-xs-6" id="div_edit_jenis_tanah">
                        <label for="exampleInputPassword1">Jenis Tanah</label>
                        <select id="edit_jenis_tanah" name="edit_jenis_tanah" class="form-control" style="width: 100%;">
                          <option value='perumahan' <?php echo $edit_detail_jaminan->jenis_tanah == 'perumahan' ? 'selected' : ''?> >Perumahan</option>
                          <option value='pekarangan' <?php echo $edit_detail_jaminan->jenis_tanah == 'pekarangan' ? 'selected' : ''?> >Pekarangan</option>
                          <option value='pertanian' <?php echo $edit_detail_jaminan->jenis_tanah == 'pertanian' ? 'selected' : ''?> >Pertanian</option>
                          <option value='perkebunan' <?php echo $edit_detail_jaminan->jenis_tanah == 'perkebunan' ? 'selected' : ''?> >Perkebunan</option>
                        </select>
                      </div>
                      <div class="form-group col-xs-6" id="div_edit_lokasi_tanah">
                        <label for="exampleInputPassword1">Lokasi Tanah</label>
                        <input type="text" class="form-control" value="<?php echo $edit_detail_jaminan->lokasi_tanah;?>" id="edit_lokasi_tanah" name="edit_lokasi_tanah" placeholder="">
                      </div>
                      <div class="form-group col-xs-6" id="div_edit_merek" style="display:none">
                        <label for="exampleInputPassword1">Merek</label>
                        <select id="edit_merek" name="edit_merek" class="form-control" style="width: 100%;">
                          <option value='HONDA' <?php echo $edit_detail_jaminan->merek == 'HONDA' ? 'selected' : ''?> >HONDA</option>
                          <option value='YAMAHA' <?php echo $edit_detail_jaminan->merek == 'YAMAHA' ? 'selected' : ''?> >YAMAHA</option>
                          <option value='SUZUKI' <?php echo $edit_detail_jaminan->merek == 'SUZUKI' ? 'selected' : ''?> >SUZUKI</option>
                        </select>
                      </div>
                      <div class="form-group col-xs-6" id="div_edit_jenis_motor" style="display:none">
                        <label for="exampleInputPassword1">Jenis</label>
                        <input type="text" class="form-control" value="<?php echo $edit_detail_jaminan->jenis;?>" id="edit_jenis_motor" name="edit_jenis_motor" placeholder="">
                      </div>
                      <div class="form-group col-xs-6" id="div_edit_tahun" style="display:none">
                        <label for="exampleInputPassword1">Tahun</label>
                        <input type="number" class="form-control" value="<?php echo $edit_detail_jaminan->tahun;?>" id="edit_tahun" name="edit_tahun" placeholder="">
                      </div>
                      <div class="form-group col-xs-6" id="div_edit_atas_nama" style="display:none">
                        <label for="exampleInputPassword1">Atas Nama</label>
                        <input type="text" class="form-control" value="<?php echo $edit_detail_jaminan->atas_nama;?>" id="edit_atas_nama" name="edit_atas_nama" placeholder="">
                      </div>
                      <div class="form-group col-xs-6" id="div_edit_no_pol" style="display:none">
                        <label for="exampleInputPassword1">No. Polisi</label>
                        <input type="text" class="form-control" value="<?php echo $edit_detail_jaminan->no_pol;?>" id="edit_no_pol" name="edit_no_pol" placeholder="">
                      </div>
                    </div>
                    <div class="box-footer">
                        <div class="col-xs-3">
                          <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                        <div class="col-xs-3">
                          <button type="button" onclick="cancelEditJaminan()" class="btn btn-warning">Batal</button>
                        </div>
                      </div>
                    </form>
                  </div>

                  <div class="box box-danger">
                    <legend style="text-align:center;">DETAIL ANGSURAN</legend>
                    <table id="detail_angsuran_table" class="table table-bordered table-hover"  width="100%">
                      <thead>
                        <tr>
                          <th>No.</th>
                          <th>Waktu</th>
                          <th>Jenis</th>
                          <th>Keterangan</th>
                          <th>Debet</th>
                          <th>Kredit</th>
                          <th>Jasa</th>
                          <th>Jasa Tambahan</th>
                          <th>Sisa Pinjaman</th>
                          <th>Edit</th>
                          <th>Delete</th>
                          <th>Post</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                          $no           = 1;
                          $total_debet  = 0;
                          $total_kredit = 0;
                          $total_jasa   = 0;
                          $total_denda  = 0;
                          $sisa_pinjaman = array();
                          for($i = 0; $i < sizeof($detail_angsuran); $i++) {
                        ?>
                        <tr>
                          <td style='text-align: center'><?php echo $no."."?></td>
                          <?php 
                          $waktu = strtotime( $detail_angsuran[$i]['waktu'] );
                          $wkt = date( 'd-m-Y', $waktu );
                          ?>
                          <td><?php echo $wkt?></td>
                          <?php if($detail_angsuran[$i]['jenis'] == "Pinjaman") {?>
                          <?php
                            if($detail_angsuran[$i]['jasa'] >= 0) {
                          ?>
                          <td style='text-align: left'><?php echo $detail_angsuran[$i]['jenis']?></td>
                          <?php
                            } else {
                          ?>
                          <td style='text-align: left'>Pengembalian Jasa</td>
                          <?php
                            }
                          ?>
                          <td><?php echo $detail_angsuran[$i]['keterangan']?></td>
                          <td style='text-align: right'><?php echo "Rp " . number_format(0,2,',','.');?></td>
                          <td style='text-align: right'><?php echo "Rp " . number_format($detail_angsuran[$i]['total'],2,',','.');?></td>
                          <?php $total_kredit += $detail_angsuran[$i]['total'];?>
                          <?php } else if($detail_angsuran[$i]['jenis'] == "Angsuran") {?>
                          <?php
                            if($detail_angsuran[$i]['jasa'] >= 0) {
                              $bln_thn = strtotime( $detail_angsuran[$i]['bulan_tahun'] );
                              $bulan_tahun = date( 'M-Y', $bln_thn );
                          ?>
                          <td style='text-align: left'><?php echo $detail_angsuran[$i]['jenis']." Bulan ke-".$detail_angsuran[$i]['bulan_ke']." (".$bulan_tahun.")"?></td>
                          <?php
                            } else {
                          ?>
                          <td style='text-align: left'>Pengembalian Jasa</td>
                          <?php
                            }
                          ?>
                          <td><?php echo $detail_angsuran[$i]['keterangan']?></td>
                          <td style='text-align: right'><?php echo "Rp " . number_format($detail_angsuran[$i]['angsuran'],2,',','.');?></td>
                          <td style='text-align: right'><?php echo "Rp " . number_format(0,2,',','.');?></td>
                          <?php $total_debet += $detail_angsuran[$i]['angsuran'];?>
                          <?php }
                          $sisa_pinjaman[$i] = $total_kredit - $total_debet;
                          ?>
                          <td style='text-align: right'><?php echo "Rp " . number_format($detail_angsuran[$i]['jasa'],2,',','.');?></td>
                          <td style='text-align: right'><?php echo "Rp " . number_format($detail_angsuran[$i]['denda'],2,',','.');?></td>
                          <td style='text-align: right'><?php echo "Rp " . number_format($sisa_pinjaman[$i],2,',','.');?></td>
                          <?php 
                            $total_jasa += $detail_angsuran[$i]['jasa'];
                            $total_denda += $detail_angsuran[$i]['denda'];
                          ?>
                          <?php 
                          if($detail_angsuran[$i]['status_post'] == 1) {
                          ?>
                          <td></td>
                          <td></td>
                          <td style='text-align: center'><a class="btn btn-primary" href="<?php echo site_url("transaksianggotacon/angsuran_unpost_akuntansi/".$pinjaman->id."/".$detail_angsuran[$i]['id']); ?>"><i class="fa fa-times"></i></a></td>
                          <?php
                          } else {
                          ?>
                          <td style='text-align: center'><a class="btn btn-warning" href="<?php echo site_url("transaksianggotacon/edit_detail_angsuran/".$pinjaman->id."/".$detail_angsuran[$i]['id']); ?>"><i class="fa fa-pencil-square-o"></i></a></td>
                          <td style='text-align: center'><a class="btn btn-danger" onClick="getConfirmationDeleteAngsuran('<?php echo $pinjaman->id?>','<?php echo $detail_angsuran[$i]['id']?>');"><i class="fa fa-trash-o"></i></a></td>
                          <td style='text-align: center'><a class="btn btn-primary" href="<?php echo site_url("transaksianggotacon/angsuran_post_akuntansi/".$pinjaman->id."/".$detail_angsuran[$i]['id']); ?>"><i class="fa fa-upload"></i></a></td>
                          <?php
                          }
                          ?>                            
                        </tr>
                        <?php $no++;}?>
                        <tr>
                          <td colspan='4'><strong>TOTAL</strong></td>
                          <td style='text-align: right'><strong><?php echo "Rp " . number_format($total_debet,2,',','.');?></strong></td>
                          <td style='text-align: right'><strong><?php echo "Rp " . number_format($total_kredit,2,',','.');?></strong></td>
                          <td style='text-align: right'><strong><?php echo "Rp " . number_format($total_jasa,2,',','.');?></strong></td>
                          <td style='text-align: right'><strong><?php echo "Rp " . number_format($total_denda,2,',','.');?></strong></td>
                          <td></td>
                        </tr>
                      </tbody>
                    </table>
                    <br>
                    <div class="form-group col-xs-12">
                      <button onclick="tambahAngsuran()" type="submit" class="btn btn-success" style="float: right;">Tambah Angsuran</button>
                    </div>
                  </div>
                  <div class="box box-danger" id="div_tambah_angsuran" style="display:none">
                    <legend style="text-align:center;">TAMBAH ANGSURAN</legend>
                    <form action="<?php echo base_url()."index.php/transaksianggotacon/insert_detail_angsuran/".$nasabah->id;?>" method="post" enctype="multipart/form-data" role="form">
                    <div class="box-body">
                      <div class="form-group col-xs-6">
                        <label for="exampleInputPassword1">Tanggal</label>
                        <div class="input-group date">
                          <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                          </div>
                          <input type="text" class="form-control pull-right" name="waktu" id="waktu" value="" data-date-format="dd-mm-yyyy" required>
                          <input type="hidden" class="form-control" value="<?php echo $pinjaman->id?>" id="id_pinjaman" name="id_pinjaman">
                        </div>
                      </div>
                      <div class="form-group col-xs-6">
                        <label for="exampleInputPassword1">Tanggal Jatuh Tempo</label>
                        <div class="input-group date">
                          <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                          </div>
                          <?php
                            $jatuh_tempo = date("d-m-Y", strtotime($pinjaman->jatuh_tempo));
                          ?>
                          <input type="text" class="form-control pull-right" name="jatuh_tempo" id="jatuh_tempo" value="<?php echo $jatuh_tempo;?>" data-date-format="dd-mm-yyyy" required>
                        </div>
                      </div>
                      <div class="form-group col-xs-6">
                        <label for="exampleInputPassword1">Jenis</label>
                        <select id="jenis" name="jenis" class="form-control" style="width: 100%;">
                          <option value='Angsuran'>Angsuran</option>
                          <option value='Pinjaman'>Pinjaman</option>
                        </select>
                      </div>
                      <div class="form-group col-xs-6">
                        <label for="exampleInputPassword1">Bulan ke-</label>
                        <?php $max = $max_bulanke_angsuran + 1;?>
                        <input type="text" class="form-control" value="<?php echo $max?>" id="bulan_ke" name="bulan_ke" placeholder="">
                      </div>
                      <div class="form-group col-xs-6">
                          <label for="exampleInputPassword1">Bulan-Tahun</label>
                          <input type="month" class="form-control" id="bulan_tahun" name="bulan_tahun" placeholder="">
                        </div>
                      <div class="form-group col-xs-6">
                        <label for="exampleInputPassword1">Angsuran</label>
                        <div class="input-group margin-bottom-sm">
                          <span class="input-group-addon">Rp</span>
                          <?php
                            if($pinjaman->jenis_pinjaman == "Angsuran") {
                              $angsuran = $pinjaman->angsuran_perbulan;
                            } else if($pinjaman->jenis_pinjaman == "Musiman") {
                              $angsuran = 0;
                            }
                          ?>
                          <input type="text" class="form-control" value="<?php echo $angsuran?>" id="angsuran" name="angsuran" placeholder="0">
                        </div>
                        <div id="label_angsuran" class="alert-danger"></div>
                      </div>
                      <div class="form-group col-xs-6">
                        <label for="exampleInputPassword1">Jasa</label>
                        <div class="input-group margin-bottom-sm">
                          <span class="input-group-addon">Rp</span>
                          <input type="text" class="form-control" value="<?php echo $pinjaman->jasa_perbulan?>" id="jasa" name="jasa" placeholder="0">
                        </div>
                        <div id="label_jasa" class="alert-danger"></div>
                      </div>
                      <div class="form-group col-xs-6">
                        <label for="exampleInputPassword1">Pengali Jasa Tambahan</label>
                        <select id="pengali_jasa_tambahan" name="pengali_jasa_tambahan" class="form-control" style="width: 100%;">
                          <option value='0'>-</option>
                          <option value='1/3'>10 hari</option>
                          <option value='1/2'>15 hari</option>
                          <option value='2/3'>20 hari</option>
                        </select>
                      </div>
                      <div class="form-group col-xs-6">
                        <label for="exampleInputPassword1">Jasa Tambahan</label>
                        <div class="input-group margin-bottom-sm">
                          <span class="input-group-addon">Rp</span>
                          <input type="text" class="form-control" id="denda" name="denda" placeholder="0">
                        </div>
                        <div id="label_denda" class="alert-danger"></div>
                      </div>
                      <div class="form-group col-xs-6">
                        <label for="exampleInputPassword1">Total</label>
                        <div class="input-group margin-bottom-sm">
                          <span class="input-group-addon">Rp</span>
                          <input type="text" class="form-control" id="total" name="total" placeholder="0">
                        </div>
                        <div id="label_total" class="alert-danger"></div>
                      </div>
                      <div class="form-group col-xs-6">
                        <label for="exampleInputPassword1">Keterangan</label>
                        <!-- <input type="text" class="form-control" id="keterangan" name="keterangan" placeholder=""> -->
                        <textarea class="form-control" id="keterangan" name="keterangan" placeholder="Keterangan"></textarea>
                      </div>
                    </div>
                    <div class="box-footer">
                        <div class="col-xs-3">
                          <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                        <div class="col-xs-3">
                          <button type="button" onclick="cancelTambahAngsuran()" class="btn btn-warning">Batal</button>
                        </div>
                      </div>
                    </form>
                  </div>
                  <br>
                  <br>
                  <div class="box box-danger">
                    <legend style="text-align:center;">SCAN SURAT TAGIHAN</legend>
                    <table id="scan_surat_tagihan_table" class="table table-bordered table-hover"  width="100%">
                      <thead>
                        <tr>
                          <th>No.</th>
                          <th>Jenis Surat</th>
                          <th>Tanggal Penerimaan Surat</th>
                          <th>Hasil Penagihan / Janji</th>
                          <th>Keterangan</th>
                          <th>Lihat File</th>
                          <th>Delete</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                          if($scansurattagihan != NULL) {
                            $no = 1;
                            for($i = 0; $i < sizeof($scansurattagihan); $i++) {
                        ?>
                          <tr>
                            <td><?php echo $no; ?></td>
                            <td><?php echo $scansurattagihan[$i]['jenis_surat']; ?></td>
                            <?php 
                              $waktu = strtotime( $scansurattagihan[$i]['tgl_penerimaan_surat'] );
                              $wkt = date( 'd M Y', $waktu );
                            ?>
                            <td><?php echo $wkt; ?></td>
                            <td><?php echo $scansurattagihan[$i]['hasil_penagihan_janji']; ?></td>
                            <td><?php echo $scansurattagihan[$i]['keterangan']; ?></td>
                            <td style='text-align: center'><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal_test"><i class="fa fa-eye"></i></button></td>
                            <div class="modal fade" id="modal_test" tabindex="-1" style="display: none;" aria-hidden="true">
                              <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h4 class="modal-title">File Surat</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                    </button>
                                  </div>
                                  <div class="modal-body" style="max-height:500px; max-width:890px; overflow: scroll;">
                                    
                                      <img src="<?php echo base_url(); ?>files/uploads/scan_surat_tagihan/<?php echo $scansurattagihan[$i]['file_surat']; ?>">
                                    
                                  </div>
                                  <div class="modal-footer justify-content-between">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <td style='text-align: center'><a class="btn btn-danger" onClick="getConfirmationDeleteScanSuratTagihan('<?php echo $pinjaman->id?>','<?php echo $scansurattagihan[$i]['id']?>');"><i class="fa fa-trash-o"></i></a></td>
                          </tr>
                        <?php    
                            }
                          }
                        ?>
                      </tbody>
                    </table>
                    <br>
                    <div class="form-group col-xs-12">
                      <button onclick="tambahScanSuratTagihan()" type="submit" class="btn btn-success" style="float: right;">Tambah Scan Surat Tagihan</button>
                    </div>
                  </div>
                  <br>
                  <br>
                  <div class="box box-danger" id="div_tambah_scansurattagihan" style="display:none">
                    <legend style="text-align:center;">TAMBAH SCAN SURAT TAGIHAN</legend>
                    <form action="<?php echo base_url()."index.php/transaksianggotacon/insert_scan_surat_tagihan/".$nasabah->id;?>" method="post" enctype="multipart/form-data" role="form">
                      <div class="box-body">
                        <div class="form-group col-xs-6">
                          <label for="exampleInputPassword1">Jenis Surat</label>
                          <select id="jenis_jaminan" name="jenis_surat" class="form-control" style="width: 100%;">
                            <option value='K1'>K1</option>
                            <option value='K2'>K2</option>
                            <option value='Merah'>Merah</option>
                          </select>
                          <input type="hidden" class="form-control" value="<?php echo $pinjaman->id?>" id="id_pinjaman" name="id_pinjaman">
                        </div>
                        <div class="form-group col-xs-6">
                          <label for="exampleInputPassword1">Tanggal Penerimaan Surat</label>
                          <div class="input-group date">
                            <div class="input-group-addon">
                              <i class="fa fa-calendar"></i>
                            </div>
                            <input type="text" class="form-control pull-right" name="tgl_penerimaan_surat" id="tgl_penerimaan_surat" data-date-format="dd-mm-yyyy" required>
                          </div>
                        </div>
                        <div class="form-group col-xs-6">
                          <label for="exampleInputPassword1">Hasil Penagihan / Janji</label>
                          <textarea id="hasil_penagihan_janji" name="hasil_penagihan_janji" class="form-control"></textarea>
                        </div>
                        <div class="form-group col-xs-6">
                          <label for="exampleInputPassword1">Keterangan</label>
                          <textarea id="keterangan" name="keterangan" class="form-control"></textarea>
                        </div>
                        <div class="form-group col-xs-6">
                          <label for="exampleInputFile">Upload File</label>
                          <input type="file" accept=".jpg, .jpeg" name="file_surat" required>
                        </div>
                      </div>
                      <div class="box-footer">
                        <div class="col-xs-3">
                          <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                        <div class="col-xs-3">
                          <button type="button" onclick="cancelScanSuratTagihan()" class="btn btn-warning">Batal</button>
                        </div>
                      </div>
                    </form>
                    <br>
                    <br>
                  </div>
                </div>
              </div>

              
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
                      <th>Jenis</th>
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
                      <td><?php echo $simpananpokok[$i]['jenis']?></td>
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
                      <td style='text-align: center'><a class="btn btn-primary" href="<?php echo site_url("transaksianggotacon/view_simpananwajib/".$simpananwajib[$i]['id']); ?>"><i class="fa fa-eye"></i></a></td>
                      <td style='text-align: center'><a class="btn btn-warning" href="<?php echo site_url("transaksianggotacon/edit_simpananwajib/".$simpananwajib[$i]['id']); ?>"><i class="fa fa-pencil-square-o"></i></a></td>
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
                      <td style='text-align: center'><a class="btn btn-primary" href="<?php echo site_url("transaksianggotacon/view_simpanankhusus/".$simpanankhusus[$i]['id']); ?>"><i class="fa fa-eye"></i></a></td>
                      <td style='text-align: center'><a class="btn btn-warning" href="<?php echo site_url("transaksianggotacon/edit_simpanankhusus/".$simpanankhusus[$i]['id']); ?>"><i class="fa fa-pencil-square-o"></i></a></td>
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
                          <!-- <td style='text-align: center'><a class="btn btn-primary" href="<?php echo base_url(); ?>files/uploads/berkas/<?php echo $berkas[$i]['file_berkas']; ?>" target="_blank"><i class="fa fa-eye"></i></a></td> -->
                          <td style='text-align: center'><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal_test"><i class="fa fa-eye"></i></button></td>
                          <div class="modal fade" id="modal_test" tabindex="-1" style="display: none;" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h4 class="modal-title">File Berkas</h4>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">×</span>
                                  </button>
                                </div>
                                <div class="modal-body" style="max-height:500px; max-width:890px; overflow: scroll;">
                                  
                                    <img src="<?php echo base_url(); ?>files/uploads/berkas/<?php echo $berkas[$i]['file_berkas']; ?>">
                                  
                                </div>
                                <div class="modal-footer justify-content-between">
                                  <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                                </div>
                              </div>
                            </div>
                          </div>
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

      function label_angsuran() {
        var angsuran = $('#angsuran').val();
        $("#label_angsuran").html('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Rp&nbsp;&nbsp;&nbsp;&nbsp&nbsp;&nbsp;&nbsp;&nbsp'+formatRupiah(Math.floor(angsuran)));
      }

      function label_jasa() {
        var jasa = $('#jasa').val();
        $("#label_jasa").html('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Rp&nbsp;&nbsp;&nbsp;&nbsp&nbsp;&nbsp;&nbsp;&nbsp'+formatRupiah(Math.floor(jasa)));
      }

      function label_denda() {
        var denda = $('#denda').val();
        $("#label_denda").html('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Rp&nbsp;&nbsp;&nbsp;&nbsp&nbsp;&nbsp;&nbsp;&nbsp'+formatRupiah(Math.floor(denda)));
      }

      function label_total() {
        var total = $('#total').val();
        $("#label_total").html('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Rp&nbsp;&nbsp;&nbsp;&nbsp&nbsp;&nbsp;&nbsp;&nbsp'+formatRupiah(Math.floor(total)));
      }

      function hitung_denda() {
        var pengali = $('#pengali_jasa_tambahan').val();
        var jasa = parseInt($('#jasa').val());
        var jasa_tambahan = 0;
        console.log(pengali);
        if(pengali == '0') {
          jasa_tambahan = 0;
        } else if(pengali == '1/3') {
          jasa_tambahan = jasa / 3;
          jasa_tambahan = parseInt(jasa_tambahan);
        } else if(pengali == '1/2') {
          jasa_tambahan = jasa / 2;
          jasa_tambahan = parseInt(jasa_tambahan);
        } else if(pengali == '2/3') {
          jasa_tambahan = (2*jasa) / 3;
          jasa_tambahan = parseInt(jasa_tambahan);
        }
        $('#denda').val(jasa_tambahan);
        label_denda();
      }

      function hitung_total() {
        if($('#angsuran').val() != "" && $('#angsuran').val() != NaN && $('#angsuran').val() != null) {
          var angsuran = parseInt($('#angsuran').val());
          console.log(angsuran);
        } else {
          var angsuran = 0;
        }

        if($('#jasa').val() != "" && $('#jasa').val() != NaN && $('#jasa').val() != null) {
          var jasa = parseInt($('#jasa').val());
        } else {
          var jasa = 0;
        }

        if($('#denda').val() != "" && $('#denda').val() != NaN && $('#denda').val() != null) {
          var denda = parseInt($('#denda').val());
        } else {
          var denda = 0;
        }

        var total = angsuran + jasa + denda;
        $('#total').val(total);
        label_total();
      }

      function hitung_jatuh_tempo() {
        var jenis_pinjaman = '<?php echo $pinjaman->jenis_pinjaman ?>';
        var input_waktu = $('#waktu').val();
        if(jenis_pinjaman == 'Angsuran') {
          var waktu = new Date( input_waktu.replace( /(\d{2})-(\d{2})-(\d{4})/, "$2/$1/$3") );
          var tanggal = waktu.setMonth(waktu.getMonth()+1);
          var temp = new Date(tanggal);
          var d = temp.getDate();
          var m = temp.getMonth() + 1;
          var y = temp.getFullYear();
          var jatuh_tempo = (d <= 9 ? '0' + d : d) + '-' + (m <= 9 ? '0' + m : m) + '-' + y;
          $('#jatuh_tempo').val(jatuh_tempo);
        } else if(jenis_pinjaman == 'Musiman') {
          if($('#jenis').val() == 'Pinjaman') {
            var waktu = new Date( input_waktu.replace( /(\d{2})-(\d{2})-(\d{4})/, "$2/$1/$3") );
            var tanggal = waktu.setMonth(waktu.getMonth()+4);
            var temp = new Date(tanggal);
            var d = temp.getDate();
            var m = temp.getMonth() + 1;
            var y = temp.getFullYear();
            var jatuh_tempo = (d <= 9 ? '0' + d : d) + '-' + (m <= 9 ? '0' + m : m) + '-' + y;
            $('#jatuh_tempo').val(jatuh_tempo);
          } else if($('#jenis').val() == 'Pinjaman') {
            $('#jatuh_tempo').val('<?php echo date("d-m-Y", strtotime($pinjaman->jenis_pinjaman)) ?>');
          }
        }
      }

      function getConfirmationDeleteJaminan(id_pinjaman, id_detail_jaminan){
        var retVal = confirm("Apakah anda yakin akan menghapus data tersebut ?");
        var controller = 'transaksianggotacon';
        var base_url = '<?php echo site_url(); //you have to load the "url_helper" to use this function ?>';
        if( retVal == true ){
          window.location.href= base_url + '/' + controller + '/delete_detail_jaminan/' + id_pinjaman + '/' + id_detail_jaminan;
          //console.log(base_url + '/' + controller + '/delete_nasabah/' + id)
        }
      }

      function getConfirmationDeleteScanSuratTagihan(id_pinjaman, id_scan_surat_tagihan){
        var retVal = confirm("Apakah anda yakin akan menghapus data tersebut ?");
        var controller = 'transaksianggotacon';
        var base_url = '<?php echo site_url(); //you have to load the "url_helper" to use this function ?>';
        if( retVal == true ){
          window.location.href= base_url + '/' + controller + '/delete_scan_surat_tagihan/' + id_pinjaman + '/' + id_scan_surat_tagihan;
          //console.log(base_url + '/' + controller + '/delete_nasabah/' + id)
        }
      }

      function getConfirmationDeleteAngsuran(id_pinjaman, id_detail_angsuran){
        var retVal = confirm("Apakah anda yakin akan menghapus data tersebut ?");
        var controller = 'transaksianggotacon';
        var base_url = '<?php echo site_url(); //you have to load the "url_helper" to use this function ?>';
        if( retVal == true ){
          window.location.href= base_url + '/' + controller + '/delete_detail_angsuran/' + id_pinjaman + '/' + id_detail_angsuran;
          //console.log(base_url + '/' + controller + '/delete_nasabah/' + id)
        }
      }

      function tambahAngsuran() {
        document.getElementById("div_tambah_angsuran").style.display = "block";
      }

      function cancelTambahAngsuran() {
        document.getElementById("div_tambah_angsuran").style.display = "none";
      }

      function tambahJaminan() {
        document.getElementById("div_edit_jaminan").style.display = "none";
        document.getElementById("div_tambah_jaminan").style.display = "block";
      }

      function cancelTambahJaminan() {
        document.getElementById("div_tambah_jaminan").style.display = "none";
      }

      function cancelEditJaminan() {
        document.getElementById("div_edit_jaminan").style.display = "none";
      }

      function tambahScanSuratTagihan() {
        document.getElementById("div_tambah_scansurattagihan").style.display = "block";
      }

      function cancelScanSuratTagihan() {
        document.getElementById("div_tambah_scansurattagihan").style.display = "none";
      }

      function editAngsuran(angsuran) {
        //document.getElementById("div_edit_angsuran").style.display = "block";
        console.log(angsuran);
      }

      $(document).ready(function(){
        $('#waktu').datepicker({}).on('changeDate', function(ev){
          hitung_jatuh_tempo();
        });

        $('#jatuh_tempo').datepicker({}).on('changeDate', function(ev){});

        $('#tgl_penerimaan_surat').datepicker({}).on('changeDate', function(ev){});

        hitung_total();
        label_angsuran();
        label_jasa();
        label_denda();
        label_total();

        $('#angsuran').keyup(function() {
          label_angsuran();
          hitung_total();
        });
        $('#jasa').keyup(function() {
          label_jasa();
          hitung_denda();
          hitung_total();
        });
        $('#pengali_jasa_tambahan').change(function() {
          hitung_denda();
          hitung_total();
        });
        $('#denda').keyup(function() {
          label_denda();
          hitung_total();
        });
        $('#total').keyup(function() {
          label_total();
        });

        $('#jenis_jaminan').change(function() {
          if($('#jenis_jaminan').val() == 'sertifikat') {
            document.getElementById("div_merek").style.display = "none";
            document.getElementById("div_jenis").style.display = "none";
            document.getElementById("div_tahun").style.display = "none";
            document.getElementById("div_atas_nama").style.display = "none";
            document.getElementById("div_no_pol").style.display = "none";

            document.getElementById("div_nama_pemilik").style.display = "block";
            document.getElementById("div_no_sertifikat").style.display = "block";
            document.getElementById("div_luas").style.display = "none";
            document.getElementById("div_jenis_tanah").style.display = "block";
            document.getElementById("div_lokasi_tanah").style.display = "block";
          } else if($('#jenis_jaminan').val() == 'bpkb') {
            document.getElementById("div_nama_pemilik").style.display = "none";
            document.getElementById("div_no_sertifikat").style.display = "none";
            document.getElementById("div_luas").style.display = "none";
            document.getElementById("div_jenis_tanah").style.display = "none";
            document.getElementById("div_lokasi_tanah").style.display = "none";

            document.getElementById("div_merek").style.display = "block";
            document.getElementById("div_jenis").style.display = "block";
            document.getElementById("div_tahun").style.display = "block";
            document.getElementById("div_atas_nama").style.display = "block";
            document.getElementById("div_no_pol").style.display = "block";
          }
        });

        $('#edit_jenis_jaminan').change(function() {
          if($('#edit_jenis_jaminan').val() == 'sertifikat') {
            document.getElementById("div_edit_merek").style.display = "none";
            document.getElementById("div_edit_jenis").style.display = "none";
            document.getElementById("div_edit_tahun").style.display = "none";
            document.getElementById("div_edit_atas_nama").style.display = "none";
            document.getElementById("div_edit_no_pol").style.display = "none";

            document.getElementById("div_edit_nama_pemilik").style.display = "block";
            document.getElementById("div_edit_no_sertifikat").style.display = "block";
            document.getElementById("div_edit_luas").style.display = "none";
            document.getElementById("div_edit_jenis_tanah").style.display = "block";
            document.getElementById("div_edit_lokasi_tanah").style.display = "block";
          } else if($('#edit_jenis_jaminan').val() == 'bpkb') {
            document.getElementById("div_edit_nama_pemilik").style.display = "none";
            document.getElementById("div_edit_no_sertifikat").style.display = "none";
            document.getElementById("div_edit_luas").style.display = "none";
            document.getElementById("div_edit_jenis_tanah").style.display = "none";
            document.getElementById("div_edit_lokasi_tanah").style.display = "none";

            document.getElementById("div_edit_merek").style.display = "block";
            document.getElementById("div_edit_jenis").style.display = "block";
            document.getElementById("div_edit_tahun").style.display = "block";
            document.getElementById("div_edit_atas_nama").style.display = "block";
            document.getElementById("div_edit_no_pol").style.display = "block";
          }
        });

        if($('#edit_jenis_jaminan').val() == 'sertifikat') {
          document.getElementById("div_edit_merek").style.display = "none";
          document.getElementById("div_edit_jenis").style.display = "none";
          document.getElementById("div_edit_tahun").style.display = "none";
          document.getElementById("div_edit_atas_nama").style.display = "none";
          document.getElementById("div_edit_no_pol").style.display = "none";

          document.getElementById("div_edit_nama_pemilik").style.display = "block";
          document.getElementById("div_edit_no_sertifikat").style.display = "block";
          document.getElementById("div_edit_luas").style.display = "none";
          document.getElementById("div_edit_jenis_tanah").style.display = "block";
          document.getElementById("div_edit_lokasi_tanah").style.display = "block";
        } else if($('#edit_jenis_jaminan').val() == 'bpkb') {
          document.getElementById("div_edit_nama_pemilik").style.display = "none";
          document.getElementById("div_edit_no_sertifikat").style.display = "none";
          document.getElementById("div_edit_luas").style.display = "none";
          document.getElementById("div_edit_jenis_tanah").style.display = "none";
          document.getElementById("div_edit_lokasi_tanah").style.display = "none";

          document.getElementById("div_edit_merek").style.display = "block";
          document.getElementById("div_edit_jenis").style.display = "block";
          document.getElementById("div_edit_tahun").style.display = "block";
          document.getElementById("div_edit_atas_nama").style.display = "block";
          document.getElementById("div_edit_no_pol").style.display = "block";
        }

      });

    </script>
