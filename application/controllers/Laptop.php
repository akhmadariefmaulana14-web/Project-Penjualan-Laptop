<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Laptop extends CI_Controller
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

    public function merk_laptop()
    {
        $data['user_admin'] = $this->session->userdata('user_admin');
        $data['laptop'] = $this->Mcrud->get_all_data('merk')->result();
        $data['jf'] = 'Merk Laptop';

        $this->template->load('layout_admin', 'admin/table_merk', $data);
    }

    public function merk_add()
    {
        $nama_merk = $this->input->post('nama_merk');

        $data_add = ['nama_merk' => $nama_merk];
        $cek_data = $this->Mcrud->get_by_id('merk', $data_add);

        if ($nama_merk == null) {
            $this->session->set_flashdata('msg', 'Data Merk Belum Diinputkan !!');
        } else {
            if ($cek_data->num_rows() == 1) {
                $this->session->set_flashdata('msg', 'Data Merk Sudah Ada !!');
            } else {
                $this->session->set_flashdata('msg', 'Data Merk Berhasil Disimpan');
                $this->Mcrud->insert('merk', $data_add);
            }
        }
        redirect('laptop/merk_laptop');
    }

    public function merk_save_edit()
    {
        $id_merk = $this->input->post('id_merk');
        $nama_merk = $this->input->post('nama_merk');
        $data_update = ['nama_merk' => $nama_merk];
        $cek_merk = $this->Mcrud->cek_data('merk', 'nama_merk', $nama_merk, 'id_merk', $id_merk);

        if ($cek_merk->num_rows() != 1) {
            $this->session->set_flashdata('msg', 'Data Merk Berhasil di Edit');
            $this->Mcrud->update('merk', $data_update, 'id_merk', $id_merk);
        } else {
            $this->session->set_flashdata('msg', 'Data Merk Sudah Ada !!');
        }

        redirect('laptop/merk_laptop');
    }

    public function merk_delete($id)
    {
        $where = ['id_merk' => $id];
        $data = $this->Mcrud->get_by_id('laptop', $where);

        if ($data->num_rows() >= 1) {
            $this->session->set_flashdata('msg', 'Data Merk Gagal Dihapus');
        } else {
            $this->session->set_flashdata('msg', 'Data Merk Berhasil Dihapus');
            $this->Mcrud->del_data('merk', $where);
        }
        redirect('Laptop/merk_laptop');
    }

    public function jenis_laptop()
    {
        $data['user_admin'] = $this->session->userdata('user_admin');
        $data['laptop'] = $this->Mcrud->data_jenis_laptop()->result();
        $data['merk'] = $this->Mcrud->get_all_data('merk')->result();
        $data['jf'] = 'Tipe Laptop';

        $this->template->load('layout_admin', 'admin/table_laptop', $data);
    }

    public function jenis_laptop_add()
    {
        $id_merk = $this->input->post('id_merk');
        $jenis_laptop = $this->input->post('jenis_laptop');
        $desc_laptop = $this->input->post('desc_laptop');
        $harga_laptop = $this->input->post('harga_laptop');
        $stok = $this->input->post('stok');
        $img_laptop = $_FILES['img_laptop'];

        if ($_FILES['img_laptop']['name'] == null) {
            $img_laptop = ' ';
        } else {
            $config['upload_path'] = './assets/image_laptop/';
            $config['allowed_types'] = 'png';
            $config['max_size'] = 5000;
            $config['encrypt_name'] = true;

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('img_laptop')) {
                $error = $this->upload->display_errors();
                $this->session->set_flashdata('msg', 'Image Gagal di Upload: ' . $error);
                redirect('laptop/jenis_laptop');
            } else {
                $img_laptop = $this->upload->data('file_name');
            }
        }

        $data = [
            'id_merk' => $id_merk,
            'jenis_laptop' => $jenis_laptop,
            'img_laptop' => $img_laptop,
            'desc_laptop' => $desc_laptop,
            'harga_laptop' => $harga_laptop,
            'stok' => $stok,
        ];

        $this->session->set_flashdata('msg', 'Data Berhasil di Tambah');
        $this->Mcrud->insert('laptop', $data);
        redirect('laptop/jenis_laptop');
    }

    public function jenis_save_edit()
    {
        $id_laptop = $this->input->post('id_laptop');
        $id_merk = $this->input->post('id_merk');
        $jenis_laptop = $this->input->post('jenis_laptop');
        $desc_laptop = $this->input->post('desc_laptop');
        $harga_laptop = $this->input->post('harga_laptop');
        $stok = $this->input->post('stok');
        $img_laptop = $_FILES['img_laptop'];

        $image = $this->Mcrud->get_by_id('laptop', ['id_laptop' => $id_laptop])->row_object();

        if ($_FILES['img_laptop']['name'] == null) {
            $img_laptop = $image->img_laptop;
        } else {
            $old_img = $image->img_laptop;

            $config['upload_path'] = './assets/image_laptop';
            $config['allowed_types'] = 'png';
            $config['max_size'] = 5000;

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('img_laptop')) {
                $this->session->set_flashdata('msg', 'Image Gagal di Upload');
                redirect('laptop/jenis_laptop');
            } else {
                $target_file = './assets/image_laptop/' . $old_img;
                if (file_exists(FCPATH . $target_file)) {
                    unlink(FCPATH . $target_file);
                }

                $img_laptop = $this->upload->data('file_name');
            }
        }

        $data = [
            'id_merk' => $id_merk,
            'jenis_laptop' => $jenis_laptop,
            'img_laptop' => $img_laptop,
            'desc_laptop' => $desc_laptop,
            'harga_laptop' => $harga_laptop,
            'stok' => $stok,
        ];

        $this->session->set_flashdata('msg', 'Data Berhasil di Edit');
        $this->Mcrud->update('laptop', $data, 'id_laptop', $id_laptop);
        redirect('laptop/jenis_laptop');
    }

    public function delete_jenis_laptop($id)
    {
        $where = ['id_laptop' => $id];
        $image = $this->Mcrud->get_by_id('laptop', $where)->row_object();

        $this->session->set_flashdata('msg', 'Data Merk Berhasil Dihapus');
        $this->Mcrud->del_data('laptop', $where);
        $target_file = './assets/image_laptop/' . $image->img_laptop;
        if (file_exists(FCPATH . $target_file)) {
            unlink(FCPATH . $target_file);
        }
        redirect('Laptop/jenis_laptop');
    }
}
?>
