<!--<link href="<?php echo base_url()."assets/css/bootstrap.min.css"; ?>" rel="stylesheet">
<link href="<?php echo base_url()."assets/css/dataTables.bootstrap.min.css"; ?>" rel="stylesheet">
<link href="<?php echo base_url()."assets/css/responsive.bootstrap.min.css"; ?>" rel="stylesheet">
<link href="<?php echo base_url()."assets/css/DT_bootstrap.css"; ?>" rel="stylesheet">
<script type="text/javascript" charset="utf8" src="<?php echo base_url()."assets/js/jquery-1.12.4.js"; ?>"></script>
<script type="text/javascript" charset="utf8" src="<?php echo base_url()."assets/js/jquery.dataTables.min.js"; ?>"></script>
<script type="text/javascript" charset="utf8" src="<?php echo base_url()."assets/js/dataTables.bootstrap.min.js"; ?>"></script>
<script type="text/javascript" charset="utf8" src="<?php echo base_url()."assets/js/dataTables.responsive.min.js"; ?>"></script>
<script type="text/javascript" charset="utf8" src="<?php echo base_url()."assets/js/responsive.bootstrap.min.js"; ?>"></script>-->
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Data Master 
		<small>Agen PSO</small>
      </h1>
      <ol class="breadcrumb">
        <li><i class="fa fa-free-code-camp"></i> Data Master</li>
        <li class="active"> <i class="fa fa-table"></i> Agen PSO</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
	    <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-success">
			<div class="box-body">
              <a class="btn btn-success" href="<?php echo base_url(''); ?>index.php/datacon/template_agen_pso">
				<i class="fa fa-download"></i> Download Template Data Agen PSO
			  </a>
            </div>
          </div>
		</div>
		<div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Import Data Agen PSO</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start for target sales-->
            <form action="<?php echo base_url();?>index.php/datacon/import_agen_pso" method="post" enctype="multipart/form-data" role="form">
              <div class="box-body">
                <div class="form-group">
                  <label for="exampleInputFile">File input</label>
                  <input required="required" type="file" accept=".xlsx, .xls" name="file">
                </div>
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <button type="submit" class="btn btn-primary" name="import_agen"><i class="fa fa-upload"></i> Import</button>
              </div>
            </form>
          </div>
          <!-- /.box -->
        </div>
		<div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-warning">
			<div class="box-header" style="text-align:center" >
              <h3 class="box-title"><b>DATA AGEN PSO</b></h3>
            </div>
			<!--<div class="row">
				<div class="col-sm-6">
					<div class="dataTables_length">
						<label>Show</label>
					</div>
				</div>
			</div>-->
			<div class="box-body">
              <table id="example" class="display table-bordered table-hover"  width="100%" cellspacing="0" >
				<thead>
					<tr>
					  <th>No.</th>
					  <th>SP Agen</th>
					  <th>Nama Agen</th>
					  <th>Provinsi</th>
					  <th>Kota</th>
					  <th>Alamat</th>
					  <th>Kode Pos</th>
					  <th>Distribution Channel</th>
					  <th>Sales Grup</th>
					  <th>Email</th>
					  <th>Latitude</th>
					  <th>Longitude</th>
					</tr>
                </thead>
				<tfoot>
					<tr>
					  <th>No.</th>
					  <th>SP Agen</th>
					  <th>Nama Agen</th>
					  <th>Provinsi</th>
					  <th>Kota</th>
					  <th>Alamat</th>
					  <th>Kode Pos</th>
					  <th>Distribution Channel</th>
					  <th>Sales Grup</th>
					  <th>Email</th>
					  <th>Latitude</th>
					  <th>Longitude</th>
					</tr>
                </tfoot>
				<tbody>
					<?php
						$no = 1;
						for($i = 0; $i < sizeof($agen_pso); $i++) {
					?>
					<tr>
						<td><?php echo $no."."?></td>
						<td><?php echo $agen_pso[$i]['sp_agen']?></td>
						<td><?php echo $agen_pso[$i]['nama']?></td>
						<td><?php echo $agen_pso[$i]['provinsi']?></td>
						<td><?php echo $agen_pso[$i]['kota']?></td>
						<td><?php echo $agen_pso[$i]['alamat']?></td>
						<td><?php echo $agen_pso[$i]['kodepos']?></td>
						<td><?php echo $agen_pso[$i]['distribution_channel']?></td>
						<td><?php echo $agen_pso[$i]['sales_grup']?></td>
						<td><?php echo $agen_pso[$i]['email']?></td>
						<td><?php echo $agen_pso[$i]['latitude']?></td>
						<td><?php echo $agen_pso[$i]['longitude']?></td>
					</tr>
					<?php $no++;}?>
				</tbody>
			  </table>
            </div>
          </div>
		</div>
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  
<style>
thead input {
        width: 100%;
        padding: 3px;
        box-sizing: border-box;
    }
</style>

<script type="text/javascript">
$(document).ready(function(){
	// Setup - add a text input to each footer cell
    $('#example tfoot th').each( function () {
        var title = $(this).text();
        $(this).html( '<input type="text" placeholder="" />' );
    } );
 
    // DataTable
    var table = $('#example').DataTable();
 
    // Apply the search
    table.columns().every( function () {
        var that = this;
 
        $( 'input', this.footer() ).on( 'keyup change', function () {
            if ( that.search() !== this.value ) {
                that
                    .search( this.value )
                    .draw();
            }
        } );
    });
	$('#example tfoot tr').appendTo('#example thead');
});
</script>
