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
<center>LAPORAN KEUANGAN <?php echo $tanggal_dari ?> s/d <?php echo $tanggal_sampai ?></center>
<br>
<center>KANTOR PONPES MAJMA'AL BAHRAIN SHIDDIQIYAH</center>
<br>
<center>TIMUR PASAR NGUMPAKDALEM, DANDER BOJONEGORO TELP 081335044439       BH : 8181/BH/II/95</center>
<br>
<br>

<table border="1" style="width:100%; border-collapse: collapse;">
	<tr>
		<th colspan="3"><strong>NERACA</strong></th>
	</tr>
	<tr>
		<th style="width:10%;">NO</th>
		<th style="width:70%;">AKTIVA</th>
		<th style="width:20%;">JUMLAH</th>
	</tr>
	<tr>
		<td></td>
		<td><strong>HARTA</strong></td>
		<td></td>
	</tr>
	<?php
		for($i = 0; $i < sizeof($kode_aset); $i++) {
        	if($kode_aset[$i]['selisih'] != 0) {
    ?>			<tr>
    				<td style="text-align: center"><?php echo $kode_aset[$i]['kode_akun']; ?></td>
	    			<td><?php echo $kode_aset[$i]['nama_akun']; ?></td>
	    			<td style="text-align: right"><?php echo $kode_aset[$i]['selisih']; ?></td>
    			</tr>
    <?php
        	}
        }
	?>
	<tr>
		<td></td>
		<td style="text-align: center"><strong>JUMLAH AKTIVA</strong></td>
		<td style="text-align: right"><strong><?php echo $total_aset; ?></strong></td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<th style="width:10%;">NO</th>
		<th style="width:70%;">PASIVA</th>
		<th style="width:20%;">JUMLAH</th>
	</tr>
	<tr>
		<td></td>
		<td><strong>HUTANG</strong></td>
		<td></td>
	</tr>
	<?php
		for($i = 0; $i < sizeof($kode_hutang); $i++) {
        	if($kode_hutang[$i]['selisih'] != 0) {
    ?>			<tr>
    				<td style="text-align: center"><?php echo $kode_hutang[$i]['kode_akun']; ?></td>
	    			<td><?php echo $kode_hutang[$i]['nama_akun']; ?></td>
	    			<td style="text-align: right"><?php echo $kode_hutang[$i]['selisih']; ?></td>
    			</tr>
    <?php
        	}
        }
	?>
	<tr>
		<td></td>
		<td style="text-align: center"><strong>JUMLAH HUTANG</strong></td>
		<td style="text-align: right"><strong><?php echo $total_hutang; ?></strong></td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td></td>
		<td><strong>MODAL</strong></td>
		<td></td>
	</tr>
	<?php
		for($i = 0; $i < sizeof($kode_modal); $i++) {
        	if($kode_modal[$i]['selisih'] != 0) {
    ?>			<tr>
    				<td style="text-align: center"><?php echo $kode_modal[$i]['kode_akun']; ?></td>
	    			<td><?php echo $kode_modal[$i]['nama_akun']; ?></td>
	    			<td style="text-align: right"><?php echo $kode_modal[$i]['selisih']; ?></td>
    			</tr>
    <?php
        	}
        }
	?>
	<tr>
		<td></td>
		<td style="text-align: center"><strong>JUMLAH MODAL</strong></td>
		<td style="text-align: right"><strong><?php echo $total_modal; ?></strong></td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td></td>
		<td style="text-align: center"><strong>JUMLAH PASIVA</strong></td>
		<?php $pasiva = $total_hutang + $total_modal; ?>
		<td style="text-align: right"><strong><?php echo $pasiva; ?></strong></td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td></td>
		<td style="text-align: center"><strong>AKTIVA = PASIVA</strong></td>
		<?php $selisih = $total_aset - ($total_hutang + $total_modal); ?>
		<td style="text-align: right"><strong><?php echo $selisih; ?></strong></td>
	</tr>
</table>
<br>
<table border="1" style="width:100%; border-collapse: collapse;">
	<tr>
		<th colspan="3"><strong>PERHITUNGAN HASIL USAHA</strong></th>
	</tr>
	<tr>
		<th style="width:10%;">NO</th>
		<th style="width:70%;">PENDAPATAN</th>
		<th style="width:20%;">JUMLAH</th>
	</tr>
	<tr>
		<td></td>
		<td><strong>PENDAPATAN JASA PINJAM</strong></td>
		<td></td>
	</tr>
	<?php
		for($i = 0; $i < sizeof($kode_pendapatan); $i++) {
        	if($kode_pendapatan[$i]['selisih'] != 0) {
    ?>			<tr>
    				<td style="text-align: center"><?php echo $kode_pendapatan[$i]['kode_akun']; ?></td>
	    			<td><?php echo $kode_pendapatan[$i]['nama_akun']; ?></td>
	    			<td style="text-align: right"><?php echo $kode_pendapatan[$i]['selisih']; ?></td>
    			</tr>
    <?php
        	}
        }
	?>
	<tr>
		<td></td>
		<td style="text-align: center"><strong>JUMLAH PENDAPATAN</strong></td>
		<td style="text-align: right"><strong><?php echo $total_pendapatan; ?></strong></td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<th style="width:10%;">NO</th>
		<th style="width:70%;">BEBAN</th>
		<th style="width:20%;">JUMLAH</th>
	</tr>
	<tr>
		<td></td>
		<td><strong>BIAYA</strong></td>
		<td></td>
	</tr>
	<?php
		for($i = 0; $i < sizeof($kode_beban); $i++) {
        	if($kode_beban[$i]['selisih'] != 0) {
    ?>			<tr>
    				<td style="text-align: center"><?php echo $kode_beban[$i]['kode_akun']; ?></td>
	    			<td><?php echo $kode_beban[$i]['nama_akun']; ?></td>
	    			<td style="text-align: right"><?php echo $kode_beban[$i]['selisih']; ?></td>
    			</tr>
    <?php
        	}
        }
	?>
	<tr>
		<td></td>
		<td style="text-align: center"><strong>JUMLAH BEBAN</strong></td>
		<td style="text-align: right"><strong><?php echo $total_beban; ?></strong></td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td></td>
		<td style="text-align: center"><strong>HASIL SHU BERJALAN</strong></td>
		<?php $shu_berjalan = $total_pendapatan - $total_beban; ?>
		<td style="text-align: right"><strong><?php echo $shu_berjalan; ?></strong></td>
	</tr>
</table>
<br>
<table style="width:100%;">
	<tr>
		<td style="width: 20%; text-align: center"></td>
		<td style="width: 60%; text-align: center"></td>
		<td style="width: 20%; text-align: center"><strong>Bojonegoro, <?php echo date("d-m-Y") ?></strong></td>
	</tr>
	<tr>
		<td style="width: 20%; text-align: center"><strong>Ketua,</strong></td>
		<td style="width: 60%; text-align: center"></td>
		<td style="width: 20%; text-align: center"><strong>Bendahara,</strong></td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td></td>
		<td></td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td></td>
		<td></td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td></td>
		<td></td>
	</tr>
	<tr>
		<td style="width: 20%; text-align: center"><strong>Drs. SUPRAPTO</strong></td>
		<td style="width: 60%; text-align: center"></td>
		<td style="width: 20%; text-align: center"><strong>DWI AGUNG, M.Pd.</strong></td>
	</tr>
</table>