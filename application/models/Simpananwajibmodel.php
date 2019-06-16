<?php

class SimpananwajibModel extends CI_Model {
	function __construct() {
		parent::__construct();
	}

	function getNewId() {
		$query = $this->db->query("SELECT MAX(id) as new_id from `simpananwajib`");
		$a = $query->row();
		if($a->new_id == NULL) {
			return 1;
		} else {
			return $a->new_id + 1;
		}
	}

	function get_simpananwajib_by_id($id) {
		$query = $this->db->query("SELECT * from `simpananwajib` WHERE id = '$id'");
		$a = $query->row();
		return $a;
	}

	function get_simpananwajib_by_id_nasabah($id_nasabah) {
		$query = $this->db->query("SELECT * from `simpananwajib` WHERE id_nasabah = '$id_nasabah'");
		$a = $query->result_array();
		return $a;
	}

	function update_total($id, $total) {
		$this->db->query("UPDATE `simpananwajib` SET total = '$total' WHERE id = '$id'");
	}

	function get_data_laporan($dari, $sampai) {
		$query = $this->db->query("
									SELECT 
										simpananwajib.*, 
										nasabah.alamat, 
										nasabah.kelurahan, 
										nasabah.dusun, 
										nasabah.rw, 
										nasabah.rt, 
										SUM(IF(detail_simpananwajib.jenis = 'Setoran', detail_simpananwajib.jumlah, 0)) as jumlah_setoran,
										SUM(IF(detail_simpananwajib.jenis = 'Tarikan', detail_simpananwajib.jumlah, 0)) as jumlah_tarikan
									FROM 
										simpananwajib
										LEFT JOIN 
											nasabah 
										ON 
											simpananwajib.id_nasabah = nasabah.id
									LEFT JOIN 
										(SELECT
									     	*
									     FROM
											detail_simpananwajib
										WHERE
											detail_simpananwajib.waktu >= '$dari'
											AND detail_simpananwajib.waktu <= '$sampai'
										ORDER BY
											detail_simpananwajib.waktu DESC) as detail_simpananwajib
									ON 
										simpananwajib.id = detail_simpananwajib.id_simpananwajib
									GROUP BY 
										simpananwajib.id
								");
		$a = $query->result_array();
		return $a;
	}

	function get_data_laporan_harian($tanggal) {
		$query = $this->db->query("
									SELECT 
										detail_simpananwajib.*, 
										simpananwajib.nama_nasabah,
										simpananwajib.nomor_nasabah,
										simpananwajib.nik_nasabah,
										simpananwajib.id_nasabah,
										nasabah.alamat,
										nasabah.kota,
										nasabah.kecamatan,
										nasabah.kelurahan,
										nasabah.dusun,
										nasabah.rw,
										nasabah.rt
									FROM 
										detail_simpananwajib
										LEFT JOIN 
											simpananwajib
										ON 
											detail_simpananwajib.id_simpananwajib = simpananwajib.id
									LEFT JOIN
										nasabah
									ON
										simpananwajib.id_nasabah = nasabah.id
									WHERE
										detail_simpananwajib.waktu = '$tanggal'
									ORDER BY
										detail_simpananwajib.id
								");
		$a = $query->result_array();
		return $a;
	}

	function showData() {
		$query = $this->db->query("SELECT * from `simpananwajib`");
		$a = $query->result_array();
		return $a;
	}

	function inputData($data) {
		$this->db->insert("simpananwajib",$data);
	}

	function updateData($id, $data) {
		$this->db->where('id', $id);
		$this->db->update('simpananwajib', $data);
	}

	function deleteData($id) {
		$this->db->where('id', $id);
		$this->db->delete('simpananwajib');
	}

	function delete_by_id_nasabah($id_nasabah) {
		$this->db->query("DELETE FROM `simpananwajib` WHERE id_nasabah = '$id_nasabah'");	
	}
}

?>