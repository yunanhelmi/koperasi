
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        User
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>index.php/usercon"><i class="fa fa-user-circle-o"></i> User</a></li>
        <li class="active"><a href="<?php echo base_url(); ?>iindex.php/nasabahcon/create_nasabah"><i class="fa fa-user"></i>Edit Data User</a></li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">
	     <div class="col-md-12 pull-left">
          <!-- general form elements -->
          <div class="box box-danger">
  		      <legend style="text-align:center;">EDIT DATA USER</legend>
            <form action="<?php echo base_url();?>index.php/usercon/do_update" method="post" enctype="multipart/form-data" role="form">
              <div class="box-body">
                <div class="form-group col-xs-6">
                  <input type="hidden" class="form-control" value="<?php echo $user['id']?>" required="required" id="id" name="id">
                  <label for="exampleInputEmail1">Username</label>
                  <input type="text" class="form-control" value="<?php echo $user['username']?>" required="required" id="username" name="username" placeholder="Username">
                </div>
                <div class="form-group col-xs-6">
                  <label for="exampleInputPassword1">Email</label>
                  <input class="form-control" value="<?php echo $user['email']?>" required="required" type="email" id="email" name="email" placeholder="Email">
                </div>
                <div class="form-group col-xs-6">
                  <label for="exampleInputPassword1">Status</label>
                  <select name="status" class="form-control" style="width: 100%;">
                    <option value='Administrator' <?php echo $user['status'] == 'Administrator' ? 'selected' : ''?> >Administrator</option>
                    <option value='Operator' <?php echo $user['status'] == 'Operator' ? 'selected' : ''?> >Operator</option>
                    <option value='User' <?php echo $user['status'] == 'User' ? 'selected' : ''?> >User</option>
                  </select>
                </div>
                <div class="form-group col-xs-6">
                  <label for="exampleInputPassword1">Password</label>
                  <input class="form-control" value="<?php echo $user['password']?>" required="required" type="password" id="password" name="password" placeholder="Password">
                </div>
                <div class="form-group col-xs-6">
                  <label for="exampleInputPassword1">Retype password</label>
                  <input class="form-control" value="" required="required" type="password" id="repassword" name="repassword" placeholder="Retype password">
                </div>
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <div class="col-xs-3">
                  <button name="update_user" type="submit" class="btn btn-primary">Simpan</button>
                </div>
                <br>
                <br>
                <div class="col-xs-3">
                  <p text-align="left"><?php echo validation_errors();?></p>
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
    <script type="text/javascript">

    </script>
