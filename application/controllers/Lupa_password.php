<?php  
defined('BASEPATH') OR exit('No direct script access allowed');  
   
class Lupa_password extends CI_Controller {  
   
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_Account');
    }
     
    public function index()  
    {  
         
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');   
        if($this->form_validation->run() == FALSE) {  
                $data['title'] = 'Halaman Reset Password';
                $this->load->view('template/assets-header-2', $data);
                $this->load->view('account/v_lupa_password',$data);
                $this->load->view('template/assets-footer', $data, FALSE);  
        }else{  
                $email = $this->input->post('email');   
                $clean = $this->security->xss_clean($email);  
                $userInfo = $this->M_Account->getUserInfoByEmail($clean);  
                 
                if(!$userInfo){  
                      $this->session->set_flashdata('sukses', 'Email salah, silakan periksa lagi.');  
                      redirect(site_url('Lupa_password'),'refresh');   
                }    
             
                //MEMBUAT TOKEN   
                       
                $token = $this->M_Account->insertToken($userInfo->id_user);              
                $qstring = $this->base64url_encode($token);     

                

                //MEMBUAT LINK

                $url = site_url() . '/lupa_password/reset_password/token/' . $qstring;
                $data['url'] = $url;
               
                $htmlContent = "<strong>Hai, Anda menerima Email ini karena ada permintaan untuk memperbaharui password Anda.</strong><br>
                  <strong>Silakan: </strong> <a href='".$url."'>Klik Disni</a><strong> untuk mereset password Anda!</strong> ";

                // $this->load->view('account/token', $data);
                
                $this->load->helper('form');
                $config = Array(
                    // 'protocol' => 'smtp',
                    // 'smtp_host' => 'smtp.mail.yahoo.com',
                    // 'smtp_port' => 465,
                    // 'smtp_user' => '', 
                    // 'smtp_pass' => '',
                    'mailtype' => 'html',
                    // 'charset' => 'iso-8859-1'
                );

                $this->load->library('email', $config);
                $this->email->from('admin@polinema.ac.id','Perpustakaan JTI Polinema');
                $this->email->to($email);
                $this->email->subject('Lupa Password');
                $this->email->message($htmlContent);
                $this->email->send();
                echo $this->email->print_debugger();
                $this->session->set_flashdata('cekemail', 'Silahkan cek email anda untuk pembaruan Password!');
                redirect('login','refresh'); 
        }  
         
    }  
   
    public function reset_password()  
    {  
        $token = $this->base64url_decode($this->uri->segment(4));           
        $cleanToken = $this->security->xss_clean($token);  
         
        $user_info = $this->M_Account->isTokenValid($cleanToken);
         
        if(!$user_info){  
                $this->session->set_flashdata('sukses', 'Token tidak valid atau kadaluarsa');  
                redirect(site_url('login'),'refresh');   
        }    
   
        $data = array(  
              'title'=> 'Halaman Reset Password',  
              'nama'=> $user_info->nama,   
              'email'=>$user_info->email,   
              'token'=>$this->base64url_encode($token)  
        );  
         
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[4]');  
        $this->form_validation->set_rules('passconf', 'Password Confirmation', 'required|matches[password]');         
         
        if ($this->form_validation->run() == FALSE) { 
              $this->load->view('template/assets-header-2', $data);  
              $this->load->view('account/v_reset_password', $data);
              $this->load->view('template/assets-footer', $data);  
        }else{               
              $post = $this->input->post(NULL, TRUE);          
              $cleanPost = $this->security->xss_clean($post);          
              $hashed = md5($cleanPost['password']);          
              $cleanPost['password'] = $hashed;  
              $cleanPost['id_user'] = $user_info->id_user;  
              unset($cleanPost['passconf']); 

              if(!$this->M_Account->updatePassword($cleanPost)){  
                      $this->session->set_flashdata('sukses', 'Update password gagal.');  
              }else{  
                      $this->session->set_flashdata('sukses', 'Password anda sudah diperbaharui. Silakan login.');  
              }  

              redirect(site_url('login'),'refresh');         
        }  
    }  
       
    public function base64url_encode($data) {   
        return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');   
    }   
   
    public function base64url_decode($data) {   
        return base64_decode(str_pad(strtr($data, '-_', '+/'), strlen($data) % 4, '=', STR_PAD_RIGHT));   
    }    
 }  