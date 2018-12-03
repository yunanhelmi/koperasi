<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Data Master 
		<small>Agen NPSO</small>
      </h1>
      <ol class="breadcrumb">
        <li><i class="fa fa-free-code-camp"></i> Data Master</li>
        <li class="active"> <i class="fa fa-table"></i> Agen NPSO</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
	    <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-success">
			<div class="box-body">
              <a class="btn btn-success" href="<?php echo base_url(''); ?>index.php/datacon/template_agen_npso">
				<i class="fa fa-download"></i> Download Template Data Agen NPSO
			  </a>
            </div>
          </div>
		</div>
		<div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title">Import Data Agen NPSO</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start for target sales-->
            <form action="<?php echo base_url();?>index.php/datacon/import_agen_npso" method="post" enctype="multipart/form-data" role="form">
              <div class="box-body">
                <div class="form-group">
                  <label for="exampleInputFile">File input</label>
                  <input required="required" type="file" accept=".xlsx, .xls" name="file">
                </div>
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <button type="submit" class="btn btn-primary" name="import_agen_npso"><i class="fa fa-upload"></i> Import</button>
              </div>
            </form>
          </div>
          <!-- /.box -->
        </div>
		<div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-warning">
			<div class="box-header" style="text-align:center" >
              <h3 class="box-title"><b>DATA AGEN NPSO</b></h3>
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
					  <th>MOR</th>
					  <th>Rayon</th>
					  <th>Provinsi</th>
					  <th>Kota</th>
					  <th>Klasifikasi</th>
					  <th>Nama Agen/Owner</th>
					  <th>Alamat</th>
					  <th>Kelurahan/Desa</th>
					  <th>Kecamatan</th>
					  <th>Delivery Service</th>
					</tr>
                </thead>
				<tfoot>
					<tr>
					  <th>No.</th>
					  <th>MOR</th>
					  <th>Rayon</th>
					  <th>Provinsi</th>
					  <th>Kota</th>
					  <th>Klasifikasi</th>
					  <th>Nama Agen/Owner</th>
					  <th>Alamat</th>
					  <th>Kelurahan/Desa</th>
					  <th>Kecamatan</th>
					  <th>Delivery Service</th>
					</tr>
                </tfoot>
				<tbody>
					<?php
						$no = 1;
						for($i = 0; $i < sizeof($agen_npso); $i++) {
					?>
					<tr>
						<td><?php echo $no."."?></td>
						<td><?php echo $agen_npso[$i]['mor']?></td>
						<td><?php echo $agen_npso[$i]['rayon']?></td>
						<td><?php echo $agen_npso[$i]['provinsi']?></td>
						<td><?php echo $agen_npso[$i]['kota']?></td>
						<td><?php echo $agen_npso[$i]['klasifikasi']?></td>
						<td><?php echo $agen_npso[$i]['nama_agen']?></td>
						<td><?php echo $agen_npso[$i]['alamat']?></td>
						<td><?php echo $agen_npso[$i]['kelurahan']?></td>
						<td><?php echo $agen_npso[$i]['kecamatan']?></td>
						<td><?php echo $agen_npso[$i]['delivery_service']?></td>
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
