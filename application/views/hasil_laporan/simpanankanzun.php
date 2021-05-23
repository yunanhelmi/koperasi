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

<center>KOPPONTREN MAMBAUL MUBBASYIRIN SHIDDIQIYAH</center>
<br>
<center>LAPORAN SIMPANAN KANZUN <?php echo $tanggal ?></center>
<br>
<center>KANTOR PONPES MAJMA'AL BAHRAIN SHIDDIQIYAH</center>
<br>
<center>NGRASEH DANDER BOJONEGORO TELP (0353) 886039       BH : 8181/BH/II/95</center>
<br>
<br>

<table border="1" style="width:100%; border-collapse: collapse;">
	<tr>
		<th>NO</th>
		<th>NAMA</th>
		<th>ALAMAT</th>
		<th>DESA</th>
		<th>DUSUN</th>
		<th>RW</th>
		<th>RT</th>
		<th>TANGGAL</th>
		<th>JUMLAH SIMPANAN</th>
	</tr>
	<?php
        $no = 1;
        $total = 0;
        for($a = 0; $a < sizeof($data); $a++) {
            $pinjaman = $data[$a]['total_setoran_detail'] - $data[$a]['total_tarikan_detail'];
            if($pinjaman != 0) {
    ?>
    			<tr>
	                <td style="text-align: center;"><?php echo $no ?></td>
	                <td style="text-align: center;"><?php echo $data[$a]['nama'] ?></td>
	                <td style="text-align: center;"><?php echo $data[$a]['alamat'] ?></td>
	                <td style="text-align: center;"><?php echo $data[$a]['kelurahan'] ?></td>
	                <td style="text-align: center;"><?php echo $data[$a]['dusun'] ?></td>
	                <td style="text-align: center;"><?php echo $data[$a]['rw'] ?></td>
	                <td style="text-align: center;"><?php echo $data[$a]['rt'] ?></td>
	                <td style="text-align: center;"><?php echo tanggal_indo($data[$a]['waktu']) ?></td>
	                <td style="text-align: right;"><?php echo $pinjaman ?></td>
	            </tr>
    <?php
    			$total += $pinjaman;
            	$no++;
            }
        }
    ?>
    <tr>
        <td colspan="8" style="text-align: center;"><strong>TOTAL</strong></td>
        <td style="text-align: right;"><strong><?php echo $total ?></strong></td>
    </tr>
    <tr>
        <td colspan="8" style="text-align: center;"><strong>TOTAL (NERACA)</strong></td>
        <td style="text-align: right;"><strong><?php echo $total_neraca ?></strong></td>
    </tr>
    <?php
        $selisih = $total - $total_neraca;
    ?>
    <tr>
        <td colspan="8" style="text-align: center;"><strong>SELISIH</strong></td>
        <td style="text-align: right;"><strong><?php echo $selisih ?></strong></td>
    </tr>
</table>