<?php

class LaporanSimpanan3thModel extends CI_Model {
	function __construct() {
		parent::__construct();
	}

	function get_data_simpanan3th($id_master, $tanggal) {
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
									ds.jumlah_setoran_detail,
									ds.jumlah_tarikan_detail,
									ds.total_setoran_detail,
									ds.total_tarikan_detail
								FROM 
									simpanan3th
									INNER JOIN
										(
											SELECT 
											id_simpanan3th,
											COUNT(IF(jenis = 'Setoran', 1, NULL)) as jumlah_setoran_detail,
											COUNT(IF(jenis = 'Tarikan', 1, NULL)) as jumlah_tarikan_detail,
											SUM(IF(jenis = 'Setoran', jumlah, 0)) as total_setoran_detail,
											SUM(IF(jenis = 'Tarikan', jumlah, 0)) as total_tarikan_detail
										FROM 
											detail_simpanan3th
										WHERE 
											detail_simpanan3th.waktu <= '$tanggal'
											AND detail_simpanan3th.status_post = '1'
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