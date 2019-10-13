<!--sidebar end-->
<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">
        <!-- page start-->
        <section class="panel">
            <header class="panel-heading">
              <i class="fa fa-money"></i> <?php echo lang('monthlystatement'); ?>
            </header>
<!--this is emp_id <?php echo $this->ion_auth->user()->row()->emp_id;?>-->
            <div class="panel-body">
                <div class="adv-table editable-table ">
                    <br><br><br>







                        <div style="margin: -25px -15px -32px -1px; padding: 0" role="form" class="form-horizontal form-inline f_report" id="form_id"><b>Doctor And Login User wise Statement</b>
                              <div style="width: 350px;" class="form-group">
                                <label for="inputEmail3" class="col-sm-2 control-label"></label>
                                <div class="col-sm-10">Doctor Name:
                                  <select class="form-control m-bot15 js-example-basic-single" id="doctor" name="dr_id" value=''>
                                      <option>Select....</option>
                                  <?php foreach ($doctors as $doctor) { ?>
                                      <option value="<?php echo $doctor->dr_id; ?>"><?php echo $doctor->dr_id; ?> --------- <?php echo $doctor->drname; ?> </option>

                                  <?php } ?>
                                  </select>
                                </div>
                              </div>
                              <div class="form-group">
                                <label for="inputPassword3" class="col-sm-2 control-label"></label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control input-lg date_pick" id="date" name="date_em" value="" placeholder="<?php echo lang('date'); ?>">
                                </div>
                              </div>
                              <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                  <button type="submit" onclick="openwind()" class="btn btn-info"><?php echo lang('print').' '.lang('statement'); ?></button>
                                </div>
                              </div>
                          </div><br><br><br><br><br><br>








                        <div style="margin: -25px -15px -32px -1px; padding: 0" role="form" class="form-horizontal form-inline f_report" id="form_id"><b>Doctor wise Statement</b>
                              <div style="width: 350px;" class="form-group">
                                <label for="inputEmail3" class="col-sm-2 control-label"></label>
                                <div class="col-sm-10">Doctor Name:
                                  <select class="form-control m-bot15 js-example-basic-single" id="doctor_em_t" name="dr_id" value=''>
                                      <option>Select....</option>
                                  <?php foreach ($doctors as $doctor) { ?>
                                      <option value="<?php echo $doctor->dr_id; ?>"><?php echo $doctor->dr_id; ?> --------- <?php echo $doctor->drname; ?> </option>

                                  <?php } ?>
                                  </select>
                                </div>
                              </div>
                              <div class="form-group">
                                <label for="inputPassword3" class="col-sm-2 control-label"></label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control input-lg date_pick" id="date_e_tm " name="date_emp_e" value="" placeholder="<?php echo lang('date'); ?>">
                                </div>
                              </div>
                              <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                  <button type="submit" onclick="openexwind()" class="btn btn-info"><?php echo lang('print').' '.lang('statement'); ?></button>
                                </div>
                              </div>
                          </div><br><br><br><br><br><br>

