<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$user = $data['user'];
if(isset($user_img)){
    $user_img= $user_img;
}else{
    $user_img= 'default-user-image.png';
}

?>

<!-- .row -->
<div class="row">
    <div class="col-md-4 col-xs-12">
        <div class="white-box">
            <div class="user-bg"><img width="100%" alt="user" src="<?php echo base_url('public/images/users/').$user_img;?>">
                <div class="overlay-box">
                    <div class="user-content">
                        <a href="javascript:void(0)"><img src="<?php echo base_url('public/images/users/').$user_img;?>"
                                                          class="thumb-lg img-circle" alt="img"></a>
                        <h4 class="text-white">User Name</h4>
                        <h5 class="text-white">info@myadmin.com</h5></div>
                </div>
            </div>
            <div class="user-btm-box">
                <div class="col-md-4 col-sm-4 text-center">
                    <p class="text-purple"><i class="ti-facebook"></i></p>
                    <h1>258</h1></div>
                <div class="col-md-4 col-sm-4 text-center">
                    <p class="text-blue"><i class="ti-twitter"></i></p>
                    <h1>125</h1></div>
                <div class="col-md-4 col-sm-4 text-center">
                    <p class="text-danger"><i class="ti-dribbble"></i></p>
                    <h1>556</h1></div>
            </div>
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
            $hidden = array('user_id' => isset($user['user_id']) ? $user['user_id'] : '');
            echo form_open_multipart($data['url'], $formAttr, $hidden);
            ?>
            <div class="form-group">
                <label class="col-md-12">Tên</label>
                <div class="col-md-12">
                    <?php
                    $input = array(
                        'name' => 'firstname',
                        'id' => 'firstname',
                        'value' => isset($user['firstname']) ? $user['firstname'] : '',
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
                <label class="col-md-12">Họ</label>
                <div class="col-md-12">
                    <?php
                    $input = array(
                        'name' => 'lastname',
                        'id' => 'lastname',
                        'value' => isset($user['lastname']) ? $user['lastname'] : '',
                        'maxlength' => '100',
                        'size' => '50',
                        'class' => 'form-control form-control-line',
                        'required'=>'required'
                    );
                    echo form_input($input);
                    ?>
                </div>
            </div>
            <?php if(strpos($data['url'],'create')) :?>
            <div class="form-group">
                <label class="col-md-12">Username</label>
                <div class="col-md-12">
                    <?php
                    $input = array(
                        'name' => 'username',
                        'id' => 'username',
                        'value' => isset($user['username']) ? $user['username'] : '',
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
                <label class="col-md-12">Password</label>
                <div class="col-md-12">
                    <?php
                    $input = array(
                        'name' => 'password',
                        'id' => 'Password',
                        'value' => isset($user['password']) ? $user['password'] : '',
                        'maxlength' => '100',
                        'size' => '50',
                        'class' => 'form-control form-control-line',
                        'required'=>'required',
                        'type'=>'password'
                    );
                    echo form_input($input);
                    ?>
                </div>
            </div>
            <?php endif; ?>
            <div class="form-group">
                <label class="col-md-12">Email</label>
                <div class="col-md-12">
                    <?php
                    $input = array(
                        'name' => 'email',
                        'id' => 'email',
                        'value' => isset($user['email']) ? $user['email'] : '',
                        'maxlength' => '100',
                        'size' => '50',
                        'type' => 'email',
                        'class' => 'form-control form-control-line',
                        'required'=>'required'
                    );
                    echo form_input($input);
                    ?>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-12">User Group</label>
                <div class="col-sm-12">
                    <?php
                    $options =$data['user_group'];

                    echo form_dropdown('user_group_id', $options, isset($user['user_group_id']) ? $user['user_group_id'] : '', 'class="form-control form-control-line" id="user_group_id" required')
                    ?>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-12">Active</label>
                <div class="col-md-12 text-left">
                    <?php
                    $input = array(
                        'name' => 'is_active',
                        'id' => 'Active',
                        'value' => isset($user['is_active']) ? $user['is_active'] : '',
                        'checked' => isset($user['is_active']) ? $user['is_active'] : '',
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
                    <img style="width: 150px;" id="user_img_preview" src="<?php echo base_url('public/images/users/').$user_img;?>" alt="" />
                    <input onchange="readURL(this);" type="file" name="user_img" id="user_img" accept="image/x-png,image/gif,image/jpeg" value="<?php echo base_url('public/images/users/').$user_img;?>" />
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
                    <button class="btn btn-success">Update Profile</button>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>
<!-- /.row -->