<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report extends CI_Controller {
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
			$this->load->model('Report_Model');
			$this->load->model('Transaksi_Model');
		}else{
			$this->session->set_flashdata('login_lagi', 'Anda sudah logout, silahkan login lagi!');
			redirect('login','refresh');
		}		
	}

	public function index()
	{
		if($this->session->userdata('logged_in_admin')){
			$data['title'] = "List Report";
			$data['data_login']=$this->User_Model->getDataLogin();
			$data['notif']=$this->Transaksi_Model->getNotif();
			
			$getStatus=$this->User_Model->getDataLogin();
			foreach ($getStatus as $key) 
			{
	            	$status = $key->status;
	        }
			$data["status"] = $status;

			$data['report_list'] = $this->Report_Model->getReport();
			$this->load->view('template/assets-header', $data);
			$this->load->view('template/navbar', $data);
			$this->load->view('report/reportUser_view', $data);
			$this->load->view('template/assets-footer', $data);
		}else{
			$this->session->set_flashdata('forbidden', 'Link yang anda tuju dilarang!');
			redirect('dashboard','refresh');
		}
	}

	public function listUser()
	{
		$data['title'] = "List Report";
		$data['data_login']=$this->User_Model->getDataLogin();
		$data['notif']=$this->Transaksi_Model->getNotif();

		$getStatus=$this->User_Model->getDataLogin();
		foreach ($getStatus as $key) 
		{
            	$status = $key->status;
        }
		$data["status"] = $status;
		
		$data['report_list'] = $this->Report_Model->getReportById();
		$this->load->view('template/assets-header', $data);
		$this->load->view('template/navbar', $data);
		$this->load->view('report/reportUser_view', $data);
		$this->load->view('template/assets-footer', $data);
	}

	public function create()
	{
		if($this->session->userdata('logged_in_user')){
			$data['title'] = "Add Report";
			$data['data_login']=$this->User_Model->getDataLogin();
			$data['notif']=$this->Transaksi_Model->getNotif();

			$this->form_validation->set_rules('subjek', 'Tema', 'required');
			$this->form_validation->set_rules('isi', 'isi', 'required|min_length[4]');

			if ($this->form_validation->run()==FALSE) {
				$this->load->view('template/assets-header', $data);
				$this->load->view('template/navbar', $data);
				$this->load->view('report/inputReport_view', $data);
				$this->load->view('template/assets-footer', $data);
			} else {
				$this->Report_Model->insertReport();
				$this->session->set_flashdata('report', 'Report Berhasil Ditambahkan!');
				redirect('report/listUser','refresh');
			}
		}else{
			$this->session->set_flashdata('forbidden', 'Link yang anda tuju dilarang!');
			redirect('dashboard','refresh');
		}
	}

	public function deleteUserReport($id_report)
	{
		if($this->session->userdata('logged_in_admin')){
			$this->load->model('Report_Model');
			$this->Report_Model->deleteReport($id_report);
			redirect('report','refresh');
		}else{
			$this->session->set_flashdata('forbidden', 'Link yang anda tuju dilarang!');
			redirect('dashboard','refresh');
		}
	}

}

/* End of file Report.php */
/* Location: ./application/controllers/Report.php */