<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_catalog_product');
        $this->load->model('M_catalog_category');
        $this->load->model('M_catalog_branch');
        $this->load->library('pagination');
    }

    public function productList()
    {
        // init params
        $product = new M_catalog_product();
        $params = array();
        $limit_per_page = 15;
        $start_index = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        $total_records = $product->getTotal();

        if ($total_records > 0)
        {
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
//        $this->data['footer']['js'][]= 'plugins/footable/footable.all.min.js';
//        $this->data['header']['css'][]= 'plugins/footable/footable.core.css';
//        $this->data['footer']['script']= '$(document).ready(function() {
//            $(\'.footable\').footable();
//        });
//        ';
        $this->data['products'] = $product->getCurrentPageRecords($limit_per_page, $start_index);
        $this->data['categories'] = $this->M_catalog_category->getAll('menu','category_name');
        $this->data['branchs'] = $this->M_catalog_branch->getAll('menu','branch_name');
        $this->template->load('template/master', 'page/admin/v_product_list', $this->data);
    }

    public function deletePost($field, $id)
    {
        $this->M_admin_user->delete($id);
        redirect('admin/user/', 'userList');
    }

    public function edit()
    {
        if (!$this->input->post()) {
            $id = $this->uri->segment(5);
            if (isset($id)) {
                $this->data['title'] = "Quản lý Sản phẩm";
                $this->data['breadcrumb'] = [
                    'Home'=> base_url('admin/dashboard/index'),
                    'Quản lý Sản phẩm'=> base_url('admin/product/productList'),
                    'Cập nhật Sản phẩm'=> base_url('admin/product/edit/id') . $id

                ];
                $product = new M_catalog_product();
                $product->load($id);
                $this->data['product'] = $product;

                $categories = $this->M_catalog_category->getAll();
                $this->data['categories'] = $categories;
                $this->data['header']['css'][]='plugins/summernote/summernote.css';
                $this->data['header']['css'][]='plugins/summernote/summernote-bs3.css';
                $this->data['header']['css'][]='plugins/datapicker/datepicker3.css';
                $this->data['footer']['js'][]='plugins/summernote/summernote.min.js';
                $this->data['footer']['js'][]='plugins/datapicker/bootstrap-datepicker.js';
                $this->data['footer']['script']=' $(document).ready(function(){
                    $(\'.summernote\').summernote();
            
                    $(\'.input-group.date\').datepicker({
                        todayBtn: "linked",
                        keyboardNavigation: false,
                        forceParse: false,
                        calendarWeeks: true,
                        autoclose: true
                    });
            
                });';
                $this->data['url']= 'admin/product/edit/id/'.$id;
                $this->load->helper('form');
                $this->template->load('template/master', 'page/admin/v_product_edit', $this->data);
            }else{
                show_404();
            }
        } else {
            $this->load->helper(array('form'));
            $this->load->library('form_validation');

            $config = array(
                array(
                    'field' => 'firstname',
                    'label' => 'Tên',
                    'rules' => 'required',
                    'errors' => array(
                        'required' => 'Bạn cần nhập %s.',
                    ),
                ),
                array(
                    'field' => 'lastname',
                    'label' => 'Họ',
                    'rules' => 'required',
                    'errors' => array(
                        'required' => 'Bạn cần nhập %s.',
                    ),
                ),
                array(
                    'field' => 'email',
                    'label' => 'Email',
                    'rules' => 'required',
                    'errors' => array(
                        'required' => 'Bạn cần nhập %s.',
                    ),
                )
            );
            if (empty($_FILES['user_img']['name'])) {
                $config[] = array(
                    'field' => 'user_img',
                    'label' => 'Hình đại diện',
                    'rules' => 'required',
                    'errors' => array(
                        'required' => 'Bạn cần Chọn %s.',
                    ),
                );
            }
            $this->form_validation->set_rules($config);

            if ($this->form_validation->run() == FALSE) {
                $id = $this->uri->segment(5);
                $this->loadingData['data']['title'] = "Chỉnh sửa Thông tin thành viên";
                $this->loadingData['data']['breadcrumb'] = [
                    ['Home', base_url('admin/dashboard/index')],
                    ['Quản lý thành viên', base_url('admin/user/userList')],
                    ['Chỉnh sửa Thông tin thành viên', base_url('admin/user/edit/id') . $id],

                ];
                $user = $this->input->post();
                $user['user_img'] = $_FILES['user_img']['tmp_name'];
                $this->loadingData['data']['user'] = $user;

                $this->load->model('M_user_group');
                $userGroup = $this->M_user_group->as_dropdown('user_group_name')->get_all();
                $this->loadingData['data']['user_group'] = $userGroup;
                $this->load->helper('form');
                $this->template->load('template/master', 'page/admin/v_user_edit', $this->loadingData);
            } else {
                $data = $this->input->post();
                $user_id = $data['user_id'];
                //upload img
                $resultUpload=$this->uploadImg('user_img');
                if ($resultUpload['result']) {
                    $imgData = array('upload_data' => $this->upload->data());
                    $data['user_img'] = $imgData['upload_data']['file_name'];
                    $oldImg = $this->M_admin_user->get($user_id)->user_img;
                    if (isset($oldImg)) {
                        unlink('public/images/users/' . $oldImg);
                    }
                    unset($data['user_id']);
                    $this->M_admin_user->update($data, $user_id);
                    $currentUser= $this->getCurrentUserData();
                    if($user_id == $currentUser['user_id']){
                        $currentUser['user_img']= $data['user_img'];
                        $this->setCurrentUserData($currentUser);
                    }
                    redirect('admin/user', 'userList');
                }else{
                    $id = $this->uri->segment(5);
                    $this->loadingData['data']['title']="Chỉnh sửa Thông tin thành viên";
                    $this->loadingData['data']['breadcrumb'] = [
                        ['Home',base_url('admin/dashboard/index')],
                        ['Quản lý thành viên',base_url('admin/user/userList')],
                        ['Chỉnh sửa Thông tin thành viên',base_url('admin/user/edit/id').$id],

                    ];
                    $user= $this->input->post();
                    $user['user_img']= $_FILES['user_img']['tmp_name'];
                    $this->loadingData['data']['user'] = $user;

                    $this->load->model('M_user_group');
                    $userGroup= $this->M_user_group->as_dropdown('user_group_name')->get_all();
                    $this->loadingData['data']['user_group'] = $userGroup;
                    $this->loadingData['data']['upload_error'] =$resultUpload['message'];
                    $this->load->helper('form');
                    return $this->template->load('template/master', 'page/admin/v_user_edit',$this->loadingData);
                }
            }
        }

    }

    public function uploadImg($fieldname)
    {
        $this->load->library('upload');
        //upload img
        $config['upload_path'] = './public/images/users';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = 2048000;
        $config['max_width'] = 1024;
        $config['max_height'] = 768;
        $config['encrypt_name'] = TRUE;

        $this->upload->initialize($config);

        if ($this->upload->do_upload($fieldname)) {
            return ['result' => true, 'message' => 'success'];
        } else {
            return ['result' => false, 'message' => $this->upload->display_errors()];
        }
    }


}
