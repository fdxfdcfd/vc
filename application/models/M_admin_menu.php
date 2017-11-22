<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_admin_menu extends MY_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->_tableName = 'admin_menu';
        $this->_entityId = 'menu_id';
    }

    public function getMenuAdmin($userGroupId){
        $this->load->model('M_user_group');
        $allow = $this->M_user_group->load($userGroupId);
        $menu= false;
        if ($allow && $allow->user_group_permission){
            $menu=$this->getCollection(
                [
                    'menu_id'=> explode(",",$allow->user_group_permission)
                ]
        );
        }
        if($menu){
            return $menu;
        }else{
            return [];
        }
    }


}