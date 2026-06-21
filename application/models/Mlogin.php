<?php
class Mlogin extends CI_Model
{
    public function login($tabel, $user){
        return $this->db->get_where($tabel, $user);
    }
}
?>
