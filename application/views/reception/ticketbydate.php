<!--sidebar end-->
<!--main content start-->



<style type="text/css">
    @media print {
        @page { margin:0; }
        body { margin: 0.1cm; }
    }
</style>


<section id="main-content">
    <section class="wrapper site-min-height">
        <!-- page start-->
        <section class="panel">
            <header class="panel-heading">
                <i class="fa fa-user"></i>  <?php  echo lang('today').' '.lang('ticket'); ?>
            </header>
            <div class="panel-body">
                <div class="adv-table editable-table ">


  <form style="margin: -25px -15px -32px -16px; padding: 0" role="form" class="f_report" action="reception/ticketbydate" method="post" enctype="multipart/form-data">
                        <div align="center" class="form-group">
                            
                                <div class="input-group input-large" data-date="13/07/2018" data-date-format="mm/dd/yyyy">
                                    <input type="text" class="form-control  dtpic " id="printdate" name="date" value="" placeholder="<?php echo lang('date'); ?>">
                                   
                                <button type="submit" name="submit" class="btn btn-info range_submit"><?php echo lang('submit'); ?></button>

                                </div>
                            </div>
                         </form><br>



                	
                    <div class="clearfix">
                        <a data-toggle="modal" href="#myModal">
                            <div class="btn-group">
                                <button id="" class="btn green">
                                   <i class="fa fa-plus-circle"></i>  <?php  echo lang('add_ticket'); ?> 
                                </button>
                            </div>
                        </a>
                        <button class="export" onclick="javascript:window.print();"> <?php  echo lang('print'); ?></button>  
                    </div>
                    <div class="space15"></div>
                    <table class="table table-striped table-hover table-bordered" id="editable-sample">
                        <thead>
                            <tr>
                                <th> <?php  echo lang('serial'); ?></th>
                                <th> <?php  echo lang('name'); ?></th>
                                <th> <?php  echo lang('age'); ?></th>
                                <th> <?php  echo lang('mobile'); ?></th>
                                <th> <?php  echo lang('doctor'); ?></th>
                                <th> <?php  echo lang('appointment'). " " .lang('date'); ?></th>
                                <th> <?php  echo lang('status'); ?></th>
                                <?php if ($this->ion_auth->in_group(array('admin'))) { ?>
                                <th> <?php  echo lang('print'). ' ' .lang('emp'). ' ' .lang('name'); ?></th>
                                <th><?php  echo lang('entry'). ' '.lang('date'); ?></th>
                                <?php }?>
                                <th> <?php  echo lang('options'); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($tickets as $ticket) { ?>

                            <tr class="">
                                <td> <?php echo $ticket->serial; ?></td>
                                <td><?php echo $ticket->patient; ?></td>
                                <td class="center"><?php echo $ticket->age; ?></td>
                                <td class="center"><?php echo $ticket->mobile; ?></td>
                                <td><?php
                                    $this->db->where('dr_id', $ticket->dr_id);
                                    $query = $this->db->get('doctor');
                                    $drm = $query->row();
                                        if($query->num_rows > 0 ) {
                                            echo  $drm->drname;}
                                     ?>
                                        
                                </td>

                                <td class="center"><?php echo $ticket->ap_date; ?></td>
                                <td>                                
                                <?php if ($ticket->print != 'printed') {
                                echo "Not Print"; }else { echo 'Already Printed & Paid '; }?> 
                                </td>
                                <?php if ($this->ion_auth->in_group(array('admin'))) { ?>
                                <td>
                                    <?php
                                        $this->db->where('emp_id', $ticket->emp_id);
                                        $query = $this->db->get('nurse');
                                        $eml = $query->row();
                                            if($query->num_rows > 0 ) {
                                                echo  $eml->ename;} 
                                    ?>
                                </td>
                                <td>
                                    <?php
                                        $dtime = $ticket->thistime;
                                        echo date('h:m a  d-M-Y', $dtime);
                                    ?>
                                </td>
                                <?php }?>
                                <td>                                
                                <?php if ($this->ion_auth->in_group(array('admin', 'Sr_Receptionist')) || $ticket->print != 'printed') { ?>
                                    <button id="printbnt" style="font-size: 16px; padding-right: 10px;" type="button" class="btn btn-info btn-xs btn_width printbnt" title="<?php  echo lang('view'); ?>" data-toggle="modal" data-id="<?php echo $ticket->id; ?>"><i class="fa fa-eye"> </i> <?php  echo lang('view'); ?></button>
                                                                    
                                <?php } ?>

                                    <?php if ($this->ion_auth->in_group(array('admin'))) { ?> 
                                    <button style="margin-left: 20px;" type="button" class="btn btn-info btn-xs btn_width editbutton" title="<?php  echo lang('edit'); ?>" data-toggle="modal" data-id="<?php echo $ticket->id; ?>"><i class="fa fa-edit"> </i></button> 


                                    <a class="btn btn-info btn-xs btn_width delete_button" href="reception/deleteticket?id=<?php echo $ticket->id; ?>" title="<?php  echo lang('delete'); ?>" onclick="return confirm('Are you sure you want to delete this item?');"><i class="fa fa-trash"></i></a>
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




<!-- Add Ticket Modal-->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title"><i class="fa fa-plus-circle"></i>  <?php  echo lang('add_ticket'); ?></h4>
            </div>
            <div class="modal-body">
                <form role="form" action="reception/Newticket" method="post" id="ticketform" enctype="multipart/form-data">


                    <div class="form-group">
                        <label for="exampleInputEmail1"> <?php  echo lang('doctor'); ?></label>
                        <select class="form-control m-bot15 js-example-basic-single" id="doctor" name="dr_id" value=''>
                            <option>Select....</option>
                        <?php foreach ($doctors as $doctor) { ?>
                            <option value="<?php echo $doctor->dr_id; ?>"><?php echo $doctor->dr_id; ?> --------- <?php echo $doctor->drname; ?> </option>

                        <?php } ?>
                        </select>
                    </div>


                    <div class="form-group">
                        <label for="exampleInputEmail1"> <?php  echo lang('ticket').' '.lang('time'); ?></label>
                        <select required="required" class="form-control" name="tickettime" id="tickettime" value='' onchange="changeval()">
                            <option value="">Select.........</option>
                            <option value="firsttime"><?php  echo lang('first_ticket'); ?></option>
                            <option value="secondtime"><?php  echo lang('second_ticket'); ?></option>
                        </select>
                    </div>
                    <input type="text" name="doctor_fee" class="doctor_fee" value=''>
                    <input type="text" name="hospital_fee" class="hospital_fee" value=''>

                    <div class="form-group">
                        <label for="exampleInputEmail1"> <?php  echo lang('patient'); ?> <?php  echo lang('name'); ?></label>
                        <input required="required" type="text" class="form-control" name="patient" id="exampleInputEmail1" placeholder="Full Name">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php  echo lang('appointment'); ?> <?php  echo lang('date'); ?></label>
                        <input required="required" type="text" class="form-control  dtpic " name="date" id="exampleInputEmail1" value='' placeholder="">
                    </div>





                    <div class="form-group col-auto">
                        <label for="exampleInputEmail1"> <?php  echo lang('age'); ?></label>
                        <input required="required" type="text" class="form-control" name="age" id="exampleInputEmail1" value='' placeholder="Type age number">
                        <select  class="form-control ageymd" id="doctor" name="y_m_d" value=''>
                            <option value="y">Y</option>
                            <option value="m">M</option>
                            <option value="d">D</option>
                        </select>
                    </div>


                    <div class="form-group">
                        <label for="exampleInputEmail1"> <?php  echo lang('mobile'); ?></label>
                        <input required="required" type="text" class="form-control" name="mobile" id="exampleInputEmail1" value='' placeholder="Mobile Number">
                    </div><br>

                    <div class="form-group">
                        <label for="exampleInputEmail1"> <?php echo lang('serial'); ?></label>
                        <input required="required" type="text" class="form-control" name="serial" id="exampleInputEmail1" placeholder="">
                    </div>


                    <input type="hidden" name="emp_id" value='<?php echo $this->ion_auth->user()->row()->emp_id;?>'>


                    <center><button style="padding: 20px 60px 20px 60px; font-size: 20px;" type="submit" name="submit" class="btn btn-info"> <?php  echo lang('add'); ?></button></center>
                </form>

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- Add Ticket Modal-->


<style type="text/css">
    .comname{
        font-weight: bold;
        font-size: 18px;
    }
    .addrss{
        font-size: 14px;        
    }
    .tctbl{
        width: 90px;
        font-size: 10px;
        font-weight: bold;
    }
    .tctblv{
        width: 120px;
        font-size: 14px;
        font-weight: bold;
    }
    .serials{
        font-size: 25px;
    }
    .fee{
        font-size: 20px;
    }
    .valu{
        text-align: center;
    }
    .doctor{
        font-size: 12px;
    }

    @media print {
  body * {
    visibility: hidden;
  }
  #section-to-print, #section-to-print * {
    visibility: visible;
  }
  #section-to-print {
    position: absolute;
    left: 0;
    top: 0;
  }
}
</style>



