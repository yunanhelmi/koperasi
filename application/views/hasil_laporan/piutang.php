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

  	$tgl 		= strtotime($tanggal);
	$tanggal 	= date("d-m-Y",$tgl);
?>

<center>KOPPONTREN MAMBAUL MUBBASYIRIN SHIDDIQIYAH</center>
<br>
<center>LAPORAN PIUTANG ANGGOTA <?php echo $tanggal ?></center>
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
	    <th>NOMOR NASABAH</th>
	    <th>ALAMAT</th>
	    <th>DESA</th>
	    <th>DUSUN</th>
	    <th>RW</th>
	    <th>RT</th>
	    <th>JAMINAN</th>
	    <th>TGL PINJAM</th>
	    <th>SLD X</th>
	    <th>SISA PINJAMAN</th>
	    <th>KETERANGAN</th>
	</tr>
	<?php
	  	$no = 1;
	  	$total_sisa = 0;
	  	for($a = 0; $a < sizeof($data); $a++) {
	  		$saldo = $data[$a]['total_pinjaman_detail'] - $data[$a]['total_angsuran_detail'];
	  		if($saldo != 0) {
	?>
			<tr>
	  			<td style="text-align: center;"><?php echo $no ?></td>
	  			<td><?php echo $data[$a]['nama']; ?></td>
	  			<td style="text-align: center;"><?php echo $data[$a]['nomor_koperasi']; ?></td>
	  			<td><?php echo $data[$a]['alamat']; ?></td>
	  			<td><?php echo $data[$a]['kelurahan']; ?></td>
	  			<td><?php echo $data[$a]['dusun']; ?></td>
	  			<td><?php echo $data[$a]['rw']; ?></td>
	  			<td><?php echo $data[$a]['rt']; ?></td>
	  			<td><?php echo $data[$a]['jaminan']; ?></td>
	  			<?php 
				  	$tgl 		= strtotime($data[$a]['tanggal_pinjaman']);
					$tanggal 	= date("d-m-Y",$tgl);
				?>
			  	<td style="text-align: center;"><?php echo $tanggal ?></td>
			  	<?php
			  		if($data[$a]['jenis_pinjaman'] == 'Musiman') {
	                    $sisa_kali_angsuran = 1;
	                } else if($data[$a]['jenis_pinjaman'] == 'Angsuran') {
	                    $sisa_kali_angsuran = $data[$a]['jumlah_angsuran'] - $data[$a]['jumlah_angsuran_detail'];
	                }
			  	?>
			  	<td style="text-align: center;"><?php echo $sisa_kali_angsuran ?></td>
			  	<td style="text-align: right;"><?php echo $saldo ?></td>
			  	<?php
			  		$total_sisa += $saldo;
			  		if($data[$a]['jenis_pinjaman'] == 'Angsuran') {
	                    // GET Today and Jatuh Tempo
	                    $today = new DateTime(date("Y-m-d"));
	                    $jatuh_tempo = new DateTime(addMonths($data[$a]['tanggal_pinjaman'], $data[$a]['jumlah_angsuran_detail'] + 1));

	                    // GET Diff Today and Jatuh Tempo
	                    if($today < $jatuh_tempo) {
	            ?>
	            		<td style="background-color: green; text-align: center;">Hijau</td>
	            <?php
	                    } else {
	                    	$diff = $today->diff($jatuh_tempo);
	                        $interval = ($diff->format('%y') * 12) + $diff->format('%m');
	                        if($interval < 3) {
	            ?>
	            				<td style="background-color: green; text-align: center;">Hijau</td>
	            <?php
	                        } else if ($interval >= 3 && $interval < 6) {
	            ?>
	            				<td style="background-color: yellow; text-align: center;">Kuning</td>
	            <?php
	                        } else if ($interval >= 6 && $interval < 9) {
	            ?>
	            				<td style="background-color: pink; text-align: center;">Merah 1</td>
	            <?php
	                        } else if ($interval >= 9) {
	            ?>
	            				<td style="background-color: red; text-align: center;">Merah 2</td>
	            <?php
	                        }
	                    }
	                } else if($data[$a]['jenis_pinjaman'] == 'Musiman') {
	                	// GET Today and Jatuh Tempo
	                    $today = new DateTime(date("Y-m-d"));
	                    $jatuh_tempo = new DateTime(addMonths($data[$a]['tanggal_pinjaman'], 4));

	                    // GET Diff Today and Jatuh Tempo
	                    if($today < $jatuh_tempo) {
	            ?>
	            				<td style="background-color: green; text-align: center;">Hijau</td>
	            <?php
	                    } else {
	                        $diff = $today->diff($jatuh_tempo);
	                        $interval = ($diff->format('%y') * 12) + $diff->format('%m');
	                        if($interval < 3) {
	            ?>
	            				<td style="background-color: green; text-align: center;">Hijau</td>
	            <?php
	                        } else if ($interval >= 3 && $interval < 6) {
	            ?>
	            				<td style="background-color: yellow; text-align: center;">Kuning</td>
	            <?php
	                        } else if ($interval >= 6 && $interval < 9) {
	            ?>
	            				<td style="background-color: pink; text-align: center;">Merah 1</td>
	            <?php
	                        } else if ($interval >= 9) {
	            ?>
	            				<td style="background-color: red; text-align: center;">Merah 2</td>
	            <?php
	                        }
	                    }
	                }
			  	?>
			</tr>
	<?php
	  		$no++;
	  		}
	  	}
	?>
	<tr>
		<td colspan="11" style="text-align: center;"><strong>TOTAL PIUTANG</strong></td>
		<td style="text-align: right;"><strong><?php echo $total_sisa ?></strong></td>
		<td></td>
	</tr>
	<tr>
		<td colspan="11" style="text-align: center;"><strong>TOTAL PIUTANG (NERACA)</strong></td>
		<td style="text-align: right;"><strong><?php echo $piutang_neraca ?></strong></td>
		<td></td>
	</tr>
	<?php
		$selisih = $total_sisa - $piutang_neraca;
	?>
	<tr>
		<td colspan="11" style="text-align: center;"><strong>SELISIH</strong></td>
		<td style="text-align: right;"><strong><?php echo $selisih ?></strong></td>
		<td></td>
	</tr>
</table>