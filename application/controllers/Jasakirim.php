<?php
class Jasakirim extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Mcrud');
        $this->load->library('template');
        if (empty($this->session->userdata('user_admin'))) {
            redirect('login_admin');
        }
    }

    public function kota()
    {
        $data['kota'] = $this->Mcrud->get_all_data('kota')->result();
        $data['user_admin'] = $this->session->userdata('user_data');
        $data['jf'] = "Kota";

        $this->template->load('layout_admin', 'admin/jasakirim/kota', $data);
    }

    public function add_kota()
    {
        $nama_kota = $this->input->post('nama_kota');
        $data_kota = array('nama_kota' => $nama_kota);
        $cek_data = $this->Mcrud->get_by_id('kota', $data_kota);

        if ($nama_kota== NULL) {
            $this->session->set_flashdata('msg', 'Data Kota Belum Diinputkan');
            redirect('jasakirim/kota');
        }
        else {
            if ($cek_data->num_rows() == 1) {
                $this->session->set_flashdata('msg', 'Data Kota Sudah Ada');
                redirect('jasakirim/kota');
            }
            else{
                $this->session->set_flashdata('msg', 'Data Kota Berhasil Disimpan');
                $this->Mcrud->insert('kota', $data_kota);
                redirect('jasakirim/kota');
            }
        }
    }

    public function kota_save_edit()
    {
        $id = $this->input->post('id_kota');
        $nama_kota = $this->input->post('nama_kota');

        $data_update = array('nama_kota' => $nama_kota);
        $this->session->set_flashdata('msg', 'Data Kota Berhasil Diedit');
        $this->Mcrud->update('kota', $data_update, 'id_kota', $id);
        redirect('jasakirim/kota');
    }

    public function delete_kota($id)
    {
        $where = array('id_kota' => $id);
        $where_asal = array('id_kota_asal' => $id);
        $where_tujuan = array('id_kota_tujuan' => $id);

        $id_asal = $this->Mcrud->get_by_id('ongkir', $where_asal);
        $id_tujuan = $this->Mcrud->get_by_id('ongkir', $where_tujuan);

        if($id_asal->num_rows() >= 1 || $id_tujuan->num_rows() >= 1){
            $this->session->set_flashdata('msg', 'Data Kota Gagal Dihapus');
            redirect('jasakirim/kota');
        }
        else{
            $this->session->set_flashdata('msg', 'Data Kota Berhasil Dihapus');
            $this->Mcrud->del_data('kota', $where);
            redirect('jasakirim/kota');
        }
    }


    public function kurir()
    {
        $data['kurir'] = $this->Mcrud->get_all_data('kurir')->result();
        $data['user_admin'] = $this->session->userdata('user_admin');
        $data['jf'] = "Kurir";

        $this->template->load('layout_admin', 'admin/jasakirim/kurir', $data);
    }

    public function add_kurir()
    {
        $nama_kurir = $this->input->post('nama_kurir');
        $data_kurir = array('nama_kurir' => $nama_kurir);
        $cek_data = $this->Mcrud->get_by_id('kurir', $data_kurir);

        if($nama_kurir == NULL){
            $this->session->set_flashdata('msg', 'Data Kurir Belum Diinputkan');
        }
        else{
            if ($cek_data->num_rows() == 1) {
                $this->session->set_flashdata('msg', 'Data Kurir Sudah Ada');
            }
            else {
                $this->session->set_flashdata('msg', 'Data Kurir Berhasil Disimpan');
                $this->Mcrud->insert('kurir', $data_kurir);
            }
        }
        redirect('jasakirim/kurir');
    }

    public function kurir_save_edit()
    {
        $id = $this->input->post('id_kurir');
        $nama_kurir = $this->input->post('nama_kurir');

        $data_update = array('nama_kurir' => $nama_kurir);
        $this->session->set_flashdata('msg', 'Data Kurir Berhasil Diedit');
        $this->Mcrud->update('kurir', $data_update, 'id_kurir', $id);
        redirect('jasakirim/kurir');
    }

    public function delete_kurir($id)
    {
        $where = array('id_kurir' => $id);
        $data = $this->Mcrud->get_by_id('ongkir', $where);

        if ($data->num_rows() >= 1) {
            $this->session->set_flashdata('msg', 'Data Kurir Gagal Dihapus');
        } else {
            $this->session->set_flashdata('msg', 'Data Kurir Berhasil Dihapus');
            $this->Mcrud->del_data('kurir', $where);           
        }
        redirect('jasakirim/kurir');
    }


    public function ongkir()
    {
        $data['kurir'] = $this->Mcrud->get_all_data('kurir')->result();
        $data['kota'] = $this->Mcrud->get_all_data('kota')->result();
        $data['ongkir'] = $this->Mcrud->ongkir()->result();
        $data['user_admin'] = $this->session->userdata('user_admin');
        $data['jf'] = "Ongkir";

        $this->template->load('layout_admin', 'admin/jasakirim/ongkir', $data);
    }

    public function add_ongkir()
    {
        $id_kurir = $this->input->post('id_kurir');
        $kota_asal = $this->input->post('id_kota_asal');
        $kota_tujuan = $this->input->post('id_kota_tujuan');
        $biaya = $this->input->post('biaya');

        $data = array(
            'id_kurir' => $id_kurir,
            'id_kota_asal' => $kota_asal,
            'id_kota_tujuan' => $kota_tujuan,
            'biaya' => $biaya
        );
            
        $cek_data_kurir = $this->Mcrud->get_by_id('ongkir', array('id_kurir' => $id_kurir));
        $cek_data_asal = $this->Mcrud->get_by_id('ongkir', array('id_kota_asal' => $kota_asal));
        $cek_data_tujuan = $this->Mcrud->get_by_id('ongkir', array('id_kota_tujuan' => $kota_tujuan)); 

        if($cek_data_kurir->num_rows() == 1){
            $this->session->set_flashdata('msg', 'Data Kurir Sudah Ada');
        }
        else if($cek_data_asal->num_rows() == 1){
            $this->session->set_flashdata('msg', 'Data Kota Asal Sudah Ada');
        }
        else if($cek_data_tujuan->num_rows() == 1){
            $this->session->set_flashdata('msg', 'Data Kota Tujuan Sudah Ada');
        }
        else{
            if ($kota_asal == $kota_tujuan) {
                $this->session->set_flashdata('msg', 'Kota Asal dan Kota Tujuan Tidak Boleh Sama');
            }
            else{
                if ($biaya == NULL) {
                    $this->session->set_flashdata('msg', 'Data Biaya Belum Diinputkan');
                }
                else {
                    $this->session->set_flashdata('msg', 'Data Ongkos Kirim Berhasil Disimpan');
                    $this->Mcrud->insert('ongkir', $data);
                }
            }
        }
        redirect('jasakirim/ongkir');
    }

    public function ongkir_save_edit()
    {
        $id = $this->input->post('id_ongkir');
        $id_kurir = $this->input->post('id_kurir');
        $kota_asal = $this->input->post('id_kota_asal');
        $kota_tujuan = $this->input->post('id_kota_tujuan');
        $biaya = $this->input->post('biaya');

        $data = array(
            'id_ongkir' => $id,
            'id_kurir' => $id_kurir,
            'id_kota_asal' => $kota_asal,
            'id_kota_tujuan' => $kota_tujuan,
            'biaya' => $biaya
        );

        $cek_data_kurir = $this->Mcrud->cek_data('ongkir', 'id_kurir', $id_kurir, 'id_ongkir', $id);
        $cek_data_asal = $this->Mcrud->cek_data('ongkir', 'id_kota_asal', $kota_asal, 'id_ongkir', $id);
        $cek_data_tujuan = $this->Mcrud->cek_data('ongkir', 'id_kota_tujuan', $kota_tujuan, 'id_ongkir', $id);

        if ($cek_data_kurir->num_rows() == 1) {
            $this->session->set_flashdata('msg', 'Data Kurir Sudah Ada');
        } else if ($cek_data_asal->num_rows() == 1) {
            $this->session->set_flashdata('msg', 'Data Kota Asal Sudah Ada');
        } else if ($cek_data_tujuan->num_rows() == 1) {
            $this->session->set_flashdata('msg', 'Data Kota Tujuan Sudah Ada');
        } else {
            if ($kota_asal == $kota_tujuan) {
                $this->session->set_flashdata('msg', 'Kota Asal dan Kota Tujuan Tidak Boleh Sama');
            } else {
                if ($biaya == NULL) {
                    $this->session->set_flashdata('msg', 'Data Biaya Belum Diinputkan');
                } else {
                    $this->session->set_flashdata('msg', 'Data Biaya Berhasil Diedit');
                    $this->Mcrud->update('ongkir', $data, 'id_ongkir', $id);                  
                }
            }
        }
        redirect('jasakirim/ongkir');
    }

    public function delete_ongkir($id)
    {
        $where = array('id_ongkir' => $id);
        $this->session->set_flashdata('msg', 'Data Biaya Berhasil Dihapus');
        $this->Mcrud->del_data('ongkir', $where);
        redirect('jasakirim/ongkir');
    }
}
