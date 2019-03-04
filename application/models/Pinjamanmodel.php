<?php

class PinjamanModel extends CI_Model {
	function __construct() {
		parent::__construct();
	}

	function getNewId() {
		$query = $this->db->query("SELECT MAX(id) as new_id from `pinjaman`");
		$a = $query->row();
		if($a->new_id == NULL) {
			return 1;
		} else {
			return $a->new_id + 1;
		}
	}

	function get_pinjaman_by_id($id) {
		$query = $this->db->query("SELECT * from `pinjaman` WHERE id = '$id'");
		$a = $query->row();
		return $a;
	}

	function get_pinjaman_by_id_nasabah($id_nasabah) {
		$query = $this->db->query("SELECT * from `pinjaman` WHERE id_nasabah = '$id_nasabah'");
		$a = $query->result_array();
		return $a;
	}

	function update_sisa_angsuran($id, $sisa_angsuran) {
		$this->db->query("UPDATE `pinjaman` SET sisa_angsuran = '$sisa_angsuran' WHERE id = '$id'");
	}

	function update_angsuran_perbulan($id, $angsuran_perbulan) {
		$this->db->query("UPDATE `pinjaman` SET angsuran_perbulan = '$angsuran_perbulan' WHERE id = '$id'");
	}

	function update_jumlah_pinjaman($id, $jumlah_pinjaman) {
		$this->db->query("UPDATE `pinjaman` SET jumlah_pinjaman = '$jumlah_pinjaman' WHERE id = '$id'");
	}

	function update_jasa_total_angsuran_perbulan($id, $jasa, $total) {
		$this->db->query("UPDATE `pinjaman` SET jasa_perbulan = '$jasa', total_angsuran_perbulan = '$total' WHERE id = '$id'");
	}

	function update_jatuh_tempo($id, $jatuh_tempo) {
		$this->db->query("UPDATE `pinjaman` SET jatuh_tempo = '$jatuh_tempo' WHERE id = '$id'");
	}

	function update_jaminan($id, $jaminan) {
		$this->db->query("UPDATE `pinjaman` SET jaminan = '$jaminan' WHERE id = '$id'");
	}

	function showData() {
		$query = $this->db->query("SELECT * from `pinjaman`");
		$a = $query->result_array();
		return $a;
	}

	function inputData($data) {
		$this->db->insert("pinjaman",$data);
	}

	function updateData($id, $data) {
		$this->db->where('id', $id);
		$this->db->update('pinjaman', $data);
	}

	function deleteData($id) {
		$this->db->where('id', $id);
		$this->db->delete('pinjaman');
	}

	function delete_by_id_nasabah($id_nasabah) {
		$this->db->query("DELETE FROM `pinjaman` WHERE id_nasabah = '$id_nasabah'");	
	}
}

?>