<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_Model extends CI_Model {
	
	public function login($username, $password)
	{
		$this->db->select('id_user, nama, no_identitas, email, no_hp, username, password, jenis_kelamin, alamat, foto, status');
		$this->db->from('user');
		$this->db->where('username', $username);
		$this->db->where('password', MD5($password));
		$query=$this->db->get();
		if ($query->num_rows()==1) {
			return $query->result();
		} else {
			return false;
		}	
	}

	var $tabel = 'user'; 
	function get_alldata() {
        $this->db->from($this->tabel);
        $this->db->where('status', "user");
        $query = $this->db->get();
 
        if ($query->num_rows() > 0) { 
            return $query->result();
        }
    }

	public function getDataLogin()
	{
		if ($this->session->userdata('logged_in_admin')) {
			$session_data = $this->session->userdata('logged_in_admin');
		} else {
			$session_data = $this->session->userdata('logged_in_user');
		}
		
		
		$data['id_user'] = $session_data['id_user'];
		$id_user=$data['id_user'];

		$this->db->select("id_user, nama, no_identitas, email, no_hp, username, password, jenis_kelamin, alamat, foto, status");
		$this->db->where('id_user', $id_user);
		$query = $this->db->get('user');
		return $query->result();
	}

	public function getDataUserForEdit($id_user)
	{
		$this->db->select("id_user, nama, no_identitas, email, no_hp, username, password, jenis_kelamin, alamat, foto, status");
		$this->db->where('id_user', $id_user);
		$query = $this->db->get('user');
		return $query->result();
	}

	public function getDataAdmin()
	{
		$this->db->select("id_user, nama, no_identitas, email, no_hp, username, password, jenis_kelamin, alamat, foto, status");
		$this->db->where('status', "admin");
		$query = $this->db->get('user');
		return $query->result();
	}

	public function getDataUser()
	{
		$this->db->select("id_user, nama, no_identitas, email, no_hp, username, password, jenis_kelamin, alamat, foto, status");
		$this->db->where('status', "user");
		$query = $this->db->get('user');
		return $query->result();
	}

	public function getDetailByUser($id_user)
		{
			$this->db->select("id_user, nama, no_identitas, email, no_hp, username, password, jenis_kelamin, alamat, foto, status");
			$this->db->where('id_user', $id_user);	
			$query = $this->db->get('user');
			return $query->result();
		}
	
	public function getNIM()
	{
		$this->db->select("user.nama, identitas.no_identitas, identitas.jenis");
		$this->db->where('jenis', "nim");
		$this->db->join('user', 'user.no_identitas = identitas.no_identitas', 'left');
		$query = $this->db->get('identitas');
		return $query->result();
	}

	public function getNIP()
	{
		$this->db->select("user.nama, identitas.no_identitas, identitas.jenis");
		$this->db->where('jenis', "nip");
		$this->db->join('user', 'user.no_identitas = identitas.no_identitas', 'left');
		$query = $this->db->get('identitas');
		return $query->result();
	}

	public function getPasswordtoChange()
	{
		if ($this->session->userdata('logged_in_admin')) {
			$session_data = $this->session->userdata('logged_in_admin');
		} else {
			$session_data = $this->session->userdata('logged_in_user');
		}

		$data['id_user'] = $session_data['id_user'];
		$id_user=$data['id_user'];

		$this->db->select("password");
		$this->db->where('id_user', $id_user);
		$query = $this->db->get('user');
		return $query->result();
	}

	public function getPasswordtoDelete($id_user)
	{
		$this->db->select("password");
		$this->db->where('id_user', $id_user);
		$query = $this->db->get('user');
		return $query->result();
	}

	public function updatePassword()
	{
		if ($this->session->userdata('logged_in_admin')) {
			$session_data = $this->session->userdata('logged_in_admin');
		} else {
			$session_data = $this->session->userdata('logged_in_user');
		}

		$data['id_user'] = $session_data['id_user'];
		$id_user=$data['id_user'];

		$password = $this->input->post('password_baru');
		$password_encrypt = md5($password);

		$data = array(
			'password' => $password_encrypt, 
			);
		$this->db->where('id_user', $id_user);
		$this->db->update('user', $data);
	}

	public function insertNoIdentitas()
	{
		$insert_identitas = array(
				'no_identitas' => $this->input->post('no_identitas'),
				'jenis' => $this->input->post('jenis'),
			);
			$this->db->insert('identitas', $insert_identitas);
	}

	public function deleteNoIdentitas($no_identitas)
	{
		$this->db->where('no_identitas', $no_identitas);
		$this->db->delete('identitas');
	} 

	public function insertAdmin()
	{
		$password = $this->input->post('password');
		$password_encrypt=md5($password);
	
		$insert_user = array(
				'nama' => $this->input->post('nama'),
				'no_identitas' => $this->input->post('no_identitas'),
				'email' => $this->input->post('email'),
				'no_hp' => $this->input->post('no_hp'),
				'username' => $this->input->post('username'),
				'password' => $password_encrypt,
				'jenis_kelamin' => $this->input->post('jenis_kelamin'),
				'alamat' => $this->input->post('alamat'),
				'foto' => $this->upload->data('file_name'),
				'status' => 'admin'
			);

			$this->db->insert('user', $insert_user);
	}

	public function insertUser()
	{
		$password = $this->input->post('password');
		$password_encrypt=md5($password);
	
		$insert_user = array(
				'nama' => $this->input->post('nama'),
				'no_identitas' => $this->input->post('no_identitas'),
				'email' => $this->input->post('email'),
				'no_hp' => $this->input->post('no_hp'),
				'username' => $this->input->post('username'),
				'password' => $password_encrypt,
				'jenis_kelamin' => $this->input->post('jenis_kelamin'),
				'alamat' => $this->input->post('alamat'),
				'foto' => $this->upload->data('file_name'),
				'status' => 'user'
			);

			$this->db->insert('user', $insert_user);
	}

	public function updateProfil()
	{
		if ($this->session->userdata('logged_in_admin')) {
			$session_data = $this->session->userdata('logged_in_admin');
		} else {
			$session_data = $this->session->userdata('logged_in_user');
		}

		$data['id_user'] = $session_data['id_user'];
		$id_user=$data['id_user'];

		$dataa = array(
			'nama' => $this->input->post('nama'), 
			'no_hp' => $this->input->post('no_hp'),
			'jenis_kelamin' => $this->input->post('jenis_kelamin'),
			'alamat' => $this->input->post('alamat'),
			'foto' => $this->upload->data('file_name')
			);
		$this->db->where('id_user', $id_user);
		$this->db->update('user', $dataa);
	}
	
	public function updateProfilTanpaFoto()
	{
		if ($this->session->userdata('logged_in_admin')) {
			$session_data = $this->session->userdata('logged_in_admin');
		} else {
			$session_data = $this->session->userdata('logged_in_user');
		}
		
		$data['id_user'] = $session_data['id_user'];
		$id_user=$data['id_user'];

		$dataa = array(
			'nama' => $this->input->post('nama'), 
			'no_hp' => $this->input->post('no_hp'),
			'jenis_kelamin' => $this->input->post('jenis_kelamin'),
			'alamat' => $this->input->post('alamat')
		);
		$this->db->where('id_user', $id_user);
		$this->db->update('user', $dataa);
	}

	public function updateUser($id_user)
	{
		$dataa = array(
			'nama' => $this->input->post('nama'), 
			'no_hp' => $this->input->post('no_hp'),
			'jenis_kelamin' => $this->input->post('jenis_kelamin'),
			'alamat' => $this->input->post('alamat'),
			'foto' => $this->upload->data('file_name')
			);
		$this->db->where('id_user', $id_user);
		$this->db->update('user', $dataa);
	}
	
	public function updateUserTanpaFoto($id_user)
	{
		$dataa = array(
			'nama' => $this->input->post('nama'), 
			'no_hp' => $this->input->post('no_hp'),
			'jenis_kelamin' => $this->input->post('jenis_kelamin'),
			'alamat' => $this->input->post('alamat')
		);
		$this->db->where('id_user', $id_user);
		$this->db->update('user', $dataa);
	}

	public function deleteUser($id_user)
	{
		$this->db->where('id_user', $id_user);
     	$query = $this->db->get('user');
    	$row = $query->row();

     	// unlink("./assets/uploads/Profil/$row->foto");

     	$this->db->delete('user', array('id_user' => $id_user));
	} 

	function isUsernameUserExist($username) {
	    $this->db->select('id_user');
	    $this->db->from('user');
	    $this->db->where('username', $username);
	    $query = $this->db->get();

	    if ($query->num_rows() > 0) {
	        return true;
	    } else {
	        return false;
	    }
	}


	function isNIMExist($no_identitas) {
	    $this->db->select('no_identitas');
	    $this->db->from('identitas');
	    $this->db->where('no_identitas', $no_identitas);
	    $query = $this->db->get();

	    if ($query->num_rows() > 0) {
	        return true;
	    } else {
	        return false;
	    }
	}

	function NIPTelahMenjadiMember($no_identitas) {
	    $this->db->select('no_identitas');
	    $this->db->from('user');
	    $this->db->where('no_identitas', $no_identitas);
	    $this->db->where('status', "admin");
	    $query = $this->db->get();

	    if ($query->num_rows() > 0) {
	        return true;
	    } else {
	        return false;
	    }
	}

	function NIMTelahMenjadiMember($no_identitas) {
	    $this->db->select('no_identitas');
	    $this->db->from('user');
	    $this->db->where('no_identitas', $no_identitas);
	    $this->db->where('status', "user");
	    $query = $this->db->get();

	    if ($query->num_rows() > 0) {
	        return true;
	    } else {
	        return false;
	    }
	}


	function isNIMExistTerdaftar($no_identitas) {
	    $this->db->select('no_identitas');
	    $this->db->from('user');
	    $this->db->where('no_identitas', $no_identitas);
	    $query = $this->db->get();

	    if ($query->num_rows() > 0) {
	        return true;
	    } else {
	        return false;
	    }
	}

	function isEmailTerdaftar($email) {
	    $this->db->select('email');
	    $this->db->from('user');
	    $this->db->where('email', $email);
	    $query = $this->db->get();

	    if ($query->num_rows() > 0) {
	        return true;
	    } else {
	        return false;
	    }
	}

	function NIPTerdaftar($no_identitas) {
	    $this->db->select('no_identitas');
	    $this->db->from('identitas');
	    $this->db->where('no_identitas', $no_identitas);
	    $this->db->where('jenis', "nip");
	    $query = $this->db->get();

	    if ($query->num_rows() > 0) {
	        return true;
	    } else {
	        return false;
	    }
	}

	function NIMTerdaftar($no_identitas) {
	    $this->db->select('no_identitas');
	    $this->db->from('identitas');
	    $this->db->where('no_identitas', $no_identitas);
	    $this->db->where('jenis', "nim");
	    $query = $this->db->get();

	    if ($query->num_rows() > 0) {
	        return true;
	    } else {
	        return false;
	    }
	}

	function deleteBentrokPeminjaman($id_user) {
	    $this->db->select('id_user');
	    $this->db->from('peminjaman');
	    $this->db->where('id_user', $id_user);
	    $query = $this->db->get();

	    if ($query->num_rows() > 0) {
	        return true;
	    } else {
	        return false;
	    }
	}

	function deleteBentrokPengembalian($id_user) {
	    $this->db->select('id_user');
	    $this->db->from('pengembalian');
	    $this->db->where('id_user', $id_user);
	    $query = $this->db->get();

	    if ($query->num_rows() > 0) {
	        return true;
	    } else {
	        return false;
	    }
	}

	function deleteBentrokReport($id_user) {
	    $this->db->select('id_user');
	    $this->db->from('report');
	    $this->db->where('id_user', $id_user);
	    $query = $this->db->get();

	    if ($query->num_rows() > 0) {
	        return true;
	    } else {
	        return false;
	    }
	}

}

/* End of file User_Model.php */
/* Location: ./application/models/User_Model.php */
 ?>