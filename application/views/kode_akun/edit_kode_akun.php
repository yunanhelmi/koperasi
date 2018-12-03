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
        <li><a href="<?php echo base_url(); ?>index.php/kodeakuncon"><i class="fa fa-users"></i> Kode Akun</a></li>
        <li class="active"><a href="<?php echo base_url(); ?>index.php/kodeakuncon/create_kode_akun"><i class="fa fa-table"></i>Edit Kode Akun </a></li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">
       <div class="col-md-12 pull-left">
          <!-- general form elements -->
          <div class="box box-danger">
            <legend style="text-align:center;">EDIT KODE AKUN</legend>
            <form action="<?php echo base_url();?>index.php/kodeakuncon/update_kode_akun" method="post" enctype="multipart/form-data" role="form">
              <div class="box-body">
                <div class="form-group col-xs-6">
                  <label for="exampleInputPassword1">Kode Akun</label>
                  <input type="hidden" class="form-control" id="id" name="id" value="<?php echo $kode_akun->id?>">
                  <input type="text" class="form-control" id="kode_akun" name="kode_akun" value="<?php echo $kode_akun->kode_akun?>" placeholder="Kode Akun">
                </div>
                <div class="form-group col-xs-6">
                  <label for="exampleInputPassword1">Nama Akun</label>
                  <input type="text" class="form-control" id="nama_akun" name="nama_akun" value="<?php echo $kode_akun->nama_akun?>" placeholder="Nama Akun">
                </div>
                <div class="form-group col-xs-6">
                  <label for="exampleInputPassword1">Keterangan</label>
                  <input type="textarea" class="form-control" id="keterangan" name="keterangan" value="<?php echo $kode_akun->keterangan?>" placeholder="Keterangan">
                </div>
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <div class="col-xs-3">
                  <button type="submit" class="btn btn-primary">Update</button>
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

      $(document).ready(function(){

      });

    </script>