<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Penerbit extends CI_Controller {
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
		$data['title'] = "List Penerbit";
		$data['data_login']=$this->User_Model->getDataLogin();
		$data['notif']=$this->Transaksi_Model->getNotif();
		$data["penerbit_list"] = $this->Buku_Model->getPenerbit();

		$getStatus=$this->User_Model->getDataLogin();
		foreach ($getStatus as $key) 
		{
            	$status = $key->status;
        }
		$data["status"] = $status;

 		$this->load->view('template/assets-header', $data);
		$this->load->view('template/navbar', $data);
		$this->load->view('buku/daftarPenerbit_view', $data);
		$this->load->view('template/assets-footer', $data);
	}

	public function create()
 	{
 		$data['title'] = "Add Penerbit";
 		$data['data_login']=$this->User_Model->getDataLogin();
 		$getStatus=$this->User_Model->getDataLogin();
 		$data['notif']=$this->Transaksi_Model->getNotif();
 		$data["penerbit_list"] = $this->Buku_Model->getPenerbit();

		foreach ($getStatus as $key) 
		{
            	$status = $key->status;
        }
		$data["status"] = $status;
 		
 		$this->form_validation->set_rules('nama_penerbit', 'Nama Penerbit', 'trim|required|min_length[2]');
 		$this->form_validation->set_rules('alamat', 'Alamat', 'trim|required');
 		$this->form_validation->set_rules('no_hp', 'Nomor HP', 'trim|required|min_length[10]');

		if ($this->form_validation->run()==FALSE) {
			$this->load->view('template/assets-header', $data);
			$this->load->view('template/navbar', $data);
			$this->load->view('buku/daftarPenerbit_view', $data);
			$this->load->view('template/assets-footer', $data);
		} else { 
			$penerbit = $this->Buku_Model->penerbitSudahDiInput();
			if ($penerbit) {
				$this->session->set_flashdata('gagal', 'Penerbit sudah ada!');
			} else {
				$this->Buku_Model->insertPenerbit();
	    		$this->session->set_flashdata('sudah_input', 'Penerbit sudah ditambah!');
			} 	
	   		redirect('penerbit','refresh');
		}
	}

	public function edit($id_penerbit)
	{
		if($this->session->userdata('logged_in_admin')){
			$data['title'] = "Edit Penerbit";
			$data['data_login']=$this->User_Model->getDataLogin();
			$data['get_penerbit']=$this->Buku_Model->getPenerbitById($id_penerbit);
			$data['notif']=$this->Transaksi_Model->getNotif();
			
			$this->form_validation->set_rules('nama_penerbit', 'Nama Penerbit', 'trim|required|min_length[2]');
	 		$this->form_validation->set_rules('alamat', 'Alamat', 'required');
	 		$this->form_validation->set_rules('no_hp', 'Nomor HP', 'trim|required|numeric|min_length[11]');
			
			if($this->form_validation->run()==FALSE){
				$this->load->view('template/assets-header', $data);
				$this->load->view('template/navbar', $data);
				$this->load->view('buku/editPenerbit_view', $data);
				$this->load->view('template/assets-footer', $data);

			}else{
				$this->Buku_Model->editPenerbit($id_penerbit);
				redirect('penerbit','refresh');
			}
		}else{
			$this->session->set_flashdata('forbidden', 'Link yang anda tuju dilarang!');
			redirect('dashboard','refresh');
		}
	}

	public function delete($id_penerbit)
	{
		if($this->session->userdata('logged_in_admin')){
			$this->load->model('Buku_Model');
		
			$terdaftar=$this->Buku_Model->penerbitTerdaftar($id_penerbit);
			if ($terdaftar) {
				$this->session->set_flashdata('fail', 'Tidak dapat menghapus, Penerbit tersebut telah terdaftar dalam buku! Silahkan hapus buku yang bersangkutan terlebih dahulu.');
				redirect('penerbit','refresh');
			} else {
				$this->session->set_flashdata('terhapus', 'Penerbit Berhasil Dihapus');
				$this->Buku_Model->deletePenerbit($id_penerbit);
				redirect('penerbit', 'refresh');
			}
		}else{
			$this->session->set_flashdata('forbidden', 'Link yang anda tuju dilarang!');
			redirect('dashboard','refresh');
		}
	}

}

/* End of file Penerbit.php */
/* Location: ./application/controllers/Penerbit.php */ ?>