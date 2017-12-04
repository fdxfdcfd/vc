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

    public function getCategoryTree()
    {
        $root_id = 0;
        $tree='';
        $tmp= $this->getCategoryByParentId(0);
        if(count($tmp)){
            $tree.= $tmp;
        }
        return $tree;
    }

    public function getCategoryByParentId($id)
    {
        $where[] = [
            'eq' => ['parent_id', $id]
        ];
        $tmpCategory = $this->getCollection($where);
        $d=[];
        $tmp = '';
        foreach ($tmpCategory as $c) {
            $tmp.= "{";
            $tmp.= "id: \"cat_$c->entity_id\",";
            $tmp.= "text: \"$c->category_name\"";
            $r= $this->getCategoryByParentId($c->entity_id);
            if(trim($r) != ''){
                $tmp.=",children: [ $r ]";
            }
            $tmp.= "},";
        }
        return $tmp;
    }
}