<?php

class TransaksiAkuntansiModel extends CI_Model {
	function __construct() {
		parent::__construct();
	}

	function getNewId() {
		$query = $this->db->query("SELECT MAX(id) as new_id from `transaksi_akuntansi`");
		$a = $query->row();
		if($a->new_id == NULL) {
			return 1;
		} else {
			return $a->new_id + 1;
		}
	}

	function get_transaksi_akuntansi_by_id($id) {
		$query = $this->db->query("SELECT * from `transaksi_akuntansi` WHERE id = '$id'");
		$a = $query->row();
		return $a;
	}

	function showData() {
		$query = $this->db->query("SELECT * from `transaksi_akuntansi`");
		$a = $query->result_array();
		return $a;
	}

	function show_by_dari_sampai($dari, $sampai) {
		$query = $this->db->query("SELECT * from `transaksi_akuntansi` WHERE tanggal >= '$dari' AND tanggal <= '$sampai'");
		$a = $query->result_array();
		return $a;
	}

	function get_jumlah_by_dari_sampai_first_char($dari, $sampai, $c) {
		$query = $this->db->query(" SELECT kode_akun, nama_akun, SUM(debet) as jumlah_debet, SUM(kredit) as jumlah_kredit from `transaksi_akuntansi` WHERE `tanggal` >= '$dari' AND `tanggal` <= '$sampai' AND kode_akun LIKE '$c%' GROUP BY kode_akun ");
		$a = $query->result_array();
		return $a;
	}

	function get_jumlah_by_sampai_first_char($sampai, $c) {
		$query = $this->db->query(" SELECT kode_akun, nama_akun, SUM(debet) as jumlah_debet, SUM(kredit) as jumlah_kredit from `transaksi_akuntansi` WHERE `tanggal` < '$sampai' AND kode_akun LIKE '$c%' GROUP BY kode_akun ");
		$a = $query->result_array();
		return $a;
	}

	function get_saldo_awal_by_dari_sampai_first_char($dari, $sampai, $c) {
		$query = $this->db->query(" SELECT kode_akun, nama_akun, SUM(debet) as jumlah_debet, SUM(kredit) as jumlah_kredit from `transaksi_akuntansi` WHERE `tanggal` >= '$dari' AND `tanggal` <= '$sampai' AND kode_akun LIKE '$c%' AND keterangan LIKE 'SALDO AWAL' GROUP BY kode_akun ");
		$a = $query->result_array();
		return $a;	
	}

	function get_jumlah_by_dari_sampai_first_char_except_saldo_awal($dari, $sampai, $c) {
		$query = $this->db->query(" SELECT kode_akun, nama_akun, SUM(debet) as jumlah_debet, SUM(kredit) as jumlah_kredit from `transaksi_akuntansi` WHERE `tanggal` >= '$dari' AND `tanggal` <= '$sampai' AND kode_akun LIKE '$c%' AND keterangan NOT LIKE 'SALDO AWAL' GROUP BY kode_akun ");
		$a = $query->result_array();
		return $a;
	}

	function inputData($data) {
		$this->db->insert("transaksi_akuntansi",$data);
	}

	function updateData($id, $data) {
		$this->db->where('id', $id);
		$this->db->update('transaksi_akuntansi', $data);
	}

	function deleteData($id) {
		$this->db->where('id', $id);
		$this->db->delete('transaksi_akuntansi');
	}
}

?>