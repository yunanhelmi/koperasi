<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class SaldoawaltahunCon extends CI_Controller {
	function __construct() {
		parent::__construct();

		$this->load->model('usermodel');
		$this->load->model('nasabahmodel');
		$this->load->model('mappingkodeakunmodel');
		$this->load->model('kodeakunmodel');
		$this->load->model('transaksiakuntansimodel');

		$this->load->library('session');
		$this->load->library('form_validation');
		$this->load->library('upload');
		$this->load->library('image_lib');
		$this->load->library(array('PHPExcel','PHPExcel/IOFactory'));
	}

	function index() {
		$session_data = $this->session->userdata('logged_in');
		if($session_data == NULL) {
			redirect("usercon/login", "refresh");
		}
		$data['username'] 	= $session_data['username'];
		$data['status'] 	= $session_data['status'];
		$data['nasabah'] 	= $this->nasabahmodel->showData();
		
		$this->load->view('/layouts/menu', $data);
		$this->load->view('/laporan/saldoawaltahun', $data);
		$this->load->view('/layouts/footer', $data);	
	}

	function view($dari, $sampai) {
		$session_data = $this->session->userdata('logged_in');
		if($session_data == NULL) {
			redirect("usercon/login", "refresh");
		}

		$data['username'] 	= $session_data['username'];
		$data['status'] 	= $session_data['status'];
		$data['nasabah'] 	= $this->nasabahmodel->showData();

		$transaksi_aset 		= $this->transaksiakuntansimodel->get_jumlah_by_dari_sampai_first_char($dari, $sampai, '1');
		$transaksi_hutang 		= $this->transaksiakuntansimodel->get_jumlah_by_dari_sampai_first_char($dari, $sampai, '2');
		$transaksi_modal 		= $this->transaksiakuntansimodel->get_jumlah_by_dari_sampai_first_char($dari, $sampai, '3');

		$kode_aset 			= $this->kodeakunmodel->get_kode_akun_by_first_char('1');
		$kode_hutang 		= $this->kodeakunmodel->get_kode_akun_by_first_char('2');
		$kode_modal 		= $this->kodeakunmodel->get_kode_akun_by_first_char('3');

		$total_aset = 0;
		for($i = 0; $i < sizeof($kode_aset); $i++) {
			for($a = 0; $a < sizeof($transaksi_aset); $a++) {
				if($kode_aset[$i]['kode_akun'] == $transaksi_aset[$a]['kode_akun']) {
					$kode_aset[$i]['debet'] 	= $transaksi_aset[$a]['jumlah_debet'];
					$kode_aset[$i]['kredit'] 	= $transaksi_aset[$a]['jumlah_kredit'];
					$kode_aset[$i]['selisih']	= $transaksi_aset[$a]['jumlah_debet'] - $transaksi_aset[$a]['jumlah_kredit'];
					$total_aset 				+= $kode_aset[$i]['selisih'];
				}
			}
		}

		$total_hutang = 0;
		for($i = 0; $i < sizeof($kode_hutang); $i++) {
			for($a = 0; $a < sizeof($transaksi_hutang); $a++) {
				if($kode_hutang[$i]['kode_akun'] == $transaksi_hutang[$a]['kode_akun']) {
					$kode_hutang[$i]['debet'] 	= $transaksi_hutang[$a]['jumlah_debet'];
					$kode_hutang[$i]['kredit'] 	= $transaksi_hutang[$a]['jumlah_kredit'];
					$kode_hutang[$i]['selisih']	= $transaksi_hutang[$a]['jumlah_debet'] - $transaksi_hutang[$a]['jumlah_kredit'];
					$total_hutang 				+= $kode_hutang[$i]['selisih'];
				}
			}
		}

		$total_modal = 0;
		for($i = 0; $i < sizeof($kode_modal); $i++) {
			for($a = 0; $a < sizeof($transaksi_modal); $a++) {
				if($kode_modal[$i]['kode_akun'] == $transaksi_modal[$a]['kode_akun']) {
					$kode_modal[$i]['debet'] 	= $transaksi_modal[$a]['jumlah_debet'];
					$kode_modal[$i]['kredit'] 	= $transaksi_modal[$a]['jumlah_kredit'];
					$kode_modal[$i]['selisih']	= $transaksi_modal[$a]['jumlah_debet'] - $transaksi_modal[$a]['jumlah_kredit'];
					$total_modal 				+= $kode_modal[$i]['selisih'];
				}
			}
		}

		$data['kode_aset']			= $kode_aset;
		$data['total_aset']			= $total_aset;
		$data['kode_hutang']		= $kode_hutang;
		$data['total_hutang']		= $total_hutang;
		$data['kode_modal']			= $kode_modal;
		$data['total_modal']		= $total_modal;
		$data['tgl_dari']			= $dari;
		$data['tgl_sampai']			= $sampai;

		/*echo "<pre>";
		var_dump($data['kode_aset']);
		echo "</pre>";*/

		$this->load->view('/layouts/menu', $data);
		$this->load->view('/laporan/saldoawaltahun', $data);
		$this->load->view('/layouts/footer', $data);
	}

	function post_saldo($dari, $sampai, $tgl_saldo) {
		$session_data = $this->session->userdata('logged_in');
		if($session_data == NULL) {
			redirect("usercon/login", "refresh");
		}

		$data['username'] 	= $session_data['username'];
		$data['status'] 	= $session_data['status'];
		$data['nasabah'] 	= $this->nasabahmodel->showData();

		$transaksi_aset 		= $this->transaksiakuntansimodel->get_jumlah_by_dari_sampai_first_char($dari, $sampai, '1');
		$transaksi_hutang 		= $this->transaksiakuntansimodel->get_jumlah_by_dari_sampai_first_char($dari, $sampai, '2');
		$transaksi_modal 		= $this->transaksiakuntansimodel->get_jumlah_by_dari_sampai_first_char($dari, $sampai, '3');

		$kode_aset 			= $this->kodeakunmodel->get_kode_akun_by_first_char('1');
		$kode_hutang 		= $this->kodeakunmodel->get_kode_akun_by_first_char('2');
		$kode_modal 		= $this->kodeakunmodel->get_kode_akun_by_first_char('3');

		$thn_saldo = explode("-", $tgl_saldo);
		$tahun_saldo = $thn_saldo[0]; 

		$total_aset = 0;
		for($i = 0; $i < sizeof($kode_aset); $i++) {
			for($a = 0; $a < sizeof($transaksi_aset); $a++) {
				if($kode_aset[$i]['kode_akun'] == $transaksi_aset[$a]['kode_akun']) {
					$kode_aset[$i]['debet'] 	= $transaksi_aset[$a]['jumlah_debet'];
					$kode_aset[$i]['kredit'] 	= $transaksi_aset[$a]['jumlah_kredit'];
					$kode_aset[$i]['selisih']	= $transaksi_aset[$a]['jumlah_debet'] - $transaksi_aset[$a]['jumlah_kredit'];
					$total_aset 				+= $kode_aset[$i]['selisih'];
				}
			}
			$post = array();
			$post['id']			= $this->transaksiakuntansimodel->getNewId();
			$post['tanggal'] 	= $tgl_saldo;
			$post['kode_akun'] 	= $kode_aset[$i]['kode_akun'];
			$post['nama_akun'] 	= $kode_aset[$i]['nama_akun'];
			$post['keterangan'] = "Saldo Awal Tahun ".$tahun_saldo." Akun ".$kode_aset[$i]['kode_akun']." - ".$kode_aset[$i]['nama_akun'];
			$post['jumlah'] 	= $kode_aset[$i]['selisih'];
			$post['debet'] 		= $kode_aset[$i]['selisih'];
			$post['kredit'] 	= 0;
			$this->transaksiakuntansimodel->inputData($post);
		}

		$total_hutang = 0;
		for($i = 0; $i < sizeof($kode_hutang); $i++) {
			for($a = 0; $a < sizeof($transaksi_hutang); $a++) {
				if($kode_hutang[$i]['kode_akun'] == $transaksi_hutang[$a]['kode_akun']) {
					$kode_hutang[$i]['debet'] 	= $transaksi_hutang[$a]['jumlah_debet'];
					$kode_hutang[$i]['kredit'] 	= $transaksi_hutang[$a]['jumlah_kredit'];
					$kode_hutang[$i]['selisih']	= $transaksi_hutang[$a]['jumlah_debet'] - $transaksi_hutang[$a]['jumlah_kredit'];
					$total_hutang 				+= $kode_hutang[$i]['selisih'];
				}
			}
			$post = array();
			$post['id']			= $this->transaksiakuntansimodel->getNewId();
			$post['tanggal'] 	= $tgl_saldo;
			$post['kode_akun'] 	= $kode_hutang[$i]['kode_akun'];
			$post['nama_akun'] 	= $kode_hutang[$i]['nama_akun'];
			$post['keterangan'] = "Saldo Awal Tahun ".$tahun_saldo." Akun ".$kode_hutang[$i]['kode_akun']." - ".$kode_hutang[$i]['nama_akun'];
			$post['jumlah'] 	= $kode_hutang[$i]['selisih'];
			$post['debet'] 		= $kode_hutang[$i]['selisih'];
			$post['kredit'] 	= 0;
			$this->transaksiakuntansimodel->inputData($post);
		}

		$total_modal = 0;
		for($i = 0; $i < sizeof($kode_modal); $i++) {
			for($a = 0; $a < sizeof($transaksi_modal); $a++) {
				if($kode_modal[$i]['kode_akun'] == $transaksi_modal[$a]['kode_akun']) {
					$kode_modal[$i]['debet'] 	= $transaksi_modal[$a]['jumlah_debet'];
					$kode_modal[$i]['kredit'] 	= $transaksi_modal[$a]['jumlah_kredit'];
					$kode_modal[$i]['selisih']	= $transaksi_modal[$a]['jumlah_debet'] - $transaksi_modal[$a]['jumlah_kredit'];
					$total_modal 				+= $kode_modal[$i]['selisih'];
				}
			}
			if($kode_modal[$i]['kode_akun'] == '305' || $kode_modal[$i]['kode_akun'] == '306') {
				continue;
			} else {
				$post = array();
				$post['id']			= $this->transaksiakuntansimodel->getNewId();
				$post['tanggal'] 	= $tgl_saldo;
				$post['kode_akun'] 	= $kode_modal[$i]['kode_akun'];
				$post['nama_akun'] 	= $kode_modal[$i]['nama_akun'];
				$post['keterangan'] = "Saldo Awal Tahun ".$tahun_saldo." Akun ".$kode_modal[$i]['kode_akun']." - ".$kode_modal[$i]['nama_akun'];
				$post['jumlah'] 	= $kode_modal[$i]['selisih'];
				$post['debet'] 		= $kode_modal[$i]['selisih'];
				$post['kredit'] 	= 0;
				$this->transaksiakuntansimodel->inputData($post);
			}
		}
		$data['kode_aset']			= $kode_aset;
		$data['total_aset']			= $total_aset;
		$data['kode_hutang']		= $kode_hutang;
		$data['total_hutang']		= $total_hutang;
		$data['kode_modal']			= $kode_modal;
		$data['total_modal']		= $total_modal;
		$data['tgl_dari']			= $dari;
		$data['tgl_sampai']			= $sampai;
		$data['tgl_saldo']			= $tgl_saldo;
		
		$this->load->view('/layouts/menu', $data);
		$this->load->view('/laporan/saldoawaltahun', $data);
		$this->load->view('/layouts/footer', $data);
	}
}

?>
