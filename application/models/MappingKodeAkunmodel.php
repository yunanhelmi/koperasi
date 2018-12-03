<?php

class MappingKodeAkunModel extends CI_Model {
	function __construct() {
		parent::__construct();
	}

	function getNewId() {
		$query = $this->db->query("SELECT MAX(id) as new_id from `mapping_kode_akun`");
		$a = $query->row();
		if($a->new_id == NULL) {
			return 1;
		} else {
			return $a->new_id + 1;
		}
	}

	function get_mapping_kode_akun_by_id($id) {
		$query = $this->db->query("SELECT * from `mapping_kode_akun` WHERE id = '$id'");
		$a = $query->row();
		return $a;
	}

	function get_mapping_kode_akun_by_nama_transaksi($nama_transaksi) {
		$query = $this->db->query("SELECT * from `mapping_kode_akun` WHERE nama_transaksi = '$nama_transaksi'");
		$a = $query->row();
		return $a;	
	}

	function showData() {
		$query = $this->db->query("SELECT * from `mapping_kode_akun`");
		$a = $query->result_array();
		return $a;
	}

	function inputData($data) {
		$this->db->insert("mapping_kode_akun",$data);
	}

	function updateData($id, $data) {
		$this->db->where('id', $id);
		$this->db->update('mapping_kode_akun', $data);
	}

	function deleteData($id) {
		$this->db->where('id', $id);
		$this->db->delete('mapping_kode_akun');
	}
}

?>