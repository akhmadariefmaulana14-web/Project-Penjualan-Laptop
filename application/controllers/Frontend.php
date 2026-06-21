<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Frontend extends CI_Controller {
	function __construct()
    {
        parent::__construct();
        $this->load->model('Mcrud');
        $this->load->library('template');
    }

	public function index()
	{
        $data['brand_laptop'] = $this->Mcrud->get_all_data('merk')->result();
        $data['laptop'] = $this->Mcrud->get_all_data('laptop')->result();
		$data['jf'] = "Halaman Utama Frontend";

		$this->template->load('layout_frontend','frontend/dashboard',$data);
	}

	 public function detail_laptop($id)
    {
        $data['laptop'] = $this->Mcrud->get_detail_laptop($id);
        $data['jf'] = 'Detail Laptop';

        if (!$data['laptop']) {
            show_404();
        }

        $this->template->load('layout_frontend', 'frontend/detail', $data);
    }
}
?>
