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

  	$tgl             = strtotime($tgl_dari);
    $tanggal_dari   = date("d-m-Y",$tgl);

    $tgl            = strtotime($tgl_sampai);
    $tanggal_sampai = date("d-m-Y",$tgl);
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
        <td colspan="9"><center>KOPERASI KHOZANAH MAMBAUL MUBASYIRIN</center></td>
    </tr>
    <tr>
        <td colspan="9"><center>LAPORAN RINCIAN JASA SIMPANAN PIHAK KETIGA<?php echo $tanggal_dari ?> s/d <?php echo $tanggal_sampai ?></center></td>
    </tr>
    <tr>
        <td class="bold" colspan="9"><center>AHU-0003689.AH.01.39.TAHUN 2022</center></td>
    </tr>
    <tr>
        <td colspan="9"><center>Kantor : Desa Ngumpakdalem Rt 10 Rw 03 Kecamatan Dander Kabupaten Bojonegoro</center></td>
    </tr>
</table>
<br>

<table border="1" style="width:100%; border-collapse: collapse;">
    <tr>
        <th>NO</th>
        <th>NAMA</th>
        <th>NO NASABAH</th>
        <th>ALAMAT</th>
        <th>DESA</th>
        <th>DUSUN</th>
        <th>RT</th>
        <th>RW</th>
        <th>JUMLAH JASA</th>
    </tr>
    <?php
        $no = 1;
        $total_jasa = 0;
        for($a = 0; $a < sizeof($data); $a++) {
            //$jumlah_jasa = $data[$a]['total_penyesuaian_jasa'] - $data[$a]['total_pencairan_hutang_jasa'];
            //$total_jasa += $jumlah_jasa;
            $total_jasa += $data[$a]['total_penyesuaian_jasa']
    ?>
            <tr>
                <td style="text-align: center;"><?php echo $no ?></td>
                <td style="text-align: center;"><?php echo $data[$a]['nama'] ?></td>
                <td style="text-align: center;"><?php echo $data[$a]['nomor_koperasi'] ?></td>
                <td style="text-align: center;"><?php echo $data[$a]['alamat'] ?></td>
                <td style="text-align: center;"><?php echo $data[$a]['kelurahan'] ?></td>
                <td style="text-align: center;"><?php echo $data[$a]['dusun'] ?></td>
                <td style="text-align: center;"><?php echo $data[$a]['rt'] ?></td>
                <td style="text-align: center;"><?php echo $data[$a]['rw'] ?></td>
                <td style="text-align: right;"><?php echo number_format($data[$a]['total_penyesuaian_jasa'],0,",",".") ?></td>
            </tr>
    <?php
        $no++;
        }
    ?>
    <tr>
        <td colspan="8" style="text-align: center;"><strong>TOTAL JASA</strong></td>
        <td style="text-align: right;"><strong><?php echo number_format($total_jasa,0,",",".") ?></strong></td>
    </tr>
    <tr>
        <td colspan="8" style="text-align: center;"><strong>TOTAL (NERACA)</strong></td>
        <td style="text-align: right;"><strong><?php echo number_format($total_neraca,0,",",".") ?></strong></td>
    </tr>
    <?php
        $selisih = $total_jasa - $total_neraca;
    ?>
    <tr>
        <td colspan="8" style="text-align: center;"><strong>SELISIH</strong></td>
        <td style="text-align: right;"><strong><?php echo number_format($selisih,0,",",".") ?></strong></td>
    </tr>
    <tr>
        <td colspan="8" style="text-align: center;"><strong>PENCAIRAN</strong></td>
        <td style="text-align: right;"><strong><?php echo number_format($transaksi_pendapatan[0]['jumlah_debet'],0,",",".") ?></strong></td>
    </tr>
    <?php
        $selisih_pencairan = $selisih - $transaksi_pendapatan[0]['jumlah_debet'];
    ?>
    <tr>
        <td colspan="8" style="text-align: center;"><strong>SELISIH</strong></td>
        <td style="text-align: right;"><strong><?php echo number_format($selisih_pencairan,0,",",".") ?></strong></td>
    </tr>
</table>