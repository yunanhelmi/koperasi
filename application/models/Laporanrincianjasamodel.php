<?php

class LaporanRincianJasaModel extends CI_Model {
	function __construct() {
		parent::__construct();
	}

	function get_data($sampai) {
		$query = $this->db->query("
								SELECT 
									id_pinjaman as id_pinjaman_detail,
									COUNT(IF(jenis = 'Angsuran', 1, NULL)) as jumlah_angsuran,
									COUNT(IF(jenis = 'Pinjaman', 1, NULL)) as jumlah_pinjaman,
									SUM(IF(jenis = 'Angsuran', angsuran, 0)) as total_angsuran,
									SUM(IF(jenis = 'Pinjaman', total, 0)) as total_pinjaman,
									MAX(waktu) as waktu_terakhir_angsuran
								FROM 
									detail_angsuran
								WHERE 
									detail_angsuran.waktu <= '$sampai'
									AND detail_angsuran.status_post = '1'
								GROUP BY 
									id_pinjaman
								");
		$a = $query->result_array();
		return $a;
	}

	function get_data1($dari, $sampai) {
		$query = $this->db->query("
								SELECT
									nasabah.nama,
									nasabah.nomor_koperasi,
									nasabah.alamat,
									nasabah.kelurahan,
									nasabah.dusun,
									nasabah.rt,
									nasabah.rw,
									pinjaman.waktu as tanggal_pinjaman,
									pinjaman.id_nasabah,
									pinjaman.id as id_pinjaman,
									ds.jumlah_jasa,
									ds.jumlah_denda
								FROM 
									(
										SELECT 
											id_pinjaman,
											SUM(jasa) as jumlah_jasa,
											SUM(denda) as jumlah_denda
										FROM 
											detail_angsuran
										WHERE 
											detail_angsuran.jenis = 'Angsuran'
											AND detail_angsuran.waktu >= '$dari'
											AND detail_angsuran.waktu <= '$sampai'
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