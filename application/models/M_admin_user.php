<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_admin_user extends MY_Model
{
    public $table = 'admin_user';
    public $primary_key = 'user_id';
    public $fillable = array(); // If you want, you can set an array with the fields that can be filled by insert/update
    public $protected = array(); // ...Or you can set an array with the fields that cannot be filled by insert/update
    public function __construct()
    {
        parent::__construct();
        $this->has_one['user_group'] = array('foreign_model'=>'M_user_group','foreign_table'=>'user_group','foreign_key'=>'user_group_id','local_key'=>'user_group_id');
    }

    public function login($username,$password){
        $passhash= md5($password);
        $user = $this->get(array('username'=>$username,'password'=>$passhash));
        if($user){
            return $user;
        }else{
            return false;
        }

    }
    public function getAllUser(){

        $this->db->select('admin_user.user_id, admin_user.firstname, admin_user.lastname,admin_user.email, user_group.user_group_name');
        $this->db->from('admin_user');
        $this->db->join('user_group', 'admin_user.user_group_id = user_group.user_group_id');
        $query = $this->db->get();
        return $query->result_array();
//            $this->fields(array('admin_user.user_id', 'admin_user.firstname', 'admin_user.lastname','admin_user.email'))
//            ->with_user_group(array('fields'=>'user_group_name'))
//            ->as_array()
//            ->get_all();
    }

}