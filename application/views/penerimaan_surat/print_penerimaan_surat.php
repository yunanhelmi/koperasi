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
?>

<style type="text/css">
    #kop_surat {
        padding-top: -30px;
        text-align: center;
        line-height: 1px;
        margin-left: -5px;
        margin-right: -5px;
    }
    p.title {
        text-align: center;
        line-height: 18px;
        font-weight: bold;
        font-size: 18px;
    }
    #halaman {
        font-size: 16px;
        margin-left: 50px;
        padding-top: -10px;
    }
    p.header_content {
        margin-top: 20px;
        line-height: 19px;
    }
    #table_detail {
        border-collapse: collapse;
        width: 100%;
    }
    #table_detail th, td {
        border: 1px solid black;
    }
    p.footer {
        margin-top: 20px;
        padding-left: 550px;
        line-height: 19px;
    }
</style>

<div id="kop_surat">
    <h2>KOPPONTREN MAMBA'UL MUBBASYIRIN SHIDDIQIYAH</h2>
    <h2>BOJONEGORO</h2>
    <h3>Badan Hukum : 8181 / BH / II / 95</h3>
    <h4>Kantor Pelayanan : Timur Pasar Ngumpak dalem, Dander Bojoneogoro</h4>
    <hr size="4px">
</div>
<p class="title">DAFTAR PENERIMAAN SURAT</p>

<p class="header_content">
    Petugas<d style="padding-left:2em;" >: <?php echo $data->nama_petugas_lapangan ?></d><br/>
</p>

<table id="table_detail">
    <thead>
        <tr>
            <th>No.</th>
            <th>Nama</th>
            <th>No. Nasabah</th>
            <th>Desa</th>
            <th>Jaminan</th>
            <th>Tgl Pinjam</th>
            <th>Sisa Pinjaman</th>
            <th>Sisa Jasa</th>
            <th>TTD</th>
        </tr>
    </thead>
    <tbody>
        <?php
            $no = 0;
            for($a = 0; $a < sizeof($detail); $a++) {
                $no++;
        ?>
                <tr>
                    <td><?php echo $no."."; ?></td>
                    <td><?php echo $detail[$a]['nama_nasabah']; ?></td>
                    <td><?php echo $detail[$a]['nomor_nasabah']; ?></td>
                    <td><?php echo $detail[$a]['kelurahan']; ?></td>
                    <td><?php echo $detail[$a]['jaminan']; ?></td>
                    <td><?php echo $detail[$a]['tanggal_pinjaman']; ?></td>
                    <td style="text-align: right"><?php echo "Rp".number_format($detail[$a]['sisa_pokok_pinjaman'],2,",","."); ?></td>
                    <td style="text-align: right"><?php echo "Rp".number_format($detail[$a]['sisa_jasa'],2,",","."); ?></td>
                    <td></td>
                </tr>
        <?php
            }
        ?>
    </tbody>
</table>
<br>
<p class="footer">
    Bojonegoro, <?php echo tanggal_indo($data->tanggal) ?><br/>
    Ketua<br/>
    <?php
    $path = base_url()."assets/image/ttd_drs_suprapto.jpg";
    $type = pathinfo($path, PATHINFO_EXTENSION);
    $data = file_get_contents($path);
    $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
    ?>
    <img src="<?php echo $base64 ?>"><br/>
    <u>Drs. SUPRAPTO</u>
</p>