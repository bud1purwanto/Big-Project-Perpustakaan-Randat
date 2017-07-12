<?php 
 defined('BASEPATH') OR exit('No direct script access allowed');
 
 class Login extends CI_Controller {
 
 	public function index()
 	{
 		$data['title'] = "Login";
 		$this->load->view('template/assets-footer', $data);
 		$this->load->view('public/login_view', $data);	
 	}

 	public function cekLogin()
 	{
		$this->form_validation->set_rules('username', 'Username', 'trim|required');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|callback_cekDB');
		if ($this->form_validation->run()==FALSE) {
			$this->load->view('template/assets-footer');
			$this->load->view('public/login_view');
		} else {
			$ip      = $_SERVER['REMOTE_ADDR']; 
			$tanggal = date("Ymd"); 
			$waktu   = time(); 

			$sess_array = array(
				'ip'=> $ip,
				'tanggal'=> $tanggal,
				'online'=> $waktu,					
				);
			$this->session->set_userdata('visitor', $sess_array);	
			$this->load->model('Visitor_Model');
			$is_exist=$this->Visitor_Model->cekVisitor();

			if ($is_exist) {
				$this->Visitor_Model->updateVisitor();
			} else {
				$this->Visitor_Model->insertVisitor();
			}

			// $this->load->library('acl');
			// if (! $this->acl->is_public('dashboard'))
		 //    {
		    
		 //        if (! $this->acl->is_allowed('dashboard', 'role-to-test'))
		 //        {
		 //            redirect('login','refresh');
		 //        }
		    
		 //    }
			redirect('dashboard','refresh');
		}
 	}
	
	public function cekDB($password)
 	{
 		$this->load->model('User_Model');
		$username = $this->input->post('username');
		$result = $this->User_Model->login($username,$password);
		if($result){
			$sess_array = array();
			foreach ($result as $row) {
				$sess_array = array(
					'id_user'=>$row->id_user,
					'nama'=> $row->nama,
					'no_identitas'=>$row->no_identitas,
					'email'=>$row->email,
					'no_hp'=>$row->no_hp,
					'username'=> $row->username,
					'password'=>$row->password,
					'jenis_kelamin'=>$row->jenis_kelamin,
					'alamat'=>$row->alamat,
					'foto'=>$row->foto,
					'status'=> $row->status,		
				);
				$status=$sess_array['status'];
				$this->session->set_userdata('logged_in_'.$status.'', $sess_array);	
				
			}
			return true;
		}else{
			$this->form_validation->set_message('cekDB',"Login Gagal Username dan Password tidak valid");
			return false;
		}
 		
 	} 


 	public function logout()
 	{
 		if ($this->session->userdata('logged_in_admin')) {
				$this->session->unset_userdata('logged_in_admin');
			} else {
				$this->session->unset_userdata('logged_in_user');
			}
 		
 		$this->session->unset_userdata('visitor');
 		$this->session->sess_destroy();
 		redirect('login','refresh');
 	}
 }

 
 /* End of file Login.php */
 /* Location: ./application/controllers/Login.php */ ?>