<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class FormperhitunganCon extends CI_Controller {
	function __construct() {
		parent::__construct();

		$this->load->model('usermodel');
		$this->load->model('nasabahmodel');
		$this->load->model('pinjamanmodel');
		$this->load->model('petugaslapanganmodel');
		$this->load->model('penerimaansuratmodel');
		$this->load->model('detailpenerimaansuratmodel');

		$this->load->library('session');
		$this->load->library('form_validation');
		$this->load->library('upload');
		$this->load->library('image_lib');
		$this->load->library(array('PHPExcel','PHPExcel/IOFactory'));
		$this->load->library('pdfgenerator');
	}

	function dilunasi() {
		$session_data = $this->session->userdata('mubasyirin_logged_in');
		if($session_data == NULL) {
			redirect("usercon/login", "refresh");
		}
		$data['username'] 	= $session_data['username'];
		$data['status'] 	= $session_data['status'];
		$this->load->view('/layouts/menu', $data);
		$this->load->view('/form_perhitungan/dilunasi', $data);
		$this->load->view('/layouts/footer', $data);
	}
}

?>