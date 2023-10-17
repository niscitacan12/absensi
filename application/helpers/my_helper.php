<?php
 function tampil_full_nama_byid($id)
 {
    $ci =& get_instance();
    $ci->load->database();
    $result = $ci->db->where('id', $id)->get('user');
     foreach ($result->result() as $c) {
        $stmt= $c->username;
        return $stmt;
     }
 }
?>