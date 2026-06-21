<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Payment extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->model('Payment_model');
        $this->load->library('template');
        $this->load->library('form_validation'); // Form validation
        
        if (empty($this->session->userdata('user_admin'))) {
            redirect('login_admin');
        }
    }

    public function index()
    {
        $data['jf'] = 'Metode Pembayaran'; 
        $data['user_admin'] = $this->session->userdata('user_admin'); 

        $data['payments'] = $this->Payment_model->get_all();
        $data['success']  = $this->session->flashdata('success');
        $data['error']    = $this->session->flashdata('error');

        $data['contents'] = $this->load->view('admin/payment', $data, TRUE);
        $this->load->view('layout_admin', $data);
    }

    public function update_bank($id)
    {
        $this->form_validation->set_rules('bank_name', 'Nama Bank', 'required|trim');
        $this->form_validation->set_rules('account_number', 'Nomor Rekening', 'required|trim');
        $this->form_validation->set_rules('account_holder', 'Atas Nama', 'required|trim');
        $this->form_validation->set_message('required', '%s wajib diisi.');

        if ($this->form_validation->run() === FALSE) {
            $this->session->set_flashdata('error', validation_errors());
            redirect('admin/payment');
        }

        $data = [
            'bank_name'      => $this->input->post('bank_name'),
            'account_number' => $this->input->post('account_number'),
            'account_holder' => $this->input->post('account_holder'),
        ];

        $this->Payment_model->update($id, $data);
        $this->session->set_flashdata('success', 'Rekening berhasil diperbarui.');
        redirect('admin/payment');
    }


    public function update_qris($id)
    {
        if (empty($_FILES['qris_image']['name'])) {
            $this->session->set_flashdata('error', 'Pilih gambar QRIS terlebih dahulu.');
            redirect('admin/payment');
        }

        $upload_path = FCPATH . 'uploads/qris/';


        if (!is_dir($upload_path)) {
            mkdir($upload_path, 0777, TRUE);
        }

        $config = [
            'upload_path'       => $upload_path,
            'allowed_types'     => 'jpg|jpeg|png|gif|webp',
            'max_size'          => 2048, // 2MB
            'file_ext_tolower'  => TRUE,
            'encrypt_name'      => TRUE,
        ];

        $this->load->library('upload');
        $this->upload->initialize($config);

        if (!$this->upload->do_upload('qris_image')) {
            $this->session->set_flashdata('error', 'Gagal upload: ' . $this->upload->display_errors('', ''));
            redirect('admin/payment');
        }

        $upload_data = $this->upload->data();

        $old = $this->Payment_model->get_by_id($id);
        if ($old && $old->qris_image) {
            $old_path = $upload_path . $old->qris_image;
            if (file_exists($old_path)) {
                unlink($old_path);
            }
        }

        $this->Payment_model->update($id, ['qris_image' => $upload_data['file_name']]);
        $this->session->set_flashdata('success', 'Gambar QRIS berhasil diperbarui.');
        redirect('admin/payment');
    }

    public function remove_qris($id)
    {
        $item = $this->Payment_model->get_by_id($id);
        if ($item && $item->qris_image) {
            $path = FCPATH . 'uploads/qris/' . $item->qris_image;
            if (file_exists($path)) {
                unlink($path);
            }
            $this->Payment_model->update($id, ['qris_image' => NULL]);
            $this->session->set_flashdata('success', 'Gambar QRIS berhasil dihapus.');
        } else {
            $this->session->set_flashdata('error', 'Tidak ada gambar untuk dihapus.');
        }
        redirect('admin/payment');
    }

    public function toggle_status($id)
    {
        $this->Payment_model->toggle_status($id);
        $this->session->set_flashdata('success', 'Status berhasil diubah.');
        redirect('admin/payment');
    }
}