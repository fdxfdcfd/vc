<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html lang="en">

<?php
$this->load->view('template/header',$data);
?>

<body>
<!-- Preloader -->
<div class="preloader">
    <div class="cssload-speeding-wheel"></div>
</div>
<div id="wrapper">
    <!-- Navigation -->
    <?php $this->load->view('template/topNav',$data)?>
    <!-- Left navbar-header -->
    <?php $this->load->view('template/leftNav',$data)?>
    <!-- Left navbar-header end -->
    <!-- Page Content -->
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row bg-title">
                <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                    <h4 class="page-title"><?php echo $data['title']?></h4> </div>
<!--                <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12"> <a href="http://wrappixel.com/templates/pixeladmin/" target="_blank" class="btn btn-danger pull-right m-l-20 btn-rounded btn-outline hidden-xs hidden-sm waves-effect waves-light">Upgrade to Pro</a>-->
                    <ol class="breadcrumb">
                        <?php
                        $active = array_pop($data['breadcrumb']);
                        foreach($data['breadcrumb'] as $breadcrumb){
                            echo "<li><a href=\"".$breadcrumb[1]."\">$breadcrumb[0]</a></li>";
                        }
                        ?>
                        <li class="active"><?php echo $active[0];?></li>
                    </ol>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <?= $contents ?>
        </div>
        <!-- /.container-fluid -->
       <?php $this->load->view('template/botNav',$data)?>
    </div>
    <!-- /#page-wrapper -->
</div>
<!-- /#wrapper -->
<?php
$this->load->view('template/footer',$data);
?>
</body>

</html>
