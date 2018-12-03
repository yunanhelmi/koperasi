<?php

class DetailSimpanandanasosialModel extends CI_Model {
	function __construct() {
		parent::__construct();
	}

	function getNewId() {
		$query = $this->db->query("SELECT MAX(id) as new_id from `detail_simpanandanasosial`");
		$a = $query->row();
		if($a->new_id == NULL) {
			return 1;
		} else {
			return $a->new_id + 1;
		}
	}

	function get_detail_simpanandanasosial_by_id($id) {
		$query = $this->db->query("SELECT * from `detail_simpanandanasosial` WHERE id = '$id'");
		$a = $query->row();
		return $a;
	}

	function get_detail_simpanandanasosial_by_id_simpanandanasosial($id_simpanandanasosial) {
		$query = $this->db->query("SELECT * from `detail_simpanandanasosial` WHERE id_simpanandanasosial = '$id_simpanandanasosial'");
		$a = $query->result_array();
		return $a;
	}

	function showData() {
		$query = $this->db->query("SELECT * from `detail_simpanandanasosial`");
		$a = $query->result_array();
		return $a;
	}

	function inputData($data) {
		$this->db->insert("detail_simpanandanasosial",$data);
	}

	function updateData($id, $data) {
		$this->db->where('id', $id);
		$this->db->update('detail_simpanandanasosial', $data);
	}

	function deleteData($id) {
		$this->db->where('id', $id);
		$this->db->delete('detail_simpanandanasosial');
	}

	function delete_by_id_simpanandanasosial($id_simpanandanasosial) {
		$this->db->query("DELETE FROM `detail_simpanandanasosial` WHERE id_simpanandanasosial = '$id_simpanandanasosial'");
	}
}

?>