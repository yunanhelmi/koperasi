<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class TransaksianggotaCon extends CI_Controller {
	function __construct() {
		parent::__construct();

		$this->load->model('usermodel');
		$this->load->model('nasabahmodel');
		$this->load->model('pinjamanmodel');
		$this->load->model('detailangsuranmodel');
		$this->load->model('detailjaminanmodel');
		$this->load->model('asetkekayaanmodel');
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
		$this->load->model('detailjasasimpananpihakketigamodel');
		$this->load->model('mappingkodeakunmodel');
		$this->load->model('kodeakunmodel');
		$this->load->model('transaksiakuntansimodel');

		$this->load->library('session');
		$this->load->library('form_validation');
		$this->load->library('upload');
		$this->load->library('image_lib');
		$this->load->library(array('PHPExcel','PHPExcel/IOFactory'));
	}

	function isLeapYear($year) {
	    return ((($year % 4 === 0) && ($year % 100 !== 0)) || ($year % 400 === 0));
	}

	function getDaysInMonth($year, $month) {
	    return [31, ($this->isLeapYear($year) ? 29 : 28), 31, 30, 31, 30, 31, 31, 30, 31, 30, 31][$month - 1];
	}

	function addMonths($d, $value) {
		$date = new DateTime($d);
		$tanggal1 = $date->format('d');

		$date->setDate($date->format('Y'), $date->format('m'), 1);
		$date->setDate($date->format('Y'), $date->format('m') + $value, $date->format('d'));
		
		$tahun = $date->format('Y');
		$bulan = (int)$date->format('m');

		$tanggal2 = $this->getDaysInMonth($tahun, $bulan);

		if($tanggal1 <= $tanggal2) {
			$date->setDate($date->format('Y'), $date->format('m'), $tanggal1);
		} else {
			$date->setDate($date->format('Y'), $date->format('m'), $tanggal2);
		}

		return $date->format('Y-m-d');
	}

	function diffMonths($d, $value) {
		$date = new DateTime($d);
		$tanggal1 = $date->format('d');

		$date->setDate($date->format('Y'), $date->format('m'), 1);
		$date->setDate($date->format('Y'), $date->format('m') - $value, $date->format('d'));
		
		$tahun = $date->format('Y');
		$bulan = (int)$date->format('m');

		$tanggal2 = $this->getDaysInMonth($tahun, $bulan);

		if($tanggal1 <= $tanggal2) {
			$date->setDate($date->format('Y'), $date->format('m'), $tanggal1);
		} else {
			$date->setDate($date->format('Y'), $date->format('m'), $tanggal2);
		}

		return $date->format('Y-m-d');
	}

	function index() {
		$session_data = $this->session->userdata('mubasyirin_logged_in');
		if($session_data == NULL) {
			redirect("usercon/login", "refresh");
		}
		
		$data['username'] 						= $session_data['username'];
		$data['status'] 						= $session_data['status'];
		$data['nasabah'] 						= $this->nasabahmodel->getDataPostUnpostPinjaman();
		$data['nasabah_simpananpokok'] 			= $this->nasabahmodel->getDataPostUnpostSimpananPokok();
		$data['nasabah_simpananwajib'] 			= $this->nasabahmodel->getDataPostUnpostSimpananWajib();
		$data['nasabah_simpanankhusus'] 		= $this->nasabahmodel->getDataPostUnpostSimpananKhusus();
		$data['nasabah_simpanandanasosial']		= $this->nasabahmodel->getDataPostUnpostSimpananDanaSosial();
		$data['nasabah_simpanankanzun'] 		= $this->nasabahmodel->getDataPostUnpostSimpananKanzun();
		$data['nasabah_simpananpihakketiga'] 	= $this->nasabahmodel->getDataPostUnpostSimpananPihakKetiga();

		$this->load->view('/layouts/menu', $data);
		$this->load->view('/transaksianggota/index', $data);
		$this->load->view('/layouts/footer', $data);
	}

	/*** Transaksi Pinjaman ***/
	function pinjaman($id_nasabah) {
		$session_data = $this->session->userdata('mubasyirin_logged_in');
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
		$data['aset_kekayaan']		= $this->asetkekayaanmodel->get_asetkekayaan_by_id_nasabah($id_nasabah);
		$data['username'] 			= $session_data['username'];
		$data['status'] 			= $session_data['status'];

		$this->load->view('/layouts/menu', $data);
		$this->load->view('/transaksianggota/index_pinjaman', $data);
		$this->load->view('/layouts/footer', $data);
	}

	function create_pinjaman($id_nasabah) {
		$session_data = $this->session->userdata('mubasyirin_logged_in');
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
		$data['aset_kekayaan']		= $this->asetkekayaanmodel->get_asetkekayaan_by_id_nasabah($id_nasabah);
		$data['username'] 			= $session_data['username'];
		$data['status'] 			= $session_data['status'];

		$this->load->view('/layouts/menu', $data);
		$this->load->view('/transaksianggota/create_pinjaman', $data);
		$this->load->view('/layouts/footer', $data);
	}

	function insert_pinjaman($id_nasabah) {
		$session_data = $this->session->userdata('mubasyirin_logged_in');
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

		// set jaminan
		$input_jaminan = $this->input->post('jaminan');
		for($i = 0; $i < sizeof($input_jaminan); $i++) {
			$jaminan = $this->asetkekayaanmodel->get_asetkekayaan_by_id($input_jaminan[$i]);
			$jaminan_arr[$i]['id'] = $jaminan->id;
			if($jaminan->jenis_aset == 'sertifikat') {
				$jaminan_arr[$i]['keterangan'] = strtoupper($jaminan->jenis_aset)." ".$jaminan->nama_pemilik." ".$jaminan->no_sertifikat." ".$jaminan->jenis_tanah." ".$jaminan->luas." ".$jaminan->lokasi_tanah;
			} else if($jaminan->jenis_aset == 'bpkb') {
				$jaminan_arr[$i]['keterangan'] = strtoupper($jaminan->jenis_aset)." ".$jaminan->merek." ".$jaminan->jenis_motor." ".$jaminan->tahun." ".$jaminan->atas_nama." ".$jaminan->no_pol;
			}
			
		}
		$insert['jaminan'] 					= json_encode($jaminan_arr);
		//End of Set Jaminan

		$date1 								= $this->input->post('waktu');
		$date 								= strtotime($date1);
		$insert['waktu'] 					= date("Y-m-d",$date);
		$jatuh_tempo1 						= $this->input->post('jatuh_tempo');
		$jatuh_tempo 						= strtotime($jatuh_tempo1);
		$insert['jatuh_tempo'] 				= date("Y-m-d",$jatuh_tempo);
		$insert['jumlah_pinjaman'] 			= $this->input->post('jumlah_pinjaman');
		$insert['jumlah_angsuran'] 			= $this->input->post('jumlah_angsuran');
		$insert['angsuran_perbulan'] 		= $this->input->post('angsuran_perbulan');
		$insert['jasa_perbulan'] 			= $this->input->post('jasa_perbulan');
		$insert['total_angsuran_perbulan'] 	= $this->input->post('total_angsuran_perbulan');
		$insert['sisa_angsuran'] 			= $this->input->post('jumlah_pinjaman');
		$insert['keterangan'] 				= $this->input->post('keterangan');

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
		$session_data = $this->session->userdata('mubasyirin_logged_in');
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
		$data['aset_kekayaan']		= $this->asetkekayaanmodel->get_asetkekayaan_by_id_nasabah($id_nasabah);
		$data['username'] 			= $session_data['username'];
		$data['status'] 			= $session_data['status'];

		$jaminan = json_decode($data['pinjaman']->jaminan);
		$test = @json_decode($data['pinjaman']->jaminan);
		for($i = 0; $i < sizeof($data['aset_kekayaan']); $i++) {
			$data['aset_kekayaan'][$i]['selected'] = 0;
			if($test) {
				for($j = 0; $j < sizeof($jaminan); $j++) {
					if($data['aset_kekayaan'][$i]['id'] == $jaminan[$j]->id) {
						$data['aset_kekayaan'][$i]['selected'] = 1;
					}
				}	
			}
		}
		
		$this->load->view('/layouts/menu', $data);
		$this->load->view('/transaksianggota/edit_pinjaman', $data);
		$this->load->view('/layouts/footer', $data);
	}

	function update_pinjaman() {
		$session_data = $this->session->userdata('mubasyirin_logged_in');
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
		
		// set jaminan
		$input_jaminan = $this->input->post('jaminan');
		for($i = 0; $i < sizeof($input_jaminan); $i++) {
			$jaminan = $this->asetkekayaanmodel->get_asetkekayaan_by_id($input_jaminan[$i]);
			$jaminan_arr[$i]['id'] = $jaminan->id;
			if($jaminan->jenis_aset == 'sertifikat') {
				$jaminan_arr[$i]['keterangan'] = strtoupper($jaminan->jenis_aset)." ".$jaminan->nama_pemilik." ".$jaminan->no_sertifikat." ".$jaminan->jenis_tanah." ".$jaminan->luas." ".$jaminan->lokasi_tanah;
			} else if($jaminan->jenis_aset == 'bpkb') {
				$jaminan_arr[$i]['keterangan'] = strtoupper($jaminan->jenis_aset)." ".$jaminan->merek." ".$jaminan->jenis_motor." ".$jaminan->tahun." ".$jaminan->atas_nama." ".$jaminan->no_pol;
			}
		}
		$update['jaminan'] 					= json_encode($jaminan_arr);
		//End of Set Jaminan

		$date1 								= $this->input->post('waktu');
		$date 								= strtotime($date1);
		$update['waktu'] 					= date("Y-m-d",$date);
		$jatuh_tempo1 						= $this->input->post('jatuh_tempo');
		$jatuh_tempo 						= strtotime($jatuh_tempo1);
		$update['jatuh_tempo'] 				= date("Y-m-d",$jatuh_tempo);
		$update['jumlah_pinjaman'] 			= $this->input->post('jumlah_pinjaman');
		$update['jumlah_angsuran'] 			= $this->input->post('jumlah_angsuran');
		$update['angsuran_perbulan'] 		= $this->input->post('angsuran_perbulan');
		$update['jasa_perbulan'] 			= $this->input->post('jasa_perbulan');
		$update['total_angsuran_perbulan'] 	= $this->input->post('total_angsuran_perbulan');
		$update['keterangan'] 				= $this->input->post('keterangan');
		$update['uang_kurang'] 				= $this->input->post('uang_kurang');
		$update['janji'] 					= $this->input->post('janji');
		$this->pinjamanmodel->updateData($id_pinjaman, $update);

		$id_nasabah = $update['id_nasabah'];

		redirect('transaksianggotacon/pinjaman/'.$id_nasabah);
	}

	function delete_pinjaman($id_pinjaman) {
		$session_data = $this->session->userdata('mubasyirin_logged_in');
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
		$session_data = $this->session->userdata('mubasyirin_logged_in');
		if($session_data == NULL) {
			redirect("usercon/login", "refresh");
		}

		$data['pinjaman'] 			= $this->pinjamanmodel->get_pinjaman_by_id($id_pinjaman);
		$data['detail_angsuran'] 	= $this->detailangsuranmodel->get_detail_angsuran_by_id_pinjaman($id_pinjaman);
		$data['detail_jaminan'] 	= $this->detailjaminanmodel->get_detail_jaminan_by_id_pinjaman($id_pinjaman);
		$data['max_bulanke_angsuran'] = $this->detailangsuranmodel->get_max_bulanke($id_pinjaman);
		$id_nasabah					= $data['pinjaman']->id_nasabah;
		$data['nasabah'] 			= $this->nasabahmodel->get_nasabah_by_id($id_nasabah);
		$data['simpananpokok'] 		= $this->simpananpokokmodel->get_simpananpokok_by_id_nasabah($id_nasabah);
		$data['simpananwajib'] 		= $this->simpananwajibmodel->get_simpananwajib_by_id_nasabah($id_nasabah);
		$data['simpanankhusus'] 	= $this->simpanankhususmodel->get_simpanankhusus_by_id_nasabah($id_nasabah);
		$data['simpanandanasosial'] = $this->simpanandanasosialmodel->get_simpanandanasosial_by_id_nasabah($id_nasabah);
		$data['simpanankanzun'] 	= $this->simpanankanzunmodel->get_simpanankanzun_by_id_nasabah($id_nasabah);
		$data['simpanan3th'] 		= $this->simpanan3thmodel->get_simpanan3th_by_id_nasabah($id_nasabah);
		$data['simpananpihakketiga']= $this->simpananpihakketigamodel->get_simpananpihakketiga_by_id_nasabah($id_nasabah);
		$data['aset_kekayaan']		= $this->asetkekayaanmodel->get_asetkekayaan_by_id_nasabah($id_nasabah);
		$data['username'] 			= $session_data['username'];
		$data['status'] 			= $session_data['status'];
		
		/*echo "<pre>";
		var_dump($data['detail_jaminan']);
		echo "</pre>";*/

		if($data['pinjaman']->sisa_angsuran > 0) {
			$tgl_pinjam = new DateTime($data['pinjaman']->waktu);
			$today = new DateTime(date("Y-m-d"));
			$lama_hari = $today->diff($tgl_pinjam)->format("%a")." hari";
			$lama_hari_long = $tgl_pinjam->diff($today);
		} else {
			$lama_hari = "LUNAS";
			$lama_hari_long = "LUNAS";
		}
		$data['lama_hari'] 			= $lama_hari;
		$data['lama_hari_long']		= $lama_hari_long;

		$this->load->view('/layouts/menu', $data);
		$this->load->view('/transaksianggota/view_pinjaman', $data);
		$this->load->view('/layouts/footer', $data);
	}

	function insert_detail_jaminan($id_nasabah){
		$session_data = $this->session->userdata('mubasyirin_logged_in');
		if($session_data == NULL) {
			redirect("usercon/login", "refresh");
		}

		// Insert Detail Jaminan ke dalam table detail_jaminan
		$input['id'] 			= $this->detailjaminanmodel->getNewId();
		$input['waktu'] 		= date("Y-m-d");
		$input['id_pinjaman'] 	= $this->input->post('id_pinjaman');
		$input['jenis_jaminan'] = $this->input->post('jenis_jaminan');
		$input['nama_pemilik'] 	= $this->input->post('nama_pemilik');
		$input['no_sertifikat'] = $this->input->post('no_sertifikat');
		$input['luas'] 			= $this->input->post('luas');
		$input['jenis_tanah'] 	= $this->input->post('jenis_tanah');
		$input['lokasi_tanah'] 	= $this->input->post('lokasi_tanah');
		$input['merek'] 		= $this->input->post('merek');
		$input['jenis'] 		= $this->input->post('jenis_motor');
		$input['tahun']			= $this->input->post('tahun');
		$input['atas_nama']		= $this->input->post('atas_nama');
		$input['no_pol']		= $this->input->post('no_pol');
		$this->detailjaminanmodel->inputData($input);

		$id_pinjaman = $this->input->post('id_pinjaman');
		redirect('transaksianggotacon/view_pinjaman/'.$id_pinjaman);
	}

	function edit_detail_jaminan($id_pinjaman, $id_detail_jaminan) {
		$session_data = $this->session->userdata('mubasyirin_logged_in');
		if($session_data == NULL) {
			redirect("usercon/login", "refresh");
		}

		$data['pinjaman'] 				= $this->pinjamanmodel->get_pinjaman_by_id($id_pinjaman);
		$data['max_bulanke_angsuran'] = $this->detailangsuranmodel->get_max_bulanke($id_pinjaman);
		$id_nasabah						= $data['pinjaman']->id_nasabah;
		$data['detail_angsuran'] 		= $this->detailangsuranmodel->get_detail_angsuran_by_id_pinjaman($id_pinjaman);
		$data['detail_jaminan'] 		= $this->detailjaminanmodel->get_detail_jaminan_by_id_pinjaman($id_pinjaman);
		$data['edit_detail_jaminan'] 	= $this->detailjaminanmodel->get_detail_jaminan_by_id($id_detail_jaminan);
		$data['nasabah'] 				= $this->nasabahmodel->get_nasabah_by_id($id_nasabah);
		$data['simpananpokok'] 			= $this->simpananpokokmodel->get_simpananpokok_by_id_nasabah($id_nasabah);
		$data['simpananwajib'] 			= $this->simpananwajibmodel->get_simpananwajib_by_id_nasabah($id_nasabah);
		$data['simpanankhusus'] 		= $this->simpanankhususmodel->get_simpanankhusus_by_id_nasabah($id_nasabah);
		$data['simpanandanasosial'] 	= $this->simpanandanasosialmodel->get_simpanandanasosial_by_id_nasabah($id_nasabah);
		$data['simpanankanzun'] 		= $this->simpanankanzunmodel->get_simpanankanzun_by_id_nasabah($id_nasabah);
		$data['simpanan3th'] 			= $this->simpanan3thmodel->get_simpanan3th_by_id_nasabah($id_nasabah);
		$data['simpananpihakketiga']	= $this->simpananpihakketigamodel->get_simpananpihakketiga_by_id_nasabah($id_nasabah);
		$data['aset_kekayaan']			= $this->asetkekayaanmodel->get_asetkekayaan_by_id_nasabah($id_nasabah);
		$data['username'] 				= $session_data['username'];
		$data['status'] 				= $session_data['status'];

		if($data['pinjaman']->sisa_angsuran > 0) {
			$tgl_pinjam = new DateTime($data['pinjaman']->waktu);
			$today = new DateTime(date("Y-m-d"));
			$lama_hari = $today->diff($tgl_pinjam)->format("%a")." hari";
			$lama_hari_long = $tgl_pinjam->diff($today);
		} else {
			$lama_hari = "LUNAS";
			$lama_hari_long = "LUNAS";
		}
		$data['lama_hari'] 			= $lama_hari;
		$data['lama_hari_long']		= $lama_hari_long;
		
		$this->load->view('/layouts/menu', $data);
		$this->load->view('/transaksianggota/view_pinjaman_edit_jaminan', $data);
		$this->load->view('/layouts/footer', $data);
	}

	function update_detail_jaminan() {
		$session_data = $this->session->userdata('mubasyirin_logged_in');
		if($session_data == NULL) {
			redirect("usercon/login", "refresh");
		}

		//Update Detail Jaminan ke dalam table detail_jaminan
		$id_detail_jaminan 		= $this->input->post('edit_id');
		$input['waktu'] 		= date("Y-m-d");
		$input['id_pinjaman'] 	= $this->input->post('edit_id_pinjaman');
		$input['jenis_jaminan'] = $this->input->post('edit_jenis_jaminan');
		$input['nama_pemilik'] 	= $this->input->post('edit_nama_pemilik');
		$input['no_sertifikat'] = $this->input->post('edit_no_sertifikat');
		$input['luas'] 			= $this->input->post('edit_luas');
		$input['jenis_tanah'] 	= $this->input->post('edit_jenis_tanah');
		$input['lokasi_tanah'] 	= $this->input->post('edit_lokasi_tanah');
		$input['merek'] 		= $this->input->post('edit_merek');
		$input['jenis'] 		= $this->input->post('edit_jenis_motor');
		$input['tahun']			= $this->input->post('edit_tahun');
		$input['atas_nama']		= $this->input->post('edit_atas_nama');
		$input['no_pol']		= $this->input->post('edit_no_pol');

		$this->detailjaminanmodel->updateData($id_detail_jaminan, $input);

		$id_pinjaman = $this->input->post('edit_id_pinjaman');

		redirect('transaksianggotacon/view_pinjaman/'.$id_pinjaman);
	}

	function delete_detail_jaminan($id_pinjaman, $id_detail_jaminan) {
		$session_data = $this->session->userdata('mubasyirin_logged_in');
		if($session_data == NULL) {
			redirect("usercon/login", "refresh");
		}
		$this->detailjaminanmodel->deleteData($id_detail_jaminan);
		redirect('transaksianggotacon/view_pinjaman/'.$id_pinjaman);
	}

	function insert_detail_angsuran($id_nasabah) {
		$session_data = $this->session->userdata('mubasyirin_logged_in');
		if($session_data == NULL) {
			redirect("usercon/login", "refresh");
		}

		// Insert Detail Angsuran ke dalam table detail_angsuran
		$date1 					= $this->input->post('waktu');
		$date 					= strtotime($date1);
		$input['waktu'] 		= date("Y-m-d",$date);
		$input['bulan_ke'] 		= $this->input->post('bulan_ke');
		$input['bulan_tahun'] 	= $this->input->post('bulan_tahun');
		$input['jenis'] 		= $this->input->post('jenis');
		$input['id_pinjaman'] 	= $this->input->post('id_pinjaman');
		$input['angsuran'] 		= $this->input->post('angsuran');
		$input['jasa'] 			= $this->input->post('jasa');
		$input['denda'] 		= $this->input->post('denda');
		$input['total'] 		= $this->input->post('total');
		$input['keterangan']	= $this->input->post('keterangan');
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

		//Updte Jasa Perbulan, Total Angsuran Per Bulan ketika Jenis Pinjaman = 'Musiman'
		$data['pinjaman'] = $this->pinjamanmodel->get_pinjaman_by_id($id_pinjaman);
		$sisa_angsuran = $data['pinjaman']->sisa_angsuran;
		if($data['pinjaman']->jenis_pinjaman == "Musiman") {
			$jasa_perbulan = ($sisa_angsuran * 3) / 100;
			$total_angsuran_perbulan = $data['pinjaman']->angsuran_perbulan + $jasa_perbulan;
			$this->pinjamanmodel->update_jasa_total_angsuran_perbulan($id_pinjaman, $jasa_perbulan, $total_angsuran_perbulan);
		}

		//Update Jaminan ketika Sisa Pinjaman = 0
		if($data['pinjaman']->sisa_angsuran == 0) {
			$this->pinjamanmodel->update_jaminan($id_pinjaman, "");
		}

		/* UPDATE Jatuh Tempo */
		$tgl_jatuh_tempo = date_create($this->input->post('jatuh_tempo'));
		$this->pinjamanmodel->update_jatuh_tempo($data['pinjaman']->id, date_format($tgl_jatuh_tempo, "Y-m-d"));
		/*if($data['pinjaman']->jenis_pinjaman == 'Angsuran') {
			if($input['jenis'] == 'Angsuran') {
				$wkt_pinjam			= $data['pinjaman']->waktu;
				$wkt_pinjam			= new DateTime($wkt_pinjam);
				$tgl_pinjam			= $wkt_pinjam->format('d');

				if($data['pinjaman']->jatuh_tempo == "0000-00-00" || $data['pinjaman']->jatuh_tempo == NULL) {
					$detail = $this->detailangsuranmodel->get_total_kali_angsuran($data['pinjaman']->id);
					$total_kali_angsuran = $detail;

					$jatuh_tempo_new 	= $this->addMonths($wkt_pinjam->format('Y-m-d'), $total_kali_angsuran + 1);
					$jatuh_tempo_new 	= new DateTime($jatuh_tempo_new);

				} else {
					$jatuh_tempo_old 	= $data['pinjaman']->jatuh_tempo;
					$jatuh_tempo_old 	= new DateTime($jatuh_tempo_old);	

					$jatuh_tempo_new 	= $this->addMonths($jatuh_tempo_old->format('Y-m-d'), 1);
					$jatuh_tempo_new 	= new DateTime($jatuh_tempo_new);
				}

				$bulan_jatuh_tempo_new = (int)$jatuh_tempo_new->format('m');
				$tahun_jatuh_tempo_new = $jatuh_tempo_new->format('Y');

				$max_tgl_bulan_jatuh_tempo_new = $this->getDaysInMonth($tahun_jatuh_tempo_new, $bulan_jatuh_tempo_new);

				if($tgl_pinjam <= $max_tgl_bulan_jatuh_tempo_new) {
					$tanggal = $tgl_pinjam;
				} else {
					$tanggal = $max_tgl_bulan_jatuh_tempo_new;
				}
				
				$jatuh_tempo 		= $jatuh_tempo_new->setDate($jatuh_tempo_new->format('Y'), $jatuh_tempo_new->format('m'), $tanggal);
				
				$this->pinjamanmodel->update_jatuh_tempo($data['pinjaman']->id, $jatuh_tempo->format('Y-m-d'));
			}

		} else if ($data['pinjaman']->jenis_pinjaman == 'Musiman') {
			if($input['jenis'] == 'Pinjaman') {
				$wkt_pinjam			= $data['pinjaman']->waktu;
				$wkt_pinjam			= new DateTime($wkt_pinjam);
				$tgl_pinjam			= $wkt_pinjam->format('d');

				if($data['pinjaman']->jatuh_tempo == "0000-00-00" || $data['pinjaman']->jatuh_tempo == NULL) {
					$detail = $this->detailangsuranmodel->get_total_kali_pinjaman($data['pinjaman']->id);
					$total_kali_pinjaman = $detail;

					$jatuh_tempo_new 	= $this->addMonths($wkt_pinjam->format('Y-m-d'), $total_kali_pinjaman * 4);
					$jatuh_tempo_new 	= new DateTime($jatuh_tempo_new);
				} else {
					$jatuh_tempo_old 	= $data['pinjaman']->jatuh_tempo;
					$jatuh_tempo_old 	= new DateTime($jatuh_tempo_old);

					$jatuh_tempo_new 	= $this->addMonths($jatuh_tempo_old->format('Y-m-d'), 4);
					$jatuh_tempo_new 	= new DateTime($jatuh_tempo_new);
				}

				$bulan_jatuh_tempo_new = (int)$jatuh_tempo_new->format('m');
				$tahun_jatuh_tempo_new = $jatuh_tempo_new->format('Y');

				$max_tgl_bulan_jatuh_tempo_new = $this->getDaysInMonth($tahun_jatuh_tempo_new, $bulan_jatuh_tempo_new);

				if($tgl_pinjam <= $max_tgl_bulan_jatuh_tempo_new) {
					$tanggal = $tgl_pinjam;
				} else {
					$tanggal = $max_tgl_bulan_jatuh_tempo_new;
				}
				
				$jatuh_tempo 		= $jatuh_tempo_new->setDate($jatuh_tempo_new->format('Y'), $jatuh_tempo_new->format('m'), $tanggal);
				
				$this->pinjamanmodel->update_jatuh_tempo($data['pinjaman']->id, $jatuh_tempo->format('Y-m-d'));
			}
		}*/
		/*END OF UPDATE Jatuh Tempo */
		
		redirect('transaksianggotacon/view_pinjaman/'.$id_pinjaman);
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

		//Update Jasa Perbulan, Total Angsuran Per Bulan ketik Jenis Pinjaman = 'Musiman'
		$update = $this->pinjamanmodel->get_pinjaman_by_id($id_pinjaman);
		$sisa_angsuran = $update->sisa_angsuran;
		if($update->jenis_pinjaman == "Musiman") {
			$jasa_perbulan = ($sisa_angsuran * 3) / 100;
			$total_angsuran_perbulan = $update->angsuran_perbulan + $jasa_perbulan;
			$this->pinjamanmodel->update_jasa_total_angsuran_perbulan($id_pinjaman, $jasa_perbulan, $total_angsuran_perbulan);
		}
		
		$data['pinjaman'] 				= $this->pinjamanmodel->get_pinjaman_by_id($id_pinjaman);
		$data['max_bulanke_angsuran'] = $this->detailangsuranmodel->get_max_bulanke($id_pinjaman);
		$id_nasabah						= $data['pinjaman']->id_nasabah;
		$data['detail_angsuran'] 		= $this->detailangsuranmodel->get_detail_angsuran_by_id_pinjaman($id_pinjaman);
		$data['detail_jaminan'] 		= $this->detailjaminanmodel->get_detail_jaminan_by_id_pinjaman($id_pinjaman);
		$data['edit_detail_angsuran'] 	= $this->detailangsuranmodel->get_detail_angsuran_by_id($id_detail_angsuran);
		$data['nasabah'] 				= $this->nasabahmodel->get_nasabah_by_id($id_nasabah);
		$data['simpananpokok'] 			= $this->simpananpokokmodel->get_simpananpokok_by_id_nasabah($id_nasabah);
		$data['simpananwajib'] 			= $this->simpananwajibmodel->get_simpananwajib_by_id_nasabah($id_nasabah);
		$data['simpanankhusus'] 		= $this->simpanankhususmodel->get_simpanankhusus_by_id_nasabah($id_nasabah);
		$data['simpanandanasosial'] 	= $this->simpanandanasosialmodel->get_simpanandanasosial_by_id_nasabah($id_nasabah);
		$data['simpanankanzun'] 		= $this->simpanankanzunmodel->get_simpanankanzun_by_id_nasabah($id_nasabah);
		$data['simpanan3th'] 			= $this->simpanan3thmodel->get_simpanan3th_by_id_nasabah($id_nasabah);
		$data['simpananpihakketiga']	= $this->simpananpihakketigamodel->get_simpananpihakketiga_by_id_nasabah($id_nasabah);
		$data['aset_kekayaan']			= $this->asetkekayaanmodel->get_asetkekayaan_by_id_nasabah($id_nasabah);
		$data['username'] 				= $session_data['username'];
		$data['status'] 				= $session_data['status'];

		if($data['pinjaman']->sisa_angsuran > 0) {
			$tgl_pinjam = new DateTime($data['pinjaman']->waktu);
			$today = new DateTime(date("Y-m-d"));
			$lama_hari = $today->diff($tgl_pinjam)->format("%a")." hari";
			$lama_hari_long = $tgl_pinjam->diff($today);
		} else {
			$lama_hari = "LUNAS";
			$lama_hari_long = "LUNAS";
		}
		$data['lama_hari'] 			= $lama_hari;
		$data['lama_hari_long']		= $lama_hari_long;
		
		$this->load->view('/layouts/menu', $data);
		$this->load->view('/transaksianggota/view_pinjaman_edit_angsuran', $data);
		$this->load->view('/layouts/footer', $data);
	}

	function update_detail_angsuran() {
		$session_data = $this->session->userdata('mubasyirin_logged_in');
		if($session_data == NULL) {
			redirect("usercon/login", "refresh");
		}

		//Update Detail Angsuran ke dalam table detail_angsuran
		$id_detail_angsuran 	= $this->input->post('edit_id');
		$date1 					= $this->input->post('edit_waktu');
		$date 					= strtotime($date1);
		$input['waktu'] 		= date("Y-m-d",$date);
		$input['bulan_ke'] 		= $this->input->post('edit_bulan_ke');
		$input['bulan_tahun'] 		= $this->input->post('edit_bulan_tahun');
		$input['jenis'] 		= $this->input->post('edit_jenis');
		$input['id_pinjaman'] 	= $this->input->post('edit_id_pinjaman');
		$input['angsuran'] 		= $this->input->post('edit_angsuran');
		$input['jasa'] 			= $this->input->post('edit_jasa');
		$input['denda'] 		= $this->input->post('edit_denda');
		$input['total'] 		= $this->input->post('edit_total');
		$input['keterangan']	= $this->input->post('edit_keterangan');

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

		//Update Jaminan ketika Sisa Pinjaman = 0
		if($data['pinjaman']->sisa_angsuran == 0) {
			$this->pinjamanmodel->update_jaminan($id_pinjaman, "");
		}

		/* UPDATE Jatuh Tempo */
		$tgl_jatuh_tempo = date_create($this->input->post('edit_jatuh_tempo'));
		$this->pinjamanmodel->update_jatuh_tempo($data['pinjaman']->id, date_format($tgl_jatuh_tempo, "Y-m-d"));

		redirect('transaksianggotacon/view_pinjaman/'.$id_pinjaman);
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

		/* UPDATE Jatuh Tempo */
		if($update->jenis_pinjaman == 'Angsuran') {
			if($prev->jenis == 'Angsuran') {
				$wkt_pinjam			= $update->waktu;
				$wkt_pinjam			= new DateTime($wkt_pinjam);
				$tgl_pinjam			= $wkt_pinjam->format('d');

				if($update->jatuh_tempo == "0000-00-00" || $update->jatuh_tempo == NULL) {
					$detail = $this->detailangsuranmodel->get_total_kali_angsuran($update->id);
					$total_kali_angsuran = $detail;

					$jatuh_tempo_new 	= $this->addMonths($wkt_pinjam->format('Y-m-d'), $total_kali_angsuran + 1);
					$jatuh_tempo_new 	= new DateTime($jatuh_tempo_new);
				} else {
					$jatuh_tempo_old 	= $update->jatuh_tempo;
					$jatuh_tempo_old 	= new DateTime($jatuh_tempo_old);

					$jatuh_tempo_new 	= $this->diffMonths($jatuh_tempo_old->format('Y-m-d'), 1);
					$jatuh_tempo_new 	= new DateTime($jatuh_tempo_new);	
				}

				$bulan_jatuh_tempo_new = (int)$jatuh_tempo_new->format('m');
				$tahun_jatuh_tempo_new = $jatuh_tempo_new->format('Y');

				$max_tgl_bulan_jatuh_tempo_new = $this->getDaysInMonth($tahun_jatuh_tempo_new, $bulan_jatuh_tempo_new);

				if($tgl_pinjam <= $max_tgl_bulan_jatuh_tempo_new) {
					$tanggal = $tgl_pinjam;
				} else {
					$tanggal = $max_tgl_bulan_jatuh_tempo_new;
				}
				
				$jatuh_tempo 		= $jatuh_tempo_new->setDate($jatuh_tempo_new->format('Y'), $jatuh_tempo_new->format('m'), $tanggal);
				
				$this->pinjamanmodel->update_jatuh_tempo($update->id, $jatuh_tempo->format('Y-m-d'));
			}

		} else if ($update->jenis_pinjaman == 'Musiman') {
			if($prev->jenis == 'Pinjaman') {
				$wkt_pinjam			= $update->waktu;
				$wkt_pinjam			= new DateTime($wkt_pinjam);
				$tgl_pinjam			= $wkt_pinjam->format('d');

				if($update->jatuh_tempo == "0000-00-00" || $update->jatuh_tempo == NULL) {
					$detail = $this->detailangsuranmodel->get_total_kali_pinjaman($update->id);
					$total_kali_pinjaman = $detail;

					$jatuh_tempo_new 	= $this->addMonths($wkt_pinjam->format('Y-m-d'), $total_kali_pinjaman * 4 );
					$jatuh_tempo_new 	= new DateTime($jatuh_tempo_new);
				} else {
					$jatuh_tempo_old 	= $update->jatuh_tempo;
					$jatuh_tempo_old 	= new DateTime($jatuh_tempo_old);

					$jatuh_tempo_new 	= $this->diffMonths($jatuh_tempo_old->format('Y-m-d'), 4);
					$jatuh_tempo_new 	= new DateTime($jatuh_tempo_new);
				}

				$bulan_jatuh_tempo_new = (int)$jatuh_tempo_new->format('m');
				$tahun_jatuh_tempo_new = $jatuh_tempo_new->format('Y');

				$max_tgl_bulan_jatuh_tempo_new = $this->getDaysInMonth($tahun_jatuh_tempo_new, $bulan_jatuh_tempo_new);

				if($tgl_pinjam <= $max_tgl_bulan_jatuh_tempo_new) {
					$tanggal = $tgl_pinjam;
				} else {
					$tanggal = $max_tgl_bulan_jatuh_tempo_new;
				}
				
				$jatuh_tempo 		= $jatuh_tempo_new->setDate($jatuh_tempo_new->format('Y'), $jatuh_tempo_new->format('m'), $tanggal);
				
				$this->pinjamanmodel->update_jatuh_tempo($update->id, $jatuh_tempo->format('Y-m-d'));
			}
		}
		/*END OF UPDATE Jatuh Tempo */

		redirect('transaksianggotacon/view_pinjaman/'.$id_pinjaman);
	}

	function angsuran_post_akuntansi($id_pinjaman, $id_detail_angsuran) {
		$session_data = $this->session->userdata('mubasyirin_logged_in');
		if($session_data == NULL) {
			redirect("usercon/login", "refresh");
		}

		$data = array();
		$data['pinjaman'] 				= $this->pinjamanmodel->get_pinjaman_by_id($id_pinjaman);
		$data['post_detail_angsuran'] 	= $this->detailangsuranmodel->get_detail_angsuran_by_id($id_detail_angsuran);

		if($data['post_detail_angsuran']->status_post != '1') {
			// Posting Akuntansi
			if($data['post_detail_angsuran']->jenis == "Angsuran") {
				/* Posting Akuntansi Untuk Angsuran */
				$mapping_kode_akun = $this->mappingkodeakunmodel->get_mapping_kode_akun_by_nama_transaksi('penerimaan piutang');
				$debet 		= $this->kodeakunmodel->get_kode_akun_by_kode($mapping_kode_akun->kode_debet);
				$kredit 	= $this->kodeakunmodel->get_kode_akun_by_kode($mapping_kode_akun->kode_kredit);

				$data_debet 					= array();
				$data_debet['id'] 				= $this->transaksiakuntansimodel->getNewId();
				$data_debet['tanggal'] 			= $data['post_detail_angsuran']->waktu;
				$data_debet['kode_akun'] 		= $mapping_kode_akun->kode_debet;
				$data_debet['nama_akun'] 		= $debet->nama_akun;
				$data_debet['keterangan'] 		= "Pembayaran Angsuran Pinjaman Bulan ke-".$data['post_detail_angsuran']->bulan_ke." Anggota a.n. ".$data['pinjaman']->nama_nasabah." Nomor Anggota: ".$data['pinjaman']->nomor_nasabah." Tanggal Pinjaman: ".date("d-m-Y", strtotime($data['pinjaman']->waktu));
				$data_debet['jumlah'] 			= $data['post_detail_angsuran']->angsuran;
				$data_debet['debet'] 			= $data['post_detail_angsuran']->angsuran;
				$data_debet['kredit'] 			= 0;
				$data_debet['origin_table']		= 'detail_angsuran';
				$data_debet['origin_table_id']	= $data['post_detail_angsuran']->id;
				$this->transaksiakuntansimodel->inputData($data_debet);

				$data_kredit 					= array();
				$data_kredit['id'] 				= $this->transaksiakuntansimodel->getNewId();
				$data_kredit['tanggal'] 		= $data['post_detail_angsuran']->waktu;
				$data_kredit['kode_akun'] 		= $mapping_kode_akun->kode_kredit;
				$data_kredit['nama_akun'] 		= $kredit->nama_akun;
				$data_kredit['keterangan'] 		= "Pembayaran Angsuran Pinjaman Bulan ke-".$data['post_detail_angsuran']->bulan_ke." Anggota a.n. ".$data['pinjaman']->nama_nasabah." Nomor Anggota: ".$data['pinjaman']->nomor_nasabah." Tanggal Pinjaman: ".date("d-m-Y", strtotime($data['pinjaman']->waktu));
				$data_kredit['jumlah'] 			= $data['post_detail_angsuran']->angsuran;
				$data_kredit['debet'] 			= 0;
				$data_kredit['kredit'] 			= $data['post_detail_angsuran']->angsuran;
				$data_kredit['origin_table']	= 'detail_angsuran';
				$data_kredit['origin_table_id']	= $data['post_detail_angsuran']->id;
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

				$data_debet 					= array();
				$data_debet['id'] 				= $this->transaksiakuntansimodel->getNewId();
				$data_debet['tanggal'] 			= $data['post_detail_angsuran']->waktu;
				$data_debet['kode_akun'] 		= $mapping_kode_akun->kode_debet;
				$data_debet['nama_akun'] 		= $debet->nama_akun;
				$data_debet['keterangan'] 		= "Jasa Pembayaran Angsuran Pinjaman Bulan ke-".$data['post_detail_angsuran']->bulan_ke." Anggota a.n. ".$data['pinjaman']->nama_nasabah." Nomor Anggota: ".$data['pinjaman']->nomor_nasabah." Tanggal Pinjaman: ".date("d-m-Y", strtotime($data['pinjaman']->waktu));
				$data_debet['jumlah'] 			= $data['post_detail_angsuran']->jasa + $data['post_detail_angsuran']->denda;
				$data_debet['debet'] 			= $data['post_detail_angsuran']->jasa + $data['post_detail_angsuran']->denda;
				$data_debet['kredit'] 			= 0;
				$data_debet['origin_table']		= 'detail_angsuran';
				$data_debet['origin_table_id']	= $data['post_detail_angsuran']->id;
				$this->transaksiakuntansimodel->inputData($data_debet);

				$data_kredit 					= array();
				$data_kredit['id'] 				= $this->transaksiakuntansimodel->getNewId();
				$data_kredit['tanggal'] 		= $data['post_detail_angsuran']->waktu;
				$data_kredit['kode_akun'] 		= $mapping_kode_akun->kode_kredit;
				$data_kredit['nama_akun'] 		= $kredit->nama_akun;
				$data_kredit['keterangan'] 		= "Jasa Pembayaran Angsuran Pinjaman Bulan ke-".$data['post_detail_angsuran']->bulan_ke." Anggota a.n. ".$data['pinjaman']->nama_nasabah." Nomor Anggota: ".$data['pinjaman']->nomor_nasabah." Tanggal Pinjaman: ".date("d-m-Y", strtotime($data['pinjaman']->waktu));
				$data_kredit['jumlah'] 			= $data['post_detail_angsuran']->jasa + $data['post_detail_angsuran']->denda;
				$data_kredit['debet'] 			= 0;
				$data_kredit['kredit'] 			= $data['post_detail_angsuran']->jasa + $data['post_detail_angsuran']->denda;
				$data_kredit['origin_table']	= 'detail_angsuran';
				$data_kredit['origin_table_id']	= $data['post_detail_angsuran']->id;
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
			} else if($data['post_detail_angsuran']->jenis == "Pinjaman") {
				/* Posting Akuntansi Untuk Pemberian Pinjaman */
				$mapping_kode_akun = $this->mappingkodeakunmodel->get_mapping_kode_akun_by_nama_transaksi('pemberian pinjaman');
				$debet 		= $this->kodeakunmodel->get_kode_akun_by_kode($mapping_kode_akun->kode_debet);
				$kredit 	= $this->kodeakunmodel->get_kode_akun_by_kode($mapping_kode_akun->kode_kredit);

				$data_debet 					= array();
				$data_debet['id'] 				= $this->transaksiakuntansimodel->getNewId();
				$data_debet['tanggal'] 			= $data['post_detail_angsuran']->waktu;
				$data_debet['kode_akun'] 		= $mapping_kode_akun->kode_debet;
				$data_debet['nama_akun'] 		= $debet->nama_akun;
				$data_debet['keterangan'] 		= "Pemberian Pinjaman kepada Anggota a.n. ".$data['pinjaman']->nama_nasabah." Nomor Anggota: ".$data['pinjaman']->nomor_nasabah." Tanggal Pinjaman: ".date("d-m-Y", strtotime($data['pinjaman']->waktu));
				$data_debet['jumlah'] 			= $data['post_detail_angsuran']->total;
				$data_debet['debet'] 			= $data['post_detail_angsuran']->total;
				$data_debet['kredit'] 			= 0;
				$data_debet['origin_table']		= 'detail_angsuran';
				$data_debet['origin_table_id']	= $data['post_detail_angsuran']->id;
				$this->transaksiakuntansimodel->inputData($data_debet);

				$data_kredit 					= array();
				$data_kredit['id'] 				= $this->transaksiakuntansimodel->getNewId();
				$data_kredit['tanggal'] 		= $data['post_detail_angsuran']->waktu;
				$data_kredit['kode_akun'] 		= $mapping_kode_akun->kode_kredit;
				$data_kredit['nama_akun'] 		= $kredit->nama_akun;
				$data_kredit['keterangan'] 		= "Pemberian Pinjaman kepada Anggota a.n. ".$data['pinjaman']->nama_nasabah." Nomor Anggota: ".$data['pinjaman']->nomor_nasabah." Tanggal Pinjaman: ".date("d-m-Y", strtotime($data['pinjaman']->waktu));
				$data_kredit['jumlah'] 			= $data['post_detail_angsuran']->total;
				$data_kredit['debet'] 			= 0;
				$data_kredit['kredit'] 			= $data['post_detail_angsuran']->total;
				$data_kredit['origin_table']	= 'detail_angsuran';
				$data_kredit['origin_table_id']	= $data['post_detail_angsuran']->id;
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
		}

		redirect('transaksianggotacon/view_pinjaman/'.$id_pinjaman);
	}

	function angsuran_unpost_akuntansi($id_pinjaman, $id_detail_angsuran) {
		$session_data = $this->session->userdata('mubasyirin_logged_in');
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
		$session_data = $this->session->userdata('mubasyirin_logged_in');
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
		$data['aset_kekayaan']		= $this->asetkekayaanmodel->get_asetkekayaan_by_id_nasabah($id_nasabah);
		$data['username'] 			= $session_data['username'];
		$data['status'] 			= $session_data['status'];

		$this->load->view('/layouts/menu', $data);
		$this->load->view('/transaksianggota/index_simpananpokok', $data);
		$this->load->view('/layouts/footer', $data);
	}

	function create_simpananpokok($id_nasabah) {
		$session_data = $this->session->userdata('mubasyirin_logged_in');
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
		$data['aset_kekayaan']		= $this->asetkekayaanmodel->get_asetkekayaan_by_id_nasabah($id_nasabah);
		$data['username'] 			= $session_data['username'];
		$data['status'] 			= $session_data['status'];

		$this->load->view('/layouts/menu', $data);
		$this->load->view('/transaksianggota/create_simpananpokok', $data);
		$this->load->view('/layouts/footer', $data);
	}

	function insert_simpananpokok($id_nasabah) {
		$session_data = $this->session->userdata('mubasyirin_logged_in');
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
		$insert['jenis'] 			= $this->input->post('jenis');
		$insert['jumlah'] 			= $this->input->post('jumlah');
		$this->simpananpokokmodel->inputData($insert);

		redirect('transaksianggotacon/simpananpokok/'.$id_nasabah);
	}

	function edit_simpananpokok($id_simpananpokok) {
		$session_data = $this->session->userdata('mubasyirin_logged_in');
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
		$data['aset_kekayaan']		= $this->asetkekayaanmodel->get_asetkekayaan_by_id_nasabah($id_nasabah);
		$data['username'] 			= $session_data['username'];
		$data['status'] 			= $session_data['status'];

		$this->load->view('/layouts/menu', $data);
		$this->load->view('/transaksianggota/edit_simpananpokok', $data);
		$this->load->view('/layouts/footer', $data);
	}

	function update_simpananpokok() {
		$session_data = $this->session->userdata('mubasyirin_logged_in');
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
		$update['jenis'] 			= $this->input->post('jenis');
		$update['jumlah'] 			= $this->input->post('jumlah');
		$this->simpananpokokmodel->updateData($id_simpananpokok, $update);

		$id_nasabah = $update['id_nasabah'];

		redirect('transaksianggotacon/simpananpokok/'.$id_nasabah);
	}

	function view_simpananpokok($id_simpananpokok) {
		$session_data = $this->session->userdata('mubasyirin_logged_in');
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
		$data['aset_kekayaan']		= $this->asetkekayaanmodel->get_asetkekayaan_by_id_nasabah($id_nasabah);
		$data['username'] 			= $session_data['username'];
		$data['status'] 			= $session_data['status'];

		$this->load->view('/layouts/menu', $data);
		$this->load->view('/transaksianggota/view_simpananpokok', $data);
		$this->load->view('/layouts/footer', $data);
	}

	function delete_simpananpokok($id_simpananpokok) {
		$session_data = $this->session->userdata('mubasyirin_logged_in');
		if($session_data == NULL) {
			redirect("usercon/login", "refresh");
		}

		$data['simpananpokok'] 		= $this->simpananpokokmodel->get_simpananpokok_by_id($id_simpananpokok);
		$id_nasabah					= $data['simpananpokok']->id_nasabah;

		$this->simpananpokokmodel->deleteData($id_simpananpokok);
		redirect('transaksianggotacon/simpananpokok/'.$id_nasabah);
	}

	function simpananpokok_post_akuntansi($id_simpananpokok) {
		$session_data = $this->session->userdata('mubasyirin_logged_in');
		if($session_data == NULL) {
			redirect("usercon/login", "refresh");
		}

		$data['simpananpokok'] 		= $this->simpananpokokmodel->get_simpananpokok_by_id($id_simpananpokok);
		$id_nasabah 				= $data['simpananpokok']->id_nasabah;

		if($data['simpananpokok']->status_post != '1') {
			if($data['simpananpokok']->jenis == "Setoran") {
				if(substr($data['simpananpokok']->nomor_nasabah, 0, 1) == "1") {
					$mapping_kode_akun = $this->mappingkodeakunmodel->get_mapping_kode_akun_by_nama_transaksi('penerimaan simp pokok');	
				} else if (substr($data['simpananpokok']->nomor_nasabah, 0, 1) == "2") {
					$mapping_kode_akun = $this->mappingkodeakunmodel->get_mapping_kode_akun_by_nama_transaksi('penerimaan simp pokok istimewa');
				}
				
				$debet 		= $this->kodeakunmodel->get_kode_akun_by_kode($mapping_kode_akun->kode_debet);
				$kredit 	= $this->kodeakunmodel->get_kode_akun_by_kode($mapping_kode_akun->kode_kredit);

				$data_debet 					= array();
				$data_debet['id'] 				= $this->transaksiakuntansimodel->getNewId();
				$data_debet['tanggal'] 			= $data['simpananpokok']->waktu;
				$data_debet['kode_akun'] 		= $mapping_kode_akun->kode_debet;
				$data_debet['nama_akun'] 		= $debet->nama_akun;
				if(substr($data['simpananpokok']->nomor_nasabah, 0, 1) == "1") {
					$data_debet['keterangan'] 	= "Simpanan Pokok Anggota a.n. ".$data['simpananpokok']->nama_nasabah." Nomor Anggota: ".$data['simpananpokok']->nomor_nasabah." Tanggal Simpanan: ".date("d-m-Y", strtotime($data['simpananpokok']->waktu));	
				} else if(substr($data['simpananpokok']->nomor_nasabah, 0, 1) == "2") {
					$data_debet['keterangan'] 	= "Simpanan Pokok Istimewa a.n. ".$data['simpananpokok']->nama_nasabah." Nomor: ".$data['simpananpokok']->nomor_nasabah." Tanggal Simpanan: ".date("d-m-Y", strtotime($data['simpananpokok']->waktu));
				}
				
				$data_debet['jumlah'] 			= $data['simpananpokok']->jumlah;
				$data_debet['debet'] 			= $data['simpananpokok']->jumlah;
				$data_debet['kredit'] 			= 0;
				$data_debet['origin_table']		= 'simpananpokok';
				$data_debet['origin_table_id']	= $data['simpananpokok']->id;
				$this->transaksiakuntansimodel->inputData($data_debet);

				$data_kredit 					= array();
				$data_kredit['id'] 				= $this->transaksiakuntansimodel->getNewId();
				$data_kredit['tanggal'] 		= $data['simpananpokok']->waktu;
				$data_kredit['kode_akun'] 		= $mapping_kode_akun->kode_kredit;
				$data_kredit['nama_akun'] 		= $kredit->nama_akun;
				if(substr($data['simpananpokok']->nomor_nasabah, 0, 1) == "1") {
					$data_kredit['keterangan'] 	= "Simpanan Pokok Anggota a.n. ".$data['simpananpokok']->nama_nasabah." Nomor Anggota: ".$data['simpananpokok']->nomor_nasabah." Tanggal Simpanan: ".date("d-m-Y", strtotime($data['simpananpokok']->waktu));
				} else if(substr($data['simpananpokok']->nomor_nasabah, 0, 1) == "2") {
					$data_kredit['keterangan'] 	= "Simpanan Pokok Istimewa a.n. ".$data['simpananpokok']->nama_nasabah." Nomor: ".$data['simpananpokok']->nomor_nasabah." Tanggal Simpanan: ".date("d-m-Y", strtotime($data['simpananpokok']->waktu));
				}
				$data_kredit['jumlah'] 			= $data['simpananpokok']->jumlah;
				$data_kredit['debet'] 			= 0;
				$data_kredit['kredit'] 			= $data['simpananpokok']->jumlah;
				$data_kredit['origin_table']	= 'simpananpokok';
				$data_kredit['origin_table_id']	= $data['simpananpokok']->id;
				$this->transaksiakuntansimodel->inputData($data_kredit);

				$update = array();
				$id 									= $data['simpananpokok']->id;
				$update['id_nasabah'] 					= $data['simpananpokok']->id_nasabah;
				$update['nama_nasabah'] 				= $data['simpananpokok']->nama_nasabah;
				$update['nomor_nasabah'] 				= $data['simpananpokok']->nomor_nasabah;
				$update['nik_nasabah'] 					= $data['simpananpokok']->nik_nasabah;
				$update['waktu'] 						= $data['simpananpokok']->waktu;
				$update['jenis'] 						= $data['simpananpokok']->jenis;
				$update['jumlah'] 						= $data['simpananpokok']->jumlah;
				$update['status_post'] 					= 1;
				$update['id_debet_transaksi_akuntansi']	= $data_debet['id'];
				$update['id_kredit_transaksi_akuntansi']= $data_kredit['id'];
				$this->simpananpokokmodel->updateData($id, $update);
			} else if($data['simpananpokok']->jenis == "Tarikan") {
				if(substr($data['simpananpokok']->nomor_nasabah, 0, 1) == "1") {
					$mapping_kode_akun = $this->mappingkodeakunmodel->get_mapping_kode_akun_by_nama_transaksi('pencairan simpanan pokok');
				} else if(substr($data['simpananpokok']->nomor_nasabah, 0, 1) == "2") {
					$mapping_kode_akun = $this->mappingkodeakunmodel->get_mapping_kode_akun_by_nama_transaksi('pencairan simp pokok istimewa');
				}
				
				$debet 		= $this->kodeakunmodel->get_kode_akun_by_kode($mapping_kode_akun->kode_debet);
				$kredit 	= $this->kodeakunmodel->get_kode_akun_by_kode($mapping_kode_akun->kode_kredit);

				$data_debet 					= array();
				$data_debet['id'] 				= $this->transaksiakuntansimodel->getNewId();
				$data_debet['tanggal'] 			= $data['simpananpokok']->waktu;
				$data_debet['kode_akun'] 		= $mapping_kode_akun->kode_debet;
				$data_debet['nama_akun'] 		= $debet->nama_akun;
				if(substr($data['simpananpokok']->nomor_nasabah, 0, 1) == "1") {
					$data_debet['keterangan'] 	= "Pencairan Simpanan Pokok Anggota a.n. ".$data['simpananpokok']->nama_nasabah." Nomor Anggota: ".$data['simpananpokok']->nomor_nasabah." Tanggal Simpanan: ".date("d-m-Y", strtotime($data['simpananpokok']->waktu));
				} else if(substr($data['simpananpokok']->nomor_nasabah, 0, 1) == "2") {
					$data_debet['keterangan'] 	= "Pencairan Simpanan Pokok Istimewa a.n. ".$data['simpananpokok']->nama_nasabah." Nomor : ".$data['simpananpokok']->nomor_nasabah." Tanggal Simpanan: ".date("d-m-Y", strtotime($data['simpananpokok']->waktu));
				}
				$data_debet['jumlah'] 			= $data['simpananpokok']->jumlah;
				$data_debet['debet'] 			= $data['simpananpokok']->jumlah;
				$data_debet['kredit'] 			= 0;
				$data_debet['origin_table']		= 'simpananpokok';
				$data_debet['origin_table_id']	= $data['simpananpokok']->id;
				$this->transaksiakuntansimodel->inputData($data_debet);

				$data_kredit 					= array();
				$data_kredit['id'] 				= $this->transaksiakuntansimodel->getNewId();
				$data_kredit['tanggal'] 		= $data['simpananpokok']->waktu;
				$data_kredit['kode_akun'] 		= $mapping_kode_akun->kode_kredit;
				$data_kredit['nama_akun'] 		= $kredit->nama_akun;
				if(substr($data['simpananpokok']->nomor_nasabah, 0, 1) == "1") {
					$data_kredit['keterangan'] 	= "Pencairan Simpanan Pokok Anggota a.n. ".$data['simpananpokok']->nama_nasabah." Nomor Anggota: ".$data['simpananpokok']->nomor_nasabah." Tanggal Simpanan: ".date("d-m-Y", strtotime($data['simpananpokok']->waktu));
				} else if(substr($data['simpananpokok']->nomor_nasabah, 0, 1) == "2") {
					$data_kredit['keterangan'] 	= "Pencairan Simpanan Pokok Istimewa a.n. ".$data['simpananpokok']->nama_nasabah." Nomor: ".$data['simpananpokok']->nomor_nasabah." Tanggal Simpanan: ".date("d-m-Y", strtotime($data['simpananpokok']->waktu));
				}
				$data_kredit['jumlah'] 			= $data['simpananpokok']->jumlah;
				$data_kredit['debet'] 			= 0;
				$data_kredit['kredit'] 			= $data['simpananpokok']->jumlah;
				$data_kredit['origin_table']	= 'simpananpokok';
				$data_kredit['origin_table_id']	= $data['simpananpokok']->id;
				$this->transaksiakuntansimodel->inputData($data_kredit);

				$update = array();
				$id 									= $data['simpananpokok']->id;
				$update['id_nasabah'] 					= $data['simpananpokok']->id_nasabah;
				$update['nama_nasabah'] 				= $data['simpananpokok']->nama_nasabah;
				$update['nomor_nasabah'] 				= $data['simpananpokok']->nomor_nasabah;
				$update['nik_nasabah'] 					= $data['simpananpokok']->nik_nasabah;
				$update['waktu'] 						= $data['simpananpokok']->waktu;
				$update['jenis'] 						= $data['simpananpokok']->jenis;
				$update['jumlah'] 						= $data['simpananpokok']->jumlah;
				$update['status_post'] 					= 1;
				$update['id_debet_transaksi_akuntansi']	= $data_debet['id'];
				$update['id_kredit_transaksi_akuntansi']= $data_kredit['id'];
				$this->simpananpokokmodel->updateData($id, $update);
			}
		}
		
		redirect('transaksianggotacon/simpananpokok/'.$id_nasabah);
	}

	function simpananpokok_unpost_akuntansi($id_simpananpokok) {
		$session_data = $this->session->userdata('mubasyirin_logged_in');
		if($session_data == NULL) {
			redirect("usercon/login", "refresh");
		}

		$data['simpananpokok'] 		= $this->simpananpokokmodel->get_simpananpokok_by_id($id_simpananpokok);
		$id_nasabah 				= $data['simpananpokok']->id_nasabah;

		$id_debet_transaksi_akuntansi 	= $data['simpananpokok']->id_debet_transaksi_akuntansi;
		$id_kredit_transaksi_akuntansi 	= $data['simpananpokok']->id_kredit_transaksi_akuntansi;

		$this->transaksiakuntansimodel->deleteData($id_debet_transaksi_akuntansi);
		$this->transaksiakuntansimodel->deleteData($id_kredit_transaksi_akuntansi);

		$update = array();
		$id 									= $data['simpananpokok']->id;
		$update['id_nasabah'] 					= $data['simpananpokok']->id_nasabah;
		$update['nama_nasabah'] 				= $data['simpananpokok']->nama_nasabah;
		$update['nomor_nasabah'] 				= $data['simpananpokok']->nomor_nasabah;
		$update['nik_nasabah'] 					= $data['simpananpokok']->nik_nasabah;
		$update['waktu'] 						= $data['simpananpokok']->waktu;
		$update['jenis'] 						= $data['simpananpokok']->jenis;
		$update['jumlah'] 						= $data['simpananpokok']->jumlah;
		$update['status_post'] 					= 0;
		$update['id_debet_transaksi_akuntansi']	= 0;
		$update['id_kredit_transaksi_akuntansi']= 0;
		$this->simpananpokokmodel->updateData($id, $update);

		redirect('transaksianggotacon/simpananpokok/'.$id_nasabah);
	}
	/*** End of Transaksi Simpanan Pokok ***/

	/*** Transaksi Simpanan Wajib ***/
	function simpananwajib($id_nasabah) {
		$session_data = $this->session->userdata('mubasyirin_logged_in');
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
		$data['aset_kekayaan']		= $this->asetkekayaanmodel->get_asetkekayaan_by_id_nasabah($id_nasabah);
		$data['username'] 			= $session_data['username'];
		$data['status'] 			= $session_data['status'];

		$this->load->view('/layouts/menu', $data);
		$this->load->view('/transaksianggota/index_simpananwajib', $data);
		$this->load->view('/layouts/footer', $data);
	}

	function create_simpananwajib($id_nasabah) {
		$session_data = $this->session->userdata('mubasyirin_logged_in');
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
		$data['aset_kekayaan']		= $this->asetkekayaanmodel->get_asetkekayaan_by_id_nasabah($id_nasabah);
		$data['username'] 			= $session_data['username'];
		$data['status'] 			= $session_data['status'];

		$this->load->view('/layouts/menu', $data);
		$this->load->view('/transaksianggota/create_simpananwajib', $data);
		$this->load->view('/layouts/footer', $data);
	}

	function insert_simpananwajib($id_nasabah) {
		$session_data = $this->session->userdata('mubasyirin_logged_in');
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
		$session_data = $this->session->userdata('mubasyirin_logged_in');
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
		$data['aset_kekayaan']		= $this->asetkekayaanmodel->get_asetkekayaan_by_id_nasabah($id_nasabah);
		$data['username'] 			= $session_data['username'];
		$data['status'] 			= $session_data['status'];
		
		$this->load->view('/layouts/menu', $data);
		$this->load->view('/transaksianggota/edit_simpananwajib', $data);
		$this->load->view('/layouts/footer', $data);
	}

	function update_simpananwajib() {
		$session_data = $this->session->userdata('mubasyirin_logged_in');
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
		$session_data = $this->session->userdata('mubasyirin_logged_in');
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
		$session_data = $this->session->userdata('mubasyirin_logged_in');
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
		$data['aset_kekayaan']			= $this->asetkekayaanmodel->get_asetkekayaan_by_id_nasabah($id_nasabah);
		$data['username'] 				= $session_data['username'];
		$data['status'] 				= $session_data['status'];
		
		$this->load->view('/layouts/menu', $data);
		$this->load->view('/transaksianggota/view_simpananwajib', $data);
		$this->load->view('/layouts/footer', $data);
	}

	function insert_detail_simpananwajib() {
		$session_data = $this->session->userdata('mubasyirin_logged_in');
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
		$session_data = $this->session->userdata('mubasyirin_logged_in');
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
		$data['aset_kekayaan']				= $this->asetkekayaanmodel->get_asetkekayaan_by_id_nasabah($id_nasabah);
		$data['username'] 					= $session_data['username'];
		$data['status'] 					= $session_data['status'];

		$this->load->view('/layouts/menu', $data);
		$this->load->view('/transaksianggota/view_simpananwajib_edit_detail', $data);
		$this->load->view('/layouts/footer', $data);	
	}

	function update_detail_simpananwajib() {
		$session_data = $this->session->userdata('mubasyirin_logged_in');
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
		$session_data = $this->session->userdata('mubasyirin_logged_in');
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
		$session_data = $this->session->userdata('mubasyirin_logged_in');
		if($session_data == NULL) {
			redirect("usercon/login", "refresh");
		}

		$data['simpananwajib'] 				= $this->simpananwajibmodel->get_simpananwajib_by_id($id_simpananwajib);
		$data['post_detail_simpananwajib'] 	= $this->detailsimpananwajibmodel->get_detail_simpananwajib_by_id($id_detail_simpananwajib);

		if($data['post_detail_simpananwajib']->status_post != '1') {
			if($data['post_detail_simpananwajib']->jenis == "Setoran") {
				$mapping_kode_akun = $this->mappingkodeakunmodel->get_mapping_kode_akun_by_nama_transaksi('penerimaan simp wajib');
				$debet 		= $this->kodeakunmodel->get_kode_akun_by_kode($mapping_kode_akun->kode_debet);
				$kredit 	= $this->kodeakunmodel->get_kode_akun_by_kode($mapping_kode_akun->kode_kredit);
				$bln_thn = strtotime( $data['post_detail_simpananwajib']->bulan_tahun );
	            $bulan_tahun = date( 'M-Y', $bln_thn );

				$data_debet 					= array();
				$data_debet['id'] 				= $this->transaksiakuntansimodel->getNewId();
				$data_debet['tanggal'] 			= $data['post_detail_simpananwajib']->waktu;
				$data_debet['kode_akun'] 		= $mapping_kode_akun->kode_debet;
				$data_debet['nama_akun'] 		= $debet->nama_akun;
				$data_debet['keterangan'] 		= "Simpanan Wajib Bulan ".$bulan_tahun." Anggota a.n. ".$data['simpananwajib']->nama_nasabah." Nomor Anggota: ".$data['simpananwajib']->nomor_nasabah." Tanggal Simpanan: ".date("d-m-Y", strtotime($data['simpananwajib']->waktu));
				$data_debet['jumlah'] 			= $data['post_detail_simpananwajib']->jumlah;
				$data_debet['debet'] 			= $data['post_detail_simpananwajib']->jumlah;
				$data_debet['kredit'] 			= 0;
				$data_debet['origin_table']		= 'detail_simpananwajib';
				$data_debet['origin_table_id']	= $data['post_detail_simpananwajib']->id;
				$this->transaksiakuntansimodel->inputData($data_debet);

				$data_kredit 					= array();
				$data_kredit['id'] 				= $this->transaksiakuntansimodel->getNewId();
				$data_kredit['tanggal'] 		= $data['post_detail_simpananwajib']->waktu;
				$data_kredit['kode_akun'] 		= $mapping_kode_akun->kode_kredit;
				$data_kredit['nama_akun'] 		= $kredit->nama_akun;
				$data_kredit['keterangan'] 		= "Simpanan Wajib Bulan ".$bulan_tahun." Anggota a.n. ".$data['simpananwajib']->nama_nasabah." Nomor Anggota: ".$data['simpananwajib']->nomor_nasabah." Tanggal Simpanan: ".date("d-m-Y", strtotime($data['simpananwajib']->waktu));
				$data_kredit['jumlah'] 			= $data['post_detail_simpananwajib']->jumlah;
				$data_kredit['debet'] 			= 0;
				$data_kredit['kredit'] 			= $data['post_detail_simpananwajib']->jumlah;
				$data_kredit['origin_table']	= 'detail_simpananwajib';
				$data_kredit['origin_table_id']	= $data['post_detail_simpananwajib']->id;
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
			} else if($data['post_detail_simpananwajib']->jenis == "Tarikan") {
				$mapping_kode_akun = $this->mappingkodeakunmodel->get_mapping_kode_akun_by_nama_transaksi('pencairan simpanan wajib');
				$debet 		= $this->kodeakunmodel->get_kode_akun_by_kode($mapping_kode_akun->kode_debet);
				$kredit 	= $this->kodeakunmodel->get_kode_akun_by_kode($mapping_kode_akun->kode_kredit);
				$bln_thn = strtotime( $data['post_detail_simpananwajib']->bulan_tahun );
	            $bulan_tahun = date( 'M-Y', $bln_thn );

				$data_debet 					= array();
				$data_debet['id'] 				= $this->transaksiakuntansimodel->getNewId();
				$data_debet['tanggal'] 			= $data['post_detail_simpananwajib']->waktu;
				$data_debet['kode_akun'] 		= $mapping_kode_akun->kode_debet;
				$data_debet['nama_akun'] 		= $debet->nama_akun;
				$data_debet['keterangan'] 		= "Pencairan Simpanan Wajib Bulan ".$bulan_tahun." Anggota a.n. ".$data['simpananwajib']->nama_nasabah." Nomor Anggota: ".$data['simpananwajib']->nomor_nasabah." Tanggal Simpanan: ".date("d-m-Y", strtotime($data['simpananwajib']->waktu));
				$data_debet['jumlah'] 			= $data['post_detail_simpananwajib']->jumlah;
				$data_debet['debet'] 			= $data['post_detail_simpananwajib']->jumlah;
				$data_debet['kredit'] 			= 0;
				$data_debet['origin_table']		= 'detail_simpananwajib';
				$data_debet['origin_table_id']	= $data['post_detail_simpananwajib']->id;
				$this->transaksiakuntansimodel->inputData($data_debet);

				$data_kredit 					= array();
				$data_kredit['id'] 				= $this->transaksiakuntansimodel->getNewId();
				$data_kredit['tanggal'] 		= $data['post_detail_simpananwajib']->waktu;
				$data_kredit['kode_akun'] 		= $mapping_kode_akun->kode_kredit;
				$data_kredit['nama_akun'] 		= $kredit->nama_akun;
				$data_kredit['keterangan'] 		= "Pencairan Simpanan Wajib Bulan ".$bulan_tahun." Anggota a.n. ".$data['simpananwajib']->nama_nasabah." Nomor Anggota: ".$data['simpananwajib']->nomor_nasabah." Tanggal Simpanan: ".date("d-m-Y", strtotime($data['simpananwajib']->waktu));
				$data_kredit['jumlah'] 			= $data['post_detail_simpananwajib']->jumlah;
				$data_kredit['debet'] 			= 0;
				$data_kredit['kredit'] 			= $data['post_detail_simpananwajib']->jumlah;
				$data_kredit['origin_table']	= 'detail_simpananwajib';
				$data_kredit['origin_table_id']	= $data['post_detail_simpananwajib']->id;
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
		}
		
		redirect('transaksianggotacon/view_simpananwajib/'.$id_simpananwajib);
	}

	function simpananwajib_unpost_akuntansi($id_simpananwajib, $id_detail_simpananwajib) {
		$session_data = $this->session->userdata('mubasyirin_logged_in');
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
		$session_data = $this->session->userdata('mubasyirin_logged_in');
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
		$data['aset_kekayaan']		= $this->asetkekayaanmodel->get_asetkekayaan_by_id_nasabah($id_nasabah);
		$data['username'] 			= $session_data['username'];
		$data['status'] 			= $session_data['status'];

		$this->load->view('/layouts/menu', $data);
		$this->load->view('/transaksianggota/index_simpanankhusus', $data);
		$this->load->view('/layouts/footer', $data);
	}

	function create_simpanankhusus($id_nasabah) {
		$session_data = $this->session->userdata('mubasyirin_logged_in');
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
		$data['aset_kekayaan']		= $this->asetkekayaanmodel->get_asetkekayaan_by_id_nasabah($id_nasabah);
		$data['username'] 			= $session_data['username'];
		$data['status'] 			= $session_data['status'];

		$this->load->view('/layouts/menu', $data);
		$this->load->view('/transaksianggota/create_simpanankhusus', $data);
		$this->load->view('/layouts/footer', $data);
	}

	function insert_simpanankhusus($id_nasabah) {
		$session_data = $this->session->userdata('mubasyirin_logged_in');
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
		$session_data = $this->session->userdata('mubasyirin_logged_in');
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
		$data['aset_kekayaan']		= $this->asetkekayaanmodel->get_asetkekayaan_by_id_nasabah($id_nasabah);
		$data['username'] 			= $session_data['username'];
		$data['status'] 			= $session_data['status'];
		
		$this->load->view('/layouts/menu', $data);
		$this->load->view('/transaksianggota/edit_simpanankhusus', $data);
		$this->load->view('/layouts/footer', $data);
	}

	function update_simpanankhusus() {
		$session_data = $this->session->userdata('mubasyirin_logged_in');
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
		$session_data = $this->session->userdata('mubasyirin_logged_in');
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
		$session_data = $this->session->userdata('mubasyirin_logged_in');
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
		$data['aset_kekayaan']		= $this->asetkekayaanmodel->get_asetkekayaan_by_id_nasabah($id_nasabah);
		$data['username'] 				= $session_data['username'];
		$data['status'] 				= $session_data['status'];
		
		$this->load->view('/layouts/menu', $data);
		$this->load->view('/transaksianggota/view_simpanankhusus', $data);
		$this->load->view('/layouts/footer', $data);
	}

	function insert_detail_simpanankhusus() {
		$session_data = $this->session->userdata('mubasyirin_logged_in');
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
		$input['keterangan']		= $this->input->post('keterangan');
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
		$data['aset_kekayaan']		= $this->asetkekayaanmodel->get_asetkekayaan_by_id_nasabah($id_nasabah);
		$data['username'] 					= $session_data['username'];
		$data['status'] 					= $session_data['status'];

		$this->load->view('/layouts/menu', $data);
		$this->load->view('/transaksianggota/view_simpanankhusus_edit_detail', $data);
		$this->load->view('/layouts/footer', $data);	
	}

	function update_detail_simpanankhusus() {
		$session_data = $this->session->userdata('mubasyirin_logged_in');
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
		$update['keterangan'] 			= $this->input->post('edit_keterangan');
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

		redirect('transaksianggotacon/view_simpanankhusus/'.$id_simpanankhusus);
	}

	function simpanankhusus_post_akuntansi($id_simpanankhusus, $id_detail_simpanankhusus) {
		$session_data = $this->session->userdata('mubasyirin_logged_in');
		if($session_data == NULL) {
			redirect("usercon/login", "refresh");
		}

		$data['simpanankhusus'] 			= $this->simpanankhususmodel->get_simpanankhusus_by_id($id_simpanankhusus);
		$data['post_detail_simpanankhusus'] = $this->detailsimpanankhususmodel->get_detail_simpanankhusus_by_id($id_detail_simpanankhusus);

		if($data['post_detail_simpanankhusus']->status_post != '1') {
			if($data['post_detail_simpanankhusus']->jenis == "Setoran") {
				if(substr($data['simpanankhusus']->nomor_nasabah, 0, 1) == '1') {
					$mapping_kode_akun = $this->mappingkodeakunmodel->get_mapping_kode_akun_by_nama_transaksi('penerimaan simp kusus (shu)');
					$debet 		= $this->kodeakunmodel->get_kode_akun_by_kode($mapping_kode_akun->kode_debet);
					$kredit 	= $this->kodeakunmodel->get_kode_akun_by_kode($mapping_kode_akun->kode_kredit);
					$bln_thn = strtotime( $data['post_detail_simpanankhusus']->bulan_tahun );
		            $bulan_tahun = date( 'M-Y', $bln_thn );

		            $data_debet 					= array();
					$data_debet['id'] 				= $this->transaksiakuntansimodel->getNewId();
					$data_debet['tanggal'] 			= $data['post_detail_simpanankhusus']->waktu;
					$data_debet['kode_akun'] 		= $mapping_kode_akun->kode_debet;
					$data_debet['nama_akun'] 		= $debet->nama_akun;
					$data_debet['keterangan'] 		= "Simpanan Khusus Bulan ".$bulan_tahun." Anggota a.n. ".$data['simpanankhusus']->nama_nasabah." Nomor Anggota: ".$data['simpanankhusus']->nomor_nasabah." Tanggal Simpanan: ".date("d-m-Y", strtotime($data['simpanankhusus']->waktu));
					$data_debet['jumlah'] 			= $data['post_detail_simpanankhusus']->jumlah;
					$data_debet['debet'] 			= $data['post_detail_simpanankhusus']->jumlah;
					$data_debet['kredit'] 			= 0;
					$data_debet['origin_table']		= 'detail_simpanankhusus';
					$data_debet['origin_table_id']	= $data['post_detail_simpanankhusus']->id;
					$this->transaksiakuntansimodel->inputData($data_debet);

					$data_kredit 					= array();
					$data_kredit['id'] 				= $this->transaksiakuntansimodel->getNewId();
					$data_kredit['tanggal'] 		= $data['post_detail_simpanankhusus']->waktu;
					$data_kredit['kode_akun'] 		= $mapping_kode_akun->kode_kredit;
					$data_kredit['nama_akun'] 		= $kredit->nama_akun;
					$data_kredit['keterangan'] 		= "Simpanan Khusus Bulan ".$bulan_tahun." Anggota a.n. ".$data['simpanankhusus']->nama_nasabah." Nomor Anggota: ".$data['simpanankhusus']->nomor_nasabah." Tanggal Simpanan: ".date("d-m-Y", strtotime($data['simpanankhusus']->waktu));
					$data_kredit['jumlah'] 			= $data['post_detail_simpanankhusus']->jumlah;
					$data_kredit['debet'] 			= 0;
					$data_kredit['kredit'] 			= $data['post_detail_simpanankhusus']->jumlah;
					$data_kredit['origin_table']	= 'detail_simpanankhusus';
					$data_kredit['origin_table_id']	= $data['post_detail_simpanankhusus']->id;
					$this->transaksiakuntansimodel->inputData($data_kredit);

					$update = array();
					$id 									= $data['post_detail_simpanankhusus']->id;
					$update['id_simpanankhusus'] 			= $data['post_detail_simpanankhusus']->id_simpanankhusus;
					$update['waktu'] 						= $data['post_detail_simpanankhusus']->waktu;
					$update['jenis'] 						= $data['post_detail_simpanankhusus']->jenis;
					$update['bulan_tahun'] 					= $data['post_detail_simpanankhusus']->bulan_tahun;
					$update['jumlah'] 						= $data['post_detail_simpanankhusus']->jumlah;
					$update['status_post'] 					= 1;
					$update['id_debet_transaksi_akuntansi']	= $data_debet['id'];
					$update['id_kredit_transaksi_akuntansi']= $data_kredit['id'];
					$this->detailsimpanankhususmodel->updateData($id, $update);
				} else {
					$mapping_kode_akun = $this->mappingkodeakunmodel->get_mapping_kode_akun_by_nama_transaksi('penerimaan simp kusus (phak 3)');
					$debet 		= $this->kodeakunmodel->get_kode_akun_by_kode($mapping_kode_akun->kode_debet);
					$kredit 	= $this->kodeakunmodel->get_kode_akun_by_kode($mapping_kode_akun->kode_kredit);
					$bln_thn = strtotime( $data['post_detail_simpanankhusus']->bulan_tahun );
		            $bulan_tahun = date( 'M-Y', $bln_thn );

		            $data_debet 					= array();
					$data_debet['id'] 				= $this->transaksiakuntansimodel->getNewId();
					$data_debet['tanggal'] 			= $data['post_detail_simpanankhusus']->waktu;
					$data_debet['kode_akun'] 		= $mapping_kode_akun->kode_debet;
					$data_debet['nama_akun'] 		= $debet->nama_akun;
					$data_debet['keterangan'] 		= "Simpanan Khusus Bulan ".$bulan_tahun." a.n. ".$data['simpanankhusus']->nama_nasabah." Nomor : ".$data['simpanankhusus']->nomor_nasabah." Tanggal Simpanan: ".date("d-m-Y", strtotime($data['simpanankhusus']->waktu));
					$data_debet['jumlah'] 			= $data['post_detail_simpanankhusus']->jumlah;
					$data_debet['debet'] 			= $data['post_detail_simpanankhusus']->jumlah;
					$data_debet['kredit'] 			= 0;
					$data_debet['origin_table']		= 'detail_simpanankhusus';
					$data_debet['origin_table_id']	= $data['post_detail_simpanankhusus']->id;
					$this->transaksiakuntansimodel->inputData($data_debet);

					$data_kredit 					= array();
					$data_kredit['id'] 				= $this->transaksiakuntansimodel->getNewId();
					$data_kredit['tanggal'] 		= $data['post_detail_simpanankhusus']->waktu;
					$data_kredit['kode_akun'] 		= $mapping_kode_akun->kode_kredit;
					$data_kredit['nama_akun'] 		= $kredit->nama_akun;
					$data_kredit['keterangan'] 		= "Simpanan Khusus Bulan ".$bulan_tahun." a.n. ".$data['simpanankhusus']->nama_nasabah." Nomor : ".$data['simpanankhusus']->nomor_nasabah." Tanggal Simpanan: ".date("d-m-Y", strtotime($data['simpanankhusus']->waktu));
					$data_kredit['jumlah'] 			= $data['post_detail_simpanankhusus']->jumlah;
					$data_kredit['debet'] 			= 0;
					$data_kredit['kredit'] 			= $data['post_detail_simpanankhusus']->jumlah;
					$data_kredit['origin_table']	= 'detail_simpanankhusus';
					$data_kredit['origin_table_id']	= $data['post_detail_simpanankhusus']->id;
					$this->transaksiakuntansimodel->inputData($data_kredit);

					$update = array();
					$id 									= $data['post_detail_simpanankhusus']->id;
					$update['id_simpanankhusus'] 			= $data['post_detail_simpanankhusus']->id_simpanankhusus;
					$update['waktu'] 						= $data['post_detail_simpanankhusus']->waktu;
					$update['jenis'] 						= $data['post_detail_simpanankhusus']->jenis;
					$update['bulan_tahun'] 					= $data['post_detail_simpanankhusus']->bulan_tahun;
					$update['jumlah'] 						= $data['post_detail_simpanankhusus']->jumlah;
					$update['status_post'] 					= 1;
					$update['id_debet_transaksi_akuntansi']	= $data_debet['id'];
					$update['id_kredit_transaksi_akuntansi']= $data_kredit['id'];
					$this->detailsimpanankhususmodel->updateData($id, $update);
				}
			} else if($data['post_detail_simpanankhusus']->jenis == "Tarikan") {
				$mapping_kode_akun = $this->mappingkodeakunmodel->get_mapping_kode_akun_by_nama_transaksi('pencairan simpanan kusus');
				$debet 		= $this->kodeakunmodel->get_kode_akun_by_kode($mapping_kode_akun->kode_debet);
				$kredit 	= $this->kodeakunmodel->get_kode_akun_by_kode($mapping_kode_akun->kode_kredit);
				$bln_thn = strtotime( $data['post_detail_simpanankhusus']->bulan_tahun );
	            $bulan_tahun = date( 'M-Y', $bln_thn );

	            if(substr($data['simpanankhusus']->nomor_nasabah, 0, 1) == '1') {
	            	$data_debet 					= array();
					$data_debet['id'] 				= $this->transaksiakuntansimodel->getNewId();
					$data_debet['tanggal'] 			= $data['post_detail_simpanankhusus']->waktu;
					$data_debet['kode_akun'] 		= $mapping_kode_akun->kode_debet;
					$data_debet['nama_akun'] 		= $debet->nama_akun;
					$data_debet['keterangan'] 		= "Pencairan Simpanan Khusus Bulan ".$bulan_tahun." Anggota a.n. ".$data['simpanankhusus']->nama_nasabah." Nomor Anggota: ".$data['simpanankhusus']->nomor_nasabah." Tanggal Simpanan: ".date("d-m-Y", strtotime($data['simpanankhusus']->waktu));
					$data_debet['jumlah'] 			= $data['post_detail_simpanankhusus']->jumlah;
					$data_debet['debet'] 			= $data['post_detail_simpanankhusus']->jumlah;
					$data_debet['kredit'] 			= 0;
					$data_debet['origin_table']		= 'detail_simpanankhusus';
					$data_debet['origin_table_id']	= $data['post_detail_simpanankhusus']->id;
					$this->transaksiakuntansimodel->inputData($data_debet);

					$data_kredit 					= array();
					$data_kredit['id'] 				= $this->transaksiakuntansimodel->getNewId();
					$data_kredit['tanggal'] 		= $data['post_detail_simpanankhusus']->waktu;
					$data_kredit['kode_akun'] 		= $mapping_kode_akun->kode_kredit;
					$data_kredit['nama_akun'] 		= $kredit->nama_akun;
					$data_kredit['keterangan'] 		= "Pencairan Simpanan Khusus Bulan ".$bulan_tahun." Anggota a.n. ".$data['simpanankhusus']->nama_nasabah." Nomor Anggota: ".$data['simpanankhusus']->nomor_nasabah." Tanggal Simpanan: ".date("d-m-Y", strtotime($data['simpanankhusus']->waktu));
					$data_kredit['jumlah'] 			= $data['post_detail_simpanankhusus']->jumlah;
					$data_kredit['debet'] 			= 0;
					$data_kredit['kredit'] 			= $data['post_detail_simpanankhusus']->jumlah;
					$data_kredit['origin_table']	= 'detail_simpanankhusus';
					$data_kredit['origin_table_id']	= $data['post_detail_simpanankhusus']->id;
					$this->transaksiakuntansimodel->inputData($data_kredit);
	            } else {
	            	$data_debet 					= array();
					$data_debet['id'] 				= $this->transaksiakuntansimodel->getNewId();
					$data_debet['tanggal'] 			= $data['post_detail_simpanankhusus']->waktu;
					$data_debet['kode_akun'] 		= $mapping_kode_akun->kode_debet;
					$data_debet['nama_akun'] 		= $debet->nama_akun;
					$data_debet['keterangan'] 		= "Pencairan Simpanan Khusus Bulan ".$bulan_tahun." a.n. ".$data['simpanankhusus']->nama_nasabah." Nomor : ".$data['simpanankhusus']->nomor_nasabah." Tanggal Simpanan: ".date("d-m-Y", strtotime($data['simpanankhusus']->waktu));
					$data_debet['jumlah'] 			= $data['post_detail_simpanankhusus']->jumlah;
					$data_debet['debet'] 			= $data['post_detail_simpanankhusus']->jumlah;
					$data_debet['kredit'] 			= 0;
					$data_debet['origin_table']		= 'detail_simpanankhusus';
					$data_debet['origin_table_id']	= $data['post_detail_simpanankhusus']->id;
					$this->transaksiakuntansimodel->inputData($data_debet);

					$data_kredit 					= array();
					$data_kredit['id'] 				= $this->transaksiakuntansimodel->getNewId();
					$data_kredit['tanggal'] 		= $data['post_detail_simpanankhusus']->waktu;
					$data_kredit['kode_akun'] 		= $mapping_kode_akun->kode_kredit;
					$data_kredit['nama_akun'] 		= $kredit->nama_akun;
					$data_kredit['keterangan'] 		= "Pencairan Simpanan Khusus Bulan ".$bulan_tahun." a.n. ".$data['simpanankhusus']->nama_nasabah." Nomor : ".$data['simpanankhusus']->nomor_nasabah." Tanggal Simpanan: ".date("d-m-Y", strtotime($data['simpanankhusus']->waktu));
					$data_kredit['jumlah'] 			= $data['post_detail_simpanankhusus']->jumlah;
					$data_kredit['debet'] 			= 0;
					$data_kredit['kredit'] 			= $data['post_detail_simpanankhusus']->jumlah;
					$data_kredit['origin_table']	= 'detail_simpanankhusus';
					$data_kredit['origin_table_id']	= $data['post_detail_simpanankhusus']->id;
					$this->transaksiakuntansimodel->inputData($data_kredit);
	            }
	            
				$update = array();
				$id 									= $data['post_detail_simpanankhusus']->id;
				$update['id_simpanankhusus'] 			= $data['post_detail_simpanankhusus']->id_simpanankhusus;
				$update['waktu'] 						= $data['post_detail_simpanankhusus']->waktu;
				$update['jenis'] 						= $data['post_detail_simpanankhusus']->jenis;
				$update['bulan_tahun'] 					= $data['post_detail_simpanankhusus']->bulan_tahun;
				$update['jumlah'] 						= $data['post_detail_simpanankhusus']->jumlah;
				$update['keterangan']					= $data['post_detail_simpanankhusus']->keterangan;
				$update['status_post'] 					= 1;
				$update['id_debet_transaksi_akuntansi']	= $data_debet['id'];
				$update['id_kredit_transaksi_akuntansi']= $data_kredit['id'];
				$this->detailsimpanankhususmodel->updateData($id, $update);
			}
		}

		redirect('transaksianggotacon/view_simpanankhusus/'.$id_simpanankhusus);
	}

	function simpanankhusus_unpost_akuntansi($id_simpanankhusus, $id_detail_simpanankhusus) {
		$session_data = $this->session->userdata('mubasyirin_logged_in');
		if($session_data == NULL) {
			redirect("usercon/login", "refresh");
		}

		$data['simpanankhusus'] 			= $this->simpanankhususmodel->get_simpanankhusus_by_id($id_simpanankhusus);
		$data['post_detail_simpanankhusus'] = $this->detailsimpanankhususmodel->get_detail_simpanankhusus_by_id($id_detail_simpanankhusus);

		$id_debet_transaksi_akuntansi 	= $data['post_detail_simpanankhusus']->id_debet_transaksi_akuntansi;
		$id_kredit_transaksi_akuntansi 	= $data['post_detail_simpanankhusus']->id_kredit_transaksi_akuntansi;

		$this->transaksiakuntansimodel->deleteData($id_debet_transaksi_akuntansi);
		$this->transaksiakuntansimodel->deleteData($id_kredit_transaksi_akuntansi);

		$update = array();
		$id 									= $data['post_detail_simpanankhusus']->id;
		$update['id_simpanankhusus'] 			= $data['post_detail_simpanankhusus']->id_simpanankhusus;
		$update['waktu'] 						= $data['post_detail_simpanankhusus']->waktu;
		$update['jenis'] 						= $data['post_detail_simpanankhusus']->jenis;
		$update['bulan_tahun'] 					= $data['post_detail_simpanankhusus']->bulan_tahun;
		$update['jumlah'] 						= $data['post_detail_simpanankhusus']->jumlah;
		$update['keterangan']					= $data['post_detail_simpanankhusus']->keterangan;
		$update['status_post'] 					= 0;
		$update['id_debet_transaksi_akuntansi']	= 0;
		$update['id_kredit_transaksi_akuntansi']= 0;
		$this->detailsimpanankhususmodel->updateData($id, $update);

		redirect('transaksianggotacon/view_simpanankhusus/'.$id_simpanankhusus);
	}
	/*** End of Transaksi Simpanan Khusus ***/

	/*** Transaksi Simpanan Dana Sosial ***/
	function simpanandanasosial($id_nasabah) {
		$session_data = $this->session->userdata('mubasyirin_logged_in');
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
		$data['aset_kekayaan']		= $this->asetkekayaanmodel->get_asetkekayaan_by_id_nasabah($id_nasabah);
		$data['username'] 			= $session_data['username'];
		$data['status'] 			= $session_data['status'];

		$this->load->view('/layouts/menu', $data);
		$this->load->view('/transaksianggota/index_simpanandanasosial', $data);
		$this->load->view('/layouts/footer', $data);
	}

	function create_simpanandanasosial($id_nasabah) {
		$session_data = $this->session->userdata('mubasyirin_logged_in');
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
		$data['aset_kekayaan']		= $this->asetkekayaanmodel->get_asetkekayaan_by_id_nasabah($id_nasabah);
		$data['username'] 			= $session_data['username'];
		$data['status'] 			= $session_data['status'];

		$this->load->view('/layouts/menu', $data);
		$this->load->view('/transaksianggota/create_simpanandanasosial', $data);
		$this->load->view('/layouts/footer', $data);
	}

	function insert_simpanandanasosial($id_nasabah) {
		$session_data = $this->session->userdata('mubasyirin_logged_in');
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

		redirect('transaksianggotacon/simpanandanasosial/'.$id_nasabah);
	}

	function edit_simpanandanasosial($id_simpanandanasosial) {
		$session_data = $this->session->userdata('mubasyirin_logged_in');
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
		$data['aset_kekayaan']		= $this->asetkekayaanmodel->get_asetkekayaan_by_id_nasabah($id_nasabah);
		$data['username'] 			= $session_data['username'];
		$data['status'] 			= $session_data['status'];
		
		$this->load->view('/layouts/menu', $data);
		$this->load->view('/transaksianggota/edit_simpanandanasosial', $data);
		$this->load->view('/layouts/footer', $data);
	}

	function update_simpanandanasosial() {
		$session_data = $this->session->userdata('mubasyirin_logged_in');
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
		$session_data = $this->session->userdata('mubasyirin_logged_in');
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
		$session_data = $this->session->userdata('mubasyirin_logged_in');
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
		$data['aset_kekayaan']		= $this->asetkekayaanmodel->get_asetkekayaan_by_id_nasabah($id_nasabah);
		$data['username'] 					= $session_data['username'];
		$data['status'] 					= $session_data['status'];
		
		$this->load->view('/layouts/menu', $data);
		$this->load->view('/transaksianggota/view_simpanandanasosial', $data);
		$this->load->view('/layouts/footer', $data);
	}

	function insert_detail_simpanandanasosial() {
		$session_data = $this->session->userdata('mubasyirin_logged_in');
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
		$session_data = $this->session->userdata('mubasyirin_logged_in');
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
		$data['aset_kekayaan']		= $this->asetkekayaanmodel->get_asetkekayaan_by_id_nasabah($id_nasabah);
		$data['username'] 						= $session_data['username'];
		$data['status'] 						= $session_data['status'];

		$this->load->view('/layouts/menu', $data);
		$this->load->view('/transaksianggota/view_simpanandanasosial_edit_detail', $data);
		$this->load->view('/layouts/footer', $data);	
	}

	function update_detail_simpanandanasosial() {
		$session_data = $this->session->userdata('mubasyirin_logged_in');
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
		$session_data = $this->session->userdata('mubasyirin_logged_in');
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

	function simpanandanasosial_post_akuntansi($id_simpanandanasosial, $id_detail_simpanandanasosial) {
		$session_data = $this->session->userdata('mubasyirin_logged_in');
		if($session_data == NULL) {
			redirect("usercon/login", "refresh");
		}

		$data['simpanandanasosial'] 			= $this->simpanandanasosialmodel->get_simpanandanasosial_by_id($id_simpanandanasosial);
		$data['post_detail_simpanandanasosial'] = $this->detailsimpanandanasosialmodel->get_detail_simpanandanasosial_by_id($id_detail_simpanandanasosial);

		if($data['post_detail_simpanandanasosial']->status_post != '1') {
			if($data['post_detail_simpanandanasosial']->jenis == "Setoran") {
				if(substr($data['simpanandanasosial']->nomor_nasabah, 0, 1) == "1") {
					$mapping_kode_akun = $this->mappingkodeakunmodel->get_mapping_kode_akun_by_nama_transaksi('penerimaan simp dansos anggota');	
				} else if (substr($data['simpanandanasosial']->nomor_nasabah, 0, 1) == "2") {
					$mapping_kode_akun = $this->mappingkodeakunmodel->get_mapping_kode_akun_by_nama_transaksi('penerimaan simpanan dansos anggota istimewa');
				}
				$debet 		= $this->kodeakunmodel->get_kode_akun_by_kode($mapping_kode_akun->kode_debet);
				$kredit 	= $this->kodeakunmodel->get_kode_akun_by_kode($mapping_kode_akun->kode_kredit);
				$bln_thn = strtotime( $data['post_detail_simpanandanasosial']->bulan_tahun );
				$bulan_tahun = date( 'M-Y', $bln_thn );

				$data_debet 					= array();
				$data_debet['id'] 				= $this->transaksiakuntansimodel->getNewId();
				$data_debet['tanggal'] 			= $data['post_detail_simpanandanasosial']->waktu;
				$data_debet['kode_akun'] 		= $mapping_kode_akun->kode_debet;
				$data_debet['nama_akun'] 		= $debet->nama_akun;
				if(substr($data['simpanandanasosial']->nomor_nasabah, 0, 1) == "1") {
					$data_debet['keterangan'] 	= "Simpanan Dana Sosial Bulan ".$bulan_tahun." Anggota a.n. ".$data['simpanandanasosial']->nama_nasabah." Nomor Anggota: ".$data['simpanandanasosial']->nomor_nasabah." Tanggal Simpanan: ".date("d-m-Y", strtotime($data['simpanandanasosial']->waktu));
				} else if(substr($data['simpanandanasosial']->nomor_nasabah, 0, 1) == "2") {
					$data_debet['keterangan'] 	= "Simpanan Dana Sosial Istimewa Bulan ".$bulan_tahun." a.n. ".$data['simpanandanasosial']->nama_nasabah." Nomor: ".$data['simpanandanasosial']->nomor_nasabah." Tanggal Simpanan: ".date("d-m-Y", strtotime($data['simpanandanasosial']->waktu));
				}
				$data_debet['jumlah'] 			= $data['post_detail_simpanandanasosial']->jumlah;
				$data_debet['debet'] 			= $data['post_detail_simpanandanasosial']->jumlah;
				$data_debet['kredit'] 			= 0;
				$data_debet['origin_table']		= 'detail_simpanandanasosial';
				$data_debet['origin_table_id']	= $data['post_detail_simpanandanasosial']->id;
				$this->transaksiakuntansimodel->inputData($data_debet);

				$data_kredit 					= array();
				$data_kredit['id'] 				= $this->transaksiakuntansimodel->getNewId();
				$data_kredit['tanggal'] 		= $data['post_detail_simpanandanasosial']->waktu;
				$data_kredit['kode_akun'] 		= $mapping_kode_akun->kode_kredit;
				$data_kredit['nama_akun'] 		= $kredit->nama_akun;
				if(substr($data['simpanandanasosial']->nomor_nasabah, 0, 1) == "1") {
					$data_kredit['keterangan'] 	= "Simpanan Dana Sosial Bulan ".$bulan_tahun." Anggota a.n. ".$data['simpanandanasosial']->nama_nasabah." Nomor Anggota: ".$data['simpanandanasosial']->nomor_nasabah." Tanggal Simpanan: ".date("d-m-Y", strtotime($data['simpanandanasosial']->waktu));
				} else if(substr($data['simpanandanasosial']->nomor_nasabah, 0, 1) == "2") {
					$data_kredit['keterangan'] 	= "Simpanan Dana Sosial Istimewa Bulan ".$bulan_tahun." a.n. ".$data['simpanandanasosial']->nama_nasabah." Nomor: ".$data['simpanandanasosial']->nomor_nasabah." Tanggal Simpanan: ".date("d-m-Y", strtotime($data['simpanandanasosial']->waktu));
				}
				$data_kredit['jumlah'] 			= $data['post_detail_simpanandanasosial']->jumlah;
				$data_kredit['debet'] 			= 0;
				$data_kredit['kredit'] 			= $data['post_detail_simpanandanasosial']->jumlah;
				$data_kredit['origin_table']	= 'detail_simpanandanasosial';
				$data_kredit['origin_table_id']	= $data['post_detail_simpanandanasosial']->id;
				$this->transaksiakuntansimodel->inputData($data_kredit);

				$update = array();
				$id 									= $data['post_detail_simpanandanasosial']->id;
				$update['id_simpanandanasosial'] 		= $data['post_detail_simpanandanasosial']->id_simpanandanasosial;
				$update['waktu'] 						= $data['post_detail_simpanandanasosial']->waktu;
				$update['jenis'] 						= $data['post_detail_simpanandanasosial']->jenis;
				$update['bulan_tahun'] 					= $data['post_detail_simpanandanasosial']->bulan_tahun;
				$update['jumlah'] 						= $data['post_detail_simpanandanasosial']->jumlah;
				$update['status_post'] 					= 1;
				$update['id_debet_transaksi_akuntansi']	= $data_debet['id'];
				$update['id_kredit_transaksi_akuntansi']= $data_kredit['id'];
				$this->detailsimpanandanasosialmodel->updateData($id, $update);
			} else if($data['post_detail_simpanandanasosial']->jenis == "Tarikan") {
				if(substr($data['simpanandanasosial']->nomor_nasabah, 0, 1) == "1") {
					$mapping_kode_akun = $this->mappingkodeakunmodel->get_mapping_kode_akun_by_nama_transaksi('pencairan simp dansos anggota');	
				} else if (substr($data['simpanandanasosial']->nomor_nasabah, 0, 1) == "2") {
					$mapping_kode_akun = $this->mappingkodeakunmodel->get_mapping_kode_akun_by_nama_transaksi('pencairan simpanan dansos anggota istimewa');
				}
				$debet 		= $this->kodeakunmodel->get_kode_akun_by_kode($mapping_kode_akun->kode_debet);
				$kredit 	= $this->kodeakunmodel->get_kode_akun_by_kode($mapping_kode_akun->kode_kredit);
				$bln_thn = strtotime( $data['post_detail_simpanandanasosial']->bulan_tahun );
				$bulan_tahun = date( 'M-Y', $bln_thn );

				$data_debet 					= array();
				$data_debet['id'] 				= $this->transaksiakuntansimodel->getNewId();
				$data_debet['tanggal'] 			= $data['post_detail_simpanandanasosial']->waktu;
				$data_debet['kode_akun'] 		= $mapping_kode_akun->kode_debet;
				$data_debet['nama_akun'] 		= $debet->nama_akun;
				if(substr($data['simpanandanasosial']->nomor_nasabah, 0, 1) == "1") {
					$data_debet['keterangan'] 	= "Pencairan Simpanan Dana Sosial Bulan ".$bulan_tahun." Anggota a.n. ".$data['simpanandanasosial']->nama_nasabah." Nomor Anggota: ".$data['simpanandanasosial']->nomor_nasabah." Tanggal Simpanan: ".date("d-m-Y", strtotime($data['simpanandanasosial']->waktu));
				} else if(substr($data['simpanandanasosial']->nomor_nasabah, 0, 1) == "2") {
					$data_debet['keterangan'] 	= "Pencairan Simpanan Dana Sosial Istimewa Bulan ".$bulan_tahun." a.n. ".$data['simpanandanasosial']->nama_nasabah." Nomor: ".$data['simpanandanasosial']->nomor_nasabah." Tanggal Simpanan: ".date("d-m-Y", strtotime($data['simpanandanasosial']->waktu));
				}
				$data_debet['jumlah'] 			= $data['post_detail_simpanandanasosial']->jumlah;
				$data_debet['debet'] 			= $data['post_detail_simpanandanasosial']->jumlah;
				$data_debet['kredit'] 			= 0;
				$data_debet['origin_table']		= 'detail_simpanandanasosial';
				$data_debet['origin_table_id']	= $data['post_detail_simpanandanasosial']->id;
				$this->transaksiakuntansimodel->inputData($data_debet);

				$data_kredit 					= array();
				$data_kredit['id'] 				= $this->transaksiakuntansimodel->getNewId();
				$data_kredit['tanggal'] 		= $data['post_detail_simpanandanasosial']->waktu;
				$data_kredit['kode_akun'] 		= $mapping_kode_akun->kode_kredit;
				$data_kredit['nama_akun'] 		= $kredit->nama_akun;
				if(substr($data['simpanandanasosial']->nomor_nasabah, 0, 1) == "1") {
					$data_kredit['keterangan'] 	= "Pencairan Simpanan Dana Sosial Bulan ".$bulan_tahun." Anggota a.n. ".$data['simpanandanasosial']->nama_nasabah." Nomor Anggota: ".$data['simpanandanasosial']->nomor_nasabah." Tanggal Simpanan: ".date("d-m-Y", strtotime($data['simpanandanasosial']->waktu));
				} else if(substr($data['simpanandanasosial']->nomor_nasabah, 0, 1) == "2") {
					$data_kredit['keterangan'] 	= "Pencairan Simpanan Dana Sosial Istimewa Bulan ".$bulan_tahun." a.n. ".$data['simpanandanasosial']->nama_nasabah." Nomor: ".$data['simpanandanasosial']->nomor_nasabah." Tanggal Simpanan: ".date("d-m-Y", strtotime($data['simpanandanasosial']->waktu));
				}
				$data_kredit['jumlah'] 			= $data['post_detail_simpanandanasosial']->jumlah;
				$data_kredit['debet'] 			= 0;
				$data_kredit['kredit'] 			= $data['post_detail_simpanandanasosial']->jumlah;
				$data_kredit['origin_table']	= 'detail_simpanandanasosial';
				$data_kredit['origin_table_id']	= $data['post_detail_simpanandanasosial']->id;
				$this->transaksiakuntansimodel->inputData($data_kredit);

				$update = array();
				$id 									= $data['post_detail_simpanandanasosial']->id;
				$update['id_simpanandanasosial'] 		= $data['post_detail_simpanandanasosial']->id_simpanandanasosial;
				$update['waktu'] 						= $data['post_detail_simpanandanasosial']->waktu;
				$update['jenis'] 						= $data['post_detail_simpanandanasosial']->jenis;
				$update['bulan_tahun'] 					= $data['post_detail_simpanandanasosial']->bulan_tahun;
				$update['jumlah'] 						= $data['post_detail_simpanandanasosial']->jumlah;
				$update['status_post'] 					= 1;
				$update['id_debet_transaksi_akuntansi']	= $data_debet['id'];
				$update['id_kredit_transaksi_akuntansi']= $data_kredit['id'];
				$this->detailsimpanandanasosialmodel->updateData($id, $update);
			}	
		}
		
		redirect('transaksianggotacon/view_simpanandanasosial/'.$id_simpanandanasosial);
	}

	function simpanandanasosial_unpost_akuntansi($id_simpanandanasosial, $id_detail_simpanandanasosial) {
		$session_data = $this->session->userdata('mubasyirin_logged_in');
		if($session_data == NULL) {
			redirect("usercon/login", "refresh");
		}

		$data['simpanandanasosial'] 			= $this->simpanandanasosialmodel->get_simpanandanasosial_by_id($id_simpanandanasosial);
		$data['post_detail_simpanandanasosial'] = $this->detailsimpanandanasosialmodel->get_detail_simpanandanasosial_by_id($id_detail_simpanandanasosial);

		$id_debet_transaksi_akuntansi 	= $data['post_detail_simpanandanasosial']->id_debet_transaksi_akuntansi;
		$id_kredit_transaksi_akuntansi 	= $data['post_detail_simpanandanasosial']->id_kredit_transaksi_akuntansi;

		$this->transaksiakuntansimodel->deleteData($id_debet_transaksi_akuntansi);
		$this->transaksiakuntansimodel->deleteData($id_kredit_transaksi_akuntansi);

		$update = array();
		$id 									= $data['post_detail_simpanandanasosial']->id;
		$update['id_simpanandanasosial'] 		= $data['post_detail_simpanandanasosial']->id_simpanandanasosial;
		$update['waktu'] 						= $data['post_detail_simpanandanasosial']->waktu;
		$update['jenis'] 						= $data['post_detail_simpanandanasosial']->jenis;
		$update['bulan_tahun'] 					= $data['post_detail_simpanandanasosial']->bulan_tahun;
		$update['jumlah'] 						= $data['post_detail_simpanandanasosial']->jumlah;
		$update['status_post'] 					= 0;
		$update['id_debet_transaksi_akuntansi']	= 0;
		$update['id_kredit_transaksi_akuntansi']= 0;
		$this->detailsimpanandanasosialmodel->updateData($id, $update);

		redirect('transaksianggotacon/view_simpanandanasosial/'.$id_simpanandanasosial);
	}
	/*** End of Transaksi Simpanan Dana Sosial ***/

	/*** Transaksi Simpanan Kanzun ***/
	function simpanankanzun($id_nasabah) {
		$session_data = $this->session->userdata('mubasyirin_logged_in');
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
		$data['aset_kekayaan']		= $this->asetkekayaanmodel->get_asetkekayaan_by_id_nasabah($id_nasabah);
		$data['username'] 			= $session_data['username'];
		$data['status'] 			= $session_data['status'];

		$this->load->view('/layouts/menu', $data);
		$this->load->view('/transaksianggota/index_simpanankanzun', $data);
		$this->load->view('/layouts/footer', $data);
	}

	function create_simpanankanzun($id_nasabah) {
		$session_data = $this->session->userdata('mubasyirin_logged_in');
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
		$data['aset_kekayaan']		= $this->asetkekayaanmodel->get_asetkekayaan_by_id_nasabah($id_nasabah);
		$data['username'] 			= $session_data['username'];
		$data['status'] 			= $session_data['status'];

		$this->load->view('/layouts/menu', $data);
		$this->load->view('/transaksianggota/create_simpanankanzun', $data);
		$this->load->view('/layouts/footer', $data);
	}

	function insert_simpanankanzun($id_nasabah) {
		$session_data = $this->session->userdata('mubasyirin_logged_in');
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
		$session_data = $this->session->userdata('mubasyirin_logged_in');
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
		$data['aset_kekayaan']		= $this->asetkekayaanmodel->get_asetkekayaan_by_id_nasabah($id_nasabah);
		$data['username'] 			= $session_data['username'];
		$data['status'] 			= $session_data['status'];
		
		$this->load->view('/layouts/menu', $data);
		$this->load->view('/transaksianggota/edit_simpanankanzun', $data);
		$this->load->view('/layouts/footer', $data);
	}

	function update_simpanankanzun() {
		$session_data = $this->session->userdata('mubasyirin_logged_in');
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
		$session_data = $this->session->userdata('mubasyirin_logged_in');
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
		$session_data = $this->session->userdata('mubasyirin_logged_in');
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
		$data['aset_kekayaan']		= $this->asetkekayaanmodel->get_asetkekayaan_by_id_nasabah($id_nasabah);
		$data['username'] 				= $session_data['username'];
		$data['status'] 				= $session_data['status'];
		
		$this->load->view('/layouts/menu', $data);
		$this->load->view('/transaksianggota/view_simpanankanzun', $data);
		$this->load->view('/layouts/footer', $data);
	}

	function insert_detail_simpanankanzun() {
		$session_data = $this->session->userdata('mubasyirin_logged_in');
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
		$data['aset_kekayaan']		= $this->asetkekayaanmodel->get_asetkekayaan_by_id_nasabah($id_nasabah);
		$data['username'] 					= $session_data['username'];
		$data['status'] 					= $session_data['status'];

		$this->load->view('/layouts/menu', $data);
		$this->load->view('/transaksianggota/view_simpanankanzun_edit_detail', $data);
		$this->load->view('/layouts/footer', $data);	
	}

	function update_detail_simpanankanzun() {
		$session_data = $this->session->userdata('mubasyirin_logged_in');
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

		redirect('transaksianggotacon/view_simpanankanzun/'.$id_simpanankanzun);
	}

	function simpanankanzun_post_akuntansi($id_simpanankanzun, $id_detail_simpanankanzun) {
		$session_data = $this->session->userdata('mubasyirin_logged_in');
		if($session_data == NULL) {
			redirect("usercon/login", "refresh");
		}

		$data['simpanankanzun'] 			= $this->simpanankanzunmodel->get_simpanankanzun_by_id($id_simpanankanzun);
		$data['post_detail_simpanankanzun'] = $this->detailsimpanankanzunmodel->get_detail_simpanankanzun_by_id($id_detail_simpanankanzun);

		if($data['post_detail_simpanankanzun']->status_post != '1') {
			if($data['post_detail_simpanankanzun']->jenis == "Setoran") {
				$mapping_kode_akun = $this->mappingkodeakunmodel->get_mapping_kode_akun_by_nama_transaksi('penerimaan kanzun');
				$debet 		= $this->kodeakunmodel->get_kode_akun_by_kode($mapping_kode_akun->kode_debet);
				$kredit 	= $this->kodeakunmodel->get_kode_akun_by_kode($mapping_kode_akun->kode_kredit);
				$bln_thn = strtotime( $data['post_detail_simpanankanzun']->bulan_tahun );
	            $bulan_tahun = date( 'M-Y', $bln_thn );

	            $data_debet 					= array();
				$data_debet['id'] 				= $this->transaksiakuntansimodel->getNewId();
				$data_debet['tanggal'] 			= $data['post_detail_simpanankanzun']->waktu;
				$data_debet['kode_akun'] 		= $mapping_kode_akun->kode_debet;
				$data_debet['nama_akun'] 		= $debet->nama_akun;
				$data_debet['keterangan'] 		= "Simpanan Kanzun Bulan ".$bulan_tahun." Anggota a.n. ".$data['simpanankanzun']->nama_nasabah." Nomor Anggota: ".$data['simpanankanzun']->nomor_nasabah." Tanggal Simpanan: ".date("d-m-Y", strtotime($data['simpanankanzun']->waktu));
				$data_debet['jumlah'] 			= $data['post_detail_simpanankanzun']->jumlah;
				$data_debet['debet'] 			= $data['post_detail_simpanankanzun']->jumlah;
				$data_debet['kredit'] 			= 0;
				$data_debet['origin_table']		= 'detail_simpanankanzun';
				$data_debet['origin_table_id']	= $data['post_detail_simpanankanzun']->id;
				$this->transaksiakuntansimodel->inputData($data_debet);

				$data_kredit 					= array();
				$data_kredit['id'] 				= $this->transaksiakuntansimodel->getNewId();
				$data_kredit['tanggal'] 		= $data['post_detail_simpanankanzun']->waktu;
				$data_kredit['kode_akun'] 		= $mapping_kode_akun->kode_kredit;
				$data_kredit['nama_akun'] 		= $kredit->nama_akun;
				$data_kredit['keterangan'] 		= "Simpanan Kanzun Bulan ".$bulan_tahun." Anggota a.n. ".$data['simpanankanzun']->nama_nasabah." Nomor Anggota: ".$data['simpanankanzun']->nomor_nasabah." Tanggal Simpanan: ".date("d-m-Y", strtotime($data['simpanankanzun']->waktu));
				$data_kredit['jumlah'] 			= $data['post_detail_simpanankanzun']->jumlah;
				$data_kredit['debet'] 			= 0;
				$data_kredit['kredit'] 			= $data['post_detail_simpanankanzun']->jumlah;
				$data_kredit['origin_table']	= 'detail_simpanankanzun';
				$data_kredit['origin_table_id']	= $data['post_detail_simpanankanzun']->id;
				$this->transaksiakuntansimodel->inputData($data_kredit);

				$update = array();
				$id 									= $data['post_detail_simpanankanzun']->id;
				$update['id_simpanankanzun'] 			= $data['post_detail_simpanankanzun']->id_simpanankanzun;
				$update['waktu'] 						= $data['post_detail_simpanankanzun']->waktu;
				$update['jenis'] 						= $data['post_detail_simpanankanzun']->jenis;
				$update['bulan_tahun'] 					= $data['post_detail_simpanankanzun']->bulan_tahun;
				$update['jumlah'] 						= $data['post_detail_simpanankanzun']->jumlah;
				$update['status_post'] 					= 1;
				$update['id_debet_transaksi_akuntansi']	= $data_debet['id'];
				$update['id_kredit_transaksi_akuntansi']= $data_kredit['id'];
				$this->detailsimpanankanzunmodel->updateData($id, $update);
			} else if($data['post_detail_simpanankanzun']->jenis == "Tarikan") {
				$mapping_kode_akun = $this->mappingkodeakunmodel->get_mapping_kode_akun_by_nama_transaksi('pencairan hutang kanzun');
				$debet 		= $this->kodeakunmodel->get_kode_akun_by_kode($mapping_kode_akun->kode_debet);
				$kredit 	= $this->kodeakunmodel->get_kode_akun_by_kode($mapping_kode_akun->kode_kredit);
				$bln_thn = strtotime( $data['post_detail_simpanankanzun']->bulan_tahun );
	            $bulan_tahun = date( 'M-Y', $bln_thn );

	            $data_debet 					= array();
				$data_debet['id'] 				= $this->transaksiakuntansimodel->getNewId();
				$data_debet['tanggal'] 			= $data['post_detail_simpanankanzun']->waktu;
				$data_debet['kode_akun'] 		= $mapping_kode_akun->kode_debet;
				$data_debet['nama_akun'] 		= $debet->nama_akun;
				$data_debet['keterangan'] 		= "Pencairan Simpanan Kanzun Bulan ".$bulan_tahun." Anggota a.n. ".$data['simpanankanzun']->nama_nasabah." Nomor Anggota: ".$data['simpanankanzun']->nomor_nasabah." Tanggal Simpanan: ".date("d-m-Y", strtotime($data['simpanankanzun']->waktu));
				$data_debet['jumlah'] 			= $data['post_detail_simpanankanzun']->jumlah;
				$data_debet['debet'] 			= $data['post_detail_simpanankanzun']->jumlah;
				$data_debet['kredit'] 			= 0;
				$data_debet['origin_table']		= 'detail_simpanankanzun';
				$data_debet['origin_table_id']	= $data['post_detail_simpanankanzun']->id;
				$this->transaksiakuntansimodel->inputData($data_debet);

				$data_kredit 					= array();
				$data_kredit['id'] 				= $this->transaksiakuntansimodel->getNewId();
				$data_kredit['tanggal'] 		= $data['post_detail_simpanankanzun']->waktu;
				$data_kredit['kode_akun'] 		= $mapping_kode_akun->kode_kredit;
				$data_kredit['nama_akun'] 		= $kredit->nama_akun;
				$data_kredit['keterangan'] 		= "Pencairan Simpanan Kanzun Bulan ".$bulan_tahun." Anggota a.n. ".$data['simpanankanzun']->nama_nasabah." Nomor Anggota: ".$data['simpanankanzun']->nomor_nasabah." Tanggal Simpanan: ".date("d-m-Y", strtotime($data['simpanankanzun']->waktu));
				$data_kredit['jumlah'] 			= $data['post_detail_simpanankanzun']->jumlah;
				$data_kredit['debet'] 			= 0;
				$data_kredit['kredit'] 			= $data['post_detail_simpanankanzun']->jumlah;
				$data_kredit['origin_table']	= 'detail_simpanankanzun';
				$data_kredit['origin_table_id']	= $data['post_detail_simpanankanzun']->id;
				$this->transaksiakuntansimodel->inputData($data_kredit);

				$update = array();
				$id 									= $data['post_detail_simpanankanzun']->id;
				$update['id_simpanankanzun'] 			= $data['post_detail_simpanankanzun']->id_simpanankanzun;
				$update['waktu'] 						= $data['post_detail_simpanankanzun']->waktu;
				$update['jenis'] 						= $data['post_detail_simpanankanzun']->jenis;
				$update['bulan_tahun'] 					= $data['post_detail_simpanankanzun']->bulan_tahun;
				$update['jumlah'] 						= $data['post_detail_simpanankanzun']->jumlah;
				$update['status_post'] 					= 1;
				$update['id_debet_transaksi_akuntansi']	= $data_debet['id'];
				$update['id_kredit_transaksi_akuntansi']= $data_kredit['id'];
				$this->detailsimpanankanzunmodel->updateData($id, $update);
			}
		}
		
		redirect('transaksianggotacon/view_simpanankanzun/'.$id_simpanankanzun);
	}

	function simpanankanzun_unpost_akuntansi($id_simpanankanzun, $id_detail_simpanankanzun) {
		$session_data = $this->session->userdata('mubasyirin_logged_in');
		if($session_data == NULL) {
			redirect("usercon/login", "refresh");
		}

		$data['simpanankanzun'] 			= $this->simpanankanzunmodel->get_simpanankanzun_by_id($id_simpanankanzun);
		$data['post_detail_simpanankanzun'] = $this->detailsimpanankanzunmodel->get_detail_simpanankanzun_by_id($id_detail_simpanankanzun);

		$id_debet_transaksi_akuntansi 	= $data['post_detail_simpanankanzun']->id_debet_transaksi_akuntansi;
		$id_kredit_transaksi_akuntansi 	= $data['post_detail_simpanankanzun']->id_kredit_transaksi_akuntansi;

		$this->transaksiakuntansimodel->deleteData($id_debet_transaksi_akuntansi);
		$this->transaksiakuntansimodel->deleteData($id_kredit_transaksi_akuntansi);

		$update = array();
		$id 									= $data['post_detail_simpanankanzun']->id;
		$update['id_simpanankanzun'] 			= $data['post_detail_simpanankanzun']->id_simpanankanzun;
		$update['waktu'] 						= $data['post_detail_simpanankanzun']->waktu;
		$update['jenis'] 						= $data['post_detail_simpanankanzun']->jenis;
		$update['bulan_tahun'] 					= $data['post_detail_simpanankanzun']->bulan_tahun;
		$update['jumlah'] 						= $data['post_detail_simpanankanzun']->jumlah;
		$update['status_post'] 					= 0;
		$update['id_debet_transaksi_akuntansi']	= 0;
		$update['id_kredit_transaksi_akuntansi']= 0;
		$this->detailsimpanankanzunmodel->updateData($id, $update);

		redirect('transaksianggotacon/view_simpanankanzun/'.$id_simpanankanzun);
	}
	/*** End of Transaksi Simpanan Kanzun ***/

	/*** Transaksi Simpanan 3 Th ***/
	function simpanan3th($id_nasabah) {
		$session_data = $this->session->userdata('mubasyirin_logged_in');
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
		$data['aset_kekayaan']		= $this->asetkekayaanmodel->get_asetkekayaan_by_id_nasabah($id_nasabah);
		$data['username'] 			= $session_data['username'];
		$data['status'] 			= $session_data['status'];

		$this->load->view('/layouts/menu', $data);
		$this->load->view('/transaksianggota/index_simpanan3th', $data);
		$this->load->view('/layouts/footer', $data);
	}

	function create_simpanan3th($id_nasabah) {
		$session_data = $this->session->userdata('mubasyirin_logged_in');
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
		$data['aset_kekayaan']		= $this->asetkekayaanmodel->get_asetkekayaan_by_id_nasabah($id_nasabah);
		$data['username'] 			= $session_data['username'];
		$data['status'] 			= $session_data['status'];

		$this->load->view('/layouts/menu', $data);
		$this->load->view('/transaksianggota/create_simpanan3th', $data);
		$this->load->view('/layouts/footer', $data);
	}

	function insert_simpanan3th($id_nasabah) {
		$session_data = $this->session->userdata('mubasyirin_logged_in');
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
		$session_data = $this->session->userdata('mubasyirin_logged_in');
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
		$data['aset_kekayaan']		= $this->asetkekayaanmodel->get_asetkekayaan_by_id_nasabah($id_nasabah);
		$data['username'] 			= $session_data['username'];
		$data['status'] 			= $session_data['status'];
		
		$this->load->view('/layouts/menu', $data);
		$this->load->view('/transaksianggota/edit_simpanan3th', $data);
		$this->load->view('/layouts/footer', $data);
	}

	function update_simpanan3th() {
		$session_data = $this->session->userdata('mubasyirin_logged_in');
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
		$session_data = $this->session->userdata('mubasyirin_logged_in');
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
		$session_data = $this->session->userdata('mubasyirin_logged_in');
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
		$data['aset_kekayaan']		= $this->asetkekayaanmodel->get_asetkekayaan_by_id_nasabah($id_nasabah);
		$data['username'] 				= $session_data['username'];
		$data['status'] 				= $session_data['status'];
		
		$this->load->view('/layouts/menu', $data);
		$this->load->view('/transaksianggota/view_simpanan3th', $data);
		$this->load->view('/layouts/footer', $data);
	}

	function insert_detail_simpanan3th() {
		$session_data = $this->session->userdata('mubasyirin_logged_in');
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
		$session_data = $this->session->userdata('mubasyirin_logged_in');
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
		$data['aset_kekayaan']		= $this->asetkekayaanmodel->get_asetkekayaan_by_id_nasabah($id_nasabah);
		$data['username'] 					= $session_data['username'];
		$data['status'] 					= $session_data['status'];

		$this->load->view('/layouts/menu', $data);
		$this->load->view('/transaksianggota/view_simpanan3th_edit_detail', $data);
		$this->load->view('/layouts/footer', $data);	
	}

	function update_detail_simpanan3th() {
		$session_data = $this->session->userdata('mubasyirin_logged_in');
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
		$session_data = $this->session->userdata('mubasyirin_logged_in');
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

	/*** Transaksi Simpanan Pihak Ketiga ***/
	function simpananpihakketiga($id_nasabah) {
		$session_data = $this->session->userdata('mubasyirin_logged_in');
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
		$data['aset_kekayaan']		= $this->asetkekayaanmodel->get_asetkekayaan_by_id_nasabah($id_nasabah);
		$data['username'] 			= $session_data['username'];
		$data['status'] 			= $session_data['status'];

		$this->load->view('/layouts/menu', $data);
		$this->load->view('/transaksianggota/index_simpananpihakketiga', $data);
		$this->load->view('/layouts/footer', $data);
	}

	function create_simpananpihakketiga($id_nasabah) {
		$session_data = $this->session->userdata('mubasyirin_logged_in');
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
		$data['aset_kekayaan']		= $this->asetkekayaanmodel->get_asetkekayaan_by_id_nasabah($id_nasabah);
		$data['username'] 			= $session_data['username'];
		$data['status'] 			= $session_data['status'];

		$this->load->view('/layouts/menu', $data);
		$this->load->view('/transaksianggota/create_simpananpihakketiga', $data);
		$this->load->view('/layouts/footer', $data);
	}

	function insert_simpananpihakketiga($id_nasabah) {
		$session_data = $this->session->userdata('mubasyirin_logged_in');
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
		$session_data = $this->session->userdata('mubasyirin_logged_in');
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
		$data['aset_kekayaan']		= $this->asetkekayaanmodel->get_asetkekayaan_by_id_nasabah($id_nasabah);
		$data['username'] 			= $session_data['username'];
		$data['status'] 			= $session_data['status'];
		
		$this->load->view('/layouts/menu', $data);
		$this->load->view('/transaksianggota/edit_simpananpihakketiga', $data);
		$this->load->view('/layouts/footer', $data);
	}

	function update_simpananpihakketiga() {
		$session_data = $this->session->userdata('mubasyirin_logged_in');
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
		$session_data = $this->session->userdata('mubasyirin_logged_in');
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
		$session_data = $this->session->userdata('mubasyirin_logged_in');
		if($session_data == NULL) {
			redirect("usercon/login", "refresh");
		}

		$data['simpananpihakketiga'] 				= $this->simpananpihakketigamodel->get_simpananpihakketiga_by_id($id_simpananpihakketiga);
		$data['detail_simpananpihakketiga']			= $this->detailsimpananpihakketigamodel->get_detail_simpananpihakketiga_by_id_simpananpihakketiga($id_simpananpihakketiga);
		$data['detail_jasa_simpananpihakketiga']	= $this->detailjasasimpananpihakketigamodel->get_detail_jasa_simpananpihakketiga_by_id_simpananpihakketiga($id_simpananpihakketiga);
		$id_nasabah									= $data['simpananpihakketiga']->id_nasabah;
		$data['nasabah'] 							= $this->nasabahmodel->get_nasabah_by_id($id_nasabah);
		$data['pinjaman'] 							= $this->pinjamanmodel->get_pinjaman_by_id_nasabah($id_nasabah);
		$data['simpananpokok'] 						= $this->simpananpokokmodel->get_simpananpokok_by_id_nasabah($id_nasabah);
		$data['simpananwajib'] 						= $this->simpananwajibmodel->get_simpananwajib_by_id_nasabah($id_nasabah);
		$data['simpanandanasosial'] 				= $this->simpanandanasosialmodel->get_simpanandanasosial_by_id_nasabah($id_nasabah);
		$data['simpanankanzun'] 					= $this->simpanankanzunmodel->get_simpanankanzun_by_id_nasabah($id_nasabah);
		$data['simpanankhusus'] 					= $this->simpanankhususmodel->get_simpanankhusus_by_id_nasabah($id_nasabah);
		$data['simpanan3th'] 						= $this->simpanan3thmodel->get_simpanan3th_by_id_nasabah($id_nasabah);
		$data['aset_kekayaan']		= $this->asetkekayaanmodel->get_asetkekayaan_by_id_nasabah($id_nasabah);
		$data['username'] 							= $session_data['username'];
		$data['status'] 							= $session_data['status'];

		$this->load->view('/layouts/menu', $data);
		$this->load->view('/transaksianggota/view_simpananpihakketiga', $data);
		$this->load->view('/layouts/footer', $data);
	}

	function insert_detail_simpananpihakketiga() {
		$session_data = $this->session->userdata('mubasyirin_logged_in');
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
		$input['keterangan']				= $this->input->post('keterangan');
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
		$session_data = $this->session->userdata('mubasyirin_logged_in');
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
		$data['detail_jasa_simpananpihakketiga'] 		= $this->detailjasasimpananpihakketigamodel->get_detail_jasa_simpananpihakketiga_by_id_simpananpihakketiga($id_simpananpihakketiga);
		$data['simpananpokok'] 						= $this->simpananpokokmodel->get_simpananpokok_by_id_nasabah($id_nasabah);
		$data['pinjaman'] 							= $this->pinjamanmodel->get_pinjaman_by_id_nasabah($id_nasabah);
		$data['simpananwajib'] 						= $this->simpananwajibmodel->get_simpananwajib_by_id_nasabah($id_nasabah);
		$data['simpanandanasosial'] 				= $this->simpanandanasosialmodel->get_simpanandanasosial_by_id_nasabah($id_nasabah);
		$data['simpanankanzun'] 					= $this->simpanankanzunmodel->get_simpanankanzun_by_id_nasabah($id_nasabah);
		$data['simpanankhusus'] 					= $this->simpanankhususmodel->get_simpanankhusus_by_id_nasabah($id_nasabah);
		$data['simpanan3th'] 						= $this->simpanan3thmodel->get_simpanan3th_by_id_nasabah($id_nasabah);
		$data['aset_kekayaan']		= $this->asetkekayaanmodel->get_asetkekayaan_by_id_nasabah($id_nasabah);
		$data['username'] 							= $session_data['username'];
		$data['status'] 							= $session_data['status'];

		$this->load->view('/layouts/menu', $data);
		$this->load->view('/transaksianggota/view_simpananpihakketiga_edit_detail', $data);
		$this->load->view('/layouts/footer', $data);
	}

	function update_detail_simpananpihakketiga() {
		$session_data = $this->session->userdata('mubasyirin_logged_in');
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
		$update['keterangan'] 				= $this->input->post('edit_keterangan');
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
		$session_data = $this->session->userdata('mubasyirin_logged_in');
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

	function insert_detail_jasa_simpananpihakketiga() {
		$session_data = $this->session->userdata('mubasyirin_logged_in');
		if($session_data == NULL) {
			redirect("usercon/login", "refresh");
		}

		// Insert Detail Jasa Simpanan 3 Th ke dalam table detail_simpanan3th
		$date1 								= $this->input->post('jasa_waktu');
		$date 								= strtotime($date1);
		$input 								= array();
		$input['waktu'] 					= date("Y-m-d",$date);
		$input['id_simpananpihakketiga']	= $this->input->post('jasa_id_simpananpihakketiga');
		$input['jenis']						= $this->input->post('jasa_jenis');
		$input['bulan_tahun']				= $this->input->post('jasa_bulan_tahun');
		$input['jumlah']					= $this->input->post('jasa_jumlah');
		$input['keterangan']				= $this->input->post('jasa_keterangan');
		$this->detailjasasimpananpihakketigamodel->inputData($input);

		$id_simpananpihakketiga = $this->input->post('jasa_id_simpananpihakketiga');
		$data['simpananpihakketiga'] = $this->simpananpihakketigamodel->get_simpananpihakketiga_by_id($id_simpananpihakketiga);

		if($input['jenis'] == 'Penyesuaian Jasa') {
			$jasa_total = $data['simpananpihakketiga']->jasa_total;
			$jasa_total	= $jasa_total + $input['jumlah'];
			$this->simpananpihakketigamodel->update_jasa_total($id_simpananpihakketiga, $jasa_total);
		} else {
			$jasa_total = $data['simpananpihakketiga']->jasa_total;
			$jasa_total	= $jasa_total - $input['jumlah'];
			$this->simpananpihakketigamodel->update_jasa_total($id_simpananpihakketiga, $jasa_total);
		}

		redirect('transaksianggotacon/view_simpananpihakketiga/'.$id_simpananpihakketiga);
	}

	function edit_detail_jasa_simpananpihakketiga($id_simpananpihakketiga, $id_detail_jasa_simpananpihakketiga) {
		$session_data = $this->session->userdata('mubasyirin_logged_in');
		if($session_data == NULL) {
			redirect("usercon/login", "refresh");
		}

		// Get Simpanan Pihak Ketiga Sesuai dengan id_simpananpihakketiga
		$update = $this->simpananpihakketigamodel->get_simpananpihakketiga_by_id($id_simpananpihakketiga);
		// Get Detail Jasa Simpanan 3 Th Sesuai dengan id_detail_simpananpihakketiga
		$prev 	= $this->detailjasasimpananpihakketigamodel->get_detail_jasa_simpananpihakketiga_by_id($id_detail_jasa_simpananpihakketiga);

		if($prev->jenis == 'Penyesuaian Jasa') {
			$jasa_total 	= $update->jasa_total - $prev->jumlah;
			$this->simpananpihakketigamodel->update_jasa_total($id_simpananpihakketiga, $jasa_total);
		} else {
			$jasa_total 	= $update->jasa_total + $prev->jumlah;
			$this->simpananpihakketigamodel->update_jasa_total($id_simpananpihakketiga, $jasa_total);
		}

		$data['simpananpihakketiga'] 					= $this->simpananpihakketigamodel->get_simpananpihakketiga_by_id($id_simpananpihakketiga);
		$id_nasabah										= $data['simpananpihakketiga']->id_nasabah;
		$data['nasabah'] 								= $this->nasabahmodel->get_nasabah_by_id($id_nasabah);
		$data['detail_simpananpihakketiga'] 			= $this->detailsimpananpihakketigamodel->get_detail_simpananpihakketiga_by_id_simpananpihakketiga($id_simpananpihakketiga);
		$data['detail_jasa_simpananpihakketiga'] 		= $this->detailjasasimpananpihakketigamodel->get_detail_jasa_simpananpihakketiga_by_id_simpananpihakketiga($id_simpananpihakketiga);
		$data['edit_detail_jasa_simpananpihakketiga']	= $this->detailjasasimpananpihakketigamodel->get_detail_jasa_simpananpihakketiga_by_id($id_detail_jasa_simpananpihakketiga);
		$data['simpananpokok'] 							= $this->simpananpokokmodel->get_simpananpokok_by_id_nasabah($id_nasabah);
		$data['pinjaman'] 								= $this->pinjamanmodel->get_pinjaman_by_id_nasabah($id_nasabah);
		$data['simpananwajib'] 							= $this->simpananwajibmodel->get_simpananwajib_by_id_nasabah($id_nasabah);
		$data['simpanandanasosial'] 					= $this->simpanandanasosialmodel->get_simpanandanasosial_by_id_nasabah($id_nasabah);
		$data['simpanankanzun'] 						= $this->simpanankanzunmodel->get_simpanankanzun_by_id_nasabah($id_nasabah);
		$data['simpanankhusus'] 						= $this->simpanankhususmodel->get_simpanankhusus_by_id_nasabah($id_nasabah);
		$data['simpanan3th'] 							= $this->simpanan3thmodel->get_simpanan3th_by_id_nasabah($id_nasabah);
		$data['aset_kekayaan']		= $this->asetkekayaanmodel->get_asetkekayaan_by_id_nasabah($id_nasabah);
		$data['username'] 								= $session_data['username'];
		$data['status'] 								= $session_data['status'];

		$this->load->view('/layouts/menu', $data);
		$this->load->view('/transaksianggota/view_simpananpihakketiga_edit_detail_jasa', $data);
		$this->load->view('/layouts/footer', $data);
	}

	function update_detail_jasa_simpananpihakketiga() {
		$session_data = $this->session->userdata('mubasyirin_logged_in');
		if($session_data == NULL) {
			redirect("usercon/login", "refresh");
		}

		//Update Detail Simpanan Pihak Ketiga ke dalam table detail_simpananpihakketiga
		$id_detail_jasa_simpananpihakketiga	= $this->input->post('edit_jasa_id');
		$date1 								= $this->input->post('edit_jasa_waktu');
		$date 								= strtotime($date1);
		$update 							= array();
		$update['waktu'] 					= date("Y-m-d",$date);
		$update['id_simpananpihakketiga'] 	= $this->input->post('edit_jasa_id_simpananpihakketiga');
		$update['jenis'] 					= $this->input->post('edit_jasa_jenis');
		$update['bulan_tahun'] 				= $this->input->post('edit_jasa_bulan_tahun');
		$update['jumlah'] 					= $this->input->post('edit_jasa_jumlah');
		$update['keterangan'] 				= $this->input->post('edit_jasa_keterangan');
		$this->detailjasasimpananpihakketigamodel->updateData($id_detail_jasa_simpananpihakketiga, $update);

		$id_simpananpihakketiga = $this->input->post('edit_jasa_id_simpananpihakketiga');
		$data['simpananpihakketiga'] = $this->simpananpihakketigamodel->get_simpananpihakketiga_by_id($id_simpananpihakketiga);

		if($update['jenis'] == 'Penyesuaian Jasa') {
			$jasa_total = $data['simpananpihakketiga']->jasa_total + $update['jumlah'];
			$this->simpananpihakketigamodel->update_jasa_total($id_simpananpihakketiga, $jasa_total);
		} else {
			$jasa_total = $data['simpananpihakketiga']->jasa_total - $update['jumlah'];
			$this->simpananpihakketigamodel->update_jasa_total($id_simpananpihakketiga, $jasa_total);
		}

		// echo "<pre>";
		// var_dump($update);
		// echo "</pre>";

		redirect('transaksianggotacon/view_simpananpihakketiga/'.$id_simpananpihakketiga);
	}

	function delete_detail_jasa_simpananpihakketiga($id_simpananpihakketiga, $id_detail_jasa_simpananpihakketiga) {
		$session_data = $this->session->userdata('mubasyirin_logged_in');
		if($session_data == NULL) {
			redirect("usercon/login", "refresh");
		}

		// Get Simpanan Pihak Ketiga Sesuai dengan id_simpananpihakketiga
		$update = $this->simpananpihakketigamodel->get_simpananpihakketiga_by_id($id_simpananpihakketiga);
		// Get Detail Simpanan Pihak Ketiga Sesuai dengan id_detail_simpananpihakketiga
		$prev 	= $this->detailjasasimpananpihakketigamodel->get_detail_jasa_simpananpihakketiga_by_id($id_detail_jasa_simpananpihakketiga);

		if($prev->jenis == 'Penyesuaian Jasa') {
			$jasa_total 	= $update->jasa_total - $prev->jumlah;
			$this->simpananpihakketigamodel->update_jasa_total($id_simpananpihakketiga, $jasa_total);
		} else {
			$jasa_total 	= $update->jasa_total + $prev->jumlah;
			$this->simpananpihakketigamodel->update_jasa_total($id_simpananpihakketiga, $jasa_total);
		}

		$this->detailjasasimpananpihakketigamodel->deleteData($id_detail_jasa_simpananpihakketiga);

		redirect('transaksianggotacon/view_simpananpihakketiga/'.$id_simpananpihakketiga);
	}

	function simpananpihakketiga_post_akuntansi($id_simpananpihakketiga, $id_detail_simpananpihakketiga) {
		$session_data = $this->session->userdata('mubasyirin_logged_in');
		if($session_data == NULL) {
			redirect("usercon/login", "refresh");
		}

		$data['simpananpihakketiga'] 				= $this->simpananpihakketigamodel->get_simpananpihakketiga_by_id($id_simpananpihakketiga);
		$data['post_detail_simpananpihakketiga']	= $this->detailsimpananpihakketigamodel->get_detail_simpananpihakketiga_by_id($id_detail_simpananpihakketiga);

		if($data['post_detail_simpananpihakketiga']->status_post != '1') {
			if($data['post_detail_simpananpihakketiga']->jenis == "Setoran") {
				$mapping_kode_akun = $this->mappingkodeakunmodel->get_mapping_kode_akun_by_nama_transaksi('penerimaan tabungan pihak 3');
				$debet 		= $this->kodeakunmodel->get_kode_akun_by_kode($mapping_kode_akun->kode_debet);
				$kredit 	= $this->kodeakunmodel->get_kode_akun_by_kode($mapping_kode_akun->kode_kredit);
				$bln_thn = strtotime( $data['post_detail_simpananpihakketiga']->bulan_tahun );
	            $bulan_tahun = date( 'M-Y', $bln_thn );

	            $data_debet 					= array();
				$data_debet['id'] 				= $this->transaksiakuntansimodel->getNewId();
				$data_debet['tanggal'] 			= $data['post_detail_simpananpihakketiga']->waktu;
				$data_debet['kode_akun'] 		= $mapping_kode_akun->kode_debet;
				$data_debet['nama_akun'] 		= $debet->nama_akun;
				$data_debet['keterangan'] 		= "Simpanan Pihak Ketiga Bulan ".$bulan_tahun." a.n. ".$data['simpananpihakketiga']->nama." Nomor : ".$data['simpananpihakketiga']->nomor_nasabah." Tanggal Simpanan: ".date("d-m-Y", strtotime($data['simpananpihakketiga']->waktu));
				$data_debet['jumlah'] 			= $data['post_detail_simpananpihakketiga']->jumlah;
				$data_debet['debet'] 			= $data['post_detail_simpananpihakketiga']->jumlah;
				$data_debet['kredit'] 			= 0;
				$data_debet['origin_table']		= 'detail_simpananpihakketiga';
				$data_debet['origin_table_id']	= $data['post_detail_simpananpihakketiga']->id;
				$this->transaksiakuntansimodel->inputData($data_debet);

				$data_kredit 					= array();
				$data_kredit['id'] 				= $this->transaksiakuntansimodel->getNewId();
				$data_kredit['tanggal'] 		= $data['post_detail_simpananpihakketiga']->waktu;
				$data_kredit['kode_akun'] 		= $mapping_kode_akun->kode_kredit;
				$data_kredit['nama_akun'] 		= $kredit->nama_akun;
				$data_kredit['keterangan'] 		= "Simpanan Pihak Ketiga Bulan ".$bulan_tahun." a.n. ".$data['simpananpihakketiga']->nama." Nomor : ".$data['simpananpihakketiga']->nomor_nasabah." Tanggal Simpanan: ".date("d-m-Y", strtotime($data['simpananpihakketiga']->waktu));
				$data_kredit['jumlah'] 			= $data['post_detail_simpananpihakketiga']->jumlah;
				$data_kredit['debet'] 			= 0;
				$data_kredit['kredit'] 			= $data['post_detail_simpananpihakketiga']->jumlah;
				$data_kredit['origin_table']	= 'detail_simpananpihakketiga';
				$data_kredit['origin_table_id']	= $data['post_detail_simpananpihakketiga']->id;
				$this->transaksiakuntansimodel->inputData($data_kredit);
			} else if($data['post_detail_simpananpihakketiga']->jenis == "Tarikan") {
				$mapping_kode_akun = $this->mappingkodeakunmodel->get_mapping_kode_akun_by_nama_transaksi('pencairan tabungan pihak 3');
				$debet 		= $this->kodeakunmodel->get_kode_akun_by_kode($mapping_kode_akun->kode_debet);
				$kredit 	= $this->kodeakunmodel->get_kode_akun_by_kode($mapping_kode_akun->kode_kredit);
				$bln_thn = strtotime( $data['post_detail_simpananpihakketiga']->bulan_tahun );
	            $bulan_tahun = date( 'M-Y', $bln_thn );

	            $data_debet 					= array();
				$data_debet['id'] 				= $this->transaksiakuntansimodel->getNewId();
				$data_debet['tanggal'] 			= $data['post_detail_simpananpihakketiga']->waktu;
				$data_debet['kode_akun'] 		= $mapping_kode_akun->kode_debet;
				$data_debet['nama_akun'] 		= $debet->nama_akun;
				$data_debet['keterangan'] 		= "Pencairan Simpanan Pihak Ketiga Bulan ".$bulan_tahun." a.n. ".$data['simpananpihakketiga']->nama." Nomor : ".$data['simpananpihakketiga']->nomor_nasabah." Tanggal Simpanan: ".date("d-m-Y", strtotime($data['simpananpihakketiga']->waktu));
				$data_debet['jumlah'] 			= $data['post_detail_simpananpihakketiga']->jumlah;
				$data_debet['debet'] 			= $data['post_detail_simpananpihakketiga']->jumlah;
				$data_debet['kredit'] 			= 0;
				$data_debet['origin_table']		= 'detail_simpananpihakketiga';
				$data_debet['origin_table_id']	= $data['post_detail_simpananpihakketiga']->id;
				$this->transaksiakuntansimodel->inputData($data_debet);

				$data_kredit 					= array();
				$data_kredit['id'] 				= $this->transaksiakuntansimodel->getNewId();
				$data_kredit['tanggal'] 		= $data['post_detail_simpananpihakketiga']->waktu;
				$data_kredit['kode_akun'] 		= $mapping_kode_akun->kode_kredit;
				$data_kredit['nama_akun'] 		= $kredit->nama_akun;
				$data_kredit['keterangan'] 		= "Pencairan Simpanan Pihak Ketiga Bulan ".$bulan_tahun." a.n. ".$data['simpananpihakketiga']->nama." Nomor : ".$data['simpananpihakketiga']->nomor_nasabah." Tanggal Simpanan: ".date("d-m-Y", strtotime($data['simpananpihakketiga']->waktu));
				$data_kredit['jumlah'] 			= $data['post_detail_simpananpihakketiga']->jumlah;
				$data_kredit['debet'] 			= 0;
				$data_kredit['kredit'] 			= $data['post_detail_simpananpihakketiga']->jumlah;
				$data_kredit['origin_table']	= 'detail_simpananpihakketiga';
				$data_kredit['origin_table_id']	= $data['post_detail_simpananpihakketiga']->id;
				$this->transaksiakuntansimodel->inputData($data_kredit);
			}

			$update = array();
			$id 									= $data['post_detail_simpananpihakketiga']->id;
			$update['id_simpananpihakketiga'] 		= $data['post_detail_simpananpihakketiga']->id_simpananpihakketiga;
			$update['waktu'] 						= $data['post_detail_simpananpihakketiga']->waktu;
			$update['jenis'] 						= $data['post_detail_simpananpihakketiga']->jenis;
			$update['bulan_tahun'] 					= $data['post_detail_simpananpihakketiga']->bulan_tahun;
			$update['jumlah'] 						= $data['post_detail_simpananpihakketiga']->jumlah;
			$update['keterangan'] 					= $data['post_detail_simpananpihakketiga']->keterangan;
			$update['status_post'] 					= 1;
			$update['id_debet_transaksi_akuntansi']	= $data_debet['id'];
			$update['id_kredit_transaksi_akuntansi']= $data_kredit['id'];
			$this->detailsimpananpihakketigamodel->updateData($id, $update);
		}
		redirect('transaksianggotacon/view_simpananpihakketiga/'.$id_simpananpihakketiga);
	}

	function simpananpihakketiga_unpost_akuntansi($id_simpananpihakketiga, $id_detail_simpananpihakketiga) {
		$session_data = $this->session->userdata('mubasyirin_logged_in');
		if($session_data == NULL) {
			redirect("usercon/login", "refresh");
		}

		$data['simpananpihakketiga'] 				= $this->simpananpihakketigamodel->get_simpananpihakketiga_by_id($id_simpananpihakketiga);
		$data['post_detail_simpananpihakketiga']	= $this->detailsimpananpihakketigamodel->get_detail_simpananpihakketiga_by_id($id_detail_simpananpihakketiga);

		$id_debet_transaksi_akuntansi 	= $data['post_detail_simpananpihakketiga']->id_debet_transaksi_akuntansi;
		$id_kredit_transaksi_akuntansi 	= $data['post_detail_simpananpihakketiga']->id_kredit_transaksi_akuntansi;

		$this->transaksiakuntansimodel->deleteData($id_debet_transaksi_akuntansi);
		$this->transaksiakuntansimodel->deleteData($id_kredit_transaksi_akuntansi);

		$update = array();
		$id 									= $data['post_detail_simpananpihakketiga']->id;
		$update['id_simpananpihakketiga'] 		= $data['post_detail_simpananpihakketiga']->id_simpananpihakketiga;
		$update['waktu'] 						= $data['post_detail_simpananpihakketiga']->waktu;
		$update['jenis'] 						= $data['post_detail_simpananpihakketiga']->jenis;
		$update['bulan_tahun'] 					= $data['post_detail_simpananpihakketiga']->bulan_tahun;
		$update['jumlah'] 						= $data['post_detail_simpananpihakketiga']->jumlah;
		$update['keterangan']					= $data['post_detail_simpananpihakketiga']->keterangan;
		$update['status_post'] 					= 0;
		$update['id_debet_transaksi_akuntansi']	= 0;
		$update['id_kredit_transaksi_akuntansi']= 0;
		$this->detailsimpananpihakketigamodel->updateData($id, $update);

		redirect('transaksianggotacon/view_simpananpihakketiga/'.$id_simpananpihakketiga);
	}

	function jasa_simpananpihakketiga_post_akuntansi($id_simpananpihakketiga, $id_detail_jasa_simpananpihakketiga) {
		$session_data = $this->session->userdata('mubasyirin_logged_in');
		if($session_data == NULL) {
			redirect("usercon/login", "refresh");
		}

		$data['simpananpihakketiga'] 				= $this->simpananpihakketigamodel->get_simpananpihakketiga_by_id($id_simpananpihakketiga);
		$data['post_detail_jasa_simpananpihakketiga']	= $this->detailjasasimpananpihakketigamodel->get_detail_jasa_simpananpihakketiga_by_id($id_detail_jasa_simpananpihakketiga);

		if($data['post_detail_jasa_simpananpihakketiga']->status_post != '1') {
			if($data['post_detail_jasa_simpananpihakketiga']->jenis == "Penyesuaian Jasa") {
				$mapping_kode_akun = $this->mappingkodeakunmodel->get_mapping_kode_akun_by_nama_transaksi('penyesuaian jasa pihak 3');
				$debet 		= $this->kodeakunmodel->get_kode_akun_by_kode($mapping_kode_akun->kode_debet);
				$kredit 	= $this->kodeakunmodel->get_kode_akun_by_kode($mapping_kode_akun->kode_kredit);
				$bln_thn = strtotime( $data['post_detail_jasa_simpananpihakketiga']->bulan_tahun );
	            $bulan_tahun = date( 'M-Y', $bln_thn );

	            $data_debet 					= array();
				$data_debet['id'] 				= $this->transaksiakuntansimodel->getNewId();
				$data_debet['tanggal'] 			= $data['post_detail_jasa_simpananpihakketiga']->waktu;
				$data_debet['kode_akun'] 		= $mapping_kode_akun->kode_debet;
				$data_debet['nama_akun'] 		= $debet->nama_akun;
				$data_debet['keterangan'] 		= "Jasa Simpanan Pihak Ketiga Bulan ".$bulan_tahun." a.n. ".$data['simpananpihakketiga']->nama." Nomor : ".$data['simpananpihakketiga']->nomor_nasabah." Tanggal Simpanan: ".date("d-m-Y", strtotime($data['simpananpihakketiga']->waktu));
				$data_debet['jumlah'] 			= $data['post_detail_jasa_simpananpihakketiga']->jumlah;
				$data_debet['debet'] 			= $data['post_detail_jasa_simpananpihakketiga']->jumlah;
				$data_debet['kredit'] 			= 0;
				$data_debet['origin_table']		= 'detail_jasa_simpananpihakketiga';
				$data_debet['origin_table_id']	= $data['post_detail_jasa_simpananpihakketiga']->id;
				$this->transaksiakuntansimodel->inputData($data_debet);

				$data_kredit 					= array();
				$data_kredit['id'] 				= $this->transaksiakuntansimodel->getNewId();
				$data_kredit['tanggal'] 		= $data['post_detail_jasa_simpananpihakketiga']->waktu;
				$data_kredit['kode_akun'] 		= $mapping_kode_akun->kode_kredit;
				$data_kredit['nama_akun'] 		= $kredit->nama_akun;
				$data_kredit['keterangan'] 		= "Jasa Simpanan Pihak Ketiga Bulan ".$bulan_tahun." a.n. ".$data['simpananpihakketiga']->nama." Nomor : ".$data['simpananpihakketiga']->nomor_nasabah." Tanggal Simpanan: ".date("d-m-Y", strtotime($data['simpananpihakketiga']->waktu));
				$data_kredit['jumlah'] 			= $data['post_detail_jasa_simpananpihakketiga']->jumlah;
				$data_kredit['debet'] 			= 0;
				$data_kredit['kredit'] 			= $data['post_detail_jasa_simpananpihakketiga']->jumlah;
				$data_kredit['origin_table']	= 'detail_jasa_simpananpihakketiga';
				$data_kredit['origin_table_id']	= $data['post_detail_jasa_simpananpihakketiga']->id;
				$this->transaksiakuntansimodel->inputData($data_kredit);
			} else if($data['post_detail_jasa_simpananpihakketiga']->jenis == "Pencairan Hutang Jasa") {
				$mapping_kode_akun = $this->mappingkodeakunmodel->get_mapping_kode_akun_by_nama_transaksi('pencairan hutang jasa pihak 3');
				$debet 		= $this->kodeakunmodel->get_kode_akun_by_kode($mapping_kode_akun->kode_debet);
				$kredit 	= $this->kodeakunmodel->get_kode_akun_by_kode($mapping_kode_akun->kode_kredit);
				$bln_thn = strtotime( $data['post_detail_jasa_simpananpihakketiga']->bulan_tahun );
	            $bulan_tahun = date( 'M-Y', $bln_thn );

	            $data_debet 					= array();
				$data_debet['id'] 				= $this->transaksiakuntansimodel->getNewId();
				$data_debet['tanggal'] 			= $data['post_detail_jasa_simpananpihakketiga']->waktu;
				$data_debet['kode_akun'] 		= $mapping_kode_akun->kode_debet;
				$data_debet['nama_akun'] 		= $debet->nama_akun;
				$data_debet['keterangan'] 		= "Pencairan Hutang Jasa Simpanan Pihak Ketiga Bulan ".$bulan_tahun." a.n. ".$data['simpananpihakketiga']->nama." Nomor : ".$data['simpananpihakketiga']->nomor_nasabah." Tanggal Simpanan: ".date("d-m-Y", strtotime($data['simpananpihakketiga']->waktu));
				$data_debet['jumlah'] 			= $data['post_detail_jasa_simpananpihakketiga']->jumlah;
				$data_debet['debet'] 			= $data['post_detail_jasa_simpananpihakketiga']->jumlah;
				$data_debet['kredit'] 			= 0;
				$data_debet['origin_table']		= 'detail_jasa_simpananpihakketiga';
				$data_debet['origin_table_id']	= $data['post_detail_jasa_simpananpihakketiga']->id;
				$this->transaksiakuntansimodel->inputData($data_debet);

				$data_kredit 					= array();
				$data_kredit['id'] 				= $this->transaksiakuntansimodel->getNewId();
				$data_kredit['tanggal'] 		= $data['post_detail_jasa_simpananpihakketiga']->waktu;
				$data_kredit['kode_akun'] 		= $mapping_kode_akun->kode_kredit;
				$data_kredit['nama_akun'] 		= $kredit->nama_akun;
				$data_kredit['keterangan'] 		= "Pencairan Hutang Jasa Simpanan Pihak Ketiga Bulan ".$bulan_tahun." a.n. ".$data['simpananpihakketiga']->nama." Nomor : ".$data['simpananpihakketiga']->nomor_nasabah." Tanggal Simpanan: ".date("d-m-Y", strtotime($data['simpananpihakketiga']->waktu));
				$data_kredit['jumlah'] 			= $data['post_detail_jasa_simpananpihakketiga']->jumlah;
				$data_kredit['debet'] 			= 0;
				$data_kredit['kredit'] 			= $data['post_detail_jasa_simpananpihakketiga']->jumlah;
				$data_kredit['origin_table']	= 'detail_jasa_simpananpihakketiga';
				$data_kredit['origin_table_id']	= $data['post_detail_jasa_simpananpihakketiga']->id;
				$this->transaksiakuntansimodel->inputData($data_kredit);
			} else if($data['post_detail_jasa_simpananpihakketiga']->jenis == "Pembayaran Biaya Jasa") {
				$mapping_kode_akun = $this->mappingkodeakunmodel->get_mapping_kode_akun_by_nama_transaksi('pembayaran biaya jasa pihak 3');
				$debet 		= $this->kodeakunmodel->get_kode_akun_by_kode($mapping_kode_akun->kode_debet);
				$kredit 	= $this->kodeakunmodel->get_kode_akun_by_kode($mapping_kode_akun->kode_kredit);
				$bln_thn = strtotime( $data['post_detail_jasa_simpananpihakketiga']->bulan_tahun );
	            $bulan_tahun = date( 'M-Y', $bln_thn );

	            $data_debet 					= array();
				$data_debet['id'] 				= $this->transaksiakuntansimodel->getNewId();
				$data_debet['tanggal'] 			= $data['post_detail_jasa_simpananpihakketiga']->waktu;
				$data_debet['kode_akun'] 		= $mapping_kode_akun->kode_debet;
				$data_debet['nama_akun'] 		= $debet->nama_akun;
				$data_debet['keterangan'] 		= "Pembayaran Biaya Jasa Simpanan Pihak Ketiga Bulan ".$bulan_tahun." a.n. ".$data['simpananpihakketiga']->nama." Nomor : ".$data['simpananpihakketiga']->nomor_nasabah." Tanggal Simpanan: ".date("d-m-Y", strtotime($data['simpananpihakketiga']->waktu));
				$data_debet['jumlah'] 			= $data['post_detail_jasa_simpananpihakketiga']->jumlah;
				$data_debet['debet'] 			= $data['post_detail_jasa_simpananpihakketiga']->jumlah;
				$data_debet['kredit'] 			= 0;
				$data_debet['origin_table']		= 'detail_jasa_simpananpihakketiga';
				$data_debet['origin_table_id']	= $data['post_detail_jasa_simpananpihakketiga']->id;
				$this->transaksiakuntansimodel->inputData($data_debet);

				$data_kredit 					= array();
				$data_kredit['id'] 				= $this->transaksiakuntansimodel->getNewId();
				$data_kredit['tanggal'] 		= $data['post_detail_jasa_simpananpihakketiga']->waktu;
				$data_kredit['kode_akun'] 		= $mapping_kode_akun->kode_kredit;
				$data_kredit['nama_akun'] 		= $kredit->nama_akun;
				$data_kredit['keterangan'] 		= "Pembayaran Biaya Jasa Simpanan Pihak Ketiga Bulan ".$bulan_tahun." a.n. ".$data['simpananpihakketiga']->nama." Nomor : ".$data['simpananpihakketiga']->nomor_nasabah." Tanggal Simpanan: ".date("d-m-Y", strtotime($data['simpananpihakketiga']->waktu));
				$data_kredit['jumlah'] 			= $data['post_detail_jasa_simpananpihakketiga']->jumlah;
				$data_kredit['debet'] 			= 0;
				$data_kredit['kredit'] 			= $data['post_detail_jasa_simpananpihakketiga']->jumlah;
				$data_kredit['origin_table']	= 'detail_jasa_simpananpihakketiga';
				$data_kredit['origin_table_id']	= $data['post_detail_jasa_simpananpihakketiga']->id;
				$this->transaksiakuntansimodel->inputData($data_kredit);
			}

			$update = array();
			$id 									= $data['post_detail_jasa_simpananpihakketiga']->id;
			$update['id_simpananpihakketiga'] 		= $data['post_detail_jasa_simpananpihakketiga']->id_simpananpihakketiga;
			$update['waktu'] 						= $data['post_detail_jasa_simpananpihakketiga']->waktu;
			$update['jenis'] 						= $data['post_detail_jasa_simpananpihakketiga']->jenis;
			$update['bulan_tahun'] 					= $data['post_detail_jasa_simpananpihakketiga']->bulan_tahun;
			$update['jumlah'] 						= $data['post_detail_jasa_simpananpihakketiga']->jumlah;
			$update['keterangan']					= $data['post_detail_jasa_simpananpihakketiga']->keterangan;
			$update['status_post'] 					= 1;
			$update['id_debet_transaksi_akuntansi']	= $data_debet['id'];
			$update['id_kredit_transaksi_akuntansi']= $data_kredit['id'];
			$this->detailjasasimpananpihakketigamodel->updateData($id, $update);
		}
		redirect('transaksianggotacon/view_simpananpihakketiga/'.$id_simpananpihakketiga);
	}

	function jasa_simpananpihakketiga_unpost_akuntansi($id_simpananpihakketiga, $id_detail_jasa_simpananpihakketiga) {
		$session_data = $this->session->userdata('mubasyirin_logged_in');
		if($session_data == NULL) {
			redirect("usercon/login", "refresh");
		}

		$data['simpananpihakketiga'] 				= $this->simpananpihakketigamodel->get_simpananpihakketiga_by_id($id_simpananpihakketiga);
		$data['post_detail_jasa_simpananpihakketiga']	= $this->detailjasasimpananpihakketigamodel->get_detail_jasa_simpananpihakketiga_by_id($id_detail_jasa_simpananpihakketiga);

		$id_debet_transaksi_akuntansi 	= $data['post_detail_jasa_simpananpihakketiga']->id_debet_transaksi_akuntansi;
		$id_kredit_transaksi_akuntansi 	= $data['post_detail_jasa_simpananpihakketiga']->id_kredit_transaksi_akuntansi;

		$this->transaksiakuntansimodel->deleteData($id_debet_transaksi_akuntansi);
		$this->transaksiakuntansimodel->deleteData($id_kredit_transaksi_akuntansi);

		$update = array();
		$id 									= $data['post_detail_jasa_simpananpihakketiga']->id;
		$update['id_simpananpihakketiga'] 		= $data['post_detail_jasa_simpananpihakketiga']->id_simpananpihakketiga;
		$update['waktu'] 						= $data['post_detail_jasa_simpananpihakketiga']->waktu;
		$update['jenis'] 						= $data['post_detail_jasa_simpananpihakketiga']->jenis;
		$update['bulan_tahun'] 					= $data['post_detail_jasa_simpananpihakketiga']->bulan_tahun;
		$update['jumlah'] 						= $data['post_detail_jasa_simpananpihakketiga']->jumlah;
		$update['keterangan'] 					= $data['post_detail_jasa_simpananpihakketiga']->keterangan;
		$update['status_post'] 					= 0;
		$update['id_debet_transaksi_akuntansi']	= 0;
		$update['id_kredit_transaksi_akuntansi']= 0;
		$this->detailjasasimpananpihakketigamodel->updateData($id, $update);

		redirect('transaksianggotacon/view_simpananpihakketiga/'.$id_simpananpihakketiga);
	}
	/*** End of Transaksi Simpanan Pihak Ketiga ***/	

	/*** Aset Kekayaan ***/
	function asetkekayaan($id_nasabah) {
		$session_data = $this->session->userdata('mubasyirin_logged_in');
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
		$data['aset_kekayaan']		= $this->asetkekayaanmodel->get_asetkekayaan_by_id_nasabah($id_nasabah);
		$data['username'] 			= $session_data['username'];
		$data['status'] 			= $session_data['status'];

		$this->load->view('/layouts/menu', $data);
		$this->load->view('/transaksianggota/index_asetkekayaan', $data);
		$this->load->view('/layouts/footer', $data);
	}

	function create_aset_kekayaan($id_nasabah) {
		$session_data = $this->session->userdata('mubasyirin_logged_in');
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
		$data['simpananpihakketiga']= $this->simpananpihakketigamodel->get_simpananpihakketiga_by_id_nasabah($id_nasabah);
		$data['username'] 			= $session_data['username'];
		$data['status'] 			= $session_data['status'];

		$this->load->view('/layouts/menu', $data);
		$this->load->view('/transaksianggota/create_asetkekayaan', $data);
		$this->load->view('/layouts/footer', $data);
	}

	function insert_asetkekayaan($id_nasabah) {
		$session_data = $this->session->userdata('mubasyirin_logged_in');
		if($session_data == NULL) {
			redirect("usercon/login", "refresh");
		}

		$insert = array();
		$insert['id'] 				= $this->asetkekayaanmodel->getNewId();
		$insert['id_nasabah'] 		= $this->input->post('id_nasabah');
		$insert['waktu'] 			= date("Y-m-d");
		$insert['jenis_aset'] 		= $this->input->post('jenis_aset');
		$insert['nama_pemilik'] 	= $this->input->post('nama_pemilik');
		$insert['no_sertifikat'] 	= $this->input->post('no_sertifikat');
		$insert['luas'] 			= $this->input->post('luas');
		$insert['jenis_tanah'] 		= $this->input->post('jenis_tanah');
		$insert['lokasi_tanah'] 	= $this->input->post('lokasi_tanah');
		$insert['merek'] 			= $this->input->post('merek');
		$insert['jenis_motor'] 		= $this->input->post('jenis_motor');
		$insert['tahun']			= $this->input->post('tahun');
		$insert['atas_nama']		= $this->input->post('atas_nama');
		$insert['no_pol']			= $this->input->post('no_pol');

		// Upload File 
		$config['upload_path'] 		= './files/uploads/aset_kekayaan/'; //path folder
        $config['allowed_types'] 	= 'jpg|png|jpeg'; //type yang dapat diakses bisa anda sesuaikan
        $config['file_name'] 		= time().$insert['id'].'.jpeg';
        $this->load->library('upload');
        $this->upload->initialize($config);
        if(!empty($_FILES['file_img']['name'])) {
        	if ($this->upload->do_upload('file_img')) {
        		$gbr = $this->upload->data();
        		$insert['file_img']			= $config['file_name'];
        	} else {
        		$insert['file_img']			= "";
        	}
        }
		$this->asetkekayaanmodel->inputData($insert);

		redirect('transaksianggotacon/asetkekayaan/'.$id_nasabah);
	}

	function edit_asetkekayaan($id_asetkekayaan) {
		$session_data = $this->session->userdata('mubasyirin_logged_in');
		if($session_data == NULL) {
			redirect("usercon/login", "refresh");
		}

		$data['asetkekayaan']= $this->asetkekayaanmodel->get_asetkekayaan_by_id($id_asetkekayaan);
		$id_nasabah					= $data['asetkekayaan']->id_nasabah;

		$data['nasabah'] 			= $this->nasabahmodel->get_nasabah_by_id($id_nasabah);
		$data['pinjaman'] 			= $this->pinjamanmodel->get_pinjaman_by_id_nasabah($id_nasabah);
		$data['simpananpokok'] 		= $this->simpananpokokmodel->get_simpananpokok_by_id_nasabah($id_nasabah);
		$data['simpananwajib'] 		= $this->simpananwajibmodel->get_simpananwajib_by_id_nasabah($id_nasabah);
		$data['simpanandanasosial'] = $this->simpanandanasosialmodel->get_simpanandanasosial_by_id_nasabah($id_nasabah);
		$data['simpanankanzun'] 	= $this->simpanankanzunmodel->get_simpanankanzun_by_id_nasabah($id_nasabah);
		$data['simpanankhusus'] 	= $this->simpanankhususmodel->get_simpanankhusus_by_id_nasabah($id_nasabah);
		$data['simpanan3th'] 		= $this->simpanan3thmodel->get_simpanan3th_by_id_nasabah($id_nasabah);
		$data['simpananpihakketiga']= $this->simpananpihakketigamodel->get_simpananpihakketiga_by_id_nasabah($id_nasabah);
		$data['username'] 			= $session_data['username'];
		$data['status'] 			= $session_data['status'];

		$this->load->view('/layouts/menu', $data);
		$this->load->view('/transaksianggota/edit_asetkekayaan', $data);
		$this->load->view('/layouts/footer', $data);
	}

	function update_asetkekayaan() {
		$session_data = $this->session->userdata('mubasyirin_logged_in');
		if($session_data == NULL) {
			redirect("usercon/login", "refresh");
		}

		$insert = array();

		$id_asetkekayaan 			= $this->input->post('id');
		$insert['id_nasabah'] 		= $this->input->post('id_nasabah');
		$id_nasabah = $insert['id_nasabah'];
		$insert['waktu'] 			= date("Y-m-d");
		$insert['jenis_aset'] 		= $this->input->post('jenis_aset');
		$insert['nama_pemilik'] 	= $this->input->post('nama_pemilik');
		$insert['no_sertifikat'] 	= $this->input->post('no_sertifikat');
		$insert['luas'] 			= $this->input->post('luas');
		$insert['jenis_tanah'] 		= $this->input->post('jenis_tanah');
		$insert['lokasi_tanah'] 	= $this->input->post('lokasi_tanah');
		$insert['merek'] 			= $this->input->post('merek');
		$insert['jenis_motor'] 		= $this->input->post('jenis_motor');
		$insert['tahun']			= $this->input->post('tahun');
		$insert['atas_nama']		= $this->input->post('atas_nama');
		$insert['no_pol']			= $this->input->post('no_pol');

		// Upload File 
		$config['upload_path'] 		= './files/uploads/aset_kekayaan/'; //path folder
        $config['allowed_types'] 	= 'jpg|png|jpeg'; //type yang dapat diakses bisa anda sesuaikan
        $config['file_name'] 		= time().$insert['id'].'.jpeg';
        $this->load->library('upload');
        $this->upload->initialize($config);
        if(!empty($_FILES['file_img']['name'])) {
        	if ($this->upload->do_upload('file_img')) {
        		$gbr = $this->upload->data();
        		$insert['file_img']			= $config['file_name'];
        	} else {
        		$insert['file_img']			= "";
        	}
        }
		$this->asetkekayaanmodel->updateData($id_asetkekayaan, $insert);

		redirect('transaksianggotacon/asetkekayaan/'.$id_nasabah);
	}

	function delete_asetkekayaan($id_asetkekayaan) {
		$session_data = $this->session->userdata('mubasyirin_logged_in');
		if($session_data == NULL) {
			redirect("usercon/login", "refresh");
		}

		$data['asetkekayaan']= $this->asetkekayaanmodel->get_asetkekayaan_by_id($id_asetkekayaan);
		$id_nasabah					= $data['asetkekayaan']->id_nasabah;

		$this->asetkekayaanmodel->deleteData($id_asetkekayaan);

		redirect('transaksianggotacon/asetkekayaan/'.$id_nasabah);
	}
	/*** End of Aset Kekayaan ***/
}