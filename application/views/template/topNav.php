<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<header id="header">
    <div class="container">
        <div class="eight columns">
            <div id="logo"> </div>
            <!--/ #logo-->

        </div>
        <!--/ .columns-->

        <div class="eight columns">
            <div class="widget widget_contacts">
                <ul class="social-icons">
                    <li class="vimeo"><a href="#">Vimeo</a></li>
                    <li class="skype"><a href="#">Skype</a></li>
                    <li class="dribble"><a href="#">Dribble</a></li>
                    <li class="youtube"><a href="#">Youtube</a></li>
                    <li class="twitter"><a href="#">Twitter</a></li>
                    <li class="facebook"><a href="#">Facebook</a></li>
                    <li class="rss"><a href="#">Rss</a></li>
                </ul>
                <!--/ .social-icons -->

            </div>
        </div>
        <!--/ .columns-->

        <div class="clear"></div>
        <div class="sixteen columns">
            <div class="menu-container clearfix">

                <nav class="mega-menu">

                    <label for="mobile-button"> <i class="fa fa-bars"></i> </label>
                    <input id="mobile-button" type="checkbox">

                    <ul class="collapse">
                        <?php
                        if (is_array($topNav['child']) || is_object($topNav['child'])):
                            foreach ($topNav['child'] as $key => $value):
                                ?>
                                <li><a href="<?php if(!$value['link_outsite']) {echo base_url('category/index/id/').$key.'.html';} else{echo $value['link_outsite'];}?>"><?php echo $value['name']?></a>
                                    <?php if(count($value['child'])):?>
                                    <div class="drop-down full-width hover-fade">
                                        <ul>
                                            <?php foreach ($value['child'] as $k => $v):?>
                                                    <li><a href="<?php echo $k.'.html'?>"><h2><?php echo $v['name']?></h2></a></li>
                                                    <?php foreach ($v['child'] as $kk => $vv):?>
                                                    <li><a href="<?php echo $kk.'.html'?>"><?php echo $vv['name']?></a></li>
                                                    <?php endforeach;?>
                                          <?php endforeach;?>
                                        </ul>
                                    </div>
                                    <?php endif;?>
                                </li>
                            <?php endforeach;?>
                        <?php endif;?>


                        <li class="login-form"> <i class="fa fa-user"></i>

                            <ul class="drop-down hover-fade">
                                <li>

                                    <form method="post" action="#">
                                        <table>
                                            <tr>
                                                <td colspan="2"><input type="email" name="email" placeholder="Your email address" required></td>
                                            </tr>
                                            <tr>
                                                <td colspan="2"><input type="password" name="password" placeholder="Password" required></td>
                                            </tr>
                                            <tr>
                                                <td><a href="#" class="button medium color">SIGN IN</a></td>
                                                <td><label><input type="checkbox" name="check_box">Keep me signed in </label></td>
                                            </tr>
                                        </table>
                                    </form>

                                </li>
                            </ul>

                        </li>
                        <li class="search-bar"> <i class="fa fa-search"></i>

                            <ul class="drop-down hover-fade">
                                <li>

                                    <form method="post" action="#">
                                        <table>
                                            <tr>
                                                <td><input type="text" name="serach_bar" placeholder="Type Keyword and Hit Enter"></td>
                                            </tr>
                                        </table>
                                    </form>

                                </li>
                            </ul>

                        </li>
                    </ul>

                </nav>
                <!-- nav container end -->

            </div>
            <!--/ .menu-container-->

        </div>
        <!--/ .columns-->

    </div>
    <!--/ .container-->

</header>
<!--/ #header-->