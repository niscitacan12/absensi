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
    public function ubah_karyawan()
    {
        $data['absensi'] = $this->M_model->get_data('absensi', 'id')->result();
        $this->load->view('karyawan/ubah_karyawan', $data);
    }

        // profil
        public function profil_karyawan()
        {
            $data['absensi'] = $this->M_model->get_by_id('absensi', 'id', $this->session->userdata('id'))->result();
            $this->load->view('karyawan/profil_karyawan', $data);
        }

        public function save_absensi() {
            $id_karyawan = $this->session->userdata('id');
            $tanggal_sekarang = date('Y-m-d'); // Mendapatkan tanggal hari ini
        
            // Cek apakah sudah melakukan absen hari ini
            $is_already_absent = $this->M_model->cek_absen($id_karyawan, $tanggal_sekarang);
        
            // Cek apakah sudah melakukan izin hari ini
            $is_already_izin = $this->M_model->cek_izin($id_karyawan, $tanggal_sekarang);
        
            if ($is_already_absent) {
                $this->session->set_flashdata('gagal_absen', 'Anda sudah melakukan absen hari ini.');
            } elseif ($is_already_izin) {
                $this->session->set_flashdata('gagal_absen', 'Anda sudah mengajukan izin hari ini.');
            } else {
                $data = [
                    'id_karyawan' => $id_karyawan,
                    'kegiatan' => $this->input->post('kegiatan'),
                    'status' => 'false',
                    'keterangan_izin' => 'masuk',
                    'jam_pulang' => '00:00:00', // Mengosongkan jam_pulang
                    'date' => $tanggal_sekarang, // Menyimpan tanggal absen
                ];
                $this->M_model->tambah_data('absensi', $data);
                $this->session->set_flashdata('berhasil_absen', 'Berhasil Absen.');
            }
        
            redirect(base_url('karyawan/history_absen'));
        }

        // // untuk aksi absensi
        // public function save_absensi()
        // {
        //     $id_karyawan = $this->session->userdata('id');
        //     date_default_timezone_set('Asia/Jakarta');
        //     $current_datetime = date('Y-m-d H:i:s');

        //     $tanggal = date('Y-m-d', strtotime($current_datetime));
        //     $jam = date('H:i:s', strtotime($current_datetime));

        //     // Ambil nilai $keterangan dari formulir POST
        //     $keterangan = $this->input->post('keterangan_izin');

        //     // Periksa apakah $keterangan memiliki nilai, jika tidak, beri nilai default (misalnya, '')
        //     if ($keterangan === NULL) {
        //         $keterangan = '';
        //     }

        //     $data = [
        //         'id_karyawan' => $id_karyawan, 
        //         'kegiatan' => $this->input->post('kegiatan'),
        //         'date' => $tanggal,
        //         'jam_masuk' => $jam,
        //         'jam_pulang' => '',
        //         'keterangan_izin' => $keterangan,
        //         'status' => 'Not',
        //     ];        

        //     $this->load->model('Absensi_model');
        //     $this->Absensi_model->createAbsensi($data);

        //     redirect('karyawan/history_absen');
        // }

    // untuk aksi izin
    public function aksi_izin() 
    { 
        $id_karyawan = $this->session->userdata('id'); 
        date_default_timezone_set('Asia/Jakarta'); 
        $current_datetime = date('Y-m-d H:i:s'); 
        $absen = $this->session->userdata('id'); // Ambil ID Karyawan dari sesi atau cara lain yang sesuai. 
     
        $tanggal = date('Y-m-d', strtotime($current_datetime)); 
 
        $kegiatan = $this->input->post('kegiatan'); // Ambil jenis kegiatan dari form 
        $keterangan = ($kegiatan == 'izin') ? 'izin' : 'masuk'; // Tetapkan keterangan sesuai dengan jenis kegiatan 
     
        $data = [ 
            'id_karyawan' => 11, 
            'kegiatan' => $this->input->post('kegiatan'), 
            'date' => $tanggal, // Mengisi tanggal saat ini 
            'jam_masuk' => '', // Mengosongkan jam masuk 
            'jam_pulang' => '', // Mengosongkan jam pulang 
            'keterangan_izin' => $keterangan, // Menyimpan keterangan sesuai dengan jenis kegiatan 
            'status' => 'Done' // Mengubah status menjadi "Done" 
        ]; 
     
        // Cek apakah karyawan sudah absen pada tanggal yang sama sebelumnya 
        $hasSubmittedAbsensi = $this->M_model->checkAbsensiExists($absen, date('Y-m-d')); 
     
        if (!$hasSubmittedAbsensi) { 
            $this->M_model->tambah_data('absensi', $data); 
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
        if ($eksekusi) {
            $this->session->set_flashdata('berhasil_ubah_karyawan', 'Berhasil mengubah kegiatan');
        }
    
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
    public function upload_image()
    {  
        $base64_image = $this->input->post('base64_image');

        $binary_image = base64_encode($base64_image);
    
        $data = array(
            'foto' => $binary_image
        );
    
        $eksekusi = $this->m_model->ubah_data('user', $data, array('id'=>$this->input->post('id')));
        if($eksekusi) {
            $this->session->set_flashdata('sukses' , 'berhasil');
            redirect(base_url('karyawan/akun'));
        } else {
            $this->session->set_flashdata('error' , 'gagal...');
           echo "error gais";
        }
    }

    public function aksi_update_profile()
    {
        $email = $this->input->post('email');
        $username = $this->input->post('username');
        $nama_depan = $this->input->post('nama_depan');
        $nama_belakang = $this->input->post('nama_belakang');
        $image = $this->input->post('image');
     
				$data = [
                   'image' => $image,
                   'username' => $username,
                   'nama_depan' => $nama_depan,
                   'nama_belakang' => $nama_belakang,
               ];
               
               $this->session->set_userdata($data);
               $update_result = $this->M_model->ubah_data('users', $data, array('id' => $this->session->userdata('id')));
               redirect(base_url('karyawan/profil_karyawan'));
	}
}
?>