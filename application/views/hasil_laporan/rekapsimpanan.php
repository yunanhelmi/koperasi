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
?>

<center>KOPERASI KHOZANAH MAMBAUL MUBASYIRIN</center>
<br>
<center>LAPORAN REKAP SIMPANAN <?php echo $tanggal ?> <?php echo sizeof($data) ?></center>
<br>
<center><strong>AHU-0003689.AH.01.39.TAHUN 2022</strong></center>
<br>
<center>Kantor : Desa Ngumpakdalem Rt 10 Rw 03 Kecamatan Dander Kabupaten Bojonegoro</center>
<br>
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
		<th>SIMPANAN 3TH</th>
	</tr>
	<?php
        $no = 1;
        $total_simpananpokok = 0;
        $total_simpananwajib = 0;
        $total_simpanankhusus = 0;
        $total_rincian_jasa = 0;
        $total_simpanan3th = 0;

        for($a = 0; $a < sizeof($data); $a++) {
            $simpananpokok = $data[$a]['simpananpokok_total_setoran'] - $data[$a]['simpananpokok_total_tarikan'];
            $simpananwajib = $data[$a]['simpananwajib_total_setoran'] - $data[$a]['simpananwajib_total_tarikan'];
            $simpanankhusus = $data[$a]['simpanankhusus_total_setoran'] - $data[$a]['simpanankhusus_total_tarikan'];
            $rincian_jasa = $data[$a]['rincianjasa_total_jasa'] + $data[$a]['rincianjasa_total_denda'];
            $simpanan3th = $data[$a]['simpanan3th_total_setoran'] - $data[$a]['simpanan3th_total_tarikan'];
    ?>
			<tr>
                <td style="text-align: center;"><?php echo $no ?></td>
                <td style="text-align: center;"><?php echo $data[$a]['nama'] ?></td>
                <td style="text-align: center;"><?php echo $data[$a]['nomor_koperasi'] ?></td>
                <td style="text-align: center;"><?php echo $data[$a]['kelurahan'] ?></td>
                <td style="text-align: right;"><?php echo $simpananpokok ?></td>
                <td style="text-align: right;"><?php echo $simpananwajib ?></td>
                <td style="text-align: right;"><?php echo $simpanankhusus ?></td>
                <td style="text-align: right;"><?php echo $rincian_jasa ?></td>
                <td style="text-align: right;"><?php echo $simpanan3th ?></td>
            </tr>
	<?php
			$total_simpananpokok += $simpananpokok;
	        $total_simpananwajib += $simpananwajib;
	        $total_simpanankhusus += $simpanankhusus;
	        $total_rincian_jasa += $rincian_jasa;
	        $total_simpanan3th += $simpanan3th;
        	$no++;
        }
    ?>
    <tr>
        <td colspan="4" style="text-align: center;"><strong>TOTAL</strong></td>
        <td style="text-align: right;"><strong><?php echo $total_simpananpokok ?></strong></td>
        <td style="text-align: right;"><strong><?php echo $total_simpananwajib ?></strong></td>
        <td style="text-align: right;"><strong><?php echo $total_simpanankhusus ?></strong></td>
        <td style="text-align: right;"><strong><?php echo $total_rincian_jasa ?></strong></td>
        <td style="text-align: right;"><strong><?php echo $total_simpanan3th ?></strong></td>
    </tr>
    <tr>
        <td colspan="4" style="text-align: center;"><strong>TOTAL (NERACA)</strong></td>
        <td style="text-align: right;"><strong><?php echo $total_neraca['simpanan_pokok'] ?></strong></td>
        <td style="text-align: right;"><strong><?php echo $total_neraca['simpanan_wajib'] ?></strong></td>
        <td style="text-align: right;"><strong><?php echo $total_neraca['simpanan_khusus'] ?></strong></td>
        <td style="text-align: right;"><strong><?php echo $total_neraca['rincian_jasa'] ?></strong></td>
        <td style="text-align: right;"><strong><?php echo $total_neraca['simpanan3th'] ?></strong></td>
    </tr>
    <?php
        $selisih_simpananpokok = $total_simpananpokok - $total_neraca['simpanan_pokok'];
        $selisih_simpananwajib = $total_simpananwajib - $total_neraca['simpanan_wajib'];
        $selisih_simpanankhusus = $total_simpanankhusus - $total_neraca['simpanan_khusus'];
        $selisih_rincian_jasa = $total_rincian_jasa - $total_neraca['rincian_jasa'];
        $selisih_simpanan3th = $total_simpanan3th - $total_neraca['simpanan3th'];
        $selisih_pencairan_jasa = $selisih_rincian_jasa - $total_neraca['pencairan_jasa'];
    ?>
    <tr>
        <td colspan="4" style="text-align: center;"><strong>SELISIH</strong></td>
        <td style="text-align: right;"><strong><?php echo $selisih_simpananpokok ?></strong></td>
        <td style="text-align: right;"><strong><?php echo $selisih_simpananwajib ?></strong></td>
        <td style="text-align: right;"><strong><?php echo $selisih_simpanankhusus ?></strong></td>
        <td style="text-align: right;"><strong><?php echo $selisih_rincian_jasa ?></strong></td>
        <td style="text-align: right;"><strong><?php echo $selisih_simpanan3th ?></strong></td>
    </tr>
    <tr>
        <td colspan="4" style="text-align: center;"><strong>PENCAIRAN</strong></td>
        <td style="text-align: right;"><strong>0</strong></td>
        <td style="text-align: right;"><strong>0</strong></td>
        <td style="text-align: right;"><strong>0</strong></td>
        <td style="text-align: right;"><strong><?php echo $total_neraca['pencairan_jasa'] ?></strong></td>
        <td style="text-align: right;"><strong>0</strong></td>
    </tr>
    <tr>
        <td colspan="4" style="text-align: center;"><strong>SELISIH</strong></td>
        <td style="text-align: right;"><strong>0</strong></td>
        <td style="text-align: right;"><strong>0</strong></td>
        <td style="text-align: right;"><strong>0</strong></td>
        <td style="text-align: right;"><strong><?php echo $selisih_pencairan_jasa ?></strong></td>
        <td style="text-align: right;"><strong>0</strong></td>
    </tr>
</table>