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
        <li><a href="<?php echo base_url(); ?>index.php/simpanan3thmastercon"><i class="fa fa-credit-card"></i> Simpanan 3 Th</a></li>
        <li class="active"><a href="<?php echo base_url(); ?>index.php/simpanan3thmastercon/view_simpanan3thmaster<?php echo $simpanan3thmaster->id?>"><i class="fa fa-credit-card"></i>View Simpanan 3 Th Baru</a></li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">
	     <div class="col-md-12 pull-left">
          <!-- general form elements -->
          <div class="box box-danger">
  		      <legend style="text-align:center;">TAMBAH SIMPANAN 3 TH BARU</legend>
            <form action="<?php echo base_url();?>index.php/simpanan3thmastercon/insert_simpanan3thmaster" method="post" enctype="multipart/form-data" role="form">
              <div class="box-body">
                <div class="form-group col-xs-12">
                  <label for="exampleInputEmail1">Nama</label>
                  <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $simpanan3thmaster->nama?>" readonly>
                </div>
                <div class="form-group col-xs-6">
                  <label for="exampleInputPassword1">Kode Debet Penerimaan Simpanan</label>
                  <input class="form-control" id="kode_debet_penerimaan_simp" name="kode_debet_penerimaan_simp" value="<?php echo $simpanan3thmaster->kode_debet_penerimaan_simp?>" readonly>
                </div>
                <div class="form-group col-xs-6">
                  <label for="exampleInputPassword1">Kode Kredit Penerimaan Simpanan</label>
                  <input class="form-control" id="kode_kredit_penerimaan_simp" name="kode_kredit_penerimaan_simp" value="<?php echo $simpanan3thmaster->kode_kredit_penerimaan_simp?>" readonly>
                </div>
                <div class="form-group col-xs-6">
                  <label for="exampleInputPassword1">Kode Debet Pencairan Simpanan</label>
                  <input class="form-control" id="kode_debet_pencairan_simp" name="kode_debet_pencairan_simp" value="<?php echo $simpanan3thmaster->kode_debet_pencairan_simp?>" readonly>
                </div>
                <div class="form-group col-xs-6">
                  <label for="exampleInputPassword1">Kode Kredit Pencairan Simpanan</label>
                  <input class="form-control" id="kode_kredit_pencairan_simp" name="kode_kredit_pencairan_simp" value="<?php echo $simpanan3thmaster->kode_kredit_pencairan_simp?>" readonly>
                </div>
                <div class="form-group col-xs-6">
                  <label for="exampleInputPassword1">Kode Debet Pencairan Hutang Jasa</label>
                  <input class="form-control" id="kode_debet_pencairan_hutang_jasa" name="kode_debet_pencairan_hutang_jasa" value="<?php echo $simpanan3thmaster->kode_debet_pencairan_hutang_jasa?>" readonly>
                </div>
                <div class="form-group col-xs-6">
                  <label for="exampleInputPassword1">Kode Kredit Pencairan Hutang Jasa</label>
                  <input class="form-control" id="kode_kredit_pencairan_hutang_jasa" name="kode_kredit_pencairan_hutang_jasa" value="<?php echo $simpanan3thmaster->kode_kredit_pencairan_hutang_jasa?>" readonly>
                </div>
                <div class="form-group col-xs-6">
                  <label for="exampleInputPassword1">Kode Debet Pembayaran Jasa</label>
                  <input class="form-control" id="kode_debet_pembayaran_jasa" name="kode_debet_pembayaran_jasa" value="<?php echo $simpanan3thmaster->kode_debet_pembayaran_jasa?>" readonly>
                </div>
                <div class="form-group col-xs-6">
                  <label for="exampleInputPassword1">Kode Kredit Pembayaran Jasa</label>
                  <input class="form-control" id="kode_kredit_pembayaran_jasa" name="kode_kredit_pembayaran_jasa" value="<?php echo $simpanan3thmaster->kode_kredit_pembayaran_jasa?>" readonly>
                </div>
                <div class="form-group col-xs-6">
                  <label for="exampleInputPassword1">Kode Debet Penyesuaian Jasa</label>
                  <input class="form-control" id="kode_debet_penyesuaian_jasa" name="kode_debet_penyesuaian_jasa" value="<?php echo $simpanan3thmaster->kode_debet_penyesuaian_jasa?>" readonly>
                </div>
                <div class="form-group col-xs-6">
                  <label for="exampleInputPassword1">Kode Kredit Penyesuaian Jasa</label>
                  <input class="form-control" id="kode_kredit_penyesuaian_jasa" name="kode_kredit_penyesuaian_jasa" value="<?php echo $simpanan3thmaster->kode_kredit_penyesuaian_jasa?>" readonly>
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