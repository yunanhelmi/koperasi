<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class LaporanPiutangCon extends CI_Controller {
	function __construct() {
		parent::__construct();

		$this->load->model('usermodel');
		$this->load->model('nasabahmodel');
		$this->load->model('mappingkodeakunmodel');
		$this->load->model('kodeakunmodel');
		$this->load->model('transaksiakuntansimodel');
		$this->load->model('pinjamanmodel');
		$this->load->model('detailangsuranmodel');
		$this->load->model('laporanpiutangmodel');

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

	function index() {
		$session_data = $this->session->userdata('logged_in');
		if($session_data == NULL) {
			redirect("usercon/login", "refresh");
		}
		$data['username'] 	= $session_data['username'];
		$data['status'] 	= $session_data['status'];
		$data['nasabah'] 	= $this->nasabahmodel->showData();
		
		$this->load->view('/layouts/menu', $data);
		$this->load->view('/laporan/piutang', $data);
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

		$tgl_dari1 	= $this->input->post('dari');
		$tgl_dari 	= strtotime($tgl_dari1);
		$dari 		= date("Y-m-d",$tgl_dari);

		$tgl_sampai1	= $this->input->post('sampai');
		$tgl_sampai 	= strtotime($tgl_sampai1);
		$sampai 		= date("Y-m-d",$tgl_sampai);

		$data_piutang = $this->laporanpiutangmodel->get_data_piutang($dari, $sampai);

		/*echo "<pre>";
		var_dump($data_piutang);
		echo "</pre>";*/

		$file = new PHPExcel ();
        $file->getProperties ()->setCreator ( "YHM" );
        $file->getProperties ()->setLastModifiedBy ( "System" );
        $file->getProperties ()->setTitle ( "Laporan Keuangan" );
        $file->getProperties ()->setSubject ( "Laporan Keuangan" );
        $file->getProperties ()->setDescription ( "Laporan Keuangan" );
        $file->getProperties ()->setKeywords ( "Laporan Keuangan" );
        $file->getProperties ()->setCategory ( "Laporan Keuangan" );

        $sheet = $file->getActiveSheet ();
        $i = 2;

        $sheet->mergeCells("A".$i.":L".$i)->setCellValue("A".$i, "KOPPONTREN MAMBAUL MUBBASYIRIN SHIDDIQIYYAH");
        $sheet->getStyle("A".$i.":L".$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle("A".$i.":L".$i)->getFont()->setSize(14)->setBold(true);
        $i++;
        $sheet->mergeCells("A".$i.":L".$i)->setCellValue("A".$i, "LAPORAN PIUTANG ".$tgl_dari1." - ".$tgl_sampai1);
        $sheet->getStyle("A".$i.":L".$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle("A".$i.":L".$i)->getFont()->setSize(12)->setBold(true);
        $i++;
        $sheet->mergeCells("A".$i.":L".$i)->setCellValue("A".$i, "KANTOR PONPES MAJMA'AL BAHRAIN SHIDDIQIYYAH");
        $sheet->getStyle("A".$i.":L".$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle("A".$i.":L".$i)->getFont()->setSize(10)->setBold(true);
        $i++;
        $sheet->mergeCells("A".$i.":L".$i)->setCellValue("A".$i, "NGRASEH DANDER BOJONEGORO  TELP (0353) 886039       BH : 8181/BH/II/95");
        $sheet->getStyle("A".$i.":L".$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle("A".$i.":L".$i)->getFont()->setSize(10)->setBold(true);
        $i += 2;

        $border_start = $i;
        $sheet->setCellValue("A".$i, "NO");
        $sheet->setCellValue("B".$i, "NAMA");
        $sheet->setCellValue("C".$i, "ALAMAT");
        $sheet->setCellValue("D".$i, "DESA");
        $sheet->setCellValue("E".$i, "DUSUN");
        $sheet->setCellValue("F".$i, "RW");
        $sheet->setCellValue("G".$i, "RT");
        $sheet->setCellValue("H".$i, "JAMINAN");
        $sheet->setCellValue("I".$i, "TGL PINJAM");
        $sheet->setCellValue("J".$i, "SLD X");
        $sheet->setCellValue("K".$i, "SISA PINJAMAN");
        $sheet->setCellValue("L".$i, "KETERANGAN");
        $sheet->getStyle("A".$i.":L".$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle("A".$i.":L".$i)->getFont()->setBold(true);
        $i++;

        $no = 1;
        $total_sisa = 0;
        for($a = 0; $a < sizeof($data_piutang); $a++) {
        	$sheet->setCellValue("A".$i, $no);
        	$sheet->setCellValue("B".$i, $data_piutang[$a]['nama']);
        	$sheet->setCellValue("C".$i, $data_piutang[$a]['alamat']);
        	$sheet->setCellValue("D".$i, $data_piutang[$a]['kelurahan']);
        	$sheet->setCellValue("E".$i, $data_piutang[$a]['dusun']);
        	$sheet->setCellValue("F".$i, $data_piutang[$a]['rw']);
        	$sheet->setCellValue("G".$i, $data_piutang[$a]['rt']);
        	$sheet->setCellValue("H".$i, $data_piutang[$a]['jaminan']);
        	$waktu = $this->tanggal_indo($data_piutang[$a]['waktu']);
        	$sheet->setCellValue("I".$i, $waktu);
        	$sisa_kali_angsuran = $data_piutang[$a]['jumlah_angsuran'] - $data_piutang[$a]['total_angsuran'];
            if($data_piutang[$a]['jenis_pinjaman'] == 'Angsuran') {
                $sheet->setCellValue("J".$i, $sisa_kali_angsuran);    
            } else if($data_piutang[$a]['jenis_pinjaman'] == 'Musiman') {
                $sheet->setCellValue("J".$i, "1");    
            }
        	$sheet->getStyle("A".$i.":J".$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        	$sheet->setCellValue("K".$i, $data_piutang[$a]['sisa_angsuran']);
        	$sheet->getStyle("K".$i)->getNumberFormat()->setFormatCode('#,##0');
        	$total_sisa += $data_piutang[$a]['sisa_angsuran'];
            if($data_piutang[$a]['jenis_pinjaman'] == 'Angsuran') {
                // GET Today and Jatuh Tempo
                if($data_piutang[$a]['jatuh_tempo'] == "0000-00-00" || $data_piutang[$a]['jatuh_tempo'] == NULL) {
                    $today = new DateTime(date("Y-m-d"));
                    $jatuh_tempo = new DateTime($this->addMonths($data_piutang[$a]['waktu'], $data_piutang[$a]['total_angsuran'] + 1));
                    
                } else {
                    $today = new DateTime(date("Y-m-d"));
                    $jatuh_tempo = new DateTime($data_piutang[$a]['jatuh_tempo']);
                }
                // GET Diff Today and Jatuh Tempo
                if($today < $jatuh_tempo) {
                    $sheet->setCellValue("L".$i, "Hijau");
                    $sheet->getStyle('L'.$i)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('008000');
                } else {
                    $diff = $today->diff($jatuh_tempo);
                    $interval = $diff->format('%m');
                    if($interval < 3) {
                        $sheet->setCellValue("L".$i, "Hijau");
                        $sheet->getStyle('L'.$i)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('008000');
                    } else if ($interval >= 3 && $interval < 6) {
                        $sheet->setCellValue("L".$i, "Kuning");
                        $sheet->getStyle('L'.$i)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('FFFF00');
                    } else if ($interval >= 6 && $interval < 9) {
                        $sheet->setCellValue("L".$i, "Merah 1");
                        $sheet->getStyle('L'.$i)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('FFC0CB');
                    } else if ($interval >= 9) {
                        $sheet->setCellValue("L".$i, "Merah 2");
                        $sheet->getStyle('L'.$i)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('FF0000');
                    }
                }
            } else if($data_piutang[$a]['jenis_pinjaman'] == 'Musiman') {
                // GET Today and Jatuh Tempo
                if($data_piutang[$a]['jatuh_tempo'] == "0000-00-00" || $data_piutang[$a]['jatuh_tempo'] == NULL) {
                    $today = new DateTime(date("Y-m-d"));
                    $jatuh_tempo = new DateTime($this->addMonths($data_piutang[$a]['waktu'], 4));
                    
                } else {
                    $today = new DateTime(date("Y-m-d"));
                    $jatuh_tempo = new DateTime($data_piutang[$a]['jatuh_tempo']);
                }
                // GET Diff Today and Jatuh Tempo
                if($today < $jatuh_tempo) {
                    $sheet->setCellValue("L".$i, "Hijau");
                    $sheet->getStyle('L'.$i)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('008000');
                } else {
                    $diff = $today->diff($jatuh_tempo);
                    $interval = $diff->format('%m');
                    if($interval < 3) {
                        $sheet->setCellValue("L".$i, "Hijau");
                        $sheet->getStyle('L'.$i)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('008000');
                    } else if ($interval >= 3 && $interval < 6) {
                        $sheet->setCellValue("L".$i, "Kuning");
                        $sheet->getStyle('L'.$i)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('FFFF00');
                    } else if ($interval >= 6 && $interval < 9) {
                        $sheet->setCellValue("L".$i, "Merah 1");
                        $sheet->getStyle('L'.$i)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('FFC0CB');
                    } else if ($interval >= 9) {
                        $sheet->setCellValue("L".$i, "Merah 2");
                        $sheet->getStyle('L'.$i)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('FF0000');
                    }
                }
            }
        	//$sheet->setCellValue("L".$i, "");
            $sheet->getStyle("L".$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        	$no++;
        	$i++;
        }
        $sheet->mergeCells("A".$i.":J".$i)->setCellValue("A".$i, "TOTAL PIUTANG");
        $sheet->setCellValue("K".$i, $total_sisa);
        $sheet->getStyle("K".$i)->getNumberFormat()->setFormatCode('#,##0');
        $sheet->getStyle("A".$i.":L".$i)->getFont()->setBold(true);
        $sheet->getStyle("A".$i.":J".$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        $border_end = $i;

        foreach(range('A','L') as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }

        $thin = array ();
        $thin['borders']=array();
        $thin['borders']['allborders']=array();
        $thin['borders']['allborders']['style']=PHPExcel_Style_Border::BORDER_THIN ;
        $sheet  ->getStyle ( "A".$border_start.":L".$border_end )->applyFromArray ($thin);

        $filename = "Laporan Piutang_".$tgl_dari1."_".$tgl_sampai1.".xlsx";

        header ( 'Content-Type: application/vnd.ms-excel' );
        header ( 'Content-Disposition: attachment;filename="'.$filename.'"' );
        header ( 'Cache-Control: max-age=0' );
        $writer = PHPExcel_IOFactory::createWriter ( $file, 'Excel2007' );
        $writer->save ( 'php://output' );
        return;
	}
}

?>