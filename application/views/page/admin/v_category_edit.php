<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$entity_id = set_value('entity_id') == false ? $categories->getEntityId() : set_value('entity_id');
$category_name = set_value('category') == false ? $categories->getCategoryName() : set_value('category');
$parent_id = set_value('parent_id') == false ? $categories->getParentId() : set_value('parent_id');
$category_type = set_value('category_type') == false ? $categories->getCategoryType() : set_value('category_type');
$content = set_value('content') == false ? $categories->getContent() : set_value('content');
$link_outsite = set_value('link_outsite ') == false ? $categories->getLinkOutsite() : set_value('link_outsite ');
$is_anchor = set_value('is_anchor') == false ? $categories->getIsAnchor() : set_value('is_anchor');
$level = set_value('level') == false ? $categories->getLevel() : set_value('level');
$order = set_value('order') == false ? $categories->getOrder() : set_value('order');
?>
<?php foreach ($css as $c): ?>
    <link href="<?php echo base_url('public/admin/css/') . $c ?>" rel="stylesheet">
<?php endforeach; ?>
<?php foreach ($js as $j): ?>
    <script src="<?php echo base_url('public/admin/js/') . $j ?>"></script>
<?php endforeach; ?>
<script>
    var public_url = '<?php echo base_url('public/admin/') ?>';
