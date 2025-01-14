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
        <td colspan="15"><center>KOPERASI KHOZANAH MAMBAUL MUBASYIRIN</center></td>
    </tr>
    <tr>
        <td colspan="15"><center>DAFTAR SURAT TAGIHAN <?php echo $tanggal ?></center></td>
    </tr>
    <tr>
        <td class="bold" colspan="15"><center>AHU-0003689.AH.01.39.TAHUN 2022</center></td>
    </tr>
    <tr>
        <td colspan="15"><center>Kantor : Desa Ngumpakdalem Rt 10 Rw 03 Kecamatan Dander Kabupaten Bojonegoro</center></td>
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
	    <th>JENIS PINJAMAN</th>
	    <th>JAMINAN</th>
	    <th>TGL PINJAM</th>
	    <th>SLD X</th>
	    <th>SISA PINJAMAN</th>
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
	  				$jatuh_tempo = new DateTime(addMonths($data[$a]['tanggal_pinjaman'], $data[$a]['jumlah_angsuran_detail'] + 1));
	                $jatuh_tempo->setDate($jatuh_tempo->format('Y'), $jatuh_tempo->format('m'), 1);
	                $sisa_kali_angsuran = $data[$a]['jumlah_angsuran'] - $data[$a]['jumlah_angsuran_detail'];
	                $total_sisa += $saldo;
	                if($today > $jatuh_tempo) {
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
					  	<td style="text-align: center;"><?php echo $sisa_kali_angsuran ?></td>
			  			<td style="text-align: right;"><?php echo $saldo ?></td>
			  			<td style="background-color: red; text-align: center;">Merah</td>
			  			<td style='text-align: center'><a class="btn btn-primary" href="<?php echo site_url("surattagihancon/cetak_surat_angsuran/".$tanggal."/".$data[$a]['id_pinjaman']); ?>"><i class="fa fa-file-text"></i></a></td>
					</tr>
	<?php
					$no++;
	                }
	  			} else if($data[$a]['jenis_pinjaman'] == 'Musiman') {
	  				$jatuh_tempo = date('Y-m-d', strtotime('+120 days', strtotime($data[$a]['tanggal_pinjaman'])));
	                $jatuh_tempo = new DateTime($jatuh_tempo);
	                $diff = $today->diff($jatuh_tempo)->format("%a");
	                $sisa_kali_angsuran = 1;
	                $total_sisa += $saldo;
	                if($diff >= 6) {
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
			  			<?php
                        if(json_decode($data[$a]['jaminan']) == NULL) {
                            $jaminan = $data[$a]['jaminan'];
                        } else {
                            $jaminan = '';
                            $string = json_decode($data[$a]['jaminan']);
                            for($i = 0; $i < sizeof($string); $i++) {
                                $jaminan .= $string[$i]->keterangan.'; ';
                            }
                            $jaminan = substr($jaminan, 0, -2);
                        }
                    ?>
                    <td><?php echo $jaminan; ?></td>
			  			<?php 
						  	$tgl 		= strtotime($data[$a]['tanggal_pinjaman']);
							$tanggal 	= date("d-m-Y",$tgl);
						?>
					  	<td style="text-align: center;"><?php echo $tanggal ?></td>
					  	<td style="text-align: center;"><?php echo $sisa_kali_angsuran ?></td>
			  			<td style="text-align: right;"><?php echo $saldo ?></td>
			  			<?php
			                if ($diff >= 6 && $diff <= 30) {
			            ?>
			            	<td style="background-color: green; text-align: center;">Hijau</td>
			           	<?php
			           		}
			                else if ($diff >= 31 && $diff <= 60) {
			            ?>
			            	<td style="background-color: yellow; text-align: center;">Kuning</td>
			            <?php
			                } else if ($diff >= 61 && $diff <= 119) {
			            ?>
			            	<td style="background-color: pink; text-align: center;">Merah 1</td>
			            <?php
			                } else if ($diff >= 120 && $diff <= 360) {
			            ?>
			            	<td style="background-color: orange; text-align: center;">Merah 2</td>
			            <?php
			            	} else if ($diff > 360) {
			            ?>
			            	<td style="background-color: red; text-align: center;">Nego</td>
			            <?php
			                }
			            ?>
			            <td style='text-align: center'><a class="btn btn-primary" href="<?php echo site_url("surattagihancon/cetak_surat_musiman/".$tanggal."/".$data[$a]['id_pinjaman']); ?>"><i class="fa fa-file-text"></i></a></td>
					</tr>
	<?php
					$no++;
	                }
	  			}
	  		}
	  	}
	?>
</table>