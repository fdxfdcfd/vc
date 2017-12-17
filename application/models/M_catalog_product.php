<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_catalog_product extends MY_Model
{
    protected $_entity_id = null;
    protected $_product_name = null;
    protected $_product_category_ids = null;
    protected $_content = null;
    protected $_price = null;
    protected $_product_type = null;
    protected $_qty = null;
    protected $_is_instock = null;
    protected $_created_at = null;
    protected $_updated_at = null;
    protected $_sku = null;
    protected $_is_active = null;


    public function __construct()
    {
        parent::__construct();
        $this->_tableName = "catalog_product";
        $this->_entityId = "entity_id";
    }
    public function saveProductImg($imgName){
        $tableImg= 'catalog_product_img';
        $data = array(
            'product_id' => $this->getEntityId() ,
            'product_img_name' => $imgName
        );
        $this->db->insert($tableImg, $data);
    }
    public function deleteProductImg($productId,$imgName){

    }

}