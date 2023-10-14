<?php

class M_model extends CI_Model
{
    function get_data($table)
    {
        return $this->db->get($table);
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

    public function checkAbsensiExists($absensi, $tanggal) {
        // Logika untuk memeriksa apakah data absensi ada dalam database
       $this->db->select('id_karyawan');
       $this->db->from('absensi');
       $this->db->where('id_karyawan', $absensi);
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

    // public function getAbsenByKaryawan($id_karyawan) {
    //     return $this->db->get_where('absensi', ['id_karyawan' => $id_karyawan])->row();
    // }

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
}
?>