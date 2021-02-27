<?php

class LaporanrincianakunModel extends CI_Model {
	function __construct() {
		parent::__construct();
	}

	function get_jumlah_by_sampai_kode_akun($sampai, $kode_akun) {
		$query = $this->db->query(" SELECT kode_akun, nama_akun, SUM(debet) as jumlah_debet, SUM(kredit) as jumlah_kredit from `transaksi_akuntansi` WHERE `tanggal` < '$sampai' AND kode_akun LIKE '$kode_akun' GROUP BY kode_akun ");
		$a = $query->result_array();
		return $a;
	}

	function get_transaksi_by_dari_sampai_kode_akun($dari, $sampai, $kode_akun) {
		$query = $this->db->query(" SELECT kode_akun, nama_akun, tanggal, debet, kredit, keterangan from `transaksi_akuntansi` WHERE `tanggal` >= '$dari' AND `tanggal` <= '$sampai' AND kode_akun LIKE '$kode_akun' ");
		$a = $query->result_array();
		return $a;
	}

	function get_saldo_awal_by_sampai_kode_akun($sampai, $kode_akun) {
		$query = $this->db->query(" SELECT kode_akun, nama_akun, SUM(debet) as jumlah_debet, SUM(kredit) as jumlah_kredit from `transaksi_akuntansi` WHERE `tanggal` <= '$sampai' AND kode_akun LIKE '$kode_akun' AND keterangan LIKE 'SALDO AWAL' GROUP BY kode_akun ");
		$a = $query->result_array();
		return $a;	
	}

	function get_transaksi_by_dari_sampai_kode_akun_except_saldo_awal($dari, $sampai, $kode_akun) {
		$query = $this->db->query(" SELECT kode_akun, nama_akun, tanggal, debet, kredit, keterangan from `transaksi_akuntansi` WHERE `tanggal` >= '$dari' AND `tanggal` <= '$sampai' AND kode_akun LIKE '$kode_akun' AND keterangan NOT LIKE 'SALDO AWAL' ");
		$a = $query->result_array();
		return $a;
	}
}

?>