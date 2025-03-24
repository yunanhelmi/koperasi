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
                  <?php 
                    $date = strtotime( $pinjaman->waktu );
                    $mydate = date( 'd-m-Y', $date );
                  ?>
                  <!-- <div class="box box-danger">
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
                      </div> -->
                    
                    <div class="box box-danger">
                      <legend style="text-align:center;">DETAIL PINJAMAN</legend>
                      <div class="box-body">
                        <div class="row">
                          <div class="form-group col-xs-2" style="margin-bottom: -3px;">
                            <label for="exampleInputEmail1">Nama Anggota</label>
                          </div>
                          <div class="form-group col-xs-1" style="text-align: right; margin-bottom: -3px;">
                            <label for="exampleInputEmail1">:</label>
                          </div>
                          <div class="form-group col-xs-9" style="margin-bottom: -3px;">
                            <p><?= $pinjaman->nama_nasabah;?></p>
                          </div>
                        </div>
                        <div class="row">
                          <div class="form-group col-xs-2" style="margin-bottom: -3px;">
                            <label for="exampleInputEmail1">Alamat</label>
                          </div>
                          <div class="form-group col-xs-1" style="text-align: right; margin-bottom: -3px;">
                            <label for="exampleInputEmail1">:</label>
                          </div>
                          <div class="form-group col-xs-9" style="margin-bottom: -3px;">
                            <p><?= $pinjaman->kelurahan." ".$pinjaman->dusun;?></p>
                          </div>
                        </div>
                        <div class="row">
                          <div class="form-group col-xs-2" style="margin-bottom: -3px;">
                            <label for="exampleInputEmail1">Jaminan</label>
                          </div>
                          <div class="form-group col-xs-1" style="text-align: right; margin-bottom: -3px;">
                            <label for="exampleInputEmail1">:</label>
                          </div>
                          <div class="form-group col-xs-9" style="margin-bottom: -3px;">
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
                              <p><?= $str_jaminan;?></p>
                          </div>
                        </div>
                        <div class="row">
                          <div class="form-group col-xs-2" style="margin-bottom: -3px;">
                            <label for="exampleInputEmail1">Jenis Pinjaman</label>
                          </div>
                          <div class="form-group col-xs-1" style="text-align: right; margin-bottom: -3px;">
                            <label for="exampleInputEmail1">:</label>
                          </div>
                          <div class="form-group col-xs-9" style="margin-bottom: -3px;">
                            <p><?= $pinjaman->jenis_pinjaman;?></p>
                          </div>
                        </div>
                        <legend></legend>
                        <div class="row">
                          <div class="form-group col-xs-2" style="margin-bottom: -3px;">
                            <label for="exampleInputEmail1">Jumlah Pinjaman Periode Sebelumnya (Musiman)</label>
                          </div>
                          <div class="form-group col-xs-1" style="text-align: right; margin-bottom: -3px;">
                            <label for="exampleInputEmail1">:</label>
                          </div>
                          <div class="form-group col-xs-9" style="margin-bottom: -3px;">
                            <p><?= "Rp " . number_format($pinjaman->jumlah_pinjaman_sebelumnya,2,',','.'); ?></p>
                          </div>
                        </div>
                        <div class="row">
                          <div class="form-group col-xs-2" style="margin-bottom: -3px;">
                            <label for="exampleInputEmail1">Tanggal Pinjaman Periode Sebelumnya (Musiman)</label>
                          </div>
                          <div class="form-group col-xs-1" style="text-align: right; margin-bottom: -3px;">
                            <label for="exampleInputEmail1">:</label>
                          </div>
                          <div class="form-group col-xs-9" style="margin-bottom: -3px;">
                            <p><?= $pinjaman->tanggal_pinjaman_sebelumnya != NULL && $pinjaman->tanggal_pinjaman_sebelumnya != '0000-00-00' ? date('d-m-Y', strtotime($pinjaman->tanggal_pinjaman_sebelumnya)) : ''; ?></p>
                          </div>
                        </div>
                        <div class="row">
                          <div class="form-group col-xs-2" style="margin-bottom: -3px;">
                            <label for="exampleInputEmail1">Jumlah Pinjaman Sekarang</label>
                          </div>
                          <div class="form-group col-xs-1" style="text-align: right; margin-bottom: -3px;">
                            <label for="exampleInputEmail1">:</label>
                          </div>
                          <div class="form-group col-xs-9" style="margin-bottom: -3px;">
                            <p><?= "Rp " . number_format($pinjaman->jumlah_pinjaman,2,',','.'); ?></p>
                          </div>
                        </div>
                        <div class="row">
                          <div class="form-group col-xs-2" style="margin-bottom: -3px;">
                            <label for="exampleInputEmail1">Jumlah Angsuran</label>
                          </div>
                          <div class="form-group col-xs-1" style="text-align: right; margin-bottom: -3px;">
                            <label for="exampleInputEmail1">:</label>
                          </div>
                          <div class="form-group col-xs-9" style="margin-bottom: -3px;">
                            <p><?= $pinjaman->jumlah_angsuran; ?></p>
                          </div>
                        </div>
                        <div class="row">
                          <div class="form-group col-xs-2" style="margin-bottom: -3px;">
                            <label for="exampleInputEmail1">Tanggal Pinjaman</label>
                          </div>
                          <div class="form-group col-xs-1" style="text-align: right; margin-bottom: -3px;">
                            <label for="exampleInputEmail1">:</label>
                          </div>
                          <div class="form-group col-xs-9" style="margin-bottom: -3px;">
                            <p><?= date( 'd-m-Y', strtotime($pinjaman->waktu) ); ?></p>
                          </div>
                        </div>
                        <div class="row">
                          <div class="form-group col-xs-2" style="margin-bottom: -3px;">
                            <label for="exampleInputEmail1">Tanggal Jatuh Tempo</label>
                          </div>
                          <div class="form-group col-xs-1" style="text-align: right; margin-bottom: -3px;">
                            <label for="exampleInputEmail1">:</label>
                          </div>
                          <div class="form-group col-xs-9" style="margin-bottom: -3px;">
                            <p><?= $pinjaman->jatuh_tempo != NULL && $pinjaman->jatuh_tempo != '0000-00-00' ? date( 'd-m-Y', strtotime($pinjaman->jatuh_tempo) ) : ''; ?></p>
                          </div>
                        </div>
                        <legend></legend>
                        <div class="row">
                          <div class="form-group col-xs-2" style="margin-bottom: -3px;">
                            <label for="exampleInputEmail1">Sisa Pinjaman</label>
                          </div>
                          <div class="form-group col-xs-1" style="text-align: right; margin-bottom: -3px;">
                            <label for="exampleInputEmail1">:</label>
                          </div>
                          <div class="form-group col-xs-9" style="margin-bottom: -3px;">
                            <p><?= "Rp " . number_format($pinjaman->sisa_angsuran,2,',','.');?></p>
                          </div>
                        </div>
                        <div class="row">
                          <div class="form-group col-xs-2" style="margin-bottom: -3px;">
                            <label for="exampleInputEmail1">Angsuran Per Bulan</label>
                          </div>
                          <div class="form-group col-xs-1" style="text-align: right; margin-bottom: -3px;">
                            <label for="exampleInputEmail1">:</label>
                          </div>
                          <div class="form-group col-xs-9" style="margin-bottom: -3px;">
                            <p><?= "Rp " . number_format($pinjaman->angsuran_perbulan,2,',','.');?></p>
                          </div>
                        </div>
                        <div class="row">
                          <div class="form-group col-xs-2" style="margin-bottom: -3px;">
                            <label for="exampleInputEmail1">Jasa Per Bulan</label>
                          </div>
                          <div class="form-group col-xs-1" style="text-align: right; margin-bottom: -3px;">
                            <label for="exampleInputEmail1">:</label>
                          </div>
                          <div class="form-group col-xs-9" style="margin-bottom: -3px;">
                            <p><?= "Rp " . number_format($pinjaman->jasa_perbulan,2,',','.');?></p>
                          </div>
                        </div>
                        <div class="row">
                          <div class="form-group col-xs-2" style="margin-bottom: -3px;">
                            <label for="exampleInputEmail1">Total Angsuran Per Bulan</label>
                          </div>
                          <div class="form-group col-xs-1" style="text-align: right; margin-bottom: -3px;">
                            <label for="exampleInputEmail1">:</label>
                          </div>
                          <div class="form-group col-xs-9" style="margin-bottom: -3px;">
                            <p><?= "Rp " . number_format($pinjaman->total_angsuran_perbulan,2,',','.');?></p>
                          </div>
                        </div>
                        <legend></legend>
                        <div class="row">
                          <div class="form-group col-xs-2" style="margin-bottom: -3px;">
                            <label for="exampleInputEmail1">Lama Hari</label>
                          </div>
                          <div class="form-group col-xs-1" style="text-align: right; margin-bottom: -3px;">
                            <label for="exampleInputEmail1">:</label>
                          </div>
                          <div class="form-group col-xs-9" style="margin-bottom: -3px;">
                            <?php
                              if($lama_hari_long != "LUNAS") {
                            ?>
                              <p><?= $lama_hari." (".$lama_hari_long->y." Tahun ".$lama_hari_long->m." Bulan ".$lama_hari_long->d." Hari)";?></p>
                            <?php
                              } else {
                            ?>
                              <p><?= $lama_hari?></p>
                            <?php
                              }
                            ?>
                          </div>
                        </div>
                        <div class="row">
                          <div class="form-group col-xs-2" style="margin-bottom: -3px;">
                            <label for="exampleInputEmail1">Uang Kurang</label>
                          </div>
                          <div class="form-group col-xs-1" style="text-align: right; margin-bottom: -3px;">
                            <label for="exampleInputEmail1">:</label>
                          </div>
                          <div class="form-group col-xs-9" style="margin-bottom: -3px;">
                            <p><?php echo "Rp " . number_format($pinjaman->uang_kurang,2,',','.');?></p>
                          </div>
                        </div>
                        <div class="row">
                          <div class="form-group col-xs-2" style="margin-bottom: -3px;">
                            <label for="exampleInputEmail1">Keterangan</label>
                          </div>
                          <div class="form-group col-xs-1" style="text-align: right; margin-bottom: -3px;">
                            <label for="exampleInputEmail1">:</label>
                          </div>
                          <div class="form-group col-xs-9" style="margin-bottom: -3px;">
                            <p><?= $pinjaman->keterangan; ?></p>
                          </div>
                        </div>
                        <div class="row">
                          <div class="form-group col-xs-2" style="margin-bottom: -3px;">
                            <label for="exampleInputEmail1">Janji</label>
                          </div>
                          <div class="form-group col-xs-1" style="text-align: right; margin-bottom: -3px;">
                            <label for="exampleInputEmail1">:</label>
                          </div>
                          <div class="form-group col-xs-9" style="margin-bottom: -3px;">
                            <p><?= $pinjaman->janji; ?></p>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="box-body">
                      <legend style="text-align:center;">DETAIL ANGSURAN</legend>
                      <div class="table-responsive">
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
                              <th>Jatuh Tempo Sebelum</th>
                              <th>Jatuh Tempo Sesudah</th>
                              <th>Lama Jatuh Tempo</th>
                              <th>Status</th>
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
                              if($detail_angsuran[$i]['jasa'] > 0 && $detail_angsuran[$i]['total'] > 0) {
                            ?>
                            <td style='text-align: left'><?php echo $detail_angsuran[$i]['jenis']?></td>
                            <?php
                              } else if($detail_angsuran[$i]['jasa'] == 0 && $detail_angsuran[$i]['total'] == 0) {
                            ?>
                            <td style='text-align: left'>Penagihan ke-<?php echo $detail_angsuran[$i]['bulan_ke']?></td>
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
                            <td><?php echo $detail_angsuran[$i]['jatuh_tempo_sebelum'] != NULL ? date('d-m-Y', strtotime($detail_angsuran[$i]['jatuh_tempo_sebelum'])) : '';?></td>
                            <td><?php echo $detail_angsuran[$i]['jatuh_tempo_sesudah'] != NULL ? date('d-m-Y', strtotime($detail_angsuran[$i]['jatuh_tempo_sesudah'])) : '';?></td>
                            <td><?php echo $detail_angsuran[$i]['lama_bayar']." Hari"?></td>
                            <?php
                            if ($detail_angsuran[$i]['status_angsuran'] == 'Hijau Tempo') {
                            ?>
                              <td style="background-color: green; text-align: center;"><?php echo $detail_angsuran[$i]['status_angsuran'] ?></td>
                            <?php
                            } else if ($detail_angsuran[$i]['status_angsuran'] == 'Hijau') {
                            ?>
                                <td style="background-color: lightgreen; text-align: center;"><?php echo $detail_angsuran[$i]['status_angsuran'] ?></td>
                            <?php
                            } else if ($detail_angsuran[$i]['status_angsuran'] == 'Kuning 1') {
                            ?>
                              <td style="background-color: yellow; text-align: center;"><?php echo $detail_angsuran[$i]['status_angsuran'] ?></td>
                            <?php
                            } else if ($detail_angsuran[$i]['status_angsuran'] == 'Kuning 2') {
                            ?>
                              <td style="background-color: orange; text-align: center;"><?php echo $detail_angsuran[$i]['status_angsuran'] ?></td>
                            <?php
                            } else if ($detail_angsuran[$i]['status_angsuran'] == 'Merah') {
                            ?>
                              <td style="background-color: red; text-align: center;"><?php echo $detail_angsuran[$i]['status_angsuran'] ?></td>
                            <?php
                            } else {
                            ?>
                              <td><?php echo $detail_angsuran[$i]['status_angsuran']?></td>
                            <?php
                            }
                            ?>
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
                      </div>
                      <br>
                      <div class="form-group col-xs-8">
                      </div>
                      <div class="form-group col-xs-2">
                        <button onclick="tambahPinjaman()" type="submit" class="btn btn-success" style="float: right;">Tambah Pinjaman</button>
                      </div>
                      <div class="form-group col-xs-2">
                        <button onclick="tambahAngsuran()" type="submit" class="btn btn-success" style="float: right;">Tambah Angsuran</button>
                      </div>
                    </div>
                  </div>

                  <div class="box box-danger" id="div_tambah_angsuran" style="display:none">
                    <legend style="text-align:center;" id="judulDetailAngsuran"></legend>
                    <form action="<?php echo base_url()."index.php/transaksianggotacon/insert_detail_angsuran/".$nasabah->id;?>" method="post" enctype="multipart/form-data" id="formTambahDetailAngsuran" role="form">
                    <div class="box-body">
                      <div class="form-group col-xs-6" id="field_ds-waktu">
                        <label for="exampleInputPassword1">Tanggal</label>
                        <div class="input-group date">
                          <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                          </div>
                          <input type="text" class="form-control pull-right" name="waktu" id="waktu" value="" data-date-format="dd-mm-yyyy" required>
                          <input type="hidden" class="form-control" value="<?php echo $pinjaman->id?>" id="id_pinjaman" name="id_pinjaman">
                        </div>
                      </div>
                      <div class="form-group col-xs-6" id="field_ds-jatuh_tempo_sebelum">
                        <label for="exampleInputPassword1">Tanggal Jatuh Tempo Sebelumnya</label>
                        <div class="input-group date">
                          <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                          </div>
                          <input type="text" class="form-control pull-right" name="jatuh_tempo_sebelum" id="jatuh_tempo_sebelum" data-date-format="dd-mm-yyyy">
                        </div>
                      </div>
                      <div class="form-group col-xs-6" id="field_ds-jatuh_tempo_sesudah">
                        <label for="exampleInputPassword1">Tanggal Jatuh Tempo Berikutnya</label>
                        <div class="input-group date">
                          <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                          </div>
                          <input type="text" class="form-control pull-right" name="jatuh_tempo_sesudah" id="jatuh_tempo_sesudah" data-date-format="dd-mm-yyyy">
                        </div>
                      </div>
                      <div class="form-group col-xs-6" id="field_ds-jenis">
                        <label for="exampleInputPassword1">Jenis</label>
                        <select id="jenis" name="jenis" class="form-control" style="width: 100%;">
                          <option value='Angsuran'>Angsuran</option>
                          <option value='Pinjaman'>Pinjaman</option>
                        </select>
                      </div>
                      <div class="form-group col-xs-6" id="field_ds-bulan_ke">
                        <label for="exampleInputPassword1">Bulan ke-</label>
                        <?php $max = $max_bulanke_angsuran + 1;?>
                        <input type="text" class="form-control" value="<?php echo $max?>" id="bulan_ke" name="bulan_ke" placeholder="">
                      </div>
                      <div class="form-group col-xs-6" id="field_ds-angsuran">
                          <label for="exampleInputPassword1">Bulan-Tahun</label>
                          <input type="month" class="form-control" id="bulan_tahun" name="bulan_tahun" placeholder="">
                        </div>
                      <div class="form-group col-xs-6" id="field_ds-bulan_tahun">
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
                      <div class="form-group col-xs-6" id="field_ds-jasa">
                        <label for="exampleInputPassword1">Jasa</label>
                        <div class="input-group margin-bottom-sm">
                          <span class="input-group-addon">Rp</span>
                          <input type="text" class="form-control" id="jasa" name="jasa" placeholder="0">
                        </div>
                        <div id="label_jasa" class="alert-danger"></div>
                      </div>
                      <div class="form-group col-xs-6" id="field_ds-pengali_jasa_tambahan"> 
                        <label for="exampleInputPassword1">Pengali Jasa Tambahan</label>
                        <select id="pengali_jasa_tambahan" name="pengali_jasa_tambahan" class="form-control" style="width: 100%;">
                          <option value='0'>-</option>
                          <option value='1/3'>10 hari</option>
                          <option value='1/2'>15 hari</option>
                          <option value='2/3'>20 hari</option>
                        </select>
                      </div>
                      <div class="form-group col-xs-6" id="field_ds-denda">
                        <label for="exampleInputPassword1">Jasa Tambahan</label>
                        <div class="input-group margin-bottom-sm">
                          <span class="input-group-addon">Rp</span>
                          <input type="text" class="form-control" id="denda" name="denda" placeholder="0">
                        </div>
                        <div id="label_denda" class="alert-danger"></div>
                      </div>
                      <div class="form-group col-xs-6" id="field_ds-total">
                        <label for="exampleInputPassword1">Total</label>
                        <div class="input-group margin-bottom-sm">
                          <span class="input-group-addon">Rp</span>
                          <input type="text" class="form-control" id="total" name="total" placeholder="0">
                        </div>
                        <div id="label_total" class="alert-danger"></div>
                      </div>
                      <div class="form-group col-xs-6" id="field_ds-keterangan">
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

                  <div class="box box-danger" id="div_edit_angsuran">
                    <legend style="text-align:center;"id="judulEditDetailAngsuran"></legend>
                    <form action="<?php echo base_url();?>index.php/transaksianggotacon/update_detail_angsuran" method="post" enctype="multipart/form-data" role="form">
                    <div class="box-body">
                      <div class="form-group col-xs-6" id="field_ds_edit-waktu">
                        <label for="exampleInputPassword1">Tanggal</label>
                        <div class="input-group date">
                          <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                          </div>
                          <?php $date = strtotime($edit_detail_angsuran->waktu);?>
                          <input type="text" class="form-control pull-right" value="<?php echo date("d-m-Y",$date);?>" name="edit_waktu" id="edit_waktu" data-date-format="dd-mm-yyyy" required>
                          <input type="hidden" class="form-control" value="<?php echo $edit_detail_angsuran->id;?>" id="edit_id" name="edit_id">
                          <input type="hidden" class="form-control" value="<?php echo $edit_detail_angsuran->id_pinjaman;?>" id="edit_id_pinjaman" name="edit_id_pinjaman">
                        </div>
                      </div>
                      <div class="form-group col-xs-6" id="field_ds_edit-jatuh_tempo_sebelum">
                        <label for="exampleInputPassword1">Tanggal Jatuh Tempo Sebelumnya</label>
                        <div class="input-group date">
                          <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                          </div>
                          <input type="text" class="form-control pull-right" name="edit_jatuh_tempo_sebelum" id="edit_jatuh_tempo_sebelum" data-date-format="dd-mm-yyyy" value="<?php echo $edit_detail_angsuran->jatuh_tempo_sebelum != NULL ? date("d-m-Y", strtotime($edit_detail_angsuran->jatuh_tempo_sebelum)) : ''?>">
                        </div>
                      </div>
                      <div class="form-group col-xs-6" id="field_ds_edit-jatuh_tempo_sesudah">
                        <label for="exampleInputPassword1">Tanggal Jatuh Tempo Berikutnya</label>
                        <div class="input-group date">
                          <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                          </div>
                          <input type="text" class="form-control pull-right" name="edit_jatuh_tempo_sesudah" id="edit_jatuh_tempo_sesudah" data-date-format="dd-mm-yyyy" value="<?php echo $edit_detail_angsuran->jatuh_tempo_sesudah != NULL ? date("d-m-Y", strtotime($edit_detail_angsuran->jatuh_tempo_sesudah)) : ''?>">
                        </div>
                      </div>
                      <div class="form-group col-xs-6" id="field_ds_edit-jenis">
                        <label for="exampleInputPassword1">Jenis</label>
                        <input type="text" class="form-control" value="<?php echo $edit_detail_angsuran->jenis;?>" id="edit_jenis" name="edit_jenis" placeholder="">
                        <!-- <select id="edit_jenis" name="edit_jenis" class="form-control" style="width: 100%;">
                          <option value='Angsuran' <?php echo $edit_detail_angsuran->jenis == 'Angsuran' ? 'selected' : ''?> >Angsuran</option>
                          <option value='Pinjaman' <?php echo $edit_detail_angsuran->jenis == 'Pinjaman' ? 'selected' : ''?> >Pinjaman</option>
                        </select>-->
                      </div>
                      <div class="form-group col-xs-6" id="field_ds_edit-bulan_ke">
                        <label for="exampleInputPassword1">Bulan ke-</label>
                        <input type="text" class="form-control" value="<?php echo $edit_detail_angsuran->bulan_ke;?>" id="edit_bulan_ke" name="edit_bulan_ke" placeholder="">
                      </div>
                      <div class="form-group col-xs-6" id="field_ds_edit-bulan_tahun">
                        <label for="exampleInputPassword1">Bulan-Tahun</label>
                        <input type="month" class="form-control" value="<?php echo $edit_detail_angsuran->bulan_tahun;?>" id="edit_bulan_tahun" name="edit_bulan_tahun" placeholder="">
                      </div>
                      <div class="form-group col-xs-6" id="field_ds_edit-angsuran">
                        <label for="exampleInputPassword1">Angsuran</label>
                        <div class="input-group margin-bottom-sm">
                          <span class="input-group-addon">Rp</span>
                          <input type="text" class="form-control" value="<?php echo $edit_detail_angsuran->angsuran;?>" id="edit_angsuran" name="edit_angsuran" placeholder="0">
                        </div>
                        <div id="label_edit_angsuran" class="alert-danger"></div>
                      </div>
                      <div class="form-group col-xs-6" id="field_ds_edit-jasa">
                        <label for="exampleInputPassword1">Jasa</label>
                        <div class="input-group margin-bottom-sm">
                          <span class="input-group-addon">Rp</span>
                          <input type="text" class="form-control" value="<?php echo $edit_detail_angsuran->jasa;?>" id="edit_jasa" name="edit_jasa" placeholder="0">
                        </div>
                        <div id="label_edit_jasa" class="alert-danger"></div>
                      </div>
                      <div class="form-group col-xs-6" id="field_ds_edit-pengali_jasa_tambahan">
                        <label for="exampleInputPassword1">Pengali Jasa Tambahan</label>
                        <select id="edit_pengali_jasa_tambahan" name="edit_pengali_jasa_tambahan" class="form-control" style="width: 100%;">
                          <option value='0'>-</option>
                          <option value='1/3'>10 hari</option>
                          <option value='1/2'>15 hari</option>
                          <option value='2/3'>20 hari</option>
                        </select>
                      </div>
                      <div class="form-group col-xs-6" id="field_ds_edit-denda">
                        <label for="exampleInputPassword1">Jasa Tambahan</label>
                        <div class="input-group margin-bottom-sm">
                          <span class="input-group-addon">Rp</span>
                          <input type="text" class="form-control" value="<?php echo $edit_detail_angsuran->denda;?>" id="edit_denda" name="edit_denda" placeholder="0">
                        </div>
                        <div id="label_edit_denda" class="alert-danger"></div>
                      </div>
                      <div class="form-group col-xs-6">
                        <label for="exampleInputPassword1">Total</label>
                        <div class="input-group margin-bottom-sm">
                          <span class="input-group-addon">Rp</span>
                          <input type="text" class="form-control" value="<?php echo $edit_detail_angsuran->total;?>" id="edit_total" name="edit_total" placeholder="0">
                        </div>
                        <div id="label_edit_total" class="alert-danger"></div>
                      </div>
                      <div class="form-group col-xs-6">
                        <label for="exampleInputPassword1">Keterangan</label>
                        <!-- <input type="text" class="form-control" id="edit_keterangan" name="edit_keterangan" placeholder="" value="<?php echo $edit_detail_angsuran->keterangan ?>"> -->
                        <textarea class="form-control" id="edit_keterangan" name="edit_keterangan" placeholder="Keterangan"><?php echo $edit_detail_angsuran->keterangan ?></textarea>
                      </div>
                    </div>
                    <div class="box-footer">
                        <div class="col-xs-3">
                          <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                      </div>
                    </form>
                  </div>
                  <br>
                  <br>
                  <div class="box box-danger">
                    <legend style="text-align:center;">DETAIL PENAGIHAN</legend>
                    <table id="detail_penagihan_table" class="table table-bordered table-hover"  width="100%">
                      <thead>
                        <tr>
                          <th>No.</th>
                          <th>Waktu</th>
                          <th>Penagihan Ke-</th>
                          <th>Keterangan</th>
                          <th>Janji</th>
                          <th>Follow Up Janji</th>
                          <th>Durasi</th>
                          <th>Edit</th>
                          <th>Delete</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                          $no = 1;
                          foreach($detail_penagihan as $dp):
                        ?>
                          <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $dp['waktu']; ?></td>
                            <td><?= $dp['penagihan_ke']; ?></td>
                            <td><?= $dp['keterangan']; ?></td>
                            <td><?= $dp['janji']; ?></td>
                            <td><?= $dp['followup']; ?></td>
                            <?php 
                              $today = new Datetime(date('Y-m-d'));
                              $waktu_penagihan = new Datetime(date('Y-m-d', strtotime($dp['waktu'])));
                              if($today < $waktu_penagihan) {
                                $durasi = $today->diff($waktu_penagihan)->format("%a") * -1;
                              } else {
                                $durasi = $today->diff($waktu_penagihan)->format("%a");
                              }
                            ?>
                            <td><?= $durasi.' Hari' ?></td>
                            <td>
                              <button class="btn btn-warning btn-sm" onclick="editDetailPenagihan(<?= $dp['id']; ?>)"><i class="fa fa-pencil-square-o"></i></button>
                            </td>
                            <td style='text-align: center'>
                              <a href="<?= site_url('transaksianggotacon/delete_detail_penagihan/'.$dp['id_pinjaman'].'/'.$dp['id']); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Hapus data ini?')"><i class="fa fa-trash-o"></i></a>
                            </td>
                          </tr>
                        <?php
                          endforeach;
                        ?>
                      </tbody>
                    </table>
                    <br>
                    <div class="form-group col-xs-12">
                      <button class="btn btn-success" data-toggle="modal" data-target="#modalDetailPenagihan" style="float: right;" onclick="resetFormDetailPenagihan()">Tambah Detail Penagihan</button>
                    </div>
                    <!-- Modal Detail Penagihan-->
                    <div class="modal fade" id="modalDetailPenagihan" tabindex="-1" aria-labelledby="titleModalDetailPenagihan" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" style="text-align: center" id="titleModalDetailPenagihan">TAMBAH DETAIL PENAGIHAN</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="<?= site_url('transaksianggotacon/insert_detail_penagihan'); ?>" method="post" id="formDetailPenagihan">
                                    <div class="modal-body">
                                        <input type="hidden" name="detail_penagihan-id" id="detail_penagihan-id">
                                        <div class="form-group">
                                            <label>Waktu</label>
                                            <input type="date" name="detail_penagihan-waktu" id="detail_penagihan-waktu" class="form-control" required>
                                            <input type="hidden" name="detail_penagihan-id_pinjaman" id="detail_penagihan-id_pinjaman" value="<?= $pinjaman->id ?>" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label>Penagihan Ke-</label>
                                            <input type="text" name="detail_penagihan-penagihan_ke" id="detail_penagihan-penagihan_ke" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label>Janji</label>
                                            <input type="date" name="detail_penagihan-janji" id="detail_penagihan-janji" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label>Follow Up Janji</label>
                                            <input type="date" name="detail_penagihan-followup" id="detail_penagihan-followup" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label>Keterangan</label>
                                            <textarea name="detail_penagihan-keterangan" id="detail_penagihan-keterangan" class="form-control"></textarea>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                  </div>
                  <br>
                  <br>
                  <!--
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
                -->
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
                      <td></td>
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

  /*$(function () {
    $('#pinjaman_table').DataTable({
      'paging'      : true,
      'lengthChange': true,
      'searching'   : true,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : true
    })
  })

  $(function () {
    $('#simpananpokok_table').DataTable({
      'paging'      : true,
      'lengthChange': true,
      'searching'   : true,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : true
    })
  })

  $(function () {
    $('#simpananwajib_table').DataTable({
      'paging'      : true,
      'lengthChange': true,
      'searching'   : true,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : true
    })
  })

  $(function () {
    $('#simpanankhusus_table').DataTable({
      'paging'      : true,
      'lengthChange': true,
      'searching'   : true,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : true
    })
  })

  $(function () {
    $('#simpanandanasosial_table').DataTable({
      'paging'      : true,
      'lengthChange': true,
      'searching'   : true,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : true
    })
  })

  $(function () {
    $('#simpanankanzun_table').DataTable({
      'paging'      : true,
      'lengthChange': true,
      'searching'   : true,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : true
    })
  })

  $(function () {
    $('#simpanan3th_table').DataTable({
      'paging'      : true,
      'lengthChange': true,
      'searching'   : true,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : true
    })
  })

  $(function () {
    $('#simpananpihakketiga_table').DataTable({
      'paging'      : true,
      'lengthChange': true,
      'searching'   : true,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : true
    })
  })*/
  </script>

  <script type="text/javascript">
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

      function label_edit_angsuran() {
        var angsuran = $('#edit_angsuran').val();
        $("#label_edit_angsuran").html('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Rp&nbsp;&nbsp;&nbsp;&nbsp&nbsp;&nbsp;&nbsp;&nbsp'+formatRupiah(Math.floor(angsuran)));
      }

      function label_edit_jasa() {
        var jasa = $('#edit_jasa').val();
        $("#label_edit_jasa").html('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Rp&nbsp;&nbsp;&nbsp;&nbsp&nbsp;&nbsp;&nbsp;&nbsp'+formatRupiah(Math.floor(jasa)));
      }

      function label_edit_denda() {
        var denda = $('#edit_denda').val();
        $("#label_edit_denda").html('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Rp&nbsp;&nbsp;&nbsp;&nbsp&nbsp;&nbsp;&nbsp;&nbsp'+formatRupiah(Math.floor(denda)));
      }

      function label_edit_total() {
        var total = $('#edit_total').val();
        $("#label_edit_total").html('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Rp&nbsp;&nbsp;&nbsp;&nbsp&nbsp;&nbsp;&nbsp;&nbsp'+formatRupiah(Math.floor(total)));
      }

      function hitung_edit_denda() {
        var pengali = $('#edit_pengali_jasa_tambahan').val();
        var jasa = parseInt($('#edit_jasa').val());
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
        $('#edit_denda').val(jasa_tambahan);
        label_edit_denda();
      }

      function hitung_edit_total() {
        if($('#edit_angsuran').val() != "" && $('#edit_angsuran').val() != NaN && $('#edit_angsuran').val() != null) {
          var angsuran = parseInt($('#edit_angsuran').val());
        } else {
          var angsuran = 0;
        }

        if($('#edit_jasa').val() != "" && $('#edit_jasa').val() != NaN && $('#edit_jasa').val() != null) {
          var jasa = parseInt($('#edit_jasa').val());
        } else {
          var jasa = 0;
        }

        if($('#edit_denda').val() != "" && $('#edit_denda').val() != NaN && $('#edit_denda').val() != null) {
          var denda = parseInt($('#edit_denda').val());
        } else {
          var denda = 0;
        }

        var total = angsuran + jasa + denda;
        $('#edit_total').val(total);
        label_edit_total();
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

      function hitung_edit_jatuh_tempo() {
        var jenis_pinjaman = '<?php echo $pinjaman->jenis_pinjaman ?>';
        var input_waktu = $('#edit_waktu').val();
        if(jenis_pinjaman == 'Angsuran') {
          var waktu = new Date( input_waktu.replace( /(\d{2})-(\d{2})-(\d{4})/, "$2/$1/$3") );
          var tanggal = waktu.setMonth(waktu.getMonth()+1);
          var temp = new Date(tanggal);
          var d = temp.getDate();
          var m = temp.getMonth() + 1;
          var y = temp.getFullYear();
          var jatuh_tempo = (d <= 9 ? '0' + d : d) + '-' + (m <= 9 ? '0' + m : m) + '-' + y;
          $('#edit_jatuh_tempo').val(jatuh_tempo);
        } else if(jenis_pinjaman == 'Musiman') {
          if($('#edit_jenis').val() == 'Pinjaman') {
            var waktu = new Date( input_waktu.replace( /(\d{2})-(\d{2})-(\d{4})/, "$2/$1/$3") );
            var tanggal = waktu.setMonth(waktu.getMonth()+4);
            var temp = new Date(tanggal);
            var d = temp.getDate();
            var m = temp.getMonth() + 1;
            var y = temp.getFullYear();
            var jatuh_tempo = (d <= 9 ? '0' + d : d) + '-' + (m <= 9 ? '0' + m : m) + '-' + y;
            $('#edit_jatuh_tempo').val(jatuh_tempo);
          } else if($('#edit_jenis').val() == 'Pinjaman') {
            $('#edit_jatuh_tempo').val('<?php echo date("d-m-Y", strtotime($pinjaman->jenis_pinjaman)) ?>');
          }
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

      function getConfirmationDeleteScanSuratTagihan(id_pinjaman, id_scan_surat_tagihan){
        var retVal = confirm("Apakah anda yakin akan menghapus data tersebut ?");
        var controller = 'transaksianggotacon';
        var base_url = '<?php echo site_url(); //you have to load the "url_helper" to use this function ?>';
        if( retVal == true ){
          window.location.href= base_url + '/' + controller + '/delete_scan_surat_tagihan/' + id_pinjaman + '/' + id_scan_surat_tagihan;
          //console.log(base_url + '/' + controller + '/delete_nasabah/' + id)
        }
      }

      /*function tambahAngsuran() {
        document.getElementById("div_edit_angsuran").style.display = "none";
        document.getElementById("div_tambah_angsuran").style.display = "block";
      }*/

      function tambahAngsuran() {
        $('#formTambahDetailAngsuran')[0].reset();
        document.getElementById("judulDetailAngsuran").innerText = "TAMBAH DETAIL (ANGSURAN)";
        $('#id_pinjaman').val(<?= $pinjaman->id ?>);
        $('#jenis').val("Angsuran");
        $('#jasa').val(<?= $pinjaman->jasa_perbulan ?>);
        document.getElementById("jenis").disabled = true;
        document.getElementById("field_ds-bulan_ke").style.display = 'block';
        document.getElementById("field_ds-bulan_tahun").style.display = 'block';
        document.getElementById("field_ds-angsuran").style.display = 'block';
        document.getElementById("field_ds-jasa").style.display = 'block';
        document.getElementById("field_ds-pengali_jasa_tambahan").style.display = 'block';
        document.getElementById("field_ds-denda").style.display = 'block';
        hitung_total();
        label_total();
        document.getElementById("div_tambah_angsuran").style.display = "block";
      }

      function tambahPinjaman() {
        $('#formTambahDetailAngsuran')[0].reset();
        document.getElementById("judulDetailAngsuran").innerText = "TAMBAH DETAIL (PINJAMAN)";
        $('#jenis').val("Pinjaman");
        document.getElementById("jenis").disabled = true;
        document.getElementById("field_ds-bulan_ke").style.display = 'none';
        document.getElementById("field_ds-bulan_tahun").style.display = 'none';
        document.getElementById("field_ds-angsuran").style.display = 'none';
        label_total();
        document.getElementById("field_ds-jasa").style.display = 'none';
        document.getElementById("field_ds-pengali_jasa_tambahan").style.display = 'none';
        document.getElementById("field_ds-denda").style.display = 'none';
        document.getElementById("div_tambah_angsuran").style.display = "block";
      }

      function cancelTambahAngsuran() {
        document.getElementById("div_tambah_angsuran").style.display = "none";
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

      function resetFormDetailPenagihan() {
          $('#formDetailPenagihan')[0].reset();
          document.getElementById("titleModalDetailPenagihan").innerText = "TAMBAH DETAIL PENAGIHAN";
          $('#formDetailPenagihan').attr('action', '<?= site_url('transaksianggotacon/insert_detail_penagihan'); ?>');
      }

      function editDetailPenagihan(id) {
          $.getJSON("<?= site_url('transaksianggotacon/edit_detail_penagihan/'); ?>" + id, function(data) {
              $('#detail_penagihan-id').val(data.id);
              $('#detail_penagihan-waktu').val(data.waktu);
              $('#detail_penagihan-id_pinjaman').val(data.id_pinjaman);
              $('#detail_penagihan-penagihan_ke').val(data.penagihan_ke);
              $('#detail_penagihan-janji').val(data.janji);
              $('#detail_penagihan-followup').val(data.followup);
              $('#detail_penagihan-keterangan').val(data.keterangan);
              document.getElementById("titleModalDetailPenagihan").innerText = "EDIT DETAIL PENAGIHAN";
              $('#formDetailPenagihan').attr('action', '<?= site_url('transaksianggotacon/update_detail_penagihan'); ?>');
              $('#modalDetailPenagihan').modal('show');
          });
      }

      $(document).ready(function(){
        console.log('document_ready');
        $('#waktu').datepicker({}).on('changeDate', function(ev){
          hitung_jatuh_tempo();
        });
        $('#jatuh_tempo').datepicker({}).on('changeDate', function(ev){});
        $('#jatuh_tempo_sebelum').datepicker({}).on('changeDate', function(ev){});
        $('#jatuh_tempo_sesudah').datepicker({}).on('changeDate', function(ev){});

        $('#edit_waktu').datepicker({}).on('changeDate', function(ev){
          hitung_edit_jatuh_tempo();
        });
        
        $('#edit_jatuh_tempo').datepicker({}).on('changeDate', function(ev){});
        $('#edit_jatuh_tempo_sebelum').datepicker({}).on('changeDate', function(ev){});
        $('#edit_jatuh_tempo_sesudah').datepicker({}).on('changeDate', function(ev){});

        $('#tgl_penerimaan_surat').datepicker({}).on('changeDate', function(ev){});

        $('#janji').datepicker({}).on('changeDate', function(ev){});
        $('#penagihan').datepicker({}).on('changeDate', function(ev){});
        $('#followup').datepicker({}).on('changeDate', function(ev){});
        
        $('#edit_janji').datepicker({}).on('changeDate', function(ev){});
        $('#edit_penagihan').datepicker({}).on('changeDate', function(ev){});
        $('#edit_followup').datepicker({}).on('changeDate', function(ev){});

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

        label_edit_angsuran();
        label_edit_jasa();
        label_edit_denda();
        label_edit_total();

        $('#edit_angsuran').keyup(function() {
          label_edit_angsuran();
          hitung_edit_total();
        });
        $('#edit_jasa').keyup(function() {
          label_edit_jasa();
          hitung_edit_denda();
          hitung_edit_total();
        });
        $('#edit_pengali_jasa_tambahan').change(function() {
          hitung_edit_denda();
          hitung_edit_total();
        });
        $('#edit_denda').keyup(function() {
          label_edit_denda();
          hitung_edit_total();
        });
        $('#edit_total').keyup(function() {
          label_edit_total();
        });

        $('#jenis').change(function() {
          hitung_jatuh_tempo();
        });

        $('#edit_jenis').change(function() {
          hitung_edit_jatuh_tempo();
        });

        if($('#edit_jenis').val() == 'Pinjaman') {
          document.getElementById("judulEditDetailAngsuran").innerText = "EDIT DETAIL (PINJAMAN)";
          document.getElementById("edit_jenis").readOnly = true;
          document.getElementById("field_ds_edit-bulan_ke").style.display = 'none';
          document.getElementById("field_ds_edit-bulan_tahun").style.display = 'none';
          document.getElementById("field_ds_edit-angsuran").style.display = 'none';
          label_edit_total();
          document.getElementById("field_ds_edit-jasa").style.display = 'none';
          document.getElementById("field_ds_edit-pengali_jasa_tambahan").style.display = 'none';
          document.getElementById("field_ds_edit-denda").style.display = 'none';
        } else if($('#edit_jenis').val() == 'Angsuran') {
          document.getElementById("judulEditDetailAngsuran").innerText = "EDIT DETAIL (ANGSURAN)";
          document.getElementById("edit_jenis").readOnly = true;
        }
      });

    </script>
