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
        Anggota
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>index.php/nasabahcon"><i class="fa fa-users"></i> Anggota</a></li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">
	     <div class="col-md-12 pull-left">
          <!-- general form elements -->
          <div class="box box-danger">
  		      <legend style="text-align:center;">DAFTAR ANGGOTA KOPERASI</legend>
            <div class="box-header" style="text-align:left" >
              <h3>
                <a class="btn btn-primary btn-success" href="<?php echo site_url("nasabahcon/create_nasabah"); ?>">Tambahkan Anggota Baru</a>
              </h3>
              <h3>
                <form action="<?php echo base_url();?>index.php/nasabahcon/excel" method="post" enctype="multipart/form-data" role="form">
                  <button type="submit" class="btn btn-info" name="excel"><i class="fa fa-file-excel-o"></i> Download Excel</button>
                </form>
              </h3>
            </div>  
            <div class="box-body">
              <table id="nasabah_table" class="table table-bordered table-hover"  width="100%">
                <thead>
                  <tr>
                    <th>No.</th>
                    <th>Nama</th>
                    <th>Nomor Nasabah</th>
                    <th>NIK</th>
                    <th>Alamat</th>
                    <th>Desa</th>
                    <th>RW</th>
                    <th>RT</th>
                    <th>View</th>
                    <th>Edit</th>
                    <th>Delete</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    $no = 1;
                    for($i = 0; $i < sizeof($nasabah); $i++) {
                  ?>
                  <tr>
                    <td style='text-align: center'><?php echo $no."."?></td>
                    <td><?php echo $nasabah[$i]['nama']?></td>
                    <td style='text-align: center'><?php echo $nasabah[$i]['nomor_koperasi']?></td>
                    <td style='text-align: center'><?php echo $nasabah[$i]['nik']?></td>
                    <td><?php echo $nasabah[$i]['alamat']?></td>
                    <td><?php echo $nasabah[$i]['kelurahan']?></td>
                    <td><?php echo $nasabah[$i]['rw']?></td>
                    <td><?php echo $nasabah[$i]['rt']?></td>
                    <td style='text-align: center'><a class="btn btn-primary" href="<?php echo site_url("nasabahcon/view_nasabah/".$nasabah[$i]['id']); ?>"><i class="fa fa-eye"></i></a></td>
                    <td style='text-align: center'><a class="btn btn-warning" href="<?php echo site_url("nasabahcon/edit_nasabah/".$nasabah[$i]['id']); ?>"><i class="fa fa-pencil-square-o"></i></a></td>
                    <td style='text-align: center'><a class="btn btn-danger" onClick="getConfirmation('<?php echo $nasabah[$i]['id']?>');"><i class="fa fa-trash-o"></i></a></td>
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
    #nasabah_table_filter {
      text-align:right;
    }
  </style>
  <script type="text/javascript">
  function getConfirmation(id){
      var retVal = confirm("Apakah anda yakin akan menghapus data tersebut ? Jika dihapus, maka seluruh data transaksi anggota ini juga akan terhapus.");
      var controller = 'nasabahcon';
      var base_url = '<?php echo site_url(); //you have to load the "url_helper" to use this function ?>';
      if( retVal == true ){
        window.location.href= base_url + '/' + controller + '/delete_nasabah/' + id;
        //console.log(base_url + '/' + controller + '/delete_nasabah/' + id)
      }
    }

  $(function () {
    $('#nasabah_table').DataTable({
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
