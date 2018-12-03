<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        LPG 50 Kg 
        <small>Import Data</small>
      </h1>
      <ol class="breadcrumb">
        <li><i class="fa fa-free-code-camp"></i> LPG 50 Kg</li>
        <li class="active"> <i class="fa fa-table"></i> Import Data</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
	    <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-success">
			<div class="box-body">
              <a class="btn btn-success" href="<?php echo base_url(''); ?>index.php/lpg50con/download_template">
				<i class="fa fa-download"></i> Download Template
			  </a>
            </div>
          </div>
		</div>
		<div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title">Import Data Target Sales LPG 50 Kg</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start for target sales-->
            <form action="<?php echo base_url();?>index.php/lpg50con/import_target" method="post" enctype="multipart/form-data" role="form">
              <div class="box-body">
                <div class="form-group">
                  <label for="exampleInputFile">File input</label>
                  <input required="required" type="file" accept=".xlsx, .xls" name="file">
                </div>
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <button type="submit" class="btn btn-primary" name="import_target"><i class="fa fa-upload"></i> Import</button>
              </div>
            </form>
          </div>
          <!-- /.box -->

        </div>
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title">Import Data Realisasi Sales LPG 50 Kg</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start for realisasi sales-->
            <form action="<?php echo base_url();?>index.php/lpg50con/import_realisasi" method="post" enctype="multipart/form-data" role="form">
              <div class="box-body">
                <div class="form-group">
                  <label for="exampleInputFile">File input</label>
                  <input required="required" type="file" accept=".xlsx, .xls" name="file">
                </div>
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary" name="import_realisasi"><i class="fa fa-upload"></i> Import</button>
              </div>
            </form>
          </div>
          <!-- /.box -->
        </div>
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