</script>
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
            <form id="form-category" action="<?= $url ?>" method="post">
                <input type="hidden" name="entity_id" id="entity_id" value="<?= $entity_id ?>">
                <div class="tabs-container">
                    <button class="btn btn-info pull-right" type="submit">Save Category</button>
                    <ul class="nav nav-tabs">
                        <li class="active"><a data-toggle="tab" href="#tab-1"> Category info</a></li>
                        <li class=""><a data-toggle="tab" href="#tab-2"> Data</a></li>
                    </ul>
                    <div class="tab-content">
                        <div id="tab-1" class="tab-pane active">
                            <div class="panel-body">
                                <fieldset class="form-horizontal">
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
                                                    <input type="hidden" name="parent_id"
                                                           id="parent_id" value="<?= $parent_id ?>">
                                                    <button type="button" id="is_root" class="btn btn-success">Is root
                                                    </button>
                                                    <div id="category_tree">
                                                    </div>

                                                </div>
                                                <div class="col-sm-4"></div>

                                            </div>
                                    </div>
                                    <div class="form-group"><label class="col-sm-2 control-label">Name:</label>
                                        <div class="col-sm-10"><input type="text" class="form-control"
                                                                      placeholder="Category name" name="category_name"
                                                                      id="category_name"
                                                                      value="<?= $category_name ?>" size="50"></div>
                                    </div>
                                    <div class="form-group"><label class="col-sm-2 control-label">Category type</label>
                                        <div class="col-sm-10">
                                            <select class="form-control m-b" name="category_type">
                                                <option value="1" <?php if ($category_type == 1) echo 'selected'; ?>>
                                                    Product only
                                                </option>
                                                <option value="2" <?php if ($category_type == 2) echo 'selected'; ?>>
                                                    Static block and product
                                                </option>
                                                <option value="3" <?php if ($category_type == 3) echo 'selected'; ?>>
                                                    Static block
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group"><label class="col-sm-2 control-label">Description:</label>
                                        <div class="col-sm-10">
                                            <div class="summernote">
                                                <?php echo $content ?>
                                            </div>
                                        </div>
                                    </div>
                                    <textarea style="display: none" name="content" id="ct" cols="30" rows="10">
                                    <?php echo $content ?>
                                    </textarea>
                                    <div class="form-group"><label class="col-sm-2 control-label">Order:</label>
                                        <div class="col-sm-10">
                                            <input type="number" class="form-control" placeholder="Order" name="order"
                                                                      id="order"
                                                                      value="<?= $order ?>" size="50"></div>
                                    </div>
                                    <div class="form-group"><label class="col-sm-2 control-label">Link out site:</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" placeholder="Link outsite" name="link_outsite"
                                                                      id="link_outsite"
                                                                      value="<?= $link_outsite ?>" size="50"></div>
                                    </div>
                                </fieldset>

                            </div>
                        </div>
                        <div id="tab-2" class="tab-pane">
                            <div class="panel-body">

                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="ibox float-e-margins">
                                            <div class="ibox-title">
                                                <h5>Asign product</h5>
                                                <div class="ibox-tools">
                                                    <a class="collapse-link">
                                                        <i class="fa fa-chevron-up"></i>
                                                    </a>
                                                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                                        <i class="fa fa-wrench"></i>
                                                    </a>
                                                    <ul class="dropdown-menu dropdown-user">
                                                        <li><a href="#">Config option 1</a>
                                                        </li>
                                                        <li><a href="#">Config option 2</a>
                                                        </li>
                                                    </ul>
                                                    <a class="close-link">
                                                        <i class="fa fa-times"></i>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="ibox-content">
                                                <div class="row">
                                                    <div class="col-sm-4 m-b-xs">
                                                        <div data-toggle="buttons" class="btn-group">
                                                            <label class="btn btn-sm btn-white"> <input type="radio" value="yes" id="option1" name="type_search"> Yes </label>
                                                            <label class="btn btn-sm btn-white"> <input type="radio"  value="no" id="option2" name="type_search"> No </label>
                                                            <label class="btn btn-sm btn-white active"> <input type="radio" selected="selected" value="any" id="option3" name="type_search"> Any </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <div class="input-group"><input id="asign_product_search" type="text" placeholder="Search" class="input-sm form-control"> <span class="input-group-btn">
                                        <button type="button" class="btn btn-sm btn-primary"> Go!</button> </span></div>
                                                    </div>
                                                </div>
                                                <div class="table-responsive">
                                                    <table class="table table-striped asign_product_table">
                                                        <thead>
                                                        <tr>
                                                            <th></th>
                                                            <th>Product id</th>
                                                            <th>Product name</th>
                                                            <th>SKU</th>
                                                            <th>Price</th>
                                                            <th>Action</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <?php if (count($asign_product_list['products'])): ?>
                                                            <?php foreach ($asign_product_list['products'] as $product):?>
                                                            <tr>
                                                                <td><input type="checkbox"  <?php if(in_array($product->entity_id,$asign_product)) echo 'checked' ?> class="i-checks product_id" data-product-id = "<?php echo $product->entity_id?>" name="asign_product[]"></td>
                                                                <td>
                                                                    <?php echo $product->entity_id?>
                                                                </td>
                                                                <td>
                                                                    <?php echo $product->product_name?>
                                                                </td>
                                                                <td>
                                                                    <?php echo $product->sku?>
                                                                </td>
                                                                <td><?php echo $product->price?></td>
                                                                <td><a href="#"><i class="fa fa-check text-navy"></i></a>
                                                                </td>
                                                            </tr>
                                                            <?php endforeach;?>
                                                        <?php endif; ?>
                                                        </tbody>
                                                        <tfoot>
                                                        <tr>
                                                            <td colspan="8">
                                                                <ul class="pagination pull-right">
                                                                    <li class="footable-page-arrow previous-arrow"
                                                                    <?php if($asign_product_list['current_page'] == 1):?>
                                                                        style="display: none"
                                                                    <?php endif;?>
                                                                        href="javascript:void(0)"
                                                                    ><a
                                                                                href="javascript:void(0)"
                                                                                onclick="getAsignProductsList(<?php echo $asign_product_list['current_page'] -1?>)"
                                                                                rel="prev">‹</a></li>
                                                                    <?php for ($i = 1 ; $i <= $asign_product_list['total_page'] ; $i++):?>
                                                                    <li class="footable-page <?php if(  $asign_product_list['current_page'] == $i) echo 'active'?>" data-page="<?php echo $i?>"><a
                                                                                href="javascript:void(0)"
                                                                                onclick="getAsignProductsList(<?php echo $i?>)" rel="start"><?php echo $i?></a>
                                                                    </li>
                                                                    <?php endfor;?>
                                                                    <li class="footable-page-arrow next-arrow"><a
                                                                                data-ci-pagination-page="3"
                                                                            <?php if($asign_product_list['current_page'] == $asign_product_list['total_page']):?>
                                                                                style="display: none"
                                                                            <?php endif;?>
                                                                                href="javascript:void(0)"
                                                                                onclick="getAsignProductsList(<?php echo $asign_product_list['current_page'] +1?>)"
                                                                                rel="next">›</a></li>
                                                                </ul>
                                                            </td>
                                                        </tr>
                                                        </tfoot>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

