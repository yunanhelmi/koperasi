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
        Simpanan 3 Th
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>index.php/petugaslapangancon"><i class="fa fa-credit-card"></i> Petugas Lapangan</a></li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">
	     <div class="col-md-12 pull-left">
          <!-- general form elements -->
          <div class="box box-danger">
  		      <legend style="text-align:center;">EDIT PETUGAS LAPANGAN BARU</legend>
            <form action="<?php echo base_url();?>index.php/petugaslapangancon/update_petugas_lapangan" method="post" enctype="multipart/form-data" role="form">
              <div class="box-body">
                <div class="form-group col-xs-12">
                  <label for="exampleInputEmail1">Nama</label>
                  <input type="hidden" class="form-control" id="id" name="id" value="<?php echo $data->id ?>">
                  <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama" value="<?php echo $data->nama ?>">
                </div>
                <div class="form-group col-xs-12">
                  <label for="exampleInputEmail1">NIK</label>
                  <input type="text" class="form-control" id="nik" name="nik" placeholder="NIK" value="<?php echo $data->nik ?>">
                </div>
                <div class="form-group col-xs-6">
                  <label for="exampleInputPassword1">Tanggal Lahir</label>
                  <div class="input-group date">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <?php $date = strtotime($data->tgl_lahir);?>
                    <input type="text" class="form-control pull-right" name="tgl_lahir" id="tgl_lahir" value="<?php echo date("d-m-Y", $date);?>" data-date-format="dd-mm-yyyy">
                  </div>
                </div>
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <div class="col-xs-3">
                  <button name="tambah_user" type="submit" class="btn btn-primary">Simpan</button>
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
    <script type="text/javascript">
      $(document).ready(function() {
        $('#tgl_lahir').datepicker({}).on('changeDate', function(ev){});
      });
    </script>
