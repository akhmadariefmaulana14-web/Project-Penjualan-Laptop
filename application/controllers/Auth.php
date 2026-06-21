<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Mcrud');
        $this->load->model('Mlogin');
        $this->load->library('Template');
    }

    public function index()
    {
        $data['jf'] = 'Login User';

        $this->template->load('layout_frontend', 'auth/login', $data);
    }

    private function hash_password($password)
    {
        return password_hash($password, PASSWORD_DEFAULT);
    }

    public function login_action()
    {
        $u = $this->input->post('username');
        $p = $this->input->post('password');
        $where = ['username' => $u, 'status_user' => 'Y'];

        $cek = $this->Mlogin->login('user', $where);
        $Pass = $cek->row();
        if ($cek->num_rows() == 1 && password_verify($p, $Pass->password_user) == true) {
            $data_session = [
                'userName' => $u,
                'status' => 'login',
                'logged_in' => true,
                'id_user' => $Pass->id_user
            ];
            $this->session->set_userdata($data_session);
            redirect('user/dashboard');
        } else {
            $this->session->set_flashdata('msg', 'Username atau Password Salah atau User di Nonaktifkan');
            redirect('Auth');
        }
    }

    public function logout()
    {
        $this->session->unset_userdata('userName');
        redirect('frontend');
    }

    public function register()
    {
        $data['jf'] = 'Daftar User';

        $this->template->load('layout_frontend', 'auth/register', $data);
    }

    public function register_action()
    {
        $nama_user = $this->input->post('nama_user');
        $username = $this->input->post('username');
        $email_user = $this->input->post('email_user');
        $alamat = $this->input->post('alamat_user');
        $password_user = $this->input->post('password_user');
        

        $no_hp = $this->input->post('no_hp'); 

        $data = [
            'nama_user' => $nama_user,
            'username' => $username,
            'email_user' => $email_user,
            'alamat_user' => $alamat,
            'password_user' => $this->hash_password($password_user),
            'no_hp' => $no_hp,
        ];

        $cekData = $this->Mcrud->get_by_id('user', ['username' => $username]);

        if ($cekData->num_rows() == 1) {
            $this->session->set_flashdata('msg', 'Username Sudah Terpakai');
            redirect('auth/register');
        } else {
            $this->Mcrud->insert('user', $data);
            redirect('auth');
        }
    }

    public function status_user($id)
    {
        $data_where = ['id_user' => $id];
        $status_user = $this->Mcrud->get_by_id('user', $data_where)->row_object();

        if ($status_user->status_user == 'Y') {
            $data_update = ['status_user' => 'N'];
        } else {
            $data_update = ['status_user' => 'Y'];
        }

        $this->Mcrud->update('user', $data_update, 'id_user', $id);
        redirect('admin/user_data');
    }
}
?>