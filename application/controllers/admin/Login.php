<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends MY_Controller {

	public function index()
	{
        $this->loadingData['loadData']['title']="Login";
        $this->load->view('page/admin/login',$this->loadingData);
	}
}
