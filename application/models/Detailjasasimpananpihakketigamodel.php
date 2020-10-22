<?php

class DetailjasasimpananpihakketigaModel extends CI_Model {
	function __construct() {
		parent::__construct();
	}

	function getNewId() {
		$query = $this->db->query("SELECT MAX(id) as new_id from `detail_jasa_simpananpihakketiga`");
		$a = $query->row();
		if($a->new_id == NULL) {
			return 1;
		} else {
			return $a->new_id + 1;
		}
	}

	function get_detail_jasa_simpananpihakketiga_by_id($id) {
		$query = $this->db->query("SELECT * from `detail_jasa_simpananpihakketiga` WHERE id = '$id'");
		$a = $query->row();
		return $a;
	}

	function get_detail_jasa_simpananpihakketiga_by_id_simpananpihakketiga($id_simpananpihakketiga) {
		$query = $this->db->query("SELECT * from `detail_jasa_simpananpihakketiga` WHERE id_simpananpihakketiga = '$id_simpananpihakketiga'");
		$a = $query->result_array();
		return $a;
	}

	function showData() {
		$query = $this->db->query("SELECT * from `detail_jasa_simpananpihakketiga`");
		$a = $query->result_array();
		return $a;
	}

	function inputData($data) {
		$this->db->insert("detail_jasa_simpananpihakketiga",$data);
	}

	function updateData($id, $data) {
		$this->db->where('id', $id);
		$this->db->update('detail_jasa_simpananpihakketiga', $data);
	}

	function deleteData($id) {
		$this->db->where('id', $id);
		$this->db->delete('detail_jasa_simpananpihakketiga');
	}

	function delete_by_id_simpananpihakketiga($id_simpananpihakketiga) {
		$this->db->query("DELETE FROM `detail_jasa_simpananpihakketiga` WHERE id_simpananpihakketiga = '$id_simpananpihakketiga'");
	}
}

?>
