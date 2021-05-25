<!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?php echo base_url()."assets/"; ?>bower_components/bootstrap/dist/css/bootstrap.min.css">
<!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url()."assets/"; ?>bower_components/font-awesome/css/font-awesome.min.css">

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

  	$tgl 				= strtotime($tanggal);
	$tanggal_laporan 	= date("d-m-Y",$tgl);
?>

<center>KOPPONTREN MAMBAUL MUBBASYIRIN SHIDDIQIYAH</center>
<br>
<center>DAFTAR SURAT TAGIHAN <?php echo $tanggal ?></center>
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
	    <th>RT</th>
	    <th>RW</th>
	    <th>JENIS PINJAMAN</th>
	    <th>JAMINAN</th>
	    <th>TGL PINJAM</th>
	    <th>TGL TERAKHIR BAYAR</th>
	    <th>TGL JATUH TEMPO</th>
	    <th>SLD X</th>
	    <th>SISA PINJAMAN</th>
	    <th>LAMA TERAKHIR BAYAR</th>
	    <th>LAMA JATUH TEMPO</th>
	    <th>KETERANGAN</th>
	    <th>CETAK</th>
	</tr>
	<?php
	  	$no = 1;
	  	$total_sisa = 0;
	  	for($a = 0; $a < sizeof($data); $a++) {
	  		$saldo = $data[$a]['total_pinjaman_detail'] - $data[$a]['total_angsuran_detail'];
	  		if($saldo != 0) {
	  			$today = new DateTime(date("Y-m-d"));
	  			if($data[$a]['jenis_pinjaman'] == 'Angsuran') {
	  				/*$jatuh_tempo = new DateTime(addMonths($data[$a]['tanggal_pinjaman'], $data[$a]['jumlah_angsuran_detail'] + 1));
	                $jatuh_tempo->setDate($jatuh_tempo->format('Y'), $jatuh_tempo->format('m'), 1);*/
	                $sisa_kali_angsuran = $data[$a]['jumlah_angsuran'] - $data[$a]['jumlah_angsuran_detail'];
	                $total_sisa += $saldo;
	                
                    $today = date('Y-m-d', strtotime($tanggal_laporan));
                    $today = new DateTime($today);
                    
                    $tgl_akhir_bayar = date('Y-m-d', strtotime($data[$a]['waktu_terakhir_angsuran']));
                    $tgl_terakhir_bayar = date('d-m-Y', strtotime($data[$a]['waktu_terakhir_angsuran']));
                    $tgl_akhir_bayar = new DateTime($tgl_akhir_bayar);

                    $jatuh_tempo = date('Y-m-d', strtotime($data[$a]['waktu_terakhir_angsuran'].' + 30 days'));
                    $tgl_jatuh_tempo = date('d-m-Y', strtotime($data[$a]['waktu_terakhir_angsuran'].' + 30 days'));
                    $jatuh_tempo = new DateTime($jatuh_tempo);

                    if($today < $tgl_akhir_bayar) {
                    	$lama_pinjam = 0;
                    	$lama_pinjam_long = '0 Tahun 0 Bulan 0 Hari';
                    	$lama_jatuh_tempo = 0;
                    	$lama_jatuh_tempo_long = '0 Tahun 0 Bulan 0 Hari';
                    } else {
                    	$lama_pinjam = $today->diff($tgl_akhir_bayar)->format("%a");
                    	$lama_pinjam_long = $today->diff($tgl_akhir_bayar);
                    	$lama_pinjam_long = " (".$lama_pinjam_long->y." Tahun ".$lama_pinjam_long->m." Bulan ".$lama_pinjam_long->d." Hari)";
                    	if($lama_pinjam <= 30) {
                    		$lama_jatuh_tempo = 0;
                    		$lama_jatuh_tempo_long = '0 Tahun 0 Bulan 0 Hari';
                    	} else {
                    		$lama_jatuh_tempo = $today->diff($jatuh_tempo)->format("%a");
                    		$lama_jatuh_tempo_long = $today->diff($jatuh_tempo);
                    		$lama_jatuh_tempo_long = " (".$lama_jatuh_tempo_long->y." Tahun ".$lama_jatuh_tempo_long->m." Bulan ".$lama_jatuh_tempo_long->d." Hari)";
                    	}
                    }
	                if($lama_pinjam > 30) {
	?>
					<tr>
						<td style="text-align: center;"><?php echo $no ?></td>
			  			<td><?php echo $data[$a]['nama']; ?></td>
			  			<td style="text-align: center;"><?php echo $data[$a]['nomor_koperasi']; ?></td>
			  			<td><?php echo $data[$a]['alamat']; ?></td>
			  			<td><?php echo $data[$a]['kelurahan']; ?></td>
			  			<td><?php echo $data[$a]['dusun']; ?></td>
			  			<td><?php echo $data[$a]['rt']; ?></td>
			  			<td><?php echo $data[$a]['rw']; ?></td>
			  			<td><?php echo $data[$a]['jenis_pinjaman']; ?></td>
			  			<td><?php echo $data[$a]['jaminan']; ?></td>
				  		<?php 
						  	$tgl 		= strtotime($data[$a]['tanggal_pinjaman']);
							$tanggal 	= date("d-m-Y",$tgl);
						?>
					  	<td style="text-align: center;"><?php echo $tanggal ?></td>
					  	<td style="text-align: center;"><?php echo $tgl_terakhir_bayar ?></td>
					  	<td style="text-align: center;"><?php echo $tgl_jatuh_tempo ?></td>
					  	<td style="text-align: center;"><?php echo $sisa_kali_angsuran ?></td>
			  			<td style="text-align: right;"><?php echo $saldo ?></td>
			  			<td style="text-align: center;"><?php echo $lama_pinjam." hari"." ".$lama_pinjam_long ?></td>
	            		<td style="text-align: center;"><?php echo $lama_jatuh_tempo." hari"." ".$lama_jatuh_tempo_long ?></td>
			  			<?php
	                    		if ($lama_pinjam > 30 && $lama_pinjam <= 150) {
			            ?>
			            			<td style="background-color: yellow; text-align: center;">Kuning</td>
			            <?php
			                    } else if ($lama_pinjam > 150 && $lama_pinjam <= 365) {
			            ?>
			            			<td style="background-color: orange; text-align: center;">Orange</td>
			            <?php
			                    } else if ($lama_pinjam > 365 && $lama_pinjam <= 730) {
			            ?>
			            			<td style="background-color: pink; text-align: center;">Pink</td>
			            <?php
			                    } else if ($lama_pinjam > 730) {
			            ?>
			            			<td style="background-color: red; text-align: center;">Merah</td>
			            <?php
			            		}
			            ?>
			  			<td style='text-align: center'><a class="btn btn-primary" href="<?php echo site_url("surattagihancon/cetak_surat_angsuran/".$tanggal_laporan."/".$data[$a]['id_pinjaman']); ?>"><i class="fa fa-file-text"></i></a></td>
					</tr>
	<?php
					$no++;
	                }
	  			} else if($data[$a]['jenis_pinjaman'] == 'Musiman') {
	  				/*$jatuh_tempo = date('Y-m-d', strtotime('+120 days', strtotime($data[$a]['tanggal_pinjaman'])));
	                $jatuh_tempo = new DateTime($jatuh_tempo);
	                $diff = $today->diff($jatuh_tempo)->format("%a");*/
	                $sisa_kali_angsuran = 1;
	                $total_sisa += $saldo;

                    $today = date('Y-m-d', strtotime($tanggal_laporan));
                    $today = new DateTime($today);

                    $tanggal_pinjaman = date('Y-m-d', strtotime($data[$a]['tanggal_pinjaman']));
                    $tanggal_pinjaman = new DateTime($tanggal_pinjaman);

                    $tgl_akhir_bayar = date('Y-m-d', strtotime($data[$a]['waktu_terakhir_angsuran']));
                    $tgl_terakhir_bayar = date('d-m-Y', strtotime($data[$a]['waktu_terakhir_angsuran']));
                    $tgl_akhir_bayar = new DateTime($tgl_akhir_bayar);

                    $jatuh_tempo = date('Y-m-d', strtotime($data[$a]['tanggal_pinjaman'].' + 120 days'));
                    $tgl_jatuh_tempo = date('d-m-Y', strtotime($data[$a]['tanggal_pinjaman'].' + 120 days'));
                    $jatuh_tempo = new DateTime($jatuh_tempo);

                    if($today < $tanggal_pinjaman) {
                    	$lama_pinjam = 0;
                    	$lama_pinjam_long = '0 Tahun 0 Bulan 0 Hari';
                    	$lama_jatuh_tempo = 0;
                    	$lama_jatuh_tempo_long = '0 Tahun 0 Bulan 0 Hari';
                    } else {
                    	$lama_pinjam = $today->diff($tanggal_pinjaman)->format("%a");
                    	$lama_pinjam_long = $today->diff($tanggal_pinjaman);
                    	$lama_pinjam_long = " (".$lama_pinjam_long->y." Tahun ".$lama_pinjam_long->m." Bulan ".$lama_pinjam_long->d." Hari)";
                    	if($lama_pinjam <= 120) {
                    		$lama_jatuh_tempo = 0;
                    		$lama_jatuh_tempo_long = '0 Tahun 0 Bulan 0 Hari';
                    	} else {
                    		$lama_jatuh_tempo = $today->diff($jatuh_tempo)->format("%a");
                    		$lama_jatuh_tempo_long = $today->diff($jatuh_tempo);
                    		$lama_jatuh_tempo_long = " (".$lama_jatuh_tempo_long->y." Tahun ".$lama_jatuh_tempo_long->m." Bulan ".$lama_jatuh_tempo_long->d." Hari)";
                    	}
                    }

	                if($lama_pinjam >= 120) {
	?>
					<tr>
						<td style="text-align: center;"><?php echo $no ?></td>
			  			<td><?php echo $data[$a]['nama']; ?></td>
			  			<td style="text-align: center;"><?php echo $data[$a]['nomor_koperasi']; ?></td>
			  			<td><?php echo $data[$a]['alamat']; ?></td>
			  			<td><?php echo $data[$a]['kelurahan']; ?></td>
			  			<td><?php echo $data[$a]['dusun']; ?></td>
			  			<td><?php echo $data[$a]['rt']; ?></td>
			  			<td><?php echo $data[$a]['rw']; ?></td>
			  			<td><?php echo $data[$a]['jenis_pinjaman']; ?></td>
			  			<td><?php echo $data[$a]['jaminan']; ?></td>
			  			<?php 
						  	$tgl 		= strtotime($data[$a]['tanggal_pinjaman']);
							$tanggal 	= date("d-m-Y",$tgl);
						?>
					  	<td style="text-align: center;"><?php echo $tanggal ?></td>
					  	<td style="text-align: center;"><?php echo $tgl_terakhir_bayar ?></td>
					  	<td style="text-align: center;"><?php echo $tgl_jatuh_tempo ?></td>
					  	<td style="text-align: center;"><?php echo $sisa_kali_angsuran ?></td>
			  			<td style="text-align: right;"><?php echo $saldo ?></td>
			  			<td style="text-align: center;"><?php echo $lama_pinjam." hari"." ".$lama_pinjam_long ?></td>
	            		<td style="text-align: center;"><?php echo $lama_jatuh_tempo." hari"." ".$lama_jatuh_tempo_long ?></td>
			           	<?php
			           		if ($lama_pinjam > 120 && $lama_pinjam <= 240) {
			            ?>
			            	<td style="background-color: yellow; text-align: center;">Kuning</td>
			            <?php
			                } else if ($lama_pinjam > 240 && $lama_pinjam <= 365) {
			            ?>
			            	<td style="background-color: orange; text-align: center;">Orange</td>
			            <?php
			                } else if ($lama_pinjam > 365 && $lama_pinjam <= 730) {
			            ?>
			            	<td style="background-color: pink; text-align: center;">Pink</td>
			            <?php
			            	} else if ($lama_pinjam > 730) {
			            ?>
			            	<td style="background-color: red; text-align: center;">Merah</td>
			            <?php
			                }
			            ?>
			            <td style='text-align: center'><a class="btn btn-primary" href="<?php echo site_url("surattagihancon/cetak_surat_musiman/".$tanggal_laporan."/".$data[$a]['id_pinjaman']); ?>"><i class="fa fa-file-text"></i></a></td>
					</tr>
	<?php
					$no++;
	                }
	  			}
	  		}
	  	}
	?>
</table>