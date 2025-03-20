<?php

class DetailpenagihanModel extends CI_Model {
	function __construct() {
		parent::__construct();
	}

	function getNewId() {
		$query = $this->db->query("SELECT MAX(id) as new_id from `detail_penagihan`");
		$a = $query->row();
		if($a->new_id == NULL) {
			return 1;
		} else {
			return $a->new_id + 1;
		}
	}

	function get_detail_penagihan_by_id($id) {
		$query = $this->db->query("SELECT * from `detail_penagihan` WHERE id = '$id'");
		$a = $query->row();
		return $a;
	}

	function get_detail_penagihan_by_id_pinjaman($id_pinjaman) {
		$query = $this->db->query("SELECT * from `detail_penagihan` WHERE id_pinjaman = '$id_pinjaman'");
		$a = $query->result_array();
		return $a;
	}

	function showData() {
		$query = $this->db->query("SELECT * from `detail_penagihan`");
		$a = $query->result_array();
		return $a;
	}

	function inputData($data) {
		$this->db->insert("detail_penagihan",$data);
	}

	function updateData($id, $data) {
		$this->db->where('id', $id);
		$this->db->update('detail_penagihan', $data);
	}

	function deleteData($id) {
		$this->db->where('id', $id);
		$this->db->delete('detail_penagihan');
	}

	function delete_by_id_pinjaman($id_pinjaman) {
		$this->db->query("DELETE FROM `detail_penagihan` WHERE id_pinjaman = '$id_pinjaman'");
	}
}