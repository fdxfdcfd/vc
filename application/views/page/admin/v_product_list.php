<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$product_name = isset($dataSearch['product_name']) ? $dataSearch['product_name'] : '';
$price = isset($dataSearch['price']) ? $dataSearch['price'] : '';
$qty = isset($dataSearch['qty']) ? $dataSearch['qty'] : '';
$is_instock = isset($dataSearch['is_instock']) ? $dataSearch['is_instock'] : '';
$product_category_ids = isset($dataSearch['product_category_ids']) ? $dataSearch['product_category_ids'] : '';
$is_active = isset($dataSearch['is_active']) ? $dataSearch['is_active'] : '';
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
            <form action="" class="form">
                <div class="col-sm-4">
                    <div class="form-group">
                        <label class="control-label" for="product_name">Product Name</label>
                        <input type="text" id="product_name" name="product_name" placeholder="Product Name"
                               class="form-control" value="<?= $product_name ?>">
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <label class="control-label" for="price">Price</label>
                        <input type="text" id="price" name="price" placeholder="Price" class="form-control"  value="<?= $price ?>">
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <label class="control-label" for="qty">Quantity</label>
                        <input type="text" id="qty" name="qty"  value="<?= $qty ?>" placeholder="Quantity"
                               class="form-control">
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label class="control-label" for="is_instock">Stock</label>
                        <select name="is_instock" id="is_instock" class="form-control">
                            <option value="1" selected>In Stock</option>
                            <option value="0">Out of Stock</option>
                        </select>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label class="control-label" for="categories">Category</label>
                        <select name="product_category_ids" id="categories" class="form-control">
                            <option value="1" selected>Enabled</option>
                            <option value="0">Disabled</option>
                        </select>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label class="control-label" for="is_active">Status</label>
                        <select name="is_active" id="is_active" class="form-control">
                            <option value="1" selected>Enabled</option>
                            <option value="0">Disabled</option>
                        </select>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label class="control-label" for="submit">&nbsp;&nbsp;&nbsp;&nbsp;</label>
                        <button id="submit" type="submit" class="btn btn-info align-bottom form-control">Search</button>
                    </div>
                </div>
            </form>
        </div>

    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox">
                <div class="ibox-content">

                    <table class="footable table table-stripped toggle-arrow-tiny table-hover" data-page-size="15">
                        <thead>
                        <tr>
                            <th data-toggle="true">Id</th>
                            <th>SKU</th>
                            <th>Product Name</th>
                            <th>Category</th>
                            <th>Qty</th>
                            <th>Stock status</th>
                            <th>Status</th>

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
                                    <?= $product->qty ?>
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
                                    <?php
                                    if ($product->is_active) {
                                        echo "<span class='label label-primary'>Active</span>";
                                    } else {
                                        echo "<span class='label label-danger'>In Active</span>";
                                    }
                                    ?>
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <a href="<?php echo base_url("admin/product/edit/") . $product->entity_id ?>"
                                           class="btn-white btn btn-xs btn-info" role="button">Edit</a>
                                        <a href2="<?php echo base_url("admin/product/deletePost/") . $product->entity_id ?>"
                                           class="btn-white btn btn-xs btn-danger" id="delete_user"
                                           role="button">Delete</a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                        <tfoot>
                        <tr>
                            <td colspan="8" class="footable-visible">
                                <?php echo $link; ?>
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