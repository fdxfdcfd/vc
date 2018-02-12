<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends MY_Controller
{

    public function index()
    {
        $id = $this->uri->segment(4);
        if($id){

            $category = new M_catalog_category();
            $category->load($id);
        }
        $this->data['categories'] =$category;
        $this->template->load('template/master', 'page/v_category', $this->data);
    }
}
