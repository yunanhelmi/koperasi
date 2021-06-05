<?php

class Laporanrincianjasasimpanan3thModel extends CI_Model {
	function __construct() {
		parent::__construct();
	}

	function get_data_jasa_simpanan3th($id_master, $tanggal) {
		$query = $this->db->query("
								SELECT
									nasabah.nama,
									nasabah.nomor_koperasi,
									nasabah.alamat,
									nasabah.kelurahan,
									nasabah.dusun,
									nasabah.rt,
									nasabah.rw,
									simpanan3th.waktu,
									ds.total_penyesuaian_jasa,
									ds.total_pencairan_hutang_jasa
								FROM 
									simpanan3th
									INNER JOIN
										(
											SELECT 
											id_simpanan3th,
											SUM(IF(jenis = 'Penyesuaian Jasa', jumlah, 0)) as total_penyesuaian_jasa,
											SUM(IF(jenis = 'Pencairan Hutang Jasa', jumlah, 0)) as total_pencairan_hutang_jasa
										FROM 
											detail_jasa_simpanan3th
										WHERE 
											detail_jasa_simpanan3th.waktu <= '$tanggal'
											AND detail_jasa_simpanan3th.status_post = '1'
										GROUP BY 
											id_simpanan3th
										) as ds
									ON 
										ds.id_simpanan3th = simpanan3th.id
										AND simpanan3th.id_master = '$id_master'
								LEFT JOIN
									nasabah 
								ON 
									simpanan3th.id_nasabah = nasabah.id 
								");
		$a = $query->result_array();
		return $a;
	}
}

?>
