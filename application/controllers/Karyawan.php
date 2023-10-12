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
    $data['absensi'] = $this->M_model->get_data('absensi', 'id', $data)->result();
    $this->load->view('karyawan/ubah_karyawan', $data);
    }

    // untuk hapus
     public function hapusKaryawan($id)
    {
        $this->M_model->delete('absensi', 'id', $id);
        redirect(base_url('karyawan/hapusKaryawan'));
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
        date_default_timezone_set('Asia/Jakarta');
        $current_datetime = date('Y-m-d H:i:s');

        $data = [
            'kegiatan' => $this->input->post('kegiatan'),
            'date' => $current_datetime,
            'jam_masuk' => $current_datetime,
            'jam_pulang' => $current_datetime,
        ];

        $this->load->model('Absensi_model');
        $this->Absensi_model->createAbsensi($data);

        redirect('karyawan/history_absen');
    }
}
?>