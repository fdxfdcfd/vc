<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller
{
    public $loadingData;

    public function __construct()
    {
        parent::__construct();
        $this->loadingData = [
            'loadData' => [
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
                        'bower_components/morrisjs/morris.js',
                        'js/custom.min.js',
                        'js/dashboard1.js',
                        'bower_components/toast-master/js/jquery.toast.js'
                    ]
                ]
            ]
        ];
    }
    public function redirectLogin(){
        $controller = $this->uri->segment(1);
        if(isset($controller) != 'login'){
            if(!$this->checkLogin()){
                redirect('admin/login');
            }
        }
    }
    protected function checkLogin(){

        return true;
    }
}