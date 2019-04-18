<?php

class LaporanSimpananWajibModel extends CI_Model {
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
									simpananwajib.waktu,
									ds.jumlah_setoran_detail,
									ds.jumlah_tarikan_detail,
									ds.total_setoran_detail,
									ds.total_tarikan_detail
								FROM 
									(
										SELECT 
											id_simpananwajib,
											COUNT(IF(jenis = 'Setoran', 1, NULL)) as jumlah_setoran_detail,
											COUNT(IF(jenis = 'Tarikan', 1, NULL)) as jumlah_tarikan_detail,
											SUM(IF(jenis = 'Setoran', jumlah, 0)) as total_setoran_detail,
											SUM(IF(jenis = 'Tarikan', jumlah, 0)) as total_tarikan_detail
										FROM 
											detail_simpananwajib
										WHERE 
											detail_simpananwajib.waktu <= '$tanggal'
											AND detail_simpananwajib.status_post = '1'
										GROUP BY 
											id_simpananwajib
									) as ds
									LEFT JOIN
										simpananwajib
									ON
										ds.id_simpananwajib = simpananwajib.id
								LEFT JOIN
									nasabah 
								ON 
									simpananwajib.id_nasabah = nasabah.id 
									
								");
		$a = $query->result_array();
		return $a;
	}
}

?>