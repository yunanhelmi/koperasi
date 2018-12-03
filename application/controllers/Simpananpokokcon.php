<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Simpananpokokcon extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->model('usermodel');
		$this->load->model('nasabahmodel');
		$this->load->model('simpananpokokmodel');
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
		$data['simpananpokok'] = $this->simpananpokokmodel->showData();
		$this->load->view('/layouts/menu', $data);
		$this->load->view('/simpananpokok/index', $data);
		$this->load->view('/layouts/footer', $data);
	}

	function create_simpananpokok() {
		$session_data = $this->session->userdata('logged_in');
		if($session_data == NULL) {
			redirect("usercon/login", "refresh");
		}
		$data['username'] = $session_data['username'];
		$data['status'] = $session_data['status'];
		$data['nasabah'] = $this->nasabahmodel->showData();
		$this->load->view('/layouts/menu', $data);
		$this->load->view('/simpananpokok/create_simpananpokok', $data);
		$this->load->view('/layouts/footer', $data);
	}

	function pickNasabah() {
		$nasabah = $this->nasabahmodel->get_nasabah_by_id($this->input->post('id_nasabah'));

		echo $nasabah->nama. '||'.$nasabah->nik. '||'.$nasabah->nomor_nasabah;
	}

	function insert_simpananpokok() {
		$session_data = $this->session->userdata('logged_in');
		if($session_data == NULL) {
			redirect("usercon/login", "refresh");
		}
		$data = array();
		$data['id'] = $this->simpananpokokmodel->getNewId();
		$data['id_nasabah'] = $this->input->post('id_nasabah');
		$data['nama_nasabah'] = $this->input->post('nama_nasabah');
		$data['nomor_nasabah'] = $this->input->post('nomor_nasabah');
		$data['nik_nasabah'] = $this->input->post('nik_nasabah');
		$date1 = $this->input->post('tanggal');
		$date = strtotime($date1);
		$data['waktu'] = date("Y-m-d",$date);
		$data['jumlah'] = $this->input->post('jumlah');
		$this->simpananpokokmodel->inputData($data);
		redirect('simpananpokokcon');
	}

	function edit_simpananpokok($id) {
		$session_data = $this->session->userdata('logged_in');
		if($session_data == NULL) {
			redirect("usercon/login", "refresh");
		}
		$data['simpananpokok'] 	= $this->simpananpokokmodel->get_simpananpokok_by_id($id);
		$data['username'] 		= $session_data['username'];
		$data['status'] 		= $session_data['status'];
		$data['nasabah'] 		= $this->nasabahmodel->showData();
		$this->load->view('/layouts/menu', $data);
		$this->load->view('/simpananpokok/edit_simpananpokok', $data);
		$this->load->view('/layouts/footer', $data);
	}

	function update_simpananpokok() {
		$session_data = $this->session->userdata('logged_in');
		if($session_data == NULL) {
			redirect("usercon/login", "refresh");
		}
		$data = array();
		$id 					= $this->input->post('id');
		$data['id_nasabah'] 	= $this->input->post('id_nasabah');
		$data['nama_nasabah'] 	= $this->input->post('nama_nasabah');
		$data['nomor_nasabah'] 	= $this->input->post('nomor_nasabah');
		$data['nik_nasabah'] 	= $this->input->post('nik_nasabah');
		$date1 					= $this->input->post('tanggal');
		$date 					= strtotime($date1);
		$data['waktu'] 			= date("Y-m-d",$date);
		$data['jumlah'] 		= $this->input->post('jumlah');
		$this->simpananpokokmodel->updateData($id, $data);
		redirect('simpananpokokcon');
	}

	function view_simpananpokok($id) {
		$session_data = $this->session->userdata('logged_in');
		if($session_data == NULL) {
			redirect("usercon/login", "refresh");
		}
		$data['simpananpokok'] 	= $this->simpananpokokmodel->get_simpananpokok_by_id($id);
		$data['username'] 		= $session_data['username'];
		$data['status'] 		= $session_data['status'];
		$data['nasabah'] 		= $this->nasabahmodel->showData();
		$this->load->view('/layouts/menu', $data);
		$this->load->view('/simpananpokok/view_simpananpokok', $data);
		$this->load->view('/layouts/footer', $data);
	}

	function delete_simpananpokok($id) {
		$session_data = $this->session->userdata('logged_in');
		if($session_data == NULL) {
			redirect("usercon/login", "refresh");
		}
		$this->simpananpokokmodel->deleteData($id);
		redirect('simpananpokokcon');
	}
}

?>