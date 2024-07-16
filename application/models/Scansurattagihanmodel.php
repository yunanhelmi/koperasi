<?php

class ScansurattagihanModel extends CI_Model {
	function __construct() {
		parent::__construct();
	}

	function getNewId() {
		$query = $this->db->query("SELECT MAX(id) as new_id from `scan_surat_tagihan`");
		$a = $query->row();
		if($a->new_id == NULL) {
			return 1;
		} else {
			return $a->new_id + 1;
		}
	}

	function get_scan_surat_tagihan_by_id($id) {
		$query = $this->db->query("SELECT * from `scan_surat_tagihan` WHERE id = '$id'");
		$a = $query->row();
		return $a;
	}

	function get_scan_surat_tagihan_by_id_pinjaman($id_pinjaman) {
		$query = $this->db->query("SELECT * from `scan_surat_tagihan` WHERE id_pinjaman = '$id_pinjaman'");
		$a = $query->result_array();
		return $a;
	}

	function showData() {
		$query = $this->db->query("SELECT * from `scan_surat_tagihan`");
		$a = $query->result_array();
		return $a;
	}

	function inputData($data) {
		$this->db->insert("scan_surat_tagihan",$data);
	}

	function updateData($id, $data) {
		$this->db->where('id', $id);
		$this->db->update('scan_surat_tagihan', $data);
	}

	function deleteData($id) {
		$this->db->where('id', $id);
		$this->db->delete('scan_surat_tagihan');
	}

	function delete_by_id_pinjaman($id_pinjaman) {
		$this->db->query("DELETE FROM `scan_surat_tagihan` WHERE id_pinjaman = '$id_pinjaman'");
	}
}

?>