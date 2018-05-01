<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_catalog_product extends MY_Model
{
    const DEFAULT_IMG_NAME ='default_product.jpg';

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
    protected $_description = null;

    public function __construct()
    {
        parent::__construct();
        $this->_tableName = "catalog_product";
        $this->_entityId = "entity_id";
    }
    public function getRelatedProduct(){
        $arrayWhere = array('pl.product_id' => $this->getEntityId(), 'main.is_active' => 1);
        $this->db->select('*');
        $this->db->from('catalog_product_link as pl');
        $this->db->join($this->_tableName.' as main', 'main.entity_id = pl.link_product');
        $this->db->where($arrayWhere);
        $query =$this->db->get();
        if($query->num_rows()){
            $data= $query->result_array();
            $query->free_result();
            foreach ($data as $key=>$dt){
                $this->db->select('product_img_name');
                $this->db->from('catalog_product_img');
                $this->db->where('product_id',$dt['entity_id']);
                $this->db->limit(1);
                $query =$this->db->get();
                if($query->num_rows()) {
                    $data[$key]['product_img'] = $query->row_array()['product_img_name'];
                }else{
                    $data[$key]['product_img'] = self::DEFAULT_IMG_NAME;
                }
            }
            return $data;
        }

        return false;

    }

}