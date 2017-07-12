<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaksi_Model extends CI_Model {
	
	public function getHistory()
	{
		$this->db->select("pengembalian.id_kembali, user.id_user, user.no_identitas, user.nama, buku.id_buku, buku.judul, peminjaman.tanggal_pinjam, peminjaman.tanggal_kembali, pengembalian.jatuh_tempo, pengembalian.tanggal_dikembalikan, pengembalian.denda");
		$this->db->join('user', 'user.id_user = pengembalian.id_user', 'left');	
		$this->db->join('buku', 'buku.id_buku = pengembalian.id_buku', 'left');
		$this->db->join('peminjaman', 'peminjaman.id_pinjam = pengembalian.id_pinjam', 'left');	
		$this->db->order_by('pengembalian.tanggal_dikembalikan', 'desc');
		$query = $this->db->get('pengembalian');
		return $query->result();
	}

	public function getHistoryXls()
	{
		$this->db->select("pengembalian.id_kembali, user.id_user, user.no_identitas, user.nama, buku.id_buku, buku.judul, peminjaman.tanggal_pinjam, peminjaman.tanggal_kembali, pengembalian.jatuh_tempo, pengembalian.tanggal_dikembalikan, pengembalian.denda");
		$this->db->join('user', 'user.id_user = pengembalian.id_user', 'left');	
		$this->db->join('buku', 'buku.id_buku = pengembalian.id_buku', 'left');
		$this->db->join('peminjaman', 'peminjaman.id_pinjam = pengembalian.id_pinjam', 'left');	
		$this->db->order_by('pengembalian.tanggal_dikembalikan', 'desc');
		$query = $this->db->get('pengembalian');
		return $query;
	}

	public function getHistoryById()
	{
		if ($this->session->userdata('logged_in_admin')) {
			$session_data = $this->session->userdata('logged_in_admin');
		} else {
			$session_data = $this->session->userdata('logged_in_user');
		}

		$data['id_user'] = $session_data['id_user'];
		$id_user=$data['id_user'];

		$this->db->select("pengembalian.id_kembali, user.id_user, user.no_identitas, user.nama, buku.id_buku, buku.judul, peminjaman.tanggal_pinjam, peminjaman.tanggal_kembali, pengembalian.jatuh_tempo, pengembalian.tanggal_dikembalikan, pengembalian.denda");
		$this->db->where('user.id_user', $id_user);
		$this->db->join('user', 'user.id_user = pengembalian.id_user', 'left');	
		$this->db->join('buku', 'buku.id_buku = pengembalian.id_buku', 'left');
		$this->db->join('peminjaman', 'peminjaman.id_pinjam = pengembalian.id_pinjam', 'left');	
		$this->db->order_by('pengembalian.tanggal_dikembalikan', 'desc');
		$query = $this->db->get('pengembalian');
		return $query->result();
	}

	public function getHistoryByIdXls()
	{
		if ($this->session->userdata('logged_in_admin')) {
			$session_data = $this->session->userdata('logged_in_admin');
		} else {
			$session_data = $this->session->userdata('logged_in_user');
		}

		$data['id_user'] = $session_data['id_user'];
		$id_user=$data['id_user'];

		$this->db->select("pengembalian.id_kembali, user.id_user, user.no_identitas, user.nama, buku.id_buku, buku.judul, peminjaman.tanggal_pinjam, peminjaman.tanggal_kembali, pengembalian.jatuh_tempo, pengembalian.tanggal_dikembalikan, pengembalian.denda");
		$this->db->where('user.id_user', $id_user);
		$this->db->join('user', 'user.id_user = pengembalian.id_user', 'left');	
		$this->db->join('buku', 'buku.id_buku = pengembalian.id_buku', 'left');
		$this->db->join('peminjaman', 'peminjaman.id_pinjam = pengembalian.id_pinjam', 'left');	
		$this->db->order_by('pengembalian.tanggal_dikembalikan', 'desc');
		$query = $this->db->get('pengembalian');
		return $query;
	}

	public function getNotif()
	{
		if ($this->session->userdata('logged_in_admin')) {
			$session_data = $this->session->userdata('logged_in_admin');
		} else {
			$session_data = $this->session->userdata('logged_in_user');
		}

		$data['id_user'] = $session_data['id_user'];
		$id_user=$data['id_user'];

		$this->db->select("peminjaman.id_pinjam, user.id_user, user.no_identitas, user.nama, buku.id_buku, buku.id_buku, buku.judul, peminjaman.tanggal_pinjam, peminjaman.tanggal_kembali, peminjaman.status");
		$this->db->where('user.id_user', $id_user);
		$this->db->where('peminjaman.status', "Belum Kembali");
		$this->db->join('user', 'user.id_user = peminjaman.id_user', 'left');	
		$this->db->join('buku', 'buku.id_buku = peminjaman.id_buku', 'left');
		$this->db->limit(4);
		$this->db->order_by('id_pinjam', 'desc');
		$query = $this->db->get('peminjaman');
		return $query->result();
	}

	public function getPeminjaman()
	{
		$this->db->select("peminjaman.id_pinjam, user.id_user, user.no_identitas, user.nama, buku.id_buku, buku.judul, peminjaman.tanggal_pinjam, peminjaman.tanggal_kembali, buku.stok, peminjaman.status");
		$this->db->join('user', 'user.id_user = peminjaman.id_user', 'left');	
		$this->db->join('buku', 'buku.id_buku = peminjaman.id_buku', 'left');
		$this->db->order_by('tanggal_kembali', 'desc');
		$query = $this->db->get('peminjaman');
		return $query->result();
	}

	public function getPeminjamanById()
	{
		if ($this->session->userdata('logged_in_admin')) {
			$session_data = $this->session->userdata('logged_in_admin');
		} else {
			$session_data = $this->session->userdata('logged_in_user');
		}

		$data['id_user'] = $session_data['id_user'];
		$id_user=$data['id_user'];

		$this->db->select("peminjaman.id_pinjam, user.id_user, user.no_identitas, user.nama, buku.id_buku, buku.id_buku, buku.judul, peminjaman.tanggal_pinjam, peminjaman.tanggal_kembali, peminjaman.status");
		$this->db->where('user.id_user', $id_user);
		$this->db->join('user', 'user.id_user = peminjaman.id_user', 'left');	
		$this->db->join('buku', 'buku.id_buku = peminjaman.id_buku', 'left');
		$this->db->order_by('tanggal_pinjam', 'desc');
		$query = $this->db->get('peminjaman');
		return $query->result();
	}

	public function getPeminjamanToEdit($id_pinjam)
	{
		$this->db->select("peminjaman.id_pinjam, user.id_user, user.no_identitas, user.nama, buku.id_buku, buku.judul, peminjaman.tanggal_pinjam, peminjaman.tanggal_kembali, buku.stok, peminjaman.status");
		$this->db->where('id_pinjam', $id_pinjam);
		$this->db->join('user', 'user.id_user = peminjaman.id_user', 'left');	
		$this->db->join('buku', 'buku.id_buku = peminjaman.id_buku', 'left');	
		$query = $this->db->get('peminjaman');
		return $query->result();
	}

	public function editPeminjaman($id_pinjam)
	{
		$dataa = array(
			'tanggal_kembali' => $this->input->post('tanggal_kembali'), 
			'status' => $this->input->post('status'),
		);
		$this->db->where('id_pinjam', $id_pinjam);
		$this->db->update('peminjaman', $dataa);
	}

	public function getPengembalian()
	{
		$this->db->select("pengembalian.id_kembali, user.id_user, user.no_identitas, user.nama, buku.id_buku, buku.judul, pengembalian.jatuh_tempo, pengembalian.denda, pengembalian.tanggal_dikembalikan");
		$this->db->join('user', 'user.id_user = pengembalian.id_user', 'left');	
		$this->db->join('buku', 'buku.id_buku = pengembalian.id_buku', 'left');	
		$query = $this->db->get('pengembalian');
		return $query->result();
	}

	public function getPengembalianById()
	{
		if ($this->session->userdata('logged_in_admin')) {
			$session_data = $this->session->userdata('logged_in_admin');
		} else {
			$session_data = $this->session->userdata('logged_in_user');
		}
		
		$data['id_user'] = $session_data['id_user'];
		$id_user=$data['id_user'];

		$this->db->select("pengembalian.id_kembali, user.id_user, user.no_identitas, user.nama, buku.id_buku, buku.judul, pengembalian.jatuh_tempo, pengembalian.denda, pengembalian.tanggal_dikembalikan");
		$this->db->where('user.id_user', $id_user);
		$this->db->join('user', 'user.id_user = pengembalian.id_user', 'left');	
		$this->db->join('buku', 'buku.id_buku = pengembalian.id_buku', 'left');	
		$query = $this->db->get('pengembalian');
		return $query->result();
	}

	public function getPeminjamanToPengembalian($id_pinjam)
	{
		$this->db->select("peminjaman.id_pinjam, user.id_user, user.no_identitas, user.nama, buku.id_buku, buku.id_buku, buku.judul, peminjaman.tanggal_pinjam, peminjaman.tanggal_kembali");
		$this->db->where('peminjaman.id_pinjam', $id_pinjam);
		$this->db->join('user', 'user.id_user = peminjaman.id_user', 'left');	
		$this->db->join('buku', 'buku.id_buku = peminjaman.id_buku', 'left');	
		$query = $this->db->get('peminjaman');
		return $query->result();
	}

	public function kurangiStokBuku()
	{
		$id_buku = $this->input->post('id_buku');
		$query = $this->db->query("UPDATE buku SET stok=stok-1 WHERE id_buku='$id_buku'");
		return $query;
	}

	public function tambahiStokBuku()
	{
		$id_buku = $this->input->post('id_buku');
		$query = $this->db->query("UPDATE buku SET stok=stok+1 WHERE id_buku='$id_buku'");
		return $query;
	}

	public function tambahPeminjaman()
	{
		$inset_peminjaman = array(
			'id_user' => $this->input->post('id_user'), 
			'id_buku' => $this->input->post('id_buku'),
			'tanggal_pinjam' => $this->input->post('tanggal_pinjam'),
			'tanggal_kembali' => $this->input->post('tanggal_kembali'),
			'status' => "Belum Kembali",
		);
		$this->db->insert('peminjaman', $inset_peminjaman);
	}	


	public function tambahPengembalian()
	{
		$inset_pengembalian = array(
			'id_pinjam' => $this->input->post('id_pinjam'), 
			'id_user' => $this->input->post('id_user'),
			'id_buku' => $this->input->post('id_buku'),
			'jatuh_tempo' => $this->input->post('jatuh_tempo'),
			'denda' => $this->input->post('denda'),
			'tanggal_dikembalikan' => $this->input->post('tanggal_dikembalikan'),

		);
		$this->db->insert('pengembalian', $inset_pengembalian);
	}

	public function editStatusPeminjaman()
	{
		$id_pinjam = $this->input->post('id_pinjam');
		$editStatus = array(
			'status' => "Kembali", 
		);
		$this->db->where('id_pinjam', $id_pinjam);
		$this->db->update('peminjaman', $editStatus);
	}

	public function getSetting()
	{
		$this->db->select('rentan, denda, peminjaman, toleransi');
		$query = $this->db->get('setting');
		return $query->result();
	}

	public function editSetting()
	{
		$edit = array(
			'rentan' => $this->input->post('rentan'), 
			'denda' => $this->input->post('denda'), 
			'peminjaman' => $this->input->post('peminjaman'),
			'toleransi' => $this->input->post('toleransi'),
		);
		$this->db->update('setting', $edit);
	}

	function MaxPinjam() {
		$id_user = $this->input->post('id_user');

	    $this->db->select('user.id_user');
	    $this->db->from('peminjaman');
	    $this->db->where('user.id_user', $id_user);
	    $this->db->where('peminjaman.status', "Belum Kembali");
	    $this->db->join('user', 'user.id_user = peminjaman.id_user', 'left');
	    $query = $this->db->count_all_results();
		return $query;
	}

	public function deletePeminjaman($id_pinjam)
	{
		$this->db->where('id_pinjam', $id_pinjam);
		$this->db->delete('peminjaman');
	}

	public function deletePengembalian($id_pinjam)
	{
		$this->db->where('id_pinjam', $id_pinjam);
		$this->db->delete('pengembalian');
	}

	public function deletePengembalianToDel($id_kembali)
	{
		$this->db->where('id_kembali', $id_kembali);
		$this->db->delete('pengembalian');
	}

	function peminjamanDiPengembalian($id_pinjam) {
	    $this->db->select('id_pinjam');
	    $this->db->from('pengembalian');
	    $this->db->where('id_pinjam', $id_pinjam);
	    $query = $this->db->get();

	    if ($query->num_rows() > 0) {
	        return true;
	    } else {
	        return false;
	    }
	}
}

/* End of file Transaksi_Model.php */
/* Location: ./application/models/Transaksi_Model.php */