<!-- Ticket Print-->
<div class="modal fade" id="printticket" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content" >
                <div id="val_reset">

            <div style="float: right; margin: 0; padding: 0;">
                <input type="hidden" name="id" id="printid" value="">
                <i class="fa fa-print"></i><input onclick="printct();" type="submit" name="" value="Print">
            </div>
            <center>
                <div id="section-to-print">
                <h2 class="comname" ><?php echo $this->db->get('settings')->row()->system_vendor; ?></h2>
                <h5 class="addrss"><?php echo $this->db->get('settings')->row()->address; ?></h5>
                <h4 class="addrss"><?php echo lang('dr_app_ticket'); ?></h4>
                <div style="margin: 0; padding: 0; height: 40px; width: 100px; border: 3px solid black; border-radius: 20px;"><h1 style="margin: 0; padding: 0; font-weight: bold;" class="serials"></h1></div><br>
                <table border="3px">
                    <tr>
                        <td class="tctbl"><?php echo lang('patient'); ?> <?php echo lang('name'); ?></td>
                        <td class="patient tctblv valu"></td>
                    </tr>

                    <tr>
                        <td class="tctbl"><?php echo lang('doctor'); ?> <?php echo lang('name'); ?></td>
                        <td class="doctor tctblv valu"></td>
                    </tr>
                    <tr>
                        <td class="tctbl"><?php  echo lang('appointment'); ?> <?php  echo lang('date'); ?></td>
                        <td class="ap_date tctblv valu"></td>
                    </tr>
                    <tr>
                        <td class="tctbl"><?php  echo lang('dr_fee'); ?></td>
                        <td class="dr_fee tctblv fee valu"></td>
                    </tr>
                </table><br><br>

                <span style="border-top: 2px solid black"><div style="font-weight: bold;"><?php
                    $this->db->where('emp_id', $this->ion_auth->user()->row()->emp_id);
                    $query = $this->db->get('nurse');
                    $eml = $query->row();
                        if($query->num_rows > 0 ) {
                            echo  $eml->ename;} ?></div>
                <?php
                    $this->db->where('emp_id', $this->ion_auth->user()->row()->emp_id);
                    $query = $this->db->get('empinfo');
                    $eml = $query->row();
                        if($query->num_rows > 0 ) {
                            echo  $eml->desig;} ?></span>
            </div>



            </center>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- Ticket Print -->







