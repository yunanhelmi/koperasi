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

<div id="kop_surat">
    <h2>KOPERASI KHOZANAH MAMBAUL MUBASYIRIN</h2>
    <h3>AHU-0003689.AH.01.39.TAHUN 2022</h3>
    <h4>Kantor : Desa Ngumpakdalem Rt 10 Rw 03 Kecamatan Dander Kabupaten Bojonegoro</h4>
    <hr size="4px">
</div>
<div></div>

<p class="dalil">
    Hai orang-orang yang beriman, penuhilah akad-akad perjanjian itu (QS. Al Maidah : 1)<br/>
    Barang siapa meminjam dari saudaranya dengan tekad mengembalikan, maka Allah<br/>
    <strong>MEMBANTU MELUNASINYA</strong> dan barang siapa meminjam dengan niat tidak<br/>
    mengembalikannya, maka Allah akan membuatnya <strong>BANGKRUT</strong> (Al Hadits)
</p>
<div id="halaman">

    <p class="header_content">
        Nomor<d style="padding-left:3em;" >: <?php echo $data[0]['nomor_koperasi'] ?> / MM / <?php echo $level == 1 ? 'Srt Pemberitahuan.' : 'Srt Tagihan.' ?> / A / <?php echo $keterangan ?> / <?php echo date("Y") ?></d><br/>
        Lampiran<d style="padding-left:2em;" >: -</d><br/>
        Perihal<d style="padding-left:3em;" >: <?php echo $level == 1 ? 'Angsuran Pinjaman' : 'Tagihan Pinjaman' ?></d>
    </p>
    <p class="header_content">
        Kepada<br/>
        Yth. Bpk / Ibu <strong><?php echo $data[0]['nama'] ?></strong><br/>
        Di <strong><?php echo $data[0]['rt'] == "" ? '' : 'RT '.$data[0]['rt'] ?> <?php echo $data[0]['rw'] == "" ? '' : 'RW '.$data[0]['rw'] ?> <?php echo $data[0]['dusun'] ?> <?php echo $data[0]['kelurahan'] ?></strong>
    </p>
    <br>
    <p>Assalamu'alaikum Wr. Wb.</p>
    <p class="body_content">
        Dengan ini kami memberitahukan bahwa pinjaman Bapak / Ibu, yang pernah dilakukan<br/>
        pada koperasi kami tanggal <strong><?php echo $tanggal_pinjaman ?></strong> sampai bulan ini telah melampaui jatuh tempo, dengan<br/>
        rincian sebagai berikut:<br/>
    </p>
    <table id="table_rincian">
        <tr>
            <td>Pokok Pinjaman</td>
            <td>:</td>
            <td>Rp. </td>
            <td><?php echo number_format($sisa_pinjaman,0,",",".") ?></td>
            <td>(<?php echo $data[0]['jaminan'] ?>)</td>
        </tr>
        <?php 
            if($level== 1) {
        ?>
        <tr>
            <td>Jasa Pinjaman</td>
            <td>:</td>
            <td style="border-bottom: 1px solid black;">Rp. </td>
            <td style="border-bottom: 1px solid black;"><?php echo number_format($jasa_pinjaman,0,",",".") ?></td>
            <td style="border-bottom: 1px solid black;">(<?php echo $lama_akhir_bayar." - ".$lama_akhir_bayar_bulan_hari  ?> / <?php echo $tanggal_laporan ?>)</td>
        </tr>
        <tr>
            <td>Total</td>
            <td>:</td>
            <td>Rp. </td>
            <td><?php echo number_format($total,0,",",".") ?></td>
            <td></td>
        </tr>
        <?php
            } else {
        ?>
        <tr>
            <td>Jasa Pinjaman</td>
            <td>:</td>
            <td>Rp. </td>
            <td><?php echo number_format($jasa_pinjaman,0,",",".") ?></td>
            <td>(<?php echo $lama_akhir_bayar." - ".$lama_akhir_bayar_bulan_hari  ?> / <?php echo $tanggal_laporan ?>)</td>
        </tr>
        <tr>
            <td>Administrasi (<?php echo $kali_administrasi ?>x)</td>
            <td>:</td>
            <td style="border-bottom: 1px solid black;">Rp. </td>
            <td style="border-bottom: 1px solid black;"><?php echo number_format($biaya_administrasi,0,",",".") ?></td>
            <td style="border-bottom: 1px solid black;"></td>
        </tr>
        <tr>
            <td>Total</td>
            <td>:</td>
            <td>Rp. </td>
            <td><?php echo number_format($total,0,",",".") ?></td>
            <td></td>
        </tr>
        <?php
            }
        ?>
    </table>
    <!--
        Pokok Pinjaman<d style="padding-left:3em;" >: Rp. <?php echo number_format($sisa_pinjaman,0,",",".") ?> (<?php echo $data[0]['jaminan'] ?>)</d><br/>
        <?php 
            if($level == 1) {
        ?>
            Jasa Pinjaman<d style="padding-left:4em;" >: <u>Rp. <?php echo number_format($jasa_pinjaman,0,",",".") ?> (<?php echo $lama_akhir_bayar." - ".$lama_akhir_bayar_long ?> / <?php echo $tanggal_laporan ?>)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u></d><br/>
            Total<d style="padding-left:7em;" > &nbsp;: <strong>Rp. <?php echo number_format($total,0,",",".") ?></d></strong><br/>
        <?php
            } else {
        ?>
            Jasa Pinjaman<d style="padding-left:4em;" >: Rp. <?php echo number_format($jasa_pinjaman,0,",",".") ?> (<?php echo $lama_akhir_bayar." - ".$lama_akhir_bayar_long  ?> / <?php echo $tanggal_laporan ?>)</d><br/>
            Administrasi (<?php echo $kali_administrasi ?>x)&nbsp;<d style="padding-left:2em;" > : <u>Rp. <?php echo number_format($biaya_administrasi,0,",",".") ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u></d><br/>
            Total<d style="padding-left:7em;" > &nbsp;: <strong>Rp. <?php echo number_format($total,0,",",".") ?></d></strong><br/>
        <?php
            }
        ?>
    -->
    <p class="body_content">
        Untuk itu dimohon dengan hormat kepada Bapak / Ibu untuk segera datang ke kantor palayanan<br/>
        kami Timur Pasar Ngumpak Dalem, pada :<br/>
        HARI : Senin - Jum'at JAM KERJA : Pagi (08.00 - 12.00) dan Sore (15.30 - 17.00)<br/>
        Untuk:<br/>
        <?php 
            if($level == 1) {
        ?>
                <d style="padding-left:1em;" >1. Membayar angsuran pinjaman</d><br/>
                <d style="padding-left:1em;" >2. Bermusyawarah di kantor untuk kelanjutan meskipun belum mempunyai uang</d><br/>
                <d style="padding-left:3em;" >Atas perhatian Bapak / Ibu sebelumnya kami sampaikan terima kasih.</d><br/>
        <?php
            } else {
        ?>
                <d style="padding-left:1em;" >1. Melunasi Pinjaman, jika tidak bisa</d><br/>
                <d style="padding-left:1em;" >2. Mengangsur pinjaman,</d><br/>
                <d style="padding-left:1em;" >3. Bermusyawarah di kantor untuk kelanjutan meskipun belum mempunyai uang</d><br/>
                <d style="padding-left:3em;" >Atas perhatian Bapak / Ibu sebelumnya kami sampaikan terima kasih.</d><br/>
        <?php
            }
        ?>
    </p>
    <p>Wassalamu'alaikum Wr. Wb.</p>
    <br>
    <p class="header_content">
        Bojonegoro, <?php echo tanggal_indo($tanggal) ?><br/>
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
    <br>
    <i><strong>NB: Jika terdapat kesalahan perhitungan dari keterangan yang tercantum di atas, bisa diubah sebagaimana mestinya ketika datang ke kantor pelayanan koperasi.</strong></i>
</div>