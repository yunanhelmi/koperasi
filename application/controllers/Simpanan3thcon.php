<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Simpanan3thcon extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->model('usermodel');
		$this->load->model('nasabahmodel');
		$this->load->model('simpanan3thmodel');
		$this->load->model('detailsimpanan3thmodel');
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
		$data['simpanan3th'] = $this->simpanan3thmodel->showData();
		$this->load->view('/layouts/menu', $data);
		$this->load->view('/simpanan3th/index', $data);
		$this->load->view('/layouts/footer', $data);
	}

	function create_simpanan3th() {
		$session_data = $this->session->userdata('logged_in');
		if($session_data == NULL) {
			redirect("usercon/login", "refresh");
		}
		$data['username'] = $session_data['username'];
		$data['status'] = $session_data['status'];
		$data['nasabah'] = $this->nasabahmodel->showData();
		$this->load->view('/layouts/menu', $data);
		$this->load->view('/simpanan3th/create_simpanan3th', $data);
		$this->load->view('/layouts/footer', $data);
	}

	function pickNasabah() {
		$nasabah = $this->nasabahmodel->get_nasabah_by_id($this->input->post('id_nasabah'));

		echo $nasabah->nama. '||'.$nasabah->nik. '||'.$nasabah->nomor_nasabah;
	}

	function insert_simpanan3th() {
		$session_data = $this->session->userdata('logged_in');
		if($session_data == NULL) {
			redirect("usercon/login", "refresh");
		}
		$data = array();
		$data['id'] = $this->simpanan3thmodel->getNewId();
		$data['id_nasabah'] = $this->input->post('id_nasabah');
		$data['nama_nasabah'] = $this->input->post('nama_nasabah');
		$data['nomor_nasabah'] = $this->input->post('nomor_nasabah');
		$data['nik_nasabah'] = $this->input->post('nik_nasabah');
		$data['simpanan_ke'] = $this->input->post('simpanan_ke');
		$date1 = $this->input->post('tanggal');
		$date = strtotime($date1);
		$data['waktu'] = date("Y-m-d",$date);
		$data['total'] = 0;
		$this->simpanan3thmodel->inputData($data);
		redirect('simpanan3thcon/view_simpanan3th/'.$data['id']);
	}

	function edit_simpanan3th($id) {
		$session_data = $this->session->userdata('logged_in');
		if($session_data == NULL) {
			redirect("usercon/login", "refresh");
		}
		$data['simpanan3th'] 	= $this->simpanan3thmodel->get_simpanan3th_by_id($id);
		$data['username'] 		= $session_data['username'];
		$data['status'] 		= $session_data['status'];
		$data['nasabah'] 		= $this->nasabahmodel->showData();
		$this->load->view('/layouts/menu', $data);
		$this->load->view('/simpanan3th/edit_simpanan3th', $data);
		$this->load->view('/layouts/footer', $data);
	}

	function update_simpanan3th() {
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
		$data['simpanan_ke'] 	= $this->input->post('simpanan_ke');
		$date1 					= $this->input->post('tanggal');
		$date 					= strtotime($date1);
		$tanggal 				= date("Y-m-d",$date);
		$waktu 					= $tanggal." 00:00:00";
		$data['waktu'] 			= $waktu;
		$data['total'] 			= $this->input->post('total');
		$this->simpanan3thmodel->updateData($id, $data);
		redirect('simpanan3thcon');
	}

	function view_simpanan3th($id_simpanan3th) {
		$session_data = $this->session->userdata('logged_in');
		if($session_data == NULL) {
			redirect("usercon/login", "refresh");
		}
		$data 							= array();
		$data['simpanan3th'] 			= $this->simpanan3thmodel->get_simpanan3th_by_id($id_simpanan3th);
		$data['username'] 				= $session_data['username'];
		$data['status'] 				= $session_data['status'];
		$data['nasabah'] 				= $this->nasabahmodel->showData();
		$data['detail_simpanan3th'] 	= $this->detailsimpanan3thmodel->get_detail_simpanan3th_by_id_simpanan3th($id_simpanan3th);

		$this->load->view('/layouts/menu', $data);
		$this->load->view('/simpanan3th/view_simpanan3th', $data);
		$this->load->view('/layouts/footer', $data);
	}

	function delete_simpanan3th($id) {
		$session_data = $this->session->userdata('logged_in');
		if($session_data == NULL) {
			redirect("usercon/login", "refresh");
		}
		$this->simpanan3thmodel->deleteData($id);
		$this->detailsimpanan3thmodel->delete_by_id_simpanan3th($id);

		redirect('simpanan3thcon');
	}

	function insert_detail_simpanan3th() {
		$session_data = $this->session->userdata('logged_in');
		if($session_data == NULL) {
			redirect("usercon/login", "refresh");
		}

		$date1 						= $this->input->post('waktu');
		$date 						= strtotime($date1);
		$input 						= array();
		$input['waktu'] 			= date("Y-m-d",$date);
		$input['id_simpanan3th']	= $this->input->post('id_simpanan3th');
		$input['jumlah']			= $this->input->post('jumlah');
		$this->detailsimpanan3thmodel->inputData($input);

		$id_simpanan3th = $this->input->post('id_simpanan3th');
		$data['simpanan3th'] = $this->simpanan3thmodel->get_simpanan3th_by_id($id_simpanan3th);

		if($input['jenis'] == 'Setoran') {
			$total 	= $data['simpanan3th']->total;
			$total	= $total + $input['jumlah'];
			$this->simpanan3thmodel->update_total($id_simpanan3th, $total);
		} else if($input['jenis'] == 'Tarikan') {
			$total 	= $data['simpanan3th']->total;
			$total	= $total - $input['jumlah'];
			$this->simpanan3thmodel->update_total($id_simpanan3th, $total);
		}

		redirect("simpanan3thcon/view_simpanan3th/".$id_simpanan3th);
	}

	function edit_detail_simpanan3th($id_simpanan3th, $id_detail_simpanan3th) {
		$session_data = $this->session->userdata('logged_in');
		if($session_data == NULL) {
			redirect("usercon/login", "refresh");
		}

		// Get Simpanan 3 Th Sesuai dengan id_simpanan3th
		$update = $this->simpanan3thmodel->get_simpanan3th_by_id($id_simpanan3th);
		// Get Detail Simpanan 3 Th Sesuai dengan id_detail_simpanan3th
		$prev 	= $this->detailsimpanan3thmodel->get_detail_simpanan3th_by_id($id_detail_simpanan3th);

		if($prev->jenis == 'Setoran') {
			$total 	= $update->total - $prev->jumlah;
			$this->simpanan3thmodel->update_total($id_simpanan3th, $total);
		} else if($prev->jenis == 'Tarikan') {
			$total 	= $update->total + $prev->jumlah;
			$this->simpanan3thmodel->update_total($id_simpanan3th, $total);
		}

		$data['simpanan3th'] 			= $this->simpanan3thmodel->get_simpanan3th_by_id($id_simpanan3th);
		$data['username'] 					= $session_data['username'];
		$data['status'] 					= $session_data['status'];
		$data['nasabah'] 					= $this->nasabahmodel->showData();
		$data['detail_simpanan3th'] 		= $this->detailsimpanan3thmodel->get_detail_simpanan3th_by_id_simpanan3th($id_simpanan3th);
		$data['edit_detail_simpanan3th'] 	= $this->detailsimpanan3thmodel->get_detail_simpanan3th_by_id($id_detail_simpanan3th);

		$this->load->view('/layouts/menu', $data);
		$this->load->view('/simpanan3th/view_simpanan3th_edit_detail', $data);
		$this->load->view('/layouts/footer', $data);
	}

	function update_detail_simpanan3th() {
		$session_data = $this->session->userdata('logged_in');
		if($session_data == NULL) {
			redirect("usercon/login", "refresh");
		}

		$id 						= $this->input->post('edit_id');
		$date1 						= $this->input->post('edit_waktu');
		$date 						= strtotime($date1);
		$input 						= array();
		$input['waktu'] 			= date("Y-m-d",$date);
		$input['id_simpanan3th'] 	= $this->input->post('edit_id_simpanan3th');
		$input['jumlah'] 			= $this->input->post('edit_jumlah');
		$this->detailsimpanan3thmodel->updateData($id, $input);

		$id_simpanan3th = $this->input->post('edit_id_simpanan3th');
		$data['simpanan3th'] = $this->simpanan3thmodel->get_simpanan3th_by_id($id_simpanan3th);

		if($update['jenis'] == 'Setoran') {
			$total = $data['simpanan3th']->total + $update['jumlah'];
			$this->simpanan3thmodel->update_total($id_simpanan3th, $total);
		} else if($update['jenis'] == 'Tarikan') {
			$total = $data['simpanan3th']->total - $update['jumlah'];
			$this->simpanan3thmodel->update_total($id_simpanan3th, $total);
		}

		redirect("simpanan3thcon/view_simpanan3th/".$id_simpanan3th);
	}

	function delete_detail_simpanan3th($id_simpanan3th, $id_detail_simpanan3th) {
		$session_data = $this->session->userdata('logged_in');
		if($session_data == NULL) {
			redirect("usercon/login", "refresh");
		}

		// Get Simpanan 3 Th Sesuai dengan id_simpanan3th
		$update = $this->simpanan3thmodel->get_simpanan3th_by_id($id_simpanan3th);
		// Get Detail Simpanan 3 Th Sesuai dengan id_detail_simpanan3th
		$prev 	= $this->detailsimpanan3thmodel->get_detail_simpanan3th_by_id($id_detail_simpanan3th);

		if($prev->jenis == 'Setoran') {
			$total 	= $update->total - $prev->jumlah;
			$this->simpanan3thmodel->update_total($id_simpanan3th, $total);
		} else if($prev->jenis == 'Tarikan') {
			$total 	= $update->total + $prev->jumlah;
			$this->simpanan3thmodel->update_total($id_simpanan3th, $total);
		}

		$this->detailsimpanan3thmodel->deleteData($id_detail_simpanan3th);
		
		redirect("simpanan3thcon/view_simpanan3th/".$id_simpanan3th);
	}
}

?>