<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<head>

    <!-- Basic Page Needs
      ================================================== -->
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <!--[if ie]><meta http-equiv='X-UA-Compatible' content="IE=edge,IE=9,IE=8,chrome=1" /><![endif]-->

    <title>Adelia HTML Template | Home</title>
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/x-icon" href="favicon.ico" />

    <!-- Mobile Specific Metas
      ================================================== -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- CSS
      ================================================== -->
    <link rel="stylesheet" href="<?php echo base_url('public/')?>css/style.css" />
    <link rel="stylesheet" href="<?php echo base_url('public/')?>css/colors/orange.css" id="colors" />
    <link rel="stylesheet" href="<?php echo base_url('public/')?>css/skeleton.css" />
    <link rel="stylesheet" href="<?php echo base_url('public/')?>css/layout.css" />
    <link rel="stylesheet" href="<?php echo base_url('public/')?>css/font-awesome.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('public/')?>css/animate.css" />
    <link rel="stylesheet" href="<?php echo base_url('public/')?>js/layerslider/css/layerslider.css" />
    <link rel="stylesheet" href="<?php echo base_url('public/')?>js/fancybox/jquery.fancybox.css" />

    <?php foreach($css as $c):?>
        <link href="<?php echo base_url('public/css/').$c?>" rel="stylesheet">
    <?php endforeach;?>
    <!-- HTML5 Shiv
        ================================================== -->
    <script src="<?php echo base_url('public/')?>js/jquery-1.8.3.min.js"></script>
    <script src="<?php echo base_url('public/')?>js/jquery.modernizr.js"></script>
</head>