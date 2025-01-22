<?php 
  $tgl 			= strtotime($dari);
	$tanggal_dari 	= date("d-m-Y",$tgl);

	$tgl 			= strtotime($sampai);
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
        <td colspan="6"><center>LAPORAN RINCIAN AKUN <?php echo $tanggal_dari ?> s/d <?php echo $tanggal_sampai ?></center></td>
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
  	<td style="text-align: center;"><?php echo $tanggal_dari ?></td>
  	<td>SALDO AWAL</td>
  	<td style="text-align: right;"></td>
  	<td style="text-align: right;"></td>
  	<td style="text-align: right;"><?php echo number_format($saldo_awal,0,",",".") ?></td>
  </tr>
  <?php
  	$no++;
  	for($i = 0; $i < sizeof($transaksi); $i++) {
  ?>
  <tr>
  	<td style="text-align: center;"><?php echo $no ?></td>
  	<?php 
  	$tgl 		= strtotime($transaksi[$i]['tanggal']);
	  $tanggal 	= date("d-m-Y",$tgl);
	?>
  	<td style="text-align: center;"><?php echo $tanggal ?></td>
  	<td><?php echo $transaksi[$i]['keterangan'] ?></td>
  	<td style="text-align: right;"><?php echo number_format($transaksi[$i]['debet'],0,",",".") ?></td>
  	<?php $total_debet += $transaksi[$i]['debet']; ?>
  	<td style="text-align: right;"><?php echo number_format($transaksi[$i]['kredit'],0,",",".") ?></td>
  	<?php $total_kredit += $transaksi[$i]['kredit']; ?>
  	<?php 
      if($prefix == '1') {
        if($kode_akun == '105') {
          $saldo += ($transaksi[$i]['kredit'] - $transaksi[$i]['debet']);
        } else {
          $saldo += ($transaksi[$i]['debet'] - $transaksi[$i]['kredit']);
        }
      } else if($prefix == '2' || $prefix == '3' || $prefix == '4') {
        $saldo += ($transaksi[$i]['kredit'] - $transaksi[$i]['debet']);
      } else if ($prefix == '5' || $prefix == '6') {
        $saldo += ($transaksi[$i]['debet'] - $transaksi[$i]['kredit']); 
      }
    ?>
  	<td style="text-align: right;"><?php echo number_format($saldo,0,",",".") ?></td>
  	<?php $no++; ?>
  </tr>
  <?php
  	}
  ?>
  <tr>
  	<td style="text-align: center;"><strong><?php echo $no ?></strong></td>
  	<td style="text-align: center;"><strong><?php echo $tanggal_sampai ?></strong></td>
  	<td><strong>SALDO AKHIR</strong></td>
  	<td style="text-align: right;"></td>
  	<td style="text-align: right;"></td>
  	<td style="text-align: right;"><strong><?php echo number_format($saldo,0,",",".") ?></strong></td>
  </tr>
</table>