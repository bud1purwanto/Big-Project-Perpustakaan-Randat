<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		if($this->session->userdata('logged_in_admin') || $this->session->userdata('logged_in_user')){
			if ($this->session->userdata('logged_in_admin')) {
				$session_data = $this->session->userdata('logged_in_admin');
			} else {
				$session_data = $this->session->userdata('logged_in_user');
			}
			
			$data['id_user'] = $session_data['id_user'];
			$this->load->model('Buku_Model');
			$this->load->model('User_Model');
			$this->load->model('Visitor_Model');
			$this->load->model('Transaksi_Model');
		}else{
			$this->session->set_flashdata('login_lagi', 'Anda sudah logout, silahkan login lagi!');
			redirect('login','refresh');
		}		
	}

	public function index()
	{
		$data['title'] = "Home";
		$data['notif']=$this->Transaksi_Model->getNotif();
		$data['hariIni']=$this->Visitor_Model->hariIni();
		$data['totalPengunjung']=$this->Visitor_Model->totalPengunjung();
		$data['onLine']=$this->Visitor_Model->onLine();
		$data['data_login']=$this->User_Model->getDataLogin();
		$data['galeri']=$this->Visitor_Model->getGaleri();

		$getStatus=$this->User_Model->getDataLogin();
		foreach ($getStatus as $key) 
		{
            	$status = $key->status;
        }
		$data["status"] = $status;
		
		$this->load->view('template/assets-header', $data);
		$this->load->view('template/navbar', $data);
		$this->load->view('home/dashboard_view', $data);
		$this->load->view('template/assets-footer', $data);	
	}

	public function deleteGaleri($id_galeri)
	{
		$this->Visitor_Model->deleteGaleri($id_galeri);
		redirect('dashboard/listGaleri','refresh');
	}

	public function galeri()
	{
		$data['title'] = "Add Galeri";
 		$data['data_login']=$this->User_Model->getDataLogin();
 		$data['notif']=$this->Transaksi_Model->getNotif();
 		$data['hariIni']=$this->Visitor_Model->hariIni();
		$data['totalPengunjung']=$this->Visitor_Model->totalPengunjung();
		$data['onLine']=$this->Visitor_Model->onLine();
		$data['galeri']=$this->Visitor_Model->getGaleri();

 		$getStatus=$this->User_Model->getDataLogin();
		foreach ($getStatus as $key) 
		{
            	$status = $key->status;
        }
		$data["status"] = $status;

		$config['upload_path']			='./assets/uploads/Galeri';
		$config['allowed_types']		='gif|jpg|png';
		$config['max_size']				=1000000000;
		$config['max_width']			=10240;
		$config['max_height']			=7680;
		
		$this->load->library('upload', $config);
		if( ! $this->upload->do_upload('userfile'))
		{
			$this->session->set_flashdata('gagal', 'Masukkan Foto!');
			$this->load->view('template/assets-header', $data);
			$this->load->view('template/navbar', $data);
			$this->load->view('home/dashboard_view', $data);
			$this->load->view('template/assets-footer', $data);	
		}
		else
		{
			$this->session->set_flashdata('sukses', 'value');
			$this->Visitor_Model->addGaleri();
		   	redirect('dashboard','refresh');
		}
	}

	public function listGaleri()
	{
		$data['title'] = "List Galeri";
 		$data['data_login']=$this->User_Model->getDataLogin();
 		$data['notif']=$this->Transaksi_Model->getNotif();
		$data['galeri']=$this->Visitor_Model->getGaleri();
		$this->load->view('template/assets-header', $data);
		$this->load->view('template/navbar', $data);
		$this->load->view('home/galeri_view', $data);
		$this->load->view('template/assets-footer', $data);
	}

	public function setting()
	{
		$data['title'] = "Setting";
 		$data['data_login']=$this->User_Model->getDataLogin();
 		$data['setting']=$this->Transaksi_Model->getSetting();
 		$data['notif']=$this->Transaksi_Model->getNotif();

 		$this->form_validation->set_rules('rentan', 'Rentan Peminjaman', 'required|min_length[1]|max_length[3]|is_natural_no_zero');
		$this->form_validation->set_rules('denda', 'Denda', 'required|min_length[3]|is_natural_no_zero');
		$this->form_validation->set_rules('peminjaman', 'Maximal Peminjaman', 'required|min_length[1]|max_length[3]|is_natural_no_zero');
		$this->form_validation->set_rules('toleransi', 'Toleransi', 'required|min_length[1]|max_length[2]|is_natural');

		if ($this->form_validation->run()==FALSE) {
			$this->load->view('template/assets-header', $data);
			$this->load->view('template/navbar', $data);
			$this->load->view('home/setting_view', $data);
			$this->load->view('template/assets-footer', $data);
		} else {
			$this->Transaksi_Model->editSetting();
			$this->session->set_flashdata('setting', 'Pengaturan Sudah Diganti!');
			redirect('dashboard/setting','refresh');
		}
	}
	public function editProfil()
	{
		$data['title'] = "Edit Profil";
		$data['data_login']=$this->User_Model->getDataLogin();
		$data['notif']=$this->Transaksi_Model->getNotif();

		$this->form_validation->set_rules('nama', 'Nama', 'trim|alpha_numeric_spaces|required|min_length[2]');
 		$this->form_validation->set_rules('no_hp', 'Nomor HP', 'trim|required|numeric|min_length[11]');
		$this->form_validation->set_rules('alamat', 'Alamat', 'required');

		$this->load->model('User_Model');
		
		if($this->form_validation->run()==FALSE){
			$this->load->view('template/assets-header', $data);
			$this->load->view('template/navbar', $data);
			$this->load->view('user/editProfil_view', $data);
			$this->load->view('template/assets-footer', $data);

		}else{
			$config['upload_path'] = './assets/uploads/Profil';
			$config['allowed_types'] = 'jpg|png';
			$config['max_size']  = 1000000;
			$config['max_width']  = 10240;
			$config['max_height']  = 7680;
			

			$this->load->library('upload', $config);
			
			if ( ! $this->upload->do_upload('userfile')){
				$this->User_Model->updateProfilTanpaFoto();	
				redirect('dashboard/editProfil','refresh');	
			}
			else{
				$this->User_Model->updateProfil();
				redirect('dashboard/editProfil','refresh');
			}
		}
	}

	public function gantiPassword()
	{
		$data['title'] = "Ganti Password";
		$data['data_login']=$this->User_Model->getDataLogin();
		$data['notif']=$this->Transaksi_Model->getNotif();
		
		$this->form_validation->set_rules('password_lama', 'Password Lama', 'required|min_length[4]');
		$this->form_validation->set_rules('password_baru', 'Password Baru', 'required|min_length[4]');
		$this->form_validation->set_rules('conf_password_baru', 'Konfirmasi Password Baru', 'required|min_length[4]|matches[password_baru]');

		if ($this->form_validation->run()==FALSE) {
			$this->load->view('template/assets-header', $data);
			$this->load->view('template/navbar', $data);
			$this->load->view('user/gantiPassword_view', $data);
			$this->load->view('template/assets-footer', $data);
		} else {
			$pass = $this->input->post('password_lama');
			$password = md5($pass);
			$getPassword = $this->User_Model->getPasswordtoChange();

			foreach ($getPassword as $key) 
			{
            	$cocok = $key->password;
        	}

        	if ($password == $cocok) {
	        	$this->User_Model->updatePassword();
				$this->session->set_flashdata('password', 'Password Berhasil Diedit');
				redirect('dashboard/editProfil', 'refresh');
        	} else {
        		$this->session->set_flashdata('password', 'Password Lama Salah!');
        		$this->load->view('template/assets-header', $data);
				$this->load->view('template/navbar', $data);
				$this->load->view('user/gantiPassword_view', $data);
				$this->load->view('template/assets-footer', $data);
        	}
        	
		}
	}

	public function isUsernameUserExist($username) {
	    $is_exist = $this->User_Model->isUsernameUserExist($username);
	   
	    if ($is_exist) {
	        $this->form_validation->set_message('isUsernameUserExist', 'Username sudah ada.');    
	        return false;
	    }else {
	        return true;
	    }
	}

	public function isEmailTerdaftar($email) {
	    $is_exist = $this->User_Model->isEmailTerdaftar($email);
	    $email=$this->input->post('email');
	    
	    if ($is_exist) {
	     	$this->form_validation->set_message('isEmailTerdaftar', 'Email sudah terdaftar!.'); 
	        return false;
	        
	    } else {
	        return true;
	    }
	}
}

/* End of file Pegawai.php */
/* Location: ./application/controllers/Pegawai.php */

 ?>