<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class UserCon extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->model('usermodel');
		$this->load->library('session');
		$this->load->library('form_validation');
	}

	function index() {
		$session_data = $this->session->userdata('mubasyirin_logged_in');
		if($session_data == NULL) {
			redirect("usercon/login", "refresh");
		}
		$data['username'] = $session_data['username'];
		$data['status'] = $session_data['status'];
		$data['user'] = $this->usermodel->showData();
		$this->load->view('/layouts/menu', $data);
		$this->load->view('/user/index', $data);
		$this->load->view('/layouts/footer', $data);
	}
	
	function login() {
		if($this->session->userdata('mubasyirin_logged_in')) {
			redirect("transaksianggotacon", "refresh");
		} else {
			/*$session_data = $this->session->userdata('mubasyirin_logged_in');
			$data['username'] = $session_data['username'];
			$data['status'] = $session_data['status'];*/
			$this->load->view('/site/login');
		}
	}
	
	function veriflogin()
	{
		if($this->session->userdata('mubasyirin_logged_in')) {
			redirect('nasabahcon', 'refresh');
		} else {
			$this->form_validation->set_rules('username','Username','strip_tags|required|xss_clean');
			$this->form_validation->set_rules('password','Password','strip_tags|required|xss_clean|callback_checklogin');
			
			if($this->form_validation->run() == FALSE) {
				$session_data = $this->session->userdata('mubasyirin_logged_in');
				$data['username'] = $session_data['username'];
				$data['status'] = $session_data['status'];
				$this->load->view('/site/login');
			} else {
				redirect('transaksianggotacon', 'refresh');
			}
		}
	}
	
	function checklogin()
	{
		$username = $this->input->post('username');
		$password = md5($this->input->post('password'));
		
		$result = $this->usermodel->login($username, $password);
			
		if($result) {
			$session_array = array();
			foreach($result as $row) {
				$session_array = array(
				'username'=>$row->username,
				'status'=>$row->status
				);
				$this->session->set_userdata('mubasyirin_logged_in', $session_array);
			}
			return TRUE;
		} else {
			$this->form_validation->set_message('checklogin', 'Invalid username or password');
			return false;
		}
	}
	
	function register() {
		if($this->session->userdata('mubasyirin_logged_in')) {
			redirect('homecon/index', 'refresh');
		} else {
			$session_data = $this->session->userdata('mubasyirin_logged_in');
			$data['username'] = $session_data['username'];
			$data['status'] = $session_data['status'];
			$this->load->view('/site/register');
		}
	}
	
	function do_register() {
		echo $this->input->post('register');
		$this->form_validation->set_rules('username','Username','strip_tags|required|xss_clean');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
		$this->form_validation->set_rules('password','Password','strip_tags|required|xss_clean');
		$this->form_validation->set_rules('repassword','Password Confirmation','strip_tags|required|xss_clean|callback_checkpassword');
		
		if($this->form_validation->run() == FALSE) {
			$this->load->view('site/register');
		} else {
			if($this->usermodel->add_user()) {
				redirect('usercon/login', 'refresh');
			} else {
				redirect('usercon/register', 'refresh');
			}
		}
	}
	
	function checkpassword() {
		$password = $this->input->post('password');
		$repassword = $this->input->post('repassword');
		
		if($password == $repassword)
		{
			return true;
		}
		else
		{
			$this->form_validation->set_message('checkpassword', 'Password tidak sama');
			return FALSE;
		}
	}
	
	function logout() {
		$this->session->unset_userdata('mubasyirin_logged_in');
		session_destroy();
		redirect('usercon/login', 'refresh');
	}

	function create_user() {
		$session_data = $this->session->userdata('mubasyirin_logged_in');
		if($session_data == NULL) {
			redirect("usercon/login", "refresh");
		}
		$data['username'] = $session_data['username'];
		$data['status'] = $session_data['status'];
		$this->load->view('/layouts/menu', $data);
		$this->load->view('/user/create_user', $data);
		$this->load->view('/layouts/footer', $data);
	}

	function do_insert() {
		$session_data = $this->session->userdata('mubasyirin_logged_in');
		if($session_data == NULL) {
			redirect("usercon/login", "refresh");
		}
		$data['username'] = $session_data['username'];
		$data['status'] = $session_data['status'];

		echo $this->input->post('tambah_user');
		$user = array();
		$user['username'] = $this->input->post('username');
		$user['email'] = $this->input->post('email');
		$user['status'] = $this->input->post('status');
		$user['password'] = md5($this->input->post('password'));

		$this->form_validation->set_rules('username','Username','strip_tags|required|xss_clean');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
		$this->form_validation->set_rules('password','Password','strip_tags|required|xss_clean');
		$this->form_validation->set_rules('repassword','Password Confirmation','strip_tags|required|xss_clean|callback_checkpassword');

		$data['user'] = $user;

		/*echo "<pre>";
		var_dump($data['user']);
		echo "</pre>";*/

		if($this->form_validation->run() == FALSE) {
			$this->load->view('/layouts/menu', $data);
			$this->load->view('/user/create_user', $data);
			$this->load->view('/layouts/footer', $data);
		} else {
			if($this->usermodel->add_user()) {
				redirect('usercon', 'refresh');
			} else {
				redirect('usercon/create_user', 'refresh');
			}
		}
	}

	function insert_user() {
		$session_data = $this->session->userdata('mubasyirin_logged_in');
		if($session_data == NULL) {
			redirect("usercon/login", "refresh");
		}
		$data = array();
		$data['id'] = $this->usermodel->getNewId();
		$data['nama'] = $this->input->post('nama');
		$this->usermodel->inputData($data);
		redirect('usercon');
	}

	function view_user($id) {
		$session_data = $this->session->userdata('mubasyirin_logged_in');
		if($session_data == NULL) {
			redirect("usercon/login", "refresh");
		}
		$data['user'] = $this->usermodel->get_user_by_id($id);
		$data['username'] = $session_data['username'];
		$data['status'] = $session_data['status'];

		$this->load->view('/layouts/menu', $data);
		$this->load->view('/user/view_user', $data);
		$this->load->view('/layouts/footer', $data);
	}

	function edit_user($id) {
		$session_data = $this->session->userdata('mubasyirin_logged_in');
		if($session_data == NULL) {
			redirect("usercon/login", "refresh");
		}
		$data['user'] = $this->usermodel->get_user_by_id($id);
		$data['username'] = $session_data['username'];
		$data['status'] = $session_data['status'];
		/*echo "<pre>";
		var_dump($data['nasabah']);
		echo "</pre>";*/
		$this->load->view('/layouts/menu', $data);
		$this->load->view('/user/edit_user', $data);
		$this->load->view('/layouts/footer', $data);
	}

	function do_update() {
		$session_data = $this->session->userdata('mubasyirin_logged_in');
		if($session_data == NULL) {
			redirect("usercon/login", "refresh");
		}
		$data['username'] = $session_data['username'];
		$data['status'] = $session_data['status'];

		echo $this->input->post('update_user');
		$user = array();
		$user['id'] = $this->input->post('id');
		$user['username'] = $this->input->post('username');
		$user['email'] = $this->input->post('email');
		$user['status'] = $this->input->post('status');
		$user['password'] = md5($this->input->post('password'));

		$this->form_validation->set_rules('username','Username','strip_tags|required|xss_clean');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
		$this->form_validation->set_rules('password','Password','strip_tags|required|xss_clean');
		$this->form_validation->set_rules('repassword','Password Confirmation','strip_tags|required|xss_clean|callback_checkpassword');

		$data['user'] = $user;

		/*echo "<pre>";
		var_dump($data['user']);
		echo "</pre>";*/

		if($this->form_validation->run() == FALSE) {
			$this->load->view('/layouts/menu', $data);
			$this->load->view('/user/update_user', $data);
			$this->load->view('/layouts/footer', $data);
		} else {
			$this->usermodel->updateData($user['id'], $user);
			redirect('usercon', 'refresh');
		}
	}

	function delete_user($id) {
		$session_data = $this->session->userdata('mubasyirin_logged_in');
		if($session_data == NULL) {
			redirect("usercon/login", "refresh");
		}
		$this->usermodel->deleteData($id);
		redirect('usercon');
	}
}

?>