<!-- Edit Ticket Modal-->
<div class="modal fade" id="editTicket" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title"><i class="fa fa-plus-circle"></i>  <?php  echo lang('edit').' '.lang('ticket'); ?></h4>
            </div>
            <div class="modal-body">
                <form role="form" action="reception/editTicketData" method="post" id="editTicketForm" enctype="multipart/form-data">


                    <div class="form-group">
                        <label for="exampleInputEmail1"> <?php  echo lang('doctor'); ?></label>
                        <select class="form-control" id="doctor_id" name="dcr_id" value=''>
                            <option>Select....</option>
                        <?php foreach ($doctors as $doctor) { ?>
                            <option value="<?php echo $doctor->dr_id; ?>"><?php echo $doctor->dr_id; ?> --------- <?php echo $doctor->drname; ?> </option>

                        <?php } ?>
                        </select>
                    </div>


                    <div class="form-group">
                        <label for="exampleInputEmail1"> <?php  echo lang('ticket').' '.lang('time'); ?></label>
                        <select class="form-control" name="tmticket" id="tmticket" value='' onchange="changetc()">
                            <option value="">Select.........</option>
                            <option value="firsttime"><?php  echo lang('first_ticket'); ?></option>
                            <option value="secondtime"><?php  echo lang('second_ticket'); ?></option>
                        </select>
                    </div>
                    <input type="text" name="docr_fee" class="docr_fee" value=''>
                    <input type="text" name="hospl_fee" class="hosp_fee" value=''>

                    <div class="form-group">
                        <label for="exampleInputEmail1"> <?php  echo lang('patient'); ?> <?php  echo lang('name'); ?></label>
                        <input required="required" type="text" class="form-control" name="p_name" id="exampleInputEmail1">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php  echo lang('appointment'); ?> <?php  echo lang('date'); ?></label>
                        <input required="required" type="text" class="form-control" name="app_date" id="exampleInputEmail1" value='' placeholder="">
                    </div>





                    <div class="form-group col-auto">
                        <label for="exampleInputEmail1"> <?php  echo lang('age'); ?></label>
                        <input required="required" type="text" class="form-control" name="p_age" id="exampleInputEmail1" value='' placeholder="Type age number">
                    </div>


                    <div class="form-group">
                        <label for="exampleInputEmail1"> <?php  echo lang('mobile'); ?></label>
                        <input required="required" type="text" class="form-control" name="mobile_no" id="exampleInputEmail1" value='' placeholder="Mobile Number">
                    </div><br>

                    <div class="form-group">
                        <label for="exampleInputEmail1"> <?php echo lang('serial'); ?></label>
                        <input required="required" type="text" class="form-control" name="serial_no" id="exampleInputEmail1" placeholder="">
                    </div>


                    <input type="hidden" name="ap_id" value=''>


                    <center><button style="padding: 20px 60px 20px 60px; font-size: 20px;" type="submit" name="submit" class="btn btn-info"> <?php  echo lang('update'); ?></button></center>
                </form>

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- Edit Ticket Modal-->






 
<script>

