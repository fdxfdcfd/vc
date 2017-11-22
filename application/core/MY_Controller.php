<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller
{
    public $data;

    public function __construct()
    {
        parent::__construct();
        $this->data['title']= "VietCaD";
        $this->data['head']= [];
        $this->data['footer']= [];
        $this->data['leftNav']= $this->getUserMenu();
        $this->data['topNav']= [];
        $this->data['botNav']= [];
    }
    protected function isLoggedIn(){
        $user = $this->session->userdata('currentUser');
        return isset($user);
    }
    protected function getMenuAdmin($userGroupId){
        $this->load->model('M_admin_menu');
        return $this->M_admin_menu->getMenuAdmin($userGroupId);
    }
    public function getCurrentUserData($field = null){
        if($field){
            return  $this->session->userdata('currentUser')[$field];
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