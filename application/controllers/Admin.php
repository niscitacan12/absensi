<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('M_model');
        $this->load->model('admin_model');
        $this->load->helper('my_helper');
        if($this->session->userdata('logged_in')!=true) {
            redirect(base_url().'auth');
        }
    }

    public function index()
	{
		$this->load->view('admin/index');
	}

    public function data_karyawan()
	{
        $data['user'] = $this->M_model->getDataKaryawan();

		$this->load->view('admin/data_karyawan', $data);
	}

    public function tabel_karyawan()
    {
        $data['absensi'] = $this->M_model->getAbsensi();
         $this->load->view('admin/tabel_karyawan', $data);
    }

    public function rekap_harian()
    {
        $data['perhari'] = $this->M_model->get_data_perhari(); // Gantilah nama_model dengan nama model yang sesuai
        $this->load->view('admin/rekap_harian', $data);
    }
    
    public function rekap_mingguan() {
        $start_date = '2023-10-01'; // Tanggal awal
        $end_date = '2023-10-07';   // Tanggal akhir
        $data['perminggu'] = $this->M_model->getRekapPerMinggu($start_date, $end_date);        
$this->load->view('admin/rekap_mingguan', $data); // Mengirim data ke tampilan
    }

    public function rekap_bulanan() {
        $bulan = $this->input->get('bulan'); // Ambil bulan dari parameter GET
        $data['rekap_bulanan'] = $this->M_model->getRekapBulanan($bulan);
        $this->load->view('admin/rekap_bulanan', $data);
    }   

    public function rekapPerHari() {
		$tanggal = $this->input->get('tanggal');
        $data['perhari'] = $this->M_model->getPerHari($tanggal);
        $this->load->view('admin/rekap_harian', $data);
    }

}
?>