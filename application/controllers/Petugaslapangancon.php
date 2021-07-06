<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class PetugaslapanganCon extends CI_Controller {
	function __construct() {
		parent::__construct();

		$this->load->model('usermodel');
		$this->load->model('nasabahmodel');
		$this->load->model('petugaslapanganmodel');

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
		$data['data'] 		= $this->petugaslapanganmodel->showData();
		$this->load->view('/layouts/menu', $data);
		$this->load->view('/petugas_lapangan/index', $data);
		$this->load->view('/layouts/footer', $data);
	}

	function create_petugas_lapangan() {
		$session_data = $this->session->userdata('mubasyirin_logged_in');
		if($session_data == NULL) {
			redirect("usercon/login", "refresh");
		}
		$data['username'] 		= $session_data['username'];
		$data['status'] 		= $session_data['status'];
		$this->load->view('/layouts/menu', $data);
		$this->load->view('/petugas_lapangan/create_petugas_lapangan', $data);
		$this->load->view('/layouts/footer', $data);
	}

	function insert_petugas_lapangan() {
		$session_data = $this->session->userdata('mubasyirin_logged_in');
		if($session_data == NULL) {
			redirect("usercon/login", "refresh");
		}
		$data = array();
		$data['id'] 			= $this->petugaslapanganmodel->getNewId();
		$data['nama'] 			= $this->input->post('nama');
		$data['nik'] 			= $this->input->post('nik');
		$date1 					= $this->input->post('tgl_lahir');
		$date 					= strtotime($date1);
		$data['tgl_lahir'] 		= date("Y-m-d",$date);

		$this->petugaslapanganmodel->inputData($data);
		redirect('petugaslapangancon');
	}

	function edit_petugas_lapangan($id) {
		$session_data = $this->session->userdata('mubasyirin_logged_in');
		if($session_data == NULL) {
			redirect("usercon/login", "refresh");
		}
		$data['data'] 		= $this->petugaslapanganmodel->get_data_by_id($id);
		$data['username'] 	= $session_data['username'];
		$data['status'] 	= $session_data['status'];
		/*echo "<pre>";
		var_dump($data['nasabah']);
		echo "</pre>";*/
		$this->load->view('/layouts/menu', $data);
		$this->load->view('/petugas_lapangan/edit_petugas_lapangan', $data);
		$this->load->view('/layouts/footer', $data);
	}

	function update_petugas_lapangan() {
		$session_data = $this->session->userdata('mubasyirin_logged_in');
		if($session_data == NULL) {
			redirect("usercon/login", "refresh");
		}

		$id 				= $this->input->post('id');
		$data 				= array();
		$data['nama'] 		= $this->input->post('nama');
		$data['nik'] 		= $this->input->post('nik');
		$date1 				= $this->input->post('tgl_lahir');
		$date 				= strtotime($date1);
		$data['tgl_lahir'] 	= date("Y-m-d",$date);

		$this->petugaslapanganmodel->updateData($id, $data);
		redirect('petugaslapangancon');
	}

	function delete_petugas_lapangan($id) {
		$session_data = $this->session->userdata('mubasyirin_logged_in');
		if($session_data == NULL) {
			redirect("usercon/login", "refresh");
		}
		$this->petugaslapanganmodel->deleteData($id);
		redirect('petugaslapangancon');		
	}
}

?>