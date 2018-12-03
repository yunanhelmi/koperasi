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