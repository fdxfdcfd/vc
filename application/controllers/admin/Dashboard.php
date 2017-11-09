<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MY_Controller {

	public function index()
	{
        $this->template->load('template/master', 'page/admin/dashboard',$this->loadingData);
	}
}
