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

    $tgl              = strtotime($tanggal);
    $tanggal_laporan  = date("d-m-Y",$tgl);

    $tgl_pinjaman = strtotime($data[0]['tanggal_pinjaman']);
    $tanggal_pinjaman = date("d-m-Y", $tgl_pinjaman);

    $terakhir_bayar = strtotime($data[0]['waktu_terakhir_angsuran']);
    $terakhir_bayar = date("d-m-Y", $terakhir_bayar);

?>

<style type="text/css">
    #kop_surat {
        padding-top: -30px;
        text-align: center;
        line-height: 1px;
        margin-left: 40px;
        margin-right: 20px;
    }
    #halaman {
        font-size: 16px;
        margin-left: 50px;
        padding-top: -10px;
    }
    p.dalil {
        text-align: center;
        line-height: 18px;
        font-style: italic;
        font-size: 15px;
    }
    #table_header {
        line-height: 16px;   
    }
    #table_header tr td:nth-child(1) {
        width: 100px;
    }
    #table_header tr td:nth-child(2) {
        width: 10px;
    }
    #table_header tr td:nth-child(3) {
        width: 500px;
    }
    p.header_content {
        margin-top: 20px;
        line-height: 19px;
    }
    p.body_content {
        line-height: 25px;
        text-indent: 3em;
    }
    p.rupiah {
        text-align: right;
    }
    #table_rincian {
        padding-left: -3px;
    }
    #table_rincian tr td:nth-child(1) {
        width: 150px;
    }
    #table_rincian tr td:nth-child(2) {
        width: 10px;
    }
    #table_rincian tr td:nth-child(3) {
        width: 10px;
    }
    #table_rincian tr td:nth-child(4) {
        width: 90px;
        text-align: right;
    }
    #table_rincian tr td:nth-child(5) {
        width: 300px;
        text-align: left;
    }
</style>

<?php



?>