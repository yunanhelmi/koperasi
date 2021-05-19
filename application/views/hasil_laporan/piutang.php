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

  	$tgl 		= strtotime($tanggal_laporan);
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
	    <th>JENIS PINJAMAN</th>
	    <th>JAMINAN</th>
	    <th>TGL PINJAM</th>
	    <th>SLD X</th>
	    <th>SISA PINJAMAN</th>
	    <th>LAMA PINJAM</th>
	    <th>LAMA JATUH TEMPO</th>
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
	  			<td><?php echo $data[$a]['jenis_pinjaman']; ?></td>
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
	                    /*$today = new DateTime(date("Y-m-d"));
	                    $jatuh_tempo = new DateTime(addMonths($data[$a]['tanggal_pinjaman'], $data[$a]['jumlah_angsuran_detail'] + 1));*/
	                    $today = strtotime($tanggal_laporan);
	                    $today = date('Y-m-d', $today);
	                    $today = new DateTime($today);
	                    $tgl_akhir_bayar = strtotime($data[$a]['waktu_terakhir_angsuran']);
	                    $tgl_akhir_bayar = date('Y-m-d', $tgl_akhir_bayar);
	                    $tgl_akhir_bayar = new DateTime($tgl_akhir_bayar);

	                    if($today < $tgl_akhir_bayar) {
	                    	$diff = 0;
	                    	$lama_jatuh_tempo = 0;
	                    } else {
	                    	$diff = $today->diff($tgl_akhir_bayar)->format("%a");
	                    	if($diff <= 30) {
	                    		$lama_jatuh_tempo = 0;
	                    	} else {
	                    		$lama_jatuh_tempo = $diff - 30;
	                    	}
	                    }
	            ?>
	            		<td style="text-align: center;"><?php echo $diff." hari" ?></td>
	            		<td style="text-align: center;"><?php echo $lama_jatuh_tempo." hari" ?></td>
	            <?php
	                    if($diff <= 30) {
	            ?>
	            			<td style="background-color: green; text-align: center;">Hijau</td>
	            <?php
	                    } else if ($diff > 30 && $diff <= 150) {
	            ?>
	            			<td style="background-color: yellow; text-align: center;">Kuning</td>
	            <?php
	                    } else if ($diff > 150 && $diff <= 365) {
	            ?>
	            			<td style="background-color: orange; text-align: center;">Orange</td>
	            <?php
	                    } else if ($diff > 365 && $diff <= 730) {
	            ?>
	            			<td style="background-color: pink; text-align: center;">Pink</td>
	            <?php
	                    } else if ($diff > 730) {
	            ?>
	            			<td style="background-color: red; text-align: center;">Merah</td>
	            <?php
	                    }
	                } else if($data[$a]['jenis_pinjaman'] == 'Musiman') {
	                	// GET Today and Jatuh Tempo
	                    //$today = new DateTime(date("Y-m-d"));
	                    $today = strtotime($tanggal_laporan);
	                    $today = date('Y-m-d', $today);
	                    $today = new DateTime($today);
	                    //$jatuh_tempo = new DateTime(addMonths($data[$a]['tanggal_pinjaman'], 4));
	                    $tanggal_pinjaman = strtotime($data[$a]['tanggal_pinjaman']);
	                    $tanggal_pinjaman = date('Y-m-d', $tanggal_pinjaman);
	                    $tanggal_pinjaman = new DateTime($tanggal_pinjaman);

	                    if($today < $tanggal_pinjaman) {
	                    	$diff = 0;
	                    	$lama_jatuh_tempo = 0;
	                    } else {
	                    	$diff = $today->diff($tanggal_pinjaman)->format("%a");
	                    	if($diff <= 120) {
	                    		$lama_jatuh_tempo = 0;
	                    	} else {
	                    		$lama_jatuh_tempo = $diff - 120;
	                    	}
	                    }
	            ?>
	            		<td style="text-align: center;"><?php echo $diff." hari" ?></td>
	            		<td style="text-align: center;"><?php echo $lama_jatuh_tempo." hari" ?></td>
	            <?php
	                    if($diff <= 120) {
	            ?>
	            			<td style="background-color: green; text-align: center;">Hijau</td>
	            <?php
	                    } else if ($diff > 120 && $diff <= 150) {
	            ?>
	            			<td style="background-color: yellow; text-align: center;">Kuning</td>
	            <?php
	                    } else if ($diff > 150 && $diff <= 365) {
	            ?>
	            			<td style="background-color: orange; text-align: center;">Orange</td>
	            <?php
	            		} else if ($diff > 365 && $diff <= 730) {
	            ?>
	            			<td style="background-color: pink; text-align: center;">Pink</td>		
	            <?php
	                    } else if ($diff > 730) {
	            ?>
	            			<td style="background-color: red; text-align: center;">Merah</td>
	            <?php
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