<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaksi_model extends CI_Model {

    public function get_all_transaksi() {
        $this->db->select('
            t.id_transaksi, 
            t.tgl_transaksi,
            t.status, 
            t.bukti_bayar, 
            d.jumlah, 
            u.nama_user, 
            u.no_hp,
            m.nama_merk, 
            l.jenis_laptop
        ');
        $this->db->from('transaksi t');
        $this->db->join('user u', 'u.id_user = t.id_user', 'left');
        $this->db->join('detail_transaksi d', 't.id_transaksi = d.id_transaksi', 'left');
        $this->db->join('laptop l', 'l.id_laptop = d.id_laptop', 'left');
        $this->db->join('merk m', 'm.id_merk = l.id_merk', 'left');

        $this->db->order_by('t.id_transaksi', 'DESC');

        return $this->db->get()->result();
    }

    public function get_all_transaksi_by_user($id_user) {
        $this->db->select('
            t.id_transaksi, 
            t.tgl_transaksi,
            t.status, 
            t.bukti_bayar, 
            d.jumlah, 
            u.nama_user, 
            u.no_hp,
            m.nama_merk, 
            l.jenis_laptop
        ');
        $this->db->from('transaksi t');
        $this->db->join('user u', 'u.id_user = t.id_user', 'left');
        $this->db->join('detail_transaksi d', 't.id_transaksi = d.id_transaksi', 'left');
        $this->db->join('laptop l', 'l.id_laptop = d.id_laptop', 'left');
        $this->db->join('merk m', 'm.id_merk = l.id_merk', 'left');
        $this->db->where('t.id_user', $id_user);

        $this->db->order_by('t.id_transaksi', 'DESC');

        return $this->db->get()->result();
    }

    public function get_by_id($id) {
        $this->db->select('
            t.id_transaksi, 
            t.tgl_transaksi, 
            t.status, 
            t.bukti_bayar, 
            d.jumlah, 
            u.nama_user, 
            u.no_hp,
            m.nama_merk, 
            l.jenis_laptop
        ');
        $this->db->from('transaksi t');
        $this->db->join('user u', 'u.id_user = t.id_user', 'left');
        $this->db->join('detail_transaksi d', 't.id_transaksi = d.id_transaksi', 'left');
        $this->db->join('laptop l', 'l.id_laptop = d.id_laptop', 'left');
        $this->db->join('merk m', 'm.id_merk = l.id_merk', 'left');
        $this->db->where('t.id_transaksi', $id);

        return $this->db->get()->row();
    }

    public function update_bukti($id, $nama_file) {
        $this->db->where('id_transaksi', $id);
        $this->db->update('transaksi', [
            'bukti_bayar' => $nama_file
        ]);
    }
}