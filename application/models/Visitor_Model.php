<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Visitor_Model extends CI_Model {
	public function getGaleri()
	{
		$this->db->select("id_galeri, foto");
		$query = $this->db->get('galeri');
		return $query->result();
	}

	public function addGaleri()
	{
		$insert_foto = array(
			'foto' => $this->upload->data('file_name'),
		);
		$this->db->insert('galeri', $insert_foto);
	}

	public function deleteGaleri($id_galeri)
	{
		$this->db->where('id_galeri', $id_galeri);
		$this->db->delete('galeri');
	}

 	public function cekVisitor()
	{	
		$session_data = $this->session->userdata('visitor');
		$data['ip'] = $session_data['ip'];
		$data['tanggal'] = $session_data['tanggal'];
		$data['online'] = $session_data['online'];
		$ip=$data['ip'];
		$tanggal=$data['tanggal'];
		$online=$data['online'];

		$this->db->select("ip, tanggal, hits, online");
		$this->db->from('visitor');
		$this->db->where('ip', $ip);
		$this->db->where('tanggal', $tanggal);
		$query = $this->db->get();

	    if ($query->num_rows() > 0) {
	        return true;
	    } else {
	        return false;
	    }
	}

	public function insertVisitor()
	{
		$session_data = $this->session->userdata('visitor');
		$data['ip'] = $session_data['ip'];
		$data['tanggal'] = $session_data['tanggal'];
		$data['online'] = $session_data['online'];
		$ip=$data['ip'];
		$tanggal=$data['tanggal'];
		$online=$data['online'];

		$insert_visitor = array(
				'ip' => $ip,
				'tanggal' => $tanggal,
				'hits' => '1',
				'online' => $online,
			);
			$this->db->insert('visitor', $insert_visitor);
	}

	public function updateVisitor()
	{
		$session_data = $this->session->userdata('visitor');
		$data['ip'] = $session_data['ip'];
		$data['tanggal'] = $session_data['tanggal'];
		$data['online'] = $session_data['online'];
		$ip=$data['ip'];
		$tanggal=$data['tanggal'];
		$online=$data['online'];


		$query = $this->db->query("UPDATE visitor SET hits=hits+1, online='$online' WHERE ip='$ip' AND tanggal='$tanggal'");
		return $query;
	}

	public function hariIni()
	{
		$session_data = $this->session->userdata('visitor');
		$data['ip'] = $session_data['ip'];
		$data['tanggal'] = $session_data['tanggal'];
		$data['online'] = $session_data['online'];
		$ip=$data['ip'];
		$tanggal=$data['tanggal'];
		$online=$data['online'];

		$this->db->like('ip');
		$this->db->from('visitor');
		$this->db->where('tanggal', $tanggal);
		$this->db->group_by('ip');
		$query = $this->db->count_all_results();
		return $query;
	}
 
 	public function totalPengunjung()
	{
		$session_data = $this->session->userdata('visitor');
		$data['ip'] = $session_data['ip'];
		$data['tanggal'] = $session_data['tanggal'];
		$data['online'] = $session_data['online'];
		$ip=$data['ip'];
		$tanggal=$data['tanggal'];
		$online=$data['online'];


		$this->db->select_sum('hits');
    	$this->db->from('visitor');

   	 	$query = $this->db->get();
    	return $query->row()->hits;
		return $query;
	}

	public function onLine()
	{
		$session_data = $this->session->userdata('visitor');
		$data['ip'] = $session_data['ip'];
		$data['tanggal'] = $session_data['tanggal'];
		$data['online'] = $session_data['online'];
		$ip=$data['ip'];
		$tanggal=$data['tanggal'];
		$online=$data['online'];

		$bataswaktu = time() - 300;

		$this->db->select('online');
		$this->db->from('visitor');
		$this->db->where('online >', $bataswaktu);
		$this->db->group_by('ip');
		$query = $this->db->count_all_results();
		return $query;
	}
 }
 
 /* End of file Visitor_Model.php */
 /* Location: ./application/models/Visitor_Model.php */ ?>