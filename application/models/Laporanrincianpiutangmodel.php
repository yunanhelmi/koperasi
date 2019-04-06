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
}

?>