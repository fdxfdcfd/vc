<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html>

<?php $this->load->view('template/admin/header',$header)?>

<body class="">

<div id="wrapper">
    <?php $this->load->view('template/admin/leftNav',$leftNav)?>
    <div id="page-wrapper" class="gray-bg">
        <?php $this->load->view('template/admin/topNav',$topNav);?>
        <?= $contents ?>
        <?php $this->load->view('template/admin/botNav',$botNav);?>

    </div>
</div>

<?php $this->load->view('template/admin/footer',$footer)?>
</body>
</html>