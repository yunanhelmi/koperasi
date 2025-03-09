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
        <td colspan="12"><center>KOPERASI KHOZANAH MAMBAUL MUBASYIRIN</center></td>
    </tr>
    <tr>
        <td colspan="12"><center>LAPORAN JATUH TEMPO <?php echo $tanggal ?></center></td>
    </tr>
    <tr>
        <td class="bold" colspan="12"><center>AHU-0003689.AH.01.39.TAHUN 2022</center></td>
    </tr>
    <tr>
        <td colspan="12"><center>Kantor : Desa Ngumpakdalem Rt 10 Rw 03 Kecamatan Dander Kabupaten Bojonegoro</center></td>
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

        if($data[$a]['penagihan'] != NULL) {
            $tanggal_penagihan = new DateTime(date('Y-m-d', strtotime($data[$a]['penagihan'])));
            if($today < $tanggal_penagihan) {
                $durasi_penagihan = ($today->diff($tanggal_penagihan)->format("%a") * -1).' Hari';
            } else {
                $durasi_penagihan = ($today->diff($tanggal_penagihan)->format("%a")).' Hari';
            }
        } else {
            $durasi_penagihan = '';
        }
        $data[$a]['durasi_penagihan'] = $durasi_penagihan;

		if($data[$a]['jenis_pinjaman'] == 'Angsuran') {
			$jatuh_tempo = date('Y-m-d', strtotime($data[$a]['jatuh_tempo']));
		    $tgl_jatuh_tempo = date('d-m-Y', strtotime($data[$a]['jatuh_tempo']));
		    $jatuh_tempo = new DateTime($jatuh_tempo);

            $waktu_terakhir_bayar1 = date('Y-m-d', strtotime($data[0]['jatuh_tempo'].' - 30 days'));
            $waktu_terakhir_bayar = new DateTime($waktu_terakhir_bayar1);

            if($today < $jatuh_tempo) {
                $lama_pinjam = $today->diff($tgl_akhir_bayar)->format("%a") * -1;
                $bulan_pinjam = 0;
                $lama_pinjam_bulan_hari = "- (".floor(($lama_pinjam*-1)/30)." Bulan ".(($lama_pinjam*-1)%30)." Hari)";
                
                $lama_jatuh_tempo = $today->diff($jatuh_tempo)->format("%a") * -1;
                $bulan_jatuh_tempo = 0;
                $lama_jatuh_tempo_bulan_hari = "- (".floor(($lama_jatuh_tempo*-1)/30)." Bulan ".(($lama_jatuh_tempo*-1)%30)." Hari)";

                $lama_akhir_bayar = $today->diff($waktu_terakhir_bayar)->format("%a") * -1;
                $bulan_akhir_bayar = 0;
                $lama_akhir_bayar_bulan_hari = "- (".floor(($lama_akhir_bayar*-1)/30)." Bulan ".(($lama_akhir_bayar*-1)%30)." Hari";
            } else {
                $lama_pinjam = $today->diff($tgl_akhir_bayar)->format("%a");
                $bulan_pinjam = floor($lama_pinjam/30);
                $lama_pinjam_bulan_hari = $bulan_pinjam." Bulan ".($lama_pinjam%30)." Hari";
                
                $lama_jatuh_tempo = $today->diff($jatuh_tempo)->format("%a");
                $bulan_jatuh_tempo = floor($lama_jatuh_tempo/30);
                $lama_jatuh_tempo_bulan_hari = $bulan_jatuh_tempo." Bulan ".($lama_jatuh_tempo%30)." Hari";

                $lama_akhir_bayar = $today->diff($waktu_terakhir_bayar)->format("%a");
                $bulan_akhir_bayar = floor($lama_akhir_bayar/30);
                $lama_akhir_bayar_bulan_hari = $bulan_akhir_bayar." Bulan ".($lama_akhir_bayar%30)." Hari";
            }

            $data[$a]['keterangan'] = 'Hijau';
            $data[$a]['keterangan_level'] = -1;
            /*if ($lama_jatuh_tempo >= 0 && $lama_jatuh_tempo <= 4) {
                $data[$a]['keterangan'] = 'Hijau';
                $data[$a]['keterangan_level'] = -1;
            } else*/ if ($lama_jatuh_tempo > 4 && $lama_jatuh_tempo <= 11) {
                $data[$a]['keterangan'] = 'Hijau Tempo';
                $data[$a]['keterangan_level'] = 0;
            } else if ($lama_jatuh_tempo > 11 && $lama_jatuh_tempo <= 30) {
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
            $data[$a]['lama_pinjam_bulan_hari'] 		= $lama_pinjam_bulan_hari;
            $data[$a]['lama_jatuh_tempo'] 				= $lama_jatuh_tempo;
            $data[$a]['lama_jatuh_tempo_bulan_hari'] 	= $lama_jatuh_tempo_bulan_hari;

            if($data[$a]['jumlah_angsuran'] != 0) {
                $angsuran_perbulan = $data[$a]['jumlah_pinjaman'] / $data[$a]['jumlah_angsuran'];    
            } else {
                $angsuran_perbulan = 0;   
            }
            $jasa_perbulan = $data[$a]['jumlah_pinjaman'] * 0.02;

            if($bulan_akhir_bayar >= 4) {
                $sisa_pinjaman = $data[$a]['total_pinjaman_detail'] - $data[$a]['total_angsuran_detail'];
            } else {
                $sisa_pinjaman = $angsuran_perbulan * $bulan_akhir_bayar;
            }

            $jasa_terbayar = $data[$a]['total_jasa_detail'];
            $kali_administrasi = $bulan_akhir_bayar / 4;
            $kali_administrasi = (int)$kali_administrasi;

            $jasa_pinjaman = 0;
            $biaya_administrasi = 0;
            if($data[$a]['keterangan_level'] <= 2) {
                $jasa_pinjaman = ($data[$a]['total_pinjaman_detail'] * $bulan_akhir_bayar * 2) / 100;
                $biaya_administrasi = 0;
            } else if($data[$a]['keterangan_level'] > 2){
                $jasa_pinjaman = ($sisa_pinjaman * $bulan_akhir_bayar * 3) / 100;
                $biaya_administrasi = ($sisa_pinjaman * $kali_administrasi) / 100;
            }
            $total_tagihan = $sisa_pinjaman + $jasa_pinjaman + $biaya_administrasi;

            $data[$a]['angsuran_perbulan']  = (int)$angsuran_perbulan;
            $data[$a]['sisa_pinjaman']      = (int)$sisa_pinjaman;
            $data[$a]['kali_administrasi']  = $kali_administrasi;
            $data[$a]['jasa_pinjaman']      = (int)$jasa_pinjaman;
            $data[$a]['biaya_administrasi'] = (int)$biaya_administrasi;
            $data[$a]['total_tagihan']      = (int)$total_tagihan;
		} else if($data[$a]['jenis_pinjaman'] == 'Musiman') {
            $jatuh_tempo = date('Y-m-d', strtotime($data[$a]['tanggal_pinjaman'].' + 120 days'));
            $tgl_jatuh_tempo = date('d-m-Y', strtotime($data[$a]['tanggal_pinjaman'].' + 120 days'));
            $jatuh_tempo = new DateTime($jatuh_tempo);

            $lama_pinjam = $today->diff($tanggal_pinjaman)->format("%a");
            $bulan_pinjam = floor($lama_pinjam/30);
            $lama_pinjam_bulan_hari = $bulan_pinjam." Bulan ".($lama_pinjam%30)." Hari";

            if($today < $jatuh_tempo) {
                $lama_jatuh_tempo = $today->diff($jatuh_tempo)->format("%a") * -1;
                $bulan_jatuh_tempo = 0;
                $lama_jatuh_tempo_bulan_hari = "- (".floor(($lama_jatuh_tempo*-1)/30)." Bulan ".(($lama_jatuh_tempo*-1)%30)." Hari)";

                $lama_akhir_bayar = $today->diff($tgl_akhir_bayar)->format("%a");
                $bulan_akhir_bayar = 0;
                $lama_akhir_bayar_bulan_hari = "- (".floor(($lama_akhir_bayar*-1)/30)." Bulan ".(($lama_akhir_bayar*-1)%30)." Hari)";
            } else {
                $lama_jatuh_tempo = $today->diff($jatuh_tempo)->format("%a");
                $bulan_jatuh_tempo = floor($lama_jatuh_tempo/30);
                $lama_jatuh_tempo_bulan_hari = $bulan_jatuh_tempo." Bulan ".($lama_jatuh_tempo%30)." Hari";

                $lama_akhir_bayar = $today->diff($tgl_akhir_bayar)->format("%a");
                $bulan_akhir_bayar = floor($lama_akhir_bayar/30);
                $lama_akhir_bayar_bulan_hari = $bulan_akhir_bayar." Bulan ".($lama_akhir_bayar%30)." Hari";
            }

            $data[$a]['keterangan'] = 'Hijau';
            $data[$a]['keterangan_level'] = -1;
            if ($lama_pinjam >= 125 && $lama_pinjam <= 131) {
                $data[$a]['keterangan'] = 'Hijau Tempo';
                $data[$a]['keterangan_level'] = 0;
            } else if ($lama_pinjam > 131 && $lama_pinjam <= 180) {
                $data[$a]['keterangan'] = 'Kuning 1';
                $data[$a]['keterangan_level'] = 1;
            } else if ($lama_pinjam > 180 && $lama_pinjam <= 240) {
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
            $data[$a]['lama_pinjam_bulan_hari'] 		= $lama_pinjam_bulan_hari;
            $data[$a]['lama_jatuh_tempo'] 				= $lama_jatuh_tempo;
            $data[$a]['lama_jatuh_tempo_bulan_hari'] 	= $lama_jatuh_tempo_bulan_hari;

            $sisa_pinjaman = $data[$a]['total_pinjaman_detail'] - $data[$a]['total_angsuran_detail'];
            if($data[$a]['jumlah_angsuran'] != 0) {
                $angsuran_perbulan = $data[$a]['jumlah_pinjaman'] / $data[$a]['jumlah_angsuran'];    
            } else {
                $angsuran_perbulan = 0;
            }
            $jasa_hari = 0;
            if(($lama_pinjam%30) >= 6 && ($lama_pinjam%30) <= 11) {
                $jasa_hari = ($sisa_pinjaman * 1)/100;
            } else if(($lama_pinjam%30) >= 12 && ($lama_pinjam%30) <= 17) {
                $jasa_hari = ($sisa_pinjaman * 1.5)/100;
            } else if(($lama_pinjam%30) >= 18 && ($lama_pinjam%30) <= 23) {
                $jasa_hari = ($sisa_pinjaman * 2)/100;
            } else if(($lama_pinjam%30) >= 24 && ($lama_pinjam%30) <= 29) {
                $jasa_hari = ($sisa_pinjaman * 3)/100;
            }

            $jasa_terbayar = $data[$a]['total_jasa_detail'];
            $kali_administrasi = $bulan_pinjam / 4;
            $kali_administrasi = (int)$kali_administrasi;
            //$jasa_pinjaman = ($sisa_pinjaman * $bulan_pinjam * 3) / 100;
            $jasa_pinjaman = ($data[$a]['jumlah_pinjaman'] * $bulan_pinjam * 3) / 100;
            $biaya_administrasi = ($sisa_pinjaman * $kali_administrasi) / 100;
            $total_tagihan = $sisa_pinjaman + $jasa_pinjaman + $biaya_administrasi;

            $data[$a]['angsuran_perbulan']  = (int)$angsuran_perbulan;
            $data[$a]['sisa_pinjaman']      = (int)$sisa_pinjaman;
            $data[$a]['kali_administrasi']  = $kali_administrasi;
            $data[$a]['jasa_pinjaman']      = (int)$jasa_pinjaman - (int)$jasa_terbayar + (int)$jasa_hari;
            $data[$a]['biaya_administrasi'] = (int)$biaya_administrasi;
            $data[$a]['total_tagihan']      = (int)$total_tagihan;
		}
        /* END OF ANGSURAN / MUSIMAN */
	}
    if($data != NULL) {
        foreach ($data as $key => $row) {
            $sort['keterangan_level'][$key]  = $row['keterangan_level'];
            $sort['jenis_pinjaman'][$key]  = $row['jenis_pinjaman'];
            $sort['tanggal_pinjaman'][$key]  = $row['tanggal_pinjaman'];
            $sort['lama_jatuh_tempo'][$key]  = $row['lama_jatuh_tempo'];
        }
        //array_multisort($sort['keterangan_level'], SORT_ASC, $sort['jenis_pinjaman'], SORT_ASC, $data);
        array_multisort($sort['jenis_pinjaman'], SORT_ASC, $sort['keterangan_level'], SORT_ASC, $sort['lama_jatuh_tempo'], SORT_ASC, $data);
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
        <!--<th>CETAK</th>-->
	    <!--<th>ALAMAT</th>-->
	    <th>DESA</th>
	    <!--<th>DUSUN</th>-->
	    <!--<th>RT</th>-->
	    <!--<th>RW</th>-->
	    <th>JENIS PINJAMAN</th>
	    <th>JAMINAN</th>
	    <th>TGL PINJAM</th>
	    <!--<th>TGL TERAKHIR BAYAR</th>-->
	    <th>TGL JATUH TEMPO</th>
	    <!--<th>SLD X</th>-->
	    <th>SISA PINJAMAN</th>
	    <!--<th>JASA PINJAMAN</th>-->
	    <!--<th>LAMA TERAKHIR BAYAR / LAMA PINJAM</th>-->
	    <th>LAMA JATUH TEMPO</th>
        <th>DURASI PENAGIHAN</th>
	    <th>KET.</th>
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
                        <!--<?php
                        if($data[$a]['jenis_pinjaman'] == 'Angsuran') {
                        ?>
                            <td style='text-align: center'><a class="btn btn-primary" href="<?php echo site_url("surattagihancon/cetak_surat_angsuran/".$tanggal_laporan."/".$data[$a]['id_pinjaman']); ?>"><i class="fa fa-file-text"></i></a></td>
                        <?php
                        } else if($data[$a]['jenis_pinjaman'] == 'Musiman') {
                        ?>              
                            <td style='text-align: center'><a class="btn btn-primary" href="<?php echo site_url("surattagihancon/cetak_surat_musiman/".$tanggal_laporan."/".$data[$a]['id_pinjaman']); ?>"><i class="fa fa-file-text"></i></a></td>
                        <?php
                        }
                        ?>-->
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
                        <td style="text-align: center;"><?php echo tanggal_indo(date('Y-m-d', strtotime($data[$a]['tgl_pinjaman']))); ?></td>
                        <td style="text-align: center;"><?php echo tanggal_indo(date('Y-m-d', strtotime($data[$a]['tgl_jatuh_tempo']))); ?></td>
                        <td style="text-align: right;"><?php echo number_format($data[$a]['saldo'],0,",","."); ?></td>
                        <td style="text-align: center;"><?php echo $data[$a]['lama_jatuh_tempo']." Hari"; ?></td>
                        <td style="text-align: center;"><?php echo $data[$a]['durasi_penagihan'] ?></td>
                        <?php
                        if ($data[$a]['keterangan_level'] == -1) {
                        ?>
                            <td style="background-color: lightgreen; text-align: center;"><?php echo $data[$a]['keterangan'] ?></td>
                        <?php
                        } else if ($data[$a]['keterangan_level'] == 0) {
                        ?>
                            <td style="background-color: green; text-align: center;"><?php echo $data[$a]['keterangan'] ?></td>
                        <?php
                        } else if ($data[$a]['keterangan_level'] == 1) {
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
                        <!--<?php
                        if($data[$a]['jenis_pinjaman'] == 'Angsuran') {
                        ?>
                            <td style='text-align: center'><a class="btn btn-primary" href="<?php echo site_url("surattagihancon/cetak_surat_angsuran/".$tanggal_laporan."/".$data[$a]['id_pinjaman']); ?>"><i class="fa fa-file-text"></i></a></td>
                        <?php
                        } else if($data[$a]['jenis_pinjaman'] == 'Musiman') {
                        ?>              
                            <td style='text-align: center'><a class="btn btn-primary" href="<?php echo site_url("surattagihancon/cetak_surat_musiman/".$tanggal_laporan."/".$data[$a]['id_pinjaman']); ?>"><i class="fa fa-file-text"></i></a></td>
                        <?php
                        }
                        ?>-->
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
                        <td style="text-align: center;"><?php echo tanggal_indo(date('Y-m-d', strtotime($data[$a]['tgl_pinjaman']))); ?></td>
                        <td style="text-align: center;"><?php echo tanggal_indo(date('Y-m-d', strtotime($data[$a]['tgl_jatuh_tempo']))); ?></td>
                        <td style="text-align: right;"><?php echo number_format($data[$a]['saldo'],0,",","."); ?></td>
                        <td style="text-align: center;"><?php echo $data[$a]['lama_jatuh_tempo']." Hari"; ?></td>
                        <td style="text-align: center;"><?php echo $data[$a]['durasi_penagihan'] ?></td>
                        <?php
                        if ($data[$a]['keterangan_level'] == -1) {
                        ?>
                            <td style="background-color: lightgreen; text-align: center;"><?php echo $data[$a]['keterangan'] ?></td>
                        <?php
                        } else if ($data[$a]['keterangan_level'] == 0) {
                        ?>
                            <td style="background-color: green; text-align: center;"><?php echo $data[$a]['keterangan'] ?></td>
                        <?php
                        } else if ($data[$a]['keterangan_level'] == 1) {
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
                        <!--<?php
                        if($data[$a]['jenis_pinjaman'] == 'Angsuran') {
                        ?>
                            <td style='text-align: center'><a class="btn btn-primary" href="<?php echo site_url("surattagihancon/cetak_surat_angsuran/".$tanggal_laporan."/".$data[$a]['id_pinjaman']); ?>"><i class="fa fa-file-text"></i></a></td>
                        <?php
                        } else if($data[$a]['jenis_pinjaman'] == 'Musiman') {
                        ?>              
                            <td style='text-align: center'><a class="btn btn-primary" href="<?php echo site_url("surattagihancon/cetak_surat_musiman/".$tanggal_laporan."/".$data[$a]['id_pinjaman']); ?>"><i class="fa fa-file-text"></i></a></td>
                        <?php
                        }
                        ?>-->
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
                        <td style="text-align: center;"><?php echo tanggal_indo(date('Y-m-d', strtotime($data[$a]['tgl_pinjaman']))); ?></td>
                        <td style="text-align: center;"><?php echo tanggal_indo(date('Y-m-d', strtotime($data[$a]['tgl_jatuh_tempo']))); ?></td>
                        <td style="text-align: right;"><?php echo number_format($data[$a]['saldo'],0,",","."); ?></td>
                        <td style="text-align: center;"><?php echo $data[$a]['lama_jatuh_tempo']." Hari"; ?></td>
                        <td style="text-align: center;"><?php echo $data[$a]['durasi_penagihan'] ?></td>
                        <?php
                        if ($data[$a]['keterangan_level'] == -1) {
                        ?>
                            <td style="background-color: lightgreen; text-align: center;"><?php echo $data[$a]['keterangan'] ?></td>
                        <?php
                        } else if ($data[$a]['keterangan_level'] == 0) {
                        ?>
                            <td style="background-color: green; text-align: center;"><?php echo $data[$a]['keterangan'] ?></td>
                        <?php
                        } else if ($data[$a]['keterangan_level'] == 1) {
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
                        <!--<?php
                        if($data[$a]['jenis_pinjaman'] == 'Angsuran') {
                        ?>
                            <td style='text-align: center'><a class="btn btn-primary" href="<?php echo site_url("surattagihancon/cetak_surat_angsuran/".$tanggal_laporan."/".$data[$a]['id_pinjaman']); ?>"><i class="fa fa-file-text"></i></a></td>
                        <?php
                        } else if($data[$a]['jenis_pinjaman'] == 'Musiman') {
                        ?>              
                            <td style='text-align: center'><a class="btn btn-primary" href="<?php echo site_url("surattagihancon/cetak_surat_musiman/".$tanggal_laporan."/".$data[$a]['id_pinjaman']); ?>"><i class="fa fa-file-text"></i></a></td>
                        <?php
                        }
                        ?>-->
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
                        <td style="text-align: center;"><?php echo tanggal_indo(date('Y-m-d', strtotime($data[$a]['tgl_pinjaman']))); ?></td>
                        <td style="text-align: center;"><?php echo tanggal_indo(date('Y-m-d', strtotime($data[$a]['tgl_jatuh_tempo']))); ?></td>
                        <td style="text-align: right;"><?php echo number_format($data[$a]['saldo'],0,",","."); ?></td>
                        <td style="text-align: center;"><?php echo $data[$a]['lama_jatuh_tempo']." Hari"; ?></td>
                        <td style="text-align: center;"><?php echo $data[$a]['durasi_penagihan'] ?></td>
                        <?php
                        if ($data[$a]['keterangan_level'] == -1) {
                        ?>
                            <td style="background-color: lightgreen; text-align: center;"><?php echo $data[$a]['keterangan'] ?></td>
                        <?php
                        } else if ($data[$a]['keterangan_level'] == 0) {
                        ?>
                            <td style="background-color: green; text-align: center;"><?php echo $data[$a]['keterangan'] ?></td>
                        <?php
                        } else if ($data[$a]['keterangan_level'] == 1) {
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