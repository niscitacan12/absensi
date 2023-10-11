<?php
defined('BASEPATH') or exit('No direct script access allowed');

class karyawan extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('m_model');
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
        $data['absensi'] = $this->m_model->get_data('absensi')->result();
        $this->load->view('karyawan/absensi', $data);
    }
}
?>