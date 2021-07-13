<?php

class PenerimaansuratModel extends CI_Model {
	function __construct() {
		parent::__construct();
	}

	function getNewId() {
		$query = $this->db->query("SELECT MAX(id) as new_id from `penerimaan_surat`");
		$a = $query->row();
		if($a->new_id == NULL) {
			return 1;
		} else {
			return $a->new_id + 1;
		}
	}

	function get_data_by_id($id) {
		$query = $this->db->query("
									SELECT 
										penerimaan_surat.id as id,
										penerimaan_surat.tanggal as tanggal,
										penerimaan_surat.id_petugas_lapangan as id_petugas_lapangan,
										petugas_lapangan.nama as nama_petugas_lapangan,
										petugas_lapangan.nik as nik_petugas_lapangan,
										petugas_lapangan.tgl_lahir as tgl_lahir_petugas_lapangan
									FROM 
										`penerimaan_surat`
										LEFT JOIN
											petugas_lapangan
										ON
											penerimaan_surat.id_petugas_lapangan = petugas_lapangan.id
									WHERE penerimaan_surat.id = '$id'
								");
		$a = $query->row();
		return $a;
	}

	function get_penerimaan_surat_by_id_petugas_lapangan($id_petugas_lapangan) {
		$query = $this->db->query("
									SELECT 
										penerimaan_surat.id as id,
										penerimaan_surat.tanggal as tanggal,
										penerimaan_surat.id_petugas_lapangan as id_petugas_lapangan,
										petugas_lapangan.nama as nama_petugas_lapangan,
										petugas_lapangan.nik as nik_petugas_lapangan,
										petugas_lapangan.tgl_lahir as tgl_lahir_petugas_lapangan
									FROM 
										`penerimaan_surat`
										LEFT JOIN
											petugas_lapangan
										ON
											penerimaan_surat.id_petugas_lapangan = petugas_lapangan.id
									WHERE penerimaan_surat.id_petugas_lapangan = '$id_petugas_lapangan'
								");
		$a = $query->result_array();
		return $a;
	}

	function showData() {
		$query = $this->db->query("
									SELECT 
										penerimaan_surat.id as id,
										penerimaan_surat.tanggal as tanggal,
										penerimaan_surat.id_petugas_lapangan as id_petugas_lapangan,
										petugas_lapangan.nama as nama_petugas_lapangan,
										petugas_lapangan.nik as nik_petugas_lapangan,
										petugas_lapangan.tgl_lahir as tgl_lahir_petugas_lapangan
									FROM 
										`penerimaan_surat`
										LEFT JOIN
											petugas_lapangan
										ON
											penerimaan_surat.id_petugas_lapangan = petugas_lapangan.id
								");
		$a = $query->result_array();
		return $a;
	}

	function inputData($data) {
		$this->db->insert("penerimaan_surat",$data);
	}

	function updateData($id, $data) {
		$this->db->where('id', $id);
		$this->db->update('penerimaan_surat', $data);
	}

	function deleteData($id) {
		$this->db->where('id', $id);
		$this->db->delete('penerimaan_surat');
	}

	function delete_by_id_petugas_lapangan($id_petugas_lapangan) {
		$this->db->query("DELETE FROM `penerimaan_surat` WHERE id_petugas_lapangan = '$id_petugas_lapangan'");	
	}
}

?>