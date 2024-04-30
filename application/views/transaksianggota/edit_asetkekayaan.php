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
        <li class="active"><i class="fa fa-credit-card"></i> Pinjaman</li>
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
            <li><a href="#simpanan_pihak_ketiga" data-toggle="tab">Simpanan Pihak Ketiga</a></li>
            <li class="active"><a href="#aset_kekayaan" data-toggle="tab">Aset Kekayaan</a></li>
          </ul>
          <div class="tab-content">
            <div class="tab-pane" id="pinjaman">
              <div class="box-header" style="text-align:left" >
                <h3>
                  <a class="btn btn-primary btn-success" href="<?php echo site_url("transaksianggotacon/create_pinjaman/".$nasabah->id); ?>">Tambahkan Pinjaman Baru</a>
                </h3>
              </div> 
              <div class="box-body">
                <table id="pinjaman_table" class="table table-bordered table-hover"  width="100%">
                  <thead>
                    <tr>
                      <th>No.</th>
                      <th>Nama</th>
                      <th>Tanggal Pinjam</th>
                      <th>Jaminan</th>
                      <th>Jatuh Tempo</th>
                      <th>Keterangan</th>
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
                    <tr <?php echo $pinjaman[$i]['sisa_angsuran'] == 0 ? "style='background-color: #90EE90'" : "" ?>>
                      <td style='text-align: center'><?php echo $no."."?></td>
                      <td><?php echo $pinjaman[$i]['nama_nasabah']?></td>
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
                      <td><?php echo rupiah($pinjaman[$i]['jumlah_pinjaman'])?></td>
                      <td><?php echo rupiah($pinjaman[$i]['sisa_angsuran'])?></td>
                      <td><?php echo $pinjaman[$i]['jumlah_angsuran']?></td>
                      <td><?php echo rupiah($pinjaman[$i]['uang_kurang'])?></td>
                      <td style='text-align: center'><a class="btn btn-primary" href="<?php echo site_url("transaksianggotacon/view_pinjaman/".$pinjaman[$i]['id']); ?>"><i class="fa fa-eye"></i></a></td>
                      <td style='text-align: center'><a class="btn btn-warning" href="<?php echo site_url("transaksianggotacon/edit_pinjaman/".$pinjaman[$i]['id']); ?>"><i class="fa fa-pencil-square-o"></i></a></td>
                      <td style='text-align: center'><a class="btn btn-danger" onClick="getConfirmationPinjaman('<?php echo $pinjaman[$i]['id']?>');"><i class="fa fa-trash-o"></i></a></td>
                    </tr>
                    <?php 
                        $no++;
                        $total_pinjaman += $pinjaman[$i]['jumlah_pinjaman'];
                        $total_sisa += $pinjaman[$i]['sisa_angsuran'];
                        //$total_angsuran += $pinjaman[$i]['jumlah_angsuran'];
                      }
                    ?>
                    <tr>
                      <td colspan="6"><strong>Total</strong></td>
                      <td><strong><?php echo rupiah($total_pinjaman) ?></strong></td>
                      <td><strong><?php echo rupiah($total_sisa) ?></strong></td>
                      <!--<td><strong><?php echo rupiah($total_angsuran) ?></strong></td>-->
                    </tr>
                  </tbody>
                </table>
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
                  <?php
                    if(substr($nasabah->nomor_koperasi, 0, 1) == "1") {
                  ?>
                  <a class="btn btn-primary btn-success" href="<?php echo site_url("transaksianggotacon/create_simpanandanasosial/".$nasabah->id); ?>">Tambahkan Simpanan Dansos Anggota Baru</a>
                  <?php
                    } else if(substr($nasabah->nomor_koperasi, 0, 1) == "2") {
                  ?>
                  <a class="btn btn-primary btn-success" href="<?php echo site_url("transaksianggotacon/create_simpanandanasosial/".$nasabah->id); ?>">Tambahkan Simpanan Dansos Anggota Istimewa Baru</a>
                  <?php
                    }
                  ?>
                  
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
                    <?php 
                        $no++;
                      }
                    ?>
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
            <div class="active tab-pane" id="aset_kekayaan">
              <legend style="text-align:center;">EDIT ASET KEKAYAAN</legend>
              <form action="<?php echo base_url()."index.php/transaksianggotacon/update_asetkekayaan/".$nasabah->id;?>" method="post" enctype="multipart/form-data" role="form">
                <div class="box-body">
                  <div class="form-group col-xs-6">
                    <label for="exampleInputEmail1">Nama Anggota</label>
                    <input type="text" class="form-control" id="nama_nasabah" name="nama_nasabah" placeholder="Nama Nasabah" value="<?php echo $nasabah->nama;?>" readonly>
                    <input type="hidden" class="form-control" value="<?php echo $asetkekayaan->id?>" id="id" name="id">
                    <input type="hidden" class="form-control" id="id_nasabah" name="id_nasabah" value="<?php echo $asetkekayaan->id_nasabah;?>">
                  </div>
                  <div class="form-group col-xs-6">
                    <label for="exampleInputPassword1">Jenis Aset</label>
                    <select id="jenis_aset" name="jenis_aset" class="form-control" style="width: 100%;">
                      <option value='sertifikat' <?php echo $asetkekayaan->jenis_aset == 'sertifikat' ? 'selected' : ''?> >Sertifikat</option>
                      <option value='bpkb' <?php echo $asetkekayaan->jenis_aset == 'bpkb' ? 'selected' : ''?> >BPKB</option>
                    </select>
                  </div>
                  <div class="form-group col-xs-6" id="div_nama_pemilik">
                    <label for="exampleInputPassword1">Nama Pemilik</label>
                    <input type="text" class="form-control" id="nama_pemilik" name="nama_pemilik" value="<?php echo $asetkekayaan->nama_pemilik;?>" placeholder="">
                  </div>
                  <div class="form-group col-xs-6" id="div_no_sertifikat">
                    <label for="exampleInputPassword1">No. Sertifikat</label>
                    <input type="text" class="form-control" id="no_sertifikat" name="no_sertifikat" value="<?php echo $asetkekayaan->no_sertifikat;?>" placeholder="">
                  </div>
                  <div class="form-group col-xs-6" id="div_luas">
                    <label for="exampleInputPassword1">Luas</label>
                    <input type="number" class="form-control" id="luas" name="luas" value="<?php echo $asetkekayaan->luas;?>" placeholder="">
                  </div>
                  <div class="form-group col-xs-6" id="div_jenis_tanah">
                    <label for="exampleInputPassword1">Jenis Tanah</label>
                    <select id="jenis_tanah" name="jenis_tanah" class="form-control" style="width: 100%;">
                      <option value='perumahan' <?php echo $asetkekayaan->jenis_tanah == 'perumahan' ? 'selected' : ''?> >Perumahan</option>
                      <option value='pekarangan' <?php echo $asetkekayaan->jenis_tanah == 'pekarangan' ? 'selected' : ''?> >Pekarangan</option>
                      <option value='pertanian' <?php echo $asetkekayaan->jenis_tanah == 'pertanian' ? 'selected' : ''?> >Pertanian</option>
                      <option value='perkebunan' <?php echo $asetkekayaan->jenis_tanah == 'perkebunan' ? 'selected' : ''?> >Perkebunan</option>
                    </select>
                  </div>
                  <div class="form-group col-xs-6" id="div_lokasi_tanah">
                    <label for="exampleInputPassword1">Lokasi Tanah</label>
                    <input type="text" class="form-control" id="lokasi_tanah" name="lokasi_tanah" value="<?php echo $asetkekayaan->lokasi_tanah;?>" placeholder="">
                  </div>
                  <div class="form-group col-xs-6" id="div_merek" style="display:none">
                    <label for="exampleInputPassword1">Merek</label>
                    <select id="merek" name="merek" class="form-control" style="width: 100%;">
                      <option value='HONDA' <?php echo $asetkekayaan->merek == 'HONDA' ? 'selected' : ''?> >HONDA</option>
                      <option value='YAMAHA' <?php echo $asetkekayaan->merek == 'YAMAHA' ? 'selected' : ''?> >YAMAHA</option>
                      <option value='SUZUKI' <?php echo $asetkekayaan->merek == 'SUZUKI' ? 'selected' : ''?> >SUZUKI</option>
                    </select>
                  </div>
                  <div class="form-group col-xs-6" id="div_jenis_motor" style="display:none">
                    <label for="exampleInputPassword1">Jenis Motor</label>
                    <input type="text" class="form-control" id="jenis_motor" name="jenis_motor" value="<?php echo $asetkekayaan->jenis_motor;?>" placeholder="">
                  </div>
                  <div class="form-group col-xs-6" id="div_tahun" style="display:none">
                    <label for="exampleInputPassword1">Tahun</label>
                    <input type="number" class="form-control" id="tahun" name="tahun" value="<?php echo $asetkekayaan->tahun;?>" placeholder="">
                  </div>
                  <div class="form-group col-xs-6" id="div_atas_nama" style="display:none">
                    <label for="exampleInputPassword1">Atas Nama</label>
                    <input type="text" class="form-control" id="atas_nama" name="atas_nama" value="<?php echo $asetkekayaan->atas_nama;?>" placeholder="">
                  </div>
                  <div class="form-group col-xs-6" id="div_no_pol" style="display:none">
                    <label for="exampleInputPassword1">No. Polisi</label>
                    <input type="text" class="form-control" id="no_pol" name="no_pol" value="<?php echo $asetkekayaan->no_pol;?>" placeholder="">
                  </div>
                  <div class="form-group col-xs-6">
                    <label for="exampleInputFile">Foto Aset</label>
                    <input type="file" accept=".jpg, .jpeg, .png" name="file_img">
                  </div>
                </div>
                <div class="box-footer">
                  <div class="col-xs-3">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                  </div>
                  <div class="col-xs-3">
                    <a class="btn btn-primary btn-warning" href="<?php echo site_url("transaksianggotacon/asetkekayaan/".$nasabah->id); ?>">Batal</a>
                  </div>
                </div>
              </form>
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
    var retVal = confirm("Apakah anda yakin akan menghapus data tersebut ? Jika dihapus, maka detail simpanan pihak ketiga anggota yang bersangkutan juga akan terhapus.");
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

  $(document).ready(function() {
    if($('#jenis_aset').val() == 'sertifikat') {
        document.getElementById("div_merek").style.display = "none";
        document.getElementById("div_jenis_motor").style.display = "none";
        document.getElementById("div_tahun").style.display = "none";
        document.getElementById("div_atas_nama").style.display = "none";
        document.getElementById("div_no_pol").style.display = "none";

        document.getElementById("merek").value = "";
        document.getElementById("jenis_motor").value = "";
        document.getElementById("tahun").value = "";
        document.getElementById("atas_nama").value = "";
        document.getElementById("no_pol").value = "";

        document.getElementById("div_nama_pemilik").style.display = "block";
        document.getElementById("div_no_sertifikat").style.display = "block";
        document.getElementById("div_luas").style.display = "block";
        document.getElementById("div_jenis_tanah").style.display = "block";
        document.getElementById("div_lokasi_tanah").style.display = "block";
      } else if($('#jenis_aset').val() == 'bpkb') {     
        document.getElementById("div_nama_pemilik").style.display = "none";
        document.getElementById("div_no_sertifikat").style.display = "none";
        document.getElementById("div_luas").style.display = "none";
        document.getElementById("div_jenis_tanah").style.display = "none";
        document.getElementById("div_lokasi_tanah").style.display = "none";

        document.getElementById("nama_pemilik").value = "";
        document.getElementById("no_sertifikat").value = "";
        document.getElementById("luas").value = "";
        document.getElementById("jenis_tanah").value = "";
        document.getElementById("lokasi_tanah").value = "";

        document.getElementById("div_merek").style.display = "block";
        document.getElementById("div_jenis_motor").style.display = "block";
        document.getElementById("div_tahun").style.display = "block";
        document.getElementById("div_atas_nama").style.display = "block";
        document.getElementById("div_no_pol").style.display = "block";
      }

    $('#jenis_aset').change(function() {
      if($('#jenis_aset').val() == 'sertifikat') {
        document.getElementById("div_merek").style.display = "none";
        document.getElementById("div_jenis_motor").style.display = "none";
        document.getElementById("div_tahun").style.display = "none";
        document.getElementById("div_atas_nama").style.display = "none";
        document.getElementById("div_no_pol").style.display = "none";

        document.getElementById("merek").value = "";
        document.getElementById("jenis_motor").value = "";
        document.getElementById("tahun").value = "";
        document.getElementById("atas_nama").value = "";
        document.getElementById("no_pol").value = "";

        document.getElementById("div_nama_pemilik").style.display = "block";
        document.getElementById("div_no_sertifikat").style.display = "block";
        document.getElementById("div_luas").style.display = "block";
        document.getElementById("div_jenis_tanah").style.display = "block";
        document.getElementById("div_lokasi_tanah").style.display = "block";
      } else if($('#jenis_aset').val() == 'bpkb') {     
        document.getElementById("div_nama_pemilik").style.display = "none";
        document.getElementById("div_no_sertifikat").style.display = "none";
        document.getElementById("div_luas").style.display = "none";
        document.getElementById("div_jenis_tanah").style.display = "none";
        document.getElementById("div_lokasi_tanah").style.display = "none";

        document.getElementById("nama_pemilik").value = "";
        document.getElementById("no_sertifikat").value = "";
        document.getElementById("luas").value = "";
        document.getElementById("jenis_tanah").value = "";
        document.getElementById("lokasi_tanah").value = "";

        document.getElementById("div_merek").style.display = "block";
        document.getElementById("div_jenis_motor").style.display = "block";
        document.getElementById("div_tahun").style.display = "block";
        document.getElementById("div_atas_nama").style.display = "block";
        document.getElementById("div_no_pol").style.display = "block";
      }
    });
  });
  
  </script>
