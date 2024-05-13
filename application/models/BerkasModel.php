<?php

class BerkasModel extends CI_Model {
	function __construct() {
		parent::__construct();
	}

	function getNewId() {
		$query = $this->db->query("SELECT MAX(id) as new_id from `berkas`");
		$a = $query->row();
		if($a->new_id == NULL) {
			return 1;
		} else {
			return $a->new_id + 1;
		}
	}

	function get_berkas_by_id($id) {
		$query = $this->db->query("SELECT * from `berkas` WHERE id = '$id'");
		$a = $query->row();
		return $a;
	}

	function get_berkas_by_id_nasabah($id_nasabah) {
		$query = $this->db->query("SELECT * from `berkas` WHERE id_nasabah = '$id_nasabah'");
		$a = $query->result_array();
		return $a;
	}

	function showData() {
		$query = $this->db->query("SELECT * from `berkas`");
		$a = $query->result_array();
		return $a;
	}

	function inputData($data) {
		$this->db->insert("berkas",$data);
	}

	function updateData($id, $data) {
		$this->db->where('id', $id);
		$this->db->update('berkas', $data);
	}

	function deleteData($id) {
		$this->db->where('id', $id);
		$this->db->delete('berkas');
	}

	function delete_by_id_nasabah($id_nasabah) {
		$this->db->query("DELETE FROM `berkas` WHERE id_nasabah = '$id_nasabah'");	
	}
}

?>