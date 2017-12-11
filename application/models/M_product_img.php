<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_product_img extends MY_Model
{

    protected $_product_img_id;
    protected $_product_id;
    protected $_product_img_name;
    protected $_is_default;


    public function __construct()
    {
        parent::__construct();
        $this->_tableName = 'product_img';
        $this->_entityId = 'product_img_id';
    }

    public function loadByProductId($product_id){
        $where[] = ['eq'=>[
           'product_id', $product_id
        ]];
        return $this->getCollection($where);
    }
}