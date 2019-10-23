<!--sidebar end-->
<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">
        <!-- page start-->
        <section class="panel">
            <header class="panel-heading">
                <i class="fa fa-user"></i>  <?php echo lang('doctors'); ?>    
            </header>
            <div class="panel-body">
                <div class="adv-table editable-table ">
                    <div class="clearfix no-print">
                        <a data-toggle="modal" href="#myModal">
                            <div class="btn-group">
                                <button id="" class="btn green">
                                    <i class="fa fa-plus-circle"></i> <?php echo lang('add_new'); ?> 
                                </button>
                            </div>
                        </a>
                        <button class="export no-print" onclick="javascript:window.print();"><?php echo lang('print'); ?></button>  
                    </div>
                    <div class="space15"></div>
                    <table class="table table-striped table-hover table-bordered" id="editable-sample">
                        <thead>
                            <tr>
                                <th><?php echo lang('doctor'); ?> <?php echo lang('id'); ?></th>
                                <th><?php echo lang('name'); ?></th>
                                <th><?php echo lang('chamber'); ?></th>
                                <th><?php echo lang('phone'); ?></th>
                                <th><?php echo lang('department'); ?></th>
                                <th><?php echo lang('profile'); ?></th>
                                <th class="no-print"><?php echo lang('options'); ?></th>
                            </tr>
                        </thead>
                        <tbody>

                        <?php foreach ($doctors as $doctor) { ?>
                            <tr class="">
                                <td><?php echo $doctor->dr_id; ?></td>
                                      
                                <td> <?php echo $doctor->drname; ?></td>
                                <td class="center"><?php echo $doctor->chamber; ?></td>
                                <td><?php echo $doctor->phone; ?></td>
                                <td class="center"><?php echo $doctor->dept_name; ?></td>
                                <td><?php echo $doctor->profile; ?></td>
                                <td class="no-print">
                                    <button type="button" class="btn btn-info btn-xs btn_width editbutton" title="<?php echo lang('edit'); ?>" data-toggle="modal" data-id="<?php echo $doctor->atid; ?>"><i class="fa fa-edit"> </i> <?php echo lang('edit'); ?></button>
                                    <a class="btn btn-info btn-xs btn_width delete_button" title="<?php echo lang('delete'); ?>" href="doctor/delete?id=<?php echo $doctor->atid; ?>" onclick="return confirm('Are you sure you want to delete this item?');"><i class="fa fa-trash"> </i> </a>
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






<!-- Add Doctor Modal-->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title"><i class="fa fa-plus-circle"></i> <?php echo lang('add_new_doctor'); ?></h4>
            </div>
            <div class="modal-body">
                <form role="form" action="doctor/addNew" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('name'); ?></label>
                        <input required="" type="text" class="form-control" name="name" id="exampleInputEmail1" value='' placeholder="Full Doctor Name">
                    </div>


                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('id'); ?></label>
                        <input type="text" readonly="readonly" class="form-control" name="dr_id" id="exampleInputEmail1" value='<?php echo $dr_id->dr_id + 1 ; ?>' >
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Full Degree</label>
                        <input required="" type="text" class="form-control" name="profile" id="exampleInputEmail1" value='' placeholder="Full Degree">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('gender'); ?></label>
                        <select class="form-control" name="gender" value=''>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('department'); ?></label>
                        <select class="form-control m-bot15 js-example-basic-single" name="department" value=''>
                            <?php foreach ($departments as $department) { ?>
                                <option value="<?php echo $department->dept_id; ?>"> <?php echo $department->dept_name; ?> </option>
                            <?php } ?> 
                        </select>
                    </div>



                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('chamber'); ?></label>
                        <input type="text" class="form-control" name="chamber" id="exampleInputEmail1" value='' placeholder="Doctor Cember">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('phone'); ?></label>
                        <input required="" type="text" class="form-control" name="phone" id="exampleInputEmail1" value='' placeholder="Doctor ">
                    </div>


                    <div class="form-group">
                        <label for="exampleInputEmail1">Activity</label>
                        <select class="form-control" name="activity" value=''>
                            <option value="1"> Active </option>
                            <option value="0"> Inactive </option> 
                        </select>
                    </div>

<br><br><br><br><br>



<!-- 
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('image'); ?></label>
                        <input style="float: left;" type="file" name="img_url" id="file" onchange="view_loadfile(event)">
                        <img id="preimage_first" width="100px" height="100px" name="img_url" src="">
                        <script type="text/javascript">
                            function view_loadfile(){
                                var output=document.getElementById('preimage_first');
                                output.src=URL.createObjectURL(event.target.files[0]);
                            };
                        </script>
                    </div> -->



                    <button type="submit" name="submit" class="btn btn-info"><?php echo lang('submit'); ?></button>
                </form>

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- Add Accountant Modal-->







<!-- Edit Event Modal-->
<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title"><i class="fa fa-plus-circle"></i> <?php echo lang('edit '). ' ' .lang('doctor').' '.lang('info'); ?></h4>
            </div>
            <div class="modal-body">
                <form role="form" action="doctor/update" id="editDoctorForm" method="post" enctype="multipart/form-data">

                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('name'); ?></label>
                        <input required="" type="text" class="form-control" name="name" id="exampleInputEmail1" value=''>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Full Degree</label>
                        <input required="" type="text" class="form-control" name="profile" id="exampleInputEmail1" value='' >
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('gender'); ?></label>
                        <select class="form-control" name="gender" value=''>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('department'); ?></label>
                        <select class="form-control " id="dept_option" name="department" value=''>
                            <?php foreach ($departments as $department) { ?>
                                <option value="<?php echo $department->dept_id; ?>"> <?php echo $department->dept_name; ?> </option>
                            <?php } ?> 
                        </select>
                    </div>



                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('chamber'); ?></label>
                        <input type="text" class="form-control" name="chamber" id="exampleInputEmail1" value='' >
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('phone'); ?></label>
                        <input required="" type="text" class="form-control" name="phone" id="exampleInputEmail1" value='' >
                    </div>


                    <div class="form-group">
                        <label for="exampleInputEmail1">Activity</label>
                        <select class="form-control" id="activity_option" name="activity" value=''>
                            <option value="1"> Active </option>
                            <option value="0"> Inactive </option> 
                        </select>
                    </div>
    <br><br><br><br><br>



<!-- 
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('image'); ?></label>
                        <input style="float: left;" type="file" name="img_url" id="file" onchange="loadfile(event)">
                        <img id="preimage_ss" width="100px" height="100px" name="img_url" src="">
                        <script type="text/javascript">
                            function loadfile(){
                                var output=document.getElementById('preimage_ss');
                                output.src=URL.createObjectURL(event.target.files[0]);
                            };
                        </script>
                    </div>
-->



                    <input type="hidden" name="dr_main_id" value="" >
                    <button type="submit" name="submit" class="btn btn-info"><?php echo lang('submit'); ?></button>
                </form>

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- Edit Event Modal-->

<script type="text/javascript">
    $(document).ready(function () {
        $(".editbutton").click(function (e) {
            e.preventDefault(e);
            // Get the record's ID via attribute
            var iid = $(this).attr('data-id');
            $('#editDoctorForm').trigger("reset");
            $('#myModal2').modal('show');
            $.ajax({
                url: 'doctor/editDoctorByJason?id=' + iid,
                method: 'GET',
                data: '',
                dataType: 'json',
                success: function (response) {
                    // Populate the form fields with the data returned from server
                    $('#editDoctorForm').find('[name="dr_main_id"]').val(response.doctor.atid).end()
                    $('#editDoctorForm').find('[name="name"]').val(response.doctor.drname).end()
                    $('#editDoctorForm').find('[name="chamber"]').val(response.doctor.chamber).end()
                    $('#editDoctorForm').find('[name="activity"]').val(response.doctor.email).end()
                    $('#editDoctorForm').find('[name="phone"]').val(response.doctor.phone).end()
                    $('#editDoctorForm').find('[name="profile"]').val(response.doctor.profile).end()

                    $('#dept_option option[value='+response.doctor.dept_id+']').attr('selected', 'selected');

                    $('#activity_option option[value='+response.doctor.stus+']').attr('selected', 'selected');        
                }
            });
        });
    });
</script>
<script>
    $(document).ready(function () {
        $(".flashmessage").delay(3000).fadeOut(100);
    });
</script>

