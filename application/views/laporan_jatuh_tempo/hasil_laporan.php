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
        <td colspan="10"><center>LAPORAN JATUH TEMPO <?php echo $tanggal ?></center></td>
    </tr>
    <tr>
        <td class="bold" colspan="10"><center>AHU-0003689.AH.01.39.TAHUN 2022</center></td>
    </tr>
    <tr>
        <td colspan="10"><center>Kantor : Desa Ngumpakdalem Rt 10 Rw 03 Kecamatan Dander Kabupaten Bojonegoro</center></td>
    </tr>
</table>
<br>

<?php
	for($a = 0; $a < sizeof($data); $a++) {
		$saldo = $data[$a]['total_pinjaman_detail'] - $data[$a]['total_angsuran_detail'];
		$tanggal_laporan = date('Y-m-d', strtotime($tanggal_laporan));
        $today = new DateTime($tanggal_laporan);

        $sisa_kali_angsuran = $data[$a]['jumlah_angsuran'] - $data[$a]['jumlah_angsuran_detail'];
	    $tanggal_pinjaman = date('Y-m-d', strtotime($data[$a]['tanggal_pinjaman']));
        $tgl_pinjaman = date('d-m-Y', strtotime($data[$a]['tanggal_pinjaman']));
		$tanggal_pinjaman = new DateTime($tanggal_pinjaman);
	    
	    $tgl_akhir_bayar = date('Y-m-d', strtotime($data[$a]['waktu_terakhir_angsuran']));
	    $tgl_terakhir_bayar = date('d-m-Y', strtotime($data[$a]['waktu_terakhir_angsuran']));
	    $tgl_akhir_bayar = new DateTime($tgl_terakhir_bayar);

		if($data[$a]['jenis_pinjaman'] == 'Angsuran') {
			$jatuh_tempo = date('Y-m-d', strtotime($data[$a]['jatuh_tempo']));
		    $tgl_jatuh_tempo = date('d-m-Y', strtotime($data[$a]['jatuh_tempo']));
		    $jatuh_tempo = new DateTime($jatuh_tempo);

            if($today < $jatuh_tempo) {
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
            	$lama_pinjam_long = $lama_pinjam_raw->y." Tahun ".$lama_pinjam_raw->m." Bulan ".$lama_pinjam_raw->d." Hari";
            	$bulan_pinjam = (($lama_pinjam_raw->format('%y') * 12) + $lama_pinjam_raw->format('%m'));
            	$lama_pinjam_bulan_hari = $bulan_pinjam." Bulan ".$lama_pinjam_raw->d." Hari";
            	if($lama_pinjam <= 30) {
            		$lama_jatuh_tempo = 0;
            		$lama_jatuh_tempo_long = '0 Tahun 0 Bulan 0 Hari';
            		$lama_jatuh_tempo_bulan_hari = '0 Bulan 0 Hari';
            	} else {
            		$lama_jatuh_tempo = $today->diff($jatuh_tempo)->format("%a");
            		$lama_jatuh_tempo_raw = $today->diff($jatuh_tempo);
            		$lama_jatuh_tempo_long = $lama_jatuh_tempo_raw->y." Tahun ".$lama_jatuh_tempo_raw->m." Bulan ".$lama_jatuh_tempo_raw->d." Hari";
            		$bulan_jatuh_tempo = (($lama_jatuh_tempo_raw->format('%y') * 12) + $lama_jatuh_tempo_raw->format('%m'));
            		$lama_jatuh_tempo_bulan_hari = $bulan_jatuh_tempo." Bulan ".$lama_jatuh_tempo_raw->d." Hari";
            	}
            }
            if ($lama_jatuh_tempo == 0) {
                $data[$a]['keterangan'] = '';
                $data[$a]['keterangan_level'] = -1;
            } else if ($lama_jatuh_tempo > 0 && $lama_jatuh_tempo <= 7) {
                $data[$a]['keterangan'] = 'Hijau';
                $data[$a]['keterangan_level'] = 0;
            } else if($lama_jatuh_tempo > 7 && $lama_jatuh_tempo <= 30) {
                $data[$a]['keterangan'] = 'Kuning 1';
                $data[$a]['keterangan_level'] = 1;
            } else if ($lama_jatuh_tempo > 30 && $lama_jatuh_tempo <= 90) {
                $data[$a]['keterangan'] = 'Kuning 2';
                $data[$a]['keterangan_level'] = 2;
            } else if ($lama_jatuh_tempo > 90) {
                $data[$a]['keterangan'] = 'Merah';
                $data[$a]['keterangan_level'] = 3;
            }

            $data[$a]['sisa_kali_angsuran'] 			= $sisa_kali_angsuran;
            $data[$a]['today'] 							= $tanggal_laporan;
            $data[$a]['tgl_pinjaman'] 			        = $tgl_pinjaman;
            $data[$a]['tgl_terakhir_bayar']             = $tgl_terakhir_bayar;
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
            $tgl_jatuh_tempo = date('d-m-Y', strtotime($data[$a]['tanggal_pinjaman'].' + 120 days'));
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
            	$lama_pinjam_long = $lama_pinjam_raw->y." Tahun ".$lama_pinjam_raw->m." Bulan ".$lama_pinjam_raw->d." Hari";
            	$bulan_pinjam = (($lama_pinjam_raw->format('%y') * 12) + $lama_pinjam_raw->format('%m'));
            	$lama_pinjam_bulan_hari = $bulan_pinjam." Bulan ".$lama_pinjam_raw->d." Hari";
            	if($lama_pinjam <= 120) {
            		$lama_jatuh_tempo = 0;
            		$lama_jatuh_tempo_long = '0 Tahun 0 Bulan 0 Hari';
            		$lama_jatuh_tempo_bulan_hari = '0 Bulan 0 Hari';
            	} else {
            		$lama_jatuh_tempo = $today->diff($jatuh_tempo)->format("%a");
            		$lama_jatuh_tempo_raw = $today->diff($jatuh_tempo);
            		$lama_jatuh_tempo_long = $lama_jatuh_tempo_raw->y." Tahun ".$lama_jatuh_tempo_raw->m." Bulan ".$lama_jatuh_tempo_raw->d." Hari";
            		$bulan_jatuh_tempo = (($lama_jatuh_tempo_raw->format('%y') * 12) + $lama_jatuh_tempo_raw->format('%m'));
            		$lama_jatuh_tempo_bulan_hari = $bulan_jatuh_tempo." Bulan ".$lama_jatuh_tempo_raw->d." Hari";
            	}
            }
            $data[$a]['keterangan'] = 'Hijau';
    		$data[$a]['keterangan_level'] = 0;
       		/*if ($lama_pinjam > 120 && $lama_pinjam <= 240) {
                $data[$a]['keterangan'] = 'Kuning 1';
                $data[$a]['keterangan_level'] = 1;
            } else if ($lama_pinjam > 240 && $lama_pinjam <= 365) {
                $data[$a]['keterangan'] = 'Kuning 2';
                $data[$a]['keterangan_level'] = 2;
            } else if ($lama_pinjam > 365 && $lama_pinjam <= 730) {
                $data[$a]['keterangan'] = 'Merah 1';
                $data[$a]['keterangan_level'] = 3;
            } else if ($lama_pinjam > 730) {
                $data[$a]['keterangan'] = 'Merah 2';
                $data[$a]['keterangan_level'] = 4;
            }*/
            if ($lama_pinjam > 127 && $lama_pinjam <= 150) {
                $data[$a]['keterangan'] = 'Kuning 1';
                $data[$a]['keterangan_level'] = 1;
            } else if ($lama_pinjam > 150 && $lama_pinjam <= 240) {
                $data[$a]['keterangan'] = 'Kuning 2';
                $data[$a]['keterangan_level'] = 2;
            } else if ($lama_pinjam > 240) {
                $data[$a]['keterangan'] = 'Merah';
                $data[$a]['keterangan_level'] = 3;
            }

            $data[$a]['sisa_kali_angsuran'] 			= $sisa_kali_angsuran;
            $data[$a]['today'] 							= $tanggal_laporan;
            $data[$a]['tgl_pinjaman']                   = $tgl_pinjaman;
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

        if($data[$a]['keterangan_level'] == 1) {
            if($data[$a]['jenis_pinjaman'] == 'Angsuran') {
                $jasa_pinjaman = ($data[$a]['total_pinjaman_detail'] * $bulan_pinjam * 2) / 100;    
            } else if($data[$a]['jenis_pinjaman'] == 'Musiman') {
                $jasa_pinjaman = ($sisa_pinjaman * $bulan_pinjam * 2) / 100;
            }            
            $biaya_administrasi = 0;
        } else {
            $jasa_pinjaman = ($sisa_pinjaman * $bulan_pinjam * 3) / 100;
            $biaya_administrasi = ($sisa_pinjaman * $bulan_pinjam) / 100;
        }
        $total_tagihan = $sisa_pinjaman + $jasa_pinjaman + $biaya_administrasi;

        $data[$a]['angsuran_perbulan'] 	= (int)$angsuran_perbulan;
        $data[$a]['sisa_pinjaman'] 		= (int)$sisa_pinjaman;
        $data[$a]['kali_administrasi'] 	= $kali_administrasi;
        $data[$a]['jasa_pinjaman'] 		= (int)$jasa_pinjaman;
        $data[$a]['biaya_administrasi'] = (int)$biaya_administrasi;
        $data[$a]['total_tagihan'] 		= (int)$total_tagihan;
	}
    if($data != NULL) {
        foreach ($data as $key => $row) {
            $sort['keterangan_level'][$key]  = $row['keterangan_level'];
            $sort['jenis_pinjaman'][$key]  = $row['jenis_pinjaman'];
        }
        //array_multisort($sort['keterangan_level'], SORT_ASC, $sort['jenis_pinjaman'], SORT_ASC, $data);
        array_multisort($sort['jenis_pinjaman'], SORT_ASC, $sort['keterangan_level'], SORT_ASC, $data);
    }
