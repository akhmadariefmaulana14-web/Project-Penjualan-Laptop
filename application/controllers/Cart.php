<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Cart extends CI_Controller {
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
        $data['jf'] = "Cart";

        $this->template->load('layout_frontend', 'frontend/cart', $data);
    }

    public function insert_cart($id) {
        $data_insert = $this->Mcrud->find($id);

        $data = array(
            'id' => $data_insert->id_laptop,
            'qty' => 1,
            'price' => $data_insert->harga_laptop,
            'name' => $data_insert->jenis_laptop,
        );

        $this->cart->insert($data);
        redirect('frontend');
    }

    public function insert_cart_from_wishlist($id)
    {
        $data_insert = $this->Mcrud->find($id);

        $data = array(
            'id' => $data_insert->id_laptop,
            'qty' => 1,
            'price' => $data_insert->harga_laptop,
            'name' => $data_insert->jenis_laptop,
        );

        $this->cart->insert($data);
        redirect('wishlist');
    }

    public function insert_cart_from_search($id)
    {
        $data_insert = $this->Mcrud->find($id);

        $data = array(
            'id' => $data_insert->id_laptop,
            'qty' => 1,
            'price' => $data_insert->harga_laptop,
            'name' => $data_insert->jenis_laptop,
        );

        $this->cart->insert($data);
        redirect('search/search_by_brand/'. $data_insert->id_merk);
    }

    public function remove_item($id) {
        $this->cart->remove($id);

        redirect('cart');
    }

    public function update_item() {
        $rowid = $this->input->post('rowid');
        $action = $this->input->post('action');
        $item = $this->cart->get_item($rowid);
        $qty = $item['qty'];
        if ($action == 'plus') {
            $qty++;
        } elseif ($action == 'minus') {
            if ($qty > 1) {
                $qty--;
            }
        }
        $data = array(
            'rowid' => $rowid,
            'qty'   => $qty
        );
        $this->cart->update($data);
        redirect('cart');
    }

    public function redeem_code() {
        $code = $this->input->post('kode_promo');

        if ($code == null) {
            redirect('cart');
        }

        $id_user = $this->Mcrud->get_by_id('user', array('username' => $this->session->userdata('userName')))->row_object();
        $data_promo = $this->Mcrud->get_by_id('promo', array('kode_promo' => $code));
        $id_promo = $data_promo->row_object();
        $cek_stok_coupon = $data_promo->num_rows();
        $cek_coupon = $this->Mcrud->cek_coupon($id_user->id_user, $id_promo->id_promo)->num_rows();
        
        if ($cek_stok_coupon == null) {
            $this->session->set_flashdata('alert-msg', 'Kode Promo Tidak Tersedia');
        } elseif ($cek_coupon > 0) {
            $this->session->set_flashdata('alert-msg', 'Kode Promo Telah Terpakai');
        } else {
            $this->session->set_tempdata('coupon', $id_promo->nilai, 300);
            $this->session->set_tempdata('id_coupon', $id_promo->id_promo, 300);
        }
        
        redirect('cart');
    }
}
?>
