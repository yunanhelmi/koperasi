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
        Transaksi Anggota
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>index.php/transaksianggotacon"><i class="fa fa-users"></i> Transaksi Anggota</a></li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">
	     <div class="col-md-12 pull-left">
          <!-- general form elements -->
          <div class="box box-danger">
  		      <legend style="text-align:center;">DAFTAR ANGGOTA KOPERASI</legend>
            <div class="box-body">
              <table id="transaksianggota_table" class="table table-bordered table-hover"  width="100%">
                <thead>
                  <tr>
                    <th>No.</th>
                    <th>Nama</th>
                    <th>Nomor Nasabah</th>
                    <th>NIK</th>
                    <th>Alamat</th>
                    <th>Dusun</th>
                    <th>Desa</th>
                    <th>RT</th>
                    <th>RW</th>
                    <th>Reputasi Nasabah</th>
                    <th>Transaksi</th>
                    <th>Post/Unpost</th>
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
                    <td><?php echo $nasabah[$i]['dusun']?></td>
                    <td><?php echo $nasabah[$i]['kelurahan']?></td>
                    <td><?php echo $nasabah[$i]['rt']?></td>
                    <td><?php echo $nasabah[$i]['rw']?></td>
                    <?php
                      if($nasabah[$i]['blacklist'] == 0) {
                    ?>
                      <td style="background-color: green; text-align: center;">-</td>
                    <?php
                      } else if($nasabah[$i]['blacklist'] == 1) {
                    ?>
                      <td style="background-color: pink; text-align: center;">BL 1</td>
                    <?php
                      } else if($nasabah[$i]['blacklist'] == 2) {
                    ?>
                      <td style="background-color: red; text-align: center;">BL 2</td>
                    <?php
                      }
                    ?>
                    <td style='text-align: center'><a class="btn btn-danger" href="<?php echo site_url("transaksianggotacon/pinjaman/".$nasabah[$i]['id']); ?>"><i class="fa fa-money"></i></a></td>
                    <?php
                      if($nasabah[$i]['total_unpost'] == '0' 
                        && $nasabah_simpananpokok[$i]['total_unpost'] == '0' 
                        && $nasabah_simpananwajib[$i]['total_unpost'] == '0' 
                        && $nasabah_simpanankhusus[$i]['total_unpost'] == '0' 
                        && $nasabah_simpanandanasosial[$i]['total_unpost'] == '0' 
                        && $nasabah_simpanankanzun[$i]['total_unpost'] == '0' 
                        && $nasabah_simpananpihakketiga[$i]['total_unpost'] == '0' ) {
                        echo "<td style='text-align: center; color:green'>Post</td>";
                      } else if ($nasabah[$i]['total_unpost'] == NULL
                        && $nasabah_simpananpokok[$i]['total_unpost'] == NULL
                        && $nasabah_simpananwajib[$i]['total_unpost'] == NULL
                        && $nasabah_simpanankhusus[$i]['total_unpost'] == NULL
                        && $nasabah_simpanandanasosial[$i]['total_unpost'] == NULL
                        && $nasabah_simpanankanzun[$i]['total_unpost'] == NULL
                        && $nasabah_simpananpihakketiga[$i]['total_unpost'] == NULL ) {
                        echo "<td style='text-align: center; color:black'>Tidak Ada Transaksi</td>";
                      } else {
                        echo "<td style='text-align: center; color:red'>Unpost</td>";
                      }
                    ?>
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
    #transaksianggota_table_filter {
      text-align:right;
    }
  </style>
  <script type="text/javascript">

  </script>
  
  <script type="text/javascript">
    $(document).ready(function() {
    // Setup - add a text input to each footer cell
    $('#transaksianggota_table thead tr').clone(true).appendTo( '#transaksianggota_table thead' );
    $('#transaksianggota_table thead tr:eq(1) th').each( function (i) {
        var title = $(this).text();
        if(title == 'Nomor Nasabah') {
          $(this).html( '<input type="text" placeholder="" />' );  
        } else {
          $(this).html( '' );  
        }
    
        $( 'input', this ).on( 'keyup change', function () {
            if ( table.column(i).search() !== this.value ) {
                table
                    .column(i)
                    .search( this.value )
                    .draw();
            }
        } );
    } );

    var table = $('#transaksianggota_table').DataTable({
      'paging'      : true,
      'lengthChange': true,
      'searching'   : true,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : true
    })
  });
  </script>
