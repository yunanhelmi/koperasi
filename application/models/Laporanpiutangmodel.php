<?php

class LaporanPiutangModel extends CI_Model {
	function __construct() {
		parent::__construct();
	}

	function get_data_piutang($dari, $sampai) {
		$query = $this->db->query("
								SELECT 
									pinjaman.*, nasabah.nama, nasabah.alamat, nasabah.kelurahan, nasabah.dusun, nasabah.rw, nasabah.rt, COUNT(detail_angsuran.id) as total_angsuran, SUM(detail_angsuran.angsuran) as total_jumlah_angsuran, MAX(detail_angsuran.waktu) as waktu_terakhir_angsuran
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
										AND detail_angsuran.status_post = '1'
										AND detail_angsuran.waktu >= '$dari'
										AND detail_angsuran.waktu <= '$sampai'
									ORDER BY
										detail_angsuran.waktu DESC) as detail_angsuran
								ON 
									pinjaman.id = detail_angsuran.id_pinjaman
								WHERE
									pinjaman.waktu <= '$sampai'
								GROUP BY 
									pinjaman.id
								");
		$a = $query->result_array();
		return $a;
	}
}

?>