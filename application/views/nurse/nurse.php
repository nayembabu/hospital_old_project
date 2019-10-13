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
                                    <i class="fa fa-plus-circle"></i> <?php echo lang('add_emp'); ?>
                                </button>
                            </div>
                        </a>
                        <button class="export no-print" onclick="javascript:window.print();"><?php echo lang('print'); ?></button>  
                    </div>
                    <div class="space15"></div>
                    <table class="table table-striped table-hover table-bordered" id="editable-sample">
                        <thead>
                            <tr>
                                <th><?php echo lang('emp_id'); ?></th>
                                <th><?php echo lang('id'); ?></th>
                                <th><?php echo lang('image'); ?></th>
                                <th><?php echo lang('name'); ?></th>
                                <th><?php echo lang('dasign'); ?></th>
                                <th><?php echo lang('father'); ?></th>
                                <th><?php echo lang('mother'); ?></th>
                                <th><?php echo lang('gender'); ?></th>
                                <th><?php echo lang('address'); ?></th>
                                <th><?php echo lang('blood'); ?></th>
                                <th><?php echo lang('phone'); ?></th>
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

                        <?php foreach ($nurses as $nurse) { ?>
                            <tr class="">
                                <td> <?php echo $nurse->eid; ?></td>
                                <td> <?php echo $nurse->emp_id; ?></td>
                            <?php if ($nurse->img_url != '') {?>        
                                <td style="width:10%;"><img style="width:50px;height: 50px;" src="<?php echo $nurse->img_url; ?>"></td>
                            <?php }else {?>
                                    <td><?php echo lang('no_photo'); ?></td>
                            <?php } ?>
                                <td style="font-weight: bold;"> <?php echo $nurse->ename; ?></td>
                                <td><?php echo $nurse->desig; ?></td>
                                <td><?php echo $nurse->father; ?></td>
                                <td><?php echo $nurse->mother; ?></td>
                                <td align="center"><?php echo $nurse->gender; ?></td>
                                <td class="center"><?php echo $nurse->address; ?></td>
                                <td><?php echo $nurse->blood; ?></td>
                                <td><?php echo $nurse->phone; ?></td>
                            <?php if ($this->ion_auth->in_group('admin')) { ?>
                                <td class="no-print">
                                    <button type="button" class="btn btn-info btn-xs btn_width editbutton" title="<?php echo lang('edit'); ?>" data-toggle="modal" data-id="<?php echo $nurse->emp_id; ?>"><i class="fa fa-edit"> </i></button>   
                                    <a class="btn btn-info btn-xs btn_width delete_button" title="<?php echo lang('delete'); ?>" href="nurse/delete?id=<?php echo $nurse->id; ?>" onclick="return confirm('Are you sure you want to delete this item?');"><i class="fa fa-trash"></i> </a>
                                </td>
                                                    <?php } ?>

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






<!-- Add Nurse Modal-->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title"><i class="fa fa-plus-circle"></i> <?php echo lang('add_emp'); ?></h4>
            </div>
            <div class="modal-body">
                <form role="form" action="nurse/addNew" method="post" enctype="multipart/form-data">
                    <div class="form-group">


                        <label for="exampleInputEmail1"><?php echo lang('name'); ?></label>
                        <input type="text" class="form-control" name="name" id="exampleInputEmail1" value=''>

                    </div>
                    <div class="form-group">


                        <label for="exampleInputEmail1"><?php echo lang('password'); ?></label>
                        <input type="password" class="form-control" name="password" id="exampleInputEmail1" placeholder="">

                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('email'); ?></label>
                        <input type="text" class="form-control" name="email" id="exampleInputEmail1" value='' placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('address'); ?></label>
                        <input type="text" class="form-control" name="address" id="exampleInputEmail1" value='' placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('phone'); ?></label>
                        <input type="text" class="form-control" name="phone" id="exampleInputEmail1" value='' placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('image'); ?></label>
                        <input type="file" name="img_url">
                    </div>

                    <input type="hidden" name="id" value=''>


                    <button type="submit" name="submit" class="btn btn-info"><?php echo lang('submit'); ?></button>
                </form>

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- Add Accountant Modal-->







<!-- Edit Nurse Modal-->
<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title"><i class="fa fa-edit"></i> <?php echo lang('edit_emp'); ?></h4>
            </div>
            <div class="modal-body">
                <form role="form" id="editNurseForm" action="nurse/updateNurse" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('id'); ?></label>
                        <input disabled="disabled" type="text" class="form-control" name="emp_id" id="exampleInputEmail1" value='' placeholder="Machine ID">
                    </div>

                     <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('emp_id'); ?></label>
                        <input disabled="disabled" type="text" class="form-control" name="eid" id="exampleInputEmail1" value='' placeholder="Employee ID Such (E101)">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('name'); ?></label>
                        <input type="text" class="form-control" name="name" id="exampleInputEmail1" value='' placeholder="">
                    </div>

                    <div style="width: 250px; float: left;" class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('father'); ?></label>
                        <input type="text" class="form-control" name="father" id="exampleInputEmail1" placeholder="Father">
                    </div>

                    <div style="width: 250px; float: right;" class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('mother'); ?></label>
                        <input type="text" class="form-control" name="mother" id="exampleInputEmail1" value='' placeholder="Mother">
                    </div>

                        <br><br><br><br>

                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('address'); ?></label>
                        <input type="text" class="form-control" name="address" id="exampleInputEmail1" value='' placeholder="Full Address With Village, Post-Office, Thana, Distric">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('blood'); ?></label>
                        <input type="text" class="form-control" name="blood" id="exampleInputEmail1" value='' placeholder="Blood Group">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('phone'); ?></label>
                        <input type="text" class="form-control" name="phone" id="exampleInputEmail1" value='' placeholder="Mobile Number">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('image'); ?></label>
                        <input style="float: left;" type="file" name="img_url" id="file" onchange="loadfile(event)">
                        <img id="preimage" width="100px" height="100px" name="img_url" src="">
                        <script type="text/javascript">
                            function loadfile(){
                                var output=document.getElementById('preimage');
                                output.src=URL.createObjectURL(event.target.files[0]);
                            };
                        </script>
                    </div>

                    <input type="hidden" name="id" value=''>


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
                                            $('#editNurseForm').trigger("reset");
                                            $.ajax({
                                                url: 'nurse/editNurseByJason?id=' + iid,
                                                method: 'GET',
                                                data: '',
                                                dataType: 'json',
                                            }).success(function (response) {
                                                // Populate the form fields with the data returned from server
                                                $('#editNurseForm').find('[name="id"]').val(response.nurse.emp_id).end()
                                                $('#editNurseForm').find('[name="emp_id"]').val(response.nurse.emp_id).end()
                                                $('#editNurseForm').find('[name="eid"]').val(response.nurse.eid).end()
                                                $('#editNurseForm').find('[name="name"]').val(response.nurse.ename).end()
                                                $('#editNurseForm').find('[name="father"]').val(response.nurse.father).end()
                                                $('#editNurseForm').find('[name="mother"]').val(response.nurse.mother).end()
                                                $('#editNurseForm').find('[name="address"]').val(response.nurse.address).end()
                                                $('#editNurseForm').find('[name="blood"]').val(response.nurse.blood).end()
                                                $('#editNurseForm').find('[name="phone"]').val(response.nurse.phone).end()
                                                $('#editNurseForm').find('[name="img_url"]').attr('src', response.nurse.img_url).end()
                                                $('#myModal2').modal('show');
                                            });

                                        });
                                    });
</script>
<script>
    $(document).ready(function () {
        $(".flashmessage").delay(3000).fadeOut(100);
    });
</script>

