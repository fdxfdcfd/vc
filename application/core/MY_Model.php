<?php defined('BASEPATH') OR exit('No direct script access allowed');


class MY_Model extends CI_Model
{
    /**
     * table name
     * @var string
     */
    protected $_tableName;

    /**
     * entity_id column
     * @var string
     */
    protected $_entityId = "entity_id";

    /**
     * created_at column
     * @var string
     */
    protected $_createAtColumn = "created_at";

    /**
     * updated_at column
     * @var string
     */
    protected $_updatedAtColumn = "updated_at";

    /**
     * MY_Model constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        //result_array();
    }

    /**
     * load object by id
     * @param $entityId
     * @return mixed
     */
    public function load($entityId)
    {
        $query = $this->db->get_where($this->_tableName, array($this->_entityId => $entityId));
        return $query->row();
    }

    /**
     * delete object by id
     * @param $entityId
     * @return mixed
     */
    public function delete($entityId)
    {
        return $this->db->delete($this->_tableName, array($this->_entityId => $entityId));
    }

    public function getCollection($where = null, $join = null, $select = ['*'])
    {
        $this->db->select(implode(",", $select));
        $this->db->from($this->_tableName);
        if ($join) {
            $this->db->join($join[0], $join[1]);
        }
        if ($where) {
            foreach ($where as $key => $value) {
//                if(isset($condition['type']) && $condition['type']=='or'){
//                    unset($condition['type']);
//                    $this->db->or_where($condition);
//                }
                if(is_array($value)){
                    $this->db->where_in($key,$value);
                }else{
                    $this->db->where($key,$value);
                }
            }
        }
        return $this->db->get()->result();
    }
    public function getAll($type = null, $value = null){
        if($type == 'array'){
            return $this->db->get($this->_tableName)->result_array();
        }
        if($type == 'menu' && $value){
            $result =  $this->db->get($this->_tableName)->result();
            $arrResult= [];
            foreach ($result as $r){
                $arrResult[$r->{$this->_entityId}]= $r->{$value};
            }
            return $arrResult;
        }
        return $this->db->get($this->_tableName)->result();
    }
}
