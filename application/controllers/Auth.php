<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	function __construct(){
        parent::__construct(); 
        $this->load->library('form_validation');
        $this->load->model('m_model');
    } 

    // untuk register admin
	public function register_admin() {
        $this->load->view('auth/register_admin');
    }

	// untuk register karyawan
	public function register() {
        $this->load->view('auth/register');
    }

	// untuk aksi register karyawan
	public function process_register() {
        $this->form_validation->set_rules('email', 'Email', 'trim|required|regex_match[/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/]');
        $this->form_validation->set_rules('password', 'Password', 'required|regex_match[/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])[0-9a-zA-Z]{8,}$/]');

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('auth/register');
        } else {
            $hashed_password = md5($this->input->post('password'));

            $data = [
                'username' => $this->input->post('username'),
                'first_name' => $this->input->post('first_name'),
                'last_name' => $this->input->post('last_name'),
                'email' => $this->input->post('email'),
                'password' => $hashed_password,
                'role' => 'karyawan',
                'image' => $this->input->post('user.png')
            ];

            $this->db->insert('user', $data);

            redirect(base_url('auth'));
        }
    }

	// untuk aksi register admin
	public function process_register_admin() {
        $this->form_validation->set_rules('email', 'Email', 'trim|required|regex_match[/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/]');
        $this->form_validation->set_rules('password', 'Password', 'required|regex_match[/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])[0-9a-zA-Z]{8,}$/]');

        if ($this->form_validation->run() === FALSE) {
			$this->load->view('auth/register_admin');
		} else {
			$hashed_password = md5($this->input->post('password'));
		
			$data = [
				'username' => $this->input->post('username'),
				'first_name' => $this->input->post('nama_depan'),
				'last_name' => $this->input->post('nama_belakang'),
				'email' => $this->input->post('email'),
				'password' => $hashed_password,
				'role' => 'admin',
				'image' => 'user.png'  // Perbarui sesuai kebutuhan
			];
		
			// Simpan data ke database
			$this->db->insert('user', $data);
		
			// Redirect ke halaman login
			return redirect()->to(base_url('auth'));  // Perbarui sesuai kebutuhan
		}	
	}	

    // untuk login
	public function index() { 
        $this->load->view('auth/login'); 
    } 

	public function process_login() {
        $this->form_validation->set_rules('email', 'Email', 'trim|required|regex_match[/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/]');
        $this->form_validation->set_rules('password', 'Password', 'required|regex_match[/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])[0-9a-zA-Z]{8,}$/]');
    
        if ($this->form_validation->run() === FALSE) {
            $this->load->view('auth/login');
        } else {
            $email = $this->input->post('email', true);
            $password = $this->input->post('password', true);
            $data = ['email' => $email];
            $query = $this->m_model->getwhere('user', $data);
            $result = $query->row_array();
    
            if (!empty($result) && md5($password) === $result['password']) {
                $data = [
                    'logged_in' => TRUE,
                    'email' => $result['email'],
                    'username' => $result['username'],
                    'role' => $result['role'],
                    'id' => $result['id'],
                ];
                $this->session->set_userdata($data);
                if ($this->session->userdata('role') == 'admin') {
                    redirect(base_url() . 'admin');
                }elseif($this->session->userdata('role') == 'karyawan'){ 
                    redirect(base_url() . 'karyawan');
                } else {
                    redirect(base_url() . 'auth');
                }
            } else {
                // Set pesan kesalahan
                $data['login_error'] = 'Email atau kata sandi salah';
                $this->load->view('auth/login', $data);
            }
        }
    }

	function logout() { 
        $this->session->sess_destroy(); 
        redirect(base_url('auth')); 
    } 
}
?>