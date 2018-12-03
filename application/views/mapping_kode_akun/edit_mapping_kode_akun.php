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
        <li><a href="<?php echo base_url(); ?>index.php/mappingkodeakuncon"><i class="fa fa-users"></i> Mapping Kode Akun</a></li>
        <li class="active"><a href="<?php echo base_url(); ?>index.php/mappingkodeakuncon/create_kode_akun"><i class="fa fa-table"></i>Edit Mapping Kode Akun </a></li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">
       <div class="col-md-12 pull-left">
          <!-- general form elements -->
          <div class="box box-danger">
            <legend style="text-align:center;">EDIT MAPPING KODE AKUN</legend>
            <form action="<?php echo base_url();?>index.php/mappingkodeakuncon/update_mapping_kode_akun" method="post" enctype="multipart/form-data" role="form">
              <div class="box-body">
                <div class="form-group col-xs-6">
                  <label for="exampleInputPassword1">Nama Transaksi</label>
                  <input type="hidden" class="form-control" id="id" name="id" value="<?php echo $mapping_kode_akun->id?>">
                  <input type="text" class="form-control" id="nama_transaksi" name="nama_transaksi" value="<?php echo $mapping_kode_akun->nama_transaksi?>" placeholder="Nama Transaksi">
                </div>
                <div class="form-group col-xs-6">
                  <label for="exampleInputPassword1">Kode Debet</label>
                  <input type="text" class="form-control" id="kode_debet" name="kode_debet" value="<?php echo $mapping_kode_akun->kode_debet?>" placeholder="Nama Akun">
                </div>
                <div class="form-group col-xs-6">
                  <label for="exampleInputPassword1">Kode Kredit</label>
                  <input type="textarea" class="form-control" id="kode_kredit" name="kode_kredit" value="<?php echo $mapping_kode_akun->kode_kredit?>" placeholder="Kode Kredit">
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
        var kode_akun = [<?php echo $kode_akun; ?>];

        $('#kode_debet').typeahead({
            source: function (query, process) {
            states2 = [];
            map2 = {};
            
            var source = [];
            $.each(kode_akun, function (i, state) {
              map2[state.stateName] = state;
              states2.push(state.stateName);
            });
           
            process(states2);
            
            },
            updater: function (item) {
                
            selectedState = map2[item].stateCode;
            selectedState2 = map2[item].stateDisplay;
            return selectedState2;
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

        $('#kode_kredit').typeahead({
            source: function (query, process) {
            states2 = [];
            map2 = {};
            
            var source = [];
            $.each(kode_akun, function (i, state) {
              map2[state.stateName] = state;
              states2.push(state.stateName);
            });
           
            process(states2);
            
            },
            updater: function (item) {
                
            selectedState = map2[item].stateCode;
            selectedState2 = map2[item].stateDisplay;
            return selectedState2;
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