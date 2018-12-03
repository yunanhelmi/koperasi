<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class TransaksiCon extends CI_Controller {
	function __construct() {
		parent::__construct();

		$this->load->model('usermodel');
		$this->load->model('nasabahmodel');
		$this->load->model('pinjamanmodel');
		$this->load->model('simpananpokokmodel');
		$this->load->model('simpananwajibmodel');
		$this->load->model('detailangsuranmodel');
		$this->load->model('detailsimpananwajibmodel');

		$this->load->library('session');
		$this->load->library('form_validation');
		$this->load->library('upload');
		$this->load->library('image_lib');
		$this->load->library(array('PHPExcel','PHPExcel/IOFactory'));
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
		$this->load->view('/transaksi/index', $data);
		$this->load->view('/layouts/footer', $data);
	}
}

?>