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
        Pinjaman
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>index.php/nasabahcon"><i class="fa fa-users"></i> Pinjaman</a></li>
        <li class="active"><a href="<?php echo base_url(); ?>iindex.php/pinjamancon/create_pinjaman"><i class="fa fa-table"></i>Edit Pinjaman</a></li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">
	     <div class="col-md-12 pull-left">
          <!-- general form elements -->
          <div class="box box-danger">
  		      <legend style="text-align:center;">EDIT PINJAMAN</legend>
            <form action="<?php echo base_url();?>index.php/pinjamancon/update_pinjaman" method="post" enctype="multipart/form-data" role="form">
              <div class="box-body">
                <div class="form-group col-xs-6">
                  <label for="exampleInputEmail1">Nama Anggota</label>
                  <select id="id_nasabah" name="id_nasabah" class="form-control select2" style="width: 100%;">
                    <option></option>
                    <?php 
                      for($i=0; $i<sizeof($nasabah); $i++) {
                    ?>
                        <option value='<?php echo $nasabah[$i]['id'];?>' <?php echo $pinjaman->id_nasabah == $nasabah[$i]['id'] ? 'selected' : ''; ?> ><?php echo $nasabah[$i]['nama'].' || '.$nasabah[$i]['nik']?></option>
                     <?php 
                      }
                    ?>
                  </select>
                  <!--<input type="text" class="form-control" id="nama_nasabah" name="nama_nasabah" placeholder="Nama Nasabah">-->
                  <input type="hidden" class="form-control" id="nama_nasabah" name="nama_nasabah" value="<?php echo $pinjaman->nama_nasabah?>">
                  <input type="hidden" class="form-control" id="id" name="id" value="<?php echo $pinjaman->id?>">
                </div>
                <div class="form-group col-xs-6">
                  <label for="exampleInputPassword1">NIK Anggota</label>
                  <input type="text" class="form-control" id="nik_nasabah" name="nik_nasabah" value="<?php echo $pinjaman->nik_nasabah?>" placeholder="NIK Nasabah" readonly>
                </div>
                <div class="form-group col-xs-6">
                  <label for="exampleInputPassword1">Jenis Pinjaman</label>
                  <select id="jenis_pinjaman" name="jenis_pinjaman" class="form-control" style="width: 100%;">
                    <option value='Musiman' <?php echo $pinjaman->jenis_pinjaman == 'Musiman' ? 'selected' : ''?> >Musiman</option>
                    <option value='Angsuran' <?php echo $pinjaman->jenis_pinjaman == 'Angsuran' ? 'selected' : ''?> >Angsuran</option>
                  </select>
                </div>
                <div class="form-group col-xs-6">
                  <label for="exampleInputPassword1">Jaminan</label>
                  <input type="text" class="form-control" id="jaminan" name="jaminan" value="<?php echo $pinjaman->jaminan?>" placeholder="Jaminan">
                </div>
                <div class="form-group col-xs-6">
                  <label for="exampleInputPassword1">Tanggal Pinjaman</label>
                  <div class="input-group date">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <?php $date = strtotime($pinjaman->waktu);?>
                    <input type="text" class="form-control pull-right" name="waktu" id="waktu" value="<?php echo date("d-m-Y",$date);?>" data-date-format="dd-mm-yyyy">
                  </div>
                </div>
                <div class="form-group col-xs-6">
                  <label for="exampleInputPassword1">Jatuh Tempo</label>
                  <input type="text" class="form-control" value="<?php echo $pinjaman->jatuh_tempo?>" id="jatuh_tempo" name="jatuh_tempo" placeholder="Jatuh Tempo">
                </div>
                <div class="form-group col-xs-6">
                  <label for="exampleInputPassword1">Jumlah Pinjaman</label>
                  <div class="input-group margin-bottom-sm">
                    <span class="input-group-addon">Rp</span>
                    <input type="text" class="form-control" value="<?php echo $pinjaman->jumlah_pinjaman?>" id="jumlah_pinjaman" name="jumlah_pinjaman" placeholder="Jumlah Pinjaman">
                  </div>
                  <div id="label_jumlah_pinjaman" class="alert-danger"></div>
                </div>
                <div class="form-group col-xs-3">
                  <label for="exampleInputPassword1">Jumlah Angsuran</label>
                  <input type="text" class="form-control" value="<?php echo $pinjaman->jumlah_angsuran?>" id="jumlah_angsuran" name="jumlah_angsuran" placeholder="Jumlah Angsuran">
                </div>
                <div class="form-group col-xs-6">
                  </br>
                </div>
                <div class="form-group col-xs-6">
                  <label for="exampleInputPassword1">Angsuran Perbulan</label>
                  <div class="input-group margin-bottom-sm">
                    <span class="input-group-addon">Rp</span>
                    <input type="text" class="form-control" value="<?php echo $pinjaman->angsuran_perbulan?>" id="angsuran_perbulan" name="angsuran_perbulan" placeholder="0">
                  </div>
                  <div id="label_angsuran_perbulan" class="alert-danger"></div> 
                </div>
                <div class="form-group col-xs-6">
                  <label for="exampleInputPassword1">Jasa Perbulan</label>
                  <div class="input-group margin-bottom-sm">
                    <span class="input-group-addon">Rp</span>
                    <input type="text" class="form-control" value="<?php echo $pinjaman->jasa_perbulan?>" id="jasa_perbulan" name="jasa_perbulan" placeholder="0">
                  </div>
                  <div id="label_jasa_perbulan" class="alert-danger"></div> 
                </div>
                <div class="form-group col-xs-6">
                  <label for="exampleInputPassword1">Total Angsuran Perbulan</label>
                  <div class="input-group margin-bottom-sm">
                    <span class="input-group-addon">Rp</span>
                    <input type="text" class="form-control" value="<?php echo $pinjaman->total_angsuran_perbulan?>" id="total_angsuran_perbulan" name="total_angsuran_perbulan" placeholder="0">
                  </div>
                  <div id="label_total_angsuran_perbulan" class="alert-danger"></div> 
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

      function label_jumlah_pinjaman() {
        var jumlah_pinjaman=$('#jumlah_pinjaman').val();
        $("#label_jumlah_pinjaman").html('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Rp&nbsp;&nbsp;&nbsp;&nbsp&nbsp;&nbsp;&nbsp;&nbsp'+formatRupiah(Math.floor(jumlah_pinjaman)));
      }

      function label_angsuran_perbulan() {
        var angsuran_perbulan = $('#angsuran_perbulan').val();
        $("#label_angsuran_perbulan").html('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Rp&nbsp;&nbsp;&nbsp;&nbsp&nbsp;&nbsp;&nbsp;&nbsp'+formatRupiah(Math.floor(angsuran_perbulan)));
      }  

      function label_jasa_perbulan() {
        var jasa_perbulan = $('#jasa_perbulan').val();
        $("#label_jasa_perbulan").html('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Rp&nbsp;&nbsp;&nbsp;&nbsp&nbsp;&nbsp;&nbsp;&nbsp'+formatRupiah(Math.floor(jasa_perbulan)));
      }

      function label_total_angsuran_perbulan() {
        var total_angsuran_perbulan = $('#total_angsuran_perbulan').val();
        $("#label_total_angsuran_perbulan").html('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Rp&nbsp;&nbsp;&nbsp;&nbsp&nbsp;&nbsp;&nbsp;&nbsp'+formatRupiah(Math.floor(total_angsuran_perbulan)));
      }

      function hitung_angsuran_perbulan() {
        //var e = document.getElementById("jenis_pinjaman");
        //if(e.options[e.selectedIndex].value == "Angsuran") {
          if($('#jumlah_pinjaman').val() != "" && $('#jumlah_pinjaman').val() != NaN && $('#jumlah_pinjaman').val() != null) {
            var jumlah_pinjaman = parseInt($('#jumlah_pinjaman').val());
          } else {
            var jumlah_pinjaman = 0;
          }
          if($('#jumlah_angsuran').val() != "" && $('#jumlah_angsuran').val() != NaN && $('#jumlah_angsuran').val() != null) {
            var jumlah_angsuran = parseInt($('#jumlah_angsuran').val());
          } else {
            var jumlah_angsuran = 1;
          }
          console.log(jumlah_angsuran);
          var angsuran_perbulan = jumlah_pinjaman / jumlah_angsuran;
          $('#angsuran_perbulan').val(angsuran_perbulan);
          label_angsuran_perbulan();
          hitung_total_angsuran_perbulan();  
        //}
      }

      function hitung_jasa_perbulan() {
        var e = document.getElementById("jenis_pinjaman");
        if(e.options[e.selectedIndex].value == "Angsuran") {
          if($('#jumlah_pinjaman').val() != "" && $('#jumlah_pinjaman').val() != NaN && $('#jumlah_pinjaman').val() != null) {
            var jumlah_pinjaman = parseInt($('#jumlah_pinjaman').val());
          } else {
            var jumlah_pinjaman = 0;
          }
          var jasa_perbulan = (jumlah_pinjaman * 2) / 100;
          $('#jasa_perbulan').val(jasa_perbulan);
          label_jasa_perbulan();
          hitung_total_angsuran_perbulan();
        } else if(e.options[e.selectedIndex].value == "Musiman") {
          if($('#jumlah_pinjaman').val() != "" && $('#jumlah_pinjaman').val() != NaN && $('#jumlah_pinjaman').val() != null) {
            var jumlah_pinjaman = parseInt($('#jumlah_pinjaman').val());
          } else {
            var jumlah_pinjaman = 0;
          }
          var jasa_perbulan = (jumlah_pinjaman * 3) / 100;
          $('#jasa_perbulan').val(jasa_perbulan);
          label_jasa_perbulan();
          hitung_total_angsuran_perbulan();
        }
      }

      function hitung_total_angsuran_perbulan() {
        //var e = document.getElementById("jenis_pinjaman");
        //if(e.options[e.selectedIndex].value == "Angsuran") {
          if($('#angsuran_perbulan').val() != "" && $('#angsuran_perbulan').val() != NaN && $('#angsuran_perbulan').val() != null) {
            var angsuran_perbulan = parseInt($('#angsuran_perbulan').val());
          } else {
            var angsuran_perbulan = 0;
          }
          if($('#jasa_perbulan').val() != "" && $('#jasa_perbulan').val() != NaN && $('#jasa_perbulan').val() != null) {
            var jasa_perbulan = parseInt($('#jasa_perbulan').val());
          } else {
            var jasa_perbulan = 0;
          }
          var total_angsuran_perbulan = angsuran_perbulan + jasa_perbulan;
          $('#total_angsuran_perbulan').val(total_angsuran_perbulan);
          label_total_angsuran_perbulan();
        }
      //}

      $(document).ready(function(){
        $('.select2').select2();

        $('#waktu').datepicker({}).on('changeDate', function(ev){});

        $( "#id_nasabah" ).change(function() {
          $.ajax({
            type: "POST",
            url: "<?php echo base_url('pinjamancon/pickNasabah') ;?>",
            data: { id_nasabah: $( "#id_nasabah" ).val() },
            cache: true,
            success:
              function(result)
              {
                var nik = result.split("||");
                $( "#nama_nasabah" ).val(nik[0]);
                $( "#nik_nasabah" ).val(nik[1]);
                console.log(nik[1]);
              }
            });
        });

        label_jumlah_pinjaman();
        label_angsuran_perbulan();
        label_jasa_perbulan();
        label_total_angsuran_perbulan();

        $('#jenis_pinjaman').change(function() {
          hitung_jasa_perbulan();
        });

        $('#jumlah_pinjaman').keyup(function() {
          label_jumlah_pinjaman();
          hitung_angsuran_perbulan();
          hitung_jasa_perbulan();
        });
        $('#jumlah_angsuran').keyup(function() {
          hitung_angsuran_perbulan();
        });

      });

    </script>