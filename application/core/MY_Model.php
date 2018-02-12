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


    public function save(){
        //add created at + updated at
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $now = date('m/d/Y h:i:s a', time());
        if($this->_data[$this->_entityId]){
            $this->_data[$this->_updatedAtColumn]=$now;
        }else{
            $this->_data[$this->_updatedAtColumn]=$now;
            $this->_data[$this->_createAtColumn]=$now;
        }
        $this->checkDataBeforeSave();
        if($this->_data[$this->_entityId]){
            $this->db->where($this->_entityId, $this->_data[$this->_entityId]);
            return  $this->db->update($this->_tableName, $this->_data);
        }else{
            $result = $this->db->insert($this->_tableName, $this->_data);
            $this->_entity_id= $this->db->insert_id();
            return $result;
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
                $this->syncDataToObject();
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
     * @return bool
     */
    public function delete()
    {
        if($id = $this->{'_'.$this->_entityId}){
            return $this->db->delete($this->_tableName, array($this->_entityId => $id));
        }
        return false;
    }

    /**
     * @param null $where
     * @param null $join
     * @param string $select
     * @param null $limit
     * @param int $start
     * @return mixed
     */
    public function getCollection($where = null, $join = null, $select = '*', $limit = null , $start = 0, $order = null)
    {
        if($limit){
            $this->db->limit($limit, $start);
        }
        $this->db->select($select);
        $this->db->from($this->_tableName);
        if ($join) {
            $this->db->join($join[0], $join[1]);
        }
        if ($where) {
            foreach ($where as $key => $value) {
                if($key==='eq')
                {
                    foreach ($value as $k=>$v) {
                        foreach ($v as $val) {
                            $this->db->where($k, $val);
                        }
                    }
                }
                if($key === 'in'){
                    foreach ($value as $k=>$v) {
                        foreach ($v as $val) {
                            $this->db->where_in($k, $val);// $v is array
                        }
                    }
                }
                if($key === 'nin'){
                    foreach ($value as $k=>$v) {
                        foreach ($v as $val) {
                            $this->db->where_not_in($k, $val);// $v is array
                        }
                    }
                }
                if($key === 'neq'){
                    foreach ($value as $k=>$v) {
                        foreach ($v as $val) {
                            $this->db->where($k.' != ', $val);
                        }
                    }
                }
                if($key === 'like'){
                    foreach ($value as $k=>$v) {
                        foreach ($v as $val) {
                            $this->db->like($k, $val);
                        }
                    }
                }
            }
        }
        if($order){
            foreach ($order as $key=>$value){
                $this->db->order_by($key, $value);
            }
        }
        return  $this->db->get()->result();
    }
    public function getCollectionCount($where = null, $join = null, $select = '*', $limit = null , $start = 0)
    {
        if($limit){
            $this->db->limit($limit, $start);
        }
        $this->db->select($select);
        $this->db->from($this->_tableName);
        if ($join) {
            $this->db->join($join[0], $join[1]);
        }
        if ($where) {
            foreach ($where as $w) {
                $key = key($w);
                $value= $w[$key];
                if($key==='eq')
                {
                    $this->db->where($value[0],$value[1]);
                }
                if($key === 'in'){
                    $this->db->where_in($value[0],$value[1]); // $value[1]= array()
                }
                if($key === 'nin'){
                    $this->db->where_not_in($value[0],$value[1]); // $value[1]= array()
                }
                if($key === 'neq'){
                    $this->db->where($value[0].' != ',$value[1]); // $value[1]= array()
                }
                if($key === 'like'){
                    $this->db->like($value[0],$value[1]); // $value[1]= array()
                }
            }
        }
        return  $this->db->get()->num_rows();
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
    public function getTotal($type = null, $value = null){
        return $this->db->get($this->_tableName)->num_rows();
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
            if($name == 'getData'){
                if(isset($arguments[0])){
                    return$this->getData($arguments[0]);
                }else{
                    return$this->getData();
                }

            }else
            return $this->{substr($this->camelToSnake($name),3)};
        }
        if(!(strpos($name, 'set')=== false )){
            if($name == 'setData'){
                $this->setData($arguments[0]);
                $this->syncDataToObject();
                return true;
            }else{
                $this->{substr($this->camelToSnake($name),3)} = $arguments[0] ;
                $this->syncObjectToData();
                return true;
            }
        }
    }

    private function getData($field = null){
        if($field){
            if(isset($this->_data[$field])){
                return $this->_data[$field];
            }
           return false;
        }
        return $this->_data;
    }
    private function setData($data){
        foreach ($data as $key=>$value) {
            $this->_data[$key] = $value;
        }
        return true;
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
            $this->_data[$k]=$this->{$key};
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
    protected function checkDataBeforeSave(){
        $allVar= get_object_vars($this);
        foreach ($this->_data as $key=>$value){
            if(!isset($allVar["_$key"])){
                unset($this->_data[$key]);
            }
        }
    }
}
