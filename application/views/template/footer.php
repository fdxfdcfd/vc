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
<?php foreach($js as $j):?>
    <script src="<?php echo base_url('public/js/').$j ?>"></script>
<?php endforeach;?>
<script>
    <?php echo $script;?>
</script>