<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class CekLaporanRincianJasacon extends CI_Controller {
	function __construct() {
		parent::__construct();

		$this->load->model('usermodel');
		$this->load->model('nasabahmodel');
		$this->load->model('mappingkodeakunmodel');
		$this->load->model('kodeakunmodel');
		$this->load->model('ceklaporanrincianjasamodel');
	}

	function cek($dari, $sampai) {
		//$dari = '2019-02-01';
		//$sampai = '2019-02-01';

		$transaksi_akuntansi = $this->ceklaporanrincianjasamodel->getTransaksiAKuntansi($dari, $sampai);

		$detail_angsuran = $this->ceklaporanrincianjasamodel->getDetailAngsuran($dari, $sampai);

		for($a = 0; $a < sizeof($detail_angsuran); $a++) {
			for($b = 0; $b < sizeof($transaksi_akuntansi); $b++) {
				if($detail_angsuran[$a]['id'] == $transaksi_akuntansi[$b]['origin_table_id'] && $detail_angsuran[$a]['pendapatan_jasa'] != $transaksi_akuntansi[$b]['kredit']) {
					echo "<pre>";
					var_dump($detail_angsuran[$a]);
					echo "</pre>";					
					echo "<pre>";
					var_dump($transaksi_akuntansi[$b]);
					echo "</pre>";					
				}
			}
		}

		/*echo "<pre>";
		var_dump($transaksi_akuntansi);
		echo "</pre>";*/
	}

	function cek_sum($dari, $sampai) {
		$transaksi_akuntansi = $this->ceklaporanrincianjasamodel->getSumTransaksiAKuntansi($dari, $sampai);

		$detail_angsuran = $this->ceklaporanrincianjasamodel->getSumDetailAngsuran($dari, $sampai);

		$pendapatan_jasa = 0;
		for($a = 0; $a < sizeof($detail_angsuran); $a++) {
			$pendapatan_jasa += $detail_angsuran[$a]['jasa'] + $detail_angsuran[$a]['denda'];
		}

		//$selisih = $detail_angsuran[0]['pendapatan_jasa'] - $transaksi_akuntansi[0]['total_kredit'];

		echo "transaksi_akuntansi";
		echo "<pre>";
		var_dump($transaksi_akuntansi);
		echo "</pre>";

		echo "pendapatan_jasa";
		echo "<pre>";
		var_dump($pendapatan_jasa);
		echo "</pre>";
	}
}

?>