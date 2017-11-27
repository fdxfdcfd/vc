<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller
{
    public $data;

    public function __construct()
    {
        parent::__construct();
        $currentController= $this->router->fetch_class();
        if(!$this->getCurrentUserData('admin_user_id') && $currentController != 'login'){
           redirect('admin/login','index');
        }
        $this->data['title']= "VietCaD";
        $this->data['header']['css']= [];
        $this->data['footer']['js']= [];
        $this->data['footer']['script']= '';
        $this->data['leftNav']= $this->getUserMenu();
        $this->data['topNav']= [];
        $this->data['botNav']= [];
    }
    protected function isLoggedIn(){
        if($this->getCurrentUserData('admin_user_id')){
            return true;
        }else{
            return false;
        }
    }
    protected function getMenuAdmin($userGroupId){
        $this->load->model('M_admin_menu');
        return $this->M_admin_menu->getMenuAdmin($userGroupId);
    }
    public function getCurrentUserData($field = null){
        if($field){
            if(isset($this->session->userdata('currentUser')[$field])){
                return $this->session->userdata('currentUser')[$field];
            }else{
                return false;
            }
        }
        return $this->session->userdata('currentUser');
    }
    public function setCurrentUserData($data = array()){
        return $this->session->set_userdata('currentUser',$data);
    }

    public function getUserMenu(){
        $this->load->model('M_admin_menu');
        return $this->M_admin_menu->getMenuAdmin($this->getCurrentUserData('user_group_id'));
    }
}