<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!-- Mainly scripts -->
<script src="<?php echo base_url('public/') ?>js/bootstrap.min.js"></script>
<script src="<?php echo base_url('public/') ?>js/plugins/metisMenu/jquery.metisMenu.js"></script>
<script src="<?php echo base_url('public/') ?>js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
<!---->
<!--<!-- Custom and plugin javascript -->-->
<script src="<?php echo base_url('public/') ?>js/inspinia.js"></script>
<script src="<?php echo base_url('public/') ?>js/plugins/pace/pace.min.js"></script>
<!-- Toastr -->
<script src="<?php echo base_url('public/') ?>js/plugins/toastr/toastr.min.js"></script>
<script>
    toastr.options = {
        "closeButton": false,
        "debug": false,
        "newestOnTop": false,
        "progressBar": false,
        "positionClass": "toast-top-right",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    }
</script>
<?php foreach($js as $j):?>
    <script src="<?php echo base_url('public/js/').$j ?>"></script>
<?php endforeach;?>


<script>
    $(document).ready(function() {
        <?php foreach ($messages['success'] as $s) {
        echo "toastr['success']('$s', 'Success');";
    }
        ?>
    });
</script>
<script>
    $(document).ready(function() {
        <?php foreach ($messages['error'] as $s) {
        echo "toastr['error']('$s', 'error');";
    }
        ?>
    });
</script>
<script>
    <?php echo $script;?>
</script>