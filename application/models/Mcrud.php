<?php
class Mcrud extends CI_Model
{
    public function get_all_data($tabel)
    {
        return $this->db->get($tabel);
    }

    public function insert($tabel, $data)
    {
        $this->db->insert($tabel, $data);
    }

    public function get_by_id($tabel, $id)
    {
        return $this->db->get_where($tabel, $id);
    }

    public function update($tabel, $data, $pk, $id)
    {
        $this->db->where($pk, $id);
        $this->db->update($tabel, $data);
    }

    public function cek_data($tabel, $field1, $data1, $field2, $data2)
    {
        return $this->db->query('SELECT * FROM ' . $tabel . ' WHERE ' . $field1 . " = '" . $data1 . "' AND " . $field2 . ' != ' . $data2);
    }

    public function cek_data_wishlist($id_laptop, $id_user)
    {
        $this->db->where($id_laptop);
        $this->db->where($id_user);
        return $this->db->get('wishlist');
    }

    public function get_wishlist($id_user)
    {
        $this->db->select('*');
        $this->db->from('wishlist');
        $this->db->join('laptop', 'laptop.id_laptop=wishlist.id_laptop');
        $this->db->where($id_user);
        return $this->db->get();
    }

    public function delete_wishlist($id_laptop, $id_user)
    {
        $this->db->where($id_laptop);
        $this->db->where($id_user);
        $this->db->delete('wishlist');
    }

    public function find($id)
    {
        $result = $this->db->where('id_laptop', $id)->limit(1)->get('laptop');
        if ($result->num_rows() > 0) {
            return $result->row();
        } else {
            return [];
        }
    }

    public function new_id_transaksi()
    {
        return $this->db->query('SELECT * FROM transaksi ORDER BY id_transaksi DESC LIMIT 1');
    }

    public function data_jenis_laptop()
    {
        $this->db->select('*');
        $this->db->from('laptop');
        $this->db->join('merk', 'laptop.id_merk=merk.id_merk');
        return $this->db->get();
    }

    public function get_detail_laptop($id)
    {
        $this->db->select('laptop.*, merk.nama_merk');
        $this->db->from('laptop');
        $this->db->join('merk', 'merk.id_merk = laptop.id_merk');
        $this->db->where('laptop.id_laptop', $id);

        $query = $this->db->get();
        return $query->num_rows() > 0 ? $query->row() : null;
    }

    public function data_traksaksi()
    {
        $this->db->select('*');
        $this->db->from('transaksi');
        $this->db->join('user', 'user.id_user=transaksi.id_user');
        $this->db->join('detail_transaksi', 'transaksi.id_transaksi=detail_transaksi.id_transaksi');
        $this->db->join('laptop', 'detail_transaksi.id_laptop=laptop.id_laptop');
        $this->db->join('merk', 'laptop.id_merk=merk.id_merk');
        return $this->db->get();
    }

    public function ongkir()
    {
        $this->db->select('id_ongkir, ongkir.id_kurir, id_kota_asal, id_kota_tujuan, nama_kurir, a.nama_kota AS kota_asal, t.nama_kota AS kota_tujuan, biaya');
        $this->db->from('ongkir');
        $this->db->join('kurir', 'ongkir.id_kurir=kurir.id_kurir');
        $this->db->join('kota a', 'a.id_kota=id_kota_asal');
        $this->db->join('kota t', 't.id_kota=id_kota_tujuan');
        return $this->db->get();
    }

    public function del_data($tabel, $id)
    {
        $this->db->where($id);
        $this->db->delete($tabel);
    }

    public function cek_coupon($id_user, $id_coupon)
    {
        $this->db->select('*');
        $this->db->from('transaksi');
        $this->db->join('detail_transaksi', 'transaksi.id_transaksi=detail_transaksi.id_transaksi');
        $this->db->where('id_user', $id_user);
        $this->db->where('id_promo', $id_coupon);
        return $this->db->get();
    }
}
?>
