<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class NasabahCon extends CI_Controller {
	function __construct() {
		parent::__construct();

		$this->load->model('usermodel');
		$this->load->model('nasabahmodel');
		$this->load->model('pinjamanmodel');
		$this->load->model('simpananpokokmodel');
		$this->load->model('simpananwajibmodel');
		$this->load->model('detailangsuranmodel');
		$this->load->model('detailsimpananwajibmodel');

		$this->load->library('session');
		$this->load->library('form_validation');
		$this->load->library('upload');
		$this->load->library('image_lib');
		$this->load->library(array('PHPExcel','PHPExcel/IOFactory'));
	}

	function index() {
		$session_data = $this->session->userdata('logged_in');
		if($session_data == NULL) {
			redirect("usercon/login", "refresh");
		}
		$data['username'] 	= $session_data['username'];
		$data['status'] 	= $session_data['status'];
		$data['nasabah'] 	= $this->nasabahmodel->showData();
		$this->load->view('/layouts/menu', $data);
		$this->load->view('/nasabah/index', $data);
		$this->load->view('/layouts/footer', $data);
	}

	function create_nasabah() {
		$session_data = $this->session->userdata('logged_in');
		if($session_data == NULL) {
			redirect("usercon/login", "refresh");
		}
		$data['nomor_nasabah'] 	= $this->nasabahmodel->getNewNomorNasabah();
		$data['username'] 		= $session_data['username'];
		$data['status'] 		= $session_data['status'];
		$this->load->view('/layouts/menu', $data);
		$this->load->view('/nasabah/create_nasabah', $data);
		$this->load->view('/layouts/footer', $data);
	}

	function insert_nasabah() {
		$session_data = $this->session->userdata('logged_in');
		if($session_data == NULL) {
			redirect("usercon/login", "refresh");
		}

		$config['upload_path'] 		= './files/uploads/foto_nasabah/'; //path folder
        $config['allowed_types'] 	= 'jpg|png|jpeg'; //type yang dapat diakses bisa anda sesuaikan
        $config['file_name'] 		= time().$this->nasabahmodel->getNewId().'.jpeg';

        //echo time().$_FILES['filefoto']['name'];

        $this->load->library('upload');
        $this->upload->initialize($config);
        if(!empty($_FILES['filefoto']['name'])){
            if ($this->upload->do_upload('filefoto')){
                $gbr = $this->upload->data();
                //Compress Image
                /*$this->image_lib->clear();
                $config1 = array();
                $config1['image_library']='gd2';
                $config1['source_image']='./files/uploads/foto_nasabah/'.$gbr['file_name'];
                $config1['maintain_ratio']= FALSE;
		        $config1['width']    = 100;
		        $config1['height']   = 100;
                $config1['new_image']= './files/uploads/foto_nasabah/'.$this->nasabahmodel->getNewId().'.jpeg';
                
                $this->load->library('image_lib', $config1);
                $this->image_lib->initialize($config1);
                $this->image_lib->resize();*/

                $data = array();
				$data['id'] 			= $this->nasabahmodel->getNewId();
				$data['nama'] 			= $this->input->post('nama');
				$data['jenis_nasabah'] 	= $this->input->post('jenis_nasabah');
				$data['nomor_nasabah'] 	= $this->nasabahmodel->getNewNomorNasabahByJenisNasabah($data['jenis_nasabah']);
				$nomor_koperasi			= str_pad( $data['nomor_nasabah'], 5, "0", STR_PAD_LEFT );
				$data['nomor_koperasi']	= $data['jenis_nasabah'].$nomor_koperasi;
				$data['nik'] 			= $this->input->post('nik');
				$data['telpon'] 		= $this->input->post('telpon');
				$data['pekerjaan'] 		= $this->input->post('pekerjaan');
				$data['alamat'] 		= $this->input->post('alamat');
				$data['kota'] 			= $this->input->post('kota');
				$data['kecamatan'] 		= $this->input->post('kecamatan');
				$data['kelurahan'] 		= $this->input->post('kelurahan');
				$data['dusun'] 			= $this->input->post('dusun');
				$data['rt'] 			= $this->input->post('rt');
				$data['rw'] 			= $this->input->post('rw');
				$data['file_foto'] 		= './files/uploads/foto_nasabah/'.time().$data['id'].'.jpeg';

				$this->nasabahmodel->inputData($data);
				redirect('nasabahcon');
            }        
        } else {
    		$data = array();
			$data['id'] 			= $this->nasabahmodel->getNewId();
			$data['nama'] 			= $this->input->post('nama');
			$data['jenis_nasabah'] 	= $this->input->post('jenis_nasabah');
			$data['nomor_nasabah'] 	= $this->nasabahmodel->getNewNomorNasabahByJenisNasabah($data['jenis_nasabah']);
			$nomor_koperasi			= str_pad( $data['nomor_nasabah'], 5, "0", STR_PAD_LEFT );
			$data['nomor_koperasi']	= $data['jenis_nasabah'].$nomor_koperasi;
			$data['nik'] 			= $this->input->post('nik');
			$data['telpon'] 		= $this->input->post('telpon');
			$data['pekerjaan'] 		= $this->input->post('pekerjaan');
			$data['alamat'] 		= $this->input->post('alamat');
			$data['kota'] 			= $this->input->post('kota');
			$data['kecamatan'] 		= $this->input->post('kecamatan');
			$data['kelurahan'] 		= $this->input->post('kelurahan');
			$data['dusun'] 			= $this->input->post('dusun');
			$data['rt'] 			= $this->input->post('rt');
			$data['rw'] 			= $this->input->post('rw');
			$this->nasabahmodel->inputData($data);
			redirect('nasabahcon');
        }
	}

	function edit_nasabah($id) {
		$session_data = $this->session->userdata('logged_in');
		if($session_data == NULL) {
			redirect("usercon/login", "refresh");
		}
		$data['nasabah'] 	= $this->nasabahmodel->get_nasabah_by_id($id);
		$data['username'] 	= $session_data['username'];
		$data['status'] 	= $session_data['status'];
		/*echo "<pre>";
		var_dump($data['nasabah']);
		echo "</pre>";*/
		$this->load->view('/layouts/menu', $data);
		$this->load->view('/nasabah/edit_nasabah', $data);
		$this->load->view('/layouts/footer', $data);
	}

	function update_nasabah() {
		$session_data = $this->session->userdata('logged_in');
		if($session_data == NULL) {
			redirect("usercon/login", "refresh");
		}

		$id = $this->input->post('id');
		$config['upload_path'] 		= './files/uploads/foto_nasabah/'; //path folder
        $config['allowed_types'] 	= 'jpg|png|jpeg'; //type yang dapat diakses bisa anda sesuaikan
        $config['file_name'] 		= time().$id.'.jpeg';
        if($this->input->post('filefoto') != null || $this->input->post('filefoto') != '') {
        	unlink($this->input->post('filefoto'));
        }

        //echo time().$_FILES['filefoto']['name'];

        $this->load->library('upload');
        $this->upload->initialize($config);
        if(!empty($_FILES['filefoto']['name'])) {
        	if ($this->upload->do_upload('filefoto')) {
        		$gbr = $this->upload->data();
                //Compress Image
                /*$this->image_lib->clear();
                $config1 = array();
                $config1['image_library']='gd2';
                $config1['source_image']='./files/uploads/foto_nasabah/'.$gbr['file_name'];
                $config1['maintain_ratio']= FALSE;
		        $config1['width']    = 100;
		        $config1['height']   = 100;
                $config1['new_image']= './files/uploads/foto_nasabah/'.$this->nasabahmodel->getNewId().'.jpeg';
                
                $this->load->library('image_lib', $config1);
                $this->image_lib->initialize($config1);
                $this->image_lib->resize();*/

				$data 				= array();
				$data['nama'] 		= $this->input->post('nama');
				$data['nik'] 		= $this->input->post('nik');
				$data['telpon'] 	= $this->input->post('telpon');
				$data['pekerjaan'] 	= $this->input->post('pekerjaan');
				$data['alamat'] 	= $this->input->post('alamat');
				$data['kota'] 		= $this->input->post('kota');
				$data['kecamatan'] 	= $this->input->post('kecamatan');
				$data['kelurahan'] 	= $this->input->post('kelurahan');
				$data['dusun'] 		= $this->input->post('dusun');
				$data['rt'] 		= $this->input->post('rt');
				$data['rw'] 		= $this->input->post('rw');
				$data['file_foto'] 	= './files/uploads/foto_nasabah/'.time().$id.'.jpeg';

				$this->nasabahmodel->updateData($id, $data);
				redirect('nasabahcon');
        	}
        } else {
			$data 				= array();
			$data['nama'] 		= $this->input->post('nama');
			$data['nik'] 		= $this->input->post('nik');
			$data['telpon'] 	= $this->input->post('telpon');
			$data['pekerjaan'] 	= $this->input->post('pekerjaan');
			$data['alamat'] 	= $this->input->post('alamat');
			$data['kota'] 		= $this->input->post('kota');
			$data['kecamatan'] 	= $this->input->post('kecamatan');
			$data['kelurahan'] 	= $this->input->post('kelurahan');
			$data['dusun'] 		= $this->input->post('dusun');
			$data['rt'] 		= $this->input->post('rt');
			$data['rw'] 		= $this->input->post('rw');

			$this->nasabahmodel->updateData($id, $data);
			redirect('nasabahcon');
        }
	}

	function view_nasabah($id) {
		$session_data = $this->session->userdata('logged_in');
		if($session_data == NULL) {
			redirect("usercon/login", "refresh");
		}
		$data['nasabah'] 	= $this->nasabahmodel->get_nasabah_by_id($id);
		$data['username'] 	= $session_data['username'];
		$data['status'] 	= $session_data['status'];

		$this->load->view('/layouts/menu', $data);
		$this->load->view('/nasabah/view_nasabah', $data);
		$this->load->view('/layouts/footer', $data);
	}

	function delete_nasabah($id) {
		$session_data = $this->session->userdata('logged_in');
		if($session_data == NULL) {
			redirect("usercon/login", "refresh");
		}

		$pinjaman 			= array();
		$pinjaman[] 		= $this->pinjamanmodel->get_pinjaman_by_id_nasabah($id);
		$simpananpokok 		= array();
		$simpananpokok[] 	= $this->simpananpokokmodel->get_simpananpokok_by_id_nasabah($id);
		$simpananwajib 		= array();
		$simpananwajib[] 	= $this->simpananwajibmodel->get_simpananwajib_by_id_nasabah($id);

		/*echo "<pre>";
		var_dump($pinjaman);
		echo "</pre>";

		echo "<pre>";
		var_dump($simpananpokok);
		echo "</pre>";

		echo "<pre>";
		var_dump($simpananwajib);
		echo "</pre>";

		foreach ($pinjaman as $p) {
			echo "<pre>";
			var_dump($p->id);
			echo "</pre>";
		}*/

		foreach ($pinjaman as $p) {
			$this->detailangsuranmodel->delete_by_id_pinjaman($p->id);
		}
		foreach ($simpananwajib as $sw) {
			$this->detailsimpananwajibmodel->delete_by_id_simpananwajib($sw->id);
		}

		/*for($i = 0; $i < sizeof($pinjaman); $i++) {
			$this->detailangsuranmodel->delete_by_id_pinjaman($pinjaman[$i]['id']);
		}
		for($i = 0; $i < sizeof($simpananwajib); $i++) {
			$this->detailsimpananwajibmodel->delete_by_id_simpananwajib($simpananwajib[$i]['id']);
		}*/



		$this->pinjamanmodel->delete_by_id_nasabah($id);
		$this->simpananpokokmodel->delete_by_id_nasabah($id);
		$this->simpananwajibmodel->delete_by_id_nasabah($id);

		$this->nasabahmodel->deleteData($id);
		redirect('nasabahcon');
	}

	function getNomorNasabah() {
		$jenis_nasabah = $this->input->post('jenis_nasabah');

		$new_nomor = $this->nasabahmodel->getNewNomorNasabahByJenisNasabah($jenis_nasabah);

		$nomor_nasabah = str_pad( $new_nomor, 5, "0", STR_PAD_LEFT );

		echo $nomor_nasabah;
	}
}

?>