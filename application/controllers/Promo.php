<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Promo extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->model('Mcrud');
        $this->load->library('template');
        if (empty($this->session->userdata('user_admin'))) {
            redirect('login_admin');
        }
    }

    public function index() {
        $data['user_admin'] = $this->session->userdata('user_admin');
        $data['promo'] = $this->Mcrud->get_all_data('promo')->result();
        $data['jf'] = "Promo";

        $this->template->load('layout_admin', 'admin/table_promo', $data);
    }

    public function add_promo()
    {
        $kode_promo = $this->input->post('kode_promo');
        $nilai = $this->input->post('nilai');

        $data_add = array(
            'kode_promo' => $kode_promo,
            'nilai' => $nilai
        );
        $cek_data = $this->Mcrud->get_by_id('promo', array('kode_promo' => $kode_promo));

        if ($kode_promo == NULL) {
            $this->session->set_flashdata('msg', 'Data Promo Belum Diinputkan !!');
        } else {
            if ($cek_data->num_rows() == 1) {
                $this->session->set_flashdata('msg', 'Data Promo Sudah Ada !!');
            } else {
                $this->session->set_flashdata('msg', 'Data Promo Berhasil Disimpan');
                $this->Mcrud->insert('promo', $data_add);
            }
        }
        redirect('promo');
    }

    public function edit_promo()
    {
        $id_promo = $this->input->post('id_promo');
        $kode_promo = $this->input->post('kode_promo');
        $nilai = $this->input->post('nilai');

        $data_update = array(
            'kode_promo' => $kode_promo,
            'nilai' => $nilai
        );
        $cek_promo = $this->Mcrud->cek_data('promo', 'kode_promo', $kode_promo, 'id_promo', $id_promo);

        if ($cek_promo->num_rows() != 1) {
            $this->session->set_flashdata('msg', 'Data Promo Berhasil di Edit');
            $this->Mcrud->update('promo', $data_update, 'id_promo', $id_promo);
        } else {
            $this->session->set_flashdata('msg', 'Data Promo Sudah Ada !!');
        }

        redirect('promo');
    }
}
?>
