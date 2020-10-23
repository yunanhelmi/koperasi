<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class SimpananpihakketigaCon extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->model('usermodel');
		$this->load->model('nasabahmodel');
		$this->load->model('simpananpihakketigamodel');
		$this->load->model('detailsimpananpihakketigamodel');
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
		$data['simpananpihakketiga'] = $this->simpananpihakketigamodel->showData();
		$this->load->view('/layouts/menu', $data);
		$this->load->view('/simpananpihakketiga/index', $data);
		$this->load->view('/layouts/footer', $data);
	}

	function create_simpananpihakketiga() {
		$session_data = $this->session->userdata('logged_in');
		if($session_data == NULL) {
			redirect("usercon/login", "refresh");
		}
		$data['username'] = $session_data['username'];
		$data['status'] = $session_data['status'];
		$data['nasabah'] = $this->nasabahmodel->showData();
		$this->load->view('/layouts/menu', $data);
		$this->load->view('/simpananpihakketiga/create_simpananpihakketiga', $data);
		$this->load->view('/layouts/footer', $data);
	}

	function pickNasabah() {
		$nasabah = $this->nasabahmodel->get_nasabah_by_id($this->input->post('id_nasabah'));

		echo $nasabah->nama. '||'.$nasabah->nik. '||'.$nasabah->nomor_nasabah;
	}

	function insert_simpananpihakketiga() {
		$session_data = $this->session->userdata('logged_in');
		if($session_data == NULL) {
			redirect("usercon/login", "refresh");
		}
		$data = array();
		$data['id'] 			= $this->simpananpihakketigamodel->getNewId();
		$data['nama'] 			= $this->input->post('nama');
		$data['nik'] 			= $this->input->post('nik');
		$data['telpon'] 		= $this->input->post('telpon');
		$data['pekerjaan'] 		= $this->input->post('pekerjaan');
		$data['alamat'] 		= $this->input->post('alamat');
		$data['kota'] 			= $this->input->post('kota');
		$data['kecamatan'] 		= $this->input->post('kecamatan');
		$data['kelurahan'] 		= $this->input->post('kelurahan');
		$data['dusun'] 			= $this->input->post('dusun');
		$data['rt'] 			= $this->input->post('rt');
		$data['rw'] 			= $this->input->post('rw');
		$date1 					= $this->input->post('tanggal');
		$date 					= strtotime($date1);
		$data['waktu'] 			= date("Y-m-d",$date);
		$data['total'] 			= 0;
		$this->simpananpihakketigamodel->inputData($data);
		redirect('simpananpihakketigacon/view_simpananpihakketiga/'.$data['id']);
	}

	function edit_simpananpihakketiga($id) {
		$session_data = $this->session->userdata('logged_in');
		if($session_data == NULL) {
			redirect("usercon/login", "refresh");
		}
		$data['simpananpihakketiga'] 	= $this->simpananpihakketigamodel->get_simpananpihakketiga_by_id($id);
		$data['username'] 				= $session_data['username'];
		$data['status'] 				= $session_data['status'];
		$data['nasabah'] 				= $this->nasabahmodel->showData();
		$this->load->view('/layouts/menu', $data);
		$this->load->view('/simpananpihakketiga/edit_simpananpihakketiga', $data);
		$this->load->view('/layouts/footer', $data);
	}

	function update_simpananpihakketiga() {
		$session_data = $this->session->userdata('logged_in');
		if($session_data == NULL) {
			redirect("usercon/login", "refresh");
		}
		$data = array();
		$id 					= $this->input->post('id');
		$data['nama'] 			= $this->input->post('nama');
		$data['nik'] 			= $this->input->post('nik');
		$data['telpon'] 		= $this->input->post('telpon');
		$data['pekerjaan'] 		= $this->input->post('pekerjaan');
		$data['alamat'] 		= $this->input->post('alamat');
		$data['kota'] 			= $this->input->post('kota');
		$data['kecamatan'] 		= $this->input->post('kecamatan');
		$data['kelurahan'] 		= $this->input->post('kelurahan');
		$data['dusun'] 			= $this->input->post('dusun');
		$data['rt'] 			= $this->input->post('rt');
		$data['rw'] 			= $this->input->post('rw');
		$date1 					= $this->input->post('tanggal');
		$date 					= strtotime($date1);
		$data['waktu'] 			= date("Y-m-d",$date);
		$data['total'] 			= $this->input->post('total');
		$this->simpananpihakketigamodel->updateData($id, $data);
		redirect('simpananpihakketigacon');
	}

	function view_simpananpihakketiga($id_simpananpihakketiga) {
		$session_data = $this->session->userdata('logged_in');
		if($session_data == NULL) {
			redirect("usercon/login", "refresh");
		}
		$data 								= array();
		$data['simpananpihakketiga'] 		= $this->simpananpihakketigamodel->get_simpananpihakketiga_by_id($id_simpananpihakketiga);
		$data['username'] 					= $session_data['username'];
		$data['status'] 					= $session_data['status'];
		$data['nasabah'] 					= $this->nasabahmodel->showData();
		$data['detail_simpananpihakketiga'] = $this->detailsimpananpihakketigamodel->get_detail_simpananpihakketiga_by_id_simpananpihakketiga($id_simpananpihakketiga);

		$this->load->view('/layouts/menu', $data);
		$this->load->view('/simpananpihakketiga/view_simpananpihakketiga', $data);
		$this->load->view('/layouts/footer', $data);
	}

	function delete_simpananpihakketiga($id) {
		$session_data = $this->session->userdata('logged_in');
		if($session_data == NULL) {
			redirect("usercon/login", "refresh");
		}
		$this->simpananpihakketigamodel->deleteData($id);
		$this->detailsimpananpihakketigamodel->delete_by_id_simpananpihakketiga($id);

		redirect('simpananpihakketigacon');
	}

	function insert_detail_simpananpihakketiga() {
		$session_data = $this->session->userdata('logged_in');
		if($session_data == NULL) {
			redirect("usercon/login", "refresh");
		}

		$date1 						= $this->input->post('waktu');
		$date 						= strtotime($date1);
		$input 						= array();
		$input['waktu'] 			= date("Y-m-d",$date);
		$input['id_simpananpihakketiga']	= $this->input->post('id_simpananpihakketiga');
		$input['jumlah']			= $this->input->post('jumlah');
		$this->detailsimpananpihakketigamodel->inputData($input);

		$id_simpananpihakketiga 		= $input['id_simpananpihakketiga'];
		$data 							= array();
		$data['simpananpihakketiga'] 	= $this->simpananpihakketigamodel->get_simpananpihakketiga_by_id($id_simpananpihakketiga);
		$total 							= $data['simpananpihakketiga']->total;
		$total 							= $total + $input['jumlah'];
		$this->simpananpihakketigamodel->update_total($id_simpananpihakketiga, $total);

		redirect("simpananpihakketigacon/view_simpananpihakketiga/".$id_simpananpihakketiga);
	}

	function edit_detail_simpananpihakketiga($id_simpananpihakketiga, $id_detail_simpananpihakketiga) {
		$session_data = $this->session->userdata('logged_in');
		if($session_data == NULL) {
			redirect("usercon/login", "refresh");
		}

		$update = $this->simpananpihakketigamodel->get_simpananpihakketiga_by_id($id_simpananpihakketiga);
		$prev 	= $this->detailsimpananpihakketigamodel->get_detail_simpananpihakketiga_by_id($id_detail_simpananpihakketiga);
		$total 	= $update->total - $prev->jumlah;
		$this->simpananpihakketigamodel->update_total($id_simpananpihakketiga, $total);

		$data['simpananpihakketiga'] 			= $this->simpananpihakketigamodel->get_simpananpihakketiga_by_id($id_simpananpihakketiga);
		$data['username'] 					= $session_data['username'];
		$data['status'] 					= $session_data['status'];
		$data['nasabah'] 					= $this->nasabahmodel->showData();
		$data['detail_simpananpihakketiga'] 		= $this->detailsimpananpihakketigamodel->get_detail_simpananpihakketiga_by_id_simpananpihakketiga($id_simpananpihakketiga);
		$data['edit_detail_simpananpihakketiga'] 	= $this->detailsimpananpihakketigamodel->get_detail_simpananpihakketiga_by_id($id_detail_simpananpihakketiga);

		$this->load->view('/layouts/menu', $data);
		$this->load->view('/simpananpihakketiga/view_simpananpihakketiga_edit_detail', $data);
		$this->load->view('/layouts/footer', $data);
	}

	function update_detail_simpananpihakketiga() {
		$session_data = $this->session->userdata('logged_in');
		if($session_data == NULL) {
			redirect("usercon/login", "refresh");
		}

		$id 						= $this->input->post('edit_id');
		$date1 						= $this->input->post('edit_waktu');
		$date 						= strtotime($date1);
		$input 						= array();
		$input['waktu'] 			= date("Y-m-d",$date);
		$input['id_simpananpihakketiga'] 	= $this->input->post('edit_id_simpananpihakketiga');
		$input['jumlah'] 			= $this->input->post('edit_jumlah');
		$this->detailsimpananpihakketigamodel->updateData($id, $input);

		$id_simpananpihakketiga = $this->input->post('edit_id_simpananpihakketiga');

		$update = $this->simpananpihakketigamodel->get_simpananpihakketiga_by_id($id_simpananpihakketiga);
		$total = $update->total + $input['jumlah'];
		$this->simpananpihakketigamodel->update_total($id_simpananpihakketiga, $total);

		redirect("simpananpihakketigacon/view_simpananpihakketiga/".$id_simpananpihakketiga);
	}

	function delete_detail_simpananpihakketiga($id_simpananpihakketiga, $id_detail_simpananpihakketiga) {
		$session_data = $this->session->userdata('logged_in');
		if($session_data == NULL) {
			redirect("usercon/login", "refresh");
		}

		$update = $this->simpananpihakketigamodel->get_simpananpihakketiga_by_id($id_simpananpihakketiga);
		$detail = $this->detailsimpananpihakketigamodel->get_detail_simpananpihakketiga_by_id($id_detail_simpananpihakketiga);
		$total 	= $update->total - $detail->jumlah;
		$this->simpananpihakketigamodel->update_total($id_simpananpihakketiga, $total);

		$this->detailsimpananpihakketigamodel->deleteData($id_detail_simpananpihakketiga);
		
		redirect("simpananpihakketigacon/view_simpananpihakketiga/".$id_simpananpihakketiga);
	}
}

?>
