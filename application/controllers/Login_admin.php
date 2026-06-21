<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_admin extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->model('Mlogin');
    }

    public function index()
    {
        $data['jf'] = "Login Admin";
        $this->load->view('auth/login_admin' , $data);
    }

    public function login_action()
    {
        $u = $this->input->post('username');
        $p = $this->input->post('password');
        $where = array('nama_admin' => $u);

        $cek = $this->Mlogin->login('admin', $where);
        $Pass = $cek->row();
        if ($cek->num_rows() == 1 && password_verify($p, $Pass->password_admin) == TRUE) {
            $data_session = array(
                'user_admin' => $u,
                'status' => 'login'
            );
            $this->session->set_userdata($data_session);
            redirect('Admin');
        } else {
            $this->session->set_flashdata('msg', 'Username atau Password Salah');
            redirect("Login_admin");
        }
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect('Login_admin');
    }
}
?>
