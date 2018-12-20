<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class LaporanNeracaCon extends CI_Controller {
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
		$this->load->view('/laporan/neraca', $data);
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

		$transaksi_aset = $this->transaksiakuntansimodel->get_jumlah_by_dari_sampai_first_char($dari, $sampai, '1');
		$transaksi_hutang = $this->transaksiakuntansimodel->get_jumlah_by_dari_sampai_first_char($dari, $sampai, '2');
		$transaksi_modal = $this->transaksiakuntansimodel->get_jumlah_by_dari_sampai_first_char($dari, $sampai, '3');

		$kode_aset = $this->kodeakunmodel->get_kode_akun_by_first_char('1');
		$kode_hutang = $this->kodeakunmodel->get_kode_akun_by_first_char('2');
		$kode_modal = $this->kodeakunmodel->get_kode_akun_by_first_char('3');

		for($i = 0; $i < sizeof($kode_aset); $i++) {
			for($a = 0; $a < sizeof($transaksi_aset); $a++) {
				if($kode_aset[$i]['kode_akun'] == $transaksi_aset[$a]['kode_akun']) {
					$kode_aset[$i]['debet'] 	= $transaksi_aset[$a]['jumlah_debet'];
					$kode_aset[$i]['kredit'] 	= $transaksi_aset[$a]['jumlah_kredit'];
					$kode_aset[$i]['selisih']	= $transaksi_aset[$a]['jumlah_debet'] - $transaksi_aset[$a]['jumlah_kredit'];
				}
			}
		}

		for($i = 0; $i < sizeof($kode_hutang); $i++) {
			for($a = 0; $a < sizeof($transaksi_hutang); $a++) {
				if($kode_hutang[$i]['kode_akun'] == $transaksi_hutang[$a]['kode_akun']) {
					$kode_hutang[$i]['debet'] 	= $transaksi_hutang[$a]['jumlah_debet'];
					$kode_hutang[$i]['kredit'] 	= $transaksi_hutang[$a]['jumlah_kredit'];
					$kode_hutang[$i]['selisih']	= $transaksi_hutang[$a]['jumlah_debet'] - $transaksi_hutang[$a]['jumlah_kredit'];
				}
			}
		}

		for($i = 0; $i < sizeof($kode_modal); $i++) {
			for($a = 0; $a < sizeof($transaksi_modal); $a++) {
				if($kode_modal[$i]['kode_akun'] == $transaksi_modal[$a]['kode_akun']) {
					$kode_modal[$i]['debet'] 	= $transaksi_modal[$a]['jumlah_debet'];
					$kode_modal[$i]['kredit'] 	= $transaksi_modal[$a]['jumlah_kredit'];
					$kode_modal[$i]['selisih']	= $transaksi_modal[$a]['jumlah_debet'] - $transaksi_modal[$a]['jumlah_kredit'];
				}
			}
		}

		echo "<pre>";
		var_dump($kode_aset);
		echo "</pre>";

		echo "<pre>";
		var_dump($kode_hutang);
		echo "</pre>";

		echo "<pre>";
		var_dump($kode_modal);
		echo "</pre>";
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

		$transaksi_aset = $this->transaksiakuntansimodel->get_jumlah_by_dari_sampai_first_char($dari, $sampai, '1');
		$transaksi_hutang = $this->transaksiakuntansimodel->get_jumlah_by_dari_sampai_first_char($dari, $sampai, '2');
		$transaksi_modal = $this->transaksiakuntansimodel->get_jumlah_by_dari_sampai_first_char($dari, $sampai, '3');

		$kode_aset = $this->kodeakunmodel->get_kode_akun_by_first_char('1');
		$kode_hutang = $this->kodeakunmodel->get_kode_akun_by_first_char('2');
		$kode_modal = $this->kodeakunmodel->get_kode_akun_by_first_char('3');

		for($i = 0; $i < sizeof($kode_aset); $i++) {
			for($a = 0; $a < sizeof($transaksi_aset); $a++) {
				if($kode_aset[$i]['kode_akun'] == $transaksi_aset[$a]['kode_akun']) {
					$kode_aset[$i]['debet'] 	= $transaksi_aset[$a]['jumlah_debet'];
					$kode_aset[$i]['kredit'] 	= $transaksi_aset[$a]['jumlah_kredit'];
					$kode_aset[$i]['selisih']	= $transaksi_aset[$a]['jumlah_debet'] - $transaksi_aset[$a]['jumlah_kredit'];
				}
			}
		}

		for($i = 0; $i < sizeof($kode_hutang); $i++) {
			for($a = 0; $a < sizeof($transaksi_hutang); $a++) {
				if($kode_hutang[$i]['kode_akun'] == $transaksi_hutang[$a]['kode_akun']) {
					$kode_hutang[$i]['debet'] 	= $transaksi_hutang[$a]['jumlah_debet'];
					$kode_hutang[$i]['kredit'] 	= $transaksi_hutang[$a]['jumlah_kredit'];
					$kode_hutang[$i]['selisih']	= $transaksi_hutang[$a]['jumlah_debet'] - $transaksi_hutang[$a]['jumlah_kredit'];
				}
			}
		}

		for($i = 0; $i < sizeof($kode_modal); $i++) {
			for($a = 0; $a < sizeof($transaksi_modal); $a++) {
				if($kode_modal[$i]['kode_akun'] == $transaksi_modal[$a]['kode_akun']) {
					$kode_modal[$i]['debet'] 	= $transaksi_modal[$a]['jumlah_debet'];
					$kode_modal[$i]['kredit'] 	= $transaksi_modal[$a]['jumlah_kredit'];
					$kode_modal[$i]['selisih']	= $transaksi_modal[$a]['jumlah_debet'] - $transaksi_modal[$a]['jumlah_kredit'];
				}
			}
		}

        $file = new PHPExcel ();
        $file->getProperties ()->setCreator ( "YHM" );
        $file->getProperties ()->setLastModifiedBy ( "System" );
        $file->getProperties ()->setTitle ( "Laporan Neraca" );
        $file->getProperties ()->setSubject ( "Laporan Neraca" );
        $file->getProperties ()->setDescription ( "Laporan Neraca" );
        $file->getProperties ()->setKeywords ( "Laporan Neraca" );
        $file->getProperties ()->setCategory ( "Laporan Neraca" );
        
        $sheet = $file->getActiveSheet ();
        $i = 2;

        $sheet->mergeCells("A".$i.":G".$i)->setCellValue("A".$i, "KOPPONTREN MAMBAUL MUBBASYIRIN SHIDDIQIYYAH");
        $sheet->getStyle("A".$i.":G".$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle("A".$i.":G".$i)->getFont()->setSize(14)->setBold(true);
        $i++;
        $sheet->mergeCells("A".$i.":G".$i)->setCellValue("A".$i, "LAPORAN NERACA ".$tgl_dari1." - ".$tgl_sampai1);
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

        $index_aktiva = $i;
        $index_pasiva = $i;

        /* AKTIVA */
        $sheet->setCellValue("A".$index_aktiva, "NO");
        $sheet->setCellValue("B".$index_aktiva, "PERKIRAAN");
        $sheet->setCellValue("C".$index_aktiva, "JUMLAH");
        $sheet->getStyle("A".$index_aktiva.":C".$index_aktiva)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle("A".$index_aktiva.":C".$index_aktiva)->getFont()->setSize(10)->setBold(true);
        $index_aktiva += 2;

        $sheet->setCellValue("B".$index_aktiva, "AKTIVA");
        $sheet->getStyle("B".$index_aktiva)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle("B".$index_aktiva)->getFont()->setSize(10)->setBold(true);
        $index_aktiva++;
        $total = 0;
        for($i = 0; $i < sizeof($kode_aset); $i++) {
        	$sheet->setCellValue("A".$index_aktiva, $kode_aset[$i]['kode_akun']);
        	$sheet->getStyle("A".$index_aktiva)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        	$sheet->setCellValue("B".$index_aktiva, $kode_aset[$i]['nama_akun']);
        	$total += $kode_aset[$i]['selisih'];
        	$sheet->setCellValue("C".$index_aktiva, $kode_aset[$i]['selisih']);
        	$index_aktiva++;
        }
        $index_aktiva++;
        $sheet->setCellValue("B".$index_aktiva, "JUMLAH");
        $sheet->setCellValue("C".$index_aktiva, $total);
        $sheet->getStyle("A".$index_aktiva.":B".$index_aktiva)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle("A".$index_aktiva.":B".$index_aktiva)->getFont()->setSize(10)->setBold(true);
        /* END OF AKTIVA*/

        /* PASIVA */
        $sheet->setCellValue("E".$index_pasiva, "NO");
        $sheet->setCellValue("F".$index_pasiva, "PERKIRAAN");
        $sheet->setCellValue("G".$index_pasiva, "JUMLAH");
        $sheet->getStyle("E".$index_pasiva.":G".$index_pasiva)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle("E".$index_pasiva.":G".$index_pasiva)->getFont()->setSize(10)->setBold(true);
        $index_pasiva += 2;

        $sheet->setCellValue("F".$index_pasiva, "HUTANG");
        $sheet->getStyle("F".$index_pasiva)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle("F".$index_pasiva)->getFont()->setSize(10)->setBold(true);
        $index_pasiva++;
        $total = 0;
        for($i = 0; $i < sizeof($kode_hutang); $i++) {
        	$sheet->setCellValue("E".$index_pasiva, $kode_hutang[$i]['kode_akun']);
        	$sheet->getStyle("E".$index_pasiva)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        	$sheet->setCellValue("F".$index_pasiva, $kode_hutang[$i]['nama_akun']);
        	$total += $kode_hutang[$i]['selisih'];
        	$sheet->setCellValue("G".$index_pasiva, $kode_hutang[$i]['selisih']);
        	$index_pasiva++;
        }
        $index_pasiva++;
        $sheet->setCellValue("F".$index_pasiva, "JUMLAH");
        $sheet->setCellValue("G".$index_pasiva, $total);
        $sheet->getStyle("E".$index_pasiva.":F".$index_pasiva)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle("E".$index_pasiva.":F".$index_pasiva)->getFont()->setSize(10)->setBold(true);
        $index_pasiva += 2;

        $sheet->setCellValue("F".$index_pasiva, "MODAL");
        $sheet->getStyle("F".$index_pasiva)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle("F".$index_pasiva)->getFont()->setSize(10)->setBold(true);
        $index_pasiva++;
        $total = 0;
        for($i = 0; $i < sizeof($kode_modal); $i++) {
        	$sheet->setCellValue("E".$index_pasiva, $kode_modal[$i]['kode_akun']);
        	$sheet->getStyle("E".$index_pasiva)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        	$sheet->setCellValue("F".$index_pasiva, $kode_modal[$i]['nama_akun']);
        	$total += $kode_modal[$i]['selisih'];
        	$sheet->setCellValue("G".$index_pasiva, $kode_modal[$i]['selisih']);
        	$index_pasiva++;
        }
        $index_pasiva++;
        $sheet->setCellValue("F".$index_pasiva, "JUMLAH");
        $sheet->setCellValue("G".$index_pasiva, $total);
        $sheet->getStyle("E".$index_pasiva.":F".$index_pasiva)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle("E".$index_pasiva.":F".$index_pasiva)->getFont()->setSize(10)->setBold(true);
        /* END OF PASIVA */

        if($index_aktiva > $index_pasiva) {
        	$index_footer = $index_aktiva;
        } else {
        	$index_footer = $index_pasiva;
        }

        $index_footer += 2;

        $sheet->setCellValue("F".$index_pasiva, "JUMLAH");

        $filename = "Laporan Neraca ".$tgl_dari1." - ".$tgl_sampai1.".xlsx";
        
        header ( 'Content-Type: application/vnd.ms-excel' );
        header ( 'Content-Disposition: attachment;filename="'.$filename.'"' );
        header ( 'Cache-Control: max-age=0' );
        $writer = PHPExcel_IOFactory::createWriter ( $file, 'Excel2007' );
        $writer->save ( 'php://output' );
		return;
	}
}

?>