<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class History extends CI_Controller {
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
        	$this->load->library('dompdf_gen');
        	$this->load->library('Excel_generator');
        	$this->load->database();
		}else{
			$this->session->set_flashdata('login_lagi', 'Anda sudah logout, silahkan login lagi!');
			redirect('login','refresh');
		}		
	}

	public function index()
	{
		if($this->session->userdata('logged_in_admin')){
			$data['title'] = "History Peminjaman";
			$data['data_login']=$this->User_Model->getDataLogin();
			$data['history_list']=$this->Transaksi_Model->getHistory();
			$data['notif']=$this->Transaksi_Model->getNotif();
			
			$getStatus=$this->User_Model->getDataLogin();
			foreach ($getStatus as $key) 
			{
	            	$status = $key->status;
	        }
			$data["status"] = $status;

			$this->load->view('template/assets-header', $data);
			$this->load->view('template/navbar', $data);
			$this->load->view('transaksi/history_view', $data);
			$this->load->view('template/assets-footer', $data, FALSE);
		}else{
			$this->session->set_flashdata('forbidden', 'Link yang anda tuju dilarang!');
			redirect('dashboard','refresh');
		}	
	}

	public function list()
	{
		$data['title'] = "History Peminjaman";
		$data['data_login']=$this->User_Model->getDataLogin();
		$data['history_list']=$this->Transaksi_Model->getHistoryById();
		$data['notif']=$this->Transaksi_Model->getNotif();

		$getStatus=$this->User_Model->getDataLogin();
		foreach ($getStatus as $key) 
		{
            	$status = $key->status;
        }
		$data["status"] = $status;

		$this->load->view('template/assets-header', $data);
		$this->load->view('template/navbar', $data);
		$this->load->view('transaksi/history_view', $data);
		$this->load->view('template/assets-footer', $data);
	}

	public function cetakpdf()
	{
		if($this->session->userdata('logged_in_admin')){
	        $data['title'] = 'Cetak PDF History Peminjaman'; 
	        $data['history'] = $this->Transaksi_Model->getHistory();
	 
	        $this->load->view('transaksi/cetakLaporan_view', $data);
	 
	        $paper_size  = 'A4';
	        $orientation = 'landscape';
	        $html = $this->output->get_output();
	 
	        $this->dompdf->set_paper($paper_size, $orientation);
	        
	        $this->dompdf->load_html($html);
	        $this->dompdf->render();
	        $this->dompdf->stream("LaporanPerpustakaan.pdf", array('Attachment'=>0));
        }else{
			$this->session->set_flashdata('forbidden', 'Link yang anda tuju dilarang!');
			redirect('dashboard','refresh');
		}	
    }

    public function cetakxls()
	{
		if($this->session->userdata('logged_in_admin')){
	        $data['title'] = 'Cetak XLS History Peminjaman'; 
	        $history = $this->Transaksi_Model->getHistoryXls();
	        $this->excel_generator->set_query($history);
	        $this->excel_generator->set_header(array('No Identitas', 'Nama', 'ID Buku', 'Judul', 'Tanggal Pinjam', 'Tanggak Kembali', 'Jatuh Tempo', 'Denda', 'Tanggal Dikembalikan'));
	        $this->excel_generator->set_column(array('no_identitas', 'nama', 'id_buku', 'judul', 'tanggal_pinjam', 'tanggal_kembali', 'jatuh_tempo', 'denda', 'tanggal_dikembalikan'));
	        $this->excel_generator->set_width(array(15, 25, 15, 35, 30, 30, 15, 10, 30));
	        $this->excel_generator->exportTo2007('History Peminjaman');

        }else{
			$this->session->set_flashdata('forbidden', 'Link yang anda tuju dilarang!');
			redirect('dashboard','refresh');
		}	
    }

    public function cetakpdfForYou()
	{
		if($this->session->userdata('logged_in_user')){
	        $data['title'] = 'Cetak PDF History Peminjaman'; 
	        $data['history'] = $this->Transaksi_Model->getHistoryById();
	 
	        $this->load->view('transaksi/cetakLaporan_view', $data);
	 
	        $paper_size  = 'A4';
	        $orientation = 'landscape';
	        $html = $this->output->get_output();
	 
	        $this->dompdf->set_paper($paper_size, $orientation);
	        
	        $this->dompdf->load_html($html);
	        $this->dompdf->render();
	        $this->dompdf->stream("LaporanPerpustakaan.pdf", array('Attachment'=>0));
        }else{
			$this->session->set_flashdata('forbidden', 'Link yang anda tuju dilarang!');
			redirect('dashboard','refresh');
		}	
    }

    public function cetakxlsForYou()
	{
		if($this->session->userdata('logged_in_user')){
	        $data['title'] = 'Cetak XLS History Peminjaman'; 
	        $history = $this->Transaksi_Model->getHistoryByIdXls();
	        $this->excel_generator->set_query($history);
	        $this->excel_generator->set_header(array('No Identitas', 'Nama', 'ID Buku', 'Judul', 'Tanggal Pinjam', 'Tanggak Kembali', 'Jatuh Tempo', 'Denda', 'Tanggal Dikembalikan'));
	        $this->excel_generator->set_column(array('no_identitas', 'nama', 'id_buku', 'judul', 'tanggal_pinjam', 'tanggal_kembali', 'jatuh_tempo', 'denda', 'tanggal_dikembalikan'));
	        $this->excel_generator->set_width(array(15, 25, 15, 35, 30, 30, 15, 10, 30));
	        $this->excel_generator->exportTo2007('History Peminjaman');

        }else{
			$this->session->set_flashdata('forbidden', 'Link yang anda tuju dilarang!');
			redirect('dashboard','refresh');
		}	
    }

}

/* End of file History.php */
/* Location: ./application/controllers/History.php */