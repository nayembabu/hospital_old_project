<!--sidebar end-->
<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">
        <!-- page start-->
        <section class="panel">
            <header class="panel-heading">
              <i class="fa fa-user"></i> <?php echo lang('attend'); ?>
            </header>
            <div class="panel-body">
                <div class="adv-table editable-table ">

            
                
                <form style="margin: -25px -15px -32px -16px; padding: 0" role="form" class="f_report" action="pharmacist/salary" method="post" enctype="multipart/form-data">
                        <div align="center" class="form-group">
                            
                                <div class="input-group input-large" data-date="13/07/2018" data-date-format="mm/dd/yyyy">
                                    <select class="form-control form-control-lg" name="date">
                                      <option value="January">January</option>
                                      <option value="February">Fabruary</option>
                                      <option value="March">March</option>
                                      <option value="April">April</option>
                                      <option value="May">May</option>
                                      <option value="June">Jun</option>
                                      <option value="July">July</option>
                                      <option value="August">August</option>
                                      <option value="September">September</option>
                                      <option value="October">October</option>
                                      <option value="November">November</option>
                                      <option value="December">December</option>
                                    </select>
                                   
                                <button type="submit" name="submit" class="btn btn-info range_submit"><?php echo lang('submit'); ?></button>

                                </div>
                            </div>
                         </form><br><br>
                        <a data-toggle="modal" href="#myModal">
                            <div class="btn-group">

                               <!--  
                                <button id="" class="btn green">
                                    <i class="fa fa-plus-circle"></i> <?php echo lang('add_pharmacist'); ?>
                                </button>
                            -->
                            </div>
                        </a>
                        <button class="export no-print" onclick="javascript:window.print();">Print</button>
                    <div class="space15"></div>
                    <table class="table table-striped table-hover table-bordered" id="editable-sample">

                        <thead>
                            <tr>
                                <th><?php echo lang('emp_id'); ?></th>
                                <th><?php echo lang('emp'); ?></th>
                                <th><?php echo lang('month'); ?></th>
                                <th><?php echo lang('duty'); ?></th>
                                <th><?php echo lang('salary'); ?></th>
                                <th><?php echo lang('overduty'); ?></th>
                                <th><?php echo lang('tsalary'); ?></th>
                                <th><?php echo lang('vat'); ?></th>
                                <th><?php echo lang('fsalary'); ?></th>
                                <th><?php echo lang('sign'); ?></th>
                                
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


                        <?php foreach ($pharmacists as $pharmacist) { ?>
                            <tr class="">
                                <td> <?php echo $pharmacist->eid; ?></td>
                                <td>
                                    
                                    <button style="color: black; background: 000; border: 000; " type="button" class="btn btn-info btn-xs btn_width editbutton" title="<?php echo lang('edit'); ?>" data-toggle="modal" data-id="<?php echo $pharmacist->id; ?>"><i class=""></i> <a href="<?php echo $pharmacist->id; ?>"></a>


                                    <?php echo $pharmacist->ename; ?></a>


                                    </button> 
                            </td>
                                <td><?php
                                $mon = '02';
                                $yr = '2019';

                        $dateObj   = DateTime::createFromFormat('!m', $mon);
                        $monthName = $dateObj->format('F');
                        echo $monthName;
                                 ?></td>
                                <td><?php
                                 $querys = $this->db->where('emp_id', $pharmacist->emp_id)->where('MONTH(date)', $mon)->where('YEAR(date)', $yr)->get('attn');
                                 $total = $querys->num_rows;
                                 //Total Present
                                 echo $total;
                                 ?></td>
                                <td>
                                    <?php $sall = $pharmacist->sallary;
                                    echo $sall; ?></td>
                                <td><?php 


                                $year = $yr;
                                $month = $mon;
                                $day = $pharmacist->offday;
                                $count = 0;
                                //Total day of Month
                                $days = cal_days_in_month(CAL_GREGORIAN, $month, $year);

                                $date = new Datetime($year.'-'.$month.'-01');

                                for($i=0; $i<$days; $i++){
                                    if($date->format('l') == $day){
                                        $count++;
                                    }
                                    $date->modify('+1 day');
                                }
                                //Total Off day
                                //echo $count;


                            ?></td>
                                <td><?php 
                                   	$sal = $sall/$days;
                                    $ftdm = $total + $count + 1;
                                    $tsall = $sal * $ftdm;
                                    echo $tsall;
                                    
                                    ?></td>
                                    <td>10</td>
                                    <td><?php
                                    $gsall = $tsall - 10;
                                    echo $gsall;?></td>
                                    <td></td>




                                <!--
                                <td class="no-print">
                                    <button type="button" class="btn btn-info btn-xs btn_width editbutton" title="<?php echo lang('edit'); ?>" data-toggle="modal" data-id="<?php echo $pharmacist->id; ?>"><i class="fa fa-edit"></i> </button>  

                                    <a class="btn btn-info btn-xs btn_width delete_button" href="pharmacist/delete?id=<?php echo $pharmacist->id; ?>" title="<?php echo lang('delete'); ?>" onclick="return confirm('Are you sure you want to delete this item?');"><i class="fa fa-trash"></i> </a>
                                </td>-->
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






<!-- Add Pharmacist Modal-->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title"><i class="fa fa-plus-circle"></i> <?php echo lang('add_new_pharmacist'); ?></h4>
            </div>
            <div class="modal-body">
                <form role="form" action="pharmacist/addNew" method="post" enctype="multipart/form-data">
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












<!-- Edit Event Modal-->
<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title"><i class="fa fa-edit"></i> <?php echo lang('edit_pharmacist'); ?></h4>
            </div>
            <div class="modal-body">
                <form role="form" id="editPharmacistForm" action="pharmacist/UpdatePharmacist" method="post" enctype="multipart/form-data">


                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('image'); ?></label>
                        <input type="file" name="img_url">
                    </div>




                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('name'); ?></label>
                        <input disabled="disabled" type="text" class="form-control" name="name" id="exampleInputEmail1" value='' placeholder="">
                    </div>


                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('emp_id'); ?></label>
                        <input disabled="disabled" type="text" class="form-control" name="emp_id" id="exampleInputEmail1" placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('email'); ?></label>
                        <input disabled="disabled" type="text" class="form-control" name="date" id="exampleInputEmail1" value='' placeholder="">
                    </div>
                    <div style="width: 200px; float: left;" class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('intime'); ?></label>
                        <input type="text" class="form-control" name="intim" id="exampleInputEmail1" value='' placeholder="">
                    </div>
                    <div class="form-group" style="width: 200px; float: right;">
                        <label for="exampleInputEmail1"><?php echo lang('outtime'); ?></label>
                        <input type="text" class="form-control" name="outtim" id="exampleInputEmail1" value='' placeholder="">
                    </div><br><br><br><br><br><br><br>

                    <input type="hidden" name="id" value=''>


                   <center> <button type="submit" name="submit" class="btn btn-info"><?php echo lang('submit'); ?></button></center>
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
                                                $('#editPharmacistForm').trigger("reset");
                                                $('#myModal2').modal('show');
                                                $.ajax({
                                                    url: 'pharmacist/editPharmacistByJason?id=' + iid,
                                                    method: 'GET',
                                                    data: '',
                                                    dataType: 'json',
                                                }).success(function (response) {
                                                    // Populate the form fields with the data returned from server
                                                    $('#editPharmacistForm').find('[name="id"]').val(response.pharmacist.id).end()
                                                    $('#editPharmacistForm').find('[name="name"]').val(response.pharmacist.emp_id).end()
                                                    $('#editPharmacistForm').find('[name="emp_id"]').val(response.pharmacist.emp_id).end()
                                                    $('#editPharmacistForm').find('[name="date"]').val(response.pharmacist.date).end()
                                                    $('#editPharmacistForm').find('[name="intim"]').val(response.pharmacist.intim).end()
                                                    $('#editPharmacistForm').find('[name="outtim"]').val(response.pharmacist.outtim).end()
                                                });
                                            });
                                        });
</script>
<script>
    $(document).ready(function () {
        $(".flashmessage").delay(3000).fadeOut(100);
    });
</script>

