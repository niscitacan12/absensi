<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class M_model extends CI_Model
{
    public function __construct() {
        parent::__construct();
    }

    public function get_data($table){
        return $this->db->get($table);
    }

    public function getKaryawan() {
        $query = $this->db->get('user');
        return $query->result();
    }

    public function getAbsensi()
    {
        // Mengambil data absensi dari tabel 'absensi'
        $query = $this->db->get('absensi');

        // Mengembalikan hasil query dalam bentuk array
        return $query->result_array();
    }

    function getwhere($table, $data)
    {
        return $this->db->get_where($table, $data);
    }

    public function delete($table, $field, $id) 
    { 
        $data=$this->db->delete($table, array($field => $id)); 
        return $data; 
    }

    public function tambah_data($table, $data)
    {
      $this->db->insert($table, $data);
      return $this->db->insert_id();
    }

    public function cek_absen($id_karyawan, $tanggal) {
        $this->db->where('id_karyawan', $id_karyawan);
        $this->db->where('date', $tanggal);
        $query = $this->db->get('absensi');
    
        if ($query->num_rows() > 0) {
            return true; // Jika sudah ada entri absen untuk karyawan dan tanggal tertentu
        } else {
            return false; // Jika belum ada entri absen untuk karyawan dan tanggal tertentu
        }
    }

    public function cek_izin($id_karyawan, $tanggal) {
        $this->db->where('id_karyawan', $id_karyawan);
        $this->db->where('date', $tanggal);
        $this->db->where('status', 'true'); // Hanya mencari entri dengan status izin
        $query = $this->db->get('absensi');

        if ($query->num_rows() > 0) {
            return true; // Jika sudah ada entri izin untuk karyawan dan tanggal tertentu
        } else {
            return false; // Jika belum ada entri izin untuk karyawan dan tanggal tertentu
        }
    }
    
    
    public function get_by_id($table, $id_column, $id)
    {
        $data = $this->db->where($id_column, $id)->get($table);
        return $data;
    }
    public function ubah_data($table, $data, $where)
    {
        $data = $this->db->update($table, $data, $where);
        return $this->db->affected_rows();
    }

    public function register_user($data) { 
        // Masukkan data ke dalam tabel 'users' dan kembalikan hasilnya 
        return $this->db->insert('users', $data); 
    }

    public function checkAbsensiExists($absen, $tanggal)
    {
        $this->db->select('id_karyawan');
        $this->db->from('absensi');
        $this->db->where('id_karyawan', $absen);
        $this->db->where('DATE(date)', $tanggal);

        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return true;
        }
        return false;
    }

    public function ubah_karyawan($id, $data) {
        // Gantilah ini dengan logika yang sesuai untuk mengubah data karyawan
        // Anda dapat menggunakan perintah SQL untuk mengupdate data dalam database
        $this->db->where('id', $id);
        return $this->db->update('tabel_karyawan', $data);
    }

    public function updateStatusPulang($id) {
        date_default_timezone_set('Asia/Jakarta');
        $data = array(
            'jam_pulang' => date('H:i:s'),
            'status' => 'true'
        );
    }

    public function update_image($user_id, $new_image) {
        $data = array(
            'image' => $new_image
        );

        $this->db->where('id', $user_id); // Sesuaikan dengan kolom dan nama tabel yang sesuai
        $this->db->update('user', $data); // Sesuaikan dengan nama tabel Anda

        return $this->db->affected_rows(); // Mengembalikan jumlah baris yang diupdate
    }
    public function get_current_image($user_id) {
        $this->db->select('image');
        $this->db->from('user'); // Gantilah 'user_table' dengan nama tabel Anda
        $this->db->where('id', $user_id);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            $row = $query->row();
            return $row->image;
        }

        return null; // Kembalikan null jika data tidak ditemukan
    }

    public function getAbsenById($id_karyawan) {
        return $this->db->get_where('absensi', ['id_karyawan' => $id_karyawan])->row();
    }

    public function setAbsensiPulang($absen_id) { 
        // Fungsi ini digunakan untuk mengisi jam pulang dan mengubah status menjadi "pulang". 
        $data = array( 
            'jam_pulang' => date('H:i:s'), 
            'status' => 'pulang' 
        ); 
 
        // Ubah data absensi berdasarkan absen_id. 
        $this->db->where('id', $absen_id); 
        $this->db->update('absensi', $data); 
    }

    public function update_data($table, $data, $where) {
        $this->db->update($table, $data, $where);
        return $this->db->affected_rows();
    }

    public function getDataKaryawan() {
        // Gantilah 'histori_karyawan' dengan nama tabel histori karyawan Anda.
        $this->db->select('*');
        $this->db->from('user');
        $this->db->where('role', 'karyawan');
        $query = $this->db->get();

        // Kembalikan data dalam bentuk array.
        return $query->result();
    }
    
    // untuk update profil
    public function updateProfile($userId, $data)
    {
        // Perbarui data profil pengguna berdasarkan ID
        $this->db->where('id', $userId);
        $this->db->update('user', $data);

        // Mengembalikan true jika pembaruan berhasil, sebaliknya false
        return $this->db->affected_rows() > 0;
    }

    public function get_absensi()
    {
        // Gantilah bagian ini dengan logika pengambilan data absensi sesuai dengan struktur database Anda.
        // Misalnya, Anda dapat mengambil data absensi dari tabel 'absensi' dalam database.
        // Berikut hanya contoh sederhana, Anda perlu sesuaikan dengan struktur dan tabel yang sebenarnya.
        $query = $this->db->get('absensi');
        return $query->result_array();
    }

    public function getAbsensiLast7Days() {
        $this->load->database();
        $end_date = date('Y-m-d');
        $start_date = date('Y-m-d', strtotime('-7 days', strtotime($end_date)));        
        $query = $this->db->select('date, kegiatan, jam_masuk, jam_pulang, keterangan_izin, status, COUNT(*) AS total_absences')
                          ->from('absensi')
                          ->where('date >=', $start_date)
                          ->where('date <=', $end_date)
                          ->group_by('date, kegiatan, jam_masuk, jam_pulang, keterangan_izin, status')
                          ->get();
        return $query->result_array();
    }

    public function getRekapBulanan($bulan)
    {
        $this->db->select('MONTH(date) as bulan, COUNT(*) as total_absensi'); // Tambahkan "as" setelah "MONTH(date)"
        $this->db->from('absensi');
        $this->db->where('MONTH(date)', $bulan);
        $this->db->group_by('bulan');
        $query = $this->db->get();
        return $query->result_array();
    }
    
  public function getPerHari($tanggal)
        {
            $this->db->select('absensi.id, absensi.date, absensi.kegiatan, absensi.id_karyawan, absensi.jam_masuk, absensi.jam_pulang, absensi.keterangan_izin');
            $this->db->from('absensi');
            $this->db->where('absensi.date', $tanggal); // Menyaring data berdasarkan tanggal
            $query = $this->db->get();
            return $query->result_array();
        }

        public function getRekapPerMinggu($start_date, $end_date) {
            $this->db->select('*');
            $this->db->from('absensi');
            $this->db->where('date >=', $start_date);
            $this->db->where('date <=', $end_date);
            $query = $this->db->get();
            return $query->result();
        }

        public function get_data_perhari() {
            // Gantilah kode ini dengan logika untuk mengambil data perhari dari database
            $this->db->select('*');
            $this->db->from('absensi');
            $query = $this->db->get();
            
            if ($query->num_rows() > 0) {
                return $query->result_array();
            } else {
                return array(); // Mengembalikan array kosong jika tidak ada data
            }
        }
}
?>