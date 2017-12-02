<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller
{
    /**
     * @var
     */
    public $data;

    /**
     * MY_Controller constructor.
     */
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
        if($currentController != 'login') {
            $this->data['leftNav'] = $this->getUserMenu();
        }
        $this->data['topNav']= [];
        $this->data['botNav']= [];
        $this->data['footer']['messages']['success']= $this->getSuccessMessage();
        $this->data['footer']['messages']['error']= $this->getErrorMessage();
    }

    /**
     * @return bool
     */
    protected function isLoggedIn(){
        if($this->getCurrentUserData('admin_user_id')){
            return true;
        }else{
            return false;
        }
    }

    /**
     * @param $userGroupId
     * @return mixed
     */
    protected function getMenuAdmin($userGroupId){
        $this->load->model('M_admin_menu');
        return $this->M_admin_menu->getMenuAdmin($userGroupId);
    }

    /**
     * @param null $field
     * @return bool
     */
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

    /**
     * @param array $data
     * @return mixed
     */
    public function setCurrentUserData($data = array()){
        return $this->session->set_userdata('currentUser',$data);
    }

    /**
     * @return mixed
     */
    public function getUserMenu(){
        $this->load->model('M_admin_menu');
        return $this->M_admin_menu->getMenuAdmin($this->getCurrentUserData('user_group_id'));
    }

    /**
     * @param $message
     */
    public function addSuccessMessage($message){
        if($this->session->userdata('successMessage')== null){
            $messages = [];
        }else{
            $messages = $this->session->userdata('successMessage');
        }
        $messages[]= $message;
        $this->session->set_userdata('successMessage',$messages);
    }

    public function getSuccessMessage(){
        if($this->session->userdata('successMessage') != null){
            $result = $this->session->userdata('successMessage');
            $this->session->unset_userdata('successMessage');
            return  $result;
        }else{
            return [];
        }
    }

    /**
     * @param $message
     */
    public function addErrorMessage($message){
        if($this->session->userdata('errorMessage')== null){
            $messages = [];
        }else{
            $messages = $this->session->userdata('errorMessage');
        }
        $messages[]= $message;
        $this->session->set_userdata('errorMessage',$messages);
    }

    public function getErrorMessage(){
        if($this->session->userdata('errorMessage') != null){
            $result = $this->session->userdata('errorMessage');
            $this->session->unset_userdata('errorMessage');
            return  $result;
        }else{
            return [];
        }
    }
}