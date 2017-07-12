<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengarang extends CI_Controller {
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
			$this->load->model('User_Model');
			$this->load->model('Buku_Model');
			$this->load->model('Transaksi_Model');
		}else{
			$this->session->set_flashdata('login_lagi', 'Anda sudah logout, silahkan login lagi!');
			redirect('login','refresh');
		}		
	}

	public function index()
	{
		$data['title'] = "List Pengarang";
		$data['data_login']=$this->User_Model->getDataLogin();
		$data['notif']=$this->Transaksi_Model->getNotif();
		$data["pengarang_list"] = $this->Buku_Model->getPengarang();

		$getStatus=$this->User_Model->getDataLogin();
		foreach ($getStatus as $key) 
		{
            	$status = $key->status;
        }
		$data["status"] = $status;
 		
 		$this->load->view('template/assets-header', $data);
		$this->load->view('template/navbar', $data);
		$this->load->view('buku/daftarPengarang_view', $data);
		$this->load->view('template/assets-footer', $data);
	}

	public function create()
 	{
 		$data['title'] = "Add Pengarang";
 		$data['data_login']=$this->User_Model->getDataLogin();
 		$data["pengarang_list"] = $this->Buku_Model->getPengarang();
 		$data['notif']=$this->Transaksi_Model->getNotif();

 		$getStatus=$this->User_Model->getDataLogin();
		foreach ($getStatus as $key) 
		{
            	$status = $key->status;
        }
		$data["status"] = $status;

 		$this->form_validation->set_rules('nama_pengarang', 'Nama Pengarang', 'trim|required|min_length[2]');
 		$this->form_validation->set_rules('alamat', 'Alamat', 'trim|required');
 		$this->form_validation->set_rules('no_hp', 'Nomor HP', 'trim|required|min_length[10]');

		if ($this->form_validation->run()==FALSE) {
			$this->load->view('template/assets-header', $data);
			$this->load->view('template/navbar', $data);
			$this->load->view('buku/daftarPengarang_view', $data);
			$this->load->view('template/assets-footer', $data);
		} else { 
			$pengarang = $this->Buku_Model->pengarangSudahDiInput();
			if ($pengarang) {
				$this->session->set_flashdata('gagal', 'Pengarang sudah ada!');
			} else {
				$this->Buku_Model->insertPengarang();
	    		$this->session->set_flashdata('sudah_input', 'Pengarang sudah ditambah!');
			} 	
	   		redirect('pengarang','refresh');
		}
	}

	public function edit($id_pengarang)
	{
		if($this->session->userdata('logged_in_admin')){
			$data['title'] = "Edit Pengarang";
			$data['data_login']=$this->User_Model->getDataLogin();
			$data['get_pengarang']=$this->Buku_Model->getPengarangById($id_pengarang);
			$data['notif']=$this->Transaksi_Model->getNotif();
			
			$this->form_validation->set_rules('nama_pengarang', 'Nama Pengarang', 'trim|required|min_length[2]');
	 		$this->form_validation->set_rules('alamat', 'Alamat', 'required');
	 		$this->form_validation->set_rules('no_hp', 'Nomor HP', 'trim|required|numeric|min_length[11]');
			
			if($this->form_validation->run()==FALSE){
				$this->load->view('template/assets-header', $data);
				$this->load->view('template/navbar', $data);
				$this->load->view('buku/editPengarang_view', $data);
				$this->load->view('template/assets-footer', $data);
			}else{
				$this->Buku_Model->editPengarang($id_pengarang);
				redirect('pengarang','refresh');
			}
		}else{
			$this->session->set_flashdata('forbidden', 'Link yang anda tuju dilarang!');
			redirect('dashboard','refresh');
		}
	}

	public function delete($id_pengarang)
	{
		if($this->session->userdata('logged_in_admin')){
			$this->load->model('Buku_Model');
		
			$terdaftar=$this->Buku_Model->pengarangTerdaftar($id_pengarang);
			if ($terdaftar) {
				$this->session->set_flashdata('fail', 'Tidak dapat menghapus, Pengarang tersebut telah terdaftar dalam buku! Silahkan hapus buku yang bersangkutan terlebih dahulu.');
				redirect('pengarang','refresh');
			} else {
				$this->session->set_flashdata('terhapus', 'Pengarang Berhasil Dihapus');
				$this->Buku_Model->deletePengarang($id_pengarang);
				redirect('pengarang', 'refresh');
			}
		}else{
			$this->session->set_flashdata('forbidden', 'Link yang anda tuju dilarang!');
			redirect('dashboard','refresh');
		}
	}

}

/* End of file Pengarang.php */
/* Location: ./application/controllers/Pengarang.php */ ?>