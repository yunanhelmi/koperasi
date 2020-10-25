<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class SimpanankanzunCon extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->model('usermodel');
		$this->load->model('nasabahmodel');
		$this->load->model('simpanankanzunmodel');
		$this->load->model('detailsimpanankanzunmodel');
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
		$data['username'] = $session_data['username'];
		$data['status'] = $session_data['status'];
		$data['nasabah'] = $this->nasabahmodel->showData();
		$data['simpanankanzun'] = $this->simpanankanzunmodel->showData();
		$this->load->view('/layouts/menu', $data);
		$this->load->view('/simpanankanzun/index', $data);
		$this->load->view('/layouts/footer', $data);
	}

	function create_simpanankanzun() {
		$session_data = $this->session->userdata('mubasyirin_logged_in');
		if($session_data == NULL) {
			redirect("usercon/login", "refresh");
		}
		$data['username'] = $session_data['username'];
		$data['status'] = $session_data['status'];
		$data['nasabah'] = $this->nasabahmodel->showData();
		$this->load->view('/layouts/menu', $data);
		$this->load->view('/simpanankanzun/create_simpanankanzun', $data);
		$this->load->view('/layouts/footer', $data);
	}

	function pickNasabah() {
		$nasabah = $this->nasabahmodel->get_nasabah_by_id($this->input->post('id_nasabah'));

		echo $nasabah->nama. '||'.$nasabah->nik. '||'.$nasabah->nomor_nasabah;
	}

	function insert_simpanankanzun() {
		$session_data = $this->session->userdata('mubasyirin_logged_in');
		if($session_data == NULL) {
			redirect("usercon/login", "refresh");
		}
		$data = array();
		$data['id'] = $this->simpanankanzunmodel->getNewId();
		$data['id_nasabah'] = $this->input->post('id_nasabah');
		$data['nama_nasabah'] = $this->input->post('nama_nasabah');
		$data['nomor_nasabah'] = $this->input->post('nomor_nasabah');
		$data['nik_nasabah'] = $this->input->post('nik_nasabah');
		$date1 = $this->input->post('tanggal');
		$date = strtotime($date1);
		$data['waktu'] = date("Y-m-d",$date);
		$data['total'] = 0;
		$this->simpanankanzunmodel->inputData($data);
		redirect('simpanankanzuncon/view_simpanankanzun/'.$data['id']);
	}

	function edit_simpanankanzun($id) {
		$session_data = $this->session->userdata('mubasyirin_logged_in');
		if($session_data == NULL) {
			redirect("usercon/login", "refresh");
		}
		$data['simpanankanzun'] 	= $this->simpanankanzunmodel->get_simpanankanzun_by_id($id);
		$data['username'] 		= $session_data['username'];
		$data['status'] 		= $session_data['status'];
		$data['nasabah'] 		= $this->nasabahmodel->showData();
		$this->load->view('/layouts/menu', $data);
		$this->load->view('/simpanankanzun/edit_simpanankanzun', $data);
		$this->load->view('/layouts/footer', $data);
	}

	function update_simpanankanzun() {
		$session_data = $this->session->userdata('mubasyirin_logged_in');
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
		$tanggal 				= date("Y-m-d",$date);
		$waktu 					= $tanggal." 00:00:00";
		$data['waktu'] 			= $waktu;
		$data['total'] 			= $this->input->post('total');
		$this->simpanankanzunmodel->updateData($id, $data);
		redirect('simpanankanzuncon');
	}

	function view_simpanankanzun($id_simpanankanzun) {
		$session_data = $this->session->userdata('mubasyirin_logged_in');
		if($session_data == NULL) {
			redirect("usercon/login", "refresh");
		}
		$data 							= array();
		$data['simpanankanzun'] 			= $this->simpanankanzunmodel->get_simpanankanzun_by_id($id_simpanankanzun);
		$data['username'] 				= $session_data['username'];
		$data['status'] 				= $session_data['status'];
		$data['nasabah'] 				= $this->nasabahmodel->showData();
		$data['detail_simpanankanzun'] 	= $this->detailsimpanankanzunmodel->get_detail_simpanankanzun_by_id_simpanankanzun($id_simpanankanzun);

		$this->load->view('/layouts/menu', $data);
		$this->load->view('/simpanankanzun/view_simpanankanzun', $data);
		$this->load->view('/layouts/footer', $data);
	}

	function delete_simpanankanzun($id) {
		$session_data = $this->session->userdata('mubasyirin_logged_in');
		if($session_data == NULL) {
			redirect("usercon/login", "refresh");
		}
		$this->simpanankanzunmodel->deleteData($id);
		$this->detailsimpanankanzunmodel->delete_by_id_simpanankanzun($id);

		redirect('simpanankanzuncon');
	}

	function insert_detail_simpanankanzun() {
		$session_data = $this->session->userdata('mubasyirin_logged_in');
		if($session_data == NULL) {
			redirect("usercon/login", "refresh");
		}

		$date1 						= $this->input->post('waktu');
		$date 						= strtotime($date1);
		$input 						= array();
		$input['waktu'] 			= date("Y-m-d",$date);
		$input['id_simpanankanzun']	= $this->input->post('id_simpanankanzun');
		$input['jenis']			= $this->input->post('jenis');
		$input['jumlah']			= $this->input->post('jumlah');
		$this->detailsimpanankanzunmodel->inputData($input);

		$id_simpanankanzun = $this->input->post('id_simpanankanzun');
		$data['simpanankanzun'] = $this->simpanankanzunmodel->get_simpanankanzun_by_id($id_simpanankanzun);

		if($input['jenis'] == 'Setoran') {
			$total 	= $data['simpanankanzun']->total;
			$total	= $total + $input['jumlah'];
			$this->simpanankanzunmodel->update_total($id_simpanankanzun, $total);
		} else if($input['jenis'] == 'Tarikan') {
			$total 	= $data['simpanankanzun']->total;
			$total	= $total - $input['jumlah'];
			$this->simpanankanzunmodel->update_total($id_simpanankanzun, $total);
		}

		redirect("simpanankanzuncon/view_simpanankanzun/".$id_simpanankanzun);
	}

	function edit_detail_simpanankanzun($id_simpanankanzun, $id_detail_simpanankanzun) {
		$session_data = $this->session->userdata('mubasyirin_logged_in');
		if($session_data == NULL) {
			redirect("usercon/login", "refresh");
		}

		// Get Simpanan Kanzun Sesuai dengan id_simpanankanzun
		$update = $this->simpanankanzunmodel->get_simpanankanzun_by_id($id_simpanankanzun);
		// Get Detail Simpanan Kanzun Sesuai dengan id_detail_simpanankanzun
		$prev 	= $this->detailsimpanankanzunmodel->get_detail_simpanankanzun_by_id($id_detail_simpanankanzun);

		if($prev->jenis == 'Setoran') {
			$total 	= $update->total - $prev->jumlah;
			$this->simpanankanzunmodel->update_total($id_simpanankanzun, $total);
		} else if($prev->jenis == 'Tarikan') {
			$total 	= $update->total + $prev->jumlah;
			$this->simpanankanzunmodel->update_total($id_simpanankanzun, $total);
		}

		$data['simpanankanzun'] 			= $this->simpanankanzunmodel->get_simpanankanzun_by_id($id_simpanankanzun);
		$data['username'] 					= $session_data['username'];
		$data['status'] 					= $session_data['status'];
		$data['nasabah'] 					= $this->nasabahmodel->showData();
		$data['detail_simpanankanzun'] 		= $this->detailsimpanankanzunmodel->get_detail_simpanankanzun_by_id_simpanankanzun($id_simpanankanzun);
		$data['edit_detail_simpanankanzun'] 	= $this->detailsimpanankanzunmodel->get_detail_simpanankanzun_by_id($id_detail_simpanankanzun);

		$this->load->view('/layouts/menu', $data);
		$this->load->view('/simpanankanzun/view_simpanankanzun_edit_detail', $data);
		$this->load->view('/layouts/footer', $data);
	}

	function update_detail_simpanankanzun() {
		$session_data = $this->session->userdata('mubasyirin_logged_in');
		if($session_data == NULL) {
			redirect("usercon/login", "refresh");
		}

		$id 						= $this->input->post('edit_id');
		$date1 						= $this->input->post('edit_waktu');
		$date 						= strtotime($date1);
		$input 						= array();
		$input['waktu'] 			= date("Y-m-d",$date);
		$input['id_simpanankanzun'] = $this->input->post('edit_id_simpanankanzun');
		$input['jenis'] 			= $this->input->post('edit_jenis');
		$input['jumlah'] 			= $this->input->post('edit_jumlah');
		$this->detailsimpanankanzunmodel->updateData($id, $input);

		$id_simpanankanzun = $this->input->post('edit_id_simpanankanzun');
		$data['simpanankanzun'] = $this->simpanankanzunmodel->get_simpanankanzun_by_id($id_simpanankanzun);

		if($update['jenis'] == 'Setoran') {
			$total = $data['simpanankanzun']->total + $update['jumlah'];
			$this->simpanankanzunmodel->update_total($id_simpanankanzun, $total);
		} else if($update['jenis'] == 'Tarikan') {
			$total = $data['simpanankanzun']->total - $update['jumlah'];
			$this->simpanankanzunmodel->update_total($id_simpanankanzun, $total);
		}

		redirect("simpanankanzuncon/view_simpanankanzun/".$id_simpanankanzun);
	}

	function delete_detail_simpanankanzun($id_simpanankanzun, $id_detail_simpanankanzun) {
		$session_data = $this->session->userdata('mubasyirin_logged_in');
		if($session_data == NULL) {
			redirect("usercon/login", "refresh");
		}

		// Get Simpanan Kanzun Sesuai dengan id_simpanankanzun
		$update = $this->simpanankanzunmodel->get_simpanankanzun_by_id($id_simpanankanzun);
		// Get Detail Simpanan Kanzun Sesuai dengan id_detail_simpanankanzun
		$prev 	= $this->detailsimpanankanzunmodel->get_detail_simpanankanzun_by_id($id_detail_simpanankanzun);

		if($prev->jenis == 'Setoran') {
			$total 	= $update->total - $prev->jumlah;
			$this->simpanankanzunmodel->update_total($id_simpanankanzun, $total);
		} else if($prev->jenis == 'Tarikan') {
			$total 	= $update->total + $prev->jumlah;
			$this->simpanankanzunmodel->update_total($id_simpanankanzun, $total);
		}

		$this->detailsimpanankanzunmodel->deleteData($id_detail_simpanankanzun);
		
		redirect("simpanankanzuncon/view_simpanankanzun/".$id_simpanankanzun);
	}
}

?>
