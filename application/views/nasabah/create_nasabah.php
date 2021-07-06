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
        <li class="active"><a href="<?php echo base_url(); ?>iindex.php/nasabahcon/create_nasabah"><i class="fa fa-table"></i>Tambah Anggota Baru</a></li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">
	     <div class="col-md-12 pull-left">
          <!-- general form elements -->
          <div class="box box-danger">
  		      <legend style="text-align:center;">TAMBAH ANGGOTA BARU</legend>
            <form action="<?php echo base_url();?>index.php/nasabahcon/insert_nasabah" method="post" enctype="multipart/form-data" role="form">
              <div class="box-body">
                <div class="form-group col-xs-6">
                  <label for="exampleInputEmail1">Nama</label>
                  <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama">
                </div>
                <div class="form-group col-xs-3">
                  <label for="exampleInputEmail1">Jenis Anggota</label>
                  <select id="jenis_nasabah" name="jenis_nasabah" class="form-control" style="width: 100%;">
                    <option value='1'>Anggota</option>
                    <option value='2'>Bukan Anggota</option>
                  </select>
                </div>
                <div class="form-group col-xs-3">
                  <label for="exampleInputEmail1">Nomor Anggota</label>
                  <?php echo '<input type="text" class="form-control" id="nomor_nasabah" name="nomor_nasabah" placeholder="Nomor Nasabah" readonly>'; ?>
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
                <div class="form-group col-xs-3">
                  <label for="exampleInputFile">Foto</label>
                  <input type="file" accept=".jpg, .jpeg, .png" name="filefoto">
                </div>
                <div class="form-group col-xs-6">
                  <label for="exampleInputPassword1">Reputasi</label>
                  <select id="blacklist" name="blacklist" class="form-control">
                    <option value=0>-</option>
                    <option value=1>BL 1</option>
                    <option value=2>BL 2</option>
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

    <script type="text/javascript">
      $(document).ready(function() {
        $.ajax({
            type: "POST",
            url: "<?php echo base_url('nasabahcon/getNomorNasabah') ;?>",
            data: { jenis_nasabah: $( "#jenis_nasabah" ).val() },
            cache: true,
            success:
              function(result)
              {
                var nomor_nasabah = $( "#jenis_nasabah" ).val() + result;
                $( "#nomor_nasabah" ).val(nomor_nasabah);
              }
            });
        
        $('#jenis_nasabah').change(function() {
          $.ajax({
            type: "POST",
            url: "<?php echo base_url('nasabahcon/getNomorNasabah') ;?>",
            data: { jenis_nasabah: $( "#jenis_nasabah" ).val() },
            cache: true,
            success:
              function(result)
              {
                var nomor_nasabah = $( "#jenis_nasabah" ).val() + result;
                $( "#nomor_nasabah" ).val(nomor_nasabah);
              }
            });
        });
      });
    </script>
