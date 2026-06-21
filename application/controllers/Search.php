<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Search extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Mcrud');
        $this->load->helper('url');
        $this->load->library('template');
    }

    // Halaman search by brand
    public function search_by_brand($id)
    {
        $data_search = ['id_merk' => $id];
        $data['merk'] = $this->Mcrud->get_by_id('merk', $data_search)->row();
        $data['laptop'] = $this->Mcrud->get_by_id('laptop', $data_search)->result();
        $data['jf'] = 'Search';

        $this->template->load('layout_frontend', 'frontend/search', $data);
    }

    // AJAX search
    public function ajax_search()
    {
        $keyword = $this->input->get('keyword', true);
        if (!$keyword) {
            echo '<div class="alert alert-warning">Please enter a keyword</div>';
            return;
        }

        // Cari berdasarkan jenis_laptop
        $this->db->like('jenis_laptop', $keyword);
        $laptop = $this->db->get('laptop')->result();

        if (!$laptop) {
            echo '<div class="alert alert-warning">Product not found for "<strong>' . htmlspecialchars($keyword) . '</strong>"</div>';
            return;
        }

        // Grid responsif dengan Bootstrap
        echo '<div class="row g-4">';

        foreach ($laptop as $item) {
            ?>
            <div class="col-6 col-md-4 col-lg-3">
                <div class="card h-100 shadow-sm rounded-3 product-card">
                    <img src="<?= base_url('assets/image_laptop/' . $item->img_laptop) ?>" 
                         class="card-img-top rounded-top-3" 
                         alt="<?= $item->jenis_laptop ?>">
                    <div class="card-body d-flex flex-column">
                        <h6 class="card-title"><?= $item->jenis_laptop ?></h6>
                        <div class="mb-2">
                            <?php for ($i=0; $i<5; $i++): ?>
                                <i class="fa fa-star text-warning"></i>
                            <?php endfor; ?>
                        </div>
                        <p class="text-danger fw-bold">Rp <?= number_format($item->harga_laptop, 0, ',', '.') ?></p>
                        <div class="mt-auto d-flex justify-content-between gap-1">
							<a href="<?= site_url('frontend/detail_laptop/' . $item->id_laptop) ?>" class="btn btn-sm btn-dark w-100">
                            <i class="fa fa-eye"></i> Detail
                        </a>
                            <a href="<?= site_url('cart/insert_cart/' . $item->id_laptop) ?>" 
                               class="btn btn-sm btn-warning w-50 hover-scale">
                               <i class="fa fa-shopping-cart"></i>
                            </a>
                            <a href="<?= site_url('wishlist/insert_wishlist/' . $item->id_laptop) ?>" 
                               class="btn btn-sm btn-outline-danger w-50 hover-scale">
                               <i class="fa fa-heart"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <?php
        }

        echo '</div>';

        ?>

        <style>
            .product-card {
                transition: transform 0.3s, box-shadow 0.3s;
            }
            .product-card:hover {
                transform: translateY(-5px);
                box-shadow: 0 12px 25px rgba(0,0,0,0.2);
            }
            .hover-scale {
                transition: transform 0.2s;
            }
            .hover-scale:hover {
                transform: scale(1.05);
            }
        </style>
        <?php
    }
}
