<?php

class SimpanankanzunModel extends CI_Model {
	function __construct() {
		parent::__construct();
	}

	function getNewId() {
		$query = $this->db->query("SELECT MAX(id) as new_id from `simpanankanzun`");
		$a = $query->row();
		if($a->new_id == NULL) {
			return 1;
		} else {
			return $a->new_id + 1;
		}
	}

	function get_simpanankanzun_by_id($id) {
		$query = $this->db->query("SELECT * from `simpanankanzun` WHERE id = '$id'");
		$a = $query->row();
		return $a;
	}

	function get_simpanankanzun_by_id_nasabah($id_nasabah) {
		$query = $this->db->query("SELECT * from `simpanankanzun` WHERE id_nasabah = '$id_nasabah'");
		$a = $query->result_array();
		return $a;
	}

	function update_total($id, $total) {
		$this->db->query("UPDATE `simpanankanzun` SET total = '$total' WHERE id = '$id'");
	}

	function get_data_laporan($dari, $sampai) {
		$query = $this->db->query("
									SELECT 
										simpanankanzun.*, 
										nasabah.alamat, 
										nasabah.kelurahan, 
										nasabah.dusun, 
										nasabah.rw, 
										nasabah.rt, 
										SUM(IF(detail_simpanankanzun.jenis = 'Setoran', detail_simpanankanzun.jumlah, 0)) as jumlah_setoran,
										SUM(IF(detail_simpanankanzun.jenis = 'Tarikan', detail_simpanankanzun.jumlah, 0)) as jumlah_tarikan
									FROM 
										simpanankanzun
										LEFT JOIN 
											nasabah 
										ON 
											simpanankanzun.id_nasabah = nasabah.id
									LEFT JOIN 
										(SELECT
									     	*
									     FROM
											detail_simpanankanzun
										WHERE
											detail_simpanankanzun.waktu >= '$dari'
											AND detail_simpanankanzun.waktu <= '$sampai'
										ORDER BY
											detail_simpanankanzun.waktu DESC) as detail_simpanankanzun
									ON 
										simpanankanzun.id = detail_simpanankanzun.id_simpanankanzun
									GROUP BY 
										simpanankanzun.id
								");
		$a = $query->result_array();
		return $a;
	}

	function get_data_laporan_harian($tanggal) {
		$query = $this->db->query("
									SELECT 
										detail_simpanankanzun.*, 
										simpanankanzun.nama_nasabah,
										simpanankanzun.nomor_nasabah,
										simpanankanzun.nik_nasabah
									FROM 
										detail_simpanankanzun
										LEFT JOIN 
											simpanankanzun
										ON
											detail_simpanankanzun.id_simpanankanzun = simpanankanzun.id
									WHERE
										detail_simpanankanzun.waktu = '$tanggal'
									ORDER BY
										detail_simpanankanzun.id
								");
		$a = $query->result_array();
		return $a;
	}

	function showData() {
		$query = $this->db->query("SELECT * from `simpanankanzun`");
		$a = $query->result_array();
		return $a;
	}

	function inputData($data) {
		$this->db->insert("simpanankanzun",$data);
	}

	function updateData($id, $data) {
		$this->db->where('id', $id);
		$this->db->update('simpanankanzun', $data);
	}

	function deleteData($id) {
		$this->db->where('id', $id);
		$this->db->delete('simpanankanzun');
	}

	function delete_by_id_nasabah($id_nasabah) {
		$this->db->query("DELETE FROM `simpanankanzun` WHERE id_nasabah = '$id_nasabah'");	
	}
}

?>