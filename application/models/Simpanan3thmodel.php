<?php

class Simpanan3thModel extends CI_Model {
	function __construct() {
		parent::__construct();
	}

	function getNewId() {
		$query = $this->db->query("SELECT MAX(id) as new_id from `simpanan3th`");
		$a = $query->row();
		if($a->new_id == NULL) {
			return 1;
		} else {
			return $a->new_id + 1;
		}
	}

	function get_simpanan3th_by_id($id) {
		$query = $this->db->query("SELECT * from `simpanan3th` WHERE id = '$id'");
		$a = $query->row();
		return $a;
	}

	function get_simpanan3th_by_id_nasabah($id_nasabah) {
		$query = $this->db->query("SELECT * from `simpanan3th` WHERE id_nasabah = '$id_nasabah'");
		$a = $query->result_array();
		return $a;
	}

	function get_simpanan3th_by_id_master($id_master) {
		$query = $this->db->query("SELECT * from `simpanan3th` WHERE id_master = '$id_master'");
		$a = $query->result_array();
		return $a;
	}

	function update_total($id, $total) {
		$this->db->query("UPDATE `simpanan3th` SET total = '$total' WHERE id = '$id'");
	}

	function update_jasa_total($id, $jasa_total) {
		$this->db->query("UPDATE `simpanan3th` SET jasa_total = '$jasa_total' WHERE id = '$id'");
	}

	function get_data_laporan($id_master, $dari, $sampai) {
		$query = $this->db->query("
									SELECT 
										simpanan3th.*, 
										nasabah.alamat, 
										nasabah.kelurahan, 
										nasabah.dusun, 
										nasabah.rw, 
										nasabah.rt, 
										SUM(IF(detail_simpanan3th.jenis = 'Setoran', detail_simpanan3th.jumlah, 0)) as jumlah_setoran,
										SUM(IF(detail_simpanan3th.jenis = 'Tarikan', detail_simpanan3th.jumlah, 0)) as jumlah_tarikan,
										SUM(IF(detail_jasa_simpanan3th.jenis = 'Penyesuaian Jasa', detail_jasa_simpanan3th.jumlah, 0)) as jumlah_penyesuaian_jasa,
										SUM(IF(detail_jasa_simpanan3th.jenis = 'Pencairan Hutang Jasa', detail_jasa_simpanan3th.jumlah, 0)) as jumlah_pencairan_hutang_jasa,
										SUM(IF(detail_jasa_simpanan3th.jenis = 'Pembayaran Biaya Jasa', detail_jasa_simpanan3th.jumlah, 0)) as jumlah_pembayaran_biaya_jasa
									FROM 
										simpanan3th
										LEFT JOIN 
											nasabah 
										ON 
											simpanan3th.id_nasabah = nasabah.id
									LEFT JOIN 
										(SELECT
									     	*
									     FROM
											detail_simpanan3th
										WHERE
											detail_simpanan3th.waktu >= '$dari'
											AND detail_simpanan3th.waktu <= '$sampai'
										ORDER BY
											detail_simpanan3th.waktu DESC) as detail_simpanan3th
									ON 
										simpanan3th.id = detail_simpanan3th.id_simpanan3th
									LEFT JOIN 
										(SELECT
									     	*
									     FROM
											detail_jasa_simpanan3th
										WHERE
											detail_jasa_simpanan3th.waktu >= '$dari'
											AND detail_jasa_simpanan3th.waktu <= '$sampai'
										ORDER BY
											detail_jasa_simpanan3th.waktu DESC) as detail_jasa_simpanan3th
									ON 
										simpanan3th.id = detail_jasa_simpanan3th.id_simpanan3th
									WHERE 
										simpanan3th.id_master = '$id_master'
									GROUP BY 
										simpanan3th.id
								");
		$a = $query->result_array();
		return $a;
	}

	function get_data_laporan_harian($tanggal) {
		$query = $this->db->query("
									SELECT 
										detail_simpanan3th.*, 
										simpanan3th.nama_simpanan,
										simpanan3th.nama_nasabah,
										simpanan3th.nomor_nasabah,
										simpanan3th.nik_nasabah,
										simpanan3th.id_nasabah,
										nasabah.alamat,
										nasabah.kota,
										nasabah.kecamatan,
										nasabah.kelurahan,
										nasabah.dusun,
										nasabah.rw,
										nasabah.rt
									FROM 
										detail_simpanan3th
										LEFT JOIN 
											simpanan3th
										ON
											detail_simpanan3th.id_simpanan3th = simpanan3th.id
									LEFT JOIN
										nasabah
									ON
										simpanan3th.id_nasabah = nasabah.id
									WHERE
										detail_simpanan3th.waktu = '$tanggal'
									ORDER BY
										detail_simpanan3th.id
								");
		$a = $query->result_array();
		return $a;
	}

	function showData() {
		$query = $this->db->query("SELECT * from `simpanan3th`");
		$a = $query->result_array();
		return $a;
	}

	function inputData($data) {
		$this->db->insert("simpanan3th",$data);
	}

	function updateData($id, $data) {
		$this->db->where('id', $id);
		$this->db->update('simpanan3th', $data);
	}

	function deleteData($id) {
		$this->db->where('id', $id);
		$this->db->delete('simpanan3th');
	}

	function delete_by_id_nasabah($id_nasabah) {
		$this->db->query("DELETE FROM `simpanan3th` WHERE id_nasabah = '$id_nasabah'");	
	}
}

?>