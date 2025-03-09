<?php

class PinjamanModel extends CI_Model {
	function __construct() {
		parent::__construct();
	}

	function getNewId() {
		$query = $this->db->query("SELECT MAX(id) as new_id from `pinjaman`");
		$a = $query->row();
		if($a->new_id == NULL) {
			return 1;
		} else {
			return $a->new_id + 1;
		}
	}

	function get_pinjaman_by_id($id) {
		$query = $this->db->query("
									SELECT pinjaman.*, nasabah.alamat, nasabah.kota, nasabah.kecamatan, nasabah.kelurahan, nasabah.dusun 
									FROM `pinjaman`
									INNER JOIN nasabah ON pinjaman.id_nasabah = nasabah.id 
									WHERE pinjaman.id = '$id'");
		$a = $query->row();
		return $a;
	}

	function get_pinjaman_by_id_nasabah($id_nasabah) {
		//$query = $this->db->query("SELECT * from `pinjaman` WHERE id_nasabah = '$id_nasabah' ORDER BY id DESC");
		$query = $this->db->query("
									SELECT 
										p.*, 
										COUNT(CASE WHEN d.status_angsuran = 'Hijau' THEN 1 END) AS jumlah_hijau,
										COUNT(CASE WHEN d.status_angsuran = 'Hijau Tempo' THEN 1 END) AS jumlah_hijau_tempo,
										COUNT(CASE WHEN d.status_angsuran = 'Kuning 1' THEN 1 END) AS jumlah_hijau_kuning1,
										COUNT(CASE WHEN d.status_angsuran = 'Kuning 2' THEN 1 END) AS jumlah_hijau_kuning2,
										COUNT(CASE WHEN d.status_angsuran = 'Merah' THEN 1 END) AS jumlah_hijau_merah
									FROM 
										pinjaman p
									LEFT JOIN 
										detail_angsuran d ON p.id = d.id_pinjaman
									WHERE 
										p.id_nasabah = '$id_nasabah'
									GROUP BY 
										p.id, p.id_nasabah
									ORDER BY 
										p.id DESC;
			");
		$a = $query->result_array();
		return $a;
	}

	function update_sisa_angsuran($id, $sisa_angsuran) {
		$this->db->query("UPDATE `pinjaman` SET sisa_angsuran = '$sisa_angsuran' WHERE id = '$id'");
	}

	function update_angsuran_perbulan($id, $angsuran_perbulan) {
		$this->db->query("UPDATE `pinjaman` SET angsuran_perbulan = '$angsuran_perbulan' WHERE id = '$id'");
	}

	function update_jumlah_pinjaman($id, $jumlah_pinjaman) {
		$this->db->query("UPDATE `pinjaman` SET jumlah_pinjaman = '$jumlah_pinjaman' WHERE id = '$id'");
	}

	function update_jasa_total_angsuran_perbulan($id, $jasa, $total) {
		$this->db->query("UPDATE `pinjaman` SET jasa_perbulan = '$jasa', total_angsuran_perbulan = '$total' WHERE id = '$id'");
	}

	function update_jatuh_tempo($id, $jatuh_tempo) {
		$this->db->query("UPDATE `pinjaman` SET jatuh_tempo = '$jatuh_tempo' WHERE id = '$id'");
	}

	function update_jaminan($id, $jaminan) {
		$this->db->query("UPDATE `pinjaman` SET jaminan = '$jaminan' WHERE id = '$id'");
	}

	function get_data_laporan_harian($tanggal) {
		$query = $this->db->query("
									SELECT 
										detail_angsuran.*, 
										pinjaman.nama_nasabah,
										pinjaman.nomor_nasabah,
										pinjaman.nik_nasabah,
										pinjaman.id_nasabah,
										nasabah.alamat,
										nasabah.kota,
										nasabah.kecamatan,
										nasabah.kelurahan,
										nasabah.dusun,
										nasabah.rw,
										nasabah.rt
									FROM 
										detail_angsuran
										LEFT JOIN
											pinjaman
										ON 
											detail_angsuran.id_pinjaman = pinjaman.id
									LEFT JOIN
										nasabah
									ON
										pinjaman.id_nasabah = nasabah.id
									WHERE
										detail_angsuran.waktu = '$tanggal'
									ORDER BY
										detail_angsuran.id
								");
		$a = $query->result_array();
		return $a;
	}

	function get_data_penerimaan_surat_by_id_nasabah($id_nasabah) {
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
										ds.jumlah_angsuran_detail,
										ds.jumlah_jasa_detail,
										ds.jumlah_pinjaman_detail,
										ds.total_angsuran_detail,
										ds.total_pinjaman_detail,
										ds.total_jasa_detail,
										ds.waktu_terakhir_angsuran
									FROM 
										(
											SELECT 
												id_pinjaman,
												COUNT(CASE WHEN jenis = 'Angsuran' AND angsuran > 0 THEN 1 END) as jumlah_angsuran_detail,
												COUNT(IF(jenis = 'Pinjaman', 1, NULL)) as jumlah_pinjaman_detail,
												COUNT(CASE WHEN jenis = 'Angsuran' AND jasa > 0 THEN 1 END) as jumlah_jasa_detail,
												SUM(IF(jenis = 'Angsuran', angsuran, 0)) as total_angsuran_detail,
												SUM(IF(jenis = 'Pinjaman', total, 0)) as total_pinjaman_detail,
												SUM(CASE WHEN jenis = 'Angsuran' AND jasa > 0 THEN jasa ELSE 0 END) as total_jasa_detail,
												MAX(waktu) as waktu_terakhir_angsuran
											FROM 
												detail_angsuran
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
										pinjaman.id_nasabah = '$id_nasabah'
									ORDER BY 
										nasabah.kelurahan
								");
		$a = $query->result_array();
		return $a;
	}

	function showData() {
		$query = $this->db->query("SELECT * from `pinjaman`");
		$a = $query->result_array();
		return $a;
	}

	function inputData($data) {
		$this->db->insert("pinjaman",$data);
	}

	function updateData($id, $data) {
		$this->db->where('id', $id);
		$this->db->update('pinjaman', $data);
	}

	function deleteData($id) {
		$this->db->where('id', $id);
		$this->db->delete('pinjaman');
	}

	function delete_by_id_nasabah($id_nasabah) {
		$this->db->query("DELETE FROM `pinjaman` WHERE id_nasabah = '$id_nasabah'");	
	}
}

?>