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
        <li><a href="<?php echo base_url(); ?>index.php/penerimaansuratcon"><i class="fa fa-users"></i> Draft Penerimaan Surat</a></li>
        <li class="active"><a href="<?php echo base_url(); ?>index.php/penerimaansuratcon/create_penerimaan_surat"><i class="fa fa-table"></i>Draft Penerimaan Surat Baru</a></li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">
       <div class="col-md-12 pull-left">
          <!-- general form elements -->
          <div class="box box-danger">
            <legend style="text-align:center;">DRAFT PENERIMAAN SURAT BARU</legend>
            <form action="<?php echo base_url();?>index.php/penerimaansuratcon/insert_penerimaan_surat" method="post" enctype="multipart/form-data" role="form">
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
                  <label for="exampleInputPassword1">Petugas Lapangan</label>
                  <input type="text" class="form-control" id="nama_petugas_lapangan" name="nama_petugas_lapangan" placeholder="Petugas Lapangan">
                  <input type="hidden" class="form-control" id="id_petugas_lapangan" name="id_petugas_lapangan">
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
        $('#tanggal').datepicker({}).on('changeDate', function(ev){});

        var petugas_lapangan = [<?php echo $petugas_lapangan; ?>];

        $('#nama_petugas_lapangan').typeahead({
            source: function (query, process) {
            states2 = [];
            map2 = {};
            
            var source = [];
            $.each(petugas_lapangan, function (i, state) {
              map2[state.stateName] = state;
              states2.push(state.stateName);
            });
           
            process(states2);
            
            },
            updater: function (item) {
                
            selectedState = map2[item].stateCode;
            selectedState2 = map2[item].stateDisplay;
            $("#id_petugas_lapangan").val(selectedState);
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