<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MY_Controller {

	public function index()
	{
	    $this->data['title']="Tổng quan";
        $this->data['breadcrumb'] = [
            ['Tổng quan',base_url('admin/dashboard/index')]
        ];
        $this->template->load('template/admin/master', 'page/admin/v_dashboard',$this->data);
	}
}
