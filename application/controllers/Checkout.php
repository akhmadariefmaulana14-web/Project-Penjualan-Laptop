<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Checkout extends CI_Controller {
    function __construct()
    {
        parent::__construct();
        $this->load->model('Mcrud');
        $this->load->library('template');
        if (empty($this->session->userdata('userName'))) {
            redirect('auth');
        }
    }

    public function index() {
        $data['jf'] = "Checkout";
        $data['kota'] = $this->Mcrud->get_all_data('kota')->result();

        $this->template->load('layout_frontend', 'frontend/checkout', $data);
    }
}
?>
