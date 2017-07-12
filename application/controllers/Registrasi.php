<?php
 defined('BASEPATH') OR exit('No direct script access allowed');
 
 class Registrasi extends CI_Controller {
 
 	public function index()
 	{
 		$data['title'] = "Registrasi";
 		$this->load->view('template/assets-footer', $data);
 		$this->load->view('public/registrasiUser_view', $data);
 	}

 	public function createUser()
 	{
 		$data['title'] = "Registrasi";
 		$this->form_validation->set_rules('nama', 'Nama', 'trim|required|alpha_numeric_spaces|min_length[2]');
 		$this->form_validation->set_rules('no_identitas', 'NIM', 'trim|required|numeric|min_length[2]|callback_isNIMExist|callback_isNIMExistTerdaftar');
 		$this->form_validation->set_rules('email', 'Email', 'trim|required|min_length[5]|valid_email|callback_isEmailTerdaftar');
 		$this->form_validation->set_rules('no_hp', 'Nomor HP', 'trim|required|numeric|min_length[11]');
 		$this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[2]|callback_isUsernameUserExist');
		$this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');
		$this->form_validation->set_rules('jenis_kelamin', 'Jenis Kelamin', 'trim|required');
		$this->form_validation->set_rules('alamat', 'Alamat', 'required');
		
		$this->load->model('User_Model');

		if ($this->form_validation->run()==FALSE) {
			$this->load->view('template/assets-footer', $data);
			$this->load->view('public/registrasiUser_view', $data);
		} else {
			$config['upload_path']			='./assets/uploads/Profil';
			$config['allowed_types']		='gif|jpg|png';
			$config['max_size']				=1000000000;
			$config['max_width']			=10240;
			$config['max_height']			=7680;
			$this->load->library('upload', $config);
			if( ! $this->upload->do_upload('userfile'))
			{
				$this->session->set_flashdata('error', 'Masukkan Foto Profil Anda!');
				$this->load->view('template/assets-footer', $data);
				$this->load->view('public/registrasiUser_view', $data);	
			}
			else
			{
				$this->User_Model->insertUser();
		    	$this->session->set_flashdata('sudah_input', 'Registrasi Berhasil, Silahkan Login!');
		   		redirect('login','refresh');
			}
		}
	}


	public function isUsernameUserExist($username) {
	    $this->load->library('form_validation');
	    $this->load->model('User_Model');
	    $is_exist = $this->User_Model->isUsernameUserExist($username);
	   
	    if ($is_exist) {
	        $this->form_validation->set_message('isUsernameUserExist', 'Username sudah ada.');    
	        return false;
	    }else {
	        return true;
	    }
	}

	public function isNIMExist($no_identitas) {
	    $this->load->library('form_validation');
	    $this->load->model('User_Model');
	    $is_exist = $this->User_Model->isNIMExist($no_identitas);


	    if ($is_exist) {
	        return true;
	    } else {
	        $this->form_validation->set_message('isNIMExist', 'NIM anda tidak terdaftar, tanya ke Admin.');    
	        return false;
	    }
	}

	public function isNIMExistTerdaftar($no_identitas) {
	    $this->load->library('form_validation');
	    $this->load->model('User_Model');
	    $is_exist = $this->User_Model->isNIMExistTerdaftar($no_identitas);

	    if ($is_exist) {
	     	$this->form_validation->set_message('isNIMExistTerdaftar', 'NIM sudah terdaftar menjadi member.'); 
	        return false;
	        
	    } else {
	        return true;
	    }
	}

	public function isEmailTerdaftar($email) {
	    $this->load->library('form_validation');
	    $this->load->model('User_Model');
	    $is_exist = $this->User_Model->isEmailTerdaftar($email);

	    if ($is_exist) {
	     	$this->form_validation->set_message('isEmailTerdaftar', 'Email sudah terdaftar menjadi member.'); 
	        return false;
	        
	    } else {
	        return true;
	    }
	}

 }
 
 /* End of file Registrasi.php */
 /* Location: ./application/controllers/Registrasi.php */ ?>