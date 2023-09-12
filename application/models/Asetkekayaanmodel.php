<?php

class AsetkekayaanModel extends CI_Model {
	function __construct() {
		parent::__construct();
	}

	function getNewId() {
		$query = $this->db->query("SELECT MAX(id) as new_id from `aset_kekayaan`");
		$a = $query->row();
		if($a->new_id == NULL) {
			return 1;
		} else {
			return $a->new_id + 1;
		}
	}

	function get_asetkekayaan_by_id($id) {
		$query = $this->db->query("SELECT * from `aset_kekayaan` WHERE id = '$id'");
		$a = $query->row();
		return $a;
	}

	function get_asetkekayaan_by_id_nasabah($id_nasabah) {
		$query = $this->db->query("SELECT * from `aset_kekayaan` WHERE id_nasabah = '$id_nasabah'");
		$a = $query->result_array();
		return $a;
	}

	function showData() {
		$query = $this->db->query("SELECT * from `aset_kekayaan`");
		$a = $query->result_array();
		return $a;
	}

	function inputData($data) {
		$this->db->insert("aset_kekayaan",$data);
	}

	function updateData($id, $data) {
		$this->db->where('id', $id);
		$this->db->update('aset_kekayaan', $data);
	}

	function deleteData($id) {
		$this->db->where('id', $id);
		$this->db->delete('aset_kekayaan');
	}

	function delete_by_id_nasabah($id_nasabah) {
		$this->db->query("DELETE FROM `aset_kekayaan` WHERE id_nasabah = '$id_nasabah'");	
	}
}

?>