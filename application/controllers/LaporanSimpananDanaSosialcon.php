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

		$data = $this->laporansimpanandanasosialmodel->get_data_dansos($tanggal);

		// Total Simpanan Dana Sosial pada neraca
        if($tanggal < '2019-01-01') {
            $transaksi    = $this->transaksiakuntansimodel->get_jumlah_by_sampai_kode_akun($tanggal, '206');
        } else if($tanggal >= '2019-01-01') {
            $transaksi    = $this->transaksiakuntansimodel->get_jumlah_by_dari_sampai_kode_akun('2019-01-01', $tanggal, '206');
        }
        $total_neraca = $transaksi[0]['jumlah_kredit'] - $transaksi[0]['jumlah_debet'];

        $simp3th19 = $this->laporansimpanandanasosialmodel->get_simpanan_3th_19($tanggal);
        if($simp3th19 == NULL) {
            $jumlah_simp3th19 = 0;
        } else {
            $jumlah_simp3th19 = $simp3th19[0]['total_setoran_detail'] - $simp3th19[0]['total_tarikan_detail'];
        }

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

        $sheet->mergeCells("A".$i.":J".$i)->setCellValue("A".$i, "KOPPONTREN MAMBAUL MUBBASYIRIN SHIDDIQIYYAH");
        $sheet->getStyle("A".$i.":J".$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle("A".$i.":J".$i)->getFont()->setSize(14)->setBold(true);
        $i++;
        $sheet->mergeCells("A".$i.":J".$i)->setCellValue("A".$i, "LAPORAN DAFTAR SIMPANAN DANSOS ANGGOTA ".$tanggal1);
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
        $sheet->setCellValue("B".$i, "NAMA");
        $sheet->setCellValue("C".$i, "NOMOR NASABAH");
        $sheet->setCellValue("D".$i, "ALAMAT");
        $sheet->setCellValue("E".$i, "DESA");
        $sheet->setCellValue("F".$i, "DUSUN");
        $sheet->setCellValue("G".$i, "RW");
        $sheet->setCellValue("H".$i, "RT");
        $sheet->setCellValue("I".$i, "TANGGAL");
        $sheet->setCellValue("J".$i, "JUMLAH SIMPANAN");
        $sheet->getStyle("A".$i.":J".$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle("A".$i.":J".$i)->getFont()->setBold(true);
        $i++;

        $no 	= 1;
        $total 	= 0;

        for($a = 0; $a < sizeof($data); $a++) {
        	$simpanan = $data[$a]['total_setoran_detail'] - $data[$a]['total_tarikan_detail'];
        	if($simpanan != 0) {
        		$sheet->setCellValue("A".$i, $no);
	        	$sheet->setCellValue("B".$i, $data[$a]['nama']);
                $sheet->setCellValue("C".$i, $data[$a]['nomor_nasabah']);
	        	$sheet->setCellValue("D".$i, $data[$a]['alamat']);
	        	$sheet->setCellValue("E".$i, $data[$a]['kelurahan']);
	        	$sheet->setCellValue("F".$i, $data[$a]['dusun']);
	        	$sheet->setCellValue("G".$i, $data[$a]['rw']);
	        	$sheet->setCellValue("H".$i, $data[$a]['rt']);
	        	$waktu = $this->tanggal_indo($data[$a]['waktu']);
	        	$sheet->setCellValue("I".$i, $waktu);
	        	$sheet->getStyle("A".$i.":I".$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	        	$sheet->setCellValue("J".$i, $simpanan);
	        	$total += $simpanan;
	        	$sheet->getStyle("J".$i)->getNumberFormat()->setFormatCode('#,##0');
	        	$no++;
        		$i++;	
        	}
        }

        $sheet->mergeCells("A".$i.":I".$i)->setCellValue("A".$i, "TOTAL");
        $sheet->setCellValue("J".$i, $total);
        $sheet->getStyle("J".$i)->getNumberFormat()->setFormatCode('#,##0');
        $sheet->getStyle("A".$i.":J".$i)->getFont()->setBold(true);
        $sheet->getStyle("A".$i.":I".$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $i++;
        $sheet->mergeCells("A".$i.":I".$i)->setCellValue("A".$i, "TOTAL (NERACA)");
        $sheet->setCellValue("J".$i, $total_neraca);
        $sheet->getStyle("J".$i)->getNumberFormat()->setFormatCode('#,##0');
        $sheet->getStyle("A".$i.":J".$i)->getFont()->setBold(true);
        $sheet->getStyle("A".$i.":I".$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $i++;
        $sheet->mergeCells("A".$i.":I".$i)->setCellValue("A".$i, "SELISIH");
        $sheet->setCellValue("J".$i, $total - $total_neraca);
        $sheet->getStyle("J".$i)->getNumberFormat()->setFormatCode('#,##0');
        $sheet->getStyle("A".$i.":J".$i)->getFont()->setBold(true);
        $sheet->getStyle("A".$i.":I".$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $i++;
        $sheet->mergeCells("A".$i.":I".$i)->setCellValue("A".$i, "PENCAIRAN");
        $sheet->setCellValue("J".$i, $jumlah_simp3th19);
        $sheet->getStyle("J".$i)->getNumberFormat()->setFormatCode('#,##0');
        $sheet->getStyle("A".$i.":J".$i)->getFont()->setBold(true);
        $sheet->getStyle("A".$i.":I".$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $i++;
        $sheet->mergeCells("A".$i.":I".$i)->setCellValue("A".$i, "SELISIH");
        $sheet->setCellValue("J".$i, ($total - $total_neraca) - $jumlah_simp3th19);
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