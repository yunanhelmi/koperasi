<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class LaporansimpanankanzunCon extends CI_Controller {
	function __construct() {
		parent::__construct();

		$this->load->model('usermodel');
		$this->load->model('nasabahmodel');
		$this->load->model('mappingkodeakunmodel');
		$this->load->model('kodeakunmodel');
		$this->load->model('transaksiakuntansimodel');
		$this->load->model('simpanankanzunmodel');
		$this->load->model('detailsimpanankanzunmodel');
		$this->load->model('laporansimpanankanzunmodel');

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
		$session_data = $this->session->userdata('mubasyirin_logged_in');
		if($session_data == NULL) {
			redirect("usercon/login", "refresh");
		}
		$data['username'] 	= $session_data['username'];
		$data['status'] 	= $session_data['status'];
		$data['nasabah'] 	= $this->nasabahmodel->showData();
		
		$this->load->view('/layouts/menu', $data);
		$this->load->view('/laporan/simpanankanzun', $data);
		$this->load->view('/layouts/footer', $data);	
	}

    function html() {
        $session_data = $this->session->userdata('mubasyirin_logged_in');
        if($session_data == NULL) {
            redirect("usercon/login", "refresh");
        }

        $tanggal1   = $this->input->post('tanggal');
        $tgl        = strtotime($tanggal1);
        $tanggal    = date("Y-m-d",$tgl);

        $simpanankanzun = $this->laporansimpanankanzunmodel->get_data($tanggal);

        // Total Simpanan Kanzun pada neraca
        if($tanggal < '2019-01-01') {
            $transaksi    = $this->transaksiakuntansimodel->get_jumlah_by_sampai_kode_akun($tanggal, '203');
        } else if($tanggal >= '2019-01-01') {
            $transaksi    = $this->transaksiakuntansimodel->get_jumlah_by_dari_sampai_kode_akun('2019-01-01', $tanggal, '203');
        }
        $total_neraca = $transaksi[0]['jumlah_kredit'] - $transaksi[0]['jumlah_debet'];

        $data['tanggal'] = $tanggal;
        $data['data'] = $simpanankanzun;
        $data['total_neraca'] = $total_neraca;

        $this->load->view('/hasil_laporan/simpanankanzun', $data);
    }

    // Yang dipake
	function excel() {
		$session_data = $this->session->userdata('mubasyirin_logged_in');
		if($session_data == NULL) {
			redirect("usercon/login", "refresh");
		}

		$tanggal1   = $this->input->post('tanggal');
        $tgl        = strtotime($tanggal1);
        $tanggal    = date("Y-m-d",$tgl);

		$data = $this->laporansimpanankanzunmodel->get_data($tanggal);

		// Total Simpanan Kanzun pada neraca
        if($tanggal < '2019-01-01') {
            $transaksi    = $this->transaksiakuntansimodel->get_jumlah_by_sampai_kode_akun($tanggal, '203');
        } else if($tanggal >= '2019-01-01') {
            $transaksi    = $this->transaksiakuntansimodel->get_jumlah_by_dari_sampai_kode_akun('2019-01-01', $tanggal, '203');
        }
        $total_neraca = $transaksi[0]['jumlah_kredit'] - $transaksi[0]['jumlah_debet'];

		$file = new PHPExcel ();
        $file->getProperties ()->setCreator ( "YHM" );
        $file->getProperties ()->setLastModifiedBy ( "System" );
        $file->getProperties ()->setTitle ( "Laporan Daftar Simpanan Kanzun" );
        $file->getProperties ()->setSubject ( "Laporan Daftar Simpanan Kanzun" );
        $file->getProperties ()->setDescription ( "Laporan Daftar Simpanan Kanzun" );
        $file->getProperties ()->setKeywords ( "Laporan Daftar Simpanan Kanzun" );
        $file->getProperties ()->setCategory ( "Laporan Daftar Simpanan Kanzun" );

        $sheet = $file->getActiveSheet ();
        $i = 2;

        $sheet->mergeCells("A".$i.":J".$i)->setCellValue("A".$i, "KOPPONTREN MAMBAUL MUBBASYIRIN SHIDDIQIYYAH");
        $sheet->getStyle("A".$i.":J".$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle("A".$i.":J".$i)->getFont()->setSize(14)->setBold(true);
        $i++;
        $sheet->mergeCells("A".$i.":J".$i)->setCellValue("A".$i, "LAPORAN DAFTAR SIMPANAN KANZUN ".$tanggal1);
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
        $sheet->setCellValue("C".$i, "NO NASABAH");
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
                $sheet->setCellValue("C".$i, $data[$a]['nomor_koperasi']);
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

        $border_end = $i;

        foreach(range('A','J') as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }

        $thin = array ();
        $thin['borders']=array();
        $thin['borders']['allborders']=array();
        $thin['borders']['allborders']['style']=PHPExcel_Style_Border::BORDER_THIN ;
        $sheet  ->getStyle ( "A".$border_start.":J".$border_end )->applyFromArray ($thin);

        $filename = "Laporan Daftar Simpanan Kanzun_".$tanggal1.".xlsx";

        header ( 'Content-Type: application/vnd.ms-excel' );
        header ( 'Content-Disposition: attachment;filename="'.$filename.'"' );
        header ( 'Cache-Control: max-age=0' );
        $writer = PHPExcel_IOFactory::createWriter ( $file, 'Excel2007' );
        $writer->save ( 'php://output' );
        return;
	}
}

?>
