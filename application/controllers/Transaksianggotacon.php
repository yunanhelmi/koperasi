<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class TransaksianggotaCon extends CI_Controller {
	function __construct() {
		parent::__construct();

		$this->load->model('usermodel');
		$this->load->model('nasabahmodel');
		$this->load->model('pinjamanmodel');
		$this->load->model('detailangsuranmodel');
		$this->load->model('simpananpokokmodel');
		$this->load->model('simpananwajibmodel');
		$this->load->model('detailsimpananwajibmodel');
		$this->load->model('simpanankhususmodel');
		$this->load->model('detailsimpanankhususmodel');
		$this->load->model('simpanandanasosialmodel');
		$this->load->model('detailsimpanandanasosialmodel');
		$this->load->model('simpanankanzunmodel');
		$this->load->model('detailsimpanankanzunmodel');
		$this->load->model('simpanan3thmodel');
		$this->load->model('detailsimpanan3thmodel');
		$this->load->model('simpananpihakketigamodel');
		$this->load->model('detailsimpananpihakketigamodel');
		$this->load->model('mappingkodeakunmodel');
		$this->load->model('kodeakunmodel');
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
		$data['username'] 	= $session_data['username'];
		$data['status'] 	= $session_data['status'];
		$data['nasabah'] 	= $this->nasabahmodel->showData();
		$this->load->view('/layouts/menu', $data);
		$this->load->view('/transaksianggota/index', $data);
		$this->load->view('/layouts/footer', $data);
	}

	/*** Transaksi Pinjaman ***/
	function pinjaman($id_nasabah) {
		$session_data = $this->session->userdata('logged_in');
		if($session_data == NULL) {
			redirect("usercon/login", "refresh");
		}
		$data['nasabah'] 			= $this->nasabahmodel->get_nasabah_by_id($id_nasabah);
		$data['pinjaman'] 			= $this->pinjamanmodel->get_pinjaman_by_id_nasabah($id_nasabah);
		$data['simpananpokok'] 		= $this->simpananpokokmodel->get_simpananpokok_by_id_nasabah($id_nasabah);
		$data['simpananwajib'] 		= $this->simpananwajibmodel->get_simpananwajib_by_id_nasabah($id_nasabah);
		$data['simpanankhusus'] 	= $this->simpanankhususmodel->get_simpanankhusus_by_id_nasabah($id_nasabah);
		$data['simpanandanasosial'] = $this->simpanandanasosialmodel->get_simpanandanasosial_by_id_nasabah($id_nasabah);
		$data['simpanankanzun'] 	= $this->simpanankanzunmodel->get_simpanankanzun_by_id_nasabah($id_nasabah);
		$data['simpanan3th'] 		= $this->simpanan3thmodel->get_simpanan3th_by_id_nasabah($id_nasabah);
		$data['simpananpihakketiga']= $this->simpananpihakketigamodel->get_simpananpihakketiga_by_id_nasabah($id_nasabah);
		$data['username'] 			= $session_data['username'];
		$data['status'] 			= $session_data['status'];

		$this->load->view('/layouts/menu', $data);
		$this->load->view('/transaksianggota/index_pinjaman', $data);
		$this->load->view('/layouts/footer', $data);
	}

	function create_pinjaman($id_nasabah) {
		$session_data = $this->session->userdata('logged_in');
		if($session_data == NULL) {
			redirect("usercon/login", "refresh");
		}
		$data['nasabah'] 			= $this->nasabahmodel->get_nasabah_by_id($id_nasabah);
		$data['simpananpokok'] 		= $this->simpananpokokmodel->get_simpananpokok_by_id_nasabah($id_nasabah);
		$data['simpananwajib'] 		= $this->simpananwajibmodel->get_simpananwajib_by_id_nasabah($id_nasabah);
		$data['simpanankhusus'] 	= $this->simpanankhususmodel->get_simpanankhusus_by_id_nasabah($id_nasabah);
		$data['simpanandanasosial'] = $this->simpanandanasosialmodel->get_simpanandanasosial_by_id_nasabah($id_nasabah);
		$data['simpanankanzun'] 	= $this->simpanankanzunmodel->get_simpanankanzun_by_id_nasabah($id_nasabah);
		$data['simpanan3th'] 		= $this->simpanan3thmodel->get_simpanan3th_by_id_nasabah($id_nasabah);
		$data['simpananpihakketiga']= $this->simpananpihakketigamodel->get_simpananpihakketiga_by_id_nasabah($id_nasabah);
		$data['username'] 			= $session_data['username'];
		$data['status'] 			= $session_data['status'];

		$this->load->view('/layouts/menu', $data);
		$this->load->view('/transaksianggota/create_pinjaman', $data);
		$this->load->view('/layouts/footer', $data);
	}

	function insert_pinjaman($id_nasabah) {
		$session_data = $this->session->userdata('logged_in');
		if($session_data == NULL) {
			redirect("usercon/login", "refresh");
		}

		$insert = array();
		$insert['id'] 						= $this->pinjamanmodel->getNewId();
		$insert['id_nasabah'] 				= $this->input->post('id_nasabah');
		$insert['nomor_nasabah'] 			= $this->input->post('nomor_nasabah');
		$insert['nama_nasabah'] 			= $this->input->post('nama_nasabah');
		$insert['nik_nasabah'] 				= $this->input->post('nik_nasabah');
		$insert['jenis_pinjaman'] 			= $this->input->post('jenis_pinjaman');
		$insert['jaminan'] 					= $this->input->post('jaminan');
		$date1 								= $this->input->post('waktu');
		$date 								= strtotime($date1);
		$insert['waktu'] 					= date("Y-m-d",$date);
		$insert['jatuh_tempo'] 				= $this->input->post('jatuh_tempo');
		$insert['jumlah_pinjaman'] 			= $this->input->post('jumlah_pinjaman');
		$insert['jumlah_angsuran'] 			= $this->input->post('jumlah_angsuran');
		$insert['angsuran_perbulan'] 		= $this->input->post('angsuran_perbulan');
		$insert['jasa_perbulan'] 			= $this->input->post('jasa_perbulan');
		$insert['total_angsuran_perbulan'] 	= $this->input->post('total_angsuran_perbulan');
		$insert['sisa_angsuran'] 			= $this->input->post('jumlah_pinjaman');

		$detail = array();
		$detail['waktu'] 		= $insert['waktu'];
		$detail['id_pinjaman'] 	= $insert['id'];
		$detail['jenis'] 		= "Pinjaman";
		$detail['total'] 		= $insert['jumlah_pinjaman'];
		
		$this->pinjamanmodel->inputData($insert);
		$this->detailangsuranmodel->inputData($detail);

		redirect('transaksianggotacon/pinjaman/'.$id_nasabah);
	}

	function edit_pinjaman($id_pinjaman) {
		$session_data = $this->session->userdata('logged_in');
		if($session_data == NULL) {
			redirect("usercon/login", "refresh");
		}

		$data['pinjaman'] 			= $this->pinjamanmodel->get_pinjaman_by_id($id_pinjaman);

		$id_nasabah					= $data['pinjaman']->id_nasabah;

		$data['nasabah'] 			= $this->nasabahmodel->get_nasabah_by_id($id_nasabah);
		$data['simpananpokok'] 		= $this->simpananpokokmodel->get_simpananpokok_by_id_nasabah($id_nasabah);
		$data['simpananwajib'] 		= $this->simpananwajibmodel->get_simpananwajib_by_id_nasabah($id_nasabah);
		$data['simpanankhusus'] 	= $this->simpanankhususmodel->get_simpanankhusus_by_id_nasabah($id_nasabah);
		$data['simpanandanasosial'] = $this->simpanandanasosialmodel->get_simpanandanasosial_by_id_nasabah($id_nasabah);
		$data['simpanankanzun'] 	= $this->simpanankanzunmodel->get_simpanankanzun_by_id_nasabah($id_nasabah);
		$data['simpanan3th'] 		= $this->simpanan3thmodel->get_simpanan3th_by_id_nasabah($id_nasabah);
		$data['simpananpihakketiga']= $this->simpananpihakketigamodel->get_simpananpihakketiga_by_id_nasabah($id_nasabah);
		$data['username'] 			= $session_data['username'];
		$data['status'] 			= $session_data['status'];
		
		$this->load->view('/layouts/menu', $data);
		$this->load->view('/transaksianggota/edit_pinjaman', $data);
		$this->load->view('/layouts/footer', $data);
	}

	function update_pinjaman() {
		$session_data = $this->session->userdata('logged_in');
		if($session_data == NULL) {
			redirect("usercon/login", "refresh");
		}

		$id_pinjaman = $this->input->post('id_pinjaman');
		$update = array();
		$update['id_nasabah'] 				= $this->input->post('id_nasabah');
		$update['nama_nasabah'] 			= $this->input->post('nama_nasabah');
		$update['nomor_nasabah'] 			= $this->input->post('nomor_nasabah');
		$update['nik_nasabah'] 				= $this->input->post('nik_nasabah');
		$update['jenis_pinjaman'] 			= $this->input->post('jenis_pinjaman');
		$update['jaminan'] 					= $this->input->post('jaminan');
		$date1 								= $this->input->post('waktu');
		$date 								= strtotime($date1);
		$update['waktu'] 					= date("Y-m-d",$date);
		$update['jatuh_tempo'] 				= $this->input->post('jatuh_tempo');
		$update['jumlah_pinjaman'] 			= $this->input->post('jumlah_pinjaman');
		$update['jumlah_angsuran'] 			= $this->input->post('jumlah_angsuran');
		$update['angsuran_perbulan'] 		= $this->input->post('angsuran_perbulan');
		$update['jasa_perbulan'] 			= $this->input->post('jasa_perbulan');
		$update['total_angsuran_perbulan'] 	= $this->input->post('total_angsuran_perbulan');
		$this->pinjamanmodel->updateData($id_pinjaman, $update);

		$id_nasabah = $update['id_nasabah'];

		redirect('transaksianggotacon/pinjaman/'.$id_nasabah);
	}

	function delete_pinjaman($id_pinjaman) {
		$session_data = $this->session->userdata('logged_in');
		if($session_data == NULL) {
			redirect("usercon/login", "refresh");
		}

		$data['pinjaman'] 			= $this->pinjamanmodel->get_pinjaman_by_id($id_pinjaman);

		$id_nasabah					= $data['pinjaman']->id_nasabah;

		$this->pinjamanmodel->deleteData($id_pinjaman);
		$this->detailangsuranmodel->delete_by_id_pinjaman($id_pinjaman);

		redirect('transaksianggotacon/pinjaman/'.$id_nasabah);
	}

	function view_pinjaman($id_pinjaman) {
		$session_data = $this->session->userdata('logged_in');
		if($session_data == NULL) {
			redirect("usercon/login", "refresh");
		}

		$data['pinjaman'] 			= $this->pinjamanmodel->get_pinjaman_by_id($id_pinjaman);
		$data['detail_angsuran'] 	= $this->detailangsuranmodel->get_detail_angsuran_by_id_pinjaman($id_pinjaman);
		$id_nasabah					= $data['pinjaman']->id_nasabah;
		$data['nasabah'] 			= $this->nasabahmodel->get_nasabah_by_id($id_nasabah);
		$data['simpananpokok'] 		= $this->simpananpokokmodel->get_simpananpokok_by_id_nasabah($id_nasabah);
		$data['simpananwajib'] 		= $this->simpananwajibmodel->get_simpananwajib_by_id_nasabah($id_nasabah);
		$data['simpanankhusus'] 	= $this->simpanankhususmodel->get_simpanankhusus_by_id_nasabah($id_nasabah);
		$data['simpanandanasosial'] = $this->simpanandanasosialmodel->get_simpanandanasosial_by_id_nasabah($id_nasabah);
		$data['simpanankanzun'] 	= $this->simpanankanzunmodel->get_simpanankanzun_by_id_nasabah($id_nasabah);
		$data['simpanan3th'] 		= $this->simpanan3thmodel->get_simpanan3th_by_id_nasabah($id_nasabah);
		$data['simpananpihakketiga']= $this->simpananpihakketigamodel->get_simpananpihakketiga_by_id_nasabah($id_nasabah);
		$data['username'] 			= $session_data['username'];
		$data['status'] 			= $session_data['status'];
		
		$this->load->view('/layouts/menu', $data);
		$this->load->view('/transaksianggota/view_pinjaman', $data);
		$this->load->view('/layouts/footer', $data);
	}

	function insert_detail_angsuran($id_nasabah) {
		$session_data = $this->session->userdata('logged_in');
		if($session_data == NULL) {
			redirect("usercon/login", "refresh");
		}

		// Insert Detail Angsuran ke dalam table detail_angsuran
		$date1 					= $this->input->post('waktu');
		$date 					= strtotime($date1);
		$input['waktu'] 		= date("Y-m-d",$date);
		$input['bulan_ke'] 		= $this->input->post('bulan_ke');
		$input['jenis'] 		= $this->input->post('jenis');
		$input['id_pinjaman'] 	= $this->input->post('id_pinjaman');
		$input['angsuran'] 		= $this->input->post('angsuran');
		$input['jasa'] 			= $this->input->post('jasa');
		$input['denda'] 		= $this->input->post('denda');
		$input['total'] 		= $this->input->post('total');
		$this->detailangsuranmodel->inputData($input);

		$id_pinjaman = $this->input->post('id_pinjaman');
		$data['pinjaman'] = $this->pinjamanmodel->get_pinjaman_by_id($id_pinjaman);

		if($input['jenis'] == 'Pinjaman') {
			//Update Sisa Angsuran Jika Jenis Transaksi 'Pinjaman'
			$sisa_angsuran = $data['pinjaman']->sisa_angsuran;
			$sisa_angsuran = $sisa_angsuran + $input['total'];
			$this->pinjamanmodel->update_sisa_angsuran($id_pinjaman, $sisa_angsuran);

			//Update Jumlah Pinjaman Jika Jenis Transaksi 'Pinjaman'
			$jumlah_pinjaman = $data['pinjaman']->jumlah_pinjaman;
			$jumlah_pinjaman = $jumlah_pinjaman + $input['total'];
			$this->pinjamanmodel->update_jumlah_pinjaman($id_pinjaman, $jumlah_pinjaman);

			//Update Angsuran Per Bulan Jika Jenis Transaksi 'Pinjaman'
			$data['pinjaman'] = $this->pinjamanmodel->get_pinjaman_by_id($id_pinjaman);
			$max_angsuran = $this->detailangsuranmodel->get_max_bulanke($id_pinjaman);
			if($max_angsuran == NULL || $max_angsuran == 0 || $max_angsuran == '0') {
				$sisa_angsuran = $data['pinjaman']->sisa_angsuran;
				$angsuran_perbulan = $sisa_angsuran / $data['pinjaman']->jumlah_angsuran;
				$this->pinjamanmodel->update_angsuran_perbulan($id_pinjaman, $angsuran_perbulan);
			} else {
				$sisa_angsuran = $data['pinjaman']->sisa_angsuran;
				$sisa_jumlah_angsuran = $data['pinjaman']->jumlah_angsuran - $max_angsuran;
				$angsuran_perbulan = $sisa_angsuran / $sisa_jumlah_angsuran;
				$this->pinjamanmodel->update_angsuran_perbulan($id_pinjaman, $angsuran_perbulan);
			}
		} else if($input['jenis'] == 'Angsuran') {
			//Update Sisa Angsuran Jika Jenis Transaksi 'Angsuran'
			$sisa_angsuran = $data['pinjaman']->sisa_angsuran;
			$sisa_angsuran = $sisa_angsuran - $input['angsuran'];
			$this->pinjamanmodel->update_sisa_angsuran($id_pinjaman, $sisa_angsuran);
		}

		//Updte Jasa Perbulan, Total Angsuran Per Bulan ketik Jenis Pinjaman = 'Musiman'
		$data['pinjaman'] = $this->pinjamanmodel->get_pinjaman_by_id($id_pinjaman);
		$sisa_angsuran = $data['pinjaman']->sisa_angsuran;
		if($data['pinjaman']->jenis_pinjaman == "Musiman") {
			$jasa_perbulan = ($sisa_angsuran * 3) / 100;
			$total_angsuran_perbulan = $data['pinjaman']->angsuran_perbulan + $jasa_perbulan;
			$this->pinjamanmodel->update_jasa_total_angsuran_perbulan($id_pinjaman, $jasa_perbulan, $total_angsuran_perbulan);
		}
		
		redirect('transaksianggotacon/view_pinjaman/'.$id_pinjaman);
	}

	function edit_detail_angsuran($id_pinjaman, $id_detail_angsuran) {
		$session_data = $this->session->userdata('logged_in');
		if($session_data == NULL) {
			redirect("usercon/login", "refresh");
		}

		// Get Pinjaman Sesuai dengan id_pinjaman
		$update = $this->pinjamanmodel->get_pinjaman_by_id($id_pinjaman);
		// Get Detail ANgsuran Sesuai dengan id_detail_pinjaman
		$prev 	= $this->detailangsuranmodel->get_detail_angsuran_by_id($id_detail_angsuran);

		if($prev->jenis == 'Pinjaman') {
			//Update Sisa Angsuran Jika Jenis Transaksi 'Pinjaman'
			$sisa_angsuran = $update->sisa_angsuran;
			$sisa_angsuran = $sisa_angsuran - $prev->total;
			$this->pinjamanmodel->update_sisa_angsuran($id_pinjaman, $sisa_angsuran);

			//Update Jumlah Pinjaman Jika Jenis Transaksi 'Pinjaman'
			$jumlah_pinjaman = $update->jumlah_pinjaman;
			$jumlah_pinjaman = $jumlah_pinjaman - $prev->total;
			$this->pinjamanmodel->update_jumlah_pinjaman($id_pinjaman, $jumlah_pinjaman);

			//Update Angsuran Per Bulan Jika Jenis Transaksi 'Pinjaman'
			$update = $this->pinjamanmodel->get_pinjaman_by_id($id_pinjaman);
			$max_angsuran = $this->detailangsuranmodel->get_max_bulanke($id_pinjaman);
			if($max_angsuran == NULL || $max_angsuran == 0 || $max_angsuran == '0') {
				$sisa_angsuran = $update->sisa_angsuran;
				$angsuran_perbulan = $sisa_angsuran / $update->jumlah_angsuran;
				$this->pinjamanmodel->update_angsuran_perbulan($id_pinjaman, $angsuran_perbulan);
			} else {
				$sisa_angsuran = $update->sisa_angsuran;
				$sisa_jumlah_angsuran = $update->jumlah_angsuran - $max_angsuran;
				$angsuran_perbulan = $sisa_angsuran / $sisa_jumlah_angsuran;
				$this->pinjamanmodel->update_angsuran_perbulan($id_pinjaman, $angsuran_perbulan);
			}
		} else if($prev->jenis == 'Angsuran') {
			$sisa 	= $update->sisa_angsuran + $prev->angsuran;
			$this->pinjamanmodel->update_sisa_angsuran($id_pinjaman, $sisa);	
		}

		//Updte Jasa Perbulan, Total Angsuran Per Bulan ketik Jenis Pinjaman = 'Musiman'
		$update = $this->pinjamanmodel->get_pinjaman_by_id($id_pinjaman);
		$sisa_angsuran = $update->sisa_angsuran;
		if($update->jenis_pinjaman == "Musiman") {
			$jasa_perbulan = ($sisa_angsuran * 3) / 100;
			$total_angsuran_perbulan = $update->angsuran_perbulan + $jasa_perbulan;
			$this->pinjamanmodel->update_jasa_total_angsuran_perbulan($id_pinjaman, $jasa_perbulan, $total_angsuran_perbulan);
		}
		
		$data['pinjaman'] 				= $this->pinjamanmodel->get_pinjaman_by_id($id_pinjaman);
		$id_nasabah						= $data['pinjaman']->id_nasabah;
		$data['detail_angsuran'] 		= $this->detailangsuranmodel->get_detail_angsuran_by_id_pinjaman($id_pinjaman);
		$data['edit_detail_angsuran'] 	= $this->detailangsuranmodel->get_detail_angsuran_by_id($id_detail_angsuran);
		$data['nasabah'] 				= $this->nasabahmodel->get_nasabah_by_id($id_nasabah);
		$data['simpananpokok'] 			= $this->simpananpokokmodel->get_simpananpokok_by_id_nasabah($id_nasabah);
		$data['simpananwajib'] 			= $this->simpananwajibmodel->get_simpananwajib_by_id_nasabah($id_nasabah);
		$data['simpanankhusus'] 		= $this->simpanankhususmodel->get_simpanankhusus_by_id_nasabah($id_nasabah);
		$data['simpanandanasosial'] 	= $this->simpanandanasosialmodel->get_simpanandanasosial_by_id_nasabah($id_nasabah);
		$data['simpanankanzun'] 		= $this->simpanankanzunmodel->get_simpanankanzun_by_id_nasabah($id_nasabah);
		$data['simpanan3th'] 			= $this->simpanan3thmodel->get_simpanan3th_by_id_nasabah($id_nasabah);
		$data['simpananpihakketiga']	= $this->simpananpihakketigamodel->get_simpananpihakketiga_by_id_nasabah($id_nasabah);
		$data['username'] 				= $session_data['username'];
		$data['status'] 				= $session_data['status'];
		
		$this->load->view('/layouts/menu', $data);
		$this->load->view('/transaksianggota/view_pinjaman_edit_angsuran', $data);
		$this->load->view('/layouts/footer', $data);
	}

	function update_detail_angsuran() {
		$session_data = $this->session->userdata('logged_in');
		if($session_data == NULL) {
			redirect("usercon/login", "refresh");
		}

		//Update Detail Angsuran ke dalam table detail_angsuran
		$id_detail_angsuran 	= $this->input->post('edit_id');
		$date1 					= $this->input->post('edit_waktu');
		$date 					= strtotime($date1);
		$input['waktu'] 		= date("Y-m-d",$date);
		$input['bulan_ke'] 		= $this->input->post('edit_bulan_ke');
		$input['jenis'] 		= $this->input->post('edit_jenis');
		$input['id_pinjaman'] 	= $this->input->post('edit_id_pinjaman');
		$input['angsuran'] 		= $this->input->post('edit_angsuran');
		$input['jasa'] 			= $this->input->post('edit_jasa');
		$input['denda'] 		= $this->input->post('edit_denda');
		$input['total'] 		= $this->input->post('edit_total');

		$this->detailangsuranmodel->updateData($id_detail_angsuran, $input);

		$id_pinjaman = $this->input->post('edit_id_pinjaman');
		$data['pinjaman'] = $this->pinjamanmodel->get_pinjaman_by_id($id_pinjaman);

		if($input['jenis'] == 'Pinjaman') {
			//Update Sisa Angsuran Jika Jenis Transaksi 'Pinjaman'
			$sisa_angsuran = $data['pinjaman']->sisa_angsuran;
			$sisa_angsuran = $sisa_angsuran + $input['total'];
			$this->pinjamanmodel->update_sisa_angsuran($id_pinjaman, $sisa_angsuran);

			//Update Jumlah Pinjaman Jika Jenis Transaksi 'Pinjaman'
			$jumlah_pinjaman = $data['pinjaman']->jumlah_pinjaman;
			$jumlah_pinjaman = $jumlah_pinjaman + $input['total'];
			$this->pinjamanmodel->update_jumlah_pinjaman($id_pinjaman, $jumlah_pinjaman);

			//Update Angsuran Per Bulan Jika Jenis Transaksi 'Pinjaman'
			$data['pinjaman'] = $this->pinjamanmodel->get_pinjaman_by_id($id_pinjaman);
			$max_angsuran = $this->detailangsuranmodel->get_max_bulanke($id_pinjaman);
			if($max_angsuran == NULL || $max_angsuran == 0 || $max_angsuran == '0') {
				$sisa_angsuran = $data['pinjaman']->sisa_angsuran;
				$angsuran_perbulan = $sisa_angsuran / $data['pinjaman']->jumlah_angsuran;
				$this->pinjamanmodel->update_angsuran_perbulan($id_pinjaman, $angsuran_perbulan);
			} else {
				$sisa_angsuran = $data['pinjaman']->sisa_angsuran;
				$sisa_jumlah_angsuran = $data['pinjaman']->jumlah_angsuran - $max_angsuran;
				$angsuran_perbulan = $sisa_angsuran / $sisa_jumlah_angsuran;
				$this->pinjamanmodel->update_angsuran_perbulan($id_pinjaman, $angsuran_perbulan);
			}
		} else if($input['jenis'] == 'Angsuran') {
			//Update Sisa Angsuran Jika Jenis Transaksi 'Angsuran'
			$sisa_angsuran = $data['pinjaman']->sisa_angsuran;
			$sisa_angsuran = $sisa_angsuran - $input['angsuran'];
			$this->pinjamanmodel->update_sisa_angsuran($id_pinjaman, $sisa_angsuran);
		}

		//Updte Jasa Perbulan, Total Angsuran Per Bulan ketik Jenis Pinjaman = 'Musiman'
		$data['pinjaman'] = $this->pinjamanmodel->get_pinjaman_by_id($id_pinjaman);
		$sisa_angsuran = $data['pinjaman']->sisa_angsuran;
		if($data['pinjaman']->jenis_pinjaman == "Musiman") {
			$jasa_perbulan = ($sisa_angsuran * 3) / 100;
			$total_angsuran_perbulan = $data['pinjaman']->angsuran_perbulan + $jasa_perbulan;
			$this->pinjamanmodel->update_jasa_total_angsuran_perbulan($id_pinjaman, $jasa_perbulan, $total_angsuran_perbulan);
		}

		redirect('transaksianggotacon/view_pinjaman/'.$id_pinjaman);
	}

	function delete_detail_angsuran($id_pinjaman, $id_detail_angsuran) {
		$session_data = $this->session->userdata('logged_in');
		if($session_data == NULL) {
			redirect("usercon/login", "refresh");
		}

		// Get Pinjaman Sesuai dengan id_pinjaman
		$update = $this->pinjamanmodel->get_pinjaman_by_id($id_pinjaman);
		// Get Detail ANgsuran Sesuai dengan id_detail_pinjaman
		$prev 	= $this->detailangsuranmodel->get_detail_angsuran_by_id($id_detail_angsuran);

		if($prev->jenis == 'Pinjaman') {
			//Update Sisa Angsuran Jika Jenis Transaksi 'Pinjaman'
			$sisa_angsuran = $update->sisa_angsuran;
			$sisa_angsuran = $sisa_angsuran - $prev->total;
			$this->pinjamanmodel->update_sisa_angsuran($id_pinjaman, $sisa_angsuran);

			//Update Jumlah Pinjaman Jika Jenis Transaksi 'Pinjaman'
			$jumlah_pinjaman = $update->jumlah_pinjaman;
			$jumlah_pinjaman = $jumlah_pinjaman - $prev->total;
			$this->pinjamanmodel->update_jumlah_pinjaman($id_pinjaman, $jumlah_pinjaman);

			//Update Angsuran Per Bulan Jika Jenis Transaksi 'Pinjaman'
			$update = $this->pinjamanmodel->get_pinjaman_by_id($id_pinjaman);
			$max_angsuran = $this->detailangsuranmodel->get_max_bulanke($id_pinjaman);
			if($max_angsuran == NULL || $max_angsuran == 0 || $max_angsuran == '0') {
				$sisa_angsuran = $update->sisa_angsuran;
				$angsuran_perbulan = $sisa_angsuran / $update->jumlah_angsuran;
				$this->pinjamanmodel->update_angsuran_perbulan($id_pinjaman, $angsuran_perbulan);
			} else {
				$sisa_angsuran = $update->sisa_angsuran;
				$sisa_jumlah_angsuran = $update->jumlah_angsuran - $max_angsuran;
				$angsuran_perbulan = $sisa_angsuran / $sisa_jumlah_angsuran;
				$this->pinjamanmodel->update_angsuran_perbulan($id_pinjaman, $angsuran_perbulan);
			}
		} else if($prev->jenis == 'Angsuran') {
			$sisa 	= $update->sisa_angsuran + $prev->angsuran;
			$this->pinjamanmodel->update_sisa_angsuran($id_pinjaman, $sisa);	
		}

		//Updte Jasa Perbulan, Total Angsuran Per Bulan ketik Jenis Pinjaman = 'Musiman'
		$update = $this->pinjamanmodel->get_pinjaman_by_id($id_pinjaman);
		$sisa_angsuran = $update->sisa_angsuran;
		if($update->jenis_pinjaman == "Musiman") {
			$jasa_perbulan = ($sisa_angsuran * 3) / 100;
			$total_angsuran_perbulan = $update->angsuran_perbulan + $jasa_perbulan;
			$this->pinjamanmodel->update_jasa_total_angsuran_perbulan($id_pinjaman, $jasa_perbulan, $total_angsuran_perbulan);
		}

		//Delete Detail Angsuran
		$this->detailangsuranmodel->deleteData($id_detail_angsuran);

		redirect('transaksianggotacon/view_pinjaman/'.$id_pinjaman);
	}

	function angsuran_post_akuntansi($id_pinjaman, $id_detail_angsuran) {
		$session_data = $this->session->userdata('logged_in');
		if($session_data == NULL) {
			redirect("usercon/login", "refresh");
		}

		$data = array();
		$data['pinjaman'] 				= $this->pinjamanmodel->get_pinjaman_by_id($id_pinjaman);
		$data['post_detail_angsuran'] 	= $this->detailangsuranmodel->get_detail_angsuran_by_id($id_detail_angsuran);

		// Posting Akuntansi
		if($data['post_detail_angsuran']->jenis == "Angsuran") {
			/* Posting Akuntansi Untuk Angsuran */
			$mapping_kode_akun = $this->mappingkodeakunmodel->get_mapping_kode_akun_by_nama_transaksi('penerimaan piutang');
			$debet 		= $this->kodeakunmodel->get_kode_akun_by_kode($mapping_kode_akun->kode_debet);
			$kredit 	= $this->kodeakunmodel->get_kode_akun_by_kode($mapping_kode_akun->kode_kredit);

			$data_debet 				= array();
			$data_debet['id'] 			= $this->transaksiakuntansimodel->getNewId();
			$data_debet['tanggal'] 		= $data['post_detail_angsuran']->waktu;
			$data_debet['kode_akun'] 	= $mapping_kode_akun->kode_debet;
			$data_debet['nama_akun'] 	= $debet->nama_akun;
			$data_debet['keterangan'] 	= "Pembayaran Angsuran Pinjaman Bulan ke-".$data['post_detail_angsuran']->bulan_ke." Anggota a.n. ".$data['pinjaman']->nama_nasabah." Nomor Anggota: ".$data['pinjaman']->nomor_nasabah;
			$data_debet['jumlah'] 		= $data['post_detail_angsuran']->angsuran;
			$data_debet['debet'] 		= $data['post_detail_angsuran']->angsuran;
			$data_debet['kredit'] 		= 0;
			$this->transaksiakuntansimodel->inputData($data_debet);

			$data_kredit 				= array();
			$data_kredit['id'] 			= $this->transaksiakuntansimodel->getNewId();
			$data_kredit['tanggal'] 	= $data['post_detail_angsuran']->waktu;
			$data_kredit['kode_akun'] 	= $mapping_kode_akun->kode_kredit;
			$data_kredit['nama_akun'] 	= $kredit->nama_akun;
			$data_kredit['keterangan'] 	= "Pembayaran Angsuran Pinjaman Bulan ke-".$data['post_detail_angsuran']->bulan_ke." Anggota a.n. ".$data['pinjaman']->nama_nasabah." Nomor Anggota: ".$data['pinjaman']->nomor_nasabah;
			$data_kredit['jumlah'] 		= $data['post_detail_angsuran']->angsuran;
			$data_kredit['debet'] 		= 0;
			$data_kredit['kredit'] 		= $data['post_detail_angsuran']->angsuran;
			$this->transaksiakuntansimodel->inputData($data_kredit);

			$update = array();
			$id 					= $data['post_detail_angsuran']->id;
			$update['waktu'] 		= $data['post_detail_angsuran']->waktu;
			$update['bulan_ke'] 	= $data['post_detail_angsuran']->bulan_ke;
			$update['jenis'] 		= $data['post_detail_angsuran']->jenis;
			$update['id_pinjaman'] 	= $data['post_detail_angsuran']->id_pinjaman;
			$update['angsuran'] 	= $data['post_detail_angsuran']->angsuran;
			$update['jasa'] 		= $data['post_detail_angsuran']->jasa;
			$update['denda'] 		= $data['post_detail_angsuran']->denda;
			$update['total'] 		= $data['post_detail_angsuran']->total;
			$update['status_post']	= 1;
			if($data['post_detail_angsuran']->id_debet_transaksi_akuntansi == NULL || $data['post_detail_angsuran']->id_debet_transaksi_akuntansi == "0") {
				$update['id_debet_transaksi_akuntansi']	= $data_debet['id'];
			} else {
				$update['id_debet_transaksi_akuntansi']	= $data['post_detail_angsuran']->id_debet_transaksi_akuntansi.",".$data_debet['id'];
			}
			if($data['post_detail_angsuran']->id_kredit_transaksi_akuntansi == NULL || $data['post_detail_angsuran']->id_kredit_transaksi_akuntansi == "0") {
				$update['id_kredit_transaksi_akuntansi']	= $data_kredit['id'];
			} else {
				$update['id_kredit_transaksi_akuntansi']	= $data['post_detail_angsuran']->id_kredit_transaksi_akuntansi.",".$data_kredit['id'];
			}
			$this->detailangsuranmodel->updateData($id, $update);
			/* End of Posting Akuntansi Untuk Angsuran */

			$data['post_detail_angsuran'] 	= $this->detailangsuranmodel->get_detail_angsuran_by_id($id_detail_angsuran);
			/* Posting Akuntansi Untuk Jasa */
			$mapping_kode_akun = $this->mappingkodeakunmodel->get_mapping_kode_akun_by_nama_transaksi('penerimaan jasa');
			$debet 		= $this->kodeakunmodel->get_kode_akun_by_kode($mapping_kode_akun->kode_debet);
			$kredit 	= $this->kodeakunmodel->get_kode_akun_by_kode($mapping_kode_akun->kode_kredit);

			$data_debet 				= array();
			$data_debet['id'] 			= $this->transaksiakuntansimodel->getNewId();
			$data_debet['tanggal'] 		= $data['post_detail_angsuran']->waktu;
			$data_debet['kode_akun'] 	= $mapping_kode_akun->kode_debet;
			$data_debet['nama_akun'] 	= $debet->nama_akun;
			$data_debet['keterangan'] 	= "Jasa Pembayaran Angsuran Pinjaman Bulan ke-".$data['post_detail_angsuran']->bulan_ke." Anggota a.n. ".$data['pinjaman']->nama_nasabah." Nomor Anggota: ".$data['pinjaman']->nomor_nasabah;
			$data_debet['jumlah'] 		= $data['post_detail_angsuran']->jasa + $data['post_detail_angsuran']->denda;
			$data_debet['debet'] 		= $data['post_detail_angsuran']->jasa + $data['post_detail_angsuran']->denda;
			$data_debet['kredit'] 		= 0;
			$this->transaksiakuntansimodel->inputData($data_debet);

			$data_kredit 				= array();
			$data_kredit['id'] 			= $this->transaksiakuntansimodel->getNewId();
			$data_kredit['tanggal'] 	= $data['post_detail_angsuran']->waktu;
			$data_kredit['kode_akun'] 	= $mapping_kode_akun->kode_kredit;
			$data_kredit['nama_akun'] 	= $kredit->nama_akun;
			$data_kredit['keterangan'] 	= "Jasa Pembayaran Angsuran Pinjaman Bulan ke-".$data['post_detail_angsuran']->bulan_ke." Anggota a.n. ".$data['pinjaman']->nama_nasabah." Nomor Anggota: ".$data['pinjaman']->nomor_nasabah;
			$data_kredit['jumlah'] 		= $data['post_detail_angsuran']->jasa + $data['post_detail_angsuran']->denda;
			$data_kredit['debet'] 		= 0;
			$data_kredit['kredit'] 		= $data['post_detail_angsuran']->jasa + $data['post_detail_angsuran']->denda;
			$this->transaksiakuntansimodel->inputData($data_kredit);

			$update = array();
			$id 					= $data['post_detail_angsuran']->id;
			$update['waktu'] 		= $data['post_detail_angsuran']->waktu;
			$update['bulan_ke'] 	= $data['post_detail_angsuran']->bulan_ke;
			$update['jenis'] 		= $data['post_detail_angsuran']->jenis;
			$update['id_pinjaman'] 	= $data['post_detail_angsuran']->id_pinjaman;
			$update['angsuran'] 	= $data['post_detail_angsuran']->angsuran;
			$update['jasa'] 		= $data['post_detail_angsuran']->jasa;
			$update['denda'] 		= $data['post_detail_angsuran']->denda;
			$update['total'] 		= $data['post_detail_angsuran']->total;
			$update['status_post']	= 1;
			if($data['post_detail_angsuran']->id_debet_transaksi_akuntansi == NULL || $data['post_detail_angsuran']->id_debet_transaksi_akuntansi == "0") {
				$update['id_debet_transaksi_akuntansi']	= $data_debet['id'];
			} else {
				$update['id_debet_transaksi_akuntansi']	= $data['post_detail_angsuran']->id_debet_transaksi_akuntansi.",".$data_debet['id'];
			}
			if($data['post_detail_angsuran']->id_kredit_transaksi_akuntansi == NULL || $data['post_detail_angsuran']->id_kredit_transaksi_akuntansi == "0") {
				$update['id_kredit_transaksi_akuntansi']	= $data_kredit['id'];
			} else {
				$update['id_kredit_transaksi_akuntansi']	= $data['post_detail_angsuran']->id_kredit_transaksi_akuntansi.",".$data_kredit['id'];
			}
			$this->detailangsuranmodel->updateData($id, $update);
			/* End of Posting Akuntansi Untuk Jasa */
		} else {
			/* Posting Akuntansi Untuk Pemberian Pinjaman */
			$mapping_kode_akun = $this->mappingkodeakunmodel->get_mapping_kode_akun_by_nama_transaksi('pemberian pinjaman');
			$debet 		= $this->kodeakunmodel->get_kode_akun_by_kode($mapping_kode_akun->kode_debet);
			$kredit 	= $this->kodeakunmodel->get_kode_akun_by_kode($mapping_kode_akun->kode_kredit);

			$data_debet 				= array();
			$data_debet['id'] 			= $this->transaksiakuntansimodel->getNewId();
			$data_debet['tanggal'] 		= $data['post_detail_angsuran']->waktu;
			$data_debet['kode_akun'] 	= $mapping_kode_akun->kode_debet;
			$data_debet['nama_akun'] 	= $debet->nama_akun;
			$data_debet['keterangan'] 	= "Pemberian Pinjaman kepada Anggota a.n. ".$data['pinjaman']->nama_nasabah." Nomor Anggota: ".$data['pinjaman']->nomor_nasabah;
			$data_debet['jumlah'] 		= $data['post_detail_angsuran']->total;
			$data_debet['debet'] 		= $data['post_detail_angsuran']->total;
			$data_debet['kredit'] 		= 0;
			$this->transaksiakuntansimodel->inputData($data_debet);

			$data_kredit 				= array();
			$data_kredit['id'] 			= $this->transaksiakuntansimodel->getNewId();
			$data_kredit['tanggal'] 	= $data['post_detail_angsuran']->waktu;
			$data_kredit['kode_akun'] 	= $mapping_kode_akun->kode_kredit;
			$data_kredit['nama_akun'] 	= $kredit->nama_akun;
			$data_kredit['keterangan'] 	= "Pemberian Pinjaman kepada Anggota a.n. ".$data['pinjaman']->nama_nasabah." Nomor Anggota: ".$data['pinjaman']->nomor_nasabah;
			$data_kredit['jumlah'] 		= $data['post_detail_angsuran']->total;
			$data_kredit['debet'] 		= 0;
			$data_kredit['kredit'] 		= $data['post_detail_angsuran']->total;
			$this->transaksiakuntansimodel->inputData($data_kredit);

			$update = array();
			$id 					= $data['post_detail_angsuran']->id;
			$update['waktu'] 		= $data['post_detail_angsuran']->waktu;
			$update['bulan_ke'] 	= $data['post_detail_angsuran']->bulan_ke;
			$update['jenis'] 		= $data['post_detail_angsuran']->jenis;
			$update['id_pinjaman'] 	= $data['post_detail_angsuran']->id_pinjaman;
			$update['angsuran'] 	= $data['post_detail_angsuran']->angsuran;
			$update['jasa'] 		= $data['post_detail_angsuran']->jasa;
			$update['denda'] 		= $data['post_detail_angsuran']->denda;
			$update['total'] 		= $data['post_detail_angsuran']->total;
			$update['status_post']	= 1;
			if($data['post_detail_angsuran']->id_debet_transaksi_akuntansi == NULL || $data['post_detail_angsuran']->id_debet_transaksi_akuntansi == "0") {
				$update['id_debet_transaksi_akuntansi']	= $data_debet['id'];
			} else {
				$update['id_debet_transaksi_akuntansi']	= $data['post_detail_angsuran']->id_debet_transaksi_akuntansi.",".$data_debet['id'];
			}
			if($data['post_detail_angsuran']->id_kredit_transaksi_akuntansi == NULL || $data['post_detail_angsuran']->id_kredit_transaksi_akuntansi == "0") {
				$update['id_kredit_transaksi_akuntansi']	= $data_kredit['id'];
			} else {
				$update['id_kredit_transaksi_akuntansi']	= $data['post_detail_angsuran']->id_kredit_transaksi_akuntansi.",".$data_kredit['id'];
			}
			$this->detailangsuranmodel->updateData($id, $update);
			/* End of Posting Akuntansi Untuk Pemberian Pinjaman */
		}

		redirect('transaksianggotacon/view_pinjaman/'.$id_pinjaman);
	}

	function angsuran_unpost_akuntansi($id_pinjaman, $id_detail_angsuran) {
		$session_data = $this->session->userdata('logged_in');
		if($session_data == NULL) {
			redirect("usercon/login", "refresh");
		}

		$data = array();
		$data['pinjaman'] 				= $this->pinjamanmodel->get_pinjaman_by_id($id_pinjaman);
		$data['post_detail_angsuran'] 	= $this->detailangsuranmodel->get_detail_angsuran_by_id($id_detail_angsuran);

		$id_debet_transaksi_akuntansi 	= $data['post_detail_angsuran']->id_debet_transaksi_akuntansi;
		$id_kredit_transaksi_akuntansi 	= $data['post_detail_angsuran']->id_kredit_transaksi_akuntansi;

		$id_debet 	= explode(",", $id_debet_transaksi_akuntansi);
		$id_kredit 	= explode(",", $id_kredit_transaksi_akuntansi);

		for($i = 0; $i < sizeof($id_debet); $i++) {
			$this->transaksiakuntansimodel->deleteData($id_debet[$i]);
		}

		for($i = 0; $i < sizeof($id_kredit); $i++) {
			$this->transaksiakuntansimodel->deleteData($id_kredit[$i]);
		}

		$update = array();
		$id 									= $data['post_detail_angsuran']->id;
		$update['waktu'] 						= $data['post_detail_angsuran']->waktu;
		$update['bulan_ke'] 					= $data['post_detail_angsuran']->bulan_ke;
		$update['jenis'] 						= $data['post_detail_angsuran']->jenis;
		$update['id_pinjaman'] 					= $data['post_detail_angsuran']->id_pinjaman;
		$update['angsuran'] 					= $data['post_detail_angsuran']->angsuran;
		$update['jasa'] 						= $data['post_detail_angsuran']->jasa;
		$update['denda'] 						= $data['post_detail_angsuran']->denda;
		$update['total'] 						= $data['post_detail_angsuran']->total;
		$update['status_post']					= 0;
		$update['id_debet_transaksi_akuntansi']	= 0;
		$update['id_kredit_transaksi_akuntansi']= 0;
		$this->detailangsuranmodel->updateData($id, $update);

		redirect('transaksianggotacon/view_pinjaman/'.$id_pinjaman);
	}
	/*** End of Transaksi Pinjaman ***/

	/*** Transaksi Simpanan Pokok ***/
	function simpananpokok($id_nasabah) {
		$session_data = $this->session->userdata('logged_in');
		if($session_data == NULL) {
			redirect("usercon/login", "refresh");
		}
		$data['nasabah'] 			= $this->nasabahmodel->get_nasabah_by_id($id_nasabah);
		$data['pinjaman'] 			= $this->pinjamanmodel->get_pinjaman_by_id_nasabah($id_nasabah);
		$data['simpananpokok'] 		= $this->simpananpokokmodel->get_simpananpokok_by_id_nasabah($id_nasabah);
		$data['simpananwajib'] 		= $this->simpananwajibmodel->get_simpananwajib_by_id_nasabah($id_nasabah);
		$data['simpanankhusus'] 	= $this->simpanankhususmodel->get_simpanankhusus_by_id_nasabah($id_nasabah);
		$data['simpanandanasosial'] = $this->simpanandanasosialmodel->get_simpanandanasosial_by_id_nasabah($id_nasabah);
		$data['simpanankanzun'] 	= $this->simpanankanzunmodel->get_simpanankanzun_by_id_nasabah($id_nasabah);
		$data['simpanan3th'] 		= $this->simpanan3thmodel->get_simpanan3th_by_id_nasabah($id_nasabah);
		$data['simpananpihakketiga']= $this->simpananpihakketigamodel->get_simpananpihakketiga_by_id_nasabah($id_nasabah);
		$data['username'] 			= $session_data['username'];
		$data['status'] 			= $session_data['status'];

		$this->load->view('/layouts/menu', $data);
		$this->load->view('/transaksianggota/index_simpananpokok', $data);
		$this->load->view('/layouts/footer', $data);
	}

	function create_simpananpokok($id_nasabah) {
		$session_data = $this->session->userdata('logged_in');
		if($session_data == NULL) {
			redirect("usercon/login", "refresh");
		}
		$data['nasabah'] 			= $this->nasabahmodel->get_nasabah_by_id($id_nasabah);
		$data['pinjaman'] 			= $this->pinjamanmodel->get_pinjaman_by_id_nasabah($id_nasabah);
		$data['simpananwajib'] 		= $this->simpananwajibmodel->get_simpananwajib_by_id_nasabah($id_nasabah);
		$data['simpanankhusus'] 	= $this->simpanankhususmodel->get_simpanankhusus_by_id_nasabah($id_nasabah);
		$data['simpanandanasosial'] = $this->simpanandanasosialmodel->get_simpanandanasosial_by_id_nasabah($id_nasabah);
		$data['simpanankanzun'] 	= $this->simpanankanzunmodel->get_simpanankanzun_by_id_nasabah($id_nasabah);
		$data['simpanan3th'] 		= $this->simpanan3thmodel->get_simpanan3th_by_id_nasabah($id_nasabah);
		$data['simpananpihakketiga']= $this->simpananpihakketigamodel->get_simpananpihakketiga_by_id_nasabah($id_nasabah);
		$data['username'] 			= $session_data['username'];
		$data['status'] 			= $session_data['status'];

		$this->load->view('/layouts/menu', $data);
		$this->load->view('/transaksianggota/create_simpananpokok', $data);
		$this->load->view('/layouts/footer', $data);
	}

	function insert_simpananpokok($id_nasabah) {
		$session_data = $this->session->userdata('logged_in');
		if($session_data == NULL) {
			redirect("usercon/login", "refresh");
		}

		$insert 					= array();
		$insert['id'] 				= $this->simpananpokokmodel->getNewId();
		$insert['id_nasabah'] 		= $this->input->post('id_nasabah');
		$insert['nama_nasabah'] 	= $this->input->post('nama_nasabah');
		$insert['nomor_nasabah'] 	= $this->input->post('nomor_nasabah');
		$insert['nik_nasabah'] 		= $this->input->post('nik_nasabah');
		$date1 						= $this->input->post('tanggal');
		$date 						= strtotime($date1);
		$insert['waktu'] 			= date("Y-m-d",$date);
		$insert['jumlah'] 			= $this->input->post('jumlah');
		$this->simpananpokokmodel->inputData($insert);

		redirect('transaksianggotacon/simpananpokok/'.$id_nasabah);
	}

	function edit_simpananpokok($id_simpananpokok) {
		$session_data = $this->session->userdata('logged_in');
		if($session_data == NULL) {
			redirect("usercon/login", "refresh");
		}
		$data['simpananpokok'] 		= $this->simpananpokokmodel->get_simpananpokok_by_id($id_simpananpokok);
		$id_nasabah 				= $data['simpananpokok']->id_nasabah;
		$data['nasabah'] 			= $this->nasabahmodel->get_nasabah_by_id($id_nasabah);
		$data['pinjaman'] 			= $this->pinjamanmodel->get_pinjaman_by_id_nasabah($id_nasabah);
		$data['simpananwajib'] 		= $this->simpananwajibmodel->get_simpananwajib_by_id_nasabah($id_nasabah);
		$data['simpanankhusus'] 	= $this->simpanankhususmodel->get_simpanankhusus_by_id_nasabah($id_nasabah);
		$data['simpanandanasosial'] = $this->simpanandanasosialmodel->get_simpanandanasosial_by_id_nasabah($id_nasabah);
		$data['simpanankanzun'] 	= $this->simpanankanzunmodel->get_simpanankanzun_by_id_nasabah($id_nasabah);
		$data['simpanan3th'] 		= $this->simpanan3thmodel->get_simpanan3th_by_id_nasabah($id_nasabah);
		$data['simpananpihakketiga']= $this->simpananpihakketigamodel->get_simpananpihakketiga_by_id_nasabah($id_nasabah);
		$data['username'] 			= $session_data['username'];
		$data['status'] 			= $session_data['status'];

		$this->load->view('/layouts/menu', $data);
		$this->load->view('/transaksianggota/edit_simpananpokok', $data);
		$this->load->view('/layouts/footer', $data);
	}

	function update_simpananpokok() {
		$session_data = $this->session->userdata('logged_in');
		if($session_data == NULL) {
			redirect("usercon/login", "refresh");
		}

		$update = array();
		$id_simpananpokok 			= $this->input->post('id_simpananpokok');
		$update['id_nasabah'] 		= $this->input->post('id_nasabah');
		$update['nama_nasabah'] 	= $this->input->post('nama_nasabah');
		$update['nomor_nasabah'] 	= $this->input->post('nomor_nasabah');
		$update['nik_nasabah'] 		= $this->input->post('nik_nasabah');
		$date1 						= $this->input->post('tanggal');
		$date 						= strtotime($date1);
		$update['waktu'] 			= date("Y-m-d",$date);
		$update['jumlah'] 			= $this->input->post('jumlah');
		$this->simpananpokokmodel->updateData($id_simpananpokok, $update);

		$id_nasabah = $update['id_nasabah'];

		redirect('transaksianggotacon/simpananpokok/'.$id_nasabah);
	}

	function view_simpananpokok($id_simpananpokok) {
		$session_data = $this->session->userdata('logged_in');
		if($session_data == NULL) {
			redirect("usercon/login", "refresh");
		}

		$data['simpananpokok'] 		= $this->simpananpokokmodel->get_simpananpokok_by_id($id_simpananpokok);
		$id_nasabah 				= $data['simpananpokok']->id_nasabah;
		$data['nasabah'] 			= $this->nasabahmodel->get_nasabah_by_id($id_nasabah);
		$data['pinjaman'] 			= $this->pinjamanmodel->get_pinjaman_by_id_nasabah($id_nasabah);
		$data['simpananwajib'] 		= $this->simpananwajibmodel->get_simpananwajib_by_id_nasabah($id_nasabah);
		$data['simpanankhusus'] 	= $this->simpanankhususmodel->get_simpanankhusus_by_id_nasabah($id_nasabah);
		$data['simpanandanasosial'] = $this->simpanandanasosialmodel->get_simpanandanasosial_by_id_nasabah($id_nasabah);
		$data['simpanankanzun'] 	= $this->simpanankanzunmodel->get_simpanankanzun_by_id_nasabah($id_nasabah);
		$data['simpanan3th'] 		= $this->simpanan3thmodel->get_simpanan3th_by_id_nasabah($id_nasabah);
		$data['simpananpihakketiga']= $this->simpananpihakketigamodel->get_simpananpihakketiga_by_id_nasabah($id_nasabah);
		$data['username'] 			= $session_data['username'];
		$data['status'] 			= $session_data['status'];

		$this->load->view('/layouts/menu', $data);
		$this->load->view('/transaksianggota/view_simpananpokok', $data);
		$this->load->view('/layouts/footer', $data);
	}

	function delete_simpananpokok($id_simpananpokok) {
		$session_data = $this->session->userdata('logged_in');
		if($session_data == NULL) {
			redirect("usercon/login", "refresh");
		}

		$data['simpananpokok'] 		= $this->simpananpokokmodel->get_simpananpokok_by_id($id_simpananpokok);
		$id_nasabah					= $data['simpananpokok']->id_nasabah;

		$this->simpananpokokmodel->deleteData($id_simpananpokok);
		redirect('transaksianggotacon/simpananpokok/'.$id_nasabah);
	}
	/*** End of Transaksi Simpanan Pokok ***/

	/*** Transaksi Simpanan Wajib ***/
	function simpananwajib($id_nasabah) {
		$session_data = $this->session->userdata('logged_in');
		if($session_data == NULL) {
			redirect("usercon/login", "refresh");
		}
		$data['nasabah'] 			= $this->nasabahmodel->get_nasabah_by_id($id_nasabah);
		$data['pinjaman'] 			= $this->pinjamanmodel->get_pinjaman_by_id_nasabah($id_nasabah);
		$data['simpananpokok'] 		= $this->simpananpokokmodel->get_simpananpokok_by_id_nasabah($id_nasabah);
		$data['simpananwajib'] 		= $this->simpananwajibmodel->get_simpananwajib_by_id_nasabah($id_nasabah);
		$data['simpanankhusus'] 	= $this->simpanankhususmodel->get_simpanankhusus_by_id_nasabah($id_nasabah);
		$data['simpanandanasosial'] = $this->simpanandanasosialmodel->get_simpanandanasosial_by_id_nasabah($id_nasabah);
		$data['simpanankanzun'] 	= $this->simpanankanzunmodel->get_simpanankanzun_by_id_nasabah($id_nasabah);
		$data['simpanan3th'] 		= $this->simpanan3thmodel->get_simpanan3th_by_id_nasabah($id_nasabah);
		$data['simpananpihakketiga']= $this->simpananpihakketigamodel->get_simpananpihakketiga_by_id_nasabah($id_nasabah);
		$data['username'] 			= $session_data['username'];
		$data['status'] 			= $session_data['status'];

		$this->load->view('/layouts/menu', $data);
		$this->load->view('/transaksianggota/index_simpananwajib', $data);
		$this->load->view('/layouts/footer', $data);
	}

	function create_simpananwajib($id_nasabah) {
		$session_data = $this->session->userdata('logged_in');
		if($session_data == NULL) {
			redirect("usercon/login", "refresh");
		}
		$data['nasabah'] 			= $this->nasabahmodel->get_nasabah_by_id($id_nasabah);
		$data['simpananpokok'] 		= $this->simpananpokokmodel->get_simpananpokok_by_id_nasabah($id_nasabah);
		$data['simpananwajib'] 		= $this->simpananwajibmodel->get_simpananwajib_by_id_nasabah($id_nasabah);
		$data['simpanankhusus'] 	= $this->simpanankhususmodel->get_simpanankhusus_by_id_nasabah($id_nasabah);
		$data['simpanandanasosial'] = $this->simpanandanasosialmodel->get_simpanandanasosial_by_id_nasabah($id_nasabah);
		$data['simpanankanzun'] 	= $this->simpanankanzunmodel->get_simpanankanzun_by_id_nasabah($id_nasabah);
		$data['simpanan3th'] 		= $this->simpanan3thmodel->get_simpanan3th_by_id_nasabah($id_nasabah);
		$data['simpananpihakketiga']= $this->simpananpihakketigamodel->get_simpananpihakketiga_by_id_nasabah($id_nasabah);
		$data['username'] 			= $session_data['username'];
		$data['status'] 			= $session_data['status'];

		$this->load->view('/layouts/menu', $data);
		$this->load->view('/transaksianggota/create_simpananwajib', $data);
		$this->load->view('/layouts/footer', $data);
	}

	function insert_simpananwajib($id_nasabah) {
		$session_data = $this->session->userdata('logged_in');
		if($session_data == NULL) {
			redirect("usercon/login", "refresh");
		}

		$insert = array();
		$insert['id'] 				= $this->simpananwajibmodel->getNewId();
		$insert['id_nasabah'] 		= $this->input->post('id_nasabah');
		$insert['nomor_nasabah'] 	= $this->input->post('nomor_nasabah');
		$insert['nama_nasabah'] 	= $this->input->post('nama_nasabah');
		$insert['nik_nasabah'] 		= $this->input->post('nik_nasabah');
		$date1 						= $this->input->post('tanggal');
		$date 						= strtotime($date1);
		$insert['waktu'] 			= date("Y-m-d",$date);
		$insert['total'] 			= 0;
		$this->simpananwajibmodel->inputData($insert);

		redirect('transaksianggotacon/simpananwajib/'.$id_nasabah);
	}

	function edit_simpananwajib($id_simpananwajib) {
		$session_data = $this->session->userdata('logged_in');
		if($session_data == NULL) {
			redirect("usercon/login", "refresh");
		}

		$data['simpananwajib'] 		= $this->simpananwajibmodel->get_simpananwajib_by_id($id_simpananwajib);
		$id_nasabah					= $data['simpananwajib']->id_nasabah;

		$data['nasabah'] 			= $this->nasabahmodel->get_nasabah_by_id($id_nasabah);
		$data['pinjaman'] 		= $this->pinjamanmodel->get_pinjaman_by_id_nasabah($id_nasabah);
		$data['simpananpokok'] 		= $this->simpananpokokmodel->get_simpananpokok_by_id_nasabah($id_nasabah);
		$data['simpanankhusus'] 	= $this->simpanankhususmodel->get_simpanankhusus_by_id_nasabah($id_nasabah);
		$data['simpanandanasosial'] = $this->simpanandanasosialmodel->get_simpanandanasosial_by_id_nasabah($id_nasabah);
		$data['simpanankanzun'] 	= $this->simpanankanzunmodel->get_simpanankanzun_by_id_nasabah($id_nasabah);
		$data['simpanan3th'] 		= $this->simpanan3thmodel->get_simpanan3th_by_id_nasabah($id_nasabah);
		$data['simpananpihakketiga']= $this->simpananpihakketigamodel->get_simpananpihakketiga_by_id_nasabah($id_nasabah);
		$data['username'] 			= $session_data['username'];
		$data['status'] 			= $session_data['status'];
		
		$this->load->view('/layouts/menu', $data);
		$this->load->view('/transaksianggota/edit_simpananwajib', $data);
		$this->load->view('/layouts/footer', $data);
	}

	function update_simpananwajib() {
		$session_data = $this->session->userdata('logged_in');
		if($session_data == NULL) {
			redirect("usercon/login", "refresh");
		}

		$id_simpananwajib = $this->input->post('id_simpananwajib');
		$update = array();
		$update['id_nasabah'] 		= $this->input->post('id_nasabah');
		$update['nama_nasabah'] 	= $this->input->post('nama_nasabah');
		$update['nomor_nasabah'] 	= $this->input->post('nomor_nasabah');
		$update['nik_nasabah'] 		= $this->input->post('nik_nasabah');
		$date1 						= $this->input->post('tanggal');
		$date 						= strtotime($date1);
		$update['waktu'] 			= date("Y-m-d",$date);
		$update['total'] 			= $this->input->post('total');
		$this->simpananwajibmodel->updateData($id_simpananwajib, $update);

		$id_nasabah = $update['id_nasabah'];

		redirect('transaksianggotacon/simpananwajib/'.$id_nasabah);
	}

	function delete_simpananwajib($id_simpananwajib) {
		$session_data = $this->session->userdata('logged_in');
		if($session_data == NULL) {
			redirect("usercon/login", "refresh");
		}

		$data['simpananwajib']	= $this->simpananwajibmodel->get_simpananwajib_by_id($id_simpananwajib);
		$id_nasabah				= $data['simpananwajib']->id_nasabah;

		$this->simpananwajibmodel->deleteData($id_simpananwajib);
		$this->detailsimpananwajibmodel->delete_by_id_simpananwajib($id_simpananwajib);

		redirect('transaksianggotacon/simpananwajib/'.$id_nasabah);
	}

	function view_simpananwajib($id_simpananwajib) {
		$session_data = $this->session->userdata('logged_in');
		if($session_data == NULL) {
			redirect("usercon/login", "refresh");
		}

		$data['simpananwajib'] 			= $this->simpananwajibmodel->get_simpananwajib_by_id($id_simpananwajib);
		$data['detail_simpananwajib'] 	= $this->detailsimpananwajibmodel->get_detail_simpananwajib_by_id_simpananwajib($id_simpananwajib);
		$id_nasabah						= $data['simpananwajib']->id_nasabah;
		$data['nasabah'] 				= $this->nasabahmodel->get_nasabah_by_id($id_nasabah);
		$data['pinjaman'] 				= $this->pinjamanmodel->get_pinjaman_by_id_nasabah($id_nasabah);
		$data['simpananpokok'] 			= $this->simpananpokokmodel->get_simpananpokok_by_id_nasabah($id_nasabah);
		$data['simpanankhusus'] 		= $this->simpanankhususmodel->get_simpanankhusus_by_id_nasabah($id_nasabah);
		$data['simpanandanasosial'] 	= $this->simpanandanasosialmodel->get_simpanandanasosial_by_id_nasabah($id_nasabah);
		$data['simpanankanzun'] 		= $this->simpanankanzunmodel->get_simpanankanzun_by_id_nasabah($id_nasabah);
		$data['simpanan3th'] 			= $this->simpanan3thmodel->get_simpanan3th_by_id_nasabah($id_nasabah);
		$data['simpananpihakketiga']	= $this->simpananpihakketigamodel->get_simpananpihakketiga_by_id_nasabah($id_nasabah);
		$data['username'] 				= $session_data['username'];
		$data['status'] 				= $session_data['status'];
		
		$this->load->view('/layouts/menu', $data);
		$this->load->view('/transaksianggota/view_simpananwajib', $data);
		$this->load->view('/layouts/footer', $data);
	}

	function insert_detail_simpananwajib() {
		$session_data = $this->session->userdata('logged_in');
		if($session_data == NULL) {
			redirect("usercon/login", "refresh");
		}

		// Insert Detail Simpanan Wajib ke dalam table detail_simpananwajib
		$date1 						= $this->input->post('waktu');
		$date 						= strtotime($date1);
		$input 						= array();
		$input['waktu'] 			= date("Y-m-d",$date);
		$input['id_simpananwajib']	= $this->input->post('id_simpananwajib');
		$input['bulan_tahun']		= $this->input->post('bulan_tahun');
		$input['jenis']				= $this->input->post('jenis');
		$input['jumlah']			= $this->input->post('jumlah');
		$this->detailsimpananwajibmodel->inputData($input);

		$id_simpananwajib = $this->input->post('id_simpananwajib');
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

		redirect('transaksianggotacon/view_simpananwajib/'.$id_simpananwajib);
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
		$id_nasabah							= $data['simpananwajib']->id_nasabah;
		$data['nasabah'] 					= $this->nasabahmodel->get_nasabah_by_id($id_nasabah);
		$data['detail_simpananwajib'] 		= $this->detailsimpananwajibmodel->get_detail_simpananwajib_by_id_simpananwajib($id_simpananwajib);
		$data['edit_detail_simpananwajib'] 	= $this->detailsimpananwajibmodel->get_detail_simpananwajib_by_id($id_detail_simpananwajib);
		$data['simpananpokok'] 				= $this->simpananpokokmodel->get_simpananpokok_by_id_nasabah($id_nasabah);
		$data['pinjaman'] 					= $this->pinjamanmodel->get_pinjaman_by_id_nasabah($id_nasabah);
		$data['simpanankhusus'] 			= $this->simpanankhususmodel->get_simpanankhusus_by_id_nasabah($id_nasabah);
		$data['simpanandanasosial'] 		= $this->simpanandanasosialmodel->get_simpanandanasosial_by_id_nasabah($id_nasabah);
		$data['simpanankanzun'] 			= $this->simpanankanzunmodel->get_simpanankanzun_by_id_nasabah($id_nasabah);
		$data['simpanan3th'] 				= $this->simpanan3thmodel->get_simpanan3th_by_id_nasabah($id_nasabah);
		$data['simpananpihakketiga']		= $this->simpananpihakketigamodel->get_simpananpihakketiga_by_id_nasabah($id_nasabah);
		$data['username'] 					= $session_data['username'];
		$data['status'] 					= $session_data['status'];

		$this->load->view('/layouts/menu', $data);
		$this->load->view('/transaksianggota/view_simpananwajib_edit_detail', $data);
		$this->load->view('/layouts/footer', $data);	
	}

	function update_detail_simpananwajib() {
		$session_data = $this->session->userdata('logged_in');
		if($session_data == NULL) {
			redirect("usercon/login", "refresh");
		}

		//Update Detail Simpanan Wajib ke dalam table detail_simpananwajib
		$id_detail_simpananwajib 	= $this->input->post('edit_id');
		$date1 						= $this->input->post('edit_waktu');
		$date 						= strtotime($date1);
		$update 					= array();
		$update['waktu'] 			= date("Y-m-d",$date);
		$update['id_simpananwajib'] = $this->input->post('edit_id_simpananwajib');
		$update['bulan_tahun'] 		= $this->input->post('edit_bulan_tahun');
		$update['jenis'] 			= $this->input->post('edit_jenis');
		$update['jumlah'] 			= $this->input->post('edit_jumlah');
		$this->detailsimpananwajibmodel->updateData($id_detail_simpananwajib, $update);

		$id_simpananwajib = $this->input->post('edit_id_simpananwajib');
		$data['simpananwajib'] = $this->simpananwajibmodel->get_simpananwajib_by_id($id_simpananwajib);

		if($update['jenis'] == 'Setoran') {
			$total = $data['simpananwajib']->total + $update['jumlah'];
			$this->simpananwajibmodel->update_total($id_simpananwajib, $total);
		} else if($update['jenis'] == 'Tarikan') {
			$total = $data['simpananwajib']->total - $update['jumlah'];
			$this->simpananwajibmodel->update_total($id_simpananwajib, $total);
		}

		redirect('transaksianggotacon/view_simpananwajib/'.$id_simpananwajib);
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

		redirect('transaksianggotacon/view_simpananwajib/'.$id_simpananwajib);
	}

	function simpananwajib_post_akuntansi($id_simpananwajib, $id_detail_simpananwajib) {
		$session_data = $this->session->userdata('logged_in');
		if($session_data == NULL) {
			redirect("usercon/login", "refresh");
		}

		$data['simpananwajib'] 				= $this->simpananwajibmodel->get_simpananwajib_by_id($id_simpananwajib);
		$data['post_detail_simpananwajib'] 	= $this->detailsimpananwajibmodel->get_detail_simpananwajib_by_id($id_detail_simpananwajib);

		if($data['post_detail_simpananwajib']->jenis == "Setoran") {
			$mapping_kode_akun = $this->mappingkodeakunmodel->get_mapping_kode_akun_by_nama_transaksi('penerimaan simp wajib');
			$debet 		= $this->kodeakunmodel->get_kode_akun_by_kode($mapping_kode_akun->kode_debet);
			$kredit 	= $this->kodeakunmodel->get_kode_akun_by_kode($mapping_kode_akun->kode_kredit);
			$bln_thn = strtotime( $data['post_detail_simpananwajib']->bulan_tahun );
            $bulan_tahun = date( 'M-Y', $bln_thn );

			$data_debet 				= array();
			$data_debet['id'] 			= $this->transaksiakuntansimodel->getNewId();
			$data_debet['tanggal'] 		= $data['post_detail_simpananwajib']->waktu;
			$data_debet['kode_akun'] 	= $mapping_kode_akun->kode_debet;
			$data_debet['nama_akun'] 	= $debet->nama_akun;
			$data_debet['keterangan'] 	= "Simpanan Wajib Bulan ".$bulan_tahun." Anggota a.n. ".$data['simpananwajib']->nama_nasabah." Nomor Anggota: ".$data['simpananwajib']->nomor_nasabah;
			$data_debet['jumlah'] 		= $data['post_detail_simpananwajib']->jumlah;
			$data_debet['debet'] 		= $data['post_detail_simpananwajib']->jumlah;
			$data_debet['kredit'] 		= 0;
			$this->transaksiakuntansimodel->inputData($data_debet);

			$data_kredit 				= array();
			$data_kredit['id'] 			= $this->transaksiakuntansimodel->getNewId();
			$data_kredit['tanggal'] 	= $data['post_detail_simpananwajib']->waktu;
			$data_kredit['kode_akun'] 	= $mapping_kode_akun->kode_kredit;
			$data_kredit['nama_akun'] 	= $kredit->nama_akun;
			$data_kredit['keterangan'] 	= "Simpanan Wajib Bulan ".$bulan_tahun." Anggota a.n. ".$data['simpananwajib']->nama_nasabah." Nomor Anggota: ".$data['simpananwajib']->nomor_nasabah;
			$data_kredit['jumlah'] 		= $data['post_detail_simpananwajib']->jumlah;
			$data_kredit['debet'] 		= 0;
			$data_kredit['kredit'] 		= $data['post_detail_simpananwajib']->jumlah;
			$this->transaksiakuntansimodel->inputData($data_kredit);

			$update = array();
			$id 									= $data['post_detail_simpananwajib']->id;
			$update['id_simpananwajib'] 			= $data['post_detail_simpananwajib']->id_simpananwajib;
			$update['waktu'] 						= $data['post_detail_simpananwajib']->waktu;
			$update['jenis'] 						= $data['post_detail_simpananwajib']->jenis;
			$update['bulan_tahun'] 					= $data['post_detail_simpananwajib']->bulan_tahun;
			$update['jumlah'] 						= $data['post_detail_simpananwajib']->jumlah;
			$update['status_post'] 					= 1;
			$update['id_debet_transaksi_akuntansi']	= $data_debet['id'];
			$update['id_kredit_transaksi_akuntansi']= $data_kredit['id'];
			$this->detailsimpananwajibmodel->updateData($id, $update);
		} else {
			$mapping_kode_akun = $this->mappingkodeakunmodel->get_mapping_kode_akun_by_nama_transaksi('pencairan simpanan wajib');
			$debet 		= $this->kodeakunmodel->get_kode_akun_by_kode($mapping_kode_akun->kode_debet);
			$kredit 	= $this->kodeakunmodel->get_kode_akun_by_kode($mapping_kode_akun->kode_kredit);
			$bln_thn = strtotime( $data['post_detail_simpananwajib']->bulan_tahun );
            $bulan_tahun = date( 'M-Y', $bln_thn );

			$data_debet 				= array();
			$data_debet['id'] 			= $this->transaksiakuntansimodel->getNewId();
			$data_debet['tanggal'] 		= $data['post_detail_simpananwajib']->waktu;
			$data_debet['kode_akun'] 	= $mapping_kode_akun->kode_debet;
			$data_debet['nama_akun'] 	= $debet->nama_akun;
			$data_debet['keterangan'] 	= "Pencairan Simpanan Wajib Bulan ".$bulan_tahun." Anggota a.n. ".$data['simpananwajib']->nama_nasabah." Nomor Anggota: ".$data['simpananwajib']->nomor_nasabah;
			$data_debet['jumlah'] 		= $data['post_detail_simpananwajib']->jumlah;
			$data_debet['debet'] 		= $data['post_detail_simpananwajib']->jumlah;
			$data_debet['kredit'] 		= 0;
			$this->transaksiakuntansimodel->inputData($data_debet);

			$data_kredit 				= array();
			$data_kredit['id'] 			= $this->transaksiakuntansimodel->getNewId();
			$data_kredit['tanggal'] 	= $data['post_detail_simpananwajib']->waktu;
			$data_kredit['kode_akun'] 	= $mapping_kode_akun->kode_kredit;
			$data_kredit['nama_akun'] 	= $kredit->nama_akun;
			$data_kredit['keterangan'] 	= "Pencairan Simpanan Wajib Bulan ".$bulan_tahun." Anggota a.n. ".$data['simpananwajib']->nama_nasabah." Nomor Anggota: ".$data['simpananwajib']->nomor_nasabah;
			$data_kredit['jumlah'] 		= $data['post_detail_simpananwajib']->jumlah;
			$data_kredit['debet'] 		= 0;
			$data_kredit['kredit'] 		= $data['post_detail_simpananwajib']->jumlah;
			$this->transaksiakuntansimodel->inputData($data_kredit);

			$update = array();
			$id 									= $data['post_detail_simpananwajib']->id;
			$update['id_simpananwajib'] 			= $data['post_detail_simpananwajib']->id_simpananwajib;
			$update['waktu'] 						= $data['post_detail_simpananwajib']->waktu;
			$update['jenis'] 						= $data['post_detail_simpananwajib']->jenis;
			$update['bulan_tahun'] 					= $data['post_detail_simpananwajib']->bulan_tahun;
			$update['jumlah'] 						= $data['post_detail_simpananwajib']->jumlah;
			$update['status_post'] 					= 1;
			$update['id_debet_transaksi_akuntansi']	= $data_debet['id'];
			$update['id_kredit_transaksi_akuntansi']= $data_kredit['id'];
			$this->detailsimpananwajibmodel->updateData($id, $update);
		}
		redirect('transaksianggotacon/view_simpananwajib/'.$id_simpananwajib);
	}

	function simpananwajib_unpost_akuntansi($id_simpananwajib, $id_detail_simpananwajib) {
		$session_data = $this->session->userdata('logged_in');
		if($session_data == NULL) {
			redirect("usercon/login", "refresh");
		}

		$data['simpananwajib'] 				= $this->simpananwajibmodel->get_simpananwajib_by_id($id_simpananwajib);
		$data['post_detail_simpananwajib'] 	= $this->detailsimpananwajibmodel->get_detail_simpananwajib_by_id($id_detail_simpananwajib);

		$id_debet_transaksi_akuntansi 	= $data['post_detail_simpananwajib']->id_debet_transaksi_akuntansi;
		$id_kredit_transaksi_akuntansi 	= $data['post_detail_simpananwajib']->id_kredit_transaksi_akuntansi;

		$this->transaksiakuntansimodel->deleteData($id_debet_transaksi_akuntansi);
		$this->transaksiakuntansimodel->deleteData($id_kredit_transaksi_akuntansi);

		$update = array();
		$id 									= $data['post_detail_simpananwajib']->id;
		$update['id_simpananwajib'] 			= $data['post_detail_simpananwajib']->id_simpananwajib;
		$update['waktu'] 						= $data['post_detail_simpananwajib']->waktu;
		$update['jenis'] 						= $data['post_detail_simpananwajib']->jenis;
		$update['bulan_tahun'] 					= $data['post_detail_simpananwajib']->bulan_tahun;
		$update['jumlah'] 						= $data['post_detail_simpananwajib']->jumlah;
		$update['status_post'] 					= 0;
		$update['id_debet_transaksi_akuntansi']	= 0;
		$update['id_kredit_transaksi_akuntansi']= 0;
		$this->detailsimpananwajibmodel->updateData($id, $update);

		redirect('transaksianggotacon/view_simpananwajib/'.$id_simpananwajib);
	}
	/*** End of Transaksi Simpanan Wajib ***/

	/*** Transaksi Simpanan Khusus ***/
	function simpanankhusus($id_nasabah) {
		$session_data = $this->session->userdata('logged_in');
		if($session_data == NULL) {
			redirect("usercon/login", "refresh");
		}
		$data['nasabah'] 			= $this->nasabahmodel->get_nasabah_by_id($id_nasabah);
		$data['pinjaman'] 			= $this->pinjamanmodel->get_pinjaman_by_id_nasabah($id_nasabah);
		$data['simpananpokok'] 		= $this->simpananpokokmodel->get_simpananpokok_by_id_nasabah($id_nasabah);
		$data['simpananwajib'] 		= $this->simpananwajibmodel->get_simpananwajib_by_id_nasabah($id_nasabah);
		$data['simpanankhusus'] 	= $this->simpanankhususmodel->get_simpanankhusus_by_id_nasabah($id_nasabah);
		$data['simpanandanasosial'] = $this->simpanandanasosialmodel->get_simpanandanasosial_by_id_nasabah($id_nasabah);
		$data['simpanankanzun'] 	= $this->simpanankanzunmodel->get_simpanankanzun_by_id_nasabah($id_nasabah);
		$data['simpanan3th'] 		= $this->simpanan3thmodel->get_simpanan3th_by_id_nasabah($id_nasabah);
		$data['simpananpihakketiga']= $this->simpananpihakketigamodel->get_simpananpihakketiga_by_id_nasabah($id_nasabah);
		$data['username'] 			= $session_data['username'];
		$data['status'] 			= $session_data['status'];

		$this->load->view('/layouts/menu', $data);
		$this->load->view('/transaksianggota/index_simpanankhusus', $data);
		$this->load->view('/layouts/footer', $data);
	}

	function create_simpanankhusus($id_nasabah) {
		$session_data = $this->session->userdata('logged_in');
		if($session_data == NULL) {
			redirect("usercon/login", "refresh");
		}
		$data['nasabah'] 			= $this->nasabahmodel->get_nasabah_by_id($id_nasabah);
		$data['pinjaman'] 			= $this->pinjamanmodel->get_pinjaman_by_id_nasabah($id_nasabah);
		$data['simpananpokok'] 		= $this->simpananpokokmodel->get_simpananpokok_by_id_nasabah($id_nasabah);
		$data['simpananwajib'] 		= $this->simpananwajibmodel->get_simpananwajib_by_id_nasabah($id_nasabah);
		$data['simpanandanasosial'] = $this->simpanandanasosialmodel->get_simpanandanasosial_by_id_nasabah($id_nasabah);
		$data['simpanankanzun'] 	= $this->simpanankanzunmodel->get_simpanankanzun_by_id_nasabah($id_nasabah);
		$data['simpanan3th'] 		= $this->simpanan3thmodel->get_simpanan3th_by_id_nasabah($id_nasabah);
		$data['simpananpihakketiga']= $this->simpananpihakketigamodel->get_simpananpihakketiga_by_id_nasabah($id_nasabah);
		$data['username'] 			= $session_data['username'];
		$data['status'] 			= $session_data['status'];

		$this->load->view('/layouts/menu', $data);
		$this->load->view('/transaksianggota/create_simpanankhusus', $data);
		$this->load->view('/layouts/footer', $data);
	}

	function insert_simpanankhusus($id_nasabah) {
		$session_data = $this->session->userdata('logged_in');
		if($session_data == NULL) {
			redirect("usercon/login", "refresh");
		}

		$insert = array();
		$insert['id'] 				= $this->simpanankhususmodel->getNewId();
		$insert['id_nasabah'] 		= $this->input->post('id_nasabah');
		$insert['nomor_nasabah'] 	= $this->input->post('nomor_nasabah');
		$insert['nama_nasabah'] 	= $this->input->post('nama_nasabah');
		$insert['nik_nasabah'] 		= $this->input->post('nik_nasabah');
		$date1 						= $this->input->post('tanggal');
		$date 						= strtotime($date1);
		$insert['waktu'] 			= date("Y-m-d",$date);
		$insert['total'] 			= 0;
		$this->simpanankhususmodel->inputData($insert);

		redirect('transaksianggotacon/simpanankhusus/'.$id_nasabah);
	}

	function edit_simpanankhusus($id_simpanankhusus) {
		$session_data = $this->session->userdata('logged_in');
		if($session_data == NULL) {
			redirect("usercon/login", "refresh");
		}

		$data['simpanankhusus'] 	= $this->simpanankhususmodel->get_simpanankhusus_by_id($id_simpanankhusus);
		$id_nasabah					= $data['simpanankhusus']->id_nasabah;

		$data['nasabah'] 			= $this->nasabahmodel->get_nasabah_by_id($id_nasabah);
		$data['pinjaman'] 			= $this->pinjamanmodel->get_pinjaman_by_id_nasabah($id_nasabah);
		$data['simpananpokok'] 		= $this->simpananpokokmodel->get_simpananpokok_by_id_nasabah($id_nasabah);
		$data['simpananwajib'] 		= $this->simpananwajibmodel->get_simpananwajib_by_id_nasabah($id_nasabah);
		$data['simpanandanasosial'] = $this->simpanandanasosialmodel->get_simpanandanasosial_by_id_nasabah($id_nasabah);
		$data['simpanankanzun'] 	= $this->simpanankanzunmodel->get_simpanankanzun_by_id_nasabah($id_nasabah);
		$data['simpanan3th'] 		= $this->simpanan3thmodel->get_simpanan3th_by_id_nasabah($id_nasabah);
		$data['simpananpihakketiga']= $this->simpananpihakketigamodel->get_simpananpihakketiga_by_id_nasabah($id_nasabah);
		$data['username'] 			= $session_data['username'];
		$data['status'] 			= $session_data['status'];
		
		$this->load->view('/layouts/menu', $data);
		$this->load->view('/transaksianggota/edit_simpanankhusus', $data);
		$this->load->view('/layouts/footer', $data);
	}

	function update_simpanankhusus() {
		$session_data = $this->session->userdata('logged_in');
		if($session_data == NULL) {
			redirect("usercon/login", "refresh");
		}

		$id_simpanankhusus = $this->input->post('id_simpanankhusus');
		$update = array();
		$update['id_nasabah'] 		= $this->input->post('id_nasabah');
		$update['nama_nasabah'] 	= $this->input->post('nama_nasabah');
		$update['nomor_nasabah'] 	= $this->input->post('nomor_nasabah');
		$update['nik_nasabah'] 		= $this->input->post('nik_nasabah');
		$date1 						= $this->input->post('tanggal');
		$date 						= strtotime($date1);
		$update['waktu'] 			= date("Y-m-d",$date);
		$update['total'] 			= $this->input->post('total');
		$this->simpanankhususmodel->updateData($id_simpanankhusus, $update);

		$id_nasabah = $update['id_nasabah'];

		redirect('transaksianggotacon/simpanankhusus/'.$id_nasabah);
	}

	function delete_simpanankhusus($id_simpanankhusus) {
		$session_data = $this->session->userdata('logged_in');
		if($session_data == NULL) {
			redirect("usercon/login", "refresh");
		}

		$data['simpanankhusus']	= $this->simpanankhususmodel->get_simpanankhusus_by_id($id_simpanankhusus);
		$id_nasabah				= $data['simpanankhusus']->id_nasabah;

		$this->simpanankhususmodel->deleteData($id_simpanankhusus);
		$this->detailsimpanankhususmodel->delete_by_id_simpanankhusus($id_simpanankhusus);

		redirect('transaksianggotacon/simpanankhusus/'.$id_nasabah);
	}

	function view_simpanankhusus($id_simpanankhusus) {
		$session_data = $this->session->userdata('logged_in');
		if($session_data == NULL) {
			redirect("usercon/login", "refresh");
		}

		$data['simpanankhusus'] 		= $this->simpanankhususmodel->get_simpanankhusus_by_id($id_simpanankhusus);
		$data['detail_simpanankhusus'] 	= $this->detailsimpanankhususmodel->get_detail_simpanankhusus_by_id_simpanankhusus($id_simpanankhusus);
		$id_nasabah						= $data['simpanankhusus']->id_nasabah;
		$data['nasabah'] 				= $this->nasabahmodel->get_nasabah_by_id($id_nasabah);
		$data['pinjaman'] 				= $this->pinjamanmodel->get_pinjaman_by_id_nasabah($id_nasabah);
		$data['simpananpokok'] 			= $this->simpananpokokmodel->get_simpananpokok_by_id_nasabah($id_nasabah);
		$data['simpananwajib'] 			= $this->simpananwajibmodel->get_simpananwajib_by_id_nasabah($id_nasabah);
		$data['simpanandanasosial'] 	= $this->simpanandanasosialmodel->get_simpanandanasosial_by_id_nasabah($id_nasabah);
		$data['simpanankanzun'] 		= $this->simpanankanzunmodel->get_simpanankanzun_by_id_nasabah($id_nasabah);
		$data['simpanan3th'] 			= $this->simpanan3thmodel->get_simpanan3th_by_id_nasabah($id_nasabah);
		$data['simpananpihakketiga']	= $this->simpananpihakketigamodel->get_simpananpihakketiga_by_id_nasabah($id_nasabah);
		$data['username'] 				= $session_data['username'];
		$data['status'] 				= $session_data['status'];
		
		$this->load->view('/layouts/menu', $data);
		$this->load->view('/transaksianggota/view_simpanankhusus', $data);
		$this->load->view('/layouts/footer', $data);
	}

	function insert_detail_simpanankhusus() {
		$session_data = $this->session->userdata('logged_in');
		if($session_data == NULL) {
			redirect("usercon/login", "refresh");
		}

		// Insert Detail Simpanan Khusus ke dalam table detail_simpanankhusus
		$date1 						= $this->input->post('waktu');
		$date 						= strtotime($date1);
		$input 						= array();
		$input['waktu'] 			= date("Y-m-d",$date);
		$input['id_simpanankhusus']	= $this->input->post('id_simpanankhusus');
		$input['jenis']				= $this->input->post('jenis');
		$input['bulan_tahun']		= $this->input->post('bulan_tahun');
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

		redirect('transaksianggotacon/view_simpanankhusus/'.$id_simpanankhusus);
	}

	function edit_detail_simpanankhusus($id_simpanankhusus, $id_detail_simpanankhusus) {
		$session_data = $this->session->userdata('logged_in');
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
		$id_nasabah							= $data['simpanankhusus']->id_nasabah;
		$data['nasabah'] 					= $this->nasabahmodel->get_nasabah_by_id($id_nasabah);
		$data['detail_simpanankhusus'] 		= $this->detailsimpanankhususmodel->get_detail_simpanankhusus_by_id_simpanankhusus($id_simpanankhusus);
		$data['edit_detail_simpanankhusus'] = $this->detailsimpanankhususmodel->get_detail_simpanankhusus_by_id($id_detail_simpanankhusus);
		$data['simpananpokok'] 				= $this->simpananpokokmodel->get_simpananpokok_by_id_nasabah($id_nasabah);
		$data['pinjaman'] 					= $this->pinjamanmodel->get_pinjaman_by_id_nasabah($id_nasabah);
		$data['simpananwajib'] 				= $this->simpananwajibmodel->get_simpananwajib_by_id_nasabah($id_nasabah);
		$data['simpanandanasosial'] 		= $this->simpanandanasosialmodel->get_simpanandanasosial_by_id_nasabah($id_nasabah);
		$data['simpanankanzun'] 			= $this->simpanankanzunmodel->get_simpanankanzun_by_id_nasabah($id_nasabah);
		$data['simpanan3th'] 				= $this->simpanan3thmodel->get_simpanan3th_by_id_nasabah($id_nasabah);
		$data['simpananpihakketiga']		= $this->simpananpihakketigamodel->get_simpananpihakketiga_by_id_nasabah($id_nasabah);
		$data['username'] 					= $session_data['username'];
		$data['status'] 					= $session_data['status'];

		$this->load->view('/layouts/menu', $data);
		$this->load->view('/transaksianggota/view_simpanankhusus_edit_detail', $data);
		$this->load->view('/layouts/footer', $data);	
	}

	function update_detail_simpanankhusus() {
		$session_data = $this->session->userdata('logged_in');
		if($session_data == NULL) {
			redirect("usercon/login", "refresh");
		}

		//Update Detail Simpanan Khusus ke dalam table detail_simpanankhusus
		$id_detail_simpanankhusus 		= $this->input->post('edit_id');
		$date1 							= $this->input->post('edit_waktu');
		$date 							= strtotime($date1);
		$update 						= array();
		$update['waktu'] 				= date("Y-m-d",$date);
		$update['id_simpanankhusus'] 	= $this->input->post('edit_id_simpanankhusus');
		$update['jenis'] 				= $this->input->post('edit_jenis');
		$update['bulan_tahun'] 			= $this->input->post('edit_bulan_tahun');
		$update['jumlah'] 				= $this->input->post('edit_jumlah');
		$this->detailsimpanankhususmodel->updateData($id_detail_simpanankhusus, $update);

		$id_simpanankhusus = $this->input->post('edit_id_simpanankhusus');
		$data['simpanankhusus'] = $this->simpanankhususmodel->get_simpanankhusus_by_id($id_simpanankhusus);

		if($update['jenis'] == 'Setoran') {
			$total = $data['simpanankhusus']->total + $update['jumlah'];
			$this->simpanankhususmodel->update_total($id_simpanankhusus, $total);
		} else if($update['jenis'] == 'Tarikan') {
			$total = $data['simpanankhusus']->total - $update['jumlah'];
			$this->simpanankhususmodel->update_total($id_simpanankhusus, $total);
		}

		redirect('transaksianggotacon/view_simpanankhusus/'.$id_simpanankhusus);
	}

	function delete_detail_simpanankhusus($id_simpanankhusus, $id_detail_simpanankhusus) {
		$session_data = $this->session->userdata('logged_in');
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

		redirect('transaksianggotacon/view_simpanankhusus/'.$id_simpanankhusus);
	}
	/*** End of Transaksi Simpanan Khusus ***/

	/*** Transaksi Simpanan Dana Sosial ***/
	function simpanandanasosial($id_nasabah) {
		$session_data = $this->session->userdata('logged_in');
		if($session_data == NULL) {
			redirect("usercon/login", "refresh");
		}
		$data['nasabah'] 			= $this->nasabahmodel->get_nasabah_by_id($id_nasabah);
		$data['pinjaman'] 			= $this->pinjamanmodel->get_pinjaman_by_id_nasabah($id_nasabah);
		$data['simpananpokok'] 		= $this->simpananpokokmodel->get_simpananpokok_by_id_nasabah($id_nasabah);
		$data['simpananwajib'] 		= $this->simpananwajibmodel->get_simpananwajib_by_id_nasabah($id_nasabah);
		$data['simpanankhusus'] 	= $this->simpanankhususmodel->get_simpanankhusus_by_id_nasabah($id_nasabah);
		$data['simpanandanasosial'] = $this->simpanandanasosialmodel->get_simpanandanasosial_by_id_nasabah($id_nasabah);
		$data['simpanankanzun'] 	= $this->simpanankanzunmodel->get_simpanankanzun_by_id_nasabah($id_nasabah);
		$data['simpanan3th'] 		= $this->simpanan3thmodel->get_simpanan3th_by_id_nasabah($id_nasabah);
		$data['simpananpihakketiga']= $this->simpananpihakketigamodel->get_simpananpihakketiga_by_id_nasabah($id_nasabah);
		$data['username'] 			= $session_data['username'];
		$data['status'] 			= $session_data['status'];

		$this->load->view('/layouts/menu', $data);
		$this->load->view('/transaksianggota/index_simpanandanasosial', $data);
		$this->load->view('/layouts/footer', $data);
	}

	function create_simpanandanasosial($id_nasabah) {
		$session_data = $this->session->userdata('logged_in');
		if($session_data == NULL) {
			redirect("usercon/login", "refresh");
		}
		$data['nasabah'] 			= $this->nasabahmodel->get_nasabah_by_id($id_nasabah);
		$data['pinjaman'] 			= $this->pinjamanmodel->get_pinjaman_by_id_nasabah($id_nasabah);
		$data['simpananpokok'] 		= $this->simpananpokokmodel->get_simpananpokok_by_id_nasabah($id_nasabah);
		$data['simpananwajib'] 		= $this->simpananwajibmodel->get_simpananwajib_by_id_nasabah($id_nasabah);
		$data['simpanankhusus'] 	= $this->simpanankhususmodel->get_simpanankhusus_by_id_nasabah($id_nasabah);
		$data['simpanankanzun'] 	= $this->simpanankanzunmodel->get_simpanankanzun_by_id_nasabah($id_nasabah);
		$data['simpanan3th'] 		= $this->simpanan3thmodel->get_simpanan3th_by_id_nasabah($id_nasabah);
		$data['simpananpihakketiga']= $this->simpananpihakketigamodel->get_simpananpihakketiga_by_id_nasabah($id_nasabah);
		$data['username'] 			= $session_data['username'];
		$data['status'] 			= $session_data['status'];

		$this->load->view('/layouts/menu', $data);
		$this->load->view('/transaksianggota/create_simpanandanasosial', $data);
		$this->load->view('/layouts/footer', $data);
	}

	function insert_simpanandanasosial($id_nasabah) {
		$session_data = $this->session->userdata('logged_in');
		if($session_data == NULL) {
			redirect("usercon/login", "refresh");
		}

		$insert = array();
		$insert['id'] 				= $this->simpanandanasosialmodel->getNewId();
		$insert['id_nasabah'] 		= $this->input->post('id_nasabah');
		$insert['nomor_nasabah'] 	= $this->input->post('nomor_nasabah');
		$insert['nama_nasabah'] 	= $this->input->post('nama_nasabah');
		$insert['nik_nasabah'] 		= $this->input->post('nik_nasabah');
		$date1 						= $this->input->post('tanggal');
		$date 						= strtotime($date1);
		$insert['waktu'] 			= date("Y-m-d",$date);
		$insert['total'] 			= 0;
		$this->simpanandanasosialmodel->inputData($insert);

		redirect('transaksianggotacon/simpanankhusus/'.$id_nasabah);
	}

	function edit_simpanandanasosial($id_simpanandanasosial) {
		$session_data = $this->session->userdata('logged_in');
		if($session_data == NULL) {
			redirect("usercon/login", "refresh");
		}

		$data['simpanandanasosial'] = $this->simpanandanasosialmodel->get_simpanandanasosial_by_id($id_simpanandanasosial);
		$id_nasabah					= $data['simpanandanasosial']->id_nasabah;

		$data['nasabah'] 			= $this->nasabahmodel->get_nasabah_by_id($id_nasabah);
		$data['pinjaman'] 			= $this->pinjamanmodel->get_pinjaman_by_id_nasabah($id_nasabah);
		$data['simpananpokok'] 		= $this->simpananpokokmodel->get_simpananpokok_by_id_nasabah($id_nasabah);
		$data['simpananwajib'] 		= $this->simpananwajibmodel->get_simpananwajib_by_id_nasabah($id_nasabah);
		$data['simpanankhusus'] 	= $this->simpanankhususmodel->get_simpanankhusus_by_id_nasabah($id_nasabah);
		$data['simpanankanzun'] 	= $this->simpanankanzunmodel->get_simpanankanzun_by_id_nasabah($id_nasabah);
		$data['simpanan3th'] 		= $this->simpanan3thmodel->get_simpanan3th_by_id_nasabah($id_nasabah);
		$data['simpananpihakketiga']= $this->simpananpihakketigamodel->get_simpananpihakketiga_by_id_nasabah($id_nasabah);
		$data['username'] 			= $session_data['username'];
		$data['status'] 			= $session_data['status'];
		
		$this->load->view('/layouts/menu', $data);
		$this->load->view('/transaksianggota/edit_simpanandanasosial', $data);
		$this->load->view('/layouts/footer', $data);
	}

	function update_simpanandanasosial() {
		$session_data = $this->session->userdata('logged_in');
		if($session_data == NULL) {
			redirect("usercon/login", "refresh");
		}

		$id_simpanandanasosial = $this->input->post('id_simpanandanasosial');
		$update = array();
		$update['id_nasabah'] 		= $this->input->post('id_nasabah');
		$update['nama_nasabah'] 	= $this->input->post('nama_nasabah');
		$update['nomor_nasabah'] 	= $this->input->post('nomor_nasabah');
		$update['nik_nasabah'] 		= $this->input->post('nik_nasabah');
		$date1 						= $this->input->post('tanggal');
		$date 						= strtotime($date1);
		$update['waktu'] 			= date("Y-m-d",$date);
		$update['total'] 			= $this->input->post('total');
		$this->simpanandanasosialmodel->updateData($id_simpanandanasosial, $update);

		$id_nasabah = $update['id_nasabah'];

		redirect('transaksianggotacon/simpanandanasosial/'.$id_nasabah);
	}

	function delete_simpanandanasosial($id_simpanandanasosial) {
		$session_data = $this->session->userdata('logged_in');
		if($session_data == NULL) {
			redirect("usercon/login", "refresh");
		}

		$data['simpanandanasosial']	= $this->simpanandanasosialmodel->get_simpanandanasosial_by_id($id_simpanandanasosial);
		$id_nasabah				= $data['simpanandanasosial']->id_nasabah;

		$this->simpanandanasosialmodel->deleteData($id_simpanandanasosial);
		$this->detailsimpanandanasosialmodel->delete_by_id_simpanandanasosial($id_simpanandanasosial);

		redirect('transaksianggotacon/simpanandanasosial/'.$id_nasabah);
	}

	function view_simpanandanasosial($id_simpanandanasosial) {
		$session_data = $this->session->userdata('logged_in');
		if($session_data == NULL) {
			redirect("usercon/login", "refresh");
		}

		$data['simpanandanasosial'] 		= $this->simpanandanasosialmodel->get_simpanandanasosial_by_id($id_simpanandanasosial);
		$data['detail_simpanandanasosial'] 	= $this->detailsimpanandanasosialmodel->get_detail_simpanandanasosial_by_id_simpanandanasosial($id_simpanandanasosial);
		$id_nasabah							= $data['simpanandanasosial']->id_nasabah;
		$data['nasabah'] 					= $this->nasabahmodel->get_nasabah_by_id($id_nasabah);
		$data['pinjaman'] 					= $this->pinjamanmodel->get_pinjaman_by_id_nasabah($id_nasabah);
		$data['simpananpokok'] 				= $this->simpananpokokmodel->get_simpananpokok_by_id_nasabah($id_nasabah);
		$data['simpananwajib'] 				= $this->simpananwajibmodel->get_simpananwajib_by_id_nasabah($id_nasabah);
		$data['simpanankhusus'] 			= $this->simpanankhususmodel->get_simpanankhusus_by_id_nasabah($id_nasabah);
		$data['simpanankanzun'] 			= $this->simpanankanzunmodel->get_simpanankanzun_by_id_nasabah($id_nasabah);
		$data['simpanan3th'] 				= $this->simpanan3thmodel->get_simpanan3th_by_id_nasabah($id_nasabah);
		$data['simpananpihakketiga']= $this->simpananpihakketigamodel->get_simpananpihakketiga_by_id_nasabah($id_nasabah);
		$data['username'] 					= $session_data['username'];
		$data['status'] 					= $session_data['status'];
		
		$this->load->view('/layouts/menu', $data);
		$this->load->view('/transaksianggota/view_simpanandanasosial', $data);
		$this->load->view('/layouts/footer', $data);
	}

	function insert_detail_simpanandanasosial() {
		$session_data = $this->session->userdata('logged_in');
		if($session_data == NULL) {
			redirect("usercon/login", "refresh");
		}

		// Insert Detail Simpanan Dana SOsial ke dalam table detail_simpanandanasosial
		$date1 							= $this->input->post('waktu');
		$date 							= strtotime($date1);
		$input 							= array();
		$input['waktu'] 				= date("Y-m-d",$date);
		$input['id_simpanandanasosial']	= $this->input->post('id_simpanandanasosial');
		$input['jenis']					= $this->input->post('jenis');
		$input['bulan_tahun']			= $this->input->post('bulan_tahun');
		$input['jumlah']				= $this->input->post('jumlah');
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

		redirect('transaksianggotacon/view_simpanandanasosial/'.$id_simpanandanasosial);
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
		$id_nasabah								= $data['simpanandanasosial']->id_nasabah;
		$data['nasabah'] 						= $this->nasabahmodel->get_nasabah_by_id($id_nasabah);
		$data['detail_simpanandanasosial'] 		= $this->detailsimpanandanasosialmodel->get_detail_simpanandanasosial_by_id_simpanandanasosial($id_simpanandanasosial);
		$data['edit_detail_simpanandanasosial'] = $this->detailsimpanandanasosialmodel->get_detail_simpanandanasosial_by_id($id_detail_simpanandanasosial);
		$data['simpananpokok'] 					= $this->simpananpokokmodel->get_simpananpokok_by_id_nasabah($id_nasabah);
		$data['pinjaman'] 						= $this->pinjamanmodel->get_pinjaman_by_id_nasabah($id_nasabah);
		$data['simpananwajib'] 					= $this->simpananwajibmodel->get_simpananwajib_by_id_nasabah($id_nasabah);
		$data['simpanankhusus'] 				= $this->simpanankhususmodel->get_simpanankhusus_by_id_nasabah($id_nasabah);
		$data['simpanankanzun'] 				= $this->simpanankanzunmodel->get_simpanankanzun_by_id_nasabah($id_nasabah);
		$data['simpanan3th'] 					= $this->simpanan3thmodel->get_simpanan3th_by_id_nasabah($id_nasabah);
		$data['simpananpihakketiga']			= $this->simpananpihakketigamodel->get_simpananpihakketiga_by_id_nasabah($id_nasabah);
		$data['username'] 						= $session_data['username'];
		$data['status'] 						= $session_data['status'];

		$this->load->view('/layouts/menu', $data);
		$this->load->view('/transaksianggota/view_simpanandanasosial_edit_detail', $data);
		$this->load->view('/layouts/footer', $data);	
	}

	function update_detail_simpanandanasosial() {
		$session_data = $this->session->userdata('logged_in');
		if($session_data == NULL) {
			redirect("usercon/login", "refresh");
		}

		//Update Detail Simpanan Dana SOsial ke dalam table detail_simpanandanasosial
		$id_detail_simpanandanasosial 		= $this->input->post('edit_id');
		$date1 								= $this->input->post('edit_waktu');
		$date 								= strtotime($date1);
		$update 							= array();
		$update['waktu'] 					= date("Y-m-d",$date);
		$update['id_simpanandanasosial'] 	= $this->input->post('edit_id_simpanandanasosial');
		$update['jenis'] 					= $this->input->post('edit_jenis');
		$update['bulan_tahun']				= $this->input->post('edit_bulan_tahun');
		$update['jumlah'] 					= $this->input->post('edit_jumlah');
		$this->detailsimpanandanasosialmodel->updateData($id_detail_simpanandanasosial, $update);

		$id_simpanandanasosial = $this->input->post('edit_id_simpanandanasosial');
		$data['simpanandanasosial'] = $this->simpanandanasosialmodel->get_simpanandanasosial_by_id($id_simpanandanasosial);

		if($update['jenis'] == 'Setoran') {
			$total = $data['simpanandanasosial']->total + $update['jumlah'];
			$this->simpanandanasosialmodel->update_total($id_simpanandanasosial, $total);
		} else if($update['jenis'] == 'Tarikan') {
			$total = $data['simpanandanasosial']->total - $update['jumlah'];
			$this->simpanandanasosialmodel->update_total($id_simpanandanasosial, $total);
		}

		redirect('transaksianggotacon/view_simpanandanasosial/'.$id_simpanandanasosial);
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

		redirect('transaksianggotacon/view_simpanandanasosial/'.$id_simpanandanasosial);
	}
	/*** End of Transaksi Simpanan Dana Sosial ***/

	/*** Transaksi Simpanan Kanzun ***/
	function simpanankanzun($id_nasabah) {
		$session_data = $this->session->userdata('logged_in');
		if($session_data == NULL) {
			redirect("usercon/login", "refresh");
		}
		$data['nasabah'] 			= $this->nasabahmodel->get_nasabah_by_id($id_nasabah);
		$data['pinjaman'] 			= $this->pinjamanmodel->get_pinjaman_by_id_nasabah($id_nasabah);
		$data['simpananpokok'] 		= $this->simpananpokokmodel->get_simpananpokok_by_id_nasabah($id_nasabah);
		$data['simpananwajib'] 		= $this->simpananwajibmodel->get_simpananwajib_by_id_nasabah($id_nasabah);
		$data['simpanankhusus'] 	= $this->simpanankhususmodel->get_simpanankhusus_by_id_nasabah($id_nasabah);
		$data['simpanandanasosial'] = $this->simpanandanasosialmodel->get_simpanandanasosial_by_id_nasabah($id_nasabah);
		$data['simpanankanzun'] 	= $this->simpanankanzunmodel->get_simpanankanzun_by_id_nasabah($id_nasabah);
		$data['simpanan3th'] 		= $this->simpanan3thmodel->get_simpanan3th_by_id_nasabah($id_nasabah);
		$data['simpananpihakketiga']= $this->simpananpihakketigamodel->get_simpananpihakketiga_by_id_nasabah($id_nasabah);
		$data['username'] 			= $session_data['username'];
		$data['status'] 			= $session_data['status'];

		$this->load->view('/layouts/menu', $data);
		$this->load->view('/transaksianggota/index_simpanankanzun', $data);
		$this->load->view('/layouts/footer', $data);
	}

	function create_simpanankanzun($id_nasabah) {
		$session_data = $this->session->userdata('logged_in');
		if($session_data == NULL) {
			redirect("usercon/login", "refresh");
		}
		$data['nasabah'] 			= $this->nasabahmodel->get_nasabah_by_id($id_nasabah);
		$data['pinjaman'] 			= $this->pinjamanmodel->get_pinjaman_by_id_nasabah($id_nasabah);
		$data['simpananpokok'] 		= $this->simpananpokokmodel->get_simpananpokok_by_id_nasabah($id_nasabah);
		$data['simpananwajib'] 		= $this->simpananwajibmodel->get_simpananwajib_by_id_nasabah($id_nasabah);
		$data['simpanandanasosial'] = $this->simpanandanasosialmodel->get_simpanandanasosial_by_id_nasabah($id_nasabah);
		$data['simpanankhusus'] 	= $this->simpanankhususmodel->get_simpanankhusus_by_id_nasabah($id_nasabah);
		$data['simpanan3th'] 		= $this->simpanan3thmodel->get_simpanan3th_by_id_nasabah($id_nasabah);
		$data['simpananpihakketiga']= $this->simpananpihakketigamodel->get_simpananpihakketiga_by_id_nasabah($id_nasabah);
		$data['username'] 			= $session_data['username'];
		$data['status'] 			= $session_data['status'];

		$this->load->view('/layouts/menu', $data);
		$this->load->view('/transaksianggota/create_simpanankanzun', $data);
		$this->load->view('/layouts/footer', $data);
	}

	function insert_simpanankanzun($id_nasabah) {
		$session_data = $this->session->userdata('logged_in');
		if($session_data == NULL) {
			redirect("usercon/login", "refresh");
		}

		$insert = array();
		$insert['id'] 				= $this->simpanankanzunmodel->getNewId();
		$insert['id_nasabah'] 		= $this->input->post('id_nasabah');
		$insert['nomor_nasabah'] 	= $this->input->post('nomor_nasabah');
		$insert['nama_nasabah'] 	= $this->input->post('nama_nasabah');
		$insert['nik_nasabah'] 		= $this->input->post('nik_nasabah');
		$date1 						= $this->input->post('tanggal');
		$date 						= strtotime($date1);
		$insert['waktu'] 			= date("Y-m-d",$date);
		$insert['total'] 			= 0;
		$this->simpanankanzunmodel->inputData($insert);

		redirect('transaksianggotacon/simpanankanzun/'.$id_nasabah);
	}

	function edit_simpanankanzun($id_simpanankanzun) {
		$session_data = $this->session->userdata('logged_in');
		if($session_data == NULL) {
			redirect("usercon/login", "refresh");
		}

		$data['simpanankanzun'] 	= $this->simpanankanzunmodel->get_simpanankanzun_by_id($id_simpanankanzun);
		$id_nasabah					= $data['simpanankanzun']->id_nasabah;

		$data['nasabah'] 			= $this->nasabahmodel->get_nasabah_by_id($id_nasabah);
		$data['pinjaman'] 			= $this->pinjamanmodel->get_pinjaman_by_id_nasabah($id_nasabah);
		$data['simpananpokok'] 		= $this->simpananpokokmodel->get_simpananpokok_by_id_nasabah($id_nasabah);
		$data['simpananwajib'] 		= $this->simpananwajibmodel->get_simpananwajib_by_id_nasabah($id_nasabah);
		$data['simpanandanasosial'] = $this->simpanandanasosialmodel->get_simpanandanasosial_by_id_nasabah($id_nasabah);
		$data['simpanankhusus'] 	= $this->simpanankhususmodel->get_simpanankhusus_by_id_nasabah($id_nasabah);
		$data['simpanan3th'] 		= $this->simpanan3thmodel->get_simpanan3th_by_id_nasabah($id_nasabah);
		$data['simpananpihakketiga']= $this->simpananpihakketigamodel->get_simpananpihakketiga_by_id_nasabah($id_nasabah);
		$data['username'] 			= $session_data['username'];
		$data['status'] 			= $session_data['status'];
		
		$this->load->view('/layouts/menu', $data);
		$this->load->view('/transaksianggota/edit_simpanankanzun', $data);
		$this->load->view('/layouts/footer', $data);
	}

	function update_simpanankanzun() {
		$session_data = $this->session->userdata('logged_in');
		if($session_data == NULL) {
			redirect("usercon/login", "refresh");
		}

		$id_simpanankanzun = $this->input->post('id_simpanankanzun');
		$update = array();
		$update['id_nasabah'] 		= $this->input->post('id_nasabah');
		$update['nama_nasabah'] 	= $this->input->post('nama_nasabah');
		$update['nomor_nasabah'] 	= $this->input->post('nomor_nasabah');
		$update['nik_nasabah'] 		= $this->input->post('nik_nasabah');
		$date1 						= $this->input->post('tanggal');
		$date 						= strtotime($date1);
		$update['waktu'] 			= date("Y-m-d",$date);
		$update['total'] 			= $this->input->post('total');
		$this->simpanankanzunmodel->updateData($id_simpanankanzun, $update);

		$id_nasabah = $update['id_nasabah'];

		redirect('transaksianggotacon/simpanankanzun/'.$id_nasabah);
	}

	function delete_simpanankanzun($id_simpanankanzun) {
		$session_data = $this->session->userdata('logged_in');
		if($session_data == NULL) {
			redirect("usercon/login", "refresh");
		}

		$data['simpanankanzun']	= $this->simpanankanzunmodel->get_simpanankanzun_by_id($id_simpanankanzun);
		$id_nasabah				= $data['simpanankanzun']->id_nasabah;

		$this->simpanankanzunmodel->deleteData($id_simpanankanzun);
		$this->detailsimpanankanzunmodel->delete_by_id_simpanankanzun($id_simpanankanzun);

		redirect('transaksianggotacon/simpanankanzun/'.$id_nasabah);
	}

	function view_simpanankanzun($id_simpanankanzun) {
		$session_data = $this->session->userdata('logged_in');
		if($session_data == NULL) {
			redirect("usercon/login", "refresh");
		}

		$data['simpanankanzun'] 		= $this->simpanankanzunmodel->get_simpanankanzun_by_id($id_simpanankanzun);
		$data['detail_simpanankanzun'] 	= $this->detailsimpanankanzunmodel->get_detail_simpanankanzun_by_id_simpanankanzun($id_simpanankanzun);
		$id_nasabah						= $data['simpanankanzun']->id_nasabah;
		$data['nasabah'] 				= $this->nasabahmodel->get_nasabah_by_id($id_nasabah);
		$data['pinjaman'] 				= $this->pinjamanmodel->get_pinjaman_by_id_nasabah($id_nasabah);
		$data['simpananpokok'] 			= $this->simpananpokokmodel->get_simpananpokok_by_id_nasabah($id_nasabah);
		$data['simpananwajib'] 			= $this->simpananwajibmodel->get_simpananwajib_by_id_nasabah($id_nasabah);
		$data['simpanandanasosial'] 	= $this->simpanandanasosialmodel->get_simpanandanasosial_by_id_nasabah($id_nasabah);
		$data['simpanankhusus'] 		= $this->simpanankhususmodel->get_simpanankhusus_by_id_nasabah($id_nasabah);
		$data['simpanan3th'] 			= $this->simpanan3thmodel->get_simpanan3th_by_id_nasabah($id_nasabah);
		$data['simpananpihakketiga']	= $this->simpananpihakketigamodel->get_simpananpihakketiga_by_id_nasabah($id_nasabah);
		$data['username'] 				= $session_data['username'];
		$data['status'] 				= $session_data['status'];
		
		$this->load->view('/layouts/menu', $data);
		$this->load->view('/transaksianggota/view_simpanankanzun', $data);
		$this->load->view('/layouts/footer', $data);
	}

	function insert_detail_simpanankanzun() {
		$session_data = $this->session->userdata('logged_in');
		if($session_data == NULL) {
			redirect("usercon/login", "refresh");
		}

		// Insert Detail Simpanan Kanzun ke dalam table detail_simpanankanzun
		$date1 						= $this->input->post('waktu');
		$date 						= strtotime($date1);
		$input 						= array();
		$input['waktu'] 			= date("Y-m-d",$date);
		$input['id_simpanankanzun']	= $this->input->post('id_simpanankanzun');
		$input['jenis']				= $this->input->post('jenis');
		$input['bulan_tahun']		= $this->input->post('bulan_tahun');
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

		redirect('transaksianggotacon/view_simpanankanzun/'.$id_simpanankanzun);
	}

	function edit_detail_simpanankanzun($id_simpanankanzun, $id_detail_simpanankanzun) {
		$session_data = $this->session->userdata('logged_in');
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
		$id_nasabah							= $data['simpanankanzun']->id_nasabah;
		$data['nasabah'] 					= $this->nasabahmodel->get_nasabah_by_id($id_nasabah);
		$data['detail_simpanankanzun'] 		= $this->detailsimpanankanzunmodel->get_detail_simpanankanzun_by_id_simpanankanzun($id_simpanankanzun);
		$data['edit_detail_simpanankanzun'] = $this->detailsimpanankanzunmodel->get_detail_simpanankanzun_by_id($id_detail_simpanankanzun);
		$data['simpananpokok'] 				= $this->simpananpokokmodel->get_simpananpokok_by_id_nasabah($id_nasabah);
		$data['pinjaman'] 					= $this->pinjamanmodel->get_pinjaman_by_id_nasabah($id_nasabah);
		$data['simpananwajib'] 				= $this->simpananwajibmodel->get_simpananwajib_by_id_nasabah($id_nasabah);
		$data['simpanandanasosial'] 		= $this->simpanandanasosialmodel->get_simpanandanasosial_by_id_nasabah($id_nasabah);
		$data['simpanankhusus'] 			= $this->simpanankhususmodel->get_simpanankhusus_by_id_nasabah($id_nasabah);
		$data['simpanan3th'] 				= $this->simpanan3thmodel->get_simpanan3th_by_id_nasabah($id_nasabah);
		$data['simpananpihakketiga']		= $this->simpananpihakketigamodel->get_simpananpihakketiga_by_id_nasabah($id_nasabah);
		$data['username'] 					= $session_data['username'];
		$data['status'] 					= $session_data['status'];

		$this->load->view('/layouts/menu', $data);
		$this->load->view('/transaksianggota/view_simpanankanzun_edit_detail', $data);
		$this->load->view('/layouts/footer', $data);	
	}

	function update_detail_simpanankanzun() {
		$session_data = $this->session->userdata('logged_in');
		if($session_data == NULL) {
			redirect("usercon/login", "refresh");
		}

		//Update Detail Simpanan Kanzun ke dalam table detail_simpanankanzun
		$id_detail_simpanankanzun 		= $this->input->post('edit_id');
		$date1 							= $this->input->post('edit_waktu');
		$date 							= strtotime($date1);
		$update 						= array();
		$update['waktu'] 				= date("Y-m-d",$date);
		$update['id_simpanankanzun'] 	= $this->input->post('edit_id_simpanankanzun');
		$update['jenis'] 				= $this->input->post('edit_jenis');
		$update['bulan_tahun']			= $this->input->post('edit_bulan_tahun');
		$update['jumlah'] 				= $this->input->post('edit_jumlah');
		$this->detailsimpanankanzunmodel->updateData($id_detail_simpanankanzun, $update);

		$id_simpanankanzun = $this->input->post('edit_id_simpanankanzun');
		$data['simpanankanzun'] = $this->simpanankanzunmodel->get_simpanankanzun_by_id($id_simpanankanzun);

		if($update['jenis'] == 'Setoran') {
			$total = $data['simpanankanzun']->total + $update['jumlah'];
			$this->simpanankanzunmodel->update_total($id_simpanankanzun, $total);
		} else if($update['jenis'] == 'Tarikan') {
			$total = $data['simpanankanzun']->total - $update['jumlah'];
			$this->simpanankanzunmodel->update_total($id_simpanankanzun, $total);
		}

		redirect('transaksianggotacon/view_simpanankanzun/'.$id_simpanankanzun);
	}

	function delete_detail_simpanankanzun($id_simpanankanzun, $id_detail_simpanankanzun) {
		$session_data = $this->session->userdata('logged_in');
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

		redirect('transaksianggotacon/view_simpanankanzun/'.$id_simpanankanzun);
	}
	/*** End of Transaksi Simpanan Kanzun ***/

	/*** Transaksi Simpanan 3 Th ***/
	function simpanan3th($id_nasabah) {
		$session_data = $this->session->userdata('logged_in');
		if($session_data == NULL) {
			redirect("usercon/login", "refresh");
		}
		$data['nasabah'] 			= $this->nasabahmodel->get_nasabah_by_id($id_nasabah);
		$data['pinjaman'] 			= $this->pinjamanmodel->get_pinjaman_by_id_nasabah($id_nasabah);
		$data['simpananpokok'] 		= $this->simpananpokokmodel->get_simpananpokok_by_id_nasabah($id_nasabah);
		$data['simpananwajib'] 		= $this->simpananwajibmodel->get_simpananwajib_by_id_nasabah($id_nasabah);
		$data['simpanankhusus'] 	= $this->simpanankhususmodel->get_simpanankhusus_by_id_nasabah($id_nasabah);
		$data['simpanandanasosial'] = $this->simpanandanasosialmodel->get_simpanandanasosial_by_id_nasabah($id_nasabah);
		$data['simpanankanzun'] 	= $this->simpanankanzunmodel->get_simpanankanzun_by_id_nasabah($id_nasabah);
		$data['simpanan3th'] 		= $this->simpanan3thmodel->get_simpanan3th_by_id_nasabah($id_nasabah);
		$data['simpananpihakketiga']= $this->simpananpihakketigamodel->get_simpananpihakketiga_by_id_nasabah($id_nasabah);
		$data['username'] 			= $session_data['username'];
		$data['status'] 			= $session_data['status'];

		$this->load->view('/layouts/menu', $data);
		$this->load->view('/transaksianggota/index_simpanan3th', $data);
		$this->load->view('/layouts/footer', $data);
	}

	function create_simpanan3th($id_nasabah) {
		$session_data = $this->session->userdata('logged_in');
		if($session_data == NULL) {
			redirect("usercon/login", "refresh");
		}
		$data['nasabah'] 			= $this->nasabahmodel->get_nasabah_by_id($id_nasabah);
		$data['pinjaman'] 			= $this->pinjamanmodel->get_pinjaman_by_id_nasabah($id_nasabah);
		$data['simpananpokok'] 		= $this->simpananpokokmodel->get_simpananpokok_by_id_nasabah($id_nasabah);
		$data['simpananwajib'] 		= $this->simpananwajibmodel->get_simpananwajib_by_id_nasabah($id_nasabah);
		$data['simpanandanasosial'] = $this->simpanandanasosialmodel->get_simpanandanasosial_by_id_nasabah($id_nasabah);
		$data['simpanankanzun'] 	= $this->simpanankanzunmodel->get_simpanankanzun_by_id_nasabah($id_nasabah);
		$data['simpanankhusus'] 	= $this->simpanankhususmodel->get_simpanankhusus_by_id_nasabah($id_nasabah);
		$data['simpananpihakketiga']= $this->simpananpihakketigamodel->get_simpananpihakketiga_by_id_nasabah($id_nasabah);
		$data['username'] 			= $session_data['username'];
		$data['status'] 			= $session_data['status'];

		$this->load->view('/layouts/menu', $data);
		$this->load->view('/transaksianggota/create_simpanan3th', $data);
		$this->load->view('/layouts/footer', $data);
	}

	function insert_simpanan3th($id_nasabah) {
		$session_data = $this->session->userdata('logged_in');
		if($session_data == NULL) {
			redirect("usercon/login", "refresh");
		}

		$insert = array();
		$insert['id'] 				= $this->simpanan3thmodel->getNewId();
		$insert['id_nasabah'] 		= $this->input->post('id_nasabah');
		$insert['nomor_nasabah'] 	= $this->input->post('nomor_nasabah');
		$insert['nama_nasabah'] 	= $this->input->post('nama_nasabah');
		$insert['nik_nasabah'] 		= $this->input->post('nik_nasabah');
		$date1 						= $this->input->post('tanggal');
		$date 						= strtotime($date1);
		$insert['waktu'] 			= date("Y-m-d",$date);
		$insert['total'] 			= 0;
		$this->simpanan3thmodel->inputData($insert);

		redirect('transaksianggotacon/simpanan3th/'.$id_nasabah);
	}

	function edit_simpanan3th($id_simpanan3th) {
		$session_data = $this->session->userdata('logged_in');
		if($session_data == NULL) {
			redirect("usercon/login", "refresh");
		}

		$data['simpanan3th'] 		= $this->simpanan3thmodel->get_simpanan3th_by_id($id_simpanan3th);
		$id_nasabah					= $data['simpanan3th']->id_nasabah;

		$data['nasabah'] 			= $this->nasabahmodel->get_nasabah_by_id($id_nasabah);
		$data['pinjaman'] 			= $this->pinjamanmodel->get_pinjaman_by_id_nasabah($id_nasabah);
		$data['simpananpokok'] 		= $this->simpananpokokmodel->get_simpananpokok_by_id_nasabah($id_nasabah);
		$data['simpananwajib'] 		= $this->simpananwajibmodel->get_simpananwajib_by_id_nasabah($id_nasabah);
		$data['simpanandanasosial'] = $this->simpanandanasosialmodel->get_simpanandanasosial_by_id_nasabah($id_nasabah);
		$data['simpanankanzun'] 	= $this->simpanankanzunmodel->get_simpanankanzun_by_id_nasabah($id_nasabah);
		$data['simpanankhusus'] 	= $this->simpanankhususmodel->get_simpanankhusus_by_id_nasabah($id_nasabah);
		$data['simpananpihakketiga']= $this->simpananpihakketigamodel->get_simpananpihakketiga_by_id_nasabah($id_nasabah);
		$data['username'] 			= $session_data['username'];
		$data['status'] 			= $session_data['status'];
		
		$this->load->view('/layouts/menu', $data);
		$this->load->view('/transaksianggota/edit_simpanan3th', $data);
		$this->load->view('/layouts/footer', $data);
	}

	function update_simpanan3th() {
		$session_data = $this->session->userdata('logged_in');
		if($session_data == NULL) {
			redirect("usercon/login", "refresh");
		}

		$id_simpanan3th = $this->input->post('id_simpanan3th');
		$update = array();
		$update['id_nasabah'] 		= $this->input->post('id_nasabah');
		$update['nama_nasabah'] 	= $this->input->post('nama_nasabah');
		$update['nomor_nasabah'] 	= $this->input->post('nomor_nasabah');
		$update['nik_nasabah'] 		= $this->input->post('nik_nasabah');
		$date1 						= $this->input->post('tanggal');
		$date 						= strtotime($date1);
		$update['waktu'] 			= date("Y-m-d",$date);
		$update['total'] 			= $this->input->post('total');
		$this->simpanan3thmodel->updateData($id_simpanan3th, $update);

		$id_nasabah = $update['id_nasabah'];

		redirect('transaksianggotacon/simpanan3th/'.$id_nasabah);
	}

	function delete_simpanan3th($id_simpanan3th) {
		$session_data = $this->session->userdata('logged_in');
		if($session_data == NULL) {
			redirect("usercon/login", "refresh");
		}

		$data['simpanan3th']	= $this->simpanan3thmodel->get_simpanan3th_by_id($id_simpanan3th);
		$id_nasabah				= $data['simpanan3th']->id_nasabah;

		$this->simpanan3thmodel->deleteData($id_simpanan3th);
		$this->detailsimpanan3thmodel->delete_by_id_simpanan3th($id_simpanan3th);

		redirect('transaksianggotacon/simpanan3th/'.$id_nasabah);
	}

	function view_simpanan3th($id_simpanan3th) {
		$session_data = $this->session->userdata('logged_in');
		if($session_data == NULL) {
			redirect("usercon/login", "refresh");
		}

		$data['simpanan3th'] 			= $this->simpanan3thmodel->get_simpanan3th_by_id($id_simpanan3th);
		$data['detail_simpanan3th'] 	= $this->detailsimpanan3thmodel->get_detail_simpanan3th_by_id_simpanan3th($id_simpanan3th);
		$id_nasabah						= $data['simpanan3th']->id_nasabah;
		$data['nasabah'] 				= $this->nasabahmodel->get_nasabah_by_id($id_nasabah);
		$data['pinjaman'] 				= $this->pinjamanmodel->get_pinjaman_by_id_nasabah($id_nasabah);
		$data['simpananpokok'] 			= $this->simpananpokokmodel->get_simpananpokok_by_id_nasabah($id_nasabah);
		$data['simpananwajib'] 			= $this->simpananwajibmodel->get_simpananwajib_by_id_nasabah($id_nasabah);
		$data['simpanandanasosial'] 	= $this->simpanandanasosialmodel->get_simpanandanasosial_by_id_nasabah($id_nasabah);
		$data['simpanankanzun'] 		= $this->simpanankanzunmodel->get_simpanankanzun_by_id_nasabah($id_nasabah);
		$data['simpanankhusus'] 		= $this->simpanankhususmodel->get_simpanankhusus_by_id_nasabah($id_nasabah);
		$data['simpananpihakketiga']= $this->simpananpihakketigamodel->get_simpananpihakketiga_by_id_nasabah($id_nasabah);
		$data['username'] 				= $session_data['username'];
		$data['status'] 				= $session_data['status'];
		
		$this->load->view('/layouts/menu', $data);
		$this->load->view('/transaksianggota/view_simpanan3th', $data);
		$this->load->view('/layouts/footer', $data);
	}

	function insert_detail_simpanan3th() {
		$session_data = $this->session->userdata('logged_in');
		if($session_data == NULL) {
			redirect("usercon/login", "refresh");
		}

		// Insert Detail Simpanan 3 Th ke dalam table detail_simpanan3th
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

		redirect('transaksianggotacon/view_simpanan3th/'.$id_simpanan3th);
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
		$id_nasabah							= $data['simpanan3th']->id_nasabah;
		$data['nasabah'] 					= $this->nasabahmodel->get_nasabah_by_id($id_nasabah);
		$data['detail_simpanan3th'] 		= $this->detailsimpanan3thmodel->get_detail_simpanan3th_by_id_simpanan3th($id_simpanan3th);
		$data['edit_detail_simpanan3th'] 	= $this->detailsimpanan3thmodel->get_detail_simpanan3th_by_id($id_detail_simpanan3th);
		$data['simpananpokok'] 				= $this->simpananpokokmodel->get_simpananpokok_by_id_nasabah($id_nasabah);
		$data['pinjaman'] 					= $this->pinjamanmodel->get_pinjaman_by_id_nasabah($id_nasabah);
		$data['simpananwajib'] 				= $this->simpananwajibmodel->get_simpananwajib_by_id_nasabah($id_nasabah);
		$data['simpanandanasosial'] 		= $this->simpanandanasosialmodel->get_simpanandanasosial_by_id_nasabah($id_nasabah);
		$data['simpanankanzun'] 			= $this->simpanankanzunmodel->get_simpanankanzun_by_id_nasabah($id_nasabah);
		$data['simpanankhusus'] 			= $this->simpanankhususmodel->get_simpanankhusus_by_id_nasabah($id_nasabah);
		$data['simpananpihakketiga']		= $this->simpananpihakketigamodel->get_simpananpihakketiga_by_id_nasabah($id_nasabah);
		$data['username'] 					= $session_data['username'];
		$data['status'] 					= $session_data['status'];

		$this->load->view('/layouts/menu', $data);
		$this->load->view('/transaksianggota/view_simpanan3th_edit_detail', $data);
		$this->load->view('/layouts/footer', $data);	
	}

	function update_detail_simpanan3th() {
		$session_data = $this->session->userdata('logged_in');
		if($session_data == NULL) {
			redirect("usercon/login", "refresh");
		}

		//Update Detail Simpanan 3 Th ke dalam table detail_simpanan3th
		$id_detail_simpanan3th 			= $this->input->post('edit_id');
		$date1 							= $this->input->post('edit_waktu');
		$date 							= strtotime($date1);
		$update 						= array();
		$update['waktu'] 				= date("Y-m-d",$date);
		$update['id_simpanan3th'] 		= $this->input->post('edit_id_simpanan3th');
		$update['jenis'] 				= $this->input->post('edit_jenis');
		$update['bulan_tahun'] 			= $this->input->post('edit_bulan_tahun');
		$update['jumlah'] 				= $this->input->post('edit_jumlah');
		$this->detailsimpanan3thmodel->updateData($id_detail_simpanan3th, $update);

		$id_simpanan3th = $this->input->post('edit_id_simpanan3th');
		$data['simpanan3th'] = $this->simpanan3thmodel->get_simpanan3th_by_id($id_simpanan3th);

		if($update['jenis'] == 'Setoran') {
			$total = $data['simpanan3th']->total + $update['jumlah'];
			$this->simpanan3thmodel->update_total($id_simpanan3th, $total);
		} else if($update['jenis'] == 'Tarikan') {
			$total = $data['simpanan3th']->total - $update['jumlah'];
			$this->simpanan3thmodel->update_total($id_simpanan3th, $total);
		}

		redirect('transaksianggotacon/view_simpanan3th/'.$id_simpanan3th);
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

		redirect('transaksianggotacon/view_simpanan3th/'.$id_simpanan3th);
	}
	/*** End of Transaksi Simpanan 3 Th ***/	

	/*** Transaksi Simpanan 3 Th ***/
	function simpananpihakketiga($id_nasabah) {
		$session_data = $this->session->userdata('logged_in');
		if($session_data == NULL) {
			redirect("usercon/login", "refresh");
		}
		$data['nasabah'] 			= $this->nasabahmodel->get_nasabah_by_id($id_nasabah);
		$data['pinjaman'] 			= $this->pinjamanmodel->get_pinjaman_by_id_nasabah($id_nasabah);
		$data['simpananpokok'] 		= $this->simpananpokokmodel->get_simpananpokok_by_id_nasabah($id_nasabah);
		$data['simpananwajib'] 		= $this->simpananwajibmodel->get_simpananwajib_by_id_nasabah($id_nasabah);
		$data['simpanankhusus'] 	= $this->simpanankhususmodel->get_simpanankhusus_by_id_nasabah($id_nasabah);
		$data['simpanandanasosial'] = $this->simpanandanasosialmodel->get_simpanandanasosial_by_id_nasabah($id_nasabah);
		$data['simpanankanzun'] 	= $this->simpanankanzunmodel->get_simpanankanzun_by_id_nasabah($id_nasabah);
		$data['simpanan3th'] 		= $this->simpanan3thmodel->get_simpanan3th_by_id_nasabah($id_nasabah);
		$data['simpananpihakketiga']= $this->simpananpihakketigamodel->get_simpananpihakketiga_by_id_nasabah($id_nasabah);
		$data['username'] 			= $session_data['username'];
		$data['status'] 			= $session_data['status'];

		$this->load->view('/layouts/menu', $data);
		$this->load->view('/transaksianggota/index_simpananpihakketiga', $data);
		$this->load->view('/layouts/footer', $data);
	}

	function create_simpananpihakketiga($id_nasabah) {
		$session_data = $this->session->userdata('logged_in');
		if($session_data == NULL) {
			redirect("usercon/login", "refresh");
		}
		$data['nasabah'] 			= $this->nasabahmodel->get_nasabah_by_id($id_nasabah);
		$data['pinjaman'] 			= $this->pinjamanmodel->get_pinjaman_by_id_nasabah($id_nasabah);
		$data['simpananpokok'] 		= $this->simpananpokokmodel->get_simpananpokok_by_id_nasabah($id_nasabah);
		$data['simpananwajib'] 		= $this->simpananwajibmodel->get_simpananwajib_by_id_nasabah($id_nasabah);
		$data['simpanandanasosial'] = $this->simpanandanasosialmodel->get_simpanandanasosial_by_id_nasabah($id_nasabah);
		$data['simpanankanzun'] 	= $this->simpanankanzunmodel->get_simpanankanzun_by_id_nasabah($id_nasabah);
		$data['simpanankhusus'] 	= $this->simpanankhususmodel->get_simpanankhusus_by_id_nasabah($id_nasabah);
		$data['simpanan3th'] 		= $this->simpanan3thmodel->get_simpanan3th_by_id_nasabah($id_nasabah);
		$data['username'] 			= $session_data['username'];
		$data['status'] 			= $session_data['status'];

		$this->load->view('/layouts/menu', $data);
		$this->load->view('/transaksianggota/create_simpananpihakketiga', $data);
		$this->load->view('/layouts/footer', $data);
	}

	function insert_simpananpihakketiga($id_nasabah) {
		$session_data = $this->session->userdata('logged_in');
		if($session_data == NULL) {
			redirect("usercon/login", "refresh");
		}

		$insert = array();
		$insert['id'] 				= $this->simpananpihakketigamodel->getNewId();
		$insert['id_nasabah'] 		= $this->input->post('id_nasabah');
		$insert['nomor_nasabah'] 	= $this->input->post('nomor_nasabah');
		$insert['nama'] 			= $this->input->post('nama_nasabah');
		$insert['nik']		 		= $this->input->post('nik_nasabah');
		$date1 						= $this->input->post('tanggal');
		$date 						= strtotime($date1);
		$insert['waktu'] 			= date("Y-m-d",$date);
		$insert['total'] 			= 0;
		$this->simpananpihakketigamodel->inputData($insert);

		redirect('transaksianggotacon/simpananpihakketiga/'.$id_nasabah);
	}

	function edit_simpananpihakketiga($id_simpananpihakketiga) {
		$session_data = $this->session->userdata('logged_in');
		if($session_data == NULL) {
			redirect("usercon/login", "refresh");
		}

		$data['simpananpihakketiga']= $this->simpananpihakketigamodel->get_simpananpihakketiga_by_id($id_simpananpihakketiga);
		$id_nasabah					= $data['simpananpihakketiga']->id_nasabah;

		$data['nasabah'] 			= $this->nasabahmodel->get_nasabah_by_id($id_nasabah);
		$data['pinjaman'] 			= $this->pinjamanmodel->get_pinjaman_by_id_nasabah($id_nasabah);
		$data['simpananpokok'] 		= $this->simpananpokokmodel->get_simpananpokok_by_id_nasabah($id_nasabah);
		$data['simpananwajib'] 		= $this->simpananwajibmodel->get_simpananwajib_by_id_nasabah($id_nasabah);
		$data['simpanandanasosial'] = $this->simpanandanasosialmodel->get_simpanandanasosial_by_id_nasabah($id_nasabah);
		$data['simpanankanzun'] 	= $this->simpanankanzunmodel->get_simpanankanzun_by_id_nasabah($id_nasabah);
		$data['simpanankhusus'] 	= $this->simpanankhususmodel->get_simpanankhusus_by_id_nasabah($id_nasabah);
		$data['simpanan3th'] 		= $this->simpanan3thmodel->get_simpanan3th_by_id_nasabah($id_nasabah);
		$data['username'] 			= $session_data['username'];
		$data['status'] 			= $session_data['status'];
		
		$this->load->view('/layouts/menu', $data);
		$this->load->view('/transaksianggota/edit_simpananpihakketiga', $data);
		$this->load->view('/layouts/footer', $data);
	}

	function update_simpananpihakketiga() {
		$session_data = $this->session->userdata('logged_in');
		if($session_data == NULL) {
			redirect("usercon/login", "refresh");
		}

		$id_simpananpihakketiga = $this->input->post('id_simpananpihakketiga');
		$update = array();
		$update['id_nasabah'] 		= $this->input->post('id_nasabah');
		$update['nama'] 			= $this->input->post('nama_nasabah');
		$update['nomor_nasabah'] 	= $this->input->post('nomor_nasabah');
		$update['nik'] 				= $this->input->post('nik_nasabah');
		$date1 						= $this->input->post('tanggal');
		$date 						= strtotime($date1);
		$update['waktu'] 			= date("Y-m-d",$date);
		$update['total'] 			= $this->input->post('total');
		$this->simpananpihakketigamodel->updateData($id_simpananpihakketiga, $update);

		$id_nasabah = $update['id_nasabah'];

		redirect('transaksianggotacon/simpananpihakketiga/'.$id_nasabah);
	}

	function delete_simpananpihakketiga($id_simpananpihakketiga) {
		$session_data = $this->session->userdata('logged_in');
		if($session_data == NULL) {
			redirect("usercon/login", "refresh");
		}

		$data['simpananpihakketiga']= $this->simpananpihakketigamodel->get_simpananpihakketiga_by_id($id_simpananpihakketiga);
		$id_nasabah					= $data['simpananpihakketiga']->id_nasabah;

		$this->simpananpihakketigamodel->deleteData($id_simpananpihakketiga);
		$this->detailsimpananpihakketigamodel->delete_by_id_simpananpihakketiga($id_simpananpihakketiga);

		redirect('transaksianggotacon/simpananpihakketiga/'.$id_nasabah);
	}

	function view_simpananpihakketiga($id_simpananpihakketiga) {
		$session_data = $this->session->userdata('logged_in');
		if($session_data == NULL) {
			redirect("usercon/login", "refresh");
		}

		$data['simpananpihakketiga'] 		= $this->simpananpihakketigamodel->get_simpananpihakketiga_by_id($id_simpananpihakketiga);
		$data['detail_simpananpihakketiga']	= $this->detailsimpananpihakketigamodel->get_detail_simpananpihakketiga_by_id_simpananpihakketiga($id_simpananpihakketiga);
		$id_nasabah							= $data['simpananpihakketiga']->id_nasabah;
		$data['nasabah'] 					= $this->nasabahmodel->get_nasabah_by_id($id_nasabah);
		$data['pinjaman'] 					= $this->pinjamanmodel->get_pinjaman_by_id_nasabah($id_nasabah);
		$data['simpananpokok'] 				= $this->simpananpokokmodel->get_simpananpokok_by_id_nasabah($id_nasabah);
		$data['simpananwajib'] 				= $this->simpananwajibmodel->get_simpananwajib_by_id_nasabah($id_nasabah);
		$data['simpanandanasosial'] 		= $this->simpanandanasosialmodel->get_simpanandanasosial_by_id_nasabah($id_nasabah);
		$data['simpanankanzun'] 			= $this->simpanankanzunmodel->get_simpanankanzun_by_id_nasabah($id_nasabah);
		$data['simpanankhusus'] 			= $this->simpanankhususmodel->get_simpanankhusus_by_id_nasabah($id_nasabah);
		$data['simpanan3th'] 				= $this->simpanan3thmodel->get_simpanan3th_by_id_nasabah($id_nasabah);
		$data['username'] 					= $session_data['username'];
		$data['status'] 					= $session_data['status'];

		$this->load->view('/layouts/menu', $data);
		$this->load->view('/transaksianggota/view_simpananpihakketiga', $data);
		$this->load->view('/layouts/footer', $data);
	}

	function insert_detail_simpananpihakketiga() {
		$session_data = $this->session->userdata('logged_in');
		if($session_data == NULL) {
			redirect("usercon/login", "refresh");
		}

		// Insert Detail Simpanan 3 Th ke dalam table detail_simpanan3th
		$date1 								= $this->input->post('waktu');
		$date 								= strtotime($date1);
		$input 								= array();
		$input['waktu'] 					= date("Y-m-d",$date);
		$input['id_simpananpihakketiga']	= $this->input->post('id_simpananpihakketiga');
		$input['jenis']						= $this->input->post('jenis');
		$input['bulan_tahun']				= $this->input->post('bulan_tahun');
		$input['jumlah']					= $this->input->post('jumlah');
		$this->detailsimpananpihakketigamodel->inputData($input);

		$id_simpananpihakketiga = $this->input->post('id_simpananpihakketiga');
		$data['simpananpihakketiga'] = $this->simpananpihakketigamodel->get_simpananpihakketiga_by_id($id_simpananpihakketiga);

		if($input['jenis'] == 'Setoran') {
			$total 	= $data['simpananpihakketiga']->total;
			$total	= $total + $input['jumlah'];
			$this->simpananpihakketigamodel->update_total($id_simpananpihakketiga, $total);
		} else if($input['jenis'] == 'Tarikan') {
			$total 	= $data['simpananpihakketiga']->total;
			$total	= $total - $input['jumlah'];
			$this->simpananpihakketigamodel->update_total($id_simpananpihakketiga, $total);
		}

		redirect('transaksianggotacon/view_simpananpihakketiga/'.$id_simpananpihakketiga);
	}

	function edit_detail_simpananpihakketiga($id_simpananpihakketiga, $id_detail_simpananpihakketiga) {
		$session_data = $this->session->userdata('logged_in');
		if($session_data == NULL) {
			redirect("usercon/login", "refresh");
		}

		// Get Simpanan Pihak Ketiga Sesuai dengan id_simpananpihakketiga
		$update = $this->simpananpihakketigamodel->get_simpananpihakketiga_by_id($id_simpananpihakketiga);
		// Get Detail Simpanan 3 Th Sesuai dengan id_detail_simpananpihakketiga
		$prev 	= $this->detailsimpananpihakketigamodel->get_detail_simpananpihakketiga_by_id($id_detail_simpananpihakketiga);

		if($prev->jenis == 'Setoran') {
			$total 	= $update->total - $prev->jumlah;
			$this->simpananpihakketigamodel->update_total($id_simpananpihakketiga, $total);
		} else if($prev->jenis == 'Tarikan') {
			$total 	= $update->total + $prev->jumlah;
			$this->simpananpihakketigamodel->update_total($id_simpananpihakketiga, $total);
		}

		$data['simpananpihakketiga'] 				= $this->simpananpihakketigamodel->get_simpananpihakketiga_by_id($id_simpananpihakketiga);
		$id_nasabah									= $data['simpananpihakketiga']->id_nasabah;
		$data['nasabah'] 							= $this->nasabahmodel->get_nasabah_by_id($id_nasabah);
		$data['detail_simpananpihakketiga'] 		= $this->detailsimpananpihakketigamodel->get_detail_simpananpihakketiga_by_id_simpananpihakketiga($id_simpananpihakketiga);
		$data['edit_detail_simpananpihakketiga']	= $this->detailsimpananpihakketigamodel->get_detail_simpananpihakketiga_by_id($id_detail_simpananpihakketiga);
		$data['simpananpokok'] 						= $this->simpananpokokmodel->get_simpananpokok_by_id_nasabah($id_nasabah);
		$data['pinjaman'] 							= $this->pinjamanmodel->get_pinjaman_by_id_nasabah($id_nasabah);
		$data['simpananwajib'] 						= $this->simpananwajibmodel->get_simpananwajib_by_id_nasabah($id_nasabah);
		$data['simpanandanasosial'] 				= $this->simpanandanasosialmodel->get_simpanandanasosial_by_id_nasabah($id_nasabah);
		$data['simpanankanzun'] 					= $this->simpanankanzunmodel->get_simpanankanzun_by_id_nasabah($id_nasabah);
		$data['simpanankhusus'] 					= $this->simpanankhususmodel->get_simpanankhusus_by_id_nasabah($id_nasabah);
		$data['simpanan3th'] 						= $this->simpanan3thmodel->get_simpanan3th_by_id_nasabah($id_nasabah);
		$data['username'] 							= $session_data['username'];
		$data['status'] 							= $session_data['status'];

		$this->load->view('/layouts/menu', $data);
		$this->load->view('/transaksianggota/view_simpananpihakketiga_edit_detail', $data);
		$this->load->view('/layouts/footer', $data);
	}

	function update_detail_simpananpihakketiga() {
		$session_data = $this->session->userdata('logged_in');
		if($session_data == NULL) {
			redirect("usercon/login", "refresh");
		}

		//Update Detail Simpanan Pihak Ketiga ke dalam table detail_simpananpihakketiga
		$id_detail_simpananpihakketiga		= $this->input->post('edit_id');
		$date1 								= $this->input->post('edit_waktu');
		$date 								= strtotime($date1);
		$update 							= array();
		$update['waktu'] 					= date("Y-m-d",$date);
		$update['id_simpananpihakketiga'] 	= $this->input->post('edit_id_simpananpihakketiga');
		$update['jenis'] 					= $this->input->post('edit_jenis');
		$update['bulan_tahun'] 				= $this->input->post('edit_bulan_tahun');
		$update['jumlah'] 					= $this->input->post('edit_jumlah');
		$this->detailsimpananpihakketigamodel->updateData($id_detail_simpananpihakketiga, $update);

		$id_simpananpihakketiga = $this->input->post('edit_id_simpananpihakketiga');
		$data['simpananpihakketiga'] = $this->simpananpihakketigamodel->get_simpananpihakketiga_by_id($id_simpananpihakketiga);

		if($update['jenis'] == 'Setoran') {
			$total = $data['simpananpihakketiga']->total + $update['jumlah'];
			$this->simpananpihakketigamodel->update_total($id_simpananpihakketiga, $total);
		} else if($update['jenis'] == 'Tarikan') {
			$total = $data['simpananpihakketiga']->total - $update['jumlah'];
			$this->simpananpihakketigamodel->update_total($id_simpananpihakketiga, $total);
		}

		redirect('transaksianggotacon/view_simpananpihakketiga/'.$id_simpananpihakketiga);
	}

	function delete_detail_simpananpihakketiga($id_simpananpihakketiga, $id_detail_simpananpihakketiga) {
		$session_data = $this->session->userdata('logged_in');
		if($session_data == NULL) {
			redirect("usercon/login", "refresh");
		}

		// Get Simpanan Pihak Ketiga Sesuai dengan id_simpananpihakketiga
		$update = $this->simpananpihakketigamodel->get_simpananpihakketiga_by_id($id_simpananpihakketiga);
		// Get Detail Simpanan Pihak Ketiga Sesuai dengan id_detail_simpananpihakketiga
		$prev 	= $this->detailsimpananpihakketigamodel->get_detail_simpananpihakketiga_by_id($id_detail_simpananpihakketiga);

		if($prev->jenis == 'Setoran') {
			$total 	= $update->total - $prev->jumlah;
			$this->simpananpihakketigamodel->update_total($id_simpananpihakketiga, $total);
		} else if($prev->jenis == 'Tarikan') {
			$total 	= $update->total + $prev->jumlah;
			$this->simpananpihakketigamodel->update_total($id_simpananpihakketiga, $total);
		}

		$this->detailsimpananpihakketigamodel->deleteData($id_detail_simpananpihakketiga);

		redirect('transaksianggotacon/view_simpananpihakketiga/'.$id_simpananpihakketiga);
	}
	/*** End of Transaksi Simpanan Pihak Ketiga ***/	
}