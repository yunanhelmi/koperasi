<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class LaporanjatuhtempoCon extends CI_Controller {
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
		$data['desa'] 	    = $this->nasabahmodel->get_data_desa();

        /*echo "<pre>";
        var_dump($data['desa']);
        echo "</pre>";*/
		
		$this->load->view('/layouts/menu', $data);
		$this->load->view('/laporan_jatuh_tempo/index', $data);
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

        //$jenis_pinjaman   = $this->input->post('jenis_pinjaman');
        $desa = $this->input->post('desa');
        $status = $this->input->post('status');
        $jenis_pinjaman = $this->input->post('jenis_pinjaman');

        if($desa == 'all') {
            $data_surat_tagihan = $this->surattagihanmodel->get_data_all($tanggal); 
        } else {
            $data_surat_tagihan = $this->surattagihanmodel->get_data_by_kelurahan($tanggal, $desa); 
        }

        //$data_surat_tagihan = $this->surattagihanmodel->get_data_by_jenis_pinjaman($tanggal, $jenis_pinjaman); 

        /*echo "<pre>";
        var_dump($data_surat_tagihan);
        echo "</pre>";*/

        $data['data'] 		    = $data_surat_tagihan;
        $data['tanggal'] 	    = $tanggal;
        $data['tanggal_ori']    = $tanggal1;
        $data['id_desa']        = $desa;
        $data['status']         = $status;
        $data['jenis_pinjaman'] = $jenis_pinjaman;
        //$data['jenis_pinjaman']    = $jenis_pinjaman;

        /*echo "<pre>";
        var_dump($data_surat_tagihan);
        echo "</pre>";*/

        $this->load->view('/laporan_jatuh_tempo/hasil_laporan', $data);
    }
}
	
?>