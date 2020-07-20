<?php

class SimpananpihakketigaModel extends CI_Model {
	function __construct() {
		parent::__construct();
	}

	function getNewId() {
		$query = $this->db->query("SELECT MAX(id) as new_id from `simpananpihakketiga`");
		$a = $query->row();
		if($a->new_id == NULL) {
			return 1;
		} else {
			return $a->new_id + 1;
		}
	}

	function get_simpananpihakketiga_by_id($id) {
		$query = $this->db->query("SELECT * from `simpananpihakketiga` WHERE id = '$id'");
		$a = $query->row();
		return $a;
	}

	function get_simpananpihakketiga_by_id_nasabah($id_nasabah) {
		$query = $this->db->query("SELECT * from `simpananpihakketiga` WHERE id_nasabah = '$id_nasabah'");
		$a = $query->result_array();
		return $a;
	}

	function update_total($id, $total) {
		$this->db->query("UPDATE `simpananpihakketiga` SET total = '$total' WHERE id = '$id'");
	}

	function update_jasa_total($id, $jasa_total) {
		$this->db->query("UPDATE `simpananpihakketiga` SET jasa_total = '$jasa_total' WHERE id = '$id'");
	}

	function get_data_laporan($dari, $sampai) {
		$query = $this->db->query("
									SELECT 
										simpananpihakketiga.*, 
										nasabah.alamat as alamat_n, 
										nasabah.kelurahan as kelurahan_n, 
										nasabah.dusun as dusun_n, 
										nasabah.rw as rw_n, 
										nasabah.rt as rt_n, 
										SUM(IF(detail_simpananpihakketiga.jenis = 'Setoran', detail_simpananpihakketiga.jumlah, 0)) as jumlah_setoran,
										SUM(IF(detail_simpananpihakketiga.jenis = 'Tarikan', detail_simpananpihakketiga.jumlah, 0)) as jumlah_tarikan
									FROM 
										simpananpihakketiga
										LEFT JOIN 
											nasabah 
										ON 
											simpananpihakketiga.id_nasabah = nasabah.id
									LEFT JOIN 
										(SELECT
									     	*
									     FROM
											detail_simpananpihakketiga
										WHERE
											detail_simpananpihakketiga.waktu >= '$dari'
											AND detail_simpananpihakketiga.waktu <= '$sampai'
										ORDER BY
											detail_simpananpihakketiga.waktu DESC) as detail_simpananpihakketiga
									ON 
										simpananpihakketiga.id = detail_simpananpihakketiga.id_simpananpihakketiga
									GROUP BY 
										simpananpihakketiga.id
								");
		$a = $query->result_array();
		return $a;
	}

	function get_data_laporan_harian($tanggal) {
		$query = $this->db->query("
									SELECT 
										detail_simpananpihakketiga.*, 
										simpananpihakketiga.nama,
										simpananpihakketiga.nomor_nasabah,
										simpananpihakketiga.nik,
										simpananpihakketiga.id_nasabah,
										nasabah.alamat,
										nasabah.kota,
										nasabah.kecamatan,
										nasabah.kelurahan,
										nasabah.dusun,
										nasabah.rw,
										nasabah.rt
									FROM 
										detail_simpananpihakketiga
										LEFT JOIN 
											simpananpihakketiga
										ON
											detail_simpananpihakketiga.id_simpananpihakketiga = simpananpihakketiga.id
									LEFT JOIN
										nasabah
									ON
										simpananpihakketiga.id_nasabah = nasabah.id
									WHERE
										detail_simpananpihakketiga.waktu = '$tanggal'
									ORDER BY
										detail_simpananpihakketiga.id
								");
		$a = $query->result_array();
		return $a;
	}

	function showData() {
		$query = $this->db->query("SELECT * from `simpananpihakketiga`");
		$a = $query->result_array();
		return $a;
	}

	function inputData($data) {
		$this->db->insert("simpananpihakketiga",$data);
	}

	function updateData($id, $data) {
		$this->db->where('id', $id);
		$this->db->update('simpananpihakketiga', $data);
	}

	function deleteData($id) {
		$this->db->where('id', $id);
		$this->db->delete('simpananpihakketiga');
	}

	function delete_by_id_nasabah($id_nasabah) {
		$this->db->query("DELETE FROM `simpananpihakketiga` WHERE id_nasabah = '$id_nasabah'");	
	}
}

?>