<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$baseUrl = base_url('public/');
$imgs = $product_imgs;
$price = $product->getPrice();
$productName = $product->getProductName();
$content = $product->getContent();
$description = $product->getDescription();
?>
<section id="content">
    <div class="menu-shadow"></div>
    <div class="container">
        <div class="page-header clearfix">
            <h1><?php echo $product->getProductName()?></h1>
            <div class="line"></div>
        </div>
        <!--/ .page-header-->

        <div class="six columns">
            <div class="image-post-slider">
                <ul>
                    <?php if(!count($imgs)):?>
                        <div> <a href="<?php echo $baseUrl?>admin/img/gallery/default_product.jpg" class="single-image zoom-icon"> <img src="<?php echo $baseUrl;?>admin/img/gallery/default_product.jpg" alt="" /> </a> </div>
                    <?php endif;?>
                    <?php foreach ($imgs as $img):?>
                    <li>
                        <div> <a href="<?php echo $baseUrl?>admin/img/gallery/<?php echo $img->product_img_name?>" class="single-image zoom-icon"> <img src="<?php echo $baseUrl;?>admin/img/gallery/<?php echo $img->product_img_name?>" alt="" /> </a> </div>
                        <!--/ .slide-->
                    </li>
                    <?php endforeach;?>
                </ul>
            </div>
            <!--/ .image-post-slider-->

        </div>
        <!--/ .columns-->

        <div class="ten columns product-description">
            <h2 class="title"><?php echo $productName?></h2>
<!--            <div class="clearfix rating-stars">-->
<!--                <i class="fa fa-star"></i>-->
<!--                <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star">-->
<!--                    -->
<!--                </i><i class="fa fa-star"></i><span class="reviews"><a href="#">2 reviews</a> / <a href="#">Add a Review</a></span>-->
<!--            </div>-->
            <div class="price">
                <?php
                if($price){
                    $currency = 'VND';
                    echo number_format($price).$currency."<br>";
                }
                ?>
            </div>
            <p><?php echo $description?></p>
<!--            <ul class="list">-->
<!--                <li><i class="fa fa-check-square-o"></i>Porttitor euismod pharetra</li>-->
<!--                <li><i class="fa fa-check-square-o"></i>Amet massa posuere pretium vestibulum.</li>-->
<!--                <li><i class="fa fa-check-square-o"></i>Vestibulum ante ipsum</li>-->
<!--            </ul>-->
            <div class="divider-half-line"></div>
<!--            <div class="addtocart-product">-->
<!--                <div class="product-amount">-->
<!--                    <input type="text" value="1"/>-->
<!--                    <div class="increase-value"><i class="fa fa-plus"></i></div>-->
<!--                </div>-->
<!--                <button class="addtocart-bt button color">ADD TO CART <i class="fa fa-shopping-cart"></i></button>-->
<!--            </div>-->
            <div class="divider-half-line"></div>
            <div class="categories-product">Categories:
                <?php
                foreach (explode(',',$product->getProductCategoryIds()) as $cate): ?>
                    <a href="<?php echo $baseUrl.'category/index/id/'.$cate.'.html'?>"><?php echo $categories[$cate]?></a>,
                <?php endforeach;?>
            </div>
        </div>
        <!--/ .columns-->

        <div class="divider-half-solid"></div>
        <div class="sixteen columns">
            <div class="content-tabs">
                <ul class="tabs-nav clearfix">
                    <li><a href="#tab1">Description</a></li>
