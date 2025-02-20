<?php

class SimpananpokokModel extends CI_Model {
	function __construct() {
		parent::__construct();
	}

	function getNewId() {
		$query = $this->db->query("SELECT MAX(id) as new_id from `simpananpokok`");
		$a = $query->row();
		if($a->new_id == NULL) {
			return 1;
		} else {
			return $a->new_id + 1;
		}
	}

	function get_simpananpokok_by_id($id) {
		$query = $this->db->query("SELECT * from `simpananpokok` WHERE id = '$id'");
		$a = $query->row();
		return $a;
	}

	function get_simpananpokok_by_id_nasabah($id_nasabah) {
		$query = $this->db->query("SELECT * from `simpananpokok` WHERE id_nasabah = '$id_nasabah'");
		$a = $query->result_array();
		return $a;
	}

	function get_data_laporan($dari, $sampai) {
		$query = $this->db->query(" 
									SELECT 
										simpananpokok.*, nasabah.alamat, nasabah.kelurahan, nasabah.dusun, nasabah.rw, nasabah.rt
									FROM 
										simpananpokok
									LEFT JOIN 
										nasabah
									ON 
										simpananpokok.id_nasabah = nasabah.id
									WHERE
										simpananpokok.waktu >= '$dari'
										AND simpananpokok.waktu <= '$sampai'
									ORDER BY simpananpokok.waktu ASC
								");
		$a = $query->result_array();
		return $a;
	}

	function get_data_laporan_harian($tanggal) {
		$query = $this->db->query("
									SELECT 
										simpananpokok.*,
										nasabah.alamat,
										nasabah.kota,
										nasabah.kecamatan,
										nasabah.kelurahan,
										nasabah.dusun,
										nasabah.rw,
										nasabah.rt
									FROM 
										simpananpokok
										LEFT JOIN
											nasabah
										ON
											simpananpokok.id_nasabah = nasabah.id
									WHERE
										simpananpokok.waktu = '$tanggal'
									ORDER BY
										simpananpokok.id
								");
		$a = $query->result_array();
		return $a;
	}

	function get_data_by_tanggal_id_nasabah($tanggal, $id_nasabah) {
		$query = $this->db->query("
									SELECT 
										COUNT(IF(simpananpokok.jenis = 'Setoran', 1, NULL)) as jumlah_setoran,
										COUNT(IF(simpananpokok.jenis = 'Tarikan', 1, NULL)) as jumlah_tarikan,
										SUM(IF(simpananpokok.jenis = 'Setoran', simpananpokok.jumlah, 0)) as total_setoran,
										SUM(IF(simpananpokok.jenis = 'Tarikan', simpananpokok.jumlah, 0)) as total_tarikan
									FROM 
										simpananpokok
									WHERE
										simpananpokok.id_nasabah = '$id_nasabah'
										AND simpananpokok.waktu <= '$tanggal'
								");
		$a = $query->result_array();
		return $a;
	}	

	function showData() {
		$query = $this->db->query("SELECT * from `simpananpokok`");
		$a = $query->result_array();
		return $a;
	}

	function inputData($data) {
		$this->db->insert("simpananpokok",$data);
	}

	function updateData($id, $data) {
		$this->db->where('id', $id);
		$this->db->update('simpananpokok', $data);
	}

	function deleteData($id) {
		$this->db->where('id', $id);
		$this->db->delete('simpananpokok');
	}

	function delete_by_id_nasabah($id_nasabah) {
		$this->db->query("DELETE FROM `simpananpokok` WHERE id_nasabah = '$id_nasabah'");	
	}
}

?>