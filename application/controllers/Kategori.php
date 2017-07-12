<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kategori extends CI_Controller {
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
		
		$data['title'] = "List Kategori";
		$data['data_login']=$this->User_Model->getDataLogin();
		$data['notif']=$this->Transaksi_Model->getNotif();
		$data["kategori_list"] = $this->Buku_Model->getKategori();

		$getStatus=$this->User_Model->getDataLogin();
		foreach ($getStatus as $key) 
		{
            	$status = $key->status;
        }
		$data["status"] = $status;

 		$this->load->view('template/assets-header', $data);
		$this->load->view('template/navbar', $data);
		$this->load->view('buku/daftarKategori_view', $data);
		$this->load->view('template/assets-footer', $data);
	}

	public function create()
 	{
 		$data['title'] = "Add Kategori";
 		$data['data_login']=$this->User_Model->getDataLogin();
 		$data['notif']=$this->Transaksi_Model->getNotif();
 		$data["kategori_list"] = $this->Buku_Model->getKategori();

 		$getStatus=$this->User_Model->getDataLogin();
		foreach ($getStatus as $key) 
		{
            	$status = $key->status;
        }
		$data["status"] = $status;
 		
 		$this->form_validation->set_rules('nama_kategori', 'Nama Kategori', 'trim|required|min_length[2]');

		if ($this->form_validation->run()==FALSE) {
			$this->load->view('template/assets-header', $data);
			$this->load->view('template/navbar', $data);
			$this->load->view('buku/daftarKategori_view', $data);
			$this->load->view('template/assets-footer', $data);
		} else { 
			$kategori = $this->Buku_Model->kategoriSudahDiInput();
			if ($kategori) {
				$this->session->set_flashdata('gagal', 'Kategori sudah ada!');
			} else {
				$this->Buku_Model->insertKategori();
	    		$this->session->set_flashdata('sudah_input', 'Kategori sudah ditambah!');
			}
			redirect('kategori','refresh');
		}
	}

	public function edit($id_kategori)
	{
		if($this->session->userdata('logged_in_admin')){
	 		$data['title'] = "Edit Kategori";
			$data['data_login']=$this->User_Model->getDataLogin();
			$data['get_kategori']=$this->Buku_Model->getKategoriById($id_kategori);
			$data['notif']=$this->Transaksi_Model->getNotif();

			$this->form_validation->set_rules('nama_kategori', 'Nama Kategori', 'trim|required|min_length[2]');
	 
			if($this->form_validation->run()==FALSE){
				$this->load->view('template/assets-header', $data);
				$this->load->view('template/navbar', $data);
				$this->load->view('buku/editKategori_view', $data);
				$this->load->view('template/assets-footer', $data);

			}else{
				$this->Buku_Model->editKategori($id_kategori);
				redirect('kategori','refresh');
			}
		}else{
			$this->session->set_flashdata('forbidden', 'Link yang anda tuju dilarang!');
			redirect('dashboard','refresh');
		}
	}

	public function delete($id_kategori)
	{
		if($this->session->userdata('logged_in_admin')){
			$this->load->model('Buku_Model');
		
			$terdaftar=$this->Buku_Model->kategoriTerdaftar($id_kategori);
			if ($terdaftar) {
				$this->session->set_flashdata('fail', 'Tidak dapat menghapus, Kategori tersebut telah terdaftar dalam buku! Silahkan hapus buku yang bersangkutan terlebih dahulu.');
				redirect('kategori','refresh');
			} else {
				$this->session->set_flashdata('terhapus', 'Kategori Berhasil Dihapus');
				$this->Buku_Model->deleteKategori($id_kategori);
				redirect('kategori', 'refresh');
			}
		}else{
			$this->session->set_flashdata('forbidden', 'Link yang anda tuju dilarang!');
			redirect('dashboard','refresh');
		}
	}

}

/* End of file Kategori.php */
/* Location: ./application/controllers/Kategori.php */ ?>