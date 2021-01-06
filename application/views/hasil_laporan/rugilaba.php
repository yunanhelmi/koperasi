<?php

	function isLeapYear($year) {
        return ((($year % 4 === 0) && ($year % 100 !== 0)) || ($year % 400 === 0));
    }

    function getDaysInMonth($year, $month) {
        return [31, (isLeapYear($year) ? 29 : 28), 31, 30, 31, 30, 31, 31, 30, 31, 30, 31][$month - 1];
    }

	function addMonths($d, $value) {
        $date = new DateTime($d);
        $tanggal1 = $date->format('d');

        $date->setDate($date->format('Y'), $date->format('m'), 1);
        $date->setDate($date->format('Y'), $date->format('m') + $value, $date->format('d'));
        
        $tahun = $date->format('Y');
        $bulan = (int)$date->format('m');

        $tanggal2 = getDaysInMonth($tahun, $bulan);

        if($tanggal1 <= $tanggal2) {
            $date->setDate($date->format('Y'), $date->format('m'), $tanggal1);
        } else {
            $date->setDate($date->format('Y'), $date->format('m'), $tanggal2);
        }

        return $date->format('Y-m-d');
    }

    function diffMonths($d, $value) {
        $date = new DateTime($d);
        $tanggal1 = $date->format('d');

        $date->setDate($date->format('Y'), $date->format('m'), 1);
        $date->setDate($date->format('Y'), $date->format('m') - $value, $date->format('d'));
        
        $tahun = $date->format('Y');
        $bulan = (int)$date->format('m');

        $tanggal2 = getDaysInMonth($tahun, $bulan);

        if($tanggal1 <= $tanggal2) {
            $date->setDate($date->format('Y'), $date->format('m'), $tanggal1);
        } else {
            $date->setDate($date->format('Y'), $date->format('m'), $tanggal2);
        }

        return $date->format('Y-m-d');
    }

  	$tgl 			= strtotime($dari);
	$tanggal_dari 	= date("d-m-Y",$tgl);

	$tgl 			= strtotime($sampai);
	$tanggal_sampai	= date("d-m-Y",$tgl);

?>

<center>KOPPONTREN MAMBAUL MUBBASYIRIN SHIDDIQIYAH</center>
<br>
<center>LAPORAN NERACA <?php echo $tanggal_dari ?> s/d <?php echo $tanggal_sampai ?></center>
<br>
<center>KANTOR PONPES MAJMA'AL BAHRAIN SHIDDIQIYAH</center>
<br>
<center>NGARES DANDER Bojonegoro TELP (0353) 886039       BH : 8181/BH/II/95</center>
<br>
<br>

<table border="1" style="width:100%; border-collapse: collapse;">
	<tr>
		<th style="width:10%;">NO</th>
		<th style="width:70%;">BEBAN</th>
		<th style="width:20%;">JUMLAH</th>
	</tr>
	<tr>
		<td></td>
		<td style="text-align: center;">BIAYA</td>
		<td></td>
	</tr>
	<?php
		for($i = 0; $i < sizeof($kode_beban); $i++) {
        	if($kode_beban[$i]['selisih'] != 0) {
    ?>			<tr>
    				<td style="text-align: center"><?php echo $kode_beban[$i]['kode_akun']; ?></td>
	    			<td><?php echo $kode_beban[$i]['nama_akun']; ?></td>
	    			<td style="text-align: right"><?php echo number_format($kode_beban[$i]['selisih']); ?></td>
    			</tr>
    <?php
        	}
        }
	?>
	<tr>
		<td></td>
		<td style="text-align: center">JUMLAH BIAYA</td>
		<td style="text-align: right;"><?php echo number_format($total_beban); ?></td>
	</tr>
	<tr>
		<td></td>
		<td style="text-align: center"><strong>JUMLAH BEBAN</strong></td>
		<td style="text-align: right"><strong><?php echo number_format($total_beban); ?></strong></td>
	</tr>
</table>
<br>
<table border="1" style="width:100%; border-collapse: collapse;">
	<tr>
		<th style="width:10%;">NO</th>
		<th style="width:70%;">PENDAPATAN</th>
		<th style="width:20%;">JUMLAH</th>
	</tr>
	<tr>
		<td></td>
		<td style="text-align: center;">PENDAPATAN</td>
		<td></td>
	</tr>
	<?php
		for($i = 0; $i < sizeof($kode_pendapatan); $i++) {
        	if($kode_pendapatan[$i]['selisih'] != 0) {
    ?>			<tr>
    				<td style="text-align: center"><?php echo $kode_pendapatan[$i]['kode_akun']; ?></td>
	    			<td><?php echo $kode_pendapatan[$i]['nama_akun']; ?></td>
	    			<td style="text-align: right"><?php echo number_format($kode_pendapatan[$i]['selisih']); ?></td>
    			</tr>
    <?php
        	}
        }
	?>
	<tr>
		<td></td>
		<td style="text-align: center">JUMLAH PENDAPATAN</td>
		<td style="text-align: right"><?php echo number_format($total_pendapatan); ?></td>
	</tr>
	<tr>
		<td></td>
		<td style="text-align: center"><strong>JUMLAH PENDAPATAN</strong></td>
		<td style="text-align: right"><strong><?php echo number_format($total_pendapatan); ?></strong></td>
	</tr>
	<tr>
		<td></td>
		<td style="text-align: center"><strong>SHU = PENDAPATAN - BIAYA</strong></td>
		<?php $shu = $total_pendapatan - $total_beban; ?>
		<td style="text-align: right"><strong><?php echo number_format($shu); ?></strong></td>
	</tr>
</table>
<br>