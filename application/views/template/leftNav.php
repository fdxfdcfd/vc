<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav navbar-collapse slimscrollsidebar">
        <ul class="nav" id="side-menu">
            <?php
            $firstNav= array_shift($lev_nav);
            ?>
            <li style="padding: 10px 0 0;">
                <a href="<?php echo base_url($firstNav['admin_menu_link'])?>" class="waves-effect"><i class="fa <?php echo $firstNav['admin_menu_class']?> fa-fw" aria-hidden="true"></i><span class="hide-menu"><?php echo $firstNav['admin_menu_name']?></span></a>
            </li>
            <?php foreach ($lev_nav as $nav):?>
                <li>
                    <a href="<?php echo base_url($nav['admin_menu_link'])?>" class="waves-effect"><i class=" fa <?php echo $nav['admin_menu_class']?> fa-fw" aria-hidden="true"></i><span class="hide-menu"><?php echo $nav['admin_menu_name']?></span></a>
                </li>
            <?php endforeach;?>
        </ul>
        <div class="center p-20">
<!--            <span class="hide-menu"><a href="http://wrappixel.com/templates/pixeladmin/" target="_blank" class="btn btn-danger btn-block btn-rounded waves-effect waves-light">Upgrade to Pro</a></span>-->
        </div>
    </div>
</div>