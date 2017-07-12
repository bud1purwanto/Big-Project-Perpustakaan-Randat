<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengembalian extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		if($this->session->userdata('logged_in_admin')){
			$session_data = $this->session->userdata('logged_in_admin');
			$data['id_user'] = $session_data['id_user'];
			$this->load->model('User_Model');
			$this->load->model('Transaksi_Model');
		}elseif ($this->session->userdata('logged_in_user')) {
			redirect('dashboard','refresh');
		}else{
			$this->session->set_flashdata('login_lagi', 'Anda sudah logout, silahkan login lagi!');
			redirect('login','refresh');
		}		
	}

	public function create($id_pinjam)
	{
		$data['title'] = "Add Pengembalian";
		$data['data_login']=$this->User_Model->getDataLogin();
		$data['peminjaman_terdaftar']=$this->Transaksi_Model->getPeminjamanToPengembalian($id_pinjam);
		$data['notif']=$this->Transaksi_Model->getNotif();
		
		$getStatus=$this->User_Model->getDataLogin();
		foreach ($getStatus as $key) 
		{
            	$status = $key->status;
        }
		$data["status"] = $status;

		$getSetting=$this->Transaksi_Model->getSetting();
		foreach ($getSetting as $key) 
		{
            	$denda = $key->denda;
	           	$peminjaman = $key->peminjaman;
	           	$toleransi = $key->toleransi;
	    }
		$data["dendadinamis"] = $denda;
		$data["peminjaman"] = $peminjaman;
		$data["toleransi"] = $toleransi;

		$this->form_validation->set_rules('jatuh_tempo', 'Jatuh Tempo', 'required');
		$this->form_validation->set_rules('denda', 'Denda', 'required');
		$this->form_validation->set_rules('tanggal_dikembalikan', 'Tanggal Dikembalikan', 'required');

		if ($this->form_validation->run()==FALSE) {
			$this->load->view('template/assets-header', $data);
			$this->load->view('template/navbar', $data);
			$this->load->view('transaksi/inputPengembalian_view', $data);
			$this->load->view('template/assets-footer', $data);
		} else {
			$this->Transaksi_Model->tambahPengembalian();
			$this->Transaksi_Model->tambahiStokBuku();
			$this->Transaksi_Model->editStatusPeminjaman();	
			$this->session->set_flashdata('berhasil', 'Pengembalian Berhasil ditambahkan!');
			redirect('history','refresh');
		}			
	}

	public function delete($id_kembali)
	{
		$this->Transaksi_Model->deletePengembalianToDel($id_kembali);
		redirect('history','refresh');
	}
}

/* End of file Pengembalian.php */
/* Location: ./application/controllers/Pengembalian.php */