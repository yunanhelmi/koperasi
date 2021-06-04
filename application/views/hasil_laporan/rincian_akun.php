<?php 
  $tgl 			= strtotime($dari);
	$tanggal_dari 	= date("d-m-Y",$tgl);

	$tgl 			= strtotime($sampai);
	$tanggal_sampai	= date("d-m-Y",$tgl);
?>

<center>KOPPONTREN MAMBAUL MUBBASYIRIN SHIDDIQIYAH</center>
<br>
<center>LAPORAN KEUANGAN <?php echo $tanggal_dari ?> s/d <?php echo $tanggal_sampai ?></center>
<br>
<center>KANTOR PONPES MAJMA'AL BAHRAIN SHIDDIQIYAH</center>
<br>
<center>TIMUR PASAR NGUMPAKDALEM, DANDER BOJONEGORO TELP 081335044439       BH : 8181/BH/II/95</center>
<br>
<center>HISTORI RIWAYAT AKUN <?php echo $kode_akun ?> - <?php echo $nama_akun ?> <?php echo $tanggal_dari ?> s/d <?php echo $tanggal_sampai ?></center>
<br>
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
  	<td style="text-align: right;"><?php echo $saldo_awal ?></td>
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
  	<td style="text-align: right;"><?php echo $transaksi[$i]['debet'] ?></td>
  	<?php $total_debet += $transaksi[$i]['debet']; ?>
  	<td style="text-align: right;"><?php echo $transaksi[$i]['kredit'] ?></td>
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
  	<td style="text-align: right;"><?php echo $saldo ?></td>
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
  	<td style="text-align: right;"><strong><?php echo $saldo ?></strong></td>
  </tr>
</table>