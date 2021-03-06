<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$product = $data['product'];
if(isset($product['product_img'])){
    $product_img= $product['product_img'];
}else{
    $product_img= 'default-user-image.png';
}
?>

<!-- .row -->
<div class="row">
    <div class="col-md-4 col-xs-12">
        <div class="white-box">
            <div class="user-bg"><img width="100%" height="100%" alt="user" src="<?php echo base_url('public/images/users/').$product_img;?>">
            </div>
<!--            <div class="user-btm-box">-->
<!--                <div class="col-md-4 col-sm-4 text-center">-->
<!--                    <p class="text-purple"><i class="fa fa-facebook-square icon-3x"></i></p>-->
<!--                    <h1>258</h1></div>-->
<!--                <div class="col-md-4 col-sm-4 text-center">-->
<!--                    <p class="text-blue"><i class="ti-twitter"></i></p>-->
<!--                    <h1>125</h1></div>-->
<!--                <div class="col-md-4 col-sm-4 text-center">-->
<!--                    <p class="text-danger"><i class="ti-dribbble"></i></p>-->
<!--                    <h1>556</h1></div>-->
<!--            </div>-->
        </div>
    </div>
    <div class="col-md-8 col-xs-12">
        <div class="white-box">

                <?php
                if(isset($data['upload_error']) || validation_errors()){
                    echo " <div class=\"alert alert-danger\">";
                    echo validation_errors();
                    if(isset($data['upload_error'])){
                        echo "<br>".$data['upload_error'];
                    }
                    echo " </div>";
                }
                ?>

            <?php
            $formAttr = ['class' => 'form-horizontal form-material', 'id' => 'user-form'];
            $hidden = array('user_id' => isset($product['product_id']) ? $product['product_id'] : '');
            echo form_open_multipart($data['url'], $formAttr, $hidden);
            ?>
            <div class="form-group">
                <label class="col-md-12">Tên sản phẩm</label>
                <div class="col-md-12">
                    <?php
                    $input = array(
                        'name' => 'product_name',
                        'id' => 'firstname',
                        'value' => isset($product['product_name']) ? $product['product_name'] : '',
                        'maxlength' => '100',
                        'size' => '50',
                        'class' => 'form-control form-control-line',
                        'required'=>'required'
                    );
                    echo form_input($input);
                    ?>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-12">Giá</label>
                <div class="col-md-12">
                    <?php
                    $input = array(
                        'name' => 'price',
                        'id' => 'price',
                        'value' => isset($product['price']) ? $product['price'] : '',
                        'maxlength' => '100',
                        'size' => '50',
                        'class' => 'form-control form-control-line',
                        'required'=>'required'
                    );
                    echo form_input($input);
                    ?>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-12">SKU</label>
                <div class="col-md-12">
                    <?php
                    $input = array(
                        'name' => 'sku',
                        'id' => 'sku',
                        'value' => isset($product['sku']) ? $product['sku'] : '',
                        'maxlength' => '100',
                        'size' => '50',
                        'class' => 'form-control form-control-line',
                        'required'=>'required'
                    );
                    echo form_input($input);
                    ?>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-12">Số lượng</label>
                <div class="col-md-12">
                    <?php
                    $input = array(
                        'name' => 'qty',
                        'id' => 'qty',
                        'value' => isset($product['qty']) ? $product['qty'] : '',
                        'maxlength' => '100',
                        'size' => '50',
                        'class' => 'form-control form-control-line',
                        'required'=>'required'
                    );
                    echo form_input($input);
                    ?>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-12">Category</label>
                <div class="col-sm-12">
                    <?php
                    $options =$data['categories'];
                    echo form_multiselect('categories[]', $options, isset($product['product_category_ids']) ? explode(',',$product['product_category_ids']) : '', 'class="form-control form-control-line" id="user_group_id" required')
                    ?>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-12">Status</label>
                <div class="col-md-12 text-left">
                    <?php
                    $input = array(
                        'name' => 'is_instock',
                        'id' => 'Active',
                        'value' => isset($product['is_instock']) ? $product['is_instock'] : '',
                        'checked' => isset($product['is_instock']) ? $product['is_instock'] : '',
                        'maxlength' => '100',
                        'size' => '50',
                        'class' => 'form-control form-control-line pull-left',
                        'required'=>'required',
                        'type'=>'checkbox'
                    );
                    echo form_input($input);
                    ?>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-12">Hình</label>
                <div class="col-sm-12">
                    <img style="width: 150px;" id="user_img_preview" src="<?php echo base_url('public/images/users/').$product_img;?>" alt="" />
                    <input onchange="readURL(this);" type="file" name="user_img" id="user_img" accept="image/x-png,image/gif,image/jpeg" value="<?php echo base_url('public/images/users/').$product_img;?>" />
                </div>
            </div>
            <script>
                function readURL(input) {
                    if (input.files && input.files[0]) {
                        var reader = new FileReader();
                        reader.onload = function (e) {
                            $('#user_img_preview')
                                .attr('src', e.target.result)
                                .width(150)
                                .height(150);
                        };
                        reader.readAsDataURL(input.files[0]);
                    }
                }
            </script>

            <div class="form-group">
                <div class="col-sm-12">
                    <button class="btn btn-success">Update Product</button>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>
<!-- /.row -->