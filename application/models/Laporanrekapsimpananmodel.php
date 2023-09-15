<?php

class LaporanrekapsimpananModel extends CI_Model {
	function __construct() {
		parent::__construct();
	}

	function get_data($tanggal) {
		$query = $this->db->query("
								SELECT
									nasabah.nama,
									nasabah.nomor_koperasi,
									nasabah.kelurahan,
									simpanan_pokok.total_setoran as simpananpokok_total_setoran,
									simpanan_pokok.total_tarikan as simpananpokok_total_tarikan,
									simpanan_wajib.total_setoran as simpananwajib_total_setoran,
									simpanan_wajib.total_tarikan as simpananwajib_total_tarikan,
									simpanan_khusus.total_setoran as simpanankhusus_total_setoran,
									simpanan_khusus.total_tarikan as simpanankhusus_total_tarikan,
									rincian_jasa.total_jasa as rincianjasa_total_jasa,
									rincian_jasa.total_denda as rincianjasa_total_denda,
									simpanan_3th.total_setoran as simpanan3th_total_setoran,
									simpanan_3th.total_tarikan as simpanan3th_total_tarikan
								FROM 
									nasabah
								LEFT JOIN
									(
										SELECT 
											simpananpokok.id_nasabah,
											SUM(IF(simpananpokok.jenis = 'Setoran', simpananpokok.jumlah, 0)) as total_setoran,
											SUM(IF(simpananpokok.jenis = 'Tarikan', simpananpokok.jumlah, 0)) as total_tarikan
										FROM 
											simpananpokok
										WHERE
											simpananpokok.waktu <= '$tanggal'
											AND simpananpokok.status_post = '1'
										GROUP BY
											simpananpokok.id_nasabah
									) as simpanan_pokok
								ON
									nasabah.id = simpanan_pokok.id_nasabah

								LEFT JOIN
									(
										SELECT 
											simpananwajib.id_nasabah,
											SUM(ds.total_setoran_detail) as total_setoran,
											SUM(ds.total_tarikan_detail) as total_tarikan
										FROM 
											(
												SELECT 
													detail_simpananwajib.id_simpananwajib as id_simpananwajib,
													SUM(IF(detail_simpananwajib.jenis = 'Setoran', jumlah, 0)) as total_setoran_detail,
													SUM(IF(detail_simpananwajib.jenis = 'Tarikan', jumlah, 0)) as total_tarikan_detail
												FROM 
													detail_simpananwajib
												WHERE 
													detail_simpananwajib.waktu <= '$tanggal'
													AND detail_simpananwajib.status_post = '1'
												GROUP BY 
													detail_simpananwajib.id_simpananwajib
											) as ds
										LEFT JOIN
											simpananwajib
										ON
											ds.id_simpananwajib = simpananwajib.id
										GROUP BY 
											simpananwajib.id_nasabah
									) as simpanan_wajib
								ON
									nasabah.id = simpanan_wajib.id_nasabah

								LEFT JOIN
									(
										SELECT 
											simpanankhusus.id_nasabah,
											SUM(ds.total_setoran_detail) as total_setoran,
											SUM(ds.total_tarikan_detail) as total_tarikan
										FROM 
											(
												SELECT 
													detail_simpanankhusus.id_simpanankhusus as id_simpanankhusus,
													SUM(IF(detail_simpanankhusus.jenis = 'Setoran', jumlah, 0)) as total_setoran_detail,
													SUM(IF(detail_simpanankhusus.jenis = 'Tarikan', jumlah, 0)) as total_tarikan_detail
												FROM 
													detail_simpanankhusus
												WHERE 
													detail_simpanankhusus.waktu <= '$tanggal'
													AND detail_simpanankhusus.status_post = '1'
												GROUP BY 
													detail_simpanankhusus.id_simpanankhusus
											) as ds
										LEFT JOIN
											simpanankhusus
										ON
											ds.id_simpanankhusus = simpanankhusus.id
										GROUP BY 
											simpanankhusus.id_nasabah
									) as simpanan_khusus
								ON
									nasabah.id = simpanan_khusus.id_nasabah

								LEFT JOIN
									(
										SELECT
											pinjaman.id_nasabah,
											SUM(ds.jumlah_jasa) as total_jasa,
											SUM(ds.jumlah_denda) as total_denda
										FROM 
											(
												SELECT 
													detail_angsuran.id_pinjaman,
													SUM(detail_angsuran.jasa) as jumlah_jasa,
													SUM(detail_angsuran.denda) as jumlah_denda
												FROM 
													detail_angsuran
												WHERE 
													detail_angsuran.jenis = 'Angsuran'
													AND detail_angsuran.waktu <= '$tanggal'
													AND detail_angsuran.status_post = '1'
												GROUP BY 
													detail_angsuran.id_pinjaman
											) as ds
										LEFT JOIN
											pinjaman
										ON
											ds.id_pinjaman = pinjaman.id
										GROUP BY
											pinjaman.id_nasabah
									) as rincian_jasa
								ON
									nasabah.id = rincian_jasa.id_nasabah

								LEFT JOIN
									(
										SELECT 
											simpanan3th.id_nasabah,
											SUM(ds.total_setoran_detail) as total_setoran,
											SUM(ds.total_tarikan_detail) as total_tarikan
										FROM 
											(
												SELECT 
													detail_simpanan3th.id_simpanan3th as id_simpanan3th,
													SUM(IF(detail_simpanan3th.jenis = 'Setoran', jumlah, 0)) as total_setoran_detail,
													SUM(IF(detail_simpanan3th.jenis = 'Tarikan', jumlah, 0)) as total_tarikan_detail
												FROM 
													detail_simpanan3th
												WHERE 
													detail_simpanan3th.waktu <= '$tanggal'
													AND detail_simpanan3th.status_post = '1'
												GROUP BY 
													detail_simpanan3th.id_simpanan3th
											) as ds
										LEFT JOIN
											simpanan3th
										ON
											ds.id_simpanan3th = simpanan3th.id
										GROUP BY 
											simpanan3th.id_nasabah
									) as simpanan_3th
								ON
									nasabah.id = simpanan_3th.id_nasabah
								");
		$a = $query->result_array();
		return $a;
	}
}

?>