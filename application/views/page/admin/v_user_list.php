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
<!--                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">-->
<!--                            <i class="fa fa-wrench"></i>-->
<!--                        </a>-->
<!--                        <ul class="dropdown-menu dropdown-user">-->
<!--                            <li><a href="#">Config option 1</a>-->
<!--                            </li>-->
<!--                            <li><a href="#">Config option 2</a>-->
<!--                            </li>-->
<!--                        </ul>-->
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
                                <th>Firstname</th>
                                <th>Lastname</th>
                                <th>Email</th>
                                <th>Active</th>
                                <th>User Group</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            foreach ($users as $user):
                                ?>
                                <tr>
                                    <td>
                                        <?=$user->user_id?>
                                    </td>
                                    <td>
                                        <?=$user->firstname?>
                                    </td>
                                    <td>
                                        <?=$user->lastname?>
                                    </td>
                                    <td>
                                        <?=$user->email?>
                                    </td>
                                    <td>
                                        <?php
                                        if($user->is_active){
                                            echo "<span class='btn btn-success'>Active</span>";
                                        }else{
                                            echo "<span class='btn btn-danger'>Inactive</span>";
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <?=$user->user_group_id?>
                                    </td>
                                    <td>
                                        <a href="<?php echo base_url("admin/user/edit/id/").$user->user_id?>" class="btn btn-info" role="button">Edit</a>
                                        <a href2="<?php echo base_url("admin/user/deletePost/id/").$user->user_id?>" class="btn btn-danger" id = "delete_user" role="button">Delete</a>
                                    </td>
                                </tr>
                            <?php endforeach;?>
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>Id</th>
                                <th>Firstname</th>
                                <th>Lastname</th>
                                <th>Email</th>
                                <th>Active</th>
                                <th>User Group</th>
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
        bootbox.confirm('Are you sure to delete this User?', function($result){
            if($result){
                window.location.replace(link);
            }
        });
    });
</script>