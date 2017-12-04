<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$entity_id = set_value('entity_id') == false ? $product->getEntityId() : set_value('entity_id');
$product_name = set_value('product_name') == false ? $product->getProductName() : set_value('product_name');
$product_category_ids = set_value('product_category_ids') == false ? $product->getProductCategoryIds() : set_value('product_category_ids');
$content = set_value('content') == false ? $product->getContent() : set_value('content');
$price = set_value('price') == false ? $product->getPrice() : set_value('price');
$product_type = set_value('product_type') == false ? $product->getProductType() : set_value('product_type');
$qty = set_value('qty') == false ? $product->getQty() : set_value('qty');
$is_instock = set_value('is_instock') == false ? $product->getIsInstock() : set_value('is_instock');
$is_active = set_value('$is_active') == false ? $product->getIsActive() : set_value('$is_active');
$sku = set_value('sku') == false ? $product->getSku() : set_value('sku');

?>
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2><?= $title ?></h2>
        <ol class="breadcrumb">
            <?php
            end($breadcrumb);
            $first = key($breadcrumb);
            ?>
            <?php foreach ($breadcrumb as $key => $value): ?>
                <li <?php if ($key == $first) echo 'class="active"' ?>>
                    <?php if ($key == $first) echo '<b>' ?><a
                            href="<?= $value ?>"><?= $key ?></a><?php if ($key == $first) echo '</b>' ?>
                </li>
            <?php endforeach; ?>
        </ol>
    </div>
    <div class="col-lg-2">

    </div>
