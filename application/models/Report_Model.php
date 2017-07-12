<?php
 defined('BASEPATH') OR exit('No direct script access allowed');
 
 class Report_Model extends CI_Model {
 	public function getReport()
	{
		$this->db->select("report.id_report, user.no_identitas, user.nama, report.subjek, report.isi, report.tanggal");
		$this->db->join('user', 'user.id_user = report.id_user', 'left');
		$this->db->order_by('tanggal', 'desc');
		$query = $this->db->get('report');
		return $query->result();
	}

	public function getReportById()
	{
		if ($this->session->userdata('logged_in_admin')) {
			$session_data = $this->session->userdata('logged_in_admin');
		} else {
			$session_data = $this->session->userdata('logged_in_user');
		}

		$data['id_user'] = $session_data['id_user'];
		$id_user=$data['id_user'];

		$this->db->select("report.id_report, user.no_identitas, user.nama, report.subjek, report.isi, report.tanggal");
		$this->db->where('user.id_user', $id_user);
		$this->db->join('user', 'user.id_user = report.id_user', 'left');
		$query = $this->db->get('report');
		return $query->result();
	}

	public function insertReport()
	{
		if ($this->session->userdata('logged_in_admin')) {
			$session_data = $this->session->userdata('logged_in_admin');
		} else {
			$session_data = $this->session->userdata('logged_in_user');
		}
		
		$data['id_user'] = $session_data['id_user'];
		$id_user=$data['id_user'];
		$tanggal = date("Ymd");
	
		$insert_report = array(
				'subjek' => $this->input->post('subjek'),
				'isi' => $this->input->post('isi'),
				'tanggal' => $tanggal,
				'id_user' => $id_user,
			);

		$this->db->insert('report', $insert_report);
	}
 	
	public function deleteReport($id_report)
	{
		$this->db->where('id_report', $id_report);
		$this->db->delete('report');
	}
 }
 
 /* End of file Report_Model.php */
 /* Location: ./application/models/Report_Model.php */ ?>