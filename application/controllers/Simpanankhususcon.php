<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class SimpanankhususCon extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->model('usermodel');
		$this->load->model('nasabahmodel');
		$this->load->model('simpanankhususmodel');
		$this->load->model('detailsimpanankhususmodel');
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
		$data['simpanankhusus'] = $this->simpanankhususmodel->showData();
		$this->load->view('/layouts/menu', $data);
		$this->load->view('/simpanankhusus/index', $data);
		$this->load->view('/layouts/footer', $data);
	}

	function create_simpanankhusus() {
		$session_data = $this->session->userdata('mubasyirin_logged_in');
		if($session_data == NULL) {
			redirect("usercon/login", "refresh");
		}
		$data['username'] = $session_data['username'];
		$data['status'] = $session_data['status'];
		$data['nasabah'] = $this->nasabahmodel->showData();
		$this->load->view('/layouts/menu', $data);
		$this->load->view('/simpanankhusus/create_simpanankhusus', $data);
		$this->load->view('/layouts/footer', $data);
	}

	function pickNasabah() {
		$nasabah = $this->nasabahmodel->get_nasabah_by_id($this->input->post('id_nasabah'));

		echo $nasabah->nama. '||'.$nasabah->nik. '||'.$nasabah->nomor_nasabah;
	}

	function insert_simpanankhusus() {
		$session_data = $this->session->userdata('mubasyirin_logged_in');
		if($session_data == NULL) {
			redirect("usercon/login", "refresh");
		}
		$data = array();
		$data['id'] = $this->simpanankhususmodel->getNewId();
		$data['id_nasabah'] = $this->input->post('id_nasabah');
		$data['nama_nasabah'] = $this->input->post('nama_nasabah');
		$data['nomor_nasabah'] = $this->input->post('nomor_nasabah');
		$data['nik_nasabah'] = $this->input->post('nik_nasabah');
		$date1 = $this->input->post('tanggal');
		$date = strtotime($date1);
		$data['waktu'] = date("Y-m-d",$date);
		$data['total'] = 0;
		$this->simpanankhususmodel->inputData($data);
		redirect('simpanankhususcon/view_simpanankhusus/'.$data['id']);
	}

	function edit_simpanankhusus($id) {
		$session_data = $this->session->userdata('mubasyirin_logged_in');
		if($session_data == NULL) {
			redirect("usercon/login", "refresh");
		}
		$data['simpanankhusus'] 	= $this->simpanankhususmodel->get_simpanankhusus_by_id($id);
		$data['username'] 		= $session_data['username'];
		$data['status'] 		= $session_data['status'];
		$data['nasabah'] 		= $this->nasabahmodel->showData();
		$this->load->view('/layouts/menu', $data);
		$this->load->view('/simpanankhusus/edit_simpanankhusus', $data);
		$this->load->view('/layouts/footer', $data);
	}

	function update_simpanankhusus() {
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
		$this->simpanankhususmodel->updateData($id, $data);
		redirect('simpanankhususcon');
	}

	function view_simpanankhusus($id_simpanankhusus) {
		$session_data = $this->session->userdata('mubasyirin_logged_in');
		if($session_data == NULL) {
			redirect("usercon/login", "refresh");
		}
		$data 							= array();
		$data['simpanankhusus'] 			= $this->simpanankhususmodel->get_simpanankhusus_by_id($id_simpanankhusus);
		$data['username'] 				= $session_data['username'];
		$data['status'] 				= $session_data['status'];
		$data['nasabah'] 				= $this->nasabahmodel->showData();
		$data['detail_simpanankhusus'] 	= $this->detailsimpanankhususmodel->get_detail_simpanankhusus_by_id_simpanankhusus($id_simpanankhusus);

		$this->load->view('/layouts/menu', $data);
		$this->load->view('/simpanankhusus/view_simpanankhusus', $data);
		$this->load->view('/layouts/footer', $data);
	}

	function delete_simpanankhusus($id) {
		$session_data = $this->session->userdata('mubasyirin_logged_in');
		if($session_data == NULL) {
			redirect("usercon/login", "refresh");
		}
		$this->simpanankhususmodel->deleteData($id);
		$this->detailsimpanankhususmodel->delete_by_id_simpanankhusus($id);

		redirect('simpanankhususcon');
	}

	function insert_detail_simpanankhusus() {
		$session_data = $this->session->userdata('mubasyirin_logged_in');
		if($session_data == NULL) {
			redirect("usercon/login", "refresh");
		}

		$date1 						= $this->input->post('waktu');
		$date 						= strtotime($date1);
		$input 						= array();
		$input['waktu'] 			= date("Y-m-d",$date);
		$input['id_simpanankhusus']	= $this->input->post('id_simpanankhusus');
		$input['jumlah']			= $this->input->post('jumlah');
		$this->detailsimpanankhususmodel->inputData($input);

		$id_simpanankhusus = $this->input->post('id_simpanankhusus');
		$data['simpanankhusus'] = $this->simpanankhususmodel->get_simpanankhusus_by_id($id_simpanankhusus);

		if($input['jenis'] == 'Setoran') {
			$total 	= $data['simpanankhusus']->total;
			$total	= $total + $input['jumlah'];
			$this->simpanankhususmodel->update_total($id_simpanankhusus, $total);
		} else if($input['jenis'] == 'Tarikan') {
			$total 	= $data['simpanankhusus']->total;
			$total	= $total - $input['jumlah'];
			$this->simpanankhususmodel->update_total($id_simpanankhusus, $total);
		}

		redirect("simpanankhususcon/view_simpanankhusus/".$id_simpanankhusus);
	}

	function edit_detail_simpanankhusus($id_simpanankhusus, $id_detail_simpanankhusus) {
		$session_data = $this->session->userdata('mubasyirin_logged_in');
		if($session_data == NULL) {
			redirect("usercon/login", "refresh");
		}

		// Get Simpanan Khusus Sesuai dengan id_simpanankhusus
		$update = $this->simpanankhususmodel->get_simpanankhusus_by_id($id_simpanankhusus);
		// Get Detail Simpanan Khusus Sesuai dengan id_detail_simpanankhusus
		$prev 	= $this->detailsimpanankhususmodel->get_detail_simpanankhusus_by_id($id_detail_simpanankhusus);

		if($prev->jenis == 'Setoran') {
			$total 	= $update->total - $prev->jumlah;
			$this->simpanankhususmodel->update_total($id_simpanankhusus, $total);
		} else if($prev->jenis == 'Tarikan') {
			$total 	= $update->total + $prev->jumlah;
			$this->simpanankhususmodel->update_total($id_simpanankhusus, $total);
		}

		$data['simpanankhusus'] 			= $this->simpanankhususmodel->get_simpanankhusus_by_id($id_simpanankhusus);
		$data['username'] 					= $session_data['username'];
		$data['status'] 					= $session_data['status'];
		$data['nasabah'] 					= $this->nasabahmodel->showData();
		$data['detail_simpanankhusus'] 		= $this->detailsimpanankhususmodel->get_detail_simpanankhusus_by_id_simpanankhusus($id_simpanankhusus);
		$data['edit_detail_simpanankhusus'] 	= $this->detailsimpanankhususmodel->get_detail_simpanankhusus_by_id($id_detail_simpanankhusus);

		$this->load->view('/layouts/menu', $data);
		$this->load->view('/simpanankhusus/view_simpanankhusus_edit_detail', $data);
		$this->load->view('/layouts/footer', $data);
	}

	function update_detail_simpanankhusus() {
		$session_data = $this->session->userdata('mubasyirin_logged_in');
		if($session_data == NULL) {
			redirect("usercon/login", "refresh");
		}

		$id 						= $this->input->post('edit_id');
		$date1 						= $this->input->post('edit_waktu');
		$date 						= strtotime($date1);
		$input 						= array();
		$input['waktu'] 			= date("Y-m-d",$date);
		$input['id_simpanankhusus'] 	= $this->input->post('edit_id_simpanankhusus');
		$input['jumlah'] 			= $this->input->post('edit_jumlah');
		$this->detailsimpanankhususmodel->updateData($id, $input);

		$id_simpanankhusus = $this->input->post('edit_id_simpanankhusus');
		$data['simpanankhusus'] = $this->simpanankhususmodel->get_simpanankhusus_by_id($id_simpanankhusus);

		if($update['jenis'] == 'Setoran') {
			$total = $data['simpanankhusus']->total + $update['jumlah'];
			$this->simpanankhususmodel->update_total($id_simpanankhusus, $total);
		} else if($update['jenis'] == 'Tarikan') {
			$total = $data['simpanankhusus']->total - $update['jumlah'];
			$this->simpanankhususmodel->update_total($id_simpanankhusus, $total);
		}

		redirect("simpanankhususcon/view_simpanankhusus/".$id_simpanankhusus);
	}

	function delete_detail_simpanankhusus($id_simpanankhusus, $id_detail_simpanankhusus) {
		$session_data = $this->session->userdata('mubasyirin_logged_in');
		if($session_data == NULL) {
			redirect("usercon/login", "refresh");
		}

		// Get Simpanan Khusus Sesuai dengan id_simpanankhusus
		$update = $this->simpanankhususmodel->get_simpanankhusus_by_id($id_simpanankhusus);
		// Get Detail Simpanan Khusus Sesuai dengan id_detail_simpanankhusus
		$prev 	= $this->detailsimpanankhususmodel->get_detail_simpanankhusus_by_id($id_detail_simpanankhusus);

		if($prev->jenis == 'Setoran') {
			$total 	= $update->total - $prev->jumlah;
			$this->simpanankhususmodel->update_total($id_simpanankhusus, $total);
		} else if($prev->jenis == 'Tarikan') {
			$total 	= $update->total + $prev->jumlah;
			$this->simpanankhususmodel->update_total($id_simpanankhusus, $total);
		}

		$this->detailsimpanankhususmodel->deleteData($id_detail_simpanankhusus);
		
		redirect("simpanankhususcon/view_simpanankhusus/".$id_simpanankhusus);
	}
}

?>
