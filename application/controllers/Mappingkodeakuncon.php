<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MappingkodeakunCon extends CI_Controller {
	function __construct() {
		parent::__construct();

		$this->load->model('usermodel');
		$this->load->model('nasabahmodel');
		$this->load->model('mappingkodeakunmodel');
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
		$data['username'] 	= $session_data['username'];
		$data['status'] 	= $session_data['status'];
		$data['mapping_kode_akun'] 	= $this->mappingkodeakunmodel->showData();
		$this->load->view('/layouts/menu', $data);
		$this->load->view('/mapping_kode_akun/index', $data);
		$this->load->view('/layouts/footer', $data);
	}

	function create_mapping_kode_akun() {
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
		$data['kode_akun']		= $temp;

		$data['username'] 		= $session_data['username'];
		$data['status'] 		= $session_data['status'];

		$this->load->view('/layouts/menu', $data);
		$this->load->view('/mapping_kode_akun/create_mapping_kode_akun', $data);
		$this->load->view('/layouts/footer', $data);
	}

	function insert_mapping_kode_akun() {
		$session_data = $this->session->userdata('mubasyirin_logged_in');
		if($session_data == NULL) {
			redirect("usercon/login", "refresh");
		}

		$data = array();
		$data['id'] 			= $this->mappingkodeakunmodel->getNewId();
		$data['nama_transaksi'] = $this->input->post('nama_transaksi');
		$data['kode_debet'] 	= $this->input->post('kode_debet');
		$data['kode_kredit'] 	= $this->input->post('kode_kredit');

		$this->mappingkodeakunmodel->inputData($data);
		redirect('mappingkodeakuncon');
	}

	function edit_mapping_kode_akun($id) {
		$session_data = $this->session->userdata('mubasyirin_logged_in');
		if($session_data == NULL) {
			redirect("usercon/login", "refresh");
		}

		$kode_akun = $this->kodeakunmodel->showData();
		$temp = '';
		foreach ($kode_akun as $kode) {
			$temp = $temp.'{"stateCode": "'.$kode["id"].'", "stateDisplay": "'.$kode["kode_akun"].'", "stateName": "'.$kode["kode_akun"].' | '.$kode["nama_akun"].'"},';
		}
		$temp=substr_replace($temp ,"",-1);
		$temp=trim(preg_replace('/\s+/', ' ', $temp));
		$data['kode_akun']		= $temp;

		$data['mapping_kode_akun'] 	= $this->mappingkodeakunmodel->get_mapping_kode_akun_by_id($id);
		$data['username'] 	= $session_data['username'];
		$data['status'] 	= $session_data['status'];

		$this->load->view('/layouts/menu', $data);
		$this->load->view('/mapping_kode_akun/edit_mapping_kode_akun', $data);
		$this->load->view('/layouts/footer', $data);
	}

	function update_mapping_kode_akun() {
		$session_data = $this->session->userdata('mubasyirin_logged_in');
		if($session_data == NULL) {
			redirect("usercon/login", "refresh");
		}

		$id = $this->input->post('id');
		$data['nama_transaksi'] = $this->input->post('nama_transaksi');
		$data['kode_debet'] 	= $this->input->post('kode_debet');
		$data['kode_kredit'] 	= $this->input->post('kode_kredit');

		$this->mappingkodeakunmodel->updateData($id, $data);
		redirect('mappingkodeakuncon');
	}

	function delete_mapping_kode_akun($id) {
		$session_data = $this->session->userdata('mubasyirin_logged_in');
		if($session_data == NULL) {
			redirect("usercon/login", "refresh");
		}

		$this->mappingkodeakunmodel->deleteData($id);
		redirect('mappingkodeakuncon');
	}
}

?>
