<?php

class LaporanSimpananDanaSosialModel extends CI_Model {
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
									simpanandanasosial.waktu,
									ds.jumlah_setoran_detail,
									ds.jumlah_tarikan_detail,
									ds.total_setoran_detail,
									ds.total_tarikan_detail
								FROM 
									(
										SELECT 
											id_simpanandanasosial,
											COUNT(IF(jenis = 'Setoran', 1, NULL)) as jumlah_setoran_detail,
											COUNT(IF(jenis = 'Tarikan', 1, NULL)) as jumlah_tarikan_detail,
											SUM(IF(jenis = 'Setoran', jumlah, 0)) as total_setoran_detail,
											SUM(IF(jenis = 'Tarikan', jumlah, 0)) as total_tarikan_detail
										FROM 
											detail_simpanandanasosial
										WHERE 
											detail_simpanandanasosial.waktu <= '$tanggal'
											AND detail_simpanandanasosial.status_post = '1'
										GROUP BY 
											id_simpanandanasosial
									) as ds
									LEFT JOIN
										simpanandanasosial
									ON
										ds.id_simpanandanasosial = simpanandanasosial.id
								LEFT JOIN
									nasabah 
								ON 
									simpanandanasosial.id_nasabah = nasabah.id 
									
								");
		$a = $query->result_array();
		return $a;
	}
}

?>