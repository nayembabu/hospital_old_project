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
                                <th><?php echo lang('image'); ?></th>
                                <th><?php echo lang('name'); ?></th>
                                <th><?php echo lang('dasign'); ?></th>
                                <th><?php echo lang('salary'); ?></th>
                                <th><?php echo lang('offday'); ?></th>
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
                            <?php if ($nurse->img_url != '') {?>        
                                <td style="width:10%;"><img style="width:50px;height: 50px;" src="<?php echo $nurse->img_url; ?>"></td>
                            <?php }else {?>
                                    <td>Upload Photo</td>
                            <?php } ?>
                                <td style="font-weight: bold;"> <?php echo $nurse->ename; ?></td>
                                <td><?php echo $nurse->desig; ?></td>
                                <td><?php echo $nurse->sallary; ?></td>
                                <td><?php echo $nurse->offday; ?></td>
                            <?php if ($this->ion_auth->in_group('admin')) { ?>
                                <td class="no-print">
                                    <button type="button" class="btn btn-info btn-xs btn_width editbutton" title="<?php echo lang('edit'); ?>" data-toggle="modal" data-id="<?php echo $nurse->emp_id; ?>"><input style="color: white; background-color: #39B27C;" type="submit" value="Edit"><i class="fa fa-edit"> </i></button></td>
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
                <form role="form" id="editNurseForm" action="nurse/updateNurseInfo" method="post" enctype="multipart/form-data">

                    <div style="width: 250px; float: left;" class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('dasign'); ?></label>
                        <input type="text" class="form-control" name="design" id="exampleInputEmail1" placeholder="Designation">
                    </div>

                    <div style="width: 250px; float: right;" class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('salary'); ?></label>
                        <input type="text" class="form-control" name="salary" id="exampleInputEmail1" value='' placeholder="Monthly Sallary">
                    </div>

                        <br><br><br><br>

                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('offday'); ?></label>
                        <input type="text" class="form-control" name="offday" id="exampleInputEmail1" value='' placeholder="Offday Such (Friday)">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Joinnning Date</label>
                        <input type="text" class="form-control  dtpic " name="jndtt" id="exampleInputEmail1" value='' placeholder="Joinnning Date">
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
                                                url: 'nurse/editInfoByJason?id=' + iid,
                                                method: 'GET',
                                                data: '',
                                                dataType: 'json',
                                            }).success(function (response) {
                                                // Populate the form fields with the data returned from server
                                                $('#editNurseForm').find('[name="id"]').val(response.nurse.emp_id).end()
                                                $('#editNurseForm').find('[name="design"]').val(response.nurse.desig).end()
                                                $('#editNurseForm').find('[name="salary"]').val(response.nurse.sallary).end()
                                                $('#editNurseForm').find('[name="offday"]').val(response.nurse.offday).end()
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

