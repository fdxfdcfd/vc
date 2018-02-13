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
    var public_url = '<?= base_url('public/admin/') ?>';
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
                                                <?= $content ?>
                                            </div>
                                        </div>
                                    </div>
                                    <textarea style="display: none" name="content" id="content" cols="30" rows="10">
                                    <?= $content ?>
                                    </textarea>
                                    <div class="form-group"><label class="col-sm-2 control-label">Order:</label>
                                        <div class="col-sm-10">
                                            <input type="number" class="form-control" placeholder="Order" name="order"
                                                                      id="order"
                                                                      value="<?= $order ?>" size="50"></div>
                                    </div>
                                    <div class="form-group"><label class="col-sm-2 control-label">Link out site:</label>
                                        <div class="col-sm-10">
                                            <input type="number" class="form-control" placeholder="Link outsite" name="link_outsite"
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
                                                            <label class="btn btn-sm btn-white"> <input type="radio" id="option1" name="options"> Day </label>
                                                            <label class="btn btn-sm btn-white active"> <input type="radio" id="option2" name="options"> Week </label>
                                                            <label class="btn btn-sm btn-white"> <input type="radio" id="option3" name="options"> Month </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <div class="input-group"><input type="text" placeholder="Search" class="input-sm form-control"> <span class="input-group-btn">
                                        <button type="button" class="btn btn-sm btn-primary"> Go!</button> </span></div>
                                                    </div>
                                                </div>
                                                <div class="table-responsive">
                                                    <table class="table table-striped">
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
                                                        <tr>
                                                            <td><input type="checkbox"  checked class="i-checks" name="input[]"></td>
                                                            <td>Project<small>This is example of project</small></td>
                                                            <td><span class="pie">0.52/1.561</span></td>
                                                            <td>20%</td>
                                                            <td>Jul 14, 2013</td>
                                                            <td><a href="#"><i class="fa fa-check text-navy"></i></a></td>
                                                        </tr>
                                                        </tbody>
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
        $(".summernote").on("summernote.blur", function (e) {
            $("#content").val($('.summernote').summernote('code'));
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
