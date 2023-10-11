<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('m_model');
		$this->load->helper('my_helper');
		// if ($this->session->userdata('logged_in') != true || $this->session->userdata('role') != 'karyawan') {
		// 	redirect(base_url() . 'auth');
		//  }
		// $this->load->library('form_validation');
	}

    // untuk register admin
    public function register_admin()
        {
            $this->load->view('auth/register_admin');
        }

	// untuk register karyawan
	public function register()
		{
			$this->load->view('auth/register');
		}

        // untuk aksi register admin
		public function aksi_register() { 
			// Memperoleh data dari formulir 
			$username = $this->input->post('username', true); 
			$email = $this->input->post('email', true); 
			$nama_depan = $this->input->post('nama_depan', true); 
			$nama_belakang = $this->input->post('nama_belakang', true); 
			$password = $this->input->post('password', true); 
		 
			// Mendapatkan file gambar yang diunggah 
			$imageFileName = $_FILES['image']['name']; 
			$imageTempName = $_FILES['image']['tmp_name']; 
		 
			// Periksa jika panjang kata sandi minimal 8 karakter 
			if (strlen($password) < 8) { 
				// Kata sandi terlalu pendek, tangani sesuai dengan kebutuhan Anda 
				redirect(base_url() . "auth/register"); 
			} 
		 
			// Hash kata sandi 
			$hashed_password = md5($password); 
		
			// Persiapkan data untuk dimasukkan ke dalam database 
			$data = [ 
				'username' => $username, 
				'email' => $email, 
				'nama_depan' => $nama_depan, 
				'nama_belakang' => $nama_belakang, 
				'password' => $hashed_password, 
				'role' => 'karyawan', 
			]; 
		 
			// Muat model database dan masukkan data 
			$this->load->model('m_model'); 
			$registration_result = $this->m_model->register_user($data); 
		 
			if ($registration_result) { 
				// Pendaftaran berhasil 
				$this->session->set_userdata([ 
					'logged_in' => TRUE, 
					'email' => $email, 
					'username' => $username, 
					'role' => 'karyawan' 
				]); 
		 
				redirect(base_url() . "auth/login"); 
			} else { 
				// Pendaftaran gagal, tangani sesuai dengan kebutuhan Anda 
				redirect(base_url() . "auth/register"); 
			} 
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
		$data = ['email' => $email]; // Perbaiki di sini, hapus koma ekstra
	
		$query = $this->m_model->getwhere('admin', $data);
		$result = $query->row_array();
	
		if (!empty($result) && md5($password) === $result['password']) {
			$data = [
				'logged_in' => TRUE,
				'email' => $result['email'],
				'username' => $result['username'],
				// 'role' => $result['role'],
				'id' => $result['id'],
			]; // Perbaiki di sini, tambahkan tanda koma
	
			$this->session->set_userdata($data);
			if ($this->session->userdata('role') == 'admin') {
				redirect(base_url()."admin");
			} elseif ($this->session->userdata('role') == 'karyawan') {
				redirect(base_url()."karyawan");
			} else {
				redirect(base_url()."auth");
			}
		} else {
			redirect(base_url()."auth");
		}
	}

	function logout()
    {
        $this->session->sess_destroy();
        redirect(base_url('auth/login'));
    }
}
?>