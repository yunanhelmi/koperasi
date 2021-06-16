<script src="<?php echo base_url(); ?>assets/js/jquery-1.11.3.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/js/highcharts.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/js/exporting.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/js/data.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/js/canvas-tools.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/js/export-csv.js" type="text/javascript"></script>
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Nasabah
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>index.php/nasabahcon"><i class="fa fa-users"></i> Anggota</a></li>
        <li class="active"><i class="fa fa-pencil"></i> Edit Anggota</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-3">

          <!-- Profile Image -->
          <div class="box box-primary">
            <div class="box-body box-profile">
              <?php
              if($nasabah->file_foto != null || $nasabah->file_foto != "") {
                $path = explode("./", $nasabah->file_foto );
              } else {
                $path[1] = '';
              }
                
              ?>
              <img class="profile-user-img img-responsive img-circle"style="width:200px;height:200px;" src=<?php echo base_url().$path[1]; ?> alt="User profile picture">
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>

        <div class="col-md-9 pull-left">
          <!-- general form elements -->
          <div class="box box-primary">
  		      <legend style="text-align:center;">EDIT ANGGOTA</legend>
            <form action="<?php echo base_url();?>index.php/nasabahcon/update_nasabah" method="post" enctype="multipart/form-data" role="form">
              <div class="box-body">
                <div class="form-group col-xs-6">
                  <label for="exampleInputEmail1">Nama</label>
                  <?php echo '<input type="text" class="form-control" id="nama" name="nama" placeholder="Nama" value="'.$nasabah->nama.'">'; ?>
                  <?php echo '<input type=hidden class=form-control id=id name=id value="'.$nasabah->id.'" >'; ?>
                </div>
                <?php
                      $nomor = str_pad( $nasabah->nomor_nasabah, 5, "0", STR_PAD_LEFT );
                      $nomor_nasabah = $nasabah->jenis_nasabah.$nomor;
                    ?>
                <div class="form-group col-xs-6">
                  <label for="exampleInputPassword1">Nomor Anggota</label>
                  <?php echo '<input type="text" class="form-control" id="nomor_nasabah" name="nomor_nasabah" placeholder="Nomor Nasabah" value="'.$nomor_nasabah.'" readonly>'?>
                </div>
                <div class="form-group col-xs-6">
                  <label for="exampleInputPassword1">NIK</label>
                  <?php echo '<input type="text" class="form-control" id="nik" name="nik" placeholder="NIK" value="'.$nasabah->nik.'">'?>
                </div>
                <div class="form-group col-xs-6">
                  <label for="exampleInputPassword1">No. HP / Telepon</label>
                  <?php echo '<input type="text" class="form-control" id="telpon" name="telpon" placeholder="No. HP / Telepon" value="'.$nasabah->telpon.'">'?>
                </div>
                <div class="form-group col-xs-6">
                  <label for="exampleInputPassword1">Pekerjaan</label>
                  <?php echo '<input type="text" class="form-control" id="pekerjaan" name="pekerjaan" placeholder="Pekerjaan" value="'.$nasabah->pekerjaan.'">'?>
                </div>
                <div class="form-group col-xs-6">
                  <label for="exampleInputPassword1">Alamat</label>
                  <?php echo '<input type="text" class="form-control" id="alamat" name="alamat" placeholder="Alamat" value="'.$nasabah->alamat.'" >'; ?>
                </div>
                <div class="form-group col-xs-6">
                  <label for="exampleInputPassword1">Kota/Kab</label>
                  <?php echo '<input type="text" class="form-control" id="kota" name="kota" placeholder="Kota/Kab" value="'.$nasabah->kota.'">'; ?>
                </div>
                <div class="form-group col-xs-6">
                  <label for="exampleInputPassword1">Kecamatan</label>
                  <?php echo '<input type="text" class="form-control" id="kecamatan" name="kecamatan" placeholder="Kecamatan" value="'.$nasabah->kecamatan.'">'; ?>
                </div>
                <div class="form-group col-xs-6">
                  <label for="exampleInputPassword1">Kelurahan/Desa</label>
                  <?php echo '<input type="text" class="form-control" id="kelurahan" name="kelurahan" placeholder="Kelurahan/Desa" value="'.$nasabah->kelurahan.'">'; ?>
                </div>
                <div class="form-group col-xs-6">
                  <label for="exampleInputPassword1">Dusun</label>
                  <?php echo '<input type="text" class="form-control" id="dusun" name="dusun" placeholder="Dusun" value="'.$nasabah->dusun.'">'; ?>
                </div>
                <div class="form-group col-xs-3">
                  <label for="exampleInputPassword1">RT</label>
                  <?php echo '<input type="text" class="form-control" id="rt" name="rt" placeholder="RT" value="'.$nasabah->rt.'">'; ?>
                </div>
                <div class="form-group col-xs-3">
                  <label for="exampleInputPassword1">RW</label>
                  <?php echo '<input type="text" class="form-control" id="rw" name="rw" placeholder="RW" value="'.$nasabah->rw.'">'; ?>
                </div>
                <div class="form-group col-xs-3">
                  <label for="exampleInputFile">Foto</label>
                  <?php echo '<input type="file" accept=".jpg, .jpeg, .png" name="filefoto" value"'.$nasabah->file_foto.'">' ?>
                </div>
                <div class="form-group col-xs-6">
                  <label for="exampleInputPassword1">Reputasi</label>
                  <select id="blacklist" name="blacklist" class="form-control">
                    <option value=0 <?php echo $nasabah->blacklist == 0 ? 'selected' : ''?> >-</option>
                    <option value=1 <?php echo $nasabah->blacklist == 1 ? 'selected' : ''?> >BL</option>
                  </select>
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
