<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html>

<?php $this->load->view('template/header',$header)?>

<body class="">

<div id="wrapper">
    <?php $this->load->view('template/leftNav',$leftNav)?>
    <div id="page-wrapper" class="gray-bg">
        <?php $this->load->view('template/topNav',$topNav);?>
        <?= $contents ?>
        <?php $this->load->view('template/botNav',$botNav);?>

    </div>
</div>

<?php $this->load->view('template/footer',$footer)?>
</body>
</html>