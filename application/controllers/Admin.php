<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('M_model');
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

    public function rekap_mingguan() {
        $data['absen'] = $this->m_model->getAbsensiLast7Days();        
        $this->load->view('admin/rekap_mingguan', $data);
    }
}
?>