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
        $email = $this->input->post('email', true); 
        $username = $this->input->post('username', true); 
        $password = md5($this->input->post('password', true)); 
        $nama_depan = $this->input->post('nama_depan', true); 
        $nama_belakang = $this->input->post('nama_belakang', true); 
        $role = 'karyawan'; 
     
        // Jika ada gambar diunggah 
        if ($_FILES['image']['name']) { 
            $config['upload_path'] = './path_to_upload_directory/'; // Ganti dengan lokasi direktori upload Anda 
            $config['allowed_types'] = 'gif|jpg|png'; 
            $config['max_size'] = 2048; // Ukuran file maksimum (dalam KB) 
     
            $this->load->library('upload', $config); 
     
            if ($this->upload->do_upload('image')) { 
                $image_data = $this->upload->data(); 
                $image = $image_data['file_name']; 
            } else { 
                $image = 'User.png'; // Jika gagal mengunggah, menggunakan gambar default 
            } 
        } else { 
            $image = 'User.png'; // Jika tidak ada gambar diunggah, menggunakan gambar default 
        } 
     
        $data = [ 
            'email' => $email, 
            'username' => $username, 
            'password' => $password, 
            'role' => $role, 
            'nama_depan' => $nama_depan, 
            'nama_belakang' => $nama_belakang, 
            'image' => $image 
        ]; 
     
        $table = 'user'; 
     
        $this->db->insert($table, $data); 
     
        if ($this->db->affected_rows() > 0) { 
            // Registrasi berhasil 
            $this->session->set_userdata([ 
                'logged_in' => TRUE, 
                'email' => $email, 
                'username' => $username, 
                'role' => $role, 
                'nama_depan' => $nama_depan, 
                'nama_belakang' => $nama_belakang, 
                'image' => $image 
            ]); 
            redirect(base_url() . "auth"); 
        } else { 
            // Registrasi gagal 
            redirect(base_url() . "auth/register"); 
        } 
        }

	// untuk aksi register admin
	public function process_register_admin() { 
        $email = $this->input->post('email', true); 
        $username = $this->input->post('username', true); 
        $password = md5($this->input->post('password', true)); 
        $nama_depan = $this->input->post('nama_depan', true); 
        $nama_belakang = $this->input->post('nama_belakang', true); 
        $role = 'admin'; 
     
        // Jika ada gambar diunggah 
        if ($_FILES['image']['name']) { 
            $config['upload_path'] = './path_to_upload_directory/'; // Ganti dengan lokasi direktori upload Anda 
            $config['allowed_types'] = 'gif|jpg|png'; 
            $config['max_size'] = 2048; // Ukuran file maksimum (dalam KB) 
     
            $this->load->library('upload', $config); 
     
            if ($this->upload->do_upload('image')) { 
                $image_data = $this->upload->data(); 
                $image = $image_data['file_name']; 
            } else { 
                $image = 'User.png'; // Jika gagal mengunggah, menggunakan gambar default 
            } 
        } else { 
            $image = 'User.png'; // Jika tidak ada gambar diunggah, menggunakan gambar default 
        } 
     
        $data = [ 
            'email' => $email, 
            'username' => $username, 
            'password' => $password, 
            'role' => $role, 
            'nama_depan' => $nama_depan, 
            'nama_belakang' => $nama_belakang, 
            'image' => $image 
        ]; 
     
        $table = 'user'; 
     
        $this->db->insert($table, $data); 
     
        if ($this->db->affected_rows() > 0) { 
            // Registrasi berhasil 
            $this->session->set_userdata([ 
                'logged_in' => TRUE, 
                'email' => $email, 
                'username' => $username, 
                'role' => $role, 
                'nama_depan' => $nama_depan, 
                'nama_belakang' => $nama_belakang, 
                'image' => $image 
            ]); 
            redirect(base_url() . "auth"); 
        } else { 
            // Registrasi gagal 
            redirect(base_url() . "auth/register_admin"); 
        } 
        }

    // untuk login
	public function index() { 
        $this->load->view('auth/login'); 
    } 

    // untuk aksi login
    public function process_login()
	{
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
			redirect(base_url()."auth");
		}
        }
	}

	function logout() { 
        $this->session->sess_destroy(); 
        redirect(base_url('auth')); 
    } 
}
?>