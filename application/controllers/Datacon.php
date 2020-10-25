<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class DataCon extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->model('usermodel');
		$this->load->model('agenpsomodel');
		$this->load->model('agennpsomodel');
		$this->load->model('pangkalanmodel');
		$this->load->library('session');
		$this->load->library('form_validation');
		$this->load->library('upload');
		$this->load->library(array('PHPExcel','PHPExcel/IOFactory'));
	}
	
	function agen_pso() {
		$session_data = $this->session->userdata('mubasyirin_logged_in');
		if($session_data == NULL) {
			redirect("usercon/login", "refresh");
		}
		$data['username'] = $session_data['username'];
		$data['status'] = $session_data['status'];
		
		$data['agen_pso'] = $this->agenpsomodel->showData();
		
		$this->load->view('/layouts/menu', $data);
		$this->load->view('/contents/data_agen_pso', $data);
		$this->load->view('/layouts/footer', $data);
	}
	
	function template_agen_pso() {
		$path = base_url('files/templates/template_agen_pso.xlsx');

		ob_clean();

		$data = file_get_contents($path); // Read the file's contents
		$name = 'Template Agen PSO.xlsx';
		force_download($name, $data);
	}
	
	function import_agen_pso() {
		$fileName = time().$_FILES['file']['name'];
		$fileName = str_replace(' ', '_', $fileName);
		$config['upload_path'] 		= './files/uploads/';
		$config['file_name'] 		= $fileName;
		$config['overwrite'] 		= TRUE;
		$config['allowed_types'] 	= 'xls|xlsx';
		$config['max_size']        	= 10000;
		
		$this->load->library('upload');
		$this->upload->initialize($config);
		
		if(! $this->upload->do_upload('file')) {
			$this->upload->display_errors();
		}
 
		$inputFileName = './files/uploads/'.$fileName;
		
		//  Read your Excel workbook
		try {
			$inputFileType = IOFactory::identify($inputFileName);
			$objReader = IOFactory::createReader($inputFileType);
			$objPHPExcel = $objReader->load($inputFileName);
		} 
		catch(Exception $e) {
			die('Error loading file "'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage());
		}
		
		//  Get worksheet dimensions
		$sheet = $objPHPExcel->getSheet(0);
		$highestRow = $sheet->getHighestRow();
		$highestColumn = $sheet->getHighestColumn();
		
		//  Loop through each row of the worksheet in turn
		for ($row = 2; $row <= $highestRow; $row++) {                  
			//  Read a row of data into an array                 
			$rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row, NULL, TRUE, FALSE);
			
			//  Insert row data array into your database of choice here
			$data = array(
						"sp_agen"				=> $rowData[0][0],
						"nama"					=> $rowData[0][1],
						"provinsi"				=> $rowData[0][2],
						"kota"					=> $rowData[0][3],
						"alamat"				=> $rowData[0][4],
						"kodepos"				=> $rowData[0][5],
						"distribution_channel"	=> $rowData[0][6],
						"sales_grup"			=> $rowData[0][7],
						"email"					=> $rowData[0][8],
						"latitude"				=> $rowData[0][9],
						"longitude"				=> $rowData[0][10]
					);
			
			$this->agenpsomodel->inputData($data);
		}
		unlink($inputFileName);
		echo '<script language="javascript">';
		echo 'alert("Data Agen PSO Berhasil Tersimpan")';
		echo '</script>';
		redirect('datacon/agen_pso', 'refresh');
	}
	
	function agen_npso() {
		$session_data = $this->session->userdata('mubasyirin_logged_in');
		if($session_data == NULL) {
			redirect("usercon/login", "refresh");
		}
		$data['username'] = $session_data['username'];
		$data['status'] = $session_data['status'];
		
		$data['agen_npso'] = $this->agennpsomodel->showData();
		
		$this->load->view('/layouts/menu', $data);
		$this->load->view('/contents/data_agen_npso', $data);
		$this->load->view('/layouts/footer', $data);
	}
	
	function template_agen_npso() {
		$path = base_url('files/templates/template_agen_npso.xlsx');

		ob_clean();

		$data = file_get_contents($path); // Read the file's contents
		$name = 'Template Agen NPSO.xlsx';
		force_download($name, $data);
	}
	
	function import_agen_npso() {
		$fileName = time().$_FILES['file']['name'];
		$fileName = str_replace(' ', '_', $fileName);
		$config['upload_path'] 		= './files/uploads/';
		$config['file_name'] 		= $fileName;
		$config['overwrite'] 		= TRUE;
		$config['allowed_types'] 	= 'xls|xlsx';
		$config['max_size']        	= 10000;
		
		$this->load->library('upload');
		$this->upload->initialize($config);
		
		if(! $this->upload->do_upload('file')) {
			$this->upload->display_errors();
		}
 
		$inputFileName = './files/uploads/'.$fileName;
		
		//  Read your Excel workbook
		try {
			$inputFileType = IOFactory::identify($inputFileName);
			$objReader = IOFactory::createReader($inputFileType);
			$objPHPExcel = $objReader->load($inputFileName);
		} 
		catch(Exception $e) {
			die('Error loading file "'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage());
		}
		
		//  Get worksheet dimensions
		$sheet = $objPHPExcel->getSheet(0);
		$highestRow = $sheet->getHighestRow();
		$highestColumn = $sheet->getHighestColumn();
		
		//  Loop through each row of the worksheet in turn
		for ($row = 2; $row <= $highestRow; $row++) {                  
			//  Read a row of data into an array                 
			$rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row, NULL, TRUE, FALSE);
			
			//  Insert row data array into your database of choice here
			$data = array(
						"mor"				=> $rowData[0][0],
						"rayon"				=> $rowData[0][1],
						"provinsi"			=> $rowData[0][2],
						"kota"				=> $rowData[0][3],
						"klasifikasi"		=> $rowData[0][4],
						"nama_agen"			=> $rowData[0][5],
						"alamat"			=> $rowData[0][6],
						"kelurahan"			=> $rowData[0][7],
						"kecamatan"			=> $rowData[0][8],
						"delivery_service"	=> $rowData[0][9],
					);
			
			$this->agennpsomodel->inputData($data);
		}
		unlink($inputFileName);
		echo '<script language="javascript">';
		echo 'alert("Data Agen NPSO Berhasil Tersimpan")';
		echo '</script>';
		redirect('datacon/agen_npso', 'refresh');
	}
	
	function pangkalan() {
		$session_data = $this->session->userdata('mubasyirin_logged_in');
		if($session_data == NULL) {
			redirect("usercon/login", "refresh");
		}
		$data['username'] = $session_data['username'];
		$data['status'] = $session_data['status'];
		
		$data['pangkalan'] = $this->pangkalanmodel->showData();
		
		$this->load->view('/layouts/menu', $data);
		$this->load->view('/contents/data_pangkalan', $data);
		$this->load->view('/layouts/footer', $data);
	}
	
	function template_pangkalan() {
		$path = base_url('files/templates/template_pangkalan.xlsx');

		ob_clean();

		$data = file_get_contents($path); // Read the file's contents
		$name = 'Template Pangkalan.xlsx';
		force_download($name, $data);
	}
	
	function import_pangkalan() {
		$fileName = time().$_FILES['file']['name'];
		$fileName = str_replace(' ', '_', $fileName);
		$config['upload_path'] 		= './files/uploads/';
		$config['file_name'] 		= $fileName;
		$config['overwrite'] 		= TRUE;
		$config['allowed_types'] 	= 'xls|xlsx';
		$config['max_size']        	= 10000;
		
		$this->load->library('upload');
		$this->upload->initialize($config);
		
		if(! $this->upload->do_upload('file')) {
			$this->upload->display_errors();
		}
 
		$inputFileName = './files/uploads/'.$fileName;
		
		//  Read your Excel workbook
		try {
			$inputFileType = IOFactory::identify($inputFileName);
			$objReader = IOFactory::createReader($inputFileType);
			$objPHPExcel = $objReader->load($inputFileName);
		} 
		catch(Exception $e) {
			die('Error loading file "'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage());
		}
		
		//  Get worksheet dimensions
		$sheet = $objPHPExcel->getSheet(0);
		$highestRow = $sheet->getHighestRow();
		$highestColumn = $sheet->getHighestColumn();
		
		//  Loop through each row of the worksheet in turn
		for ($row = 2; $row <= $highestRow; $row++) {                  
			//  Read a row of data into an array                 
			$rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row, NULL, TRUE, FALSE);
			
			//  Insert row data array into your database of choice here
			$data = array(
						"nama_pangkalan"	=> $rowData[0][0],
						"type"				=> $rowData[0][1],
						"noreg"				=> $rowData[0][2],
						"alamat"			=> $rowData[0][3],
						"provinsi"			=> $rowData[0][4],
						"kota"				=> $rowData[0][5],
						"kecamatan"			=> $rowData[0][6],
						"kelurahan"			=> $rowData[0][7],
						"telpon"			=> $rowData[0][8],
						"pemilik"			=> $rowData[0][9],
						"ktp_pemilik"		=> $rowData[0][10],
						"hp_pemilik"		=> $rowData[0][11],
						"sp_agen"			=> $rowData[0][12],
						"qty_kontrak"		=> $rowData[0][13],
						"kodepos"			=> $rowData[0][14],
						"latitude"			=> $rowData[0][15],
						"longitude"			=> $rowData[0][16]
					);
			
			$this->pangkalanmodel->inputData($data);
		}
		unlink($inputFileName);
		echo '<script language="javascript">';
		echo 'alert("Data Pangkalan Berhasil Tersimpan")';
		echo '</script>';
		redirect('datacon/pangkalan', 'refresh');
	}
}

?>
