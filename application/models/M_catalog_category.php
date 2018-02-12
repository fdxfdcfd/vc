<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_catalog_category extends MY_Model
{
    protected $_entity_id = null;
    protected $_category_name = null;
    protected $_parent_id = null;
    protected $_category_type = null;
    protected $_content = null;
    protected $_link_outsite = null;
    protected $_level = null;
    protected $_is_anchor = null;
    protected $_order = null;

    public function __construct()
    {
        parent::__construct();
        $this->_tableName = "catalog_category";
        $this->_entityId = "entity_id";
    }

    public function getCategoryTree()
    {
        $root_id = 0;
        $tree='';
        $tmp= $this->getCategoryByParentIdJson(0);
        if(count($tmp)){
            $tree.= $tmp;
        }
        return $tree;
    }

    public function getCategoryByParentIdJson($id)
    {
        $where['eq']['parent_id'][] = $id;
        $tmpCategory = $this->getCollection($where);
        $d=[];
        $tmp = '';
        foreach ($tmpCategory as $c) {
            $tmp.= "{";
            $tmp.= "id: \"cat_$c->entity_id\",";
            $tmp.= "text: \"$c->category_name\"";
            $r= $this->getCategoryByParentIdJson($c->entity_id);
            if(trim($r) != ''){
                $tmp.=",children: [ $r ]";
            }
            $tmp.= "},";
        }
        return $tmp;
    }

    public function getMenuHome(){
        $data = [];
        $data = $this->getMenu(0);
        $data = reset($data);
        return $data;
    }

    public function getMenu($parent = 0){
        $data = [];
        $tmp = $this->getCategoryByParentId($parent);
        if (is_array($tmp) || is_object($tmp)) {
            foreach ($tmp as $t) {
                $data[$t->entity_id]['name'] = $t->category_name;
                $data[$t->entity_id]['child'] = $this->getMenu($t->entity_id);
            }
        }
        return $data;
    }
    protected function getCategoryByParentId($parent = 0){
        $categories = new M_catalog_category();
        $where['eq']['is_active'][] =1;
        $where['eq']['parent_id'][] =$parent;
        $order['order']='asc';
        $query = $categories->getCollection($where,null,'*',null,0,$order);
        if(count($query)){
            return $query;
        }else{
            return false;
        }
    }
}