</div>
<script>
    $(document).ready(function () {
        //summer note
        $('.summernote').summernote({
            minHeight: 300
        });
        $(".summernote").on("summernote.change", function (e) {   // callback as jquery custom event
            $("#ct").html($('.summernote').summernote('code'));
        });

        $('#form-category').submit(function(){
            $("#content").val($('.summernote').summernote('code'));
        });
        //datepiker
        $('.input-group.date').datepicker({
            todayBtn: "linked",
            keyboardNavigation: false,
            forceParse: false,
            calendarWeeks: true,
            autoclose: true
        });
        //icheck
        $('.i-checks').iCheck({
            checkboxClass: 'icheckbox_square-green',
            radioClass: 'iradio_square-green',
        });

        $('#category_tree').jstree({
            "core": {
                "themes": {
                    "variant": "large"
                },
                "data": <?=$treeCategories?>
            },

            "plugins": ["search", "wholerow", "sort"]
        });

        var to = false;

        $('#search_category').keyup(function () {
            if (to) {
                clearTimeout(to);
            }
            to = setTimeout(function () {
                var v = $('#search_category').val();
                $('#category_tree').jstree(true).search(v);
            }, 250);
        });
        $('#category_tree').on('changed.jstree', function (e, data) {
            if ($('#category_tree').jstree('get_selected')[0]) {
                var parent = $('#category_tree').jstree('get_selected')[0].substr(4);
                $("#parent_id").val(parent);
            }
        });

        $('#category_tree').on("loaded.jstree", function (event, data) {
            var parent_id = $("#parent_id").val();
            $('#category_tree').jstree('select_node', "#cat_" + parent_id);
        });
        $('#is_root').click(function () {
            $('#category_tree').jstree(true).deselect_all();
            $("#parent_id").val(0);
        });

    });
    <?php
    $js_array = json_encode($this->session->userdata('asign_product'));
    echo "asign_product = ". $js_array . ";\n";
    ?>

    $('#check_all_related').click(function () {
        var sku = search_sku
    });



    function updateAsignProduct(product_id, checked){
        $.ajax({
            type: "GET",
            url: "<?php echo base_url(); ?>" + "admin/category/updateSessionAsignProduct",
            dataType: 'json',
            data: {
                product_id: product_id,
                checked : checked
            },
            success: function (res) {
                if (res.code == 1) {
                    asign_product = res.asign_product;
                } else {
                    toastr['error']('Something wrong. Can\'t asign this produ', 'Error');
                }
            }
        });
    }

    $(".product_id").on("ifChanged", function(){
        updateAsignProduct($(this).attr('data-product-id'), $(this).is(':checked') );
    });
    function getAsignProductsList(page) {
        var id = <?php echo $entity_id ? $entity_id : 0;?>;
        var type = $('input[name="type_search"]').val();
        var search = $('#asign_product_search').val();
        $.ajax({
            type: "GET",
            url: "<?php echo base_url(); ?>" + "admin/category/getAsignProductList",
            dataType: 'json',
            data: {
                id: id,
                type: type,
                search: search,
                page: page
            },
            success: function (res) {
                if (res.code == 1) {
                    $('.footable-page').removeClass('active');
                    html = '';
                    data = res.products;
                    $.each(data,function(i,item){
                        var is_asign = $.inArray( item.entity_id.toString(), asign_product ) >= 0 ? 'checked' : "";
                        html += ' <tr>\n';
                        html +='<td><input type="checkbox" '+is_asign +' class="i-checks product_id" data-product-id = "'+item.entity_id+'" name="asign_product[]"></td>\n';
                        html +='<td>\n' ;
                        html +=item.entity_id+'\n' ;
                        html +='</td>\n' ;
                        html +='<td>\n' ;
                        html +=item.product_name+'\n' ;
                        html +='</td>\n' ;
                        html +='<td>\n' ;
                        html +=item.sku+'\n' ;
                        html +='</td>\n' ;
                        html +='<td>'+item.price+'</td>\n' ;
                        html +='<td><a href="#"><i class="fa fa-check text-navy"></i></a>\n' ;
                        html +='</td>\n' ;
                        html +=' </tr>';

                    });
                    $('.asign_product_table > tbody').html(html);
                    $('.i-checks').iCheck({
                        checkboxClass: 'icheckbox_square-green',
                        radioClass: 'iradio_square-green',
                    });
                    $(".product_id").on("ifChanged", function(){
                        updateAsignProduct($(this).attr('data-product-id'));
                    });
                    if(page > 1 ){
                        $('.previous-arrow').show()
                        $('.previous-arrow a').attr('onclick','getAsignProductsList('+ (res.current_page -1) +')');
                    }else{
                        $('.previous-arrow').hide()
                    }
                    if(page == res.total_page ){
                        $('.next-arrow').hide()
                    }else{
                        $('.next-arrow').show()
                        $('.next-arrow a').attr('onclick','getAsignProductsList('+ (parseInt(res.current_page) + 1) +')');
                    }
                    $.each($('.footable-page'),function(i,item){
                        if(!$(item).hasClass('active') && $(item).attr('data-page') == res.current_page){
                            $(item).addClass('active');
                        }
                    });
                } else {
                    toastr['error']('Something wrong. Can\'t load this page', 'Error');
                }
            }
        });
        return false;
    }
</script>
