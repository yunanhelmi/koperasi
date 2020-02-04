<?php

class CekLaporanRincianJasamodel extends CI_Model {
	function __construct() {
		parent::__construct();
	}

	function getTransaksiAKuntansi($dari, $sampai) {
		$query = $this->db->query("
									SELECT 
										* 
									FROM 
										`transaksi_akuntansi` 
									WHERE 
										`tanggal` >= '$dari'
										AND `tanggal` <= '$sampai' 
										AND kode_akun = '401'
								");
		$a = $query->result_array();
		return $a;
	}

	function getDetailAngsuran($dari, $sampai) {
		$query = $this->db->query("
									SELECT 
										*, 
										jasa + denda as pendapatan_jasa
									FROM 
										`detail_angsuran` 
									WHERE 
										waktu >= '$dari' 
										AND waktu <= '$sampai' 
										AND jenis = 'Angsuran' 
										AND status_post = '1'
								");
		$a = $query->result_array();
		return $a;	
	}

	function getSumTransaksiAKuntansi($dari, $sampai) {
		$query = $this->db->query("
									SELECT 
										SUM(kredit) as total_kredit,
										SUM(debet) as total_debet,
										SUM(kredit - debet) as selisih
									FROM 
										`transaksi_akuntansi` 
									WHERE 
										`tanggal` >= '$dari'
										AND `tanggal` <= '$sampai' 
										AND kode_akun = '401'
								");
		$a = $query->result_array();
		return $a;	
	}

	function getSumDetailAngsuran($dari, $sampai) {
		$query = $this->db->query("
									SELECT  
										SUM(jasa) as jasa,
										SUM(denda) as denda
									FROM 
										`detail_angsuran` 
									WHERE 
										waktu >= '$dari' 
										AND waktu <= '$sampai' 
										AND jenis = 'Angsuran' 
										AND status_post = '1'
										AND jenis = 'Angsuran'
									GROUP BY
										id_pinjaman
								");
		$a = $query->result_array();
		return $a;	
	}

	function getPiutang() {
		$query = $this->db->query("
									SELECT
										pinjaman.*,
										ds.total_angsuran_detail,
										ds.total_pinjaman_detail
									FROM 
										(
											SELECT 
												id_pinjaman,
												SUM(IF(jenis = 'Angsuran', angsuran, 0)) as total_angsuran_detail,
												SUM(IF(jenis = 'Pinjaman', total, 0)) as total_pinjaman_detail
											FROM 
												detail_angsuran
											GROUP BY 
												id_pinjaman
										) as ds
									LEFT JOIN
										pinjaman
									ON
										ds.id_pinjaman = pinjaman.id
								");
		$a = $query->result_array();
		return $a;	
	}
}

?>