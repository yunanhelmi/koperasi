<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Data Master 
		<small>Pangkalan</small>
      </h1>
      <ol class="breadcrumb">
        <li><i class="fa fa-free-code-camp"></i> Data Master</li>
        <li class="active"> <i class="fa fa-table"></i> Pangkalan</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
	    <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-success">
			<div class="box-body">
              <a class="btn btn-success" href="<?php echo base_url(''); ?>index.php/datacon/template_pangkalan">
				<i class="fa fa-download"></i> Download Template Data Pangkalan
			  </a>
            </div>
          </div>
		</div>
		<div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title">Import Data Pangkalan</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start for target sales-->
            <form action="<?php echo base_url();?>index.php/datacon/import_pangkalan" method="post" enctype="multipart/form-data" role="form">
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
              <h3 class="box-title"><b>DATA PANGKALAN</b></h3>
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
					  <th>Pangkalan</th>
					  <th>Type</th>
					  <th>No Registrasi</th>
					  <th>Alamat</th>
					  <th>Provinsi</th>
					  <th>Kab/Kota</th>
					  <th>Kecamatan</th>
					  <th>Kelurahan/Desa</th>
					  <!--<th>Tlp Kantor</th>-->
					  <th>Pemilik</th>
					  <!--<th>KTP Pemilik</th>
					  <th>HP Pemilik</th>-->
					  <th>SP Agen</th>
					  <th>Qty Kontrak</th>
					  <th>Kode Pos</th>
					  <!--<th>Latitude</th>
					  <th>Longitude</th>-->
					</tr>
                </thead>
				<tfoot>
					<tr>
					  <th>No.</th>
					  <th>Pangkalan</th>
					  <th>Type</th>
					  <th>No Registrasi</th>
					  <th>Alamat</th>
					  <th>Provinsi</th>
					  <th>Kab/Kota</th>
					  <th>Kecamatan</th>
					  <th>Kelurahan/Desa</th>
					  <!--<th>Tlp Kantor</th>-->
					  <th>Pemilik</th>
					  <!--<th>KTP Pemilik</th>
					  <th>HP Pemilik</th>-->
					  <th>SP Agen</th>
					  <th>Qty Kontrak</th>
					  <th>Kode Pos</th>
					  <!--<th>Latitude</th>
					  <th>Longitude</th>-->
					</tr>
                </tfoot>
				<tbody>
					<?php
						$no = 1;
						for($i = 0; $i < sizeof($pangkalan); $i++) {
					?>
					<tr>
						<td><?php echo $no."."?></td>
						<td><?php echo $pangkalan[$i]['nama_pangkalan']?></td>
						<td><?php echo $pangkalan[$i]['type']?></td>
						<td><?php echo $pangkalan[$i]['noreg']?></td>
						<td><?php echo $pangkalan[$i]['alamat']?></td>
						<td><?php echo $pangkalan[$i]['provinsi']?></td>
						<td><?php echo $pangkalan[$i]['kota']?></td>
						<td><?php echo $pangkalan[$i]['kecamatan']?></td>
						<td><?php echo $pangkalan[$i]['kelurahan']?></td>
						<!--<td><?php //echo $pangkalan[$i]['telpon']?></td>-->
						<td><?php echo $pangkalan[$i]['pemilik']?></td>
						<!--<td><?php //echo $pangkalan[$i]['ktp_pemilik']?></td>
						<td><?php //echo $pangkalan[$i]['hp_pemilik']?></td>-->
						<td><?php echo $pangkalan[$i]['sp_agen']?></td>
						<td><?php echo $pangkalan[$i]['qty_kontrak']?></td>
						<td><?php echo $pangkalan[$i]['kodepos']?></td>
						<!--<td><?php //echo $pangkalan[$i]['latitude']?></td>
						<td><?php //echo $pangkalan[$i]['longitude']?></td>-->
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
