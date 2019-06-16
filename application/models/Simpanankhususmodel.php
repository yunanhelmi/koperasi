<?php

class SimpanankhususModel extends CI_Model {
	function __construct() {
		parent::__construct();
	}

	function getNewId() {
		$query = $this->db->query("SELECT MAX(id) as new_id from `simpanankhusus`");
		$a = $query->row();
		if($a->new_id == NULL) {
			return 1;
		} else {
			return $a->new_id + 1;
		}
	}

	function get_simpanankhusus_by_id($id) {
		$query = $this->db->query("SELECT * from `simpanankhusus` WHERE id = '$id'");
		$a = $query->row();
		return $a;
	}

	function get_simpanankhusus_by_id_nasabah($id_nasabah) {
		$query = $this->db->query("SELECT * from `simpanankhusus` WHERE id_nasabah = '$id_nasabah'");
		$a = $query->result_array();
		return $a;
	}

	function update_total($id, $total) {
		$this->db->query("UPDATE `simpanankhusus` SET total = '$total' WHERE id = '$id'");
	}

	function get_data_laporan($dari, $sampai) {
		$query = $this->db->query("
									SELECT 
										simpanankhusus.*, 
										nasabah.alamat, 
										nasabah.kelurahan, 
										nasabah.dusun, 
										nasabah.rw, 
										nasabah.rt, 
										SUM(IF(detail_simpanankhusus.jenis = 'Setoran', detail_simpanankhusus.jumlah, 0)) as jumlah_setoran,
										SUM(IF(detail_simpanankhusus.jenis = 'Tarikan', detail_simpanankhusus.jumlah, 0)) as jumlah_tarikan
									FROM 
										simpanankhusus
										LEFT JOIN 
											nasabah 
										ON 
											simpanankhusus.id_nasabah = nasabah.id
									LEFT JOIN 
										(SELECT
									     	*
									     FROM
											detail_simpanankhusus
										WHERE
											detail_simpanankhusus.waktu >= '$dari'
											AND detail_simpanankhusus.waktu <= '$sampai'
										ORDER BY
											detail_simpanankhusus.waktu DESC) as detail_simpanankhusus
									ON 
										simpanankhusus.id = detail_simpanankhusus.id_simpanankhusus
									GROUP BY 
										simpanankhusus.id
								");
		$a = $query->result_array();
		return $a;
	}

	function get_data_laporan_harian($tanggal) {
		$query = $this->db->query("
									SELECT 
										detail_simpanankhusus.*, 
										simpanankhusus.nama_nasabah,
										simpanankhusus.nomor_nasabah,
										simpanankhusus.nik_nasabah,
										simpanankhusus.id_nasabah,
										nasabah.alamat,
										nasabah.kota,
										nasabah.kecamatan,
										nasabah.kelurahan,
										nasabah.dusun,
										nasabah.rw,
										nasabah.rt
									FROM 
										detail_simpanankhusus
										LEFT JOIN 
											simpanankhusus
										ON
											detail_simpanankhusus.id_simpanankhusus = simpanankhusus.id
									LEFT JOIN
										nasabah
									ON
										simpanankhusus.id_nasabah = nasabah.id
									WHERE
										detail_simpanankhusus.waktu = '$tanggal'
									ORDER BY
										detail_simpanankhusus.id
								");
		$a = $query->result_array();
		return $a;
	}

	function showData() {
		$query = $this->db->query("SELECT * from `simpanankhusus`");
		$a = $query->result_array();
		return $a;
	}

	function inputData($data) {
		$this->db->insert("simpanankhusus",$data);
	}

	function updateData($id, $data) {
		$this->db->where('id', $id);
		$this->db->update('simpanankhusus', $data);
	}

	function deleteData($id) {
		$this->db->where('id', $id);
		$this->db->delete('simpanankhusus');
	}

	function delete_by_id_nasabah($id_nasabah) {
		$this->db->query("DELETE FROM `simpanankhusus` WHERE id_nasabah = '$id_nasabah'");	
	}
}

?>