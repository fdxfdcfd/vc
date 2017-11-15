<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller
{
    public $data;

    public function __construct()
    {
        parent::__construct();
        $this->data['title']= "VietCaD";
    }
    protected function isLoggedIn(){
        $user = $this->session->userdata('currentUser');
        return isset($user);
    }
    protected function getMenuAdmin($userGroupId){
        $this->load->model('M_admin_menu');
        return $this->M_admin_menu->getMenuAdmin($userGroupId);
    }
    public function getCurrentUserData(){
        return $this->session->userdata('currentUser');
    }
    public function setCurrentUserData($data = array()){
        return $this->session->set_userdata('currentUser',$data);
    }
}