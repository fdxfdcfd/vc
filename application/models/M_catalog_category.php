<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_catalog_category extends MY_Model
{
    public $table = 'catalog_category';
    public $primary_key = 'catalog_category_id';
    public $fillable = array(); // If you want, you can set an array with the fields that can be filled by insert/update
    public $protected = array(); // ...Or you can set an array with the fields that cannot be filled by insert/update
    public function __construct()
    {
        parent::__construct();
    }
}