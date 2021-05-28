<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class SurattagihanCon extends CI_Controller {
	function __construct() {
		parent::__construct();

		$this->load->model('usermodel');
		$this->load->model('nasabahmodel');
		$this->load->model('mappingkodeakunmodel');
		$this->load->model('kodeakunmodel');
		$this->load->model('transaksiakuntansimodel');
		$this->load->model('pinjamanmodel');
		$this->load->model('detailangsuranmodel');
		$this->load->model('laporanrincianpiutangmodel');
		$this->load->model('surattagihanmodel');

		$this->load->library('session');
		$this->load->library('form_validation');
		$this->load->library('upload');
		$this->load->library('image_lib');
		$this->load->library(array('PHPExcel','PHPExcel/IOFactory'));
		$this->load->library('pdfgenerator');
	}

	function isLeapYear($year) {
        return ((($year % 4 === 0) && ($year % 100 !== 0)) || ($year % 400 === 0));
    }

    function getDaysInMonth($year, $month) {
        return [31, ($this->isLeapYear($year) ? 29 : 28), 31, 30, 31, 30, 31, 31, 30, 31, 30, 31][$month - 1];
    }

    function addMonths($d, $value) {
        $date = new DateTime($d);
        $tanggal1 = $date->format('d');

        $date->setDate($date->format('Y'), $date->format('m'), 1);
        $date->setDate($date->format('Y'), $date->format('m') + $value, $date->format('d'));
        
        $tahun = $date->format('Y');
        $bulan = (int)$date->format('m');

        $tanggal2 = $this->getDaysInMonth($tahun, $bulan);

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

        $tanggal2 = $this->getDaysInMonth($tahun, $bulan);

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

	function index() {
		$session_data = $this->session->userdata('mubasyirin_logged_in');
		if($session_data == NULL) {
			redirect("usercon/login", "refresh");
		}
		
		$data['username'] 	= $session_data['username'];
		$data['status'] 	= $session_data['status'];
		$data['nasabah'] 	= $this->nasabahmodel->showData();
		
		$this->load->view('/layouts/menu', $data);
		$this->load->view('/surat_tagihan/index', $data);
		$this->load->view('/layouts/footer', $data);	
	}

	function html() {
        $session_data = $this->session->userdata('mubasyirin_logged_in');
        if($session_data == NULL) {
            redirect("usercon/login", "refresh");
        }

        $tanggal1   = $this->input->post('tanggal');
        $tgl        = strtotime($tanggal1);
        $tanggal    = date("Y-m-d",$tgl);

        $jenis_pinjaman   = $this->input->post('jenis_pinjaman');

        $data_surat_tagihan = $this->surattagihanmodel->get_data($tanggal, $jenis_pinjaman); 

        /*echo "<pre>";
        var_dump($data_surat_tagihan);
        echo "</pre>";*/

        $data['data'] 		= $data_surat_tagihan;
        $data['tanggal'] 	= $tanggal;

        $this->load->view('/surat_tagihan/hasil_surat_tagihan', $data);
    }

    function cetak_surat_angsuran($tanggal, $id_pinjaman) {
		$session_data = $this->session->userdata('mubasyirin_logged_in');
        if($session_data == NULL) {
            redirect("usercon/login", "refresh");
        }

        $tgl        = strtotime($tanggal);
        $tanggal    = date("Y-m-d",$tgl);

        $data = $this->surattagihanmodel->get_data_surat_tagihan($tanggal, $id_pinjaman);
        $angsuran_perbulan = $data[0]['jumlah_pinjaman'] / $data[0]['jumlah_angsuran'];
        $jasa_perbulan = $data[0]['jumlah_pinjaman'] * 0.02;

        $today = date('Y-m-d', strtotime($tanggal));
        $today = new DateTime($today);

        $tanggal_pinjaman = date('Y-m-d', strtotime($data[0]['tanggal_pinjaman']));
        $tanggal_pinjaman = new DateTime($tanggal_pinjaman);

        $tgl_akhir_bayar = date('Y-m-d', strtotime($data[0]['waktu_terakhir_angsuran']));
        $tgl_terakhir_bayar = date('d-m-Y', strtotime($data[0]['waktu_terakhir_angsuran']));
        $tgl_akhir_bayar = new DateTime($tgl_akhir_bayar);

        $jatuh_tempo = date('Y-m-d', strtotime($data[0]['waktu_terakhir_angsuran'].' + 30 days'));
        $tgl_jatuh_tempo = date('d-m-Y', strtotime($data[0]['waktu_terakhir_angsuran'].' + 30 days'));
        $jatuh_tempo = new DateTime($jatuh_tempo);

        $lama_pinjam = $today->diff($tanggal_pinjaman)->format("%a");
        $lama_pinjam_raw = $today->diff($tanggal_pinjaman);
        $lama_pinjam_long = $lama_pinjam_raw->y." Tahun ".$lama_pinjam_raw->m." Bulan ".$lama_pinjam_raw->d." Hari";
        $bulan_pinjam = (($lama_pinjam_raw->format('%y') * 12) + $lama_pinjam_raw->format('%m'));

        $lama_akhir_bayar = $today->diff($tgl_akhir_bayar)->format("%a");
        $lama_akhir_bayar_raw = $today->diff($tgl_akhir_bayar);
        $lama_akhir_bayar_long = $lama_akhir_bayar_raw->y." Tahun ".$lama_akhir_bayar_raw->m." Bulan ".$lama_akhir_bayar_raw->d." Hari";
        $bulan_akhir_bayar = (($lama_akhir_bayar_raw->format('%y') * 12) + $lama_akhir_bayar_raw->format('%m'));
        
        $lama_jatuh_tempo = $today->diff($jatuh_tempo)->format("%a");
        $lama_jatuh_tempo_raw = $today->diff($jatuh_tempo);
        $lama_jatuh_tempo_long = $lama_jatuh_tempo_raw->y." Tahun ".$lama_jatuh_tempo_raw->m." Bulan ".$lama_jatuh_tempo_raw->d." Hari";
        $bulan_jatuh_tempo = (($lama_jatuh_tempo_raw->format('%y') * 12) + $lama_jatuh_tempo_raw->format('%m'));

        if ($lama_pinjam > 30 && $lama_pinjam <= 150) {
            $res['status'] = 'kuning';
        } else if ($lama_pinjam > 150 && $lama_pinjam <= 365) {
            $res['status'] = 'orange';
        } else if ($lama_pinjam > 365 && $lama_pinjam <= 730) {
            $res['status'] = 'pink';
        }  else if ($lama_pinjam > 730) {
            $res['status'] = 'merah';
        }

        if($bulan_akhir_bayar > ($data[0]['jumlah_angsuran'] - $data[0]['jumlah_angsuran_detail'])) {
            $sisa_pinjaman = $data[0]['total_pinjaman_detail'] - $data[0]['total_angsuran_detail'];
        } else {
            $sisa_pinjaman = $angsuran_perbulan * $bulan_akhir_bayar;
        }

        $kali_administrasi = $bulan_akhir_bayar / 4;
        $kali_administrasi = (int)$kali_administrasi;

        if($res['status'] == "kuning") {
            $jasa_pinjaman = ($sisa_pinjaman * $bulan_akhir_bayar * 2) / 100;
            $biaya_administrasi = 0;
        } else {
            $jasa_pinjaman = ($sisa_pinjaman * $bulan_akhir_bayar * 3) / 100;
            $biaya_administrasi = ($sisa_pinjaman * $kali_administrasi) / 100;
        }

        $total = $sisa_pinjaman + $jasa_pinjaman + $biaya_administrasi;

        $res['data']                   = $data;
        $res['sisa_pinjaman']          = $sisa_pinjaman;
        $res['jasa_pinjaman']          = $jasa_pinjaman;
        $res['lama_pinjam']            = $lama_pinjam." Hari";
        $res['lama_pinjam_long']       = $lama_pinjam_long;
        $res['bulan_pinjam']           = $bulan_pinjam;
        $res['lama_akhir_bayar']       = $lama_akhir_bayar." Hari";
        $res['lama_akhir_bayar_long']  = $lama_akhir_bayar_long;
        $res['bulan_akhir_bayar']      = $bulan_akhir_bayar;
        $res['lama_jatuh_tempo']       = $lama_jatuh_tempo." Hari";
        $res['lama_jatuh_tempo_long']  = $lama_jatuh_tempo_long;
        $res['bulan_jatuh_tempo']      = $bulan_jatuh_tempo;
        $res['biaya_administrasi']     = $biaya_administrasi;
        $res['kali_administrasi']      = $kali_administrasi;
        $res['total']                  = $total;
        $res['tanggal']                = $tanggal;

        /*echo "<pre>";
        var_dump($res);
        echo "</pre>";*/

        $pdf = $this->load->view('/surat_tagihan/surat_angsuran', $res, true);

        $filename = "Surat Tagihan_".$data[0]['nomor_koperasi'];

        $this->pdfgenerator->generate($pdf,$filename);
        //$this->load->view('/surat_tagihan/surat_angsuran', $res);
    }

    function cetak_surat_musiman($tanggal, $id_pinjaman) {
    	$session_data = $this->session->userdata('mubasyirin_logged_in');
        if($session_data == NULL) {
            redirect("usercon/login", "refresh");
        }

        $tgl        = strtotime($tanggal);
        $tanggal    = date("Y-m-d",$tgl);

        $data = $this->surattagihanmodel->get_data_surat_tagihan($tanggal, $id_pinjaman);
        $sisa_pinjaman = $data[0]['total_pinjaman_detail'] - $data[0]['total_angsuran_detail'];
        
        $today = date('Y-m-d', strtotime($tanggal));
        $today = new DateTime($today);

        $tanggal_pinjaman = date('Y-m-d', strtotime($data[0]['tanggal_pinjaman']));
        $tanggal_pinjaman = new DateTime($tanggal_pinjaman);

        $tgl_akhir_bayar = date('Y-m-d', strtotime($data[0]['waktu_terakhir_angsuran']));
        $tgl_terakhir_bayar = date('d-m-Y', strtotime($data[0]['waktu_terakhir_angsuran']));
        $tgl_akhir_bayar = new DateTime($tgl_akhir_bayar);

        $jatuh_tempo = date('Y-m-d', strtotime($data[0]['tanggal_pinjaman'].' + 120 days'));
        $tgl_jatuh_tempo = date('d-m-Y', strtotime($data[0]['tanggal_pinjaman'].' + 120 days'));
        $jatuh_tempo = new DateTime($jatuh_tempo);

        $lama_pinjam = $today->diff($tanggal_pinjaman)->format("%a");
        $lama_pinjam_raw = $today->diff($tanggal_pinjaman);
        $lama_pinjam_long = $lama_pinjam_raw->y." Tahun ".$lama_pinjam_raw->m." Bulan ".$lama_pinjam_raw->d." Hari";
        $bulan_pinjam = (($lama_pinjam_raw->format('%y') * 12) + $lama_pinjam_raw->format('%m'));

        $lama_akhir_bayar = $today->diff($tgl_akhir_bayar)->format("%a");
        $lama_akhir_bayar_raw = $today->diff($tgl_akhir_bayar);
        $lama_akhir_bayar_long = $lama_akhir_bayar_raw->y." Tahun ".$lama_akhir_bayar_raw->m." Bulan ".$lama_akhir_bayar_raw->d." Hari";
        $bulan_akhir_bayar = (($lama_akhir_bayar_raw->format('%y') * 12) + $lama_akhir_bayar_raw->format('%m'));
        
        $lama_jatuh_tempo = $today->diff($jatuh_tempo)->format("%a");
        $lama_jatuh_tempo_raw = $today->diff($jatuh_tempo);
        $lama_jatuh_tempo_long = $lama_jatuh_tempo_raw->y." Tahun ".$lama_jatuh_tempo_raw->m." Bulan ".$lama_jatuh_tempo_raw->d." Hari";
        $bulan_jatuh_tempo = (($lama_jatuh_tempo_raw->format('%y') * 12) + $lama_jatuh_tempo_raw->format('%m'));

        
        $kali_administrasi = $bulan_pinjam / 4;
        $kali_administrasi = (int)$kali_administrasi;
        $jasa_pinjaman = ($sisa_pinjaman * $bulan_pinjam * 3) / 100;
        $biaya_administrasi = ($sisa_pinjaman * $kali_administrasi) / 100;
        $total = $sisa_pinjaman + $jasa_pinjaman + $biaya_administrasi;

        if ($lama_pinjam > 120 && $lama_pinjam <= 240) {
            $res['status'] = 'kuning';
        } else if ($lama_pinjam > 240 && $lama_pinjam <= 365) {
            $res['status'] = 'orange';
        } else if ($lama_pinjam > 365 && $lama_pinjam <= 730) {
            $res['status'] = 'pink';
        }  else if ($lama_pinjam > 730) {
            $res['status'] = 'merah';
        }

        $res['data']                   = $data;
        $res['sisa_pinjaman']          = $sisa_pinjaman;
        $res['jasa_pinjaman']          = $jasa_pinjaman;
        $res['lama_pinjam']            = $lama_pinjam." Hari";
        $res['lama_pinjam_long']       = $lama_pinjam_long;
        $res['bulan_pinjam']           = $bulan_pinjam;
        $res['lama_akhir_bayar']       = $lama_akhir_bayar." Hari";
        $res['lama_akhir_bayar_long']  = $lama_akhir_bayar_long;
        $res['bulan_akhir_bayar']      = $bulan_akhir_bayar;
        $res['lama_jatuh_tempo']       = $lama_jatuh_tempo." Hari";
        $res['lama_jatuh_tempo_long']  = $lama_jatuh_tempo_long;
        $res['bulan_jatuh_tempo']      = $bulan_jatuh_tempo;
        $res['biaya_administrasi']     = $biaya_administrasi;
        $res['kali_administrasi']      = $kali_administrasi;
        $res['total']                  = $total;
        $res['tanggal']                = $tanggal;

        /*echo "<pre>";
        var_dump($res);
        echo "</pre>";*/

        $pdf = $this->load->view('/surat_tagihan/surat_musiman', $res, true);

        $filename = "Surat Tagihan_".$data[0]['nomor_koperasi'];

        $this->pdfgenerator->generate($pdf,$filename);
        //$this->load->view('/surat_tagihan/surat_musiman', $res);
    } 
}

?>