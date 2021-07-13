<?php

class DetailpenerimaansuratModel extends CI_Model {
	function __construct() {
		parent::__construct();
	}

	function getNewId() {
		$query = $this->db->query("SELECT MAX(id) as new_id from `detail_penerimaan_surat`");
		$a = $query->row();
		if($a->new_id == NULL) {
			return 1;
		} else {
			return $a->new_id + 1;
		}
	}

	function get_detail_penerimaan_surat_by_id($id) {
		$query = $this->db->query("SELECT * from `detail_penerimaan_surat` WHERE id = '$id'");
		$a = $query->row();
		return $a;
	}

	function get_detail_penerimaan_surat_by_id_penerimaan_surat($id_penerimaan_surat) {
		$query = $this->db->query("SELECT * from `detail_penerimaan_surat` WHERE id_penerimaan_surat = '$id_penerimaan_surat'");
		$a = $query->result_array();
		return $a;
	}

	function showData() {
		$query = $this->db->query("SELECT * from `detail_penerimaan_surat`");
		$a = $query->result_array();
		return $a;
	}

	function inputData($data) {
		$this->db->insert("detail_penerimaan_surat",$data);
	}

	function updateData($id, $data) {
		$this->db->where('id', $id);
		$this->db->update('detail_penerimaan_surat', $data);
	}

	function deleteData($id) {
		$this->db->where('id', $id);
		$this->db->delete('detail_penerimaan_surat');
	}

	function delete_by_id_penerimaan_surat($id_penerimaan_surat) {
		$this->db->query("DELETE FROM `detail_penerimaan_surat` WHERE id_penerimaan_surat = '$id_penerimaan_surat'");
	}
}

?>