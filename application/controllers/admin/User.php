<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_admin_user');
    }

    public function userList()
    {
        $this->loadingData['data']['title']="Quản lý thành viên";
        $this->loadingData['data']['breadcrumb'] = [
            ['Home',base_url('admin/dashboard/index')],
            ['Quản lý thành viên',base_url('admin/user/userList')]
        ];
        $this->loadingData['users']= $this->M_admin_user->getAllUser();
        $this->template->load('template/master', 'page/admin/v_user_list',$this->loadingData);
    }
    public function deletePost($field, $id){
        $this->M_admin_user->delete($id);
        redirect('admin/user/','userList');
    }


}
