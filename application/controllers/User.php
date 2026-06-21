<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('template');
        $this->load->model('Transaksi_model');

        if (!$this->session->userdata('userName')) {
            redirect('auth');
        }
    }

    public function index()
    {
        $id_user = $this->session->userdata('id_user');
        if (!$id_user) {
            $nama_user = $this->session->userdata('userName');
            $query = $this->db->get_where('user', array('nama_user' => $nama_user));
            $user_data = $query->row();
            $id_user = $user_data ? $user_data->id_user : 0;
        }
        $data['transaksi'] = $this->db->get_where('transaksi', array('id_user' => $id_user))->result();
        $data['user'] = array('id_user' => $id_user, 'nama_user' => $this->session->userdata('userName'));
        $this->template->load('layout_user', 'user/v_riwayat', $data);
    }


    public function transaksi()
    {
        $id_user = $this->session->userdata('id_user');

        if (!$id_user) {
            $nama_user = $this->session->userdata('userName');
            $query = $this->db->get_where('user', array('nama_user' => $nama_user));
            $user_data = $query->row();
            $id_user = $user_data ? $user_data->id_user : 0;
        }


        $this->db->select('t.id_transaksi, t.tgl_transaksi, t.bukti_bayar, t.status, t.metode_pembayaran, dt.jumlah, u.nama_user, l.jenis_laptop, m.nama_merk');
        $this->db->from('transaksi t');
        $this->db->join('user u', 't.id_user = u.id_user');
        $this->db->join('detail_transaksi dt', 't.id_transaksi = dt.id_transaksi');
        $this->db->join('laptop l', 'dt.id_laptop = l.id_laptop');
        $this->db->join('merk m', 'l.id_merk = m.id_merk');
        $this->db->where('t.id_user', $id_user);

        $data['transaksi'] = $this->db->get()->result();
        $data['user'] = array('id_user' => $id_user, 'nama_user' => $this->session->userdata('userName'));
        $this->load->model('Payment_model'); 
        $data['banks'] = $this->Payment_model->get_active_banks(); 
        $data['qris']  = $this->Payment_model->get_active_qris();  

        $this->template->load('layout_user', 'user/transaksi', $data);
    }

    public function upload_bukti($id)
    {
        $id_user = $this->session->userdata('id_user');
        if (!$id_user) {
            $nama_user = $this->session->userdata('userName');
            $query = $this->db->get_where('user', array('nama_user' => $nama_user));
            $user_data = $query->row();
            $id_user = $user_data ? $user_data->id_user : 0;
        }

        $this->db->select('t.id_transaksi, t.tgl_transaksi, t.bukti_bayar, t.status, dt.jumlah, u.nama_user, l.jenis_laptop, m.nama_merk');
        $this->db->from('transaksi t');
        $this->db->join('user u', 't.id_user = u.id_user');
        $this->db->join('detail_transaksi dt', 't.id_transaksi = dt.id_transaksi');
        $this->db->join('laptop l', 'dt.id_laptop = l.id_laptop');
        $this->db->join('merk m', 'l.id_merk = m.id_merk');
        $this->db->where('t.id_transaksi', $id);
        $this->db->where('t.id_user', $id_user);

        $transaksi = $this->db->get()->row();
        if (!$transaksi) {
            show_404();
        }

        $data['user'] = array('id_user' => $id_user, 'nama_user' => $this->session->userdata('userName'));
        $data['transaksi'] = $transaksi;
        $data['jf'] = "Upload Bukti Pembayaran";
        $this->template->load('layout_user', 'user/upload_bukti', $data);
    }

    public function proses_upload_bukti($id)
    {
        $id_user = $this->session->userdata('id_user');
        if (!$id_user) {
            $nama_user = $this->session->userdata('userName');
            $query = $this->db->get_where('user', array('nama_user' => $nama_user));
            $user_data = $query->row();
            $id_user = $user_data ? $user_data->id_user : 0;
        }


        if (!is_dir('./assets/uploads/bukti/')) {
            mkdir('./assets/uploads/bukti/', 0777, true);
        }

        $config['upload_path'] = './assets/uploads/bukti/';
        $config['allowed_types'] = 'jpg|jpeg|png|gif';
        $config['max_size'] = 2048;
        $config['file_name'] = 'bukti_' . time() . '_' . $id;

        $this->load->library('upload', $config);

        if ($this->upload->do_upload('bukti')) {
            $upload_data = $this->upload->data();
            $nama_file = $upload_data['file_name'];
            $this->Transaksi_model->update_bukti($id, $nama_file);

            $this->session->set_flashdata('msg', 'Bukti pembayaran berhasil diupload!');
            redirect('user/transaksi');

        } else {
            $this->session->set_flashdata('error', $this->upload->display_errors());
            redirect('user/upload_bukti/' . $id);
        }
    }

    public function proses_bayar()
    {
        $id_transaksi = $this->input->post('id_transaksi');
        $metode = $this->input->post('metode_pembayaran');

        if (empty($id_transaksi)) {
            $this->session->set_flashdata('error', 'ID Transaksi tidak ditemukan.');
            redirect('user/transaksi');
        }

        $upload_path = './assets/uploads/bukti/';
        if (!is_dir($upload_path)) {
            mkdir($upload_path, 0777, true);
        }

        $config['upload_path'] = $upload_path;
        $config['allowed_types'] = 'jpg|jpeg|png';
        $config['max_size'] = 2048;
        $config['file_name'] = 'bukti_' . $id_transaksi . '_' . time();

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('bukti_bayar')) {
            $this->session->set_flashdata('error', 'Gagal upload: ' . $this->upload->display_errors('', ''));
            redirect('user/transaksi');
        }

        $data = array(
            'metode_pembayaran' => $metode,
            'bukti_bayar' => $this->upload->data('file_name'),
            'tgl_transaksi' => date('Y-m-d H:i:s')
        );

        $this->db->where('id_transaksi', $id_transaksi);
        $this->db->update('transaksi', $data);

        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('msg', 'Bukti pembayaran berhasil dikirim!');
        } else {
            $this->session->set_flashdata('error', 'File terupload tapi gagal simpan ke database.');
        }

        redirect('user/transaksi');
    }


    public function ajax_proses_upload_bukti($id)
    {
        $id_user = $this->session->userdata('id_user');
        if (!$id_user) {
            $nama_user = $this->session->userdata('userName');
            $query = $this->db->get_where('user', array('nama_user' => $nama_user));
            $user_data = $query->row();
            $id_user = $user_data ? $user_data->id_user : 0;
        }

        if (!is_dir('./assets/uploads/bukti/')) {
            mkdir('./assets/uploads/bukti/', 0777, true);
        }

        $config['upload_path'] = './assets/uploads/bukti/';
        $config['allowed_types'] = 'jpg|jpeg|png|gif';
        $config['max_size'] = 2048;
        $config['file_name'] = 'bukti_' . time() . '_' . $id;

        $this->load->library('upload', $config);

        if ($this->upload->do_upload('bukti')) {
            $upload_data = $this->upload->data();
            $nama_file = $upload_data['file_name'];
            $this->Transaksi_model->update_bukti($id, $nama_file);

            echo json_encode(['success' => true, 'filename' => $nama_file, 'message' => 'Bukti berhasil diupload!']);
            exit;

        } else {
            echo json_encode(['success' => false, 'error' => $this->upload->display_errors()]);
            exit;
        }
    }

 
    public function upload_bukti_modal()
    {
        $id_transaksi = $this->input->post('id_transaksi');
        $metode = $this->input->post('metode_pembayaran');

        if (empty($id_transaksi)) {
            echo json_encode(['status' => 'error', 'message' => 'ID Transaksi tidak valid']);
            return;
        }


        $id_user = $this->session->userdata('id_user');
        if (!$id_user) {
            $nama_user = $this->session->userdata('userName');
            $query = $this->db->get_where('user', array('nama_user' => $nama_user));
            $user_data = $query->row();
            $id_user = $user_data ? $user_data->id_user : 0;
        }

        $this->db->where('id_transaksi', $id_transaksi);
        $this->db->where('id_user', $id_user);
        $cek = $this->db->get('transaksi')->row();

        if (!$cek) {
            echo json_encode(['status' => 'error', 'message' => 'Transaksi tidak ditemukan atau bukan milik Anda']);
            return;
        }

        if (!is_dir('./assets/uploads/bukti/')) {
            mkdir('./assets/uploads/bukti/', 0777, true);
        }

        $config['upload_path'] = './assets/uploads/bukti/';
        $config['allowed_types'] = 'jpg|jpeg|png|gif';
        $config['max_size'] = 2048;
        $config['file_name'] = 'bukti_' . time() . '_' . $id_transaksi;

        $this->load->library('upload', $config);

        if ($this->upload->do_upload('bukti_bayar')) {
            $upload_data = $this->upload->data();
            $nama_file = $upload_data['file_name'];

            $data = [
                'bukti_bayar' => $nama_file,
                'metode_pembayaran' => $metode,
                'status' => 'Y'
            ];

            $this->db->where('id_transaksi', $id_transaksi);
            $this->db->where('id_user', $id_user);
            $update = $this->db->update('transaksi', $data);

            if ($update) {
                echo json_encode([
                    'status' => 'success',
                    'message' => 'Pembayaran berhasil diupload!'
                ]);
            } else {
                @unlink('./assets/uploads/bukti/' . $nama_file);
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Gagal menyimpan data ke database'
                ]);
            }
        } else {
            echo json_encode([
                'status' => 'error',
                'message' => $this->upload->display_errors('', ' ')
            ]);
        }
    }

    public function hapus_transaksi()
    {
        if ($this->input->method() !== 'post') {
            show_404();
        }

        $id = $this->input->post('id_hapus');
        if (empty($id) || !is_numeric($id)) {
            $this->session->set_flashdata('error', 'ID tidak valid');
            redirect('user/transaksi');
            return;
        }

        $id_user = $this->session->userdata('id_user');
        if (!$id_user) {
            $nama_user = $this->session->userdata('userName');
            $query = $this->db->get_where('user', array('nama_user' => $nama_user));
            $user_data = $query->row();
            $id_user = $user_data ? $user_data->id_user : 0;
        }

        $this->db->where('id_transaksi', $id);
        $this->db->where('id_user', $id_user);
        $transaksi = $this->db->get('transaksi')->row();

        if (!$transaksi) {
            $this->session->set_flashdata('error', 'Data tidak ditemukan atau Anda tidak punya akses.');
            redirect('user/transaksi');
            return;
        }

        if (!empty($transaksi->bukti_bayar)) {
            $file_path = './assets/uploads/bukti/' . $transaksi->bukti_bayar;
            if (file_exists($file_path)) {
                unlink($file_path);
            }
        }

        $this->db->delete('detail_transaksi', array('id_transaksi' => $id));
        $this->db->delete('transaksi', array('id_transaksi' => $id, 'id_user' => $id_user));
        $this->session->set_flashdata('msg', 'Data transaksi berhasil dihapus!');
        redirect('user/transaksi');
    }

    public function user_data()
    {
        $data['user'] = $this->Mcrud->get_all_data('user')->result();
        $data['user_admin'] = $this->session->userdata('user_admin');
        $data['jf'] = "Data User";

        $this->template->load('layout_admin', 'admin/table_user', $data);
    }

    public function dashboard()
    {
        $id_user = $this->session->userdata('id_user');

        if (!$id_user) {
            $nama_user = $this->session->userdata('userName');
            $query = $this->db->get_where('user', array('nama_user' => $nama_user));
            $user_data = $query->row();
            $id_user = $user_data ? $user_data->id_user : 0;
        }

        $total_query = $this->db->select_sum('dt.subtotal', 'total')
            ->from('detail_transaksi dt')
            ->join('transaksi t', 't.id_transaksi = dt.id_transaksi')
            ->where('t.id_user', $id_user)
            ->get();
        $total_result = $total_query->row();
        $total_penjualan = $total_result ? $total_result->total : 0;

        $laptop_query = $this->db->distinct()
            ->select('dt.id_laptop')
            ->from('detail_transaksi dt')
            ->join('transaksi t', 't.id_transaksi = dt.id_transaksi')
            ->where('t.id_user', $id_user)
            ->get();
        $laptop = $laptop_query->num_rows();

        $transaksi = $this->db->where('id_user', $id_user)
            ->count_all_results('transaksi');

        $data = array(
            'total_penjualan' => $total_penjualan,
            'laptop' => $laptop,
            'transaksi' => $transaksi
        );

        $this->template->load('layout_user', 'user/dashboard', $data);
    }

}