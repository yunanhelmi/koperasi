<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class LaporanSimpananDanaSosialCon extends CI_Controller {
	function __construct() {
		parent::__construct();

		$this->load->model('usermodel');
		$this->load->model('nasabahmodel');
		$this->load->model('mappingkodeakunmodel');
		$this->load->model('kodeakunmodel');
		$this->load->model('transaksiakuntansimodel');
		$this->load->model('simpanandanasosialmodel');
		$this->load->model('detailsimpanandanasosialmodel');
		$this->load->model('laporansimpanandanasosialmodel');

		$this->load->library('session');
		$this->load->library('form_validation');
		$this->load->library('upload');
		$this->load->library('image_lib');
		$this->load->library(array('PHPExcel','PHPExcel/IOFactory'));
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
		$this->load->view('/laporan/simpanandanasosial', $data);
		$this->load->view('/layouts/footer', $data);	
	}

	function excel() {
		$session_data = $this->session->userdata('logged_in');
		if($session_data == NULL) {
			redirect("usercon/login", "refresh");
		}

		$tanggal1   = $this->input->post('tanggal');
        $tgl        = strtotime($tanggal1);
        $tanggal    = date("Y-m-d",$tgl);

		$data = $this->laporansimpanandanasosialmodel->get_data($tanggal);

		/*echo "<pre>";
		var_dump($data);
		echo "</pre>";*/

		$file = new PHPExcel ();
        $file->getProperties ()->setCreator ( "YHM" );
        $file->getProperties ()->setLastModifiedBy ( "System" );
        $file->getProperties ()->setTitle ( "Laporan Daftar Simpanan Dana Sosial Anggota" );
        $file->getProperties ()->setSubject ( "Laporan Daftar Simpanan Dana Sosial Anggota" );
        $file->getProperties ()->setDescription ( "Laporan Daftar Simpanan Dana Sosial Anggota" );
        $file->getProperties ()->setKeywords ( "Laporan Daftar Simpanan Dana Sosial Anggota" );
        $file->getProperties ()->setCategory ( "Laporan Daftar Simpanan Dana Sosial Anggota" );

        $sheet = $file->getActiveSheet ();
        $i = 2;

        $sheet->mergeCells("A".$i.":H".$i)->setCellValue("A".$i, "KOPPONTREN MAMBAUL MUBBASYIRIN SHIDDIQIYYAH");
        $sheet->getStyle("A".$i.":H".$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle("A".$i.":H".$i)->getFont()->setSize(14)->setBold(true);
        $i++;
        $sheet->mergeCells("A".$i.":H".$i)->setCellValue("A".$i, "LAPORAN DAFTAR SIMPANAN DANSOS ANGGOTA ".$tanggal1);
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
	        	$sheet->getStyle("A".$i.":G".$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	        	$sheet->setCellValue("H".$i, $simpanan);
	        	$total += $simpanan;
	        	$sheet->getStyle("H".$i)->getNumberFormat()->setFormatCode('#,##0');
	        	$no++;
        		$i++;	
        	}
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

        $filename = "Laporan Daftar Simpanan Dansos Anggota_".$tanggal1.".xlsx";

        header ( 'Content-Type: application/vnd.ms-excel' );
        header ( 'Content-Disposition: attachment;filename="'.$filename.'"' );
        header ( 'Cache-Control: max-age=0' );
        $writer = PHPExcel_IOFactory::createWriter ( $file, 'Excel2007' );
        $writer->save ( 'php://output' );
        return;
	}
}

?>