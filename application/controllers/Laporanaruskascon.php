<?php 

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class LaporanaruskasCon extends CI_Controller {
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
		$session_data = $this->session->userdata('mubasyirin_logged_in');
		if($session_data == NULL) {
			redirect("usercon/login", "refresh");
		}
		$data['username'] 	= $session_data['username'];
		$data['status'] 	= $session_data['status'];
		$data['nasabah'] 	= $this->nasabahmodel->showData();
		
		$this->load->view('/layouts/menu', $data);
		$this->load->view('/laporan/aruskas', $data);
		$this->load->view('/layouts/footer', $data);
	}

    function html() {
        $session_data = $this->session->userdata('mubasyirin_logged_in');
        if($session_data == NULL) {
            redirect("usercon/login", "refresh");
        }

        $tgl_dari1  = $this->input->post('dari');
        $tgl_dari   = strtotime($tgl_dari1);
        $dari       = date("Y-m-d",$tgl_dari);

        $tgl_sampai1    = $this->input->post('sampai');
        $tgl_sampai     = strtotime($tgl_sampai1);
        $sampai         = date("Y-m-d",$tgl_sampai);

        if($dari < '2019-01-01' && $sampai < '2019-01-01') {
            $data_kas_prev = $this->transaksiakuntansimodel->get_jumlah_by_prev_sampai_kode_akun($sampai, '101');
            $data_kas = $this->transaksiakuntansimodel->showdata_by_dari_sampai_kode_akun($dari, $sampai, '101');
        } else if($dari >= '2019-01-01' && $sampai >= '2019-01-01') {
            $data_kas_prev = $this->transaksiakuntansimodel->get_jumlah_by_dari_prev_sampai_kode_akun('2019-01-01', $dari, '101');
            $data_kas = $this->transaksiakuntansimodel->showdata_by_dari_sampai_kode_akun($dari, $sampai, '101');
        }

        if($data_kas_prev != NULL) {
            $saldo_awal = $data_kas_prev[0]['jumlah_debet'] - $data_kas_prev[0]['jumlah_kredit'];   
        } else {
            $saldo_awal = 0;
        }

        $data['tgl_dari'] = $dari;
        $data['tgl_sampai'] = $sampai;
        $data['saldo_awal'] = $saldo_awal;
        $data['data_kas'] = $data_kas;

        $this->load->view('/hasil_laporan/aruskas', $data);
    }

    // Yang dipake
	function excel() {
		$session_data = $this->session->userdata('mubasyirin_logged_in');
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
			$data_kas_prev = $this->transaksiakuntansimodel->get_jumlah_by_prev_sampai_kode_akun($sampai, '101');
			$data_kas = $this->transaksiakuntansimodel->showdata_by_dari_sampai_kode_akun($dari, $sampai, '101');
		} else if($dari >= '2019-01-01' && $sampai >= '2019-01-01') {
			$data_kas_prev = $this->transaksiakuntansimodel->get_jumlah_by_dari_prev_sampai_kode_akun('2019-01-01', $dari, '101');
			$data_kas = $this->transaksiakuntansimodel->showdata_by_dari_sampai_kode_akun($dari, $sampai, '101');
		}

		if($data_kas_prev != NULL) {
			$saldo_awal = $data_kas_prev[0]['jumlah_debet'] - $data_kas_prev[0]['jumlah_kredit'];	
		} else {
			$saldo_awal = 0;
		}
		
		/*echo "<pre>";
		var_dump($data_kas_prev);
		echo "</pre>";*/

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

        $sheet->mergeCells("A".$i.":F".$i)->setCellValue("A".$i, "KOPPONTREN MAMBAUL MUBBASYIRIN SHIDDIQIYYAH");
        $sheet->getStyle("A".$i.":F".$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle("A".$i.":F".$i)->getFont()->setSize(14)->setBold(true);
        $i++;
        $sheet->mergeCells("A".$i.":F".$i)->setCellValue("A".$i, "LAPORAN ARUS KAS ".$tgl_dari1." - ".$tgl_sampai1);
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
        $sheet->setCellValue("B".$i, "TANGGAL");
        $sheet->setCellValue("C".$i, "KETERANGAN");
        $sheet->setCellValue("D".$i, "DEBET");
        $sheet->setCellValue("E".$i, "KREDIT");
        $sheet->setCellValue("F".$i, "SALDO");
        $sheet->getStyle("A".$i.":F".$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle("A".$i.":F".$i)->getFont()->setBold(true);
        $i++;

        $no = 1;
        $sheet->setCellValue("A".$i, $no);
        $sheet->setCellValue("B".$i, $tgl_dari1);
        $sheet->setCellValue("C".$i, "SALDO AWAL");
        $sheet->setCellValue("F".$i, $saldo_awal);
        $saldo = $saldo_awal;
        $sheet->getStyle("F".$i)->getNumberFormat()->setFormatCode('#,##0');
        $no++;
        $i++;

        $total_debet = 0;
        $total_kredit = 0;
        for($a = 0; $a < sizeof($data_kas); $a++) {
        	$sheet->setCellValue("A".$i, $no);
        	$tgl 		= strtotime($data_kas[$a]['tanggal']);
			$tanggal 	= date("d-m-Y",$tgl);
        	$sheet->setCellValue("B".$i, $tanggal);
        	$sheet->setCellValue("C".$i, $data_kas[$a]['keterangan']);
        	$sheet->setCellValue("D".$i, $data_kas[$a]['debet']);
        	$total_debet += $data_kas[$a]['debet'];
        	$sheet->getStyle("D".$i)->getNumberFormat()->setFormatCode('#,##0');
        	$sheet->setCellValue("E".$i, $data_kas[$a]['kredit']);
        	$total_kredit += $data_kas[$a]['kredit'];
        	$sheet->getStyle("E".$i)->getNumberFormat()->setFormatCode('#,##0');
            $saldo += ($data_kas[$a]['debet'] - $data_kas[$a]['kredit']);
            $sheet->setCellValue("F".$i, $saldo);
            $sheet->getStyle("F".$i)->getNumberFormat()->setFormatCode('#,##0');
        	$no++;
        	$i++;
        }
        /*$sheet->mergeCells("A".$i.":C".$i)->setCellValue("A".$i, "TOTAL");
        $sheet->setCellValue("D".$i, $total_debet);
        $sheet->getStyle("D".$i)->getNumberFormat()->setFormatCode('#,##0');
		$sheet->setCellValue("E".$i, $total_kredit);
		$sheet->getStyle("E".$i)->getNumberFormat()->setFormatCode('#,##0');
		$sheet->getStyle("A".$i.":E".$i)->getFont()->setBold(true);
		$total = $total_debet - $total_kredit;
		$i++;*/
        $sheet->setCellValue("A".$i, $no);
        $sheet->setCellValue("B".$i, $tgl_sampai1);
        $sheet->setCellValue("C".$i, "SALDO AKHIR");
        $sheet->setCellValue("F".$i, $saldo);
        $sheet->getStyle("F".$i)->getNumberFormat()->setFormatCode('#,##0');
        $sheet->getStyle("A".$i.":F".$i)->getFont()->setBold(true);

        $border_end = $i;

        foreach(range('A','F') as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }

        $thin = array ();
        $thin['borders']=array();
        $thin['borders']['allborders']=array();
        $thin['borders']['allborders']['style']=PHPExcel_Style_Border::BORDER_THIN ;
        $sheet  ->getStyle ( "A".$border_start.":F".$border_end )->applyFromArray ($thin);

        $filename = "Laporan Arus Kas_".$tgl_dari1."_".$tgl_sampai1.".xlsx";

        header ( 'Content-Type: application/vnd.ms-excel' );
        header ( 'Content-Disposition: attachment;filename="'.$filename.'"' );
        header ( 'Cache-Control: max-age=0' );
        $writer = PHPExcel_IOFactory::createWriter ( $file, 'Excel2007' );
        $writer->save ( 'php://output' );
        return;

	}
}

?>
