<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MY_Controller
{

    public function index()
    {
        $this->template->load('template/master', 'page/v_home', $this->data);
    }
}
