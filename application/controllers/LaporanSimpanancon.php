<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class LaporanSimpananCon extends CI_Controller {
	function __construct() {
		parent::__construct();

		$this->load->model('usermodel');
		$this->load->model('nasabahmodel');
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
		$this->load->view('/laporan/simpanan', $data);
		$this->load->view('/layouts/footer', $data);	
	}

	function excel_simpananpokok() {
		$session_data = $this->session->userdata('logged_in');
		if($session_data == NULL) {
			redirect("usercon/login", "refresh");
		}

		$tgl_dari1 	= $this->input->post('dari_simpananpokok');
		$tgl_dari 	= strtotime($tgl_dari1);
		$dari 		= date("Y-m-d",$tgl_dari);

		$tgl_sampai1	= $this->input->post('sampai_simpananpokok');
		$tgl_sampai 	= strtotime($tgl_sampai1);
		$sampai 		= date("Y-m-d",$tgl_sampai);

		$data = $this->simpananpokokmodel->get_data_laporan($dari, $sampai);

        /*echo "<pre>";
        var_dump(sizeof($data));
        echo "</pre>";*/

		$file = new PHPExcel ();
        $file->getProperties ()->setCreator ( "YHM" );
        $file->getProperties ()->setLastModifiedBy ( "System" );
        $file->getProperties ()->setTitle ( "Laporan Simpanan Pokok" );
        $file->getProperties ()->setSubject ( "Laporan Simpanan Pokok" );
        $file->getProperties ()->setDescription ( "Laporan Simpanan Pokok" );
        $file->getProperties ()->setKeywords ( "Laporan Simpanan Pokok" );
        $file->getProperties ()->setCategory ( "Laporan Simpanan Pokok" );

        $sheet = $file->getActiveSheet ();
        $i = 2;

        $sheet->mergeCells("A".$i.":H".$i)->setCellValue("A".$i, "KOPPONTREN MAMBAUL MUBBASYIRIN SHIDDIQIYYAH");
        $sheet->getStyle("A".$i.":H".$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle("A".$i.":H".$i)->getFont()->setSize(14)->setBold(true);
        $i++;
        $sheet->mergeCells("A".$i.":H".$i)->setCellValue("A".$i, "LAPORAN SIMPANAN POKOK ".$tgl_dari1." - ".$tgl_sampai1);
        $sheet->getStyle("A".$i.":H".$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle("A".$i.":H".$i)->getFont()->setSize(12)->setBold(true);
        $i++;
        $sheet->mergeCells("A".$i.":H".$i)->setCellValue("A".$i, "KANTOR PONPES MAJMA'AL BAHRAIN SHIDDIQIYYAH");
        $sheet->getStyle("A".$i.":H".$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle("A".$i.":H".$i)->getFont()->setSize(10)->setBold(true);
        $i++;
        $sheet->mergeCells("A".$i.":H".$i)->setCellValue("A".$i, "NGRASEH DANDER BOJONEGORO  TELP (0353) 886039       BH : 8181/BH/II/95");
        $sheet->getStyle("A".$i.":H".$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle("A".$i.":H".$i)->getFont()->setSize(10)->setBold(true);
        $i += 2;

        $border_start = $i;
        $sheet->setCellValue("A".$i, "NO");
        $sheet->setCellValue("B".$i, "NAMA");
        $sheet->setCellValue("C".$i, "ALAMAT");
        $sheet->setCellValue("D".$i, "DESA");
        $sheet->setCellValue("E".$i, "DUSUN");
        $sheet->setCellValue("F".$i, "RW");
        $sheet->setCellValue("G".$i, "RT");
        $sheet->setCellValue("H".$i, "JUMLAH SIMPANAN");
        $sheet->getStyle("A".$i.":H".$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle("A".$i.":H".$i)->getFont()->setBold(true);
        $i++;

        $no = 1;
        $total = 0;

        for($a = 0; $a < sizeof($data); $a++) {
        	$sheet->setCellValue("A".$i, $no);
        	$sheet->setCellValue("B".$i, $data[$a]['nama_nasabah']);
        	$sheet->setCellValue("C".$i, $data[$a]['alamat']);
        	$sheet->setCellValue("D".$i, $data[$a]['kelurahan']);
        	$sheet->setCellValue("E".$i, $data[$a]['dusun']);
        	$sheet->setCellValue("F".$i, $data[$a]['rw']);
        	$sheet->setCellValue("G".$i, $data[$a]['rt']);
        	$sheet->setCellValue("H".$i, $data[$a]['jumlah']);
            $sheet->getStyle("H".$i)->getNumberFormat()->setFormatCode('#,##0');
            $sheet->getStyle("A".$i.":G".$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $total += $data[$a]['jumlah'];
        	$no++;
            $i++;
        }

        $sheet->mergeCells("A".$i.":G".$i)->setCellValue("A".$i, "TOTAL");
        $sheet->setCellValue("H".$i, $total);
        $sheet->getStyle("H".$i)->getNumberFormat()->setFormatCode('#,##0');
        $sheet->getStyle("A".$i.":H".$i)->getFont()->setBold(true);
        $sheet->getStyle("A".$i.":G".$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        $border_end = $i;

        foreach(range('A','H') as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }

        $thin = array ();
        $thin['borders']=array();
        $thin['borders']['allborders']=array();
        $thin['borders']['allborders']['style']=PHPExcel_Style_Border::BORDER_THIN ;
        $sheet  ->getStyle ( "A".$border_start.":H".$border_end )->applyFromArray ($thin);

        $filename = "Laporan Simpanan Pokok_".$tgl_dari1."_".$tgl_sampai1.".xlsx";

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

		$tgl_dari1 	= $this->input->post('dari_simpananwajib');
		$tgl_dari 	= strtotime($tgl_dari1);
		$dari 		= date("Y-m-d",$tgl_dari);

		$tgl_sampai1	= $this->input->post('sampai_simpananwajib');
		$tgl_sampai 	= strtotime($tgl_sampai1);
		$sampai 		= date("Y-m-d",$tgl_sampai);

        $data = $this->simpananwajibmodel->get_data_laporan($dari, $sampai);

        /*echo "<pre>";
        var_dump(sizeof($data));
        echo "</pre>";*/

        $file = new PHPExcel ();
        $file->getProperties ()->setCreator ( "YHM" );
        $file->getProperties ()->setLastModifiedBy ( "System" );
        $file->getProperties ()->setTitle ( "Laporan Simpanan Wajib" );
        $file->getProperties ()->setSubject ( "Laporan Simpanan Wajib" );
        $file->getProperties ()->setDescription ( "Laporan Simpanan Wajib" );
        $file->getProperties ()->setKeywords ( "Laporan Simpanan Wajib" );
        $file->getProperties ()->setCategory ( "Laporan Simpanan Wajib" );

        $sheet = $file->getActiveSheet ();
        $i = 2;

        $sheet->mergeCells("A".$i.":H".$i)->setCellValue("A".$i, "KOPPONTREN MAMBAUL MUBBASYIRIN SHIDDIQIYYAH");
        $sheet->getStyle("A".$i.":H".$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle("A".$i.":H".$i)->getFont()->setSize(14)->setBold(true);
        $i++;
        $sheet->mergeCells("A".$i.":H".$i)->setCellValue("A".$i, "LAPORAN SIMPANAN WAJIB ".$tgl_dari1." - ".$tgl_sampai1);
        $sheet->getStyle("A".$i.":H".$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle("A".$i.":H".$i)->getFont()->setSize(12)->setBold(true);
        $i++;
        $sheet->mergeCells("A".$i.":H".$i)->setCellValue("A".$i, "KANTOR PONPES MAJMA'AL BAHRAIN SHIDDIQIYYAH");
        $sheet->getStyle("A".$i.":H".$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle("A".$i.":H".$i)->getFont()->setSize(10)->setBold(true);
        $i++;
        $sheet->mergeCells("A".$i.":H".$i)->setCellValue("A".$i, "NGRASEH DANDER BOJONEGORO  TELP (0353) 886039       BH : 8181/BH/II/95");
        $sheet->getStyle("A".$i.":H".$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle("A".$i.":H".$i)->getFont()->setSize(10)->setBold(true);
        $i += 2;

        $border_start = $i;
        $sheet->setCellValue("A".$i, "NO");
        $sheet->setCellValue("B".$i, "NAMA");
        $sheet->setCellValue("C".$i, "ALAMAT");
        $sheet->setCellValue("D".$i, "DESA");
        $sheet->setCellValue("E".$i, "DUSUN");
        $sheet->setCellValue("F".$i, "RW");
        $sheet->setCellValue("G".$i, "RT");
        $sheet->setCellValue("H".$i, "JUMLAH SIMPANAN");
        $sheet->getStyle("A".$i.":H".$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle("A".$i.":H".$i)->getFont()->setBold(true);
        $i++;

        $no = 1;
        $total = 0;

        for($a = 0; $a < sizeof($data); $a++) {
            $sheet->setCellValue("A".$i, $no);
            $sheet->setCellValue("B".$i, $data[$a]['nama_nasabah']);
            $sheet->setCellValue("C".$i, $data[$a]['alamat']);
            $sheet->setCellValue("D".$i, $data[$a]['kelurahan']);
            $sheet->setCellValue("E".$i, $data[$a]['dusun']);
            $sheet->setCellValue("F".$i, $data[$a]['rw']);
            $sheet->setCellValue("G".$i, $data[$a]['rt']);
            $jumlah = $data[$a]['jumlah_setoran'] - $data[$a]['jumlah_tarikan'];
            $sheet->setCellValue("H".$i, $jumlah);
            $sheet->getStyle("H".$i)->getNumberFormat()->setFormatCode('#,##0');
            $sheet->getStyle("A".$i.":G".$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $total += $jumlah;
            $no++;
            $i++;
        }

        $sheet->mergeCells("A".$i.":G".$i)->setCellValue("A".$i, "TOTAL");
        $sheet->setCellValue("H".$i, $total);
        $sheet->getStyle("H".$i)->getNumberFormat()->setFormatCode('#,##0');
        $sheet->getStyle("A".$i.":H".$i)->getFont()->setBold(true);
        $sheet->getStyle("A".$i.":G".$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        $border_end = $i;

        foreach(range('A','H') as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }

        $thin = array ();
        $thin['borders']=array();
        $thin['borders']['allborders']=array();
        $thin['borders']['allborders']['style']=PHPExcel_Style_Border::BORDER_THIN ;
        $sheet  ->getStyle ( "A".$border_start.":H".$border_end )->applyFromArray ($thin);

        $filename = "Laporan Simpanan Wajib_".$tgl_dari1."_".$tgl_sampai1.".xlsx";

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

        $tgl_dari1  = $this->input->post('dari_simpanankhusus');
        $tgl_dari   = strtotime($tgl_dari1);
        $dari       = date("Y-m-d",$tgl_dari);

        $tgl_sampai1    = $this->input->post('sampai_simpanankhusus');
        $tgl_sampai     = strtotime($tgl_sampai1);
        $sampai         = date("Y-m-d",$tgl_sampai);

        $data = $this->simpanankhususmodel->get_data_laporan($dari, $sampai);

        /*echo "<pre>";
        var_dump(sizeof($data));
        echo "</pre>";*/

        $file = new PHPExcel ();
        $file->getProperties ()->setCreator ( "YHM" );
        $file->getProperties ()->setLastModifiedBy ( "System" );
        $file->getProperties ()->setTitle ( "Laporan Simpanan Khusus" );
        $file->getProperties ()->setSubject ( "Laporan Simpanan Khusus" );
        $file->getProperties ()->setDescription ( "Laporan Simpanan Khusus" );
        $file->getProperties ()->setKeywords ( "Laporan Simpanan Khusus" );
        $file->getProperties ()->setCategory ( "Laporan Simpanan Khusus" );

        $sheet = $file->getActiveSheet ();
        $i = 2;

        $sheet->mergeCells("A".$i.":H".$i)->setCellValue("A".$i, "KOPPONTREN MAMBAUL MUBBASYIRIN SHIDDIQIYYAH");
        $sheet->getStyle("A".$i.":H".$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle("A".$i.":H".$i)->getFont()->setSize(14)->setBold(true);
        $i++;
        $sheet->mergeCells("A".$i.":H".$i)->setCellValue("A".$i, "LAPORAN SIMPANAN KHUSUS ".$tgl_dari1." - ".$tgl_sampai1);
        $sheet->getStyle("A".$i.":H".$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle("A".$i.":H".$i)->getFont()->setSize(12)->setBold(true);
        $i++;
        $sheet->mergeCells("A".$i.":H".$i)->setCellValue("A".$i, "KANTOR PONPES MAJMA'AL BAHRAIN SHIDDIQIYYAH");
        $sheet->getStyle("A".$i.":H".$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle("A".$i.":H".$i)->getFont()->setSize(10)->setBold(true);
        $i++;
        $sheet->mergeCells("A".$i.":H".$i)->setCellValue("A".$i, "NGRASEH DANDER BOJONEGORO  TELP (0353) 886039       BH : 8181/BH/II/95");
        $sheet->getStyle("A".$i.":H".$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle("A".$i.":H".$i)->getFont()->setSize(10)->setBold(true);
        $i += 2;

        $border_start = $i;
        $sheet->setCellValue("A".$i, "NO");
        $sheet->setCellValue("B".$i, "NAMA");
        $sheet->setCellValue("C".$i, "ALAMAT");
        $sheet->setCellValue("D".$i, "DESA");
        $sheet->setCellValue("E".$i, "DUSUN");
        $sheet->setCellValue("F".$i, "RW");
        $sheet->setCellValue("G".$i, "RT");
        $sheet->setCellValue("H".$i, "JUMLAH SIMPANAN");
        $sheet->getStyle("A".$i.":H".$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle("A".$i.":H".$i)->getFont()->setBold(true);
        $i++;

        $no = 1;
        $total = 0;

        for($a = 0; $a < sizeof($data); $a++) {
            $sheet->setCellValue("A".$i, $no);
            $sheet->setCellValue("B".$i, $data[$a]['nama_nasabah']);
            $sheet->setCellValue("C".$i, $data[$a]['alamat']);
            $sheet->setCellValue("D".$i, $data[$a]['kelurahan']);
            $sheet->setCellValue("E".$i, $data[$a]['dusun']);
            $sheet->setCellValue("F".$i, $data[$a]['rw']);
            $sheet->setCellValue("G".$i, $data[$a]['rt']);
            $jumlah = $data[$a]['jumlah_setoran'] - $data[$a]['jumlah_tarikan'];
            $sheet->setCellValue("H".$i, $jumlah);
            $sheet->getStyle("H".$i)->getNumberFormat()->setFormatCode('#,##0');
            $sheet->getStyle("A".$i.":G".$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $total += $jumlah;
            $no++;
            $i++;
        }

        $sheet->mergeCells("A".$i.":G".$i)->setCellValue("A".$i, "TOTAL");
        $sheet->setCellValue("H".$i, $total);
        $sheet->getStyle("H".$i)->getNumberFormat()->setFormatCode('#,##0');
        $sheet->getStyle("A".$i.":H".$i)->getFont()->setBold(true);
        $sheet->getStyle("A".$i.":G".$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        $border_end = $i;

        foreach(range('A','H') as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }

        $thin = array ();
        $thin['borders']=array();
        $thin['borders']['allborders']=array();
        $thin['borders']['allborders']['style']=PHPExcel_Style_Border::BORDER_THIN ;
        $sheet  ->getStyle ( "A".$border_start.":H".$border_end )->applyFromArray ($thin);

        $filename = "Laporan Simpanan Khusus_".$tgl_dari1."_".$tgl_sampai1.".xlsx";

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

        $tgl_dari1  = $this->input->post('dari_simpanandanasosial');
        $tgl_dari   = strtotime($tgl_dari1);
        $dari       = date("Y-m-d",$tgl_dari);

        $tgl_sampai1    = $this->input->post('sampai_simpanandanasosial');
        $tgl_sampai     = strtotime($tgl_sampai1);
        $sampai         = date("Y-m-d",$tgl_sampai);

        $data = $this->simpanandanasosialmodel->get_data_laporan($dari, $sampai);

        /*echo "<pre>";
        var_dump(sizeof($data));
        echo "</pre>";*/

        $file = new PHPExcel ();
        $file->getProperties ()->setCreator ( "YHM" );
        $file->getProperties ()->setLastModifiedBy ( "System" );
        $file->getProperties ()->setTitle ( "Laporan Simpanan Dansos Anggota" );
        $file->getProperties ()->setSubject ( "Laporan Simpanan Dansos Anggota" );
        $file->getProperties ()->setDescription ( "Laporan Simpanan Dansos Anggota" );
        $file->getProperties ()->setKeywords ( "Laporan Simpanan Dansos Anggota" );
        $file->getProperties ()->setCategory ( "Laporan Simpanan Dansos Anggota" );

        $sheet = $file->getActiveSheet ();
        $i = 2;

        $sheet->mergeCells("A".$i.":H".$i)->setCellValue("A".$i, "KOPPONTREN MAMBAUL MUBBASYIRIN SHIDDIQIYYAH");
        $sheet->getStyle("A".$i.":H".$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle("A".$i.":H".$i)->getFont()->setSize(14)->setBold(true);
        $i++;
        $sheet->mergeCells("A".$i.":H".$i)->setCellValue("A".$i, "LAPORAN SIMPANAN DANSOS ANGGOTA ".$tgl_dari1." - ".$tgl_sampai1);
        $sheet->getStyle("A".$i.":H".$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle("A".$i.":H".$i)->getFont()->setSize(12)->setBold(true);
        $i++;
        $sheet->mergeCells("A".$i.":H".$i)->setCellValue("A".$i, "KANTOR PONPES MAJMA'AL BAHRAIN SHIDDIQIYYAH");
        $sheet->getStyle("A".$i.":H".$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle("A".$i.":H".$i)->getFont()->setSize(10)->setBold(true);
        $i++;
        $sheet->mergeCells("A".$i.":H".$i)->setCellValue("A".$i, "NGRASEH DANDER BOJONEGORO  TELP (0353) 886039       BH : 8181/BH/II/95");
        $sheet->getStyle("A".$i.":H".$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle("A".$i.":H".$i)->getFont()->setSize(10)->setBold(true);
        $i += 2;

        $border_start = $i;
        $sheet->setCellValue("A".$i, "NO");
        $sheet->setCellValue("B".$i, "NAMA");
        $sheet->setCellValue("C".$i, "ALAMAT");
        $sheet->setCellValue("D".$i, "DESA");
        $sheet->setCellValue("E".$i, "DUSUN");
        $sheet->setCellValue("F".$i, "RW");
        $sheet->setCellValue("G".$i, "RT");
        $sheet->setCellValue("H".$i, "JUMLAH SIMPANAN");
        $sheet->getStyle("A".$i.":H".$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle("A".$i.":H".$i)->getFont()->setBold(true);
        $i++;

        $no = 1;
        $total = 0;

        for($a = 0; $a < sizeof($data); $a++) {
            $sheet->setCellValue("A".$i, $no);
            $sheet->setCellValue("B".$i, $data[$a]['nama_nasabah']);
            $sheet->setCellValue("C".$i, $data[$a]['alamat']);
            $sheet->setCellValue("D".$i, $data[$a]['kelurahan']);
            $sheet->setCellValue("E".$i, $data[$a]['dusun']);
            $sheet->setCellValue("F".$i, $data[$a]['rw']);
            $sheet->setCellValue("G".$i, $data[$a]['rt']);
            $jumlah = $data[$a]['jumlah_setoran'] - $data[$a]['jumlah_tarikan'];
            $sheet->setCellValue("H".$i, $jumlah);
            $sheet->getStyle("H".$i)->getNumberFormat()->setFormatCode('#,##0');
            $sheet->getStyle("A".$i.":G".$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $total += $jumlah;
            $no++;
            $i++;
        }

        $sheet->mergeCells("A".$i.":G".$i)->setCellValue("A".$i, "TOTAL");
        $sheet->setCellValue("H".$i, $total);
        $sheet->getStyle("H".$i)->getNumberFormat()->setFormatCode('#,##0');
        $sheet->getStyle("A".$i.":H".$i)->getFont()->setBold(true);
        $sheet->getStyle("A".$i.":G".$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        $border_end = $i;

        foreach(range('A','H') as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }

        $thin = array ();
        $thin['borders']=array();
        $thin['borders']['allborders']=array();
        $thin['borders']['allborders']['style']=PHPExcel_Style_Border::BORDER_THIN ;
        $sheet  ->getStyle ( "A".$border_start.":H".$border_end )->applyFromArray ($thin);

        $filename = "Laporan Simpanan Dansos Anggota_".$tgl_dari1."_".$tgl_sampai1.".xlsx";

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

        $tgl_dari1  = $this->input->post('dari_simpanankanzun');
        $tgl_dari   = strtotime($tgl_dari1);
        $dari       = date("Y-m-d",$tgl_dari);

        $tgl_sampai1    = $this->input->post('sampai_simpanankanzun');
        $tgl_sampai     = strtotime($tgl_sampai1);
        $sampai         = date("Y-m-d",$tgl_sampai);

        $data = $this->simpanankanzunmodel->get_data_laporan($dari, $sampai);

        /*echo "<pre>";
        var_dump(sizeof($data));
        echo "</pre>";*/

        $file = new PHPExcel ();
        $file->getProperties ()->setCreator ( "YHM" );
        $file->getProperties ()->setLastModifiedBy ( "System" );
        $file->getProperties ()->setTitle ( "Laporan Simpanan Kanzun" );
        $file->getProperties ()->setSubject ( "Laporan Simpanan Kanzun" );
        $file->getProperties ()->setDescription ( "Laporan Simpanan Kanzun" );
        $file->getProperties ()->setKeywords ( "Laporan Simpanan Kanzun" );
        $file->getProperties ()->setCategory ( "Laporan Simpanan Kanzun" );

        $sheet = $file->getActiveSheet ();
        $i = 2;

        $sheet->mergeCells("A".$i.":H".$i)->setCellValue("A".$i, "KOPPONTREN MAMBAUL MUBBASYIRIN SHIDDIQIYYAH");
        $sheet->getStyle("A".$i.":H".$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle("A".$i.":H".$i)->getFont()->setSize(14)->setBold(true);
        $i++;
        $sheet->mergeCells("A".$i.":H".$i)->setCellValue("A".$i, "LAPORAN SIMPANAN KANZUN ".$tgl_dari1." - ".$tgl_sampai1);
        $sheet->getStyle("A".$i.":H".$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle("A".$i.":H".$i)->getFont()->setSize(12)->setBold(true);
        $i++;
        $sheet->mergeCells("A".$i.":H".$i)->setCellValue("A".$i, "KANTOR PONPES MAJMA'AL BAHRAIN SHIDDIQIYYAH");
        $sheet->getStyle("A".$i.":H".$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle("A".$i.":H".$i)->getFont()->setSize(10)->setBold(true);
        $i++;
        $sheet->mergeCells("A".$i.":H".$i)->setCellValue("A".$i, "NGRASEH DANDER BOJONEGORO  TELP (0353) 886039       BH : 8181/BH/II/95");
        $sheet->getStyle("A".$i.":H".$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle("A".$i.":H".$i)->getFont()->setSize(10)->setBold(true);
        $i += 2;

        $border_start = $i;
        $sheet->setCellValue("A".$i, "NO");
        $sheet->setCellValue("B".$i, "NAMA");
        $sheet->setCellValue("C".$i, "ALAMAT");
        $sheet->setCellValue("D".$i, "DESA");
        $sheet->setCellValue("E".$i, "DUSUN");
        $sheet->setCellValue("F".$i, "RW");
        $sheet->setCellValue("G".$i, "RT");
        $sheet->setCellValue("H".$i, "JUMLAH SIMPANAN");
        $sheet->getStyle("A".$i.":H".$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle("A".$i.":H".$i)->getFont()->setBold(true);
        $i++;

        $no = 1;
        $total = 0;

        for($a = 0; $a < sizeof($data); $a++) {
            $sheet->setCellValue("A".$i, $no);
            $sheet->setCellValue("B".$i, $data[$a]['nama_nasabah']);
            $sheet->setCellValue("C".$i, $data[$a]['alamat']);
            $sheet->setCellValue("D".$i, $data[$a]['kelurahan']);
            $sheet->setCellValue("E".$i, $data[$a]['dusun']);
            $sheet->setCellValue("F".$i, $data[$a]['rw']);
            $sheet->setCellValue("G".$i, $data[$a]['rt']);
            $jumlah = $data[$a]['jumlah_setoran'] - $data[$a]['jumlah_tarikan'];
            $sheet->setCellValue("H".$i, $jumlah);
            $sheet->getStyle("H".$i)->getNumberFormat()->setFormatCode('#,##0');
            $sheet->getStyle("A".$i.":G".$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $total += $jumlah;
            $no++;
            $i++;
        }

        $sheet->mergeCells("A".$i.":G".$i)->setCellValue("A".$i, "TOTAL");
        $sheet->setCellValue("H".$i, $total);
        $sheet->getStyle("H".$i)->getNumberFormat()->setFormatCode('#,##0');
        $sheet->getStyle("A".$i.":H".$i)->getFont()->setBold(true);
        $sheet->getStyle("A".$i.":G".$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        $border_end = $i;

        foreach(range('A','H') as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }

        $thin = array ();
        $thin['borders']=array();
        $thin['borders']['allborders']=array();
        $thin['borders']['allborders']['style']=PHPExcel_Style_Border::BORDER_THIN ;
        $sheet  ->getStyle ( "A".$border_start.":H".$border_end )->applyFromArray ($thin);

        $filename = "Laporan Simpanan Kanzun_".$tgl_dari1."_".$tgl_sampai1.".xlsx";

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

        $tgl_dari1  = $this->input->post('dari_simpananpihakketiga');
        $tgl_dari   = strtotime($tgl_dari1);
        $dari       = date("Y-m-d",$tgl_dari);

        $tgl_sampai1    = $this->input->post('sampai_simpananpihakketiga');
        $tgl_sampai     = strtotime($tgl_sampai1);
        $sampai         = date("Y-m-d",$tgl_sampai);

        $data = $this->simpananpihakketigamodel->get_data_laporan($dari, $sampai);

        /*echo "<pre>";
        var_dump($data);
        echo "</pre>";*/

        $file = new PHPExcel ();
        $file->getProperties ()->setCreator ( "YHM" );
        $file->getProperties ()->setLastModifiedBy ( "System" );
        $file->getProperties ()->setTitle ( "Laporan Simpanan Pihak Ketiga" );
        $file->getProperties ()->setSubject ( "Laporan Simpanan Pihak Ketiga" );
        $file->getProperties ()->setDescription ( "Laporan Simpanan Pihak Ketiga" );
        $file->getProperties ()->setKeywords ( "Laporan Simpanan Pihak Ketiga" );
        $file->getProperties ()->setCategory ( "Laporan Simpanan Pihak Ketiga" );

        $sheet = $file->getActiveSheet ();
        $i = 2;

        $sheet->mergeCells("A".$i.":H".$i)->setCellValue("A".$i, "KOPPONTREN MAMBAUL MUBBASYIRIN SHIDDIQIYYAH");
        $sheet->getStyle("A".$i.":H".$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle("A".$i.":H".$i)->getFont()->setSize(14)->setBold(true);
        $i++;
        $sheet->mergeCells("A".$i.":H".$i)->setCellValue("A".$i, "LAPORAN SIMPANAN PIHAK KETIGA ".$tgl_dari1." - ".$tgl_sampai1);
        $sheet->getStyle("A".$i.":H".$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle("A".$i.":H".$i)->getFont()->setSize(12)->setBold(true);
        $i++;
        $sheet->mergeCells("A".$i.":H".$i)->setCellValue("A".$i, "KANTOR PONPES MAJMA'AL BAHRAIN SHIDDIQIYYAH");
        $sheet->getStyle("A".$i.":H".$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle("A".$i.":H".$i)->getFont()->setSize(10)->setBold(true);
        $i++;
        $sheet->mergeCells("A".$i.":H".$i)->setCellValue("A".$i, "NGRASEH DANDER BOJONEGORO  TELP (0353) 886039       BH : 8181/BH/II/95");
        $sheet->getStyle("A".$i.":H".$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle("A".$i.":H".$i)->getFont()->setSize(10)->setBold(true);
        $i += 2;

        $border_start = $i;
        $sheet->setCellValue("A".$i, "NO");
        $sheet->setCellValue("B".$i, "NAMA");
        $sheet->setCellValue("C".$i, "ALAMAT");
        $sheet->setCellValue("D".$i, "DESA");
        $sheet->setCellValue("E".$i, "DUSUN");
        $sheet->setCellValue("F".$i, "RW");
        $sheet->setCellValue("G".$i, "RT");
        $sheet->setCellValue("H".$i, "JUMLAH SIMPANAN");
        $sheet->getStyle("A".$i.":H".$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle("A".$i.":H".$i)->getFont()->setBold(true);
        $i++;

        $no = 1;
        $total = 0;

        for($a = 0; $a < sizeof($data); $a++) {
            $sheet->setCellValue("A".$i, $no);
            $sheet->setCellValue("B".$i, $data[$a]['nama']);
            $sheet->setCellValue("C".$i, $data[$a]['alamat_n']);
            $sheet->setCellValue("D".$i, $data[$a]['kelurahan_n']);
            $sheet->setCellValue("E".$i, $data[$a]['dusun_n']);
            $sheet->setCellValue("F".$i, $data[$a]['rw_n']);
            $sheet->setCellValue("G".$i, $data[$a]['rt_n']);
            $jumlah = $data[$a]['jumlah_setoran'] - $data[$a]['jumlah_tarikan'];
            $sheet->setCellValue("H".$i, $jumlah);
            $sheet->getStyle("H".$i)->getNumberFormat()->setFormatCode('#,##0');
            $sheet->getStyle("A".$i.":G".$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $total += $jumlah;
            $no++;
            $i++;
        }

        $sheet->mergeCells("A".$i.":G".$i)->setCellValue("A".$i, "TOTAL");
        $sheet->setCellValue("H".$i, $total);
        $sheet->getStyle("H".$i)->getNumberFormat()->setFormatCode('#,##0');
        $sheet->getStyle("A".$i.":H".$i)->getFont()->setBold(true);
        $sheet->getStyle("A".$i.":G".$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        $border_end = $i;

        foreach(range('A','H') as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }

        $thin = array ();
        $thin['borders']=array();
        $thin['borders']['allborders']=array();
        $thin['borders']['allborders']['style']=PHPExcel_Style_Border::BORDER_THIN ;
        $sheet  ->getStyle ( "A".$border_start.":H".$border_end )->applyFromArray ($thin);

        $filename = "Laporan Simpanan Pihak Ketiga_".$tgl_dari1."_".$tgl_sampai1.".xlsx";

        header ( 'Content-Type: application/vnd.ms-excel' );
        header ( 'Content-Disposition: attachment;filename="'.$filename.'"' );
        header ( 'Cache-Control: max-age=0' );
        $writer = PHPExcel_IOFactory::createWriter ( $file, 'Excel2007' );
        $writer->save ( 'php://output' );
        return;
    }
}

?>