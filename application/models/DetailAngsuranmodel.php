<?php

class DetailAngsuranModel extends CI_Model {
	function __construct() {
		parent::__construct();
	}

	function getNewId() {
		$query = $this->db->query("SELECT MAX(id) as new_id from `detail_angsuran`");
		$a = $query->row();
		if($a->new_id == NULL) {
			return 1;
		} else {
			return $a->new_id + 1;
		}
	}

	function get_detail_angsuran_by_id($id) {
		$query = $this->db->query("SELECT * from `detail_angsuran` WHERE id = '$id'");
		$a = $query->row();
		return $a;
	}

	function get_detail_angsuran_by_id_pinjaman($id_pinjaman) {
		$query = $this->db->query("SELECT * from `detail_angsuran` WHERE id_pinjaman = '$id_pinjaman'");
		$a = $query->result_array();
		return $a;
	}

	function get_total_kali_angsuran($id_pinjaman) {
		$query = $this->db->query("SELECT COUNT(id) as total_kali_angsuran from `detail_angsuran` WHERE id_pinjaman = '$id_pinjaman' AND jenis = 'Angsuran' GROUP BY id_pinjaman");
		$a = $query->row();
		return $a->total_kali_angsuran;
	}

	function get_total_kali_pinjaman($id_pinjaman) {
		$query = $this->db->query("SELECT COUNT(id) as total_kali_angsuran from `detail_angsuran` WHERE id_pinjaman = '$id_pinjaman' AND jenis = 'Pinjaman' GROUP BY id_pinjaman");
		$a = $query->row();
		return $a->total_kali_angsuran;
	}

	function get_max_bulanke($id_pinjaman) {
		$query = $this->db->query("SELECT COUNT(id) as max_bulanke from `detail_angsuran` WHERE id_pinjaman = '$id_pinjaman' AND jenis = 'Angsuran'");
		$a = $query->row();
		return $a->max_bulanke;
	}

	function showData() {
		$query = $this->db->query("SELECT * from `detail_angsuran`");
		$a = $query->result_array();
		return $a;
	}

	function inputData($data) {
		$this->db->insert("detail_angsuran",$data);
	}

	function updateData($id, $data) {
		$this->db->where('id', $id);
		$this->db->update('detail_angsuran', $data);
	}

	function deleteData($id) {
		$this->db->where('id', $id);
		$this->db->delete('detail_angsuran');
	}

	function delete_by_id_pinjaman($id_pinjaman) {
		$this->db->query("DELETE FROM `detail_angsuran` WHERE id_pinjaman = '$id_pinjaman'");
	}
}

?>