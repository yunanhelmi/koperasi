<script src="<?php echo base_url(); ?>assets/js/jquery-1.11.3.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/js/highcharts.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/js/exporting.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/js/data.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/js/canvas-tools.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/js/export-csv.js" type="text/javascript"></script>
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
        <li><a href="<?php echo base_url(); ?>index.php/transaksiakuntansicon"><i class="fa fa-users"></i> Transaksi Akuntansi</a></li>
        <li class="active"><a href="<?php echo base_url(); ?>index.php/transaksiakuntansicon/view_transaksi_akuntansi"><i class="fa fa-table"></i>View Transaksi</a></li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">
       <div class="col-md-12 pull-left">
          <!-- general form elements -->
          <div class="box box-danger">
            <legend style="text-align:center;">EDIT TRANSAKSI</legend>
              <div class="box-body">
                <div class="form-group col-xs-6">
                  <label for="exampleInputPassword1">Tanggal</label>
                  <div class="input-group date">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <input type="hidden" class="form-control" id="id" name="id" value="<?php echo $transaksi_akuntansi->id?>">
                    <?php $date = strtotime($transaksi_akuntansi->tanggal);?>
                    <input type="text" class="form-control pull-right" name="tanggal" id="tanggal" value="<?php echo date("d-m-Y",$date);?>" data-date-format="dd-mm-yyyy" readonly>
                  </div>
                </div>
                <div class="form-group col-xs-6">
                  <label for="exampleInputPassword1">Kode Akun</label>
                  <input type="text" class="form-control" id="kode_akun" name="kode_akun" placeholder="Kode Akun" value="<?php echo $transaksi_akuntansi->kode_akun?>" readonly>
                </div>
                <div class="form-group col-xs-6">
                  <label for="exampleInputPassword1">Nama Akun</label>
                  <input type="text" class="form-control" id="nama_akun" name="nama_akun" placeholder="Nama Akun" value="<?php echo $transaksi_akuntansi->nama_akun?>" readonly>
                </div>
                <div class="form-group col-xs-6">
                  <label for="exampleInputPassword1">Keterangan</label>
                  <input type="textarea" class="form-control" id="keterangan" name="keterangan" placeholder="Keterangan" value="<?php echo $transaksi_akuntansi->keterangan?>" readonly>
                </div>
                <div class="form-group col-xs-6">
                  <label for="exampleInputPassword1">Debet</label>
                  <div class="input-group margin-bottom-sm">
                    <span class="input-group-addon">Rp</span>
                    <input type="text" class="form-control" id="debet" name="debet" placeholder="0" value="<?php echo $transaksi_akuntansi->debet?>" readonly>
                  </div>
                  <div id="label_debet" class="alert-danger"></div> 
                </div>
                <div class="form-group col-xs-6">
                  <label for="exampleInputPassword1">Kredit</label>
                  <div class="input-group margin-bottom-sm">
                    <span class="input-group-addon">Rp</span>
                    <input type="text" class="form-control" id="kredit" name="kredit" placeholder="0" value="<?php echo $transaksi_akuntansi->kredit?>" readonly>
                  </div>
                  <div id="label_kredit" class="alert-danger"></div> 
                </div>
              </div>
              <!-- /.box-body -->
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

      function label_debet() {
        var debet=$('#debet').val();
        $("#label_debet").html('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Rp&nbsp;&nbsp;&nbsp;&nbsp&nbsp;&nbsp;&nbsp;&nbsp'+formatRupiah(Math.floor(debet)));
      }

      function label_kredit() {
        var kredit=$('#kredit').val();
        $("#label_kredit").html('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Rp&nbsp;&nbsp;&nbsp;&nbsp&nbsp;&nbsp;&nbsp;&nbsp'+formatRupiah(Math.floor(kredit)));
      }

      $(document).ready(function(){
        $('#tanggal').datepicker({}).on('changeDate', function(ev){});

        label_debet();
        label_kredit();

        $('#debet').keyup(function() {
          label_debet();
        });

        $('#kredit').keyup(function() {
          label_kredit();
        });

      });

    </script>