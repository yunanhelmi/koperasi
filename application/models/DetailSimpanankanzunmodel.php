<?php

class DetailSimpanankanzunModel extends CI_Model {
	function __construct() {
		parent::__construct();
	}

	function getNewId() {
		$query = $this->db->query("SELECT MAX(id) as new_id from `detail_simpanankanzun`");
		$a = $query->row();
		if($a->new_id == NULL) {
			return 1;
		} else {
			return $a->new_id + 1;
		}
	}

	function get_detail_simpanankanzun_by_id($id) {
		$query = $this->db->query("SELECT * from `detail_simpanankanzun` WHERE id = '$id'");
		$a = $query->row();
		return $a;
	}

	function get_detail_simpanankanzun_by_id_simpanankanzun($id_simpanankanzun) {
		$query = $this->db->query("SELECT * from `detail_simpanankanzun` WHERE id_simpanankanzun = '$id_simpanankanzun'");
		$a = $query->result_array();
		return $a;
	}

	function showData() {
		$query = $this->db->query("SELECT * from `detail_simpanankanzun`");
		$a = $query->result_array();
		return $a;
	}

	function inputData($data) {
		$this->db->insert("detail_simpanankanzun",$data);
	}

	function updateData($id, $data) {
		$this->db->where('id', $id);
		$this->db->update('detail_simpanankanzun', $data);
	}

	function deleteData($id) {
		$this->db->where('id', $id);
		$this->db->delete('detail_simpanankanzun');
	}

	function delete_by_id_simpanankanzun($id_simpanankanzun) {
		$this->db->query("DELETE FROM `detail_simpanankanzun` WHERE id_simpanankanzun = '$id_simpanankanzun'");
	}
}

?>