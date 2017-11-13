<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_catalog_product extends MY_Model
{
    public $table = 'catalog_product';
    public $primary_key = 'product_id';
    public $fillable = array(
        'product_id',
        'product_name',
        'product_category_ids',
        'content',
        'price',
        'branch',
        'product_type',
        'qty',
        'is_instock'


    ); // If you want, you can set an array with the fields that can be filled by insert/update
    public $protected = array(); // ...Or you can set an array with the fields that cannot be filled by insert/update

    public function __construct()
    {
        parent::__construct();
    }


}