?>

<!--<div style="text-align: left">
    <form action="<?php echo base_url();?>index.php/surattagihancon/cetak_multi_page" method="post" enctype="multipart/form-data" role="form" target="_blank">
        <div class="box-body">
            <input type="hidden" class="form-control pull-right" name="tanggal" id="tanggal" value="<?php echo $tanggal_ori?>">
            <input type="hidden" class="form-control pull-right" name="desa" id="desa" value="<?php echo $id_desa?>">
            <button type="submit" class="btn btn-success" name="excel"><i class="fa fa-print"></i> Print All</button>
        </div>
    </form>
</div>-->

<table border="1" style="width:100%; border-collapse: collapse;">
	<tr>
	    <th>NO</th>
	    <th>NAMA</th>
	    <th>NOMOR NASABAH</th>
        <th>CETAK</th>
	    <!--<th>ALAMAT</th>-->
	    <th>DESA</th>
	    <!--<th>DUSUN</th>-->
	    <!--<th>RT</th>-->
	    <!--<th>RW</th>-->
	    <th>JENIS PINJAMAN</th>
	    <th>JAMINAN</th>
	    <th>TGL PINJAM</th>
	    <!--<th>TGL TERAKHIR BAYAR</th>-->
	    <!--<th>TGL JATUH TEMPO</th>-->
	    <!--<th>SLD X</th>-->
	    <th>SISA PINJAMAN</th>
	    <!--<th>JASA PINJAMAN</th>-->
	    <!--<th>LAMA TERAKHIR BAYAR / LAMA PINJAM</th>-->
	    <!--<th>LAMA JATUH TEMPO</th>-->
	    <th>KETERANGAN</th>
	</tr>

	<?php
	  	$no = 1;
	  	$total_sisa = 0;
	  	for($a = 0; $a < sizeof($data); $a++) {
            $tanggungan_jasa = $data[$a]['jasa_pinjaman'] - $data[$a]['total_jasa_detail'];
	  		if(($data[$a]['saldo'] != 0 || $tanggungan_jasa > 0) && $data[$a]['keterangan_level'] >= 0) {
	  			$total_sisa += $data[$a]['saldo'];
	  			if($status != 'all' && $data[$a]['keterangan_level'] == $status && $data[$a]['saldo'] > 0) {
                    if($jenis_pinjaman != 'all' && $data[$a]['jenis_pinjaman'] == $jenis_pinjaman) {
    ?>
                    <tr>
                        <td style="text-align: center;"><?php echo $no ?></td>
                        <td><?php echo $data[$a]['nama']; ?></td>
                        <td style="text-align: center;"><?php echo $data[$a]['nomor_koperasi']; ?></td>
                        <?php
                        if($data[$a]['jenis_pinjaman'] == 'Angsuran') {
                        ?>
                            <td style='text-align: center'><a class="btn btn-primary" href="<?php echo site_url("surattagihancon/cetak_surat_angsuran/".$tanggal_laporan."/".$data[$a]['id_pinjaman']); ?>"><i class="fa fa-file-text"></i></a></td>
                        <?php
                        } else if($data[$a]['jenis_pinjaman'] == 'Musiman') {
                        ?>              
                            <td style='text-align: center'><a class="btn btn-primary" href="<?php echo site_url("surattagihancon/cetak_surat_musiman/".$tanggal_laporan."/".$data[$a]['id_pinjaman']); ?>"><i class="fa fa-file-text"></i></a></td>
                        <?php
                        }
                        ?>
                        <td><?php echo $data[$a]['kelurahan']; ?></td>
                        <td><?php echo $data[$a]['jenis_pinjaman']; ?></td>
                        <?php
                        if(is_array(json_decode($data[$a]['jaminan']))) {
                            $string_jaminan = '';
                            $jaminan = json_decode($data[$a]['jaminan']);
                            for($i = 0; $i < sizeof($jaminan); $i++) {
                                $string_jaminan .= $jaminan[$i]->keterangan;
                                $string_jaminan .= '; ';
                            }
                            $string_jaminan = substr($string_jaminan, 0, -2);
                        ?>
                        <td>(<?php echo $string_jaminan ?>)</td>
                        <?php
                        } else {
                        ?>
                        <td>(<?php echo $data[$a]['jaminan'] ?>)</td>
                        <?php
                        }
                        ?>
                        <td style="text-align: center;"><?php echo $data[$a]['tgl_pinjaman']; ?></td>
                        <td style="text-align: right;"><?php echo $data[$a]['saldo']; ?></td>
                        <?php
                        if ($data[$a]['keterangan_level'] == 1) {
                        ?>
                            <td style="background-color: yellow; text-align: center;"><?php echo $data[$a]['keterangan'] ?></td>
                        <?php
                        } else if ($data[$a]['keterangan_level'] == 2) {
                        ?>
                            <td style="background-color: orange; text-align: center;"><?php echo $data[$a]['keterangan'] ?></td>
                        <?php
                        } else if ($data[$a]['keterangan_level'] == 3) {
                        ?>
                            <td style="background-color: red; text-align: center;"><?php echo $data[$a]['keterangan'] ?></td>
                        <?php
                        } else if ($data[$a]['keterangan_level'] == 0) {
                        ?>
                            <td style="background-color: green; text-align: center;"><?php echo $data[$a]['keterangan'] ?></td>
                        <?php
                        }
                        ?>
                    </tr>
    <?php
                    $no++;
                    } else if($jenis_pinjaman == 'all') {
    ?>
                    <tr>
                        <td style="text-align: center;"><?php echo $no ?></td>
                        <td><?php echo $data[$a]['nama']; ?></td>
                        <td style="text-align: center;"><?php echo $data[$a]['nomor_koperasi']; ?></td>
                        <?php
                        if($data[$a]['jenis_pinjaman'] == 'Angsuran') {
                        ?>
                            <td style='text-align: center'><a class="btn btn-primary" href="<?php echo site_url("surattagihancon/cetak_surat_angsuran/".$tanggal_laporan."/".$data[$a]['id_pinjaman']); ?>"><i class="fa fa-file-text"></i></a></td>
                        <?php
                        } else if($data[$a]['jenis_pinjaman'] == 'Musiman') {
                        ?>              
                            <td style='text-align: center'><a class="btn btn-primary" href="<?php echo site_url("surattagihancon/cetak_surat_musiman/".$tanggal_laporan."/".$data[$a]['id_pinjaman']); ?>"><i class="fa fa-file-text"></i></a></td>
                        <?php
                        }
                        ?>
                        <td><?php echo $data[$a]['kelurahan']; ?></td>
                        <td><?php echo $data[$a]['jenis_pinjaman']; ?></td>
                        <?php
                        if(is_array(json_decode($data[$a]['jaminan']))) {
                            $string_jaminan = '';
                            $jaminan = json_decode($data[$a]['jaminan']);
                            for($i = 0; $i < sizeof($jaminan); $i++) {
                                $string_jaminan .= $jaminan[$i]->keterangan;
                                $string_jaminan .= '; ';
                            }
                            $string_jaminan = substr($string_jaminan, 0, -2);
                        ?>
                        <td>(<?php echo $string_jaminan ?>)</td>
                        <?php
                        } else {
                        ?>
                        <td>(<?php echo $data[$a]['jaminan'] ?>)</td>
                        <?php
                        }
                        ?>
                        <td style="text-align: center;"><?php echo $data[$a]['tgl_pinjaman']; ?></td>
                        <td style="text-align: right;"><?php echo $data[$a]['saldo']; ?></td>
                        <?php
                        if ($data[$a]['keterangan_level'] == 1) {
                        ?>
                            <td style="background-color: yellow; text-align: center;"><?php echo $data[$a]['keterangan'] ?></td>
                        <?php
                        } else if ($data[$a]['keterangan_level'] == 2) {
                        ?>
                            <td style="background-color: orange; text-align: center;"><?php echo $data[$a]['keterangan'] ?></td>
                        <?php
                        } else if ($data[$a]['keterangan_level'] == 3) {
                        ?>
                            <td style="background-color: red; text-align: center;"><?php echo $data[$a]['keterangan'] ?></td>
                        <?php
                        } else if ($data[$a]['keterangan_level'] == 0) {
                        ?>
                            <td style="background-color: green; text-align: center;"><?php echo $data[$a]['keterangan'] ?></td>
                        <?php
                        }
                        ?>
                    </tr>
    <?php
                    $no++;
                    }
				} else if($status == 'all' && $data[$a]['saldo'] > 0) {
                    if($jenis_pinjaman != 'all' && $data[$a]['jenis_pinjaman'] == $jenis_pinjaman) {
    ?>
                    <tr>
                        <td style="text-align: center;"><?php echo $no ?></td>
                        <td><?php echo $data[$a]['nama']; ?></td>
                        <td style="text-align: center;"><?php echo $data[$a]['nomor_koperasi']; ?></td>
                        <?php
                        if($data[$a]['jenis_pinjaman'] == 'Angsuran') {
                        ?>
                            <td style='text-align: center'><a class="btn btn-primary" href="<?php echo site_url("surattagihancon/cetak_surat_angsuran/".$tanggal_laporan."/".$data[$a]['id_pinjaman']); ?>"><i class="fa fa-file-text"></i></a></td>
                        <?php
                        } else if($data[$a]['jenis_pinjaman'] == 'Musiman') {
                        ?>              
                            <td style='text-align: center'><a class="btn btn-primary" href="<?php echo site_url("surattagihancon/cetak_surat_musiman/".$tanggal_laporan."/".$data[$a]['id_pinjaman']); ?>"><i class="fa fa-file-text"></i></a></td>
                        <?php
                        }
                        ?>
                        <td><?php echo $data[$a]['kelurahan']; ?></td>
                        <td><?php echo $data[$a]['jenis_pinjaman']; ?></td>
                        <?php
                        if(is_array(json_decode($data[$a]['jaminan']))) {
                            $string_jaminan = '';
                            $jaminan = json_decode($data[$a]['jaminan']);
                            for($i = 0; $i < sizeof($jaminan); $i++) {
                                $string_jaminan .= $jaminan[$i]->keterangan;
                                $string_jaminan .= '; ';
                            }
                            $string_jaminan = substr($string_jaminan, 0, -2);
                        ?>
                        <td>(<?php echo $string_jaminan ?>)</td>
                        <?php
                        } else {
                        ?>
                        <td>(<?php echo $data[$a]['jaminan'] ?>)</td>
                        <?php
                        }
                        ?>
                        <td style="text-align: center;"><?php echo $data[$a]['tgl_pinjaman']; ?></td>
                        <td style="text-align: right;"><?php echo $data[$a]['saldo']; ?></td>
                        <?php
                        if ($data[$a]['keterangan_level'] == 1) {
                        ?>
                            <td style="background-color: yellow; text-align: center;"><?php echo $data[$a]['keterangan'] ?></td>
                        <?php
                        } else if ($data[$a]['keterangan_level'] == 2) {
                        ?>
                            <td style="background-color: orange; text-align: center;"><?php echo $data[$a]['keterangan'] ?></td>
                        <?php
                        } else if ($data[$a]['keterangan_level'] == 3) {
                        ?>
                            <td style="background-color: red; text-align: center;"><?php echo $data[$a]['keterangan'] ?></td>
                        <?php
                        } else if ($data[$a]['keterangan_level'] == 0) {
                        ?>
                            <td style="background-color: green; text-align: center;"><?php echo $data[$a]['keterangan'] ?></td>
                        <?php
                        }
                        ?>
                    </tr>
    <?php
                    $no++;
                    } else if($jenis_pinjaman == 'all') {
    ?>
                    <tr>
                        <td style="text-align: center;"><?php echo $no ?></td>
                        <td><?php echo $data[$a]['nama']; ?></td>
                        <td style="text-align: center;"><?php echo $data[$a]['nomor_koperasi']; ?></td>
                        <?php
                        if($data[$a]['jenis_pinjaman'] == 'Angsuran') {
                        ?>
                            <td style='text-align: center'><a class="btn btn-primary" href="<?php echo site_url("surattagihancon/cetak_surat_angsuran/".$tanggal_laporan."/".$data[$a]['id_pinjaman']); ?>"><i class="fa fa-file-text"></i></a></td>
                        <?php
                        } else if($data[$a]['jenis_pinjaman'] == 'Musiman') {
                        ?>              
                            <td style='text-align: center'><a class="btn btn-primary" href="<?php echo site_url("surattagihancon/cetak_surat_musiman/".$tanggal_laporan."/".$data[$a]['id_pinjaman']); ?>"><i class="fa fa-file-text"></i></a></td>
                        <?php
                        }
                        ?>
                        <td><?php echo $data[$a]['kelurahan']; ?></td>
                        <td><?php echo $data[$a]['jenis_pinjaman']; ?></td>
                        <?php
                        if(is_array(json_decode($data[$a]['jaminan']))) {
                            $string_jaminan = '';
                            $jaminan = json_decode($data[$a]['jaminan']);
                            for($i = 0; $i < sizeof($jaminan); $i++) {
                                $string_jaminan .= $jaminan[$i]->keterangan;
                                $string_jaminan .= '; ';
                            }
                            $string_jaminan = substr($string_jaminan, 0, -2);
                        ?>
                        <td>(<?php echo $string_jaminan ?>)</td>
                        <?php
                        } else {
                        ?>
                        <td>(<?php echo $data[$a]['jaminan'] ?>)</td>
                        <?php
                        }
                        ?>
                        <td style="text-align: center;"><?php echo $data[$a]['tgl_pinjaman']; ?></td>
                        <td style="text-align: right;"><?php echo $data[$a]['saldo']; ?></td>
                        <?php
                        if ($data[$a]['keterangan_level'] == 1) {
                        ?>
                            <td style="background-color: yellow; text-align: center;"><?php echo $data[$a]['keterangan'] ?></td>
                        <?php
                        } else if ($data[$a]['keterangan_level'] == 2) {
                        ?>
                            <td style="background-color: orange; text-align: center;"><?php echo $data[$a]['keterangan'] ?></td>
                        <?php
                        } else if ($data[$a]['keterangan_level'] == 3) {
                        ?>
                            <td style="background-color: red; text-align: center;"><?php echo $data[$a]['keterangan'] ?></td>
                        <?php
                        } else if ($data[$a]['keterangan_level'] == 0) {
                        ?>
                            <td style="background-color: green; text-align: center;"><?php echo $data[$a]['keterangan'] ?></td>
                        <?php
                        }
                        ?>
                    </tr>
    <?php
                    $no++;
                    }
                }
	  		}
	  	}
	?>
</table>