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
        Simpanan 3 Th
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>index.php/usercon"><i class="fa fa-credit-card"></i> Simpanan 3 Th</a></li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">
	     <div class="col-md-12 pull-left">
          <!-- general form elements -->
          <div class="box box-danger">
  		      <legend style="text-align:center;">SIMPANAN 3 TH</legend>
            <div class="box-header" style="text-align:left" >
              <h3>
                <a class="btn btn-primary btn-success" href="<?php echo site_url("simpanan3thmastercon/create_simpanan3thmaster"); ?>">Tambahkan Simpanan 3 Th Baru</a>
              </h3>
            </div>  
            <div class="box-body">
              <table id="user_table" class="table table-bordered table-hover"  width="100%">
                <thead>
                  <tr>
                    <th>No.</th>
                    <th>Nama</th>
                    <th>View</th>
                    <th>Edit</th>
                    <th>Delete</th>
                    <th>Transaksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    $no = 1;
                    for($i = 0; $i < sizeof($simpanan3thmaster); $i++) {
                  ?>
                  <tr>
                    <td style='text-align: center'><?php echo $no."."?></td>
                    <td><?php echo $simpanan3thmaster[$i]['nama']?></td>
                    <td style='text-align: center'><a class="btn btn-primary" href="<?php echo site_url("simpanan3thmastercon/view_simpanan3thmaster/".$simpanan3thmaster[$i]['id']); ?>"><i class="fa fa-eye"></i></a></td>
                    <td style='text-align: center'><a class="btn btn-warning" href="<?php echo site_url("simpanan3thmastercon/edit_simpanan3thmaster/".$simpanan3thmaster[$i]['id']); ?>"><i class="fa fa-pencil-square-o"></i></a></td>
                    <td style='text-align: center'><a class="btn btn-danger" onClick="getConfirmation('<?php echo $simpanan3thmaster[$i]['id']?>');"><i class="fa fa-trash-o"></i></a></td>
                    <td style='text-align: center'><a class="btn btn-success" href="<?php echo site_url("simpanan3thmastercon/transaksi_simpanan3thmaster/".$simpanan3thmaster[$i]['id']); ?>"><i class="fa fa-money"></i></a></td>
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
    #simpanan3thmaster_table_filter {
      text-align:right;
    }
  </style>
  <script type="text/javascript">
  function getConfirmation(id){
      var retVal = confirm("Apakah anda yakin akan menghapus data tersebut ?");
      var controller = 'simpanan3thmastercon';
      var base_url = '<?php echo site_url(); //you have to load the "url_helper" to use this function ?>';
      if( retVal == true ){
        window.location.href= base_url + controller + '/delete_simpanan3thmaster/' + id;
      }
    }

  $(function () {
    $('#simpanan3thmaster_table').DataTable({
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
