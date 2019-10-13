<!--sidebar end-->
<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">
        <!-- page start-->
        <section class="">

            <header class="panel-heading">
                    <i class="fa fa-dollar"></i>   <?php echo lang('patient').' '.lang('bill'); ?>
            </header>
            <div class="panel-body">
                
                <div class="adv-table editable-table ">
                    <!--
                      <div class=" no-print">
                        <a data-toggle="modal" href="#myModal">
                            <div class="btn-group">
                                <button id="" class="btn green">
                                     <i class="fa fa-plus-circle"></i> <?php echo lang('add_new'); ?>
                                </button>
                            </div>
                        </a>
                        <button class="export no-print" onclick="javascript:window.print();"><?php echo lang('print'); ?></button>  
                    </div>
                    -->
                    <div class="space15"></div>
                    <table class="table table-striped table-hover table-bordered" id="editable-sample">
                        <thead>
                            <tr>
                                <th><?php echo lang('patient_id'); ?></th> 
                                <th><?php echo lang('name'); ?></th>
                                <th><?php echo lang('doctor').' '.lang('name'); ?></th>
                                <th><?php echo lang('register').' '.lang('no'); ?></th>
                                <th><?php echo lang('bed').' '.lang('no'); ?></th>
                                <th><?php echo lang('admit').' '.lang('date'); ?></th>
                                <th><?php echo lang('register').' '.lang('no'); ?></th>
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
                        <?php foreach ($paitents as $patient) { ?>
                            <tr class="">
                                <td> <?php echo $patient->id; ?></td>
                                <td> <?php echo $patient->ptnname; ?></td>
                                <td><?php 
                                        $this->db->where('dr_id', $patient->dr_id);
                                        $query = $this->db->get('doctor');
                                        $eml = $query->row();
                                                echo  $eml->drname;
                                 ?></td>
                                <td> <?php echo $patient->patient_id; ?></td>
                                <td> <?php echo $patient->b_num; ?></td>
                                <td> <?php echo date('d-m-Y h:m a', $patient->time_this); ?></td>
                                <td align="right"> <?php echo $patient->reg_no; ?></td>

                                <td class="no-print">
                            <?php if ($this->ion_auth->in_group(array('admin', 'Accountant'))) { ?>
                                <?php if (empty($patient->dis_time)) {?>
                                     <a type="button" class="btn editbutton" title="<?php echo lang('edit'); ?>" data-toggle="modal" data-id="<?php echo $patient->id; ?>"><i class="fa fa-edit"></i> <?php echo lang('bill'); ?></a>
                                <?php }?>
							<?php } ?>


                                <?php if (!empty($patient->dis_time)) {?>
                                     <button onclick="reply_click(this.id)" type="" class="btn green" id="<?php echo $patient->id; ?>" title="<?php echo $patient->dr_id; ?>" data-toggle="modal" data=""><i class="fa fa-print"></i> <?php echo lang('print'); ?></button>



                                     <a type="button" class="btn btn-primary editbill" title="<?php echo lang('edit'); ?>" data-toggle="modal" data-id="<?php echo $patient->id; ?>"><i class="fa fa-edit"></i> <?php echo lang('edit'); ?></a>


                                <!--
                                    <button onclick="ok_click(this.id)" type="" class="btn btn-success" id="<?php echo $patient->id; ?>"></i> <?php echo lang('ok'); ?></button> -->
                                 
                                <?php }?>


<!--
                                    <?php if ($this->ion_auth->in_group(array('admin', 'Accountant'))) { ?>
                                     <a class="btn delete_button" title="<?php echo lang('delete'); ?>" href="bill/billdelete?id=<?php echo $patient->id; ?>" onclick="return confirm('Are you sure you want to delete this item?');"><i class="fa fa-trash"></i></a>
                                    <?php } ?>
                                   -->

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


<!--
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
                        <select class="form-control" id="doctor" name="dr_id" value=''>
                            <option>Select....</option>
                        <?php foreach ($doctors as $doctor) { ?>
                            <option value="<?php echo $doctor->dr_id; ?>"><?php echo $doctor->dr_id; ?> --------- <?php echo $doctor->drname; ?> </option>
                        <?php } ?>
                        </select>
                    </div>




                    <div class="form-group">
                        <label for="exampleInputEmail1"> <?php  echo lang('name'); ?></label>
                        <select class="form-control m-bot15 js-example-basic-single" id="app_id" name="app_id" value='' onchange="changeid()">
                            <option>Select....</option>
                        <?php foreach ($appoints as $appoint) { ?>
                            <option value="<?php echo $appoint->id; ?>"><?php echo $appoint->serial; ?> --------- <?php echo $appoint->patient; ?> </option>
                        <?php } ?>
                        </select>
                    </div>

                        <input type="text" class="form-control" name="name" id="exampleInputEmail1" value='' placeholder="">



                    <div class="form-group">
                        <label for="exampleInputEmail1"> <?php  echo lang('bed').' '.lang('no'); ?></label>
                        <select class="form-control m-bot15 js-example-basic-single" id="app_id" name="b_num" value=''>
                            <option>Select....</option>
                        <?php foreach ($beds as $bed) { ?>
                            <option value="<?php echo $bed->b_num; ?>"><?php echo $bed->b_num; ?> </option>
                        <?php } ?>
                        </select>
                    </div>



                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('father'); ?></label>
                        <input type="text" class="form-control" name="f_name" id="exampleInputEmail1" value='' placeholder="">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('address'); ?></label>
                        <input required="required" type="text" class="form-control" name="address" id="exampleInputEmail1" value='' placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('mobile'); ?></label>
                        <input type="text" class="form-control" name="mobile" id="exampleInputEmail1" value='' placeholder="">
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
                        <label><?php echo lang('birth_date'); ?></label>
                        <input class="form-control form-control-inline input-medium default-date-picker" type="text" name="birthdate" value="" placeholder="">      
                    </div>


                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('age'); ?></label>
                        <input class="form-control form-control-inline input-medium " type="text" name="age" value="" placeholder="">      
                    </div>


                    <input type="hidden" name="id" value=''>
                    <section class=""><center>
                        <button style="padding: 20px 60px 20px 60px; font-size: 20px;" type="submit" name="submit" class="btn btn-info"><?php echo lang('register'); ?></button></center>
                    </section>
                </form>

            </div>
        </div>
    </div>
</div>-->
<!-- Add Patient Modal-->







<!-- Create Bill Modal-->
<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title"><i class="fa fa-edit"></i> <?php echo lang('create').' '.lang('bill'); ?></h4>
            </div>
            <div class="modal-body">
                <form role="form" id="editPatientForm" action="bill/newbill" method="post" enctype="multipart/form-data">

                    <div class="input-group">
                      <span class="input-group-addon lanr" id="basic-addon3">
                          <?php echo lang('patient').' '.lang('name'); ?>
                      </span>
                      <input disabled="disabled" type="text" name="name" class="form-control" aria-describedby="basic-addon3">
                    </div><br>


                    <div class="input-group">
                      <span class="input-group-addon lanr" id="basic-addon3">
                          <?php echo lang('bed').' '.lang('no'); ?>
                      </span>
                      <input disabled="disabled" type="text" name="b_num" class="form-control" aria-describedby="basic-addon3">
                    </div><br>


                    <div class="input-group">
                      <span class="input-group-addon lanr" id="basic-addon3">
                          <?php echo lang('consultant').' '.lang('name'); ?>
                      </span>
                        <select class="form-control m-bot15 js-example-basic-single" id="doctor" name="consul" value=''>
                            <option value="">Select....</option>
                        <?php foreach ($doctors as $doctor) { ?>
                            <option value="<?php echo $doctor->dr_id; ?>"><?php echo $doctor->dr_id; ?> --------- <?php echo $doctor->drname; ?> </option>
                        <?php } ?>
                        </select>
                    </div><br>

                    <div class="input-group">
                      <span class="input-group-addon lanr" id="basic-addon3">
                          <?php echo lang('consultant').' '.lang('name'); ?>
                      </span>
                        <select class="form-control m-bot15 js-example-basic-single" id="doctor" name="consul_sec" value=''>
                            <option value="">Select....</option>
                        <?php foreach ($doctors as $doctor) { ?>
                            <option value="<?php echo $doctor->dr_id; ?>"><?php echo $doctor->dr_id; ?> --------- <?php echo $doctor->drname; ?> </option>
                        <?php } ?>
                        </select>
                    </div><br>


                    <div class="input-group">
                      <span class="input-group-addon lanr" id="basic-addon3">
                          <?php echo lang('doctor').' '.lang('name'); ?>
                      </span>
                      <input disabled="disabled" type="text" name="dr_id" class="form-control" aria-describedby="basic-addon3">
                    </div><br>


                    <div id="dr_asst_div" style="display: none;">
                    <div class="input-group">
                      <span class="input-group-addon lanr" id="basic-addon3">
                          <?php echo lang('doctor').' '.lang('assistant').' '.lang('name'); ?>
                      </span>
                      <input type="text" id="dr_asst" name="assis" class="form-control" aria-describedby="basic-addon3">
                    </div><br>
                    </div>

                    <div id="dr_annes_div" style="display: none;">
                    <div class="input-group">
                      <span class="input-group-addon lanr" id="basic-addon3">
                          <?php echo lang('anesthesiologist').' '.lang('name'); ?>
                      </span>
                      <input type="text" id="dcr_ansth" name="anesthe" class="form-control" aria-describedby="basic-addon3">
                    </div><br>
                    </div>




                    <div class="input-group">
                      <span class="input-group-addon lanr" id="basic-addon3">
                          <?php echo lang('select').' '.lang('bill').' '.lang('type'); ?>
                      </span>
                        <select class="form-control form-control-lg" id="bill_type">
                          <option value="">Select Bill Type</option>
                          <option value="indoor">Indoor</option>
<!--                           <option value="obsn">Observation</option> -->
                          <option value="dnc">D.N.C</option>
                          <option value="nvd">N.V.D</option>
                          <option value="ot">O.T</option>
                        </select>
                    </div><br>


                    <div id="bill_des">
                        
                    </div>
                    <br>
                    <div style="font-size: 20px; font-weight: bold;" align="right" class="total_bill t_b">

                    </div>

                    <br><br>
                    <input type="text" name="admitTime">
                    <input type="hidden" name="id" >
                    <input type="hidden" name="pStatus">
                    <center>
                        <section class="">
                            <button style="font-size: 20px;" type="submit" name="submit" class="btn btn-info"><?php echo lang('submit'); ?></button>
                        </section>
                    </center>

                </form>
            </div>
        </div>
    </div>
</div>
<!-- Create Bill Modal-->








<!-- Edit Bill -->
<div class="modal fade" id="editBillData" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title"><i class="fa fa-edit"></i> <?php echo lang('edit').' '.lang('bill'); ?></h4>
            </div>
            <div class="modal-body">
                <form role="form" id="editBillForm" action="bill/editBill" method="post" enctype="multipart/form-data">

                    <div class="input-group">
                      <span class="input-group-addon lanr" id="basic-addon3">
                          <?php echo lang('patient').' '.lang('name'); ?>
                      </span>
                      <input disabled="disabled" type="text" name="name" class="form-control" aria-describedby="basic-addon3">
                    </div><br>


                    <div class="input-group">
                      <span class="input-group-addon lanr" id="basic-addon3">
                          <?php echo lang('bed').' '.lang('no'); ?>
                      </span>
                      <input disabled="disabled" type="text" name="b_num" class="form-control" aria-describedby="basic-addon3">
                    </div><br>


                    <div class="input-group">
                      <span class="input-group-addon lanr" id="basic-addon3">
                          <?php echo lang('consultant').' '.lang('name'); ?>
                      </span>
                        <select class="form-control" id="consul" name="consul" value=''>
                            <option value="">Select....</option>
                        <?php foreach ($doctors as $doctor) { ?>
                            <option value="<?php echo $doctor->dr_id; ?>"><?php echo $doctor->dr_id; ?> --------- <?php echo $doctor->drname; ?> </option>
                        <?php } ?>
                        </select>
                    </div><br>

                    <div class="input-group">
                      <span class="input-group-addon lanr" id="basic-addon3">
                          <?php echo lang('consultant').' '.lang('name'); ?>
                      </span>
                        <select class="form-control" id="consul_sec" name="consul_sec" value=''>
                            <option value="">Select....</option>
                        <?php foreach ($doctors as $doctor) { ?>
                            <option value="<?php echo $doctor->dr_id; ?>"><?php echo $doctor->dr_id; ?> --------- <?php echo $doctor->drname; ?> </option>
                        <?php } ?>
                        </select>
                    </div><br>


                    <div class="input-group">
                      <span class="input-group-addon lanr" id="basic-addon3">
                          <?php echo lang('doctor').' '.lang('name'); ?>
                      </span>
                      <input disabled="disabled" type="text" name="dr_id" class="form-control" aria-describedby="basic-addon3">
                    </div><br>



                    <div class="input-group">
                      <span class="input-group-addon lanr" id="basic-addon3">
                          <?php echo lang('doctor').' '.lang('assistant').' '.lang('name'); ?>
                      </span>
                      <input type="text" name="assis" class="form-control" aria-describedby="basic-addon3">
                    </div><br>


                    <div class="input-group">
                      <span class="input-group-addon lanr" id="basic-addon3">
                          <?php echo lang('anesthesiologist').' '.lang('name'); ?>
                      </span>
                      <input type="text" name="anesthe" class="form-control" aria-describedby="basic-addon3">
                    </div><br><br>
                    <input type="text" name="admitTime" id="t_days">
                    <br>

                    <div class="edit_bill" id="edit_bill">
                    </div>

                    <div style="font-size: 20px; font-weight: bold;" align="right" class="bill_total">
                    </div><br>

                    <input type="hidden" name="id" >
                    <center>
                        <section class="">
                            <button style="font-size: 20px;" type="submit" name="submit" class="btn btn-info"><?php echo lang('submit'); ?></button>
                        </section>
                    </center>

                </form>
            </div>
        </div>
    </div>
</div>
<!-- Edit Bill -->





















<script type="text/javascript">


function ok_click(clicked_id){
    $.ajax({
            url: 'bill/bill_ok?ok=' + clicked_id,
            method: 'GET',
            data: '',
            dataType: 'json',
        }).success(function (bill) {
    $('#editable-sample').load(location.href + ' #editable-sample');
        });
        
}


function reply_click(clicked_id){
        var url = 'bill/printbill?id='+clicked_id;     
      window.open(url, '_blank', 'height=800,width=800');
    }
</script>

<script type="text/javascript">

$(document).ready(function () {
    $(".editbutton").click(function (e) {
        e.preventDefault(e);
        // Get the record's ID via attribute  
        var iid = $(this).attr('data-id');

        $('#editPatientForm').trigger("reset");
        $('#myModal2').modal('show');
        $.ajax({
            url: 'bill/editPatientByJason?id=' + iid,
            method: 'GET',
            data: '',
            dataType: 'json',
        }).success(function (response) {
            // Populate the form fields with the data returned from server
            var dr_id = response.patient.dr_id;

            var bed = response.patient.b_num;

            $('#editPatientForm').find('[name="name"]').val(response.patient.ptnname).end()
            $('#editPatientForm').find('[name="b_num"]').val(response.patient.b_num).end()
            $('#editPatientForm').find('[name="id"]').val(response.patient.id).end()

    $.ajax({
    type: 'ajax',
    url: 'bill/dr_name?dr_id=' + dr_id,
    method: 'GET',
    data: '',
    dataType: 'json',
    }).success(function(dr_nam) {

    $('#editPatientForm').find('[name="dr_id"]').val(dr_nam.dr_id_name.drname).end()
    });

    $.ajax({
    type: 'ajax',
    url: 'bill/bed_bill?bed_no=' + bed,
    method: 'GET',
    data: '',
    dataType: 'json',
    }).success(function(bill_tk) {

        var bed_taka = bill_tk.bed_no_tk.price;
        var bed_amount_hours = bed_taka / 24;
        var t_day = 1;

                var admit = response.patient.time_this;
                var dis = <?php echo time();?>;
                var total_admit = dis - admit;
                var date = new Date(total_admit*1000);
                var t_ad = date.getHours();
                var minutes = Math.floor((date/1000)/60/60);
                var dayss = Math.floor((date/1000)/60/60/24)
                var total_bed_bill = parseInt(bed_amount_hours * minutes);
                var ob_hours = minutes % 24;
                var mtDys = dayss;
                if (ob_hours > 6 && dayss != 0 ) {
                    t_day = dayss + 1;   
                }else if(dayss == 0) {
                    t_day = 1;
                }else {
                    t_day = dayss;
                }
    $('#editPatientForm').find('[name="admitTime"]').val(mtDys+" Day & "+ ob_hours+ " Hours").end()






$("#bill_type").click(function(){


    var billtype = $('#bill_type').val();

    if (billtype == 'ot') {
        $('#dr_asst_div').css('display', 'block');
        $('#dr_annes_div').css('display', 'block');
        $('#dr_asst').attr('required', 'required');
        $('#dcr_ansth').attr('required', 'required');

    }else {
        $('#dr_asst_div').css('display', 'none');
        $('#dr_annes_div').css('display', 'none');
        $('#dr_asst').removeAttr('required');
        $('#dcr_ansth').removeAttr('required');
    }

        $.ajax({
            type: 'ajax',
            url: 'bill/getBillcatByJson',
            async: false,
            data: '',
            dataType: 'json',
        }).success(function(billcat) {

            $('#editPatientForm').find('[name="pStatus"]').val(billtype).end()




            
            var html = '';
            var i;

            for (i=0; i<billcat.length; i++) {

                if (billtype == 'indoor') {
                    if (billcat[i].c_num == '9' || billcat[i].c_num == '10' || billcat[i].c_num == '11' || billcat[i].c_num == '15' || billcat[i].c_num == '16' ||  billcat[i].c_num == '21' || billcat[i].c_num == '23' || billcat[i].c_num == '19') {

                       var i_rate = parseInt(billcat[i].indore_rate);
                        var t_rate = i_rate ;

                        //  var bill_rate = function (){
                        //      var rate_sum = 0;
                        //      $('#nebu').each(function(){
                        //          var num_rate = $(this).val();
                        //          var d_rate = $('#rate').val();

                        //      if (num_rate != 0) {
                        //          rate_sum = num_rate * d_rate;
                        //          }
                                
                        //      $('#bill_tk').val(rate_sum);
                        //      });
                        //  }
                        // // bill_rate(); 


                        // $("#nebu").on("keyup", function() {
                        // const dependedFieldValue = $("#nebu").val();
                        // const motherFieldValue = i_rate;
                        // if(dependedFieldValue.trim() !== ''){
                        // $("#motherField").val() = dependedFieldValue * motherFieldValue;
                        // }
                        // })

                     html +='<div class="input-group"><span style="font-weight: bold; color: black;" class="input-group-addon lanr" id="basic-addon3">'+billcat[i].category+'</span><input type="hidden" name="cat_cid[]" value="'+billcat[i].c_num+'"><input style="text-align:right; float:left; border: 1px solid black; width: 50%;" type="text" name="nebu[]" id="nebu'+billcat[i].c_num+'" class="form-control nebu" aria-describedby="basic-addon3" value=""><input type="hidden" id="rate'+billcat[i].c_num+'" class="vvvall" value="'+i_rate+'"><input style="text-align:right; float:right; width: 50%;" type="text" name="cat_cvalue[]" class="form-control bill_tk bill_tl bbbthhhkkk" id="bill_tk'+billcat[i].c_num+'" aria-describedby="basic-addon3" value="0"></div><div class="klm"></div>';

                   
                 }else if (billcat[i].c_num == '8') {
                    
                    var rate = bed_taka;
                    var total_rate;
                    if (dayss == 0 && ob_hours < 7 ) {
                        total_rate = 200;
                    }else {
                        total_rate = rate * t_day;
                    }


                     html +='<div class="input-group"><span style="font-weight: bold; color: black;" class="input-group-addon lanr" id="basic-addon3">'+billcat[i].category+'</span><input type="hidden" name="cat_cid[]" value="'+billcat[i].c_num+'"><input style="text-align:right;" type="text" name="cat_cvalue[]" class="form-control bill_tk" aria-describedby="basic-addon3" value="'+total_rate+'"></div>';
                }else if (billcat[i].c_num == '2' || billcat[i].c_num == '24' ) {
                    var rate = billcat[i].indore_rate;
                    var total_rate;                var total_rate;
                    if (dayss == 0 && ob_hours < 7 ) {
                        total_rate = 200;
                    }else {
                        total_rate = rate * t_day;
                    }
                        html +='<div class="input-group"><span style="font-weight: bold; color: black;" class="input-group-addon lanr" id="basic-addon3">'+billcat[i].category+'</span><input type="hidden" name="cat_cid[]" value="'+billcat[i].c_num+'"><input style="text-align:right;" type="text" name="cat_cvalue[]" class="form-control bill_tk" aria-describedby="basic-addon3" value="'+total_rate+'"></div>';
                }else {
                     html +='<div class="input-group"><span style="font-weight: bold; color: black;" class="input-group-addon lanr" id="basic-addon3">'+billcat[i].category+'</span><input type="hidden" name="cat_cid[]" value="'+billcat[i].c_num+'"><input style="text-align:right;" type="text" name="cat_cvalue[]" class="form-control bill_tk" aria-describedby="basic-addon3" value="'+billcat[i].indore_rate+'"></div>'; }
                 
                }else if (billtype == 'obsn'){
                    html += '<div class="input-group"><span style="font-weight: bold; color: black;" class="input-group-addon lanr" id="basic-addon3">'+billcat[i].category+'</span><input type="hidden" name="cat_cid[]" value="'+billcat[i].c_num+'"><input style="text-align:right;" type="text" name="cat_cvalue[]" class="form-control  bill_tk" aria-describedby="basic-addon3" value="0"></div>';

                }else if (billtype == 'dnc'){
                    html += '<div class="input-group"><span style="font-weight: bold; color: black;" class="input-group-addon lanr" id="basic-addon3">'+billcat[i].category+'</span><input type="hidden" name="cat_cid[]" value="'+billcat[i].c_num+'"><input style="text-align:right;" type="text" name="cat_cvalue[]" class="form-control bill_tk" aria-describedby="basic-addon3" value="'+billcat[i].dnc_rate+'"></div>';

                }else if (billtype == 'nvd'){
                    html += '<div class="input-group"><span style="font-weight: bold; color: black;" class="input-group-addon lanr" id="basic-addon3">'+billcat[i].category+'</span><input type="hidden" name="cat_cid[]" value="'+billcat[i].c_num+'"><input style="text-align:right;" type="text" name="cat_cvalue[]" class="form-control bill_tk" aria-describedby="basic-addon3" value="'+billcat[i].nvd_rate+'"></div>';

                }else if (billtype == 'ot') {
                    html += '<div class="input-group"><span style="font-weight: bold; color: black;" class="input-group-addon lanr" id="basic-addon3">'+billcat[i].category+'</span><input type="hidden" name="cat_cid[]" value="'+billcat[i].c_num+'"><input style="text-align:right;" type="text" name="cat_cvalue[]" class="form-control bill_tk" aria-describedby="basic-addon3" value="'+billcat[i].ot_rate+'"></div>';

                }else {


                }}

            $('#bill_des').html(html);


            var total_bill_amount = function (){
                var sum_total = 0;
                $('.bill_tk').each(function(){
                    var bill_num = $(this).val();
                if (bill_num != 0) {
                    sum_total += parseInt(bill_num);
                    }
                });
                $('.total_bill').html(sum_total);
            }

                total_bill_amount();

            $('.bill_tk').keyup(function(){
                total_bill_amount();
            })





    //         $('.nebu').keyup(function(){
    //             alert($(this).val());
    //             bill_rate();

    // var cvlt = $(this).val();
    // alert(cvlt);
    //         })



            // $('#t_day').keyup(function(){
            //     var days_total = $(this).val();
            //     alert(days_total);
                
            // })           


/**

$('.nebu').keyup(function() {
    var cvlt = $(this).val();
    alert(cvlt)

});

**/








        });

    });





        });

        });

    });






});
/**
        $('#bill_des').jAutoCalc({'destroy'});
        $('#bill_des').jAutoCalc({keyEventsFire: true, decimalPlaces: 2, emptyAsZero: true});
        $('#bill_des').jAutoCalc({ decimalPlaces: 2});




            $('.form-control').on('input','. bill_tk', function(){
                var totalSum = 0;
                $('.form-control . bill_tk').each(function(){
                    var inputVal = $(this).val();
                    if ($.isNumberic(inputVal)){
                        totalSum += parseFloat(inputVal);
                    }
                });
                $('.total_bill').text(totalSum);
            });
**/









</script>








<script type="text/javascript">

$(document).ready(function () {
    $(".editbill").click(function (e) {
        e.preventDefault(e);
        // Get the record's ID via attribute  
        var p_bill_id = $(this).attr('data-id');

        $('#editBillForm').trigger("reset");
        $('#editBillData').modal('show');
        $.ajax({
            url: 'bill/editPatientByJason?id=' + p_bill_id,
            method: 'GET',
            data: '',
            dataType: 'json',
        }).success(function (response) {
            // Populate the form fields with the data returned from server
            var dr_id = response.patient.dr_id;

            var bed = response.patient.b_num;



                var admit = response.patient.time_this;
                var dis = <?php echo time();?>;
                var total_admit = dis - admit;
                var date = new Date(total_admit*1000);
                var t_ad = date.getHours();
                var minutes = Math.floor((date/1000)/60/60);
                var dayss = Math.floor((date/1000)/60/60/24);
                var t_day = dayss + 1;
             $('#editBillForm').find('[name="admitTime"]').val(t_day+" Day").end()





            $('#editBillForm').find('[name="name"]').val(response.patient.ptnname).end()
            $('#editBillForm').find('[name="b_num"]').val(response.patient.b_num).end()
            $('#editBillForm').find('[name="id"]').val(response.patient.id).end()
           // $('#editBillForm').find('[name="id"]').val(response.patient.consultant_id).end()

            $('#consul option[value='+response.patient.consultant_id+']').attr('selected', 'selected');
            $('#consul_sec option[value='+response.patient.consul_sec_id+']').attr('selected', 'selected');

            $.ajax({
            type: 'ajax',
            url: 'bill/dr_name?dr_id=' + dr_id,
            method: 'GET',
            data: '',
            dataType: 'json',
            }).success(function(dr_nam) {

                 $('#editBillForm').find('[name="dr_id"]').val(dr_nam.dr_id_name.drname).end()
            });

        });

    $.ajax({
    type: 'ajax',
    url: 'bill/bill_rate?p_id=' + p_bill_id,
    async: false,
    data: '',
    dataType: 'json',
    }).success(function(bill_tk) {
            var html = '';
            var n;

        for (n=0; n<bill_tk.length; n++) {

              html += '<div class="input-group"><span style="font-weight: bold; color: black;" class="input-group-addon lanr" id="basic-addon3">'+bill_tk[n].category+'</span><input type="hidden" name="cat_cid[]" value="'+bill_tk[n].c_num+'"><input style="text-align:right;" type="text" id="" name="cat_cvalue[]" class="form-control taka_bill" aria-describedby="basic-addon3" value="'+bill_tk[n].bill_taka+'"></div>';
            
                }

            $('#edit_bill').html(html);


            var bill_amount = function (){
                var sum_t = 0;
                $('.taka_bill').each(function(){
                    var bill_r = $(this).val();
                if (bill_r != 0) {
                    sum_t += parseInt(bill_r);
                    }
                });
                $('.bill_total').html(sum_t);
            }

                bill_amount();
            $('.taka_bill').keyup(function(){
                bill_amount();
            })


        });


    });

});
/**



















        $('#bill_des').jAutoCalc({'destroy'});

editBillForm

cat_cid

        $('#bill_des').jAutoCalc({keyEventsFire: true, decimalPlaces: 2, emptyAsZero: true});
        $('#bill_des').jAutoCalc({ decimalPlaces: 2});




            $('.form-control').on('input','. bill_tk', function(){
                var totalSum = 0;
                $('.form-control . bill_tk').each(function(){
                    var inputVal = $(this).val();
                    if ($.isNumberic(inputVal)){
                        totalSum += parseFloat(inputVal);
                    }
                });
                $('.total_bill').text(totalSum);
            });
**/
</script>













<!--
<script type="text/javascript">
    $(document).ready(function () {    
        $('#dis_id').keyup(function () {
            var num1 = document.getElementById('nebu');
            var price = document.getElementById('nebu');
            var total_val = num1 * price; 
        });

    });

</script>-->
<script>
    $(document).ready(function () {
        $(".flashmessage").delay(3000).fadeOut(100);
    });
</script>
