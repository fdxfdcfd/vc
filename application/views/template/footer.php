<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!-- Bootstrap Core JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.17.0/dist/jquery.validate.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.17.0/dist/additional-methods.js"></script>

<?php
foreach ($foot['js'] as $js){
    ?>
    <script src="<?php echo base_url('public/').$js;?>"></script>
    <?php
}
?>
<!--<script type="text/javascript">-->
<!--    $(document).ready(function() {-->
<!--        $.toast({-->
<!--            heading: 'Welcome to Pixel admin',-->
<!--            text: 'Use the predefined ones, or specify a custom position object.',-->
<!--            position: 'top-right',-->
<!--            loaderBg: '#ff6849',-->
<!--            icon: 'info',-->
<!--            hideAfter: 3500,-->
<!--            stack: 6-->
<!--        })-->
<!--    });-->
<!--</script>-->

