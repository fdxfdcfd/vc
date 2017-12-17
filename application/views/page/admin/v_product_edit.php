<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$entity_id = set_value('entity_id') == false ? $product->getEntityId() : set_value('entity_id');
$product_name = set_value('product_name') == false ? $product->getProductName() : set_value('product_name');
$product_category_ids = set_value('product_category_ids') == false ? $product->getProductCategoryIds() : set_value('product_category_ids');
$content = set_value('content') == false ? $product->getContent() : set_value('content');
$price = set_value('price') == false ? $product->getPrice() : set_value('price');
//$product_type = set_value('product_type') == false ? $product->getProductType() : set_value('product_type');
$qty = set_value('qty') == false ? $product->getQty() : set_value('qty');
$is_instock = set_value('is_instock') == false ? $product->getIsInstock() : set_value('is_instock');
$is_active = set_value('is_active') == false ? $product->getIsActive() : set_value('is_active');
$sku = set_value('sku') == false ? $product->getSku() : set_value('sku');
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
            <form id="form-product" action="<?=base_url('admin/product/edit/').$entity_id?>" method="post">
                <input type="hidden" name="entity_id" id="entity_id" value="<?=$entity_id?>">
                <div class="tabs-container">
                    <button class="btn btn-info pull-right" type="submit">Save product</button>
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
                                        <div class="col-sm-10"><input type="text" class="form-control" name="sku" id="sku"
                                                                      placeholder="SKU" value="<?= $sku ?>"></div>
                                    </div>
                                    <div class="form-group"><label class="col-sm-2 control-label">QTY:</label>
                                        <div class="col-sm-10">
                                            <input type="number" class="form-control"
                                                                      placeholder="qty" name="qty" id="qty" value="<?= $qty ?>"></div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Is In Stock:</label>
                                        <div class="col-sm-10">
                                            <input type="checkbox" name="is_instock" id="is_instock" value="1"
                                                   class="i-checks" <?php if ($is_instock) echo 'checked' ?>>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Enable:</label>
                                        <div class="col-sm-10">
                                            <input type="checkbox" name="is_active" id="is_active" value="1"
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
                                    <table class="table table-bordered table-stripped" id="product_img">
                                        <thead>
                                        <tr>
                                            <th>
                                                Image preview
                                            </th>
                                            <th>
                                                Image url
                                            </th>
                                            <th>
                                                Actions
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php foreach ($product_imgs as $img): ?>
                                            <tr>
                                                <td>
                                                    <img class="img-lg"
                                                         src="<?= base_url('public/') ?>img/gallery/<?= $img->product_img_name ?>">
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control" disabled
                                                           value="<?= base_url('public/') ?>img/gallery/<?= $img->product_img_name ?>">
                                                </td>
                                                <td>
                                                    <button  type="button"  data-img="<?=$img->entity_id?>" class="btn btn-white deleteImg"><i class="fa fa-trash"></i></button>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>

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
            "checkbox": {
                "keep_selected_style": false
            },
            "plugins": ["search", "checkbox", "wholerow", "sort"]
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
            var i, j, r = [];
            nodesOnSelectedPath = [...data.selected.reduce(function (acc, nodeId) {
                var node = data.instance.get_node(nodeId);
                return new Set([...acc,...node.parents, node.id
            ])
                ;
            }, new Set)
        ]
            ;
            for (var key in nodesOnSelectedPath) {
                if (nodesOnSelectedPath[key] == "#") {
                    nodesOnSelectedPath.splice(key, 1);
                }
                nodesOnSelectedPath[key] = nodesOnSelectedPath[key].substring(4);
            }
            $("#product_category_ids").val(nodesOnSelectedPath.join(","));
        });

        $('#category_tree').on("loaded.jstree", function (event, data) {
            var categories = $("#product_category_ids").val();
            console.log(categories);
            $.each(categories.split(","), function (i, val) {
                $('#category_tree').jstree('select_node', "#cat_" + val);
            });
        });
        Dropzone.autoDiscover = false;
        var myDropzone = new Dropzone("#cc-dropzone",
            {
                paramName: "file",
                maxFilesize: 10,
                acceptedFiles: 'image/*',
                maxFiles: 4,
                dictDefaultMessage: "<strong>Drop files here or click to upload. </strong><br> size must be < 2mb"
            });
        $("#cc-dropzone").addClass("dropzone");
        myDropzone.on("success", function (file, response) {
            var data = JSON.parse(response);
            if(data.code= 1){
                $img_url = public_url + 'img/gallery/' + data.message;
                $('#product_img tr:last').after('' +
                    '<tr>' +
                    '<td>' +
                    '<img class="img-lg" ' +
                    'src="' + $img_url + '"' +
                    '</td>' +
                    '<td>' +
                    '<input type="text" class="form-control" disabled ' +
                    'value="' + $img_url + '">' +
                    '</td>' +
                    '<td>' +
                    '<button  type="button" data-img="-1" class="btn btn-white deleteImg"><i class="fa fa-trash"></i></button>' +
                    '</td>' +
                    '</tr>' +
                    '');
                toastr['success']('Upload image succesful', 'Success');
            }else{
                toastr['error']('Something wrong. Can\'t remove this image', 'Error');
            }

        });
        myDropzone.on("error", function (file) {
            alert("Error. Please refresh and try again.");
        });
        $('body').on('click', 'a', function () {
            if (this.getAttribute('data-toggle') == 'tab') {
                if (this.getAttribute('href') == '#tab-4') {
                    $('#cc-dropzone').show();
                } else {
                    $('#cc-dropzone').hide();
                }
            }
        });
    });
    $('.deleteImg').click(function () {
        var id = $(this).attr('data-img');
        var element =  $(this)[0].parentNode.parentNode;
        console.log(element);
        alert(id);
        if(id != -1){
            $.ajax({
                type: "POST",
                url: "<?php echo base_url(); ?>" + "admin/product/deleteImg",
                dataType: 'json',
                data: {img_id: id},
                success: function(res){
                    if(res.result == 1){
                        toastr['success']('Delete Image successful', 'Success');
                        element.remove();
                    }else{
                        toastr['error']('Something wrong. Can\'t remove this image', 'Error');
                    }
                }
            });
        }
        else{
            toastr['success']('Delete Image successful', 'Success');
            console.log(element);
            element.remove();
        }
    });

</script>
