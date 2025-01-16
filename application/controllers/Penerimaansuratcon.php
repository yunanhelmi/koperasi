<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class PenerimaansuratCon extends CI_Controller {
	function __construct() {
		parent::__construct();

		$this->load->model('usermodel');
		$this->load->model('nasabahmodel');
		$this->load->model('pinjamanmodel');
		$this->load->model('petugaslapanganmodel');
		$this->load->model('penerimaansuratmodel');
		$this->load->model('detailpenerimaansuratmodel');

		$this->load->library('session');
		$this->load->library('form_validation');
		$this->load->library('upload');
		$this->load->library('image_lib');
		$this->load->library(array('PHPExcel','PHPExcel/IOFactory'));
		$this->load->library('pdfgenerator');
	}

	function index() {
		$session_data = $this->session->userdata('mubasyirin_logged_in');
		if($session_data == NULL) {
			redirect("usercon/login", "refresh");
		}
		$data['username'] 	= $session_data['username'];
		$data['status'] 	= $session_data['status'];
		$data['data'] 		= $this->penerimaansuratmodel->showData();
		$this->load->view('/layouts/menu', $data);
		$this->load->view('/penerimaan_surat/index', $data);
		$this->load->view('/layouts/footer', $data);
	}

	function create_penerimaan_surat() {
		$session_data = $this->session->userdata('mubasyirin_logged_in');
		if($session_data == NULL) {
			redirect("usercon/login", "refresh");
		}

		$petugas_lapangan = $this->petugaslapanganmodel->showData();
		$temp = '';
		foreach ($petugas_lapangan as $petugas) {
			$temp = $temp.'{"stateCode": "'.$petugas["id"].'", "stateDisplay": "'.$petugas["nama"].'", "stateName": "'.$petugas["nama"].' | '.$petugas["nik"].'"},';
		}
		$temp=substr_replace($temp ,"",-1);
		$temp=trim(preg_replace('/\s+/', ' ', $temp));
		$data['petugas_lapangan']		= $temp;

		$data['username'] 		= $session_data['username'];
		$data['status'] 		= $session_data['status'];
		$this->load->view('/layouts/menu', $data);
		$this->load->view('/penerimaan_surat/create_penerimaan_surat', $data);
		$this->load->view('/layouts/footer', $data);
	}

	function insert_penerimaan_surat() {
		$session_data = $this->session->userdata('mubasyirin_logged_in');
		if($session_data == NULL) {
			redirect("usercon/login", "refresh");
		}
		$data = array();
		$data['id'] 					= $this->penerimaansuratmodel->getNewId();
		$date1 							= $this->input->post('tanggal');
		$date 							= strtotime($date1);
		$data['tanggal'] 				= date("Y-m-d",$date);
		$data['id_petugas_lapangan'] 	= $this->input->post('id_petugas_lapangan');

		$this->penerimaansuratmodel->inputData($data);
		redirect('penerimaansuratcon');
	}

	function edit_penerimaan_surat($id) {
		$session_data = $this->session->userdata('mubasyirin_logged_in');
		if($session_data == NULL) {
			redirect("usercon/login", "refresh");
		}

		$data['data'] 		= $this->penerimaansuratmodel->get_data_by_id($id);

		$petugas_lapangan = $this->petugaslapanganmodel->showData();
		$temp = '';
		foreach ($petugas_lapangan as $petugas) {
			$temp = $temp.'{"stateCode": "'.$petugas["id"].'", "stateDisplay": "'.$petugas["nama"].'", "stateName": "'.$petugas["nama"].' | '.$petugas["nik"].'"},';
		}
		$temp=substr_replace($temp ,"",-1);
		$temp=trim(preg_replace('/\s+/', ' ', $temp));
		$data['petugas_lapangan']		= $temp;

		$data['username'] 	= $session_data['username'];
		$data['status'] 	= $session_data['status'];
		
		$this->load->view('/layouts/menu', $data);
		$this->load->view('/penerimaan_surat/edit_penerimaan_surat', $data);
		$this->load->view('/layouts/footer', $data);
	}

	function update_penerimaan_surat() {
		$session_data = $this->session->userdata('mubasyirin_logged_in');
		if($session_data == NULL) {
			redirect("usercon/login", "refresh");
		}
		$data = array();
		$id 							= $this->input->post('id');
		$date1 							= $this->input->post('tanggal');
		$date 							= strtotime($date1);
		$data['tanggal'] 				= date("Y-m-d",$date);
		$data['id_petugas_lapangan'] 	= $this->input->post('id_petugas_lapangan');

		$this->penerimaansuratmodel->updateData($id, $data);
		redirect('penerimaansuratcon');
	}

	function view_penerimaan_surat($id) {
		$session_data = $this->session->userdata('mubasyirin_logged_in');
		if($session_data == NULL) {
			redirect("usercon/login", "refresh");
		}

		$data['data'] 		= $this->penerimaansuratmodel->get_data_by_id($id);
		$data['detail']		= $this->detailpenerimaansuratmodel->get_detail_penerimaan_surat_by_id_penerimaan_surat($id);

		$nasabah = $this->nasabahmodel->showData();
		$temp = '';
		foreach ($nasabah as $n) {
			$temp = $temp.'{"id": "'.$n["id"].'", "nama": "'.$n["nama"].'", "nomor_nasabah": "'.$n["nomor_koperasi"].'", "display": "'.$n["nama"].' | '.$n["nomor_koperasi"].'"},';
		}
		$temp=substr_replace($temp ,"",-1);
		$temp=trim(preg_replace('/\s+/', ' ', $temp));
		$data['nasabah']		= $temp;

		$data['username'] 	= $session_data['username'];
		$data['status'] 	= $session_data['status'];
		
		$this->load->view('/layouts/menu', $data);
		$this->load->view('/penerimaan_surat/view_penerimaan_surat', $data);
		$this->load->view('/layouts/footer', $data);
	}

	function delete_penerimaan_surat($id) {
		$session_data = $this->session->userdata('mubasyirin_logged_in');
		if($session_data == NULL) {
			redirect("usercon/login", "refresh");
		}
		$this->penerimaansuratmodel->deleteData($id);
		$this->detailpenerimaansuratmodel->delete_by_id_penerimaan_surat($id);
		redirect('penerimaansuratcon');		
	}

	function insert_detail_penerimaan_surat($id_penerimaan_surat) {
		$session_data = $this->session->userdata('mubasyirin_logged_in');
		if($session_data == NULL) {
			redirect("usercon/login", "refresh");
		}

		$id_nasabah = $this->input->post('id_nasabah');
		$tanggal_surat = $this->input->post('tanggal_surat');

		$pinjaman = $this->pinjamanmodel->get_data_penerimaan_surat_by_id_nasabah($id_nasabah);

		for($a = 0; $a < sizeof($pinjaman); $a++) {
			$saldo = $pinjaman[$a]['total_pinjaman_detail'] - $pinjaman[$a]['total_angsuran_detail'];
			$tanggal_laporan = date('Y-m-d', strtotime($tanggal_surat));
	        $today = new DateTime($tanggal_laporan);

	        $sisa_kali_angsuran = $pinjaman[$a]['jumlah_angsuran'] - $pinjaman[$a]['jumlah_angsuran_detail'];
		    $tanggal_pinjaman = date('Y-m-d', strtotime($pinjaman[$a]['tanggal_pinjaman']));
	        $tgl_pinjaman = date('d-m-Y', strtotime($pinjaman[$a]['tanggal_pinjaman']));
			$tanggal_pinjaman = new DateTime($tanggal_pinjaman);
		    
		    $tgl_akhir_bayar = date('Y-m-d', strtotime($pinjaman[$a]['waktu_terakhir_angsuran']));
		    $tgl_terakhir_bayar = date('d-m-Y', strtotime($pinjaman[$a]['waktu_terakhir_angsuran']));
		    $tgl_akhir_bayar = new DateTime($tgl_terakhir_bayar);

		    if($pinjaman[$a]['jenis_pinjaman'] == 'Angsuran') {
		    	$jatuh_tempo = date('Y-m-d', strtotime($pinjaman[$a]['jatuh_tempo']));
			    $tgl_jatuh_tempo = date('d-m-Y', strtotime($pinjaman[$a]['jatuh_tempo']));
			    $jatuh_tempo = new DateTime($jatuh_tempo);

			    if($today < $jatuh_tempo) {
	            	$lama_pinjam = 0;
	            	$lama_pinjam_long = '0 Tahun 0 Bulan 0 Hari';
	            	$bulan_pinjam = 0;
	            	$lama_pinjam_bulan_hari = '0 Bulan 0 Hari';
	            	
	            	$lama_jatuh_tempo = 0;
	            	$lama_jatuh_tempo_long = '0 Tahun 0 Bulan 0 Hari';
	            	$bulan_jatuh_tempo = 0;
	            	$lama_jatuh_tempo_bulan_hari = '0 Bulan 0 Hari';
	            } else {
	            	$lama_pinjam = $today->diff($tgl_akhir_bayar)->format("%a");
	            	$lama_pinjam_raw = $today->diff($tgl_akhir_bayar);
	            	$lama_pinjam_long = $lama_pinjam_raw->y." Tahun ".$lama_pinjam_raw->m." Bulan ".$lama_pinjam_raw->d." Hari";
	            	$bulan_pinjam = (($lama_pinjam_raw->format('%y') * 12) + $lama_pinjam_raw->format('%m'));
	            	$lama_pinjam_bulan_hari = $bulan_pinjam." Bulan ".$lama_pinjam_raw->d." Hari";
	            	if($lama_pinjam <= 30) {
	            		$lama_jatuh_tempo = 0;
	            		$lama_jatuh_tempo_long = '0 Tahun 0 Bulan 0 Hari';
	            		$lama_jatuh_tempo_bulan_hari = '0 Bulan 0 Hari';
	            	} else {
	            		$lama_jatuh_tempo = $today->diff($jatuh_tempo)->format("%a");
	            		$lama_jatuh_tempo_raw = $today->diff($jatuh_tempo);
	            		$lama_jatuh_tempo_long = $lama_jatuh_tempo_raw->y." Tahun ".$lama_jatuh_tempo_raw->m." Bulan ".$lama_jatuh_tempo_raw->d." Hari";
	            		$bulan_jatuh_tempo = (($lama_jatuh_tempo_raw->format('%y') * 12) + $lama_jatuh_tempo_raw->format('%m'));
	            		$lama_jatuh_tempo_bulan_hari = $bulan_jatuh_tempo." Bulan ".$lama_jatuh_tempo_raw->d." Hari";
	            	}
	            }

	    		if ($lama_jatuh_tempo == 0) {
	                $pinjaman[$a]['keterangan'] = '';
	                $pinjaman[$a]['keterangan_level'] = -1;
	            } else if ($lama_jatuh_tempo >= 5 && $lama_jatuh_tempo <= 11) {
	                $pinjaman[$a]['keterangan'] = 'Hijau';
	                $pinjaman[$a]['keterangan_level'] = 0;
	            } else if($lama_jatuh_tempo > 11 && $lama_jatuh_tempo <= 30) {
	                $pinjaman[$a]['keterangan'] = 'Kuning 1';
	                $pinjaman[$a]['keterangan_level'] = 1;
	            } else if ($lama_jatuh_tempo > 30 && $lama_jatuh_tempo <= 90) {
	                $pinjaman[$a]['keterangan'] = 'Kuning 2';
	                $pinjaman[$a]['keterangan_level'] = 2;
	            } else if ($lama_jatuh_tempo > 90) {
	                $pinjaman[$a]['keterangan'] = 'Merah';
	                $pinjaman[$a]['keterangan_level'] = 3;
	            }
	            $pinjaman[$a]['sisa_kali_angsuran'] 			= $sisa_kali_angsuran;
	            $pinjaman[$a]['today'] 							= $tanggal_laporan;
	            $pinjaman[$a]['tgl_pinjaman'] 			        = $tgl_pinjaman;
	            $pinjaman[$a]['tgl_terakhir_bayar']             = $tgl_terakhir_bayar;
	            $pinjaman[$a]['tgl_jatuh_tempo'] 				= $tgl_jatuh_tempo;
	            $pinjaman[$a]['saldo'] 							= $saldo;
	            $pinjaman[$a]['lama_pinjam'] 					= $lama_pinjam;
	            $pinjaman[$a]['lama_pinjam_long'] 				= $lama_pinjam_long;
	            $pinjaman[$a]['lama_pinjam_bulan_hari'] 		= $lama_pinjam_bulan_hari;
	            $pinjaman[$a]['lama_jatuh_tempo'] 				= $lama_jatuh_tempo;
	            $pinjaman[$a]['lama_jatuh_tempo_long'] 			= $lama_jatuh_tempo_long;
	            $pinjaman[$a]['lama_jatuh_tempo_bulan_hari'] 	= $lama_jatuh_tempo_bulan_hari;

		    } else if($pinjaman[$a]['jenis_pinjaman'] == 'Musiman') {
		    	$jatuh_tempo = date('Y-m-d', strtotime($pinjaman[$a]['tanggal_pinjaman'].' + 120 days'));
	            $tgl_jatuh_tempo = date('d-m-Y', strtotime($pinjaman[$a]['tanggal_pinjaman'].' + 120 days'));
	            $jatuh_tempo = new DateTime($jatuh_tempo);

	            if($today < $tanggal_pinjaman) {
	            	$lama_pinjam = 0;
	            	$lama_pinjam_long = '0 Tahun 0 Bulan 0 Hari';
	            	$lama_pinjam_bulan_hari = '0 Bulan 0 Hari';
	            	$lama_jatuh_tempo = 0;
	            	$lama_jatuh_tempo_long = '0 Tahun 0 Bulan 0 Hari';
	            	$lama_jatuh_tempo_bulan_hari = '0 Bulan 0 Hari';
	            } else {
	            	$lama_pinjam = $today->diff($tanggal_pinjaman)->format("%a");
	            	$lama_pinjam_raw = $today->diff($tanggal_pinjaman);
	            	$lama_pinjam_long = $lama_pinjam_raw->y." Tahun ".$lama_pinjam_raw->m." Bulan ".$lama_pinjam_raw->d." Hari";
	            	$bulan_pinjam = (($lama_pinjam_raw->format('%y') * 12) + $lama_pinjam_raw->format('%m'));
	            	$lama_pinjam_bulan_hari = $bulan_pinjam." Bulan ".$lama_pinjam_raw->d." Hari";
	            	if($lama_pinjam <= 120) {
	            		$lama_jatuh_tempo = 0;
	            		$lama_jatuh_tempo_long = '0 Tahun 0 Bulan 0 Hari';
	            		$lama_jatuh_tempo_bulan_hari = '0 Bulan 0 Hari';
	            	} else {
	            		$lama_jatuh_tempo = $today->diff($jatuh_tempo)->format("%a");
	            		$lama_jatuh_tempo_raw = $today->diff($jatuh_tempo);
	            		$lama_jatuh_tempo_long = $lama_jatuh_tempo_raw->y." Tahun ".$lama_jatuh_tempo_raw->m." Bulan ".$lama_jatuh_tempo_raw->d." Hari";
	            		$bulan_jatuh_tempo = (($lama_jatuh_tempo_raw->format('%y') * 12) + $lama_jatuh_tempo_raw->format('%m'));
	            		$lama_jatuh_tempo_bulan_hari = $bulan_jatuh_tempo." Bulan ".$lama_jatuh_tempo_raw->d." Hari";
	            	}
	            }

	       		/*$pinjaman[$a]['keterangan'] = 'Hijau';
	    		$pinjaman[$a]['keterangan_level'] = 0;
	       		if ($lama_pinjam > 120 && $lama_pinjam <= 240) {
	                $data[$a]['keterangan'] = 'Kuning 1';
	                $data[$a]['keterangan_level'] = 1;
	            } else if ($lama_pinjam > 240 && $lama_pinjam <= 365) {
	                $data[$a]['keterangan'] = 'Kuning 2';
	                $data[$a]['keterangan_level'] = 2;
	            } else if ($lama_pinjam > 365 && $lama_pinjam <= 730) {
	                $data[$a]['keterangan'] = 'Merah 1';
	                $data[$a]['keterangan_level'] = 3;
	            } else if ($lama_pinjam > 730) {
	                $data[$a]['keterangan'] = 'Merah 2';
	                $data[$a]['keterangan_level'] = 4;
	            }*/
	            if ($lama_pinjam >= 125 && $lama_pinjam <= 131) {
	                $pinjaman[$a]['keterangan'] = 'Hijau';
	                $pinjaman[$a]['keterangan_level'] = 0;
	            } else if ($lama_pinjam > 131 && $lama_pinjam <= 180) {
	                $pinjaman[$a]['keterangan'] = 'Kuning 1';
	                $pinjaman[$a]['keterangan_level'] = 1;
	            } else if ($lama_pinjam > 180 && $lama_pinjam <= 240) {
	                $pinjaman[$a]['keterangan'] = 'Kuning 2';
	                $pinjaman[$a]['keterangan_level'] = 2;
	            } else if ($lama_pinjam > 240) {
	                $pinjaman[$a]['keterangan'] = 'Merah';
	                $pinjaman[$a]['keterangan_level'] = 3;
	            }
	            $pinjaman[$a]['sisa_kali_angsuran'] 			= $sisa_kali_angsuran;
	            $pinjaman[$a]['today'] 							= $tanggal_laporan;
	            $pinjaman[$a]['tgl_pinjaman']                   = $tgl_pinjaman;
	            $pinjaman[$a]['tgl_terakhir_bayar'] 			= $tgl_terakhir_bayar;
	            $pinjaman[$a]['tgl_jatuh_tempo'] 				= $tgl_jatuh_tempo;
	            $pinjaman[$a]['saldo'] 							= $saldo;
	            $pinjaman[$a]['lama_pinjam'] 					= $lama_pinjam;
	            $pinjaman[$a]['lama_pinjam_long'] 				= $lama_pinjam_long;
	            $pinjaman[$a]['lama_pinjam_bulan_hari'] 		= $lama_pinjam_bulan_hari;
	            $pinjaman[$a]['lama_jatuh_tempo'] 				= $lama_jatuh_tempo;
	            $pinjaman[$a]['lama_jatuh_tempo_long'] 			= $lama_jatuh_tempo_long;
	            $pinjaman[$a]['lama_jatuh_tempo_bulan_hari'] 	= $lama_jatuh_tempo_bulan_hari;
		    }
		    if($pinjaman[$a]['jumlah_angsuran'] != 0) {
	            $angsuran_perbulan = $pinjaman[$a]['jumlah_pinjaman'] / $pinjaman[$a]['jumlah_angsuran'];    
	        } else {
	            $angsuran_perbulan = 0;
	        }
			if($bulan_pinjam > ($pinjaman[$a]['jumlah_angsuran'] - $pinjaman[$a]['jumlah_angsuran_detail'])) {
	            $sisa_pinjaman = $pinjaman[$a]['total_pinjaman_detail'] - $pinjaman[$a]['total_angsuran_detail'];
	        } else {
	            $sisa_pinjaman = $angsuran_perbulan * $bulan_pinjam;
	        }

			$kali_administrasi = $bulan_pinjam / 4;
	        $kali_administrasi = (int)$kali_administrasi;

	        if($pinjaman[$a]['keterangan_level'] == 1) {
	            if($pinjaman[$a]['jenis_pinjaman'] == 'Angsuran') {
	                $jasa_pinjaman = ($pinjaman[$a]['total_pinjaman_detail'] * $bulan_pinjam * 2) / 100;    
	            } else if($pinjaman[$a]['jenis_pinjaman'] == 'Musiman') {
	                $jasa_pinjaman = ($sisa_pinjaman * $bulan_pinjam * 2) / 100;
	            }            
	            $biaya_administrasi = 0;
	        } else {
	            $jasa_pinjaman = ($sisa_pinjaman * $bulan_pinjam * 3) / 100;
	            $biaya_administrasi = ($sisa_pinjaman * $bulan_pinjam) / 100;
	        }
	        $total_tagihan = $sisa_pinjaman + $jasa_pinjaman + $biaya_administrasi;

	        $pinjaman[$a]['angsuran_perbulan'] 	= (int)$angsuran_perbulan;
	        $pinjaman[$a]['sisa_pinjaman'] 		= (int)$sisa_pinjaman;
	        $pinjaman[$a]['kali_administrasi'] 	= $kali_administrasi;
	        $pinjaman[$a]['jasa_pinjaman'] 		= (int)$jasa_pinjaman;
	        $pinjaman[$a]['biaya_administrasi'] = (int)$biaya_administrasi;
	        $pinjaman[$a]['total_tagihan'] 		= (int)$total_tagihan;
		}

		/*echo "<pre>";
		var_dump($pinjaman);
		echo "</pre>";*/
		$input = array();
		$i = 0;
		for($a = 0; $a < sizeof($pinjaman); $a++) {
			$tanggungan_jasa = $pinjaman[$a]['jasa_pinjaman'] - $pinjaman[$a]['total_jasa_detail'];
			//if(($pinjaman[$a]['saldo'] != 0 || $tanggungan_jasa > 0) && $pinjaman[$a]['keterangan_level'] != 0) {
			if(($pinjaman[$a]['saldo'] != 0 || $tanggungan_jasa > 0)) {
				$input[$i]['id'] 							= $this->detailpenerimaansuratmodel->getNewId();
				$input[$i]['id_penerimaan_surat'] 			= $id_penerimaan_surat;
				$input[$i]['id_nasabah'] 					= $pinjaman[$a]['id_nasabah'];
				$input[$i]['tanggal_input'] 				= date("Y-m-d");
				$input[$i]['nomor_nasabah'] 				= $pinjaman[$a]['nomor_koperasi'];
				$input[$i]['nama_nasabah'] 					= $pinjaman[$a]['nama'];
				$input[$i]['kelurahan'] 					= $pinjaman[$a]['kelurahan'];
				$input[$i]['status_surat'] 					= $pinjaman[$a]['keterangan_level'];
				$input[$i]['jaminan'] 						= $pinjaman[$a]['jaminan'];
				$input[$i]['tanggal_pinjaman'] 				= $pinjaman[$a]['tanggal_pinjaman'];
				$input[$i]['jenis_pinjaman'] 				= $pinjaman[$a]['jenis_pinjaman'];
				//$input[$i]['sisa_pokok_pinjaman'] 			= (double)$pinjaman[$a]['saldo'];
				$input[$i]['sisa_pokok_pinjaman'] 			= (double)$pinjaman[$a]['sisa_pinjaman'];
				//$input[$i]['sisa_jasa'] 					= (double)$tanggungan_jasa;
				$input[$i]['sisa_jasa'] 					= (double)$pinjaman[$a]['jasa_pinjaman'];
				$input[$i]['bayar_pokok_pinjaman'] 			= 0;
				$input[$i]['bayar_jasa'] 					= 0;
				$input[$i]['tgl_terakhir_angsuran'] 		= $pinjaman[$a]['waktu_terakhir_angsuran'];
				$tgl_terakhir_bayar1 						= $pinjaman[$a]['tgl_terakhir_bayar'];
				$tgl_terakhir_bayar 						= strtotime($tgl_terakhir_bayar1);
				$input[$i]['tgl_terakhir_bayar'] 				= date("Y-m-d",$tgl_terakhir_bayar);
				$tgl_jatuh_tempo1 							= $pinjaman[$a]['tgl_jatuh_tempo'];
				$tgl_jatuh_tempo 							= strtotime($tgl_jatuh_tempo1);
				$input[$i]['tgl_jatuh_tempo'] 				= date("Y-m-d",$tgl_jatuh_tempo);
				$input[$i]['lama_pinjam']					= (int)$pinjaman[$a]['lama_pinjam'];
				$input[$i]['lama_pinjam_long']				= $pinjaman[$a]['lama_pinjam_long'];
				$input[$i]['lama_pinjam_bulan_hari']		= $pinjaman[$a]['lama_pinjam_bulan_hari'];
				$input[$i]['lama_jatuh_tempo']				= (int)$pinjaman[$a]['lama_jatuh_tempo'];
				$input[$i]['lama_jatuh_tempo_long']			= $pinjaman[$a]['lama_jatuh_tempo_long'];
				$input[$i]['lama_jatuh_tempo_bulan_hari']	= $pinjaman[$a]['lama_jatuh_tempo_bulan_hari'];
				$input[$i]['kali_administrasi']				= (int)$pinjaman[$a]['kali_administrasi'];
				$input[$i]['biaya_administrasi']			= (double)$pinjaman[$a]['biaya_administrasi'];
				$this->detailpenerimaansuratmodel->inputData($input[$i]);
				$i++;
			}
		}
		/*echo "<pre>";
		var_dump($input);
		echo "</pre>";*/
		redirect('penerimaansuratcon/view_penerimaan_surat/'.$id_penerimaan_surat);
	}

	function edit_detail_penerimaan_surat($id_detail_penerimaan_surat) {
		$session_data = $this->session->userdata('mubasyirin_logged_in');
		if($session_data == NULL) {
			redirect("usercon/login", "refresh");
		}
		$data = array();
		$data['detail'] = $this->detailpenerimaansuratmodel->get_detail_penerimaan_surat_by_id($id_detail_penerimaan_surat);
		$data['penerimaan_surat'] = $this->penerimaansuratmodel->get_data_by_id($data['detail']->id_penerimaan_surat);

		$data['username'] 	= $session_data['username'];
		$data['status'] 	= $session_data['status'];

		$this->load->view('/layouts/menu', $data);
		$this->load->view('/penerimaan_surat/edit_detail_penerimaan_surat', $data);
		$this->load->view('/layouts/footer', $data);
	}

	function update_detail_penerimaan_surat() {
		$session_data = $this->session->userdata('mubasyirin_logged_in');
		if($session_data == NULL) {
			redirect("usercon/login", "refresh");
		}
		$update 						= array();
		$id 							= $this->input->post('id');
		$id_penerimaan_surat 			= $this->input->post('id_penerimaan_surat');
		$update['bayar_pokok_pinjaman'] = $this->input->post('bayar_pokok_pinjaman');
		$update['bayar_jasa'] 			= $this->input->post('bayar_jasa');
		$this->detailpenerimaansuratmodel->updateData($id, $update);
		redirect('penerimaansuratcon/view_penerimaan_surat/'.$id_penerimaan_surat);
	}

	function delete_detail_penerimaan_surat($id_penerimaan_surat, $id_detail_penerimaan_surat) {
		$session_data = $this->session->userdata('mubasyirin_logged_in');
		if($session_data == NULL) {
			redirect("usercon/login", "refresh");
		}

		$detail_penerimaan_surat = $this->detailpenerimaansuratmodel->deleteData($id_detail_penerimaan_surat);
		redirect('penerimaansuratcon/view_penerimaan_surat/'.$id_penerimaan_surat);
	}

	function print_penerimaan_surat($id_penerimaan_surat) {
		$session_data = $this->session->userdata('mubasyirin_logged_in');
        if($session_data == NULL) {
            redirect("usercon/login", "refresh");
        }

        $data = array();
        $data['data'] = $this->penerimaansuratmodel->get_data_by_id($id_penerimaan_surat);
        $data['detail'] = $this->detailpenerimaansuratmodel->get_detail_penerimaan_surat_by_id_penerimaan_surat($id_penerimaan_surat);

        $pdf = $this->load->view('/penerimaan_surat/print_penerimaan_surat', $data, true);

        $filename = "Surat Tagihan_".$data['data']->nama_petugas_lapangan."_".$data['data']->tanggal;

        $this->pdfgenerator->generate($pdf,$filename);
	}
}

?>