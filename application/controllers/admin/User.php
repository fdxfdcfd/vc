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
        $this->loadingData['data']['title'] = "Quản lý thành viên";
        $this->loadingData['data']['breadcrumb'] = [
            ['Home', base_url('admin/dashboard/index')],
            ['Quản lý thành viên', base_url('admin/user/userList')]
        ];
        $this->loadingData['users'] = $this->M_admin_user->getAllUser();
        $this->template->load('template/master', 'page/admin/v_user_list', $this->loadingData);
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
                $this->loadingData['data']['title'] = "Chỉnh sửa Thông tin thành viên";
                $this->loadingData['data']['breadcrumb'] = [
                    ['Home', base_url('admin/dashboard/index')],
                    ['Quản lý thành viên', base_url('admin/user/userList')],
                    ['Chỉnh sửa Thông tin thành viên', base_url('admin/user/edit/id/') . $id],

                ];
                $this->loadingData['data']['url']= base_url('admin/user/edit/id/').$id;
                $user = $this->M_admin_user->as_array()->get($id);
                $this->loadingData['data']['user'] = $user;

                $this->load->model('M_user_group');
                $userGroup = $this->M_user_group->as_dropdown('user_group_name')->get_all();
                $this->loadingData['data']['user_group'] = $userGroup;
                $this->load->helper('form');
                $this->template->load('template/master', 'page/admin/v_user_edit', $this->loadingData);
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
                $this->loadingData['data']['title'] = "Chỉnh sửa Thông tin thành viên";
                $this->loadingData['data']['breadcrumb'] = [
                    ['Home', base_url('admin/dashboard/index')],
                    ['Quản lý thành viên', base_url('admin/user/userList')],
                    ['Chỉnh sửa Thông tin thành viên', base_url('admin/user/edit/id/') . $id],

                ];
                $this->loadingData['data']['url']= base_url('admin/user/edit/id/').$id;
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
                $defaultImg=false;
                if(is_uploaded_file($_FILES['user_img']['tmp_name'])){
                    //upload img
                    $resultUpload=$this->uploadImg('user_img');
                }else{
                    $defaultImg=true;
                    $resultUpload['result']=false;
                }
                if ($resultUpload['result'] || $defaultImg) {
                    $oldImg = $this->M_admin_user->get($user_id)->user_img;
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
                        ['Chỉnh sửa Thông tin thành viên',base_url('admin/user/edit/id//').$id],

                    ];
                    $this->loadingData['data']['url']= base_url('admin/user/edit/id//').$id;
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
                $id = $user['user_id'];
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
                    unset($data['user_id']);
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
