<?php

class TabunganModel extends CI_Model {
	function __construct() {
		parent::__construct();
	}

	function getNewId() {
		$query = $this->db->query("SELECT MAX(id) as new_id from `tabungan`");
		$a = $query->row();
		if($a->new_id == NULL) {
			return 1;
		} else {
			return $a->new_id + 1;
		}
	}

	function get_simpanan_pokok_by_id($id) {
		$query = $this->db->query("SELECT * from `tabungan` WHERE id = '$id'");
		$a = $query->row();
		return $a;
	}

	function showData() {
		$query = $this->db->query("SELECT * from `tabungan`");
		$a = $query->result_array();
		return $a;
	}

	function inputData($data) {
		$this->db->insert("tabungan",$data);
	}

	function updateData($id, $data) {
		$this->db->where('id', $id);
		$this->db->update('tabungan', $data);
	}

	function deleteData($id) {
		$this->db->where('id', $id);
		$this->db->delete('tabungan');
	}
}

?>