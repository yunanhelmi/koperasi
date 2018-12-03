<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class TransaksiAkuntansiCon extends CI_Controller {
	function __construct() {
		parent::__construct();

		$this->load->model('usermodel');
		$this->load->model('nasabahmodel');
		$this->load->model('transaksiakuntansimodel');
		$this->load->model('kodeakunmodel');

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
		$data['transaksi_akuntansi'] 	= $this->transaksiakuntansimodel->showData();
		$this->load->view('/layouts/menu', $data);
		$this->load->view('/transaksi_akuntansi/index', $data);
		$this->load->view('/layouts/footer', $data);
	}

	function create_transaksi_akuntansi() {
		$session_data = $this->session->userdata('logged_in');
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
		$data['kode_akun']		= $temp;

		$data['username'] 		= $session_data['username'];
		$data['status'] 		= $session_data['status'];
		$this->load->view('/layouts/menu', $data);
		$this->load->view('/transaksi_akuntansi/create_transaksi_akuntansi', $data);
		$this->load->view('/layouts/footer', $data);
	}

	function insert_transaksi_akuntansi() {
		$session_data = $this->session->userdata('logged_in');
		if($session_data == NULL) {
			redirect("usercon/login", "refresh");
		}

		$data = array();
		$data['id'] 		= $this->transaksiakuntansimodel->getNewId();
		$date1 				= $this->input->post('tanggal');
		$date 				= strtotime($date1);
		$data['tanggal'] 	= date("Y-m-d",$date);
		$data['kode_akun'] 	= $this->input->post('kode_akun');
		$data['nama_akun'] 	= $this->input->post('nama_akun');
		$data['keterangan'] = $this->input->post('keterangan');
		$data['debet'] 		= $this->input->post('debet');
		$data['kredit']	 	= $this->input->post('kredit');
		if($data['debet'] == NULL || $data['debet'] == 0 || $data['debet'] == "0" || $data['debet'] == "") {
			$data['jumlah']	 	= $this->input->post('kredit');
		} else if($data['kredit'] == NULL || $data['kredit'] == 0 || $data['kredit'] == "0" || $data['kredit'] == "") {
			$data['jumlah']	 	= $this->input->post('debet');
		}
		
		$this->transaksiakuntansimodel->inputData($data);
		redirect('transaksiakuntansicon');
	}

	function edit_transaksi_akuntansi($id) {
		$session_data = $this->session->userdata('logged_in');
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
		$data['kode_akun']		= $temp;
		
		$data['transaksi_akuntansi'] 	= $this->transaksiakuntansimodel->get_transaksi_akuntansi_by_id($id);
		$data['username'] 	= $session_data['username'];
		$data['status'] 	= $session_data['status'];

		$this->load->view('/layouts/menu', $data);
		$this->load->view('/transaksi_akuntansi/edit_transaksi_akuntansi', $data);
		$this->load->view('/layouts/footer', $data);
	}

	function update_transaksi_akuntansi() {
		$session_data = $this->session->userdata('logged_in');
		if($session_data == NULL) {
			redirect("usercon/login", "refresh");
		}

		$id = $this->input->post('id');
		$data = array();
		$date1 				= $this->input->post('tanggal');
		$date 				= strtotime($date1);
		$data['tanggal'] 	= date("Y-m-d",$date);
		$data['kode_akun'] 	= $this->input->post('kode_akun');
		$data['nama_akun'] 	= $this->input->post('nama_akun');
		$data['keterangan'] = $this->input->post('keterangan');
		$data['debet'] 		= $this->input->post('debet');
		$data['kredit']	 	= $this->input->post('kredit');
		if($data['debet'] == NULL || $data['debet'] == 0 || $data['debet'] == "0" || $data['debet'] == "") {
			$data['jumlah']	 	= $this->input->post('kredit');
		} else if($data['kredit'] == NULL || $data['kredit'] == 0 || $data['kredit'] == "0" || $data['kredit'] == "") {
			$data['jumlah']	 	= $this->input->post('debet');
		}

		$this->transaksiakuntansimodel->updateData($id, $data);
		redirect('transaksiakuntansicon');
	}

	function view_transaksi_akuntansi($id) {
		$session_data = $this->session->userdata('logged_in');
		if($session_data == NULL) {
			redirect("usercon/login", "refresh");
		}
		$data['transaksi_akuntansi'] 	= $this->transaksiakuntansimodel->get_transaksi_akuntansi_by_id($id);
		$data['username'] 	= $session_data['username'];
		$data['status'] 	= $session_data['status'];

		$this->load->view('/layouts/menu', $data);
		$this->load->view('/transaksi_akuntansi/view_transaksi_akuntansi', $data);
		$this->load->view('/layouts/footer', $data);
	}

	function delete_transaksi_akuntansi($id) {
		$session_data = $this->session->userdata('logged_in');
		if($session_data == NULL) {
			redirect("usercon/login", "refresh");
		}

		$this->transaksiakuntansimodel->deleteData($id);
		redirect('transaksiakuntansicon');
	}
}

?>