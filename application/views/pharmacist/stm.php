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







                        <div style="margin: -25px -15px -32px -16px; padding: 0" role="form" class="form-horizontal form-inline f_report" id="form_id">
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
                                    <input type="text" class="form-control input-lg" id="year" name="year" value="" placeholder="<?php echo lang('year'); ?>">
                                </div>
                              </div>
                              <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                  <button type="submit" onclick="openwind()" class="btn btn-info"><?php echo lang('pmst'); ?></button>
                                </div>
                              </div>
                              <div style="margin-left: 15px" class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                  <button type="submit" onclick="banksheet()" class="btn btn-info"><?php echo lang('bank_sheet'); ?></button>
                                </div>
                              </div>
                              <div style="margin-left: 15px" class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                  <button type="submit" onclick="trialsheet()" class="btn btn-info"><?php echo lang('trial_sheet'); ?></button>
                                </div>
                              </div>
                              <div style="margin-left: 15px" class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                  <button type="submit" onclick="balancesheet()" class="btn btn-info"><?php echo lang('balance_sheet'); ?></button>
                                </div>
                              </div>
                          </div><br><br><br><br><br><br>








                    <center>
                        <div style="margin: -25px -15px -32px -16px; padding: 0" role="form" class="form-horizontal form-inline f_report" id="form_id">
                          <h3><?php echo lang('incladger'); ?></h3><br>
                              <div class="form-group">
                                <label for="inputEmail3" class="col-sm-2 control-label"></label>
                                <div class="col-sm-10">
                                    <select class="form-control form-control-lg" id="ciid" name="ciid">
                                <?php foreach ($cats as $cat) {?>
                                      <option value="<?php echo $cat->id;?>"><?php echo $cat->category; ?></option>
                                <?php } ?>
                                    </select>
                                </div>
                              </div>
                              <div class="form-group">
                                <label for="inputEmail3" class="col-sm-2 control-label"></label>
                                <div class="col-sm-10">
                                    <select class="form-control form-control-lg" id="imonth" name="imonth">
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
                                    <input type="text" class="form-control input-lg" id="iyear" name="iyear" value="" placeholder="<?php echo lang('year'); ?>">
                                </div>
                              </div>
                              <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                  <button type="submit" onclick="inladger()" class="btn btn-info"><?php echo lang('ladgerpagep'); ?></button>
                                </div>
                              </div>
                          </div>
                        </center><br><br><br><br><br><br>
                        








                    <center>
                        <div style="margin: -25px -15px -32px -16px; padding: 0" role="form" class="form-horizontal form-inline f_report" id="form_id">
                          <h3><?php echo lang('expladger'); ?></h3><br>
                              <div class="form-group">
                                <label for="inputEmail3" class="col-sm-2 control-label"></label>
                                <div class="col-sm-10">
                                    <select class="form-control form-control-lg" id="ceid" name="ceid">
                                <?php foreach ($catexs as $catex) {?>
                                      <option value="<?php echo $catex->id;?>"><?php echo $catex->category; ?></option>
                                <?php } ?>
                                    </select>
                                </div>
                              </div>
                              <div class="form-group">
                                <label for="inputEmail3" class="col-sm-2 control-label"></label>
                                <div class="col-sm-10">
                                    <select class="form-control form-control-lg" id="emonth" name="emonth">
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
                                    <input type="text" class="form-control input-lg" id="eyear" name="eyear" value="" placeholder="<?php echo lang('year'); ?>">
                                </div>
                              </div>
                              <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                  <button type="submit" onclick="exladger()" class="btn btn-info"><?php echo lang('ladgerpagep'); ?></button>
                                </div>
                              </div>
                          </div>
                      </center>
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
    var url = 'cashier/mieprint?month='+document.getElementById("month").value+'&year='+document.getElementById("year").value;     
  window.open(url, '_blank', 'height=800,width=800');
}

function banksheet() {
    var url = 'cashier/bankstat?month='+document.getElementById("month").value+'&year='+document.getElementById("year").value;     
  window.open(url, '_blank', 'height=800,width=800');
}

function trialsheet() {
    var url = 'cashier/trialprint?month='+document.getElementById("month").value+'&year='+document.getElementById("year").value;     
  window.open(url, '_blank', 'height=800,width=800');
}

function balancesheet() {
    var url = 'cashier/mieprint?month='+document.getElementById("month").value+'&year='+document.getElementById("year").value;     
  window.open(url, '_blank', 'height=800,width=800');
}

function inladger() {
    var url = 'cashier/iladg?ciid='+document.getElementById("ciid").value+'&month='+document.getElementById("imonth").value+'&year='+document.getElementById("iyear").value;     
  window.open(url, '_blank', 'height=800,width=800');
}

function exladger() {
    var url = 'cashier/eladg?ciid='+document.getElementById("ceid").value+'&month='+document.getElementById("emonth").value+'&year='+document.getElementById("eyear").value;     
  window.open(url, '_blank', 'height=800,width=800');
}
</script>


<script>
    $(document).ready(function () {
        $(".flashmessage").delay(3000).fadeOut(100);
    });
</script>

