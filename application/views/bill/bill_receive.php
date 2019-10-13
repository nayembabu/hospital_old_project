<!--sidebar end-->
<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">
        <!-- page start-->
        <section class=""> 

            <header class="panel-heading">
                    <i class="fa fa-dollar"></i>   <?php echo lang('receive').' '.lang('bill'); ?>
            </header>
            <div class="panel-body">
                
                <div class="adv-table editable-table ">
                    
                      <div class=" no-print">
                        <center>
                        <a data-toggle="modal" href="#advblModal">
                            <div class="btn-group" >
                                <button class="btn green" style="font-size: 30px;">
                                     <i class="fa fa-plus-circle"></i> Advance Bill
                                </button>
                            </div>
                        </a></center>
                        <button class="export no-print" onclick="javascript:window.print();"><?php echo lang('print'); ?></button>  
                    </div>
                    
                    <div class="space15"></div>

                    <table class="table table-striped table-hover table-bordered" id="editable-sample">
                        <thead>
                            <tr>
                                <th><?php echo lang('receive').' '.lang('time'); ?></th> 
                                <th><?php echo lang('patient_id'); ?></th> 
                                <th><?php echo lang('name'); ?></th>
                                <th><?php echo lang('status'); ?></th>
                                <th><?php echo lang('doctor').' '.lang('name'); ?></th>
                                <th><?php echo lang('register').' '.lang('no'); ?></th>
                                <th><?php echo lang('bed').' '.lang('no'); ?></th>
                                <th><?php echo lang('discharge').' '.lang('time'); ?></th>
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
                                <td> <?php echo $patient->bllrcvtime; ?></td>
                                <td> <?php echo $patient->id; ?></td>
                                <td> <?php echo $patient->ptnname; ?></td>
                                <td> <?php echo $patient->p_stus; ?></td>
                                <td><?php 
                                        $this->db->where('dr_id', $patient->dr_id);
                                        $query = $this->db->get('doctor');
                                        $eml = $query->row();
                                                echo  $eml->drname;
                                 ?></td>
                                <td> <?php echo $patient->patient_id; ?></td>
                                <td> <?php echo $patient->b_num; ?></td>
                                <td> <?php echo date('d-m-y h:m a',$patient->dis_time); ?></td>
                                <td align="right"> <?php echo $patient->reg_no; ?></td>

                                <td class="no-print">


                                <?php if ($patient->ok == '1') {?>

                                     <button onclick="reply_click(this.id, this.title)" type="" class="btn green" id="<?php echo $patient->id; ?>" title="<?php echo $patient->dr_id; ?>" data-toggle="modal" data=""><i class="fa fa-stethoscope"></i> <?php echo lang('print'); ?></button>

                        <?php if ($this->ion_auth->in_group(array('admin', 'Accountant'))) { ?> 
                                     <a type="button" class="btn btn-primary rcvbldt" title="<?php echo lang('edit'); ?>" data-toggle="modal" data-id="<?php echo $patient->id; ?>"><i class="fas fa-hand-holding-usd"></i></a>

                                <?php }?>
                                <?php }?>



                                <?php if ($patient->ok == '0') {?>

                                     <a type="button" class="btn btn-primary editbill" title="<?php echo lang('edit'); ?>" data-toggle="modal" data-id="<?php echo $patient->id; ?>"><i class="fas fa-hand-holding-usd"></i> <?php echo lang('receive').' '.lang('bill'); ?></a>

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






<!-- Advance Bill Option -->


<div class="modal fade" id="advblModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title"><i class="fa fa-plus-circle"></i>  Advance Bill Receive </h4>
            </div>
            <div class="modal-body">
                <form role="form" class="advbill" id="patientadd" method="post" enctype="multipart/form-data">





                    <div class="input-group">
                      <span class="input-group-addon lanr" id="basic-addon3">
                        Patient Name
                      </span>
                        <select class="form-control m-bot15 js-example-basic-single" id="ptnnss" name="ptniidd" value=''>
                            <option value="">Select....</option>
                        <?php foreach ($ptnts as $pnnt) { ?>
                            <option value="<?php echo $pnnt->id; ?>"><?php echo  $pnnt->ptnname.'-----'.$pnnt->b_num.'-----'.$pnnt->patient_id ; ?></option>
                        <?php } ?>
                        </select>
                    </div><br>




                    <div class="ptninfo"> </div>
                    <br>



                    <div class="form-group">
                        <label for="exampleInputEmail1">Advance Taka</label>
                        <input required="required" type="text" class="form-control" name="advtk" id="exampleInputEmail1" value='' placeholder="Type Taka">
                    </div>


 
                    <section class=""><center>
                        <button style="display: none; padding: 20px 60px 20px 60px; font-size: 20px;" type="submit" name="submit" class="btn btn-info sbmtbtn"><?php echo lang('submit'); ?></button></center>
                    </section>
                </form>

            </div>
        </div>
    </div>
</div>
<!-- Advance Bill Option -->







<!-- Create Bill Modal-->

<!--
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
                      <input readonly type="text" name="name" class="form-control" aria-describedby="basic-addon3">
                    </div><br>


                    <div class="input-group">
                      <span class="input-group-addon lanr" id="basic-addon3">
                          <?php echo lang('bed').' '.lang('no'); ?>
                      </span>
                      <input readonly type="text" name="b_num" class="form-control" aria-describedby="basic-addon3">
                    </div><br>


                    <div class="input-group">
                      <span class="input-group-addon lanr" id="basic-addon3">
                          <?php echo lang('consultant').' '.lang('name'); ?>
                      </span>
                        <select class="form-control m-bot15 js-example-basic-single" id="doctor" name="consul" value=''>
                            <option value="">Select....</option>
                        <?php foreach ($doctors as $doctor) { ?>
                            <option value="<?php echo $doctor->name; ?>"><?php echo $doctor->dr_id; ?> --------- <?php echo $doctor->name; ?> </option>
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
                            <option value="<?php echo $doctor->drname; ?>"><?php echo $doctor->dr_id; ?> --------- <?php echo $doctor->drname; ?> </option>
                        <?php } ?>
                        </select>
                    </div><br>


                    <div class="input-group">
                      <span class="input-group-addon lanr" id="basic-addon3">
                          <?php echo lang('doctor').' '.lang('name'); ?>
                      </span>
                      <input readonly type="text" name="dr_id" class="form-control" aria-describedby="basic-addon3">
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
                    </div><br>




                    <div class="input-group">
                      <span class="input-group-addon lanr" id="basic-addon3">
                          <?php echo lang('select').' '.lang('bill').' '.lang('type'); ?>
                      </span>
                        <select class="form-control form-control-lg" id="bill_type">
                          <option value="">Select Bill Type</option>
                          <option value="indoor">Indoor</option>
                          <option value="obsn">Observation</option>
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
                    <center>
                        <section class="">
                            <button style="font-size: 20px;" type="submit" name="submit" class="btn btn-info"><?php echo lang('submit'); ?></button>
                        </section>
                    </center>

                </form>
            </div>
        </div>
    </div>
</div>-->
<!-- Create Bill Modal-->








<!-- Receive Bill -->
<div class="modal fade" id="editBillData" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title"><i class="fa fa-edit"></i> <?php echo lang('edit').' '.lang('bill'); ?></h4>
            </div>
            <div class="modal-body">
                <form role="form" id="editBillForm" method="post" enctype="multipart/form-data">

                    <div class="input-group">
                      <span class="input-group-addon lanr" id="basic-addon3">
                          <?php echo lang('patient').' '.lang('name'); ?>
                      </span>
                      <input readonly type="text" name="name" class="form-control" aria-describedby="basic-addon3">
                    </div><br>


                    <div class="input-group">
                      <span class="input-group-addon lanr" id="basic-addon3">
                          <?php echo lang('bed').' '.lang('no'); ?>
                      </span>
                      <input readonly type="text" name="b_num" class="form-control" aria-describedby="basic-addon3">
                    </div><br>



                    <div class="input-group">
                      <span class="input-group-addon lanr" id="basic-addon3">
                          <?php echo lang('doctor').' '.lang('name'); ?>
                      </span>
                      <input readonly id="drs_name" type="text" name="dr_id" class="form-control" aria-describedby="basic-addon3">
                    </div><br>


<!--
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
                      <input type="text" name="anes_id" class="form-control" aria-describedby="basic-addon3">
                    </div><br><br>--><br>


                    <div style="float: right; width: 200px; border: 1px solid black;" class="input-group">
                      <span style="font-weight: bold; color: black;" class="input-group-addon lanr" id="basic-addon3">
                          <?php echo lang('total').' '.lang('bill'); ?>
                      </span>
                      <input style="font-weight: bold; font-size: 18px; text-align: right;" type="text" name="t_bill" id="t_bill" class="form-control t_bill" aria-describedby="basic-addon3">
                    </div>
                    <br><br><br>


                    <div class="edit_bill" id="edit_bill">
                    </div>

                    <div style="font-size: 18px; font-weight: bold;" align="right" class="bill_total">
                    </div><br>
                    <div style="font-size: 22px; font-weight: bold;" align="right" class="brcvl">
                    </div><br>

                   <!-- <input type="text" name="admitTime"> -->
                    <input type="text" name="disc" id="disc"> 
                    <input type="hidden" name="p_stas" id="p_stas">
                    <input type="hidden" name="id" >
                    <input type="hidden" name="dr_id_ap">
                    <center>
                        <section class="">
                            <button style="font-size: 30px;" type="submit" name="submit" class="btn btn-info rcvbbbblllll"><?php echo lang('submit'); ?></button>
                        </section>
                    </center>

                </form>
            </div>
        </div>
    </div>
</div>
<!-- Receive Bill -->












<script type="text/javascript">
    
    $('#ptnnss').change(function() {

        var ptnsiid = $(this).children("option:selected").val();

if (ptnsiid == '') {
    alert('Please Select Patient');    
    $('.ptninfo').html('<h2>Please Select Patient</h2>');

    $('.sbmtbtn').css('display', 'none');
    $('.advbill').removeAttr('action');



}else {
        $.ajax({
            url: "bill/ptninfoforadvncajax?ptnniid=" + ptnsiid, 
            method: 'GET',
            data: '',
            dataType: 'json',
            success: function(ptninffo){

                $('.ptninfo').html('<div class="input-group"><span class="input-group-addon lanr" id="basic-addon3">Doctor Name</span><input readonly="readonly" type="text" class="form-control" name="drname" id="exampleInputEmail1" value="'+ptninffo.ptnninffo.drname+'"> </div><div class="input-group"><span class="input-group-addon lanr" id="basic-addon3">Bed No</span><input readonly="readonly" type="text" class="form-control" name="drname" id="exampleInputEmail1" value="'+ptninffo.ptnninffo.b_num+'"></div><div class="input-group"><span class="input-group-addon lanr" id="basic-addon3">Admition Date</span><input readonly="readonly" type="text" class="form-control" name="drname" id="exampleInputEmail1" value="'+ptninffo.ptnninffo.add_date+'"></div><br>');

     



          } })




    $('.sbmtbtn').css('display', 'block');
    $('.advbill').attr('action', 'bill/advbll');

     } })

</script>




<script type="text/javascript">



// function ok_click(clicked_id){
//     $.ajax({
//             url: 'bill/bill_ok?ok=' + clicked_id,
//             method: 'GET',
//             data: '',
//             dataType: 'json',
//         }).success(function (bill) {
//     $('#editable-sample').load(location.href + ' #editable-sample');
//         });        
// }


$('.rcvbldt').click(function () {
    $('#editBillData').modal('show');
    $('#editBillForm').attr('action', 'bill/editReceiveBill');
})

$('.editbill').click(function () {
    $('#editBillData').modal('show');
    $('#editBillForm').attr('action', 'bill/receive_bill');
})



function reply_click(clicked_id, clicked_title){
        var url = 'bill/print_receive_bill?id='+clicked_id+'&dr_id='+clicked_title;     
      window.open(url, '_blank', 'height=800, width=800');
    }



$(document).ready(function () {
    $('.editbill, .rcvbldt').click(function (e) {
        e.preventDefault(e);
        // Get the record's ID via attribute  
        var p_bill_id = $(this).attr('data-id');

        var p_stuts;
        var dr_id;
        var con1;
        var con2;
        var assis;
        var anesth;

        var dr_s_fee;
        var dr_h_fee;

        var con1_s_fee;
        var con1_h_fee;

        var con2_s_fee;
        var con2_h_fee;

        var dr_f_fee;
        var dr_f_h_fee;

        var drs_name;

        var fee_dr_post;
        var fee_con1_post;
        var fee_con2_post;
        var fee_drst_post;


        var dr_id_name;
        var const_name;
        var connd_name;

        var dncTotalBill;



        var assist_st_fee;
        var ass_ast_f;
        var to_Val;
        var tot_Valu;
        var asi_Valu;
        var asiss_Val;
        var se_ass_fee;
        var st_ast_fsee;

        var toTalsergn = 0;
        var nvdtTlSrg = 0;







        $('#editBillForm').trigger("reset");


        $.ajax({
            url: 'bill/editPatientByIIIId?id=' + p_bill_id,
            method: 'GET',
            data: '',
            dataType: 'json',
        }).success(function (response) {

            $('#editBillForm').find('[name="name"]').val(response.patient.ptnname).end()
            $('#editBillForm').find('[name="b_num"]').val(response.patient.b_num).end()
            $('#editBillForm').find('[name="id"]').val(response.patient.id).end()
            $('#editBillForm').find('[name="p_stas"]').val(response.patient.p_stus).end()
            $('#editBillForm').find('[name="dr_id_ap"]').val(response.patient.dr_id).end()
            
            dr_id = response.patient.dr_id;

            con1 = response.patient.consultant_id;
            con2 = response.patient.consul_sec_id; 

            dr_id_name = response.drIdNamm.drname;
            const_name = response.conSStNamm.drname;
            connd_name = response.conNNddNam.drname;

            assis = response.patient.assistant_id;
            anesth = response.patient.anes_id;

            p_stuts = response.patient.p_stus;

            drs_name = dr_id_name;


            $('#editBillForm').find('[name="dr_id"]').val(dr_id_name)





               dr_f_fee = response.dr_tckt_fee.dr_firsttime;
               dr_f_h_fee = response.dr_tckt_fee.hospital_first;

               fee_drst_post = dr_f_fee - dr_f_h_fee;



               dr_s_fee = response.dr_tckt_fee.dr_sectime;
               dr_h_fee = response.dr_tckt_fee.hospital_sec;

               fee_dr_post = dr_s_fee - dr_h_fee;



               con1_s_fee = response.const_tckt_feeee.dr_sectime;
               con1_h_fee = response.const_tckt_feeee.hospital_sec;

               fee_con1_post = con1_s_fee - con1_h_fee;



               con2_s_fee = response.connd_tckt_feeee.dr_sectime;
               con2_h_fee = response.connd_tckt_feeee.hospital_sec;

               fee_con2_post = con2_s_fee - con2_h_fee;




                var bed = response.patient.b_num;

                var admit = response.patient.time_this;
                var dis = <?php echo time();?>;
                var total_admit = dis - admit;
                var date = new Date(total_admit*1000);
                var t_ad = date.getHours();
                var minutes = Math.floor((date/1000)/60/60);
                var dayss = Math.floor((date/1000)/60/60/24);
                var t_day = dayss + 1;


            //$('#editBillForm').find('[name="assis"]').val(response.patient.assistant_id).end()

            //$('#editBillForm').find('[name="anes_id"]').val(response.patient.anes_id).end()







    $.ajax({
    type: 'ajax',
    url: 'bill/bill_ratess?p_id=' + p_bill_id,
    data: '',
    dataType: 'json',
    }).success(function(bill_tk) {
            var html = '';
            var n;
            var t_amount = 0;
            var s_taka;
            var t_amount;
            var bed_taka;

            var dr_nd_fee;
            var con_t_fee = 0;

            var ot_taka;

            var assist_fee = 0;
            var anest_fee = 0;

            var ho_s_fee;

            var hos_fee_t;

            var dnc_dr_ser_fee;



        for (n=0; n<bill_tk.length; n++) {

             t_amount = t_amount + parseInt(bill_tk[n].bill_taka);


//start Indoor 
             if (p_stuts == 'indoor') {

                if (bill_tk[n].c_num == '24') {  

                      s_taka = parseInt(bill_tk[n].bill_taka);

                  html += '<div class="input-group"><span style="font-weight: bold; color: black;" class="input-group-addon lanr" id="basic-addon3">'+bill_tk[n].category+'</span><input type="hidden" name="cat_cid[]" value="'+bill_tk[n].c_num+'"><input readonly style="text-align:right;" type="text" id="s_taka" name="cat_cvalue[]" class="form-control taka_bill multakka" aria-describedby="basic-addon3" value="'+bill_tk[n].bill_taka+'"></div>';

               }else if (bill_tk[n].c_num == '8') { 

                      bed_taka = parseInt(bill_tk[n].bill_taka);

                  html += '<div class="input-group"><span style="font-weight: bold; color: black;" class="input-group-addon lanr" id="basic-addon3">'+bill_tk[n].category+'</span><input type="hidden" name="cat_cid[]" value="'+bill_tk[n].c_num+'"><input readonly style="text-align:right;" type="text" id="bed_taka" name="cat_cvalue[]" class="form-control taka_bill multakka" aria-describedby="basic-addon3" value="'+bill_tk[n].bill_taka+'"></div>';
                
                    }else if (bill_tk[n].c_num == '2' & con1 == '') { 

                      con_t_fee = parseInt(bill_tk[n].bill_taka);

                      var drs_fee = con_t_fee - dr_s_fee;


                  html += '<div class="input-group"><span style="font-weight: bold; color: black;" class="input-group-addon lanr" id="basic-addon3">'+bill_tk[n].category+'</span><input type="hidden" name="cat_cid[]" value="'+bill_tk[n].c_num+'"><input style="text-align:right;" type="text" id="con1_fee" name="cat_cvalue[]" class="form-control taka_bill multakka" aria-describedby="basic-addon3" readonly value="'+con_t_fee+'"></div>                              <div class="input-group"><span style="font-weight: bold; color: black;" class="input-group-addon lanr sp_dr_name" id="basic-addon3">'+dr_id_name+'</span><input type="hidden" name="dr_ide_post" value="'+dr_id+'"><input type="hidden" name="dr_tc_fee" id="dr_tc_fee" value="'+0+'"><input type="hidden" name="hs_tc_fee" id="hs_tc_fee" value="'+0+'"><input type="text" style="width: 50%; float: left;" class="form-control cblfd" id="dr_tct_cnt" placeholder="Type Ticket Number" aria-describedby="basic-addon3"><input readonly style="text-align:right; width: 50%" type="text" id="dr_rr_fee_val" name="dr_tct_fee" class="form-control taka_bill" aria-describedby="basic-addon3" value="'+0+'"></div>';
                
                    }else if (bill_tk[n].c_num == '2' & con1 != '' & con2 == '') { 

                      con_t_fee = parseInt(bill_tk[n].bill_taka);

                      var drs_fee = con_t_fee - dr_s_fee - con1_s_fee;


                  html += '<div class="input-group"><span style="font-weight: bold; color: black;" class="input-group-addon lanr" id="basic-addon3">'+bill_tk[n].category+'</span><input type="hidden" name="cat_cid[]" value="'+bill_tk[n].c_num+'"><input style="text-align:right;" type="text" id="con1_fee" name="cat_cvalue[]" class="form-control taka_bill multakka" aria-describedby="basic-addon3" readonly value="'+con_t_fee+'"></div>                            <div class="input-group"><span style="font-weight: bold; color: black;" class="input-group-addon lanr sp_dr_name" id="basic-addon3">'+dr_id_name+'</span><input type="hidden" name="dr_ide_post" value="'+dr_id+'"><input type="hidden" name="dr_tc_fee" id="dr_tc_fee" value="'+0+'"><input type="hidden" name="hs_tc_fee" id="hs_tc_fee" value="'+0+'"><input type="text" style="width: 50%; float: left;" class="form-control cblfd" id="dr_tct_cnt" placeholder="Type Ticket Number" aria-describedby="basic-addon3"><input readonly style="text-align:right; width: 50%" type="text" id="dr_rr_fee_val" name="dr_tct_fee" class="form-control taka_bill" aria-describedby="basic-addon3" value="'+0+'"></div>                                        <div class="input-group"><span style="font-weight: bold; color: black;" class="input-group-addon lanr sp_dr_name" id="basic-addon3">'+const_name+'</span><input type="hidden" name="conFrRrstId" value="'+con1+'"><input type="hidden" name="conFrstTK" id="conFRrstIdd" value="'+0+'"><input type="hidden" name="conFstHosTK" id="hsTcFFee" value="'+0+'"><input type="text" style="width: 50%; float: left;" class="form-control cblfd" id="confRRStpPP" placeholder="Type Ticket Number" value="" aria-describedby="basic-addon3"><input readonly style="text-align:right; width: 50%" type="text" id="coNfstFEVl" name="dr_tct_fee" class="form-control taka_bill" aria-describedby="basic-addon3"value="'+0+'"></div>';
                
                    }else if (bill_tk[n].c_num == '2' && con1 != '' && con2 != '') { 

                      con_t_fee = parseInt(bill_tk[n].bill_taka);

                      var drs_fee = con_t_fee - dr_s_fee - con1_s_fee - con2_s_fee;


                  html += '<div class="input-group"><span style="font-weight: bold; color: black;" class="input-group-addon lanr" id="basic-addon3">'+bill_tk[n].category+'</span><input type="hidden" name="cat_cid[]" value="'+bill_tk[n].c_num+'"><input style="text-align:right;" type="text" id="con1_fee" name="cat_cvalue[]" class="form-control taka_bill multakka" aria-describedby="basic-addon3" readonly value="'+con_t_fee+'"></div>                      <div class="input-group"><span style="font-weight: bold; color: black;" class="input-group-addon lanr sp_dr_name" id="basic-addon3">'+dr_id_name+'</span><input type="hidden" name="dr_ide_post" value="'+dr_id+'"><input type="hidden" name="dr_tc_fee" id="dr_tc_fee" value="'+0+'"><input type="hidden" name="hs_tc_fee" id="hs_tc_fee" value="'+0+'"><input type="text" style="width: 50%; float: left;" class="form-control cblfd" id="dr_tct_cnt" placeholder="Type Ticket Number" aria-describedby="basic-addon3"><input readonly style="text-align:right; width: 50%" type="text" id="dr_rr_fee_val" name="dr_tct_fee" class="form-control taka_bill" aria-describedby="basic-addon3" value="'+0+'"></div>                                        <div class="input-group"><span style="font-weight: bold; color: black;" class="input-group-addon lanr sp_dr_name" id="basic-addon3">'+const_name+'</span><input type="hidden" name="conFrRrstId" value="'+con1+'"><input type="hidden" name="conFrstTK" id="conFRrstIdd" value="'+0+'"><input type="hidden" name="conFstHosTK" id="hsTcFFee" value="'+0+'"><input type="text" style="width: 50%; float: left;" class="form-control cblfd" id="confRRStpPP" placeholder="Type Ticket Number" aria-describedby="basic-addon3"><input readonly style="text-align:right; width: 50%" type="text" id="coNfstFEVl" name="dr_tct_fee" class="form-control taka_bill" aria-describedby="basic-addon3"value="'+0+'"></div>                                                          <div class="input-group"><span style="font-weight: bold; color: black;" class="input-group-addon lanr sp_dr_name" id="basic-addon3">'+connd_name+'</span><input type="hidden" name="conNdddNiDi" value="'+con2+'"><input type="hidden" name="consNndDDTK" id="connNdDIdd" value="'+0+'"><input type="hidden" name="conFstHosTK" id="hscnddTcFFee" value="'+0+'"><input type="text" style="width: 50%; float: left;" class="form-control cblfd" id="conNNDndpPP" placeholder="Type Ticket Number" aria-describedby="basic-addon3"><input readonly style="text-align:right; width: 50%" type="text" id="coNnDdnFaVl" name="dr_tct_fee" class="form-control taka_bill" aria-describedby="basic-addon3"value="'+0+'"></div>';
                
                    }else if (bill_tk[n].c_num == '7') { 

                      dr_tcccex_fee = parseInt(bill_tk[n].bill_taka);

                  html += '<div class="input-group"><span style="font-weight: bold; color: black;" class="input-group-addon lanr" id="basic-addon3">'+bill_tk[n].category+'</span><input type="hidden" name="cat_cid[]" value="'+bill_tk[n].c_num+'"><input style="text-align:right;" type="text" id="con1_fee" name="cat_cvalue[]" class="form-control taka_bill multakka" aria-describedby="basic-addon3" readonly value="0"></div><div class="input-group"><span style="font-weight: bold; color: black;" class="input-group-addon lanr sp_dr_name" id="basic-addon3">'+drs_name+'</span><input type="hidden" name="drFrstTcccctID" value="'+dr_id+'"><input type="hidden" name="drFrstTctDrFee" id="dr_tc_fee" value="'+fee_drst_post+'"><input type="hidden" name="hospTctDrFee" id="hs_tc_fee" value="'+dr_f_h_fee+'"><input readonly style="text-align:right; " type="text" id="con_st_fee_val" name="dr_tct_fee" class="form-control taka_bill" aria-describedby="basic-addon3" value="'+dr_tcccex_fee+'"></div>';
                
                    }else if (bill_tk[n].c_num == '12') { 

                    var dr_night_fee = parseInt(bill_tk[n].bill_taka);
                    var hlfntfee = dr_night_fee / 2;

                  html += '<div class="input-group"><span style="font-weight: bold; color: black;" class="input-group-addon lanr" id="basic-addon3">'+bill_tk[n].category+'</span><input type="hidden" name="cat_cid[]" value="'+bill_tk[n].c_num+'"><input style="text-align:right;" type="text" id="con1_fee" name="cat_cvalue[]" class="form-control taka_bill multakka" aria-describedby="basic-addon3" readonly value="0"></div><div class="input-group"><span style="font-weight: bold; color: black;" class="input-group-addon lanr sp_dr_name" id="basic-addon3">'+drs_name+'</span><input type="hidden" name="drFrstTcccctID" value="'+dr_id+'"><input type="hidden" name="drFrstTctDrFee" id="dr_tc_fee" value="'+hlfntfee+'"><input type="hidden" name="hospTctDrFee" id="hs_tc_fee" value="'+hlfntfee+'"><input readonly style="text-align:right; " type="text" id="con_st_fee_val" name="dr_tct_fee" class="form-control taka_bill" aria-describedby="basic-addon3" value="'+dr_night_fee+'"></div>';
                
                    }else if (bill_tk[n].c_num == '13') {

                        var stitc_bill = parseInt(bill_tk[n].bill_taka);
                        var stitc_bill_t = stitc_bill / 2;

                  html += '<div class="input-group"><span style="font-weight: bold; color: black;" class="input-group-addon lanr" id="basic-addon3">'+bill_tk[n].category+'</span><input type="hidden" name="cat_cid[]" value="'+bill_tk[n].c_num+'"><input style="text-align:right;" readonly type="text" id="" name="cat_cvalue[]" class="form-control taka_bill multakka" aria-describedby="basic-addon3" value="'+stitc_bill_t+'"></div><div class="input-group"><span style="font-weight: bold; color: black;" class="input-group-addon lanr" id="basic-addon3"><input name="nd_cummis[]" required="required" class="cblfd" type="text" placeholder="Type Name"></span><input type="hidden" name="nd_cummis_no[]" value="'+bill_tk[n].c_num+'"><input style="text-align:right;" readonly type="text" id="" name="nd_cummis_tk[]" class="form-control taka_bill" aria-describedby="basic-addon3" value="'+stitc_bill_t+'"></div>';
                
                    }else if (bill_tk[n].c_num == '14') {

                        var dresh_bill = parseInt(bill_tk[n].bill_taka);
                        var dresh_bill_t = dresh_bill / 2;

                  html += '<div class="input-group"><span style="font-weight: bold; color: black;" class="input-group-addon lanr" id="basic-addon3">'+bill_tk[n].category+'</span><input type="hidden" name="cat_cid[]" value="'+bill_tk[n].c_num+'"><input style="text-align:right;" readonly type="text" id="" name="cat_cvalue[]" class="form-control taka_bill multakka" aria-describedby="basic-addon3" value="'+dresh_bill_t+'"></div><div class="input-group"><span style="font-weight: bold; color: black;" class="input-group-addon lanr" id="basic-addon3"><input name="nd_cummis[]" required="required" class="cblfd" type="text" placeholder="Type Name"></span><input type="hidden" name="nd_cummis_no[]" value="'+bill_tk[n].c_num+'"><input style="text-align:right;" readonly type="text" id="" name="nd_cummis_tk[]" class="form-control taka_bill" aria-describedby="basic-addon3" value="'+dresh_bill_t+'"></div>';
                
                    }else if (bill_tk[n].c_num == '15') {

                        var ng_bill = parseInt(bill_tk[n].bill_taka);
                        var ng_bill_t = ng_bill - 200;

                  html += '<div class="input-group"><span style="font-weight: bold; color: black;" class="input-group-addon lanr" id="basic-addon3">'+bill_tk[n].category+'</span><input type="hidden" name="cat_cid[]" value="'+bill_tk[n].c_num+'"><input style="text-align:right;" readonly type="text" id="" name="cat_cvalue[]" class="form-control taka_bill multakka" aria-describedby="basic-addon3" value="200"></div><div class="input-group"><span style="font-weight: bold; color: black;" class="input-group-addon lanr" id="basic-addon3"><input name="nd_cummis[]" required="required" type="text" class="cblfd" placeholder="Type Name"></span><input type="hidden" name="nd_cummis_no[]" value="'+bill_tk[n].c_num+'"><input style="text-align:right;" readonly type="text" id="" name="nd_cummis_tk[]" class="form-control taka_bill" aria-describedby="basic-addon3" value="'+ng_bill_t+'"></div>';
                
                    }else if (bill_tk[n].c_num == '16') {

                        var cathe_bill = parseInt(bill_tk[n].bill_taka);
                        var cathe_bill_t = cathe_bill - 200;

                  html += '<div class="input-group"><span style="font-weight: bold; color: black;" class="input-group-addon lanr" id="basic-addon3">'+bill_tk[n].category+'</span><input type="hidden" name="cat_cid[]" value="'+bill_tk[n].c_num+'"><input style="text-align:right;" readonly type="text" id="" name="cat_cvalue[]" class="form-control taka_bill multakka" aria-describedby="basic-addon3" value="200"></div><div class="input-group"><span style="font-weight: bold; color: black;" class="input-group-addon lanr" id="basic-addon3"><input name="nd_cummis[]" required="required" type="text" class="cblfd" placeholder="Type Name"></span><input type="hidden" name="nd_cummis_no[]" value="'+bill_tk[n].c_num+'"><input style="text-align:right;" readonly type="text" id="" name="nd_cummis_tk[]" class="form-control taka_bill" aria-describedby="basic-addon3" value="'+cathe_bill_t+'"></div>';

                    }else if (bill_tk[n].c_num == '17') {

                        var ivcan_bill = parseInt(bill_tk[n].bill_taka);

                  html += '<div class="input-group"><span style="font-weight: bold; color: black;" class="input-group-addon lanr" id="basic-addon3">'+bill_tk[n].category+'</span><input type="hidden" name="cat_cid[]" value="'+bill_tk[n].c_num+'"><input style="text-align:right;" readonly type="text" id="" name="cat_cvalue[]" class="form-control ivcanmain taka_bill multakka" aria-describedby="basic-addon3" value="'+ivcan_bill+'"></div><div class="input-group"><span style="font-weight: bold; color: black;" class="input-group-addon lanr" id="basic-addon3"><input class="ivcantyp cblfd" name="nd_cummis[]" type="text" placeholder="Type Name"></span><input type="hidden" name="nd_cummis_no[]" value="'+bill_tk[n].c_num+'"><input style="text-align:right;" readonly type="text" id="" name="nd_cummis_tk[]" class="form-control ivcanval taka_bill" aria-describedby="basic-addon3" value="'+0+'"></div>';
                
                    }else if (bill_tk[n].c_num == '18') {

                        var path_due = parseInt(bill_tk[n].bill_taka);

                  html += '<div class="input-group"><span style="font-weight: bold; color: black;" class="input-group-addon lanr" id="basic-addon3">'+bill_tk[n].category+'</span><input type="hidden" name="nd_cummis_no[]" value="'+bill_tk[n].c_num+'"><input style="text-align:right;" readonly type="text" id="" name="nd_cummis_tk[]" class="form-control taka_bill" aria-describedby="basic-addon3" value="'+path_due+'"></div>';

                    }else if (bill_tk[n].c_num == '20' || bill_tk[n].c_num == '21' || bill_tk[n].c_num == '22' || bill_tk[n].c_num == '23' || bill_tk[n].c_num == '25') {

                        var outBilaaa = parseInt(bill_tk[n].bill_taka);

                  html += '<div class="input-group"><span style="font-weight: bold; color: black;" class="input-group-addon lanr" id="basic-addon3">'+bill_tk[n].category+'</span><input name="nd_cummis[]" type="hidden" value="'+bill_tk[n].category+'" ><input type="hidden" name="nd_cummis_no[]" value="'+bill_tk[n].c_num+'"><input style="text-align:right;" readonly type="text" id="" name="nd_cummis_tk[]" class="form-control taka_bill" aria-describedby="basic-addon3" value="'+outBilaaa+'"></div>';

                    }else {

                  html += '<div class="input-group"><span style="font-weight: bold; color: black;" class="input-group-addon lanr" id="basic-addon3">'+bill_tk[n].category+'</span><input type="hidden" name="cat_cid[]" value="'+bill_tk[n].c_num+'"><input style="text-align:right;" readonly type="text" id="" name="cat_cvalue[]" class="form-control taka_bill multakka" aria-describedby="basic-addon3" value="'+bill_tk[n].bill_taka+'"></div>           ';
// Indoor End


// NVD Start 

                } }else if (p_stuts == 'nvd') {

                    if (bill_tk[n].c_num == '24') {

                      s_taka = parseInt(bill_tk[n].bill_taka);

                  html += '<div class="input-group"><span style="font-weight: bold; color: black;" class="input-group-addon lanr" id="basic-addon3">'+bill_tk[n].category+'</span><input type="hidden" name="cat_cid[]" value="'+bill_tk[n].c_num+'"><input readonly style="text-align:right;" type="text" id="s_taka" name="cat_cvalue[]" class="form-control taka_bill multakka" aria-describedby="basic-addon3" value="'+bill_tk[n].bill_taka+'"></div>';

                    }else if (bill_tk[n].c_num == '8') { 

                      bed_taka = parseInt(bill_tk[n].bill_taka);

                  html += '<div class="input-group"><span style="font-weight: bold; color: black;" class="input-group-addon lanr" id="basic-addon3">'+bill_tk[n].category+'</span><input type="hidden" name="cat_cid[]" value="'+bill_tk[n].c_num+'"><input readonly style="text-align:right;" type="text" id="bed_taka" name="cat_cvalue[]" class="form-control taka_bill multakka" aria-describedby="basic-addon3" value="'+bill_tk[n].bill_taka+'"></div>';
                
                    }else if (bill_tk[n].c_num == '5') { 

                      assist_fee = parseInt(bill_tk[n].bill_taka);
                    }else if (bill_tk[n].c_num == '4') { 
                      anest_fee = parseInt(bill_tk[n].bill_taka);

                    }else if (bill_tk[n].c_num == '3') { 

                      con_t_fee = parseInt(bill_tk[n].bill_taka);

                      nvdtTlSrg = con_t_fee + anest_fee + assist_fee;


                                      //NVD All Cummission
                                
                                  html += '<div class="input-group"><span style="font-weight: bold; color: black;" class="input-group-addon lanr sp_dr_name" id="basic-addon3">'+drs_name+'</span><input type="hidden" name="nd_cummis[]" value="'+drs_name+'"><input type="text" style="width: 50%; float: left;" class="form-control nvddrfeetyp cblfd" placeholder="Type Doctor fee" aria-describedby="basic-addon3"> <input readonly style="text-align:right; width: 50%;" type="text" id="con_st_fee_val" name="nd_cummis_tk[]" class="nvddrfeeval form-control taka_bill" aria-describedby="basic-addon3" value="'+0+'"></div>                                            <div class="input-group"><span style="font-weight: bold; color: black;" class="input-group-addon lanr sp_dr_name" id="basic-addon3">'+anesth+'</span><input type="hidden" name="nd_cummis[]" value="'+anesth+'"><input type="text" style="width: 50%; float: left;" class="nvdanstfeetyp form-control cblfd" id="assist_st_fee" placeholder="Type Anesthesiologist fee" aria-describedby="basic-addon3" value="'+0+'"><input readonly style="text-align:right; width: 50%" type="text" id="assist_fee_val" name="nd_cummis_tk[]" class="nvdanstfeeval cblfd form-control taka_bill" aria-describedby="basic-addon3" value="'+0+'"></div>                                           <div class="input-group"><span style="font-weight: bold; color: black;" class="input-group-addon lanr sp_dr_name" id="basic-addon3">Assistant Other</span><input type="hidden" name="cat_cid[]" value="'+bill_tk[n].c_num+'"><input readonly style="text-align:right;" type="text" id="host_otp_val" name="cat_cvalue[]" class="hnvdTtlTK form-control taka_bill multakka" aria-describedby="basic-addon3" value="'+nvdtTlSrg+'"></div>                                         <div class="input-group"><span style="font-weight: bold; color: black;" class="input-group-addon lanr sp_dr_name" id="basic-addon3"><input id="OTrefartyp" class="nvdreffex cblfd" name="nd_cummis[]" type="text" value="" placeholder="Type Reffer Name" ></span><input readonly style="text-align:right;" type="text" id="refarVal" name="nd_cummis_tk[]" class="nvdrfrfeeval form-control taka_bill" aria-describedby="basic-addon3" value="'+0+'"></div>                                       <div class="input-group"><span style="font-weight: bold; color: black;" class="input-group-addon lanr sp_dr_name" id="basic-addon3"><input name="nd_cummis[]" type="text" value="" class="nvdcstTyp cblfd" placeholder="Type Cummission Name" ></span><input readonly style="text-align:right;" type="text" id="con_st_fee_val" name="nd_cummis_tk[]" class="nvdcstval form-control taka_bill" aria-describedby="basic-addon3" value="'+0+'"></div>                                      <div class="input-group"><span style="font-weight: bold; color: black;" class="input-group-addon lanr sp_dr_name" id="basic-addon3"><input type="text" class="nvdcndTyp cblfd" name="nd_cummis[]" value=""  placeholder="Type Cummission Name" ></span><input readonly style="text-align:right;" type="text" id="con_st_fee_val" name="nd_cummis_tk[]" class="nvdcndval form-control taka_bill" aria-describedby="basic-addon3" value="'+0+'"></div>                                     <div class="input-group"><span style="font-weight: bold; color: black;" class="input-group-addon lanr sp_dr_name" id="basic-addon3"><input type="text" name="nd_cummis[]" class="nvdcrddTyp cblfd" placeholder="Type Cummission Name" ></span><input readonly style="text-align:right;" type="text" id="con_st_fee_val" name="nd_cummis_tk[]" class="nvdcrddval form-control taka_bill" aria-describedby="basic-addon3" value="'+0+'"></div>   ';

                    }else if (bill_tk[n].c_num == '6') {

                      ot_taka = parseInt(bill_tk[n].bill_taka);

                  html += '<div class="input-group"><span style="font-weight: bold; color: black;" class="input-group-addon lanr" id="basic-addon3">'+bill_tk[n].category+'</span><input type="hidden" name="cat_cid[]" value="'+bill_tk[n].c_num+'"><input readonly style="text-align:right;" type="text" id="ot_taka" name="cat_cvalue[]" class="form-control taka_bill multakka" aria-describedby="basic-addon3" value="'+bill_tk[n].bill_taka+'"></div>';


                    }else {

                  html += '<div class="input-group"><span style="font-weight: bold; color: black;" class="input-group-addon lanr" id="basic-addon3">'+bill_tk[n].category+'</span><input type="hidden" name="cat_cid[]" value="'+bill_tk[n].c_num+'"><input style="text-align:right;" readonly type="text" id="" name="cat_cvalue[]" class="form-control taka_bill multakka" aria-describedby="basic-addon3" value="'+bill_tk[n].bill_taka+'"></div>                        <input type="hidden" name="cat_cid[]" value="0"><input type="hidden" name="cat_cvalue[]" value="0"><input type="hidden" name="cat_cid[]" value="0"><input type="hidden" name="cat_cvalue[]" value="0"><input type="hidden" name="cat_cid[]" value="0"><input type="hidden" name="cat_cvalue[]" value="0">';
                    }
//end NVD


//start Observation
                 }else if (p_stuts == 'obsn') {



                if (bill_tk[n].c_num == '24') {  

                      s_taka = parseInt(bill_tk[n].bill_taka);

                  html += '<div class="input-group"><span style="font-weight: bold; color: black;" class="input-group-addon lanr" id="basic-addon3">'+bill_tk[n].category+'</span><input type="hidden" name="cat_cid[]" value="'+bill_tk[n].c_num+'"><input readonly style="text-align:right;" type="text" id="s_taka" name="cat_cvalue[]" class="form-control taka_bill multakka" aria-describedby="basic-addon3" value="'+bill_tk[n].bill_taka+'"></div>';

                }else if (bill_tk[n].c_num == '8') { 

                      bed_taka = parseInt(bill_tk[n].bill_taka);

                  html += '<div class="input-group"><span style="font-weight: bold; color: black;" class="input-group-addon lanr" id="basic-addon3">'+bill_tk[n].category+'</span><input type="hidden" name="cat_cid[]" value="'+bill_tk[n].c_num+'"><input readonly style="text-align:right;" type="text" id="bed_taka" name="cat_cvalue[]" class="form-control taka_bill multakka" aria-describedby="basic-addon3" value="'+bill_tk[n].bill_taka+'"></div>';
              }else if (bill_tk[n].c_num == '2') {  

                      con_t_fee = parseInt(bill_tk[n].bill_taka);

                      var drs_fee = con_t_fee - dr_s_fee;


                  html += '<div class="input-group"><span style="font-weight: bold; color: black;" class="input-group-addon lanr" id="basic-addon3">'+bill_tk[n].category+'</span><input type="hidden" name="cat_cid[]" value="'+bill_tk[n].c_num+'"><input style="text-align:right;" type="text" id="con1_fee" name="cat_cvalue[]" class="form-control taka_bill multakka" aria-describedby="basic-addon3" readonly value="'+drs_fee+'"></div>                              <div class="input-group"><span style="font-weight: bold; color: black;" class="input-group-addon lanr sp_dr_name" id="basic-addon3">'+dr_id_name+'</span><input type="hidden" name="dr_ide_post" value="'+dr_id+'"><input type="hidden" name="dr_tc_fee" id="dr_tc_fee" value="'+fee_dr_post+'"><input type="hidden" name="hs_tc_fee" id="hs_tc_fee" value="'+dr_h_fee+'"><input type="text" style="width: 50%; float: left;" class="form-control cblfd" id="dr_tct_cnt" placeholder="Type Ticket Number" aria-describedby="basic-addon3"><input readonly style="text-align:right; width: 50%" type="text" id="dr_rr_fee_val" name="dr_tct_fee" class="form-control taka_bill" aria-describedby="basic-addon3" value="'+dr_s_fee+'"></div>';
                

                }else if (bill_tk[n].c_num == '7') { 

                      dr_tcccex_fee = parseInt(bill_tk[n].bill_taka);

                  html += '<div class="input-group"><span style="font-weight: bold; color: black;" class="input-group-addon lanr" id="basic-addon3">'+bill_tk[n].category+'</span><input type="hidden" name="cat_cid[]" value="'+bill_tk[n].c_num+'"><input style="text-align:right;" type="text" id="con1_fee" name="cat_cvalue[]" class="form-control taka_bill multakka" aria-describedby="basic-addon3" readonly value="0"></div><div class="input-group"><span style="font-weight: bold; color: black;" class="input-group-addon lanr sp_dr_name" id="basic-addon3">'+drs_name+'</span><input type="hidden" name="drFrstTcccctID" value="'+dr_id+'"><input type="hidden" name="drFrstTctDrFee" id="dr_tc_fee" value="'+fee_drst_post+'"><input type="hidden" name="hospTctDrFee" id="hs_tc_fee" value="'+dr_f_h_fee+'"><input readonly style="text-align:right; " type="text" id="con_st_fee_val" name="dr_tct_fee" class="form-control taka_bill" aria-describedby="basic-addon3" value="'+dr_tcccex_fee+'"></div>';
                
                    }else {

                  html += '<div class="input-group"><span style="font-weight: bold; color: black;" class="input-group-addon lanr" id="basic-addon3">'+bill_tk[n].category+'</span><input type="hidden" name="cat_cid[]" value="'+bill_tk[n].c_num+'"><input style="text-align:right;" readonly type="text" id="" name="cat_cvalue[]" class="form-control taka_bill multakka" aria-describedby="basic-addon3" value="'+bill_tk[n].bill_taka+'"></div>'; }
// Observation END




// OT Start
                 }else if (p_stuts == 'ot') {




                    if (bill_tk[n].c_num == '24') {

                      s_taka = parseInt(bill_tk[n].bill_taka);

                  html += '<div class="input-group"><span style="font-weight: bold; color: black;" class="input-group-addon lanr" id="basic-addon3">'+bill_tk[n].category+'</span><input type="hidden" name="cat_cid[]" value="'+bill_tk[n].c_num+'"><input readonly style="text-align:right;" type="text" id="s_taka" name="cat_cvalue[]" class="form-control taka_bill multakka" aria-describedby="basic-addon3" value="'+bill_tk[n].bill_taka+'"></div>';

                    }else if (bill_tk[n].c_num == '8') { 

                      bed_taka = parseInt(bill_tk[n].bill_taka);

                  html += '<div class="input-group"><span style="font-weight: bold; color: black;" class="input-group-addon lanr" id="basic-addon3">'+bill_tk[n].category+'</span><input type="hidden" name="cat_cid[]" value="'+bill_tk[n].c_num+'"><input readonly style="text-align:right;" type="text" id="bed_taka" name="cat_cvalue[]" class="form-control taka_bill multakka" aria-describedby="basic-addon3" value="'+bill_tk[n].bill_taka+'"></div>';
                
                    }else if (bill_tk[n].c_num == '3') { 
                      con_t_fee = parseInt(bill_tk[n].bill_taka);

                    }else if (bill_tk[n].c_num == '4') { 
                              anest_fee = parseInt(bill_tk[n].bill_taka);

                    }else if (bill_tk[n].c_num == '5') { 

                      assist_fee = parseInt(bill_tk[n].bill_taka);

                      toTalsergn = con_t_fee + anest_fee + assist_fee;

                // OT All Cummission

                  html += '<div class="input-group"><span style="font-weight: bold; color: black;" class="input-group-addon lanr sp_dr_name" id="basic-addon3">'+drs_name+'</span><input type="hidden" name="nd_cummis[]" value="'+drs_name+'"><input type="text" style="width: 50%; float: left;" class="form-control cblfd otdrfeetyp cblfd" placeholder="Type Doctor fee" aria-describedby="basic-addon3"> <input readonly style="text-align:right; width: 50%;" type="text" id="con_st_fee_val" name="nd_cummis_tk[]" class="otdrfeeval form-control taka_bill" aria-describedby="basic-addon3" value="'+0+'"></div>                                            <div class="input-group"><span style="font-weight: bold; color: black;" class="input-group-addon lanr sp_dr_name" id="basic-addon3">'+anesth+'</span><input type="hidden" name="nd_cummis[]" value="'+anesth+'"><input type="text" style="width: 50%; float: left;" class="cblfd otanstfeetyp form-control" id="assist_st_fee" placeholder="Type Anesthesiologist fee" aria-describedby="basic-addon3"><input readonly style="text-align:right; width: 50%" type="text" id="assist_fee_val" name="nd_cummis_tk[]" class="otanstfeeval form-control taka_bill" aria-describedby="basic-addon3" value="'+0+'"></div>                                           <div class="input-group"><span style="font-weight: bold; color: black;" class="input-group-addon lanr sp_dr_name" id="basic-addon3">'+assis+'</span> <input type="hidden" name="nd_cummis[]" value="'+assis+'"><input type="text" style="width: 50%; float: left;" class="otassttyp form-control cblfd" id="ass_ast" placeholder="Type Assistant fee" aria-describedby="basic-addon3"> <input readonly style="text-align:right; width: 50%;" type="text" id="ass_v_taka" name="nd_cummis_tk[]" class="otasstval form-control taka_bill" aria-describedby="basic-addon3" value="'+0+'"></div>                                  <div class="input-group"><span style="font-weight: bold; color: black;" class="input-group-addon lanr sp_dr_name" id="basic-addon3">Assistant Other</span><input type="hidden" name="cat_cid[]" value="'+bill_tk[n].c_num+'"><input readonly style="text-align:right;" type="text" id="host_otp_val" name="cat_cvalue[]" class="hTotalTTKK form-control taka_bill multakka" aria-describedby="basic-addon3" value="'+toTalsergn+'"></div>                                         <div class="input-group"><span style="font-weight: bold; color: black;" class="input-group-addon lanr sp_dr_name" id="basic-addon3"><input id="OTrefartyp" class="reffefeeEx cblfd" name="nd_cummis[]" type="text" value="" placeholder="Type Reffer Name" ></span><input readonly style="text-align:right;" type="text" id="refarVal" name="nd_cummis_tk[]" class="reffefeeTaka form-control taka_bill" aria-describedby="basic-addon3" value="'+0+'"></div>                                       <div class="input-group"><span style="font-weight: bold; color: black;" class="input-group-addon lanr sp_dr_name" id="basic-addon3"><input name="nd_cummis[]" type="text" value="" class="cummstTyp cblfd" placeholder="Type Cummission Name" ></span><input readonly style="text-align:right;" type="text" id="con_st_fee_val" name="nd_cummis_tk[]" class="cummstval form-control taka_bill" aria-describedby="basic-addon3" value="'+0+'"></div>                                      <div class="input-group"><span style="font-weight: bold; color: black;" class="input-group-addon lanr sp_dr_name" id="basic-addon3"><input type="text" class="cummndTyp cblfd" name="nd_cummis[]" value=""  placeholder="Type Cummission Name" ></span><input readonly style="text-align:right;" type="text" id="con_st_fee_val" name="nd_cummis_tk[]" class="cummndval form-control taka_bill" aria-describedby="basic-addon3" value="'+0+'"></div>                                     <div class="input-group"><span style="font-weight: bold; color: black;" class="input-group-addon lanr sp_dr_name" id="basic-addon3"><input type="text" name="nd_cummis[]" class="cummrddTyp cblfd" placeholder="Type Cummission Name" ></span><input readonly style="text-align:right;" type="text" id="con_st_fee_val" name="nd_cummis_tk[]" class="cummrddval form-control taka_bill" aria-describedby="basic-addon3" value="'+0+'"></div>                                    <div class="input-group"><span style="font-weight: bold; color: black;" class="input-group-addon lanr sp_dr_name" id="basic-addon3"><input type="text" class="cummrthTyp cblfd" placeholder="Type Cummission Name"  class="otCumEXcrNdTyp" name="nd_cummis[]" ></span><input style="text-align:right;" type="text" id="con_st_fee_val" name="nd_cummis_tk[]" class="cummrthval form-control otCumEXcrNd taka_bill" aria-describedby="basic-addon3" value="'+0+'"></div>                                  <div class="input-group"><span style="font-weight: bold; color: black;" class="input-group-addon lanr sp_dr_name" id="basic-addon3"><input type="text" class="cummffthTyp cblfd"  placeholder="Type Cummission Name" name="nd_cummis[]" ></span><input style="text-align:right;" type="text" id="con_st_fee_val" name="nd_cummis_tk[]" class="form-control cummffthval taka_bill" aria-describedby="basic-addon3" value="'+0+'"></div>                             ';



                    }else if (bill_tk[n].c_num == '6') {

                      ot_taka = parseInt(bill_tk[n].bill_taka);

                  html += '<div class="input-group"><span style="font-weight: bold; color: black;" class="input-group-addon lanr" id="basic-addon3">'+bill_tk[n].category+'</span><input type="hidden" name="cat_cid[]" value="'+bill_tk[n].c_num+'"><input readonly style="text-align:right;" type="text" id="ot_taka" name="cat_cvalue[]" class="form-control taka_bill multakka" aria-describedby="basic-addon3" value="'+bill_tk[n].bill_taka+'"></div>';

                    }else if (bill_tk[n].c_num == '20' || bill_tk[n].c_num == '21' || bill_tk[n].c_num == '22' || bill_tk[n].c_num == '23' || bill_tk[n].c_num == '25') {

                        var outBilaaa = parseInt(bill_tk[n].bill_taka);

                  html += '<div class="input-group"><span style="font-weight: bold; color: black;" class="input-group-addon lanr" id="basic-addon3">'+bill_tk[n].category+'</span><input name="nd_cummis[]" type="hidden" value="'+bill_tk[n].category+'" ><input type="hidden" name="nd_cummis_no[]" value="'+bill_tk[n].c_num+'"><input style="text-align:right;" readonly type="text" id="" name="nd_cummis_tk[]" class="form-control taka_bill" aria-describedby="basic-addon3" value="'+outBilaaa+'"></div>';



                    }else if (bill_tk[n].c_num == '7') { 

                      dr_tcccex_fee = parseInt(bill_tk[n].bill_taka);

                  html += '<div class="input-group"><span style="font-weight: bold; color: black;" class="input-group-addon lanr" id="basic-addon3">'+bill_tk[n].category+'</span><input type="hidden" name="cat_cid[]" value="'+bill_tk[n].c_num+'"><input style="text-align:right;" type="text" id="con1_fee" name="cat_cvalue[]" class="form-control taka_bill multakka" aria-describedby="basic-addon3" readonly value="0"></div><div class="input-group"><span style="font-weight: bold; color: black;" class="input-group-addon lanr sp_dr_name" id="basic-addon3">'+drs_name+'</span><input type="hidden" name="drFrstTcccctID" value="'+dr_id+'"><input type="hidden" name="drFrstTctDrFee" id="dr_tc_fee" value="'+fee_drst_post+'"><input type="hidden" name="hospTctDrFee" id="hs_tc_fee" value="'+dr_f_h_fee+'"><input readonly style="text-align:right; " type="text" id="con_st_fee_val" name="dr_tct_fee" class="form-control taka_bill" aria-describedby="basic-addon3" value="'+dr_tcccex_fee+'"></div>';
                
                    }else {

                  html += '<div class="input-group"><span style="font-weight: bold; color: black;" class="input-group-addon lanr" id="basic-addon3">'+bill_tk[n].category+'</span><input type="hidden" name="cat_cid[]" value="'+bill_tk[n].c_num+'"><input style="text-align:right;" readonly type="text" id="" name="cat_cvalue[]" class="form-control taka_bill multakka" aria-describedby="basic-addon3" value="'+bill_tk[n].bill_taka+'"></div>                                        <input type="hidden" name="cat_cid[]" value="0"><input type="hidden" name="cat_cvalue[]" value="0"><input type="hidden" name="cat_cid[]" value="0"><input type="hidden" name="cat_cvalue[]" value="0"><input type="hidden" name="cat_cid[]" value="0"><input type="hidden" name="cat_cvalue[]" value="0">';
                    }
// OT end


// DNC Start
                 }else if (p_stuts == 'dnc') {

                if (bill_tk[n].c_num == '24') {

                      s_taka = parseInt(bill_tk[n].bill_taka);

                  html += '<div class="input-group"><span style="font-weight: bold; color: black;" class="input-group-addon lanr" id="basic-addon3">'+bill_tk[n].category+'</span><input type="hidden" name="cat_cid[]" value="'+bill_tk[n].c_num+'"><input readonly style="text-align:right;" type="text" id="s_taka" name="cat_cvalue[]" class="form-control taka_bill multakka" aria-describedby="basic-addon3" value="'+bill_tk[n].bill_taka+'"></div>';

                    }else if (bill_tk[n].c_num == '8') { 

                      bed_taka = parseInt(bill_tk[n].bill_taka);

                  html += '<div class="input-group"><span style="font-weight: bold; color: black;" class="input-group-addon lanr" id="basic-addon3">'+bill_tk[n].category+'</span><input type="hidden" name="cat_cid[]" value="'+bill_tk[n].c_num+'"><input readonly style="text-align:right;" type="text" id="bed_taka" name="cat_cvalue[]" class="form-control taka_bill multakka" aria-describedby="basic-addon3" value="'+bill_tk[n].bill_taka+'"></div>';
                
                    }else if (bill_tk[n].c_num == '4') { 

                      anest_fee = parseInt(bill_tk[n].bill_taka);

                    }else if (bill_tk[n].c_num == '5') { 

                      assist_fee = parseInt(bill_tk[n].bill_taka);

                    }else if (bill_tk[n].c_num == '3') { 

                      con_t_fee = parseInt(bill_tk[n].bill_taka);

                      nvdtTlSrg = con_t_fee + anest_fee + assist_fee;


                                      //DNC All Cummission
                                
                                  html += '<div class="input-group"><span style="font-weight: bold; color: black;" class="input-group-addon lanr sp_dr_name" id="basic-addon3">'+drs_name+'</span><input type="hidden" name="nd_cummis[]" value="'+drs_name+'"><input type="text" style="width: 50%; float: left;" class="cblfd form-control dncdrfeetyp" placeholder="Type Doctor fee" aria-describedby="basic-addon3"> <input readonly style="text-align:right; width: 50%;" type="text" id="con_st_fee_val" name="nd_cummis_tk[]" class="dncdrfeeval form-control taka_bill" aria-describedby="basic-addon3" value="'+0+'"></div>                                            <div class="input-group"><span style="font-weight: bold; color: black;" class="input-group-addon lanr sp_dr_name" id="basic-addon3">'+anesth+'</span><input type="hidden" name="nd_cummis[]" value="'+anesth+'"><input type="text" style="width: 50%; float: left;" class="cblfd dncanstfeetyp form-control" id="assist_st_fee" placeholder="Type Anesthesiologist fee" aria-describedby="basic-addon3" value="'+0+'"><input readonly style="text-align:right; width: 50%" type="text" id="assist_fee_val" name="nd_cummis_tk[]" class="dncanstfeeval form-control taka_bill" aria-describedby="basic-addon3" value="'+0+'"></div>                                           <div class="input-group"><span style="font-weight: bold; color: black;" class="input-group-addon lanr sp_dr_name" id="basic-addon3">Assistant Other</span><input type="hidden" name="cat_cid[]" value="'+bill_tk[n].c_num+'"><input readonly style="text-align:right;" type="text" id="host_otp_val" name="cat_cvalue[]" class="hdncTtlTK form-control taka_bill multakka" aria-describedby="basic-addon3" value="'+nvdtTlSrg+'"></div>                                         <div class="input-group"><span style="font-weight: bold; color: black;" class="input-group-addon lanr sp_dr_name" id="basic-addon3"><input id="OTrefartyp" class="dncreffex cblfd" name="nd_cummis[]" type="text" value="" placeholder="Type Reffer Name" ></span><input readonly style="text-align:right;" type="text" id="refarVal" name="nd_cummis_tk[]" class="dncrfrfeeval form-control taka_bill" aria-describedby="basic-addon3" value="'+0+'"></div>                                       <div class="input-group"><span style="font-weight: bold; color: black;" class="input-group-addon lanr sp_dr_name" id="basic-addon3"><input name="nd_cummis[]" type="text" value="" class="dnccstTyp cblfd" placeholder="Type Cummission Name" ></span><input readonly style="text-align:right;" type="text" id="con_st_fee_val" name="nd_cummis_tk[]" class="dnccstval form-control taka_bill" aria-describedby="basic-addon3" value="'+0+'"></div>                                      <div class="input-group"><span style="font-weight: bold; color: black;" class="input-group-addon lanr sp_dr_name" id="basic-addon3"><input type="text" class="dnccndTyp cblfd" name="nd_cummis[]" value=""  placeholder="Type Cummission Name" ></span><input readonly style="text-align:right;" type="text" id="con_st_fee_val" name="nd_cummis_tk[]" class="dnccndval form-control taka_bill" aria-describedby="basic-addon3" value="'+0+'"></div>                                     <div class="input-group"><span style="font-weight: bold; color: black;" class="input-group-addon lanr sp_dr_name" id="basic-addon3"><input type="text" name="nd_cummis[]" class="dncrddTyp cblfd" placeholder="Type Cummission Name" ></span><input readonly style="text-align:right;" type="text" id="con_st_fee_val" name="nd_cummis_tk[]" class="dncrddval form-control taka_bill" aria-describedby="basic-addon3" value="'+0+'"></div>                    ';


                    }else if (bill_tk[n].c_num == '6') {

                      ot_taka = parseInt(bill_tk[n].bill_taka);

                  html += '<div class="input-group"><span style="font-weight: bold; color: black;" class="input-group-addon lanr" id="basic-addon3">'+bill_tk[n].category+'</span><input type="hidden" name="cat_cid[]" value="'+bill_tk[n].c_num+'"><input readonly style="text-align:right;" type="text" id="ot_taka" name="cat_cvalue[]" class="form-control taka_bill multakka" aria-describedby="basic-addon3" value="'+bill_tk[n].bill_taka+'"></div>';


                    }else if (bill_tk[n].c_num == '5') {

                      var dnc_dr_anes_fee = parseInt(bill_tk[n].bill_taka);

                  html += '<div class="input-group"><span style="font-weight: bold; color: black;" class="input-group-addon lanr" id="basic-addon3">'+anesth+'</span><input style="text-align:right;" readonly type="text" id="" name="cat_cvalue[]" class="form-control taka_bill multakka" aria-describedby="basic-addon3" value="'+dnc_dr_anes_fee+'"></div>';



                    }else if (bill_tk[n].c_num == '24') {

                      s_taka = parseInt(bill_tk[n].bill_taka);

                  html += '<div class="input-group"><span style="font-weight: bold; color: black;" class="input-group-addon lanr" id="basic-addon3">'+bill_tk[n].category+'</span><input type="hidden" name="cat_cid[]" value="'+bill_tk[n].c_num+'"><input readonly style="text-align:right;" type="text" id="s_taka" name="cat_cvalue[]" class="form-control taka_bill multakka" aria-describedby="basic-addon3" value="'+bill_tk[n].bill_taka+'"></div>';

                    }else if (bill_tk[n].c_num == '8') { 

                      bed_taka = parseInt(bill_tk[n].bill_taka);

                  html += '<div class="input-group"><span style="font-weight: bold; color: black;" class="input-group-addon lanr" id="basic-addon3">'+bill_tk[n].category+'</span><input type="hidden" name="cat_cid[]" value="'+bill_tk[n].c_num+'"><input readonly style="text-align:right;" type="text" id="bed_taka" name="cat_cvalue[]" class="form-control taka_bill multakka" aria-describedby="basic-addon3" value="'+bill_tk[n].bill_taka+'"></div>';

                    }else {


                  html += '<div class="input-group"><span style="font-weight: bold; color: black;" class="input-group-addon lanr" id="basic-addon3">'+bill_tk[n].category+'</span><input type="hidden" name="cat_cid[]" value="'+bill_tk[n].c_num+'"><input style="text-align:right;" readonly type="text" id="" name="cat_cvalue[]" class="form-control taka_bill multakka" aria-describedby="basic-addon3" value="'+bill_tk[n].bill_taka+'"></div>                                           <input type="hidden" name="cat_cid[]" value="0"><input type="hidden" name="cat_cvalue[]" value="0"><input type="hidden" name="cat_cid[]" value="0"><input type="hidden" name="cat_cvalue[]" value="0"><input type="hidden" name="cat_cid[]" value="0"><input type="hidden" name="cat_cvalue[]" value="0">';

                    }
// DNC END


                }else{
                    alert('Bill is not Created' );
                 }; }

            $('#edit_bill').html(html);




// Total Bill calculate Event
            var bill_amount = function (){
                var sum_t = 0;
                $('.taka_bill').each(function(){
                    var bill_r = $(this).val();
                if (bill_r != 0) {
                    sum_t += parseInt(bill_r);
                    }
                    var discount = $('#t_bill').val()
                    sum_k = sum_t - discount;
                });
                $('#disc').val(sum_k); 
                $('.bill_total').html(sum_t);
            }
// Total Bill calculate Event







// Total Bill without discount calculate Event
    var total_rcv_tk = function (){
        var t_tkk = 0;

        $('.multakka').each(function(){
            var bill_num = $(this).val();
        if (bill_num != 0) {
            t_tkk += parseInt(bill_num);
            }
        });
        $('.brcvl').html(t_tkk);
    }
// Total Bill without discount calculate Event







// Discount From Total Bill Event
                $('.t_bill').keyup(function(event) {
                    var textt = $(this).val();
                    var discoun = t_amount - textt;
                    var service_c = s_taka - discoun;
                    var bad_c = bed_taka + service_c;
                    var ot_c = bad_c + ot_taka;
                    if (textt > t_amount) {

                    }else {
                        if (discoun <= s_taka) {
                            $('#s_taka').val(service_c);
                            $('#bed_taka').val(bed_taka);
                        }else if (discoun > s_taka && bad_c >= 0) {
                             $('#s_taka').val(0);
                            $('#bed_taka').val(bad_c);
                        }else if (bad_c < 0 && ot_c > 0) {
                             $('#s_taka').val(0);
                            $('#bed_taka').val(0);
                            $('#ot_taka').val(ot_c);
                        }
                    }
                });
// Discount From Total Bill Event





// Consultand Fee Event
            if (con1 == '' & con2 == '') {
                 $('#dr_tct_cnt').keyup(function(event) {
                    var drTypVal        = parseInt($('#dr_tct_cnt').val());
                    var drshoWvaL   = drTypVal * dr_s_fee;
                    var drDrrvaL    = drTypVal * fee_dr_post;
                    var drHspTlvAL  = drTypVal * dr_h_fee;
                    var oBosistoDrTaka = con_t_fee - drshoWvaL;
                    if (drshoWvaL > con_t_fee) {
                        alert('Hei Check again and again !!');
                    }else {
                        $('#con1_fee').val(oBosistoDrTaka);
	                    $('#dr_rr_fee_val').val(drshoWvaL);
	                    $('#dr_tc_fee').val(drDrrvaL);
	                    $('#hs_tc_fee').val(drHspTlvAL);
                    }
                });
            }else if (!con1 == '' & con2 == '') {
                $('#dr_tct_cnt, #confRRStpPP').keyup(function(event) {
                    var drTypVal        = parseInt($('#dr_tct_cnt').val());
                    var conSSttTypVal   = parseInt($('#confRRStpPP').val());
                    var drshoWvaL   = drTypVal * dr_s_fee;
                    var drDrrvaL    = drTypVal * fee_dr_post;
                    var drHspTlvAL  = drTypVal * dr_h_fee;
                    var conSStshoWvaL   = conSSttTypVal * con1_s_fee;
                    var conSStDrrvaL    = conSSttTypVal * fee_con1_post;
                    var conSStHspTlvAL  = conSSttTypVal * con1_h_fee;
                    var ttllTK = drshoWvaL + conSStshoWvaL;
                    var oBosistoDrTaka = con_t_fee - ttllTK;
                    if (ttllTK > con_t_fee) {
                        alert('Hei Check again and again !!');
                    }else {
                        $('#con1_fee').val(oBosistoDrTaka);
                        //dr Taka
	                    $('#dr_rr_fee_val').val(drshoWvaL);
	                    $('#dr_tc_fee').val(drDrrvaL);
	                    $('#hs_tc_fee').val(drHspTlvAL);
	                        //con1 Taka
	                    $('#coNfstFEVl').val(conSStshoWvaL);
	                    $('#conFRrstIdd').val(conSStDrrvaL);
	                    $('#hsTcFFee').val(conSStHspTlvAL);
                    }
                });
            }else {
                $('#dr_tct_cnt, #confRRStpPP, #conNNDndpPP').keyup(function(event) {
                    var drTypVal        = parseInt($('#dr_tct_cnt').val());
                    var conSSttTypVal   = parseInt($('#confRRStpPP').val());
                    var conNndssTypVal  = parseInt($('#conNNDndpPP').val());
                    var drshoWvaL   = drTypVal * dr_s_fee;
                    var drDrrvaL    = drTypVal * fee_dr_post;
                    var drHspTlvAL  = drTypVal * dr_h_fee;
                    var conSStshoWvaL   = conSSttTypVal * con1_s_fee;
                    var conSStDrrvaL    = conSSttTypVal * fee_con1_post;
                    var conSStHspTlvAL  = conSSttTypVal * con1_h_fee;
                    var connNDshoWvaL   = conNndssTypVal * con2_s_fee;
                    var connNDDrrvaL    = conNndssTypVal * con2_h_fee;
                    var connNDdrsvaL   = conNndssTypVal * fee_con2_post;
                    var connnDHspTlvAL  = conNndssTypVal * con1_h_fee;
                    var ttllTK = drshoWvaL + conSStshoWvaL + connNDshoWvaL;
                    var oBosistoDrTaka = con_t_fee - ttllTK;
                    if (ttllTK > con_t_fee) {
                        alert('Hei Check again and again !!');
                    }else {
                        $('#con1_fee').val(oBosistoDrTaka);
	                        //dr Taka
	                    $('#dr_rr_fee_val').val(drshoWvaL);
	                    $('#dr_tc_fee').val(drDrrvaL);
	                    $('#hs_tc_fee').val(drHspTlvAL);
	                        //con1 Taka
	                    $('#coNfstFEVl').val(conSStshoWvaL);
	                    $('#conFRrstIdd').val(conSStDrrvaL);
	                    $('#hsTcFFee').val(conSStHspTlvAL);
	                        //con2 Taka
	                    $('#coNnDdnFaVl').val(connNDshoWvaL);
	                    $('#connNdDIdd').val(connNDdrsvaL);
	                    $('#hscnddTcFFee').val(connnDHspTlvAL);
                    }
                });
            }
// Consultand Fee Event






//Total OT Cummission Event
        $(' .otdrfeetyp, .otanstfeetyp, .otassttyp, .reffefeeEx, .cummstTyp, .cummndTyp, .cummrddTyp, .cummrthTyp, .cummffthTyp ').keyup(function(){

            var drfees = parseInt($('.otdrfeetyp').val());  //DR Fee
            var ansthfees = parseInt($('.otanstfeetyp').val()); //Annesta Fee
            var asstsfees = parseInt($('.otassttyp').val()); //Assistant Fee
            var totalDrCmsFee = drfees + ansthfees + asstsfees;
            var cumsdrfee = toTalsergn - totalDrCmsFee;
            $('.otdrfeeval').val(drfees);
            $('.otanstfeeval').val(ansthfees);
            $('.otasstval').val(asstsfees);

            var trmss = cumsdrfee;

            var refferfees = $('.reffefeeEx').val(); //Reffer Fee

            var cumstfe = $('.cummstTyp').val(); //cummission Fee
            var cumndfe = $('.cummndTyp').val(); //cummission Fee
            var cumrdfe = $('.cummrddTyp').val(); //cummission Fee
            var cumrth = $('.cummrthTyp').val(); //cummission Fee
            var cumfth = $('.cummffthTyp').val(); //cummission Fee

            if (refferfees != '') {
                trms = cumsdrfee - 1000;
            $('.reffefeeTaka').val(1000);
            }else {
                trms = cumsdrfee;
                $('.reffefeeTaka').val(0);
             }

            if (cumstfe != '') {
                trms = trms - 300;
                $('.cummstval').val(300);
            }else { 
                trms = trms;
                $('.cummstval').val(0);
                 }

            if (cumndfe != '') {
                trms = trms - 250;
                $('.cummndval').val(250);
            }else { 
                trms = trms;
                $('.cummndval').val(0);
                }

            if (cumrdfe != '') {
                trms = trms - 100;
                $('.cummrddval').val(100);
            }else { 
                trms = trms;
                $('.cummrddval').val(0);
                 }

            if (cumrth != '') {
                trms = trms - 100;
                $('.cummrthval').val(100);
            }else { 
                trms = trms;
                $('.cummrthval').val(0);
                 }

            if (cumfth != '') {
                trms = trms - 100;
                $('.cummffthval').val(100);
            }else { 
                trms = trms;
                $('.cummffthval').val(0);
                 }

            $('.hTotalTTKK').val(trms);

        })
//Total OT Cummission Event







//Total NVD Cummission Event
        $(' .nvddrfeetyp, .nvdanstfeetyp, .nvdreffex, .nvdcstTyp, .nvdcndTyp, .nvdcrddTyp ').keyup(function(){
            var nvdansth = 0; 



            var otdrfees = parseInt($('.nvddrfeetyp').val());  //DR Fee
                nvdansth = parseInt($('.nvdanstfeetyp').val()); //Annesta Fee
            var totabll = otdrfees + nvdansth;
            var totalnvdbll = nvdtTlSrg - totabll;

            $('.nvddrfeeval').val(otdrfees);
            $('.nvdanstfeeval').val(nvdansth);

            var trmss = totalnvdbll;

            var refferfees = $('.nvdreffex').val(); //Reffer Fee

            var cumstfe = $('.nvdcstTyp').val(); //cummission Fee
            var cumndfe = $('.nvdcndTyp').val(); //cummission Fee
            var cumrdfe = $('.nvdcrddTyp').val(); //cummission Fee

            if (refferfees != '') {
                if (p_stuts == 'dnc') {
                trms = totalnvdbll - 200;
            $('.nvdrfrfeeval').val(500);
                }else {
                trms = totalnvdbll - 500;
            $('.nvdrfrfeeval').val(500); }
            }else {
                trms = totalnvdbll;
                $('.nvdrfrfeeval').val(0);
             }

            if (cumstfe != '') {
                trms = trms - 200;
            $('.nvdcstval').val(200);
            }else {
                trms = trms;
                $('.nvdcstval').val(0);
             }

            if (cumndfe != '') {
                trms = trms - 100;
            $('.nvdcndval').val(100);
            }else {
                trms = trms;
                $('.nvdcndval').val(0);
             }

            if (cumrdfe != '') {
                trms = trms - 50;
            $('.nvdcrddval').val(50);
            }else {
                trms = trms;
                $('.nvdcrddval').val(0);
             }

            $('.hnvdTtlTK').val(trms);

        })
//Total NVD Cummission Event





//Total DNC Cummission Event
        $(' .dncdrfeetyp, .dncanstfeetyp, .dncreffex, .dnccstTyp, .dnccndTyp, .dncrddTyp ').keyup(function(){
            var nvdansth = 0;

            var otdrfees = parseInt($('.dncdrfeetyp').val());  //DR Fee
                nvdansth = parseInt($('.dncanstfeetyp').val()); //Annesta Fee
            var totabll = otdrfees + nvdansth;
            var totalnvdbll = nvdtTlSrg - totabll;

            $('.dncdrfeeval').val(otdrfees);
            $('.dncanstfeeval').val(nvdansth);

            var trmss = totalnvdbll;

            var refferfees = $('.dncreffex').val(); //Reffer Fee

            var cumstfe = $('.dnccstTyp').val(); //cummission Fee
            var cumndfe = $('.dnccndTyp').val(); //cummission Fee
            var cumrdfe = $('.dnccrddTyp').val(); //cummission Fee

            if (refferfees != '') {
                trms = totalnvdbll - 200;
                $('.dncrfrfeeval').val(200);
            }else {
                trms = totalnvdbll;
                $('.dncrfrfeeval').val(0);
             }

            if (cumstfe != '') {
                trms = trms - 200;
            $('.dnccstval').val(200);
            }else {
                trms = trms;
                $('.dnccstval').val(0);
             }

            if (cumndfe != '') {
                trms = trms - 200;
            $('.dnccndval').val(200);
            }else {
                trms = trms;
                $('.dnccndval').val(0);
             }

            if (cumrdfe != '') {
                trms = trms - 50;
            $('.dncrddval').val(50);
            }else {
                trms = trms;
                $('.dncrddval').val(0);
             }

            $('.hdncTtlTK').val(trms);

        })
//Total DNC Cummission Event













//Total IV / Cunala Cummission Event
        $(' .ivcantyp ').keyup(function(){

            var cantyp = $('.ivcantyp').val();
            
            var wcms = ivcan_bill - 100;

            var canvval = 0;
            if (cantyp == '') {
                $('.ivcanmain').val(ivcan_bill);
                $('.ivcanval').val(0);
            }else {                
                $('.ivcanmain').val(wcms);
                $('.ivcanval').val(100);
            }
        })
//Total IV / Cunala Cummission Event










                bill_amount();

            $(' .taka_bill, .t_bill, #con_st_fee, #assist_st_fee, #ass_ast,  .otdrfeetyp, .otanstfeetyp, .otassttyp, .reffefeeEx, .cummstTyp, .cummndTyp, .cummrddTyp, .cummrthTyp, .cummffthTyp ').keyup(function(){
                bill_amount();
                total_rcv_tk(); 
            })





            total_rcv_tk();

            $(' .cblfd ').keyup(function(){
                total_rcv_tk();
            })


        });




        });



    });




});


</script>







<script>
    $(document).ready(function () {
        $(".flashmessage").delay(3000).fadeOut(100);
    });
</script>































