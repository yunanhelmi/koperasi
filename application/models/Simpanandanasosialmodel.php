<?php

class SimpanandanasosialModel extends CI_Model {
	function __construct() {
		parent::__construct();
	}

	function getNewId() {
		$query = $this->db->query("SELECT MAX(id) as new_id from `simpanandanasosial`");
		$a = $query->row();
		if($a->new_id == NULL) {
			return 1;
		} else {
			return $a->new_id + 1;
		}
	}

	function get_simpanandanasosial_by_id($id) {
		$query = $this->db->query("SELECT * from `simpanandanasosial` WHERE id = '$id'");
		$a = $query->row();
		return $a;
	}

	function get_simpanandanasosial_by_id_nasabah($id_nasabah) {
		$query = $this->db->query("SELECT * from `simpanandanasosial` WHERE id_nasabah = '$id_nasabah'");
		$a = $query->result_array();
		return $a;
	}

	function update_total($id, $total) {
		$this->db->query("UPDATE `simpanandanasosial` SET total = '$total' WHERE id = '$id'");
	}

	function get_data_laporan($dari, $sampai) {
		$query = $this->db->query("
									SELECT 
										simpanandanasosial.*, 
										nasabah.alamat, 
										nasabah.kelurahan, 
										nasabah.dusun, 
										nasabah.rw, 
										nasabah.rt, 
										SUM(IF(detail_simpanandanasosial.jenis = 'Setoran', detail_simpanandanasosial.jumlah, 0)) as jumlah_setoran,
										SUM(IF(detail_simpanandanasosial.jenis = 'Tarikan', detail_simpanandanasosial.jumlah, 0)) as jumlah_tarikan
									FROM 
										simpanandanasosial
										LEFT JOIN 
											nasabah 
										ON 
											simpanandanasosial.id_nasabah = nasabah.id
									LEFT JOIN 
										(SELECT
									     	*
									     FROM
											detail_simpanandanasosial
										WHERE
											detail_simpanandanasosial.waktu >= '$dari'
											AND detail_simpanandanasosial.waktu <= '$sampai'
										ORDER BY
											detail_simpanandanasosial.waktu DESC) as detail_simpanandanasosial
									ON 
										simpanandanasosial.id = detail_simpanandanasosial.id_simpanandanasosial
									GROUP BY 
										simpanandanasosial.id
								");
		$a = $query->result_array();
		return $a;
	}

	function get_data_laporan_harian($tanggal) {
		$query = $this->db->query("
									SELECT 
										detail_simpanandanasosial.*, 
										simpanandanasosial.nama_nasabah,
										simpanandanasosial.nomor_nasabah,
										simpanandanasosial.nik_nasabah
									FROM 
										detail_simpanandanasosial
										LEFT JOIN 
											simpanandanasosial
										ON
											detail_simpanandanasosial.id_simpanandanasosial = simpanandanasosial.id
									WHERE
										detail_simpanandanasosial.waktu = '$tanggal'
									ORDER BY
										detail_simpanandanasosial.id
								");
		$a = $query->result_array();
		return $a;
	}

	function showData() {
		$query = $this->db->query("SELECT * from `simpanandanasosial`");
		$a = $query->result_array();
		return $a;
	}

	function inputData($data) {
		$this->db->insert("simpanandanasosial",$data);
	}

	function updateData($id, $data) {
		$this->db->where('id', $id);
		$this->db->update('simpanandanasosial', $data);
	}

	function deleteData($id) {
		$this->db->where('id', $id);
		$this->db->delete('simpanandanasosial');
	}

	function delete_by_id_nasabah($id_nasabah) {
		$this->db->query("DELETE FROM `simpanandanasosial` WHERE id_nasabah = '$id_nasabah'");	
	}
}

?>