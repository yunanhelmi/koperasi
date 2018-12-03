<?php

class SimpanankhususModel extends CI_Model {
	function __construct() {
		parent::__construct();
	}

	function getNewId() {
		$query = $this->db->query("SELECT MAX(id) as new_id from `simpanankhusus`");
		$a = $query->row();
		if($a->new_id == NULL) {
			return 1;
		} else {
			return $a->new_id + 1;
		}
	}

	function get_simpanankhusus_by_id($id) {
		$query = $this->db->query("SELECT * from `simpanankhusus` WHERE id = '$id'");
		$a = $query->row();
		return $a;
	}

	function get_simpanankhusus_by_id_nasabah($id_nasabah) {
		$query = $this->db->query("SELECT * from `simpanankhusus` WHERE id_nasabah = '$id_nasabah'");
		$a = $query->result_array();
		return $a;
	}

	function update_total($id, $total) {
		$this->db->query("UPDATE `simpanankhusus` SET total = '$total' WHERE id = '$id'");
	}

	function showData() {
		$query = $this->db->query("SELECT * from `simpanankhusus`");
		$a = $query->result_array();
		return $a;
	}

	function inputData($data) {
		$this->db->insert("simpanankhusus",$data);
	}

	function updateData($id, $data) {
		$this->db->where('id', $id);
		$this->db->update('simpanankhusus', $data);
	}

	function deleteData($id) {
		$this->db->where('id', $id);
		$this->db->delete('simpanankhusus');
	}

	function delete_by_id_nasabah($id_nasabah) {
		$this->db->query("DELETE FROM `simpanankhusus` WHERE id_nasabah = '$id_nasabah'");	
	}
}

?>