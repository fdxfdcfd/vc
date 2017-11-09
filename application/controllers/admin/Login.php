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
        $this->loadingData['data']['title'] = "Login";
        $this->load->view('page/admin/v_login', $this->loadingData);
    }

    public function loginPost()
    {
        if ($this->input->post()) {
            $dataPost = $this->input->post();
            if (isset($dataPost['username']) && isset($dataPost['password'])) {
                $user = $this->M_admin_user->login($dataPost['username'], $dataPost['password']);
                if ($user) {
                    $data = [
                        'currentUser'=>[
                        'username' => $user->username,
                        'email' => $user->email,
                        'firstname' => $user->firstname,
                        'lastname' => $user->lastname,
                        'name'=>$user->firstname ." ". $user->lastname,
                        'user_group_id' => $user->user_group_id,
                        'logged_in' => true
                    ]];
                    $this->session->set_userdata($data);
                    redirect('/admin/dashboard', 'index');
                } else {
                    redirect('/admin/login', 'index');
                    "Wrong username or password!";
                }
            }

        }
    }
    public function logoutPost(){
        $this->session->unset_userdata('currentUser');
        redirect('/admin/login', 'index');
    }
}
