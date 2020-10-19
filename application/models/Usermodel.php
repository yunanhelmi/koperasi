<?php

class UserModel extends CI_Model {
	function __construct() {
		parent::__construct();
		$this->load->database();
	}
	
	function login($username, $password) {
		$this->db->select("*");
		$this->db->from("user");
		$this->db->where("username = '".$username."'");
		$this->db->where("password = '".$password."'");
		$this->db->limit(1);
		
		$query = $this->db->get();
		
		if($query->num_rows() == 1) {
			return $query->result();
		} else {
			return false;
		}
	}
	
	function add_user() {
		if($this->input->post('status') == NULL || $this->input->post('status') == '') {
			$data=array(
				'username'=>$this->input->post('username'),
				'password'=>md5($this->input->post('password')),
				'status'=>'administrator',
				'email'=>$this->input->post('email')
			);
		} else {
			$data=array(
				'username'=>$this->input->post('username'),
				'password'=>md5($this->input->post('password')),
				'status'=>$this->input->post('status'),
				'email'=>$this->input->post('email')
			);
		}
		
		
		$this->db->insert('user', $data);
		return true;
	}

	function getNewId() {
		$query = $this->db->query("SELECT MAX(id) as new_id from `user`");
		$a = $query->row();
		if($a->new_id == NULL) {
			return 1;
		} else {
			return $a->new_id + 1;
		}
	}

	function get_user_by_id($id) {
		$query = $this->db->query("SELECT * from `user` WHERE id = '$id'");
		$a = $query->row();
		return $a;
	}

	function showData() {
		$query = $this->db->query("SELECT * from `user`");
		$a = $query->result_array();
		return $a;
	}

	function inputData($data) {
		$this->db->insert("user",$data);
	}

	function updateData($id, $data) {
		$this->db->where('id', $id);
		$this->db->update('user', $data);
	}

	function deleteData($id) {
		$this->db->where('id', $id);
		$this->db->delete('user');
	}
}

?>
