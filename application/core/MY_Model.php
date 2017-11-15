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
    protected $_entityId="entity_id";

    /**
     * created_at column
     * @var string
     */
    protected $_createAtColumn= "created_at";

    /**
     * updated_at column
     * @var string
     */
    protected $_updatedAtColumn= "updated_at";

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
    public function load($entityId){
        $query= $this->db->get_where($this->_tableName, array($this->_entityId => $entityId));
        return $query->row();
    }

    /**
     * delete object by id
     * @param $entityId
     * @return mixed
     */
    public function delete($entityId){
        return $this->db->delete($this->_tableName, array($this->_entityId => $entityId));
    }
}