</div>
<div class="wrapper wrapper-content animated fadeInRight ecommerce">
    <div class="row">
        <div class="col-lg-12">
            <form action="">
                <div class="tabs-container">
                    <ul class="nav nav-tabs">
                        <li class="active"><a data-toggle="tab" href="#tab-1"> Product info</a></li>
                        <li class=""><a data-toggle="tab" href="#tab-2"> Data</a></li>
                        <li class=""><a data-toggle="tab" href="#tab-3"> Category</a></li>
                        <li class=""><a data-toggle="tab" href="#tab-4"> Images</a></li>
                    </ul>
                    <div class="tab-content">
                        <div id="tab-1" class="tab-pane active">
                            <div class="panel-body">
                                <fieldset class="form-horizontal">
                                    <div class="form-group"><label class="col-sm-2 control-label">Name:</label>
                                        <div class="col-sm-10"><input type="text" class="form-control"
                                                                      placeholder="Product name" name="product_name"
                                                                      id="product_name"
                                                                      value="<?= $product_name ?>" size="50"></div>
                                    </div>
                                    <div class="form-group"><label class="col-sm-2 control-label">Price:</label>
                                        <div class="col-sm-10"><input type="text" class="form-control" name="price"
                                                                      id="price"
                                                                      placeholder="price" value="<?= $price ?>"></div>
                                    </div>
                                    <div class="form-group"><label class="col-sm-2 control-label">Description:</label>
                                        <div class="col-sm-10">
                                            <div class="summernote">
                                                <?= $content ?>
                                            </div>
                                        </div>
                                    </div>
                                    <textarea style="display: none" name="content" id="content" cols="30" rows="10">
                                    <?= $content ?>
                                    </textarea>
                                    <div class="form-group"><label class="col-sm-2 control-label">Meta Tag
                                            Title:</label>
                                        <div class="col-sm-10"><input type="text" class="form-control"
                                                                      placeholder="..."></div>
                                    </div>
                                    <div class="form-group"><label class="col-sm-2 control-label">Meta Tag
                                            Description:</label>
                                        <div class="col-sm-10"><input type="text" class="form-control"
                                                                      placeholder="Sheets containing Lorem"></div>
                                    </div>
                                    <div class="form-group"><label class="col-sm-2 control-label">Meta Tag
                                            Keywords:</label>
                                        <div class="col-sm-10"><input type="text" class="form-control"
                                                                      placeholder="Lorem, Ipsum, has, been"></div>
                                    </div>
                                </fieldset>

                            </div>
                        </div>
                        <div id="tab-2" class="tab-pane">
                            <div class="panel-body">

                                <fieldset class="form-horizontal">
                                    <div class="form-group"><label class="col-sm-2 control-label">SKU:</label>
                                        <div class="col-sm-10"><input type="text" class="form-control"
                                                                      placeholder="SKU" value="<?= $sku ?>"></div>
                                    </div>
                                    <div class="form-group"><label class="col-sm-2 control-label">QTY:</label>
                                        <div class="col-sm-10"><input type="number" class="form-control"
                                                                      placeholder="qty" value="<?= $qty ?>"></div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Is In Stock:</label>
                                        <div class="col-sm-10">
                                            <input type="checkbox"
                                                   class="i-checks" <?php if ($is_instock) echo 'checked' ?>>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Enable:</label>
                                        <div class="col-sm-10">
                                            <input type="checkbox"
                                                   class="i-checks" <?php if ($is_active) echo 'checked' ?>>
                                        </div>
                                    </div>
                                    <!--                                    <div class="form-group"><label class="col-sm-2 control-label">Tax Class:</label>-->
                                    <!--                                        <div class="col-sm-10">-->
                                    <!--                                            <select class="form-control">-->
                                    <!--                                                <option>option 1</option>-->
                                    <!--                                                <option>option 2</option>-->
                                    <!--                                            </select>-->
                                    <!--                                        </div>-->
                                    <!--                                    </div>-->
                                    <!--                                    <div class="form-group"><label class="col-sm-2 control-label">Quantity:</label>-->
                                    <!--                                        <div class="col-sm-10"><input type="text" class="form-control"-->
                                    <!--                                                                      placeholder="Quantity"></div>-->
                                    <!--                                    </div>-->
                                    <!--                                    <div class="form-group"><label class="col-sm-2 control-label">Minimum-->
                                    <!--                                            quantity:</label>-->
                                    <!--                                        <div class="col-sm-10"><input type="text" class="form-control" placeholder="2">-->
                                    <!--                                        </div>-->
                                    <!--                                    </div>-->
                                    <!--                                    <div class="form-group"><label class="col-sm-2 control-label">Sort order:</label>-->
                                    <!--                                        <div class="col-sm-10"><input type="text" class="form-control" placeholder="0">-->
                                    <!--                                        </div>-->
                                    <!--                                    </div>-->
                                    <!--                                    <div class="form-group"><label class="col-sm-2 control-label">Status:</label>-->
                                    <!--                                        <div class="col-sm-10">-->
                                    <!--                                            <select class="form-control">-->
                                    <!--                                                <option>option 1</option>-->
                                    <!--                                                <option>option 2</option>-->
                                    <!--                                            </select>-->
                                    <!--                                        </div>-->
                                    <!--                                    </div>-->
                                </fieldset>


                            </div>
                        </div>
                        <div id="tab-3" class="tab-pane">
                            <div class="panel-body">
                                <div class="form-group">
                                    <fieldset class="form-horizontal">
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Search Category:</label>
                                            <div class="col-sm-10">
                                                <input id="search_category" type="text" class="form-control"
                                                       placeholder="category name" value=""></div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-sm-4"></div>
                                            <div class="col-sm-4">
                                                <input type="hidden" name="product_category_ids"
                                                       id="product_category_ids" value="<?= $product_category_ids ?>">
                                                <div id="category_tree">
                                                </div>

                                            </div>
                                            <div class="col-sm-4"></div>

                                        </div>

                                        <!--                                    <div class="col-sm-9">-->
                                        <!--                                        <div class="panel panel-default">-->
                                        <!--                                            <div class="panel-heading">Category Info</div>-->
                                        <!--                                            <div class="panel-body">-->
                                        <!--                                                <div class="form-group"><label class="col-sm-2 control-label">Name:</label>-->
                                        <!--                                                    <div class="col-sm-10"><input type="text" class="form-control"-->
                                        <!--                                                                                  placeholder="Product name" name="product_name"-->
                                        <!--                                                                                  id="product_name"-->
                                        <!--                                                                                  value="-->
                                        <? //= $product_name ?><!--" size="50"></div>-->
                                        <!--                                                </div>-->
                                        <!--                                            </div>-->
                                        <!--                                        </div>-->
                                        <!--                                    </div>-->
                                </div>
                                </fieldset>


                            </div>
                        </div>
                        <div id="tab-4" class="tab-pane">
                            <div class="panel-body">

                                <div class="table-responsive">
                                    <table class="table table-bordered table-stripped">
                                        <thead>
                                        <tr>
                                            <th>
                                                Image preview
                                            </th>
                                            <th>
                                                Image url
                                            </th>
                                            <th>
                                                Sort order
                                            </th>
                                            <th>
                                                Actions
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>
                                                <img src="img/gallery/2s.jpg">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" disabled
                                                       value="http://mydomain.com/images/image1.png">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" value="1">
                                            </td>
                                            <td>
                                                <button class="btn btn-white"><i class="fa fa-trash"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <img src="img/gallery/1s.jpg">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" disabled
                                                       value="http://mydomain.com/images/image2.png">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" value="2">
                                            </td>
                                            <td>
                                                <button class="btn btn-white"><i class="fa fa-trash"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <img src="img/gallery/3s.jpg">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" disabled
                                                       value="http://mydomain.com/images/image3.png">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" value="3">
                                            </td>
                                            <td>
                                                <button class="btn btn-white"><i class="fa fa-trash"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <img src="img/gallery/4s.jpg">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" disabled
                                                       value="http://mydomain.com/images/image4.png">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" value="4">
                                            </td>
                                            <td>
                                                <button class="btn btn-white"><i class="fa fa-trash"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <img src="img/gallery/5s.jpg">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" disabled
                                                       value="http://mydomain.com/images/image5.png">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" value="5">
                                            </td>
                                            <td>
                                                <button class="btn btn-white"><i class="fa fa-trash"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <img src="img/gallery/6s.jpg">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" disabled
                                                       value="http://mydomain.com/images/image6.png">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" value="6">
                                            </td>
                                            <td>
                                                <button class="btn btn-white"><i class="fa fa-trash"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <img src="img/gallery/7s.jpg">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" disabled
                                                       value="http://mydomain.com/images/image7.png">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" value="7">
                                            </td>
                                            <td>
                                                <button class="btn btn-white"><i class="fa fa-trash"></i></button>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

</div>
