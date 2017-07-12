<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Buku_Pengarang extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		if($this->session->userdata('logged_in_admin')){
			$session_data = $this->session->userdata('logged_in_admin');
			$data['id_user'] = $session_data['id_user'];
			$this->load->model('Buku_Model');	
			$this->load->model('User_Model');
			$this->load->model('Transaksi_Model');
		}elseif ($this->session->userdata('logged_in_user')) {
			redirect('dashboard','refresh');
		}else{
			$this->session->set_flashdata('login_lagi', 'Anda sudah logout, silahkan login lagi!');
			redirect('login','refresh');
		}	
	}

	public function index()
	{
		$data['title'] = "List Pengarang Buku";
		$data['data_login']=$this->User_Model->getDataLogin();
		$data['notif']=$this->Transaksi_Model->getNotif();
		$data["buku_pengarang"] = $this->Buku_Model->getBukuPengarang();

		$getStatus=$this->User_Model->getDataLogin();
		foreach ($getStatus as $key) 
		{
            	$status = $key->status;
        }
		$data["status"] = $status;

 		$this->load->view('template/assets-header', $data);
		$this->load->view('template/navbar', $data);
		$this->load->view('buku/daftarBukuPengarang_view', $data);
		$this->load->view('template/assets-footer', $data);
	}


	public function delete($id)
	{
		$this->load->model('Buku_Model');
		$this->session->set_flashdata('terhapus', 'Pengarang Buku Berhasil Dihapus');
		$this->Buku_Model->deleteBukuPengarang($id);
		redirect('Buku_Pengarang', 'refresh');
		
	}

}

/* End of file Kategori.php */
/* Location: ./application/controllers/Kategori.php */ ?>