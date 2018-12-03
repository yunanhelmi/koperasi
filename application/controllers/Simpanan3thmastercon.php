<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Simpanan3thMastercon extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->model('usermodel');
		$this->load->model('nasabahmodel');
		$this->load->model('simpanan3thmastermodel');
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
		$data['username'] = $session_data['username'];
		$data['status'] = $session_data['status'];
		$data['nasabah'] = $this->nasabahmodel->showData();
		$data['simpanan3thmaster'] = $this->simpanan3thmastermodel->showData();
		$this->load->view('/layouts/menu', $data);
		$this->load->view('/simpanan3thmaster/index', $data);
		$this->load->view('/layouts/footer', $data);
	}

	function create_simpanan3thmaster() {
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

		$data['username'] = $session_data['username'];
		$data['status'] = $session_data['status'];

		$this->load->view('/layouts/menu', $data);
		$this->load->view('/simpanan3thmaster/create_simpanan3thmaster', $data);
		$this->load->view('/layouts/footer', $data);
	}

	function insert_simpanan3thmaster() {
		$session_data = $this->session->userdata('logged_in');
		if($session_data == NULL) {
			redirect("usercon/login", "refresh");
		}

		$data = array();
		$data['id'] 								= $this->simpanan3thmastermodel->getNewId();
		$data['nama'] 								= $this->input->post('nama');
		$data['kode_debet_penerimaan_simp']			= $this->input->post('kode_debet_penerimaan_simp');
		$data['kode_kredit_penerimaan_simp']		= $this->input->post('kode_kredit_penerimaan_simp');
		$data['kode_debet_pencairan_simp'] 			= $this->input->post('kode_debet_pencairan_simp');
		$data['kode_kredit_pencairan_simp']			= $this->input->post('kode_kredit_pencairan_simp');
		$data['kode_debet_pencairan_hutang_jasa']	= $this->input->post('kode_debet_pencairan_hutang_jasa');
		$data['kode_kredit_pencairan_hutang_jasa']	= $this->input->post('kode_kredit_pencairan_hutang_jasa');
		$data['kode_debet_pembayaran_jasa']			= $this->input->post('kode_debet_pembayaran_jasa');
		$data['kode_kredit_pembayaran_jasa'] 		= $this->input->post('kode_kredit_pembayaran_jasa');
		$data['kode_debet_penyesuaian_jasa'] 		= $this->input->post('kode_debet_penyesuaian_jasa');
		$data['kode_kredit_penyesuaian_jasa'] 		= $this->input->post('kode_kredit_penyesuaian_jasa');

		$this->simpanan3thmastermodel->inputData($data);
		redirect('simpanan3thmastercon');
	}

	function edit_simpanan3thmaster($id) {
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

		$data['simpanan3thmaster'] 	= $this->simpanan3thmastermodel->get_simpanan3th_master_by_id($id);
		$data['username'] 			= $session_data['username'];
		$data['status'] 			= $session_data['status'];

		$this->load->view('/layouts/menu', $data);
		$this->load->view('/simpanan3thmaster/edit_simpanan3thmaster', $data);
		$this->load->view('/layouts/footer', $data);
	}

	function update_simpanan3thmaster() {
		$session_data = $this->session->userdata('logged_in');
		if($session_data == NULL) {
			redirect("usercon/login", "refresh");
		}

		$data = array();
		$id 										= $this->input->post('id');
		$data['nama'] 								= $this->input->post('nama');
		$data['kode_debet_penerimaan_simp']			= $this->input->post('kode_debet_penerimaan_simp');
		$data['kode_kredit_penerimaan_simp']		= $this->input->post('kode_kredit_penerimaan_simp');
		$data['kode_debet_pencairan_simp'] 			= $this->input->post('kode_debet_pencairan_simp');
		$data['kode_kredit_pencairan_simp']			= $this->input->post('kode_kredit_pencairan_simp');
		$data['kode_debet_pencairan_hutang_jasa']	= $this->input->post('kode_debet_pencairan_hutang_jasa');
		$data['kode_kredit_pencairan_hutang_jasa']	= $this->input->post('kode_kredit_pencairan_hutang_jasa');
		$data['kode_debet_pembayaran_jasa']			= $this->input->post('kode_debet_pembayaran_jasa');
		$data['kode_kredit_pembayaran_jasa'] 		= $this->input->post('kode_kredit_pembayaran_jasa');
		$data['kode_debet_penyesuaian_jasa'] 		= $this->input->post('kode_debet_penyesuaian_jasa');
		$data['kode_kredit_penyesuaian_jasa'] 		= $this->input->post('kode_kredit_penyesuaian_jasa');

		$this->simpanan3thmastermodel->updateData($id, $data);
		redirect('simpanan3thmastercon');
	}

	function view_simpanan3thmaster($id) {
		$session_data = $this->session->userdata('logged_in');
		if($session_data == NULL) {
			redirect("usercon/login", "refresh");
		}
		$data 							= array();
		$data['simpanan3thmaster'] 		= $this->simpanan3thmastermodel->get_simpanan3th_master_by_id($id);
		$data['username'] 				= $session_data['username'];
		$data['status'] 				= $session_data['status'];

		$this->load->view('/layouts/menu', $data);
		$this->load->view('/simpanan3thmaster/view_simpanan3thmaster', $data);
		$this->load->view('/layouts/footer', $data);
	}
	
	function delete_simpanan3thmaster($id) {
		$session_data = $this->session->userdata('logged_in');
		if($session_data == NULL) {
			redirect("usercon/login", "refresh");
		}

		$this->simpanan3thmastermodel->deleteData($id);
		redirect('simpanan3thmastercon');
	}

	function view_transaksi($id) {
		
	}
}

?>