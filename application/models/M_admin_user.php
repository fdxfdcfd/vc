<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_admin_user extends MY_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->_tableName = "admin_user";
        $this->_entityId = "user_id";
    }

    public function authenticateUserLogin($username,$password){


    }

}