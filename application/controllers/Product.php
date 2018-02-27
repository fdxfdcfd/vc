<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_catalog_product');
        $this->load->model('M_catalog_category');
        $this->load->model('M_product_img');
        $this->load->library('pagination');
    }
    public function view()
    {
        $id = $this->uri->segment(4);
        if($id){
            $product = new M_catalog_product();
            $product->load($id);
            $this->data['product'] = $product;
        }
        $this->template->load('template/master', 'page/v_product', $this->data);
    }
}
