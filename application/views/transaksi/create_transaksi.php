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
        Akuntansi
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>index.php/transaksicon"><i class="fa fa-usd"></i> Transaksi Lain-Lain</a></li>
        <li class="active"><a href="<?php echo base_url(); ?>index.php/transaksicon/create_transaksi"><i class="fa fa-table"></i> Tambah Transaksi Lain-Lain Baru</a></li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">
       <div class="col-md-12 pull-left">
          <!-- general form elements -->
          <div class="box box-danger">
            <legend style="text-align:center;">TRANSAKSI LAIN-LAIN BARU</legend>
            <form action="<?php echo base_url();?>index.php/transaksicon/insert_transaksi" method="post" enctype="multipart/form-data" role="form">
              <div class="box-body">
                <div class="form-group col-xs-6">
                  <label for="exampleInputPassword1">Tanggal</label>
                  <div class="input-group date">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <input type="text" class="form-control pull-right" name="tanggal" id="tanggal" value="<?php echo date("d-m-Y");?>" data-date-format="dd-mm-yyyy">
                  </div>
                </div>
                <div class="form-group col-xs-6">
                  <label for="exampleInputPassword1">Nama Transaksi</label>
                  <input type="text" class="form-control" id="nama_transaksi" name="nama_transaksi" placeholder="">
                </div>
                <div class="form-group col-xs-6">
                  <label for="exampleInputPassword1">Keterangan</label>
                  <input type="text" class="form-control" id="keterangan" name="keterangan" placeholder="">
                </div>
                <div class="form-group col-xs-6">
                  <label for="exampleInputPassword1">Kode Debet</label>
                  <input type="textarea" class="form-control" id="kode_debet" name="kode_debet" placeholder="">
                </div>
                <div class="form-group col-xs-6">
                  <label for="exampleInputPassword1">Kode Kredit</label>
                  <input type="textarea" class="form-control" id="kode_kredit" name="kode_kredit" placeholder="">
                </div>
                <div class="form-group col-xs-6">
                  <label for="exampleInputPassword1">Jumlah</label>
                  <div class="input-group margin-bottom-sm">
                    <span class="input-group-addon">Rp</span>
                    <input type="text" class="form-control" id="jumlah" name="jumlah" placeholder="0">
                  </div>
                  <div id="label_jumlah" class="alert-danger"></div> 
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

      function label_jumlah() {
        var jumlah = $('#jumlah').val();
        $("#label_jumlah").html('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Rp&nbsp;&nbsp;&nbsp;&nbsp&nbsp;&nbsp;&nbsp;&nbsp'+formatRupiah(Math.floor(jumlah)));
      }

      $(document).ready(function(){
        $('#tanggal').datepicker({}).on('changeDate', function(ev){});

        label_jumlah();

        $('#jumlah').keyup(function() {
          label_jumlah();
        });

        var nama_transaksi = [<?php echo $nama_transaksi; ?>];

        $('#nama_transaksi').typeahead({
            source: function (query, process) {
            states2 = [];
            map2 = {};
            
            var source = [];
            $.each(nama_transaksi, function (i, state) {
              map2[state.stateName] = state;
              states2.push(state.stateName);
            });
           
            process(states2);
            
            },
            updater: function (item) {
                
            selectedState = map2[item].stateCode;
            selectedState2 = map2[item].kodeDebet;
            selectedState3 = map2[item].kodeKredit;
            $("#kode_debet").val(selectedState2);
            $("#kode_kredit").val(selectedState3);
            return selectedState;
            },
            matcher: function (item) {
                if (item.toLowerCase().indexOf(this.query.trim().toLowerCase()) != -1) {
              return true;
            }
            },
            sorter: function (items) {
                return items.sort();
            },
            highlighter: function (item) {
            var regex = new RegExp( '(' + this.query + ')', 'gi' );
            return item.replace( regex, "<strong>$1</strong>" );
            
            },
        });

      });

    </script>