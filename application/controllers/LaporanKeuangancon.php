<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class LaporanKeuanganCon extends CI_Controller {
	function __construct() {
		parent::__construct();

		$this->load->model('usermodel');
		$this->load->model('nasabahmodel');
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
		$this->load->view('/laporan/keuangan', $data);
		$this->load->view('/layouts/footer', $data);	
	}	

	function view($dari, $sampai) {
		$session_data = $this->session->userdata('logged_in');
		if($session_data == NULL) {
			redirect("usercon/login", "refresh");
		}

		$data['username'] 	= $session_data['username'];
		$data['status'] 	= $session_data['status'];
		$data['nasabah'] 	= $this->nasabahmodel->showData();

		$transaksi_aset 		= $this->transaksiakuntansimodel->get_jumlah_by_dari_sampai_first_char($dari, $sampai, '1');
		$transaksi_hutang 		= $this->transaksiakuntansimodel->get_jumlah_by_dari_sampai_first_char($dari, $sampai, '2');
		$transaksi_modal 		= $this->transaksiakuntansimodel->get_jumlah_by_dari_sampai_first_char($dari, $sampai, '3');
		$transaksi_pendapatan 	= $this->transaksiakuntansimodel->get_jumlah_by_dari_sampai_first_char($dari, $sampai, '4');
		$transaksi_beban 		= $this->transaksiakuntansimodel->get_jumlah_by_dari_sampai_first_char($dari, $sampai, '5');

		$kode_aset 			= $this->kodeakunmodel->get_kode_akun_by_first_char('1');
		$kode_hutang 		= $this->kodeakunmodel->get_kode_akun_by_first_char('2');
		$kode_modal 		= $this->kodeakunmodel->get_kode_akun_by_first_char('3');
		$kode_pendapatan 	= $this->kodeakunmodel->get_kode_akun_by_first_char('4');
		$kode_beban 		= $this->kodeakunmodel->get_kode_akun_by_first_char('5');

		$total_aset = 0;
		for($i = 0; $i < sizeof($kode_aset); $i++) {
			for($a = 0; $a < sizeof($transaksi_aset); $a++) {
				if($kode_aset[$i]['kode_akun'] == $transaksi_aset[$a]['kode_akun']) {
					$kode_aset[$i]['debet'] 	= $transaksi_aset[$a]['jumlah_debet'];
					$kode_aset[$i]['kredit'] 	= $transaksi_aset[$a]['jumlah_kredit'];
					if($kode_aset[$i]['kode_akun'] == '105') {
						$kode_aset[$i]['selisih']	= $transaksi_aset[$a]['jumlah_kredit'] - $transaksi_aset[$a]['jumlah_debet'];
						$total_aset 				-= $kode_aset[$i]['selisih'];
					} else {
						$kode_aset[$i]['selisih']	= $transaksi_aset[$a]['jumlah_debet'] - $transaksi_aset[$a]['jumlah_kredit'];
						$total_aset 				+= $kode_aset[$i]['selisih'];
					}
					
				}
			}
		}

		$total_hutang = 0;
		for($i = 0; $i < sizeof($kode_hutang); $i++) {
			for($a = 0; $a < sizeof($transaksi_hutang); $a++) {
				if($kode_hutang[$i]['kode_akun'] == $transaksi_hutang[$a]['kode_akun']) {
					$kode_hutang[$i]['debet'] 	= $transaksi_hutang[$a]['jumlah_debet'];
					$kode_hutang[$i]['kredit'] 	= $transaksi_hutang[$a]['jumlah_kredit'];
					$kode_hutang[$i]['selisih']	= $transaksi_hutang[$a]['jumlah_kredit'] - $transaksi_hutang[$a]['jumlah_debet'];
					$total_hutang 				+= $kode_hutang[$i]['selisih'];
				}
			}
		}

		$total_modal = 0;
		for($i = 0; $i < sizeof($kode_modal); $i++) {
			for($a = 0; $a < sizeof($transaksi_modal); $a++) {
				if($kode_modal[$i]['kode_akun'] == $transaksi_modal[$a]['kode_akun']) {
					$kode_modal[$i]['debet'] 	= $transaksi_modal[$a]['jumlah_debet'];
					$kode_modal[$i]['kredit'] 	= $transaksi_modal[$a]['jumlah_kredit'];
					$kode_modal[$i]['selisih']	= $transaksi_modal[$a]['jumlah_kredit'] - $transaksi_modal[$a]['jumlah_debet'];
					//$total_modal 				+= $kode_modal[$i]['selisih'];
				}
			}
		}

		$total_pendapatan = 0;
		for($i = 0; $i < sizeof($kode_pendapatan); $i++) {
			for($a = 0; $a < sizeof($transaksi_pendapatan); $a++) {
				if($kode_pendapatan[$i]['kode_akun'] == $transaksi_pendapatan[$a]['kode_akun']) {
					$kode_pendapatan[$i]['debet'] 	= $transaksi_pendapatan[$a]['jumlah_debet'];
					$kode_pendapatan[$i]['kredit'] 	= $transaksi_pendapatan[$a]['jumlah_kredit'];
					$kode_pendapatan[$i]['selisih']	= $transaksi_pendapatan[$a]['jumlah_kredit'] - $transaksi_pendapatan[$a]['jumlah_debet'];
					$total_pendapatan 				+= $kode_pendapatan[$i]['selisih'];
				}
			}
		}

		$total_beban = 0;
		for($i = 0; $i < sizeof($kode_beban); $i++) {
			for($a = 0; $a < sizeof($transaksi_beban); $a++) {
				if($kode_beban[$i]['kode_akun'] == $transaksi_beban[$a]['kode_akun']) {
					$kode_beban[$i]['debet'] 	= $transaksi_beban[$a]['jumlah_debet'];
					$kode_beban[$i]['kredit'] 	= $transaksi_beban[$a]['jumlah_kredit'];
					$kode_beban[$i]['selisih']	= $transaksi_beban[$a]['jumlah_debet'] - $transaksi_beban[$a]['jumlah_kredit'];
					$total_beban 				+= $kode_beban[$i]['selisih'];
				}
			}
		}
		$data['kode_aset']			= $kode_aset;
		$data['total_aset']			= $total_aset;
		$data['kode_hutang']		= $kode_hutang;
		$data['total_hutang']		= $total_hutang;
		$data['kode_modal']			= $kode_modal;
		$data['total_modal']		= $total_modal;
		$data['kode_pendapatan']	= $kode_pendapatan;
		$data['total_pendapatan']	= $total_pendapatan;
		$data['kode_beban']			= $kode_beban;
		$data['total_beban']		= $total_beban;

		$this->load->view('/layouts/menu', $data);
		$this->load->view('/laporan/keuangan', $data);
		$this->load->view('/layouts/footer', $data);
	}

	function excel() {
		$session_data = $this->session->userdata('logged_in');
		if($session_data == NULL) {
			redirect("usercon/login", "refresh");
		}

		$tgl_dari1 	= $this->input->post('dari');
		$tgl_dari 	= strtotime($tgl_dari1);
		$dari 		= date("Y-m-d",$tgl_dari);

		$tgl_sampai1	= $this->input->post('sampai');
		$tgl_sampai 	= strtotime($tgl_sampai1);
		$sampai 		= date("Y-m-d",$tgl_sampai);

		if($dari < '2019-01-01' && $sampai < '2019-01-01') {
			$transaksi_prev_aset	= $this->transaksiakuntansimodel->get_jumlah_by_sampai_first_char($dari, '1');
			$transaksi_prev_hutang	= $this->transaksiakuntansimodel->get_jumlah_by_sampai_first_char($dari, '2');
			$transaksi_prev_modal	= $this->transaksiakuntansimodel->get_jumlah_by_sampai_first_char($dari, '3');

			$transaksi_aset 		= $this->transaksiakuntansimodel->get_jumlah_by_dari_sampai_first_char($dari, $sampai, '1');
			$transaksi_hutang 		= $this->transaksiakuntansimodel->get_jumlah_by_dari_sampai_first_char($dari, $sampai, '2');
			$transaksi_modal 		= $this->transaksiakuntansimodel->get_jumlah_by_dari_sampai_first_char($dari, $sampai, '3');
		} else if($dari >= '2019-01-01' && $sampai >= '2019-01-01') {
			$transaksi_prev_aset	= $this->transaksiakuntansimodel->get_saldo_awal_by_dari_sampai_first_char($dari, $sampai, '1');
			$transaksi_prev_hutang	= $this->transaksiakuntansimodel->get_saldo_awal_by_dari_sampai_first_char($dari, $sampai, '2');
			$transaksi_prev_modal	= $this->transaksiakuntansimodel->get_saldo_awal_by_dari_sampai_first_char($dari, $sampai, '3');

			$transaksi_aset 		= $this->transaksiakuntansimodel->get_jumlah_by_dari_sampai_first_char_except_saldo_awal($dari, $sampai, '1');
			$transaksi_hutang 		= $this->transaksiakuntansimodel->get_jumlah_by_dari_sampai_first_char_except_saldo_awal($dari, $sampai, '2');
			$transaksi_modal 		= $this->transaksiakuntansimodel->get_jumlah_by_dari_sampai_first_char_except_saldo_awal($dari, $sampai, '3');	
		}
		
		$transaksi_pendapatan 	= $this->transaksiakuntansimodel->get_jumlah_by_dari_sampai_first_char($dari, $sampai, '4');
		$transaksi_beban 		= $this->transaksiakuntansimodel->get_jumlah_by_dari_sampai_first_char($dari, $sampai, '5');

		$kode_aset 			= $this->kodeakunmodel->get_kode_akun_by_first_char('1');
		$kode_hutang 		= $this->kodeakunmodel->get_kode_akun_by_first_char('2');
		$kode_modal 		= $this->kodeakunmodel->get_kode_akun_by_first_char('3');
		$kode_pendapatan 	= $this->kodeakunmodel->get_kode_akun_by_first_char('4');
		$kode_beban 		= $this->kodeakunmodel->get_kode_akun_by_first_char('5');

		// Sebelum Tanggal Dari
		$total_aset = 0;
		for($i = 0; $i < sizeof($kode_aset); $i++) {
			for($a = 0; $a < sizeof($transaksi_prev_aset); $a++) {
				if($kode_aset[$i]['kode_akun'] == $transaksi_prev_aset[$a]['kode_akun']) {
					$kode_aset[$i]['debet'] 	= $transaksi_prev_aset[$a]['jumlah_debet'];
					$kode_aset[$i]['kredit'] 	= $transaksi_prev_aset[$a]['jumlah_kredit'];
					if($kode_aset[$i]['kode_akun'] == '105') {
						$kode_aset[$i]['selisih']	+= $transaksi_prev_aset[$a]['jumlah_kredit'] - $transaksi_prev_aset[$a]['jumlah_debet'];
						$total_aset 				-= $kode_aset[$i]['selisih'];
					} else {
						$kode_aset[$i]['selisih']	+= $transaksi_prev_aset[$a]['jumlah_debet'] - $transaksi_prev_aset[$a]['jumlah_kredit'];
						$total_aset 				+= $kode_aset[$i]['selisih'];
					}
				}
			}
		}

		$total_hutang = 0;
		for($i = 0; $i < sizeof($kode_hutang); $i++) {
			for($a = 0; $a < sizeof($transaksi_prev_hutang); $a++) {
				if($kode_hutang[$i]['kode_akun'] == $transaksi_prev_hutang[$a]['kode_akun']) {
					$kode_hutang[$i]['debet'] 	= $transaksi_prev_hutang[$a]['jumlah_debet'];
					$kode_hutang[$i]['kredit'] 	= $transaksi_prev_hutang[$a]['jumlah_kredit'];
					$kode_hutang[$i]['selisih']	+= $transaksi_prev_hutang[$a]['jumlah_kredit'] - $transaksi_prev_hutang[$a]['jumlah_debet'];
					$total_hutang 				+= $kode_hutang[$i]['selisih'];
				}
			}
		}

		$total_modal = 0;
		for($i = 0; $i < sizeof($kode_modal); $i++) {
			if($kode_modal[$i]['kode_akun'] != '305') {
				for($a = 0; $a < sizeof($transaksi_prev_modal); $a++) {
					if($kode_modal[$i]['kode_akun'] == $transaksi_prev_modal[$a]['kode_akun']) {
						$kode_modal[$i]['debet'] 	= $transaksi_prev_modal[$a]['jumlah_debet'];
						$kode_modal[$i]['kredit'] 	= $transaksi_prev_modal[$a]['jumlah_kredit'];
						$kode_modal[$i]['selisih']	+= $transaksi_prev_modal[$a]['jumlah_kredit'] - $transaksi_prev_modal[$a]['jumlah_debet'];
						$total_modal 				+= $kode_modal[$i]['selisih'];
					}
				}		
			}
		}

		// Antara Dari dan Sampai
		//$total_aset = 0;
		for($i = 0; $i < sizeof($kode_aset); $i++) {
			for($a = 0; $a < sizeof($transaksi_aset); $a++) {
				if($kode_aset[$i]['kode_akun'] == $transaksi_aset[$a]['kode_akun']) {
					$kode_aset[$i]['debet'] 	= $transaksi_aset[$a]['jumlah_debet'];
					$kode_aset[$i]['kredit'] 	= $transaksi_aset[$a]['jumlah_kredit'];
					if($kode_aset[$i]['kode_akun'] == '105') {
						$kode_aset[$i]['selisih']	+= $transaksi_aset[$a]['jumlah_kredit'] - $transaksi_aset[$a]['jumlah_debet'];
						//$total_aset 				-= $kode_aset[$i]['selisih'];
						$total_aset 				-= $transaksi_aset[$a]['jumlah_kredit'] - $transaksi_aset[$a]['jumlah_debet'];
					} else {
						$kode_aset[$i]['selisih']	+= $transaksi_aset[$a]['jumlah_debet'] - $transaksi_aset[$a]['jumlah_kredit'];
						//$total_aset 				+= $kode_aset[$i]['selisih'];
						$total_aset 				+= $transaksi_aset[$a]['jumlah_debet'] - $transaksi_aset[$a]['jumlah_kredit'];
					}
				}
			}
		}

		//$total_hutang = 0;
		for($i = 0; $i < sizeof($kode_hutang); $i++) {
			for($a = 0; $a < sizeof($transaksi_hutang); $a++) {
				if($kode_hutang[$i]['kode_akun'] == $transaksi_hutang[$a]['kode_akun']) {
					$kode_hutang[$i]['debet'] 	= $transaksi_hutang[$a]['jumlah_debet'];
					$kode_hutang[$i]['kredit'] 	= $transaksi_hutang[$a]['jumlah_kredit'];
					$kode_hutang[$i]['selisih']	+= $transaksi_hutang[$a]['jumlah_kredit'] - $transaksi_hutang[$a]['jumlah_debet'];
					//$total_hutang 				+= $kode_hutang[$i]['selisih'];
					$total_hutang 				+= $transaksi_hutang[$a]['jumlah_kredit'] - $transaksi_hutang[$a]['jumlah_debet'];
				}
			}
		}

		//$total_modal = 0;
		for($i = 0; $i < sizeof($kode_modal); $i++) {
			for($a = 0; $a < sizeof($transaksi_modal); $a++) {
				if($kode_modal[$i]['kode_akun'] == $transaksi_modal[$a]['kode_akun']) {
					$kode_modal[$i]['debet'] 	= $transaksi_modal[$a]['jumlah_debet'];
					$kode_modal[$i]['kredit'] 	= $transaksi_modal[$a]['jumlah_kredit'];
					$kode_modal[$i]['selisih']	+= $transaksi_modal[$a]['jumlah_kredit'] - $transaksi_modal[$a]['jumlah_debet'];
					//$total_modal 				+= $kode_modal[$i]['selisih'];
					$total_modal 				+= $transaksi_modal[$a]['jumlah_kredit'] - $transaksi_modal[$a]['jumlah_debet'];
				}
			}
		}

		$total_pendapatan = 0;
		for($i = 0; $i < sizeof($kode_pendapatan); $i++) {
			for($a = 0; $a < sizeof($transaksi_pendapatan); $a++) {
				if($kode_pendapatan[$i]['kode_akun'] == $transaksi_pendapatan[$a]['kode_akun']) {
					$kode_pendapatan[$i]['debet'] 	= $transaksi_pendapatan[$a]['jumlah_debet'];
					$kode_pendapatan[$i]['kredit'] 	= $transaksi_pendapatan[$a]['jumlah_kredit'];
					$kode_pendapatan[$i]['selisih']	+= $transaksi_pendapatan[$a]['jumlah_kredit'] - $transaksi_pendapatan[$a]['jumlah_debet'];
					//$total_pendapatan 				+= $kode_pendapatan[$i]['selisih'];
					$total_pendapatan 				+= $transaksi_pendapatan[$a]['jumlah_kredit'] - $transaksi_pendapatan[$a]['jumlah_debet'];
				}
			}
		}

		$total_beban = 0;
		for($i = 0; $i < sizeof($kode_beban); $i++) {
			for($a = 0; $a < sizeof($transaksi_beban); $a++) {
				if($kode_beban[$i]['kode_akun'] == $transaksi_beban[$a]['kode_akun']) {
					$kode_beban[$i]['debet'] 	= $transaksi_beban[$a]['jumlah_debet'];
					$kode_beban[$i]['kredit'] 	= $transaksi_beban[$a]['jumlah_kredit'];
					$kode_beban[$i]['selisih']	+= $transaksi_beban[$a]['jumlah_debet'] - $transaksi_beban[$a]['jumlah_kredit'];
					//$total_beban 				+= $kode_beban[$i]['selisih'];
					$total_beban 				+= $transaksi_beban[$a]['jumlah_debet'] - $transaksi_beban[$a]['jumlah_kredit'];
				}
			}
		}

		/*echo "<pre>";
		var_dump($kode_aset);
		echo "</pre>";*/

		for($i = 0; $i < sizeof($kode_modal); $i++) {
			if($kode_modal[$i]['kode_akun'] == '305') {
				$kode_modal[$i]['selisih'] = $total_pendapatan - $total_beban;
				$total_modal 				+= $kode_modal[$i]['selisih'];
			}
		}

		/*$total_modal = 0;
		for($i = 0; $i < sizeof($kode_modal); $i++) {
			for($a = 0; $a < sizeof($transaksi_modal); $a++) {
				if($kode_modal[$i]['kode_akun'] == $transaksi_modal[$a]['kode_akun']) {
					$kode_modal[$i]['debet'] 	= $transaksi_modal[$a]['jumlah_debet'];
					$kode_modal[$i]['kredit'] 	= $transaksi_modal[$a]['jumlah_kredit'];$kode_modal[$i]['selisih']	= $transaksi_modal[$a]['jumlah_kredit'] - $transaksi_modal[$a]['jumlah_debet'];
					$total_modal 				+= $kode_modal[$i]['selisih'];
				}
				if($kode_modal[$i]['kode_akun'] == '305') {
					$kode_modal[$i]['selisih'] = $total_pendapatan - $total_beban;
					$total_modal 				+= $kode_modal[$i]['selisih'];
				}

			}
		}*/

		/*echo "<pre>";
		var_dump($kode_modal);
		echo "</pre>";*/

        $file = new PHPExcel ();
        $file->getProperties ()->setCreator ( "YHM" );
        $file->getProperties ()->setLastModifiedBy ( "System" );
        $file->getProperties ()->setTitle ( "Laporan Keuangan" );
        $file->getProperties ()->setSubject ( "Laporan Keuangan" );
        $file->getProperties ()->setDescription ( "Laporan Keuangan" );
        $file->getProperties ()->setKeywords ( "Laporan Keuangan" );
        $file->getProperties ()->setCategory ( "Laporan Keuangan" );
        
        $sheet = $file->getActiveSheet ();
        $i = 2;

        $sheet->mergeCells("A".$i.":G".$i)->setCellValue("A".$i, "KOPPONTREN MAMBAUL MUBBASYIRIN SHIDDIQIYYAH");
        $sheet->getStyle("A".$i.":G".$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle("A".$i.":G".$i)->getFont()->setSize(14)->setBold(true);
        $i++;
        $sheet->mergeCells("A".$i.":G".$i)->setCellValue("A".$i, "LAPORAN KEUANGAN ".$tgl_dari1." - ".$tgl_sampai1);
        $sheet->getStyle("A".$i.":G".$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle("A".$i.":G".$i)->getFont()->setSize(12)->setBold(true);
        $i++;
        $sheet->mergeCells("A".$i.":G".$i)->setCellValue("A".$i, "KANTOR PONPES MAJMA'AL BAHRAIN SHIDDIQIYYAH");
        $sheet->getStyle("A".$i.":G".$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle("A".$i.":G".$i)->getFont()->setSize(10)->setBold(true);
        $i++;
        $sheet->mergeCells("A".$i.":G".$i)->setCellValue("A".$i, "NGRASEH DANDER BOJONEGORO  TELP (0353) 886039       BH : 8181/BH/II/95");
        $sheet->getStyle("A".$i.":G".$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle("A".$i.":G".$i)->getFont()->setSize(10)->setBold(true);
        $i += 2;

        $index_kiri     = $i;
        $index_kanan    = $i;
        $border_start   = $i;

        /* KIRI */
        $sheet->mergeCells("A".$index_kiri.":C".$index_kiri)->setCellValue("A".$index_kiri, "NERACA");
        $sheet->getStyle("A".$index_kiri.":C".$index_kiri)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle("A".$index_kiri.":C".$index_kiri)->getFont()->setSize(12)->setBold(true);
        $index_kiri++;

        /* AKTIVA (ASET) */
        $sheet->setCellValue("A".$index_kiri, "NO");
        $sheet->setCellValue("B".$index_kiri, "AKTIVA");
        $sheet->setCellValue("C".$index_kiri, "JUMLAH");
        $sheet->getStyle("A".$index_kiri.":C".$index_kiri)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle("A".$index_kiri.":C".$index_kiri)->getFont()->setSize(10)->setBold(true);
        $index_kiri++;
        $sheet->setCellValue("B".$index_kiri, "HARTA");
        $sheet->getStyle("B".$index_kiri)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle("B".$index_kiri)->getFont()->setSize(10)->setBold(true);
        $index_kiri++;
        for($i = 0; $i < sizeof($kode_aset); $i++) {
        	if($kode_aset[$i]['selisih'] != 0) {
        		$sheet->setCellValue("A".$index_kiri, $kode_aset[$i]['kode_akun']);
                $sheet->getStyle("A".$index_kiri)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                $sheet->setCellValue("B".$index_kiri, $kode_aset[$i]['nama_akun']);
                $sheet->setCellValue("C".$index_kiri, $kode_aset[$i]['selisih']);
                $sheet->getStyle("C".$index_kiri)->getNumberFormat()->setFormatCode('#,##0');
                $index_kiri++;
        	}
        }
        $sheet->setCellValue("B".$index_kiri, "JUMLAH AKTIVA");
        $sheet->setCellValue("C".$index_kiri, $total_aset);
        $sheet->getStyle("C".$index_kiri)->getNumberFormat()->setFormatCode('#,##0');
        $sheet->getStyle("B".$index_kiri)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle("A".$index_kiri.":C".$index_kiri)->getFont()->setSize(10)->setBold(true);
        $index_kiri += 2;
        /* END OF AKTIVA (ASET) */

        /* PASIVA */
        $sheet->setCellValue("A".$index_kiri, "NO");
        $sheet->setCellValue("B".$index_kiri, "PASIVA");
        $sheet->setCellValue("C".$index_kiri, "JUMLAH");
        $sheet->getStyle("A".$index_kiri.":C".$index_kiri)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle("A".$index_kiri.":C".$index_kiri)->getFont()->setSize(10)->setBold(true);
        $index_kiri++;
        /* Hutang */
        $sheet->setCellValue("B".$index_kiri, "HUTANG");
        $sheet->getStyle("B".$index_kiri)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle("B".$index_kiri)->getFont()->setSize(10)->setBold(true);
        $index_kiri++;
        for($i = 0; $i < sizeof($kode_hutang); $i++) {
        	if($kode_hutang[$i]['selisih'] != 0) {
        		$sheet->setCellValue("A".$index_kiri, $kode_hutang[$i]['kode_akun']);
                $sheet->getStyle("A".$index_kiri)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                $sheet->setCellValue("B".$index_kiri, $kode_hutang[$i]['nama_akun']);
                $sheet->setCellValue("C".$index_kiri, $kode_hutang[$i]['selisih']);
                $sheet->getStyle("C".$index_kiri)->getNumberFormat()->setFormatCode('#,##0');
                $index_kiri++;
        	}
        }
        $sheet->setCellValue("B".$index_kiri, "JUMLAH HUTANG");
        $sheet->setCellValue("C".$index_kiri, $total_hutang);
        $sheet->getStyle("C".$index_kiri)->getNumberFormat()->setFormatCode('#,##0');
        $sheet->getStyle("B".$index_kiri)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle("A".$index_kiri.":C".$index_kiri)->getFont()->setSize(10)->setBold(true);
        $index_kiri += 2;
        /* End Of Hutang */
        /* Modal */
        $sheet->setCellValue("B".$index_kiri, "MODAL");
        $sheet->getStyle("B".$index_kiri)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle("B".$index_kiri)->getFont()->setSize(10)->setBold(true);
        $index_kiri++;
        for($i = 0; $i < sizeof($kode_modal); $i++) {
        	if($kode_modal[$i]['selisih'] != 0) {
        		$sheet->setCellValue("A".$index_kiri, $kode_modal[$i]['kode_akun']);
                $sheet->getStyle("A".$index_kiri)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                $sheet->setCellValue("B".$index_kiri, $kode_modal[$i]['nama_akun']);
                $sheet->setCellValue("C".$index_kiri, $kode_modal[$i]['selisih']);
                $sheet->getStyle("C".$index_kiri)->getNumberFormat()->setFormatCode('#,##0');
                $index_kiri++;
        	}
        }
        $sheet->setCellValue("B".$index_kiri, "JUMLAH MODAL");
        $sheet->setCellValue("C".$index_kiri, $total_modal);
        $sheet->getStyle("C".$index_kiri)->getNumberFormat()->setFormatCode('#,##0');
        $sheet->getStyle("B".$index_kiri)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle("A".$index_kiri.":C".$index_kiri)->getFont()->setSize(10)->setBold(true);
        $index_kiri += 2;
        // JUMLAH PASIVA
        $sheet->setCellValue("B".$index_kiri, "JUMLAH PASIVA");
        $total_pasiva = $total_hutang + $total_modal;
        $sheet->setCellValue("C".$index_kiri, $total_pasiva);
        $sheet->getStyle("C".$index_kiri)->getNumberFormat()->setFormatCode('#,##0');
        $sheet->getStyle("B".$index_kiri)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle("A".$index_kiri.":C".$index_kiri)->getFont()->setSize(10)->setBold(true);
        $index_kiri += 2;

        $sheet->setCellValue("B".$index_kiri, "AKTIVA = PASIVA");
        $total_neraca = $total_aset - $total_pasiva;
        $sheet->setCellValue("C".$index_kiri, $total_neraca);
        $sheet->getStyle("C".$index_kiri)->getNumberFormat()->setFormatCode('#,##0');
        $sheet->getStyle("B".$index_kiri)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle("A".$index_kiri.":C".$index_kiri)->getFont()->setSize(10)->setBold(true);
        /* End Of Modal */
        /* END OF PASIVA */
        /* END OF KIRI */

        /* KANAN */
        $sheet->mergeCells("E".$index_kanan.":G".$index_kanan)->setCellValue("E".$index_kanan, "PERHITUNGAN HASIL USAHA");
        $sheet->getStyle("E".$index_kanan.":G".$index_kanan)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle("E".$index_kanan.":G".$index_kanan)->getFont()->setSize(12)->setBold(true);
        $index_kanan++;

        /* Pendapatan */
        $sheet->setCellValue("E".$index_kanan, "NO");
        $sheet->setCellValue("F".$index_kanan, "PENDAPATAN");
        $sheet->setCellValue("G".$index_kanan, "JUMLAH");
        $sheet->getStyle("E".$index_kanan.":G".$index_kanan)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle("E".$index_kanan.":G".$index_kanan)->getFont()->setSize(10)->setBold(true);
        $index_kanan++;
        $sheet->setCellValue("F".$index_kanan, "PENDAPATAN JASA PINJAM");
        $sheet->getStyle("F".$index_kanan)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle("F".$index_kanan)->getFont()->setSize(10)->setBold(true);
        $index_kanan++;
        for($i = 0; $i < sizeof($kode_pendapatan); $i++) {
        	if($kode_pendapatan[$i]['selisih'] != 0) {
        		$sheet->setCellValue("E".$index_kanan, $kode_pendapatan[$i]['kode_akun']);
                $sheet->getStyle("E".$index_kanan)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                $sheet->setCellValue("F".$index_kanan, $kode_pendapatan[$i]['nama_akun']);
                $sheet->setCellValue("G".$index_kanan, $kode_pendapatan[$i]['selisih']);
                $sheet->getStyle("G".$index_kanan)->getNumberFormat()->setFormatCode('#,##0');
                $index_kanan++;
        	} 
        }
        $sheet->setCellValue("F".$index_kanan, "JUMLAH PENDAPATAN");
        $sheet->setCellValue("G".$index_kanan, $total_pendapatan);
        $sheet->getStyle("G".$index_kanan)->getNumberFormat()->setFormatCode('#,##0');
        $sheet->getStyle("F".$index_kanan)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle("E".$index_kanan.":G".$index_kanan)->getFont()->setSize(10)->setBold(true);
        $index_kanan += 2;
        /* End Of Pendapatan */
        
        /* Beban */
        $sheet->setCellValue("E".$index_kanan, "NO");
        $sheet->setCellValue("F".$index_kanan, "BEBAN");
        $sheet->setCellValue("G".$index_kanan, "JUMLAH");
        $sheet->getStyle("E".$index_kanan.":G".$index_kanan)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle("E".$index_kanan.":G".$index_kanan)->getFont()->setSize(10)->setBold(true);
        $index_kanan++;
        $sheet->setCellValue("F".$index_kanan, "BIAYA");
        $sheet->getStyle("F".$index_kanan)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle("F".$index_kanan)->getFont()->setSize(10)->setBold(true);
        $index_kanan++;
        for($i = 0; $i < sizeof($kode_beban); $i++) {
        	if($kode_beban[$i]['selisih'] != 0) {
        		$sheet->setCellValue("E".$index_kanan, $kode_beban[$i]['kode_akun']);
                $sheet->getStyle("E".$index_kanan)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                $sheet->setCellValue("F".$index_kanan, $kode_beban[$i]['nama_akun']);
                $sheet->setCellValue("G".$index_kanan, $kode_beban[$i]['selisih']);
                $sheet->getStyle("G".$index_kanan)->getNumberFormat()->setFormatCode('#,##0');
                $index_kanan++;
        	}
        }
        $sheet->setCellValue("F".$index_kanan, "JUMLAH BEBAN");
        $sheet->setCellValue("G".$index_kanan, $total_beban);
        $sheet->getStyle("G".$index_kanan)->getNumberFormat()->setFormatCode('#,##0');
        $sheet->getStyle("F".$index_kanan)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle("E".$index_kanan.":G".$index_kanan)->getFont()->setSize(10)->setBold(true);
        $index_kanan += 2;
        /* End Of Beban */
        // JUMLAH SHU BERJALAN
        $sheet->setCellValue("F".$index_kanan, "HASIL SHU BERJALAN");
        $shu_berjalan = $total_pendapatan - $total_beban;
        $sheet->setCellValue("G".$index_kanan, $shu_berjalan);
        $sheet->getStyle("G".$index_kanan)->getNumberFormat()->setFormatCode('#,##0');
        $sheet->getStyle("F".$index_kanan)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle("E".$index_kanan.":G".$index_kanan)->getFont()->setSize(10)->setBold(true);
        /* END OF KANAN */

        /* FOOTER */
        if($index_kiri > $index_kanan) {
                $index_footer   = $index_kiri;
                $border_end     = $index_kiri;
        } else {
                $index_footer   = $index_kanan;
                $border_end     = $index_kanan;
        }
        $index_footer += 2;
        $sheet->setCellValue("F".$index_footer, "Bojonegoro, ".date("d-m-Y"));
        $index_footer++;
        $sheet->setCellValue("B".$index_footer, "Ketua,");
        $sheet->setCellValue("F".$index_footer, "Bendahara,");
        $index_footer += 4;
        $sheet->setCellValue("B".$index_footer, "Drs. SUPRAPTO");
        $sheet->setCellValue("F".$index_footer, "DWI AGUNG, M.Pd.");
        /* END OF FOOTER */

        foreach(range('A','G') as $columnID) {
		    $sheet->getColumnDimension($columnID)->setAutoSize(true);
		}

        $thin = array ();
        $thin['borders']=array();
        $thin['borders']['allborders']=array();
        $thin['borders']['allborders']['style']=PHPExcel_Style_Border::BORDER_THIN ;
        $sheet  ->getStyle ( "A".$border_start.":G".$border_end )->applyFromArray ($thin);

        $filename = "Laporan Keuangan_".$tgl_dari1."_".$tgl_sampai1.".xlsx";
        
        header ( 'Content-Type: application/vnd.ms-excel' );
        header ( 'Content-Disposition: attachment;filename="'.$filename.'"' );
        header ( 'Cache-Control: max-age=0' );
        $writer = PHPExcel_IOFactory::createWriter ( $file, 'Excel2007' );
        $writer->save ( 'php://output' );
        return;
	}
}

?>