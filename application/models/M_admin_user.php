<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_admin_user extends MY_Model
{
    protected $_admin_user_id = null;
    protected $_firstname = null;
    protected $_lastname = null;
    protected $_email = null;
    protected $_username = null;
    protected $_password = null;
    protected $_created_at = null;
    protected $_updated_at = null;
    protected $_logdate = null;
    protected $_lognum = null;
    protected $_is_active = null;
    protected $_extra = null;
    protected $_rp_token = null;
    protected $_rp_token_created_at = null;
    protected $_failures_num = null;
    protected $_first_failure = null;
    protected $_lock_expires = null;
    protected $_user_group_id = null;
    protected $_user_img = null;
    protected $_position = null;

    public function __construct()
    {
        parent::__construct();
        $this->_tableName = "admin_user";
        $this->_entityId = "admin_user_id";
        $this->syncObjectToData();
    }

    public function authenticateUserLogin($username, $password)
    {
        $rPassword = md5($password);
        $query = $this->db->get_where($this->_tableName, array('username' => $username, 'password' => $rPassword));
        $a = $this->db->last_query();
        if ($query->num_rows()) {
            return $query->row();
        } else {
            return false;
        }
    }

    public function getAdminUserByUsername($username)
    {
        $query = $this->db->get_where($this->_tableName, array('username' => $username));
        return $query->row();
    }
}