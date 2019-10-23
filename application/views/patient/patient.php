

<!--sidebar end-->
<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">



        <!-- page start-->
        <section class="">

            <header class="panel-heading">
                    <i class="fa fa-user"></i>   <?php echo lang('patient'); ?>
                </header>
            <div class="panel-body">
                
                <div class="adv-table editable-table ">
                      <div class=" no-print">
                        <a data-toggle="modal" href="#myModal">
                            <div class="btn-group">
                                <button id="" class="btn green">
                                     <i class="fa fa-plus-circle"></i> <?php echo lang('add_new'); ?>
                                </button>
                            </div>
                        </a>
<button onclick="open_blank_chart()" type="button" class="btn green" id="" title="" data-toggle="modal" data_id=""><i class="fa fa-stethoscope"></i> <?php echo lang('blank').' '.lang('chart'); ?></button>
                        <button class="export no-print" onclick="javascript:window.print();"><?php echo lang('print'); ?></button>

                    </div>
                    <div class="space15"></div>
                    <table class="table table-striped table-hover table-bordered" id="editable-sample">
                        <thead>
                            <tr>
                                <th><?php echo lang('id'); ?></th> 
                                <th><?php echo lang('name'); ?></th>
                                <th><?php echo lang('bed'); ?></th>
                                <th><?php echo lang('address'); ?></th>
                                <th><?php echo lang('doctor').' '.lang('name'); ?></th>
                                <th><?php echo lang('register').' '.lang('no'); ?></th> 
                                <th><?php echo lang('admission').' '.lang('time'); ?></th>
                                <th><?php echo lang('mobile'); ?></th>
                                <th>Employee</th>
                                <th class="no-print"><?php echo lang('options'); ?></th>
                            </tr>
                        </thead>
                        <tbody>

                        <?php foreach ($patients as $patient) { ?>
                            <tr class="">
                                <td> <?php echo $patient->p_n_id; ?></td>
                                <td> <?php echo $patient->ptnname; ?></td>
                                <td> <a type="button" class="btn btn-primary edit_p_bed" title="<?php echo lang('edit'); ?>" data-toggle="modal" data_p_id="<?php echo $patient->p_n_id; ?>"><?php echo $patient->b_num; ?></a>
                                </td>
                                <td> <?php echo $patient->pn_address; ?></td>
                                <td>  <?php echo $patient->drname; ?> </td>
                                <td align="right"><?php echo $patient->reg_no; ?></td>
                                <td><?php echo date('d-M-y h:m a', $patient->time_this); ?></td>
                                <td><?php echo $patient->mobile; ?></td>
                                <td><?php echo $patient->ename; ?></td>



                                <td class="no-print">
                                    <?php if ($this->ion_auth->in_group(array('admin', 'Supervisor'))) { ?>
                                     <a type="button" class="btn editbutton editpbutton" title="<?php echo lang('edit'); ?>" data-toggle="modal" data_p_id="<?php echo $patient->p_n_id; ?>"><i class="fa fa-edit"></i> </a>
                                    <?php } ?>


<!--                                      <button onclick="reply_click(this.id)" type="button" class="btn green" id="<?php echo $patient->id; ?>" title="" data-toggle="modal" data_id=""><i class="fa fa-stethoscope"></i> <?php echo lang('chart'); ?></button> -->


                                    <?php if ($this->ion_auth->in_group(array('admin', 'Accountant'))) { ?>
                                     <a class="btn delete_button" title="<?php echo lang('delete'); ?>" href="patient/delete?id=<?php echo $patient->p_n_id; ?>" onclick="return confirm('Are you sure you want to delete this item?');"><i class="fa fa-trash"></i></a>
                                    <?php } ?>
                                   

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






<!-- Add Patient Modal-->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title"><i class="fa fa-plus-circle"></i> <?php echo lang('register_new_patient'); ?></h4>
            </div>
            <div class="modal-body">
                <form role="form" id="patientadd" action="patient/addpatient" method="post" enctype="multipart/form-data">

                    <div class="form-group">
                        <label for="exampleInputEmail1"> <?php  echo lang('doctor'); ?></label>
                        <select required="required" class="form-control m-bot15 js-example-basic-single" id="doctor" name="dr_id" value=''>
                            <option value="">Select....</option>
                        <?php foreach ($doctors as $doctor) { ?>
                            <option value="<?php echo $doctor->dr_id; ?>"><?php echo $doctor->dr_id; ?> --------- <?php echo $doctor->drname; ?> </option>
                        <?php } ?>
                        </select>
                    </div>




                    <div class="form-group">
                        <label for="exampleInputEmail1"> <?php  echo lang('name'); ?></label>
                       <!-- <select class="form-control m-bot15 js-example-basic-single" id="app_id" name="app_id" value='' onchange="changeid()">
                            <option>Select....</option>
                        <?php foreach ($appoints as $appoint) { ?>
                            <option value="<?php echo $appoint->id; ?>"><?php echo $appoint->serial; ?> --------- <?php echo $appoint->patient; ?> </option>
                        <?php } ?>
                        </select>-->
                    </div>

                        <input type="text" class="form-control" name="name" id="exampleInputEmail1" value='' placeholder="Patient Name">

                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('date'); ?></label>
                        <input required="required" type="text" class="form-control default-date-picker" name="date" id="exampleInputEmail1" value='' placeholder="Admission Date">

                        <input type="time" required="required" class="form-control" name="time" id="exampleInputEmail1" value='' placeholder="Admission Time">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('sex'); ?></label>
                        <select class="form-control m-bot15" name="sex" value=''>
                            <option value="Male"> Male </option>
                            <option value="Female"> Female </option>
                            <option value="Others"> Others </option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('age'); ?></label>
                        <input class="form-control form-control-inline input-medium" type="text" name="age" value="" placeholder="Patient Age">      
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1"> <?php  echo lang('bed').' '.lang('no'); ?></label>
                        <select class="form-control m-bot15 js-example-basic-single" required="required" id="app_id" name="b_num" value=''>
                            <option value="">Select....</option>
                        <?php foreach ($beds as $bed) { ?>
                            <option value="<?php echo $bed->b_num; ?>"><?php echo $bed->b_num; ?> </option>
                        <?php } ?>
                        </select>
                    </div>

                    <div class="form-group">
                        
                        <div class="form-check form-check-inline">
                          <input class="form-check-input" type="radio" name="inlineRadioOptions" id="fa" value="option1">
                          <label class="form-check-label" for="inlineRadio1">Father Name</label>

                          <input class="form-check-input" type="radio" name="inlineRadioOptions" id="hus" value="option2">
                          <label class="form-check-label" for="inlineRadio2">Husband Name</label>
                        </div>

                        <input type="hidden" class="form-control reltn" name="actv" id="exampleInputEmail1" value='' placeholder="">

                        <input type="text" style="display: none;" class="form-control" name="f_name" id="f_name_box" value='' placeholder="Type Name">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('address'); ?></label>
                        <input required="required" type="text" class="form-control" name="address" id="exampleInputEmail1" value='' placeholder="Type Full Address">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('mobile'); ?></label>
                        <input type="text" class="form-control" required="required" name="mobile" id="exampleInputEmail1" value='' placeholder="Patient Mobile Number">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Patient Cause</label>
                        <input type="text" class="form-control" required="required" name="ptn_cause" id="exampleInputEmail1" value='' placeholder="Patient Causes">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('register').' '.lang('no'); ?></label>
                        <input type="text" class="form-control" required="required" name="reg_no" id="exampleInputEmail1" value='' placeholder=" Registration Number">
                    </div>

                    <input type="hidden" name="id" value=''>
                    <section class=""><center>
                        <button style="padding: 20px 60px 20px 60px; font-size: 20px;" type="submit" name="submit" class="btn btn-info"><?php echo lang('register'); ?></button></center>
                    </section>
                </form>

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- Add Patient Modal-->







<!-- Edit Patient Modal -->
<div class="modal fade" id="edit_p" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title"><i class="fa fa-edit"></i> <?php echo lang('edit_patient'); ?></h4>
            </div>
            <div class="modal-body">
                <form role="form" id="editPatientForm" action="patient/editPatientData" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <div class="col-md-12">   
                            <div class="col-md-6">
                                <div class="col-md-3 payment_label"> 
                                    <label for="exampleInputEmail1"><?php echo lang('doctor'); ?></label>
                                </div>
                                <div class="col-md-9"> 
                                    <select style="width: 300px;" class="form-control m-bot15" name="doctor_p" id="doctor_p" value=''> 
                                        <?php foreach ($doctors as $doctor) { ?>
                                            <option value="<?php echo $doctor->dr_id; ?>">
                                                <?php echo $doctor->dr_id.'---'.$doctor->drname; ?> 
                                            </option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('name'); ?></label>
                        <input type="text" class="form-control" name="name" id="exampleInputEmail1" value='' placeholder="">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('register').' '.lang('no'); ?></label>
                        <input type="text" class="form-control" name="reg_no" id="exampleInputEmail1" value='' placeholder="">
                    </div>

                    <div class="form-group">
            <?php if ($this->ion_auth->in_group(array('admin'))) { ?>
                        <label for="exampleInputEmail1"><?php echo lang('date'); ?></label>
                        <input required="required" type="text" class="form-control default-date-picker" name="date" id="admit_date" value='' placeholder="">

                        <input type="time" required="required" class="form-control" name="time" id="admits_times" value='' placeholder="">
            <?php } ?>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('address'); ?></label>
                        <input type="text" class="form-control" name="address" id="exampleInputEmail1" value='' placeholder="">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('father').' / '.lang('husband').' '.lang('name'); ?></label>
                        <input type="text" class="form-control" name="father" id="exampleInputEmail1" value='' placeholder="">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('mobile'); ?></label>
                        <input type="text" class="form-control" name="phone" id="exampleInputEmail1" value='' placeholder="">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('age'); ?></label>
                        <input type="text" class="form-control" name="age" id="exampleInputEmail1" value='' placeholder="">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('sex'); ?></label>
                        <select class="form-control m-bot15" id="sex" name="sex" value=''>
                            <option value="Male"> Male </option>
                            <option value="Female"> Female </option>
                            <option value="Others"> Others </option>
                        </select>
                    </div>

                    <input type="hidden" name="id" value=''>
                    <input type="hidden" name="p_id" value=''>
                    <section class="">
                        <button type="submit" name="submit" class="btn btn-info"><?php echo lang('submit'); ?></button>
                    </section>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Edit Patient Modal-->






<!-- Edit Patient Bed -->
<div class="modal fade" id="edit_p_bed" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title"><i class="fa fa-edit"></i> <?php echo lang('edit_patient'); ?></h4>
            </div>
            <base href="">
            <div class="modal-body">
                <form role="form" id="editbedinfoForm" action="patient/editBed_data" method="post" enctype="multipart/form-data">

                    <div class="form-group">
                        <label for="exampleInputEmail1"> <?php  echo lang('bed').' '.lang('no'); ?></label>
                        <select class="form-control" id="bed_id" name="b_num" value=''>
                            <option>Select....</option>
                        <?php foreach ($beds as $bed) { ?>
                            <option value="<?php echo $bed->b_num; ?>"><?php echo $bed->b_num; ?> </option>
                        <?php } ?>
                        </select>
                    </div>

                    <input type="hidden" name="p_id_for_bed" id="p_id_editbed" value=''>
                    <section class=""><center>
                        <button style="padding: 20px 60px 20px 60px; font-size: 20px;" type="submit" name="submit" class="btn btn-info"><?php echo lang('register'); ?></button></center>
                    </section>

                </form>
            </div>
        </div>
    </div>
</div>
<!-- Edit Patient Bed-->











<script type="text/javascript">

function reply_click(clicked_id, clicked_title){
        var url = 'patient/printchart?id='+clicked_id+'&dr_id='+clicked_title;     
      window.open(url, '_blank', 'height=800,width=800');
    }


/**

// Function for Admission Appoinment Patient 

    function changeid(){
        // Get the record's ID via attribute  
        var iid = $('#app_id').val();
        $.ajax({
            url: 'patient/getinfoByJason?id=' + iid,
            method: 'GET',
            data: '',
            dataType: 'json',
        }).success(function (appoints) {
            // Populate the form fields with the data returned from server
            $('#doctor option[value='+appoints.appointments.dr_id+']').attr('selected', 'selected');
            $('#patientadd').find('[name="name"]').val(appoints.appointments.patient).end()
            $('#patientadd').find('[name="age"]').val(appoints.appointments.age).end()
            $('#patientadd').find('[name="mobile"]').val(appoints.appointments.mobile).end()
        });
    }
**/




$(document).ready(function () {
    $(".editpbutton").click(function (e) {
        e.preventDefault(e);
        // Get the record's ID via attribute  
        var iid = $(this).attr('data_p_id');
        $('#editPatientForm').trigger("reset");
        $('#edit_p').modal('show');
        $.ajax({
            url: 'patient/editPatientByJason?id=' + iid,
            method: 'GET',
            data: '',
            dataType: 'json',
        }).success(function (response) {
            // Populate the form fields with the data returned from server

            $('#editPatientForm').find('[name="id"]').val(response.patient.p_n_id).end()
            $('#editPatientForm').find('[name="name"]').val(response.patient.ptnname).end()
            $('#editPatientForm').find('[name="p_id"]').val(response.patient.patient_id).end() 
            $('#doctor_p option[value='+response.patient.dr_id+']').attr('selected', 'selected');
            $('#sex option[value='+response.patient.sex+']').attr('selected', 'selected');
            $('#editPatientForm').find('[name="address"]').val(response.patient.pn_address).end()
            $('#editPatientForm').find('[name="phone"]').val(response.patient.mobile).end()
            $('#editPatientForm').find('[name="father"]').val(response.patient.f_s_name).end()
            $('#editPatientForm').find('[name="age"]').val(response.patient.age).end()
            $('#editPatientForm').find('[name="reg_no"]').val(response.patient.reg_no).end()

            var admit_time = response.patient.time_this;


            var timestampInMilliSeconds = admit_time*1000;
            var date = new Date(timestampInMilliSeconds);

            var day = (date.getDate() < 10 ? '0' : '') + date.getDate();
            var month = (date.getMonth() < 9 ? '0' : '') + (date.getMonth() + 1);
            var year = date.getFullYear();

            var hours = ((date.getHours() % 12 || 12) < 10 ? '0' : '') + (date.getHours() % 12 || 12);
            var minutes = (date.getMinutes() < 10 ? '0' : '') + date.getMinutes();
            var meridiem = (date.getHours() >= 12) ? 'pm' : 'am';

            var formattedDate = day + '-' + month + '-' + year + ' at ' + hours + ':' + minutes + ' ' + meridiem;
            var dateformt = day + '-' + month + '-' + year;
            var times_formates = hours + ':' + minutes + ' ' + meridiem;

            $('#admit_date').val(dateformt);
        });
    });
});


    $('#fa').click(function() {
        $('.reltn').val('fa');
        $('#f_name_box').css('display', 'block');
    })

    $('#hus').click(function() {
        $('.reltn').val('hus');
        $('#f_name_box').css('display', 'block');
    })



$(document).ready(function () {
    $(".edit_p_bed").click(function (e) {
        e.preventDefault(e);
        // Get the record's ID via attribute  
        var iid = $(this).attr('data_p_id');
        $('#editbedinfoForm').trigger("reset");
        $('#edit_p_bed').modal('show');

        $('#p_id_editbed').val(iid);


        $.ajax({
            url: 'patient/editPatientByJason?id=' + iid,
            method: 'GET',
            data: '',
            dataType: 'json',
            success: function (respon) {
            // Populate the form fields with the data returned from server
              $('#bed_id option[value='+respon.patient.b_num+']').attr('selected', 'selected');
            }
        })

    })
})








</script>










