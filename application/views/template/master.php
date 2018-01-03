<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<!--[if IE 7]>
<html class="ie7 no-js" lang="en">     <![endif]-->
<!--[if lte IE 8]>
<html class="ie8 no-js" lang="en">     <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!-->
<html class="not-ie no-js" lang="en">
<!--<![endif]-->

<?php $this->load->view('template/header', $header) ?>

<body class="wide color pattern-1">

<div id="wrapper">
    <?php $this->load->view('template/topNav', $topNav); ?>
    <?= $contents ?>
    <?php $this->load->view('template/botNav', $botNav); ?>

</div>

<?php $this->load->view('template/footer', $footer) ?>
</body>
</html>