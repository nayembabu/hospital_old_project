<!--sidebar end-->
<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">
        <!-- page start-->
        <section class="panel">
            <header class="panel-heading">
              <i class="fa fa-user"></i> <?php echo lang('job_card'); ?>
            </header>
            <div class="panel-body">
                <div class="adv-table editable-table ">

            
                    <br><br><br><br><br>


                        <div style="margin: -25px -15px -32px -16px; padding: 0" role="form" class="form-horizontal form-inline f_report" id="form_id">
                                <div class="form-group" style="margin: 10px">
                                   <label for="inputPassword3"><?php echo lang('emp').' '. lang('name'); ?>
                                   </label>
                                    <select class="form-control m-bot15 js-example-basic-single form-control-lg" id="emp_id" name="emp_id">
                                            <option>Select Employee  ........</option>
                                        <?php foreach ($emps as $emp) { ?>
                                            <option value="<?php echo $emp->emp_id;?>">
                                                <?php echo $emp->ename;?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                </div>
                              <div class="form-group">
                                <label for="inputEmail3" class="col-sm-2 control-label"></label>
                                <div class="col-sm-10">
                                    <select class="form-control form-control-lg" id="month" name="month">
                                      <option value="01">January</option>
                                      <option value="02">Fabruary</option>
                                      <option value="03">March</option>
                                      <option value="04">April</option>
                                      <option value="05">May</option>
                                      <option value="06">Jun</option>
                                      <option value="07">July</option>
                                      <option value="08">August</option>
                                      <option value="09">September</option>
                                      <option value="10">October</option>
                                      <option value="11">November</option>
                                      <option value="12">December</option>
                                    </select>
                                </div>
                              </div>
                              <div class="form-group">
                                <label for="inputPassword3" class="col-sm-2 control-label"></label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control input-lg" id="year" name="year" value="" placeholder="<?php echo lang('Year'); ?>">
                                </div>
                              </div>
                              <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                  <button type="submit" onclick="openprint()" class="btn btn-info"><?php echo lang('present'); ?></button>
                                </div>
                              </div>
                          </div><br><br><br><br><br><br>









                </div>
            </div>
        </section>
        <!-- page end-->
    </section>
</section>
<!--main content end-->
<!--footer start-->













<script type="text/javascript">
function openprint() {
    var month = document.getElementById("month").value;
    var emp_id = document.getElementById("emp_id").value;
    var year = document.getElementById("year").value;
    var url = 'pharmacist/job_details?month='+month+'&emp_id='+emp_id+'&year='+year;
  window.open(url, '_blank', 'height=800,width=800');
}
</script>


