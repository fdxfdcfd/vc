<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!--row -->
<div class="row">
    <div class="col-sm-12">
        <div class="white-box">
            <h3 class="box-title">Recent sales
                <div class="col-md-2 col-sm-4 col-xs-12 pull-right">
<!--                    <select class="form-control pull-right row b-none">-->
<!--                        <option>March 2016</option>-->
<!--                        <option>April 2016</option>-->
<!--                        <option>May 2016</option>-->
<!--                        <option>June 2016</option>-->
<!--                        <option>July 2016</option>-->
<!--                    </select>-->
                    <a class="btn btn-success" href="<?php  echo base_url('admin/user/create')?>">Thêm User</a>
                </div>
            </h3>
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                    <tr>
                        <th>Id</th>
                        <th>Product Name</th>
                        <th>Price</th>
                        <th>SKU</th>
                        <th>Quantity</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    if($products):
                    foreach ($products as $key=> $value):
                    ?>
                    <tr>
                        <td><?php echo $value['product_id']?></td>
                        <td><?php echo $value['product_name']?></td>
                        <td><?php echo $value['price']?></td>
                        <td><?php echo $value['sku']?></td>
                        <td><?php echo $value['qty']?></td>
                        <td><?php
                            if($value['is_instock'])
                            {
                                echo "<span class='label label-success'>In Stock</span>";
                            }else{
                                echo "<span class='label label-danger'>In Stock</span>";
                            }
                            ?></td>
                        <td>
                            <a href="<?php echo base_url("admin/product/edit/id/").$value['product_id']?>" class="btn btn-info" role="button">Edit</a>
                            <a href="<?php echo base_url("admin/product/deletePost/id/").$value['product_id']?>" class="btn btn-danger delete_user" role="button">Delete</a>
                        </td>
                    </tr>
                    <?php
                    endforeach;
                    endif;
                    ?>
                    </tbody>
                </table></div>
        </div>
    </div>
    <script>
        $('.delete_user').click(function (event) {
            event.preventDefault();
            var link=$(this).attr('href');
            bootbox.confirm('Are you sure to delete this User?', function($result){
                if($result){
                    window.location.replace(link);
                }
            });
        });
    </script>
</div>
<!-- /.row -->