<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MY_Controller {

	public function index()
	{

        $this->loadingData['data']['foot'][]='bower_components/morrisjs/morris.js';
        $this->loadingData['data']['foot'][]='js/dashboard1.js';
	    $this->loadingData['data']['title']="Tổng quan";
        $this->loadingData['data']['breadcrumb'] = [
            ['Tổng quan',base_url('admin/dashboard/index')]
        ];
        $this->template->load('template/master', 'page/admin/v_dashboard',$this->loadingData);
	}
}
