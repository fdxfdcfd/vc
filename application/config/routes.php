<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'home';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
//
$route['admin'] = 'admin/dashboard';
$route['admin/user'] = 'admin/user/userlist';
$route['admin/product'] = 'admin/product/productlist';
