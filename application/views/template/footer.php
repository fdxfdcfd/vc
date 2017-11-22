<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>


    <!-- Mainly scripts -->
    <script src="<?php echo base_url('public/')?>js/bootstrap.min.js"></script>
    <script src="<?php echo base_url('public/')?>js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="<?php echo base_url('public/')?>js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

    <!-- Custom and plugin javascript -->
    <script src="<?php echo base_url('public/')?>js/inspinia.js"></script>
    <script src="<?php echo base_url('public/')?>js/plugins/pace/pace.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/4.4.0/bootbox.js"></script>
<?php
foreach ($footer as $js){
    ?>
    <script src="<?php echo base_url('public/').$js;?>"></script>
    <?php
}
?>