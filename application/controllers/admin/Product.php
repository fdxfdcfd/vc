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

    public function productList()
    {
        $dataSearch = [];
        $params = '';
        if ($this->input->get()) {
            $dataSearch = $this->input->get();
            $params = $_SERVER['QUERY_STRING'];
        }
        // init params
        $product = new M_catalog_product();
        $params = array();
        $limit_per_page = 15;
        $start_index = ($this->uri->segment(4)) ? $this->uri->segment(4) : 1;

        $where = $this->generateWhere($dataSearch);
        $total_records = $product->getCollectionCount($where, null, '*');
        if ($start_index > ($total_records / $limit_per_page + 1)) {
            $start_index = 1;
        }
        $this->data['products'] = $product->getCollection($where, null, '*', $limit_per_page, ($start_index - 1) * $limit_per_page);
        $this->data['link'] = '';
        if ($total_records > 0) {
            $config['num_links'] = 2;
            $config['full_tag_open'] = '<ul class="pagination pull-right">';
            $config['full_tag_close'] = '</ul>';

            $config['first_link'] = '«';
            $config['first_tag_open'] = ' <li class="footable-page-arrow">';
            $config['first_tag_close'] = '</li>';

            $config['last_link'] = '»';
            $config['last_tag_open'] = ' <li class="footable-page-arrow">';
            $config['last_tag_close'] = '</li>';

            $config['next_link'] = '›';
            $config['next_tag_open'] = '<li class="footable-page-arrow">';
            $config['next_tag_close'] = '</li>';

            $config['prev_link'] = '‹';
            $config['prev_tag_open'] = '<li class="footable-page-arrow">';
            $config['prev_tag_close'] = '</li>';

            $config['cur_tag_open'] = ' <li class="footable-page active"><a>';
            $config['cur_tag_close'] = '</a></li>';


            $config['num_tag_open'] = '<li class="footable-page">';
            $config['num_tag_close'] = '</li>';


            $config['base_url'] = base_url() . 'admin/product/productlist/';
            $config['total_rows'] = $total_records;
            $config['per_page'] = $limit_per_page;
            $config['use_page_numbers'] = TRUE;
            $config["uri_segment"] = 4;

            $this->pagination->initialize($config);

            // build paging links
            $this->data['link'] = $this->pagination->create_links();
        }

        $this->data['title'] = "Quản lý Sản phẩm";
        $this->data['breadcrumb'] = [
            'Home' => base_url('admin/dashboard/index'),
            'Quản lý Sản phẩm' => base_url('admin/product/productList')
        ];
        $this->data['footer']['js'][] = 'plugins/bootbox/bootbox.min.js';

        $categoris = new M_catalog_category();
        $this->load->helper('form');
        $this->data['dataSearch'] = $dataSearch;
        $this->data['params'] = $params;
        $this->data['categories'] = $categoris->getAll('menu', 'category_name');
        $this->template->load('template/admin/master', 'page/admin/v_product_list', $this->data);
    }

    public function deletePost($id)
    {
        $product = new M_catalog_product();
        $product->load($id);
        if ($product->getEntityId()) {
            $product->delete();
            $this->addSuccessMessage('Delete Product successful.');
            redirect('admin/user/', 'userList');
        }
    }

    protected function generateWhere($paramSearch = [])
    {
        $where = [];
        foreach ($paramSearch as $key => $value) {
            if (trim($value) != '') {
                if ($key == 'product_category_ids') {
                    $val = explode(',', $value);
                    foreach ($val as $v) {
                        $where['like'][$key][] = $v;
                    }
                } else {
                    $where['like'][$key][] = $value;
                }
            }
        }
        return $where;
    }

    public function edit()
    {
        if (!$this->input->post()) {
            $id = $this->uri->segment(4);
            if (isset($id)) {
                $this->data['title'] = "Quản lý Sản phẩm";
                $this->data['breadcrumb'] = [
                    'Home' => base_url('admin/dashboard/index'),
                    'Quản lý Sản phẩm' => base_url('admin/product/productList'),
                    'Cập nhật Sản phẩm' => base_url('admin/product/edit/id/') . $id

                ];
                $product = new M_catalog_product();
                $product->load($id);
                $this->session->set_userdata('currentProduct', serialize($product));
                $this->data['product'] = $product;

                $category = new M_catalog_category();
                $treeCategory = $category->getCategoryTree();
                $this->data['categories'] = $category->getAll();
                $this->data['treeCategories'] = $treeCategory;
                $this->data['css'][] = 'plugins/summernote/summernote.css';
                $this->data['css'][] = 'plugins/summernote/summernote-bs3.css';
                $this->data['css'][] = 'plugins/datapicker/datepicker3.css';
                $this->data['css'][] = 'plugins/iCheck/custom.css';
                $this->data['css'][] = 'plugins/jsTree/style.min.css';
                $this->data['js'][] = 'plugins/summernote/summernote.min.js';
                $this->data['js'][] = 'plugins/datapicker/bootstrap-datepicker.js';
                $this->data['js'][] = 'plugins/iCheck/icheck.min.js';
                $this->data['js'][] = 'plugins/jsTree/jstree.min.js';
                $this->data['css'][] = 'plugins/dropzone/dropzone.css';
                $this->data['js'][] = 'plugins/dropzone/dropzone.js';
                $this->data['url'] = 'admin/product/edit/id/' . $id;
                $productImg = new M_product_img();
                $imgs = $productImg->loadByProductId($id);
                $this->session->unset_userdata('product_edit_img');
                $this->session->unset_userdata('product_delete_img');
                $this->data['product_imgs'] = $imgs;
                $this->load->helper('form');
                $this->template->load('template/admin/master', 'page/admin/v_product_edit', $this->data);
            } else {
                show_404();
            }
        } else {
            $this->load->helper(array('form'));
            $this->load->library('form_validation');

            $config = array(
                array(
                    'field' => 'product_name',
                    'label' => 'Tên sản phẩm',
                    'rules' => 'required',
                    'errors' => array(
                        'required' => 'Bạn cần nhập %s.',
                    ),
                ),
//                array(
//                    'field' => 'lastname',
//                    'label' => 'Họ',
//                    'rules' => 'required',
//                    'errors' => array(
//                        'required' => 'Bạn cần nhập %s.',
//                    ),
//                ),
//                array(
//                    'field' => 'email',
//                    'label' => 'Email',
//                    'rules' => 'required',
//                    'errors' => array(
//                        'required' => 'Bạn cần nhập %s.',
//                    ),
//                )
            );
            $this->form_validation->set_rules($config);

            if ($this->form_validation->run() == FALSE) {
                $this->addErrorMessage('You must fill all field required.');
                $id = $this->uri->segment(4);
                $this->data['title'] = "Quản lý Sản phẩm";
                $this->data['breadcrumb'] = [
                    'Home' => base_url('admin/dashboard/index'),
                    'Quản lý Sản phẩm' => base_url('admin/product/productList'),
                    'Cập nhật Sản phẩm' => base_url('admin/product/edit/id/') . $id

                ];
                $this->data['product'] = $this->input->post();
                $category = new M_catalog_category();
                $treeCategory = $category->getCategoryTree();
                $this->data['categories'] = $category->getAll();
                $this->data['treeCategories'] = $treeCategory;
                $this->data['css'][] = 'plugins/summernote/summernote.css';
                $this->data['css'][] = 'plugins/summernote/summernote-bs3.css';
                $this->data['css'][] = 'plugins/datapicker/datepicker3.css';
                $this->data['css'][] = 'plugins/iCheck/custom.css';
                $this->data['css'][] = 'plugins/jsTree/style.min.css';
                $this->data['js'][] = 'plugins/summernote/summernote.min.js';
                $this->data['js'][] = 'plugins/datapicker/bootstrap-datepicker.js';
                $this->data['js'][] = 'plugins/iCheck/icheck.min.js';
                $this->data['js'][] = 'plugins/jsTree/jstree.min.js';
                $this->data['css'][] = 'plugins/dropzone/dropzone.css';
                $this->data['js'][] = 'plugins/dropzone/dropzone.js';
                $this->data['url'] = 'admin/product/edit/id/' . $id;

                $this->data['product_imgs'] = unserialize($this->session->userdata('product_edit_img'));
                $this->load->helper('form');
                $this->template->load('template/admin/master', 'page/admin/v_product_edit', $this->data);
            } else {
                $data = $this->input->post();
                if (!isset($data['is_instock'])) {
                    $data['is_instock'] = 0;
                }
                if (!isset($data['is_active'])) {
                    $data['is_active'] = 0;
                }
                $product_id = $data['entity_id'];
                $product = new M_catalog_product();
                $product->load($product_id);

                $product->setData($data);
                $product->save();
                if ($sessionproductImage = unserialize($this->session->userdata('product_edit_img'))) {
                    foreach ($sessionproductImage as $img) {
                        $imgModel = new M_product_img();
                        $imgModel->setData(['product_id' => $product->getEntityId(), 'product_img_name' => $img]);
                        $imgModel->save();
                    }
                }
                if ($sessionDeleteProductImage = unserialize($this->session->userdata('product_delete_img'))) {
                    foreach ($sessionDeleteProductImage as $id => $name) {
                        $imgModel = new M_product_img();
                        $imgModel->load($id);
                        $imgModel->delete();
                        $link = 'public/img/gallery/'.$name;
                        if(is_file($link)){
                            unlink($link);
                        }
                    }
                }
                $this->session->unset_userdata('product_edit_img');
                $this->session->unset_userdata('product_delete_img');
                $this->addSuccessMessage('Save Product successful.');
                redirect('admin/product', 'productList');
            }
        }

    }

    public function create()
    {
        if (!$this->input->post()) {
            $this->data['title'] = "Quản lý Sản phẩm";
            $this->data['breadcrumb'] = [
                'Home' => base_url('admin/dashboard/index'),
                'Quản lý Sản phẩm' => base_url('admin/product/productList'),
                'Cập nhật Sản phẩm' => base_url('admin/product/create')

            ];
            $product = new M_catalog_product();
            $this->data['product'] = $product;
            $category = new M_catalog_category();
            $treeCategory = $category->getCategoryTree();
            $this->data['categories'] = $category->getAll();
            $this->data['treeCategories'] = $treeCategory;
            $this->data['css'][] = 'plugins/summernote/summernote.css';
            $this->data['css'][] = 'plugins/summernote/summernote-bs3.css';
            $this->data['css'][] = 'plugins/datapicker/datepicker3.css';
            $this->data['css'][] = 'plugins/iCheck/custom.css';
            $this->data['css'][] = 'plugins/jsTree/style.min.css';
            $this->data['js'][] = 'plugins/summernote/summernote.min.js';
            $this->data['js'][] = 'plugins/datapicker/bootstrap-datepicker.js';
            $this->data['js'][] = 'plugins/iCheck/icheck.min.js';
            $this->data['js'][] = 'plugins/jsTree/jstree.min.js';
            $this->data['css'][] = 'plugins/dropzone/dropzone.css';
            $this->data['js'][] = 'plugins/dropzone/dropzone.js';
            $this->data['url'] = 'admin/product/create';
            $this->data['product_imgs'] = [];
            $this->session->unset_userdata('product_edit_img');
            $this->session->unset_userdata('product_delete_img');
            $this->load->helper('form');
            $this->template->load('template/admin/master', 'page/admin/v_product_edit', $this->data);
        } else {
            $this->load->helper(array('form'));
            $this->load->library('form_validation');

            $config = array(
                array(
                    'field' => 'product_name',
                    'label' => 'Tên sản phẩm',
                    'rules' => 'required',
                    'errors' => array(
                        'required' => 'Bạn cần nhập %s.',
                    ),
                ),
//                array(
//                    'field' => 'lastname',
//                    'label' => 'Họ',
//                    'rules' => 'required',
//                    'errors' => array(
//                        'required' => 'Bạn cần nhập %s.',
//                    ),
//                ),
//                array(
//                    'field' => 'email',
//                    'label' => 'Email',
//                    'rules' => 'required',
//                    'errors' => array(
//                        'required' => 'Bạn cần nhập %s.',
//                    ),
//                )
            );
            $this->form_validation->set_rules($config);

            if ($this->form_validation->run() == FALSE) {
                $this->addErrorMessage('You must fill all field required.');
                $id = $this->uri->segment(4);
                $this->data['title'] = "Quản lý Sản phẩm";
                $this->data['breadcrumb'] = [
                    'Home' => base_url('admin/dashboard/index'),
                    'Quản lý Sản phẩm' => base_url('admin/product/productList'),
                    'Cập nhật Sản phẩm' => base_url('admin/product/create/')

                ];
                $this->data['product'] = $this->input->post();
                $category = new M_catalog_category();
                $treeCategory = $category->getCategoryTree();
                $this->data['categories'] = $category->getAll();
                $this->data['treeCategories'] = $treeCategory;
                $this->data['css'][] = 'plugins/summernote/summernote.css';
                $this->data['css'][] = 'plugins/summernote/summernote-bs3.css';
                $this->data['css'][] = 'plugins/datapicker/datepicker3.css';
                $this->data['css'][] = 'plugins/iCheck/custom.css';
                $this->data['css'][] = 'plugins/jsTree/style.min.css';
                $this->data['js'][] = 'plugins/summernote/summernote.min.js';
                $this->data['js'][] = 'plugins/datapicker/bootstrap-datepicker.js';
                $this->data['js'][] = 'plugins/iCheck/icheck.min.js';
                $this->data['js'][] = 'plugins/jsTree/jstree.min.js';
                $this->data['css'][] = 'plugins/dropzone/dropzone.css';
                $this->data['js'][] = 'plugins/dropzone/dropzone.js';
                $this->data['url'] = 'admin/product/create';

                $this->data['product_imgs'] = unserialize($this->session->userdata('product_edit_img'));
                $this->load->helper('form');
                $this->template->load('template/admin/master', 'page/admin/v_product_edit', $this->data);
            } else {
                $data = $this->input->post();
                if (!isset($data['is_instock'])) {
                    $data['is_instock'] = 0;
                }
                if (!isset($data['is_active'])) {
                    $data['is_active'] = 0;
                }
                $product = new M_catalog_product();

                $product->setData($data);
                $product->save();
                if ($sessionproductImage = unserialize($this->session->userdata('product_edit_img'))) {
                    foreach ($sessionproductImage as $img) {
                        $imgModel = new M_product_img();
                        $imgModel->setData(['product_id' => $product->getEntityId(), 'product_img_name' => $img]);
                        $imgModel->save();
                    }
                }
                if ($sessionDeleteProductImage = unserialize($this->session->userdata('product_delete_img'))) {
                    foreach ($sessionDeleteProductImage as $id => $name) {
                        $imgModel = new M_product_img();
                        $imgModel->load($id);
                        $imgModel->delete();

                    }
                }
                $this->session->unset_userdata('product_edit_img');
                $this->session->unset_userdata('product_delete_img');
                $this->addSuccessMessage('Save Product successful.');
                redirect('admin/product', 'productList');
            }
        }
    }

    public function uploadImg()
    {
        $sessionproductImage = unserialize($this->session->userdata('product_edit_img'));
        $fieldname = 'file';
        $this->load->library('upload');
        //upload img
        $config['upload_path'] = './public/img/gallery';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = 20480000;
        $config['encrypt_name'] = TRUE;
        $this->upload->initialize($config);
        if ($this->upload->do_upload($fieldname)) {
            $upload = $this->upload->data();
            $sessionproductImage[] = $upload['file_name'];
            $this->session->set_userdata('product_edit_img', serialize($sessionproductImage));
            $result = ['code' => 1, 'message' => $upload['file_name']];
            echo json_encode($result);
        } else {
            $result = ['code' => 0, 'message' => $this->upload->display_errors()];
            echo json_encode($result);
        }
    }

    public function deleteImg()
    {
        $sessionDeleteProductImage = unserialize($this->session->userdata('product_delete_img'));
        $sessionproductImage = unserialize($this->session->userdata('product_edit_img'));
        $params = $this->input->post();
        if (isset($params['img_id'])) {
            if ($params['img_id'] != -1) {
                $sessionDeleteProductImage[$params['img_id']] = $params['img_name'];
            } else {
                $sessionproductImage = array_diff($sessionproductImage, array($params['img_name']));
            }
            $this->session->set_userdata('product_edit_img', serialize($sessionproductImage));
            $this->session->set_userdata('product_delete_img', serialize($sessionDeleteProductImage));
            $result = ['result' => 1, 'message' => 'Success'];

        } else {
            $result = ['result' => 0, 'message' => 'Image id is not invalid.'];
        }
        echo json_encode($result);
    }


    public function loadRelatedProduct(){
        $sessionRelatedProduct = unserialize($this->session->userdata('related_product_add'));
//        $sessionDeleteRelatedProduct = unserialize($this->session->userdata('related_product_delete'));
        $this->session->set_userdata('related_product_add', serialize($sessionRelatedProduct));

        $params= $this->input->post();
        $result = ['code'=>1,'message'=>'success'];
        echo json_encode($result);
    }


}
