<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Simpanandanasosialcon extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->model('usermodel');
		$this->load->model('nasabahmodel');
		$this->load->model('simpanandanasosialmodel');
		$this->load->model('detailsimpanandanasosialmodel');
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
		$data['simpanandanasosial'] = $this->simpanandanasosialmodel->showData();
		$this->load->view('/layouts/menu', $data);
		$this->load->view('/simpanandanasosial/index', $data);
		$this->load->view('/layouts/footer', $data);
	}

	function create_simpanandanasosial() {
		$session_data = $this->session->userdata('logged_in');
		if($session_data == NULL) {
			redirect("usercon/login", "refresh");
		}
		$data['username'] = $session_data['username'];
		$data['status'] = $session_data['status'];
		$data['nasabah'] = $this->nasabahmodel->showData();
		$this->load->view('/layouts/menu', $data);
		$this->load->view('/simpanandanasosial/create_simpanandanasosial', $data);
		$this->load->view('/layouts/footer', $data);
	}

	function pickNasabah() {
		$nasabah = $this->nasabahmodel->get_nasabah_by_id($this->input->post('id_nasabah'));

		echo $nasabah->nama. '||'.$nasabah->nik. '||'.$nasabah->nomor_nasabah;
	}

	function insert_simpanandanasosial() {
		$session_data = $this->session->userdata('logged_in');
		if($session_data == NULL) {
			redirect("usercon/login", "refresh");
		}
		$data = array();
		$data['id'] = $this->simpanandanasosialmodel->getNewId();
		$data['id_nasabah'] = $this->input->post('id_nasabah');
		$data['nama_nasabah'] = $this->input->post('nama_nasabah');
		$data['nomor_nasabah'] = $this->input->post('nomor_nasabah');
		$data['nik_nasabah'] = $this->input->post('nik_nasabah');
		$date1 = $this->input->post('tanggal');
		$date = strtotime($date1);
		$data['waktu'] = date("Y-m-d",$date);
		$data['total'] = 0;
		$this->simpanandanasosialmodel->inputData($data);
		redirect('simpanandanasosialcon/view_simpanandanasosial/'.$data['id']);
	}

	function edit_simpanandanasosial($id) {
		$session_data = $this->session->userdata('logged_in');
		if($session_data == NULL) {
			redirect("usercon/login", "refresh");
		}
		$data['simpanandanasosial'] 	= $this->simpanandanasosialmodel->get_simpanandanasosial_by_id($id);
		$data['username'] 		= $session_data['username'];
		$data['status'] 		= $session_data['status'];
		$data['nasabah'] 		= $this->nasabahmodel->showData();
		$this->load->view('/layouts/menu', $data);
		$this->load->view('/simpanandanasosial/edit_simpanandanasosial', $data);
		$this->load->view('/layouts/footer', $data);
	}

	function update_simpanandanasosial() {
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
		$tanggal 				= date("Y-m-d",$date);
		$waktu 					= $tanggal." 00:00:00";
		$data['waktu'] 			= $waktu;
		$data['total'] 			= $this->input->post('total');
		$this->simpanandanasosialmodel->updateData($id, $data);
		redirect('simpanandanasosialcon');
	}

	function view_simpanandanasosial($id_simpanandanasosial) {
		$session_data = $this->session->userdata('logged_in');
		if($session_data == NULL) {
			redirect("usercon/login", "refresh");
		}
		$data 							= array();
		$data['simpanandanasosial'] 			= $this->simpanandanasosialmodel->get_simpanandanasosial_by_id($id_simpanandanasosial);
		$data['username'] 				= $session_data['username'];
		$data['status'] 				= $session_data['status'];
		$data['nasabah'] 				= $this->nasabahmodel->showData();
		$data['detail_simpanandanasosial'] 	= $this->detailsimpanandanasosialmodel->get_detail_simpanandanasosial_by_id_simpanandanasosial($id_simpanandanasosial);

		$this->load->view('/layouts/menu', $data);
		$this->load->view('/simpanandanasosial/view_simpanandanasosial', $data);
		$this->load->view('/layouts/footer', $data);
	}

	function delete_simpanandanasosial($id) {
		$session_data = $this->session->userdata('logged_in');
		if($session_data == NULL) {
			redirect("usercon/login", "refresh");
		}
		$this->simpanandanasosialmodel->deleteData($id);
		$this->detailsimpanandanasosialmodel->delete_by_id_simpanandanasosial($id);

		redirect('simpanandanasosialcon');
	}

	function insert_detail_simpanandanasosial() {
		$session_data = $this->session->userdata('logged_in');
		if($session_data == NULL) {
			redirect("usercon/login", "refresh");
		}

		$date1 						= $this->input->post('waktu');
		$date 						= strtotime($date1);
		$input 						= array();
		$input['waktu'] 			= date("Y-m-d",$date);
		$input['id_simpanandanasosial']	= $this->input->post('id_simpanandanasosial');
		$input['jenis']				= $this->input->post('jenis');
		$input['jumlah']			= $this->input->post('jumlah');
		$this->detailsimpanandanasosialmodel->inputData($input);

		$id_simpanandanasosial = $this->input->post('id_simpanandanasosial');
		$data['simpanandanasosial'] = $this->simpanandanasosialmodel->get_simpanandanasosial_by_id($id_simpanandanasosial);

		if($input['jenis'] == 'Setoran') {
			$total 	= $data['simpanandanasosial']->total;
			$total	= $total + $input['jumlah'];
			$this->simpanandanasosialmodel->update_total($id_simpanandanasosial, $total);
		} else if($input['jenis'] == 'Tarikan') {
			$total 	= $data['simpanandanasosial']->total;
			$total	= $total - $input['jumlah'];
			$this->simpanandanasosialmodel->update_total($id_simpanandanasosial, $total);
		}

		redirect("simpanandanasosialcon/view_simpanandanasosial/".$id_simpanandanasosial);
	}

	function edit_detail_simpanandanasosial($id_simpanandanasosial, $id_detail_simpanandanasosial) {
		$session_data = $this->session->userdata('logged_in');
		if($session_data == NULL) {
			redirect("usercon/login", "refresh");
		}

		// Get Simpanan Dana SOsial Sesuai dengan id_simpanandanasosial
		$update = $this->simpanandanasosialmodel->get_simpanandanasosial_by_id($id_simpanandanasosial);
		// Get Detail Simpanan Dana Sosial Sesuai dengan id_detail_simpanandanasosial
		$prev 	= $this->detailsimpanandanasosialmodel->get_detail_simpanandanasosial_by_id($id_detail_simpanandanasosial);

		if($prev->jenis == 'Setoran') {
			$total 	= $update->total - $prev->jumlah;
			$this->simpanandanasosialmodel->update_total($id_simpanandanasosial, $total);
		} else if($prev->jenis == 'Tarikan') {
			$total 	= $update->total + $prev->jumlah;
			$this->simpanandanasosialmodel->update_total($id_simpanandanasosial, $total);
		}

		$data['simpanandanasosial'] 			= $this->simpanandanasosialmodel->get_simpanandanasosial_by_id($id_simpanandanasosial);
		$data['username'] 					= $session_data['username'];
		$data['status'] 					= $session_data['status'];
		$data['nasabah'] 					= $this->nasabahmodel->showData();
		$data['detail_simpanandanasosial'] 		= $this->detailsimpanandanasosialmodel->get_detail_simpanandanasosial_by_id_simpanandanasosial($id_simpanandanasosial);
		$data['edit_detail_simpanandanasosial'] 	= $this->detailsimpanandanasosialmodel->get_detail_simpanandanasosial_by_id($id_detail_simpanandanasosial);

		$this->load->view('/layouts/menu', $data);
		$this->load->view('/simpanandanasosial/view_simpanandanasosial_edit_detail', $data);
		$this->load->view('/layouts/footer', $data);
	}

	function update_detail_simpanandanasosial() {
		$session_data = $this->session->userdata('logged_in');
		if($session_data == NULL) {
			redirect("usercon/login", "refresh");
		}

		$id 						= $this->input->post('edit_id');
		$date1 						= $this->input->post('edit_waktu');
		$date 						= strtotime($date1);
		$input 						= array();
		$input['waktu'] 			= date("Y-m-d",$date);
		$input['id_simpanandanasosial'] 	= $this->input->post('edit_id_simpanandanasosial');
		$input['jenis'] 			= $this->input->post('edit_jenis');
		$input['jumlah'] 			= $this->input->post('edit_jumlah');
		$this->detailsimpanandanasosialmodel->updateData($id, $input);

		$id_simpanandanasosial = $this->input->post('edit_id_simpanandanasosial');
		$data['simpanandanasosial'] = $this->simpanandanasosialmodel->get_simpanandanasosial_by_id($id_simpanandanasosial);

		if($update['jenis'] == 'Setoran') {
			$total = $data['simpanandanasosial']->total + $update['jumlah'];
			$this->simpanandanasosialmodel->update_total($id_simpanandanasosial, $total);
		} else if($update['jenis'] == 'Tarikan') {
			$total = $data['simpanandanasosial']->total - $update['jumlah'];
			$this->simpanandanasosialmodel->update_total($id_simpanandanasosial, $total);
		}

		redirect("simpanandanasosialcon/view_simpanandanasosial/".$id_simpanandanasosial);
	}

	function delete_detail_simpanandanasosial($id_simpanandanasosial, $id_detail_simpanandanasosial) {
		$session_data = $this->session->userdata('logged_in');
		if($session_data == NULL) {
			redirect("usercon/login", "refresh");
		}

		// Get Simpanan Dana Sosial Sesuai dengan id_simpanandanasosial
		$update = $this->simpanandanasosialmodel->get_simpanandanasosial_by_id($id_simpanandanasosial);
		// Get Detail Simpanan Dana Sosial Sesuai dengan id_detail_simpanandanasosial
		$prev 	= $this->detailsimpanandanasosialmodel->get_detail_simpanandanasosial_by_id($id_detail_simpanandanasosial);

		if($prev->jenis == 'Setoran') {
			$total 	= $update->total - $prev->jumlah;
			$this->simpanandanasosialmodel->update_total($id_simpanandanasosial, $total);
		} else if($prev->jenis == 'Tarikan') {
			$total 	= $update->total + $prev->jumlah;
			$this->simpanandanasosialmodel->update_total($id_simpanandanasosial, $total);
		}

		$this->detailsimpanandanasosialmodel->deleteData($id_detail_simpanandanasosial);
		
		redirect("simpanandanasosialcon/view_simpanandanasosial/".$id_simpanandanasosial);
	}
}

?>