<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_admin_user');
        $this->loadingData['data']['foot']['js'][]="js/admin_user_form.js";
    }

    public function userList()
    {
        $this->data['title'] = "Quản lý thành viên";
        $this->data['breadcrumb'] = [
            'Home'=> base_url('admin/dashboard/index'),
            'Quản lý thành viên'=> base_url('admin/user/userList')
        ];
        $this->data['users'] = $this->M_admin_user->getAll();
        $this->template->load('template/master', 'page/admin/v_user_list', $this->data);
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
                $this->data['title'] = "Chỉnh sửa Thông tin thành viên";
                $this->data['breadcrumb'] = [
                    'Home'=> base_url('admin/dashboard/index'),
                    'Quản lý thành viên'=> base_url('admin/user/userList'),
                    'Chỉnh sửa Thông tin thành viên'=> base_url('admin/user/edit/id/') . $id,

                ];
                $this->data['url']= base_url('admin/user/edit/id/').$id;
                $this->data['urlUpload']= base_url('admin/user/uploadImg/id/').$id;
                $user = $this->M_admin_user->load($id,'array');
                $this->data['user']= $user;

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
                    maxFiles: 1,
                    init: function() {
                    this.on('success', function( file, resp ){
                    alert(resp);
                        });
                      },
                    dictDefaultMessage: \"<strong>Drop files here or click to upload. </strong><br> size must be < 2mb\"
                    };
                        $('.chosen-select').chosen({width: \"100%\"});
                ";
                $this->template->load('template/master', 'page/admin/v_user_edit', $this->data);
            }else{
                redirect('admin/user','dashboard');
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
                $user['user_img'] = $_FILES['user_img']['tmp_name'];
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
                    maxFiles: 1,
                    init: function() {
                    this.on('success', function( file, resp ){
                    alert(resp);
                        });
                      },
                    dictDefaultMessage: \"<strong>Drop files here or click to upload. </strong><br> size must be < 2mb\"
                    };
                        $('.chosen-select').chosen({width: \"100%\"});
                ";
                $this->template->load('template/master', 'page/admin/v_user_edit', $this->data);
            } else {
                $data = $this->input->post();
                $admin_user_id = $data['admin_user_id'];
                $defaultImg=false;
                if(is_uploaded_file($_FILES['user_img']['tmp_name'])){
                    //upload img
                    $resultUpload=$this->uploadImg('user_img');
                }else{
                    $defaultImg=true;
                    $resultUpload['result']=false;
                }
                if ($resultUpload['result'] || $defaultImg) {
                    $oldImg = $this->M_admin_user->load($admin_user_id)->user_img;
                    if($defaultImg){
                        if(isset($oldImg)){
                            $data['user_img']=$oldImg;
                        }else
                        $data['user_img'] = 'default-user-image.png';
                    }else{
                        $imgData = array('upload_data' => $this->upload->data());
                        $data['user_img'] = $imgData['upload_data']['file_name'];
                    }

                    if ($data['user_img'] != $oldImg) {
                        unlink('public/images/users/' . $oldImg);
                    }
                    unset($data['admin_user_id']);
                    $this->M_admin_user->update($data, $admin_user_id);
                    $currentUser= $this->getCurrentUserData();
                    if($admin_user_id == $currentUser['admin_user_id']){
                        $currentUser['user_img']= $data['user_img'];
                        $this->setCurrentUserData($currentUser);
                    }
                    redirect('admin/user', 'userList');
                }else{
                    $id = $this->uri->segment(5);
                    $this->data['title'] = "Chỉnh sửa Thông tin thành viên";
                    $this->data['breadcrumb'] = [
                        'Home'=> base_url('admin/dashboard/index'),
                        'Quản lý thành viên'=> base_url('admin/user/userList'),
                        'Chỉnh sửa Thông tin thành viên'=> base_url('admin/user/edit/id/') . $id,

                    ];
                    $this->data['url']= base_url('admin/user/edit/id/').$id;
                    $user = $this->input->post();
                    $user['user_img'] = $_FILES['user_img']['tmp_name'];
                    $this->data['user'] = $user;

                    $this->load->model('M_user_group');
                    $userGroup = $this->M_user_group->getAll('menu','user_group_name');
                    $this->data['user_group'] = $userGroup;
                    $this->data['upload_error'] =$resultUpload['message'];
                    $this->load->helper('form');
                    $this->data['header']['css'][]='plugins/dropzone/dropzone.css';
                    $this->data['header']['css'][]='plugins/chosen/chosen.css';
                    $this->data['footer']['js'][]='plugins/chosen/chosen.jquery.js';
                    $this->data['footer']['js'][]='plugins/dropzone/dropzone.js';
                    $this->data['footer']['script']="
                    Dropzone.options.dropzoneForm = {
                    paramName: \"file\", // The name that will be used to transfer the file
                    maxFilesize: 2, // MB
                    dictDefaultMessage: \"<strong>Drop files here or click to upload. </strong><br> size must be < 2mb\"
                    };
                        $('.chosen-select').chosen({width: \"100%\"});
                ";
                    $this->template->load('template/master', 'page/admin/v_user_edit', $this->data);

                }
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
        $fieldname='file';
        $id =   $id = $this->uri->segment(5);
        $user = new M_admin_user();
        $user->load($id);
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
            var_dump($user->getData());
            $user->setUserImg($upload['file_name']);
            var_dump($user->getData());die;
            $user->save();
        } else {
            var_dump($this->upload->display_errors());
            return ['result' => false, 'message' => $this->upload->display_errors()];
        }
    }


}
