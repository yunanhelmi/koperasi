<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class SimpananwajibCon extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->model('usermodel');
		$this->load->model('nasabahmodel');
		$this->load->model('simpananwajibmodel');
		$this->load->model('detailsimpananwajibmodel');
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
		$data['simpananwajib'] = $this->simpananwajibmodel->showData();
		$this->load->view('/layouts/menu', $data);
		$this->load->view('/simpananwajib/index', $data);
		$this->load->view('/layouts/footer', $data);
	}

	function create_simpananwajib() {
		$session_data = $this->session->userdata('logged_in');
		if($session_data == NULL) {
			redirect("usercon/login", "refresh");
		}
		$data['username'] = $session_data['username'];
		$data['status'] = $session_data['status'];
		$data['nasabah'] = $this->nasabahmodel->showData();
		$this->load->view('/layouts/menu', $data);
		$this->load->view('/simpananwajib/create_simpananwajib', $data);
		$this->load->view('/layouts/footer', $data);
	}

	function pickNasabah() {
		$nasabah = $this->nasabahmodel->get_nasabah_by_id($this->input->post('id_nasabah'));

		echo $nasabah->nama. '||'.$nasabah->nik. '||'.$nasabah->nomor_nasabah;
	}

	function insert_simpananwajib() {
		$session_data = $this->session->userdata('logged_in');
		if($session_data == NULL) {
			redirect("usercon/login", "refresh");
		}
		$data 					= array();
		$data['id'] 			= $this->simpananwajibmodel->getNewId();
		$data['id_nasabah'] 	= $this->input->post('id_nasabah');
		$data['nama_nasabah'] 	= $this->input->post('nama_nasabah');
		$data['nomor_nasabah'] 	= $this->input->post('nomor_nasabah');
		$data['nik_nasabah'] 	= $this->input->post('nik_nasabah');
		$date1 					= $this->input->post('tanggal');
		$date 					= strtotime($date1);
		$data['waktu'] 			= date("Y-m-d",$date);
		$data['total'] = 0;
		$this->simpananwajibmodel->inputData($data);
		redirect('simpananwajibcon/view_simpananwajib/'.$data['id']);
	}

	function edit_simpananwajib($id) {
		$session_data = $this->session->userdata('logged_in');
		if($session_data == NULL) {
			redirect("usercon/login", "refresh");
		}
		$data['simpananwajib'] 	= $this->simpananwajibmodel->get_simpananwajib_by_id($id);
		$data['username'] 		= $session_data['username'];
		$data['status'] 		= $session_data['status'];
		$data['nasabah'] 		= $this->nasabahmodel->showData();
		$this->load->view('/layouts/menu', $data);
		$this->load->view('/simpananwajib/edit_simpananwajib', $data);
		$this->load->view('/layouts/footer', $data);
	}

	function update_simpananwajib() {
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
		$this->simpananwajibmodel->updateData($id, $data);
		redirect('simpananwajibcon');
	}

	function view_simpananwajib($id_simpananwajib) {
		$session_data = $this->session->userdata('logged_in');
		if($session_data == NULL) {
			redirect("usercon/login", "refresh");
		}
		$data 							= array();
		$data['simpananwajib'] 			= $this->simpananwajibmodel->get_simpananwajib_by_id($id_simpananwajib);
		$data['username'] 				= $session_data['username'];
		$data['status'] 				= $session_data['status'];
		$data['nasabah'] 				= $this->nasabahmodel->showData();
		$data['detail_simpananwajib'] 	= $this->detailsimpananwajibmodel->get_detail_simpananwajib_by_id_simpananwajib($id_simpananwajib);

		$this->load->view('/layouts/menu', $data);
		$this->load->view('/simpananwajib/view_simpananwajib', $data);
		$this->load->view('/layouts/footer', $data);
	}

	function delete_simpananwajib($id) {
		$session_data = $this->session->userdata('logged_in');
		if($session_data == NULL) {
			redirect("usercon/login", "refresh");
		}
		$this->simpananwajibmodel->deleteData($id);
		$this->detailsimpananwajibmodel->delete_by_id_simpananwajib($id);

		redirect('simpananwajibcon');
	}

	function insert_detail_simpananwajib() {
		$session_data = $this->session->userdata('logged_in');
		if($session_data == NULL) {
			redirect("usercon/login", "refresh");
		}

		$date1 						= $this->input->post('waktu');
		$date 						= strtotime($date1);
		$input 						= array();
		$input['waktu'] 			= date("Y-m-d",$date);
		$input['id_simpananwajib']	= $this->input->post('id_simpananwajib');
		$input['bulan_tahun']		= $this->input->post('bulan_tahun');
		$input['jenis']				= $this->input->post('jjenis');
		$input['jumlah']			= $this->input->post('jumlah');
		$this->detailsimpananwajibmodel->inputData($input);

		$id_simpananwajib 		= $input['id_simpananwajib'];
		$data['simpananwajib'] = $this->simpananwajibmodel->get_simpananwajib_by_id($id_simpananwajib);

		if($input['jenis'] == 'Setoran') {
			$total 	= $data['simpananwajib']->total;
			$total	= $total + $input['jumlah'];
			$this->simpananwajibmodel->update_total($id_simpananwajib, $total);
		} else if($input['jenis'] == 'Tarikan') {
			$total 	= $data['simpananwajib']->total;
			$total	= $total - $input['jumlah'];
			$this->simpananwajibmodel->update_total($id_simpananwajib, $total);
		}

		redirect("simpananwajibcon/view_simpananwajib/".$id_simpananwajib);
	}

	function edit_detail_simpananwajib($id_simpananwajib, $id_detail_simpananwajib) {
		$session_data = $this->session->userdata('logged_in');
		if($session_data == NULL) {
			redirect("usercon/login", "refresh");
		}

		// Get Simpanan Wajib Sesuai dengan id_simpananwajib
		$update = $this->simpananwajibmodel->get_simpananwajib_by_id($id_simpananwajib);
		// Get Detail Simpanan Wajib Sesuai dengan id_detail_simpananwajib
		$prev 	= $this->detailsimpananwajibmodel->get_detail_simpananwajib_by_id($id_detail_simpananwajib);

		if($prev->jenis == 'Setoran') {
			$total 	= $update->total - $prev->jumlah;
			$this->simpananwajibmodel->update_total($id_simpananwajib, $total);
		} else if($prev->jenis == 'Tarikan') {
			$total 	= $update->total + $prev->jumlah;
			$this->simpananwajibmodel->update_total($id_simpananwajib, $total);
		}

		$data['simpananwajib'] 				= $this->simpananwajibmodel->get_simpananwajib_by_id($id_simpananwajib);
		$data['username'] 					= $session_data['username'];
		$data['status'] 					= $session_data['status'];
		$data['nasabah'] 					= $this->nasabahmodel->showData();
		$data['detail_simpananwajib'] 		= $this->detailsimpananwajibmodel->get_detail_simpananwajib_by_id_simpananwajib($id_simpananwajib);
		$data['edit_detail_simpananwajib'] 	= $this->detailsimpananwajibmodel->get_detail_simpananwajib_by_id($id_detail_simpananwajib);

		$this->load->view('/layouts/menu', $data);
		$this->load->view('/simpananwajib/view_simpananwajib_edit_detail', $data);
		$this->load->view('/layouts/footer', $data);
	}

	function update_detail_simpananwajib() {
		$session_data = $this->session->userdata('logged_in');
		if($session_data == NULL) {
			redirect("usercon/login", "refresh");
		}

		$id 						= $this->input->post('edit_id');
		$date1 						= $this->input->post('edit_waktu');
		$date 						= strtotime($date1);
		$input 						= array();
		$input['waktu'] 			= date("Y-m-d",$date);
		$input['id_simpananwajib'] 	= $this->input->post('edit_id_simpananwajib');
		$input['jenis'] 		= $this->input->post('edit_jenis');
		$input['bulan_tahun'] 		= $this->input->post('edit_bulan_tahun');
		$input['jumlah'] 			= $this->input->post('edit_jumlah');
		$this->detailsimpananwajibmodel->updateData($id, $input);

		$id_simpananwajib = $this->input->post('edit_id_simpananwajib');
		$data['simpananwajib'] = $this->simpananwajibmodel->get_simpananwajib_by_id($id_simpananwajib);

		if($update['jenis'] == 'Setoran') {
			$total = $data['simpananwajib']->total + $update['jumlah'];
			$this->simpananwajibmodel->update_total($id_simpananwajib, $total);
		} else if($update['jenis'] == 'Tarikan') {
			$total = $data['simpananwajib']->total - $update['jumlah'];
			$this->simpananwajibmodel->update_total($id_simpananwajib, $total);
		}

		redirect("simpananwajibcon/view_simpananwajib/".$id_simpananwajib);
	}

	function delete_detail_simpananwajib($id_simpananwajib, $id_detail_simpananwajib) {
		$session_data = $this->session->userdata('logged_in');
		if($session_data == NULL) {
			redirect("usercon/login", "refresh");
		}

		// Get Simpanan Wajib Sesuai dengan id_simpananwajib
		$update = $this->simpananwajibmodel->get_simpananwajib_by_id($id_simpananwajib);
		// Get Detail Simpanan Wajib Sesuai dengan id_detail_simpananwajib
		$prev 	= $this->detailsimpananwajibmodel->get_detail_simpananwajib_by_id($id_detail_simpananwajib);

		if($prev->jenis == 'Setoran') {
			$total 	= $update->total - $prev->jumlah;
			$this->simpananwajibmodel->update_total($id_simpananwajib, $total);
		} else if($prev->jenis == 'Tarikan') {
			$total 	= $update->total + $prev->jumlah;
			$this->simpananwajibmodel->update_total($id_simpananwajib, $total);
		}

		$this->detailsimpananwajibmodel->deleteData($id_detail_simpananwajib);
		
		redirect("simpananwajibcon/view_simpananwajib/".$id_simpananwajib);
	}
}

?>
