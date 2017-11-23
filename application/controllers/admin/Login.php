<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_admin_user');

        if ($this->isLoggedIn() && !$this->router->fetch_class() == 'logout' ) {
            redirect('admin/dashboard', 'index');
        }
    }

    public function index()
    {
        $user = new M_admin_user();
        $this->data['title'] = "Login";
        $this->load->view('page/admin/v_login', $this->data);
    }

    public function login()
    {
        //check current load view or post
        if ($this->input->post()) {
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
                if ($this->M_admin_user->authenticateUserLogin($dataLogin['username'], $dataLogin['password'])) {

                    $userData = $this->M_admin_user->getAdminUserByUsername($dataLogin['username']);

                    // set session user datas
                    $data = [
                        'currentUser' => [
                            'admin_user_id' => $userData->admin_user_id,
                            'username' => $userData->username,
                            'email' => $userData->email,
                            'firstname' => $userData->firstname,
                            'lastname' => $userData->lastname,
                            'name' => $userData->firstname . " " . $userData->lastname,
                            'user_group_id' => $userData->user_group_id,
                            'user_img' => $userData->user_img,
                            'position' =>$userData->position,
                            'logged_in' => true
                        ]];
                    $this->session->set_userdata($data);

                    // user login ok
                    redirect('/admin/dashboard', 'index');

                } else {
                    // login failed
                    $this->data['error'] = 'Wrong username or password.';

                    // send error to the view
                    $this->load->view('page/admin/v_login', $this->data);
                }
            }
        } else { //redirect to index
            redirect('admin/login', 'index');
        }

    }

    public function logout()
    {
        $this->session->unset_userdata('currentUser');
        redirect('/admin/login', 'index');
    }
}
