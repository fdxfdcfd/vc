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
        redirect('admin/category/categorylist');
    }
    public function categoryList()
    {
        $dataSearch = [];
        $params = '';
//        if ($this->input->get()) {
//            $dataSearch = $this->input->get();
//            $params = $_SERVER['QUERY_STRING'];
//        }
        // init params
        $category = new M_catalog_category();
        $params = array();
        $limit_per_page = 15;
        $start_index = ($this->uri->segment(4)) ? $this->uri->segment(4) : 1;

        $where = $this->generateWhere($dataSearch);
        $total_records = $category->getCollectionCount($where, null, '*');
        if ($start_index > ($total_records / $limit_per_page + 1)) {
            $start_index = 1;
        }
        $this->data['categories'] = $category->getCollection($where, null, '*', $limit_per_page, ($start_index - 1) * $limit_per_page);

        $cat = new M_catalog_category();
        $this->data['cat_menu'] = $cat->getAll('menu', 'category_name');

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


            $config['base_url'] = base_url() . 'admin/category/categoryList/';
            $config['total_rows'] = $total_records;
            $config['per_page'] = $limit_per_page;
            $config['use_page_numbers'] = TRUE;
            $config["uri_segment"] = 4;

            $this->pagination->initialize($config);

            // build paging links
            $this->data['link'] = $this->pagination->create_links();
        }

        $this->data['title'] = "Quản lý danh mục";
        $this->data['breadcrumb'] = [
            'Home' => base_url('admin/dashboard/index'),
            'Quản lý danh mục' => base_url('admin/category/categoryList')
        ];
        $this->data['footer']['js'][] = 'plugins/bootbox/bootbox.min.js';

        $this->load->helper('form');
        //$this->data['dataSearch'] = $dataSearch;
        $this->data['params'] = $params;
        $this->template->load('template/admin/master', 'page/admin/v_category_list', $this->data);
    }

    public function deletePost($id)
    {
        $category = new M_catalog_category();
        $category->load($id);
        if ($category->getEntityId()) {
            $category->delete();
            $this->addSuccessMessage('Delete Category successful.');
            redirect('admin/category/categorylist');
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
                $this->data['title'] = "Quản lý Danh Mục";
                $this->data['breadcrumb'] = [
                    'Home' => base_url('admin/dashboard/index'),
                    'Quản lý danh mục' => base_url('admin/category/categoryList'),
                    'Cập nhật danh mục' => base_url('admin/category/edit/id/') . $id

                ];
                $category = new M_catalog_category();
                $category->load($id);
                $this->data['categories'] = $category;
                $cat = new M_catalog_category();
                $treeCategory = $cat->getCategoryTree();
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
                $this->data['url'] = 'admin/category/edit/id/' . $id;
                $this->load->helper('form');
                $this->template->load('template/admin/master', 'page/admin/v_category_edit', $this->data);
            } else {
                show_404();
            }
        } else {
            $this->load->helper(array('form'));
            $this->load->library('form_validation');

            $config = array(
                array(
                    'field' => 'category_name',
                    'label' => 'Tên danh mục',
                    'rules' => 'required',
                    'errors' => array(
                        'required' => 'Bạn cần nhập %s.',
                    ),
                )
            );
            $this->form_validation->set_rules($config);

            if ($this->form_validation->run() == FALSE) {
                $this->addErrorMessage('You must fill all field required.');
                $id = $this->uri->segment(4);
                $this->data['title'] = "Quản lý danh mục";
                $this->data['breadcrumb'] = [
                    'Home' => base_url('admin/dashboard/index'),
                    'Quản lý Danh mục' => base_url('admin/category/categoryList'),
                    'Cập nhật Danh mục' => base_url('admin/category/edit/id/') . $id

                ];
                $this->data['product'] = $this->input->post();
                $category = new M_catalog_category();
                $treeCategory = $category->getCategoryTree();
                $this->data['categories'] = $category;
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
                $this->data['url'] = 'admin/category/edit/id/' . $id;

                $this->data['product_imgs'] = unserialize($this->session->userdata('product_edit_img'));
                $this->load->helper('form');
                $this->template->load('template/admin/master', 'page/admin/v_category_edit', $this->data);
            } else {
                $data = $this->input->post();

                if (!isset($data['is_active'])) {
                    $data['is_active'] = 0;
                }

                $data['content'] = $_POST['content'];
                $data['level'] = $data['parent']+ 1;
                $category_id = $data['entity_id'];
                $category = new M_catalog_category();
                $category->load($category_id);

                $category->setData($data);
                $category->save();
                $this->addSuccessMessage('Save Category successful.');
                redirect('admin/category', 'categorylist');
            }
        }

    }

    public function create()
    {
        if (!$this->input->post()) {
            $this->data['title'] = "Quản lý Danh Mục";
            $this->data['breadcrumb'] = [
                'Home' => base_url('admin/dashboard/index'),
                'Quản lý Danh mục' => base_url('admin/category/categoryList'),
                'Tạo Danh mục' => base_url('admin/category/create/')

            ];
            $category = new M_catalog_category();
            $this->data['categories'] = $category;
            $cat = new M_catalog_category();
            $treeCategory = $cat->getCategoryTree();
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
            $this->data['url'] = 'admin/category/create/';
            $this->load->helper('form');
            $this->template->load('template/admin/master', 'page/admin/v_category_create', $this->data);
        } else {
            $this->load->helper(array('form'));
            $this->load->library('form_validation');

            $config = array(
                array(
                    'field' => 'category_name',
                    'label' => 'Tên danh mục',
                    'rules' => 'required',
                    'errors' => array(
                        'required' => 'Bạn cần nhập %s.',
                    ),
                )
            );
            $this->form_validation->set_rules($config);

            if ($this->form_validation->run() == FALSE) {
                $this->addErrorMessage('You must fill all field required.');
                $id = $this->uri->segment(4);
                $this->data['title'] = "Quản lý danh mục";
                $this->data['breadcrumb'] = [
                    'Home' => base_url('admin/dashboard/index'),
                    'Quản lý danh mục' => base_url('admin/category/categoryList'),
                    'Tạo danh mục' => base_url('admin/category/create/')

                ];
                $this->data['categories'] = $this->input->post();
                $category = new M_catalog_category();
                $treeCategory = $category->getCategoryTree();
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
                $this->data['url'] = 'admin/category/create';
                $this->load->helper('form');
                $this->template->load('template/admin/master', 'page/admin/v_category_create', $this->data);
            } else {
                $data = $this->input->post();
                if (!isset($data['is_instock'])) {
                    $data['is_instock'] = 0;
                }
                if (!isset($data['is_active'])) {
                    $data['is_active'] = 0;
                }
                $data['content'] = addslashes($data['content']);
                $data['level'] = $data['parent']+ 1;
                $category = new M_catalog_category();

                $category->setData($data);
                $category->save();
                $this->addSuccessMessage('Save Category successful.');
                redirect('admin/category', 'categoryList');
            }
        }
    }
}
