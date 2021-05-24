<?php

class SurattagihanModel extends CI_Model {
	function __construct() {
		parent::__construct();
	}

	function get_data($tanggal, $jenis_pinjaman) {
		$query = $this->db->query("
								SELECT
									nasabah.nama,
									nasabah.nomor_koperasi,
									nasabah.alamat,
									nasabah.kelurahan,
									nasabah.dusun,
									nasabah.rt,
									nasabah.rw,
									pinjaman.id as id_pinjaman,
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
								WHERE
									pinjaman.jenis_pinjaman = '$jenis_pinjaman'
								ORDER BY 
									nasabah.kelurahan
								");
		$a = $query->result_array();
		return $a;
	}

	function get_data_surat_tagihan($tanggal, $id_pinjaman) {
		$query = $this->db->query("
								SELECT
									nasabah.nama,
									nasabah.nomor_koperasi,
									nasabah.alamat,
									nasabah.kelurahan,
									nasabah.dusun,
									nasabah.rt,
									nasabah.rw,
									pinjaman.id as id_pinjaman,
									pinjaman.jenis_pinjaman,
									pinjaman.jaminan,
									pinjaman.waktu as tanggal_pinjaman,
									pinjaman.id_nasabah,
									pinjaman.jatuh_tempo,
									pinjaman.jumlah_angsuran,
									pinjaman.jumlah_pinjaman,
									pinjaman.angsuran_perbulan,
									pinjaman.jasa_perbulan,
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
								WHERE
									pinjaman.id = '$id_pinjaman' 
									
								");
		$a = $query->result_array();
		return $a;	
	}
}

?>