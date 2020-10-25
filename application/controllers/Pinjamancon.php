<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pinjamancon extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->model('usermodel');
		$this->load->model('nasabahmodel');
		$this->load->model('pinjamanmodel');
		$this->load->model('detailangsuranmodel');
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
		$data['nasabah'] 	= $this->nasabahmodel->showData();
		$data['pinjaman'] 	= $this->pinjamanmodel->showData();
		/*echo "<pre>";
		var_dump($data['pinjaman']);
		echo "</pre>";*/
		$this->load->view('/layouts/menu', $data);
		$this->load->view('/pinjaman/index', $data);
		$this->load->view('/layouts/footer', $data);
	}

	function create_pinjaman() {
		$session_data = $this->session->userdata('mubasyirin_logged_in');
		if($session_data == NULL) {
			redirect("usercon/login", "refresh");
		}
		$data['username'] 	= $session_data['username'];
		$data['status'] 	= $session_data['status'];
		$data['nasabah'] 	= $this->nasabahmodel->showData();
		$this->load->view('/layouts/menu', $data);
		$this->load->view('/pinjaman/create_pinjaman', $data);
		$this->load->view('/layouts/footer', $data);
	}

	function insert_pinjaman() {
		$session_data = $this->session->userdata('mubasyirin_logged_in');
		if($session_data == NULL) {
			redirect("usercon/login", "refresh");
		}

		$data = array();
		$data['id'] 						= $this->pinjamanmodel->getNewId();
		$data['id_nasabah'] 				= $this->input->post('id_nasabah');
		$data['nama_nasabah'] 				= $this->input->post('nama_nasabah');
		$data['nik_nasabah'] 				= $this->input->post('nik_nasabah');
		$data['jenis_pinjaman'] 			= $this->input->post('jenis_pinjaman');
		$data['nik_nasabah'] 				= $this->input->post('nik_nasabah');
		$data['jaminan'] 					= $this->input->post('jaminan');
		$date1 								= $this->input->post('waktu');
		$date 								= strtotime($date1);
		$data['waktu'] 						= date("Y-m-d",$date);
		$data['jatuh_tempo'] 				= $this->input->post('jatuh_tempo');
		$data['jumlah_pinjaman'] 			= $this->input->post('jumlah_pinjaman');
		$data['jumlah_angsuran'] 			= $this->input->post('jumlah_angsuran');
		$data['angsuran_perbulan'] 			= $this->input->post('angsuran_perbulan');
		$data['jasa_perbulan'] 				= $this->input->post('jasa_perbulan');
		$data['total_angsuran_perbulan'] 	= $this->input->post('total_angsuran_perbulan');
		$data['sisa_angsuran'] 				= $this->input->post('jumlah_pinjaman');
		
		$this->pinjamanmodel->inputData($data);
		redirect('pinjamancon');
	}

	function edit_pinjaman($id) {
		$session_data = $this->session->userdata('mubasyirin_logged_in');
		if($session_data == NULL) {
			redirect("usercon/login", "refresh");
		}
		$data['pinjaman'] = $this->pinjamanmodel->get_pinjaman_by_id($id);
		$data['username'] = $session_data['username'];
		$data['status'] = $session_data['status'];
		$data['nasabah'] = $this->nasabahmodel->showData();
		
		$this->load->view('/layouts/menu', $data);
		$this->load->view('/pinjaman/edit_pinjaman', $data);
		$this->load->view('/layouts/footer', $data);
	}

	function update_pinjaman() {
		$session_data = $this->session->userdata('mubasyirin_logged_in');
		if($session_data == NULL) {
			redirect("usercon/login", "refresh");
		}

		$id = $this->input->post('id');
		$data = array();
		$data['id_nasabah'] = $this->input->post('id_nasabah');
		$data['nama_nasabah'] = $this->input->post('nama_nasabah');
		$data['nik_nasabah'] = $this->input->post('nik_nasabah');
		$data['jenis_pinjaman'] = $this->input->post('jenis_pinjaman');
		$data['nik_nasabah'] = $this->input->post('nik_nasabah');
		$data['jaminan'] = $this->input->post('jaminan');
		$date1 = $this->input->post('waktu');
		$date = strtotime($date1);
		$data['waktu'] = date("Y-m-d",$date);
		$data['jatuh_tempo'] = $this->input->post('jatuh_tempo');
		$data['jumlah_pinjaman'] = $this->input->post('jumlah_pinjaman');
		$data['jumlah_angsuran'] = $this->input->post('jumlah_angsuran');
		$data['angsuran_perbulan'] = $this->input->post('angsuran_perbulan');
		$data['jasa_perbulan'] = $this->input->post('jasa_perbulan');
		$data['total_angsuran_perbulan'] = $this->input->post('total_angsuran_perbulan');
		$this->pinjamanmodel->updateData($id, $data);
		redirect('pinjamancon');
	}

	function view_pinjaman($id) {
		$session_data = $this->session->userdata('mubasyirin_logged_in');
		if($session_data == NULL) {
			redirect("usercon/login", "refresh");
		}
		$data['pinjaman'] = $this->pinjamanmodel->get_pinjaman_by_id($id);
		$data['username'] = $session_data['username'];
		$data['status'] = $session_data['status'];
		$data['nasabah'] = $this->nasabahmodel->showData();
		$data['nasabah_pinjaman'] = $this->nasabahmodel->get_nasabah_by_id($data['pinjaman']->id_nasabah);
		$data['detail_angsuran'] = $this->detailangsuranmodel->get_detail_angsuran_by_id_pinjaman($id);

		$this->load->view('/layouts/menu', $data);
		$this->load->view('/pinjaman/view_pinjaman', $data);
		$this->load->view('/layouts/footer', $data);
	}

	function delete_pinjaman($id) {
		$session_data = $this->session->userdata('mubasyirin_logged_in');
		if($session_data == NULL) {
			redirect("usercon/login", "refresh");
		}
		$this->pinjamanmodel->deleteData($id);
		$this->detailangsuranmodel->delete_by_id_pinjaman($id);

		redirect('pinjamancon');
	}

	function pickNasabah() {
		$nasabah = $this->nasabahmodel->get_nasabah_by_id($this->input->post('id_nasabah'));

		echo $nasabah->nama. '||'.$nasabah->nik;
	}

	function insert_detail_angsuran() {
		$session_data = $this->session->userdata('mubasyirin_logged_in');
		if($session_data == NULL) {
			redirect("usercon/login", "refresh");
		}
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

		redirect("pinjamancon/view_pinjaman/".$id_pinjaman);
	}

	function edit_detail_angsuran($id_pinjaman, $id_detail_angsuran) {
		$session_data = $this->session->userdata('mubasyirin_logged_in');
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
		$data['username'] 				= $session_data['username'];
		$data['status'] 				= $session_data['status'];
		$data['nasabah'] 				= $this->nasabahmodel->showData();
		$data['detail_angsuran'] 		= $this->detailangsuranmodel->get_detail_angsuran_by_id_pinjaman($id_pinjaman);
		$data['edit_detail_angsuran'] 	= $this->detailangsuranmodel->get_detail_angsuran_by_id($id_detail_angsuran);
		$data['nasabah_pinjaman'] 		= $this->nasabahmodel->get_nasabah_by_id($data['pinjaman']->id_nasabah);

		$this->load->view('/layouts/menu', $data);
		$this->load->view('/pinjaman/view_pinjaman_edit_angsuran', $data);
		$this->load->view('/layouts/footer', $data);
	}

	function update_detail_angsuran() {
		$session_data = $this->session->userdata('mubasyirin_logged_in');
		if($session_data == NULL) {
			redirect("usercon/login", "refresh");
		}
		$id = $this->input->post('edit_id');
		$date1 = $this->input->post('edit_waktu');
		$date = strtotime($date1);
		$input['waktu'] = date("Y-m-d",$date);
		$input['bulan_ke'] = $this->input->post('edit_bulan_ke');
		$input['jenis'] = $this->input->post('edit_jenis');
		$input['id_pinjaman'] = $this->input->post('edit_id_pinjaman');
		$input['angsuran'] = $this->input->post('edit_angsuran');
		$input['jasa'] = $this->input->post('edit_jasa');
		$input['denda'] = $this->input->post('edit_denda');
		$input['total'] = $this->input->post('edit_total');
		$this->detailangsuranmodel->updateData($id, $input);

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

		redirect("pinjamancon/view_pinjaman/".$id_pinjaman);
	}

	function delete_detail_angsuran($id_pinjaman, $id_detail_angsuran) {
		$session_data = $this->session->userdata('mubasyirin_logged_in');
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
		
		redirect("pinjamancon/view_pinjaman/".$id_pinjaman);
	}
}

?>