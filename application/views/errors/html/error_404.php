<?php
$CI =& get_instance();
if( ! isset($CI))
{
    $CI = new CI_Controller();
}
$CI->load->helper('url');
?>
<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>INSPINIA | 404 Error</title>

    <link href="<?php echo base_url('public/')?>css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url('public/')?>font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="<?php echo base_url('public/')?>css/animate.css" rel="stylesheet">
    <link href="<?php echo base_url('public/')?>css/style.css" rel="stylesheet">

</head>

<body class="gray-bg">


<div class="middle-box text-center animated fadeInDown">
    <h1>404</h1>
    <h3 class="font-bold">Page Not Found</h3>

    <div class="error-desc">
        Sorry, but the page you are looking for has note been found. Try checking the URL for error, then hit the refresh button on your browser or try found something else in our app.
        <form class="form-inline m-t" role="form" action="<?php echo base_url('admin/dashboard/index')?>">
<!--            <div class="form-group">-->
<!--                <input type="text" class="form-control" placeholder="Search for page">-->
<!--            </div>-->
            <button type="submit" class="btn btn-primary">Home</button>
        </form>
    </div>
</div>

<!-- Mainly scripts -->
<script src="<?php echo base_url('public/')?>js/jquery-3.1.1.min.js"></script>
<script src="<?php echo base_url('public/')?>js/bootstrap.min.js"></script>

</body>

</html>
