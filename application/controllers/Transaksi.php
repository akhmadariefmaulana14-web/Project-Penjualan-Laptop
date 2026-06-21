<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaksi extends CI_Controller {
    function __construct()
    {
        parent::__construct();
        $this->load->model('Mcrud');
        $this->load->library('template');
        $this->load->model('Payment_model');
    }

    public function index() {
        $data['user_admin'] = $this->session->userdata('user_admin');
        $data['jf'] = "Transaksi";
        $data['transaksi'] = $this->Mcrud->data_traksaksi()->result();
        $data['banks'] = $this->Payment_model->get_active_banks();
        $data['qris']  = $this->Payment_model->get_active_qris();

        $this->template->load('layout_user', 'user/transaksi', $data);
    }

    public function status_transaksi($id_transaksi)
    {
        $transaksi = $this->db->get_where('transaksi', ['id_transaksi' => $id_transaksi])->row();
        if ($transaksi->status == 'Y') {
            $status_baru = 'N';
        } else {
            $status_baru = 'Y';
        }
        $this->db->where('id_transaksi', $id_transaksi);
        $this->db->update('transaksi', array('status' => $status_baru));
        redirect('transaksi');
    }

    public function insert_transaksi() {
        $id_user = array('username' => $this->session->userdata('userName'));
        $data_user = $this->Mcrud->get_by_id('user', $id_user)->row_object();
        $id_transaksi = $this->Mcrud->new_id_transaksi()->row_object();
        $new_id_transaksi = 1 + $id_transaksi->id_transaksi;

        $data_transaksi = array(
            'id_transaksi' => $new_id_transaksi,
            'id_user' => $data_user->id_user,
            'tgl_transaksi' => date("Y-m-d"),
        );

        $this->Mcrud->insert('transaksi', $data_transaksi);

        foreach ($this->cart->contents() as $items) {
            $data_detail_transaksi = array(
                'id_transaksi' => $new_id_transaksi,
                'id_laptop' => $items["id"],
                'jumlah' => $items["qty"],
                'subtotal' => $items["subtotal"],
                'id_promo' => $this->session->tempdata('id_coupon')
            );
            $this->Mcrud->insert('detail_transaksi', $data_detail_transaksi);
        }

        $this->cart->destroy();
        $this->session->set_flashdata('alert-success', 'Pesanan Anda Sedang Di Proses');
        redirect('frontend');
    }

    public function cetak_pdf() {
        $data['transaksi'] = $this->Mcrud->data_traksaksi()->result();
        $this->load->view('admin/table_cetak', $data);
    }
}