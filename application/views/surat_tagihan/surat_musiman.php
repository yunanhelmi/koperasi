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

  	$tgl 		      = strtotime($tanggal);
	$tanggal_laporan  = date("d-m-Y",$tgl);

    $tgl_pinjaman = strtotime($data[0]['tanggal_pinjaman']);
    $tanggal_pinjaman = date("d-m-Y", $tgl_pinjaman);
?>

<style type="text/css">
    #kop_surat {
        padding-top: -30px;
        text-align: center;
        line-height: 1px;
    }
    p.dalil {
        text-align: center;
        line-height: 18px;
        font-style: italic;
    }
    #table_header {
        line-height: 15px;   
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
        line-height: 18px;
    }
    p.body_content {
        line-height: 20px;
        text-indent: 3em;
    }
</style>

<div id="kop_surat">
    <h2>KOPPONTREN MAMBA'UL MUBBASYIRIN SHIDDIQIYAH</h2>
    <h2>BOJONEGORO</h2>
    <h3>Badan Hukum : 8181 / BH / II / 95</h3>
    <h4>Kantor Pelayanan : Timur Pasar Ngumpak dalem, Dander Bojoneogoro</h4>
    <hr size="4px">
</div>
<div></div>
<p class="dalil">
    Hai orang-orang yang beriman, penuhilah akad-akad perjanjian itu (QS. Al Maidah : 1)<br/>
    Barang siapa meminjam dari saudaranya dengan tekad mengembalikan, maka Allah<br/>
    <strong>MEMBANTU MELUNASINYA</strong> dan barang siapa meminjam dengan niat tidak<br/>
    mengembalikannya, maka Allah akan membuatnya <strong>BANGKRUT</strong> (Al Hadits)
</p>

<p class="header_content">
    Nomor<d style="padding-left:3em;" >:       / MM / Srt Tagihan. / II / <?php echo date("Y") ?></d><br/>
    Lampiran<d style="padding-left:2em;" >: -</d><br/>
    Perihal<d style="padding-left:3em;" >: Tagihan Pinjaman</d>
</p>
<p class="header_content">
    Kepada<br/>
    Yth. Bpk / Ibu <strong><?php echo $data[0]['nama'] ?></strong><br/>
    Di <?php echo $data[0]['rt'] == "" ? '' : 'RT '.$data[0]['rt'] ?> <?php echo $data[0]['rw'] == "" ? '' : 'RW '.$data[0]['rw'] ?> <?php echo $data[0]['dusun'] ?> <?php echo $data[0]['kelurahan'] ?>
</p>
<br>
<p>Assalamu'alaikum Wr. Wb.</p>
<p class="body_content">
    Dengan ini kami memberitahukan bahwa pinjaman Bapak / Ibu, yang pernah dilakukan<br/>
    pada koperasi kami tanggal <strong><?php echo $tanggal_pinjaman ?></strong> sampai bulan ini telah melampaui jatuh tempo, dengan<br/>
    rincian sebagai berikut:<br/>
    Pokok Pinjaman<d style="padding-left:3em;" >: Rp. <?php echo number_format($sisa_pinjaman,0,",",".") ?> (<?php echo $data[0]['jaminan'] ?>)</d><br/>
    Jasa Pinjaman<d style="padding-left:4em;" >: Rp. <?php echo number_format($jasa_pinjaman,0,",",".") ?> (<?php echo $lama_hari ?> / <?php echo $tanggal_laporan ?>)</d><br/>
    Administrasi&nbsp;<d style="padding-left:4em;" > : <u>Rp. <?php echo number_format($biaya_administrasi,0,",",".") ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u></d><br/>
    Total<d style="padding-left:7em;" > &nbsp;: <strong>Rp. <?php echo number_format($total,0,",",".") ?></d></strong><br/>
    Untuk itu dimohon dengan hormat kepada Bapak / Ibu untuk segera datang ke kantor palayanan<br/>
    kami Timur Pasar Ngumpak Dalem, pada :<br/>
    HARI : Senin - Jum'at JAM KERJA : Pagi (08.00 - 12.00) dan Sore (15.30 - 17.00)<br/>
    Untuk:<br/>
    <d style="padding-left:1em;" >1. Melunasi Pinjaman, jika tidak bisa</d><br/>
    <d style="padding-left:1em;" >2. Mengangsur pinjaman,</d><br/>
    <d style="padding-left:1em;" >3. Bermusyawarah di kantor untuk kelanjutan meskipun belum mempunyai uang</d><br/>
    <d style="padding-left:3em;" >Atas perhatian Bapak / Ibu sebelumnya kami sampaikan terima kasih.</d>
</p>
<p>Wassalamu'alaikum Wr. Wb.</p>
<br>
<p class="header_content">
    Bojonegoro, <?php echo tanggal_indo($tanggal) ?><br/>
    Ketua<br/><br/><br/><br/><br/>
    <u>Drs. SUPRAPTO</u>
</p>
