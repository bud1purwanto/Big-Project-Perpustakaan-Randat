<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		if($this->session->userdata('logged_in_admin')){
			$session_data = $this->session->userdata('logged_in_admin');
			$data['id_user'] = $session_data['id_user'];
			$this->load->model('Transaksi_Model');	
			$this->load->model('User_Model');
		}elseif ($this->session->userdata('logged_in_user')) {
			redirect('dashboard','refresh');
		}else{
			$this->session->set_flashdata('login_lagi', 'Anda sudah logout, silahkan login lagi!');
			redirect('login','refresh');
		}		
	}

	public function index()
	{
		$data['title'] = "List Admin";
		$data['data_login']=$this->User_Model->getDataLogin();
		$data["admin_list"] = $this->User_Model->getDataAdmin();
		$data['notif']=$this->Transaksi_Model->getNotif();

		$this->load->view('template/assets-header', $data);
		$this->load->view('template/navbar', $data);
		$this->load->view('user/daftarAdmin_view', $data);
		$this->load->view('template/assets-footer', $data);
	}

	public function search()
	{
		$keyword = $this->uri->segment(3);
		$data = $this->db->from('user')->where('status', 'user')->like('nama',$keyword)->get();	

		foreach($data->result() as $row)
		{
			$arr['query'] = $keyword;
			$arr['suggestions'][] = array(
				'value'	=>$row->nama,
				'nama'	=>$row->nama,
				'no_identitas'	=>$row->no_identitas,
				'id_user'	=>$row->id_user,

			);
		}
		echo json_encode($arr);
	}

	public function get_alldata() {
        $kode = $this->input->post('kode',TRUE);
        $query = $this->User_Model->get_alldata(); 
 
        $nama       =  array();
        foreach ($query as $d) {
            $nama[]     = array(
                'label' => $d->nama, 
                'nama' => $d->nama , 
                'no_identitas' => $d->no_identitas, 
                'id_user' => $d->id_user
            );
        }
        echo json_encode($nama);      
    }
    
	public function Server_Admin()
	{
        $this->load->library('Datatables');
        $this->datatables
                ->select('id_user, nama, foto, no_identitas, username, jenis_kelamin')
                ->from('user')
                ->where('status', "admin");
        echo $this->datatables->generate();
	}

	public function user()
	{
		$data['title'] = "List User";
		$data['data_login']=$this->User_Model->getDataLogin();
		$data["user_list"] = $this->User_Model->getDataUser();
		$data['notif']=$this->Transaksi_Model->getNotif();

		$this->load->view('template/assets-header', $data);
		$this->load->view('template/navbar', $data);
		$this->load->view('user/daftarUser_view', $data);
		$this->load->view('template/assets-footer', $data);
	}

	public function createAdmin()
 	{
 		$data['title'] = "Add Admin";
		$data['data_login']=$this->User_Model->getDataLogin();
		$data['notif']=$this->Transaksi_Model->getNotif();

 		$this->form_validation->set_rules('nama', 'Nama', 'trim|required|alpha_numeric_spaces|min_length[2]');
 		$this->form_validation->set_rules('no_identitas', 'NIP', 'trim|required|numeric|min_length[2]|callback_isNIMExist|callback_NIPTelahMenjadiMember|callback_NIMTelahMenjadiMember');
 		$this->form_validation->set_rules('email', 'Email', 'trim|required|min_length[5]|valid_email|callback_isEmailTerdaftar');
 		$this->form_validation->set_rules('no_hp', 'Nomor HP', 'trim|required|numeric|min_length[11]');
 		$this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[2]|callback_isUsernameUserExist');
		$this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');
		$this->form_validation->set_rules('jenis_kelamin', 'Jenis Kelamin', 'trim|required');
		$this->form_validation->set_rules('alamat', 'Alamat', 'required');
		

		if ($this->form_validation->run()==FALSE) {
			$this->load->view('template/assets-header', $data);
			$this->load->view('template/navbar', $data);
			$this->load->view('user/tambahAdmin_view', $data);
			$this->load->view('template/assets-footer', $data);
		} else {
			$config['upload_path']			='./assets/uploads/Profil';
			$config['allowed_types']		='gif|jpg|png';
			$config['max_size']				=1000000000;
			$config['max_width']			=10240;
			$config['max_height']			=7680;
			$this->load->library('upload', $config);
			if( ! $this->upload->do_upload('userfile'))
			{
				$this->session->set_flashdata('eror', 'Masukkan Foto Profil Anda!');
				$this->load->view('template/assets-header', $data);
				$this->load->view('template/navbar', $data);
				$this->load->view('user/tambahAdmin_view', $data);
				$this->load->view('template/assets-footer', $data);
			}
			else
			{
				$this->User_Model->insertAdmin();
		    	$this->session->set_flashdata('sudah_input', 'Admin berhasil ditambahkan!');
		   		redirect('user','refresh');
			}
		}
	}

	public function createUser()
 	{
 		$data['title'] = "Add User";
		$data['data_login']=$this->User_Model->getDataLogin();
		$data['notif']=$this->Transaksi_Model->getNotif();

 		$this->form_validation->set_rules('nama', 'Nama', 'trim|required|alpha_numeric_spaces|min_length[2]');
 		$this->form_validation->set_rules('no_identitas', 'NIP', 'trim|required|numeric|min_length[2]|callback_isNIMExist|callback_NIPTelahMenjadiMember|callback_NIMTelahMenjadiMember');
 		$this->form_validation->set_rules('email', 'Email', 'trim|required|min_length[5]|valid_email|callback_isEmailTerdaftar');
 		$this->form_validation->set_rules('no_hp', 'Nomor HP', 'trim|required|numeric|min_length[11]');
 		$this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[2]|callback_isUsernameUserExist');
		$this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');
		$this->form_validation->set_rules('jenis_kelamin', 'Jenis Kelamin', 'trim|required');
		$this->form_validation->set_rules('alamat', 'Alamat', 'required');
		

		if ($this->form_validation->run()==FALSE) {
			$this->load->view('template/assets-header', $data);
			$this->load->view('template/navbar', $data);
			$this->load->view('user/tambahUser_view', $data);
			$this->load->view('template/assets-footer', $data, FALSE);
		} else {
			$config['upload_path']			='./assets/uploads/Profil';
			$config['allowed_types']		='gif|jpg|png';
			$config['max_size']				=1000000000;
			$config['max_width']			=10240;
			$config['max_height']			=7680;
			$this->load->library('upload', $config);
			if( ! $this->upload->do_upload('userfile'))
			{
				$this->session->set_flashdata('eror', 'Masukkan Foto Profil Anda!');
				$this->load->view('template/assets-header', $data);
				$this->load->view('template/navbar', $data);
				$this->load->view('user/tambahUser_view', $data);
				$this->load->view('template/assets-footer', $data);
			}
			else
			{
				$this->User_Model->insertUser();
		    	$this->session->set_flashdata('sudah_input', 'User berhasil ditambahkan!');
		   		redirect('user/user','refresh');
			}
		}
	}

	public function editUser($id_user)
	{
		$data['title'] = "Edit User";
		$data['data_login']=$this->User_Model->getDataLogin();
		$data['notif']=$this->Transaksi_Model->getNotif();
		$data['data_edit']=$this->User_Model->getDataUserForEdit($id_user);

		$this->form_validation->set_rules('nama', 'Nama', 'trim|alpha_numeric_spaces|required|min_length[2]');
 		$this->form_validation->set_rules('no_hp', 'Nomor HP', 'trim|required|numeric|min_length[11]');
		$this->form_validation->set_rules('alamat', 'Alamat', 'required');

		$this->load->model('User_Model');
		
		if($this->form_validation->run()==FALSE){
			$this->load->view('template/assets-header', $data);
			$this->load->view('template/navbar', $data);
			$this->load->view('user/editUser_view', $data);
			$this->load->view('template/assets-footer', $data);

		}else{
			$config['upload_path'] = './assets/uploads/Profil';
			$config['allowed_types'] = 'jpg|png';
			$config['max_size']  = 1000000;
			$config['max_width']  = 10240;
			$config['max_height']  = 7680;
			

			$this->load->library('upload', $config);
			
			if ( ! $this->upload->do_upload('userfile')){
				$this->User_Model->updateUserTanpaFoto($id_user);	
			}
			else{
				$this->User_Model->updateUser($id_user);
			}
			$this->session->set_flashdata('sudah_input', 'User Berhasil Diedit');
			redirect('user/user','refresh');
		}
	}

	public function adminDetail($id_user)
	{
		$data['title'] = "Detail Admin";
		$data['data_login']=$this->User_Model->getDataLogin();
		$data["admin_detail"] = $this->User_Model->getDetailByUser($id_user);
		$data['notif']=$this->Transaksi_Model->getNotif();

		$this->load->view('template/assets-header', $data);
		$this->load->view('template/navbar', $data);
		$this->load->view('user/detailAdmin_view', $data);
		$this->load->view('template/assets-footer', $data);
	}

	public function userDetail($id_user)
	{
		$data['title'] = "Detail User";
		$data['data_login']=$this->User_Model->getDataLogin();
		$data["user_detail"] = $this->User_Model->getDetailByUser($id_user);
		$data['notif']=$this->Transaksi_Model->getNotif();

		$this->load->view('template/assets-header', $data);
		$this->load->view('template/navbar', $data);
		$this->load->view('user/detailUser_view', $data);
		$this->load->view('template/assets-footer', $data);
	}

	public function identitas()
	{
		$data['title'] = "List Nomor Identitas";
		$data['data_login']=$this->User_Model->getDataLogin();
		$data["nim_list"] = $this->User_Model->getNIM();
		$data["nip_list"] = $this->User_Model->getNIP();
		$data['notif']=$this->Transaksi_Model->getNotif();

		$this->load->view('template/assets-header', $data);
		$this->load->view('template/navbar', $data);
		$this->load->view('user/daftarIdentitas_view', $data);
		$this->load->view('template/assets-footer', $data);
	}

	public function addNoIdentitas()
	{
		$data['title'] = "Add Nomor Identitas";
		$data['data_login']=$this->User_Model->getDataLogin();
		$data["nim_list"] = $this->User_Model->getNIM();
		$data["nip_list"] = $this->User_Model->getNIP();
		$data['notif']=$this->Transaksi_Model->getNotif();

		$this->form_validation->set_rules('no_identitas', 'Nomor Identitas', 'trim|required|numeric|min_length[2]|max_length[20]|callback_NIPTerdaftar|callback_NIMTerdaftar');
		$this->form_validation->set_rules('jenis', 'Jenis Identitas', 'trim|required');
		$this->load->model('User_Model');

		if ($this->form_validation->run()==FALSE) {
			$this->load->view('template/assets-header', $data);
			$this->load->view('template/navbar', $data);
			$this->load->view('user/daftarIdentitas_view', $data);
			$this->load->view('template/assets-footer', $data);
		} else {
			$this->User_Model->insertNoIdentitas();
			redirect('user/identitas','refresh');
		}
	}

	public function deleteNOID($no_identitas)
	{
		$terdaftar=$this->User_Model->isNIMExistTerdaftar($no_identitas);
		if ($terdaftar) {
			$this->session->set_flashdata('terdaftar', 'Tidak dapat menghapus, No Identitas tersebut telah terdaftar! Silahkan hapus membership terlebih dahulu.');
			redirect('user/identitas','refresh');
		} else {
			$this->session->set_flashdata('terhapus', 'Nomor Identitas Berhasil Dihapus');
			$this->load->model('User_Model');
			$this->User_Model->deleteNoIdentitas($no_identitas);
			redirect('user/identitas', 'refresh');
		}
	}

	public function deleteAdmin($id_user)
	{
		$data['title'] = "Delete Admin";
		$data['data_login']=$this->User_Model->getDataLogin();
		$data["admin_list"] = $this->User_Model->getDataAdmin();
		$data['notif']=$this->Transaksi_Model->getNotif();

		$this->form_validation->set_rules('password', 'Password', 'required|min_length[4]');

		if ($this->form_validation->run()==FALSE) {
			$this->load->view('template/assets-header', $data);
			$this->load->view('template/navbar', $data);
			$this->load->view('user/deleteAdmin_view', $data);
			$this->load->view('template/assets-footer', $data);
		} else {
			$pass = $this->input->post('password');
			$password = md5($pass);
			$getPassword = $this->User_Model->getPasswordtoDelete($id_user);
			
			foreach ($getPassword as $key) 
			{
	            $cocok = $key->password;
	        }

			if ($password == $cocok) {
				$this->User_Model->deleteUser($id_user);
				$this->session->set_flashdata('terhapus', 'Admin Berhasil Dihapus');
				redirect('user', 'refresh');
			} else {
				$this->session->set_flashdata('terhapus', 'Password Salah!');
				$this->load->view('template/assets-header', $data);
				$this->load->view('template/navbar', $data);
				$this->load->view('user/deleteAdmin_view', $data);
				$this->load->view('template/assets-footer', $data);
			}
		}
	}

	public function deleteUser($id_user)
	{
		$peminjaman = $this->User_Model->deleteBentrokPeminjaman($id_user);
		$pengembalian = $this->User_Model->deleteBentrokPengembalian($id_user);
		$report = $this->User_Model->deleteBentrokReport($id_user);
		if ($peminjaman) {
			$this->session->set_flashdata('gagal', 'Member gagal dihapus karena masih terikat dengan peminjaman!');
		} else if ($pengembalian) {
			$this->session->set_flashdata('gagal', 'Member gagal dihapus karena masih terikat dengan pengembalian!');
		} else if ($report) {
			$this->session->set_flashdata('gagal', 'Member gagal dihapus karena masih terikat dengan report!');
		} else if (!$peminjaman && !$pengembalian && !$report) {
			$this->session->set_flashdata('terhapus', 'Member Berhasil Dihapus');
			$this->User_Model->deleteUser($id_user);
		}
		
		redirect('user/user', 'refresh');
	}

	public function isUsernameUserExist($username) {
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
	    $this->load->model('User_Model');
	    $is_exist = $this->User_Model->isNIMExist($no_identitas);


	    if ($is_exist) {
	        return true;
	    } else {
	        $this->form_validation->set_message('isNIMExist', 'NIP anda tidak terdaftar, daftarkan NIP terlebih dahulu.');    
	        return false;
	    }
	}

	public function NIPTelahMenjadiMember($no_identitas) {
	    $this->load->model('User_Model');
	    $is_exist = $this->User_Model->NIPTelahMenjadiMember($no_identitas);

	    if ($is_exist) {
	     	$this->form_validation->set_message('NIPTelahMenjadiMember', 'NIP sudah terdaftar menjadi admin!.'); 
	        return false;
	        
	    } else {
	        return true;
	    }
	}

	public function NIMTelahMenjadiMember($no_identitas) {
	    $this->load->model('User_Model');
	    $is_exist = $this->User_Model->NIMTelahMenjadiMember($no_identitas);

	    if ($is_exist) {
	     	$this->form_validation->set_message('NIMTelahMenjadiMember', 'NIM sudah terdaftar menjadi member!.'); 
	        return false;
	        
	    } else {
	        return true;
	    }
	}


	public function isEmailTerdaftar($email) {
	    $this->load->model('User_Model');
	    $is_exist = $this->User_Model->isEmailTerdaftar($email);

	    if ($is_exist) {
	     	$this->form_validation->set_message('isEmailTerdaftar', 'Email sudah terdaftar menjadi admin.'); 
	        return false;
	        
	    } else {
	        return true;
	    }
	}

	public function NIPTerdaftar($no_identitas) {
	    $this->load->model('User_Model');
	    $is_exist = $this->User_Model->NIPTerdaftar($no_identitas);

	    if ($is_exist) {
	     	$this->form_validation->set_message('NIPTerdaftar', 'NIP sudah terdaftar!.'); 
	        return false;
	        
	    } else {
	        return true;
	    }
	}

	public function NIMTerdaftar($no_identitas) {
	    $this->load->model('User_Model');
	    $is_exist = $this->User_Model->NIMTerdaftar($no_identitas);

	    if ($is_exist) {
	     	$this->form_validation->set_message('NIMTerdaftar', 'NIM sudah terdaftar!.'); 
	        return false;
	        
	    } else {
	        return true;
	    }
	}

}

/* End of file User.php */
/* Location: ./application/controllers/User.php */
 ?>