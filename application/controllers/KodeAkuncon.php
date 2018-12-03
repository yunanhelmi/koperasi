<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class KodeAkunCon extends CI_Controller {
	function __construct() {
		parent::__construct();

		$this->load->model('usermodel');
		$this->load->model('nasabahmodel');
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
		$data['kode_akun'] 	= $this->kodeakunmodel->showData();
		$this->load->view('/layouts/menu', $data);
		$this->load->view('/kode_akun/index', $data);
		$this->load->view('/layouts/footer', $data);
	}

	function create_kode_akun() {
		$session_data = $this->session->userdata('logged_in');
		if($session_data == NULL) {
			redirect("usercon/login", "refresh");
		}

		$data['username'] 		= $session_data['username'];
		$data['status'] 		= $session_data['status'];
		$this->load->view('/layouts/menu', $data);
		$this->load->view('/kode_akun/create_kode_akun', $data);
		$this->load->view('/layouts/footer', $data);
	}

	function insert_kode_akun() {
		$session_data = $this->session->userdata('logged_in');
		if($session_data == NULL) {
			redirect("usercon/login", "refresh");
		}

		$data = array();
		$data['id'] 		= $this->kodeakunmodel->getNewId();
		$data['kode_akun'] 	= $this->input->post('kode_akun');
		$data['nama_akun'] 	= $this->input->post('nama_akun');
		$data['keterangan'] = $this->input->post('keterangan');

		$this->kodeakunmodel->inputData($data);
		redirect('kodeakuncon');
	}

	function edit_kode_akun($id) {
		$session_data = $this->session->userdata('logged_in');
		if($session_data == NULL) {
			redirect("usercon/login", "refresh");
		}

		$data['kode_akun'] 	= $this->kodeakunmodel->get_kode_akun_by_id($id);
		$data['username'] 	= $session_data['username'];
		$data['status'] 	= $session_data['status'];

		$this->load->view('/layouts/menu', $data);
		$this->load->view('/kode_akun/edit_kode_akun', $data);
		$this->load->view('/layouts/footer', $data);
	}

	function update_kode_akun() {
		$session_data = $this->session->userdata('logged_in');
		if($session_data == NULL) {
			redirect("usercon/login", "refresh");
		}

		$id = $this->input->post('id');
		$data['kode_akun'] 	= $this->input->post('kode_akun');
		$data['nama_akun'] 	= $this->input->post('nama_akun');
		$data['keterangan'] = $this->input->post('keterangan');

		$this->kodeakunmodel->updateData($id, $data);
		redirect('kodeakuncon');
	}

	function delete_kode_akun($id) {
		$session_data = $this->session->userdata('logged_in');
		if($session_data == NULL) {
			redirect("usercon/login", "refresh");
		}

		$this->kodeakunmodel->deleteData($id);
		redirect('kodeakuncon');
	}
}

?>