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
        $params = $this->input->get();
        if($id){
            $category = new M_catalog_category();
            $category->load($id);
            $p = isset($params['p']) ? $params['p'] :  1;
            $np = isset($params['np']) ? $params['np'] :  12;
            $s = isset($params['s']) ? $params['s'] :  'date';
            $search = [
                's'=> $s
            ];
            $this->data['products'] = $this->getProductListByCategoryId($id,[],$p ,$np );
        }
        $this->data['categories'] =$category;
        $this->template->load('template/master', 'page/v_category', $this->data);
    }
    public function getProductListByCategoryId($categoryId, $search= [], $page = 1, $limit_per_page= 12){
        $product = new M_catalog_product();
        $result = [];
        $start_index = $page ? $page : 1;
        $products = [];
        $total_records =0;
        $this->db->select('*');
        $arrayWhere = ['category_id'=>$categoryId, 'pro.is_active'=> 1];
        $this->db->where($arrayWhere);
        $this->db->join('catalog_product as pro', 'pro.entity_id = cate_pro.product_id');
        if(count($search)){
            foreach ($search as $key => $val){
                $this->db->order_by($val, "asc");
            }
        }
        $query = $this->db->get('catalog_category_product as cate_pro');

        if($query->num_rows()) {
            $total_records = $query->num_rows();
            if ($start_index > ($total_records / $limit_per_page + 1)) {
                $start_index = 1;
            }
            $products = $query->result();
            foreach ($products as $product) {
                $product->img_url = base_url('public/admin/img/gallery/') . 'default_product.jpg';
                $this->db->where([
                    'product_id' => $product->entity_id,
                ]);
                $this->db->order_by("is_default", "desc");
                $this->db->limit(1);
                $query = $this->db->get('catalog_product_img');
                if ($query->num_rows()) {
                    $product->img_url = base_url('public/admin/img/gallery/') . $query->row()->product_img_name;
                }
            }
        }
        $result['products'] = $products;
        $result['total_records'] = $total_records;
        $result['total_page'] = $total_records % $limit_per_page == 0 ? $total_records / $limit_per_page : (int)($total_records / $limit_per_page) + 1;
        $result['current_page'] =$page;
        return $result;
    }
}
