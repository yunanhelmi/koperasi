<script src="<?php echo base_url(); ?>assets/js/jquery-1.11.3.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/js/highcharts.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/js/exporting.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/js/data.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/js/canvas-tools.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/js/export-csv.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/bower_components/select2/dist/js/select2.full.min.js"></script>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/bower_components/select2/dist/css/select2.min.css">
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Pinjaman
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>index.php/pinjamancon"><i class="fa fa-users"></i> Pinjaman</a></li>
        <li class="active"><a href="<?php echo base_url(); ?>index.php/pinjamancon/create_pinjaman"><i class="fa fa-table"></i>View Pinjaman</a></li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-4 col-md-offset-4">
          <div class="box box-danger">
              <div class="box-body box-profile">
                <?php
              if($nasabah_pinjaman->file_foto != null || $nasabah_pinjaman->file_foto != "") {
                $path = explode("./", $nasabah_pinjaman->file_foto );
              } else {
                $path[1] = '';
              }
                
              ?>
              <img class="profile-user-img img-responsive img-circle"style="width:200px;height:200px;" src=<?php echo base_url().$path[1]; ?> alt="User profile picture">
              </div>
          </div>
        </div>
      </div>
      <div class="row">
       <div class="col-md-12 pull-left">
          <!-- general form elements -->
          <div class="box box-danger">
            <legend style="text-align:center;">VIEW PINJAMAN</legend>
              <div class="box-body">
                <div class="form-group col-xs-6">
                  <label for="exampleInputEmail1">Nama Anggota</label>
                  <p><?php echo $pinjaman->nama_nasabah;?></p>
                </div>
                <div class="form-group col-xs-6">
                  <label for="exampleInputPassword1">NIK Anggota</label>
                  <p><?php echo $pinjaman->nik_nasabah;?></p>
                </div>
                <div class="form-group col-xs-6">
                  <label for="exampleInputPassword1">Jenis Pinjaman</label>
                  <p><?php echo $pinjaman->jenis_pinjaman;?></p>
                </div>
                <div class="form-group col-xs-6">
                  <label for="exampleInputPassword1">Jaminan</label>
                  <p><?php echo $pinjaman->jaminan;?></p>
                </div>
                <div class="form-group col-xs-6">
                  <label for="exampleInputPassword1">Tanggal Pinjaman</label>
                  <?php 
                    $date = strtotime( $pinjaman->waktu );
                    $mydate = date( 'd F Y', $date );
                  ?>
                  <p><?php echo $mydate;?></p>
                </div>
                <div class="form-group col-xs-6">
                  <label for="exampleInputPassword1">Tanggal Jatuh Tempo</label>
                  <p><?php echo $pinjaman->jatuh_tempo;?></p>
                </div>
                <div class="form-group col-xs-6">
                  <label for="exampleInputPassword1">Jumlah Pinjaman Awal</label>
                  <p><?php echo "Rp " . number_format($pinjaman->jumlah_pinjaman,2,',','.');?></p>
                </div>
                <div class="form-group col-xs-6">
                  <label for="exampleInputPassword1">Jumlah Angsuran</label>
                  <p><?php echo $pinjaman->jumlah_angsuran;?></p>
                </div>
                <div class="form-group col-xs-6">
                  <label for="exampleInputPassword1">Sisa Pinjaman</label>
                  <p><?php echo "Rp " . number_format($pinjaman->sisa_angsuran,2,',','.');?></p>
                </div>
                <div class="form-group col-xs-6">
                  <label for="exampleInputPassword1">Angsuran Per Bulan</label>
                  <p><?php echo "Rp " . number_format($pinjaman->angsuran_perbulan,2,',','.');?></p>
                </div>
                <div class="form-group col-xs-6">
                  <label for="exampleInputPassword1">Jasa Per Bulan</label>
                  <p><?php echo "Rp " . number_format($pinjaman->jasa_perbulan,2,',','.');?></p>
                </div>
                <div class="form-group col-xs-6">
                  <label for="exampleInputPassword1">Total Angsuran Per Bulan</label>
                  <p><?php echo "Rp " . number_format($pinjaman->total_angsuran_perbulan,2,',','.');?></p>
                </div>
              </div>
              <!-- /.box-body -->
          </div>
          <div class="box box-danger" id="div_tambah_angsuran" style="display:none">
            <legend style="text-align:center;">TAMBAH ANGSURAN</legend>
            <form action="<?php echo base_url();?>index.php/pinjamancon/insert_detail_angsuran" method="post" enctype="multipart/form-data" role="form">
            <div class="box-body">
              <div class="form-group col-xs-6">
                <label for="exampleInputPassword1">Tanggal</label>
                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" class="form-control pull-right" name="waktu" id="waktu" value="<?php echo date("d-m-Y",$date);?>" data-date-format="dd-mm-yyyy">
                  <input type="hidden" class="form-control" value="<?php echo $pinjaman->id?>" id="id_pinjaman" name="id_pinjaman">
                </div>
              </div>
              <div class="form-group col-xs-6">
                <label for="exampleInputPassword1">Jenis</label>
                <select id="jenis" name="jenis" class="form-control" style="width: 100%;">
                  <option value='Angsuran'>Angsuran</option>
                  <option value='Pinjaman'>Pinjaman</option>
                </select>
              </div>
              <div class="form-group col-xs-6">
                <label for="exampleInputPassword1">Bulan ke-</label>
                <input type="text" class="form-control" id="bulan_ke" name="bulan_ke" placeholder="">
              </div>
              <div class="form-group col-xs-6">
                <label for="exampleInputPassword1">Angsuran</label>
                <div class="input-group margin-bottom-sm">
                  <span class="input-group-addon">Rp</span>
                  <input type="text" class="form-control" value="<?php echo $pinjaman->angsuran_perbulan?>" id="angsuran" name="angsuran" placeholder="0">
                </div>
                <div id="label_angsuran" class="alert-danger"></div>
              </div>
              <div class="form-group col-xs-6">
                <label for="exampleInputPassword1">Jasa</label>
                <div class="input-group margin-bottom-sm">
                  <span class="input-group-addon">Rp</span>
                  <input type="text" class="form-control" value="<?php echo $pinjaman->jasa_perbulan?>" id="jasa" name="jasa" placeholder="0">
                </div>
                <div id="label_jasa" class="alert-danger"></div>
              </div>
              <div class="form-group col-xs-6">
                <label for="exampleInputPassword1">Jasa Tambahan</label>
                <div class="input-group margin-bottom-sm">
                  <span class="input-group-addon">Rp</span>
                  <input type="text" class="form-control" id="denda" name="denda" placeholder="0">
                </div>
                <div id="label_denda" class="alert-danger"></div>
              </div>
              <div class="form-group col-xs-6">
                <label for="exampleInputPassword1">Total</label>
                <div class="input-group margin-bottom-sm">
                  <span class="input-group-addon">Rp</span>
                  <input type="text" class="form-control" id="total" name="total" placeholder="0">
                </div>
                <div id="label_total" class="alert-danger"></div>
              </div>
            </div>
            <div class="box-footer">
                <div class="col-xs-3">
                  <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
              </div>
            </form>
          </div>
          <div class="box box-danger">
            <legend style="text-align:center;">DETAIL ANGSURAN</legend>
            <div class="box-body">
              <div class="form-group col-xs-6">
                <button onclick="tambahAngsuran()" type="submit" class="btn btn-success">Tambah Angsuran</button>
              </div>
              <table id="detail_angsuran_table" class="table table-bordered table-hover"  width="100%">


                <thead>
                  <tr>
                    <th>No.</th>
                    <th>Waktu</th>
                    <th>Keterangan</th>
                    <th>Debet</th>
                    <th>Kredit</th>
                    <th>Sisa Pinjaman</th>
                    <th>Jasa</th>
                    <th>Denda</th>
                    <th>Edit</th>
                    <th>Delete</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    $no           = 1;
                    $total_debet  = 0;
                    $total_kredit = 0;
                    $total_jasa   = 0;
                    $total_denda  = 0;
                    $sisa_pinjaman = array();
                    for($i = 0; $i < sizeof($detail_angsuran); $i++) {
                  ?>
                  <tr>
                    <td style='text-align: center'><?php echo $no."."?></td>
                    <?php 
                    $waktu = strtotime( $detail_angsuran[$i]['waktu'] );
                    $wkt = date( 'd F Y', $waktu );
                    ?>
                    <td><?php echo $wkt?></td>
                    <?php if($detail_angsuran[$i]['jenis'] == "Pinjaman") {?>
                    <td style='text-align: left'><?php echo $detail_angsuran[$i]['jenis']?></td>
                    <td style='text-align: right'><?php echo "Rp " . number_format(0,2,',','.');?></td>
                    <td style='text-align: right'><?php echo "Rp " . number_format($detail_angsuran[$i]['total'],2,',','.');?></td>
                    <?php $total_kredit += $detail_angsuran[$i]['total'];?>
                    <?php } else if($detail_angsuran[$i]['jenis'] == "Angsuran") {?>
                    <td style='text-align: left'><?php echo $detail_angsuran[$i]['jenis']." Bulan ke-".$detail_angsuran[$i]['bulan_ke']?></td>
                    <td style='text-align: right'><?php echo "Rp " . number_format($detail_angsuran[$i]['angsuran'],2,',','.');?></td>
                    <td style='text-align: right'><?php echo "Rp " . number_format(0,2,',','.');?></td>
                    <?php $total_debet += $detail_angsuran[$i]['angsuran'];?>
                    <?php }
                    $sisa_pinjaman[$i] = $total_kredit - $total_debet;
                    ?>
                    <td style='text-align: right'><?php echo "Rp " . number_format($sisa_pinjaman[$i],2,',','.');?></td>
                    <td style='text-align: right'><?php echo "Rp " . number_format($detail_angsuran[$i]['jasa'],2,',','.');?></td>
                    <td style='text-align: right'><?php echo "Rp " . number_format($detail_angsuran[$i]['denda'],2,',','.');?></td>
                    <?php 
                      $total_jasa += $detail_angsuran[$i]['jasa'];
                      $total_denda += $detail_angsuran[$i]['denda'];
                    ?>
                    <td style='text-align: center'><a class="btn btn-warning" href="<?php echo site_url("pinjamancon/edit_detail_angsuran/".$pinjaman->id."/".$detail_angsuran[$i]['id']); ?>"><i class="fa fa-pencil-square-o"></i></a></td>
                    <td style='text-align: center'><a class="btn btn-danger" onClick="getConfirmation('<?php echo $pinjaman->id?>','<?php echo $detail_angsuran[$i]['id']?>');"><i class="fa fa-trash-o"></i></a></td>
                  </tr>
                  <?php $no++;}?>
                  <tr>
                    <td colspan='3'><strong>TOTAL</strong></td>
                    <td style='text-align: right'><strong><?php echo "Rp " . number_format($total_debet,2,',','.');?></strong></td>
                    <td style='text-align: right'><strong><?php echo "Rp " . number_format($total_kredit,2,',','.');?></strong></td>
                    <td></td>
                    <td style='text-align: right'><strong><?php echo "Rp " . number_format($total_jasa,2,',','.');?></strong></td>
                    <td style='text-align: right'><strong><?php echo "Rp " . number_format($total_denda,2,',','.');?></strong></td>
                  </tr>
                </tbody>


              </table>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- /.content -->

    </div>
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
    #detail_angsuran_table td {
      text-align:center;
    }
    #pinjaman_table_filter {
      text-align:right;
    }
  </style>

    <script>
      function formatRupiah(nilaiUang2)
      {
        var nilaiUang=nilaiUang2+"";
        var nilaiRupiah   = "";
        var jumlahAngka   = nilaiUang.length;
        
        while(jumlahAngka > 3)
        {
        
        sisaNilai = jumlahAngka-3;
          nilaiRupiah = "."+nilaiUang.substr(sisaNilai,3)+""+nilaiRupiah;
          
          nilaiUang = nilaiUang.substr(0,sisaNilai)+"";
          jumlahAngka = nilaiUang.length;
        }
       
        nilaiRupiah = nilaiUang+""+nilaiRupiah+",00";
        return nilaiRupiah;
      }

      function label_angsuran() {
        var angsuran = $('#angsuran').val();
        $("#label_angsuran").html('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Rp&nbsp;&nbsp;&nbsp;&nbsp&nbsp;&nbsp;&nbsp;&nbsp'+formatRupiah(Math.floor(angsuran)));
      }

      function label_jasa() {
        var jasa = $('#jasa').val();
        $("#label_jasa").html('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Rp&nbsp;&nbsp;&nbsp;&nbsp&nbsp;&nbsp;&nbsp;&nbsp'+formatRupiah(Math.floor(jasa)));
      }

      function label_denda() {
        var denda = $('#denda').val();
        $("#label_denda").html('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Rp&nbsp;&nbsp;&nbsp;&nbsp&nbsp;&nbsp;&nbsp;&nbsp'+formatRupiah(Math.floor(denda)));
      }

      function label_total() {
        var total = $('#total').val();
        $("#label_total").html('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Rp&nbsp;&nbsp;&nbsp;&nbsp&nbsp;&nbsp;&nbsp;&nbsp'+formatRupiah(Math.floor(total)));
      }

      function hitung_total() {
        if($('#angsuran').val() != "" && $('#angsuran').val() != NaN && $('#angsuran').val() != null) {
          var angsuran = parseInt($('#angsuran').val());
          console.log(angsuran);
        } else {
          var angsuran = 0;
        }

        if($('#jasa').val() != "" && $('#jasa').val() != NaN && $('#jasa').val() != null) {
          var jasa = parseInt($('#jasa').val());
        } else {
          var jasa = 0;
        }

        if($('#denda').val() != "" && $('#denda').val() != NaN && $('#denda').val() != null) {
          var denda = parseInt($('#denda').val());
        } else {
          var denda = 0;
        }

        var total = angsuran + jasa + denda;
        $('#total').val(total);
        label_total();
      }

      function getConfirmation(id_pinjaman, id_detail_angsuran){
        var retVal = confirm("Apakah anda yakin akan menghapus data tersebut ?");
        var controller = 'pinjamancon';
        var base_url = '<?php echo site_url(); //you have to load the "url_helper" to use this function ?>';
        if( retVal == true ){
          window.location.href= base_url + controller + '/delete_detail_angsuran/' + id_pinjaman + '/' + id_detail_angsuran;
          //console.log(base_url + '/' + controller + '/delete_nasabah/' + id)
        }
      }

      function tambahAngsuran() {
        document.getElementById("div_tambah_angsuran").style.display = "block";
      }

      function editAngsuran(angsuran) {
        //document.getElementById("div_edit_angsuran").style.display = "block";
        console.log(angsuran);
      }

      $(document).ready(function(){
        $('.select2').select2();

        $('#waktu').datepicker({}).on('changeDate', function(ev){});

        $( "#id_nasabah" ).change(function() {
          $.ajax({
            type: "POST",
            url: "<?php echo base_url('pinjamancon/pickNasabah') ;?>",
            data: { id_nasabah: $( "#id_nasabah" ).val() },
            cache: true,
            success:
              function(result)
              {
                var nik = result.split("||");
                $( "#nama_nasabah" ).val(nik[0]);
                $( "#nik_nasabah" ).val(nik[1]);
                console.log(nik[1]);
              }
            });
        });

        hitung_total();
        label_angsuran();
        label_jasa();
        label_denda();
        label_total();

        $('#angsuran').keyup(function() {
          label_angsuran();
          hitung_total();
        });
        $('#jasa').keyup(function() {
          label_jasa();
          hitung_total();
        });
        $('#denda').keyup(function() {
          label_denda();
          hitung_total();
        });
        $('#total').keyup(function() {
          label_total();
        });

      });

    </script>