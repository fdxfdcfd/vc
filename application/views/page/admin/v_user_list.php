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
                    foreach ($users as $key=> $value):
                    ?>
                    <tr>
                        <?php foreach ($value as $k=>$v):?>
                            <?php
                            if ($k == 'is_active'){
                                if($v){
                                    echo "<td><span class='btn btn-success'>Active</span></td>";
                                }else{
                                    echo "<td><span class='btn btn-danger'>Inactive</span></td>";
                                }

                            }else{
                                echo "<td>$v</td>";
                            }
                            ?>
                        <?php endforeach; ?>
                        <td>
                            <a href="<?php echo base_url("admin/user/edit/id/").$value['user_id']?>" class="btn btn-info" role="button">Edit</a>
                            <a href="<?php echo base_url("admin/")?>" class="btn btn-danger delete_user" role="button">Delete</a>
                        </td>
                    </tr>
                    <?php endforeach;?>
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