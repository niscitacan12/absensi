<?php
defined('BASEPATH') or exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet; 
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

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
        $data['absensi'] = $this->M_model->getHistoriKaryawan();

		$this->load->view('admin/tabel_karyawan', $data);
	}

    public function rekap_harian()
    {
        $data['perhari'] = $this->M_model->get_data_perhari(); // Gantilah nama_model dengan nama model yang sesuai
        $this->load->view('admin/rekap_harian', $data);
    }
    
    public function rekap_mingguan() {
        $data['absensi'] = $this->M_model->getAbsensiLast7Days();        
        $this->load->view('admin/rekap_mingguan', $data);
    }
    

    public function rekap_bulanan() {
        $bulan = $this->input->post('bulan'); // Mengambil bulan dari input form
        $data['absensi'] = $this->M_model->get_bulanan($bulan); // Ganti dengan fungsi yang sesuai
        $this->session->set_flashdata('bulan', $bulan);
        $this->load->view('admin/rekap_bulanan', $data);
    }

    public function rekapPerHari() {
		$tanggal = $this->input->get('tanggal');
        $data['perhari'] = $this->M_model->getPerHari($tanggal);
        $this->load->view('admin/rekap_harian', $data);
    }

    // untuk hapus 
   // Misalnya, dalam controller Anda
