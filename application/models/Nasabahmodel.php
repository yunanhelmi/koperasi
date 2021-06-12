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

	function get_data_desa() {
		$query = $this->db->query("
								SELECT
									DISTINCT(kelurahan)
								FROM 
									nasabah
								ORDER BY 
									kelurahan
								");
		$a = $query->result_array();
		return $a;
	}

	function getDataPostUnpostPinjaman() {
		$query = $this->db->query("
									SELECT
										nasabah.*, pinjaman.id as id_pinjaman, SUM(detail_angsuran.total_unpost) as total_unpost
									FROM 
										nasabah
										LEFT JOIN
											pinjaman
										ON
											nasabah.id = pinjaman.id_nasabah
									LEFT JOIN
										(SELECT
									     	id_pinjaman, 
									     	COUNT(id) as total_unpost
									     FROM
											detail_angsuran
										WHERE
											detail_angsuran.status_post IS NULL
											OR detail_angsuran.status_post = 0
										GROUP BY 
											id_pinjaman
										) as detail_angsuran
									ON 
										pinjaman.id = detail_angsuran.id_pinjaman
									GROUP BY
										nasabah.id
									ORDER BY
										nasabah.id
								");
		$a = $query->result_array();
		return $a;
	}

	function getDataPostUnpostSimpananPokok() {
		$query = $this->db->query("
									SELECT
										nasabah.id, 
										SUM(simpananpokok.total_unpost) as total_unpost
									FROM 
										nasabah
										LEFT JOIN
											(SELECT
										     	id_nasabah, 
										     	COUNT(id) as total_unpost
										     FROM
												simpananpokok
											WHERE
												simpananpokok.status_post IS NULL
												OR simpananpokok.status_post = 0
											GROUP BY 
												id_nasabah
											) as simpananpokok
										ON 
											nasabah.id = simpananpokok.id_nasabah
									GROUP BY
										nasabah.id
									ORDER BY
										nasabah.id
								");
		$a = $query->result_array();
		return $a;
	}

	function getDataPostUnpostSimpananWajib() {
		$query = $this->db->query("
									SELECT
										nasabah.*, simpananwajib.id as id_simpananwajib, SUM(detail_simpananwajib.total_unpost) as total_unpost
									FROM 
										nasabah
										LEFT JOIN
											simpananwajib
										ON
											nasabah.id = simpananwajib.id_nasabah
									LEFT JOIN
										(SELECT
									     	id_simpananwajib, 
									     	COUNT(id) as total_unpost
									     FROM
											detail_simpananwajib
										WHERE
											detail_simpananwajib.status_post IS NULL
											OR detail_simpananwajib.status_post = 0
										GROUP BY 
											id_simpananwajib
										) as detail_simpananwajib
									ON 
										simpananwajib.id = detail_simpananwajib.id_simpananwajib
									GROUP BY
										nasabah.id
									ORDER BY
										nasabah.id
								");
		$a = $query->result_array();
		return $a;
	}

	function getDataPostUnpostSimpananKhusus() {
		$query = $this->db->query("
									SELECT
										nasabah.*, simpanankhusus.id as id_simpanankhusus, SUM(detail_simpanankhusus.total_unpost) as total_unpost
									FROM 
										nasabah
										LEFT JOIN
											simpanankhusus
										ON
											nasabah.id = simpanankhusus.id_nasabah
									LEFT JOIN
										(SELECT
									     	id_simpanankhusus, 
									     	COUNT(id) as total_unpost
									     FROM
											detail_simpanankhusus
										WHERE
											detail_simpanankhusus.status_post IS NULL
											OR detail_simpanankhusus.status_post = 0
										GROUP BY 
											id_simpanankhusus
										) as detail_simpanankhusus
									ON 
										simpanankhusus.id = detail_simpanankhusus.id_simpanankhusus
									GROUP BY
										nasabah.id
									ORDER BY
										nasabah.id
								");
		$a = $query->result_array();
		return $a;
	}

	function getDataPostUnpostSimpananDanaSosial() {
		$query = $this->db->query("
									SELECT
										nasabah.*, simpanandanasosial.id as id_simpanandanasosial, SUM(detail_simpanandanasosial.total_unpost) as total_unpost
									FROM 
										nasabah
										LEFT JOIN
											simpanandanasosial
										ON
											nasabah.id = simpanandanasosial.id_nasabah
									LEFT JOIN
										(SELECT
									     	id_simpanandanasosial, 
									     	COUNT(id) as total_unpost
									     FROM
											detail_simpanandanasosial
										WHERE
											detail_simpanandanasosial.status_post IS NULL
											OR detail_simpanandanasosial.status_post = 0
										GROUP BY 
											id_simpanandanasosial
										) as detail_simpanandanasosial
									ON 
										simpanandanasosial.id = detail_simpanandanasosial.id_simpanandanasosial
									GROUP BY
										nasabah.id
									ORDER BY
										nasabah.id
								");
		$a = $query->result_array();
		return $a;
	}

	function getDataPostUnpostSimpananKanzun() {
		$query = $this->db->query("
									SELECT
										nasabah.*, simpanankanzun.id as id_simpanankanzun, SUM(detail_simpanankanzun.total_unpost) as total_unpost
									FROM 
										nasabah
										LEFT JOIN
											simpanankanzun
										ON
											nasabah.id = simpanankanzun.id_nasabah
									LEFT JOIN
										(SELECT
									     	id_simpanankanzun, 
									     	COUNT(id) as total_unpost
									     FROM
											detail_simpanankanzun
										WHERE
											detail_simpanankanzun.status_post IS NULL
											OR detail_simpanankanzun.status_post = 0
										GROUP BY 
											id_simpanankanzun
										) as detail_simpanankanzun
									ON 
										simpanankanzun.id = detail_simpanankanzun.id_simpanankanzun
									GROUP BY
										nasabah.id
									ORDER BY
										nasabah.id
								");
		$a = $query->result_array();
		return $a;
	}

	function getDataPostUnpostSimpananPihakKetiga() {
		$query = $this->db->query("
									SELECT
										nasabah.*, simpananpihakketiga.id as id_simpananpihakketiga, SUM(detail_simpananpihakketiga.total_unpost) as total_unpost
									FROM 
										nasabah
										LEFT JOIN
											simpananpihakketiga
										ON
											nasabah.id = simpananpihakketiga.id_nasabah
									LEFT JOIN
										(SELECT
									     	id_simpananpihakketiga, 
									     	COUNT(id) as total_unpost
									     FROM
											detail_simpananpihakketiga
										WHERE
											detail_simpananpihakketiga.status_post IS NULL
											OR detail_simpananpihakketiga.status_post = 0
										GROUP BY 
											id_simpananpihakketiga
										) as detail_simpananpihakketiga
									ON 
										simpananpihakketiga.id = detail_simpananpihakketiga.id_simpananpihakketiga
									GROUP BY
										nasabah.id
									ORDER BY
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