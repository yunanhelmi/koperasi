<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class LaporanRincianPiutangCon extends CI_Controller {
	function __construct() {
		parent::__construct();

		$this->load->model('usermodel');
		$this->load->model('nasabahmodel');
		$this->load->model('mappingkodeakunmodel');
		$this->load->model('kodeakunmodel');
		$this->load->model('transaksiakuntansimodel');
		$this->load->model('pinjamanmodel');
		$this->load->model('detailangsuranmodel');
		$this->load->model('laporanrincianpiutangmodel');

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
		$this->load->view('/laporan/rincian_piutang', $data);
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

		$data_angsuran = $this->laporanrincianpiutangmodel->get_data_angsuran($dari, $sampai);
		$data_pinjaman = $this->laporanrincianpiutangmodel->get_data_pinjaman($dari, $sampai);	

		$file = new PHPExcel ();
        $file->getProperties ()->setCreator ( "YHM" );
        $file->getProperties ()->setLastModifiedBy ( "System" );
        $file->getProperties ()->setTitle ( "Laporan Rincian Piutang" );
        $file->getProperties ()->setSubject ( "Laporan Rincian Piutang" );
        $file->getProperties ()->setDescription ( "Laporan Rincian Piutang" );
        $file->getProperties ()->setKeywords ( "Laporan Rincian Piutang" );
        $file->getProperties ()->setCategory ( "Laporan Rincian Piutang" );

        $sheet = $file->getActiveSheet ();
        $i = 2;

        $sheet->mergeCells("A".$i.":M".$i)->setCellValue("A".$i, "KOPPONTREN MAMBAUL MUBBASYIRIN SHIDDIQIYYAH");
        $sheet->getStyle("A".$i.":M".$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle("A".$i.":M".$i)->getFont()->setSize(14)->setBold(true);
        $i++;
        $sheet->mergeCells("A".$i.":M".$i)->setCellValue("A".$i, "LAPORAN RINCIAN PIUTANG ".$tgl_dari1." - ".$tgl_sampai1);
        $sheet->getStyle("A".$i.":M".$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle("A".$i.":M".$i)->getFont()->setSize(12)->setBold(true);
        $i++;
        $sheet->mergeCells("A".$i.":M".$i)->setCellValue("A".$i, "KANTOR PONPES MAJMA'AL BAHRAIN SHIDDIQIYYAH");
        $sheet->getStyle("A".$i.":M".$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle("A".$i.":M".$i)->getFont()->setSize(10)->setBold(true);
        $i++;
        $sheet->mergeCells("A".$i.":M".$i)->setCellValue("A".$i, "NGRASEH DANDER BOJONEGORO  TELP (0353) 886039       BH : 8181/BH/II/95");
        $sheet->getStyle("A".$i.":M".$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle("A".$i.":M".$i)->getFont()->setSize(10)->setBold(true);
        $i += 2;

        $border_start = $i;
        $sheet->setCellValue("A".$i, "NO");
        $sheet->setCellValue("B".$i, "NAMA");
        $sheet->setCellValue("C".$i, "NIK");
        $sheet->setCellValue("D".$i, "NOMOR NASABAH");
        $sheet->setCellValue("E".$i, "JENIS");
        $sheet->setCellValue("F".$i, "JUMLAH");
        $sheet->setCellValue("H".$i, "NO");
        $sheet->setCellValue("I".$i, "NAMA");
        $sheet->setCellValue("J".$i, "NIK");
        $sheet->setCellValue("K".$i, "NOMOR NASABAH");
        $sheet->setCellValue("L".$i, "JENIS");
        $sheet->setCellValue("M".$i, "JUMLAH");
        $sheet->getStyle("A".$i.":M".$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle("A".$i.":M".$i)->getFont()->setBold(true);
        $i++;
        
        $total_pinjaman = 0;
        $total_angsuran = 0;

        // Untuk Data Pinjaman
        $index_kiri = $i;
        $no = 1;
        for($a = 0; $a < sizeof($data_pinjaman); $a++) {
        	$sheet->setCellValue("A".$index_kiri, $no);
        	$sheet->setCellValue("B".$index_kiri, $data_pinjaman[$a]['nama_nasabah']);
        	$sheet->setCellValue("C".$index_kiri, "'".$data_pinjaman[$a]['nik_nasabah']);
        	$sheet->setCellValue("D".$index_kiri, $data_pinjaman[$a]['nomor_nasabah']);
        	$sheet->setCellValue("E".$index_kiri, "Pinjaman");
        	$sheet->setCellValue("F".$index_kiri, $data_pinjaman[$a]['jumlah_total']);

        	$sheet->getStyle("A".$index_kiri.":E".$index_kiri)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        	$sheet->getStyle("F".$index_kiri)->getNumberFormat()->setFormatCode('#,##0');

        	$index_kiri++;
        	$no++;
        	$total_pinjaman += $data_pinjaman[$a]['jumlah_total'];
        }
        $sheet->mergeCells("A".$index_kiri.":E".$index_kiri)->setCellValue("A".$index_kiri, "TOTAL PINJAMAN");
        $sheet->setCellValue("F".$index_kiri, $total_pinjaman);
        $sheet->getStyle("A".$index_kiri.":E".$index_kiri)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle("F".$index_kiri)->getNumberFormat()->setFormatCode('#,##0');
        $sheet->getStyle("A".$index_kiri.":F".$index_kiri)->getFont()->setBold(true);

        // Untuk Data Angsuran
        $index_kanan = $i;
        $no = 1;
        for($a = 0; $a < sizeof($data_angsuran); $a++) {
        	$sheet->setCellValue("H".$index_kanan, $no);
        	$sheet->setCellValue("I".$index_kanan, $data_angsuran[$a]['nama_nasabah']);
        	$sheet->setCellValue("J".$index_kanan, "'".$data_angsuran[$a]['nik_nasabah']);
        	$sheet->setCellValue("K".$index_kanan, $data_angsuran[$a]['nomor_nasabah']);
        	$sheet->setCellValue("L".$index_kanan, "Angsuran");
        	$sheet->setCellValue("M".$index_kanan, $data_angsuran[$a]['jumlah_angsuran']);

        	$sheet->getStyle("H".$index_kanan.":L".$index_kanan)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        	$sheet->getStyle("M".$index_kanan)->getNumberFormat()->setFormatCode('#,##0');

        	$index_kanan++;
        	$no++;
        	$total_angsuran += $data_angsuran[$a]['jumlah_angsuran'];
        }
        $sheet->mergeCells("H".$index_kanan.":L".$index_kanan)->setCellValue("H".$index_kanan, "TOTAL ANGSURAN");
        $sheet->setCellValue("M".$index_kanan, $total_angsuran);
        $sheet->getStyle("H".$index_kanan.":L".$index_kanan)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle("M".$index_kanan)->getNumberFormat()->setFormatCode('#,##0');
        $sheet->getStyle("H".$index_kanan.":M".$index_kanan)->getFont()->setBold(true);

        if($index_kiri > $index_kanan) {
        	$index_footer = $index_kiri + 2;
        	$border_end     = $index_kiri;
        } else {
        	$index_footer = $index_kanan + 2;
        	$border_end     = $index_kanan;
        }

        $selisih_total = $total_pinjaman - $total_angsuran;
        $sheet->mergeCells("A".$index_footer.":E".$index_footer)->setCellValue("A".$index_footer, "SELISIH (TOTAL PINJAMAN - TOTAL ANGSURAN)");
        $sheet->setCellValue("F".$index_footer, $selisih_total);
        $sheet->getStyle("A".$index_footer.":E".$index_footer)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle("F".$index_footer)->getNumberFormat()->setFormatCode('#,##0');
        $sheet->getStyle("A".$index_footer.":F".$index_footer)->getFont()->setBold(true);

        foreach(range('A','M') as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }

        $thin = array ();
        $thin['borders']=array();
        $thin['borders']['allborders']=array();
        $thin['borders']['allborders']['style']=PHPExcel_Style_Border::BORDER_THIN ;
        $sheet  ->getStyle ( "A".$border_start.":M".$border_end )->applyFromArray ($thin);

        $filename = "Laporan Rincian Piutang_".$tgl_dari1."_".$tgl_sampai1.".xlsx";

        header ( 'Content-Type: application/vnd.ms-excel' );
        header ( 'Content-Disposition: attachment;filename="'.$filename.'"' );
        header ( 'Cache-Control: max-age=0' );
        $writer = PHPExcel_IOFactory::createWriter ( $file, 'Excel2007' );
        $writer->save ( 'php://output' );
        return;
	}
}

?>