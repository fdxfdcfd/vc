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
    <div class="row">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <div class="ibox-tools">
                    <a class="collapse-link">
                        <i class="fa fa-chevron-up"></i>
                    </a>
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-wrench"></i>
                    </a>
                    <a class="close-link">
                        <i class="fa fa-times"></i>
                    </a>
                </div>
            </div>
            <div class="ibox-content">
                <div class="row">
                    <h3 class="m-t-none m-b">Thông tin cơ bản.</h3>
                    <?php if(validation_errors()):?>
                    <div class="alert alert-danger">
                        <?php echo validation_errors(); ?>
                    </div>
                    <?php endif;?>
                    <form role="form" action="<?= $url ?>" method="post" enctype="multipart/form-data"
                          id="userForm">
                        <div class="">
                            <input type="hidden" name="admin_user_id" id="admin_user_id"
                                   value="<?php echo isset($user['admin_user_id']) ? $user['admin_user_id'] : '' ?>">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Firstname</label>
                                    <input type="text" placeholder="Firstname" name="firstname" id="firstname"
                                           class="form-control"
                                           value="<?php echo isset($user['firstname']) ? $user['firstname'] : '' ?>">
                                </div>
                                <div class="form-group">
                                    <label>Lastname</label>
                                    <input type="text" placeholder="Lastname" name="lastname" id="lastname"
                                           class="form-control"
                                           value="<?php echo isset($user['lastname']) ? $user['lastname'] : '' ?>">
                                </div>
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="text" placeholder="Email" name="email" id="email" class="form-control"
                                           value="<?php echo isset($user['email']) ? $user['email'] : '' ?>">
                                </div>

                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="font-normal">User group</label>
                                    <select data-placeholder="Choose user group" class="chosen-select" name="user_group_id">
                                        <?php foreach ($user_group as $key => $value): ?>
                                            <?php
                                            $user_group_id = isset($user['user_group_id']) ? $user['user_group_id'] : '';
                                            if ($user_group_id == $key):?>
                                                <option selected value="<?= $key ?>"><?= $value ?></option>
                                            <?php else: ?>
                                                <option value="<?= $key ?>"><?= $value ?></option>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Position</label>
                                    <input type="text" placeholder="Position" name="position" id="position"
                                           class="form-control"
                                           value="<?php echo isset($user['position']) ? $user['position'] : '' ?>">
                                </div>
                                <div class="form-group">
                                    <div class="onoffswitch">
                                        <input type="checkbox" checked="<?php echo $user['is_active'] ?  'true' : 'false' ?>" class="onoffswitch-checkbox" name="is_active" id="is_active" value="1">
                                        <label class="onoffswitch-label" for="is_active">
                                            <span class="onoffswitch-inner"></span>
                                            <span class="onoffswitch-switch"></span>
                                        </label>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <button class="btn btn-sm btn-primary pull-right m-t-n-xs" type="submit">
                                        <strong>Submit</strong></button>
                                </div>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </form>

                    <form role="form" action="<?= $urlUpload ?>" method="post" enctype="multipart/form-data"
                          class="dropzone"
                          id="dropzoneForm">
                        <div class="row">
                            <h4>Upload profile image </h4>
                            <div class="fallback">
                                <input name="file" id="file" type="file"/>
                            </div>
                        </div>
                    </form>


                </div>
            </div>
        </div>
    </div>
</div>