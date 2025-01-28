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
        <td colspan="10"><center>KOPERASI KHOZANAH MAMBAUL MUBASYIRIN</center></td>
    </tr>
    <tr>
        <td colspan="10"><center>LAPORAN SIMPANAN POKOK ISTIMEWA <?php echo $tanggal ?></center></td>
    </tr>
    <tr>
        <td class="bold" colspan="10"><center>AHU-0003689.AH.01.39.TAHUN 2022</center></td>
    </tr>
    <tr>
        <td colspan="10"><center>Kantor : Desa Ngumpakdalem Rt 10 Rw 03 Kecamatan Dander Kabupaten Bojonegoro</center></td>
    </tr>
</table>
<br>

<table border="1" style="width:100%; border-collapse: collapse;">
	<tr>
		<th>NO</th>
		<th>NAMA</th>
		<th>NOMOR NASABAH</th>
		<th>ALAMAT</th>
		<th>DESA</th>
		<th>DUSUN</th>
		<th>RT</th>
		<th>RW</th>
		<th>TANGGAL</th>
		<th>JUMLAH SIMPANAN</th>
	</tr>
	<?php
        $no = 1;
        $total = 0;
        for($a = 0; $a < sizeof($data); $a++) {
            $pinjaman = $data[$a]['total_setoran'] - $data[$a]['total_tarikan'];
            if($pinjaman != 0) {
    ?>
    			<tr>
	                <td style="text-align: center;"><?php echo $no ?></td>
	                <td style="text-align: center;"><?php echo $data[$a]['nama'] ?></td>
	                <td style="text-align: center;"><?php echo $data[$a]['nomor_nasabah'] ?></td>
	                <td style="text-align: center;"><?php echo $data[$a]['alamat'] ?></td>
	                <td style="text-align: center;"><?php echo $data[$a]['kelurahan'] ?></td>
	                <td style="text-align: center;"><?php echo $data[$a]['dusun'] ?></td>
	                <td style="text-align: center;"><?php echo $data[$a]['rt'] ?></td>
	                <td style="text-align: center;"><?php echo $data[$a]['rw'] ?></td>
	                <td style="text-align: center;"><?php echo tanggal_indo($data[$a]['waktu']) ?></td>
	                <td style="text-align: right;"><?php echo number_format($pinjaman,0,",",".") ?></td>
	            </tr>
    <?php
    			$total += $pinjaman;
            	$no++;
            }
        }
    ?>
    <tr>
        <td colspan="8" style="text-align: center;"><strong>TOTAL</strong></td>
        <td style="text-align: right;"><strong><?php echo number_format($total,0,",",".") ?></strong></td>
    </tr>
    <tr>
        <td colspan="8" style="text-align: center;"><strong>TOTAL (NERACA)</strong></td>
        <td style="text-align: right;"><strong><?php echo number_format($total_neraca,0,",",".") ?></strong></td>
    </tr>
    <?php
        $selisih = $total - $total_neraca;
    ?>
    <tr>
        <td colspan="8" style="text-align: center;"><strong>SELISIH</strong></td>
        <td style="text-align: right;"><strong><?php echo number_format($selisih,0,",",".") ?></strong></td>
    </tr>
</table>