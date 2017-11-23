<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_catalog_branch extends MY_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->_tableName = "catalog_branch";
        $this->_entityId = "entity_id";
    }
}