function AutoRefresh( t ) {
               setTimeout("location.reload(true);", t);
            }

    function printct(){
        window.print(); 
        onafterprint=printentry(); 
        JavaScript:AutoRefresh(1000);
    }

function printentry () {  
        var iid = $('#printid').val();
            $.ajax({
                url: 'reception/editticketprint?id=' + iid,
                method: 'GET',
                data: '',
                dataType: 'json',

            });  }


    function changeval(){
        var doctor_id = $('#doctor').val();
        var select_status = $('#tickettime').val();
        $.ajax({
            url: 'reception/getdrfeeByJason?id=' + doctor_id,
            method: 'GET',
            data: '',
            dataType: 'json',
        }).success(function (ticket) {
            var dr_st_fee = parseInt(ticket.defees.dr_firsttime);
            var hos_st_fee = parseInt(ticket.defees.hospital_first);
            var dr_nd_fee = parseInt(ticket.defees.dr_sectime);
            var hos_nd_fee = parseInt(ticket.defees.hospital_sec);
            var dr_first_fee = dr_st_fee - hos_st_fee;
            var dr_second_fee = dr_nd_fee - hos_nd_fee;
        if (select_status == 'firsttime') {
            $('.doctor_fee').val(dr_first_fee).end()
            $('.hospital_fee').val(hos_st_fee).end()      
        }else{
            $('.doctor_fee').val(dr_second_fee).end()
            $('.hospital_fee').val(hos_nd_fee).end()
        }

        });
    }










    function changetc(){
        var dcr_id = $('#doctor_id').val();
        var select_sts = $('#tmticket').val();
        $.ajax({
            url: 'reception/getdrfeeByJason?id=' + dcr_id,
            method: 'GET',
            data: '',
            dataType: 'json',
        }).success(function (tc_dr) {
            var dcr_1st_fee = parseInt(tc_dr.defees.dr_firsttime);
            var hosp_1st_fee = parseInt(tc_dr.defees.hospital_first);
            var dcr_2nd_fee = parseInt(tc_dr.defees.dr_sectime);
            var hosp_2nd_fee = parseInt(tc_dr.defees.hospital_sec);
            var dr_1st_fee = dcr_1st_fee - hosp_1st_fee;
            var dr_2nd_fee = dcr_2nd_fee - hosp_2nd_fee;
        if (select_sts == 'firsttime') {
            $('.docr_fee').val(dr_1st_fee).end()
            $('.hospl_fee').val(hosp_1st_fee).end()      
        }else{
            $('.docr_fee').val(dr_2nd_fee).end()
            $('.hospl_fee').val(hosp_2nd_fee).end()
        }

        });
    }

