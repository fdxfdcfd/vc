<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_user_group extends MY_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->_tableName = 'user_group';
        $this->_entityId = 'user_group_id';
    }
}