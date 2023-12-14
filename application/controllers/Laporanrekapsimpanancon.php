<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class LaporanrekapsimpananCon extends CI_Controller {
	function __construct() {
		parent::__construct();

		$this->load->model('usermodel');
		$this->load->model('nasabahmodel');
		$this->load->model('simpanan3thmastermodel');
		$this->load->model('transaksiakuntansimodel');
		$this->load->model('laporanrekapsimpananmodel');
		$this->load->model('simpanan3thmodel');

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
		$this->load->view('/laporan/rekapsimpanan', $data);
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

	function html() {
        $session_data = $this->session->userdata('mubasyirin_logged_in');
        if($session_data == NULL) {
            redirect("usercon/login", "refresh");
        }

        $tanggal1   = $this->input->post('tanggal');
        $tgl        = strtotime($tanggal1);
        $tanggal    = date("Y-m-d",$tgl);

        $result = $this->laporanrekapsimpananmodel->get_data($tanggal);

        $total_neraca = array();
        if($tanggal < '2019-01-01') {
            $simpananpokok_biasa    = $this->transaksiakuntansimodel->get_jumlah_by_sampai_kode_akun($tanggal, '301');
            $simpananpokok_istimewa    = $this->transaksiakuntansimodel->get_jumlah_by_sampai_kode_akun($tanggal, '311');
            $simpananwajib    = $this->transaksiakuntansimodel->get_jumlah_by_sampai_kode_akun($tanggal, '302');
            $simpanankhusus    = $this->transaksiakuntansimodel->get_jumlah_by_sampai_kode_akun($tanggal, '303');
        } else if($tanggal >= '2019-01-01') {
            $simpananpokok_biasa    = $this->transaksiakuntansimodel->get_jumlah_by_dari_sampai_kode_akun('2019-01-01', $tanggal, '301');
            $simpananpokok_istimewa    = $this->transaksiakuntansimodel->get_jumlah_by_dari_sampai_kode_akun('2019-01-01', $tanggal, '311');
            $simpananwajib    = $this->transaksiakuntansimodel->get_jumlah_by_dari_sampai_kode_akun('2019-01-01', $tanggal, '302');
            $simpanankhusus    = $this->transaksiakuntansimodel->get_jumlah_by_dari_sampai_kode_akun('2019-01-01', $tanggal, '303');
        }
        
        $rincian_jasa = $this->transaksiakuntansimodel->get_jumlah_by_sampai_kode_akun($tanggal, '401');

        $simpanan3th_master = $this->simpanan3thmastermodel->showData();
        $simpanan3th_nasabah = array();
        $simpanan3th = array();
        for($i=0; $i<sizeof($simpanan3th_master); $i++) {
        	$simpanan3th_nasabah[$i]['nama_simpanan3th'] = $simpanan3th_master[$i]['nama'];
        	$simpanan3th_nasabah[$i]['data'] = $this->simpanan3thmodel->laporan_rekap_simpanan($tanggal, $simpanan3th_master[$i]['id']);
        	$simpanan3th[$i]['total_neraca'] = 0;
        	if($tanggal < '2019-01-01') {
	            $transaksi    = $this->transaksiakuntansimodel->get_jumlah_by_sampai_kode_akun($tanggal, $simpanan3th_master[$i]['kode_debet_pencairan_simp']);
	        } else if($tanggal >= '2019-01-01') {
	            $transaksi    = $this->transaksiakuntansimodel->get_jumlah_by_dari_sampai_kode_akun('2019-01-01', $tanggal, $simpanan3th_master[$i]['kode_debet_pencairan_simp']);
	        }
	        if($transaksi != NULL) {
	            $simpanan3th[$i]['nama'] = $simpanan3th_master[$i]['nama'];
	            $simpanan3th[$i]['total_neraca'] += $transaksi[0]['jumlah_kredit'] - $transaksi[0]['jumlah_debet'];
	        }
        }

        $total_neraca['simpanan_pokok'] = ($simpananpokok_biasa[0]['jumlah_kredit'] - $simpananpokok_biasa[0]['jumlah_debet']) + ($simpananpokok_istimewa[0]['jumlah_kredit'] - $simpananpokok_istimewa[0]['jumlah_debet']);
        $total_neraca['simpanan_wajib'] = $simpananwajib[0]['jumlah_kredit'] - $simpananwajib[0]['jumlah_debet'];
        $total_neraca['simpanan_khusus'] = $simpanankhusus[0]['jumlah_kredit'] - $simpanankhusus[0]['jumlah_debet'];
        $total_neraca['rincian_jasa'] = $rincian_jasa[0]['jumlah_kredit'] - $rincian_jasa[0]['jumlah_debet'];
        $total_neraca['pencairan_jasa'] = $rincian_jasa[0]['jumlah_debet'];
        //$total_neraca['simpanan3th'] = $simpanan3th;

        /*echo "<pre>";
        var_dump($simpanan3th);
        echo "</pre>";
        echo "<pre>";
        var_dump($simpanan3th_nasabah);
        echo "</pre>";*/

        $data['tanggal'] = $tanggal;
        $data['data'] = $result;
        $data['total_neraca'] = $total_neraca;
        $data['simpanan3th'] = $simpanan3th;
        $data['simpanan3th_nasabah'] = $simpanan3th_nasabah;

        $this->load->view('/hasil_laporan/rekapsimpanan', $data);
    }
}

?>