<?php

class CeksimpanankhususModel extends CI_Model {
	function cekTotal() {
		$query = $this->db->query("
									SELECT
										simpanankhusus.*,
										ds.total_setoran_detail,
										ds.total_tarikan_detail
									FROM 
										(
											SELECT 
												id_simpanankhusus,
												SUM(IF(jenis = 'Setoran', jumlah, 0)) as total_setoran_detail,
												SUM(IF(jenis = 'Tarikan', jumlah, 0)) as total_tarikan_detail
											FROM 
												detail_simpanankhusus
											GROUP BY 
												id_simpanankhusus
										) as ds
									LEFT JOIN
										simpanankhusus
									ON
										ds.id_simpanankhusus = simpanankhusus.id
								");
		$a = $query->result_array();
		return $a;	
	}

	function updateTotal($id, $total) {
		$this->db->query("UPDATE `simpanankhusus` SET total = '$total' WHERE id = '$id'");
	}
}

?>
