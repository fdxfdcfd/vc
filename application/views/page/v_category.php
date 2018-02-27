<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<?php
if($categories->getCategoryType() == 3 ):
    echo $categories->getContent();
else:
?>
</section>
    <section id="content">
        <div class="menu-shadow"></div>
        <div class="container clearfix">
            <div class="page-header clearfix">
                <h1><?php echo $categories->getCategoryName();?></h1>
                <div class="line"></div>
            </div>
            <!--/ .page-header-->

            <section class="sorting">
                <div class="divider-line"></div>
                <div class="sort">
                    <div class="sort_text">
                        <p>Sort By:</p>
                    </div>
                    <form name="form" id="form1">
                        <select name="jumpMenu" id="jumpMenu1" onChange="MM_jumpMenu('parent',this,0)">
                            <option selected>Price</option>
                            <option>Sales</option>
                            <option>Rating</option>
                            <option>Date</option>
                            <option>Brand</option>
                        </select>
                    </form>
                    <div class="pagenavi"><a href="#" class="order"><i class="fa fa-long-arrow-down"></i></a></div>
                </div>
                <div class="show-nr">
                    <form name="form" id="form">
                        <select name="jumpMenu" id="jumpMenu" onChange="MM_jumpMenu('parent',this,0)">
                            <option selected>12 Products</option>
                            <option>24 Products</option>
                            <option>36 Products</option>
                        </select>
                    </form>
                    <div class="show-nr_text">
                        <p>Show:</p>
                    </div>
                </div>
                <div class="clear"></div>
            </section>
            <section id="shop-items" class="shop-items clearfix">
                <?php if(count($products['products'])):?>
                    <?php foreach ($products['products'] as $product):?>
                        <article class="four columns">
                            <!--                    <button class="addtocart button color">ADD TO CART <i class="fa fa-shopping-cart"></i></button>-->
                            <div class="shop-img">
                                <img src="<?php echo $product->img_url?>" alt="">
                            </div>
                            <!--/ .shop-img-->

                            <a class="shop-item-meta" href="<?php echo base_url('product/view/id/').$product->entity_id;?>">
                                <h6 class="title"><?php echo $product->product_name?></h6>
                                <h4 class="title"><?php echo $product->sku?></h4>
                                <span class="price"><?php echo $product->price?></span> </a><!--/ .shop-item-meta-->
                        </article>
                    <?php endforeach;?>
                <?php else:?>
                    <h6 class="title">No Product found</h6>
                <?php endif;?>
                <!--/ .columns-->

            </section>
            <!--/ #portfolio-items -->
            <?php if(count($products['products'])):?>
                <div class="shop-navigation shop-navi-sidebar">
                    <div class="divider-line"></div>
                    <div class="pagenavi clearfix">
                        <a href="#" class="prev page-numbers"></a>
                        <span class="page-numbers current">1</span>
                        <a href="#" class="page-numbers">2</a>
                        <a href="#" class="page-numbers">3</a>
                        <a href="#" class="next page-numbers"></a>
                    </div>
                    <!--/ .pagenavi-->

                </div>
                <!--/ .shop-navigation-->
            <?php endif;?>

            <div class="divider-half-solid"></div>
        </div>
        <!--/ .container-->

    </section>
    <!--/ #content-->
<?php endif;?>