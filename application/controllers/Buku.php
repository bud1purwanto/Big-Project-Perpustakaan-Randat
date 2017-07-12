<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Buku extends CI_Controller {
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
			$this->load->model('Buku_Model');
			$this->load->model('Transaksi_Model');
		}else{
			$this->session->set_flashdata('login_lagi', 'Anda sudah logout, silahkan login lagi!');
			redirect('login','refresh');
		}		
	}

	public function index()
	{
		$data['title'] = "List Buku";
		$data['data_login']=$this->User_Model->getDataLogin();
		$data['notif']=$this->Transaksi_Model->getNotif();

		$getStatus=$this->User_Model->getDataLogin();
		foreach ($getStatus as $key) 
		{
            	$status = $key->status;
        }
		$data["status"] = $status;
			
		$data["buku_list"] = $this->Buku_Model->getBuku();
 		$data["pengarang_list"] = $this->Buku_Model->getPengarang();
		$data["penerbit_list"] = $this->Buku_Model->getPenerbit();
		$data["kategori_list"] = $this->Buku_Model->getKategori();

		$this->load->view('template/assets-header', $data);
		$this->load->view('template/navbar', $data);
		$this->load->view('buku/daftarBuku_view', $data);
		$this->load->view('template/assets-footer', $data);
	}

	public function search()
	{
		$keyword = $this->uri->segment(3);	
		$data = $this->db->from('buku')->where('stok >', 0)->like('judul',$keyword)->get();	

		foreach($data->result() as $row)
		{
			$arr['query'] = $keyword;
			$arr['suggestions'][] = array(
				'value'			=>$row->judul,
				'judul'			=>$row->judul,
				'id_buku_tampil'=>$row->id_buku,
				'id_buku'		=>$row->id_buku,
				'stok'			=>$row->stok,

			);
		}
		echo json_encode($arr);
	}

	public function get_alldata() {
        $kode = $this->input->post('kode',TRUE);
        $query = $this->Buku_Model->get_alldata(); 
 
        $nama       =  array();
        foreach ($query as $d) {
            $nama[]     = array(
                'label' => $d->judul, 
                'judul' => $d->judul , 
                'id_buku' => $d->id_buku,
                'id_bukutampil' => $d->id_buku,
                'stok' => $d->stok,
            );
        }
        echo json_encode($nama);      
    }
    
	public function daftarBuku($id_kategori)
	{
		$data['title'] = "List Buku Per Kategori";
		$data['data_login']=$this->User_Model->getDataLogin();
		$data['notif']=$this->Transaksi_Model->getNotif();		

		$getStatus=$this->User_Model->getDataLogin();
		foreach ($getStatus as $key) 
		{
            	$status = $key->status;
        }
		$data["status"] = $status;

		$data["buku_list"] = $this->Buku_Model->getBukuPerKategori($id_kategori);
 		$data["pengarang_list"] = $this->Buku_Model->getPengarang();
		$data["penerbit_list"] = $this->Buku_Model->getPenerbit();
		$data["kategori_list"] = $this->Buku_Model->getKategori();
		$data['get_kategori']=$this->Buku_Model->getKategoriById($id_kategori);

		$this->load->view('template/assets-header', $data);
		$this->load->view('template/navbar', $data);
		$this->load->view('buku/daftarBukuPerKategori_view', $data);
		$this->load->view('template/assets-footer', $data);
	}

	public function create()
 	{
 		if($this->session->userdata('logged_in_admin')){
	 		$data['title'] = "Add Buku";
	 		$data['data_login']=$this->User_Model->getDataLogin();
	 		$data['notif']=$this->Transaksi_Model->getNotif();

	 		$getStatus=$this->User_Model->getDataLogin();
			foreach ($getStatus as $key) 
			{
	            	$status = $key->status;
	        }
			$data["status"] = $status;
	 		
	 		$data["buku_list"] = $this->Buku_Model->getBuku();
	 		$data["pengarang_list"] = $this->Buku_Model->getPengarang();
			$data["penerbit_list"] = $this->Buku_Model->getPenerbit();
			$data["kategori_list"] = $this->Buku_Model->getKategori();

			$this->form_validation->set_rules('id_buku', 'ID Buku', 'required|min_length[2]|max_length[12]|callback_primaryBuku');
	 		$this->form_validation->set_rules('judul', 'Judul', 'trim|required|min_length[2]');
	 		$this->form_validation->set_rules('id_pengarang[]', 'Nama Pengarang', 'trim|required');
	 		$this->form_validation->set_rules('id_penerbit', 'Nama Penerbit', 'trim|required');
	 		$this->form_validation->set_rules('id_kategori', 'Nama Kategori', 'trim|required');
	 		$this->form_validation->set_rules('stok', 'Stok', 'trim|required|is_natural_no_zero|numeric|min_length[1]');
			
			$this->load->model('Buku_Model');

			if ($this->form_validation->run()==FALSE) {
				$this->load->view('template/assets-header-3', $data);
				$this->load->view('template/navbar', $data);
				$this->load->view('buku/inputBuku_view', $data);
				$this->load->view('template/assets-footer-2', $data);
			} else {
				$config['upload_path']			='./assets/uploads/Buku';
				$config['allowed_types']		='gif|jpg|png';
				$config['max_size']				=1000000000;
				$config['max_width']			=10240;
				$config['max_height']			=7680;
				$this->load->library('upload', $config);
				if( ! $this->upload->do_upload('userfile'))
				{
					$this->session->set_flashdata('error', 'Masukkan Cover Buku!');
					$this->load->view('template/assets-header-3', $data);
					$this->load->view('template/navbar', $data);
					$this->load->view('buku/inputBuku_view', $data);
					$this->load->view('template/assets-footer-2', $data);
				}
				else
				{
					$this->Buku_Model->insertBuku();
					$buqu = $this->input->post('id_pengarang[]');
					foreach ($buqu as $selectedOption){
					$this->Buku_Model->insertPengarangnyaBuku($selectedOption);
					}
			    	$this->session->set_flashdata('sudah_input', ' Buku sudah ditambah!');
			   		redirect('buku','refresh');
				}
			}
		}else{
			$this->session->set_flashdata('forbidden', 'Link yang anda tuju dilarang!');
			redirect('dashboard','refresh');
		}	
	}

	public function edit($id_buku)
	{
		if($this->session->userdata('logged_in_admin')){
			$data['title'] = "Edit Buku";
			$data['data_login']=$this->User_Model->getDataLogin();
			$data['notif']=$this->Transaksi_Model->getNotif();
	 		$data["buku_list"] = $this->Buku_Model->getBukuById($id_buku);
	 		$data["pengarang_list"] = $this->Buku_Model->getPengarang();
			$data["penerbit_list"] = $this->Buku_Model->getPenerbit();
			$data["kategori_list"] = $this->Buku_Model->getKategori();

			$this->form_validation->set_rules('id_buku', 'ID Buku', 'required|min_length[2]|max_length[12]');
	 		$this->form_validation->set_rules('judul', 'Judul', 'trim|required|min_length[2]');
	 		$this->form_validation->set_rules('id_penerbit', 'Nama Penerbit', 'trim|required');
	 		$this->form_validation->set_rules('id_kategori', 'Nama Kategori', 'trim|required');
	 		$this->form_validation->set_rules('stok', 'Stok', 'trim|required|is_natural|numeric|min_length[1]');
	
			if($this->form_validation->run()==FALSE){
				$this->load->view('template/assets-header-3', $data);
				$this->load->view('template/navbar', $data);
				$this->load->view('buku/editBuku_view',$data);
				$this->load->view('template/assets-footer-2', $data);

			}else{
				$config['upload_path'] = './assets/uploads/Buku';
				$config['allowed_types'] = 'jpg|png';
				$config['max_size']  = 1000000;
				$config['max_width']  = 10240;
				$config['max_height']  = 7680;
				
				$this->load->library('upload', $config);
				
				if ( ! $this->upload->do_upload('userfile')){
					$this->Buku_Model->updateBukuTanpaFoto($id_buku);	
					$this->session->set_flashdata('sudah_input', 'Buku Berhasil diedit!');
				}
				else{
					$this->Buku_Model->updateBuku($id_buku);
					$this->session->set_flashdata('sudah_input', 'Buku Berhasil diedit!');
				}
				redirect('buku','refresh');
			}

		}else{
			$this->session->set_flashdata('forbidden', 'Link yang anda tuju dilarang!');
			redirect('dashboard','refresh');
		}	
	}

	public function delete($id_buku)
	{
		if($this->session->userdata('logged_in_admin')){
			$dipinjam = $this->Buku_Model->bukuDiPinjam($id_buku);
			$buku_pengarang = $this->Buku_Model->bukuDiPengarang($id_buku);
			if ($dipinjam) {
				$this->session->set_flashdata('gagal', 'Buku tidak bisa dihapus karena sedang dipinjam!');
			} else if ($buku_pengarang) {
				$this->session->set_flashdata('gagal', 'Buku tidak bisa dihapus karena memiliki pengarang!');
			}else {
				$this->Buku_Model->delete($id_buku);
				$this->session->set_flashdata('terhapus', 'Buku Berhasil Dihapus');
			}
			redirect('buku', 'refresh');
		}else{
			$this->session->set_flashdata('forbidden', 'Link yang anda tuju dilarang!');
			redirect('dashboard','refresh');
		}
	}

	public function primaryBuku($id_buku) {
	    $this->load->model('Buku_Model');
	    $is_exist = $this->Buku_Model->primaryBuku($id_buku);

	    if ($is_exist) {
	     	$this->form_validation->set_message('primaryBuku', 'ID Buku sudah dipakai, ganti yang lain!.'); 
	        return false;
	        
	    } else {
	        return true;
	    }
	}
}

/* End of file Buku.php */
/* Location: ./application/controllers/Buku.php */ ?>