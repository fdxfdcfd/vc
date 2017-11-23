<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_admin_user extends MY_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->_tableName = "admin_user";
        $this->_entityId = "admin_user_id";
    }

    public function authenticateUserLogin($username,$password){
        $rPassword=  md5($password);
        $query= $this->db->get_where($this->_tableName, array('username' => $username, 'password'=>$rPassword));
        $a= $this->db->last_query();
        if($query->num_rows()){
            return $query->row();
        }else{
            return false;
        }
    }

    public function getAdminUserByUsername($username){
        $query= $this->db->get_where($this->_tableName, array('username' => $username));
        return $query->row();
    }

}