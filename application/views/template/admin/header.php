<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title><?=$title?></title>

    <link href="<?php echo base_url('public/admin/')?>css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url('public/admin/')?>font-awesome/css/font-awesome.css" rel="stylesheet">

    <!-- Toastr style -->
    <link href="<?php echo base_url('public/admin/')?>css/plugins/toastr/toastr.min.css" rel="stylesheet">

    <!-- Gritter -->
    <link href="<?php echo base_url('public/admin/')?>js/plugins/gritter/jquery.gritter.css" rel="stylesheet">

    <link href="<?php echo base_url('public/admin/')?>css/animate.css" rel="stylesheet">
    <link href="<?php echo base_url('public/admin/')?>css/style.css" rel="stylesheet">
    <script src="<?php echo base_url('public/admin/')?>js/jquery-3.1.1.min.js"></script>
    <?php foreach($css as $c):?>
        <link href="<?php echo base_url('public/css/').$c?>" rel="stylesheet">
    <?php endforeach;?>

</head>