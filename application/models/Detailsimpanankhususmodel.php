<?php

class DetailsimpanankhususModel extends CI_Model {
	function __construct() {
		parent::__construct();
	}

	function getNewId() {
		$query = $this->db->query("SELECT MAX(id) as new_id from `detail_simpanankhusus`");
		$a = $query->row();
		if($a->new_id == NULL) {
			return 1;
		} else {
			return $a->new_id + 1;
		}
	}

	function get_detail_simpanankhusus_by_id($id) {
		$query = $this->db->query("SELECT * from `detail_simpanankhusus` WHERE id = '$id'");
		$a = $query->row();
		return $a;
	}

	function get_detail_simpanankhusus_by_id_simpanankhusus($id_simpanankhusus) {
		$query = $this->db->query("SELECT * from `detail_simpanankhusus` WHERE id_simpanankhusus = '$id_simpanankhusus'");
		$a = $query->result_array();
		return $a;
	}

	function showData() {
		$query = $this->db->query("SELECT * from `detail_simpanankhusus`");
		$a = $query->result_array();
		return $a;
	}

	function inputData($data) {
		$this->db->insert("detail_simpanankhusus",$data);
	}

	function updateData($id, $data) {
		$this->db->where('id', $id);
		$this->db->update('detail_simpanankhusus', $data);
	}

	function deleteData($id) {
		$this->db->where('id', $id);
		$this->db->delete('detail_simpanankhusus');
	}

	function delete_by_id_simpanankhusus($id_simpanankhusus) {
		$this->db->query("DELETE FROM `detail_simpanankhusus` WHERE id_simpanankhusus = '$id_simpanankhusus'");
	}
}

?>
