<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('Mcrud');
        $this->load->model('Transaksi_model');
        $this->load->library('template');
        
        if (empty($this->session->userdata('user_admin'))) {
            redirect('Login_admin');
        }
    }

    public function index()
    {
        $data['user_admin'] = $this->session->userdata('user_admin');
        $data['transaksi'] = $this->Mcrud->get_all_data('transaksi')->num_rows();
        $data['laptop'] = $this->Mcrud->get_all_data('laptop')->num_rows();
        $data['user'] = $this->Mcrud->get_all_data('user')->num_rows();
        $data['total_penjualan'] = $this->Mcrud->get_all_data('detail_transaksi')->result();
        $data['jf'] = "Dashboard Admin";

        $this->template->load('layout_admin', 'admin/dashboard', $data);
    }

    public function transaksi()
    {
        $data['user_admin'] = $this->session->userdata('user_admin');
        $data['transaksi'] = $this->Transaksi_model->get_all_transaksi();
        $data['jf'] = "Data Transaksi";
        $this->template->load('layout_admin', 'admin/table_transaksi', $data);
    }

    public function user_data()
    {
        $data['user'] = $this->Mcrud->get_all_data('user')->result();
        $data['user_admin'] = $this->session->userdata('user_admin');
        $data['jf'] = "Data User";

        $this->template->load('layout_admin', 'admin/table_user', $data);
    }

  public function hapus_transaksi() {
    if ($this->input->method() !== 'post') {
        show_404();
    }

    $id = $this->input->post('id_hapus');

    if (empty($id) || !is_numeric($id)) {
        $this->session->set_flashdata('error', 'ID transaksi tidak valid!');
        redirect('admin/transaksi');
        return;
    }

    $this->db->where('id_transaksi', $id);
    $transaksi = $this->db->get('transaksi')->row();

    if (!$transaksi) {
        $this->session->set_flashdata('error', 'Data transaksi tidak ditemukan!');
        redirect('admin/transaksi');
        return;
    }

    if (!empty($transaksi->bukti_bayar)) {
        $file_path = './assets/uploads/bukti/' . $transaksi->bukti_bayar;
        if (file_exists($file_path)) {
            unlink($file_path);
        }
    }

    $this->db->delete('detail_transaksi', array('id_transaksi' => $id));
    $this->db->delete('transaksi', array('id_transaksi' => $id));
    $this->session->set_flashdata('msg', 'Data transaksi berhasil dihapus!');
    redirect('admin/transaksi');
}

}