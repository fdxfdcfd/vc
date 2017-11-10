<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller
{
    public $loadingData;

    public function __construct()
    {
        parent::__construct();
        if($this->uri->segment(1)=='admin'){
            $this->loadingData = [
                'data' => [
                    'title' => 'VietCad',
                    'head' => [
                        'css' => [
//                        'bootstrap/dist/css/bootstrap.min.css',
                            'css/animate.css',
                            'css/style.css',
                            'css/colors/blue-dark.css',
                            'bower_components/morrisjs/morris.css',
                            'bower_components/toast-master/css/jquery.toast.css',
                            'bower_components/sidebar-nav/dist/sidebar-nav.min.css'

                        ],
                        'js' => []
                    ],
                    'foot' => [
                        'js' => [
                            'bower_components/sidebar-nav/dist/sidebar-nav.min.js',
                            'js/jquery.slimscroll.js',
                            'js/waves.js',
                            'bower_components/waypoints/lib/jquery.waypoints.js',
                            'bower_components/counterup/jquery.counterup.min.js',
                            'bower_components/raphael/raphael-min.js',
                            'js/custom.min.js',
                            'bower_components/toast-master/js/jquery.toast.js',
                            'js/bootbox.min.js'
                        ]
                    ]
                ]
            ];
            if(!strpos($this->router->fetch_class(),'Post')){
                $this->loadingData['data']['lev_nav']= $this->getMenuAdmin($this->getCurrentUserData()['user_group_id']);
            }
            if(!$this->isLoggedIn() && $this->router->fetch_class() !='login'){
                redirect('admin/login','index');
            }
        }else{

        }

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