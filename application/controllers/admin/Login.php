<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_admin_user');
        if($this->isLoggedIn() && $this->router->fetch_method()!='logoutPost'){
            redirect('admin/dashboard','index');
        }
    }

    public function index()
    {
        $user = new M_admin_user();
        var_dump($user->load(1));die;
        $this->data['title'] = "Login";
        $this->load->view('page/admin/v_login', $this->data);
    }

    public function login()
    {
        //check current load view or post
        if($this->input->post()){
            // load form helper and validation library
            $this->load->helper('form');
            $this->load->library('form_validation');

            // set validation rules
            $this->form_validation->set_rules('username', 'Username', 'required');
            $this->form_validation->set_rules('password', 'Password', 'required');

            if ($this->form_validation->run() == false) {

                // validation not ok, send validation errors to the view
                $this->data['title'] = "Login";
                $this->load->view('page/admin/v_login', $this->data);

            } else {
                $dataLogin = $this->input->post();
                if ($this->M_admin_user->authenticateUserLogin($dataLogin['username'], 'password')) {

                    $user_id = $this->user_model->get_user_id_from_username($username);
                    $user    = $this->user_model->get_user($user_id);

                    // set session user datas
                    $_SESSION['user_id']      = (int)$user->id;
                    $_SESSION['username']     = (string)$user->username;
                    $_SESSION['logged_in']    = (bool)true;
                    $_SESSION['is_confirmed'] = (bool)$user->is_confirmed;
                    $_SESSION['is_admin']     = (bool)$user->is_admin;

                    // user login ok
                    $this->load->view('header');
                    $this->load->view('user/login/login_success', $data);
                    $this->load->view('footer');

                } else {

                    // login failed
                    $data->error = 'Wrong username or password.';

                    // send error to the view
                    $this->load->view('header');
                    $this->load->view('user/login/login', $data);
                    $this->load->view('footer');

                }

            }
        }else{ //redirect to index
            redirect('admin/login','index');
    }

    }
    public function logoutPost(){
        $this->session->unset_userdata('currentUser');
        redirect('/admin/login', 'index');
    }
}
