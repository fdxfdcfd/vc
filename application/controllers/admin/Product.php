<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_catalog_product');
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
                    ['Chỉnh sửa Thông tin thành viên', base_url('admin/user/edit/id') . $id],

                ];
                $user = $this->M_admin_user->as_array()->get($id);
                $this->loadingData['data']['user'] = $user;

                $this->load->model('M_user_group');
                $userGroup = $this->M_user_group->as_dropdown('user_group_name')->get_all();
                $this->loadingData['data']['user_group'] = $userGroup;
                $this->load->helper('form');
                $this->template->load('template/master', 'page/admin/v_user_edit', $this->loadingData);
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
