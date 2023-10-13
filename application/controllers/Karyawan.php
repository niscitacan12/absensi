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
    public function ubah_karyawan($id)
    {
        $data['absensi'] = $this->M_model->get_data('absensi', 'id', $id)->result();
    $this->load->view('karyawan/ubah_karyawan', $data);
    }

        // profil
        public function profil_karyawan()
        {
            $data['absensi'] = $this->M_model->get_by_id('absensi', 'id', $this->session->userdata('id'))->result();
            $this->load->view('karyawan/profil_karyawan', $data);
        }

        // untuk aksi absensi
        public function save_absensi()
    {
        $id_karyawan = $this->session->userdata('id');
        date_default_timezone_set('Asia/Jakarta');
        $current_datetime = date('Y-m-d H:i:s');
        $absensi = $this->session->userdata('id');

        $tanggal = date('Y-m-d', strtotime($current_datetime));
        $jam = date('H:i:s', strtotime($current_datetime));

        $data = [
            'id_karyawan' => 3, 
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
        $keterangan = ($kegiatan == 'izin') ? 'izin' : 'masuk'; // Tetapkan keterangan sesuai dengan jenis kegiatan 
     
        $data = [ 
            'id_karyawan' => 3, 
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

     // untuk hapus
     public function hapus($id)
     {
         $this->M_model->delete('absensi', 'id', $id);
         redirect(base_url('karyawan/history_absen'));
     } 
     
}
?>