<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Simpanan3thcon extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->model('usermodel');
		$this->load->model('nasabahmodel');
		$this->load->model('simpanan3thmastermodel');
		$this->load->model('simpanan3thmodel');
		$this->load->model('detailsimpanan3thmodel');
		$this->load->model('detailjasasimpanan3thmodel');
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

	function create_simpanan3th($id_master) {
		$session_data = $this->session->userdata('logged_in');
		if($session_data == NULL) {
			redirect("usercon/login", "refresh");
		}

		$simpanan3thmaster = $this->simpanan3thmastermodel->showData();
		$temp = '';
		foreach ($simpanan3thmaster as $s) {
			$temp = $temp.'{"stateCode": "'.$s["id"].'", "stateDisplay": "'.$s["nama"].'", "stateName": "'.$s["nama"].'"},';
		}
		$temp=substr_replace($temp ,"",-1);
		$temp=trim(preg_replace('/\s+/', ' ', $temp));
		$data['simpanan3thmaster_dropdown']		= $temp;

		$data['simpanan3thmaster'] = $this->simpanan3thmastermodel->get_simpanan3thmaster_by_id($id_master);
		$data['username'] 	= $session_data['username'];
		$data['status'] 	= $session_data['status'];
		$data['nasabah'] 	= $this->nasabahmodel->showData();

		$this->load->view('/layouts/menu', $data);
		$this->load->view('/simpanan3th/create_simpanan3th', $data);
		$this->load->view('/layouts/footer', $data);
	}

	function pickNasabah() {
		$nasabah = $this->nasabahmodel->get_nasabah_by_id($this->input->post('id_nasabah'));

		echo $nasabah->nama. '||'.$nasabah->nik. '||'.$nasabah->nomor_koperasi;
	}

	function insert_simpanan3th() {
		$session_data = $this->session->userdata('logged_in');
		if($session_data == NULL) {
			redirect("usercon/login", "refresh");
		}
		$data = array();
		$data['id'] = $this->simpanan3thmodel->getNewId();
		$data['id_nasabah'] 	= $this->input->post('id_nasabah');
		$data['nama_nasabah'] 	= $this->input->post('nama_nasabah');
		$data['nomor_nasabah'] 	= $this->input->post('nomor_nasabah');
		$data['nik_nasabah'] 	= $this->input->post('nik_nasabah');
		$data['id_master'] 		= $this->input->post('id_master');
		$data['nama_simpanan'] 	= $this->input->post('nama_simpanan');
		$date1 	= $this->input->post('tanggal');
		$date 	= strtotime($date1);
		$data['waktu'] 			= date("Y-m-d",$date);
		$data['total'] 			= 0;

		$this->simpanan3thmodel->inputData($data);
		redirect('simpanan3thcon/view_simpanan3th/'.$data['id']);
	}

	function edit_simpanan3th($id) {
		$session_data = $this->session->userdata('logged_in');
		if($session_data == NULL) {
			redirect("usercon/login", "refresh");
		}
		$data['simpanan3th'] 		= $this->simpanan3thmodel->get_simpanan3th_by_id($id);
		$id_master 					= $data['simpanan3th']->id_master;
		$data['simpanan3thmaster']	= $this->simpanan3thmastermodel->get_simpanan3thmaster_by_id($id_master);

		$simpanan3thmaster = $this->simpanan3thmastermodel->showData();
		$temp = '';
		foreach ($simpanan3thmaster as $s) {
			$temp = $temp.'{"stateCode": "'.$s["id"].'", "stateDisplay": "'.$s["nama"].'", "stateName": "'.$s["nama"].'"},';
		}
		$temp=substr_replace($temp ,"",-1);
		$temp=trim(preg_replace('/\s+/', ' ', $temp));
		$data['simpanan3thmaster_dropdown']		= $temp;

		$data['username'] 			= $session_data['username'];
		$data['status'] 			= $session_data['status'];
		$data['nasabah'] 			= $this->nasabahmodel->showData();

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
		$data['id_master'] 		= $this->input->post('id_master');
		$data['nama_simpanan'] 	= $this->input->post('nama_simpanan');
		$date1 					= $this->input->post('tanggal');
		$date 					= strtotime($date1);
		$tanggal 				= date("Y-m-d",$date);
		$waktu 					= $tanggal." 00:00:00";
		$data['waktu'] 			= $waktu;
		$data['total'] 			= $this->input->post('total');

		$this->simpanan3thmodel->updateData($id, $data);
		redirect('simpanan3thmastercon/transaksi_simpanan3thmaster/'.$data['id_master']);
	}

	function view_simpanan3th($id_simpanan3th) {
		$session_data = $this->session->userdata('logged_in');
		if($session_data == NULL) {
			redirect("usercon/login", "refresh");
		}
		$data 							= array();
		$data['simpanan3th'] 			= $this->simpanan3thmodel->get_simpanan3th_by_id($id_simpanan3th);
		$id_master 						= $data['simpanan3th']->id_master;
		$data['simpanan3thmaster']		= $this->simpanan3thmastermodel->get_simpanan3thmaster_by_id($id_master);
		$data['username'] 				= $session_data['username'];
		$data['status'] 				= $session_data['status'];
		$data['nasabah'] 				= $this->nasabahmodel->showData();
		$data['detail_simpanan3th'] 	= $this->detailsimpanan3thmodel->get_detail_simpanan3th_by_id_simpanan3th($id_simpanan3th);
		$data['detail_jasa_simpanan3th']= $this->detailjasasimpanan3thmodel->get_detail_jasa_simpanan3th_by_id_simpanan3th($id_simpanan3th);

		$this->load->view('/layouts/menu', $data);
		$this->load->view('/simpanan3th/view_simpanan3th', $data);
		$this->load->view('/layouts/footer', $data);
	}

	function delete_simpanan3th($id) {
		$session_data = $this->session->userdata('logged_in');
		if($session_data == NULL) {
			redirect("usercon/login", "refresh");
		}

		$simpanan3th 			= $this->simpanan3thmodel->get_simpanan3th_by_id($id);

		$this->simpanan3thmodel->deleteData($id);
		$this->detailsimpanan3thmodel->delete_by_id_simpanan3th($id);

		redirect('simpanan3thmastercon/transaksi_simpanan3thmaster/'.$simpanan3th->id_master);
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
		$input['jenis']				= $this->input->post('jenis');
		$input['bulan_tahun']		= $this->input->post('bulan_tahun');
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

		$data['simpanan3th'] 				= $this->simpanan3thmodel->get_simpanan3th_by_id($id_simpanan3th);
		$id_master 							= $data['simpanan3th']->id_master;
		$data['simpanan3thmaster']			= $this->simpanan3thmastermodel->get_simpanan3thmaster_by_id($id_master);
		$data['username'] 					= $session_data['username'];
		$data['status'] 					= $session_data['status'];
		$data['nasabah'] 					= $this->nasabahmodel->showData();
		$data['detail_simpanan3th'] 		= $this->detailsimpanan3thmodel->get_detail_simpanan3th_by_id_simpanan3th($id_simpanan3th);
		$data['detail_jasa_simpanan3th'] 	= $this->detailjasasimpanan3thmodel->get_detail_jasa_simpanan3th_by_id_simpanan3th($id_simpanan3th);
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
		$update 					= array();
		$update['waktu'] 			= date("Y-m-d",$date);
		$update['id_simpanan3th'] 	= $this->input->post('edit_id_simpanan3th');
		$update['jenis']			= $this->input->post('edit_jenis');
		$update['bulan_tahun']		= $this->input->post('edit_bulan_tahun');
		$update['jumlah'] 			= $this->input->post('edit_jumlah');
		$this->detailsimpanan3thmodel->updateData($id, $update);

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

	function post_akuntansi($id_simpanan3th, $id_detail_simpanan3th) {
		$session_data = $this->session->userdata('logged_in');
		if($session_data == NULL) {
			redirect("usercon/login", "refresh");
		}

		$data['simpanan3th'] 			= $this->simpanan3thmodel->get_simpanan3th_by_id($id_simpanan3th);
		$id_master 						= $data['simpanan3th']->id_master;
		$data['simpanan3thmaster']		= $this->simpanan3thmastermodel->get_simpanan3thmaster_by_id($id_master);
		$data['post_detail_simpanan3th']= $this->detailsimpanan3thmodel->get_detail_simpanan3th_by_id($id_detail_simpanan3th);

		if($data['post_detail_simpanan3th']->status_post != '1') {
			if($data['post_detail_simpanan3th']->jenis == "Setoran") {
				$debet 		= $this->kodeakunmodel->get_kode_akun_by_kode($data['simpanan3thmaster']->kode_debet_penerimaan_simp);
				$kredit 	= $this->kodeakunmodel->get_kode_akun_by_kode($data['simpanan3thmaster']->kode_kredit_penerimaan_simp);
				$bln_thn 	= strtotime( $data['post_detail_simpanan3th']->bulan_tahun );
	            $bulan_tahun = date( 'M-Y', $bln_thn );

	            $data_debet 					= array();
				$data_debet['id'] 				= $this->transaksiakuntansimodel->getNewId();
				$data_debet['tanggal'] 			= $data['post_detail_simpanan3th']->waktu;
				$data_debet['kode_akun'] 		= $data['simpanan3thmaster']->kode_debet_penerimaan_simp;
				$data_debet['nama_akun'] 		= $debet->nama_akun;
				$data_debet['keterangan'] 		= $data['simpanan3thmaster']->nama." Bulan ".$bulan_tahun." Anggota a.n. ".$data['simpanan3th']->nama_nasabah." Nomor Anggota: ".$data['simpanan3th']->nomor_nasabah." Tanggal Simpanan: ".date("d-m-Y", strtotime($data['simpanan3th']->waktu));
				$data_debet['jumlah'] 			= $data['post_detail_simpanan3th']->jumlah;
				$data_debet['debet'] 			= $data['post_detail_simpanan3th']->jumlah;
				$data_debet['kredit'] 			= 0;
				$data_debet['origin_table']		= 'detail_simpanan3th';
				$data_debet['origin_table_id']	= $data['post_detail_simpanan3th']->id;
				$this->transaksiakuntansimodel->inputData($data_debet);

				$data_kredit 					= array();
				$data_kredit['id'] 				= $this->transaksiakuntansimodel->getNewId();
				$data_kredit['tanggal'] 		= $data['post_detail_simpanan3th']->waktu;
				$data_kredit['kode_akun'] 		= $data['simpanan3thmaster']->kode_kredit_penerimaan_simp;
				$data_kredit['nama_akun'] 		= $kredit->nama_akun;
				$data_kredit['keterangan'] 		= $data['simpanan3thmaster']->nama." Bulan ".$bulan_tahun." Anggota a.n. ".$data['simpanan3th']->nama_nasabah." Nomor Anggota: ".$data['simpanan3th']->nomor_nasabah." Tanggal Simpanan: ".date("d-m-Y", strtotime($data['simpanan3th']->waktu));
				$data_kredit['jumlah'] 			= $data['post_detail_simpanan3th']->jumlah;
				$data_kredit['debet'] 			= 0;
				$data_kredit['kredit'] 			= $data['post_detail_simpanan3th']->jumlah;
				$data_kredit['origin_table']	= 'detail_simpanan3th';
				$data_kredit['origin_table_id']	= $data['post_detail_simpanan3th']->id;
				$this->transaksiakuntansimodel->inputData($data_kredit);
			} else if($data['post_detail_simpanan3th']->jenis == "Tarikan") {
				$debet 		= $this->kodeakunmodel->get_kode_akun_by_kode($data['simpanan3thmaster']->kode_debet_pencairan_simp);
				$kredit 	= $this->kodeakunmodel->get_kode_akun_by_kode($data['simpanan3thmaster']->kode_kredit_pencairan_simp);
				$bln_thn 	= strtotime( $data['post_detail_simpanan3th']->bulan_tahun );
	            $bulan_tahun = date( 'M-Y', $bln_thn );

	            $data_debet 					= array();
				$data_debet['id'] 				= $this->transaksiakuntansimodel->getNewId();
				$data_debet['tanggal'] 			= $data['post_detail_simpanan3th']->waktu;
				$data_debet['kode_akun'] 		= $data['simpanan3thmaster']->kode_debet_pencairan_simp;
				$data_debet['nama_akun'] 		= $debet->nama_akun;
				$data_debet['keterangan'] 		= "Pencairan ".$data['simpanan3thmaster']->nama." Bulan ".$bulan_tahun." Anggota a.n. ".$data['simpanan3th']->nama_nasabah." Nomor Anggota: ".$data['simpanan3th']->nomor_nasabah." Tanggal Simpanan: ".date("d-m-Y", strtotime($data['simpanan3th']->waktu));
				$data_debet['jumlah'] 			= $data['post_detail_simpanan3th']->jumlah;
				$data_debet['debet'] 			= $data['post_detail_simpanan3th']->jumlah;
				$data_debet['kredit'] 			= 0;
				$data_debet['origin_table']		= 'detail_simpanan3th';
				$data_debet['origin_table_id']	= $data['post_detail_simpanan3th']->id;
				$this->transaksiakuntansimodel->inputData($data_debet);

				$data_kredit 					= array();
				$data_kredit['id'] 				= $this->transaksiakuntansimodel->getNewId();
				$data_kredit['tanggal'] 		= $data['post_detail_simpanan3th']->waktu;
				$data_kredit['kode_akun'] 		= $data['simpanan3thmaster']->kode_kredit_pencairan_simp;
				$data_kredit['nama_akun'] 		= $kredit->nama_akun;
				$data_kredit['keterangan'] 		= "Pencairan ".$data['simpanan3thmaster']->nama." Bulan ".$bulan_tahun." Anggota a.n. ".$data['simpanan3th']->nama_nasabah." Nomor Anggota: ".$data['simpanan3th']->nomor_nasabah." Tanggal Simpanan: ".date("d-m-Y", strtotime($data['simpanan3th']->waktu));
				$data_kredit['jumlah'] 			= $data['post_detail_simpanan3th']->jumlah;
				$data_kredit['debet'] 			= 0;
				$data_kredit['kredit'] 			= $data['post_detail_simpanan3th']->jumlah;
				$data_kredit['origin_table']	= 'detail_simpanan3th';
				$data_kredit['origin_table_id']	= $data['post_detail_simpanan3th']->id;
				$this->transaksiakuntansimodel->inputData($data_kredit);
			}

			$update = array();
			$id 									= $data['post_detail_simpanan3th']->id;
			$update['id_simpanan3th'] 				= $data['post_detail_simpanan3th']->id_simpanan3th;
			$update['waktu'] 						= $data['post_detail_simpanan3th']->waktu;
			$update['jenis'] 						= $data['post_detail_simpanan3th']->jenis;
			$update['bulan_tahun'] 					= $data['post_detail_simpanan3th']->bulan_tahun;
			$update['jumlah'] 						= $data['post_detail_simpanan3th']->jumlah;
			$update['status_post'] 					= 1;
			$update['id_debet_transaksi_akuntansi']	= $data_debet['id'];
			$update['id_kredit_transaksi_akuntansi']= $data_kredit['id'];
			$this->detailsimpanan3thmodel->updateData($id, $update);
		}
		

		redirect("simpanan3thcon/view_simpanan3th/".$id_simpanan3th);
	}

	function unpost_akuntansi($id_simpanan3th, $id_detail_simpanan3th) {
		$session_data = $this->session->userdata('logged_in');
		if($session_data == NULL) {
			redirect("usercon/login", "refresh");
		}

		$data['simpanan3th'] 			= $this->simpanan3thmodel->get_simpanan3th_by_id($id_simpanan3th);
		$id_master 						= $data['simpanan3th']->id_master;
		$data['simpanan3thmaster']		= $this->simpanan3thmastermodel->get_simpanan3thmaster_by_id($id_master);
		$data['post_detail_simpanan3th']= $this->detailsimpanan3thmodel->get_detail_simpanan3th_by_id($id_detail_simpanan3th);

		$id_debet_transaksi_akuntansi 	= $data['post_detail_simpanan3th']->id_debet_transaksi_akuntansi;
		$id_kredit_transaksi_akuntansi 	= $data['post_detail_simpanan3th']->id_kredit_transaksi_akuntansi;

		$this->transaksiakuntansimodel->deleteData($id_debet_transaksi_akuntansi);
		$this->transaksiakuntansimodel->deleteData($id_kredit_transaksi_akuntansi);

		$update = array();
		$id 									= $data['post_detail_simpanan3th']->id;
		$update['id_simpanan3th'] 				= $data['post_detail_simpanan3th']->id_simpanan3th;
		$update['waktu'] 						= $data['post_detail_simpanan3th']->waktu;
		$update['jenis'] 						= $data['post_detail_simpanan3th']->jenis;
		$update['bulan_tahun'] 					= $data['post_detail_simpanan3th']->bulan_tahun;
		$update['jumlah'] 						= $data['post_detail_simpanan3th']->jumlah;
		$update['status_post'] 					= 0;
		$update['id_debet_transaksi_akuntansi']	= 0;
		$update['id_kredit_transaksi_akuntansi']= 0;
		$this->detailsimpanan3thmodel->updateData($id, $update);

		redirect("simpanan3thcon/view_simpanan3th/".$id_simpanan3th);
	}

	function insert_detail_jasa_simpanan3th() {
		$session_data = $this->session->userdata('logged_in');
		if($session_data == NULL) {
			redirect("usercon/login", "refresh");
		}

		$date1 						= $this->input->post('jasa_waktu');
		$date 						= strtotime($date1);
		$input 						= array();
		$input['waktu'] 			= date("Y-m-d",$date);
		$input['id_simpanan3th']	= $this->input->post('jasa_id_simpanan3th');
		$input['jenis']				= $this->input->post('jasa_jenis');
		$input['bulan_tahun']		= $this->input->post('jasa_bulan_tahun');
		$input['jumlah']			= $this->input->post('jasa_jumlah');
		$this->detailjasasimpanan3thmodel->inputData($input);

		$id_simpanan3th = $this->input->post('jasa_id_simpanan3th');
		$data['simpanan3th'] = $this->simpanan3thmodel->get_simpanan3th_by_id($id_simpanan3th);

		if($input['jenis'] == 'Penyesuaian Jasa') {
			$jasa_total 	= $data['simpanan3th']->jasa_total;
			$jasa_total		= $jasa_total + $input['jumlah'];
			$this->simpanan3thmodel->update_jasa_total($id_simpanan3th, $jasa_total);
		} else {
			$jasa_total 	= $data['simpanan3th']->jasa_total;
			$jasa_total		= $jasa_total - $input['jumlah'];
			$this->simpanan3thmodel->update_jasa_total($id_simpanan3th, $jasa_total);
		}

		redirect("simpanan3thcon/view_simpanan3th/".$id_simpanan3th);
	}

	function edit_detail_jasa_simpanan3th($id_simpanan3th, $id_detail_jasa_simpanan3th) {
		$session_data = $this->session->userdata('logged_in');
		if($session_data == NULL) {
			redirect("usercon/login", "refresh");
		}

		// Get Simpanan 3 Th Sesuai dengan id_simpanan3th
		$update = $this->simpanan3thmodel->get_simpanan3th_by_id($id_simpanan3th);
		// Get Detail Jasa Simpanan 3 Th Sesuai dengan id_detail_jasa_simpanan3th
		$prev 	= $this->detailjasasimpanan3thmodel->get_detail_jasa_simpanan3th_by_id($id_detail_jasa_simpanan3th);

		if($prev->jenis == 'Penyesuaian Jasa') {
			$jasa_total 	= $update->jasa_total - $prev->jumlah;
			$this->simpanan3thmodel->update_jasa_total($id_simpanan3th, $jasa_total);
		} else {
			$jasa_total 	= $update->jasa_total + $prev->jumlah;
			$this->simpanan3thmodel->update_jasa_total($id_simpanan3th, $jasa_total);
		}

		$data['simpanan3th'] 					= $this->simpanan3thmodel->get_simpanan3th_by_id($id_simpanan3th);
		$id_master 								= $data['simpanan3th']->id_master;
		$data['simpanan3thmaster']				= $this->simpanan3thmastermodel->get_simpanan3thmaster_by_id($id_master);
		$data['username'] 						= $session_data['username'];
		$data['status'] 						= $session_data['status'];
		$data['nasabah'] 						= $this->nasabahmodel->showData();
		$data['detail_simpanan3th'] 			= $this->detailsimpanan3thmodel->get_detail_simpanan3th_by_id_simpanan3th($id_simpanan3th);
		$data['detail_jasa_simpanan3th'] 		= $this->detailjasasimpanan3thmodel->get_detail_jasa_simpanan3th_by_id_simpanan3th($id_simpanan3th);
		$data['edit_detail_jasa_simpanan3th'] 	= $this->detailjasasimpanan3thmodel->get_detail_jasa_simpanan3th_by_id($id_detail_jasa_simpanan3th);

		$this->load->view('/layouts/menu', $data);
		$this->load->view('/simpanan3th/view_simpanan3th_edit_detail_jasa', $data);
		$this->load->view('/layouts/footer', $data);
	}

	function update_detail_jasa_simpanan3th() {
		$session_data = $this->session->userdata('logged_in');
		if($session_data == NULL) {
			redirect("usercon/login", "refresh");
		}

		$id 						= $this->input->post('edit_jasa_id');
		$date1 						= $this->input->post('edit_jasa_waktu');
		$date 						= strtotime($date1);
		$update 					= array();
		$update['waktu'] 			= date("Y-m-d",$date);
		$update['id_simpanan3th'] 	= $this->input->post('edit_jasa_id_simpanan3th');
		$update['jenis']			= $this->input->post('edit_jasa_jenis');
		$update['bulan_tahun']		= $this->input->post('edit_jasa_bulan_tahun');
		$update['jumlah'] 			= $this->input->post('edit_jasa_jumlah');
		$this->detailjasasimpanan3thmodel->updateData($id, $update);

		$id_simpanan3th = $this->input->post('edit_jasa_id_simpanan3th');
		$data['simpanan3th'] = $this->simpanan3thmodel->get_simpanan3th_by_id($id_simpanan3th);

		if($update['jenis'] == 'Penyesuaian Jasa') {
			$jasa_total = $data['simpanan3th']->jasa_total + $update['jumlah'];
			$this->simpanan3thmodel->update_jasa_total($id_simpanan3th, $jasa_total);
		} else {
			$jasa_total = $data['simpanan3th']->jasa_total - $update['jumlah'];
			$this->simpanan3thmodel->update_jasa_total($id_simpanan3th, $jasa_total);
		}

		redirect("simpanan3thcon/view_simpanan3th/".$id_simpanan3th);
	}

	function delete_detail_jasa_simpanan3th($id_simpanan3th, $id_detail_jasa_simpanan3th) {
		$session_data = $this->session->userdata('logged_in');
		if($session_data == NULL) {
			redirect("usercon/login", "refresh");
		}

		// Get Simpanan 3 Th Sesuai dengan id_simpanan3th
		$update = $this->simpanan3thmodel->get_simpanan3th_by_id($id_simpanan3th);
		// Get Detail Jasa Simpanan 3 Th Sesuai dengan id_detail_simpanan3th
		$prev 	= $this->detailjasasimpanan3thmodel->get_detail_jasa_simpanan3th_by_id($id_detail_jasa_simpanan3th);

		if($prev->jenis == 'Penyesuaian Jasa') {
			$jasa_total 	= $update->jasa_total - $prev->jumlah;
			$this->simpanan3thmodel->update_jasa_total($id_simpanan3th, $jasa_total);
		} else {
			$jasa_total 	= $update->jasa_total + $prev->jumlah;
			$this->simpanan3thmodel->update_jasa_total($id_simpanan3th, $jasa_total);
		}

		$this->detailjasasimpanan3thmodel->deleteData($id_detail_jasa_simpanan3th);
		
		redirect("simpanan3thcon/view_simpanan3th/".$id_simpanan3th);
	}

	function jasa_simpanan3th_post_akuntansi($id_simpanan3th, $id_detail_jasa_simpanan3th) {
		$session_data = $this->session->userdata('logged_in');
		if($session_data == NULL) {
			redirect("usercon/login", "refresh");
		}

		$data['simpanan3th'] 					= $this->simpanan3thmodel->get_simpanan3th_by_id($id_simpanan3th);
		$id_master 								= $data['simpanan3th']->id_master;
		$data['simpanan3thmaster']				= $this->simpanan3thmastermodel->get_simpanan3thmaster_by_id($id_master);
		$data['post_detail_jasa_simpanan3th']	= $this->detailjasasimpanan3thmodel->get_detail_jasa_simpanan3th_by_id($id_detail_jasa_simpanan3th);

		if($data['post_detail_jasa_simpanan3th']->status_post != '1') {
			if($data['post_detail_jasa_simpanan3th']->jenis == "Penyesuaian Jasa") {
				$debet 		= $this->kodeakunmodel->get_kode_akun_by_kode($data['simpanan3thmaster']->kode_debet_penyesuaian_jasa);
				$kredit 	= $this->kodeakunmodel->get_kode_akun_by_kode($data['simpanan3thmaster']->kode_kredit_penyesuaian_jasa);
				$bln_thn 	= strtotime( $data['post_detail_jasa_simpanan3th']->bulan_tahun );
	            $bulan_tahun = date( 'M-Y', $bln_thn );

	            $data_debet 					= array();
				$data_debet['id'] 				= $this->transaksiakuntansimodel->getNewId();
				$data_debet['tanggal'] 			= $data['post_detail_jasa_simpanan3th']->waktu;
				$data_debet['kode_akun'] 		= $data['simpanan3thmaster']->kode_debet_penyesuaian_jasa;
				$data_debet['nama_akun'] 		= $debet->nama_akun;
				$data_debet['keterangan'] 		= $data['post_detail_jasa_simpanan3th']->jenis." ".$data['simpanan3thmaster']->nama." Bulan ".$bulan_tahun." Anggota a.n. ".$data['simpanan3th']->nama_nasabah." Nomor Anggota: ".$data['simpanan3th']->nomor_nasabah." Tanggal Simpanan: ".date("d-m-Y", strtotime($data['simpanan3th']->waktu));
				$data_debet['jumlah'] 			= $data['post_detail_jasa_simpanan3th']->jumlah;
				$data_debet['debet'] 			= $data['post_detail_jasa_simpanan3th']->jumlah;
				$data_debet['kredit'] 			= 0;
				$data_debet['origin_table']		= 'detail_jasa_simpanan3th';
				$data_debet['origin_table_id']	= $data['post_detail_jasa_simpanan3th']->id;
				$this->transaksiakuntansimodel->inputData($data_debet);

				$data_kredit 					= array();
				$data_kredit['id'] 				= $this->transaksiakuntansimodel->getNewId();
				$data_kredit['tanggal'] 		= $data['post_detail_jasa_simpanan3th']->waktu;
				$data_kredit['kode_akun'] 		= $data['simpanan3thmaster']->kode_kredit_penyesuaian_jasa;
				$data_kredit['nama_akun'] 		= $kredit->nama_akun;
				$data_kredit['keterangan'] 		= $data['post_detail_jasa_simpanan3th']->jenis." ".$data['simpanan3thmaster']->nama." Bulan ".$bulan_tahun." Anggota a.n. ".$data['simpanan3th']->nama_nasabah." Nomor Anggota: ".$data['simpanan3th']->nomor_nasabah." Tanggal Simpanan: ".date("d-m-Y", strtotime($data['simpanan3th']->waktu));
				$data_kredit['jumlah'] 			= $data['post_detail_jasa_simpanan3th']->jumlah;
				$data_kredit['debet'] 			= 0;
				$data_kredit['kredit'] 			= $data['post_detail_jasa_simpanan3th']->jumlah;
				$data_kredit['origin_table']	= 'detail_jasa_simpanan3th';
				$data_kredit['origin_table_id']	= $data['post_detail_jasa_simpanan3th']->id;
				$this->transaksiakuntansimodel->inputData($data_kredit);
			} else if ($data['post_detail_jasa_simpanan3th']->jenis == "Pencairan Hutang Jasa") {
				$debet 		= $this->kodeakunmodel->get_kode_akun_by_kode($data['simpanan3thmaster']->kode_debet_pencairan_hutang_jasa);
				$kredit 	= $this->kodeakunmodel->get_kode_akun_by_kode($data['simpanan3thmaster']->kode_kredit_pencairan_hutang_jasa);
				$bln_thn 	= strtotime( $data['post_detail_jasa_simpanan3th']->bulan_tahun );
	            $bulan_tahun = date( 'M-Y', $bln_thn );

	            $data_debet 					= array();
				$data_debet['id'] 				= $this->transaksiakuntansimodel->getNewId();
				$data_debet['tanggal'] 			= $data['post_detail_jasa_simpanan3th']->waktu;
				$data_debet['kode_akun'] 		= $data['simpanan3thmaster']->kode_debet_pencairan_hutang_jasa;
				$data_debet['nama_akun'] 		= $debet->nama_akun;
				$data_debet['keterangan'] 		= $data['post_detail_jasa_simpanan3th']->jenis." ".$data['simpanan3thmaster']->nama." Bulan ".$bulan_tahun." Anggota a.n. ".$data['simpanan3th']->nama_nasabah." Nomor Anggota: ".$data['simpanan3th']->nomor_nasabah." Tanggal Simpanan: ".date("d-m-Y", strtotime($data['simpanan3th']->waktu));
				$data_debet['jumlah'] 			= $data['post_detail_jasa_simpanan3th']->jumlah;
				$data_debet['debet'] 			= $data['post_detail_jasa_simpanan3th']->jumlah;
				$data_debet['kredit'] 			= 0;
				$data_debet['origin_table']		= 'detail_jasa_simpanan3th';
				$data_debet['origin_table_id']	= $data['post_detail_jasa_simpanan3th']->id;
				$this->transaksiakuntansimodel->inputData($data_debet);

				$data_kredit 					= array();
				$data_kredit['id'] 				= $this->transaksiakuntansimodel->getNewId();
				$data_kredit['tanggal'] 		= $data['post_detail_jasa_simpanan3th']->waktu;
				$data_kredit['kode_akun'] 		= $data['simpanan3thmaster']->kode_kredit_pencairan_hutang_jasa;
				$data_kredit['nama_akun'] 		= $kredit->nama_akun;
				$data_kredit['keterangan'] 		= $data['post_detail_jasa_simpanan3th']->jenis." ".$data['simpanan3thmaster']->nama." Bulan ".$bulan_tahun." Anggota a.n. ".$data['simpanan3th']->nama_nasabah." Nomor Anggota: ".$data['simpanan3th']->nomor_nasabah." Tanggal Simpanan: ".date("d-m-Y", strtotime($data['simpanan3th']->waktu));
				$data_kredit['jumlah'] 			= $data['post_detail_jasa_simpanan3th']->jumlah;
				$data_kredit['debet'] 			= 0;
				$data_kredit['kredit'] 			= $data['post_detail_jasa_simpanan3th']->jumlah;
				$data_kredit['origin_table']	= 'detail_jasa_simpanan3th';
				$data_kredit['origin_table_id']	= $data['post_detail_jasa_simpanan3th']->id;
				$this->transaksiakuntansimodel->inputData($data_kredit);
			} else if ($data['post_detail_jasa_simpanan3th']->jenis == "Pembayaran Biaya Jasa") {
				$debet 		= $this->kodeakunmodel->get_kode_akun_by_kode($data['simpanan3thmaster']->kode_debet_pembayaran_jasa);
				$kredit 	= $this->kodeakunmodel->get_kode_akun_by_kode($data['simpanan3thmaster']->kode_kredit_pembayaran_jasa);
				$bln_thn 	= strtotime( $data['post_detail_jasa_simpanan3th']->bulan_tahun );
	            $bulan_tahun = date( 'M-Y', $bln_thn );

	            $data_debet 					= array();
				$data_debet['id'] 				= $this->transaksiakuntansimodel->getNewId();
				$data_debet['tanggal'] 			= $data['post_detail_jasa_simpanan3th']->waktu;
				$data_debet['kode_akun'] 		= $data['simpanan3thmaster']->kode_debet_pembayaran_jasa;
				$data_debet['nama_akun'] 		= $debet->nama_akun;
				$data_debet['keterangan'] 		= $data['post_detail_jasa_simpanan3th']->jenis." ".$data['simpanan3thmaster']->nama." Bulan ".$bulan_tahun." Anggota a.n. ".$data['simpanan3th']->nama_nasabah." Nomor Anggota: ".$data['simpanan3th']->nomor_nasabah." Tanggal Simpanan: ".date("d-m-Y", strtotime($data['simpanan3th']->waktu));
				$data_debet['jumlah'] 			= $data['post_detail_jasa_simpanan3th']->jumlah;
				$data_debet['debet'] 			= $data['post_detail_jasa_simpanan3th']->jumlah;
				$data_debet['kredit'] 			= 0;
				$data_debet['origin_table']		= 'detail_jasa_simpanan3th';
				$data_debet['origin_table_id']	= $data['post_detail_jasa_simpanan3th']->id;
				$this->transaksiakuntansimodel->inputData($data_debet);

				$data_kredit 					= array();
				$data_kredit['id'] 				= $this->transaksiakuntansimodel->getNewId();
				$data_kredit['tanggal'] 		= $data['post_detail_jasa_simpanan3th']->waktu;
				$data_kredit['kode_akun'] 		= $data['simpanan3thmaster']->kode_kredit_pembayaran_jasa;
				$data_kredit['nama_akun'] 		= $kredit->nama_akun;
				$data_kredit['keterangan'] 		= $data['post_detail_jasa_simpanan3th']->jenis." ".$data['simpanan3thmaster']->nama." Bulan ".$bulan_tahun." Anggota a.n. ".$data['simpanan3th']->nama_nasabah." Nomor Anggota: ".$data['simpanan3th']->nomor_nasabah." Tanggal Simpanan: ".date("d-m-Y", strtotime($data['simpanan3th']->waktu));
				$data_kredit['jumlah'] 			= $data['post_detail_jasa_simpanan3th']->jumlah;
				$data_kredit['debet'] 			= 0;
				$data_kredit['kredit'] 			= $data['post_detail_jasa_simpanan3th']->jumlah;
				$data_kredit['origin_table']	= 'detail_jasa_simpanan3th';
				$data_kredit['origin_table_id']	= $data['post_detail_jasa_simpanan3th']->id;
				$this->transaksiakuntansimodel->inputData($data_kredit);
			}

			$update = array();
			$id 									= $data['post_detail_jasa_simpanan3th']->id;
			$update['id_simpanan3th'] 				= $data['post_detail_jasa_simpanan3th']->id_simpanan3th;
			$update['waktu'] 						= $data['post_detail_jasa_simpanan3th']->waktu;
			$update['jenis'] 						= $data['post_detail_jasa_simpanan3th']->jenis;
			$update['bulan_tahun'] 					= $data['post_detail_jasa_simpanan3th']->bulan_tahun;
			$update['jumlah'] 						= $data['post_detail_jasa_simpanan3th']->jumlah;
			$update['status_post'] 					= 1;
			$update['id_debet_transaksi_akuntansi']	= $data_debet['id'];
			$update['id_kredit_transaksi_akuntansi']= $data_kredit['id'];
			$this->detailjasasimpanan3thmodel->updateData($id, $update);
		}
		

		redirect("simpanan3thcon/view_simpanan3th/".$id_simpanan3th);
	}

	function jasa_simpanan3th_unpost_akuntansi($id_simpanan3th, $id_detail_jasa_simpanan3th) {
		$session_data = $this->session->userdata('logged_in');
		if($session_data == NULL) {
			redirect("usercon/login", "refresh");
		}

		$data['simpanan3th'] 					= $this->simpanan3thmodel->get_simpanan3th_by_id($id_simpanan3th);
		$id_master 								= $data['simpanan3th']->id_master;
		$data['simpanan3thmaster']				= $this->simpanan3thmastermodel->get_simpanan3thmaster_by_id($id_master);
		$data['post_detail_jasa_simpanan3th']	= $this->detailjasasimpanan3thmodel->get_detail_jasa_simpanan3th_by_id($id_detail_jasa_simpanan3th);

		$id_debet_transaksi_akuntansi 	= $data['post_detail_jasa_simpanan3th']->id_debet_transaksi_akuntansi;
		$id_kredit_transaksi_akuntansi 	= $data['post_detail_jasa_simpanan3th']->id_kredit_transaksi_akuntansi;

		$this->transaksiakuntansimodel->deleteData($id_debet_transaksi_akuntansi);
		$this->transaksiakuntansimodel->deleteData($id_kredit_transaksi_akuntansi);

		$update = array();
		$id 									= $data['post_detail_jasa_simpanan3th']->id;
		$update['id_simpanan3th'] 				= $data['post_detail_jasa_simpanan3th']->id_simpanan3th;
		$update['waktu'] 						= $data['post_detail_jasa_simpanan3th']->waktu;
		$update['jenis'] 						= $data['post_detail_jasa_simpanan3th']->jenis;
		$update['bulan_tahun'] 					= $data['post_detail_jasa_simpanan3th']->bulan_tahun;
		$update['jumlah'] 						= $data['post_detail_jasa_simpanan3th']->jumlah;
		$update['status_post'] 					= 0;
		$update['id_debet_transaksi_akuntansi']	= 0;
		$update['id_kredit_transaksi_akuntansi']= 0;
		$this->detailjasasimpanan3thmodel->updateData($id, $update);

		redirect("simpanan3thcon/view_simpanan3th/".$id_simpanan3th);
	}
}

?>