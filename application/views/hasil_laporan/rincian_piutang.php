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

  	$tgl 		= strtotime($tgl_sampai);
	$tanggal 	= date("d-m-Y",$tgl);
?>

<center>KOPPONTREN MAMBAUL MUBBASYIRIN SHIDDIQIYAH</center>
<br>
<center>LAPORAN RINCIAN PIUTANG <?php echo $tanggal ?></center>
<br>
<center>KANTOR PONPES MAJMA'AL BAHRAIN SHIDDIQIYAH</center>
<br>
<center>NGRASEH DANDER BOJONEGORO TELP (0353) 886039       BH : 8181/BH/II/95</center>
<br>
<br>

<table border="1" style="width:100%; border-collapse: collapse;">
    <tr>
        <th>NO</th>
        <th>ID PINJAMAN</th>
        <th>NAMA NASABAH</th>
        <th>NOMOR NASABAH</th>
        <th>JUMLAH PINJAMAN DETAIL</th>
        <th>JUMLAH ANGSURAN DETAIL</th>
        <th>TOTAL PINJAMAN DETAIL</th>
        <th>TOTAL ANGSURAN DETAIL</th>
        <th>SALDO</th>
    </tr>
    <?php
        $no = 1;
        $total_sisa = 0;
        for($a = 0; $a < sizeof($data); $a++) {
            $saldo = $data[$a]['total_pinjaman'] - $data[$a]['total_angsuran'];
            if($saldo != 0) {
                $total_sisa += $saldo;
    ?>
                <tr>
                    <td style="text-align: center;"><?php echo $no ?></td>
                    <td style="text-align: center;"><?php echo $data[$a]['id_pinjaman_detail'] ?></td>
                    <td style="text-align: center;"><?php echo $data[$a]['nama_nasabah'] ?></td>
                    <td style="text-align: center;"><?php echo $data[$a]['nomor_nasabah'] ?></td>
                    <td style="text-align: center;"><?php echo $data[$a]['jumlah_pinjaman'] ?></td>
                    <td style="text-align: center;"><?php echo $data[$a]['jumlah_angsuran'] ?></td>
                    <td style="text-align: right;"><?php echo $data[$a]['total_pinjaman'] ?></td>
                    <td style="text-align: right;"><?php echo $data[$a]['total_angsuran'] ?></td>
                    <td style="text-align: right;"><?php echo $saldo ?></td>
                </tr>
    <?php
            $no++;
            }
        }
    ?>
    <tr>
        <td colspan="8" style="text-align: center;"><strong>TOTAL PIUTANG</strong></td>
        <td style="text-align: right;"><strong><?php echo $total_sisa ?></strong></td>
        <td></td>
    </tr>
</table>