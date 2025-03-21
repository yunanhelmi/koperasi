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
        <td colspan="3"><center>LAPORAN NERACA <?php echo $tanggal_dari ?> s/d <?php echo $tanggal_sampai ?></center></td>
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
		<th style="width:70%;">AKTIVA</th>
		<th style="width:20%;">JUMLAH</th>
	</tr>
	<tr>
		<td></td>
		<td style="text-align: center;">HARTA</td>
		<td></td>
	</tr>
	<?php
		for($i = 0; $i < sizeof($kode_aset); $i++) {
        	if($kode_aset[$i]['selisih'] != 0) {
    ?>			<tr>
    				<td style="text-align: center"><?php echo $kode_aset[$i]['kode_akun']; ?></td>
	    			<td><?php echo $kode_aset[$i]['nama_akun']; ?></td>
	    			<td style="text-align: right"><?php echo number_format($kode_aset[$i]['selisih'],0,",","."); ?></td>
    			</tr>
    <?php
        	}
        }
	?>
	<tr>
		<td></td>
		<td style="text-align: center">JUMLAH HARTA</td>
		<td style="text-align: right;"><?php echo number_format($total_aset,0,",","."); ?></td>
	</tr>
	<tr>
		<td></td>
		<td style="text-align: center"><strong>JUMLAH AKTIVA</strong></td>
		<td style="text-align: right"><strong><?php echo number_format($total_aset,0,",","."); ?></strong></td>
	</tr>
</table>
<br>
<table border="1" style="width:100%; border-collapse: collapse;">
	<tr>
		<th style="width:10%;">NO</th>
		<th style="width:70%;">PASIVA</th>
		<th style="width:20%;">JUMLAH</th>
	</tr>
	<tr>
		<td></td>
		<td style="text-align: center;">HUTANG</td>
		<td></td>
	</tr>
	<?php
		for($i = 0; $i < sizeof($kode_hutang); $i++) {
        	if($kode_hutang[$i]['selisih'] != 0) {
    ?>			<tr>
    				<td style="text-align: center"><?php echo $kode_hutang[$i]['kode_akun']; ?></td>
	    			<td><?php echo $kode_hutang[$i]['nama_akun']; ?></td>
	    			<td style="text-align: right"><?php echo number_format($kode_hutang[$i]['selisih'],0,",","."); ?></td>
    			</tr>
    <?php
        	}
        }
	?>
	<tr>
		<td></td>
		<td style="text-align: center">JUMLAH HUTANG</td>
		<td style="text-align: right"><?php echo number_format($total_hutang,0,",","."); ?></td>
	</tr>
	<tr>
		<td></td>
		<td style="text-align: center;">MODAL</td>
		<td></td>
	</tr>
	<?php
		for($i = 0; $i < sizeof($kode_modal); $i++) {
        	if($kode_modal[$i]['selisih'] != 0) {
    ?>			<tr>
    				<td style="text-align: center"><?php echo $kode_modal[$i]['kode_akun']; ?></td>
	    			<td><?php echo $kode_modal[$i]['nama_akun']; ?></td>
	    			<td style="text-align: right"><?php echo number_format($kode_modal[$i]['selisih'],0,",","."); ?></td>
    			</tr>
    <?php
        	}
        }
	?>
	<tr>
		<td></td>
		<td style="text-align: center">JUMLAH MODAL</td>
		<td style="text-align: right"><?php echo number_format($total_modal,0,",","."); ?></td>
	</tr>
	<tr></tr>
	<tr>
		<td></td>
		<td style="text-align: center"><strong>JUMLAH PASIVA</strong></td>
		<?php $jumlah_pasiva = $total_hutang + $total_modal ?>
		<td style="text-align: right"><strong><?php echo number_format($jumlah_pasiva,0,",","."); ?></strong></td>
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
<br>
<br>
<br>
<table style="width: 100%">
	<tr>
		<td style="width: 40%"><strong>RENTABILITAS (%) : SHU / MODAL SENDIRI  X 100 %</strong></td>
		<td style="width: 60%"><strong><?php echo $rentabilitas ?></strong></td>
	</tr>
	<tr>
		<td style="width: 40%"><strong>LIKUIDITAS  : HARTA LANCAR / HUTANG LANCAR</strong></td>
		<td style="width: 60%"><strong><?php echo $likuiditas ?></strong></td>
	</tr>
	<tr>
		<td style="width: 40%"><strong>SOLVABILITAS  : TOTAL AKTIVA / TOTAL HUTANG</strong></td>
		<td style="width: 60%"><strong><?php echo $solvabilitas ?></strong></td>
	</tr>
</table>