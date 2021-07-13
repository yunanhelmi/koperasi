<script src="<?php echo base_url(); ?>assets/js/jquery-1.11.3.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/js/highcharts.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/js/exporting.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/js/data.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/js/canvas-tools.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/js/export-csv.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/js/bootstrap-typeahead.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/bower_components/select2/dist/js/select2.full.min.js"></script>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/bower_components/select2/dist/css/select2.min.css">
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Akuntansi
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>index.php/penerimaansuratcon"><i class="fa fa-users"></i> Draft Penerimaan Surat</a></li>
        <li class="active"><a href="<?php echo base_url(); ?>index.php/penerimaansuratcon/view_penerimaan_surat"><i class="fa fa-table"></i>View Draft Penerimaan Surat</a></li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">
       <div class="col-md-12 pull-left">
          <!-- general form elements -->
          <div class="box box-danger">
            <legend style="text-align:center;">VIEW DRAFT PENERIMAAN SURAT</legend>
              <div class="box-body">
                <div class="form-group col-xs-3">
                  <label for="exampleInputPassword1">Tanggal</label>
                  <p><?php echo $penerimaan_surat->tanggal;?></p>
                </div>
                <div class="form-group col-xs-6">
                  <label for="exampleInputPassword1">Petugas Lapangan</label>
                  <p><?php echo $penerimaan_surat->nama_petugas_lapangan;?></p>
                </div>
              </div>
          </div>
          <div class="box box-danger">
            <legend style="text-align:center;">EDIT DETAIL PENERIMAAN SURAT</legend>
            <form action="<?php echo base_url()."index.php/penerimaansuratcon/update_detail_penerimaan_surat";?>" method="post" enctype="multipart/form-data" role="form">
              <div class="box-body">
                <div class="form-group col-xs-6">
                  <label for="exampleInputPassword1">Nama Nasabah</label>
                  <p><?php echo $detail->nama_nasabah;?></p>
                  <input type="hidden" class="form-control" id="id_penerimaan_surat" name="id_penerimaan_surat" value="<?php echo $detail->id_penerimaan_surat ?>">
                  <input type="hidden" class="form-control" id="id" name="id" value="<?php echo $detail->id ?>">
                </div>
                <div class="form-group col-xs-6">
                  <label for="exampleInputPassword1">Nomor Nasabah</label>
                  <p><?php echo $detail->nomor_nasabah;?></p>
                </div>
                <div class="form-group col-xs-6">
                  <label for="exampleInputPassword1">Kelurahan</label>
                  <p><?php echo $detail->kelurahan;?></p>
                </div>
                <div class="form-group col-xs-6">
                  <label for="exampleInputPassword1">Status</label>
                  <?php
                    if($detail->status_surat == 0) {
                      echo "<p>Hijau</p>";
                    } else if($detail->status_surat == 1) {
                      echo "<p>K1</p>";
                    } else if($detail->status_surat == 2) {
                      echo "<p>K2</p>";
                    } else if($detail->status_surat == 3) {
                      echo "<p>M1</p>";
                    } else if($detail->status_surat == 4) {
                      echo "<p>M2</p>";
                    }
                  ?>
                </div>
                <div class="form-group col-xs-6">
                  <label for="exampleInputPassword1">Jaminan</label>
                  <p><?php echo $detail->jaminan;?></p>
                </div>
                <div class="form-group col-xs-6">
                  <label for="exampleInputPassword1">Tanggal Pinjaman</label>
                  <p><?php echo $detail->tanggal_pinjaman;?></p>
                </div>
                <div class="form-group col-xs-6">
                  <label for="exampleInputPassword1">Jenis Pinjaman</label>
                  <p><?php echo $detail->jenis_pinjaman;?></p>
                </div>
                <div class="form-group col-xs-6">
                  <label for="exampleInputPassword1">Sisa Pokok Pinjaman</label>
                  <p><?php echo "Rp " . number_format($detail->sisa_pokok_pinjaman,2,',','.');?></p>
                </div>
                <div class="form-group col-xs-6">
                  <label for="exampleInputPassword1">Sisa Jasa</label>
                  <p><?php echo "Rp " . number_format($detail->sisa_jasa,2,',','.');?></p>
                </div>
                <div class="form-group col-xs-6">
                  <label for="exampleInputPassword1">Bayar Pokok Pinjaman</label>
                  <div class="input-group margin-bottom-sm">
                    <span class="input-group-addon">Rp</span>
                    <input type="text" class="form-control" value="<?php echo $detail->bayar_pokok_pinjaman?>" id="bayar_pokok_pinjaman" name="bayar_pokok_pinjaman">
                  </div>
                  <div id="label_bayar_pokok_pinjaman" class="alert-danger"></div>
                </div>
                <div class="form-group col-xs-6">
                  <label for="exampleInputPassword1">Bayar Jasa</label>
                  <div class="input-group margin-bottom-sm">
                    <span class="input-group-addon">Rp</span>
                    <input type="text" class="form-control" value="<?php echo $detail->bayar_jasa?>" id="bayar_jasa" name="bayar_jasa">
                  </div>
                  <div id="label_bayar_jasa" class="alert-danger"></div>
                </div>
              </div>
              <div class="box-footer">
                <div class="col-xs-3">
                  <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
                <div class="col-xs-3">
                    <a class="btn btn-primary btn-warning" href="<?php echo site_url("penerimaansuratcon/view_penerimaan_surat/".$detail->id_penerimaan_surat); ?>">Batal</a>
                </div>
              </div>
            </form>
          </div>
          
        </div>
      </div>
    </section>
    <!-- /.content -->

    </div>
    <style type="text/css">

    </style>

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

      function label_bayar_pokok_pinjaman() {
        var bayar_pokok_pinjaman = $('#bayar_pokok_pinjaman').val();
        $("#label_bayar_pokok_pinjaman").html('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Rp&nbsp;&nbsp;&nbsp;&nbsp&nbsp;&nbsp;&nbsp;&nbsp'+formatRupiah(Math.floor(bayar_pokok_pinjaman)));
      }

      function label_bayar_jasa() {
        var bayar_jasa = $('#bayar_jasa').val();
        $("#label_bayar_jasa").html('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Rp&nbsp;&nbsp;&nbsp;&nbsp&nbsp;&nbsp;&nbsp;&nbsp'+formatRupiah(Math.floor(bayar_jasa)));
      }

      $(document).ready(function(){
        label_bayar_pokok_pinjaman();
        label_bayar_jasa();

        $('#bayar_pokok_pinjaman').keyup(function() {
          label_bayar_pokok_pinjaman();
        });

        $('#bayar_jasa').keyup(function() {
          label_bayar_jasa();
        });

      });

    </script>