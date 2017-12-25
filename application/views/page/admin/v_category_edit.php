<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$entity_id = set_value('entity_id') == false ? $categories->getEntityId() : set_value('entity_id');
$category_name = set_value('category') == false ? $categories->getCategoryName() : set_value('category');
$parent_id = set_value('parent_id') == false ? $categories->getParentId() : set_value('parent_id');
$content = set_value('content') == false ? $categories->getContent() : set_value('content');
$is_anchor = set_value('is_anchor') == false ? $categories->getIsAnchor() : set_value('is_anchor');
$level = set_value('level') == false ? $categories->getLevel() : set_value('level');

?>
<?php foreach ($css as $c): ?>
    <link href="<?php echo base_url('public/css/') . $c ?>" rel="stylesheet">
<?php endforeach; ?>
<?php foreach ($js as $j): ?>
    <script src="<?php echo base_url('public/js/') . $j ?>"></script>
<?php endforeach; ?>
<script>
    var public_url = '<?= base_url('public/') ?>';
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
            <form id="form-product" action="<?= $url ?>" method="post">
                <input type="hidden" name="entity_id" id="entity_id" value="<?= $entity_id ?>">
                <div class="tabs-container">
                    <button class="btn btn-info pull-right" type="submit">Save product</button>
                    <ul class="nav nav-tabs">
                        <li class="active"><a data-toggle="tab" href="#tab-1"> Product info</a></li>
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
                                                    <button type="button" id="is_root" class="btn btn-success">Is root</button>
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
                                    <div class="form-group"><label class="col-sm-2 control-label">Name:</label>
                                        <div class="col-sm-10"><input type="text" class="form-control"
                                                                      placeholder="Product name" name="product_name"
                                                                      id="product_name"
                                                                      value="<?= $category_name ?>" size="50"></div>
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
                                </fieldset>

                            </div>
                        </div>
                        <div id="tab-2" class="tab-pane">
                            <div class="panel-body">

                                ccc


                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <form role="form" action="<?= base_url('admin/product/uploadImg') ?>" method="post"
                  enctype="multipart/form-data"
                  class="cc-dropzone"
                  id="cc-dropzone" style="display: none">
                <div class="row">
                    <h4>Upload product image </h4>
                    <div class="fallback">
                        <input name="file" id="file" type="file"/>
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
        $(".summernote").on("summernote.blur", function (e) {
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
            if($('#category_tree').jstree('get_selected')[0]){
                var parent = $('#category_tree').jstree('get_selected')[0].substr(4);
                $("#parent_id").val(parent);
            }
        });

        $('#category_tree').on("loaded.jstree", function (event, data) {
            var parent_id = $("#parent_id").val();
                $('#category_tree').jstree('select_node', "#cat_" + parent_id);
        });
        $('#is_root').click(function(){
            $('#category_tree').jstree(true).deselect_all();
            $("#parent_id").val(0);
        });

    });


    $('#check_all_related').click(function () {
        var sku = search_sku
    });
    function getRelatedProduct() {
        var page = 1;
        $.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>" + "admin/product/loadRelatedProduct",
            dataType: 'json',
            data: {
                page: page,
            },
            success: function (res) {
                alert(123);
                if (res.code == 1) {
                    toastr['success']('Delete Image successful', 'Success');
                    element.remove();
                } else {
                    toastr['error']('Something wrong. Can\'t remove this image', 'Error');
                }
            }
        });
    }

</script>
