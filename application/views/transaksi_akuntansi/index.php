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
          <div class="box box-danger">
            <legend style="text-align:center;">DAFTAR TRANSAKSI AKUNTANSI</legend>
            <form action="<?php echo base_url();?>index.php/transaksiakuntansicon/index" method="post" enctype="multipart/form-data" role="form">
            <div class="box-body">
              <div class="form-group col-xs-3">
                <label for="exampleInputPassword1">Dari</label>
                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" class="form-control pull-right" name="dari" id="dari" value="<?php echo $tgl_dari ?>" data-date-format="dd-mm-yyyy">
                </div>
              </div>
              <div class="form-group col-xs-3">
                <label for="exampleInputPassword1">Sampai</label>
                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" class="form-control pull-right" name="sampai" id="sampai" value="<?php echo $tgl_sampai ?>" data-date-format="dd-mm-yyyy">
                </div>
              </div>
            </div>
            <div class="box-footer">
              <div class="col-xs-3">
                <div class="form-group pull-left">
                  <button type="submit" class="btn btn-info" name="excel"><i class="fa fa-eye"></i> Tampilkan</button>
                </div>
              </div>
            </div>  
          </form>
          </div>
        </div>
      </div>
      <div class="row">
	     <div class="col-md-12 pull-left">
          <!-- general form elements -->
          <div class="box box-danger"> 
            <div class="box-header">
              <div class="col-xs-2">
                <div class="form-group pull-left">
                  <a class="btn btn-primary btn-success" href="<?php echo site_url("transaksiakuntansicon/create_transaksi_akuntansi"); ?>"><i class="fa fa-plus-square-o"></i> Tambahkan Transaksi</a>
                </div>
              </div>
              <div class="col-xs-2">
                <div class="form-group pull-left">
                  <button style="margin-bottom: 10px" class="btn btn-danger delete_all" data-url="<?php echo site_url("transaksiakuntansicon/delete_multiple_transaksi_akuntansi"); ?>">Hapus Transaksi yang Dipilih</button>
                </div>
              </div> 
            </div>
            <div class="box-body">
              <table id="transaksi_akuntansi_table" class="table table-bordered table-hover"  width="100%">
                <thead>
                  <tr>
                    <th></th>
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
                    if($transaksi_akuntansi != NULL) {
                      for($i = 0; $i < sizeof($transaksi_akuntansi); $i++) {
                  ?>
                  <tr>
                    <td><input type="checkbox" class="sub_chk" data-id="<?php echo $transaksi_akuntansi[$i]['id'] ?>"></td>
                    <td style='text-align: center'><?php echo $no."."?></td>
                    <?php 
                    $waktu = strtotime( $transaksi_akuntansi[$i]['tanggal'] );
                    $wkt = date( 'd M Y', $waktu );
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
                  <?php 
                      $no++;}
                    } 
                  ?>
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
        window.location.href= base_url + '/' + controller + '/delete_transaksi_akuntansi/' + id;
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
    $(document).ready(function() {
      $('#dari').datepicker({}).on('changeDate', function(ev){});
      $('#sampai').datepicker({}).on('changeDate', function(ev){});

      $('.delete_all').on('click', function(e) {
        var allVals = [];  
        $(".sub_chk:checked").each(function() {  
            allVals.push($(this).attr('data-id'));
        });
        if(allVals.length <=0) {  
          alert("Anda belum memilih transaksi yang akan dihapus.");  
        } else {
          var check = confirm("Apakah anda yakin akan menghapus transaksi tersebut?");
          if(check == true) {
            var join_selected_values = allVals.join(",");
            $.ajax({
              url: $(this).data('url'),
              type: 'POST',
              data: 'ids='+join_selected_values,
              success: function (data) {
                console.log(data);
                $(".sub_chk:checked").each(function() {  
                    $(this).parents("tr").remove();
                });
                alert("Item Deleted successfully.");
              },
              error: function (data) {
                  alert(data.responseText);
              }
            });

            $.each(allVals, function( index, value ) {
              $('table tr').filter("[data-row-id='" + value + "']").remove();
            });
          }
        }
      });
    });
  </script>