public function hapus($id) {
    // Lakukan penghapusan data dengan ID tertentu dari database.
    // Pastikan Anda mengeksekusi query penghapusan dengan benar.

    if ($penghapusan_berhasil) {
        echo "success"; // Berhasil menghapus data.
    } else {
        echo "failure"; // Gagal menghapus data.
    }
}

    // profil
    public function profil_admin()
    {
        $data['akun'] = $this->M_model->get_by_id('user', 'id', $this->session->userdata('id'))->result();
        $this->load->view('admin/profil_admin', $data);
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
            redirect(base_url('admin/profil_admin'));
        } else {
        // Pembaruan gagal, Anda dapat menangani ini sesuai kebutuhan
        echo "Gagal memperbarui profil. Error: " . $this->db->error()['message'];
        }
    } 
    
    // edit profil
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
				redirect(base_url('admin/profil_admin'));
			}
		}

		$this->session->set_userdata($data);
		$update_result = $this->M_model->ubah_data('user', $data, array('id' => $this->session->userdata('id')));

		if ($update_result) {
			$this->session->set_flashdata('update_user', 'Data berhasil diperbarui');
			redirect(base_url('admin/profil_admin'));
		} else {
			$this->session->set_flashdata('gagal_update', 'Gagal memperbarui data');
			redirect(base_url('admin/profil_admin'));
		}
	}

    // edit foto
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
         redirect('admin/profil_admin'); // Gantilah dengan halaman yang sesuai
        } else {
         $error = array('error' => $this->upload->display_errors());
         $this->session->set_flashdata('error_profile', $error['error']);
         redirect('admin/profil_admin');
         // Tangani kesalahan unggah gambar
        }
       }

    // untuk export
    public function export_data_karyawan()
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $style_col = [
            'font' => ['bold' => true],
            'alignment' => [
                'horizontal' =>
                    \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical' =>
                    \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
            ],
            'borders' => [
                'top' => [
                    'borderStyle' =>
                        \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
                'right' => [
                    'borderStyle' =>
                        \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
                'bottom' => [
                    'borderStyle' =>
                        \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
                'left' => [
                    'borderStyle' =>
                        \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
            ],
        ];

        $style_row = [
            'font' => ['bold' => true],
            'alignment' => [
                'vertical' =>
                    \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
            ],
            'borders' => [
                'top' => [
                    'borderStyle' =>
                        \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
                'right' => [
                    'borderStyle' =>
                        \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
                'bottom' => [
                    'borderStyle' =>
                        \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
                'left' => [
                    'borderStyle' =>
                        \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
            ],
        ];

        $sheet->setCellValue('A1', 'DATA KARYAWAN');
        $sheet->mergeCells('A1:E1');
        $sheet
            ->getStyle('A1')
            ->getFont()
            ->setBold(true);

        $sheet->setCellValue('A3', 'ID');
        $sheet->setCellValue('B3', 'NAMA');
        $sheet->setCellValue('C3', 'EMAIL');
        $sheet->setCellValue('D3', 'NAMA DEPAN');
        $sheet->setCellValue('E3', 'NAMA BELAKANG');

        $sheet->getStyle('A3')->applyFromArray($style_col);
        $sheet->getStyle('B3')->applyFromArray($style_col);
        $sheet->getStyle('C3')->applyFromArray($style_col);
        $sheet->getStyle('D3')->applyFromArray($style_col);
        $sheet->getStyle('E3')->applyFromArray($style_col);

        // get dari database
        $data = $this->M_model->getDataKaryawan();

        $no = 1;
        $numrow = 4;
        foreach ($data as $data) {
            $sheet->setCellValue('A' . $numrow, $data->id);
            $sheet->setCellValue('B' . $numrow, $data->username);
            $sheet->setCellValue('C' . $numrow, $data->email);
            $sheet->setCellValue('D' . $numrow, $data->nama_depan);
            $sheet->setCellValue('E' . $numrow, $data->nama_belakang);

            $sheet->getStyle('A' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('B' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('C' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('D' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('E' . $numrow)->applyFromArray($style_row);

            $no++;
            $numrow++;
        }

        $sheet->getColumnDimension('A')->setWidth(5);
        $sheet->getColumnDimension('B')->setWidth(25);
        $sheet->getColumnDimension('C')->setWidth(25);
        $sheet->getColumnDimension('D')->setWidth(20);
        $sheet->getColumnDimension('E')->setWidth(20);

        $sheet->getDefaultRowDimension()->setRowHeight(-1);

        $sheet
            ->getPageSetup()
            ->setOrientation(
                \PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE
            );

        $sheet->setTitle('LAPORAN DATA KARYAWAN');

        header(
            'Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
        );
        header('Content-Disposition: attachment; filename="Data Karyawan.xlsx"');
        header('Cache-Control: max-age=0');

        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
    }

    // untuk export REKAP KESELURUHAN
    public function export_tabel_karyawan() 
    { 
        // Ambil data rekap bulanan dari model sesuai bulan yang dipilih 
        $data = $this->M_model->getHistoriKaryawan(); 
     
        $spreadsheet = new Spreadsheet(); 
        $sheet = $spreadsheet->getActiveSheet(); 
 
        $style_col = [ 
            'font' => ['bold' => true ], 
            'alignment' => [ 
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER, 
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER 
            ], 
            'borders' => [ 
                'top' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], 
                'right' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], 
                'bottom' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], 
                'left' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], 
            ] 
            ]; 
        $style_row = [ 
            'alignment' => [ 
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER 
            ], 
            'borders' => [ 
                'top' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], 
                'right' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], 
                'bottom' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], 
                'left' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], 
            ] 
        ]; 
 
        $sheet->setCellValue('A1', "REKAP KESELURUHAN"); 
        $sheet->mergeCells('A1:E1'); 
        $sheet->getStyle('A1')->getFont()->setBold(true); 
 
        $sheet->setCellValue('A3', "ID"); 
        $sheet->setCellValue('B3', "KEGIATAN"); 
        $sheet->setCellValue('C3', "NAMA"); 
        $sheet->setCellValue('D3', "TANGGAL"); 
        $sheet->setCellValue('E3', "JAM MASUK"); 
        $sheet->setCellValue('F3', "JAM PULANG"); 
        $sheet->setCellValue('G3', "KETERANGAN"); 
        $sheet->setCellValue('H3', "STATUS"); 
 
        
        $sheet->getStyle('A3')->applyFromArray($style_col); 
        $sheet->getStyle('B3')->applyFromArray($style_col); 
        $sheet->getStyle('C3')->applyFromArray($style_col); 
        $sheet->getStyle('D3')->applyFromArray($style_col); 
        $sheet->getStyle('E3')->applyFromArray($style_col); 
        $sheet->getStyle('F3')->applyFromArray($style_col); 
        $sheet->getStyle('G3')->applyFromArray($style_col); 
        $sheet->getStyle('H3')->applyFromArray($style_col); 
 
        $data = $this->M_model->getHistoriKaryawan(); 
 
       
        $no= 1; 
        $numrow = 4; 
        foreach($data as $data) { 
             
        $sheet->setCellValue('A'.$numrow,$data->id); 
        $sheet->setCellValue('B'.$numrow,$data->username); 
        $sheet->setCellValue('C'.$numrow,$data->kegiatan);  
        $sheet->setCellValue('D'.$numrow,$data->date);  
        $sheet->setCellValue('E'.$numrow,$data->jam_masuk);  
        $sheet->setCellValue('F'.$numrow,$data->jam_pulang);  
        $sheet->setCellValue('G'.$numrow,$data->keterangan_izin);  
        $sheet->setCellValue('H'.$numrow,$data->status);  
 
        $sheet->getStyle('A'.$numrow)->applyFromArray($style_row); 
        $sheet->getStyle('B'.$numrow)->applyFromArray($style_row); 
        $sheet->getStyle('C'.$numrow)->applyFromArray($style_row); 
        $sheet->getStyle('D'.$numrow)->applyFromArray($style_row); 
        $sheet->getStyle('E'.$numrow)->applyFromArray($style_row); 
        $sheet->getStyle('F'.$numrow)->applyFromArray($style_row); 
        $sheet->getStyle('G'.$numrow)->applyFromArray($style_row); 
        $sheet->getStyle('H'.$numrow)->applyFromArray($style_row); 
 
        $no++; 
        $numrow++; 
 
        } 
 
        $sheet->getColumnDimension('A')->setWidth(5); 
        $sheet->getColumnDimension('B')->setWidth(25); 
        $sheet->getColumnDimension('C')->setWidth(30); 
        $sheet->getColumnDimension('D')->setWidth(20); 
        $sheet->getColumnDimension('E')->setWidth(20); 
        $sheet->getColumnDimension('F')->setWidth(30); 
        $sheet->getColumnDimension('G')->setWidth(25);
        $sheet->getColumnDimension('H')->setWidth(25);
        $sheet->getDefaultRowDimension()->setRowHeight(-1);

        $sheet
            ->getPageSetup()
            ->setOrientation(
                \PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE
            );

        $sheet->setTitle('REKAP KESELURUHAN');

        header(
            'Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
        );
        header('Content-Disposition: attachment; filename="REKAP KESELURUHAN.xlsx"');
        header('Cache-Control: max-age=0');

        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
    }
    
    // export harian
    public function export_harian()
    {
		$tanggal = $this->input->get('tanggal');
    	
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $style_col = [
            'font' => ['bold' => true],
            'alignment' => [
                'horizontal' =>
                    \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical' =>
                    \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
            ],
            'borders' => [
                'top' => [
                    'borderStyle' =>
                        \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
                'right' => [
                    'borderStyle' =>
                        \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
                'bottom' => [
                    'borderStyle' =>
                        \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
                'left' => [
                    'borderStyle' =>
                        \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
            ],
        ];

        $style_row = [
            'font' => ['bold' => true],
            'alignment' => [
                'vertical' =>
                    \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
            ],
            'borders' => [
                'top' => [
                    'borderStyle' =>
                        \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
                'right' => [
                    'borderStyle' =>
                        \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
                'bottom' => [
                    'borderStyle' =>
                        \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
                'left' => [
                    'borderStyle' =>
                        \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
            ],
        ];

        $sheet->setCellValue('A1', 'Rekap Harian');
        $sheet->mergeCells('A1:G1');
        $sheet
            ->getStyle('A1')
            ->getFont()
            ->setBold(true);

        $sheet->setCellValue('A3', 'No');
        $sheet->setCellValue('B3', 'Nama');
        $sheet->setCellValue('C3', 'Kegiatan');
        $sheet->setCellValue('D3', 'Tanggal');
        $sheet->setCellValue('E3', 'Jam Masuk');
        $sheet->setCellValue('F3', 'Jam Pulang');
        $sheet->setCellValue('G3', 'Keterangan');

        $sheet->getStyle('A3')->applyFromArray($style_col);
        $sheet->getStyle('B3')->applyFromArray($style_col);
        $sheet->getStyle('C3')->applyFromArray($style_col);
        $sheet->getStyle('D3')->applyFromArray($style_col);
        $sheet->getStyle('E3')->applyFromArray($style_col);
        $sheet->getStyle('F3')->applyFromArray($style_col);
        $sheet->getStyle('G3')->applyFromArray($style_col);

        $harian = $this->M_model->getPerHari($tanggal);

        $no = 1;
        $numrow = 4;
        foreach ($harian as $data) {
            $sheet->setCellValue('A' . $numrow, $no);
            $sheet->setCellValue('B' . $numrow, $data['username']);
            $sheet->setCellValue('C' . $numrow, $data['kegiatan']);
            $sheet->setCellValue('D' . $numrow, $data['date']);
            $sheet->setCellValue('E' . $numrow, $data['jam_masuk']);
            $sheet->setCellValue('F' . $numrow, $data['jam_pulang']);
            $sheet->setCellValue('G' . $numrow, $data['keterangan_izin']);

            $sheet->getStyle('A' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('B' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('C' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('D' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('E' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('F' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('G' . $numrow)->applyFromArray($style_row);

            $no++;
            $numrow++;
        }

        $sheet->getColumnDimension('A')->setWidth(5);
        $sheet->getColumnDimension('B')->setWidth(25);
        $sheet->getColumnDimension('C')->setWidth(25);
        $sheet->getColumnDimension('D')->setWidth(20);
        $sheet->getColumnDimension('E')->setWidth(30);
        $sheet->getColumnDimension('F')->setWidth(30);
        $sheet->getColumnDimension('G')->setWidth(30);

        $sheet->getDefaultRowDimension()->setRowHeight(-1);

        $sheet
            ->getPageSetup()
            ->setOrientation(
                \PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE
            );

        $sheet->setTitle('Rekap Harian');

        header(
            'Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
        );
        header('Content-Disposition: attachment; filename="Rekap Harian.xlsx"');
        header('Cache-Control: max-age=0');

        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
    }

    // export mingguan
    public function export_rekap_mingguan()
    {

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $style_col = [
            'font' => ['bold' => true],
            'alignment' => [
                'horizontal' =>
                    \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical' =>
                    \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
            ],
            'borders' => [
                'top' => [
                    'borderStyle' =>
                        \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
                'right' => [
                    'borderStyle' =>
                        \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
                'bottom' => [
                    'borderStyle' =>
                        \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
                'left' => [
                    'borderStyle' =>
                        \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
            ],
        ];

        $style_row = [
            'font' => ['bold' => true],
            'alignment' => [
                'vertical' =>
                    \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
            ],
            'borders' => [
                'top' => [
                    'borderStyle' =>
                        \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
                'right' => [
                    'borderStyle' =>
                        \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
                'bottom' => [
                    'borderStyle' =>
                        \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
                'left' => [
                    'borderStyle' =>
                        \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
            ],
        ];

        $sheet->setCellValue('A1', 'REKAP MINGGUAN');
        $sheet->mergeCells('A1:G1');
        $sheet
            ->getStyle('A1')
            ->getFont()
            ->setBold(true);

        $sheet->setCellValue('A3', 'NO');
        $sheet->setCellValue('B3', 'KEGIATAN');
        $sheet->setCellValue('C3', 'TANGGAL');
        $sheet->setCellValue('D3', 'JAM MASUK');
        $sheet->setCellValue('E3', 'JAM PULANG');
        $sheet->setCellValue('F3', 'KETERANGAN');
        
        $sheet->getStyle('A3')->applyFromArray($style_col);
        $sheet->getStyle('B3')->applyFromArray($style_col);
        $sheet->getStyle('C3')->applyFromArray($style_col);
        $sheet->getStyle('D3')->applyFromArray($style_col);
        $sheet->getStyle('E3')->applyFromArray($style_col);
        $sheet->getStyle('F3')->applyFromArray($style_col);
        
        $data = $this->M_model->getAbsensiLast7Days();

        $no = 1;
        $numrow = 4;
        foreach ($data as $row) {
            $sheet->setCellValue('A' . $numrow, $no);
            $sheet->setCellValue('B' . $numrow, $row->kegiatan);
            $sheet->setCellValue('C' . $numrow, $row->date);
            $sheet->setCellValue('D' . $numrow, $row->jam_masuk);
            $sheet->setCellValue('E' . $numrow, $row->jam_pulang);
            $sheet->setCellValue('F' . $numrow, $row->keterangan_izin);
            
            $sheet->getStyle('A' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('B' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('C' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('D' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('E' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('F' . $numrow)->applyFromArray($style_row);
            
            $no++;
            $numrow++;
        }

        $sheet->getColumnDimension('A')->setWidth(5);
        $sheet->getColumnDimension('B')->setWidth(25);
        $sheet->getColumnDimension('C')->setWidth(25);
        $sheet->getColumnDimension('D')->setWidth(20);
        $sheet->getColumnDimension('E')->setWidth(30);
        $sheet->getColumnDimension('F')->setWidth(30);
        
        $sheet->getDefaultRowDimension()->setRowHeight(-1);

        $sheet
            ->getPageSetup()
            ->setOrientation(
                \PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE
            );

        $sheet->setTitle('REKAP MINGGUAN');

        header(
            'Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
        );
        header('Content-Disposition: attachment; filename="REKAP MINGGUAN.xlsx"');
        header('Cache-Control: max-age=0');

        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
    } 

    public function export_rekap_bulanan()
    {
        $bulan = $this->session->flashdata('bulan');
        $data = $this->M_model->get_bulanan($bulan);
    
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $style_col = [
            'font' => ['bold' => true],
            'alignment' => [
                'horizontal' =>
                    \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical' =>
                    \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
            ],
            'borders' => [
                'top' => [
                    'borderStyle' =>
                        \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
                'right' => [
                    'borderStyle' =>
                        \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
                'bottom' => [
                    'borderStyle' =>
                        \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
                'left' => [
                    'borderStyle' =>
                        \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
            ],
        ];

        $style_row = [
            'font' => ['bold' => true],
            'alignment' => [
                'vertical' =>
                    \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
            ],
            'borders' => [
                'top' => [
                    'borderStyle' =>
                        \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
                'right' => [
                    'borderStyle' =>
                        \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
                'bottom' => [
                    'borderStyle' =>
                        \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
                'left' => [
                    'borderStyle' =>
                        \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
            ],
        ];

        $sheet->setCellValue('A1', 'REKAP BULANAN');
        $sheet->mergeCells('A1:G1');
        $sheet
            ->getStyle('A1')
            ->getFont()
            ->setBold(true);

        $sheet->setCellValue('A3', 'NO');
        $sheet->setCellValue('B3', 'KEGIATAN');
        $sheet->setCellValue('C3', 'TANGGAL');
        $sheet->setCellValue('D3', 'JAM MASUK');
        $sheet->setCellValue('E3', 'JAM PULANG');
        $sheet->setCellValue('F3', 'KETERANGAN');
        
        $sheet->getStyle('A3')->applyFromArray($style_col);
        $sheet->getStyle('B3')->applyFromArray($style_col);
        $sheet->getStyle('C3')->applyFromArray($style_col);
        $sheet->getStyle('D3')->applyFromArray($style_col);
        $sheet->getStyle('E3')->applyFromArray($style_col);
        $sheet->getStyle('F3')->applyFromArray($style_col);
       
        $data = $this->M_model->get_bulanan($bulan);

        $no = 1;
        $numrow = 4;
        foreach ($data as $row) {
            $sheet->setCellValue('A' . $numrow, $no);
            $sheet->setCellValue('B' . $numrow, $row->kegiatan);
            $sheet->setCellValue('C' . $numrow, $row->date);
            $sheet->setCellValue('D' . $numrow, $row->jam_masuk);
            $sheet->setCellValue('E' . $numrow, $row->jam_pulang);
            $sheet->setCellValue('F' . $numrow, $row->keterangan_izin);
           
            $sheet->getStyle('A' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('B' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('C' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('D' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('E' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('F' . $numrow)->applyFromArray($style_row);
           
            $no++;
            $numrow++;
        }

        $sheet->getColumnDimension('A')->setWidth(5);
        $sheet->getColumnDimension('B')->setWidth(25);
        $sheet->getColumnDimension('C')->setWidth(25);
        $sheet->getColumnDimension('D')->setWidth(20);
        $sheet->getColumnDimension('E')->setWidth(30);
        $sheet->getColumnDimension('F')->setWidth(30);
       
        $sheet->getDefaultRowDimension()->setRowHeight(-1);

        $sheet
            ->getPageSetup()
            ->setOrientation(
                \PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE
            );

        $sheet->setTitle('REKAP BULANAN');

        header(
            'Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
        );
        header('Content-Disposition: attachment; filename="REKAP BULANAN.xlsx"');
        header('Cache-Control: max-age=0');

        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
    } 

}
?>