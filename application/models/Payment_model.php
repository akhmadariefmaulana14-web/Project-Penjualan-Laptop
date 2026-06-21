<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Payment_model extends CI_Model
{

    protected $table = 'tb_payment_settings';

    public function get_all()
    {
        return $this->db->order_by('id', 'ASC')->get($this->table)->result();
    }

    public function get_by_id($id)
    {
        return $this->db->get_where($this->table, ['id' => $id])->row();
    }

    public function get_active_banks()
    {
        return $this->db->where('payment_type', 'bank_transfer')
            ->where('is_active', 1)
            ->order_by('id', 'ASC')
            ->get($this->table)
            ->result();
    }

    public function get_active_qris()
    {
        return $this->db->where('payment_type', 'qris')
            ->where('is_active', 1)
            ->where('qris_image IS NOT NULL')
            ->get($this->table)
            ->row();
    }

    public function update($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update($this->table, $data);
    }

    public function toggle_status($id)
    {
        $item = $this->get_by_id($id);
        if ($item) {
            return $this->update($id, ['is_active' => $item->is_active ? 0 : 1]);
        }
        return false;
    }
}