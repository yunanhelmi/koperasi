<?php

class LaporansimpananpihakketigaModel extends CI_Model {
	function __construct() {
		parent::__construct();
	}

	function get_data($tanggal) {
		$query = $this->db->query("
								SELECT
									nasabah.nama,
									nasabah.nomor_koperasi,
									nasabah.alamat,
									nasabah.kelurahan,
									nasabah.dusun,
									nasabah.rt,
									nasabah.rw,
									simpananpihakketiga.waktu,
									ds.jumlah_setoran_detail,
									ds.jumlah_tarikan_detail,
									ds.total_setoran_detail,
									ds.total_tarikan_detail
								FROM 
									(
										SELECT 
											id_simpananpihakketiga,
											COUNT(IF(jenis = 'Setoran', 1, NULL)) as jumlah_setoran_detail,
											COUNT(IF(jenis = 'Tarikan', 1, NULL)) as jumlah_tarikan_detail,
											SUM(IF(jenis = 'Setoran', jumlah, 0)) as total_setoran_detail,
											SUM(IF(jenis = 'Tarikan', jumlah, 0)) as total_tarikan_detail
										FROM 
											detail_simpananpihakketiga
										WHERE 
											detail_simpananpihakketiga.waktu <= '$tanggal'
											AND detail_simpananpihakketiga.status_post = '1'
										GROUP BY 
											id_simpananpihakketiga
									) as ds
									LEFT JOIN
										simpananpihakketiga
									ON
										ds.id_simpananpihakketiga = simpananpihakketiga.id
								LEFT JOIN
									nasabah 
								ON 
									simpananpihakketiga.id_nasabah = nasabah.id 
									
								");
		$a = $query->result_array();
		return $a;
	}
}

?>
