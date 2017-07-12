<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Peminjaman extends CI_Controller {
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
			$this->load->model('Transaksi_Model');
		}else{
			$this->session->set_flashdata('login_lagi', 'Anda sudah logout, silahkan login lagi!');
			redirect('login','refresh');
		}		
	}

	public function index()
	{
		$data['title'] = "List Peminjaman";
		$data['data_login']=$this->User_Model->getDataLogin();
		$data['peminjaman_list']=$this->Transaksi_Model->getPeminjaman();
		$data['notif']=$this->Transaksi_Model->getNotif();
		$data['setting']=$this->Transaksi_Model->getSetting();

		$getStatus=$this->User_Model->getDataLogin();
		foreach ($getStatus as $key) 
		{
            	$status = $key->status;
        }
		$data["status"] = $status;

		$this->form_validation->set_rules('id_user', 'ID User', 'required');
		$this->form_validation->set_rules('nama', 'Nama', 'required');
		$this->form_validation->set_rules('judul', 'Judul', 'required');
		$this->form_validation->set_rules('tanggal_pinjam', 'Tanggal Pinjam', 'required');
		$this->form_validation->set_rules('tanggal_kembali', 'Tanggal Kembali', 'required');

		if ($this->form_validation->run()==FALSE) {
			$this->load->view('template/assets-header', $data);
			$this->load->view('template/navbar', $data);
			$this->load->view('transaksi/daftarPeminjaman_view', $data);
			$this->load->view('template/assets-footer-2', $data);
		} else {
			$getSetting=$this->Transaksi_Model->getSetting();
			foreach ($getSetting as $key) 
			{
	            	$peminjaman = $key->peminjaman;
	        }

			$overload = $this->Transaksi_Model->MaxPinjam();
			
			if ($overload >= $peminjaman) {
				$this->session->set_flashdata('overload', 'User tersebut sudah mencapai batas '.$peminjaman.' peminjaman');
				$this->load->view('template/assets-header', $data);
				$this->load->view('template/navbar', $data);
				$this->load->view('transaksi/daftarPeminjaman_view', $data);
			} else {	
				$this->Transaksi_Model->tambahPeminjaman();
				$this->Transaksi_Model->kurangiStokBuku();	
				$this->session->set_flashdata('berhasil', 'Peminjaman Berhasil ditambahkan!');
				redirect('peminjaman','refresh');
			}
			
		}	
	}

	public function edit($id_pinjam)
	{
		if($this->session->userdata('logged_in_admin')){
			$data['title'] = "Edit Peminjaman";
			$data['data_login']=$this->User_Model->getDataLogin();
			$data['peminjaman_list']=$this->Transaksi_Model->getPeminjaman();
			$data['notif']=$this->Transaksi_Model->getNotif();
			$data['setting']=$this->Transaksi_Model->getSetting();
			$data['data_pinjam']=$this->Transaksi_Model->getPeminjamanToEdit($id_pinjam);
			
			$getStatus=$this->User_Model->getDataLogin();
			foreach ($getStatus as $key) 
			{
	            	$status = $key->status;
	        }
			$data["status"] = $status;

			$this->form_validation->set_rules('tanggal_kembali', 'Tanggal Kembali', 'required');
			$this->form_validation->set_rules('status', 'Status', 'required');

			if ($this->form_validation->run()==FALSE) {
				$this->load->view('template/assets-header', $data);
				$this->load->view('template/navbar', $data);
				$this->load->view('transaksi/editPeminjaman_view', $data);
				$this->load->view('template/assets-footer', $data);
			} else {
				$this->Transaksi_Model->editPeminjaman($id_pinjam);
				$this->Transaksi_Model->kurangiStokBuku();
				$exis=$this->Transaksi_Model->peminjamanDiPengembalian($id_pinjam);
				if ($exis) {
					$this->Transaksi_Model->deletePengembalian($id_pinjam);
				}
		 		$this->session->set_flashdata('berhasil', 'Peminjaman Berhasil diedit!');
				redirect('peminjaman','refresh');
			}	
		}else{
			$this->session->set_flashdata('forbidden', 'Link yang anda tuju dilarang!');
			redirect('dashboard','refresh');
		}

	}

	public function list()
	{
		$data['title'] = "List Peminjaman";
		$data['data_login']=$this->User_Model->getDataLogin();
		$data['peminjaman_list']=$this->Transaksi_Model->getPeminjamanById();
		$data['notif']=$this->Transaksi_Model->getNotif();
		
		$getStatus=$this->User_Model->getDataLogin();
		foreach ($getStatus as $key) 
		{
            	$status = $key->status;
        }
		$data["status"] = $status;
		$this->load->view('template/assets-header', $data);
		$this->load->view('template/navbar', $data);
		$this->load->view('transaksi/daftarPeminjaman_view', $data);
	}

	public function delete($id_pinjam)
	{
		$exis=$this->Transaksi_Model->peminjamanDiPengembalian($id_pinjam);
		if ($exis) {
			$this->session->set_flashdata('overload', 'Peminjaman gagal dihapus karena data ini masih terdapat dalam data pengembalian');
		} else {
			$this->Transaksi_Model->deletePeminjaman($id_pinjam);
		}
		redirect('peminjaman','refresh');
		
	}

}

/* End of file Peminjaman.php */
/* Location: ./application/controllers/Peminjaman.php */