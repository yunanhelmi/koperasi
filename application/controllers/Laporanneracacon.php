<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class LaporanneracaCon extends CI_Controller {
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
		$session_data = $this->session->userdata('mubasyirin_logged_in');
		if($session_data == NULL) {
			redirect("usercon/login", "refresh");
		}
		$data['username'] 	= $session_data['username'];
		$data['status'] 	= $session_data['status'];
		$data['nasabah'] 	= $this->nasabahmodel->showData();
		
		$this->load->view('/layouts/menu', $data);
		$this->load->view('/laporan/neraca', $data);
		$this->load->view('/layouts/footer', $data);
	}

	function view($dari, $sampai) {
		$session_data = $this->session->userdata('mubasyirin_logged_in');
		if($session_data == NULL) {
			redirect("usercon/login", "refresh");
		}

		$data['username'] 	= $session_data['username'];
		$data['status'] 	= $session_data['status'];
		$data['nasabah'] 	= $this->nasabahmodel->showData();

		$transaksi_aset = $this->transaksiakuntansimodel->get_jumlah_by_dari_sampai_first_char($dari, $sampai, '1');
		$transaksi_hutang = $this->transaksiakuntansimodel->get_jumlah_by_dari_sampai_first_char($dari, $sampai, '2');
		$transaksi_modal = $this->transaksiakuntansimodel->get_jumlah_by_dari_sampai_first_char($dari, $sampai, '3');

		$kode_aset = $this->kodeakunmodel->get_kode_akun_by_first_char('1');
		$kode_hutang = $this->kodeakunmodel->get_kode_akun_by_first_char('2');
		$kode_modal = $this->kodeakunmodel->get_kode_akun_by_first_char('3');

		for($i = 0; $i < sizeof($kode_aset); $i++) {
			for($a = 0; $a < sizeof($transaksi_aset); $a++) {
				if($kode_aset[$i]['kode_akun'] == $transaksi_aset[$a]['kode_akun']) {
					$kode_aset[$i]['debet'] 	= $transaksi_aset[$a]['jumlah_debet'];
					$kode_aset[$i]['kredit'] 	= $transaksi_aset[$a]['jumlah_kredit'];
					if($kode_aset[$i]['kode_akun'] == '105') {
						$kode_aset[$i]['selisih']	= $transaksi_aset[$a]['jumlah_kredit'] - $transaksi_aset[$a]['jumlah_debet'];
					} else {
						$kode_aset[$i]['selisih']	= $transaksi_aset[$a]['jumlah_debet'] - $transaksi_aset[$a]['jumlah_kredit'];	
					}
				}
			}
		}

		for($i = 0; $i < sizeof($kode_hutang); $i++) {
			for($a = 0; $a < sizeof($transaksi_hutang); $a++) {
				if($kode_hutang[$i]['kode_akun'] == $transaksi_hutang[$a]['kode_akun']) {
					$kode_hutang[$i]['debet'] 	= $transaksi_hutang[$a]['jumlah_debet'];
					$kode_hutang[$i]['kredit'] 	= $transaksi_hutang[$a]['jumlah_kredit'];
					$kode_hutang[$i]['selisih']	= $transaksi_hutang[$a]['jumlah_kredit'] - $transaksi_hutang[$a]['jumlah_debet'];
				}
			}
		}

		for($i = 0; $i < sizeof($kode_modal); $i++) {
			for($a = 0; $a < sizeof($transaksi_modal); $a++) {
				if($kode_modal[$i]['kode_akun'] == $transaksi_modal[$a]['kode_akun']) {
					$kode_modal[$i]['debet'] 	= $transaksi_modal[$a]['jumlah_debet'];
					$kode_modal[$i]['kredit'] 	= $transaksi_modal[$a]['jumlah_kredit'];
					$kode_modal[$i]['selisih']	= $transaksi_modal[$a]['jumlah_kredit'] - $transaksi_modal[$a]['jumlah_debet'];
				}
			}
		}

		echo "<pre>";
		var_dump($kode_aset);
		echo "</pre>";

		echo "<pre>";
		var_dump($kode_hutang);
		echo "</pre>";

		echo "<pre>";
		var_dump($kode_modal);
		echo "</pre>";
	}

	function html() {
		$session_data = $this->session->userdata('mubasyirin_logged_in');
		if($session_data == NULL) {
			redirect("usercon/login", "refresh");
		}

		$tgl_dari1 	= $this->input->post('dari');
		$tgl_dari 	= strtotime($tgl_dari1);
		$dari 		= date("Y-m-d",$tgl_dari);

		$tgl_sampai1	= $this->input->post('sampai');
		$tgl_sampai 	= strtotime($tgl_sampai1);
		$sampai 		= date("Y-m-d",$tgl_sampai);

		if($dari < '2019-01-01' && $sampai < '2019-01-01') {
			$transaksi_prev_aset	= $this->transaksiakuntansimodel->get_jumlah_by_sampai_first_char($dari, '1');
			$transaksi_prev_hutang	= $this->transaksiakuntansimodel->get_jumlah_by_sampai_first_char($dari, '2');
			$transaksi_prev_modal	= $this->transaksiakuntansimodel->get_jumlah_by_sampai_first_char($dari, '3');

			$transaksi_aset 		= $this->transaksiakuntansimodel->get_jumlah_by_dari_sampai_first_char($dari, $sampai, '1');
			$transaksi_hutang 		= $this->transaksiakuntansimodel->get_jumlah_by_dari_sampai_first_char($dari, $sampai, '2');
			$transaksi_modal 		= $this->transaksiakuntansimodel->get_jumlah_by_dari_sampai_first_char($dari, $sampai, '3');
		} else if($dari == '2019-01-01' && $sampai >= '2019-01-01') {
			$transaksi_prev_aset	= $this->transaksiakuntansimodel->get_saldo_awal_by_sampai_first_char($sampai, '1');
			$transaksi_prev_hutang	= $this->transaksiakuntansimodel->get_saldo_awal_by_sampai_first_char($sampai, '2');
			$transaksi_prev_modal	= $this->transaksiakuntansimodel->get_saldo_awal_by_sampai_first_char($sampai, '3');

			$transaksi_aset 		= $this->transaksiakuntansimodel->get_jumlah_by_dari_sampai_first_char_except_saldo_awal($dari, $sampai, '1');
			$transaksi_hutang 		= $this->transaksiakuntansimodel->get_jumlah_by_dari_sampai_first_char_except_saldo_awal($dari, $sampai, '2');
			$transaksi_modal 		= $this->transaksiakuntansimodel->get_jumlah_by_dari_sampai_first_char_except_saldo_awal($dari, $sampai, '3');	
		} else if($dari > '2019-01-01' && $sampai >= '2019-01-01') {
			$transaksi_prev_aset	= $this->transaksiakuntansimodel->get_saldo_awal_by_sampai_first_char($sampai, '1');
			$transaksi_prev_hutang	= $this->transaksiakuntansimodel->get_saldo_awal_by_sampai_first_char($sampai, '2');
			$transaksi_prev_modal	= $this->transaksiakuntansimodel->get_saldo_awal_by_sampai_first_char($sampai, '3');

			$transaksi_aset 		= $this->transaksiakuntansimodel->get_jumlah_by_dari_sampai_first_char_except_saldo_awal('2019-01-01', $sampai, '1');
			$transaksi_hutang 		= $this->transaksiakuntansimodel->get_jumlah_by_dari_sampai_first_char_except_saldo_awal('2019-01-01', $sampai, '2');
			$transaksi_modal 		= $this->transaksiakuntansimodel->get_jumlah_by_dari_sampai_first_char_except_saldo_awal('2019-01-01', $sampai, '3');	
		}

		$transaksi_pendapatan 	= $this->transaksiakuntansimodel->get_jumlah_by_dari_sampai_first_char($dari, $sampai, '4');
		$transaksi_beban 		= $this->transaksiakuntansimodel->get_jumlah_by_dari_sampai_first_char($dari, $sampai, '5');

		$kode_aset 			= $this->kodeakunmodel->get_kode_akun_by_first_char('1');
		$kode_hutang 		= $this->kodeakunmodel->get_kode_akun_by_first_char('2');
		$kode_modal 		= $this->kodeakunmodel->get_kode_akun_by_first_char('3');
		$kode_pendapatan 	= $this->kodeakunmodel->get_kode_akun_by_first_char('4');
		$kode_beban 		= $this->kodeakunmodel->get_kode_akun_by_first_char('5');

		// Sebelum Tanggal Dari
		$total_aset = 0;
		for($i = 0; $i < sizeof($kode_aset); $i++) {
			for($a = 0; $a < sizeof($transaksi_prev_aset); $a++) {
				if($kode_aset[$i]['kode_akun'] == $transaksi_prev_aset[$a]['kode_akun']) {
					$kode_aset[$i]['debet'] 	= $transaksi_prev_aset[$a]['jumlah_debet'];
					$kode_aset[$i]['kredit'] 	= $transaksi_prev_aset[$a]['jumlah_kredit'];
					if($kode_aset[$i]['kode_akun'] == '105') {
						$kode_aset[$i]['selisih']	+= $transaksi_prev_aset[$a]['jumlah_kredit'] - $transaksi_prev_aset[$a]['jumlah_debet'];
						$total_aset 				-= $kode_aset[$i]['selisih'];
					} else {
						$kode_aset[$i]['selisih']	+= $transaksi_prev_aset[$a]['jumlah_debet'] - $transaksi_prev_aset[$a]['jumlah_kredit'];
						$total_aset 				+= $kode_aset[$i]['selisih'];
					}
				}
			}
		}

		$total_hutang = 0;
		for($i = 0; $i < sizeof($kode_hutang); $i++) {
			for($a = 0; $a < sizeof($transaksi_prev_hutang); $a++) {
				if($kode_hutang[$i]['kode_akun'] == $transaksi_prev_hutang[$a]['kode_akun']) {
					$kode_hutang[$i]['debet'] 	= $transaksi_prev_hutang[$a]['jumlah_debet'];
					$kode_hutang[$i]['kredit'] 	= $transaksi_prev_hutang[$a]['jumlah_kredit'];
					$kode_hutang[$i]['selisih']	+= $transaksi_prev_hutang[$a]['jumlah_kredit'] - $transaksi_prev_hutang[$a]['jumlah_debet'];
					$total_hutang 				+= $kode_hutang[$i]['selisih'];
				}
			}
		}

		$total_modal = 0;
		for($i = 0; $i < sizeof($kode_modal); $i++) {
			if($kode_modal[$i]['kode_akun'] != '305') {
				for($a = 0; $a < sizeof($transaksi_prev_modal); $a++) {
					if($kode_modal[$i]['kode_akun'] == $transaksi_prev_modal[$a]['kode_akun']) {
						$kode_modal[$i]['debet'] 	= $transaksi_prev_modal[$a]['jumlah_debet'];
						$kode_modal[$i]['kredit'] 	= $transaksi_prev_modal[$a]['jumlah_kredit'];
						$kode_modal[$i]['selisih']	+= $transaksi_prev_modal[$a]['jumlah_kredit'] - $transaksi_prev_modal[$a]['jumlah_debet'];
						$total_modal 				+= $kode_modal[$i]['selisih'];
					}
				}		
			}
		}

		// Antara Dari dan Sampai
		//$total_aset 	= 0;
		for($i = 0; $i < sizeof($kode_aset); $i++) {
			for($a = 0; $a < sizeof($transaksi_aset); $a++) {
				if($kode_aset[$i]['kode_akun'] == $transaksi_aset[$a]['kode_akun']) {
					$kode_aset[$i]['debet'] 	= $transaksi_aset[$a]['jumlah_debet'];
					$kode_aset[$i]['kredit'] 	= $transaksi_aset[$a]['jumlah_kredit'];
					if($kode_aset[$i]['kode_akun'] == '105') {
						$kode_aset[$i]['selisih']	+= $transaksi_aset[$a]['jumlah_kredit'] - $transaksi_aset[$a]['jumlah_debet'];
						//$total_aset 				-= $kode_aset[$i]['selisih'];
						$total_aset 				-= $transaksi_aset[$a]['jumlah_kredit'] - $transaksi_aset[$a]['jumlah_debet'];
					} else {
						$kode_aset[$i]['selisih']	+= $transaksi_aset[$a]['jumlah_debet'] - $transaksi_aset[$a]['jumlah_kredit'];
						//$total_aset 				+= $kode_aset[$i]['selisih'];
						$total_aset 				+= $transaksi_aset[$a]['jumlah_debet'] - $transaksi_aset[$a]['jumlah_kredit'];
					}
				}
			}
		}

		//$total_hutang = 0;
		for($i = 0; $i < sizeof($kode_hutang); $i++) {
			for($a = 0; $a < sizeof($transaksi_hutang); $a++) {
				if($kode_hutang[$i]['kode_akun'] == $transaksi_hutang[$a]['kode_akun']) {
					$kode_hutang[$i]['debet'] 	= $transaksi_hutang[$a]['jumlah_debet'];
					$kode_hutang[$i]['kredit'] 	= $transaksi_hutang[$a]['jumlah_kredit'];
					$kode_hutang[$i]['selisih']	+= $transaksi_hutang[$a]['jumlah_kredit'] - $transaksi_hutang[$a]['jumlah_debet'];
					//$total_hutang 				+= $kode_hutang[$i]['selisih'];
					$total_hutang 				+= $transaksi_hutang[$a]['jumlah_kredit'] - $transaksi_hutang[$a]['jumlah_debet'];
				}
			}
		}

		//$total_modal = 0;
		for($i = 0; $i < sizeof($kode_modal); $i++) {
			for($a = 0; $a < sizeof($transaksi_modal); $a++) {
				if($kode_modal[$i]['kode_akun'] == $transaksi_modal[$a]['kode_akun']) {
					$kode_modal[$i]['debet'] 	= $transaksi_modal[$a]['jumlah_debet'];
					$kode_modal[$i]['kredit'] 	= $transaksi_modal[$a]['jumlah_kredit'];
					$kode_modal[$i]['selisih']	+= $transaksi_modal[$a]['jumlah_kredit'] - $transaksi_modal[$a]['jumlah_debet'];
					//$total_modal 				+= $kode_modal[$i]['selisih'];
					$total_modal 				+= $transaksi_modal[$a]['jumlah_kredit'] - $transaksi_modal[$a]['jumlah_debet'];
				}
			}
		}

		$total_pendapatan = 0;
		for($i = 0; $i < sizeof($kode_pendapatan); $i++) {
			for($a = 0; $a < sizeof($transaksi_pendapatan); $a++) {
				if($kode_pendapatan[$i]['kode_akun'] == $transaksi_pendapatan[$a]['kode_akun']) {
					$kode_pendapatan[$i]['debet'] 	= $transaksi_pendapatan[$a]['jumlah_debet'];
					$kode_pendapatan[$i]['kredit'] 	= $transaksi_pendapatan[$a]['jumlah_kredit'];
					$kode_pendapatan[$i]['selisih']	= $transaksi_pendapatan[$a]['jumlah_kredit'] - $transaksi_pendapatan[$a]['jumlah_debet'];
					$total_pendapatan 				+= $kode_pendapatan[$i]['selisih'];
				}
			}
		}

		$total_beban = 0;
		for($i = 0; $i < sizeof($kode_beban); $i++) {
			for($a = 0; $a < sizeof($transaksi_beban); $a++) {
				if($kode_beban[$i]['kode_akun'] == $transaksi_beban[$a]['kode_akun']) {
					$kode_beban[$i]['debet'] 	= $transaksi_beban[$a]['jumlah_debet'];
					$kode_beban[$i]['kredit'] 	= $transaksi_beban[$a]['jumlah_kredit'];
					$kode_beban[$i]['selisih']	+= $transaksi_beban[$a]['jumlah_debet'] - $transaksi_beban[$a]['jumlah_kredit'];
					$total_beban 				+= $kode_beban[$i]['selisih'];
				}
			}
		}

		/*for($i = 0; $i < sizeof($kode_modal); $i++) {
			if($kode_modal[$i]['kode_akun'] == '305') {
				$kode_modal[$i]['selisih'] = $total_pendapatan - $total_beban;
			}
		}*/

		for($i = 0; $i < sizeof($kode_modal); $i++) {
			if($kode_modal[$i]['kode_akun'] == '305') {
				$kode_modal[$i]['selisih']  = $total_pendapatan - $total_beban;
				$shu_berjalan				= $kode_modal[$i]['selisih'];
				$total_modal 				+= $kode_modal[$i]['selisih'];
			}
		}


		$harta_lancar 	= 0;
		$harta_tetap 	= 0;
		for($i = 0; $i < sizeof($kode_aset); $i++) {
			if($kode_aset[$i]['kode_akun'] == '101' || $kode_aset[$i]['kode_akun'] == '102' || $kode_aset[$i]['kode_akun'] == '103') {
				$harta_lancar 	+= $kode_aset[$i]['selisih'];
			} else if($kode_aset[$i]['kode_akun'] == '104' || $kode_aset[$i]['kode_akun'] == '105') {
				$harta_tetap	+= $kode_aset[$i]['selisih'];
			}
		}


		if($total_modal == 0) {
			$rentabilitas 	= 0;	
		} else {
			$rentabilitas 	= ($shu_berjalan / $total_modal) * 100;	
		}
		
		if($total_hutang == 0) {
			$solvabilitas 	= 0;
		} else {
			$solvabilitas 	= $total_aset / $total_hutang;	
		}

		if($total_hutang == 0) {
			$likuiditas		= 0;
		} else {
			$likuiditas		= $harta_lancar / $total_hutang;	
		}

		$data['dari'] 				= $dari;
        $data['sampai'] 			= $sampai;
        $data['kode_aset'] 			= $kode_aset;
        $data['total_aset'] 		= $total_aset;
        $data['kode_hutang'] 		= $kode_hutang;
        $data['total_hutang'] 		= $total_hutang;
        $data['kode_modal'] 		= $kode_modal;
        $data['total_modal'] 		= $total_modal;
        $data['kode_pendapatan'] 	= $kode_pendapatan;
        $data['total_pendapatan'] 	= $total_pendapatan;
        $data['kode_beban'] 		= $kode_beban;
        $data['total_beban'] 		= $total_beban;
        $data['rentabilitas'] 		= $rentabilitas;
        $data['solvabilitas'] 		= $solvabilitas;
        $data['likuiditas'] 		= $likuiditas;

        $this->load->view('/hasil_laporan/neraca', $data);
	}

	// Yang dipake
	function excel() {
		$session_data = $this->session->userdata('mubasyirin_logged_in');
		if($session_data == NULL) {
			redirect("usercon/login", "refresh");
		}

		$tgl_dari1 	= $this->input->post('dari');
		$tgl_dari 	= strtotime($tgl_dari1);
		$dari 		= date("Y-m-d",$tgl_dari);

		$tgl_sampai1	= $this->input->post('sampai');
		$tgl_sampai 	= strtotime($tgl_sampai1);
		$sampai 		= date("Y-m-d",$tgl_sampai);

		if($dari < '2019-01-01' && $sampai < '2019-01-01') {
			$transaksi_prev_aset	= $this->transaksiakuntansimodel->get_jumlah_by_sampai_first_char($dari, '1');
			$transaksi_prev_hutang	= $this->transaksiakuntansimodel->get_jumlah_by_sampai_first_char($dari, '2');
			$transaksi_prev_modal	= $this->transaksiakuntansimodel->get_jumlah_by_sampai_first_char($dari, '3');

			$transaksi_aset 		= $this->transaksiakuntansimodel->get_jumlah_by_dari_sampai_first_char($dari, $sampai, '1');
			$transaksi_hutang 		= $this->transaksiakuntansimodel->get_jumlah_by_dari_sampai_first_char($dari, $sampai, '2');
			$transaksi_modal 		= $this->transaksiakuntansimodel->get_jumlah_by_dari_sampai_first_char($dari, $sampai, '3');
		} else if($dari == '2019-01-01' && $sampai >= '2019-01-01') {
			$transaksi_prev_aset	= $this->transaksiakuntansimodel->get_saldo_awal_by_sampai_first_char($sampai, '1');
			$transaksi_prev_hutang	= $this->transaksiakuntansimodel->get_saldo_awal_by_sampai_first_char($sampai, '2');
			$transaksi_prev_modal	= $this->transaksiakuntansimodel->get_saldo_awal_by_sampai_first_char($sampai, '3');

			$transaksi_aset 		= $this->transaksiakuntansimodel->get_jumlah_by_dari_sampai_first_char_except_saldo_awal($dari, $sampai, '1');
			$transaksi_hutang 		= $this->transaksiakuntansimodel->get_jumlah_by_dari_sampai_first_char_except_saldo_awal($dari, $sampai, '2');
			$transaksi_modal 		= $this->transaksiakuntansimodel->get_jumlah_by_dari_sampai_first_char_except_saldo_awal($dari, $sampai, '3');	
		} else if($dari > '2019-01-01' && $sampai >= '2019-01-01') {
			$transaksi_prev_aset	= $this->transaksiakuntansimodel->get_saldo_awal_by_sampai_first_char($sampai, '1');
			$transaksi_prev_hutang	= $this->transaksiakuntansimodel->get_saldo_awal_by_sampai_first_char($sampai, '2');
			$transaksi_prev_modal	= $this->transaksiakuntansimodel->get_saldo_awal_by_sampai_first_char($sampai, '3');

			$transaksi_aset 		= $this->transaksiakuntansimodel->get_jumlah_by_dari_sampai_first_char_except_saldo_awal('2019-01-01', $sampai, '1');
			$transaksi_hutang 		= $this->transaksiakuntansimodel->get_jumlah_by_dari_sampai_first_char_except_saldo_awal('2019-01-01', $sampai, '2');
			$transaksi_modal 		= $this->transaksiakuntansimodel->get_jumlah_by_dari_sampai_first_char_except_saldo_awal('2019-01-01', $sampai, '3');	
		}

		$transaksi_pendapatan 	= $this->transaksiakuntansimodel->get_jumlah_by_dari_sampai_first_char($dari, $sampai, '4');
		$transaksi_beban 		= $this->transaksiakuntansimodel->get_jumlah_by_dari_sampai_first_char($dari, $sampai, '5');

		$kode_aset 			= $this->kodeakunmodel->get_kode_akun_by_first_char('1');
		$kode_hutang 		= $this->kodeakunmodel->get_kode_akun_by_first_char('2');
		$kode_modal 		= $this->kodeakunmodel->get_kode_akun_by_first_char('3');
		$kode_pendapatan 	= $this->kodeakunmodel->get_kode_akun_by_first_char('4');
		$kode_beban 		= $this->kodeakunmodel->get_kode_akun_by_first_char('5');

		// Sebelum Tanggal Dari
		$total_aset = 0;
		for($i = 0; $i < sizeof($kode_aset); $i++) {
			for($a = 0; $a < sizeof($transaksi_prev_aset); $a++) {
				if($kode_aset[$i]['kode_akun'] == $transaksi_prev_aset[$a]['kode_akun']) {
					$kode_aset[$i]['debet'] 	= $transaksi_prev_aset[$a]['jumlah_debet'];
					$kode_aset[$i]['kredit'] 	= $transaksi_prev_aset[$a]['jumlah_kredit'];
					if($kode_aset[$i]['kode_akun'] == '105') {
						$kode_aset[$i]['selisih']	+= $transaksi_prev_aset[$a]['jumlah_kredit'] - $transaksi_prev_aset[$a]['jumlah_debet'];
						$total_aset 				-= $kode_aset[$i]['selisih'];
					} else {
						$kode_aset[$i]['selisih']	+= $transaksi_prev_aset[$a]['jumlah_debet'] - $transaksi_prev_aset[$a]['jumlah_kredit'];
						$total_aset 				+= $kode_aset[$i]['selisih'];
					}
				}
			}
		}

		$total_hutang = 0;
		for($i = 0; $i < sizeof($kode_hutang); $i++) {
			for($a = 0; $a < sizeof($transaksi_prev_hutang); $a++) {
				if($kode_hutang[$i]['kode_akun'] == $transaksi_prev_hutang[$a]['kode_akun']) {
					$kode_hutang[$i]['debet'] 	= $transaksi_prev_hutang[$a]['jumlah_debet'];
					$kode_hutang[$i]['kredit'] 	= $transaksi_prev_hutang[$a]['jumlah_kredit'];
					$kode_hutang[$i]['selisih']	+= $transaksi_prev_hutang[$a]['jumlah_kredit'] - $transaksi_prev_hutang[$a]['jumlah_debet'];
					$total_hutang 				+= $kode_hutang[$i]['selisih'];
				}
			}
		}

		$total_modal = 0;
		for($i = 0; $i < sizeof($kode_modal); $i++) {
			if($kode_modal[$i]['kode_akun'] != '305') {
				for($a = 0; $a < sizeof($transaksi_prev_modal); $a++) {
					if($kode_modal[$i]['kode_akun'] == $transaksi_prev_modal[$a]['kode_akun']) {
						$kode_modal[$i]['debet'] 	= $transaksi_prev_modal[$a]['jumlah_debet'];
						$kode_modal[$i]['kredit'] 	= $transaksi_prev_modal[$a]['jumlah_kredit'];
						$kode_modal[$i]['selisih']	+= $transaksi_prev_modal[$a]['jumlah_kredit'] - $transaksi_prev_modal[$a]['jumlah_debet'];
						$total_modal 				+= $kode_modal[$i]['selisih'];
					}
				}		
			}
		}

		// Antara Dari dan Sampai
		//$total_aset 	= 0;
		for($i = 0; $i < sizeof($kode_aset); $i++) {
			for($a = 0; $a < sizeof($transaksi_aset); $a++) {
				if($kode_aset[$i]['kode_akun'] == $transaksi_aset[$a]['kode_akun']) {
					$kode_aset[$i]['debet'] 	= $transaksi_aset[$a]['jumlah_debet'];
					$kode_aset[$i]['kredit'] 	= $transaksi_aset[$a]['jumlah_kredit'];
					if($kode_aset[$i]['kode_akun'] == '105') {
						$kode_aset[$i]['selisih']	+= $transaksi_aset[$a]['jumlah_kredit'] - $transaksi_aset[$a]['jumlah_debet'];
						//$total_aset 				-= $kode_aset[$i]['selisih'];
						$total_aset 				-= $transaksi_aset[$a]['jumlah_kredit'] - $transaksi_aset[$a]['jumlah_debet'];
					} else {
						$kode_aset[$i]['selisih']	+= $transaksi_aset[$a]['jumlah_debet'] - $transaksi_aset[$a]['jumlah_kredit'];
						//$total_aset 				+= $kode_aset[$i]['selisih'];
						$total_aset 				+= $transaksi_aset[$a]['jumlah_debet'] - $transaksi_aset[$a]['jumlah_kredit'];
					}
				}
			}
		}

		//$total_hutang = 0;
		for($i = 0; $i < sizeof($kode_hutang); $i++) {
			for($a = 0; $a < sizeof($transaksi_hutang); $a++) {
				if($kode_hutang[$i]['kode_akun'] == $transaksi_hutang[$a]['kode_akun']) {
					$kode_hutang[$i]['debet'] 	= $transaksi_hutang[$a]['jumlah_debet'];
					$kode_hutang[$i]['kredit'] 	= $transaksi_hutang[$a]['jumlah_kredit'];
					$kode_hutang[$i]['selisih']	+= $transaksi_hutang[$a]['jumlah_kredit'] - $transaksi_hutang[$a]['jumlah_debet'];
					//$total_hutang 				+= $kode_hutang[$i]['selisih'];
					$total_hutang 				+= $transaksi_hutang[$a]['jumlah_kredit'] - $transaksi_hutang[$a]['jumlah_debet'];
				}
			}
		}

		//$total_modal = 0;
		for($i = 0; $i < sizeof($kode_modal); $i++) {
			for($a = 0; $a < sizeof($transaksi_modal); $a++) {
				if($kode_modal[$i]['kode_akun'] == $transaksi_modal[$a]['kode_akun']) {
					$kode_modal[$i]['debet'] 	= $transaksi_modal[$a]['jumlah_debet'];
					$kode_modal[$i]['kredit'] 	= $transaksi_modal[$a]['jumlah_kredit'];
					$kode_modal[$i]['selisih']	+= $transaksi_modal[$a]['jumlah_kredit'] - $transaksi_modal[$a]['jumlah_debet'];
					//$total_modal 				+= $kode_modal[$i]['selisih'];
					$total_modal 				+= $transaksi_modal[$a]['jumlah_kredit'] - $transaksi_modal[$a]['jumlah_debet'];
				}
			}
		}

		$total_pendapatan = 0;
		for($i = 0; $i < sizeof($kode_pendapatan); $i++) {
			for($a = 0; $a < sizeof($transaksi_pendapatan); $a++) {
				if($kode_pendapatan[$i]['kode_akun'] == $transaksi_pendapatan[$a]['kode_akun']) {
					$kode_pendapatan[$i]['debet'] 	= $transaksi_pendapatan[$a]['jumlah_debet'];
					$kode_pendapatan[$i]['kredit'] 	= $transaksi_pendapatan[$a]['jumlah_kredit'];
					$kode_pendapatan[$i]['selisih']	= $transaksi_pendapatan[$a]['jumlah_kredit'] - $transaksi_pendapatan[$a]['jumlah_debet'];
					$total_pendapatan 				+= $kode_pendapatan[$i]['selisih'];
				}
			}
		}

		$total_beban = 0;
		for($i = 0; $i < sizeof($kode_beban); $i++) {
			for($a = 0; $a < sizeof($transaksi_beban); $a++) {
				if($kode_beban[$i]['kode_akun'] == $transaksi_beban[$a]['kode_akun']) {
					$kode_beban[$i]['debet'] 	= $transaksi_beban[$a]['jumlah_debet'];
					$kode_beban[$i]['kredit'] 	= $transaksi_beban[$a]['jumlah_kredit'];
					$kode_beban[$i]['selisih']	+= $transaksi_beban[$a]['jumlah_debet'] - $transaksi_beban[$a]['jumlah_kredit'];
					$total_beban 				+= $kode_beban[$i]['selisih'];
				}
			}
		}

		/*for($i = 0; $i < sizeof($kode_modal); $i++) {
			if($kode_modal[$i]['kode_akun'] == '305') {
				$kode_modal[$i]['selisih'] = $total_pendapatan - $total_beban;
			}
		}*/

		for($i = 0; $i < sizeof($kode_modal); $i++) {
			if($kode_modal[$i]['kode_akun'] == '305') {
				$kode_modal[$i]['selisih']  = $total_pendapatan - $total_beban;
				$shu_berjalan				= $kode_modal[$i]['selisih'];
				$total_modal 				+= $kode_modal[$i]['selisih'];
			}
		}


		$harta_lancar 	= 0;
		$harta_tetap 	= 0;
		for($i = 0; $i < sizeof($kode_aset); $i++) {
			if($kode_aset[$i]['kode_akun'] == '101' || $kode_aset[$i]['kode_akun'] == '102' || $kode_aset[$i]['kode_akun'] == '103') {
				$harta_lancar 	+= $kode_aset[$i]['selisih'];
			} else if($kode_aset[$i]['kode_akun'] == '104' || $kode_aset[$i]['kode_akun'] == '105') {
				$harta_tetap	+= $kode_aset[$i]['selisih'];
			}
		}


		if($total_modal == 0) {
			$rentabilitas 	= 0;	
		} else {
			$rentabilitas 	= ($shu_berjalan / $total_modal) * 100;	
		}
		
		if($total_hutang == 0) {
			$solvabilitas 	= 0;
		} else {
			$solvabilitas 	= $total_aset / $total_hutang;	
		}

		if($total_hutang == 0) {
			$likuiditas		= 0;
		} else {
			$likuiditas		= $harta_lancar / $total_hutang;	
		}
		

        $file = new PHPExcel ();
        $file->getProperties ()->setCreator ( "YHM" );
        $file->getProperties ()->setLastModifiedBy ( "System" );
        $file->getProperties ()->setTitle ( "Laporan Neraca" );
        $file->getProperties ()->setSubject ( "Laporan Neraca" );
        $file->getProperties ()->setDescription ( "Laporan Neraca" );
        $file->getProperties ()->setKeywords ( "Laporan Neraca" );
        $file->getProperties ()->setCategory ( "Laporan Neraca" );
        
        $sheet = $file->getActiveSheet ();
        $i = 2;

        $sheet->mergeCells("A".$i.":G".$i)->setCellValue("A".$i, "KOPPONTREN MAMBAUL MUBBASYIRIN SHIDDIQIYYAH");
        $sheet->getStyle("A".$i.":G".$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle("A".$i.":G".$i)->getFont()->setSize(14)->setBold(true);
        $i++;
        $sheet->mergeCells("A".$i.":G".$i)->setCellValue("A".$i, "LAPORAN NERACA ".$tgl_dari1." - ".$tgl_sampai1);
        $sheet->getStyle("A".$i.":G".$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle("A".$i.":G".$i)->getFont()->setSize(12)->setBold(true);
        $i++;
        $sheet->mergeCells("A".$i.":G".$i)->setCellValue("A".$i, "KANTOR PONPES MAJMA'AL BAHRAIN SHIDDIQIYYAH");
        $sheet->getStyle("A".$i.":G".$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle("A".$i.":G".$i)->getFont()->setSize(10)->setBold(true);
        $i++;
        $sheet->mergeCells("A".$i.":G".$i)->setCellValue("A".$i, "NGRASEH DANDER BOJONEGORO  TELP (0353) 886039       BH : 8181/BH/II/95");
        $sheet->getStyle("A".$i.":G".$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle("A".$i.":G".$i)->getFont()->setSize(10)->setBold(true);
        $i += 2;

        $index_kiri = $i;
        $index_kanan = $i;
        $border_start   = $i;

        /* AKTIVA */
        $sheet->setCellValue("A".$index_kiri, "NO");
        $sheet->setCellValue("B".$index_kiri, "AKTIVA");
        $sheet->setCellValue("C".$index_kiri, "JUMLAH");
        $sheet->getStyle("A".$index_kiri.":C".$index_kiri)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle("A".$index_kiri.":C".$index_kiri)->getFont()->setSize(10)->setBold(true);
        $index_kiri++;
        $sheet->setCellValue("B".$index_kiri, "HARTA");
        $sheet->getStyle("B".$index_kiri)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle("B".$index_kiri)->getFont()->setSize(10)->setBold(true);
        $index_kiri++;
        for($i = 0; $i < sizeof($kode_aset); $i++) {
        	if($kode_aset[$i]['selisih'] != 0) {
        		$sheet->setCellValue("A".$index_kiri, $kode_aset[$i]['kode_akun']);
	        	$sheet->getStyle("A".$index_kiri)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	        	$sheet->setCellValue("B".$index_kiri, $kode_aset[$i]['nama_akun']);
	        	$sheet->setCellValue("C".$index_kiri, $kode_aset[$i]['selisih']);
	        	$sheet->getStyle("C".$index_kiri)->getNumberFormat()->setFormatCode('#,##0');
	        	$index_kiri++;	
        	}
        	
        }
        $sheet->setCellValue("B".$index_kiri, "JUMLAH HARTA");
        $sheet->setCellValue("C".$index_kiri, $total_aset);
        $sheet->getStyle("C".$index_kiri)->getNumberFormat()->setFormatCode('#,##0');
        $sheet->getStyle("A".$index_kiri.":B".$index_kiri)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle("A".$index_kiri.":B".$index_kiri)->getFont()->setSize(10)->setBold(true);
        $index_kiri += 2;
        /*$sheet->setCellValue("B".$index_kiri, "JUMLAH AKTIVA");
        $sheet->setCellValue("C".$index_kiri, $total_aset);
        $sheet->getStyle("C".$index_kiri)->getNumberFormat()->setFormatCode('#,##0');
        $sheet->getStyle("A".$index_kiri.":B".$index_kiri)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle("A".$index_kiri.":B".$index_kiri)->getFont()->setSize(10)->setBold(true);*/
        /* END OF AKTIVA*/

        /* PASIVA */
        $sheet->setCellValue("E".$index_kanan, "NO");
        $sheet->setCellValue("F".$index_kanan, "PASIVA");
        $sheet->setCellValue("G".$index_kanan, "JUMLAH");
        $sheet->getStyle("E".$index_kanan.":G".$index_kanan)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle("E".$index_kanan.":G".$index_kanan)->getFont()->setSize(10)->setBold(true);
        $index_kanan++;
        $sheet->setCellValue("F".$index_kanan, "HUTANG");
        $sheet->getStyle("F".$index_kanan)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle("F".$index_kanan)->getFont()->setSize(10)->setBold(true);
        $index_kanan++;
        for($i = 0; $i < sizeof($kode_hutang); $i++) {
        	if($kode_hutang[$i]['selisih'] != 0) {
        		$sheet->setCellValue("E".$index_kanan, $kode_hutang[$i]['kode_akun']);
	        	$sheet->getStyle("E".$index_kanan)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	        	$sheet->setCellValue("F".$index_kanan, $kode_hutang[$i]['nama_akun']);
	        	$sheet->setCellValue("G".$index_kanan, $kode_hutang[$i]['selisih']);
	        	$sheet->getStyle("G".$index_kanan)->getNumberFormat()->setFormatCode('#,##0');
	        	$index_kanan++;
        	}
        }
        $sheet->setCellValue("F".$index_kanan, "JUMLAH HUTANG");
        $sheet->setCellValue("G".$index_kanan, $total_hutang);
        $sheet->getStyle("G".$index_kanan)->getNumberFormat()->setFormatCode('#,##0');
        $sheet->getStyle("E".$index_kanan.":F".$index_kanan)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle("E".$index_kanan.":F".$index_kanan)->getFont()->setSize(10)->setBold(true);
        $index_kanan += 2;

        $sheet->setCellValue("F".$index_kanan, "MODAL");
        $sheet->getStyle("F".$index_kanan)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle("F".$index_kanan)->getFont()->setSize(10)->setBold(true);
        $index_kanan++;
        for($i = 0; $i < sizeof($kode_modal); $i++) {
        	if($kode_modal[$i]['selisih'] != 0) {
        		$sheet->setCellValue("E".$index_kanan, $kode_modal[$i]['kode_akun']);
	        	$sheet->getStyle("E".$index_kanan)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	        	$sheet->setCellValue("F".$index_kanan, $kode_modal[$i]['nama_akun']);
	        	$sheet->setCellValue("G".$index_kanan, $kode_modal[$i]['selisih']);
	        	$sheet->getStyle("G".$index_kanan)->getNumberFormat()->setFormatCode('#,##0');
	        	$index_kanan++;	
        	}
        }
        $sheet->setCellValue("F".$index_kanan, "JUMLAH MODAL");
        $sheet->setCellValue("G".$index_kanan, $total_modal);
        $sheet->getStyle("G".$index_kanan)->getNumberFormat()->setFormatCode('#,##0');
        $sheet->getStyle("E".$index_kanan.":F".$index_kanan)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle("E".$index_kanan.":F".$index_kanan)->getFont()->setSize(10)->setBold(true);
        $index_kanan += 2;
        $jumlah_pasiva = $total_hutang + $total_modal;
        $sheet->setCellValue("F".$index_kanan, "JUMLAH PASIVA");
        $sheet->setCellValue("G".$index_kanan, $jumlah_pasiva);
        $sheet->getStyle("G".$index_kanan)->getNumberFormat()->setFormatCode('#,##0');
        $sheet->getStyle("E".$index_kanan.":F".$index_kanan)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle("E".$index_kanan.":F".$index_kanan)->getFont()->setSize(10)->setBold(true);
        /* END OF PASIVA */

        /* FOOTER */
        if($index_kiri > $index_kanan) {
        	$index_footer = $index_kiri;
        	$border_end     = $index_kiri;
        } else {
        	$index_footer = $index_kanan;
        	$border_end     = $index_kanan;
        }
        $sheet->setCellValue("B".$border_end, "JUMLAH AKTIVA");
        $sheet->setCellValue("C".$border_end, $total_aset);
        $sheet->getStyle("C".$border_end)->getNumberFormat()->setFormatCode('#,##0');
        $sheet->getStyle("A".$border_end.":B".$border_end)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle("A".$border_end.":B".$border_end)->getFont()->setSize(10)->setBold(true);

        $sheet->setCellValue("F".$border_end, "JUMLAH PASIVA");
        $sheet->setCellValue("G".$border_end, $jumlah_pasiva);
        $sheet->getStyle("G".$border_end)->getNumberFormat()->setFormatCode('#,##0');
        $sheet->getStyle("E".$border_end.":F".$border_end)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle("E".$border_end.":F".$border_end)->getFont()->setSize(10)->setBold(true);

        $index_footer += 2;
        $sheet->setCellValue("F".$index_footer, "Bojonegoro, ".date("d-m-Y"));
        $sheet->getStyle("B".$index_footer.":F".$index_footer)->getFont()->setBold(true);
        $index_footer++;
        $sheet->setCellValue("B".$index_footer, "Ketua,");
        $sheet->setCellValue("F".$index_footer, "Bendahara,");
        $sheet->getStyle("B".$index_footer.":F".$index_footer)->getFont()->setBold(true);
        $index_footer += 4;
        $sheet->setCellValue("B".$index_footer, "Drs. SUPRAPTO");
        $sheet->setCellValue("F".$index_footer, "DWI AGUNG, M.Pd.");
        $sheet->getStyle("B".$index_footer.":F".$index_footer)->getFont()->setBold(true);
        $index_footer += 5;
        $sheet->setCellValue("B".$index_footer, "RENTABILITAS (%) : SHU / MODAL SENDIRI  X 100 %");
        $sheet->setCellValue("C".$index_footer, $rentabilitas);
        $sheet->getStyle("B".$index_footer.":C".$index_footer)->getFont()->setBold(true);
        $index_footer++;
        $sheet->setCellValue("B".$index_footer, "LIKUIDITAS  : HARTA LANCAR / HUTANG LANCAR");
        $sheet->setCellValue("C".$index_footer, $likuiditas);
        $sheet->getStyle("B".$index_footer.":C".$index_footer)->getFont()->setBold(true);
        $index_footer++;
        $sheet->setCellValue("B".$index_footer, "SOLVABILITAS  : TOTAL AKTIVA / TOTAL HUTANG");
        $sheet->setCellValue("C".$index_footer, $solvabilitas);
        $sheet->getStyle("B".$index_footer.":C".$index_footer)->getFont()->setBold(true);
        /* END OF FOOTER */

        foreach(range('A','G') as $columnID) {
		    $sheet->getColumnDimension($columnID)->setAutoSize(true);
		}
		
        $thin = array ();
        $thin['borders']=array();
        $thin['borders']['allborders']=array();
        $thin['borders']['allborders']['style']=PHPExcel_Style_Border::BORDER_THIN ;
        $sheet  ->getStyle ( "A".$border_start.":G".$border_end )->applyFromArray ($thin);

        $filename = "Laporan Neraca_".$tgl_dari1."_".$tgl_sampai1.".xlsx";
        
        header ( 'Content-Type: application/vnd.ms-excel' );
        header ( 'Content-Disposition: attachment;filename="'.$filename.'"' );
        header ( 'Cache-Control: max-age=0' );
        $writer = PHPExcel_IOFactory::createWriter ( $file, 'Excel2007' );
        $writer->save ( 'php://output' );
		return;
	}
}

?>
