<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_catalog_product');
        $this->load->model('M_catalog_category');
        $this->load->model('M_product_img');
        $this->load->library('pagination');
    }
    public function index()
    {
        $id = $this->uri->segment(4);
        if($id){
            $category = new M_catalog_category();
            $category->load($id);
            $this->data['products'] = $this->getProductListByCategoryId($id);
        }
        $this->data['categories'] =$category;
        $this->template->load('template/master', 'page/v_category', $this->data);
    }
    public function getProductListByCategoryId($categoryId, $search='', $page = 1, $limit_per_page= 12){
        $product = new M_catalog_product();
        $result = [];
        $limit_per_page = 12;
        $start_index = $page ? $page : 1;
        $products = [];
        $total_records =0;
        $this->db->select('product_id');
        $this->db->where('category_id',$categoryId );
        $query = $this->db->get('catalog_category_product');
        if($query->num_rows()) {
            $arrayProduct= [];
            foreach ($query->result() as $re){
                $arrayProduct[] = $re->product_id;
            }
            if ($search) {
                $where['like']['product_name'] = [$search];
                $where['in']['entity_id'] = $arrayProduct;
            } else {
                $where['in']['entity_id'] = $arrayProduct;
            }
            $total_records = $product->getCollectionCount($where, null, '*');

            if ($start_index > ($total_records / $limit_per_page + 1)) {
                $start_index = 1;
            }
            $products = $product->getCollection($where, null, '*', $limit_per_page, ($start_index - 1) * $limit_per_page);
            foreach ($products as $product) {
                $product->img_url = base_url('public/admin/img/gallery/') . 'default_product.jpg';
                $this->db->where([
                    'product_id' => $product->entity_id,
                    'is_default' => '1'
                ]);
                $query = $this->db->get('catalog_product_img');
                if ($query->num_rows()) {
                    $product->img_url = base_url('public/admin/img/gallery/') . $query->row()->product_img_name;
                } else {
                    $this->db->where('product_id', $product->entity_id);
                    $query = $this->db->get('catalog_product_img');
                    if ($query->num_rows()) {
                        $product->img_url = base_url('public/admin/img/gallery/') . $query->row()->product_img_name;
                    }
                }

            }
        }
        $result['products'] = $products;
        $result['total_records'] = $total_records;
        $result['total_page'] = $total_records % $limit_per_page == 0 ? $total_records / $limit_per_page : (int)($total_records % $limit_per_page) + 1;
        $result['current_page'] =$page;

        return $result;
    }
}
