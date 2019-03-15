<?php

class KodeAkunModel extends CI_Model {
	function __construct() {
		parent::__construct();
	}

	function getNewId() {
		$query = $this->db->query("SELECT MAX(id) as new_id from `kode_akun`");
		$a = $query->row();
		if($a->new_id == NULL) {
			return 1;
		} else {
			return $a->new_id + 1;
		}
	}

	function get_kode_akun_by_id($id) {
		$query = $this->db->query("SELECT * from `kode_akun` WHERE id = '$id'");
		$a = $query->row();
		return $a;
	}

	function get_kode_akun_by_kode($kode) {
		$query = $this->db->query("SELECT * from `kode_akun` WHERE kode_akun = '$kode'");
		$a = $query->row();
		return $a;
	}

	function get_kode_akun_by_first_char($c) {
		$query = $this->db->query("SELECT *, 0 as debet, 0 as kredit, 0 as selisih from `kode_akun` WHERE kode_akun LIKE '$c%' ORDER BY kode_akun");
		$a = $query->result_array();
		return $a;
	}

	function showData() {
		$query = $this->db->query("SELECT * from `kode_akun` ORDER BY `kode_akun`");
		$a = $query->result_array();
		return $a;
	}

	function inputData($data) {
		$this->db->insert("kode_akun",$data);
	}

	function updateData($id, $data) {
		$this->db->where('id', $id);
		$this->db->update('kode_akun', $data);
	}

	function deleteData($id) {
		$this->db->where('id', $id);
		$this->db->delete('kode_akun');
	}
}

?>