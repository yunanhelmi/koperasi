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
            <li><a href="#simpanan_pokok" data-toggle="tab">Simpanan Pokok</a></li>
            <li><a href="#simpanan_wajib" data-toggle="tab">Simpanan Wajib</a></li>
            <li><a href="#simpanan_khusus" data-toggle="tab">Simpanan Khusus</a></li>
            <li><a href="#simpanan_dana_sosial" data-toggle="tab">Simpanan Dana Sosial</a></li>
            <li><a href="#simpanan_kanzun" data-toggle="tab">Simpanan Kanzun</a></li>
            <!--<li><a href="#simpanan_3th" data-toggle="tab">Simpanan 3 Th</a></li>-->
            <li><a href="#simpanan_pihak_ketiga" data-toggle="tab">Simpanan Pihak Ketiga</a></li>
          </ul>
          <div class="tab-content">
            <div class="active tab-pane" id="pinjaman">


              <div class="row">
               <div class="col-md-12 pull-left">
                  <?php 
                    $date = strtotime( $pinjaman->waktu );
                    $mydate = date( 'd F Y', $date );
                  ?>
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
                          <input type="text" class="form-control pull-right" name="waktu" id="waktu" value="<?php echo date("d-m-Y",$date);?>" data-date-format="dd-mm-yyyy">
                          <input type="hidden" class="form-control" value="<?php echo $pinjaman->id?>" id="id_pinjaman" name="id_pinjaman">
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
                        <input type="text" class="form-control" id="bulan_ke" name="bulan_ke" placeholder="">
                      </div>
                      <div class="form-group col-xs-6">
                        <label for="exampleInputPassword1">Bulan-Tahun</label>
                        <input type="month" class="form-control" id="bulan_tahun" name="bulan_tahun" placeholder="">
                      </div>
                      <div class="form-group col-xs-6">
                        <label for="exampleInputPassword1">Angsuran</label>
                        <div class="input-group margin-bottom-sm">
                          <span class="input-group-addon">Rp</span>
                          <input type="text" class="form-control" value="<?php echo $pinjaman->angsuran_perbulan?>" id="angsuran" name="angsuran" placeholder="0">
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
                    </div>
                    <div class="box-footer">
                      <div class="col-xs-3">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                      </div>
                    </div>
                    </form>
                  </div>

                  <div class="box box-danger" id="div_edit_angsuran">
                    <legend style="text-align:center;">EDIT ANGSURAN</legend>
                    <form action="<?php echo base_url();?>index.php/transaksianggotacon/update_detail_angsuran" method="post" enctype="multipart/form-data" role="form">
                    <div class="box-body">
                      <div class="form-group col-xs-6">
                        <label for="exampleInputPassword1">Tanggal</label>
                        <div class="input-group date">
                          <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                          </div>
                          <?php $date = strtotime($edit_detail_angsuran->waktu);?>
                          <input type="text" class="form-control pull-right" value="<?php echo date("d-m-Y",$date);?>" name="edit_waktu" id="edit_waktu" data-date-format="dd-mm-yyyy">
                          <input type="hidden" class="form-control" value="<?php echo $edit_detail_angsuran->id;?>" id="edit_id" name="edit_id">
                          <input type="hidden" class="form-control" value="<?php echo $edit_detail_angsuran->id_pinjaman;?>" id="edit_id_pinjaman" name="edit_id_pinjaman">
                        </div>
                      </div>
                      <div class="form-group col-xs-6">
                        <label for="exampleInputPassword1">Jenis</label>
                        <select id="edit_jenis" name="edit_jenis" class="form-control" style="width: 100%;">
                          <option value='Angsuran' <?php echo $edit_detail_angsuran->jenis == 'Angsuran' ? 'selected' : ''?> >Angsuran</option>
                          <option value='Pinjaman' <?php echo $edit_detail_angsuran->jenis == 'Pinjaman' ? 'selected' : ''?> >Pinjaman</option>
                        </select>
                      </div>
                      <div class="form-group col-xs-6">
                        <label for="exampleInputPassword1">Bulan ke-</label>
                        <input type="text" class="form-control" value="<?php echo $edit_detail_angsuran->bulan_ke;?>" id="edit_bulan_ke" name="edit_bulan_ke" placeholder="">
                      </div>
                      <div class="form-group col-xs-6">
                        <label for="exampleInputPassword1">Bulan-Tahun</label>
                        <input type="month" class="form-control" value="<?php echo $edit_detail_angsuran->bulan_tahun;?>" id="edit_bulan_tahun" name="edit_bulan_tahun" placeholder="">
                      </div>
                      <div class="form-group col-xs-6">
                        <label for="exampleInputPassword1">Angsuran</label>
                        <div class="input-group margin-bottom-sm">
                          <span class="input-group-addon">Rp</span>
                          <input type="text" class="form-control" value="<?php echo $edit_detail_angsuran->angsuran;?>" id="edit_angsuran" name="edit_angsuran" placeholder="0">
                        </div>
                        <div id="label_edit_angsuran" class="alert-danger"></div>
                      </div>
                      <div class="form-group col-xs-6">
                        <label for="exampleInputPassword1">Jasa</label>
                        <div class="input-group margin-bottom-sm">
                          <span class="input-group-addon">Rp</span>
                          <input type="text" class="form-control" value="<?php echo $edit_detail_angsuran->jasa;?>" id="edit_jasa" name="edit_jasa" placeholder="0">
                        </div>
                        <div id="label_edit_jasa" class="alert-danger"></div>
                      </div>
                      <div class="form-group col-xs-6">
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
                    </div>
                    <div class="box-footer">
                        <div class="col-xs-3">
                          <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                      </div>
                    </form>
                  </div>

                  <div class="box box-danger">
                    <legend style="text-align:center;">DETAIL ANGSURAN</legend>

                    <div class="box-body">
                        <div class="form-group col-xs-3">
                          <label for="exampleInputEmail1">Nama Anggota</label>
                          <p><?php echo $pinjaman->nama_nasabah;?></p>
                        </div>
                        <div class="form-group col-xs-3">
                          <label for="exampleInputPassword1">NIK Anggota</label>
                          <p><?php echo $pinjaman->nik_nasabah;?></p>
                        </div>
                        <div class="form-group col-xs-3">
                          <label for="exampleInputPassword1">Jenis Pinjaman</label>
                          <p><?php echo $pinjaman->jenis_pinjaman;?></p>
                        </div>
                        <div class="form-group col-xs-3">
                          <label for="exampleInputPassword1">Jaminan</label>
                          <p><?php echo $pinjaman->jaminan;?></p>
                        </div>
                        <div class="form-group col-xs-3">
                          <label for="exampleInputPassword1">Tanggal Pinjaman</label>
                          <?php 
                            $date = strtotime( $pinjaman->waktu );
                            $mydate = date( 'd F Y', $date );
                          ?>
                          <p><?php echo $mydate;?></p>
                        </div>
                        <div class="form-group col-xs-3">
                          <label for="exampleInputPassword1">Tanggal Jatuh Tempo</label>
                          <?php 
                            $jatuh_tempo = strtotime( $pinjaman->jatuh_tempo );
                            $jatuh_tempo1 = date( 'd F Y', $jatuh_tempo );
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
                      </div>

                    <div class="box-body">
                      <div class="form-group col-xs-6">
                        <button onclick="tambahAngsuran()" type="submit" class="btn btn-success">Tambah Angsuran</button>
                      </div>
                      <table id="detail_angsuran_table" class="table table-bordered table-hover"  width="100%">
                        <thead>
                          <tr>
                            <th>No.</th>
                            <th>Waktu</th>
                            <th>Keterangan</th>
                            <th>Debet</th>
                            <th>Kredit</th>
                            <th>Sisa Pinjaman</th>
                            <th>Jasa</th>
                            <th>Jasa Tambahan</th>
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
                          $wkt = date( 'd F Y', $waktu );
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
                          <td style='text-align: right'><?php echo "Rp " . number_format($detail_angsuran[$i]['angsuran'],2,',','.');?></td>
                          <td style='text-align: right'><?php echo "Rp " . number_format(0,2,',','.');?></td>
                          <?php $total_debet += $detail_angsuran[$i]['angsuran'];?>
                          <?php }
                          $sisa_pinjaman[$i] = $total_kredit - $total_debet;
                          ?>
                          <td style='text-align: right'><?php echo "Rp " . number_format($sisa_pinjaman[$i],2,',','.');?></td>
                          <td style='text-align: right'><?php echo "Rp " . number_format($detail_angsuran[$i]['jasa'],2,',','.');?></td>
                          <td style='text-align: right'><?php echo "Rp " . number_format($detail_angsuran[$i]['denda'],2,',','.');?></td>
                          <?php 
                            $total_jasa += $detail_angsuran[$i]['jasa'];
                            $total_denda += $detail_angsuran[$i]['denda'];
                          ?>
                          <td style='text-align: center'><a class="btn btn-warning" href="<?php echo site_url("transaksianggotacon/edit_detail_angsuran/".$pinjaman->id."/".$detail_angsuran[$i]['id']); ?>"><i class="fa fa-pencil-square-o"></i></a></td>
                          <td style='text-align: center'><a class="btn btn-danger" onClick="getConfirmationDeleteAngsuran('<?php echo $pinjaman->id?>','<?php echo $detail_angsuran[$i]['id']?>');"><i class="fa fa-trash-o"></i></a></td>
                          <?php 
                          if($detail_angsuran[$i]['status_post'] == 1) {
                          ?>
                          <td style='text-align: center'><a class="btn btn-primary" href="<?php echo site_url("transaksianggotacon/angsuran_unpost_akuntansi/".$pinjaman->id."/".$detail_angsuran[$i]['id']); ?>"><i class="fa fa-times"></i></a></td>
                          <?php
                          } else {
                          ?>
                          <td style='text-align: center'><a class="btn btn-primary" href="<?php echo site_url("transaksianggotacon/angsuran_post_akuntansi/".$pinjaman->id."/".$detail_angsuran[$i]['id']); ?>"><i class="fa fa-upload"></i></a></td>
                          <?php
                          }
                          ?>
                          </tr>
                          <?php $no++;}?>
                          <tr>
                            <td colspan='3'><strong>TOTAL</strong></td>
                            <td style='text-align: right'><strong><?php echo "Rp " . number_format($total_debet,2,',','.');?></strong></td>
                            <td style='text-align: right'><strong><?php echo "Rp " . number_format($total_kredit,2,',','.');?></strong></td>
                            <td></td>
                            <td style='text-align: right'><strong><?php echo "Rp " . number_format($total_jasa,2,',','.');?></strong></td>
                            <td style='text-align: right'><strong><?php echo "Rp " . number_format($total_denda,2,',','.');?></strong></td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>

              
            </div>
            <div class="tab-pane" id="simpanan_pokok">
              <div class="box-header" style="text-align:left" >
                <h3>
                  <a class="btn btn-primary btn-success" href="<?php echo site_url("transaksianggotacon/create_simpananpokok/".$nasabah->id); ?>">Tambahkan Simpanan Pokok Baru</a>
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
                      for($i = 0; $i < sizeof($simpananpokok); $i++) {
                    ?>
                    <tr>
                      <td style='text-align: center'><?php echo $no."."?></td>
                      <td><?php echo $simpananpokok[$i]['nama_nasabah']?></td>
                      <td><?php echo $simpananpokok[$i]['nomor_nasabah']?></td>
                      <td><?php echo $simpananpokok[$i]['nik_nasabah']?></td>
                      <?php $date = strtotime($simpananpokok[$i]['waktu']);?>
                      <td><?php echo date("d-M-Y",$date)?></td>
                      <td><?php echo rupiah($simpananpokok[$i]['jumlah'])?></td>
                      <td style='text-align: center'><a class="btn btn-primary" href="<?php echo site_url("transaksianggotacon/view_simpananpokok/".$simpananpokok[$i]['id']); ?>"><i class="fa fa-eye"></i></a></td>
                      <td style='text-align: center'><a class="btn btn-warning" href="<?php echo site_url("transaksianggotacon/edit_simpananpokok/".$simpananpokok[$i]['id']); ?>"><i class="fa fa-pencil-square-o"></i></a></td>
                      <td style='text-align: center'><a class="btn btn-danger" onClick="getConfirmationSimpananpokok('<?php echo $simpananpokok[$i]['id']?>');"><i class="fa fa-trash-o"></i></a></td>
                      <?php 
                      if($simpananpokok[$i]['status_post'] == 1) {
                      ?>
                      <td style='text-align: center'><a class="btn btn-primary" href="<?php echo site_url("transaksianggotacon/simpananpokok_unpost_akuntansi/".$simpananpokok[$i]['id']); ?>"><i class="fa fa-times"></i></a></td>
                      <?php
                      } else {
                      ?>
                      <td style='text-align: center'><a class="btn btn-primary" href="<?php echo site_url("transaksianggotacon/simpananpokok_post_akuntansi/".$simpananpokok[$i]['id']); ?>"><i class="fa fa-upload"></i></a></td>
                      <?php
                      }
                      ?>
                    </tr>
                    <?php $no++;}?>
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
                      for($i = 0; $i < sizeof($simpananwajib); $i++) {
                    ?>
                    <tr>
                      <td style='text-align: center'><?php echo $no."."?></td>
                      <td><?php echo $simpananwajib[$i]['nama_nasabah']?></td>
                      <td><?php echo $simpananwajib[$i]['nomor_nasabah']?></td>
                      <td><?php echo $simpananwajib[$i]['nik_nasabah']?></td>
                      <?php $date = strtotime($simpananwajib[$i]['waktu']);?>
                      <td><?php echo date("d-M-Y",$date)?></td>
                      <td><?php echo rupiah($simpananwajib[$i]['total'])?></td>
                      <td style='text-align: center'><a class="btn btn-primary" href="<?php echo site_url("transaksianggotacon/view_simpananpokok/".$simpananwajib[$i]['id']); ?>"><i class="fa fa-eye"></i></a></td>
                      <td style='text-align: center'><a class="btn btn-warning" href="<?php echo site_url("transaksianggotacon/edit_simpananpokok/".$simpananwajib[$i]['id']); ?>"><i class="fa fa-pencil-square-o"></i></a></td>
                      <td style='text-align: center'><a class="btn btn-danger" onClick="getConfirmationSimpananwajib('<?php echo $simpananwajib[$i]['id']?>');"><i class="fa fa-trash-o"></i></a></td>
                    </tr>
                    <?php $no++;}?>
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
                      for($i = 0; $i < sizeof($simpanankhusus); $i++) {
                    ?>
                    <tr>
                      <td style='text-align: center'><?php echo $no."."?></td>
                      <td><?php echo $simpanankhusus[$i]['nama_nasabah']?></td>
                      <td><?php echo $simpanankhusus[$i]['nomor_nasabah']?></td>
                      <td><?php echo $simpanankhusus[$i]['nik_nasabah']?></td>
                      <?php $date = strtotime($simpanankhusus[$i]['waktu']);?>
                      <td><?php echo date("d-M-Y",$date)?></td>
                      <td><?php echo rupiah($simpanankhusus[$i]['total'])?></td>
                      <td style='text-align: center'><a class="btn btn-primary" href="<?php echo site_url("transaksianggotacon/view_simpananpokok/".$simpanankhusus[$i]['id']); ?>"><i class="fa fa-eye"></i></a></td>
                      <td style='text-align: center'><a class="btn btn-warning" href="<?php echo site_url("transaksianggotacon/edit_simpananpokok/".$simpanankhusus[$i]['id']); ?>"><i class="fa fa-pencil-square-o"></i></a></td>
                      <td style='text-align: center'><a class="btn btn-danger" onClick="getConfirmationSimpanankhusus('<?php echo $simpanankhusus[$i]['id']?>');"><i class="fa fa-trash-o"></i></a></td>
                    </tr>
                    <?php $no++;}?>
                  </tbody>
                </table>
              </div>
            </div>
            <div class="tab-pane" id="simpanan_dana_sosial">
              <div class="box-header" style="text-align:left" >
                <h3>
                  <a class="btn btn-primary btn-success" href="<?php echo site_url("transaksianggotacon/create_simpanandanasosial/".$nasabah->id); ?>">Tambahkan Simpanan Dana Sosial Baru</a>
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
                      for($i = 0; $i < sizeof($simpanandanasosial); $i++) {
                    ?>
                    <tr>
                      <td style='text-align: center'><?php echo $no."."?></td>
                      <td><?php echo $simpanandanasosial[$i]['nama_nasabah']?></td>
                      <td><?php echo $simpanandanasosial[$i]['nomor_nasabah']?></td>
                      <td><?php echo $simpanandanasosial[$i]['nik_nasabah']?></td>
                      <?php $date = strtotime($simpanandanasosial[$i]['waktu']);?>
                      <td><?php echo date("d-M-Y",$date)?></td>
                      <td><?php echo rupiah($simpanandanasosial[$i]['total'])?></td>
                      <td style='text-align: center'><a class="btn btn-primary" href="<?php echo site_url("transaksianggotacon/view_simpanandanasosial/".$simpanandanasosial[$i]['id']); ?>"><i class="fa fa-eye"></i></a></td>
                      <td style='text-align: center'><a class="btn btn-warning" href="<?php echo site_url("transaksianggotacon/edit_simpanandanasosial/".$simpanandanasosial[$i]['id']); ?>"><i class="fa fa-pencil-square-o"></i></a></td>
                      <td style='text-align: center'><a class="btn btn-danger" onClick="getConfirmationSimpanandanasosial('<?php echo $simpanandanasosial[$i]['id']?>');"><i class="fa fa-trash-o"></i></a></td>
                    </tr>
                    <?php $no++;}?>
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
                      for($i = 0; $i < sizeof($simpanankanzun); $i++) {
                    ?>
                    <tr>
                      <td style='text-align: center'><?php echo $no."."?></td>
                      <td><?php echo $simpanankanzun[$i]['nama_nasabah']?></td>
                      <td><?php echo $simpanankanzun[$i]['nomor_nasabah']?></td>
                      <td><?php echo $simpanankanzun[$i]['nik_nasabah']?></td>
                      <?php $date = strtotime($simpanankanzun[$i]['waktu']);?>
                      <td><?php echo date("d-M-Y",$date)?></td>
                      <td><?php echo rupiah($simpanankanzun[$i]['total'])?></td>
                      <td style='text-align: center'><a class="btn btn-primary" href="<?php echo site_url("transaksianggotacon/view_simpanankanzun/".$simpanankanzun[$i]['id']); ?>"><i class="fa fa-eye"></i></a></td>
                      <td style='text-align: center'><a class="btn btn-warning" href="<?php echo site_url("transaksianggotacon/edit_simpanankanzun/".$simpanankanzun[$i]['id']); ?>"><i class="fa fa-pencil-square-o"></i></a></td>
                      <td style='text-align: center'><a class="btn btn-danger" onClick="getConfirmationSimpanankanzun('<?php echo $simpanankanzun[$i]['id']?>');"><i class="fa fa-trash-o"></i></a></td>
                    </tr>
                    <?php $no++;}?>
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
                      <td><?php echo date("d-M-Y",$date)?></td>
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
                      for($i = 0; $i < sizeof($simpananpihakketiga); $i++) {
                    ?>
                    <tr>
                      <td style='text-align: center'><?php echo $no."."?></td>
                      <td><?php echo $simpananpihakketiga[$i]['nama']?></td>
                      <td><?php echo $simpananpihakketiga[$i]['nomor_nasabah']?></td>
                      <td><?php echo $simpananpihakketiga[$i]['nik']?></td>
                      <?php $date = strtotime($simpananpihakketiga[$i]['waktu']);?>
                      <td><?php echo date("d-M-Y",$date)?></td>
                      <td><?php echo rupiah($simpananpihakketiga[$i]['total'])?></td>
                      <td style='text-align: center'><a class="btn btn-primary" href="<?php echo site_url("transaksianggotacon/view_simpananpihakketiga/".$simpananpihakketiga[$i]['id']); ?>"><i class="fa fa-eye"></i></a></td>
                      <td style='text-align: center'><a class="btn btn-warning" href="<?php echo site_url("transaksianggotacon/edit_simpananpihakketiga/".$simpananpihakketiga[$i]['id']); ?>"><i class="fa fa-pencil-square-o"></i></a></td>
                      <td style='text-align: center'><a class="btn btn-danger" onClick="getConfirmationSimpananpihakketiga('<?php echo $simpananpihakketiga[$i]['id']?>');"><i class="fa fa-trash-o"></i></a></td>
                    </tr>
                    <?php $no++;}?>
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
      window.location.href= base_url + controller + '/delete_pinjaman/' + id;
      //console.log(base_url + '/' + controller + '/delete_nasabah/' + id)
    }
  }

  function getConfirmationSimpananpokok(id){
    var retVal = confirm("Apakah anda yakin akan menghapus data tersebut ? Jika dihapus, maka detail simpanan pokok anggota yang bersangkutan juga akan terhapus.");
    var controller = 'transaksianggotacon';
    var base_url = '<?php echo site_url(); //you have to load the "url_helper" to use this function ?>';
    if( retVal == true ){
      window.location.href= base_url + controller + '/delete_simpananpokok/' + id;
      //console.log(base_url + '/' + controller + '/delete_nasabah/' + id)
    }
  }

  function getConfirmationSimpananwajib(id){
    var retVal = confirm("Apakah anda yakin akan menghapus data tersebut ? Jika dihapus, maka detail simpanan wajib anggota yang bersangkutan juga akan terhapus.");
    var controller = 'transaksianggotacon';
    var base_url = '<?php echo site_url(); //you have to load the "url_helper" to use this function ?>';
    if( retVal == true ){
      window.location.href= base_url + controller + '/delete_simpananwajib/' + id;
      //console.log(base_url + '/' + controller + '/delete_nasabah/' + id)
    }
  }

  function getConfirmationSimpanankhusus(id){
    var retVal = confirm("Apakah anda yakin akan menghapus data tersebut ? Jika dihapus, maka detail simpanan khusus anggota yang bersangkutan juga akan terhapus.");
    var controller = 'transaksianggotacon';
    var base_url = '<?php echo site_url(); //you have to load the "url_helper" to use this function ?>';
    if( retVal == true ){
      window.location.href= base_url + controller + '/delete_simpanankhusus/' + id;
      //console.log(base_url + '/' + controller + '/delete_nasabah/' + id)
    }
  }

  function getConfirmationSimpanandanasosial(id){
    var retVal = confirm("Apakah anda yakin akan menghapus data tersebut ? Jika dihapus, maka detail simpanan dana sosial anggota yang bersangkutan juga akan terhapus.");
    var controller = 'transaksianggotacon';
    var base_url = '<?php echo site_url(); //you have to load the "url_helper" to use this function ?>';
    if( retVal == true ){
      window.location.href= base_url + controller + '/delete_simpanandanasosial/' + id;
      //console.log(base_url + '/' + controller + '/delete_nasabah/' + id)
    }
  }

  function getConfirmationSimpanankanzun(id){
    var retVal = confirm("Apakah anda yakin akan menghapus data tersebut ? Jika dihapus, maka detail simpanan kanzun anggota yang bersangkutan juga akan terhapus.");
    var controller = 'transaksianggotacon';
    var base_url = '<?php echo site_url(); //you have to load the "url_helper" to use this function ?>';
    if( retVal == true ){
      window.location.href= base_url + controller + '/delete_simpanankanzun/' + id;
      //console.log(base_url + '/' + controller + '/delete_nasabah/' + id)
    }
  }

  function getConfirmationSimpanan3th(id){
    var retVal = confirm("Apakah anda yakin akan menghapus data tersebut ? Jika dihapus, maka detail simpanan 3 th anggota yang bersangkutan juga akan terhapus.");
    var controller = 'transaksianggotacon';
    var base_url = '<?php echo site_url(); //you have to load the "url_helper" to use this function ?>';
    if( retVal == true ){
      window.location.href= base_url + controller + '/delete_simpanan3th/' + id;
      //console.log(base_url + '/' + controller + '/delete_nasabah/' + id)
    }
  }

  function getConfirmationSimpananpihakketiga(id){
    var retVal = confirm("Apakah anda yakin akan menghapus data tersebut ? Jika dihapus, maka detail simpanan 3 th anggota yang bersangkutan juga akan terhapus.");
    var controller = 'transaksianggotacon';
    var base_url = '<?php echo site_url(); //you have to load the "url_helper" to use this function ?>';
    if( retVal == true ){
      window.location.href= base_url + controller + '/delete_simpananpihakketiga/' + id;
      //console.log(base_url + '/' + controller + '/delete_nasabah/' + id)
    }
  }

  $(function () {
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
  })
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

      function getConfirmationDeleteAngsuran(id_pinjaman, id_detail_angsuran){
        var retVal = confirm("Apakah anda yakin akan menghapus data tersebut ?");
        var controller = 'transaksianggotacon';
        var base_url = '<?php echo site_url(); //you have to load the "url_helper" to use this function ?>';
        if( retVal == true ){
          window.location.href= base_url + controller + '/delete_detail_angsuran/' + id_pinjaman + '/' + id_detail_angsuran;
          //console.log(base_url + '/' + controller + '/delete_nasabah/' + id)
        }
      }

      function tambahAngsuran() {
        document.getElementById("div_edit_angsuran").style.display = "none";
        document.getElementById("div_tambah_angsuran").style.display = "block";
      }

      function editAngsuran(angsuran) {
        //document.getElementById("div_edit_angsuran").style.display = "block";
        console.log(angsuran);
      }

      $(document).ready(function(){
        $('#waktu').datepicker({}).on('changeDate', function(ev){});
        $('#edit_waktu').datepicker({}).on('changeDate', function(ev){});
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
          hitung_edit_total();
        });
        $('#edit_denda').keyup(function() {
          label_edit_denda();
          hitung_edit_total();
        });
        $('#edit_total').keyup(function() {
          label_edit_total();
        });

      });

    </script>
