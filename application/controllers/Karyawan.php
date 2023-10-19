<?php
defined('BASEPATH') or exit('No direct script access allowed');

class karyawan extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('M_model');
        $this->load->model('absensi_model');
        $this->load->helper('my_helper');
        if($this->session->userdata('logged_in')!=true || $this->session->userdata('role') != 'karyawan') {
            redirect(base_url().'auth');
        }
    }
    public function index()
    {
        // Mengisi data yang diperlukan untuk tampilan
        $data = array(
            'title' => 'Dashboard Karyawan', // Judul halaman
            'content' => 'Selamat datang di dashboard karyawan.', // Konten halaman
        );

        // Menampilkan tampilan (sesuaikan dengan nama tampilan Anda)
        $this->load->view('karyawan/index', $data);
    }

    // untuk absen
    public function absensi()
    {
        $this->load->model('Absensi_model');
        $data['absensi'] = $this->Absensi_model->getAbsensi();
        $this->load->view('karyawan/absensi', $data);
    }

    // untuk history absen
    public function history_absen()
    {
        $id_karyawan = $this->session->userdata('id');
        $data['absensi'] = $this->M_model->get_data('absensi')->result();
        $this->load->view('karyawan/history_absen', $data);
    }

     // untuk izin karyawan
     public function izin_karyawan() {
    
        $data['absensi'] = $this->M_model->get_data('absensi')->result();
        $data['akun'] = $this->M_model->get_by_id('user', 'id', $this->session->userdata('id'))->result();
        $this->load->view('karyawan/izin_karyawan', $data);
}

    // untuk ubah
    public function ubah_karyawan($id) {
        // Lakukan pengambilan data yang diperlukan berdasarkan $id
        // Misalnya, menggunakan model untuk mengambil data dari database
    
        $data['id'] = $id; // Mengatur nilai $id ke dalam variabel $data
    
        $this->load->view('karyawan/ubah_karyawan', $data);
    }    

        // profil
        public function profil_karyawan()
        {
            $data['akun'] = $this->M_model->get_by_id('user', 'id', $this->session->userdata('id'))->result();
            $this->load->view('karyawan/profil_karyawan', $data);
        }

        // untuk aksi ubah
        public function aksi_ubah_karyawan() { 
            $id = $this->input->post('id'); 
            $kegiatan = $this->input->post('kegiatan'); 
        
            $data = [
                'kegiatan' => $kegiatan,
            ];
        
            $this->M_model->update('absensi', $data, array('id'=>$id)); 
            redirect(base_url('karyawan/history_absen')); 
            $this->session->set_flashdata('berhasil_ubah_absen', 'Berhasil mengubah kegiatan atau keterangan izin'); 
        }
        
        public function absen()
	{
		$id_karyawan = $this->session->userdata('id');
		$data['absensi'] = $this->m_model->get_absensi_by_karyawan($id_karyawan);
		$this->load->view('karyawan/history_absen', $data);
	}

        // // untuk aksi absensi
        public function save_absensi()
        {
            $id_karyawan = $this->session->userdata('id');
            date_default_timezone_set('Asia/Jakarta');
            $current_datetime = date('Y-m-d H:i:s');

            $tanggal = date('Y-m-d', strtotime($current_datetime));
            $jam = date('H:i:s', strtotime($current_datetime));

            // Ambil nilai $keterangan dari formulir POST
            $keterangan_izin = $this->input->post('keterangan_izin');

            // Periksa apakah $keterangan memiliki nilai, jika tidak, beri nilai default (misalnya, '')
            if ($keterangan_izin === NULL) {
                $keterangan_izin = '';
            }

            $data = [
                'id_karyawan' => $id_karyawan, 
                'kegiatan' => $this->input->post('kegiatan'),
                'date' => $tanggal,
                'jam_masuk' => $jam,
                'jam_pulang' => '',
                'keterangan_izin' => $keterangan_izin,
                'status' => 'Not',
            ];        

            $this->load->model('Absensi_model');
            $this->Absensi_model->createAbsensi($data);

            redirect('karyawan/history_absen');
        }

    // untuk aksi izin
    public function aksi_izin() {
        $id_karyawan = $this->session->userdata('id');
        date_default_timezone_set('Asia/Jakarta');
        $current_datetime = date('Y-m-d H:i:s');
        $absensi = $this->session->userdata('id');

        $tanggal = date('Y-m-d', strtotime($current_datetime));
        $keterangan_izin = $this->input->post('keterangan_izin');
        $data = [
            'id_karyawan' => $id_karyawan,
            'kegiatan' => '-',
            'date' => $tanggal,
            'jam_masuk' => '',
            'jam_pulang' => '',
            'status' => 'Done',
            'keterangan_izin' =>$this->input->post('keterangan_izin'),

        ];

        if ($this->input->post('keterangan_izin')) {
            $keterangan_izin = $this->input->post('keterangan_izin');
        } else {
            $keterangan_izin = ''; // Atau Anda dapat menetapkan nilai default sesuai kebutuhan.
        }        

        $hasSubmittedAbsensi = $this->M_model->checkAbsensiExists($absensi, date('Y-m-d'));

        if (!$hasSubmittedAbsensi) {
            $this->M_model->tambah_data('absensi', $data);
        } else {

        }
        redirect(base_url('karyawan/history_absen'));
    }  

     // untuk hapus
     public function hapus($id)
     {
         $this->M_model->delete('absensi', 'id', $id);
         redirect(base_url('karyawan/history_absen'));  
     } 
     
    //  untuk pulang
    public function pulang($absen_id) { 
        if ($this->session->userdata('role') === 'karyawan') { 
            $this->M_model->setAbsensiPulang($absen_id); 
     
            // Set pesan sukses 
            $this->session->set_flashdata('success', 'Jam pulang berhasil diisi.'); 
     
            redirect('karyawan/history_absen'); 
        } else { 
            redirect('karyawan/history_absen'); 
        } 
    }

    // untuk upload image
    public function upload_image($field_name)
    {
        $config['upload_path'] = './images/user/';
        $config['allowed_types'] = 'jpg|png|jpeg';
        $config['max_size'] = 30000;

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload($field_name)) {
            $error = array('error' => $this->upload->display_errors());
            return array(false, $error);
        } else {
            $data = $this->upload->data();
            $file_name = $data['file_name'];
            return array(true, $file_name);
        }
    }

    // untuk aksi profil
    public function aksi_update_profile()
    {
        $this->load->model('M_model'); // Memuat model
    
        $email = $this->input->post('email');
        $username = $this->input->post('username');
        $nama_depan = $this->input->post('nama_depan');
        $nama_belakang = $this->input->post('nama_belakang');
        $image = $this->input->post('image'); // Ganti dari post ke file
        
        $data = [
            'image' => $image,
            'username' => $username,
            'nama_depan' => $nama_depan,
            'nama_belakang' => $nama_belakang,
        ];
    
        $this->session->set_userdata($data);
        
        // Menggunakan model untuk memperbarui data dalam database
        $update_result = $this->M_model->updateProfile($this->session->userdata('id'), $data);

        if ($update_result) {
            redirect(base_url('karyawan/profil_karyawan'));
        } else {
        // Pembaruan gagal, Anda dapat menangani ini sesuai kebutuhan
        echo "Gagal memperbarui profil. Error: " . $this->db->error()['message'];
        }
    }    

    public function edit_profile()
	{
		$password_baru = $this->input->post('password_baru');
		$konfirmasi_password = $this->input->post('konfirmasi_password');
		$email = $this->input->post('email');
		$username = $this->input->post('username');
		$nama_depan = $this->input->post('nama_depan');
		$nama_belakang = $this->input->post('nama_belakang');

		$data = array(
			'email' => $email,
			'username' => $username,
			'nama_depan' => $nama_depan,
			'nama_belakang' => $nama_belakang,
		);

		if (!empty($password_baru)) {
			if ($password_baru === $konfirmasi_password) {
				$data['password'] = md5($password_baru);
				$this->session->set_flashdata('ubah_password', 'Berhasil mengubah password');
			} else {
				$this->session->set_flashdata('kesalahan_password', 'Password baru dan Konfirmasi password tidak sama');
				redirect(base_url('karyawan/profil_karyawan'));
			}
		}

		$this->session->set_userdata($data);
		$update_result = $this->M_model->ubah_data('user', $data, array('id' => $this->session->userdata('id')));

		if ($update_result) {
			$this->session->set_flashdata('update_user', 'Data berhasil diperbarui');
			redirect(base_url('karyawan/profil_karyawan'));
		} else {
			$this->session->set_flashdata('gagal_update', 'Gagal memperbarui data');
			redirect(base_url('karyawan/profil_karyawan'));
		}
	}

    public function edit_foto() {
        $config['upload_path'] = './assets/images/user/'; // Lokasi penyimpanan gambar di server
        $config['allowed_types'] = 'jpg|jpeg|png'; // Tipe file yang diizinkan
        $config['max_size'] = 5120; // Maksimum ukuran file (dalam KB)
       
        $this->load->library('upload', $config);
       
        if ($this->upload->do_upload('userfile')) {
         $upload_data = $this->upload->data();
         $file_name = $upload_data['file_name'];
       
         // Update nama file gambar baru ke dalam database untuk user yang sesuai
         $user_id = $this->session->userdata('id'); // Ganti ini dengan cara Anda menyimpan ID user yang sedang login
         $current_image = $this->M_model->get_current_image($user_id); // Dapatkan nama gambar saat ini
       
         if ($current_image !== 'User.png') {
          // Hapus gambar saat ini jika bukan 'User.png'
          unlink('./assets/images/user/' . $current_image);
         }
       
         $this->M_model->update_image($user_id, $file_name); // Gantilah 'm_model' dengan model Anda
         $this->session->set_flashdata('berhasil_ubah_foto', 'Foto berhasil diperbarui.');
      
       
         // Redirect atau tampilkan pesan keberhasilan
         redirect('karyawan/profil_karyawan'); // Gantilah dengan halaman yang sesuai
        } else {
         $error = array('error' => $this->upload->display_errors());
         $this->session->set_flashdata('error_profile', $error['error']);
         redirect('karyawan/profil_karyawan');
         // Tangani kesalahan unggah gambar
        }
       }

}
?>