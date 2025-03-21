<?php

class LaporanpiutangModel extends CI_Model {
	function __construct() {
		parent::__construct();
	}

	function get_data_piutang($tanggal) {
		/*$query = $this->db->query("
								SELECT 
									pinjaman.*, 
									nasabah.nama, 
									nasabah.alamat, 
									nasabah.kelurahan, 
									nasabah.dusun, 
									nasabah.rw, 
									nasabah.rt, 
									COUNT(detail_angsuran.id) as total_angsuran, 
									SUM(detail_angsuran.angsuran) as total_jumlah_angsuran, 
									MAX(detail_angsuran.waktu) as waktu_terakhir_angsuran
								FROM 
									pinjaman
									LEFT JOIN 
										nasabah 
									ON 
										pinjaman.id_nasabah = nasabah.id
								LEFT JOIN 
									(SELECT
								     	*
								     FROM
										detail_angsuran
									WHERE
										detail_angsuran.jenis = 'Angsuran'
									ORDER BY
										detail_angsuran.waktu DESC) as detail_angsuran
								ON 
									pinjaman.id = detail_angsuran.id_pinjaman
								WHERE
									pinjaman.waktu >= '$dari'
									AND pinjaman.waktu <= '$sampai'
								GROUP BY 
									pinjaman.id
								");*/
		$query = $this->db->query("
								SELECT
									pinjaman.*,
									nasabah.nama, 
									nasabah.alamat, 
									nasabah.kelurahan, 
									nasabah.dusun, 
									nasabah.rw, 
									nasabah.rt, 
									COUNT(IF(detail_angsuran.jenis = 'Angsuran', 1, NULL)) as jumlah_angsuran_detail,
									COUNT(IF(detail_angsuran.jenis = 'Pinjaman', 1, NULL)) as jumlah_pinjaman_detail,
									SUM(IF(detail_angsuran.jenis = 'Angsuran', detail_angsuran.angsuran, 0)) as total_angsuran_detail,
									SUM(IF(detail_angsuran.jenis = 'Pinjaman', detail_angsuran.total, 0)) as total_pinjaman_detail,
									MAX(detail_angsuran.waktu) as waktu_terakhir_angsuran
								FROM 
									pinjaman
									LEFT JOIN 
										nasabah 
									ON 
										pinjaman.id_nasabah = nasabah.id
								LEFT JOIN 
									(SELECT
								     	*
								     FROM
										detail_angsuran
									WHERE
										detail_angsuran.waktu <= '$tanggal'
										AND detail_angsuran.status_post = '1'
									ORDER BY
										detail_angsuran.waktu DESC) as detail_angsuran
								ON 
									pinjaman.id = detail_angsuran.id_pinjaman
								WHERE
									pinjaman.waktu <= '$tanggal'
									AND pinjaman.sisa_angsuran > 0
								GROUP BY 
									pinjaman.id
								");
		$a = $query->result_array();
		return $a;
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
									pinjaman.jenis_pinjaman,
									pinjaman.jaminan,
									pinjaman.waktu as tanggal_pinjaman,
									pinjaman.id_nasabah,
									pinjaman.jatuh_tempo,
									pinjaman.jumlah_angsuran,
									pinjaman.jumlah_pinjaman,
									pinjaman.angsuran_perbulan,
									pinjaman.uang_kurang,
									ds.jumlah_angsuran_detail,
									ds.jumlah_pinjaman_detail,
									ds.total_angsuran_detail,
									ds.total_pinjaman_detail,
									ds.total_jasa_detail,
									ds.waktu_terakhir_angsuran,
									ds.jasa_terakhir_angsuran,
									ds.bulanke_terakhir_angsuran,
									ds.bulan_tahun_terakhir_angsuran,
									dp.waktu as penagihan,
									dp.janji as janji,
									dp.followup as followup
								FROM 
									(
										SELECT 
											id_pinjaman,
											COUNT(CASE WHEN jenis = 'Angsuran' AND angsuran > 0 THEN 1 END) as jumlah_angsuran_detail,
											COUNT(IF(jenis = 'Pinjaman', 1, NULL)) as jumlah_pinjaman_detail,
											SUM(IF(jenis = 'Angsuran', angsuran, 0)) as total_angsuran_detail,
											SUM(IF(jenis = 'Pinjaman', total, 0)) as total_pinjaman_detail,
											SUM(CASE WHEN jenis = 'Angsuran' AND jasa > 0 THEN jasa ELSE 0 END) as total_jasa_detail,
											MAX(waktu) as waktu_terakhir_angsuran,
											MAX(jasa) as jasa_terakhir_angsuran,
											MAX(bulan_ke) as bulanke_terakhir_angsuran,
											MAX(bulan_tahun) as bulan_tahun_terakhir_angsuran
										FROM 
											detail_angsuran
										WHERE 
											detail_angsuran.waktu <= '$tanggal'
											AND detail_angsuran.status_post = '1'
										GROUP BY 
											id_pinjaman
									) as ds
									LEFT JOIN
										pinjaman
									ON
										ds.id_pinjaman = pinjaman.id
								LEFT JOIN
									nasabah 
								ON 
									pinjaman.id_nasabah = nasabah.id
								LEFT JOIN 
							    (
							        -- Subquery untuk mendapatkan baris terakhir dari detail_penagihan
							        SELECT dp1.*
							        FROM detail_penagihan dp1
							        WHERE dp1.waktu = (
							            SELECT MAX(dp2.waktu) 
							            FROM detail_penagihan dp2 
							            WHERE dp2.id_pinjaman = dp1.id_pinjaman
							        )
							    ) AS dp ON pinjaman.id = dp.id_pinjaman
								");
		$a = $query->result_array();
		return $a;
	}
}

?>
