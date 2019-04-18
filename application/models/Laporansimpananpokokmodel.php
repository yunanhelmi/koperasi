<?php

class LaporanSimpananPokokModel extends CI_Model {
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
									nasabah.rw, 
									nasabah.rt, 
								    simpananpokok.*,
									COUNT(IF(simpananpokok.jenis = 'Setoran', 1, NULL)) as jumlah_setoran,
									COUNT(IF(simpananpokok.jenis = 'Tarikan', 1, NULL)) as jumlah_tarikan,
									SUM(IF(simpananpokok.jenis = 'Setoran', simpananpokok.jumlah, 0)) as total_setoran,
									SUM(IF(simpananpokok.jenis = 'Tarikan', simpananpokok.jumlah, 0)) as total_tarikan
								FROM 
									simpananpokok
									LEFT JOIN 
										nasabah 
									ON 
										simpananpokok.id_nasabah = nasabah.id
								WHERE
									simpananpokok.waktu <= '$tanggal'
									AND simpananpokok.nomor_nasabah LIKE '1%'
									AND simpananpokok.status_post = '1'
								GROUP BY
									simpananpokok.id_nasabah	
								ORDER BY
									simpananpokok.waktu DESC
								");
		$a = $query->result_array();
		return $a;
	}
}

?>