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
        Simpanan Pihak Ketiga
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>index.php/simpananpihakketigacon"><i class="fa fa-users"></i> Simpanan Pihak Ketiga</a></li>
        <li class="active"><a href="<?php echo base_url(); ?>iindex.php/simpananpihakketigacon/update_simpananpihakketiga"><i class="fa fa-table"></i>Edit Simpanan Pihak Ketiga</a></li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">
	     <div class="col-md-12 pull-left">
          <!-- general form elements -->
          <div class="box box-danger">
  		      <legend style="text-align:center;">EDIT SIMPANAN PIHAK KETIGA</legend>
            <form action="<?php echo base_url();?>index.php/simpananpihakketigacon/update_simpananpihakketiga" method="post" enctype="multipart/form-data" role="form">
              <div class="box-body">
                <div class="form-group col-xs-6">
                  <label for="exampleInputEmail1">Nama</label>
                  <?php echo '<input type="text" class="form-control" id="nama" name="nama" placeholder="Nama" value="'.$simpananpihakketiga->nama.'">'; ?>
                  <?php echo '<input type=hidden class=form-control id=id name=id value="'.$simpananpihakketiga->id.'" >'; ?>
                </div>
                <div class="form-group col-xs-6">
                  <label for="exampleInputPassword1">NIK</label>
                  <?php echo '<input type="text" class="form-control" id="nik" name="nik" placeholder="NIK" value="'.$simpananpihakketiga->nik.'">'?>
                </div>
                <div class="form-group col-xs-6">
                  <label for="exampleInputPassword1">No. HP / Telepon</label>
                  <?php echo '<input type="text" class="form-control" id="telpon" name="telpon" placeholder="No. HP / Telepon" value="'.$simpananpihakketiga->telpon.'">'?>
                </div>
                <div class="form-group col-xs-6">
                  <label for="exampleInputPassword1">Pekerjaan</label>
                  <?php echo '<input type="text" class="form-control" id="pekerjaan" name="pekerjaan" placeholder="Pekerjaan" value="'.$simpananpihakketiga->pekerjaan.'">'?>
                </div>
                <div class="form-group col-xs-6">
                  <label for="exampleInputPassword1">Alamat</label>
                  <?php echo '<input type="text" class="form-control" id="alamat" name="alamat" placeholder="Alamat" value="'.$simpananpihakketiga->alamat.'" >'; ?>
                </div>
                <div class="form-group col-xs-6">
                  <label for="exampleInputPassword1">Kota/Kab</label>
                  <?php echo '<input type="text" class="form-control" id="kota" name="kota" placeholder="Kota/Kab" value="'.$simpananpihakketiga->kota.'">'; ?>
                </div>
                <div class="form-group col-xs-6">
                  <label for="exampleInputPassword1">Kecamatan</label>
                  <?php echo '<input type="text" class="form-control" id="kecamatan" name="kecamatan" placeholder="Kecamatan" value="'.$simpananpihakketiga->kecamatan.'">'; ?>
                </div>
                <div class="form-group col-xs-6">
                  <label for="exampleInputPassword1">Kelurahan/Desa</label>
                  <?php echo '<input type="text" class="form-control" id="kelurahan" name="kelurahan" placeholder="Kelurahan/Desa" value="'.$simpananpihakketiga->kelurahan.'">'; ?>
                </div>
                <div class="form-group col-xs-6">
                  <label for="exampleInputPassword1">Dusun</label>
                  <?php echo '<input type="text" class="form-control" id="dusun" name="dusun" placeholder="Dusun" value="'.$simpananpihakketiga->dusun.'">'; ?>
                </div>
                <div class="form-group col-xs-3">
                  <label for="exampleInputPassword1">RT</label>
                  <?php echo '<input type="text" class="form-control" id="rt" name="rt" placeholder="RT" value="'.$simpananpihakketiga->rt.'">'; ?>
                </div>
                <div class="form-group col-xs-3">
                  <label for="exampleInputPassword1">RW</label>
                  <?php echo '<input type="text" class="form-control" id="rw" name="rw" placeholder="RW" value="'.$simpananpihakketiga->rw.'">'; ?>
                </div>
                <div class="form-group col-xs-6">
                  <label for="exampleInputPassword1">Tanggal</label>
                  <div class="input-group date">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <?php $date = strtotime($simpananpihakketiga->waktu);?>
                    <input type="text" class="form-control pull-right" name="tanggal" id="tanggal" value="<?php echo date("d-m-Y",$date);?>" data-date-format="dd-mm-yyyy">
                  </div>
                </div>
                <div class="form-group col-xs-6">
                  <label for="exampleInputPassword1">Total</label>
                  <div class="input-group margin-bottom-sm">
                    <span class="input-group-addon">Rp</span>
                    <input type="text" class="form-control" value="<?php echo $simpananpihakketiga->total?>" id="total" name="total" placeholder="0">
                  </div>
                  <div id="label_total" class="alert-danger"></div>
                </div>
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <div class="col-xs-3">
                  <button type="submit" class="btn btn-primary">Simpan</button>
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

      function label_total() {
        var total=$('#total').val();
        $("#label_total").html('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Rp&nbsp;&nbsp;&nbsp;&nbsp&nbsp;&nbsp;&nbsp;&nbsp'+formatRupiah(Math.floor(total)));
      }

      $(document).ready(function(){
        $('.select2').select2();

        $('#tanggal').datepicker({}).on('changeDate', function(ev){});

        label_total();

        $('#total').keyup(function() {
          label_total();
        });

      });

    </script>