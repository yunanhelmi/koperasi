<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class TransaksiCon extends CI_Controller {
	function __construct() {
		parent::__construct();

		$this->load->model('usermodel');
		$this->load->model('nasabahmodel');
		$this->load->model('transaksimodel');
		$this->load->model('kodeakunmodel');
		$this->load->model('mappingkodeakunmodel');
		$this->load->model('transaksiakuntansimodel');

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
		$data['transaksi'] 	= $this->transaksimodel->showData();
		$this->load->view('/layouts/menu', $data);
		$this->load->view('/transaksi/index', $data);
		$this->load->view('/layouts/footer', $data);
	}

	function create_transaksi() {
		$session_data = $this->session->userdata('mubasyirin_logged_in');
		if($session_data == NULL) {
			redirect("usercon/login", "refresh");
		}

		$nama_transaksi = $this->mappingkodeakunmodel->showData();
		$temp = '';
		foreach ($nama_transaksi as $nama) {
			$temp = $temp.'{"stateCode": "'.$nama["nama_transaksi"].'", "kodeDebet": "'.$nama["kode_debet"].'", "kodeKredit": "'.$nama["kode_kredit"].'", "stateName": "'.$nama["nama_transaksi"].'"},';
		}
		$temp=substr_replace($temp ,"",-1);
		$temp=trim(preg_replace('/\s+/', ' ', $temp));
		$data['nama_transaksi']		= $temp;

		$data['username'] 		= $session_data['username'];
		$data['status'] 		= $session_data['status'];
		$this->load->view('/layouts/menu', $data);
		$this->load->view('/transaksi/create_transaksi', $data);
		$this->load->view('/layouts/footer', $data);
	}

	function insert_transaksi() {
		$session_data = $this->session->userdata('mubasyirin_logged_in');
		if($session_data == NULL) {
			redirect("usercon/login", "refresh");
		}

		$data = array();
		$data['id'] 			= $this->transaksimodel->getNewId();
		$date1 					= $this->input->post('tanggal');
		$date 					= strtotime($date1);
		$data['tanggal'] 		= date("Y-m-d",$date);
		$data['nama_transaksi'] = $this->input->post('nama_transaksi');
		$data['keterangan'] 	= $this->input->post('keterangan');
		$data['kode_debet'] 	= $this->input->post('kode_debet');
		$data['kode_kredit'] 	= $this->input->post('kode_kredit');
		$data['jumlah'] 		= $this->input->post('jumlah');
		
		$this->transaksimodel->inputData($data);
		redirect('transaksicon');
	}

	function edit_transaksi($id) {
		$session_data = $this->session->userdata('mubasyirin_logged_in');
		if($session_data == NULL) {
			redirect("usercon/login", "refresh");
		}

		$nama_transaksi = $this->mappingkodeakunmodel->showData();
		$temp = '';
		foreach ($nama_transaksi as $nama) {
			$temp = $temp.'{"stateCode": "'.$nama["nama_transaksi"].'", "kodeDebet": "'.$nama["kode_debet"].'", "kodeKredit": "'.$nama["kode_kredit"].'", "stateName": "'.$nama["nama_transaksi"].'"},';
		}
		$temp=substr_replace($temp ,"",-1);
		$temp=trim(preg_replace('/\s+/', ' ', $temp));
		$data['nama_transaksi']		= $temp;
		
		$data['transaksi'] 	= $this->transaksimodel->get_transaksi_by_id($id);
		$data['username'] 	= $session_data['username'];
		$data['status'] 	= $session_data['status'];

		$this->load->view('/layouts/menu', $data);
		$this->load->view('/transaksi/edit_transaksi', $data);
		$this->load->view('/layouts/footer', $data);
	}

	function update_transaksi() {
		$session_data = $this->session->userdata('mubasyirin_logged_in');
		if($session_data == NULL) {
			redirect("usercon/login", "refresh");
		}

		$id = $this->input->post('id');
		$data = array();
		$date1 				= $this->input->post('tanggal');
		$date 				= strtotime($date1);
		$data['tanggal'] 		= date("Y-m-d",$date);
		$data['nama_transaksi'] = $this->input->post('nama_transaksi');
		$data['keterangan'] 	= $this->input->post('keterangan');
		$data['kode_debet'] 	= $this->input->post('kode_debet');
		$data['kode_kredit'] 	= $this->input->post('kode_kredit');
		$data['jumlah'] 		= $this->input->post('jumlah');

		$this->transaksimodel->updateData($id, $data);
		redirect('transaksicon');
	}

	function delete_transaksi($id) {
		$session_data = $this->session->userdata('mubasyirin_logged_in');
		if($session_data == NULL) {
			redirect("usercon/login", "refresh");
		}

		$this->transaksimodel->deleteData($id);
		redirect('transaksicon');
	}

	function post_akuntansi($id) {
		$session_data = $this->session->userdata('mubasyirin_logged_in');
		if($session_data == NULL) {
			redirect("usercon/login", "refresh");
		}

		$transaksi 	= $this->transaksimodel->get_transaksi_by_id($id);
		$debet 		= $this->kodeakunmodel->get_kode_akun_by_kode($transaksi->kode_debet);
		$kredit 	= $this->kodeakunmodel->get_kode_akun_by_kode($transaksi->kode_kredit);

		$data_debet 					= array();
		$data_debet['id'] 				= $this->transaksiakuntansimodel->getNewId();
		$data_debet['tanggal'] 			= $transaksi->tanggal;
		$data_debet['kode_akun'] 		= $transaksi->kode_debet;
		$data_debet['nama_akun'] 		= $debet->nama_akun;
		$data_debet['keterangan'] 		= $transaksi->keterangan;
		$data_debet['jumlah'] 			= $transaksi->jumlah;
		$data_debet['debet'] 			= $transaksi->jumlah;
		$data_debet['kredit'] 			= 0;
		$data_debet['origin_table']		= 'transaksi';
		$data_debet['origin_table_id']	= $transaksi->id;
		$this->transaksiakuntansimodel->inputData($data_debet);

		$data_kredit 					= array();
		$data_kredit['id'] 				= $this->transaksiakuntansimodel->getNewId();
		$data_kredit['tanggal'] 		= $transaksi->tanggal;
		$data_kredit['kode_akun'] 		= $transaksi->kode_kredit;
		$data_kredit['nama_akun'] 		= $kredit->nama_akun;
		$data_kredit['keterangan'] 		= $transaksi->keterangan;
		$data_kredit['jumlah'] 			= $transaksi->jumlah;
		$data_kredit['debet'] 			= 0;
		$data_kredit['kredit'] 			= $transaksi->jumlah;
		$data_kredit['origin_table']	= 'transaksi';
		$data_kredit['origin_table_id']	= $transaksi->id;
		$this->transaksiakuntansimodel->inputData($data_kredit);

		$update = array();
		$id 									= $transaksi->id;
		$update['tanggal'] 						= $transaksi->tanggal;
		$update['nama_transaksi'] 				= $transaksi->nama_transaksi;
		$update['keterangan'] 					= $transaksi->keterangan;
		$update['kode_debet'] 					= $transaksi->kode_debet;
		$update['kode_kredit'] 					= $transaksi->kode_kredit;
		$update['jumlah'] 						= $transaksi->jumlah;
		$update['status_post'] 					= 1;
		$update['id_debet_transaksi_akuntansi'] = $data_debet['id'];
		$update['id_kredit_transaksi_akuntansi']= $data_kredit['id'];

		$this->transaksimodel->updateData($id, $update);
		redirect('transaksicon');
	}

	function unpost_akuntansi($id) {
		$session_data = $this->session->userdata('mubasyirin_logged_in');
		if($session_data == NULL) {
			redirect("usercon/login", "refresh");
		}

		$transaksi 	= $this->transaksimodel->get_transaksi_by_id($id);
		$this->transaksiakuntansimodel->deleteData($transaksi->id_debet_transaksi_akuntansi);
		$this->transaksiakuntansimodel->deleteData($transaksi->id_kredit_transaksi_akuntansi);

		$update = array();
		$id 									= $transaksi->id;
		$update['tanggal'] 						= $transaksi->tanggal;
		$update['nama_transaksi'] 				= $transaksi->nama_transaksi;
		$update['keterangan'] 					= $transaksi->keterangan;
		$update['kode_debet'] 					= $transaksi->kode_debet;
		$update['kode_kredit'] 					= $transaksi->kode_kredit;
		$update['jumlah'] 						= $transaksi->jumlah;
		$update['status_post'] 					= 0;
		$update['id_debet_transaksi_akuntansi'] = 0;
		$update['id_kredit_transaksi_akuntansi']= 0;

		$this->transaksimodel->updateData($id, $update);
		redirect('transaksicon');
	}
}

?>