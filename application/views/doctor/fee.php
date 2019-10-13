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
                                <th><?php echo lang('first_ticket'); ?></th>
                                <th><?php echo lang('second_ticket'); ?></th>
                                <th><?php echo lang('hospital_first'); ?></th>
                                <th><?php echo lang('hospital_second'); ?></th>
                                <th class="no-print"><?php echo lang('options'); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($doctorfee as $doctorfees) { ?>
                            <tr class="">
                                <td><?php echo $doctorfees->dr_id; ?></td>
                                <td> <?php echo $doctorfees->drname; ?></td>
                                <td><?php echo $doctorfees->dr_firsttime; ?></td>
                                <td> <?php echo $doctorfees->dr_sectime; ?></td>
                                <td> <?php echo $doctorfees->hospital_first; ?></td>
                                <td> <?php echo $doctorfees->hospital_sec; ?></td>
                                <td class="no-print">
                                    <button type="button" class="btn btn-info btn-xs btn_width editbutton" title="<?php echo lang('edit'); ?>" data-toggle="modal" data-id="<?php echo $doctor->id; ?>"><i class="fa fa-edit"> </i> <?php echo lang('edit'); ?></button>   
                                    <a class="btn btn-info btn-xs btn_width delete_button" title="<?php echo lang('delete'); ?>" href="doctor/delete?id=<?php echo $doctor->id; ?>" onclick="return confirm('Are you sure you want to delete this item?');"><i class="fa fa-trash"> </i> <?php echo lang('delete'); ?></a>
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






<!-- Add Accountant Modal-->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title"><i class="fa fa-plus-circle"></i> <?php echo lang('add_new_doctor'); ?></h4>
            </div>
            <div class="modal-body">
                <form role="form" action="doctor/addfee" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('doctor'); ?></label>
                        <select class="form-control m-bot15 js-example-basic-single" name="dr_id" value=''>
                        <?php foreach ($doctors as $doctor) { ?>
                            <option value="<?php echo $doctor->dr_id; ?>"><?php echo $doctor->dr_id; ?> --------- <?php echo $doctor->drname; ?> </option>
                        <?php } ?>

                        </select>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('first_ticket'); ?></label>
                        <input required="required" type="text" class="form-control" name="dr_firsttime" id="exampleInputEmail1" value='' placeholder="">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('second_ticket'); ?></label>
                        <input type="text" class="form-control" name="dr_sectime" id="exampleInputEmail1" value='' placeholder="">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('hospital_charge'); ?> <?php echo lang('first_ticket'); ?></label>
                        <input required="required" type="text" class="form-control" name="hospital_first" id="exampleInputEmail1" value='' placeholder="">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('hospital_charge'); ?> <?php echo lang('second_ticket'); ?></label>
                        <input required="required" type="text" class="form-control" name="hospital_sec" id="exampleInputEmail1" value='' placeholder="">
                    </div>
                    <br><br><br><br><br>
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
                <h4 class="modal-title"><i class="fa fa-edit"></i> <?php echo lang('edit_doctor'); ?></h4>
            </div>
            <div class="modal-body">
                <form role="form" action="doctor/addfee" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('doctor'); ?></label>
                        <select class="form-control m-bot15 js-example-basic-single" name="dr_id" value=''>
                        <?php foreach ($doctors as $doctor) { ?>
                            <option value="<?php echo $doctor->dr_id; ?>"><?php echo $doctor->dr_id; ?> --------- <?php echo $doctor->drname; ?> </option>
                        <?php } ?>

                        </select>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('first_ticket'); ?></label>
                        <input required="required" type="text" class="form-control" name="dr_firsttime" id="exampleInputEmail1" value='' placeholder="">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('second_ticket'); ?></label>
                        <input type="text" class="form-control" name="dr_sectime" id="exampleInputEmail1" value='' placeholder="">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('hospital_charge'); ?> <?php echo lang('first_ticket'); ?></label>
                        <input required="required" type="text" class="form-control" name="hospital_first" id="exampleInputEmail1" value='' placeholder="">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('hospital_charge'); ?> <?php echo lang('second_ticket'); ?></label>
                        <input required="required" type="text" class="form-control" name="hospital_sec" id="exampleInputEmail1" value='' placeholder="">
                    </div>
                    <br><br><br><br><br>
                    <button type="submit" name="submit" class="btn btn-info"><?php echo lang('submit'); ?></button>
                </form>

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- Edit Event Modal-->

<script src="common/js/codelnp.min.js"></script>
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
                                                }).success(function (response) {
                                                    // Populate the form fields with the data returned from server
                                                    $('#editDoctorForm').find('[name="id"]').val(response.doctor.id).end()
                                                    $('#editDoctorForm').find('[name="name"]').val(response.doctor.drname).end()
                                                    $('#editDoctorForm').find('[name="password"]').val(response.doctor.password).end()
                                                    $('#editDoctorForm').find('[name="email"]').val(response.doctor.email).end()
                                                    $('#editDoctorForm').find('[name="address"]').val(response.doctor.address).end()
                                                    $('#editDoctorForm').find('[name="phone"]').val(response.doctor.phone).end()
                                                    $('#editDoctorForm').find('[name="department"]').val(response.doctor.department).end()
                                                    $('#editDoctorForm').find('[name="profile"]').val(response.doctor.profile).end()

                                                    $('.js-example-basic-single.department').val(response.doctor.department).trigger('change');
                                                });
                                            });
                                        });
</script>
<script>
    $(document).ready(function () {
        $(".flashmessage").delay(3000).fadeOut(100);
    });
</script>

