<?php

class CeksimpananpensiunModel extends CI_Model {
	function cekTotal() {
		$query = $this->db->query("
									SELECT
										simpananpensiun.*,
										ds.total_setoran_detail,
										ds.total_tarikan_detail
									FROM 
										(
											SELECT 
												id_simpananpensiun,
												SUM(IF(jenis = 'Setoran', jumlah, 0)) as total_setoran_detail,
												SUM(IF(jenis = 'Tarikan', jumlah, 0)) as total_tarikan_detail
											FROM 
												detail_simpananpensiun
											GROUP BY 
												id_simpananpensiun
										) as ds
									LEFT JOIN
										simpananpensiun
									ON
										ds.id_simpananpensiun = simpananpensiun.id
								");
		$a = $query->result_array();
		return $a;	
	}

	function updateTotal($id, $total) {
		$this->db->query("UPDATE `simpananpensiun` SET total = '$total' WHERE id = '$id'");
	}
}

?>
