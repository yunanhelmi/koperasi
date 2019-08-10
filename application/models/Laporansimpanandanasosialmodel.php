<?php

class LaporanSimpananDanaSosialModel extends CI_Model {
	function __construct() {
		parent::__construct();
	}

	function get_data_dansos($tanggal) {
		$query = $this->db->query("
								SELECT
									nasabah.nama,
									nasabah.alamat,
									nasabah.kelurahan,
									nasabah.dusun,
									nasabah.rt,
									nasabah.rw,
									simpanandanasosial.nomor_nasabah,
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
								WHERE
									simpanandanasosial.nomor_nasabah LIKE '1%'
									
								");
		$a = $query->result_array();
		return $a;
	}

	function get_data_dansos_dari_sampai($dari, $sampai) {
		$query = $this->db->query("
								SELECT
									nasabah.nama, 
									nasabah.alamat, 
									nasabah.kelurahan, 
									nasabah.dusun, 
									nasabah.rw, 
									nasabah.rt, 
									simpanandanasosial.nomor_nasabah,
									simpanandanasosial.waktu,
									COUNT(IF(detail_simpanandanasosial.jenis = 'Setoran', 1, NULL)) as jumlah_setoran_detail,
									COUNT(IF(detail_simpanandanasosial.jenis = 'Tarikan', 1, NULL)) as jumlah_tarikan_detail,
									SUM(IF(detail_simpanandanasosial.jenis = 'Setoran', detail_simpanandanasosial.jumlah, 0)) as total_setoran_detail,
									SUM(IF(detail_simpanandanasosial.jenis = 'Tarikan', detail_simpanandanasosial.jumlah, 0)) as total_tarikan_detail
								FROM 
									simpanandanasosial
									LEFT JOIN 
										nasabah 
									ON 
										simpanandanasosial.id_nasabah = nasabah.id
								LEFT JOIN 
									(SELECT
								     	*
								     FROM
										detail_simpanandanasosial
									WHERE
										detail_simpanandanasosial.waktu >= '$dari'
										AND detail_simpanandanasosial.waktu <= '$sampai'
										AND detail_simpanandanasosial.status_post = '1'
									ORDER BY
										detail_simpanandanasosial.waktu DESC) as detail_simpanandanasosial
								ON 
									simpanandanasosial.id = detail_simpanandanasosial.id_simpanandanasosial
								WHERE
									simpanandanasosial.waktu >= '$dari'
									AND simpanandanasosial.waktu <= '$sampai'
									AND simpanandanasosial.nomor_nasabah LIKE '1%'
								GROUP BY 
									simpanandanasosial.id
								");
		$a = $query->result_array();
		return $a;
	}

	function get_data_dansos_istimewa($tanggal) {
		$query = $this->db->query("
								SELECT
									nasabah.nama,
									nasabah.alamat,
									nasabah.kelurahan,
									nasabah.dusun,
									nasabah.rt,
									nasabah.rw,
									simpanandanasosial.nomor_nasabah,
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
								WHERE
									simpanandanasosial.nomor_nasabah LIKE '2%'
									
								");
		$a = $query->result_array();
		return $a;
	}

	function get_data_dansos_istimewa_dari_sampai($dari, $sampai) {
		$query = $this->db->query("
								SELECT
									nasabah.nama,
									nasabah.alamat,
									nasabah.kelurahan,
									nasabah.dusun,
									nasabah.rt,
									nasabah.rw,
									simpanandanasosial.nomor_nasabah,
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
											detail_simpanandanasosial.waktu >= '$dari'
											AND detail_simpanandanasosial.waktu <= '$sampai'
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
								WHERE
									simpanandanasosial.nomor_nasabah LIKE '2%'
									
								");
		$a = $query->result_array();
		return $a;
	}
}

?>