<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Laporanrincianjasasimpanan3thCon extends CI_Controller {
	function __construct() {
		parent::__construct();

		$this->load->model('usermodel');
		$this->load->model('nasabahmodel');
		$this->load->model('mappingkodeakunmodel');
		$this->load->model('kodeakunmodel');
		$this->load->model('transaksiakuntansimodel');
		$this->load->model('simpanan3thmastermodel');
        $this->load->model('simpanan3thmodel');
		$this->load->model('detailsimpanan3thmodel');
		$this->load->model('laporanrincianjasasimpanan3thmodel');

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
		$data['username']         = $session_data['username'];
		$data['status']           = $session_data['status'];
		$data['nasabah'] 	        = $this->nasabahmodel->showData();
        $data['simpanan3thmaster']  = $this->simpanan3thmastermodel->showData();
		
		$this->load->view('/layouts/menu', $data);
		$this->load->view('/laporan/rincian_jasa_simpanan3th', $data);
		$this->load->view('/layouts/footer', $data);	
	}

	function html() {
		$session_data = $this->session->userdata('mubasyirin_logged_in');
        if($session_data == NULL) {
            redirect("usercon/login", "refresh");
        }

        $id_master      = $this->input->post('id_master');
        $simpanan3th_master = $this->simpanan3thmastermodel->get_simpanan3thmaster_by_id($id_master);
        $title = $simpanan3th_master->nama;

        $tanggal1       = $this->input->post('tanggal');
        $tgl            = strtotime($tanggal1);
        $tanggal        = date("Y-m-d",$tgl);

        $jasa_simpanan3th = $this->laporanrincianjasasimpanan3thmodel->get_data_jasa_simpanan3th($id_master, $tanggal);

        // Total Simpanan Dana Sosial pada neraca
        if($tanggal < '2019-01-01') {
            $transaksi    = $this->transaksiakuntansimodel->get_jumlah_by_sampai_kode_akun($tanggal, $simpanan3th_master->kode_kredit_penyesuaian_jasa);
        } else if($tanggal >= '2019-01-01') {
            $transaksi    = $this->transaksiakuntansimodel->get_jumlah_by_dari_sampai_kode_akun('2019-01-01', $tanggal, $simpanan3th_master->kode_kredit_penyesuaian_jasa);
        }

        if($transaksi != NULL) {
            $total_neraca = $transaksi[0]['jumlah_kredit'] - $transaksi[0]['jumlah_debet'];
        } else {
            $total_neraca = 0;
        }

        $data['title']        	= $title;
        $data['tanggal']        = $tanggal;
        $data['data']           = $jasa_simpanan3th;
        $data['transaksi_pendapatan']   = $transaksi;
        $data['total_neraca']   = $total_neraca;

        $this->load->view('/hasil_laporan/rincian_jasa_simpanan3th', $data);
	}
}

?>