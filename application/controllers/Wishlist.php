<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Wishlist extends CI_Controller {

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
        $data_user = array('username' => $this->session->userdata('userName'));
        $id_user = $this->Mcrud->get_by_id('user', $data_user)->row_object();

        $data['data_wishlist'] = $this->Mcrud->get_wishlist(array('id_user' => $id_user->id_user))->result();
        $data['jf'] = "Wishlist";

        $this->template->load('layout_frontend', 'frontend/wishlist', $data);
    }

    public function insert_wishlist($id) {
        $data_laptop = array('id_laptop' => $id);
        $data_user = array('username' => $this->session->userdata('userName'));
        $id_user = $this->Mcrud->get_by_id('user', $data_user)->row_object();

        if ($this->Mcrud->cek_data_wishlist($data_laptop, array('id_user' => $id_user->id_user))->num_rows() > 0) {
            $this->Mcrud->delete_wishlist($data_laptop, array('id_user' => $id_user->id_user));

            redirect('frontend');
        } else {
            $data_insert = array (
                'id_laptop' => $id,
                'id_user' => $id_user->id_user
            );

            $this->Mcrud->insert('wishlist', $data_insert);
            redirect('frontend');
        }
    }

    public function insert_wishlist_from_search($id)
    {
        $data_laptop = array('id_laptop' => $id);
        $data_user = array('username' => $this->session->userdata('userName'));
        $id_user = $this->Mcrud->get_by_id('user', $data_user)->row_object();
        $id_merk = $this->Mcrud->get_by_id('laptop', $data_laptop)->row_object();

        if ($this->Mcrud->cek_data_wishlist($data_laptop, array('id_user' => $id_user->id_user))->num_rows() > 0) {
            $this->Mcrud->delete_wishlist($data_laptop, array('id_user' => $id_user->id_user));

            redirect('search/search_by_brand/' . $id_merk->id_merk);
        } else {
            $data_insert = array(
                'id_laptop' => $id,
                'id_user' => $id_user->id_user
            );

            $this->Mcrud->insert('wishlist', $data_insert);
            redirect('search/search_by_brand/' . $id_merk->id_merk);
        }
    }  

    public function remove_wishlist($id) {
        $data_laptop = array('id_laptop' => $id);
        $data_user = array('username' => $this->session->userdata('userName'));
        $id_user = $this->Mcrud->get_by_id('user', $data_user)->row_object();
        $this->Mcrud->delete_wishlist($data_laptop, array('id_user' => $id_user->id_user));

        redirect('wishlist');
    }
}
