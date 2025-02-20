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
        <td colspan="3"><center>KOPERASI KHOZANAH MAMBAUL MUBASYIRIN</center></td>
    </tr>
    <tr>
        <td colspan="3"><center>LAPORAN RUGI LABA <?php echo $tanggal_dari ?> s/d <?php echo $tanggal_sampai ?></center></td>
    </tr>
    <tr>
        <td class="bold" colspan="3"><center>AHU-0003689.AH.01.39.TAHUN 2022</center></td>
    </tr>
    <tr>
        <td colspan="3"><center>Kantor : Desa Ngumpakdalem Rt 10 Rw 03 Kecamatan Dander Kabupaten Bojonegoro</center></td>
    </tr>
</table>
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
	    			<td style="text-align: right"><?php echo number_format($kode_beban[$i]['selisih'],0,",","."); ?></td>
    			</tr>
    <?php
        	}
        }
	?>
	<tr>
		<td></td>
		<td style="text-align: center">JUMLAH BIAYA</td>
		<td style="text-align: right;"><?php echo number_format($total_beban,0,",","."); ?></td>
	</tr>
	<tr>
		<td></td>
		<td style="text-align: center"><strong>JUMLAH BEBAN</strong></td>
		<td style="text-align: right"><strong><?php echo number_format($total_beban,0,",","."); ?></strong></td>
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
	    			<td style="text-align: right"><?php echo number_format($kode_pendapatan[$i]['selisih'],0,",","."); ?></td>
    			</tr>
    <?php
        	}
        }
	?>
	<tr>
		<td></td>
		<td style="text-align: center">JUMLAH PENDAPATAN</td>
		<td style="text-align: right"><?php echo number_format($total_pendapatan,0,",","."); ?></td>
	</tr>
	<tr>
		<td></td>
		<td style="text-align: center"><strong>JUMLAH PENDAPATAN</strong></td>
		<td style="text-align: right"><strong><?php echo number_format($total_pendapatan,0,",","."); ?></strong></td>
	</tr>
	<tr>
		<td></td>
		<td style="text-align: center"><strong>SHU = PENDAPATAN - BIAYA</strong></td>
		<?php $shu = $total_pendapatan - $total_beban; ?>
		<td style="text-align: right"><strong><?php echo number_format($shu,0,",","."); ?></strong></td>
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