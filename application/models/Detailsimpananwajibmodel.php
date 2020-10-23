<?php

class DetailsimpananwajibModel extends CI_Model {
	function __construct() {
		parent::__construct();
	}

	function getNewId() {
		$query = $this->db->query("SELECT MAX(id) as new_id from `detail_simpananwajib`");
		$a = $query->row();
		if($a->new_id == NULL) {
			return 1;
		} else {
			return $a->new_id + 1;
		}
	}

	function get_detail_simpananwajib_by_id($id) {
		$query = $this->db->query("SELECT * from `detail_simpananwajib` WHERE id = '$id'");
		$a = $query->row();
		return $a;
	}

	function get_detail_simpananwajib_by_id_simpananwajib($id_simpananwajib) {
		$query = $this->db->query("SELECT * from `detail_simpananwajib` WHERE id_simpananwajib = '$id_simpananwajib'");
		$a = $query->result_array();
		return $a;
	}

	function showData() {
		$query = $this->db->query("SELECT * from `detail_simpananwajib`");
		$a = $query->result_array();
		return $a;
	}

	function inputData($data) {
		$this->db->insert("detail_simpananwajib",$data);
	}

	function updateData($id, $data) {
		$this->db->where('id', $id);
		$this->db->update('detail_simpananwajib', $data);
	}

	function deleteData($id) {
		$this->db->where('id', $id);
		$this->db->delete('detail_simpananwajib');
	}

	function delete_by_id_simpananwajib($id_simpananwajib) {
		$this->db->query("DELETE FROM `detail_simpananwajib` WHERE id_simpananwajib = '$id_simpananwajib'");
	}
}

?>