</script>


<script type="text/javascript">
$(document).ready(function () {
    $(".printbnt").click(function (e) {
        e.preventDefault(e);
        // Get the record's ID via attribute  
        var iid = $(this).attr('data-id');
        $('#val_reset').trigger("rese");
        $('#printticket').modal('show');
        $.ajax({
            url: 'reception/getticketByJason?id=' + iid,
            method: 'GET',
            data: '',
            dataType: 'json',
        }).success(function (ticketprint) {
            // Populate the form fields with the data returned from server
            var dr_fee = parseInt(ticketprint.ticketss.doctor_fee);
            var hos_fee = parseInt(ticketprint.ticketss.hospital_fee);
            var ticket_fee = dr_fee + hos_fee;
            var dr_id = parseInt(ticketprint.ticketss.dr_id);
            $('.serials').append(ticketprint.ticketss.serial).end()
            $('.patient').append(ticketprint.ticketss.patient).end()
            $('.ap_date').append(ticketprint.ticketss.ap_date).end()
            $('.dr_fee').append(ticket_fee + '  /=').end()
            $('#printid').val(ticketprint.ticketss.id).end()
                $.ajax({
                url: 'reception/getdrByJason?drid=' + dr_id,
                method: 'GET',
                data: '',
                dataType: 'json',
            }).success(function (doctorrs) {
                $('.doctor').append(doctorrs.doctorr.drname).end()
            });

        });
    });
});
</script>




<script type="text/javascript">
$(document).ready(function () {
    $(".editbutton").click(function (e) {
        e.preventDefault(e);
        // Get the record's ID via attribute  
        var iid = $(this).attr('data-id');
        $('#editTicketForm').trigger("reset");
        $('#editTicket').modal('show');
        $.ajax({
            url: 'reception/editTicketByJason?id=' + iid,
            method: 'GET',
            data: '',
            dataType: 'json',
        }).success(function (editTc) {
            // Populate the form fields with the data returned from server
            $('#doctor_id option[value='+editTc.app_view.dr_id+']').attr('selected', 'selected');
            $('#editTicketForm').find('[name="ap_id"]').val(editTc.app_view.id).end()
            $('#editTicketForm').find('[name="p_name"]').val(editTc.app_view.patient).end()
            $('#editTicketForm').find('[name="p_age"]').val(editTc.app_view.age).end()
            $('#editTicketForm').find('[name="mobile_no"]').val(editTc.app_view.mobile).end()
            $('#editTicketForm').find('[name="serial_no"]').val(editTc.app_view.serial).end()
            $('#editTicketForm').find('[name="docr_fee"]').val(editTc.app_view.doctor_fee).end()
            $('#editTicketForm').find('[name="hospl_fee"]').val(editTc.app_view.hospital_fee).end()
            $('#editTicketForm').find('[name="app_date"]').val(editTc.app_view.ap_date).end()
        });
    });
});
</script>




<script>
    $(document).ready(function () {
        $(".flashmessage").delay(3000).fadeOut(100);
    });
</script>
