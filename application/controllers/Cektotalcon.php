<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class CektotalCon extends CI_Controller {
	function __construct() {
		parent::__construct();

		$this->load->model('usermodel');
		$this->load->model('nasabahmodel');
		$this->load->model('mappingkodeakunmodel');
		$this->load->model('kodeakunmodel');
		$this->load->model('ceksimpananwajibmodel');
		$this->load->model('ceksimpananpensiunmodel');
	}

	function cekTotalSimpananWajib() {
		$data = $this->ceksimpananwajibmodel->cekTotal();

		for($i = 0; $i < sizeof($data); $i++) {
			$jumlah = $data[$i]['total_setoran_detail'] - $data[$i]['total_tarikan_detail'];
			if($jumlah != $data[$i]['total']) {
				echo "<pre>";
				var_dump($data[$i]);
				echo "</pre>";
			}
		}
	}

	function perbaikiTotalSimpananWajib() {
		$data = $this->ceksimpananwajibmodel->cekTotal();

		for($i = 0; $i < sizeof($data); $i++) {
			$jumlah = $data[$i]['total_setoran_detail'] - $data[$i]['total_tarikan_detail'];
			if($jumlah != $data[$i]['total']) {
				$id_simpananwajib = $data[$i]['id'];
				$this->ceksimpananwajibmodel->updateTotal($id_simpananwajib, $jumlah);
			}
		}
	}

	function cekTotalSimpananPensiun() {
		$data = $this->ceksimpananpensiunmodel->cekTotal();

		for($i = 0; $i < sizeof($data); $i++) {
			$jumlah = $data[$i]['total_setoran_detail'] - $data[$i]['total_tarikan_detail'];
			if($jumlah != $data[$i]['total']) {
				echo "<pre>";
				var_dump($data[$i]);
				echo "</pre>";
			}
		}
	}

	function perbaikiTotalSimpananPensiun() {
		$data = $this->ceksimpananpensiunmodel->cekTotal();

		for($i = 0; $i < sizeof($data); $i++) {
			$jumlah = $data[$i]['total_setoran_detail'] - $data[$i]['total_tarikan_detail'];
			if($jumlah != $data[$i]['total']) {
				$id_simpananpensiun = $data[$i]['id'];
				$this->ceksimpananpensiunmodel->updateTotal($id_simpananpensiun, $jumlah);
			}
		}
	}
}

?>
