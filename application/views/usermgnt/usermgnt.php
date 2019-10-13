<!--sidebar end-->
<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">
        <!-- page start-->
        <section class="panel">
            <header class="panel-heading">
                <i class="fa fa-user"></i>  <?php echo lang('emp'); ?>
            </header>
            <div class="panel-body">
                <div class="adv-table editable-table ">
                    <div class="clearfix no-print">
                        <a data-toggle="modal" href="#myModal">
                            <div class="btn-group">
                                <button id="" class="btn green">
                                    <i class="fa fa-plus-circle"></i> <?php echo lang('add_user'); ?>
                                </button>
                            </div>
                        </a>
                        <button class="export no-print" onclick="javascript:window.print();"><?php echo lang('print'); ?></button>  
                    </div>
                    <div class="space15"></div>
                    <table class="table table-striped table-hover table-bordered" id="editable-sample">
                        <thead>
                            <tr>
                                <th><?php echo lang('id'); ?></th>
                                <th><?php echo lang('image'); ?></th>
                                <th><?php echo lang('name'); ?></th>
                                <th><?php echo lang('username'); ?></th>
                                <th><?php echo lang('group'); ?></th>
                                <th class="no-print"><?php echo lang('options'); ?></th>
                            </tr>
                        </thead>
                        <tbody>

                        <style>
                            .img_url{
                                height:20px;
                                width:20px;
                                background-size: contain; 
                                max-height:20px;
                                border-radius: 100px;
                            }
                        </style>

                        <?php foreach ($userents as $userent) { ?>
                            <tr class="">
                                <td> <?php echo $userent->eid; ?></td>
                            <?php if ($userent->img_url != '') {?>        
                                <td style="width:10%;"><img style="width:50px;height: 50px;" src="<?php echo $userent->img_url; ?>"></td>
                            <?php }else {?>
                                    <td><?php echo lang('no_photo'); ?></td>
                            <?php } ?>
                                <td style="font-weight: bold;"> <?php echo $userent->ename; ?></td>
                                <td style="font-weight: bold;"> <?php echo $userent->utype; ?></td>

                                <td style="font-weight: bold;"> 
                                    <?php 
                                        $this->db->where('user_id', $userent->id);
                                        $this->db->join('groups', 'users_groups.group_id = groups.id');
                                       $query = $this->db->get('users_groups');
                                       $eml = $query->row();
                                       echo  $eml->name;
                                    ?>
                                </td>

                                <td class="no-print">
                                <?php if (empty($eml->group_id)) { ?>
                                    <button type="button" class="btn btn-info btn-xs btn_width addgroup" title="<?php echo lang('add').' '.lang('group'); ?>" data-toggle="modal" data-emp="<?php echo $userent->emp_id; ?>"><i class="fa fa-plus-circle"> </i>Add Group</button>
                                <?php } ?>

                                <?php if (!empty($eml->group_id)) { ?>
                                    <button type="button" class="btn btn-secondary btn-xs btn_width editgroup" title="<?php echo lang('edit').' '.lang('group'); ?>" data-toggle="modal" data_emp="<?php echo $userent->id; ?>"><i class="fa fa-edit"> </i><?php echo lang('edit').' '.lang('group'); ?></button>
                                <?php } ?>
                                    <button type="button" class="btn btn-info btn-xs btn_width editbutton" title="<?php echo lang('edit'); ?>" data-toggle="modal" data-uid="<?php echo $userent->emp_id; ?>"><i class="fa fa-edit"> </i><?php echo lang('edit').' '.lang('password'); ?></button>   
                                    <a class="btn btn-info btn-xs btn_width delete_button" title="<?php echo lang('delete'); ?>" href="usermgnt/delete?id=<?php echo $userent->emp_id; ?>" onclick="return confirm('Are you sure you want to delete this item?');"><i class="fa fa-trash"></i> </a>
                                </td>

                            </tr>
                        <?php } ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </section>
        <!-- page end-->
    </section>
</section>
<!--main content end-->
<!--footer start-->






