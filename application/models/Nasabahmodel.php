<?php

class NasabahModel extends CI_Model {
	function __construct() {
		parent::__construct();
	}

	function getNewId() {
		$query = $this->db->query("SELECT MAX(id) as new_id from `nasabah`");
		$a = $query->row();
		if($a->new_id == NULL) {
			return 1;
		} else {
			return $a->new_id + 1;
		}
	}

	function getNewNomorNasabah() {
		$query = $this->db->query("SELECT MAX(nomor_nasabah) as new_nomor_nasabah from `nasabah`");
		$a = $query->row();
		if($a->new_nomor_nasabah == NULL) {
			return 1;
		} else {
			return $a->new_nomor_nasabah + 1;
		}
	}

	function getNewNomorNasabahByJenisNasabah($jenis_nasabah) {
		$query = $this->db->query("SELECT MAX(nomor_nasabah) as new_nomor_nasabah from `nasabah` WHERE jenis_nasabah = '$jenis_nasabah'");
		$a = $query->row();
		if($a->new_nomor_nasabah == NULL) {
			return 1;
		} else {
			return $a->new_nomor_nasabah + 1;
		}	
	}

	function get_nasabah_by_id($id) {
		$query = $this->db->query("SELECT * from `nasabah` WHERE id = '$id'");
		$a = $query->row();
		return $a;
	}

	function showData() {
		$query = $this->db->query("SELECT * from `nasabah`");
		$a = $query->result_array();
		return $a;
	}

	function getDataPostUnpost() {
		$query = $this->db->query("
									SELECT
										nasabah.*, pinjaman.id as id_pinjaman, COUNT(detail_angsuran.id) as total_unpost
									FROM 
										nasabah
										LEFT JOIN
											pinjaman
										ON
											nasabah.id = pinjaman.id_nasabah
									LEFT JOIN
										(SELECT
									     	*
									     FROM
											detail_angsuran
										WHERE
											detail_angsuran.status_post IS NULL
											OR detail_angsuran.status_post = 0
										) as detail_angsuran
									ON 
										pinjaman.id = detail_angsuran.id_pinjaman
									GROUP BY 
										nasabah.id
								");
		$a = $query->result_array();
		return $a;
	}

	function inputData($data) {
		$this->db->insert("nasabah",$data);
	}

	function updateData($id, $data) {
		$this->db->where('id', $id);
		$this->db->update('nasabah', $data);
	}

	function deleteData($id) {
		$this->db->where('id', $id);
		$this->db->delete('nasabah');
	}
}

?>