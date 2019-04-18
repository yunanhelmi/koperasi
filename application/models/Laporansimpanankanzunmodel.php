<?php

class LaporanSimpananKanzunModel extends CI_Model {
	function __construct() {
		parent::__construct();
	}

	function get_data($tanggal) {
		$query = $this->db->query("
								SELECT
									nasabah.nama,
									nasabah.alamat,
									nasabah.kelurahan,
									nasabah.dusun,
									nasabah.rt,
									nasabah.rw,
									simpanankanzun.waktu,
									ds.jumlah_setoran_detail,
									ds.jumlah_tarikan_detail,
									ds.total_setoran_detail,
									ds.total_tarikan_detail
								FROM 
									(
										SELECT 
											id_simpanankanzun,
											COUNT(IF(jenis = 'Setoran', 1, NULL)) as jumlah_setoran_detail,
											COUNT(IF(jenis = 'Tarikan', 1, NULL)) as jumlah_tarikan_detail,
											SUM(IF(jenis = 'Setoran', jumlah, 0)) as total_setoran_detail,
											SUM(IF(jenis = 'Tarikan', jumlah, 0)) as total_tarikan_detail
										FROM 
											detail_simpanankanzun
										WHERE 
											detail_simpanankanzun.waktu <= '$tanggal'
											AND detail_simpanankanzun.status_post = '1'
										GROUP BY 
											id_simpanankanzun
									) as ds
									LEFT JOIN
										simpanankanzun
									ON
										ds.id_simpanankanzun = simpanankanzun.id
								LEFT JOIN
									nasabah 
								ON 
									simpanankanzun.id_nasabah = nasabah.id 
									
								");
		$a = $query->result_array();
		return $a;
	}
}

?>