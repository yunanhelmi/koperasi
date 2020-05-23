<?php

class LaporanRincianPiutangModel extends CI_Model {
	function __construct() {
		parent::__construct();
	}

	function get_data_angsuran($dari, $sampai) {
		$query = $this->db->query("
								SELECT 
									SUM(detail_angsuran.angsuran) as jumlah_angsuran,
									SUM(detail_angsuran.jasa) as jumlah_jasa,
									SUM(detail_angsuran.denda) as jumlah_denda,
									detail_angsuran.id_pinjaman,
									pinjaman.nomor_nasabah,
									pinjaman.nik_nasabah,
									pinjaman.nama_nasabah
								FROM 
									detail_angsuran
								LEFT JOIN 
									pinjaman
								ON 
									detail_angsuran.id_pinjaman = pinjaman.id
								WHERE 
									detail_angsuran.waktu >= '$dari' 
									AND detail_angsuran.waktu <= '$sampai' 
									AND detail_angsuran.status_post = '1' 
									AND detail_angsuran.jenis = 'Angsuran'
								GROUP BY 
									id_pinjaman	
								");
		$a = $query->result_array();
		return $a;
	}

	function get_data_pinjaman($dari, $sampai) {
		$query = $this->db->query("
								SELECT 
									SUM(detail_angsuran.angsuran) as jumlah_angsuran,
									SUM(detail_angsuran.jasa) as jumlah_jasa,
									SUM(detail_angsuran.denda) as jumlah_denda,
									SUM(detail_angsuran.total) as jumlah_total,
									detail_angsuran.id_pinjaman,
									pinjaman.nomor_nasabah,
									pinjaman.nik_nasabah,
									pinjaman.nama_nasabah
								FROM 
									detail_angsuran
								LEFT JOIN 
									pinjaman
								ON 
									detail_angsuran.id_pinjaman = pinjaman.id
								WHERE 
									detail_angsuran.waktu >= '$dari' 
									AND detail_angsuran.waktu <= '$sampai' 
									AND detail_angsuran.status_post = '1' 
									AND detail_angsuran.jenis = 'Pinjaman'
								GROUP BY 
									id_pinjaman	
								");
		$a = $query->result_array();
		return $a;
	}

	function get_data($sampai) {
		$query = $this->db->query("
								SELECT 
									pinjaman.nama_nasabah,
									pinjaman.nomor_nasabah,
									detail_angsuran.id_pinjaman as id_pinjaman_detail,
									COUNT(IF(detail_angsuran.jenis = 'Angsuran', 1, NULL)) as jumlah_angsuran,
									COUNT(IF(detail_angsuran.jenis = 'Pinjaman', 1, NULL)) as jumlah_pinjaman,
									SUM(IF(detail_angsuran.jenis = 'Angsuran', angsuran, 0)) as total_angsuran,
									SUM(IF(detail_angsuran.jenis = 'Pinjaman', total, 0)) as total_pinjaman,
									MAX(detail_angsuran.waktu) as waktu_terakhir_angsuran
								FROM 
									detail_angsuran
								LEFT JOIN
									pinjaman
								ON 
									detail_angsuran.id_pinjaman = pinjaman.id
								WHERE 
									detail_angsuran.waktu <= '$sampai'
									AND detail_angsuran.status_post = '1'
								GROUP BY 
									id_pinjaman
								");
		$a = $query->result_array();
		return $a;
	}

	function get_data1($sampai) {
		$query = $this->db->query("
								SELECT
									nasabah.nama,
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
									pinjaman.angsuran_perbulan,
									ds.jumlah_angsuran_detail,
									ds.jumlah_pinjaman_detail,
									ds.total_angsuran_detail,
									ds.total_pinjaman_detail,
									ds.waktu_terakhir_angsuran
								FROM 
									(
										SELECT 
											id_pinjaman,
											COUNT(IF(jenis = 'Angsuran', 1, NULL)) as jumlah_angsuran_detail,
											COUNT(IF(jenis = 'Pinjaman', 1, NULL)) as jumlah_pinjaman_detail,
											SUM(IF(jenis = 'Angsuran', angsuran, 0)) as total_angsuran_detail,
											SUM(IF(jenis = 'Pinjaman', total, 0)) as total_pinjaman_detail,
											MAX(waktu) as waktu_terakhir_angsuran
										FROM 
											detail_angsuran
										WHERE 
											detail_angsuran.waktu <= '$sampai'
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
									
								");
		$a = $query->result_array();
		return $a;
	}
}

?>