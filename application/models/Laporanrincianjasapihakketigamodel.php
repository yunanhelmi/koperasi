<?php

class LaporanrincianjasapihakketigaModel extends CI_Model {
	function __construct() {
		parent::__construct();
	}

	function get_data($dari, $sampai) {
		$query = $this->db->query("
								SELECT
									nasabah.nama,
									nasabah.nomor_koperasi,
									nasabah.alamat,
									nasabah.kelurahan,
									nasabah.dusun,
									nasabah.rt,
									nasabah.rw,
									simpananpihakketiga.waktu as tanggal_simpananpihakketiga,
									simpananpihakketiga.id_nasabah,
									simpananpihakketiga.id as id_simpananpihakketiga,
									ds.total_penyesuaian_jasa,
									ds.total_pencairan_hutang_jasa
								FROM 
									(
										SELECT 
											id_simpananpihakketiga,
											SUM(IF(jenis = 'Penyesuaian Jasa', jumlah, jumlah)) as total_penyesuaian_jasa,
											SUM(IF(jenis = 'Pencairan Hutang Jasa', jumlah, jumlah)) as total_pencairan_hutang_jasa
										FROM 
											detail_simpananpihakketiga
										WHERE 
											detail_simpananpihakketiga.waktu >= '$dari'
											AND detail_simpananpihakketiga.waktu <= '$sampai'
											AND detail_simpananpihakketiga.status_post = '1'
										GROUP BY 
											id_simpananpihakketiga
									) as ds
									LEFT JOIN
										simpananpihakketiga
									ON
										ds.id_simpananpihakketiga = simpananpihakketiga.id
								LEFT JOIN
									nasabah 
								ON 
									simpananpihakketiga.id_nasabah = nasabah.id 
									
								");
		$a = $query->result_array();
		return $a;
	}
}

?>