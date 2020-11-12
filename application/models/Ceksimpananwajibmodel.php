<?php

class CeksimpananwajibModel extends CI_Model {
	function cekTotal() {
		$query = $this->db->query("
									SELECT
										simpananwajib.*,
										ds.total_setoran_detail,
										ds.total_tarikan_detail
									FROM 
										(
											SELECT 
												id_simpananwajib,
												SUM(IF(jenis = 'Setoran', jumlah, 0)) as total_setoran_detail,
												SUM(IF(jenis = 'Tarikan', jumlah, 0)) as total_tarikan_detail
											FROM 
												detail_simpananwajib
											GROUP BY 
												id_simpananwajib
										) as ds
									LEFT JOIN
										simpananwajib
									ON
										ds.id_simpananwajib = simpananwajib.id
								");
		$a = $query->result_array();
		return $a;	
	}

	function updateTotal($id, $total) {
		$this->db->query("UPDATE `simpananwajib` SET total = '$total' WHERE id = '$id'");
	}
}

?>
