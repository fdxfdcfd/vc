<?php
defined('BASEPATH') OR exit('No direct script access allowed');
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

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="ibox-content m-b-sm border-bottom">
        <div class="row">
            <div class="col-sm-4">
                <div class="form-group">
                    <label class="control-label" for="product_name">Product Name</label>
                    <input type="text" id="product_name" name="product_name" value="" placeholder="Product Name"
                           class="form-control">
                </div>
            </div>
            <div class="col-sm-2">
                <div class="form-group">
                    <label class="control-label" for="price">Price</label>
                    <input type="text" id="price" name="price" value="" placeholder="Price" class="form-control">
                </div>
            </div>
            <div class="col-sm-2">
                <div class="form-group">
                    <label class="control-label" for="quantity">Quantity</label>
                    <input type="text" id="quantity" name="quantity" value="" placeholder="Quantity"
                           class="form-control">
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <label class="control-label" for="status">Status</label>
                    <select name="status" id="status" class="form-control">
                        <option value="1" selected>Enabled</option>
                        <option value="0">Disabled</option>
                    </select>
                </div>
            </div>
        </div>

    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox">
                <div class="ibox-content">

                    <table class="footable table table-stripped toggle-arrow-tiny" data-page-size="15">
                        <thead>
                        <tr>
                            <th data-toggle="true">Id</th>
                            <th>SKU</th>
                            <th>Product Name</th>
                            <th>Category</th>
                            <th>Branch</th>
                            <th>Status</th>
                            <th>Qty</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        foreach ($products as $product):
                            ?>
                            <tr>
                                <td>
                                    <?= $product->entity_id ?>
                                </td>
                                <td>
                                    <?= $product->sku ?>
                                </td>
                                <td>
                                    <?= $product->product_name ?>
                                </td>
                                <td>
                                    <?php
                                    $arrCategory = explode(',', $product->product_category_ids);
                                    foreach ($arrCategory as $category) {
                                        if (isset($categories[$category])) {
                                            echo "<span class=\"badge\">$categories[$category]</span>";
                                        }
                                    }
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    if (isset($branchs[$product->branch])) {
                                        echo "<span class=\"badge\">$branchs[$category]</span>";
                                    }
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    if ($product->is_instock) {
                                        echo "<span class='label label-primary'>In Stock</span>";
                                    } else {
                                        echo "<span class='label label-danger'>Out of Stock</span>";
                                    }
                                    ?>
                                </td>
                                <td>
                                    <?= $product->qty ?>
                                </td>
                                <td>
                                    <div class="btn-group">
                                    <a href="<?php echo base_url("admin/product/edit/id/") . $product->entity_id ?>"
                                       class="btn-white btn btn-xs btn-info" role="button">Edit</a>
                                    <a href2="<?php echo base_url("admin/product/deletePost/id/") . $product->entity_id ?>"
                                       class="btn-white btn btn-xs btn-danger" id="delete_user" role="button">Delete</a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                        <tfoot>
                        <tr>
                            <td colspan="8" class="footable-visible">
                                <?php echo $link;?>
                            </td>
                        </tr>
                        </tfoot>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $('#delete_user').click(function (event) {
        event.preventDefault();
        var link = $(this).attr('href2');
        bootbox.confirm('Are you sure to delete this Product?', function ($result) {
            if ($result) {
                window.location.replace(link);
            }
        });
    });
</script>