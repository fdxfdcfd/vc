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

    protected $_data;

    /**
     * MY_Model constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    private function getData($field = null){
        if($field){
            return $this->_data['_'.$field];
        }
        return $this->_data;
    }
    private function setData($data){
        foreach ($data as $key=>$value) {
            $this->_data[$key] = $value;
        }
        return true;
    }

    private function addData($data){
        return $this->_data=$data;
    }

    public function save(){
        if($this->_data[$this->_entityId]){
            $this->db->where($this->_entityId, $this->_data[$this->_entityId]);
            return  $this->db->update($this->_tableName, $this->_data);
        }else{
            return $this->db->insert($this->_tableName, $this->_data);
        }
    }

    /**
     * load object by id
     * @param $entityId
     * @return mixed
     */
    public function load($entityId, $type= 'object')
    {
        if($entityId){
            $query = $this->db->get_where($this->_tableName, array($this->_entityId => $entityId));
            if($query->num_rows()){
                $this->setData($query->row_array());
            }
            if($type == 'object'){
                return $query->row();
            }else{
                return $query->row_array();
            }
        }
        return false;
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

    public function getAll($type = null, $value = null, $limit = 10 , $start = 0){
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
    public function getTotal($type = null, $value = null){
        return $this->db->get($this->_tableName)->num_rows();
    }

    public function getCurrentPageRecords($limit, $start)
    {
        $this->db->limit($limit, $start);
        $query = $this->db->get($this->_tableName);

        if ($query->num_rows() > 0)
        {
            foreach ($query->result() as $row)
            {
                $data[] = $row;
            }
            return $data;
        }
        return false;
    }


    protected function camelToSnake($input) {
        preg_match_all('!([A-Z][A-Z0-9]*(?=$|[A-Z][a-z0-9])|[A-Za-z][a-z0-9]+)!', $input, $matches);
        $ret = $matches[0];
        foreach ($ret as &$match) {
            $match = $match == strtoupper($match) ? strtolower($match) : lcfirst($match);
        }
        return implode('_', $ret);
    }

    protected function snakeToCamel($input, $capitalizeFirstCharacter = true){
        $str = lcfirst(implode('', array_map('ucfirst', explode('_', $input))));
        if ($capitalizeFirstCharacter) {
            $str[0] = strtoupper($str[0]);
        }
        return $str;
    }

    public function __call($name, $arguments)
    {
        $allFunc= $this->getAllGS();
        if(!(strpos($name, 'get')=== false )){
            return $this->{substr($this->camelToSnake($name),3)};
        }
        if(!(strpos($name, 'set')=== false )){
            if($name == 'setData'){
                $this->setData($arguments[0]);
                $this->syncDataToObject();
                return true;
            }else{
                $this->{'_'.substr($this->camelToSnake($name),3)} = $arguments[0] ;
                $this->syncObjectToData();
                return true;
            }
        }
    }

    protected function syncDataToObject(){
        $allVar= $this->getAllVar();
        foreach ($allVar as $key=>$value){
            $this->{$key}= $this->_data[substr($key,1)];
        }
    }
    protected function syncObjectToData(){
        $allVar= $this->getAllVar();
        foreach ($allVar as $key=>$value){
            $k= substr($key,1);
            $this->_data[$k]=$this->{'get'.$this->snakeToCamel($key)}();
        }
    }
    protected function getAllVar(){
        $allVar= get_object_vars($this);
        unset($allVar['_tableName']);
        unset($allVar['_entityId']);
        unset($allVar['_createAtColumn']);
        unset($allVar['_updatedAtColumn']);
        unset($allVar['_data']);
        return $allVar;
    }

    protected function getAllGS(){
        $allVar= get_object_vars($this);
        unset($allVar['_tableName']);
        unset($allVar['_entityId']);
        unset($allVar['_createAtColumn']);
        unset($allVar['_updatedAtColumn']);
        unset($allVar['_data']);
        $allFunc=[];
        foreach ($allVar as $key=>$value){
            $allFunc[] ='get'.$this->snakeToCamel($key);
        }
        foreach ($allVar as $key=>$value){
            $allFunc[] ='set'.$this->snakeToCamel($key);
        }
        return $allFunc;
    }
}
