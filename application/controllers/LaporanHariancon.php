<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class LaporanHariancon extends CI_Controller {
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
		$this->load->model('simpananpihakketigamodel');
		$this->load->model('detailsimpananpihakketigamodel');
		$this->load->model('simpanan3thmastermodel');
		$this->load->model('simpanan3thmodel');
		$this->load->model('detailsimpanan3thmodel');
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
		$this->load->view('/laporan/harian', $data);
		$this->load->view('/layouts/footer', $data);	
	}

	function excel_pinjaman() {
		$session_data = $this->session->userdata('logged_in');
		if($session_data == NULL) {
			redirect("usercon/login", "refresh");
		}

		$tgl1 		= $this->input->post('tanggal_pinjaman');
		$tgl 		= strtotime($tgl1);
		$tanggal 	= date("Y-m-d",$tgl);

		$data = $this->pinjamanmodel->get_data_laporan_harian($tanggal);

		/*echo "<pre>";
        var_dump($data);
        echo "</pre>";*/

        $file = new PHPExcel ();
        $file->getProperties ()->setCreator ( "YHM" );
        $file->getProperties ()->setLastModifiedBy ( "System" );
        $file->getProperties ()->setTitle ( "Laporan Harian Pinjaman" );
        $file->getProperties ()->setSubject ( "Laporan Harian Pinjaman" );
        $file->getProperties ()->setDescription ( "Laporan Harian Pinjaman" );
        $file->getProperties ()->setKeywords ( "Laporan Harian Pinjaman" );
        $file->getProperties ()->setCategory ( "Laporan Harian Pinjaman" );

        $sheet = $file->getActiveSheet ();
        $i = 2;

        $sheet->mergeCells("A".$i.":I".$i)->setCellValue("A".$i, "KOPPONTREN MAMBAUL MUBBASYIRIN SHIDDIQIYYAH");
        $sheet->getStyle("A".$i.":I".$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle("A".$i.":I".$i)->getFont()->setSize(14)->setBold(true);
        $i++;
        $sheet->mergeCells("A".$i.":I".$i)->setCellValue("A".$i, "LAPORAN HARIAN PINJAMAN ".$tgl1);
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
        $sheet->setCellValue("B".$i, "NAMA NASABAH");
        $sheet->setCellValue("C".$i, "NOMOR NASABAH");
        $sheet->setCellValue("D".$i, "NIK");
        $sheet->setCellValue("E".$i, "JENIS");
        $sheet->setCellValue("F".$i, "JUMLAH");
        $sheet->setCellValue("G".$i, "JASA");
        $sheet->setCellValue("H".$i, "JASA TAMBAHAN");
        $sheet->setCellValue("I".$i, "TOTAL");
        $sheet->getStyle("A".$i.":I".$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle("A".$i.":I".$i)->getFont()->setBold(true);
        $i++;

        $no = 1;
        for($a = 0; $a < sizeof($data); $a++) {
        	$sheet->setCellValue("A".$i, $no);
        	$sheet->setCellValue("B".$i, $data[$a]['nama_nasabah']);
        	$sheet->setCellValue("C".$i, $data[$a]['nomor_nasabah']);
        	$sheet->setCellValue("D".$i, "'".$data[$a]['nik_nasabah']);
        	$sheet->setCellValue("E".$i, $data[$a]['jenis']);
        	$sheet->setCellValue("F".$i, $data[$a]['angsuran']);
        	$sheet->setCellValue("G".$i, $data[$a]['jasa']);
        	$sheet->setCellValue("H".$i, $data[$a]['denda']);
        	$sheet->setCellValue("I".$i, $data[$a]['total']);
        	$sheet->getStyle("A".$i.":E".$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        	$sheet->getStyle("F".$i.":I".$i)->getNumberFormat()->setFormatCode('#,##0');
	        $i++;
	        $no++;
        }

        $border_end = $i - 1;

        foreach(range('A','I') as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }

        $thin = array ();
        $thin['borders']=array();
        $thin['borders']['allborders']=array();
        $thin['borders']['allborders']['style']=PHPExcel_Style_Border::BORDER_THIN ;
        $sheet  ->getStyle ( "A".$border_start.":I".$border_end )->applyFromArray ($thin);

        $filename = "Laporan Harian Pinjaman_".$tgl1.".xlsx";

        header ( 'Content-Type: application/vnd.ms-excel' );
        header ( 'Content-Disposition: attachment;filename="'.$filename.'"' );
        header ( 'Cache-Control: max-age=0' );
        $writer = PHPExcel_IOFactory::createWriter ( $file, 'Excel2007' );
        $writer->save ( 'php://output' );
        return;
	}

    function excel_simpananpokok() {
        $session_data = $this->session->userdata('logged_in');
        if($session_data == NULL) {
            redirect("usercon/login", "refresh");
        }

        $tgl1       = $this->input->post('tanggal_simpananpokok');
        $tgl        = strtotime($tgl1);
        $tanggal    = date("Y-m-d",$tgl);

        $data = $this->simpananpokokmodel->get_data_laporan_harian($tanggal);

        /*echo "<pre>";
        var_dump($data);
        echo "</pre>";*/

        $file = new PHPExcel ();
        $file->getProperties ()->setCreator ( "YHM" );
        $file->getProperties ()->setLastModifiedBy ( "System" );
        $file->getProperties ()->setTitle ( "Laporan Harian Simpanan Pokok" );
        $file->getProperties ()->setSubject ( "Laporan Harian Simpanan Pokok" );
        $file->getProperties ()->setDescription ( "Laporan Harian Simpanan Pokok" );
        $file->getProperties ()->setKeywords ( "Laporan Harian Simpanan Pokok" );
        $file->getProperties ()->setCategory ( "Laporan Harian Simpanan Pokok" );

        $sheet = $file->getActiveSheet ();
        $i = 2;

        $sheet->mergeCells("A".$i.":F".$i)->setCellValue("A".$i, "KOPPONTREN MAMBAUL MUBBASYIRIN SHIDDIQIYYAH");
        $sheet->getStyle("A".$i.":F".$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle("A".$i.":F".$i)->getFont()->setSize(14)->setBold(true);
        $i++;
        $sheet->mergeCells("A".$i.":F".$i)->setCellValue("A".$i, "LAPORAN HARIAN SIMPANAN POKOK ".$tgl1);
        $sheet->getStyle("A".$i.":F".$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle("A".$i.":F".$i)->getFont()->setSize(12)->setBold(true);
        $i++;
        $sheet->mergeCells("A".$i.":F".$i)->setCellValue("A".$i, "KANTOR PONPES MAJMA'AL BAHRAIN SHIDDIQIYYAH");
        $sheet->getStyle("A".$i.":F".$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle("A".$i.":F".$i)->getFont()->setSize(10)->setBold(true);
        $i++;
        $sheet->mergeCells("A".$i.":F".$i)->setCellValue("A".$i, "NGRASEH DANDER BOJONEGORO  TELP (0353) 886039       BH : 8181/BH/II/95");
        $sheet->getStyle("A".$i.":F".$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle("A".$i.":F".$i)->getFont()->setSize(10)->setBold(true);
        $i += 2;

        $border_start = $i;
        $sheet->setCellValue("A".$i, "NO");
        $sheet->setCellValue("B".$i, "NAMA NASABAH");
        $sheet->setCellValue("C".$i, "NOMOR NASABAH");
        $sheet->setCellValue("D".$i, "NIK");
        $sheet->setCellValue("E".$i, "JENIS");
        $sheet->setCellValue("F".$i, "JUMLAH");
        $sheet->getStyle("A".$i.":F".$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle("A".$i.":F".$i)->getFont()->setBold(true);
        $i++;

        $no = 1;
        for($a = 0; $a < sizeof($data); $a++) {
            $sheet->setCellValue("A".$i, $no);
            $sheet->setCellValue("B".$i, $data[$a]['nama_nasabah']);
            $sheet->setCellValue("C".$i, $data[$a]['nomor_nasabah']);
            $sheet->setCellValue("D".$i, "'".$data[$a]['nik_nasabah']);
            $sheet->setCellValue("E".$i, $data[$a]['jenis']);
            $sheet->setCellValue("F".$i, $data[$a]['jumlah']);
            $sheet->getStyle("A".$i.":E".$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $sheet->getStyle("F".$i)->getNumberFormat()->setFormatCode('#,##0');
            $i++;
            $no++;
        }

        $border_end = $i - 1;

        foreach(range('A','F') as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }

        $thin = array ();
        $thin['borders']=array();
        $thin['borders']['allborders']=array();
        $thin['borders']['allborders']['style']=PHPExcel_Style_Border::BORDER_THIN ;
        $sheet  ->getStyle ( "A".$border_start.":F".$border_end )->applyFromArray ($thin);

        $filename = "Laporan Harian Simpanan Pokok_".$tgl1.".xlsx";

        header ( 'Content-Type: application/vnd.ms-excel' );
        header ( 'Content-Disposition: attachment;filename="'.$filename.'"' );
        header ( 'Cache-Control: max-age=0' );
        $writer = PHPExcel_IOFactory::createWriter ( $file, 'Excel2007' );
        $writer->save ( 'php://output' );
        return;
    }

    function excel_simpananwajib() {
        $session_data = $this->session->userdata('logged_in');
        if($session_data == NULL) {
            redirect("usercon/login", "refresh");
        }

        $tgl1       = $this->input->post('tanggal_simpananwajib');
        $tgl        = strtotime($tgl1);
        $tanggal    = date("Y-m-d",$tgl);

        $data = $this->simpananwajibmodel->get_data_laporan_harian($tanggal);

        /*echo "<pre>";
        var_dump($data);
        echo "</pre>";*/

        $file = new PHPExcel ();
        $file->getProperties ()->setCreator ( "YHM" );
        $file->getProperties ()->setLastModifiedBy ( "System" );
        $file->getProperties ()->setTitle ( "Laporan Harian Simpanan Wajib" );
        $file->getProperties ()->setSubject ( "Laporan Harian Simpanan Wajib" );
        $file->getProperties ()->setDescription ( "Laporan Harian Simpanan Wajib" );
        $file->getProperties ()->setKeywords ( "Laporan Harian Simpanan Wajib" );
        $file->getProperties ()->setCategory ( "Laporan Harian Simpanan Wajib" );

        $sheet = $file->getActiveSheet ();
        $i = 2;

        $sheet->mergeCells("A".$i.":F".$i)->setCellValue("A".$i, "KOPPONTREN MAMBAUL MUBBASYIRIN SHIDDIQIYYAH");
        $sheet->getStyle("A".$i.":F".$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle("A".$i.":F".$i)->getFont()->setSize(14)->setBold(true);
        $i++;
        $sheet->mergeCells("A".$i.":F".$i)->setCellValue("A".$i, "LAPORAN HARIAN SIMPANAN WAJIB ".$tgl1);
        $sheet->getStyle("A".$i.":F".$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle("A".$i.":F".$i)->getFont()->setSize(12)->setBold(true);
        $i++;
        $sheet->mergeCells("A".$i.":F".$i)->setCellValue("A".$i, "KANTOR PONPES MAJMA'AL BAHRAIN SHIDDIQIYYAH");
        $sheet->getStyle("A".$i.":F".$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle("A".$i.":F".$i)->getFont()->setSize(10)->setBold(true);
        $i++;
        $sheet->mergeCells("A".$i.":F".$i)->setCellValue("A".$i, "NGRASEH DANDER BOJONEGORO  TELP (0353) 886039       BH : 8181/BH/II/95");
        $sheet->getStyle("A".$i.":F".$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle("A".$i.":F".$i)->getFont()->setSize(10)->setBold(true);
        $i += 2;

        $border_start = $i;
        $sheet->setCellValue("A".$i, "NO");
        $sheet->setCellValue("B".$i, "NAMA NASABAH");
        $sheet->setCellValue("C".$i, "NOMOR NASABAH");
        $sheet->setCellValue("D".$i, "NIK");
        $sheet->setCellValue("E".$i, "JENIS");
        $sheet->setCellValue("F".$i, "JUMLAH");
        $sheet->getStyle("A".$i.":F".$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle("A".$i.":F".$i)->getFont()->setBold(true);
        $i++;

        $no = 1;
        for($a = 0; $a < sizeof($data); $a++) {
            $sheet->setCellValue("A".$i, $no);
            $sheet->setCellValue("B".$i, $data[$a]['nama_nasabah']);
            $sheet->setCellValue("C".$i, $data[$a]['nomor_nasabah']);
            $sheet->setCellValue("D".$i, "'".$data[$a]['nik_nasabah']);
            $sheet->setCellValue("E".$i, $data[$a]['jenis']);
            $sheet->setCellValue("F".$i, $data[$a]['jumlah']);
            $sheet->getStyle("A".$i.":E".$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $sheet->getStyle("F".$i)->getNumberFormat()->setFormatCode('#,##0');
            $i++;
            $no++;
        }

        $border_end = $i - 1;

        foreach(range('A','F') as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }

        $thin = array ();
        $thin['borders']=array();
        $thin['borders']['allborders']=array();
        $thin['borders']['allborders']['style']=PHPExcel_Style_Border::BORDER_THIN ;
        $sheet  ->getStyle ( "A".$border_start.":F".$border_end )->applyFromArray ($thin);

        $filename = "Laporan Harian Simpanan Wajib_".$tgl1.".xlsx";

        header ( 'Content-Type: application/vnd.ms-excel' );
        header ( 'Content-Disposition: attachment;filename="'.$filename.'"' );
        header ( 'Cache-Control: max-age=0' );
        $writer = PHPExcel_IOFactory::createWriter ( $file, 'Excel2007' );
        $writer->save ( 'php://output' );
        return;
    }

    function excel_simpanankhusus() {
        $session_data = $this->session->userdata('logged_in');
        if($session_data == NULL) {
            redirect("usercon/login", "refresh");
        }

        $tgl1       = $this->input->post('tanggal_simpanankhusus');
        $tgl        = strtotime($tgl1);
        $tanggal    = date("Y-m-d",$tgl);

        $data = $this->simpanankhususmodel->get_data_laporan_harian($tanggal);

        /*echo "<pre>";
        var_dump($data);
        echo "</pre>";*/

        $file = new PHPExcel ();
        $file->getProperties ()->setCreator ( "YHM" );
        $file->getProperties ()->setLastModifiedBy ( "System" );
        $file->getProperties ()->setTitle ( "Laporan Harian Simpanan Khusus" );
        $file->getProperties ()->setSubject ( "Laporan Harian Simpanan Khusus" );
        $file->getProperties ()->setDescription ( "Laporan Harian Simpanan Khusus" );
        $file->getProperties ()->setKeywords ( "Laporan Harian Simpanan Khusus" );
        $file->getProperties ()->setCategory ( "Laporan Harian Simpanan Khusus" );

        $sheet = $file->getActiveSheet ();
        $i = 2;

        $sheet->mergeCells("A".$i.":F".$i)->setCellValue("A".$i, "KOPPONTREN MAMBAUL MUBBASYIRIN SHIDDIQIYYAH");
        $sheet->getStyle("A".$i.":F".$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle("A".$i.":F".$i)->getFont()->setSize(14)->setBold(true);
        $i++;
        $sheet->mergeCells("A".$i.":F".$i)->setCellValue("A".$i, "LAPORAN HARIAN SIMPANAN KHUSUS ".$tgl1);
        $sheet->getStyle("A".$i.":F".$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle("A".$i.":F".$i)->getFont()->setSize(12)->setBold(true);
        $i++;
        $sheet->mergeCells("A".$i.":F".$i)->setCellValue("A".$i, "KANTOR PONPES MAJMA'AL BAHRAIN SHIDDIQIYYAH");
        $sheet->getStyle("A".$i.":F".$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle("A".$i.":F".$i)->getFont()->setSize(10)->setBold(true);
        $i++;
        $sheet->mergeCells("A".$i.":F".$i)->setCellValue("A".$i, "NGRASEH DANDER BOJONEGORO  TELP (0353) 886039       BH : 8181/BH/II/95");
        $sheet->getStyle("A".$i.":F".$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle("A".$i.":F".$i)->getFont()->setSize(10)->setBold(true);
        $i += 2;

        $border_start = $i;
        $sheet->setCellValue("A".$i, "NO");
        $sheet->setCellValue("B".$i, "NAMA NASABAH");
        $sheet->setCellValue("C".$i, "NOMOR NASABAH");
        $sheet->setCellValue("D".$i, "NIK");
        $sheet->setCellValue("E".$i, "JENIS");
        $sheet->setCellValue("F".$i, "JUMLAH");
        $sheet->getStyle("A".$i.":F".$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle("A".$i.":F".$i)->getFont()->setBold(true);
        $i++;

        $no = 1;
        for($a = 0; $a < sizeof($data); $a++) {
            $sheet->setCellValue("A".$i, $no);
            $sheet->setCellValue("B".$i, $data[$a]['nama_nasabah']);
            $sheet->setCellValue("C".$i, $data[$a]['nomor_nasabah']);
            $sheet->setCellValue("D".$i, "'".$data[$a]['nik_nasabah']);
            $sheet->setCellValue("E".$i, $data[$a]['jenis']);
            $sheet->setCellValue("F".$i, $data[$a]['jumlah']);
            $sheet->getStyle("A".$i.":E".$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $sheet->getStyle("F".$i)->getNumberFormat()->setFormatCode('#,##0');
            $i++;
            $no++;
        }

        $border_end = $i - 1;

        foreach(range('A','F') as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }

        $thin = array ();
        $thin['borders']=array();
        $thin['borders']['allborders']=array();
        $thin['borders']['allborders']['style']=PHPExcel_Style_Border::BORDER_THIN ;
        $sheet  ->getStyle ( "A".$border_start.":F".$border_end )->applyFromArray ($thin);

        $filename = "Laporan Harian Simpanan Khusus_".$tgl1.".xlsx";

        header ( 'Content-Type: application/vnd.ms-excel' );
        header ( 'Content-Disposition: attachment;filename="'.$filename.'"' );
        header ( 'Cache-Control: max-age=0' );
        $writer = PHPExcel_IOFactory::createWriter ( $file, 'Excel2007' );
        $writer->save ( 'php://output' );
        return;
    }

    function excel_simpanandanasosial() {
        $session_data = $this->session->userdata('logged_in');
        if($session_data == NULL) {
            redirect("usercon/login", "refresh");
        }

        $tgl1       = $this->input->post('tanggal_simpanandanasosial');
        $tgl        = strtotime($tgl1);
        $tanggal    = date("Y-m-d",$tgl);

        $data = $this->simpanandanasosialmodel->get_data_laporan_harian($tanggal);

        /*echo "<pre>";
        var_dump($data);
        echo "</pre>";*/

        $file = new PHPExcel ();
        $file->getProperties ()->setCreator ( "YHM" );
        $file->getProperties ()->setLastModifiedBy ( "System" );
        $file->getProperties ()->setTitle ( "Laporan Harian Simpanan Dansos Anggota" );
        $file->getProperties ()->setSubject ( "Laporan Harian Simpanan Dansos Anggota" );
        $file->getProperties ()->setDescription ( "Laporan Harian Simpanan Dansos Anggota" );
        $file->getProperties ()->setKeywords ( "Laporan Harian Simpanan Dansos Anggota" );
        $file->getProperties ()->setCategory ( "Laporan Harian Simpanan Dansos Anggota" );

        $sheet = $file->getActiveSheet ();
        $i = 2;

        $sheet->mergeCells("A".$i.":F".$i)->setCellValue("A".$i, "KOPPONTREN MAMBAUL MUBBASYIRIN SHIDDIQIYYAH");
        $sheet->getStyle("A".$i.":F".$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle("A".$i.":F".$i)->getFont()->setSize(14)->setBold(true);
        $i++;
        $sheet->mergeCells("A".$i.":F".$i)->setCellValue("A".$i, "LAPORAN HARIAN SIMPANAN DANSOS ANGGOTA ".$tgl1);
        $sheet->getStyle("A".$i.":F".$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle("A".$i.":F".$i)->getFont()->setSize(12)->setBold(true);
        $i++;
        $sheet->mergeCells("A".$i.":F".$i)->setCellValue("A".$i, "KANTOR PONPES MAJMA'AL BAHRAIN SHIDDIQIYYAH");
        $sheet->getStyle("A".$i.":F".$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle("A".$i.":F".$i)->getFont()->setSize(10)->setBold(true);
        $i++;
        $sheet->mergeCells("A".$i.":F".$i)->setCellValue("A".$i, "NGRASEH DANDER BOJONEGORO  TELP (0353) 886039       BH : 8181/BH/II/95");
        $sheet->getStyle("A".$i.":F".$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle("A".$i.":F".$i)->getFont()->setSize(10)->setBold(true);
        $i += 2;

        $border_start = $i;
        $sheet->setCellValue("A".$i, "NO");
        $sheet->setCellValue("B".$i, "NAMA NASABAH");
        $sheet->setCellValue("C".$i, "NOMOR NASABAH");
        $sheet->setCellValue("D".$i, "NIK");
        $sheet->setCellValue("E".$i, "JENIS");
        $sheet->setCellValue("F".$i, "JUMLAH");
        $sheet->getStyle("A".$i.":F".$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle("A".$i.":F".$i)->getFont()->setBold(true);
        $i++;

        $no = 1;
        for($a = 0; $a < sizeof($data); $a++) {
            $sheet->setCellValue("A".$i, $no);
            $sheet->setCellValue("B".$i, $data[$a]['nama_nasabah']);
            $sheet->setCellValue("C".$i, $data[$a]['nomor_nasabah']);
            $sheet->setCellValue("D".$i, "'".$data[$a]['nik_nasabah']);
            $sheet->setCellValue("E".$i, $data[$a]['jenis']);
            $sheet->setCellValue("F".$i, $data[$a]['jumlah']);
            $sheet->getStyle("A".$i.":E".$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $sheet->getStyle("F".$i)->getNumberFormat()->setFormatCode('#,##0');
            $i++;
            $no++;
        }

        $border_end = $i - 1;

        foreach(range('A','F') as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }

        $thin = array ();
        $thin['borders']=array();
        $thin['borders']['allborders']=array();
        $thin['borders']['allborders']['style']=PHPExcel_Style_Border::BORDER_THIN ;
        $sheet  ->getStyle ( "A".$border_start.":F".$border_end )->applyFromArray ($thin);

        $filename = "Laporan Harian Simpanan Dansos Anggota_".$tgl1.".xlsx";

        header ( 'Content-Type: application/vnd.ms-excel' );
        header ( 'Content-Disposition: attachment;filename="'.$filename.'"' );
        header ( 'Cache-Control: max-age=0' );
        $writer = PHPExcel_IOFactory::createWriter ( $file, 'Excel2007' );
        $writer->save ( 'php://output' );
        return;
    }

    function excel_simpanankanzun() {
        $session_data = $this->session->userdata('logged_in');
        if($session_data == NULL) {
            redirect("usercon/login", "refresh");
        }

        $tgl1       = $this->input->post('tanggal_simpanankanzun');
        $tgl        = strtotime($tgl1);
        $tanggal    = date("Y-m-d",$tgl);

        $data = $this->simpanankanzunmodel->get_data_laporan_harian($tanggal);

        /*echo "<pre>";
        var_dump($data);
        echo "</pre>";*/

        $file = new PHPExcel ();
        $file->getProperties ()->setCreator ( "YHM" );
        $file->getProperties ()->setLastModifiedBy ( "System" );
        $file->getProperties ()->setTitle ( "Laporan Harian Simpanan Kanzun" );
        $file->getProperties ()->setSubject ( "Laporan Harian Simpanan Kanzun" );
        $file->getProperties ()->setDescription ( "Laporan Harian Simpanan Kanzun" );
        $file->getProperties ()->setKeywords ( "Laporan Harian Simpanan Kanzun" );
        $file->getProperties ()->setCategory ( "Laporan Harian Simpanan Kanzun" );

        $sheet = $file->getActiveSheet ();
        $i = 2;

        $sheet->mergeCells("A".$i.":F".$i)->setCellValue("A".$i, "KOPPONTREN MAMBAUL MUBBASYIRIN SHIDDIQIYYAH");
        $sheet->getStyle("A".$i.":F".$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle("A".$i.":F".$i)->getFont()->setSize(14)->setBold(true);
        $i++;
        $sheet->mergeCells("A".$i.":F".$i)->setCellValue("A".$i, "LAPORAN HARIAN SIMPANAN KANZUN ".$tgl1);
        $sheet->getStyle("A".$i.":F".$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle("A".$i.":F".$i)->getFont()->setSize(12)->setBold(true);
        $i++;
        $sheet->mergeCells("A".$i.":F".$i)->setCellValue("A".$i, "KANTOR PONPES MAJMA'AL BAHRAIN SHIDDIQIYYAH");
        $sheet->getStyle("A".$i.":F".$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle("A".$i.":F".$i)->getFont()->setSize(10)->setBold(true);
        $i++;
        $sheet->mergeCells("A".$i.":F".$i)->setCellValue("A".$i, "NGRASEH DANDER BOJONEGORO  TELP (0353) 886039       BH : 8181/BH/II/95");
        $sheet->getStyle("A".$i.":F".$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle("A".$i.":F".$i)->getFont()->setSize(10)->setBold(true);
        $i += 2;

        $border_start = $i;
        $sheet->setCellValue("A".$i, "NO");
        $sheet->setCellValue("B".$i, "NAMA NASABAH");
        $sheet->setCellValue("C".$i, "NOMOR NASABAH");
        $sheet->setCellValue("D".$i, "NIK");
        $sheet->setCellValue("E".$i, "JENIS");
        $sheet->setCellValue("F".$i, "JUMLAH");
        $sheet->getStyle("A".$i.":F".$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle("A".$i.":F".$i)->getFont()->setBold(true);
        $i++;

        $no = 1;
        for($a = 0; $a < sizeof($data); $a++) {
            $sheet->setCellValue("A".$i, $no);
            $sheet->setCellValue("B".$i, $data[$a]['nama_nasabah']);
            $sheet->setCellValue("C".$i, $data[$a]['nomor_nasabah']);
            $sheet->setCellValue("D".$i, "'".$data[$a]['nik_nasabah']);
            $sheet->setCellValue("E".$i, $data[$a]['jenis']);
            $sheet->setCellValue("F".$i, $data[$a]['jumlah']);
            $sheet->getStyle("A".$i.":E".$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $sheet->getStyle("F".$i)->getNumberFormat()->setFormatCode('#,##0');
            $i++;
            $no++;
        }

        $border_end = $i - 1;

        foreach(range('A','F') as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }

        $thin = array ();
        $thin['borders']=array();
        $thin['borders']['allborders']=array();
        $thin['borders']['allborders']['style']=PHPExcel_Style_Border::BORDER_THIN ;
        $sheet  ->getStyle ( "A".$border_start.":F".$border_end )->applyFromArray ($thin);

        $filename = "Laporan Harian Simpanan Kanzun_".$tgl1.".xlsx";

        header ( 'Content-Type: application/vnd.ms-excel' );
        header ( 'Content-Disposition: attachment;filename="'.$filename.'"' );
        header ( 'Cache-Control: max-age=0' );
        $writer = PHPExcel_IOFactory::createWriter ( $file, 'Excel2007' );
        $writer->save ( 'php://output' );
        return;
    }

    function excel_simpananpihakketiga() {
        $session_data = $this->session->userdata('logged_in');
        if($session_data == NULL) {
            redirect("usercon/login", "refresh");
        }

        $tgl1       = $this->input->post('tanggal_simpananpihakketiga');
        $tgl        = strtotime($tgl1);
        $tanggal    = date("Y-m-d",$tgl);

        $data = $this->simpananpihakketigamodel->get_data_laporan_harian($tanggal);

        /*echo "<pre>";
        var_dump($data);
        echo "</pre>";*/

        $file = new PHPExcel ();
        $file->getProperties ()->setCreator ( "YHM" );
        $file->getProperties ()->setLastModifiedBy ( "System" );
        $file->getProperties ()->setTitle ( "Laporan Harian Simpanan Pihak Ketiga" );
        $file->getProperties ()->setSubject ( "Laporan Harian Simpanan Pihak Ketiga" );
        $file->getProperties ()->setDescription ( "Laporan Harian Simpanan Pihak Ketiga" );
        $file->getProperties ()->setKeywords ( "Laporan Harian Simpanan Pihak Ketiga" );
        $file->getProperties ()->setCategory ( "Laporan Harian Simpanan Pihak Ketiga" );

        $sheet = $file->getActiveSheet ();
        $i = 2;

        $sheet->mergeCells("A".$i.":F".$i)->setCellValue("A".$i, "KOPPONTREN MAMBAUL MUBBASYIRIN SHIDDIQIYYAH");
        $sheet->getStyle("A".$i.":F".$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle("A".$i.":F".$i)->getFont()->setSize(14)->setBold(true);
        $i++;
        $sheet->mergeCells("A".$i.":F".$i)->setCellValue("A".$i, "LAPORAN HARIAN SIMPANAN PIHAK KETIGA ".$tgl1);
        $sheet->getStyle("A".$i.":F".$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle("A".$i.":F".$i)->getFont()->setSize(12)->setBold(true);
        $i++;
        $sheet->mergeCells("A".$i.":F".$i)->setCellValue("A".$i, "KANTOR PONPES MAJMA'AL BAHRAIN SHIDDIQIYYAH");
        $sheet->getStyle("A".$i.":F".$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle("A".$i.":F".$i)->getFont()->setSize(10)->setBold(true);
        $i++;
        $sheet->mergeCells("A".$i.":F".$i)->setCellValue("A".$i, "NGRASEH DANDER BOJONEGORO  TELP (0353) 886039       BH : 8181/BH/II/95");
        $sheet->getStyle("A".$i.":F".$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle("A".$i.":F".$i)->getFont()->setSize(10)->setBold(true);
        $i += 2;

        $border_start = $i;
        $sheet->setCellValue("A".$i, "NO");
        $sheet->setCellValue("B".$i, "NAMA NASABAH");
        $sheet->setCellValue("C".$i, "NOMOR NASABAH");
        $sheet->setCellValue("D".$i, "NIK");
        $sheet->setCellValue("E".$i, "JENIS");
        $sheet->setCellValue("F".$i, "JUMLAH");
        $sheet->getStyle("A".$i.":F".$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle("A".$i.":F".$i)->getFont()->setBold(true);
        $i++;

        $no = 1;
        for($a = 0; $a < sizeof($data); $a++) {
            $sheet->setCellValue("A".$i, $no);
            $sheet->setCellValue("B".$i, $data[$a]['nama']);
            $sheet->setCellValue("C".$i, $data[$a]['nomor_nasabah']);
            $sheet->setCellValue("D".$i, "'".$data[$a]['nik']);
            $sheet->setCellValue("E".$i, $data[$a]['jenis']);
            $sheet->setCellValue("F".$i, $data[$a]['jumlah']);
            $sheet->getStyle("A".$i.":E".$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $sheet->getStyle("F".$i)->getNumberFormat()->setFormatCode('#,##0');
            $i++;
            $no++;
        }

        $border_end = $i - 1;

        foreach(range('A','F') as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }

        $thin = array ();
        $thin['borders']=array();
        $thin['borders']['allborders']=array();
        $thin['borders']['allborders']['style']=PHPExcel_Style_Border::BORDER_THIN ;
        $sheet  ->getStyle ( "A".$border_start.":F".$border_end )->applyFromArray ($thin);

        $filename = "Laporan Harian Simpanan Pihak Ketiga_".$tgl1.".xlsx";

        header ( 'Content-Type: application/vnd.ms-excel' );
        header ( 'Content-Disposition: attachment;filename="'.$filename.'"' );
        header ( 'Cache-Control: max-age=0' );
        $writer = PHPExcel_IOFactory::createWriter ( $file, 'Excel2007' );
        $writer->save ( 'php://output' );
        return;
    }

    function excel_simpanan3th() {
        $session_data = $this->session->userdata('logged_in');
        if($session_data == NULL) {
            redirect("usercon/login", "refresh");
        }

        $tgl1       = $this->input->post('tanggal_simpanan3th');
        $tgl        = strtotime($tgl1);
        $tanggal    = date("Y-m-d",$tgl);

        $data = $this->simpanan3thmodel->get_data_laporan_harian($tanggal);

        /*echo "<pre>";
        var_dump($data);
        echo "</pre>";*/

        $title = strtoupper($data[0]['nama_simpanan']);
        $file = new PHPExcel ();
        $file->getProperties ()->setCreator ( "YHM" );
        $file->getProperties ()->setLastModifiedBy ( "System" );
        $file->getProperties ()->setTitle ( $title );
        $file->getProperties ()->setSubject ( $title );
        $file->getProperties ()->setDescription ( $title );
        $file->getProperties ()->setKeywords ( $title );
        $file->getProperties ()->setCategory ( $title );

        $sheet = $file->getActiveSheet ();
        $i = 2;

        $sheet->mergeCells("A".$i.":F".$i)->setCellValue("A".$i, "KOPPONTREN MAMBAUL MUBBASYIRIN SHIDDIQIYYAH");
        $sheet->getStyle("A".$i.":F".$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle("A".$i.":F".$i)->getFont()->setSize(14)->setBold(true);
        $i++;
        $sheet->mergeCells("A".$i.":F".$i)->setCellValue("A".$i, $title." ".$tgl1);
        $sheet->getStyle("A".$i.":F".$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle("A".$i.":F".$i)->getFont()->setSize(12)->setBold(true);
        $i++;
        $sheet->mergeCells("A".$i.":F".$i)->setCellValue("A".$i, "KANTOR PONPES MAJMA'AL BAHRAIN SHIDDIQIYYAH");
        $sheet->getStyle("A".$i.":F".$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle("A".$i.":F".$i)->getFont()->setSize(10)->setBold(true);
        $i++;
        $sheet->mergeCells("A".$i.":F".$i)->setCellValue("A".$i, "NGRASEH DANDER BOJONEGORO  TELP (0353) 886039       BH : 8181/BH/II/95");
        $sheet->getStyle("A".$i.":F".$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle("A".$i.":F".$i)->getFont()->setSize(10)->setBold(true);
        $i += 2;

        $border_start = $i;
        $sheet->setCellValue("A".$i, "NO");
        $sheet->setCellValue("B".$i, "NAMA");
        $sheet->setCellValue("C".$i, "NOMOR NASABAH");
        $sheet->setCellValue("D".$i, "NIK");
        $sheet->setCellValue("E".$i, "JENIS");
        $sheet->setCellValue("F".$i, "JUMLAH");
        $sheet->getStyle("A".$i.":F".$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle("A".$i.":F".$i)->getFont()->setBold(true);
        $i++;

        $no = 1;
        for($a = 0; $a < sizeof($data); $a++) {
            $sheet->setCellValue("A".$i, $no);
            $sheet->setCellValue("B".$i, $data[$a]['nama_nasabah']);
            $sheet->setCellValue("C".$i, $data[$a]['nomor_nasabah']);
            $sheet->setCellValue("D".$i, "'".$data[$a]['nik_nasabah']);
            $sheet->setCellValue("E".$i, $data[$a]['jenis']);
            $sheet->setCellValue("F".$i, $data[$a]['jumlah']);
            $sheet->getStyle("A".$i.":E".$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $sheet->getStyle("F".$i)->getNumberFormat()->setFormatCode('#,##0');
            $i++;
            $no++;
        }

        $border_end = $i - 1;

        foreach(range('A','F') as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }

        $thin = array ();
        $thin['borders']=array();
        $thin['borders']['allborders']=array();
        $thin['borders']['allborders']['style']=PHPExcel_Style_Border::BORDER_THIN ;
        $sheet  ->getStyle ( "A".$border_start.":F".$border_end )->applyFromArray ($thin);

        $filename = $title."_".$tgl1.".xlsx";

        header ( 'Content-Type: application/vnd.ms-excel' );
        header ( 'Content-Disposition: attachment;filename="'.$filename.'"' );
        header ( 'Cache-Control: max-age=0' );
        $writer = PHPExcel_IOFactory::createWriter ( $file, 'Excel2007' );
        $writer->save ( 'php://output' );
        return;
    }
}

?>