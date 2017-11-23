<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2><?=$title?></h2>
        <ol class="breadcrumb">
            <?php
            end($breadcrumb);
            $first = key($breadcrumb);
            ?>
            <?php foreach ($breadcrumb as $key => $value):?>
                <li <?php if($key == $first) echo 'class="active"'?>>
                    <?php if($key == $first) echo '<b>'?><a href="<?=$value?>"><?=$key?></a><?php if($key == $first) echo '</b>'?>
                </li>
            <?php endforeach;?>
        </ol>
    </div>
    <div class="col-lg-2">

    </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5></h5>
                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                        <a class="close-link">
                            <i class="fa fa-times"></i>
                        </a>
                    </div>
                </div>
                <div class="ibox-content">

                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover dataTables-example">
                            <thead>
                            <tr>
                                <th>Id</th>
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
                                        <?=$product->entity_id?>
                                    </td>
                                    <td>
                                        <?=$product->sku?>
                                    </td>
                                    <td>
                                        <?=$product->product_name?>
                                    </td>
                                    <td>
                                       <?php
                                       $arrCategory= explode(',', $product->product_category_ids);
                                       foreach($arrCategory as $category){
                                           if(isset($categories[$category])){
                                              echo "<span class=\"badge\">$categories[$category]</span>";
                                           }
                                       }
                                       ?>
                                    </td>
                                    <td>
                                        <?php
                                            if(isset($branchs[$product->branch])){
                                                echo "<span class=\"badge\">$branchs[$category]</span>";
                                            }
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        if($product->is_instock){
                                            echo "<span class='btn btn-success'>In Stock</span>";
                                        }else{
                                            echo "<span class='btn btn-danger'>Out of Stock</span>";
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <?=$product->qty?>
                                    </td>
                                    <td>
                                        <a href="<?php echo base_url("admin/product/edit/id/").$product->entity_id?>" class="btn btn-info" role="button">Edit</a>
                                        <a href2="<?php echo base_url("admin/product/deletePost/id/").$product->entity_id?>" class="btn btn-danger" id = "delete_user" role="button">Delete</a>
                                    </td>
                                </tr>
                            <?php endforeach;?>
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>Id</th>
                                <th>SKU</th>
                                <th>Product Name</th>
                                <th>Category</th>
                                <th>Branch</th>
                                <th>Status</th>
                                <th>Qty</th>
                                <th>Action</th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $('#delete_user').click(function (event) {
        event.preventDefault();
        var link=$(this).attr('href2');
        bootbox.confirm('Are you sure to delete this Product?', function($result){
            if($result){
                window.location.replace(link);
            }
        });
    });
</script>