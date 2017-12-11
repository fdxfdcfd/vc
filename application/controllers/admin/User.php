<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_admin_user');
        $this->load->library('pagination');
        $this->loadingData['data']['foot']['js'][] = "js/admin_user_form.js";
    }

    public function userList()
    {
        // init params
        $user = new M_admin_user();
        $params = array();
        $limit_per_page = 10;
        $start_index = ($this->uri->segment(4)) ? $this->uri->segment(4) : 1;
        $total_records = $user->getTotal();

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


            $config['base_url'] = base_url() . 'admin/user/userlist/';
            $config['total_rows'] = $total_records;
            $config['per_page'] = $limit_per_page;
            $config["uri_segment"] = 4;
            $config['use_page_numbers'] = TRUE;

            $this->pagination->initialize($config);

            // build paging links
            $this->data['link'] = $this->pagination->create_links();
        }


        $this->data['title'] = "Quản lý thành viên";
        $this->data['footer']['js'][] = 'plugins/bootbox/bootbox.min.js';
        $this->data['breadcrumb'] = [
            'Home' => base_url('admin/dashboard/index'),
            'Quản lý thành viên' => base_url('admin/user/userList')
        ];
        $userGroup = $this->M_user_group->getAll('menu', 'user_group_name');
        $this->data['user_group'] = $userGroup;
        $start_index = ($start_index - 1) * $limit_per_page;
        $this->data['users'] = $user->getCollection(null, null, '*', $limit_per_page, $start_index);
        $this->template->load('template/master', 'page/admin/v_user_list', $this->data);
    }

    public function deletePost($field, $id)
    {
        $user = new M_admin_user();
        $user->load($id);
        $user->delete();
        $this->addSuccessMessage('Delete User successful.');
        redirect('admin/user/', 'userList');
    }

    public function edit()
    {
        if (!$this->input->post()) {
            $id = $this->uri->segment(5);
            if (isset($id)) {
                $this->data['title'] = "Chỉnh sửa Thông tin thành viên";
                $this->data['breadcrumb'] = [
                    'Home' => base_url('admin/dashboard/index'),
                    'Quản lý thành viên' => base_url('admin/user/userList'),
                    'Chỉnh sửa Thông tin thành viên' => base_url('admin/user/edit/id/') . $id,
                ];
                $this->data['url'] = base_url('admin/user/edit/id/') . $id;
                $user = new M_admin_user();
                $user->load($id, 'array');
                $this->data['user'] = $user->getData();
                if ($user->getData('user_img')) {
                    $this->session->set_userdata('user_edit_img', $user->getData('user_img'));
                }
                $this->load->model('M_user_group');
                $userGroup = $this->M_user_group->getAll('menu', 'user_group_name');
                $this->data['user_group'] = $userGroup;
                $this->load->helper('form');
                $this->data['header']['css'][] = 'plugins/dropzone/dropzone.css';
                $this->data['header']['css'][] = 'plugins/chosen/chosen.css';
                $this->data['footer']['js'][] = 'plugins/chosen/chosen.jquery.js';
                $this->data['footer']['js'][] = 'plugins/dropzone/dropzone.js';
                $this->data['footer']['script'] = "
                    Dropzone.options.dropzoneForm = {
                    paramName: \"file\", // The name that will be used to transfer the file
                    maxFilesize: 2, // MB
                    acceptedFiles: 'image/*',
                    maxFiles: 4,
                    dictDefaultMessage: \"<strong>Drop files here or click to upload. </strong><br> size must be < 2mb\"
                    };
                        $('.chosen-select').chosen({width: \"100%\"});
                ";
                $this->template->load('template/master', 'page/admin/v_user_edit', $this->data);
            } else {
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
            $this->form_validation->set_rules($config);

            if ($this->form_validation->run() == FALSE) {
                $id = $this->uri->segment(5);
                $this->data['title'] = "Chỉnh sửa Thông tin thành viên";
                $this->data['breadcrumb'] = [
                    'Home' => base_url('admin/dashboard/index'),
                    'Quản lý thành viên' => base_url('admin/user/userList'),
                    'Chỉnh sửa Thông tin thành viên' => base_url('admin/user/edit/id/') . $id,

                ];
                $this->data['url'] = base_url('admin/user/edit/id/') . $id;
                $user = $this->input->post();
                $this->data['user'] = $user;
                $this->load->model('M_user_group');
                $userGroup = $this->M_user_group->getAll('menu', 'user_group_name');
                $this->data['user_group'] = $userGroup;
                $this->load->helper('form');
                $this->data['header']['css'][] = 'plugins/dropzone/dropzone.css';
                $this->data['header']['css'][] = 'plugins/chosen/chosen.css';
                $this->data['footer']['js'][] = 'plugins/chosen/chosen.jquery.js';
                $this->data['footer']['js'][] = 'plugins/dropzone/dropzone.js';
                $this->data['footer']['script'] = "
                    Dropzone.options.dropzoneForm = {
                    paramName: \"user_img\", // The name that will be used to transfer the file
                    maxFilesize: 2, // MB
                    acceptedFiles: 'image/*',
                    maxFiles: 4,
                    dictDefaultMessage: \"<strong>Drop files here or click to upload. </strong><br> size must be < 2mb\"
                    };
                        $('.chosen-select').chosen({width: \"100%\"});
                ";
                $this->template->load('template/master', 'page/admin/v_user_edit', $this->data);
            } else {
                $data = $this->input->post();
                $admin_user_id = $data['admin_user_id'];
                if ($admin_user_id) {
                    $unlink = $this->session->userdata('unlink_user_edit_img');
                    foreach ($unlink as $link) {
                        unlink($link);
                    }
                    $user = new M_admin_user();
                    $user->load($admin_user_id);
                    if ($sessioUserImage = $this->session->userdata('user_edit_img')) {
                        $user->setUserImg($sessioUserImage);
                    }
                    $user->setData($data);
                    $user->save();
                }
                redirect('admin/user', 'userList');
            }
        }
    }

    public function create()
    {
        if (!$this->input->post()) {
            $this->data['title'] = "Thêm Thành viên";
            $this->data['breadcrumb'] = [
                'Home' => base_url('admin/dashboard/index'),
                'Quản lý thành viên' => base_url('admin/user/userList'),
                'Thêm thành viên' => base_url('admin/user/create'),
            ];
            $this->data['user'] = [];
            $this->data['header']['css'][] = 'plugins/dropzone/dropzone.css';
            $this->data['header']['css'][] = 'plugins/chosen/chosen.css';
            $this->data['footer']['js'][] = 'plugins/chosen/chosen.jquery.js';
            $this->data['footer']['js'][] = 'plugins/dropzone/dropzone.js';
            $this->data['footer']['script'] = "
                    Dropzone.options.dropzoneForm = {
                    paramName: \"file\", // The name that will be used to transfer the file
                    maxFilesize: 2, // MB
                    acceptedFiles: 'image/*',
                    maxFiles: 4,
                    dictDefaultMessage: \"<strong>Drop files here or click to upload. </strong><br> size must be < 2mb\"
                    };
                        $('.chosen-select').chosen({width: \"100%\"});
                ";
            $this->data['url'] = base_url('admin/user/create');
            $userGroup = new M_user_group();
            $userGroup = $userGroup->getAll('menu', 'user_group_name');
            $this->data['user_group'] = $userGroup;
            $this->load->helper('form');
            $this->template->load('template/master', 'page/admin/v_user_edit', $this->data);

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
            $this->form_validation->set_rules($config);

            if ($this->form_validation->run() == FALSE) {
                $this->data['title'] = "Thêm Thành viên";
                $this->data['breadcrumb'] = [
                    'Home' => base_url('admin/dashboard/index'),
                    'Quản lý thành viên' => base_url('admin/user/userList'),
                    'Thêm thành viên' => base_url('admin/user/create'),
                ];
                $this->data['user'] = $this->input->post();;
                $this->data['header']['css'][] = 'plugins/dropzone/dropzone.css';
                $this->data['header']['css'][] = 'plugins/chosen/chosen.css';
                $this->data['footer']['js'][] = 'plugins/chosen/chosen.jquery.js';
                $this->data['footer']['js'][] = 'plugins/dropzone/dropzone.js';
                $this->data['footer']['script'] = "
                    Dropzone.options.dropzoneForm = {
                    paramName: \"file\", // The name that will be used to transfer the file
                    maxFilesize: 2, // MB
                    acceptedFiles: 'image/*',
                    maxFiles: 4,
                    dictDefaultMessage: \"<strong>Drop files here or click to upload. </strong><br> size must be < 2mb\"
                    };
                        $('.chosen-select').chosen({width: \"100%\"});
                ";
                $this->data['url'] = base_url('admin/user/create');
                $userGroup = new M_user_group();
                $userGroup = $userGroup->getAll('menu', 'user_group_name');
                $this->data['user_group'] = $userGroup;
                $this->load->helper('form');
                $this->template->load('template/master', 'page/admin/v_user_edit', $this->data);
            } else {
                $data = $this->input->post();
                $admin_user_id = $data['admin_user_id'];
                $unlink = $this->session->userdata('unlink_user_edit_img');
                foreach ($unlink as $link) {
                    if( is_file($link)){
                        unlink($link);
                    }
                }
                $this->session->set_userdata('unlink_user_edit_img',[]);
                $user = new M_admin_user();
                if ($sessioUserImage = $this->session->userdata('user_edit_img')) {
                    $user->setUserImg($sessioUserImage);
                }
                $user->setData($data);
                $user->save();
                redirect('admin/user', 'userList');
            }
        }

    }


    public function uploadImg()
    {
        $sessionUserImage = $this->session->userdata('user_edit_img');
        $fieldname = 'file';
        $this->load->library('upload');
        //upload img
        $config['upload_path'] = './public/img/users';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = 2048000;
        $config['max_width'] = 1024;
        $config['max_height'] = 768;
        $config['encrypt_name'] = TRUE;
        $this->upload->initialize($config);
        if ($this->upload->do_upload($fieldname)) {
            $upload = $this->upload->data();
            if ($sessionUserImage && is_file('public/img/users/' . $sessionUserImage)) {
                $unlink = $this->session->userdata('unlink_user_edit_img');
                $unlink[] = 'public/img/users/' . $sessionUserImage;
                $this->session->set_userdata('unlink_user_edit_img', $unlink);
            }
            $this->session->set_userdata('user_edit_img', $upload['file_name']);
            echo 'Done';
        } else {
            echo $this->upload->display_errors();
        }
    }
}
