<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class LaporanRincianJasaCon extends CI_Controller {
	function __construct() {
		parent::__construct();

		$this->load->model('usermodel');
		$this->load->model('nasabahmodel');
		$this->load->model('mappingkodeakunmodel');
		$this->load->model('kodeakunmodel');
		$this->load->model('transaksiakuntansimodel');
		$this->load->model('pinjamanmodel');
		$this->load->model('detailangsuranmodel');
		$this->load->model('laporanrincianjasamodel');

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

	function index() {
		$session_data = $this->session->userdata('logged_in');
		if($session_data == NULL) {
			redirect("usercon/login", "refresh");
		}
		$data['username'] 	= $session_data['username'];
		$data['status'] 	= $session_data['status'];
		$data['nasabah'] 	= $this->nasabahmodel->showData();
		
		$this->load->view('/layouts/menu', $data);
		$this->load->view('/laporan/rincian_jasa', $data);
		$this->load->view('/layouts/footer', $data);	
	}

	function excel_coba() {
        $session_data = $this->session->userdata('logged_in');
        if($session_data == NULL) {
            redirect("usercon/login", "refresh");
        }

        $tgl_dari1      = $this->input->post('dari');
        $tgl_dari       = strtotime($tgl_dari1);
        $dari           = date("Y-m-d",$tgl_dari);

        $tgl_sampai1    = $this->input->post('sampai');
        $tgl_sampai     = strtotime($tgl_sampai1);
        $sampai         = date("Y-m-d",$tgl_sampai);

        $data = $this->laporanrincianjasamodel->get_data1($dari, $sampai); 

        /*echo "<pre>";
        var_dump($data);
        echo "</pre>";*/

        $file = new PHPExcel ();
        $file->getProperties ()->setCreator ( "YHM" );
        $file->getProperties ()->setLastModifiedBy ( "System" );
        $file->getProperties ()->setTitle ( "Laporan Rincian Jasa" );
        $file->getProperties ()->setSubject ( "Laporan Rincian Jasa" );
        $file->getProperties ()->setDescription ( "Laporan Rincian Jasa" );
        $file->getProperties ()->setKeywords ( "Laporan Rincian Jasa" );
        $file->getProperties ()->setCategory ( "Laporan Rincian Jasa" );

        $sheet = $file->getActiveSheet ();
        $i = 2;

        $sheet->mergeCells("A".$i.":I".$i)->setCellValue("A".$i, "KOPPONTREN MAMBAUL MUBBASYIRIN SHIDDIQIYYAH");
        $sheet->getStyle("A".$i.":I".$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle("A".$i.":I".$i)->getFont()->setSize(14)->setBold(true);
        $i++;
        $sheet->mergeCells("A".$i.":I".$i)->setCellValue("A".$i, "LAPORAN RINCIAN JASA PER ".$tgl_dari1." - ".$tgl_sampai1);
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
        $sheet->setCellValue("C".$i, "NO NASABAH");
        $sheet->setCellValue("D".$i, "ALAMAT");
        $sheet->setCellValue("E".$i, "DESA");
        $sheet->setCellValue("F".$i, "DUSUN");
        $sheet->setCellValue("G".$i, "RW");
        $sheet->setCellValue("H".$i, "RT");
        $sheet->setCellValue("I".$i, "JUMLAH JASA");
        $sheet->getStyle("A".$i.":I".$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle("A".$i.":I".$i)->getFont()->setBold(true);
        $i++;

        $no = 1;
        $total_jasa = 0;
        for($a = 0; $a < sizeof($data); $a++) {
            $jumlah_jasa = $data[$a]['jumlah_jasa'] + $data[$a]['jumlah_denda'];
            $sheet->setCellValue("A".$i, $no);
            $sheet->setCellValue("B".$i, $data[$a]['nama']);
            $sheet->setCellValue("C".$i, $data[$a]['nomor_koperasi']);
            $sheet->setCellValue("D".$i, $data[$a]['alamat']);
            $sheet->setCellValue("E".$i, $data[$a]['kelurahan']);
            $sheet->setCellValue("F".$i, $data[$a]['dusun']);
            $sheet->setCellValue("G".$i, $data[$a]['rw']);
            $sheet->setCellValue("H".$i, $data[$a]['rt']);
            $sheet->setCellValue("I".$i, $jumlah_jasa);
            $total_jasa += $jumlah_jasa;
            $sheet->getStyle("I".$i)->getNumberFormat()->setFormatCode('#,##0');
            $sheet->getStyle("A".$i.":H".$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $i++;
            $no++;
        }

        $sheet->mergeCells("A".$i.":H".$i)->setCellValue("A".$i, "TOTAL JASA");
        $sheet->setCellValue("I".$i, $total_jasa);
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

        $filename = "Laporan Rincian Jasa_".$tgl_dari1."_".$tgl_sampai1.".xlsx";

        header ( 'Content-Type: application/vnd.ms-excel' );
        header ( 'Content-Disposition: attachment;filename="'.$filename.'"' );
        header ( 'Cache-Control: max-age=0' );
        $writer = PHPExcel_IOFactory::createWriter ( $file, 'Excel2007' );
        $writer->save ( 'php://output' );
        return;
    }

    function excel_coba1() {
        $session_data = $this->session->userdata('logged_in');
        if($session_data == NULL) {
            redirect("usercon/login", "refresh");
        }

        $tgl_dari1      = $this->input->post('dari');
        $tgl_dari       = strtotime($tgl_dari1);
        $dari           = date("Y-m-d",$tgl_dari);

        $tgl_sampai1    = $this->input->post('sampai');
        $tgl_sampai     = strtotime($tgl_sampai1);
        $sampai         = date("Y-m-d",$tgl_sampai);

        $data = $this->laporanrincianjasamodel->get_data1($dari, $sampai); 

        /*echo "<pre>";
        var_dump($data);
        echo "</pre>";*/

        $file = new PHPExcel ();
        $file->getProperties ()->setCreator ( "YHM" );
        $file->getProperties ()->setLastModifiedBy ( "System" );
        $file->getProperties ()->setTitle ( "Laporan Rincian Jasa" );
        $file->getProperties ()->setSubject ( "Laporan Rincian Jasa" );
        $file->getProperties ()->setDescription ( "Laporan Rincian Jasa" );
        $file->getProperties ()->setKeywords ( "Laporan Rincian Jasa" );
        $file->getProperties ()->setCategory ( "Laporan Rincian Jasa" );

        $sheet = $file->getActiveSheet ();
        $i = 2;

        $sheet->mergeCells("A".$i.":J".$i)->setCellValue("A".$i, "KOPPONTREN MAMBAUL MUBBASYIRIN SHIDDIQIYYAH");
        $sheet->getStyle("A".$i.":J".$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle("A".$i.":J".$i)->getFont()->setSize(14)->setBold(true);
        $i++;
        $sheet->mergeCells("A".$i.":J".$i)->setCellValue("A".$i, "LAPORAN RINCIAN JASA PER ".$tgl_dari1." - ".$tgl_sampai1);
        $sheet->getStyle("A".$i.":J".$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle("A".$i.":J".$i)->getFont()->setSize(12)->setBold(true);
        $i++;
        $sheet->mergeCells("A".$i.":J".$i)->setCellValue("A".$i, "KANTOR PONPES MAJMA'AL BAHRAIN SHIDDIQIYYAH");
        $sheet->getStyle("A".$i.":J".$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle("A".$i.":J".$i)->getFont()->setSize(10)->setBold(true);
        $i++;
        $sheet->mergeCells("A".$i.":J".$i)->setCellValue("A".$i, "NGRASEH DANDER BOJONEGORO  TELP (0353) 886039       BH : 8181/BH/II/95");
        $sheet->getStyle("A".$i.":J".$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle("A".$i.":J".$i)->getFont()->setSize(10)->setBold(true);
        $i += 2;

        $border_start = $i;
        $sheet->setCellValue("A".$i, "NO");
        $sheet->setCellValue("B".$i, "ID PINJAMAN");
        $sheet->setCellValue("C".$i, "NAMA");
        $sheet->setCellValue("D".$i, "NO NASABAH");
        $sheet->setCellValue("E".$i, "ALAMAT");
        $sheet->setCellValue("F".$i, "DESA");
        $sheet->setCellValue("G".$i, "DUSUN");
        $sheet->setCellValue("H".$i, "RW");
        $sheet->setCellValue("I".$i, "RT");
        $sheet->setCellValue("J".$i, "JUMLAH JASA");
        $sheet->getStyle("A".$i.":J".$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle("A".$i.":J".$i)->getFont()->setBold(true);
        $i++;

        $no = 1;
        $total_jasa = 0;
        for($a = 0; $a < sizeof($data); $a++) {
            if($data[$a]['jumlah_jasa'] != 0) {
                $sheet->setCellValue("A".$i, $no);
                $sheet->setCellValue("B".$i, $data[$a]['id_pinjaman']);
                $sheet->setCellValue("C".$i, $data[$a]['nama']);
                $sheet->setCellValue("D".$i, $data[$a]['nomor_koperasi']);
                $sheet->setCellValue("E".$i, $data[$a]['alamat']);
                $sheet->setCellValue("F".$i, $data[$a]['kelurahan']);
                $sheet->setCellValue("G".$i, $data[$a]['dusun']);
                $sheet->setCellValue("H".$i, $data[$a]['rw']);
                $sheet->setCellValue("I".$i, $data[$a]['rt']);
                $sheet->setCellValue("J".$i, $data[$a]['jumlah_jasa']);
                $total_jasa += $data[$a]['jumlah_jasa'];
                $sheet->getStyle("J".$i)->getNumberFormat()->setFormatCode('#,##0');
                $sheet->getStyle("A".$i.":I".$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                $i++;
                $no++;
            }
        }

        $sheet->mergeCells("A".$i.":I".$i)->setCellValue("A".$i, "TOTAL JASA");
        $sheet->setCellValue("J".$i, $total_jasa);
        $sheet->getStyle("J".$i)->getNumberFormat()->setFormatCode('#,##0');
        $sheet->getStyle("A".$i.":J".$i)->getFont()->setBold(true);
        $sheet->getStyle("A".$i.":I".$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        
        $border_end = $i;

        foreach(range('A','J') as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }

        $thin = array ();
        $thin['borders']=array();
        $thin['borders']['allborders']=array();
        $thin['borders']['allborders']['style']=PHPExcel_Style_Border::BORDER_THIN ;
        $sheet  ->getStyle ( "A".$border_start.":J".$border_end )->applyFromArray ($thin);

        $filename = "Laporan Rincian Jasa_".$tgl_dari1."_".$tgl_sampai1.".xlsx";

        header ( 'Content-Type: application/vnd.ms-excel' );
        header ( 'Content-Disposition: attachment;filename="'.$filename.'"' );
        header ( 'Cache-Control: max-age=0' );
        $writer = PHPExcel_IOFactory::createWriter ( $file, 'Excel2007' );
        $writer->save ( 'php://output' );
        return;
    }

}

?>