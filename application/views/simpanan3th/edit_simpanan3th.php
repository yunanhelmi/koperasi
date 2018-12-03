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
        Simpanan 3 Th
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>index.php/nasabahcon"><i class="fa fa-users"></i> Simpanan 3 Th</a></li>
        <li class="active"><a href="<?php echo base_url(); ?>iindex.php/simpanan3thcon/update_simpanan3th"><i class="fa fa-table"></i>Edit Simpanan 3 Th</a></li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">
	     <div class="col-md-12 pull-left">
          <!-- general form elements -->
          <div class="box box-danger">
  		      <legend style="text-align:center;">EDIT SIMPANAN 3 TH</legend>
            <form action="<?php echo base_url();?>index.php/simpanan3thcon/update_simpanan3th" method="post" enctype="multipart/form-data" role="form">
              <div class="box-body">
                <div class="form-group col-xs-6">
                  <label for="exampleInputEmail1">Nama Anggota</label>
                  <select id="id_nasabah" name="id_nasabah" class="form-control select2" style="width: 100%;">
                    <option></option>
                    <?php 
                      for($i=0; $i<sizeof($nasabah); $i++) {
                    ?>
                        <option value='<?php echo $nasabah[$i]['id'];?>' <?php echo $simpanan3th->id_nasabah == $nasabah[$i]['id'] ? 'selected' : ''; ?> ><?php echo $nasabah[$i]['nama'].' || '.$nasabah[$i]['nik']?></option>
                     <?php 
                      }
                    ?>
                  </select>
                  <!--<input type="text" class="form-control" id="nama_nasabah" name="nama_nasabah" placeholder="Nama Nasabah">-->
                  <input type="hidden" class="form-control" id="nama_nasabah" name="nama_nasabah" value="<?php echo $simpanan3th->nama_nasabah?>">
                  <input type="hidden" class="form-control" id="id" name="id" value="<?php echo $simpanan3th->id?>">
                </div>
                <div class="form-group col-xs-6">
                  <label for="exampleInputPassword1">Nomor Anggota</label>
                  <input type="text" class="form-control" id="nomor_nasabah" name="nomor_nasabah" value="<?php echo $simpanan3th->nomor_nasabah?>" placeholder="NIK Anggota" readonly>
                </div>
                <div class="form-group col-xs-6">
                  <label for="exampleInputPassword1">NIK</label>
                  <input type="text" class="form-control" id="nik_nasabah" name="nik_nasabah" value="<?php echo $simpanan3th->nik_nasabah?>" placeholder="NIK Anggota" readonly>
                </div>
                <div class="form-group col-xs-6">
                  <label for="exampleInputPassword1">SIMPANAN KE</label>
                  <input type="text" class="form-control" id="simpanan_ke" name="simpanan_ke" value="<?php echo $simpanan3th->simpanan_ke?>" placeholder="Simpanan ke-">
                </div>
                <div class="form-group col-xs-6">
                  <label for="exampleInputPassword1">Tanggal</label>
                  <div class="input-group date">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <?php $date = strtotime($simpanan3th->waktu);?>
                    <input type="text" class="form-control pull-right" name="tanggal" id="tanggal" value="<?php echo date("d-m-Y",$date);?>" data-date-format="dd-mm-yyyy">
                  </div>
                </div>
                <div class="form-group col-xs-6">
                  <label for="exampleInputPassword1">Total</label>
                  <div class="input-group margin-bottom-sm">
                    <span class="input-group-addon">Rp</span>
                    <input type="text" class="form-control" value="<?php echo $simpanan3th->total?>" id="total" name="total" placeholder="0">
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

        $( "#id_nasabah" ).change(function() {
          $.ajax({
            type: "POST",
            url: "<?php echo base_url('simpanan3thcon/pickNasabah') ;?>",
            data: { id_nasabah: $( "#id_nasabah" ).val() },
            cache: true,
            success:
              function(result)
              {
                var nik = result.split("||");
                $( "#nama_nasabah" ).val(nik[0]);
                $( "#nik_nasabah" ).val(nik[1]);
                $( "#nomor_nasabah" ).val(nik[2]);
              }
            });
        });

        label_total();

        $('#total').keyup(function() {
          label_total();
        });

      });

    </script>