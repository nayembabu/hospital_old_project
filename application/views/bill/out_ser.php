<!--sidebar end-->
<!--main content start-->





<section id="main-content">
    <section class="wrapper site-min-height">
        <!-- page start
        <center><h1>Statement Closed</h1></center>-->
        <section  class="">

            <header class="panel-heading">
                    <i class="fa fa-user"></i>   <?php echo lang('out').' '.lang('service'); ?> 

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
                    </div>


                      <div class="no-print dntlcls" style=" margin: -35px 0 0 350px; position: absolute; ">
                        <a data-toggle="modal" href="#dntlModalbox">
                            <div class="btn-group">
                                <button style=" font-size: 20px;" id="" class="btn green">
                                     <i class="fa fa-plus-circle"></i> Dental Service 
                                </button>
                            </div>
                        </a>
                    </div>



                    <div class="space15"></div>
                    <table class="table table-striped table-hover table-bordered" id="editable-sample">
                        <thead>
                            <tr>
                                <th><?php echo lang('id'); ?></th> 
                                <th><?php echo lang('out').' '.lang('patient').' '.lang('id'); ?></th> 
                                <th><?php echo lang('patient').' '.lang('name'); ?></th>
                                <th><?php echo lang('patient').' '.lang('age'); ?></th>
                                <th><?php echo lang('emp'); ?></th>
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
                        <?php foreach ($p_out_service as $patient) { ?>
                            <tr class="">
                                <td> <?php echo $patient->id; ?></td>
                                <td> <?php echo $patient->out_p_iid; ?></td>
                                <td> <?php echo $patient->out_p_name; ?></td>
                                <td> <?php echo $patient->age; ?></td>
                                <td> <?php echo $patient->ename; ?></td>


                                <td class="no-print">
                                <?php if ($this->ion_auth->in_group(array('admin', 'Accountant'))) { ?>
                                     <a type="button" class="btn editoutsrbt" title="<?php echo lang('edit'); ?>" data-toggle="modal" data-id="<?php echo $patient->id; ?>"><i class="fa fa-edit"></i> <?php echo lang('bill'); ?></a>
                                <?php } ?> 
                                     <button onclick="print_bill(this.id)" type="button" class="btn green" id="<?php echo $patient->out_p_iid; ?>" title="<?php echo $patient->dr_id; ?>" data-toggle="modal" data_id=""><i class="fa fa-print"></i> <?php echo lang('print'); ?></button>

<!--                                     <?php if ($this->ion_auth->in_group(array('admin', 'Accountant'))) { ?>
                                     <a class="btn delete_button" title="<?php echo lang('delete'); ?>" href="patient/delete?id=<?php echo $patient->id; ?>" onclick="return confirm('Are you sure you want to delete this item?');"><i class="fa fa-trash"></i></a>
                                    <?php } ?> -->
                                   

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
                <form role="form" id="patientadd" action="bill/add_out_patient" method="post" enctype="multipart/form-data">

                    <div class="form-group">
                        <label for="exampleInputEmail1"> <?php  echo lang('doctor'); ?></label>
                        <select class="form-control m-bot15 js-example-basic-single" id="doctor" name="dr_id" value=''>
                            <option value="">Select....</option>
                        <?php foreach ($doctors as $doctor) { ?>
                            <option value="<?php echo $doctor->drname; ?>"><?php echo $doctor->dr_id; ?> --------- <?php echo $doctor->drname; ?> </option>
                        <?php } ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1"> <?php  echo lang('name'); ?></label>
                        <input required="required" type="text" class="form-control" name="out_p_name" id="exampleInputEmail1 out_p_name" value='' placeholder="Patient Name">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('age'); ?></label>
                        <input class="form-control form-control-inline input-medium " type="text" name="age" value="" placeholder="">      
                    </div>

                    <input class="form-control form-control-inline input-medium " type="hidden" name="outpiiddd" value="<?php foreach ($ooutPtnn as $outp) {
                                                    $pidp[] = $outp->id;
                                                   }
                                                $lastid = end($pidp) + 1;
                                                echo $lastid;
                                                 ?>" placeholder="">   

                    <div class="form-group" id="out_ser_info_full">
                        <label for="exampleInputEmail1"> <?php  echo lang('service').' '.lang('name'); ?></label><br>

                      <div id="out_ser_info" class="out_ser_info">
                        <select onchange="clickChangeServices()" required="required" style="width: 50%; float: left;" class="form-control  " id="out_ser" name="ser_cat_iid[]" value=''>
                            <option value="">Select....</option>
                        <?php foreach ($bill_cats as $bill_cat) { ?>
                            <option value="<?php echo $bill_cat->c_num; ?>"><?php echo $bill_cat->category; ?> </option>
                        <?php } ?>
                        </select>

                        <input type="hidden" name="stssas" class="ptssts" value="">

                        <input style="width: 10%; float: left; border: 1px black dashed; margin-left: 5px;" type="text" class="form-control ttltaka" id="out_ser_num" value=''>
                        <input style="width: 25%; float: left; text-align: right;" type="text" class="form-control hospltaka" name="ser_tk[]" id="out_ser_tk" value=''>
                        <div class="cumms_box" id="cumms_box_full" >
                            <input id="cumms_name" style="width: 50%; float: left; border: 1px black dotted ;" type="text" class="form-control" name="comms_name[]">
                            <input id="cumms_taka" style="width: 36%; float: left; border: 1px black solid ;" type="text" class="form-control cumstaka" name="ser_comms_tk[]">
                        </div>

                    </div>
                        <img style="cursor: pointer;" src="uploads/ad_plus.png" width="30px" height="30px" id="add_img">
                        <img style="cursor: pointer;" src="uploads/delete.png" width="30px" height="30px" id="del_img">
                    </div>
