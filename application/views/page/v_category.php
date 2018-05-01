<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$base_url = base_url();
$public_url = base_url('public/');
$content = str_replace('{public_url()}',$public_url,$categories->getContent());
?>

<?php
if ($categories->getCategoryType() == 3):
    echo $content;
else:?>
    </section>
    <section id="content">
        <div class="menu-shadow"></div>
        <div class="container clearfix">
            <div class="page-header clearfix">
                <h1><?php echo $categories->getCategoryName(); ?></h1>
                <div class="line"></div>
                <div class="row pull-left">
                    <?php
                    if ($categories->getCategoryType() == 2) {
                        echo $categories->getContent();
                    }
                    ?>
                </div>
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
                            <option value="price" selected>Price</option>
                            <option value="date">Date</option>
<!--                            <option value="brand">Brand</option>-->
                        </select>
                    </form>
                    <div class="pagenavi"><a href="#" class="order"><i class="fa fa-long-arrow-down"></i></a></div>
                </div>
                <div class="show-nr">
                    <form name="form" id="form">
                        <select name="jumpMenu" id="jumpMenu" onChange="MM_jumpMenu('parent',this,0)">
                            <option value="12" selected>12 Products</option>
                            <option value="24">24 Products</option>
                            <option value="36">36 Products</option>
                        </select>
                    </form>
                    <div class="show-nr_text">
                        <p>Show:</p>
                    </div>
                </div>
                <div class="clear"></div>
            </section>
            <section id="shop-items" class="shop-items clearfix">
                <?php if (count($products['products'])): ?>
                    <?php foreach ($products['products'] as $product): ?>
                        <article class="four columns">
                            <!--                    <button class="addtocart button color">ADD TO CART <i class="fa fa-shopping-cart"></i></button>-->
                            <div class="shop-img">
                                <img src="<?php echo $product->img_url ?>" alt="">
                            </div>
                            <!--/ .shop-img-->

                            <a class="shop-item-meta"
                               href="<?php echo base_url('product/view/id/') . $product->entity_id; ?>">
                                <h6 class="title"><?php echo $product->product_name ?></h6>
                                <h4 class="title"><?php echo $product->sku ?></h4>
                                <span class="price"><?php echo $product->price ?></span> </a><!--/ .shop-item-meta-->
                        </article>
                    <?php endforeach; ?>
                <?php else: ?>
                    <h6 class="title">No Product found</h6>
                <?php endif; ?>
                <!--/ .columns-->

            </section>
            <!--/ #portfolio-items -->
            <?php if (count($products['products'])): ?>
                <div class="shop-navigation shop-navi-sidebar">
                    <div class="divider-line"></div>
                    <div class="pagenavi clearfix">
                        <?php
                        if ($products['current_page'] == 1){
                            $pre = 'disabled="disabled"';
                        }else{
                            $pre = 'onclick="sortProduct('.($products["current_page"]-1).')"';
                        }
                        ?>
                        <a href="#"  <?php echo $pre ?>  class="prev page-numbers"></a>
                        <?php for ($i = 1 ; $i <= $products['total_page']; $i++):?>
                            <?php if($i == $products['current_page']):?>
                                <span class="page-numbers current"><?php echo $i?></span>
                                <?php else:?>
                                <a href="#" class="page-numbers"><?php echo $i?></a>
                             <?php endif;?>
                    <?php endfor;?>
                        <?php
                        if ($products['current_page'] == $products['total_page']){
                            $next = 'disabled="disabled"';
                        }else{
                            $next = 'onclick="sortProduct('.($products["current_page"]+1).')"';
                        }
                        ?>
                        <a href="#"  <?php echo $next ?>   class="next page-numbers"></a>
                    </div>
                    <!--/ .pagenavi-->

                </div>
                <!--/ .shop-navigation-->
            <?php endif; ?>

            <div class="divider-half-solid"></div>
        </div>
        <!--/ .container-->

    </section>
    <!--/ #content-->
    <script>
        jQuery('#jumpMenu').change(function(){
            sortProduct(currentPage());
        });
        jQuery('#jumpMenu1').change(function(){
            sortProduct(currentPage());
        });
        function sortProduct(page = 1){
            numperPage = $('#jumpMenu').val();
            sortBy = $('#jumpMenu1').val();

            baseUrl = location.protocol + '//' + location.host + location.pathname;
            window.location = baseUrl + '?p='+page+'&s='+sortBy+'&np='+numperPage;
        }

        function getNumberPage(){
            return  getUrlParameter('np');
        }

        function getSortBy(){
            return  getUrlParameter('s');
        }

        function currentPage() {
            return getUrlParameter('p');
        }
        jQuery(document).ready(function () {
            if(getNumberPage()){
                jQuery('#jumpMenu').val(getNumberPage());
            }else{
                jQuery('#jumpMenu').val(12);
            }

            if(getSortBy()){
                jQuery('#jumpMenu1').val(getSortBy());
            }else{
                jQuery('#jumpMenu1').val('date');
            }

        });

        function getUrlParameter(sParam) {
            var sPageURL = decodeURIComponent(window.location.search.substring(1)),
                sURLVariables = sPageURL.split('&'),
                sParameterName,
                i;

            for (i = 0; i < sURLVariables.length; i++) {
                sParameterName = sURLVariables[i].split('=');

                if (sParameterName[0] === sParam) {
                    return sParameterName[1] === undefined ? true : sParameterName[1];
                }
            }
        };
    </script>
<?php endif; ?>