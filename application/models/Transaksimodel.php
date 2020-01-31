<?php

class TransaksiModel extends CI_Model {
	function __construct() {
		parent::__construct();
	}

	function getNewId() {
		$query = $this->db->query("SELECT MAX(id) as new_id from `transaksi`");
		$a = $query->row();
		if($a->new_id == NULL) {
			return 1;
		} else {
			return $a->new_id + 1;
		}
	}

	function get_transaksi_by_id($id) {
		$query = $this->db->query("SELECT * from `transaksi` WHERE id = '$id'");
		$a = $query->row();
		return $a;
	}

	function showData() {
		$query = $this->db->query("SELECT * from `transaksi`");
		$a = $query->result_array();
		return $a;
	}

	function get_data_by_kode_debet_sampai($sampai, $kode_debet) {
		$query = $this->db->query("SELECT 
										SUM(jumlah) as jumlah 
									FROM 
										`transaksi` 
									WHERE 
										tanggal <= '$sampai' 
										AND kode_debet = '$kode_debet' 
									");
		$a = $query->result_array();
		return $a;	
	}

	function get_data_by_kode_kredit_sampai($sampai, $kode_kredit) {
		$query = $this->db->query("SELECT 
										SUM(jumlah) as jumlah 
									FROM 
										`transaksi` 
									WHERE 
										tanggal <= '$sampai' 
										AND kode_kredit = '$kode_kredit' 
									");
		$a = $query->result_array();
		return $a;	
	}

	function inputData($data) {
		$this->db->insert("transaksi",$data);
	}

	function updateData($id, $data) {
		$this->db->where('id', $id);
		$this->db->update('transaksi', $data);
	}

	function deleteData($id) {
		$this->db->where('id', $id);
		$this->db->delete('transaksi');
	}
}

?>