<br><br><br>

                    <center>
                        <button style="padding: 20px 60px 20px 60px; font-size: 20px;" type="submit" name="submit" class="btn btn-info outssssr"><?php echo lang('register'); ?></button>
                    </center>
                </form>

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- Add Patient Modal-->









<!-- Add Dental Service Modal-->
<div class="modal fade" id="dntlModalbox" tabindex="-1" role="dialog" aria-labelledby="myModalDental" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title"><i class="fa fa-plus-circle"></i> <?php echo lang('register_new_patient'); ?></h4>
            </div>
            <div class="modal-body">
                <form role="form" id="dntlfrm" action="bill/add_dntlsrvc" method="post" enctype="multipart/form-data">

                    <div class="form-group">
                        <label for="exampleInputEmail1"> <?php  echo lang('doctor'); ?></label>
                        <select required="required" onchange="dntlcumstaka()" class="form-control m-bot15 js-example-basic-single dntldoctor" id="dntldoctor" name="dr_id" value=''>
                            <option value="">Select....</option>
                        <?php foreach ($doctors as $doctor) { ?>
                            <option value="<?php echo $doctor->drname; ?>"><?php echo $doctor->dr_id; ?> --------- <?php echo $doctor->drname; ?> </option>
                        <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"> <?php  echo lang('name'); ?></label>
                        <input required="required" type="text" class="form-control" name="out_p_name" id="exampleInputEmail1 out_p_name" value='' placeholder="Patient Name">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('age'); ?></label>
                        <input class="form-control form-control-inline input-medium " type="text" name="age" value="" placeholder="">      
                    </div>


                    <input class="form-control form-control-inline input-medium " type="hidden" name="outpiiddd" value="<?php foreach ($ooutPtnn as $outp) {
                                                    $pidp[] = $outp->id;
                                                   }
                                                $lastid = end($pidp) + 1;
                                                echo $lastid;
                                                 ?>" placeholder=""> 



                    <div class="form-group" id="out_ser_info_full">
                        <label for="exampleInputEmail1"> <?php  echo lang('service').' '.lang('name'); ?></label><br>
                      <div id="out_ser_info" class="out_ser_info">
                        <select required="required" style="width: 50%; float: left;" class="form-control  " id="dntlsc" name="dntlsc" value=''>
                            <option value="26">Dental Service Charge</option>
                        </select>

                        <input style="width: 20%; float: left; border: 2px black dashed; margin-left: 5px;" type="text" class="form-control dntlttltaaka" id="dntlttltaaka" name="ttltakaa" value=''>

                        <input readonly="readonly" style="width: 15%; float: left; border: 1px solid black; text-align: right;" type="text" class="form-control dntlhstakka" name="hss_tak" id="dntlhstakka" value=''>

                        <div class="cumms_box" id="cumms_box_full">
                            <input id="cum_nem" style="width: 50%; float: left; border: 1px black dotted ;" type="text" class="form-control cumsnem" name="cums_nem">
                            <input readonly="readonly" id="cumms_taka" style="width: 36%; float: left; border: 1px black solid ;" type="text" align="right" class="form-control ttlcumstk" name="dntldrtaka">
                        </div>

