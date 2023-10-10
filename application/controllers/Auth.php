<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('m_model');
		$this->load->helper('my_helper');
		$this->load->library('form_validation');
	}

    // untuk register admin
    public function register_admin()
        {
            $this->load->view('auth/register_admin');
        }

	// untuk register karyawan
	public function register_karyawan()
		{
			$this->load->view('auth/register_karyawan');
		}

        // untuk aksi register admin
		public function aksi_register() {  
			$email    = $this->input->post('email', true);  
			$username = $this->input->post('username', true);  
			$nama_depan = $this->input->post('nama_depan', true);  
			$nama_belakang = $this->input->post('nama_belakang', true);  
			$password = $this->input->post('password', true); 
		
			// Validasi input
			$this->form_validation->set_rules('email', 'Email', 'required');
			$this->form_validation->set_rules('username', 'Username', 'required');
			$this->form_validation->set_rules('nama_depan', 'Nama Depan', 'required');
			$this->form_validation->set_rules('nama_belakang', 'Nama Belakang', 'required');
			$this->form_validation->set_rules('password', 'Password', 'required');
		
			if ($this->form_validation->run() == FALSE) {
				$this->session->set_flashdata('error', validation_errors());
				redirect(base_url() . 'auth');
			}
		
			$data = array(  
				'email'    => $email,  
				'username' => $username,  
				'nama_depan' => $nama_depan,  
				'nama_belakang' => $nama_belakang,  
				'password' => md5($password),  
				'role' => 'admin'
			);  
		
			$table = 'user';  
		
			$this->m_model->tambah_data($table, $data);
			redirect(base_url().'auth');
		}		

    // untuk login
    public function login()
    {
        $this->load->view('auth/login');
    }

    public function aksi_login()
	{
		$email = $this->input->post('email', true);
		$password = $this->input->post('password', true);
		$data = [
			'email' => $email
		]; // Perbaiki di sini, hapus koma ekstra
	
		$query = $this->m_model->getwhere('user', $data);
		$result = $query->row_array();
	
		if (!empty($result) && md5($password) === $result['password']) {
			if ($result['role'] === 'admin') {
				$data = [
					'logged_in' => TRUE,  
					'email' => $result['email'],  
					'username' => $result['username'],  
					'role' => $result['role'],  
					'id' => $result['id'],  
				];
				$this->session->set_userdata($data);
				redirect(base_url()."admin");
			} elseif ($result['role'] === 'karyawan') {
				$data = [
					'logged_in' => TRUE,  
					'email' => $result['email'],  
					'username' => $result['username'],  
					'role' => $result['role'],  
					'id' => $result['id'],  
				];
				$this->session->set_userdata($data);
				redirect(base_url()."karyawan");
			} else {
				$this->session->set_flashdata('error', 'peran tidak dikenali.');
				redirect(base_url().'auth');
			}
		} else {
			$this->session->set_flashdata('error', 'Email atau kata sandi salah');
		}
	}

	function logout()
    {
        $this->session->sess_destroy();
        redirect(base_url('auth/login'));
    }
}
?>