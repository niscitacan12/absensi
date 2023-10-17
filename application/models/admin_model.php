<?php
class admin_model extends CI_Model
{
    public function getRekapBulanan($bulan) {
        $this->db->select('MONTH(tanggal) as bulan, COUNT(*) as total_absensi');
        $this->db->from('absensi');
        $this->db->where('MONTH(tanggal)', $bulan); // Menyaring data berdasarkan bulan
        $this->db->group_by('bulan');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getRekapHarian($tanggal) {
        $this->db->where('date', $tanggal);
        return $this->db->get('absensi')->result_array();
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
}
?>