<?php 
  function tanggal_indo($tanggal) {
    $bulan = array (1 =>   'Januari',
          'Februari',
          'Maret',
          'April',
          'Mei',
          'Juni',
          'Juli',
          'Agustus',
          'September',
          'Oktober',
          'November',
          'Desember'
        );
    $split = explode('-', $tanggal);
    return $split[2] . ' ' . $bulan[ (int)$split[1] ] . ' ' . $split[0];
  }

  $tgl 			= strtotime($tgl_dari);
	$tanggal_dari 	= date("d-m-Y",$tgl);

	$tgl 			= strtotime($tgl_sampai);
	$tanggal_sampai	= date("d-m-Y",$tgl);
?>

<style type="text/css">
    .kop_surat {
        width: 100%;
    }
    .kop_surat .bold {
        font-weight: bold;
    }
    .kop_surat tr {
        height: 30px;
    }
</style>

<table class="kop_surat">
    <tr>
        <td colspan="6"><center>KOPERASI KHOZANAH MAMBAUL MUBASYIRIN</center></td>
    </tr>
    <tr>
        <td colspan="6"><center>LAPORAN ARUS BANK <?php echo $tanggal_dari ?> s/d <?php echo $tanggal_sampai ?></center></td>
    </tr>
    <tr>
        <td class="bold" colspan="6"><center>AHU-0003689.AH.01.39.TAHUN 2022</center></td>
    </tr>
    <tr>
        <td colspan="6"><center>Kantor : Desa Ngumpakdalem Rt 10 Rw 03 Kecamatan Dander Kabupaten Bojonegoro</center></td>
    </tr>
</table>
<br>

<table border="1" style="width:100%; border-collapse: collapse;">
  <tr>
    <th>NO</th>
    <th>TANGGAL</th>
    <th>KETERANGAN</th>
    <th>DEBET</th>
    <th>KREDIT</th>
    <th>SALDO</th>
  </tr>
  <?php
  	$total_debet = 0;
    $total_kredit = 0;
    $saldo = $saldo_awal;
    $no = 1;
  ?>
  <tr>
  	<td style="text-align: center;"><?php echo $no ?></td>
  	<td style="text-align: center;"><?php echo tanggal_indo($tanggal_dari) ?></td>
  	<td>SALDO AWAL</td>
  	<td style="text-align: right;"></td>
  	<td style="text-align: right;"></td>
  	<td style="text-align: right;"><?php echo $saldo_awal ?></td>
  </tr>
  <?php
  	$no++;
  	for($i = 0; $i < sizeof($data_bank); $i++) {
  ?>
  <tr>
  	<td style="text-align: center;"><?php echo $no ?></td>
  	<?php 
  	$tgl 		= strtotime($data_bank[$i]['tanggal']);
	$tanggal 	= date("d-m-Y",$tgl);
	?>
  	<td style="text-align: center;"><?php echo tanggal_indo($tanggal) ?></td>
  	<td><?php echo $data_bank[$i]['keterangan'] ?></td>
  	<td style="text-align: right;"><?php echo $data_bank[$i]['debet'] ?></td>
  	<?php $total_debet += $data_bank[$i]['debet']; ?>
  	<td style="text-align: right;"><?php echo $data_bank[$i]['kredit'] ?></td>
  	<?php $total_kredit += $data_bank[$i]['kredit']; ?>
  	<?php $saldo += ($data_bank[$i]['debet'] - $data_bank[$i]['kredit']); ?>
  	<td style="text-align: right;"><?php echo $saldo ?></td>
  	<?php $no++; ?>
  </tr>
  <?php
  	}
  ?>
  <tr>
  	<td style="text-align: center;"><strong><?php echo $no ?></strong></td>
  	<td style="text-align: center;"><strong><?php echo tanggal_indo($tanggal_sampai) ?></strong></td>
  	<td><strong>SALDO AKHIR</strong></td>
  	<td style="text-align: right;"></td>
  	<td style="text-align: right;"></td>
  	<td style="text-align: right;"><strong><?php echo $saldo ?></strong></td>
  </tr>
</table>