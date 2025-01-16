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
        <li class="active"><a href="<?php echo base_url(); ?>index.php/penerimaansuratcon/view_penerimaan_surat"><i class="fa fa-table"></i>View Draft Penerimaan Surat</a></li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">
       <div class="col-md-12 pull-left">
          <!-- general form elements -->
          <div class="box box-danger">
            <legend style="text-align:center;">VIEW DRAFT PENERIMAAN SURAT</legend>
              <div class="box-body">
                <div class="form-group col-xs-3">
                  <label for="exampleInputPassword1">Tanggal</label>
                  <p><?php echo $data->tanggal;?></p>
                </div>
                <div class="form-group col-xs-4">
                  <label for="exampleInputPassword1">Petugas Lapangan</label>
                  <p><?php echo $data->nama_petugas_lapangan;?></p>
                </div>
                <div class="form-group col-xs-4">
                  <a class="btn btn-primary" href="<?php echo site_url("penerimaansuratcon/print_penerimaan_surat/".$data->id); ?>"><i class="fa fa-print"></i> Cetak</a>
                </div>
              </div>
          </div>
          <div class="box box-danger" id="div_tambah_detail" style="display:none">
            <legend style="text-align:center;">TAMBAH DETAIL PENERIMAAN SURAT</legend>
            <form action="<?php echo base_url()."index.php/penerimaansuratcon/insert_detail_penerimaan_surat/".$data->id;?>" method="post" enctype="multipart/form-data" role="form">
              <div class="box-body">
                <div class="form-group col-xs-6">
                  <label for="exampleInputPassword1">Nama Nasabah</label>
                  <input type="text" class="form-control" id="nama_nasabah" name="nama_nasabah" placeholder="Nama Nasabah">
                  <input type="hidden" class="form-control" id="id_nasabah" name="id_nasabah">
                </div>
                <div class="form-group col-xs-6">
                  <label for="exampleInputPassword1">Nomor Nasabah</label>
                  <input type="text" class="form-control" name="nomor_nasabah" id="nomor_nasabah" placeholder="Nomor Nasabah">
                </div>
              </div>
              <div class="box-footer">
                <div class="col-xs-3">
                  <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
                <div class="col-xs-3">
                  <button type="button" onclick="cancelTambahDetail()" class="btn btn-warning">Batal</button>
                </div>
              </div>
            </form>
          </div>
          <div class="box box-danger">
            <legend style="text-align: center;">DETAIL PENERIMAAN SURAT</legend>
            <div class="form-group col-xs-12">
              <button onclick="tambahDetail()" type="submit" class="btn btn-success" style="float: left;">Tambah Detail</button>
            </div>
            <table id="detail_penerimaan_surat_table" class="table table-bordered table-hover"  width="100%" style="overflow-x: auto;">
              <thead>
                <tr>
                  <th>No.</th>
                  <th>Nama</th>
                  <th>No. Nasabah</th>
                  <th>Desa</th>
                  <th>Status</th>
                  <th>Jaminan</th>
                  <th>Tgl Pinjam</th>
                  <th>Kekurangan Pokok</th>
                  <th>Kekurangan Jasa</th>
                  <th>Pokok Terbayar</th>
                  <th>Jasa Terbayar</th>
                </tr>
              </thead>
              <tbody>
                <?php
                  $no = 0;
                  for($a = 0; $a < sizeof($detail); $a++) {
                    $no++;
                ?>
                    <tr>
                      <td><?php echo $no; ?></td>
                      <td><?php echo $detail[$a]['nama_nasabah']; ?></td>
                      <td><?php echo $detail[$a]['nomor_nasabah']; ?></td>
                      <td><?php echo $detail[$a]['kelurahan']; ?></td>
                      <?php
                        if($detail[$a]['status_surat'] == 0) {
                      ?>
                        <td style="background-color: green; text-align: center;">H</td>
                      <?php
                        } else if($detail[$a]['status_surat'] == 1) {
                      ?>
                        <td style="background-color: yellow; text-align: center;">K1</td>
                      <?php
                        } else if($detail[$a]['status_surat'] == 2) {
                      ?>
                        <td style="background-color: orange; text-align: center;">K2</td>
                      <?php
                        } else if($detail[$a]['status_surat'] == 3) {
                      ?>
                        <td style="background-color: red; text-align: center;">M</td>
                      <?php
                        }
                      ?>
                      
                      <td><?php echo $detail[$a]['jaminan']; ?></td>
                      <td><?php echo $detail[$a]['tanggal_pinjaman']; ?></td>
                      <td><?php echo "Rp".number_format($detail[$a]['sisa_pokok_pinjaman'],2,",","."); ?></td>
                      <td><?php echo "Rp".number_format($detail[$a]['sisa_jasa'],2,",","."); ?></td>
                      <td><?php echo "Rp".number_format($detail[$a]['bayar_pokok_pinjaman'],2,",","."); ?></td>
                      <td><?php echo "Rp".number_format($detail[$a]['bayar_jasa'],2,",","."); ?></td>
                      <td style='text-align: center'><a class="btn btn-warning" href="<?php echo site_url("penerimaansuratcon/edit_detail_penerimaan_surat/".$detail[$a]['id']); ?>"><i class="fa fa-pencil-square-o"></i></a></td>
                      <td style='text-align: center'><a class="btn btn-danger" onClick="getConfirmationDeleteDetail('<?php echo $data->id?>','<?php echo $detail[$a]['id']?>');"><i class="fa fa-trash-o"></i></a></td>
                    </tr>
                <?php
                  }
                ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </section>
    <!-- /.content -->

    </div>
    <style type="text/css">

    </style>

    <script>
      function tambahDetail() {
        document.getElementById("div_tambah_detail").style.display = "block";
      }

      function cancelTambahDetail() {
        document.getElementById("div_tambah_detail").style.display = "none";
      }

      function getConfirmationDeleteDetail(id_penerimaan_surat, id_detail_penerimaan_surat){
        var retVal = confirm("Apakah anda yakin akan menghapus data tersebut ?");
        var controller = 'penerimaansuratcon';
        var base_url = '<?php echo site_url(); //you have to load the "url_helper" to use this function ?>';
        if( retVal == true ){
          window.location.href= base_url + '/' + controller + '/delete_detail_penerimaan_surat/' + id_penerimaan_surat + '/' + id_detail_penerimaan_surat;
          //console.log(base_url + '/' + controller + '/delete_nasabah/' + id)
        }
      }

      $(document).ready(function(){
        $('#tanggal').datepicker({}).on('changeDate', function(ev){});

        var nasabah = [<?php echo $nasabah; ?>];

        $('#nama_nasabah').typeahead({
            source: function (query, process) {
            states2 = [];
            map2 = {};
            
            var source = [];
            $.each(nasabah, function (i, state) {
              map2[state.display] = state;
              states2.push(state.display);
            });
           
            process(states2);
            
            },
            updater: function (item) {
                
            selectedId = map2[item].id;
            selectedNama = map2[item].nama;
            selectedNomor = map2[item].nomor_nasabah;
            $("#id_nasabah").val(selectedId);
            $("#nomor_nasabah").val(selectedNomor);
            return selectedNama;
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