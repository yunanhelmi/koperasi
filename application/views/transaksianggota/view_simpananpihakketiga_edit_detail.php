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
        <li><a href="<?php echo base_url()."index.php/transaksianggotacon/simpananpihakketiga/".$nasabah->id; ?>" ><i class="fa fa-credit-card"></i> Simpanan Pihak Ketiga</a></li>
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
            <li><a href="#pinjaman" data-toggle="tab">Pinjaman</a></li>
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
            <li class="active"><a href="#simpanan_pihak_ketiga" data-toggle="tab">Simpanan Pihak Ketiga</a></li>
            <li><a href="#aset_kekayaan" data-toggle="tab">Aset Kekayaan</a></li>
            <li><a href="#berkas" data-toggle="tab">Scan Berkas</a></li>
          </ul>
          <div class="tab-content">
            <div class="tab-pane" id="pinjaman">
              <div class="box-header" style="text-align:left" >
                <h3>
                  <a class="btn btn-primary btn-success" href="<?php echo site_url("transaksianggotacon/create_pinjaman/".$nasabah->id); ?>">Tambahkan Pinjaman Baru</a>
                </h3>
              </div> 
              <div class="box-body">
                <div class="table-responsive">
                  <table id="pinjaman_table" class="table table-bordered table-hover"  width="100%">
                    <thead>
                      <tr>
                        <th></th>
                        <th>No.</th>
                        <th>Nama</th>
                        <th>Jenis Pinjaman</th>
                        <th>Tanggal Pinjam</th>
                        <th>Jaminan</th>
                        <th>Jatuh Tempo</th>
                        <th>Keterangan</th>
                        <th>Status Pinjaman</th>
                        <th>Jumlah Pinjaman</th>
                        <th>Sisa Pinjaman</th>
                        <th>Jumlah Angsuran</th>
                        <th>Uang Kurang</th>
                        <th>View</th>
                        <th>Edit</th>
                        <th>Delete</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                        $no = 1;
                        $total_pinjaman = 0;
                        $total_sisa = 0;
                        //$total_angsuran = 0;
                        for($i = 0; $i < sizeof($pinjaman); $i++) {
                      ?>
                      <tr <?php echo $pinjaman[$i]['sisa_angsuran'] == 0 ? "style='background-color: #EEEEEE'" : "style='background-color: #90EE90'" ?>>
                        <td>
                            <button class="btn btn-info toggle-detail-pinjaman">
                                <i class="fa fa-plus"></i>
                            </button>
                        </td>
                        <td style='text-align: center'><?php echo $no."."?></td>
                        <td><?php echo $pinjaman[$i]['nama_nasabah']?></td>
                        <td><?php echo $pinjaman[$i]['jenis_pinjaman']?></td>
                        <?php $waktu = strtotime($pinjaman[$i]['waktu'])?>
                        <td><?php echo date("d-m-Y", $waktu)?></td>
                        <?php
                          $jaminan = json_decode($pinjaman[$i]['jaminan']);
                          $test = @json_decode($pinjaman[$i]['jaminan']);
                          if ($test)  {
                            $str_jaminan = '';
                            for($a = 0; $a < sizeof($jaminan); $a++) {
                              $str_jaminan .= $jaminan[$a]->keterangan;
                              $str_jaminan .= '; ';
                            }
                            $str_jaminan = substr($str_jaminan, 0, -2);
                          } else {
                            $str_jaminan = $pinjaman[$i]['jaminan'];
                          }
                          
                        ?>
                        <td><?php echo $str_jaminan?></td>
                        <?php $jatuh_tempo = strtotime($pinjaman[$i]['jatuh_tempo'])?>
                        <td><?php echo date("d-m-Y", $jatuh_tempo)?></td>
                        <td><?php echo $pinjaman[$i]['keterangan']?></td>
                        <td><?php echo $pinjaman[$i]['status_pinjaman']?></td>
                        <td><?php echo rupiah($pinjaman[$i]['jumlah_pinjaman'])?></td>
                        <td><?php echo $pinjaman[$i]['sisa_angsuran'] > 0 ? rupiah($pinjaman[$i]['sisa_angsuran']) : rupiah($pinjaman[$i]['sisa_angsuran'])." (LUNAS)" ?></td>
                        <td><?php echo $pinjaman[$i]['jumlah_angsuran']?></td>
                        <td><?php echo rupiah($pinjaman[$i]['uang_kurang'])?></td>
                        <td style='text-align: center'><a class="btn btn-primary" href="<?php echo site_url("transaksianggotacon/view_pinjaman/".$pinjaman[$i]['id']); ?>"><i class="fa fa-eye"></i></a></td>
                        <td style='text-align: center'><a class="btn btn-warning" href="<?php echo site_url("transaksianggotacon/edit_pinjaman/".$pinjaman[$i]['id']); ?>"><i class="fa fa-pencil-square-o"></i></a></td>
                        <td style='text-align: center'><a class="btn btn-danger" onClick="getConfirmationPinjaman('<?php echo $pinjaman[$i]['id']?>');"><i class="fa fa-trash-o"></i></a></td>
                      </tr>
                      <tr class="detail-pinjaman-row" style="display: none;">
                          <td colspan="16" style="text-align: left">
                              <strong>Hijau:</strong> <?php echo $pinjaman[$i]['jumlah_hijau'] ?><br>
                              <strong>Hijau Tempo:</strong> <?php echo $pinjaman[$i]['jumlah_hijau_tempo'] ?><br>
                              <strong>Kuning 1:</strong> <?php echo $pinjaman[$i]['jumlah_hijau_kuning1'] ?><br>
                              <strong>Kuning 2:</strong> <?php echo $pinjaman[$i]['jumlah_hijau_kuning2'] ?><br>
                              <strong>Merah:</strong> <?php echo $pinjaman[$i]['jumlah_hijau_merah'] ?><br>
                          </td>
                      </tr>
                      <?php 
                          $no++;
                          $total_pinjaman += $pinjaman[$i]['jumlah_pinjaman'];
                          $total_sisa += $pinjaman[$i]['sisa_angsuran'];
                          //$total_angsuran += $pinjaman[$i]['jumlah_angsuran'];
                        }
                      ?>
                      <tr>
                        <td colspan="8"><strong>Total</strong></td>
                        <td><strong><?php echo rupiah($total_pinjaman) ?></strong></td>
                        <td><strong><?php echo rupiah($total_sisa) ?></strong></td>
                        <!--<td><strong><?php echo rupiah($total_angsuran) ?></strong></td>-->
                      </tr>
                    </tbody>
                  </table>
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


            <div class="active tab-pane" id="simpanan_pihak_ketiga">
              

              <div class="row">
                <div class="col-md-12 pull-left">
                  <div class="box box-danger" id="div_tambah_detail_simpananpihakketiga" style="display:none">
                    <legend style="text-align:center;">TAMBAH DETAIL SIMPANAN PIHAK KETIGA</legend>
                    <form action="<?php echo base_url();?>index.php/transaksianggotacon/insert_detail_simpananpihakketiga" method="post" enctype="multipart/form-data" role="form">
                      <div class="box-body">
                        <div class="form-group col-xs-6">
                          <label for="exampleInputPassword1">Tanggal</label>
                          <div class="input-group date">
                            <div class="input-group-addon">
                              <i class="fa fa-calendar"></i>
                            </div>
                            <input type="text" class="form-control pull-right" name="waktu" id="waktu" value="" data-date-format="dd-mm-yyyy" required>
                            <input type="hidden" class="form-control" value="<?php echo $simpananpihakketiga->id?>" id="id_simpananpihakketiga" name="id_simpananpihakketiga">
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
                          <label for="exampleInputPassword1">Bulan-Tahun</label>
                          <input type="month" class="form-control" id="bulan_tahun" name="bulan_tahun" placeholder="">
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
                      <div class="form-group col-xs-6">
                        <label for="exampleInputPassword1">Keterangan</label>
                        <!-- <input type="text" class="form-control" id="keterangan" name="keterangan" placeholder=""> -->
                        <textarea class="form-control" id="keterangan" name="keterangan" placeholder="Keterangan"></textarea>
                      </div>
                      <div class="box-footer">
                        <div class="col-xs-3">
                          <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                        <div class="col-xs-3">
                          <button type="button" onclick="cancelTambahDetailSimpananPihakKetiga()" class="btn btn-warning">Batal</button>
                        </div>
                      </div>
                    </form>
                  </div>
                  <div class="box box-danger" id="div_edit_detail_simpananpihakketiga">
                    <legend style="text-align:center;">EDIT DETAIL SIMPANAN PIHAK KETIGA</legend>
                    <form action="<?php echo base_url();?>index.php/transaksianggotacon/update_detail_simpananpihakketiga" method="post" enctype="multipart/form-data" role="form">
                      <div class="box-body">
                        <div class="form-group col-xs-6">
                          <label for="exampleInputPassword1">Tanggal</label>
                          <div class="input-group date">
                            <div class="input-group-addon">
                              <i class="fa fa-calendar"></i>
                            </div>
                            <?php 
                              $tgl = strtotime($edit_detail_simpananpihakketiga->waktu);
                            ?>
                            <input type="text" class="form-control pull-right" name="edit_waktu" id="edit_waktu" value="<?php echo date("d-m-Y", $tgl);?>" data-date-format="dd-mm-yyyy">
                            <input type="hidden" class="form-control" value="<?php echo $edit_detail_simpananpihakketiga->id?>" id="edit_id" name="edit_id">
                            <input type="hidden" class="form-control" value="<?php echo $edit_detail_simpananpihakketiga->id_simpananpihakketiga?>" id="edit_id_simpananpihakketiga" name="edit_id_simpananpihakketiga">
                          </div>
                        </div>
                        <div class="form-group col-xs-6">
                          <label for="exampleInputPassword1">Jenis</label>
                          <select id="edit_jenis" name="edit_jenis" class="form-control" style="width: 100%;">
                            <option value='Setoran' <?php echo $edit_detail_simpananpihakketiga->jenis == 'Setoran' ? 'selected' : ''?> >Setoran</option>
                            <option value='Tarikan' <?php echo $edit_detail_simpananpihakketiga->jenis == 'Tarikan' ? 'selected' : ''?> >Tarikan</option>
                          </select>
                        </div>
                        <div class="form-group col-xs-6">
                          <label for="exampleInputPassword1">Bulan-Tahun</label>
                          <input type="month" class="form-control" value="<?php echo $edit_detail_simpananpihakketiga->bulan_tahun?>" id="edit_bulan_tahun" name="edit_bulan_tahun" placeholder="">
                        </div>
                        <div class="form-group col-xs-6">
                          <label for="exampleInputPassword1">Jumlah</label>
                          <div class="input-group margin-bottom-sm">
                            <span class="input-group-addon">Rp</span>
                            <input type="text" class="form-control" value="<?php echo $edit_detail_simpananpihakketiga->jumlah?>" id="edit_jumlah" name="edit_jumlah" placeholder="0">
                          </div>
                          <div id="label_edit_jumlah" class="alert-danger"></div>
                        </div>
                      </div>
                      <div class="form-group col-xs-6">
                        <label for="exampleInputPassword1">Keterangan</label>
                        <!-- <input type="text" class="form-control" value="<?php echo $edit_detail_simpananpihakketiga->keterangan?>" id="edit_keterangan" name="edit_keterangan"> -->
                        <textarea class="form-control" id="edit_keterangan" name="edit_keterangan" placeholder="Keterangan"><?php echo $edit_detail_simpananpihakketiga->keterangan?></textarea>
                      </div>
                      <div class="box-footer">
                        <div class="col-xs-3">
                          <button type="submit" class="btn btn-primary">Update</button>
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
                        <div class="form-group col-xs-6">
                          <label for="exampleInputPassword1">Keterangan</label>
                          <!-- <input type="text" class="form-control" id="jasa_keterangan" name="jasa_keterangan" placeholder=""> -->
                          <textarea class="form-control" id="jasa_keterangan" name="jasa_keterangan" placeholder="Keterangan"></textarea>
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
                      <div class="form-group col-xs-4">
                        <label for="exampleInputEmail1">Nama Anggota</label>
                        <p><?php echo $simpananpihakketiga->nama;?></p>
                      </div>
                      <div class="form-group col-xs-4">
                          <label for="exampleInputEmail1">Nomor Anggota</label>
                          <p><?php echo $simpananpihakketiga->nomor_nasabah;?></p>
                      </div>
                      <div class="form-group col-xs-4">
                          <label for="exampleInputEmail1">NIK Anggota</label>
                          <p><?php echo $simpananpihakketiga->nik;?></p>
                      </div>
                      <div class="form-group col-xs-4">
                        <label for="exampleInputPassword1">Tanggal</label>
                        <?php 
                          $date = strtotime( $simpananpihakketiga->waktu );
                          $mydate = date( 'd-m-Y', $date );
                        ?>
                        <p><?php echo $mydate;?></p>
                      </div>
                      <div class="form-group col-xs-4">
                        <label for="exampleInputPassword1">Total</label>
                        <p><?php echo "Rp " . number_format($simpananpihakketiga->total,2,',','.');?></p>
                      </div>
                      <div class="form-group col-xs-4">
                        <label for="exampleInputPassword1">Total Jasa</label>
                        <p><?php echo "Rp " . number_format($simpananpihakketiga->jasa_total,2,',','.');?></p>
                      </div>
                    </div>
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
                            <th>Jenis</th>
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
                            for($i = 0; $i < sizeof($detail_simpananpihakketiga); $i++) {
                          ?>
                          <tr>
                            <td style='text-align: center'><?php echo $no."."?></td>
                            <?php 
                              $date = strtotime( $detail_simpananpihakketiga[$i]['waktu'] );
                              $tanggal = date( 'd-m-Y', $date );
                              $bln_thn = strtotime( $detail_simpananpihakketiga[$i]['bulan_tahun'] );
                              $bulan_tahun = date( 'M-Y', $bln_thn );
                            ?>
                            <td><?php echo $tanggal;?></td>
                            <?php
                              if($detail_simpananpihakketiga[$i]['jenis'] == 'Setoran') {
                                $total_debet += $detail_simpananpihakketiga[$i]['jumlah'];
                            ?>
                            <td style='text-align: left'>Setoran Bulan <?php echo $bulan_tahun;?></td>
                            <td style='text-align: left'><?php echo $detail_simpananpihakketiga[$i]['keterangan'];?></td>
                            <td style='text-align: right'><?php echo "Rp " . number_format($detail_simpananpihakketiga[$i]['jumlah'],2,',','.');?></td>
                            <td style='text-align: right'><?php echo "Rp " . number_format(0,2,',','.');?></td>
                            <?php
                              } else if($detail_simpananpihakketiga[$i]['jenis'] == 'Tarikan') {
                                $total_kredit += $detail_simpananpihakketiga[$i]['jumlah'];
                            ?>
                            <td style='text-align: left'>Tarikan</td>
                            <td style='text-align: left'><?php echo $detail_simpananpihakketiga[$i]['keterangan'];?></td>
                            <td style='text-align: right'><?php echo "Rp " . number_format(0,2,',','.');?></td>
                            <td style='text-align: right'><?php echo "Rp " . number_format($detail_simpananpihakketiga[$i]['jumlah'],2,',','.');?></td>
                            <?php
                              }
                              $sisa_simpanan[$i] = $total_debet - $total_kredit;
                            ?>
                            <td style='text-align: right'><?php echo "Rp " . number_format($sisa_simpanan[$i],2,',','.');?></td>
                            
                            <?php 
                            if($detail_simpananpihakketiga[$i]['status_post'] == 1) {
                            ?>
                            <td></td>
                            <td></td>
                            <td style='text-align: center'><a class="btn btn-primary" href="<?php echo site_url("transaksianggotacon/simpananpihakketiga_unpost_akuntansi/".$simpananpihakketiga->id."/".$detail_simpananpihakketiga[$i]['id']); ?>"><i class="fa fa-times"></i></a></td>
                            <?php
                            } else {
                            ?>
                            <td style='text-align: center'><a class="btn btn-warning" href="<?php echo site_url("transaksianggotacon/edit_detail_simpananpihakketiga/".$simpananpihakketiga->id."/".$detail_simpananpihakketiga[$i]['id']); ?>"><i class="fa fa-pencil-square-o"></i></a></td>
                            <td style='text-align: center'><a class="btn btn-danger" onClick="getConfirmationDeleteDetailSimpananpihakketiga('<?php echo $simpananpihakketiga->id?>','<?php echo $detail_simpananpihakketiga[$i]['id']?>');"><i class="fa fa-trash-o"></i></a></td>
                            <td style='text-align: center'><a class="btn btn-primary" href="<?php echo site_url("transaksianggotacon/simpananpihakketiga_post_akuntansi/".$simpananpihakketiga->id."/".$detail_simpananpihakketiga[$i]['id']); ?>"><i class="fa fa-upload"></i></a></td>
                            <?php
                            }
                            ?>
                          </tr>
                          <?php $no++;}?>
                          <tr>
                            <td colspan='4'><strong>TOTAL</strong></td>
                            <td style='text-align: right'><strong><?php echo "Rp " . number_format($total_debet,2,',','.');?></strong></td>
                            <td style='text-align: right'><strong><?php echo "Rp " . number_format($total_kredit,2,',','.');?></strong></td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
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
                            <th>Jenis</th>
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
                            <td style='text-align: left'><?php echo $detail_jasa_simpananpihakketiga[$i]['keterangan']?></td>
                            <td style='text-align: right'><?php echo "Rp " . number_format($detail_jasa_simpananpihakketiga[$i]['jumlah'],2,',','.');?></td>
                            <td style='text-align: right'><?php echo "Rp " . number_format(0,2,',','.');?></td>
                            <?php
                              } else {
                                $total_kredit += $detail_jasa_simpananpihakketiga[$i]['jumlah'];
                            ?>
                            <td style='text-align: left'><?php echo $detail_jasa_simpananpihakketiga[$i]['jenis']?></td>
                            <td style='text-align: left'><?php echo $detail_jasa_simpananpihakketiga[$i]['keterangan']?></td>
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
                            <td colspan='4'><strong>TOTAL</strong></td>
                            <td style='text-align: right'><strong><?php echo "Rp " . number_format($total_debet,2,',','.');?></strong></td>
                            <td style='text-align: right'><strong><?php echo "Rp " . number_format($total_kredit,2,',','.');?></strong></td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
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
    #detail_jasa_simpananpihakketiga_table td {
      text-align:center;
    }
    #detail_jasa_simpananpihakketiga_table_filter {
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

  function getConfirmationJasa(id_simpanan3th, id_detail_jasa_simpananpihakketiga){
    var retVal = confirm("Apakah anda yakin akan menghapus data tersebut? Jika dihapus, maka jasa total simpanan piak ketiga anggota yang bersangkutan akan disesuaikan.");
    var controller = 'transaksianggotacon';
    var base_url = '<?php echo site_url(); //you have to load the "url_helper" to use this function ?>';
    if( retVal == true ){
      window.location.href= base_url + '/' + controller + '/delete_detail_jasa_simpananpihakketiga/' + id_simpanan3th + '/' + id_detail_jasa_simpanan3th;
    }
  }

  </script>

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

    function label_jasa_jumlah() {
        var jasa_jumlah = $('#jasa_jumlah').val();
        $("#label_jasa_jumlah").html('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Rp&nbsp;&nbsp;&nbsp;&nbsp&nbsp;&nbsp;&nbsp;&nbsp'+formatRupiah(Math.floor(jasa_jumlah)));
    }

    function getConfirmationDeleteDetailSimpananpihakketiga(id_simpananpihakketiga, id_detail_simpananpihakketiga){
      var retVal = confirm("Apakah anda yakin akan menghapus data tersebut?");
      var controller = 'transaksianggotacon';
      var base_url = '<?php echo site_url(); //you have to load the "url_helper" to use this function ?>';
      if( retVal == true ){
        window.location.href= base_url + '/' + controller + '/delete_detail_simpananpihakketiga/' + id_simpananpihakketiga + '/' + id_detail_simpananpihakketiga;
        //console.log(base_url + '/' + controller + '/delete_nasabah/' + id)
      }
    }

    function getConfirmationDeleteDetailJasaSimpananpihakketiga(id_simpananpihakketiga, id_detail_jasa_simpananpihakketiga){
      var retVal = confirm("Apakah anda yakin akan menghapus data tersebut?");
      var controller = 'transaksianggotacon';
      var base_url = '<?php echo site_url(); //you have to load the "url_helper" to use this function ?>';
      if( retVal == true ){
        window.location.href= base_url + '/' + controller + '/delete_detail_jasa_simpananpihakketiga/' + id_simpananpihakketiga + '/' + id_detail_jasa_simpananpihakketiga;
        //console.log(base_url + '/' + controller + '/delete_nasabah/' + id)
      }
    }

    function tambahDetailSimpananPihakKetiga() {
      document.getElementById("div_tambah_detail_simpananpihakketiga").style.display = "block";
    }

    function cancelTambahDetailSimpananPihakKetiga() {
      document.getElementById("div_tambah_detail_simpananpihakketiga").style.display = "none"; 
    }

    function tambahDetailJasaSimpananPihakKetiga() {
      document.getElementById("div_tambah_detail_jasa_simpananpihakketiga").style.display = "block";
    }

    $(document).ready(function(){
      $('#waktu').datepicker({}).on('changeDate', function(ev){});
      $('#edit_waktu').datepicker({}).on('changeDate', function(ev){});

      $('#jasa_waktu').datepicker({}).on('changeDate', function(ev){});

      label_jumlah();
      label_edit_jumlah();

      label_jasa_jumlah();

      $('#jumlah').keyup(function() {
          console.log('jumlah');
          label_jumlah();
      });

      $('#edit_jumlah').keyup(function() {
        label_edit_jumlah();
      });

      $('#jasa_jumlah').keyup(function() {
          label_jasa_jumlah();
      });

      $(".toggle-detail-pinjaman").click(function(){
          var icon = $(this).find("i");
          icon.toggleClass("fa-plus fa-minus");
          $(this).closest("tr").next(".detail-pinjaman-row").toggle();
      });
      
    });
  </script>