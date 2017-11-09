<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_user_group extends MY_Model
{
    public $table = 'user_group';
    public $primary_key = 'user_group_id';
    public $fillable = array(); // If you want, you can set an array with the fields that can be filled by insert/update
    public $protected = array(); // ...Or you can set an array with the fields that cannot be filled by insert/update
    public function __construct()
    {
        parent::__construct();
        $this->has_many['admin_user'] = array('foreign_model'=>'M_admin_user','foreign_table'=>'admin_user','foreign_key'=>'user_group_id','local_key'=>'user_group_id');
    }
}