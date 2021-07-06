<?php

class PetugaslapanganModel extends CI_Model {
	function __construct() {
		parent::__construct();
	}

	function getNewId() {
		$query = $this->db->query("SELECT MAX(id) as new_id from `petugas_lapangan`");
		$a = $query->row();
		if($a->new_id == NULL) {
			return 1;
		} else {
			return $a->new_id + 1;
		}
	}

	function get_data_by_id($id) {
		$query = $this->db->query("SELECT * from `petugas_lapangan` WHERE id = '$id'");
		$a = $query->row();
		return $a;
	}

	function showData() {
		$query = $this->db->query("SELECT * from `petugas_lapangan`");
		$a = $query->result_array();
		return $a;
	}

	function inputData($data) {
		$this->db->insert("petugas_lapangan",$data);
	}

	function updateData($id, $data) {
		$this->db->where('id', $id);
		$this->db->update('petugas_lapangan', $data);
	}

	function deleteData($id) {
		$this->db->where('id', $id);
		$this->db->delete('petugas_lapangan');
	}
}

?>