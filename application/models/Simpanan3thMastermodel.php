<?php

class Simpanan3thMasterModel extends CI_Model {
	function __construct() {
		parent::__construct();
	}

	function getNewId() {
		$query = $this->db->query("SELECT MAX(id) as new_id from `simpanan3th_master`");
		$a = $query->row();
		if($a->new_id == NULL) {
			return 1;
		} else {
			return $a->new_id + 1;
		}
	}

	function get_simpanan3thmaster_by_id($id) {
		$query = $this->db->query("SELECT * from `simpanan3th_master` WHERE id = '$id'");
		$a = $query->row();
		return $a;
	}

	function get_simpanan3th_master_by_id_nasabah($id_nasabah) {
		$query = $this->db->query("SELECT * from `simpanan3th_master` WHERE id_nasabah = '$id_nasabah'");
		$a = $query->result_array();
		return $a;
	}

	function update_total($id, $total) {
		$this->db->query("UPDATE `simpanan3th_master` SET total = '$total' WHERE id = '$id'");
	}

	function showData() {
		$query = $this->db->query("SELECT * from `simpanan3th_master`");
		$a = $query->result_array();
		return $a;
	}

	function inputData($data) {
		$this->db->insert("simpanan3th_master",$data);
	}

	function updateData($id, $data) {
		$this->db->where('id', $id);
		$this->db->update('simpanan3th_master', $data);
	}

	function deleteData($id) {
		$this->db->where('id', $id);
		$this->db->delete('simpanan3th_master');
	}

	function delete_by_id_nasabah($id_nasabah) {
		$this->db->query("DELETE FROM `simpanan3th_master` WHERE id_nasabah = '$id_nasabah'");	
	}
}

?>