<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html lang="en">

<?php
$this->load->view('template/header',$loadData);
?>

<body>
<!-- Preloader -->
<div class="preloader">
    <div class="cssload-speeding-wheel"></div>
</div>
<div id="wrapper">
    <!-- Navigation -->
    <?php $this->load->view('template/topNav',$loadData)?>
    <!-- Left navbar-header -->
    <?php $this->load->view('template/leftNav',$loadData)?>
    <!-- Left navbar-header end -->
    <!-- Page Content -->
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row bg-title">
                <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                    <h4 class="page-title">Blank Page </h4> </div>
                <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12"> <a href="http://wrappixel.com/templates/pixeladmin/" target="_blank" class="btn btn-danger pull-right m-l-20 btn-rounded btn-outline hidden-xs hidden-sm waves-effect waves-light">Upgrade to Pro</a>
                    <ol class="breadcrumb">
                        <li><a href="#">Dashboard</a></li>
                        <li class="active">Blank Page</li>
                    </ol>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="white-box">
                        <?= $contents ?>
                        <h3 class="box-title">Blank page</h3> </div>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
       <?php $this->load->view('template/botNav',$loadData)?>
    </div>
    <!-- /#page-wrapper -->
</div>
<!-- /#wrapper -->
<?php
$this->load->view('template/footer',$loadData);
?>
</body>

</html>
