<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Buku_Model extends CI_Model {
	public function getBuku()
	{
		$query = $this->db->query("SELECT 
		buku.id_buku, buku.cover, buku.judul, GROUP_CONCAT(pengarang.nama_pengarang SEPARATOR ', <br>') 
		as nama_pengarang, penerbit.nama_penerbit, buku.tahun_terbit, kategori.nama_kategori, buku.stok
		FROM buku 
		INNER JOIN buku_pengarang on buku_pengarang.id_buku = buku.id_buku
		INNER JOIN pengarang ON pengarang.id_pengarang = buku_pengarang.id_pengarang
		INNER JOIn penerbit ON penerbit.id_penerbit = buku.id_penerbit
		INNER JOIN kategori ON kategori.id_kategori = buku.id_kategori
		GROUP BY buku.judul");
		return $query->result();
	}

	public function getBukuPerKategori($id_kategori)
	{
		$query = $this->db->query("SELECT 
		buku.id_buku, buku.cover, buku.judul, GROUP_CONCAT(pengarang.nama_pengarang SEPARATOR ', <br>') 
		as nama_pengarang, penerbit.nama_penerbit, buku.tahun_terbit, kategori.nama_kategori, buku.stok
		FROM buku 
		INNER JOIN buku_pengarang on buku_pengarang.id_buku = buku.id_buku
		INNER JOIN pengarang ON pengarang.id_pengarang = buku_pengarang.id_pengarang
		INNER JOIn penerbit ON penerbit.id_penerbit = buku.id_penerbit
		INNER JOIN kategori ON kategori.id_kategori = buku.id_kategori 
		WHERE buku.id_kategori='$id_kategori'
		GROUP BY buku.judul");
		return $query->result();
	}

	var $tabel = 'buku';
	function get_alldata() {
        $this->db->from($this->tabel);
        $this->db->where('stok >', 0);	
        $query = $this->db->get();
     
        if ($query->num_rows() > 0) { 
            return $query->result();
        }
    }

	public function getPengarang()
	{
		$this->db->select("id_pengarang, nama_pengarang, alamat, no_hp");
		$query = $this->db->get('pengarang');
		return $query->result();
	}

	public function getPenerbit()
	{
		$this->db->select("id_penerbit, nama_penerbit, alamat, no_hp");
		$query = $this->db->get('penerbit');
		return $query->result();
	}

	public function getKategori()
	{
		$this->db->select("id_kategori, nama_kategori");
		$query = $this->db->get('kategori');
		return $query->result();
	}

	public function getBukuPengarang()
	{
		$this->db->select("id, buku.id_buku, buku.judul, pengarang.id_pengarang, pengarang.nama_pengarang");
		$this->db->join('buku', 'buku.id_buku = buku_pengarang.id_buku', 'left');
		$this->db->join('pengarang', 'pengarang.id_pengarang = buku_pengarang.id_pengarang', 'left');
		$query = $this->db->get('buku_pengarang');
		return $query->result();
	}

	public function getBukuById($id_buku)
	{
		$query = $this->db->query("SELECT 
		buku.id_buku, buku.cover, buku.judul, GROUP_CONCAT(pengarang.nama_pengarang SEPARATOR ', <br>') 
		as nama_pengarang, penerbit.id_penerbit, penerbit.nama_penerbit, buku.tahun_terbit, kategori.id_kategori, kategori.nama_kategori, buku.stok
		FROM buku 
		INNER JOIN buku_pengarang on buku_pengarang.id_buku = buku.id_buku
		INNER JOIN pengarang ON pengarang.id_pengarang = buku_pengarang.id_pengarang
		INNER JOIn penerbit ON penerbit.id_penerbit = buku.id_penerbit
		INNER JOIN kategori ON kategori.id_kategori = buku.id_kategori 
		WHERE buku.id_buku='$id_buku'
		GROUP BY buku.judul");
		return $query->result();
	}

	public function getPengarangById($id_pengarang)
	{
		$this->db->select("id_pengarang, nama_pengarang, alamat, no_hp");
		$this->db->where('id_pengarang', $id_pengarang);
		$query = $this->db->get('pengarang');
		return $query->result();
	}

	public function getPenerbitById($id_penerbit)
	{
		$this->db->select("id_penerbit, nama_penerbit, alamat, no_hp");
		$this->db->where('id_penerbit', $id_penerbit);
		$query = $this->db->get('penerbit');
		return $query->result();
	}

	public function getKategoriById($id_kategori)
	{
		$this->db->select("id_kategori, nama_kategori");
		$this->db->where('id_kategori', $id_kategori);
		$query = $this->db->get('kategori');
		return $query->result();
	}

	public function insertBuku()
	{
		$insert_buku = array(
			'id_buku' => $this->input->post('id_buku'),
			'cover' => $this->upload->data('file_name'),
			'judul' => $this->input->post('judul'),
			'id_penerbit' => $this->input->post('id_penerbit'),
			'tahun_terbit' => $this->input->post('tahun_terbit'),
			'id_kategori' => $this->input->post('id_kategori'),
			'stok' => $this->input->post('stok')
		);
		$this->db->insert('buku', $insert_buku);
	}

	public function insertPengarangnyaBuku($selectedOption)
	{
		$insert_buku = array(
			'id_buku' => $this->input->post('id_buku'),
			'id_pengarang' => $selectedOption,
		);
		$this->db->insert('buku_pengarang', $insert_buku);
	}

	public function insertPengarang()
	{
		$insert_pengarang = array(
			'nama_pengarang' => $this->input->post('nama_pengarang'),
			'alamat' => $this->input->post('alamat'),
			'no_hp' => $this->input->post('no_hp'),
		);
		$this->db->insert('pengarang', $insert_pengarang);
	}

	public function insertPenerbit()
	{
		$insert_penerbit = array(
			'nama_penerbit' => $this->input->post('nama_penerbit'),
			'alamat' => $this->input->post('alamat'),
			'no_hp' => $this->input->post('no_hp'),
		);
		$this->db->insert('penerbit', $insert_penerbit);
	}

	public function insertKategori()
	{
		$insert_kategori = array(
			'nama_kategori' => $this->input->post('nama_kategori'),
		);
		$this->db->insert('kategori', $insert_kategori);
	}

	public function updateBuku($id_buku)
	{
		$dataa = array(
			'id_buku' => $this->input->post('id_buku'),
			'cover' => $this->upload->data('file_name'), 
			'judul' => $this->input->post('judul'),
			'id_penerbit' => $this->input->post('id_penerbit'),
			'tahun_terbit' => $this->input->post('tahun_terbit'),
			'id_kategori' => $this->input->post('id_kategori'),
			'stok' => $this->input->post('stok'),
			);
		$this->db->where('id_buku', $id_buku);
		$this->db->update('buku', $dataa);
	}
	
	public function updateBukuTanpaFoto($id_buku)
	{
		$dataa = array(
			'id_buku' => $this->input->post('id_buku'),
			'judul' => $this->input->post('judul'),
			'id_penerbit' => $this->input->post('id_penerbit'),
			'tahun_terbit' => $this->input->post('tahun_terbit'),
			'id_kategori' => $this->input->post('id_kategori'),
			'stok' => $this->input->post('stok'),
		);
		$this->db->where('id_buku', $id_buku);
		$this->db->update('buku', $dataa);
	}

	public function editPengarang($id_pengarang)
	{
		$edit_pengarang = array(
			'nama_pengarang' => $this->input->post('nama_pengarang'), 
			'alamat' => $this->input->post('alamat'),
			'no_hp' => $this->input->post('no_hp'),	
		);
		$this->db->where('id_pengarang', $id_pengarang);
		$this->db->update('pengarang', $edit_pengarang);
	}

	public function editPenerbit($id_penerbit)
	{
		$edit_penerbit = array(
			'nama_penerbit' => $this->input->post('nama_penerbit'), 
			'alamat' => $this->input->post('alamat'),
			'no_hp' => $this->input->post('no_hp'),	
		);
		$this->db->where('id_penerbit', $id_penerbit);
		$this->db->update('penerbit', $edit_penerbit);
	}

	public function editKategori($id_kategori)
	{
		$edit_kategori = array(
			'nama_kategori' => $this->input->post('nama_kategori'), 
		);
		$this->db->where('id_kategori', $id_kategori);
		$this->db->update('kategori', $edit_kategori);
	}
	
	public function delete($id_buku)
    {
    	// $this->db->where('id_buku', $id_buku);
     // 	$query = $this->db->get('buku');
    	// $row = $query->row();

    	// unlink("./assets/uploads/Buku/$row->cover");
    	$this->db->where('id_buku', $id_buku);
    	$this->db->delete('buku');
	}

	public function deletePengarang($id_pengarang)
    {
	 	$this->db->where('id_pengarang', $id_pengarang);
	 	$this->db->delete('pengarang');
	}

	public function deletePenerbit($id_penerbit)
    {
	 	$this->db->where('id_penerbit', $id_penerbit);
	 	$this->db->delete('penerbit');
	}

	public function deleteKategori($id_kategori)
    {
	 	$this->db->where('id_kategori', $id_kategori);
	 	$this->db->delete('kategori');
	}

	public function deleteBukuPengarang($id)
    {
	 	$this->db->where('id', $id);
	 	$this->db->delete('buku_pengarang');
	}

	function pengarangTerdaftar($id_pengarang) {
	    $this->db->select('id_pengarang');
	    $this->db->from('buku_pengarang');
	    $this->db->where('id_pengarang', $id_pengarang);
	    $query = $this->db->get();

	    if ($query->num_rows() > 0) {
	        return true;
	    } else {
	        return false;
	    }
	}

	function pengarangSudahDiInput() {
		$nama_pengarang = $this->input->post('nama_pengarang');
	    $this->db->select('nama_pengarang');
	    $this->db->from('pengarang');
	    $this->db->where('nama_pengarang', $nama_pengarang);
	    $query = $this->db->get();

	    if ($query->num_rows() > 0) {
	        return true;
	    } else {
	        return false;
	    }
	}
	
	function penerbitTerdaftar($id_penerbit) {
	    $this->db->select('id_penerbit');
	    $this->db->from('buku');
	    $this->db->where('id_penerbit', $id_penerbit);
	    $query = $this->db->get();

	    if ($query->num_rows() > 0) {
	        return true;
	    } else {
	        return false;
	    }
	}

	function penerbitSudahDiInput() {
		$nama_penerbit = $this->input->post('nama_penerbit');
	    $this->db->select('nama_penerbit');
	    $this->db->from('penerbit');
	    $this->db->where('nama_penerbit', $nama_penerbit);
	    $query = $this->db->get();

	    if ($query->num_rows() > 0) {
	        return true;
	    } else {
	        return false;
	    }
	}

	function kategoriTerdaftar($id_kategori) {
	    $this->db->select('id_kategori');
	    $this->db->from('buku');
	    $this->db->where('id_kategori', $id_kategori);
	    $query = $this->db->get();

	    if ($query->num_rows() > 0) {
	        return true;
	    } else {
	        return false;
	    }
	}

	function kategoriSudahDiInput() {
		$nama_kategori = $this->input->post('nama_kategori');
	    $this->db->select('nama_kategori');
	    $this->db->from('kategori');
	    $this->db->where('nama_kategori', $nama_kategori);
	    $query = $this->db->get();

	    if ($query->num_rows() > 0) {
	        return true;
	    } else {
	        return false;
	    }
	}

	function bukuDiPinjam($id_buku) {
	    $this->db->select('id_buku');
	    $this->db->from('peminjaman');
	    $this->db->where('id_buku', $id_buku);
	    $query = $this->db->get();

	    if ($query->num_rows() > 0) {
	        return true;
	    } else {
	        return false;
	    }
	}

	function primaryBuku($id_buku) {
	    $this->db->select('id_buku');
	    $this->db->from('buku');
	    $this->db->where('id_buku', $id_buku);
	    $query = $this->db->get();

	    if ($query->num_rows() > 0) {
	        return true;
	    } else {
	        return false;
	    }
	}

	function bukuDiPengarang($id_buku) {
	    $this->db->select('id_buku');
	    $this->db->from('buku_pengarang');
	    $this->db->where('id_buku', $id_buku);
	    $query = $this->db->get();

	    if ($query->num_rows() > 0) {
	        return true;
	    } else {
	        return false;
	    }
	}
}

/* End of file Pegawai_Model.php */
/* Location: ./application/models/Pegawai_Model.php */
 ?>