<?php if ($this->ion_auth->in_group(array('admin', 'Sr_Receptionist'))) { ?>

                        <div style="margin: -25px -15px -32px -1px; padding: 0" role="form" class="form-horizontal form-inline f_report" id="form_id"><b>Doctor And User wise Statement</b>
                              <div style="width: 350px;" class="form-group">
                                <label for="inputEmail3" class="col-sm-2 control-label"></label>
                                <div class="col-sm-10">Doctor Name
                                  <select class="form-control m-bot15 js-example-basic-single" id="doctorad" name="dr_id" value=''>
                                      <option>Select....</option>
                                  <?php foreach ($doctors as $doctor) { ?>
                                      <option value="<?php echo $doctor->dr_id; ?>"><?php echo $doctor->dr_id; ?> --------- <?php echo $doctor->drname; ?> </option>

                                  <?php } ?>
                                  </select>
                                </div>
                              </div>


                              <div style="width: 350px;" class="form-group">
                                <label for="inputEmail3" class="col-sm-2 control-label"></label>
                                <div class="col-sm-10">User Name:
                                  <select class="form-control m-bot15 js-example-basic-single" id="emp_id" name="emp_id" value=''>
                                      <option>Select....</option>
                                  <?php foreach ($users as $user) { ?>
                                      <option value="<?php echo $user->emp_id; ?>"><?php echo $user->ename; ?> </option>

                                  <?php } ?>
                                  </select>
                                </div>
                              </div>
                              <div class="form-group">
                                <label for="inputPassword3" class="col-sm-2 control-label"></label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control input-lg date_pick" id="datead" name="date_e" value="" placeholder="<?php echo lang('date'); ?>">
                                </div>
                              </div>
                              <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                  <button type="submit" onclick="openwindadmin()" class="btn btn-info"><?php echo lang('print').' '.lang('statement'); ?></button>
                                </div>
                              </div>
                          </div><br><br><br><br><br><br>
                        <?php } ?>




                        <div style="margin: -25px -15px -32px -1px; padding: 0" role="form" class="form-horizontal form-inline f_report" id="form_id"><b>Total Statement By Date</b>


                              <div class="form-group">
                                <label for="inputPassword3" class="col-sm-2 control-label"></label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control input-lg date_pick" id="dateemp" name="date_t" value="" placeholder="<?php echo lang('date'); ?>">
                                </div>
                              </div>
                              <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                  <button type="submit" onclick="opentotalticket()" class="btn btn-info"><?php echo lang('print').' '.lang('statement'); ?></button>
                                </div>
                              </div>
                          </div><br><br><br><br><br><br>
     


<?php if ($this->ion_auth->in_group(array('admin', 'Sr_Receptionist'))) { ?>

                        <div style="margin: -25px -15px -32px -1px; padding: 0" role="form" class="form-horizontal form-inline f_report" id="form_id"><b>User wise Total Statement</b>


                              <div style="width: 350px;" class="form-group">
                                <label for="inputEmail3" class="col-sm-2 control-label"></label>
                                <div class="col-sm-10">User Name:
                                  <select class="form-control m-bot15 js-example-basic-single" id="emp_id_t" name="emp_id" value=''>
                                      <option>Select....</option>
                                  <?php foreach ($users as $user) { ?>
                                      <option value="<?php echo $user->emp_id; ?>"><?php echo $user->ename; ?> </option>

                                  <?php } ?>
                                  </select>
                                </div>
                              </div>
                              <div class="form-group">
                                <label for="inputPassword3" class="col-sm-2 control-label"></label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control input-lg date_pick" id="date_emp_t" name="date_em_t" value="" placeholder="<?php echo lang('date'); ?>">
                                </div>
                              </div>
                              <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                  <button type="submit" onclick="opentotalempticket()" class="btn btn-info"><?php echo lang('print').' '.lang('statement'); ?></button>
                                </div>
                              </div>
                          </div>
                        <?php } ?>






               </div>
            </div>
        </section>
        <!-- page end-->
    </section>
</section>
<!--main content end-->
<!--footer start-->





<script type="text/javascript">
function openwind() {
    var url = 'reception/countprint?dr_id='+document.getElementById("doctor").value+'&date='+document.getElementById("date").value;     
  window.open(url, '_blank', 'height=800,width=800');
}

function openwindadmin() {
    var url = 'reception/countprintadmin?dr_id='+document.getElementById("doctorad").value+'&date='+document.getElementById("datead").value+'&emp_id='+document.getElementById("emp_id").value;     
  window.open(url, '_blank', 'height=800,width=800');
}


function opentotalticket() {
    var url = 'reception/count_emp?date='+document.getElementById("dateemp").value;     
  window.open(url, '_blank', 'height=800,width=800');
}



function opentotalempticket() {
    var url = 'reception/count_e?date='+document.getElementById("date_emp_t").value+'&emp_id='+document.getElementById("emp_id_t").value;     
  window.open(url, '_blank', 'height=800,width=800');
}


function openexwind() {
    var url = 'reception/count_e_dr?date='+document.getElementById("date_e_tm").value+'&dr_id='+document.getElementById("doctor_em_t").value;     
  window.open(url, '_blank', 'height=800,width=800');
}




  $( function() {
    $( ".date_pick" ).datepicker({

    format: "dd-mm-yyyy"
    }).on('changeDate', function(ev){
       $(this).datepicker('hide');
    });
  });










</script>


<script>
    $(document).ready(function () {
        $(".flashmessage").delay(3000).fadeOut(100);
    });
</script>

