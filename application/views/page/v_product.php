<?php
defined('BASEPATH') OR exit('No direct script access allowed');
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
                    <li>
                        <div> <a href="images/shop/1.jpg" class="single-image zoom-icon"> <img src="images/shop/1.jpg" alt="" /> </a> </div>
                        <!--/ .slide-->
                    </li>
                    <li>
                        <div> <a href="images/shop/2.jpg" class="single-image zoom-icon"> <img src="images/shop/2.jpg" alt="" /> </a> </div>
                        <!--/ .slide-->
                    </li>
                    <li>
                        <div> <a href="images/shop/4.jpg" class="single-image zoom-icon"> <img src="images/shop/4.jpg" alt="" /> </a> </div>
                        <!--/ .slide-->
                    </li>
                </ul>
            </div>
            <!--/ .image-post-slider-->

        </div>
        <!--/ .columns-->

        <div class="ten columns product-description">
            <h2 class="title">Retro Spring Woman Dress</h2>
<!--            <div class="clearfix rating-stars">-->
<!--                <i class="fa fa-star"></i>-->
<!--                <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star">-->
<!--                    -->
<!--                </i><i class="fa fa-star"></i><span class="reviews"><a href="#">2 reviews</a> / <a href="#">Add a Review</a></span>-->
<!--            </div>-->
            <div class="price">$17.00</div>
            <p> Aliquam hendrit rutrum iaculis nullam ondimentum maluada velit beum donec sit amet
                tristique erosam amet risus mollis malesuada nulla. Vestibulum ante ipsum primis in
                faucibus orcluctus et ultrices. Vestibulum ante ipsum primis in
                faucibus. </p>
            <ul class="list">
                <li><i class="fa fa-check-square-o"></i>Porttitor euismod pharetra</li>
                <li><i class="fa fa-check-square-o"></i>Amet massa posuere pretium vestibulum.</li>
                <li><i class="fa fa-check-square-o"></i>Vestibulum ante ipsum</li>
            </ul>
            <div class="divider-half-line"></div>
<!--            <div class="addtocart-product">-->
<!--                <div class="product-amount">-->
<!--                    <input type="text" value="1"/>-->
<!--                    <div class="increase-value"><i class="fa fa-plus"></i></div>-->
<!--                </div>-->
<!--                <button class="addtocart-bt button color">ADD TO CART <i class="fa fa-shopping-cart"></i></button>-->
<!--            </div>-->
            <div class="divider-half-line"></div>
            <div class="categories-product">Categories: <a href="#">Accessories</a>, <a href="#">Dresses</a>, <a href="#">Bags</a></div>
        </div>
        <!--/ .columns-->

        <div class="divider-half-solid"></div>
        <div class="sixteen columns">
            <div class="content-tabs">
                <ul class="tabs-nav clearfix">
                    <li><a href="#tab1">Description</a></li>
                    <li><a href="#tab2">Reviews (2)</a></li>
                </ul>
                <!--/ .tabs-nav-->

                <div class="tabs-container">
                    <div class="tab-content" id="tab1">
                        <p><span class="dropcap">P</span>hasellus vitae mauris justo. Proin erat urna, semper nec ullamcorper semper, adipiscing in purus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Duis placerat eget libero non pretium. In discere repudiandae vel, est no tempor lucilius, te graeco atomorum per. Quo te agam menandri scriptorem, dicta soluta altera nec ei. Vix minim nihil et, cu vidisse scaevola conceptam eum. Per an labores fabellas. Nobis oblique id sit.</p>
                        <p>Nam case oratio nusquam et, id eum omnesque prodesset. Vel ad iusto ludus maluisset. Graeco inimicus ut sed, ne habeo omnium tractatos pro, sit choro admodum eu. Ex his numquam admodum, adhuc percipit sit ut, molestie necessitatibus eam in. At populo referrentur has, sit suas veritus ne, blandit deserunt ius te.</p>
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
        <section id="shop-items" class="shop-items clearfix">
            <h4 class="content-title">Related Products</h4>
            <article class="four columns">
                <button class="addtocart button color">ADD TO CART <i class="fa fa-shopping-cart"></i></button>
                <div class="shop-img"> <img src="images/shop/1.jpg" alt=""> </div>
                <!--/ .shop-img-->

                <a class="shop-item-meta" href="shop-single.html">
                    <h6 class="title">Retro Spring Dress</h6>
                    <span class="price">$17.00</span> </a><!--/ .shop-item-meta-->

            </article>
            <!--/ .columns-->

            <article class="four columns">
                <button class="addtocart button color">ADD TO CART <i class="fa fa-shopping-cart"></i></button>
                <div class="shop-img"> <img src="images/shop/2.jpg" alt=""> </div>
                <!--/ .shop-img-->

                <a class="shop-item-meta" href="shop-single.html">
                    <h6 class="title">Sexy Summer Dress</h6>
                    <span class="price color">$23.00</span> </a><!--/ .shop-item-meta-->

            </article>
            <!--/ .columns-->

            <article class="four columns">
                <button class="addtocart button color">ADD TO CART <i class="fa fa-shopping-cart"></i></button>
                <div class="shop-img"> <img src="images/shop/3.jpg" alt=""> </div>
                <!--/ .shop-img-->

                <div class="item-sale">SALE</div>
                <!--/ .item-sale-->

                <a class="shop-item-meta" href="shop-single.html">
                    <h6 class="title">Casual Dress</h6>
                    <span class="price"><span class="old-price">$27.00</span> $23.00</span> </a><!--/ .shop-item-meta-->

            </article>
            <!--/ .columns-->

            <article class="four columns">
                <button class="addtocart button color">ADD TO CART <i class="fa fa-shopping-cart"></i></button>
                <div class="shop-img"> <img src="images/shop/4.jpg" alt=""> </div>
                <!--/ .shop-img-->

                <div class="item-new">NEW</div>
                <!--/ .item-new-->

                <a class="shop-item-meta" href="shop-single.html">
                    <h6 class="title">White Swimsuit</h6>
                    <span class="price">$29.00</span> </a><!--/ .shop-item-meta-->

            </article>
            <!--/ .columns-->

        </section>
        <!--/ .shop-items-->

    </div>
    <!--/ .container-->

</section>
<!--/ #content-->