<!-- Add User -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title"><i class="fa fa-plus-circle"></i> <?php echo lang('add_user'); ?></h4>
            </div>
            <div class="modal-body">
                <form role="form" action="usermgnt/Neweuser" method="post" enctype="multipart/form-data">

                    <div class="form-group">
                       <label for="exampleInputEmail1"><?php echo lang('name'); ?>
                       </label>
                        <select class="form-control m-bot15 js-example-basic-single form-control-lg" name="emp_id">
                            <option>Select......</option>
                            <?php foreach ($emps as $emp) { ?>
                                <option value="<?php echo $emp->emp_id;?>">
                                    <?php echo $emp->ename;?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('username'); ?></label>
                        <input type="text" class="form-control" name="utype" id="exampleInputEmail1" placeholder="Emter Username">
                    </div>


                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('password'); ?></label>
                        <input type="text" class="form-control" name="password" id="exampleInputEmail1" placeholder="Emter Password">
                    </div>


                    <center><button style="padding: 20px 60px 20px 60px; font-size: 20px;" type="submit" name="submit" class="btn btn-info"> <?php  echo lang('add'); ?></button></center>
                </form>

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- Add User-->










<!-- Add User Group Modal-->
<div class="modal fade" id="myModauser" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title"><i class="fa fa-edit"></i> <?php echo lang('add').' '.lang('user').' '.lang('group'); ?></h4>
            </div>
            <div class="modal-body">
                <form role="form" id="editusergroup" action="usermgnt/addusergroup" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('id'); ?></label>
                        <input type="text" class="form-control" name="emp" value='' placeholder="">
                    </div>
                    <div class="form-group">
                       <label for="exampleInputEmail1"><?php echo lang('group').' '.lang('name'); ?>
                       </label>
                        <select class="form-control m-bot15 js-example-basic-single form-control-lg" name="group_id">
                            <option>Select......</option>
                            <?php foreach ($groups as $group) { ?>
                                <option value="<?php echo $group->id;?>">
                                    <?php echo $group->name;?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>
                    <button type="submit" name="submit" class="btn btn-info"><?php echo lang('submit'); ?></button>
                </form>

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- Add User Group Modal-->














<!-- Edit User Group Modal-->
<div class="modal fade" id="edituser_group" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title"><i class="fa fa-edit"></i> <?php echo lang('edit').' '.lang('user').' '.lang('group'); ?></h4>
            </div>
            <div class="modal-body">
                <form role="form" id="editusersgroups" action="usermgnt/editusergroup" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <input type="hidden" class="form-control" name="emp_uid" placeholder="">
                    </div>
                    <div class="form-group">
                       <label for="exampleInputEmail1"><?php echo lang('group').' '.lang('name'); ?>
                       </label>
                        <select class="form-control form-control-lg" name="group_uiid" id="group_uiid">
                            <option>Select......</option>
                            <?php foreach ($groups as $group) { ?>
                                <option value="<?php echo $group->id;?>">
                                    <?php echo $group->name;?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>
                    <input type="hidden" name="ugr_id">
                    <button type="submit" name="submit" class="btn btn-info"><?php echo lang('submit'); ?></button>
                </form>

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- Edit User Group Modal-->













<!-- Edit User password-->
<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title"><i class="fa fa-edit"></i> <?php echo lang('edit_user'); ?></h4>
            </div>
            <div class="modal-body">
                <form role="form" id="edituserpass" action="usermgnt/editupassword" method="post" enctype="multipart/form-data">


                     <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('username'); ?></label>
                        <input disabled="disabled" type="text" class="form-control" name="username" id="exampleInputEmail1" value=''>
                    </div>


                     <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('password'); ?></label>
                        <input type="text" class="form-control" name="password" id="exampleInputEmail1" value='' placeholder="Enter Password">
                    </div>


                    <input type="hidden" name="id" value=''>
                    <button type="submit" name="submit" class="btn btn-info"><?php echo lang('submit'); ?></button>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- Edit User Password-->









<script type="text/javascript">
    $(document).ready(function () {
        $(".addgroup").click(function (e) {
            e.preventDefault(e);
            var iid = $(this).attr('data-emp');
            $('#myModauser').trigger("reset");
            $('#myModauser').modal('show');
            $.ajax({
                url: 'usermgnt/addusergroupByJason?id=' + iid,
                method: 'GET',
                data: '',
                dataType: 'json',
            }).success(function (group) {
             $('#editusergroup').find('[name="emp"]').val(group.usergros.id).end()
            });
        });
    });
</script>





<script type="text/javascript">
    $(document).ready(function () {
        $(".editgroup").click(function (e) {
            e.preventDefault(e);
            var empuid = $(this).attr('data_emp');
            $('#edituser_group').trigger("reset");
            $('#edituser_group').modal('show');
            $.ajax({
                url: 'usermgnt/editusergroupByJason?id=' + empuid,
                method: 'GET',
                data: '',
                dataType: 'json',
            }).success(function (groupus) {
             $('#editusersgroups').find('[name="emp_uid"]').val(groupus.usergrops.user_id).end()
             $('#group_uiid option[value='+groupus.usergrops.group_id+']').attr('selected', 'selected');
             $('#editusersgroups').find('[name="ugr_id"]').val(groupus.usergrops.id).end()
            });
        });
    });
</script>






<script type="text/javascript">
    $(document).ready(function () {
        $(".editbutton").click(function (e) {
            e.preventDefault(e);
            var uiid = $(this).attr('data-uid');
            $('#myModal2').trigger("reset");
            $('#myModal2').modal('show');
            $.ajax({
                url: 'usermgnt/getuserByJason?uid=' + uiid,
                method: 'GET',
                data: '',
                dataType: 'json',
            }).success(function (group) {
             $('#edituserpass').find('[name="id"]').val(group.ugroup.emp_id).end()
             $('#edituserpass').find('[name="username"]').val(group.ugroup.utype).end()
            });
        });
    });
</script>




<script>
    $(document).ready(function () {
        $(".flashmessage").delay(3000).fadeOut(100);
    });
</script>

