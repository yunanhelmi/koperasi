<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class HomeCon extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->model('usermodel');
		$this->load->model('lpg3model');
		$this->load->model('lpg12model');
		$this->load->model('lpg50model');
		$this->load->model('bg5_5model');
		$this->load->model('bg12model');
		$this->load->library('session');
		$this->load->library('form_validation');
		$this->load->library('upload');
		$this->load->library(array('PHPExcel','PHPExcel/IOFactory'));
	}
	
	function index() {
		$session_data = $this->session->userdata('mubasyirin_logged_in');
		if($session_data == NULL) {
			redirect("usercon/login", "refresh");
		}
		$data['username'] = $session_data['username'];
		$data['status'] = $session_data['status'];
		$data['bulan'] = ['januari','februari','maret','april','mei','juni','juli','agustus','september','oktober','november','desember'];
		
		/********** For LPG 3 Kg Chart **********/
		$tahun = $this->lpg3model->getTahunTarget();
		if($tahun == NULL) {
			$tahun = 0;
		}
		$data['tahunlpg3'] = $tahun != NULL ? $tahun : 0;
		/*--- Bagian Kiri ---*/
		if($this->input->post('bulanlpg3kiri') == NULL) {
			$data['bulanlpg3kiri'] = 'januari';
		} else {
			$data['bulanlpg3kiri'] = $this->input->post('bulanlpg3kiri');
		}
		if($this->input->post('tahunlpg3kiri') == NULL) {
			$data['tahunlpg3kiri'] = $tahun[0]['tahun'];
		} else {
			$data['tahunlpg3kiri'] = $this->input->post('tahunlpg3kiri');
		}
		$datalpg3targetkiri = $this->lpg3model->getSumTargetTahun($data['tahunlpg3kiri']);
		$datalpg3realisasikiri = $this->lpg3model->getSumRealisasiTahun($data['tahunlpg3kiri']);
		$data['datalpg3targetkiri'] = $datalpg3targetkiri[0][$data['bulanlpg3kiri']];
		$data['datalpg3realisasikiri'] = $datalpg3realisasikiri[0][$data['bulanlpg3kiri']];
		if($tahun == NULL) {
			$data['datalpg3persentasekiri'] = 0;
		} else {
			$data['datalpg3persentasekiri'] = ($data['datalpg3realisasikiri'] / $data['datalpg3targetkiri']) * 100;
		}
		
		/*--- Bagian Kanan ---*/
		if($this->input->post('bulanlpg3kanan') == NULL) {
			$data['bulanlpg3kanan'] = 'januari';
		} else {
			$data['bulanlpg3kanan'] = $this->input->post('bulanlpg3kanan');
		}
		if($this->input->post('tahunlpg3kanan') == NULL) {
			$data['tahunlpg3kanan'] = $tahun[0]['tahun'];
		} else {
			$data['tahunlpg3kanan'] = $this->input->post('tahunlpg3kanan');
		}
		$datalpg3targetkanan = $this->lpg3model->getSumTargetTahun($data['tahunlpg3kanan']);
		$datalpg3realisasikanan = $this->lpg3model->getSumRealisasiTahun($data['tahunlpg3kanan']);
		$data['datalpg3targetkanan'] = $datalpg3targetkanan[0]['total'];
		$akumulasi = 0;
		foreach($datalpg3realisasikanan[0] as $b => $c) {
			if($b == $data['bulanlpg3kanan']) {
				$akumulasi += $datalpg3realisasikanan[0][$b];
				break;
			} else {
				$akumulasi += $datalpg3realisasikanan[0][$b];
			}
		}
		$data['datalpg3realisasikanan'] = $akumulasi;
		if($tahun == NULL) {
			$data['datalpg3persentasekanan'] = 0;
		} else {
			$data['datalpg3persentasekanan'] = ($data['datalpg3realisasikanan'] / $data['datalpg3targetkanan']) * 100;
		}
		/********** End of LPG 3 Kg Chart **********/
		
		/********** For LPG 12 Kg Chart **********/
		$tahun = $this->lpg12model->getTahunTarget();
		if($tahun == NULL) {
			$tahun = 0;
		}
		$data['tahunlpg12'] = $tahun != NULL ? $tahun : 0;
		/*--- Bagian Kiri ---*/
		if($this->input->post('bulanlpg12kiri') == NULL) {
			$data['bulanlpg12kiri'] = 'januari';
		} else {
			$data['bulanlpg12kiri'] = $this->input->post('bulanlpg12kiri');
		}
		if($this->input->post('tahunlpg12kiri') == NULL) {
			$data['tahunlpg12kiri'] = $tahun[0]['tahun'];
		} else {
			$data['tahunlpg12kiri'] = $this->input->post('tahunlpg12kiri');
		}
		$datalpg12targetkiri = $this->lpg12model->getSumTargetTahun($data['tahunlpg12kiri']);
		$datalpg12realisasikiri = $this->lpg12model->getSumRealisasiTahun($data['tahunlpg12kiri']);
		$data['datalpg12targetkiri'] = $datalpg12targetkiri[0][$data['bulanlpg12kiri']];
		$data['datalpg12realisasikiri'] = $datalpg12realisasikiri[0][$data['bulanlpg12kiri']];
		$data['datalpg12persentasekiri'] = ($data['datalpg12realisasikiri'] / $data['datalpg12targetkiri']) * 100;
		/*--- Bagian Kanan ---*/
		if($this->input->post('bulanlpg12kanan') == NULL) {
			$data['bulanlpg12kanan'] = 'januari';
		} else {
			$data['bulanlpg12kanan'] = $this->input->post('bulanlpg12kanan');
		}
		if($this->input->post('tahunlpg12kanan') == NULL) {
			$data['tahunlpg12kanan'] = $tahun[0]['tahun'];
		} else {
			$data['tahunlpg12kanan'] = $this->input->post('tahunlpg12kanan');
		}
		$datalpg12targetkanan = $this->lpg12model->getSumTargetTahun($data['tahunlpg12kanan']);
		$datalpg12realisasikanan = $this->lpg12model->getSumRealisasiTahun($data['tahunlpg12kanan']);
		$data['datalpg12targetkanan'] = $datalpg12targetkanan[0]['total'];
		$akumulasi = 0;
		foreach($datalpg12realisasikanan[0] as $b => $c) {
			if($b == $data['bulanlpg12kanan']) {
				$akumulasi += $datalpg12realisasikanan[0][$b];
				break;
			} else {
				$akumulasi += $datalpg12realisasikanan[0][$b];
			}
		}
		$data['datalpg12realisasikanan'] = $akumulasi;
		if($tahun == NULL) {
			$data['datalpg12persentasekanan'] = 0;
		} else {
			$data['datalpg12persentasekanan'] = ($data['datalpg12realisasikanan'] / $data['datalpg12targetkanan']) * 100;
		}
		/********** End of LPG 12 Kg Chart **********/
		
		/********** For LPG 50 Kg Chart **********/
		$tahun = $this->lpg50model->getTahunTarget();
		if($tahun == NULL) {
			$tahun = 0;
		}
		$data['tahunlpg50'] = $tahun != NULL ? $tahun : 0;
		/*--- Bagian Kiri ---*/
		if($this->input->post('bulanlpg50kiri') == NULL) {
			$data['bulanlpg50kiri'] = 'januari';
		} else {
			$data['bulanlpg50kiri'] = $this->input->post('bulanlpg50kiri');
		}
		if($this->input->post('tahunlpg50kiri') == NULL) {
			$data['tahunlpg50kiri'] = $tahun[0]['tahun'];
		} else {
			$data['tahunlpg50kiri'] = $this->input->post('tahunlpg50kiri');
		}
		$datalpg50targetkiri = $this->lpg50model->getSumTargetTahun($data['tahunlpg50kiri']);
		$datalpg50realisasikiri = $this->lpg50model->getSumRealisasiTahun($data['tahunlpg50kiri']);
		$data['datalpg50targetkiri'] = $datalpg50targetkiri[0][$data['bulanlpg50kiri']];
		$data['datalpg50realisasikiri'] = $datalpg50realisasikiri[0][$data['bulanlpg50kiri']];
		if($tahun == NULL) {
			$data['datalpg50persentasekiri'] = 0;
		} else {
			$data['datalpg50persentasekiri'] = ($data['datalpg50realisasikiri'] / $data['datalpg50targetkiri']) * 100;
		}
		/*--- Bagian Kanan ---*/
		if($this->input->post('bulanlpg50kanan') == NULL) {
			$data['bulanlpg50kanan'] = 'januari';
		} else {
			$data['bulanlpg50kanan'] = $this->input->post('bulanlpg50kanan');
		}
		if($this->input->post('tahunlpg50kanan') == NULL) {
			$data['tahunlpg50kanan'] = $tahun[0]['tahun'];
		} else {
			$data['tahunlpg50kanan'] = $this->input->post('tahunlpg50kanan');
		}
		$datalpg50targetkanan = $this->lpg50model->getSumTargetTahun($data['tahunlpg50kanan']);
		$datalpg50realisasikanan = $this->lpg50model->getSumRealisasiTahun($data['tahunlpg50kanan']);
		$data['datalpg50targetkanan'] = $datalpg50targetkanan[0]['total'];
		$akumulasi = 0;
		foreach($datalpg50realisasikanan[0] as $b => $c) {
			if($b == $data['bulanlpg50kanan']) {
				$akumulasi += $datalpg50realisasikanan[0][$b];
				break;
			} else {
				$akumulasi += $datalpg50realisasikanan[0][$b];
			}
		}
		$data['datalpg50realisasikanan'] = $akumulasi;
		if($tahun == NULL) {
			$data['datalpg50persentasekanan'] = 0;
		} else {
			$data['datalpg50persentasekanan'] = ($data['datalpg50realisasikanan'] / $data['datalpg50targetkanan']) * 100;
		}
		/********** End of LPG 50 Kg Chart **********/
		
		/********** For BG 5.5 Kg Chart **********/
		$tahun = $this->bg5_5model->getTahunTarget();
		if($tahun == NULL) {
			$tahun = 0;
		}
		$data['tahunbg5_5'] = $tahun != NULL ? $tahun : 0;
		/*--- Bagian Kiri ---*/
		if($this->input->post('bulanbg5_5kiri') == NULL) {
			$data['bulanbg5_5kiri'] = 'januari';
		} else {
			$data['bulanbg5_5kiri'] = $this->input->post('bulanbg5_5kiri');
		}
		if($this->input->post('tahunbg5_5kiri') == NULL) {
			$data['tahunbg5_5kiri'] = $tahun[0]['tahun'];
		} else {
			$data['tahunbg5_5kiri'] = $this->input->post('tahunbg5_5kiri');
		}
		$databg5_5targetkiri = $this->bg5_5model->getSumTargetTahun($data['tahunbg5_5kiri']);
		$databg5_5realisasikiri = $this->bg5_5model->getSumRealisasiTahun($data['tahunbg5_5kiri']);
		$data['databg5_5targetkiri'] = $databg5_5targetkiri[0][$data['bulanbg5_5kiri']];
		$data['databg5_5realisasikiri'] = $databg5_5realisasikiri[0][$data['bulanbg5_5kiri']];
		if($tahun == NULL) {
			$data['databg5_5persentasekiri'] = 0;
		} else {
			$data['databg5_5persentasekiri'] = ($data['databg5_5realisasikiri'] / $data['databg5_5targetkiri']) * 100;
		}
		
		/*--- Bagian Kanan ---*/
		if($this->input->post('bulanbg5_5kanan') == NULL) {
			$data['bulanbg5_5kanan'] = 'januari';
		} else {
			$data['bulanbg5_5kanan'] = $this->input->post('bulanbg5_5kanan');
		}
		if($this->input->post('tahunbg5_5kanan') == NULL) {
			$data['tahunbg5_5kanan'] = $tahun[0]['tahun'];
		} else {
			$data['tahunbg5_5kanan'] = $this->input->post('tahunbg5_5kanan');
		}
		$databg5_5targetkanan = $this->bg5_5model->getSumTargetTahun($data['tahunbg5_5kanan']);
		$databg5_5realisasikanan = $this->bg5_5model->getSumRealisasiTahun($data['tahunbg5_5kanan']);
		$data['databg5_5targetkanan'] = $databg5_5targetkanan[0]['total'];
		$akumulasi = 0;
		foreach($databg5_5realisasikanan[0] as $b => $c) {
			if($b == $data['bulanbg5_5kanan']) {
				$akumulasi += $databg5_5realisasikanan[0][$b];
				break;
			} else {
				$akumulasi += $databg5_5realisasikanan[0][$b];
			}
		}
		$data['databg5_5realisasikanan'] = $akumulasi;
		if($tahun == NULL) {
			$data['databg5_5persentasekanan'] = 0;
		} else {
			$data['databg5_5persentasekanan'] = ($data['databg5_5realisasikanan'] / $data['databg5_5targetkanan']) * 100;
		}
		/********** End of BG 5.5 Kg Chart **********/
		
		/********** For BG 12 Kg Chart **********/
		$tahun = $this->bg12model->getTahunTarget();
		if($tahun == NULL) {
			$tahun = 0;
		}
		$data['tahunbg12'] = $tahun != NULL ? $tahun : 0;
		/*--- Bagian Kiri ---*/
		if($this->input->post('bulanbg12kiri') == NULL) {
			$data['bulanbg12kiri'] = 'januari';
		} else {
			$data['bulanbg12kiri'] = $this->input->post('bulanbg12kiri');
		}
		if($this->input->post('tahunbg12kiri') == NULL) {
			$data['tahunbg12kiri'] = $tahun[0]['tahun'];
		} else {
			$data['tahunbg12kiri'] = $this->input->post('tahunbg12kiri');
		}
		$databg12targetkiri = $this->bg12model->getSumTargetTahun($data['tahunbg12kiri']);
		$databg12realisasikiri = $this->bg12model->getSumRealisasiTahun($data['tahunbg12kiri']);
		$data['databg12targetkiri'] = $databg12targetkiri[0][$data['bulanbg12kiri']];
		$data['databg12realisasikiri'] = $databg12realisasikiri[0][$data['bulanbg12kiri']];
		if($tahun == NULL) {
			$data['databg12persentasekiri'] = 0;
		} else {
			$data['databg12persentasekiri'] = ($data['databg12realisasikiri'] / $data['databg12targetkiri']) * 100;
		}
		/*--- Bagian Kanan ---*/
		if($this->input->post('bulanbg12kanan') == NULL) {
			$data['bulanbg12kanan'] = 'januari';
		} else {
			$data['bulanbg12kanan'] = $this->input->post('bulanbg12kanan');
		}
		if($this->input->post('tahunbg12kanan') == NULL) {
			$data['tahunbg12kanan'] = $tahun[0]['tahun'];
		} else {
			$data['tahunbg12kanan'] = $this->input->post('tahunbg12kanan');
		}
		$databg12targetkanan = $this->bg12model->getSumTargetTahun($data['tahunbg12kanan']);
		$databg12realisasikanan = $this->bg12model->getSumRealisasiTahun($data['tahunbg12kanan']);
		$data['databg12targetkanan'] = $databg12targetkanan[0]['total'];
		$akumulasi = 0;
		foreach($databg12realisasikanan[0] as $b => $c) {
			if($b == $data['bulanbg12kanan']) {
				$akumulasi += $databg12realisasikanan[0][$b];
				break;
			} else {
				$akumulasi += $databg12realisasikanan[0][$b];
			}
		}
		$data['databg12realisasikanan'] = $akumulasi;
		if($tahun == NULL) {
			$data['databg12persentasekanan'] = 0;
		} else {
			$data['databg12persentasekanan'] = ($data['databg12realisasikanan'] / $data['databg12targetkanan']) * 100;
		}
		/********** End of BG 12 Kg Chart **********/
		
		$this->load->view('/layouts/menu', $data);
		$this->load->view('/layouts/home1', $data);
		$this->load->view('/layouts/footer', $data);
	}
	
	function home() {
		$session_data = $this->session->userdata('mubasyirin_logged_in');
		if($session_data == NULL) {
			redirect("usercon/login", "refresh");
		}
		$data['username'] = $session_data['username'];
		$data['status'] = $session_data['status'];
		
		/********** For LPG 3 Kg Chart **********/
		$tahun = $this->lpg3model->getTahunTarget();
		$data['tahun_lpg3_chart'] = $tahun != NULL ? $tahun[0]['tahun'] : 0;
		$data_target_lpg3 = $this->lpg3model->selectTargetTahun($data['tahun_lpg3_chart']);
		$data_realisasi_lpg3 = $this->lpg3model->selectRealisasiTahun($data['tahun_lpg3_chart']);
		$total_target_lpg3 = array();
		for($i = 0; $i <= 12; $i++) {
			$total_target_lpg3[$i] = 0;
		}
		$total_realisasi_lpg3 = array();
		for($i = 0; $i <= 12; $i++) {
			$total_realisasi_lpg3[$i] = 0;
		}
		for($i = 0; $i < sizeof($data_target_lpg3); $i++) {
			$total_target_lpg3[0] += $data_target_lpg3[$i]['januari']; 
			$total_target_lpg3[1] += $data_target_lpg3[$i]['februari']; 
			$total_target_lpg3[2] += $data_target_lpg3[$i]['maret']; 
			$total_target_lpg3[3] += $data_target_lpg3[$i]['april']; 
			$total_target_lpg3[4] += $data_target_lpg3[$i]['mei']; 
			$total_target_lpg3[5] += $data_target_lpg3[$i]['juni']; 
			$total_target_lpg3[6] += $data_target_lpg3[$i]['juli']; 
			$total_target_lpg3[7] += $data_target_lpg3[$i]['agustus']; 
			$total_target_lpg3[8] += $data_target_lpg3[$i]['september']; 
			$total_target_lpg3[9] += $data_target_lpg3[$i]['oktober']; 
			$total_target_lpg3[10] += $data_target_lpg3[$i]['november']; 
			$total_target_lpg3[11] += $data_target_lpg3[$i]['desember'];
			$total_target_lpg3[12] += $data_target_lpg3[$i]['total'];
		}
		for($i = 0; $i < sizeof($data_realisasi_lpg3); $i++) {
			$total_realisasi_lpg3[0] += $data_realisasi_lpg3[$i]['januari']; 
			$total_realisasi_lpg3[1] += $data_realisasi_lpg3[$i]['februari']; 
			$total_realisasi_lpg3[2] += $data_realisasi_lpg3[$i]['maret']; 
			$total_realisasi_lpg3[3] += $data_realisasi_lpg3[$i]['april']; 
			$total_realisasi_lpg3[4] += $data_realisasi_lpg3[$i]['mei']; 
			$total_realisasi_lpg3[5] += $data_realisasi_lpg3[$i]['juni']; 
			$total_realisasi_lpg3[6] += $data_realisasi_lpg3[$i]['juli']; 
			$total_realisasi_lpg3[7] += $data_realisasi_lpg3[$i]['agustus']; 
			$total_realisasi_lpg3[8] += $data_realisasi_lpg3[$i]['september']; 
			$total_realisasi_lpg3[9] += $data_realisasi_lpg3[$i]['oktober']; 
			$total_realisasi_lpg3[10] += $data_realisasi_lpg3[$i]['november']; 
			$total_realisasi_lpg3[11] += $data_realisasi_lpg3[$i]['desember']; 
			$total_realisasi_lpg3[12] += $data_realisasi_lpg3[$i]['total']; 
		}
		$data_target_lpg3_chart = array();
		$data_realisasi_lpg3_chart = array();
		for($i = 0; $i < 12; $i++) {
			$data_target_lpg3_chart[] = $total_target_lpg3[$i];
			$data_realisasi_lpg3_chart[] = $total_realisasi_lpg3[$i];
		}
		$data['data_target_lpg3_chart'] = json_encode($data_target_lpg3_chart);
		$data['data_realisasi_lpg3_chart'] = json_encode($data_realisasi_lpg3_chart);
		//Prev Year
		$data['thn_kemarin_lpg3'] = $data['tahun_lpg3_chart'] - 1;
		$data_realisasi_lpg3_kemarin = $this->lpg3model->selectRealisasiTahun($data['thn_kemarin_lpg3']);
		$total_realisasi_lpg3_thn_kemarin = 0;
		for($i = 0; $i < sizeof($data_realisasi_lpg3_kemarin); $i++) {
			$total_realisasi_lpg3_thn_kemarin += $data_realisasi_lpg3_kemarin[$i]['total'];
		}
		$data['total_target_lpg3'] = $total_target_lpg3[12];
		$data['total_realisasi_lpg3'] = $total_realisasi_lpg3[12];
		$data['total_realisasi_lpg3_kemarin'] = $total_realisasi_lpg3_thn_kemarin;
		/********** End of LPG 12 Kg Chart **********/
		
		/********** For LPG 12 Kg Chart **********/
		$tahun = $this->lpg12model->getTahunTarget();
		$data['tahun_lpg12_chart'] = $tahun != NULL ? $tahun[0]['tahun'] : 0;
		$data_target_lpg12 = $this->lpg12model->selectTargetTahun($data['tahun_lpg12_chart']);
		$data_realisasi_lpg12 = $this->lpg12model->selectRealisasiTahun($data['tahun_lpg12_chart']);
		$total_target_lpg12 = array();
		for($i = 0; $i <= 12; $i++) {
			$total_target_lpg12[$i] = 0;
		}
		$total_realisasi_lpg12 = array();
		for($i = 0; $i <= 12; $i++) {
			$total_realisasi_lpg12[$i] = 0;
		}
		for($i = 0; $i < sizeof($data_target_lpg12); $i++) {
			$total_target_lpg12[0] += $data_target_lpg12[$i]['januari']; 
			$total_target_lpg12[1] += $data_target_lpg12[$i]['februari']; 
			$total_target_lpg12[2] += $data_target_lpg12[$i]['maret']; 
			$total_target_lpg12[3] += $data_target_lpg12[$i]['april']; 
			$total_target_lpg12[4] += $data_target_lpg12[$i]['mei']; 
			$total_target_lpg12[5] += $data_target_lpg12[$i]['juni']; 
			$total_target_lpg12[6] += $data_target_lpg12[$i]['juli']; 
			$total_target_lpg12[7] += $data_target_lpg12[$i]['agustus']; 
			$total_target_lpg12[8] += $data_target_lpg12[$i]['september']; 
			$total_target_lpg12[9] += $data_target_lpg12[$i]['oktober']; 
			$total_target_lpg12[10] += $data_target_lpg12[$i]['november']; 
			$total_target_lpg12[11] += $data_target_lpg12[$i]['desember'];
			$total_target_lpg12[12] += $data_target_lpg12[$i]['total'];
		}
		for($i = 0; $i < sizeof($data_realisasi_lpg12); $i++) {
			$total_realisasi_lpg12[0] += $data_realisasi_lpg12[$i]['januari']; 
			$total_realisasi_lpg12[1] += $data_realisasi_lpg12[$i]['februari']; 
			$total_realisasi_lpg12[2] += $data_realisasi_lpg12[$i]['maret']; 
			$total_realisasi_lpg12[3] += $data_realisasi_lpg12[$i]['april']; 
			$total_realisasi_lpg12[4] += $data_realisasi_lpg12[$i]['mei']; 
			$total_realisasi_lpg12[5] += $data_realisasi_lpg12[$i]['juni']; 
			$total_realisasi_lpg12[6] += $data_realisasi_lpg12[$i]['juli']; 
			$total_realisasi_lpg12[7] += $data_realisasi_lpg12[$i]['agustus']; 
			$total_realisasi_lpg12[8] += $data_realisasi_lpg12[$i]['september']; 
			$total_realisasi_lpg12[9] += $data_realisasi_lpg12[$i]['oktober']; 
			$total_realisasi_lpg12[10] += $data_realisasi_lpg12[$i]['november']; 
			$total_realisasi_lpg12[11] += $data_realisasi_lpg12[$i]['desember']; 
			$total_realisasi_lpg12[12] += $data_realisasi_lpg12[$i]['total']; 
		}
		$data_target_lpg12_chart = array();
		$data_realisasi_lpg12_chart = array();
		for($i = 0; $i < 12; $i++) {
			$data_target_lpg12_chart[] = $total_target_lpg12[$i];
			$data_realisasi_lpg12_chart[] = $total_realisasi_lpg12[$i];
		}
		$data['data_target_lpg12_chart'] = json_encode($data_target_lpg12_chart);
		$data['data_realisasi_lpg12_chart'] = json_encode($data_realisasi_lpg12_chart);
		//Prev Year
		$data['thn_kemarin_lpg12'] = $data['tahun_lpg12_chart'] - 1;
		$data_realisasi_lpg12_kemarin = $this->lpg12model->selectRealisasiTahun($data['thn_kemarin_lpg12']);
		$total_realisasi_lpg12_thn_kemarin = 0;
		for($i = 0; $i < sizeof($data_realisasi_lpg12_kemarin); $i++) {
			$total_realisasi_lpg12_thn_kemarin += $data_realisasi_lpg12_kemarin[$i]['total'];
		}
		$data['total_target_lpg12'] = $total_target_lpg12[12];
		$data['total_realisasi_lpg12'] = $total_realisasi_lpg12[12];
		$data['total_realisasi_lpg12_kemarin'] = $total_realisasi_lpg12_thn_kemarin;
		/********** End of LPG 12 Kg Chart **********/
		
		/********** For LPG 50 Kg Chart **********/
		$tahun = $this->lpg50model->getTahunTarget();
		$data['tahun_lpg50_chart'] = $tahun != NULL ? $tahun[0]['tahun'] : 0;
		$data_target_lpg50 = $this->lpg50model->selectTargetTahun($data['tahun_lpg50_chart']);
		$data_realisasi_lpg50 = $this->lpg50model->selectRealisasiTahun($data['tahun_lpg50_chart']);
		$total_target_lpg50 = array();
		for($i = 0; $i <= 12; $i++) {
			$total_target_lpg50[$i] = 0;
		}
		$total_realisasi_lpg50 = array();
		for($i = 0; $i <= 12; $i++) {
			$total_realisasi_lpg50[$i] = 0;
		}
		for($i = 0; $i < sizeof($data_target_lpg50); $i++) {
			$total_target_lpg50[0] += $data_target_lpg50[$i]['januari']; 
			$total_target_lpg50[1] += $data_target_lpg50[$i]['februari']; 
			$total_target_lpg50[2] += $data_target_lpg50[$i]['maret']; 
			$total_target_lpg50[3] += $data_target_lpg50[$i]['april']; 
			$total_target_lpg50[4] += $data_target_lpg50[$i]['mei']; 
			$total_target_lpg50[5] += $data_target_lpg50[$i]['juni']; 
			$total_target_lpg50[6] += $data_target_lpg50[$i]['juli']; 
			$total_target_lpg50[7] += $data_target_lpg50[$i]['agustus']; 
			$total_target_lpg50[8] += $data_target_lpg50[$i]['september']; 
			$total_target_lpg50[9] += $data_target_lpg50[$i]['oktober']; 
			$total_target_lpg50[10] += $data_target_lpg50[$i]['november']; 
			$total_target_lpg50[11] += $data_target_lpg50[$i]['desember'];
			$total_target_lpg50[12] += $data_target_lpg50[$i]['total'];
		}
		for($i = 0; $i < sizeof($data_realisasi_lpg50); $i++) {
			$total_realisasi_lpg50[0] += $data_realisasi_lpg50[$i]['januari']; 
			$total_realisasi_lpg50[1] += $data_realisasi_lpg50[$i]['februari']; 
			$total_realisasi_lpg50[2] += $data_realisasi_lpg50[$i]['maret']; 
			$total_realisasi_lpg50[3] += $data_realisasi_lpg50[$i]['april']; 
			$total_realisasi_lpg50[4] += $data_realisasi_lpg50[$i]['mei']; 
			$total_realisasi_lpg50[5] += $data_realisasi_lpg50[$i]['juni']; 
			$total_realisasi_lpg50[6] += $data_realisasi_lpg50[$i]['juli']; 
			$total_realisasi_lpg50[7] += $data_realisasi_lpg50[$i]['agustus']; 
			$total_realisasi_lpg50[8] += $data_realisasi_lpg50[$i]['september']; 
			$total_realisasi_lpg50[9] += $data_realisasi_lpg50[$i]['oktober']; 
			$total_realisasi_lpg50[10] += $data_realisasi_lpg50[$i]['november']; 
			$total_realisasi_lpg50[11] += $data_realisasi_lpg50[$i]['desember']; 
			$total_realisasi_lpg50[12] += $data_realisasi_lpg50[$i]['total']; 
		}
		$data_target_lpg50_chart = array();
		$data_realisasi_lpg50_chart = array();
		for($i = 0; $i < 12; $i++) {
			$data_target_lpg50_chart[] = $total_target_lpg50[$i];
			$data_realisasi_lpg50_chart[] = $total_realisasi_lpg50[$i];
		}
		$data['data_target_lpg50_chart'] = json_encode($data_target_lpg50_chart);
		$data['data_realisasi_lpg50_chart'] = json_encode($data_realisasi_lpg50_chart);
		//Prev Year
		$data['thn_kemarin_lpg50'] = $data['tahun_lpg50_chart'] - 1;
		$data_realisasi_lpg50_kemarin = $this->lpg50model->selectRealisasiTahun($data['thn_kemarin_lpg50']);
		$total_realisasi_lpg50_thn_kemarin = 0;
		for($i = 0; $i < sizeof($data_realisasi_lpg50_kemarin); $i++) {
			$total_realisasi_lpg50_thn_kemarin += $data_realisasi_lpg50_kemarin[$i]['total'];
		}
		$data['total_target_lpg50'] = $total_target_lpg50[12];
		$data['total_realisasi_lpg50'] = $total_realisasi_lpg50[12];
		$data['total_realisasi_lpg50_kemarin'] = $total_realisasi_lpg50_thn_kemarin;
		/********** End of LPG 50 Kg Chart **********/
		
		/********** For Bright Gas 5.5 Kg Chart **********/
		$tahun = $this->bg5_5model->getTahunTarget();
		$data['tahun_bg5_5_chart'] = $tahun != NULL ? $tahun[0]['tahun'] : 0;
		$data_target_bg5_5 = $this->bg5_5model->selectTargetTahun($data['tahun_bg5_5_chart']);
		$data_realisasi_bg5_5 = $this->bg5_5model->selectRealisasiTahun($data['tahun_bg5_5_chart']);
		$total_target_bg5_5 = array();
		for($i = 0; $i <= 12; $i++) {
			$total_target_bg5_5[$i] = 0;
		}
		$total_realisasi_bg5_5 = array();
		for($i = 0; $i <= 12; $i++) {
			$total_realisasi_bg5_5[$i] = 0;
		}
		for($i = 0; $i < sizeof($data_target_lpg50); $i++) {
			$total_target_bg5_5[0] += $data_target_bg5_5[$i]['januari']; 
			$total_target_bg5_5[1] += $data_target_bg5_5[$i]['februari']; 
			$total_target_bg5_5[2] += $data_target_bg5_5[$i]['maret']; 
			$total_target_bg5_5[3] += $data_target_bg5_5[$i]['april']; 
			$total_target_bg5_5[4] += $data_target_bg5_5[$i]['mei']; 
			$total_target_bg5_5[5] += $data_target_bg5_5[$i]['juni']; 
			$total_target_bg5_5[6] += $data_target_bg5_5[$i]['juli']; 
			$total_target_bg5_5[7] += $data_target_bg5_5[$i]['agustus']; 
			$total_target_bg5_5[8] += $data_target_bg5_5[$i]['september']; 
			$total_target_bg5_5[9] += $data_target_bg5_5[$i]['oktober']; 
			$total_target_bg5_5[10] += $data_target_bg5_5[$i]['november']; 
			$total_target_bg5_5[11] += $data_target_bg5_5[$i]['desember'];
			$total_target_bg5_5[12] += $data_target_bg5_5[$i]['total'];
		}
		for($i = 0; $i < sizeof($data_realisasi_bg5_5); $i++) {
			$total_realisasi_bg5_5[0] += $data_realisasi_bg5_5[$i]['januari']; 
			$total_realisasi_bg5_5[1] += $data_realisasi_bg5_5[$i]['februari']; 
			$total_realisasi_bg5_5[2] += $data_realisasi_bg5_5[$i]['maret']; 
			$total_realisasi_bg5_5[3] += $data_realisasi_bg5_5[$i]['april']; 
			$total_realisasi_bg5_5[4] += $data_realisasi_bg5_5[$i]['mei']; 
			$total_realisasi_bg5_5[5] += $data_realisasi_bg5_5[$i]['juni']; 
			$total_realisasi_bg5_5[6] += $data_realisasi_bg5_5[$i]['juli']; 
			$total_realisasi_bg5_5[7] += $data_realisasi_bg5_5[$i]['agustus']; 
			$total_realisasi_bg5_5[8] += $data_realisasi_bg5_5[$i]['september']; 
			$total_realisasi_bg5_5[9] += $data_realisasi_bg5_5[$i]['oktober']; 
			$total_realisasi_bg5_5[10] += $data_realisasi_bg5_5[$i]['november']; 
			$total_realisasi_bg5_5[11] += $data_realisasi_bg5_5[$i]['desember']; 
			$total_realisasi_bg5_5[12] += $data_realisasi_bg5_5[$i]['total']; 
		}
		$data_target_bg5_5_chart = array();
		$data_realisasi_bg5_5_chart = array();
		for($i = 0; $i < 12; $i++) {
			$data_target_bg5_5_chart[] = $total_target_bg5_5[$i];
			$data_realisasi_bg5_5_chart[] = $total_realisasi_bg5_5[$i];
		}
		$data['data_target_bg5_5_chart'] = json_encode($data_target_bg5_5_chart);
		$data['data_realisasi_bg5_5_chart'] = json_encode($data_realisasi_bg5_5_chart);
		//Prev Year
		$data['thn_kemarin_bg5_5'] = $data['tahun_bg5_5_chart'] - 1;
		$data_realisasi_bg5_5_kemarin = $this->bg5_5model->selectRealisasiTahun($data['thn_kemarin_bg5_5']);
		$total_realisasi_bg5_5_thn_kemarin = 0;
		for($i = 0; $i < sizeof($data_realisasi_bg5_5_kemarin); $i++) {
			$total_realisasi_bg5_5_thn_kemarin += $data_realisasi_bg5_5_kemarin[$i]['total'];
		}
		$data['total_target_bg5_5'] = $total_target_bg5_5[12];
		$data['total_realisasi_bg5_5'] = $total_realisasi_bg5_5[12];
		$data['total_realisasi_bg5_5_kemarin'] = $total_realisasi_bg5_5_thn_kemarin;
		/********** End of Bright Gas 5.5 Kg Chart **********/
		
		/********** For Bright Gas 12 Kg Chart **********/
		$tahun = $this->bg12model->getTahunTarget();
		$data['tahun_bg12_chart'] = $tahun != NULL ? $tahun[0]['tahun'] : 0;
		$data_target_bg12 = $this->bg12model->selectTargetTahun($data['tahun_bg12_chart']);
		$data_realisasi_bg12 = $this->bg12model->selectRealisasiTahun($data['tahun_bg12_chart']);
		$total_target_bg12 = array();
		for($i = 0; $i <= 12; $i++) {
			$total_target_bg12[$i] = 0;
		}
		$total_realisasi_bg12 = array();
		for($i = 0; $i <= 12; $i++) {
			$total_realisasi_bg12[$i] = 0;
		}
		for($i = 0; $i < sizeof($data_target_lpg50); $i++) {
			$total_target_bg12[0] += $data_target_bg12[$i]['januari']; 
			$total_target_bg12[1] += $data_target_bg12[$i]['februari']; 
			$total_target_bg12[2] += $data_target_bg12[$i]['maret']; 
			$total_target_bg12[3] += $data_target_bg12[$i]['april']; 
			$total_target_bg12[4] += $data_target_bg12[$i]['mei']; 
			$total_target_bg12[5] += $data_target_bg12[$i]['juni']; 
			$total_target_bg12[6] += $data_target_bg12[$i]['juli']; 
			$total_target_bg12[7] += $data_target_bg12[$i]['agustus']; 
			$total_target_bg12[8] += $data_target_bg12[$i]['september']; 
			$total_target_bg12[9] += $data_target_bg12[$i]['oktober']; 
			$total_target_bg12[10] += $data_target_bg12[$i]['november']; 
			$total_target_bg12[11] += $data_target_bg12[$i]['desember'];
			$total_target_bg12[12] += $data_target_bg12[$i]['total'];
		}
		for($i = 0; $i < sizeof($data_realisasi_bg12); $i++) {
			$total_realisasi_bg12[0] += $data_realisasi_bg12[$i]['januari']; 
			$total_realisasi_bg12[1] += $data_realisasi_bg12[$i]['februari']; 
			$total_realisasi_bg12[2] += $data_realisasi_bg12[$i]['maret']; 
			$total_realisasi_bg12[3] += $data_realisasi_bg12[$i]['april']; 
			$total_realisasi_bg12[4] += $data_realisasi_bg12[$i]['mei']; 
			$total_realisasi_bg12[5] += $data_realisasi_bg12[$i]['juni']; 
			$total_realisasi_bg12[6] += $data_realisasi_bg12[$i]['juli']; 
			$total_realisasi_bg12[7] += $data_realisasi_bg12[$i]['agustus']; 
			$total_realisasi_bg12[8] += $data_realisasi_bg12[$i]['september']; 
			$total_realisasi_bg12[9] += $data_realisasi_bg12[$i]['oktober']; 
			$total_realisasi_bg12[10] += $data_realisasi_bg12[$i]['november']; 
			$total_realisasi_bg12[11] += $data_realisasi_bg12[$i]['desember']; 
			$total_realisasi_bg12[12] += $data_realisasi_bg12[$i]['total']; 
		}
		$data_target_bg12_chart = array();
		$data_realisasi_bg12_chart = array();
		for($i = 0; $i < 12; $i++) {
			$data_target_bg12_chart[] = $total_target_bg12[$i];
			$data_realisasi_bg12_chart[] = $total_realisasi_bg12[$i];
		}
		$data['data_target_bg12_chart'] = json_encode($data_target_bg12_chart);
		$data['data_realisasi_bg12_chart'] = json_encode($data_realisasi_bg12_chart);
		//Prev Year
		$data['thn_kemarin_bg12'] = $data['tahun_bg12_chart'] - 1;
		$data_realisasi_bg12_kemarin = $this->bg12model->selectRealisasiTahun($data['thn_kemarin_bg12']);
		$total_realisasi_bg12_thn_kemarin = 0;
		for($i = 0; $i < sizeof($data_realisasi_bg12_kemarin); $i++) {
			$total_realisasi_bg12_thn_kemarin += $data_realisasi_bg12_kemarin[$i]['total'];
		}
		$data['total_target_bg12'] = $total_target_bg12[12];
		$data['total_realisasi_bg12'] = $total_realisasi_bg12[12];
		$data['total_realisasi_bg12_kemarin'] = $total_realisasi_bg12_thn_kemarin;
		/********** End of Bright Gas 12 Kg Chart **********/

		$this->load->view('/layouts/menu', $data);
		$this->load->view('/layouts/home', $data);
		$this->load->view('/layouts/footer', $data);
	}
}

?>
