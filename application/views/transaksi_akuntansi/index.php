<script src="<?php echo base_url(); ?>assets/js/jquery-1.11.3.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/js/highcharts.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/js/exporting.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/js/data.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/js/canvas-tools.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/js/export-csv.js" type="text/javascript"></script>
<!-- Content Wrapper. Contains page content -->
<?php

function rupiah($angka){
  $hasil_rupiah = "Rp " . number_format($angka,2,',','.');
  return $hasil_rupiah;
}

?>
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Transaksi Akuntansi
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>index.php/transaksiakuntansicon"><i class="fa fa-users"></i> Transaksi Akuntansi</a></li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">
	     <div class="col-md-12 pull-left">
          <!-- general form elements -->
          <div class="box box-danger">
  		      <legend style="text-align:center;">DAFTAR TRANSAKSI AKUNTANSI</legend>
            <div class="box-header" style="text-align:left" >
              <h3>
                <a class="btn btn-primary btn-success" href="<?php echo site_url("transaksiakuntansicon/create_transaksi_akuntansi"); ?>">Tambahkan Transaksi</a>
              </h3>
            </div>  
            <div class="box-body">
              <table id="transaksi_akuntansi_table" class="table table-bordered table-hover"  width="100%">
                <thead>
                  <tr>
                    <th>No.</th>
                    <th>Tanggal</th>
                    <th>Kode Akun</th>
                    <th>Nama Akun</th>
                    <th>Keterangan</th>
                    <th>Debet</th>
                    <th>Kredit</th>
                    <th>Edit</th>
                    <th>Delete</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    $no = 1;
                    $total_debet = 0;
                    $total_kredit = 0;
                    for($i = 0; $i < sizeof($transaksi_akuntansi); $i++) {
                  ?>
                  <tr>
                    <td style='text-align: center'><?php echo $no."."?></td>
                    <?php 
                    $waktu = strtotime( $transaksi_akuntansi[$i]['tanggal'] );
                    $wkt = date( 'd F Y', $waktu );
                    ?>
                    <td style='text-align: center'><?php echo $wkt?></td>
                    <td style='text-align: center'><?php echo $transaksi_akuntansi[$i]['kode_akun']?></td>
                    <td><?php echo $transaksi_akuntansi[$i]['nama_akun']?></td>
                    <td><?php echo $transaksi_akuntansi[$i]['keterangan']?></td>
                    <td style='text-align: right'><?php echo rupiah($transaksi_akuntansi[$i]['debet'])?></td>
                    <td style='text-align: right'><?php echo rupiah($transaksi_akuntansi[$i]['kredit'])?></td>
                    <?php
                      $total_debet += $transaksi_akuntansi[$i]['debet'];
                      $total_kredit += $transaksi_akuntansi[$i]['kredit'];
                    ?>
                    <td style='text-align: center'><a class="btn btn-warning" href="<?php echo site_url("transaksiakuntansicon/edit_transaksi_akuntansi/".$transaksi_akuntansi[$i]['id']); ?>"><i class="fa fa-pencil-square-o"></i></a></td>
                    <td style='text-align: center'><a class="btn btn-danger" onClick="getConfirmation('<?php echo $transaksi_akuntansi[$i]['id']?>');"><i class="fa fa-trash-o"></i></a></td>
                  </tr>
                  <?php $no++;}?>
                  <!--<tr>
                    <td colspan='5' style='text-align: center'><strong>TOTAL</strong></td>
                    <td style='text-align: right'><strong><?php echo rupiah($total_debet)?></strong></td>
                    <td style='text-align: right'><strong><?php echo rupiah($total_kredit)?></strong></td>
                  </tr>-->
                </tbody>
              </table>
            </div>
          </div>
		    </div>
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <style type="text/css">
    table.table-bordered{
      border:1px solid silver;
      margin-top:20px;
    }
    table.table-bordered > thead > tr > th{
      border:1px solid silver;
    }
    table.table-bordered > tbody > tr > td{
      border:1px solid silver;
    }
    .table th {
       text-align: center;   
    }
    #transaksi_akuntansi_table_filter {
      text-align:right;
    }
  </style>
  <script type="text/javascript">
  function getConfirmation(id){
      var retVal = confirm("Apakah anda yakin akan menghapus data tersebut ?");
      var controller = 'transaksiakuntansicon';
      var base_url = '<?php echo site_url(); //you have to load the "url_helper" to use this function ?>';
      if( retVal == true ){
        window.location.href= base_url + controller + '/delete_transaksi_akuntansi/' + id;
      }
    }

  $(function () {
    $('#transaksi_akuntansi_table').DataTable({
      'paging'      : true,
      'lengthChange': true,
      'searching'   : true,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : true
    })
  })
  </script>
  <script type="text/javascript">
    
  </script>
