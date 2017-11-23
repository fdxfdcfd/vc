<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_catalog_category extends MY_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->_tableName = "catalog_category";
        $this->_entityId = "entity_id";
    }
}