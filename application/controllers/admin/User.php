<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_admin_user');
        $this->load->library('pagination');
        $this->loadingData['data']['foot']['js'][]="js/admin_user_form.js";
    }

    public function userList()
    {
        // init params
        $user = new M_admin_user();
        $params = array();
        $limit_per_page = 10;
        $start_index = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        $total_records = $user->getTotal();

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


            $config['base_url'] = base_url() . 'admin/user/userlist/';
            $config['total_rows'] = $total_records;
            $config['per_page'] = $limit_per_page;
            $config["uri_segment"] = 4;

            $this->pagination->initialize($config);

            // build paging links
            $this->data['link'] = $this->pagination->create_links();
        }


        $this->data['title'] = "Quản lý thành viên";
        $this->data['footer']['js'][]= 'plugins/bootbox/bootbox.min.js';
        $this->data['breadcrumb'] = [
            'Home'=> base_url('admin/dashboard/index'),
            'Quản lý thành viên'=> base_url('admin/user/userList')
        ];
        $userGroup = $this->M_user_group->getAll('menu','user_group_name');
        $this->data['user_group'] = $userGroup;
        $this->data['users'] = $user->getCollection(null,null,'*',$limit_per_page, $start_index);
        $this->template->load('template/master', 'page/admin/v_user_list', $this->data);
    }

    public function deletePost($field, $id)
    {
        $user = new M_admin_user();
        $user->load($id);
        $user->delete();
        redirect('admin/user/', 'userList');
    }

    public function edit()
    {
        if (!$this->input->post()) {
            $id = $this->uri->segment(5);
            if (isset($id)) {
                $this->data['title'] = "Chỉnh sửa Thông tin thành viên";
                $this->data['breadcrumb'] = [
                    'Home'=> base_url('admin/dashboard/index'),
                    'Quản lý thành viên'=> base_url('admin/user/userList'),
                    'Chỉnh sửa Thông tin thành viên'=> base_url('admin/user/edit/id/') . $id,
                ];
                $this->data['url']= base_url('admin/user/edit/id/').$id;
                $this->data['urlUpload']= base_url('admin/user/uploadImg/id/').$id;
                $user = new M_admin_user();
                $user->load($id,'array');
                $this->data['user']= $user->getData();
                if ($user->getData('user_img')) {
                    $this->session->set_userdata('user_edit_img', $user->getData('user_img'));
                }

                $this->load->model('M_user_group');
                $userGroup = $this->M_user_group->getAll('menu','user_group_name');
                $this->data['user_group'] = $userGroup;
                $this->load->helper('form');
                $this->data['header']['css'][]='plugins/dropzone/dropzone.css';
                $this->data['header']['css'][]='plugins/chosen/chosen.css';
                $this->data['footer']['js'][]='plugins/chosen/chosen.jquery.js';
                $this->data['footer']['js'][]='plugins/dropzone/dropzone.js';
                $this->data['footer']['script']="
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
            $this->form_validation->set_rules($config);

            if ($this->form_validation->run() == FALSE) {
                $id = $this->uri->segment(5);
                $this->data['title'] = "Chỉnh sửa Thông tin thành viên";
                $this->data['breadcrumb'] = [
                    'Home'=> base_url('admin/dashboard/index'),
                    'Quản lý thành viên'=> base_url('admin/user/userList'),
                    'Chỉnh sửa Thông tin thành viên'=> base_url('admin/user/edit/id/') . $id,

                ];
                $this->data['url']= base_url('admin/user/edit/id/').$id;
                $this->data['urlUpload']= base_url('admin/user/uploadImg/id/').$id;
                $user = $this->input->post();
                $this->data['user'] = $user;
                $this->load->model('M_user_group');
                $userGroup = $this->M_user_group->getAll('menu','user_group_name');
                $this->data['user_group'] = $userGroup;
                $this->load->helper('form');
                $this->data['header']['css'][]='plugins/dropzone/dropzone.css';
                $this->data['header']['css'][]='plugins/chosen/chosen.css';
                $this->data['footer']['js'][]='plugins/chosen/chosen.jquery.js';
                $this->data['footer']['js'][]='plugins/dropzone/dropzone.js';
                $this->data['footer']['script']="
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
                if($admin_user_id){
                    $user= new M_admin_user();
                    $user->load($admin_user_id);
                    if($sessioUserImage= $this->session->userdata('user_edit_img')){
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
                $this->loadingData['data']['title'] = "Thêm Thành viên";
                $this->loadingData['data']['breadcrumb'] = [
                    ['Home', base_url('admin/dashboard/index')],
                    ['Quản lý thành viên', base_url('admin/user/userList')],
                    ['Thêm thành viên', base_url('admin/user/create')],
                ];
                $this->loadingData['data']['user'] = [];
            $this->loadingData['data']['url']= base_url('admin/user/create');
                $this->load->model('M_user_group');
                $userGroup = $this->M_user_group->as_dropdown('user_group_name')->get_all();
                $this->loadingData['data']['user_group'] = $userGroup;
                $this->load->helper('form');
                $this->template->load('template/master', 'page/admin/v_user_edit', $this->loadingData);

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
                $user = $this->input->post();
                $id = $user['admin_user_id'];
                $this->loadingData['data']['title'] = "Chỉnh sửa Thông tin thành viên";
                $this->loadingData['data']['breadcrumb'] = [
                    ['Home', base_url('admin/dashboard/index')],
                    ['Quản lý thành viên', base_url('admin/user/userList')],
                    ['Chỉnh sửa Thông tin thành viên', base_url('admin/user/edit/id/') . $id],

                ];
                $this->loadingData['data']['url']= base_url('admin/user/create');
                $user['user_img'] = $_FILES['user_img']['tmp_name'];
                $this->loadingData['data']['user'] = $user;

                $this->load->model('M_user_group');
                $userGroup = $this->M_user_group->as_dropdown('user_group_name')->get_all();
                $this->loadingData['data']['user_group'] = $userGroup;
                $this->load->helper('form');
                $this->template->load('template/master', 'page/admin/v_user_edit', $this->loadingData);
            } else {
                $data = $this->input->post();
                $defaultImg=false;
                if(is_uploaded_file($_FILES['user_img']['tmp_name'])){
                    //upload img
                    $resultUpload=$this->uploadImg('user_img');
                }else{
                    $defaultImg=true;
                    $resultUpload['result']=false;
                }
                if ($resultUpload['result'] || $defaultImg) {
                    if($defaultImg){
                        $data['user_img'] = 'default-user-image.png';
                    }else{
                        $imgData = array('upload_data' => $this->upload->data());
                        $data['user_img'] = $imgData['upload_data']['file_name'];
                    }
                    unset($data['admin_user_id']);
                    $data['password']=md5($data['password']);
                    $this->M_admin_user->insert($data);
                    $currentUser= $this->getCurrentUserData();
                    redirect('admin/user', 'userList');
                }else{
                    $id = $this->uri->segment(5);
                    $this->loadingData['data']['title']="Chỉnh sửa Thông tin thành viên";
                    $this->loadingData['data']['breadcrumb'] = [
                        ['Home',base_url('admin/dashboard/index')],
                        ['Quản lý thành viên',base_url('admin/user/userList')],
                        ['Chỉnh sửa Thông tin thành viên',base_url('admin/user/edit/id/').$id],

                    ];
                    $user= $this->input->post();
                    $this->loadingData['data']['url']= base_url('admin/user/create');
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


    public function uploadImg()
    {
        $sessioUserImage= $this->session->userdata('user_edit_img');
        $fieldname='file';
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
            $upload= $this->upload->data();
            if($sessioUserImage && is_file('public/img/users/' . $sessioUserImage)){
                unlink('public/img/users/' . $sessioUserImage);
            }
            $this->session->set_userdata('user_edit_img',$upload['file_name']);
            echo 'Done';
        } else {
            echo $this->upload->display_errors();
        }
    }
}
