<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class LaporanSimpanan3thCon extends CI_Controller {
	function __construct() {
		parent::__construct();

		$this->load->model('usermodel');
		$this->load->model('nasabahmodel');
		$this->load->model('mappingkodeakunmodel');
		$this->load->model('kodeakunmodel');
		$this->load->model('transaksiakuntansimodel');
		$this->load->model('simpananpokokmodel');
		$this->load->model('simpanan3thmastermodel');
        $this->load->model('simpanan3thmodel');
		$this->load->model('detailsimpanan3thmodel');
		$this->load->model('laporansimpanan3thmodel');

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
		$data['username']         = $session_data['username'];
		$data['status']           = $session_data['status'];
		$data['nasabah'] 	        = $this->nasabahmodel->showData();
        $data['simpanan3thmaster']  = $this->simpanan3thmastermodel->showData();
		
		$this->load->view('/layouts/menu', $data);
		$this->load->view('/laporan/simpanan3th', $data);
		$this->load->view('/layouts/footer', $data);	
	}

	function tanggal_indo($tanggal) {
		$bulan = array (1 =>   'Januari',
					'Februari',
					'Maret',
					'April',
					'Mei',
					'Juni',
					'Juli',
					'Agustus',
					'September',
					'Oktober',
					'November',
					'Desember'
				);
		$split = explode('-', $tanggal);
		return $split[2] . ' ' . $bulan[ (int)$split[1] ] . ' ' . $split[0];
	}

	function excel() {
		$session_data = $this->session->userdata('logged_in');
		if($session_data == NULL) {
			redirect("usercon/login", "refresh");
		}

		$id_master		= $this->input->post('id_master');
		$simpanan3th_master = $this->simpanan3thmastermodel->get_simpanan3thmaster_by_id($id_master);
		$title = $simpanan3th_master->nama;
		/*echo "<pre>";
		var_dump($simpanan3th_master);
		echo "</pre>";*/

		$tanggal1   	= $this->input->post('tanggal');
        $tgl        	= strtotime($tanggal1);
        $tanggal    	= date("Y-m-d",$tgl);

        //print_r($tanggal);

        $data = $this->laporansimpanan3thmodel->get_data_simpanan3th($id_master, $tanggal);

		/*echo "<pre>";
		var_dump($data);
		echo "</pre>";*/

		$file = new PHPExcel ();
        $file->getProperties ()->setCreator ( "YHM" );
        $file->getProperties ()->setLastModifiedBy ( "System" );
        $file->getProperties ()->setTitle ( "Laporan Daftar ".$title );
        $file->getProperties ()->setSubject ( "Laporan Daftar ".$title );
        $file->getProperties ()->setDescription ( "Laporan Daftar ".$title );
        $file->getProperties ()->setKeywords ( "Laporan Daftar ".$title );
        $file->getProperties ()->setCategory ( "Laporan Daftar ".$title );

        $sheet = $file->getActiveSheet ();
        $i = 2;

        $sheet->mergeCells("A".$i.":I".$i)->setCellValue("A".$i, "KOPPONTREN MAMBAUL MUBBASYIRIN SHIDDIQIYYAH");
        $sheet->getStyle("A".$i.":I".$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle("A".$i.":I".$i)->getFont()->setSize(14)->setBold(true);
        $i++;
        $sheet->mergeCells("A".$i.":I".$i)->setCellValue("A".$i, "LAPORAN DAFTAR ".strtoupper($title)." ".$tanggal1);
        $sheet->getStyle("A".$i.":I".$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle("A".$i.":I".$i)->getFont()->setSize(12)->setBold(true);
        $i++;
        $sheet->mergeCells("A".$i.":I".$i)->setCellValue("A".$i, "KANTOR PONPES MAJMA'AL BAHRAIN SHIDDIQIYYAH");
        $sheet->getStyle("A".$i.":I".$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle("A".$i.":I".$i)->getFont()->setSize(10)->setBold(true);
        $i++;
        $sheet->mergeCells("A".$i.":I".$i)->setCellValue("A".$i, "NGRASEH DANDER BOJONEGORO  TELP (0353) 886039       BH : 8181/BH/II/95");
        $sheet->getStyle("A".$i.":I".$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle("A".$i.":I".$i)->getFont()->setSize(10)->setBold(true);
        $i += 2;

        $border_start = $i;
        $sheet->setCellValue("A".$i, "NO");
        $sheet->setCellValue("B".$i, "NAMA");
        $sheet->setCellValue("C".$i, "ALAMAT");
        $sheet->setCellValue("D".$i, "DESA");
        $sheet->setCellValue("E".$i, "DUSUN");
        $sheet->setCellValue("F".$i, "RW");
        $sheet->setCellValue("G".$i, "RT");
        $sheet->setCellValue("H".$i, "TANGGAL");
        $sheet->setCellValue("I".$i, "JUMLAH SIMPANAN");
        $sheet->getStyle("A".$i.":I".$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle("A".$i.":I".$i)->getFont()->setBold(true);
        $i++;

        $no 	= 1;
        $total 	= 0;

        for($a = 0; $a < sizeof($data); $a++) {
        	$simpanan = $data[$a]['total_setoran_detail'] - $data[$a]['total_tarikan_detail'];
        	if($simpanan != 0) {
        		$sheet->setCellValue("A".$i, $no);
	        	$sheet->setCellValue("B".$i, $data[$a]['nama']);
	        	$sheet->setCellValue("C".$i, $data[$a]['alamat']);
	        	$sheet->setCellValue("D".$i, $data[$a]['kelurahan']);
	        	$sheet->setCellValue("E".$i, $data[$a]['dusun']);
	        	$sheet->setCellValue("F".$i, $data[$a]['rw']);
	        	$sheet->setCellValue("G".$i, $data[$a]['rt']);
	        	$waktu = $this->tanggal_indo($data[$a]['waktu']);
	        	$sheet->setCellValue("H".$i, $waktu);
	        	$sheet->getStyle("A".$i.":H".$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	        	$sheet->setCellValue("I".$i, $simpanan);
	        	$total += $simpanan;
	        	$sheet->getStyle("I".$i)->getNumberFormat()->setFormatCode('#,##0');
	        	$no++;
        		$i++;	
        	}
        }

        $sheet->mergeCells("A".$i.":H".$i)->setCellValue("A".$i, "TOTAL");
        $sheet->setCellValue("I".$i, $total);
        $sheet->getStyle("I".$i)->getNumberFormat()->setFormatCode('#,##0');
        $sheet->getStyle("A".$i.":I".$i)->getFont()->setBold(true);
        $sheet->getStyle("A".$i.":H".$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        $border_end = $i;

        foreach(range('A','I') as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }

        $thin = array ();
        $thin['borders']=array();
        $thin['borders']['allborders']=array();
        $thin['borders']['allborders']['style']=PHPExcel_Style_Border::BORDER_THIN ;
        $sheet  ->getStyle ( "A".$border_start.":I".$border_end )->applyFromArray ($thin);

        $filename = "Laporan Daftar ".$title."_".$tanggal1.".xlsx";

        header ( 'Content-Type: application/vnd.ms-excel' );
        header ( 'Content-Disposition: attachment;filename="'.$filename.'"' );
        header ( 'Cache-Control: max-age=0' );
        $writer = PHPExcel_IOFactory::createWriter ( $file, 'Excel2007' );
        $writer->save ( 'php://output' );
        return;
	}
}

?>