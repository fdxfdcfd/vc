<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_catalog_product extends MY_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->_tableName = "catalog_product";
        $this->_entityId = "product_id";
    }

}