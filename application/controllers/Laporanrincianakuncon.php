<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class LaporanrincianakunCon extends CI_Controller {
	function __construct() {
		parent::__construct();

		$this->load->model('usermodel');
		$this->load->model('nasabahmodel');
		$this->load->model('mappingkodeakunmodel');
		$this->load->model('kodeakunmodel');
		$this->load->model('transaksiakuntansimodel');
		$this->load->model('laporanrincianakunmodel');
		$this->load->model('kodeakunmodel');

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

		$kode_akun = $this->kodeakunmodel->showData();
		$temp = '';
		foreach ($kode_akun as $kode) {
			$temp = $temp.'{"stateCode": "'.$kode["nama_akun"].'", "stateDisplay": "'.$kode["kode_akun"].'", "stateName": "'.$kode["kode_akun"].' | '.$kode["nama_akun"].'"},';
		}
		$temp=substr_replace($temp ,"",-1);
		$temp=trim(preg_replace('/\s+/', ' ', $temp));
		
		$data['kode_akun']	= $temp;
		$data['username'] 	= $session_data['username'];
		$data['status'] 	= $session_data['status'];
		$data['nasabah'] 	= $this->nasabahmodel->showData();
		
		$this->load->view('/layouts/menu', $data);
		$this->load->view('/laporan/rincian_akun', $data);
		$this->load->view('/layouts/footer', $data);	
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

		$kode_akun = $this->input->post('kode_akun');
		$nama_akun = $this->input->post('nama_akun');
		$prefix = substr($kode_akun, 0, 1);

		if($prefix == '1' || $prefix == '2' || $prefix == '3') {
			if($dari < '2019-01-01' && $sampai < '2019-01-01') {
				$transaksi_prev	= $this->laporanrincianakunmodel->get_jumlah_by_sampai_kode_akun($dari, $kode_akun);
				
				$transaksi 		= $this->laporanrincianakunmodel->get_transaksi_by_dari_sampai_kode_akun($dari, $sampai, $kode_akun);
			} else if($dari == '2019-01-01' && $sampai >= '2019-01-01') {
				$transaksi_prev	= $this->laporanrincianakunmodel->get_saldo_awal_by_sampai_kode_akun($sampai, $kode_akun);

				$transaksi 		= $this->laporanrincianakunmodel->get_transaksi_by_dari_sampai_kode_akun_except_saldo_awal($dari, $sampai, $kode_akun);
			} else if($dari > '2019-01-01' && $sampai >= '2019-01-01') {
				$transaksi_prev	= $this->laporanrincianakunmodel->get_saldo_awal_by_sampai_kode_akun($sampai, $kode_akun);

				$transaksi 		= $this->laporanrincianakunmodel->get_transaksi_by_dari_sampai_kode_akun_except_saldo_awal('2019-01-01', $sampai, $kode_akun);
			}
		} else {
			$transaksi_prev = array();
			$transaksi 	= $this->laporanrincianakunmodel->get_transaksi_by_dari_sampai_kode_akun($dari, $sampai, $kode_akun);
		}

		/*echo "<pre>";
        var_dump($transaksi_prev);
        echo "</pre>";*/

		$saldo_awal = 0;
		if($prefix == '1') {
			if($kode_akun == '105') {
				$saldo_awal += ($transaksi_prev[0]['jumlah_kredit'] - $transaksi_prev[0]['jumlah_debet']);
			} else {
				$saldo_awal += ($transaksi_prev[0]['jumlah_debet'] - $transaksi_prev[0]['jumlah_kredit']);
			}
		} else if($prefix == '2' || $prefix == '3') {
			$saldo_awal += ($transaksi_prev[0]['jumlah_kredit'] - $transaksi_prev[0]['jumlah_debet']);
		}

		$data['dari'] 				= $dari;
        $data['sampai'] 			= $sampai;
        $data['prefix']				= $prefix;
        $data['kode_akun'] 			= $kode_akun;
        $data['nama_akun'] 			= $nama_akun;
        $data['transaksi_prev'] 	= $transaksi_prev;
        $data['saldo_awal']			= $saldo_awal;
        $data['transaksi'] 			= $transaksi;

        $this->load->view('/hasil_laporan/rincian_akun', $data);
	}
}

?>