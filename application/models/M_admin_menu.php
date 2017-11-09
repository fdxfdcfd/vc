<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_admin_menu extends MY_Model
{
    public $table = 'admin_menu';
    public $primary_key = 'admin_menu_id';
    public $fillable = array(); // If you want, you can set an array with the fields that can be filled by insert/update
    public $protected = array(); // ...Or you can set an array with the fields that cannot be filled by insert/update
    public function __construct()
    {
        parent::__construct();
    }

    public function getMenuAdmin($userGroupId){
        $this->load->model('M_user_group');
        $allow = $this->M_user_group->get($userGroupId);
        $menu= false;
        if ($allow && $allow->user_group_permission){
            $menu=$this->as_array()->get_all('admin_menu_id', explode(',',$allow->user_group_permission));
        }
        if($menu){
            return $menu;
        }else{
            return [];
        }
    }


}