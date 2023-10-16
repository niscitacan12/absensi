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
     public function izin_karyawan()
     {
         $data['absensi'] = $this->M_model->get_data('absensi')->result();
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
        public function profil_karyawan() {
            // Mendapatkan data pengguna dari model atau sumber data lainnya
            $data['users'] = $this->M_model->get_user_data(); // Gantilah dengan pemanggilan yang sesuai
        
            $this->load->view('karyawan/profil_karyawan', $data);
        }        

        // public function save_absensi() {
        //     $id_karyawan = $this->session->userdata('id');
        //     $tanggal_sekarang = date('Y-m-d'); // Mendapatkan tanggal hari ini
        //     $jam_masuk = date('H:i:s'); // Mendapatkan waktu saat ini
            
        //     // Cek apakah sudah melakukan absen hari ini
        //     $is_already_absent = $this->M_model->cek_absen($id_karyawan, $tanggal_sekarang);
            
        //     // Cek apakah sudah melakukan izin hari ini
        //     $is_already_izin = $this->M_model->cek_izin($id_karyawan, $tanggal_sekarang);
            
        //     if ($is_already_absent) {
        //         $this->session->set_flashdata('gagal_absen', 'Anda sudah melakukan absen hari ini.');
        //     } elseif ($is_already_izin) {
        //         $this->session->set_flashdata('gagal_absen', 'Anda sudah mengajukan izin hari ini.');
        //     } else {
        //         $data = [
        //             'id_karyawan' => 12, // Menggunakan $id_karyawan dari session
        //             'kegiatan' => $this->input->post('kegiatan'),
        //             'status' => 'false',
        //             'keterangan_izin' => 'masuk',
        //             'jam_pulang' => '', // Mengosongkan jam_pulang
        //             'jam_masuk' => $jam_masuk, // Menyimpan waktu masuk
        //             'date' => $tanggal_sekarang, // Menyimpan tanggal absen
        //         ];
        //         $this->M_model->tambah_data('absensi', $data);
        //         $this->session->set_flashdata('berhasil_absen', 'Berhasil Absen.');
        //     }
            
        //     redirect(base_url('karyawan/history_absen'));
        // }        

        // // untuk aksi absensi
        public function save_absensi()
        {
            $id_karyawan = $this->session->userdata('id');
            date_default_timezone_set('Asia/Jakarta');
            $current_datetime = date('Y-m-d H:i:s');

            $tanggal = date('Y-m-d', strtotime($current_datetime));
            $jam = date('H:i:s', strtotime($current_datetime));

            // Ambil nilai $keterangan dari formulir POST
            $keterangan = $this->input->post('keterangan_izin');

            // Periksa apakah $keterangan memiliki nilai, jika tidak, beri nilai default (misalnya, '')
            if ($keterangan === NULL) {
                $keterangan = '';
            }

            $data = [
                'id_karyawan' => 23, 
                'kegiatan' => $this->input->post('kegiatan'),
                'date' => $tanggal,
                'jam_masuk' => $jam,
                'jam_pulang' => '',
                'keterangan_izin' => $keterangan,
                'status' => 'Not',
            ];        

            $this->load->model('Absensi_model');
            $this->Absensi_model->createAbsensi($data);

            redirect('karyawan/history_absen');
        }

    // untuk aksi izin
    public function aksi_izin()
    {
        $id_karyawan = $this->session->userdata('id');
        date_default_timezone_set('Asia/Jakarta');
        $current_datetime = date('Y-m-d H:i:s');
        $absen = $this->session->userdata('id'); // Ambil ID Karyawan dari sesi atau cara lain yang sesuai.
    
        $tanggal = date('Y-m-d', strtotime($current_datetime));
    
        $kegiatan = $this->input->post('kegiatan'); // Ambil jenis kegiatan dari form
        $keterangan_izin = $this->input->post('keterangan_izin'); // Ambil keterangan izin dari form
    
        // Inisialisasi variabel keterangan
        $keterangan = '';
    
        // Periksa apakah jenis kegiatan adalah "izin"
        if ($kegiatan == 'izin') {
            // Jika izin, atur kegiatan menjadi kosong dan keterangan diisi dengan "izin"
            $kegiatan = '';
            $keterangan = 'izin';
        } else {
            // Jika jenis kegiatan bukan "izin," tetapkan keterangan sesuai dengan input
            $keterangan = $keterangan_izin;
        }
    
        $data = [
            'id_karyawan' => $id_karyawan,
            'kegiatan' => $kegiatan,
            'date' => $tanggal, // Mengisi tanggal saat ini
            'jam_masuk' => '', // Mengosongkan jam masuk
            'jam_pulang' => '', // Mengosongkan jam pulang
            'keterangan_izin' => $keterangan, // Menyimpan keterangan izin yang diisi oleh pengguna atau "izin" jika jenis kegiatan adalah "izin"
            'status' => 'Done' // Mengubah status menjadi "Done"
        ];
    
        // Cek apakah karyawan sudah absen pada tanggal yang sama sebelumnya
        $hasSubmittedAbsensi = $this->M_model->checkAbsensiExists($absen, date('Y-m-d'));
    
        if (!$hasSubmittedAbsensi) {
            $this->m_model->tambah_data('absensi', $data);
        } else {
            // Karyawan sudah absen pada hari ini, Anda dapat menangani ini sesuai kebutuhan Anda
        }
    
        redirect(base_url('karyawan/history_absen'));
    }
    

    // untuk aksi ubah karyawan
    public function aksi_ubah_karyawan()
    {
        $id = $this->input->post('id'); // Ambil id dari data POST
        $data = [
            'kegiatan' => $this->input->post('kegiatan'),
        ];
        $eksekusi = $this->M_model->update_data('absensi', $data, array('id' => $id)); // Gunakan $id dari data POST
    
        // Tambahkan kondisional untuk menampilkan pesan berdasarkan $row->keterangan_izin
        $pesan = '';
        if ($eksekusi) {
            $pesan = 'Berhasil mengubah kegiatan';
        }
    
        $row = $this->M_model->get_data('absensi', array('id' => $id)); // Ganti $row dengan data aktual yang telah diubah
        if ($row->keterangan_izin === '-') {
            $pesan .= ' Input an kegiatan';
        } else {
            $pesan .= ' Input an keterangan izin';
        }
    
        $this->session->set_flashdata('berhasil_ubah_karyawan', $pesan);
        redirect(base_url('karyawan/history_absen'));
    }
    

    // untuk pulang
    // public function pulang($id) {
    //     $this->M_model->updateStatusPulang($id);
	// 	$this->session->set_flashdata('berhasil_pulang', 'Berhasil pulang.');
    //     redirect('karyawan/history_absen');
    // }

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
    // public function aksi_pulang()
    // {
    //     $id_karyawan = $this->input->post('id_karyawan');
        
    //     // Set zona waktu ke "Asia/Jakarta"
    //     date_default_timezone_set('Asia/Jakarta');
        
    //     $current_datetime = date('Y-m-d H:i:s');
        
    //     list($date, $time) = explode(' ', $current_datetime);
    
    //     $absensi = $this->M_model->getAbsenByKaryawan($id_karyawan);
        
    //     if ($absensi !== null) { // Periksa apakah $absensi bukan null
    //         if ($absensi->status != 'Done') {
    //             $data = [
    //                 'jam_pulang' => $time, // Menggunakan waktu saat ini
    //                 'status' => 'Done'
    //             ];
    //             $this->M_model->updateAbsen($absensi->id_karyawan, $data);
    //         }
    //     }
        
    //     redirect(base_url('karyawan/history_absen'));
    // }

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
}
?>