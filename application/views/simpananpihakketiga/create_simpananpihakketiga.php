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
        <li class="active"><a href="<?php echo base_url(); ?>iindex.php/simpananpihakketigacon/create_simpananpihakketiga"><i class="fa fa-table"></i>Simpanan Pihak Ketiga</a></li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">
	     <div class="col-md-12 pull-left">
          <!-- general form elements -->
          <div class="box box-danger">
  		      <legend style="text-align:center;">SIMPANAN PIHAK KETIGA BARU</legend>
            <form action="<?php echo base_url();?>index.php/simpananpihakketigacon/insert_simpananpihakketiga" method="post" enctype="multipart/form-data" role="form">
              <div class="box-body">
                <div class="form-group col-xs-6">
                  <label for="exampleInputEmail1">Nama</label>
                  <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama">
                </div>
                <div class="form-group col-xs-6">
                  <label for="exampleInputPassword1">NIK</label>
                  <input type="text" class="form-control" id="nik" name="nik" placeholder="NIK">
                </div>
                <div class="form-group col-xs-6">
                  <label for="exampleInputPassword1">No. HP / Telepon</label>
                  <input type="text" class="form-control" id="telpon" name="telpon" placeholder="No. HP / Telepon">
                </div>
                <div class="form-group col-xs-6">
                  <label for="exampleInputPassword1">Pekerjaan</label>
                  <input type="text" class="form-control" id="pekerjaan" name="pekerjaan" placeholder="Pekerjaan">
                </div>
                <div class="form-group col-xs-6">
                  <label for="exampleInputPassword1">Alamat</label>
                  <input type="text" class="form-control" id="alamat" name="alamat" placeholder="Alamat">
                </div>
                <div class="form-group col-xs-6">
                  <label for="exampleInputPassword1">Kota/Kab</label>
                  <input type="text" class="form-control" id="kota" name="kota" placeholder="Kota/Kab">
                </div>
                <div class="form-group col-xs-6">
                  <label for="exampleInputPassword1">Kecamatan</label>
                  <input type="text" class="form-control" id="kecamatan" name="kecamatan" placeholder="Kecamatan">
                </div>
                <div class="form-group col-xs-6">
                  <label for="exampleInputPassword1">Kelurahan/Desa</label>
                  <input type="text" class="form-control" id="kelurahan" name="kelurahan" placeholder="Kelurahan/Desa">
                </div>
                <div class="form-group col-xs-6">
                  <label for="exampleInputPassword1">Dusun</label>
                  <input type="text" class="form-control" id="dusun" name="dusun" placeholder="Dusun">
                </div>
                <div class="form-group col-xs-3">
                  <label for="exampleInputPassword1">RW</label>
                  <input type="text" class="form-control" id="rw" name="rw" placeholder="RW">
                </div>
                <div class="form-group col-xs-3">
                  <label for="exampleInputPassword1">RT</label>
                  <input type="text" class="form-control" id="rt" name="rt" placeholder="RT">
                </div>
                <div class="form-group col-xs-6">
                  <label for="exampleInputPassword1">Tanggal</label>
                  <div class="input-group date">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <input type="text" class="form-control pull-right" name="tanggal" id="tanggal" value="<?php echo date("d-m-Y");?>" data-date-format="dd-mm-yyyy">
                  </div>
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
      $(document).ready(function(){
        $('.select2').select2();

        $('#tanggal').datepicker({}).on('changeDate', function(ev){});

      });

    </script>