<br><br><br><br><br><br>
                    <center>
                        <button style="padding: 20px 60px 20px 60px; font-size: 20px;" type="submit" name="submit" class="btn btn-info dntsbmt"><?php echo lang('register'); ?></button>
                    </center>
                </form>

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- Add Dental Service Modal-->








<script type="text/javascript">


    $('#add_img').click(function() {
        var ser_info = $('.out_ser_info').html();
        $('#out_ser_info_full').append(ser_info);
    });



    $('.dntsbmt').click(function() {
        $('.dntsbmt').attr('disabled','disabled');
    });



    $('.outssssr').click(function() {
        $('.outssssr').attr('disabled','disabled');
    });




    $('#del_img').click(function() {
        $('#out_ser_info:last').fadeOut(90);
    });



    // $('.ttltaka, .cumstaka').keyup(function(){
    //     var totltk = parseInt($('.ttltaka').val());
    //     var connnn = parseInt($('.cumstaka').val());
    //     var cmsstk = 0;
    //     if (connnn != '') {
    //         cmsstk = parseInt($('.cumstaka').val());
    //     }
    //     var hostak = totltk - cmsstk;

    //     var cmsstk = $('.hospltaka').val(hostak);

    // })




    function clickChangeServices() {
        var chash;
        var ser_cat_num;
        var out_to_taka;
        var ser_cats = $('#out_ser').val();



    //     $.ajax({
    //         url: 'bill/bill_cat_rate?cat_id=' + ser_cats,
    //         method: 'GET',
    //         data: '',
    //         dataType: 'json',
    //     }).success(function (b_cat_rate) {
    //         chash = b_cat_rate.cat_rat.indore_rate;
    //         $('#out_ser_tk').val(chash);
    //     });


        if (ser_cats == '6' || ser_cats == '27' || ser_cats == '28' || ser_cats == '30' || ser_cats == '31' || ser_cats == '33' || ser_cats == '34' ) {
            $('.ptssts').val('ot');
        }else {
            $('.ptssts').val('out_ser');            
        }
        


        // if (ser_cats == '13' || ser_cats == '14' || ser_cats == '15' || ser_cats == '16' || ser_cats == '24' || ser_cats == '17') {
        //     $('#cumms_box_full').css('display', 'block');
            
        // }else {
        //     $('#cumms_box_full').css('display', 'none');
        // }

        // $('#out_ser_num').keyup(function(e) {            
        //     ser_cat_num = $(this).val();
        //     out_to_taka = ser_cat_num * chash; 
        //     $('#out_ser_tk').val(out_to_taka);
        // });

    }




        $('#dntlttltaaka').keyup(function(e) {            
            ttltakka = parseInt($('.dntlttltaaka').val());
            hsptltaka = (ttltakka * 10) / 100; 
            cumstaka = ttltakka - hsptltaka;
            $('#dntlhstakka').val(hsptltaka);
            $('.ttlcumstk').val(cumstaka);
        });



        function dntlcumstaka() {          
            cumsname = $('.dntldoctor').val();
            $('#cum_nem').val(cumsname);
        }






function print_bill(clicked_id){
        var url = 'bill/print_out_bill?id='+clicked_id;     
      window.open(url, '_blank', 'height=800,width=800');
    }



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
</script>

<script type="text/javascript">


    
document.onkeyup = function(e) {
if (e.ctrlKey && e.which == 89) {
        $('#myModal').modal('show');
     } 
if (e.ctrlKey && e.which == 81) {
        $('#dntlModalbox').modal('show');
     } }

</script>
<script type="text/javascript">




$(document).ready(function () {

    $(".editoutsrbt").click(function (e) {
        e.preventDefault(e);
        // Get the record's ID via attribute  
        var iid = $(this).attr('dataId');
        $('#editPatientForm').trigger("reset");
        $('#editoutser').modal('show');
        $.ajax({
            url: 'bill/?id=' + iid,
            method: 'GET',
            data: '',
            dataType: 'json',
        }).success(function (response) {
            // Populate the form fields with the data returned from server





        });
    });
});


</script>




<script>
    $(document).ready(function () {
        $(".flashmessage").delay(3000).fadeOut(100);
    });
</script>

