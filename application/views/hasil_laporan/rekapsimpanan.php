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

  	$tgl 		= strtotime($tanggal);
	$tanggal 	= date("d-m-Y",$tgl);

    $column = 0;
    for($i = 0; $i < sizeof($simpanan3th); $i++) {
        $column++;
    }
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
        <td colspan="<?php echo $column+8; ?>"><center>KOPERASI KHOZANAH MAMBAUL MUBASYIRIN</center></td>
    </tr>
    <tr>
        <td colspan="<?php echo $column+8; ?>"><center>LAPORAN REKAP SIMPANAN <?php echo $tanggal ?> <?php echo sizeof($data) ?></center></td>
    </tr>
    <tr>
        <td class="bold" colspan="<?php echo $column+8; ?>"><center>AHU-0003689.AH.01.39.TAHUN 2022</center></td>
    </tr>
    <tr>
        <td colspan="<?php echo $column+8; ?>"><center>Kantor : Desa Ngumpakdalem Rt 10 Rw 03 Kecamatan Dander Kabupaten Bojonegoro</center></td>
    </tr>
</table>
<br>

<table border="1" style="width:100%; border-collapse: collapse;">
	<tr>
		<th>NO</th>
		<th>NAMA</th>
		<th>NO. ANGGOTA</th>
		<th>DESA</th>
		<th>SIMPANAN POKOK</th>
		<th>SIMPANAN WAJIB</th>
		<th>SIMPANAN KHUSUS</th>
		<th>RINCIAN JASA</th>
		<?php
            for($i = 0; $i < sizeof($simpanan3th); $i++) {
                $total_simpanan3th[$i] = 0;
        ?>
                <th><?php echo $simpanan3th[$i]['nama'] ?></th>
        <?php
            }
        ?>
	</tr>
	<?php
        $no = 1;
        $total_simpananpokok = 0;
        $total_simpananwajib = 0;
        $total_simpanankhusus = 0;
        $total_rincian_jasa = 0;

        for($a = 0; $a < sizeof($data); $a++) {
            $simpananpokok = $data[$a]['simpananpokok_total_setoran'] - $data[$a]['simpananpokok_total_tarikan'];
            $simpananwajib = $data[$a]['simpananwajib_total_setoran'] - $data[$a]['simpananwajib_total_tarikan'];
            $simpanankhusus = $data[$a]['simpanankhusus_total_setoran'] - $data[$a]['simpanankhusus_total_tarikan'];
            $rincian_jasa = $data[$a]['rincianjasa_total_jasa'] + $data[$a]['rincianjasa_total_denda'];
    ?>
			<tr>
                <td style="text-align: center;"><?php echo $no ?></td>
                <td style="text-align: center;"><?php echo $data[$a]['nama'] ?></td>
                <td style="text-align: center;"><?php echo $data[$a]['nomor_koperasi'] ?></td>
                <td style="text-align: center;"><?php echo $data[$a]['kelurahan'] ?></td>
                <td style="text-align: right;"><?php echo number_format($simpananpokok,0,",",".") ?></td>
                <td style="text-align: right;"><?php echo number_format($simpananwajib,0,",",".") ?></td>
                <td style="text-align: right;"><?php echo number_format($simpanankhusus,0,",",".") ?></td>
                <td style="text-align: right;"><?php echo number_format($rincian_jasa,0,",",".") ?></td>
                <?php
                    for($b = 0; $b < sizeof($simpanan3th); $b++) {
                        $temp_simpanan3th = $simpanan3th_nasabah[$b]['data'][$a]['simpanan3th_total_setoran'] - $simpanan3th_nasabah[$b]['data'][$a]['simpanan3th_total_tarikan'];
                        $total_simpanan3th[$b] += $temp_simpanan3th;
                ?>
                        <td style="text-align: right;"><?php echo number_format($temp_simpanan3th,0,",",".") ?></td>
                <?php
                    }
                ?>
            </tr>
	<?php
			$total_simpananpokok += $simpananpokok;
	        $total_simpananwajib += $simpananwajib;
	        $total_simpanankhusus += $simpanankhusus;
	        $total_rincian_jasa += $rincian_jasa;
        	$no++;
        }
    ?>
    <tr>
        <td colspan="4" style="text-align: center;"><strong>TOTAL</strong></td>
        <td style="text-align: right;"><strong><?php echo number_format($total_simpananpokok,0,",",".") ?></strong></td>
        <td style="text-align: right;"><strong><?php echo number_format($total_simpananwajib,0,",",".") ?></strong></td>
        <td style="text-align: right;"><strong><?php echo number_format($total_simpanankhusus,0,",",".") ?></strong></td>
        <td style="text-align: right;"><strong><?php echo number_format($total_rincian_jasa,0,",",".") ?></strong></td>
        <?php
            for($i = 0; $i < sizeof($simpanan3th); $i++) {
        ?>
                <td style="text-align: right;"><strong><?php echo number_format($total_simpanan3th[$i],0,",",".") ?></strong></td>
        <?php
            }
        ?>
        
    </tr>
    <tr>
        <td colspan="4" style="text-align: center;"><strong>TOTAL (NERACA)</strong></td>
        <td style="text-align: right;"><strong><?php echo number_format($total_neraca['simpanan_pokok'],0,",",".") ?></strong></td>
        <td style="text-align: right;"><strong><?php echo number_format($total_neraca['simpanan_wajib'],0,",",".") ?></strong></td>
        <td style="text-align: right;"><strong><?php echo number_format($total_neraca['simpanan_khusus'],0,",",".") ?></strong></td>
        <td style="text-align: right;"><strong><?php echo number_format($total_neraca['rincian_jasa'],0,",",".") ?></strong></td>
        <?php
            for($i = 0; $i < sizeof($simpanan3th); $i++) {
                $selisih_simpanan3th[$i] = $total_simpanan3th[$i] - $simpanan3th[$i]['total_neraca'];
        ?>
                <td style="text-align: right;"><strong><?php echo number_format($simpanan3th[$i]['total_neraca'],0,",",".") ?></strong></td>
        <?php
            }
        ?>
    </tr>
    <?php
        $selisih_simpananpokok = $total_simpananpokok - $total_neraca['simpanan_pokok'];
        $selisih_simpananwajib = $total_simpananwajib - $total_neraca['simpanan_wajib'];
        $selisih_simpanankhusus = $total_simpanankhusus - $total_neraca['simpanan_khusus'];
        $selisih_rincian_jasa = $total_rincian_jasa - $total_neraca['rincian_jasa'];
        $selisih_pencairan_jasa = $selisih_rincian_jasa - $total_neraca['pencairan_jasa'];
    ?>
    <tr>
        <td colspan="4" style="text-align: center;"><strong>SELISIH</strong></td>
        <td style="text-align: right;"><strong><?php echo number_format($selisih_simpananpokok,0,",",".") ?></strong></td>
        <td style="text-align: right;"><strong><?php echo number_format($selisih_simpananwajib,0,",",".") ?></strong></td>
        <td style="text-align: right;"><strong><?php echo number_format($selisih_simpanankhusus,0,",",".") ?></strong></td>
        <td style="text-align: right;"><strong><?php echo number_format($selisih_rincian_jasa,0,",",".") ?></strong></td>
        <?php
            for($i = 0; $i < sizeof($simpanan3th); $i++) {
        ?>
                <td style="text-align: right;"><strong><?php echo number_format($selisih_simpanan3th[$i],0,",",".") ?></strong></td>
        <?php
            }
        ?>
    </tr>
    <tr>
        <td colspan="4" style="text-align: center;"><strong>PENCAIRAN</strong></td>
        <td style="text-align: right;"><strong>0</strong></td>
        <td style="text-align: right;"><strong>0</strong></td>
        <td style="text-align: right;"><strong>0</strong></td>
        <td style="text-align: right;"><strong><?php echo number_format($total_neraca['pencairan_jasa'],0,",",".") ?></strong></td>
        <?php
            for($i = 0; $i < sizeof($simpanan3th); $i++) {
        ?>
                <td style="text-align: right;"><strong>0</strong></td>
        <?php
            }
        ?>
    </tr>
    <tr>
        <td colspan="4" style="text-align: center;"><strong>SELISIH</strong></td>
        <td style="text-align: right;"><strong>0</strong></td>
        <td style="text-align: right;"><strong>0</strong></td>
        <td style="text-align: right;"><strong>0</strong></td>
        <td style="text-align: right;"><strong><?php echo number_format($selisih_pencairan_jasa,0,",",".") ?></strong></td>
        <?php
            for($i = 0; $i < sizeof($simpanan3th); $i++) {
        ?>
                <td style="text-align: right;"><strong>0</strong></td>
        <?php
            }
        ?>
    </tr>
</table>