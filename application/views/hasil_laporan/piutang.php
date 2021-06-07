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

  	$tgl 		= strtotime($tanggal_laporan);
	$tanggal_title 	= date("d-m-Y",$tgl);
?>

<!--
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
	    <th>RT</th>
	    <th>RW</th>
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
	  			<td><?php echo $data[$a]['rt']; ?></td>
	  			<td><?php echo $data[$a]['rw']; ?></td>
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
	                    } else if ($diff > 120 && $diff <= 240) {
	            ?>
	            			<td style="background-color: yellow; text-align: center;">Kuning</td>
	            <?php
	                    } else if ($diff > 240 && $diff <= 365) {
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
-->

<center>KOPPONTREN MAMBAUL MUBBASYIRIN SHIDDIQIYAH</center>
<br>
<center>LAPORAN PIUTANG ANGGOTA <?php echo $tanggal_title ?></center>
<br>
<center>KANTOR PONPES MAJMA'AL BAHRAIN SHIDDIQIYAH</center>
<br>
<center>TIMUR PASAR NGUMPAKDALEM, DANDER BOJONEGORO TELP 081335044439       BH : 8181/BH/II/95</center>
<br>
<br>

<?php
	for($a = 0; $a < sizeof($data); $a++) {
		$saldo = $data[$a]['total_pinjaman_detail'] - $data[$a]['total_angsuran_detail'];
		$tanggal_laporan = date('Y-m-d', strtotime($tanggal_laporan));
        $today = new DateTime($tanggal_laporan);

        $sisa_kali_angsuran = $data[$a]['jumlah_angsuran'] - $data[$a]['jumlah_angsuran_detail'];
	    $tanggal_pinjaman = date('Y-m-d', strtotime($data[$a]['tanggal_pinjaman']));
		$tanggal_pinjaman = new DateTime($tanggal_pinjaman);
	    
	    $tgl_akhir_bayar = date('Y-m-d', strtotime($data[$a]['waktu_terakhir_angsuran']));
	    $tgl_terakhir_bayar = date('Y-m-d', strtotime($data[$a]['waktu_terakhir_angsuran']));
	    $tgl_akhir_bayar = new DateTime($tgl_akhir_bayar);

		if($data[$a]['jenis_pinjaman'] == 'Angsuran') {
			$jatuh_tempo = date('Y-m-d', strtotime($data[$a]['waktu_terakhir_angsuran'].' + 30 days'));
		    $tgl_jatuh_tempo = date('Y-m-d', strtotime($data[$a]['waktu_terakhir_angsuran'].' + 30 days'));
		    $jatuh_tempo = new DateTime($jatuh_tempo);

            if($today < $tgl_akhir_bayar) {
            	$lama_pinjam = 0;
            	$lama_pinjam_long = '0 Tahun 0 Bulan 0 Hari';
            	$bulan_pinjam = 0;
            	$lama_pinjam_bulan_hari = '0 Bulan 0 Hari';
            	
            	$lama_jatuh_tempo = 0;
            	$lama_jatuh_tempo_long = '0 Tahun 0 Bulan 0 Hari';
            	$bulan_jatuh_tempo = 0;
            	$lama_jatuh_tempo_bulan_hari = '0 Bulan 0 Hari';
            } else {
            	$lama_pinjam = $today->diff($tgl_akhir_bayar)->format("%a");
            	$lama_pinjam_raw = $today->diff($tgl_akhir_bayar);
            	$lama_pinjam_long = " (".$lama_pinjam_raw->y." Tahun ".$lama_pinjam_raw->m." Bulan ".$lama_pinjam_raw->d." Hari)";
            	$bulan_pinjam = (($lama_pinjam_raw->format('%y') * 12) + $lama_pinjam_raw->format('%m'));
            	$lama_pinjam_bulan_hari = " (".$bulan_pinjam." Bulan ".$lama_pinjam_raw->d." Hari)";
            	if($lama_pinjam <= 30) {
            		$lama_jatuh_tempo = 0;
            		$lama_jatuh_tempo_long = '0 Tahun 0 Bulan 0 Hari';
            		$lama_jatuh_tempo_bulan_hari = '0 Bulan 0 Hari';
            	} else {
            		$lama_jatuh_tempo = $today->diff($jatuh_tempo)->format("%a");
            		$lama_jatuh_tempo_raw = $today->diff($jatuh_tempo);
            		$lama_jatuh_tempo_long = " (".$lama_jatuh_tempo_raw->y." Tahun ".$lama_jatuh_tempo_raw->m." Bulan ".$lama_jatuh_tempo_raw->d." Hari)";
            		$bulan_jatuh_tempo = (($lama_jatuh_tempo_raw->format('%y') * 12) + $lama_jatuh_tempo_raw->format('%m'));
            		$lama_jatuh_tempo_bulan_hari = " (".$bulan_jatuh_tempo." Bulan ".$lama_jatuh_tempo_raw->d." Hari)";
            	}
            }
            $data[$a]['keterangan'] = 'Hijau';
    		$data[$a]['keterangan_level'] = 0;
    		if ($lama_pinjam > 30 && $lama_pinjam <= 150) {
    			$data[$a]['keterangan'] = 'Kuning';
    			$data[$a]['keterangan_level'] = 1;
            } else if ($lama_pinjam > 150 && $lama_pinjam <= 365) {
    			$data[$a]['keterangan'] = 'Orange';
    			$data[$a]['keterangan_level'] = 2;
            } else if ($lama_pinjam > 365 && $lama_pinjam <= 730) {
    			$data[$a]['keterangan'] = 'Pink';
    			$data[$a]['keterangan_level'] = 3;
            } else if ($lama_pinjam > 730) {
    			$data[$a]['keterangan'] = 'Merah';
    			$data[$a]['keterangan_level'] = 4;
    		}
            $data[$a]['sisa_kali_angsuran'] 			= $sisa_kali_angsuran;
            $data[$a]['today'] 							= $tanggal_laporan;
            $data[$a]['tgl_terakhir_bayar'] 			= $tgl_terakhir_bayar;
            $data[$a]['tgl_jatuh_tempo'] 				= $tgl_jatuh_tempo;
            $data[$a]['saldo'] 							= $saldo;
            $data[$a]['lama_pinjam'] 					= $lama_pinjam;
            $data[$a]['lama_pinjam_long'] 				= $lama_pinjam_long;
            $data[$a]['lama_pinjam_bulan_hari'] 		= $lama_pinjam_bulan_hari;
            $data[$a]['lama_jatuh_tempo'] 				= $lama_jatuh_tempo;
            $data[$a]['lama_jatuh_tempo_long'] 			= $lama_jatuh_tempo_long;
            $data[$a]['lama_jatuh_tempo_bulan_hari'] 	= $lama_jatuh_tempo_bulan_hari;
		} else if($data[$a]['jenis_pinjaman'] == 'Musiman') {
            $jatuh_tempo = date('Y-m-d', strtotime($data[$a]['tanggal_pinjaman'].' + 120 days'));
            $tgl_jatuh_tempo = date('Y-m-d', strtotime($data[$a]['tanggal_pinjaman'].' + 120 days'));
            $jatuh_tempo = new DateTime($jatuh_tempo);

            if($today < $tanggal_pinjaman) {
            	$lama_pinjam = 0;
            	$lama_pinjam_long = '0 Tahun 0 Bulan 0 Hari';
            	$lama_pinjam_bulan_hari = '0 Bulan 0 Hari';
            	$lama_jatuh_tempo = 0;
            	$lama_jatuh_tempo_long = '0 Tahun 0 Bulan 0 Hari';
            	$lama_jatuh_tempo_bulan_hari = '0 Bulan 0 Hari';
            } else {
            	$lama_pinjam = $today->diff($tanggal_pinjaman)->format("%a");
            	$lama_pinjam_raw = $today->diff($tanggal_pinjaman);
            	$lama_pinjam_long = " (".$lama_pinjam_raw->y." Tahun ".$lama_pinjam_raw->m." Bulan ".$lama_pinjam_raw->d." Hari)";
            	$bulan_pinjam = (($lama_pinjam_raw->format('%y') * 12) + $lama_pinjam_raw->format('%m'));
            	$lama_pinjam_bulan_hari = " (".$bulan_pinjam." Bulan ".$lama_pinjam_raw->d." Hari)";
            	if($lama_pinjam <= 120) {
            		$lama_jatuh_tempo = 0;
            		$lama_jatuh_tempo_long = '0 Tahun 0 Bulan 0 Hari';
            		$lama_jatuh_tempo_bulan_hari = '0 Bulan 0 Hari';
            	} else {
            		$lama_jatuh_tempo = $today->diff($jatuh_tempo)->format("%a");
            		$lama_jatuh_tempo_raw = $today->diff($jatuh_tempo);
            		$lama_jatuh_tempo_long = " (".$lama_jatuh_tempo_raw->y." Tahun ".$lama_jatuh_tempo_raw->m." Bulan ".$lama_jatuh_tempo_raw->d." Hari)";
            		$bulan_jatuh_tempo = (($lama_jatuh_tempo_raw->format('%y') * 12) + $lama_jatuh_tempo_raw->format('%m'));
            		$lama_jatuh_tempo_bulan_hari = " (".$bulan_jatuh_tempo." Bulan ".$lama_jatuh_tempo_raw->d." Hari)";
            	}
            }
            $data[$a]['keterangan'] = 'Hijau';
    		$data[$a]['keterangan_level'] = 0;
       		if ($lama_pinjam > 120 && $lama_pinjam <= 240) {
        		$data[$a]['keterangan'] = 'Kuning';
    			$data[$a]['keterangan_level'] = 1;
            } else if ($lama_pinjam > 240 && $lama_pinjam <= 365) {
        		$data[$a]['keterangan'] = 'Orange';
    			$data[$a]['keterangan_level'] = 2;
            } else if ($lama_pinjam > 365 && $lama_pinjam <= 730) {
        		$data[$a]['keterangan'] = 'Pink';
    			$data[$a]['keterangan_level'] = 3;
        	} else if ($lama_pinjam > 730) {
        		$data[$a]['keterangan'] = 'Merah';
    			$data[$a]['keterangan_level'] = 4;
            }
            $data[$a]['sisa_kali_angsuran'] 			= $sisa_kali_angsuran;
            $data[$a]['today'] 							= $tanggal_laporan;
            $data[$a]['tgl_terakhir_bayar'] 			= $tgl_terakhir_bayar;
            $data[$a]['tgl_jatuh_tempo'] 				= $tgl_jatuh_tempo;
            $data[$a]['saldo'] 							= $saldo;
            $data[$a]['lama_pinjam'] 					= $lama_pinjam;
            $data[$a]['lama_pinjam_long'] 				= $lama_pinjam_long;
            $data[$a]['lama_pinjam_bulan_hari'] 		= $lama_pinjam_bulan_hari;
            $data[$a]['lama_jatuh_tempo'] 				= $lama_jatuh_tempo;
            $data[$a]['lama_jatuh_tempo_long'] 			= $lama_jatuh_tempo_long;
            $data[$a]['lama_jatuh_tempo_bulan_hari'] 	= $lama_jatuh_tempo_bulan_hari;
		}
		if($data[$a]['jumlah_angsuran'] != 0) {
            $angsuran_perbulan = $data[$a]['jumlah_pinjaman'] / $data[$a]['jumlah_angsuran'];    
        } else {
            $angsuran_perbulan = 0;
        }
		if($bulan_pinjam > ($data[$a]['jumlah_angsuran'] - $data[$a]['jumlah_angsuran_detail'])) {
            $sisa_pinjaman = $data[$a]['total_pinjaman_detail'] - $data[$a]['total_angsuran_detail'];
        } else {
            $sisa_pinjaman = $angsuran_perbulan * $bulan_pinjam;
        }

		$kali_administrasi = $bulan_pinjam / 4;
        $kali_administrasi = (int)$kali_administrasi;

        if($data[$a]['keterangan'] == "kuning") {
            $jasa_pinjaman = ($sisa_pinjaman * $bulan_pinjam * 2) / 100;
            $biaya_administrasi = 0;
        } else {
            $jasa_pinjaman = ($sisa_pinjaman * $bulan_pinjam * 3) / 100;
            $biaya_administrasi = ($sisa_pinjaman * $bulan_pinjam) / 100;
        }
        $total_tagihan = $sisa_pinjaman + $jasa_pinjaman + $biaya_administrasi;

        $data[$a]['angsuran_perbulan'] 	= $angsuran_perbulan;
        $data[$a]['sisa_pinjaman'] 		= $sisa_pinjaman;
        $data[$a]['kali_administrasi'] 	= $kali_administrasi;
        $data[$a]['jasa_pinjaman'] 		= $jasa_pinjaman;
        $data[$a]['biaya_administrasi'] = $biaya_administrasi;
        $data[$a]['total_tagihan'] 		= $total_tagihan;
	}
	foreach ($data as $key => $row) {
	    $level[$key]  = $row['keterangan_level'];
	}  
	array_multisort($level, SORT_ASC, $data);
?>

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
	    <th>JASA PINJAMAN</th>
	    <th>LAMA TERAKHIR BAYAR / LAMA PINJAM</th>
	    <th>LAMA JATUH TEMPO</th>
	    <th>KETERANGAN</th>
	</tr>

	<?php
	  	$no = 1;
	  	$total_sisa = 0;
	  	for($a = 0; $a < sizeof($data); $a++) {
	  		if($data[$a]['saldo'] != 0) {
	  			$total_sisa += $data[$a]['saldo'];
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
				  	<td style="text-align: center;"><?php echo tanggal_indo($data[$a]['today']); ?></td>
				  	<td style="text-align: center;"><?php echo tanggal_indo($data[$a]['tgl_terakhir_bayar']); ?></td>
				  	<td style="text-align: center;"><?php echo tanggal_indo($data[$a]['tgl_jatuh_tempo']); ?></td>
				  	<td style="text-align: center;"><?php $data[$a]['sisa_kali_angsuran']; ?></td>
		  			<td style="text-align: right;"><?php echo $data[$a]['saldo']; ?></td>
		  			<td style="text-align: right;"><?php echo $data[$a]['jasa_pinjaman']; ?></td>
		  			<td style="text-align: center;"><?php echo $data[$a]['lama_pinjam']." hari"." ".$data[$a]['lama_pinjam_bulan_hari'] ?></td>
		    		<td style="text-align: center;"><?php echo $data[$a]['lama_jatuh_tempo']." hari"." ".$data[$a]['lama_jatuh_tempo_bulan_hari'] ?></td>
		  			<?php
		            		if ($data[$a]['keterangan_level'] == 0) {
		            ?>
		            			<td style="background-color: green; text-align: center;"><?php echo $data[$a]['keterangan'] ?></td>
		  			<?php
		            		} else if ($data[$a]['keterangan_level'] == 0) {
		            ?>
		            			<td style="background-color: yellow; text-align: center;"><?php echo $data[$a]['keterangan'] ?></td>
		            <?php
		                    } else if ($data[$a]['keterangan_level'] == 2) {
		            ?>
		            			<td style="background-color: orange; text-align: center;"><?php echo $data[$a]['keterangan'] ?></td>
		            <?php
		                    } else if ($data[$a]['keterangan_level'] == 3) {
		            ?>
		            			<td style="background-color: pink; text-align: center;"><?php echo $data[$a]['keterangan'] ?></td>
		            <?php
		                    } else if ($data[$a]['keterangan_level'] == 4) {
		            ?>
		            			<td style="background-color: red; text-align: center;"><?php echo $data[$a]['keterangan'] ?></td>
		            <?php
		            		}
					?>
				</tr>
		<?php    
				$no++;
	  		}
	  	}
	?>
	<tr>
		<td colspan="14" style="text-align: center;"><strong>TOTAL PIUTANG</strong></td>
		<td style="text-align: right;"><strong><?php echo $total_sisa ?></strong></td>
		<td></td>
	</tr>
	<tr>
		<td colspan="14" style="text-align: center;"><strong>TOTAL PIUTANG (NERACA)</strong></td>
		<td style="text-align: right;"><strong><?php echo $piutang_neraca ?></strong></td>
		<td></td>
	</tr>
	<?php
		$selisih = $total_sisa - $piutang_neraca;
	?>
	<tr>
		<td colspan="14" style="text-align: center;"><strong>SELISIH</strong></td>
		<td style="text-align: right;"><strong><?php echo $selisih ?></strong></td>
		<td></td>
	</tr>
</table>