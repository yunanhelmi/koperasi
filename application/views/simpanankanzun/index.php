<script src="<?php echo base_url(); ?>assets/js/jquery-1.11.3.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/js/highcharts.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/js/exporting.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/js/data.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/js/canvas-tools.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/js/export-csv.js" type="text/javascript"></script>
<?php

function rupiah($angka){
  $hasil_rupiah = "Rp " . number_format($angka,2,',','.');
  return $hasil_rupiah;
}

?>
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Simpanan Kanzun
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>index.php/simpanankanzuncon"><i class="fa fa-users"></i> Simpanan Kanzun</a></li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">
	     <div class="col-md-12 pull-left">
          <!-- general form elements -->
          <div class="box box-danger">
  		      <legend style="text-align:center;">SIMPANAN KANZUN</legend>
            <div class="box-header" style="text-align:left" >
              <h3>
                <a class="btn btn-primary btn-success" href="<?php echo site_url("simpanankanzuncon/create_simpanankanzun"); ?>">Tambahkan Simpanan Kanzun Baru</a>
              </h3>
            </div>  
            <div class="box-body">
              <table id="simpanankanzun_table" class="table table-bordered table-hover"  width="100%">
                <thead>
                  <tr>
                    <th>No.</th>
                    <th>Nama</th>
                    <th>Nomor Anggota</th>
                    <th>NIK</th>
                    <th>Tanggal</th>
                    <th>Total</th>
                    <th>View</th>
                    <th>Edit</th>
                    <th>Delete</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    $no = 1;
                    for($i = 0; $i < sizeof($simpanankanzun); $i++) {
                  ?>
                  <tr>
                    <td style='text-align: center'><?php echo $no."."?></td>
                    <td><?php echo $simpanankanzun[$i]['nama_nasabah']?></td>
                    <td><?php echo $simpanankanzun[$i]['nomor_nasabah']?></td>
                    <td><?php echo $simpanankanzun[$i]['nik_nasabah']?></td>
                    <?php $date = strtotime($simpanankanzun[$i]['waktu']);?>
                    <td><?php echo date("d-M-Y",$date)?></td>
                    <td><?php echo rupiah($simpanankanzun[$i]['total'])?></td>
                    <td style='text-align: center'><a class="btn btn-primary" href="<?php echo site_url("simpanankanzuncon/view_simpanankanzun/".$simpanankanzun[$i]['id']); ?>"><i class="fa fa-eye"></i></a></td>
                    <td style='text-align: center'><a class="btn btn-warning" href="<?php echo site_url("simpanankanzuncon/edit_simpanankanzun/".$simpanankanzun[$i]['id']); ?>"><i class="fa fa-pencil-square-o"></i></a></td>
                    <td style='text-align: center'><a class="btn btn-danger" onClick="getConfirmation('<?php echo $simpanankanzun[$i]['id']?>');"><i class="fa fa-trash-o"></i></a></td>
                  </tr>
                  <?php $no++;}?>
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
    .table td {
       text-align: center;   
    }
    #simpanankanzun_table_filter {
      text-align:right;
    }
  </style>
  <script type="text/javascript">
  function getConfirmation(id){
      var retVal = confirm("Apakah anda yakin akan menghapus data tersebut ? Jika dihapus, maka detail simpanan kanzun anggota yang bersangkutan juga akan terhapus.");
      var controller = 'simpanankanzuncon';
      var base_url = '<?php echo site_url(); //you have to load the "url_helper" to use this function ?>';
      if( retVal == true ){
        window.location.href= base_url + controller + '/delete_simpanankanzun/' + id;
        //console.log(base_url + '/' + controller + '/delete_nasabah/' + id)
      }
    }

  $(function () {
    $('#simpanankanzun_table').DataTable({
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