<!--                    <li><a href="#tab2">Reviews (2)</a></li>-->
                </ul>
                <!--/ .tabs-nav-->

                <div class="tabs-container">
                    <div class="tab-content" id="tab1">
                        <?php
                        if($content){
                            $fc = $content[0];
                            $scontent = substr($content,1);
                        }else{
                            $fc = '';
                            $scontent  = '';
                        }

                        ?>
                        <p><span class="dropcap"><?php echo $fc?></span><?php echo $scontent?></p>
                        <div class="clearfix"></div>
                    </div>
                    <!--/ .tab-content -->

                    <div class="tab-content" id="tab2">
                        <ol class="comments-list">
                            <li class="comment">
                                <article>
                                    <div class="gravatar"> <img src="images/gravatar.jpg" alt=""> </div>
                                    <div class="comment-body">
                                        <div class="comment-meta clearfix">
                                            <div class="comment-author"><a href="#">John Doe</a></div>
                                            <div class="comment-date"><a href="#">July 01, 2014</a></div>
                                            <div class="clearfix rating-stars"><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i></div>
                                        </div>
                                        <!--/ .comment-meta-->

                                        <p> Quisque suscipit tempor viverra. Curabitur arcu lacus, molestie a ligula in, volutpat tempor purus. Maecenas eget leo varius, interdum urna id, vehicula tellus. Nulla congue scelerisque ultricies. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Curabitur aliquet enim quis elit consectetur, eget pretium justo egestas. Sed augue metus, viverra eu tincidunt sed, malesuada ac nibh. </p>
                                    </div>
                                    <!--/ .comment-body-->

                                </article>
                            </li>
                            <!--/ .comment-->

                            <li class="comment">
                                <article>
                                    <div class="gravatar"> <img src="images/gravatar.jpg" alt=""> </div>
                                    <div class="comment-body">
                                        <div class="comment-meta clearfix">
                                            <div class="comment-author"><a href="#">Melinda Doe</a></div>
                                            <div class="comment-date"><a href="#">August 9, 2014</a></div>
                                            <div class="clearfix rating-stars"><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-half-o"></i></div>
                                        </div>
                                        <!--/ .comment-meta-->

                                        <p> Maecenas eget leo varius, interdum urna id, vehicula tellus. Nulla congue scelerisque ultricies. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Curabitur aliquet enim quis elit consectetur, eget pretium justo egestas. Sed augue metus, viverra eu tincidunt sed, malesuada ac nibh. </p>
                                    </div>
                                    <!--/ .comment-body-->

                                </article>
                            </li>
                            <!--/ .comment-->

                        </ol>
                        <!--/ .comments-list-->

                        <h5>Add a Review</h5>
                        <form method="post" action="/" class="comments-form" id="contactform">
                            <p class="comment-form-author">
                                <label for="author">Your Name: <span class="required">(required)</span></label>
                                <input required="" type="text" name="author" id="author" />
                            </p>
                            <p class="comment-form-email">
                                <label for="email">E-mail: <span class="required">(required)</span></label>
                                <input required="" type="email" name="email" id="email" />
                            </p>
                            <p class="your-rating">
                            <div>Your Rating</div>
                            <div class="clearfix"><a href=""><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i></a></div>
                            </p>
                            <p class="comment-form-comment">
                                <label for="comment">Your Review: <span class="required">(required)</span></label>
                                <textarea required="" name="comment" id="comment"></textarea>
                            </p>
                            <p class="form-submit">
                                <button class="button default" type="submit">Submit</button>
                            </p>
                        </form>
                        <!--/ .comments-form-->

                        <div class="divider-half-solid"></div>
                    </div>
                    <!--/ .tab-content -->

                </div>
                <!-- .tabs-container -->

            </div>
            <!--/ .content tabs -->

        </div>
        <!--/ .columns -->

        <div class="clear"></div>
        <?php if($related_product):?>
        <section id="shop-items" class="shop-items clearfix">
            <h4 class="content-title">Related Products</h4>
            <?php foreach ($related_product as $rel):?>
                <article class="four columns">
                    <div class="shop-img">
                        <img src="<?php echo $baseUrl?>admin/img/gallery/<?php echo $rel['product_img'] ?>" alt="<?php echo $rel['product_name']?>" />
                    </div>
                    <a class="shop-item-meta" href="<?php echo base_url()?>product/view/id/<?php echo $rel['entity_id'] ?>">
                        <h6 class="title"><?php echo $rel['product_name']?></h6>
                        <span class="price">
                            <?php  $currency = 'VND';
                            echo number_format($rel['price']).$currency?></span>
                    </a><!--/ .shop-item-meta-->
                </article>
                <!--/ .columns-->
            <?php endforeach;?>

        </section>
        <!--/ .shop-items-->
        <?php endif;?>

    </div>
    <!--/ .container-->

</section>
<!--/ #content-->