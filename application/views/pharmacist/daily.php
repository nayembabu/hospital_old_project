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

            
                
                <form style="margin: -25px -15px -32px -16px; padding: 0" role="form" class="f_report" action="pharmacist/daily" method="post" enctype="multipart/form-data">
                        <div align="center" class="form-group">
                            
                                <div class="input-group input-large" data-date="13/07/2018" data-date-format="mm/dd/yyyy">
                                    <input type="text" class="form-control  dtpic " id="printdate" name="date" value="" placeholder="<?php echo lang('date'); ?>">
                                   
                                <button type="submit" name="submit" class="btn btn-info range_submit"><?php echo lang('submit'); ?></button>

                                </div>
                            </div>
                         </form><br>
                             <center>
                                <button onclick="openprint()" id="print" type="print" name="print" class="btn btn-info"><?php echo lang('printpre'); ?></button>
                            </center>
                         <br><br>
                        <a data-toggle="modal" href="#myModal">
                            <div class="btn-group">
                                <button id="" class="btn green">
                                    <i class="fa fa-plus-circle"></i> <?php echo lang('add_attn'); ?>
                                </button>
                            </div>
                        </a>
                        <button class="export no-print" onclick="javascript:window.print();">Print</button>

                    <div class="space15"></div>

                    <table class="table table-striped table-hover table-bordered" id="editable-sample">

                        <thead>
                            <tr>
                                <th><?php echo lang('emp_id'); ?></th>
                                <th><?php echo lang('emp'); ?></th>
                                <th><?php echo lang('date'); ?></th>
                                <th><?php echo lang('intime'); ?></th>
                                <th><?php echo lang('outtime'); ?></th>
                                <th><?php echo lang('dutytime'); ?></th>
                                <th class="no-print"><?php echo lang('delete'); ?></th>
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
                                <td><?php echo $pharmacist->date; ?></td>
                                <td><?php echo $pharmacist->intim; ?></td>
                                <td><?php echo $pharmacist->outtim; ?></td>
                                <td>
                                <?php if (empty($pharmacist->intim) || empty($pharmacist->outtim)) {
                                        echo "A";
                                    }else {
                                        $in = $pharmacist->intim;
                                        $out = $pharmacist->outtim; 
                                        $cal = $out-$in; 
                                        echo  $cal, lang('hours');
                                      }?>
                                 </td>


                                <td class="no-print">




                                    <button type="button" class="btn btn-info btn-xs btn_width editbutton" title="<?php echo lang('edit'); ?>" data-toggle="modal" data-id="<?php echo $pharmacist->id; ?>"><i class="fa fa-edit"></i> </button>  




                                    <a class="btn btn-info btn-xs btn_width delete_button" href="pharmacist/delete?id=<?php echo $pharmacist->id; ?>" title="<?php echo lang('delete'); ?>" onclick="return confirm('Are you sure you want to delete this item?');"><i class="fa fa-trash"></i> </a>
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






<!-- Add Pharmacist Modal-->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title"><i class="fa fa-plus-circle"></i> <?php echo lang('add_attn'); ?></h4>
            </div>
            <div class="modal-body">
                <form role="form" action="pharmacist/NewAttn" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                       <label for="exampleInputEmail1"><?php echo lang('name'); ?>
                       </label>
                        <select class="form-control m-bot15 js-example-basic-single form-control-lg" name="emp_id">
                        		<option></option>
                            <?php foreach ($emps as $emp) { ?>
                                <option value="<?php echo $emp->emp_id;?>">
                                    <?php echo $emp->ename;?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('date'); ?></label>
                        <input type="text" class="form-control" name="date" placeholder="Enter Date Formate (2019-03-28)" value="">
                    </div>

                    <div style="width: 200px; float: left;" class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('intime'); ?></label>
                        <input type="text" class="form-control" name="intime" id="exampleInputEmail1" value='' placeholder="">
                    </div>
                    <div class="form-group" style="width: 200px; float: right;">
                        <label for="exampleInputEmail1"><?php echo lang('outtime'); ?></label>
                        <input type="text" class="form-control" name="outtime" id="exampleInputEmail1" value='' placeholder="">
                    </div><br><br><br><br><br><br><br>

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
                        <label for="exampleInputEmail1"><?php echo lang('name'); ?></label>
                        <input disabled="disabled" type="text" class="form-control" name="name" id="exampleInputEmail1" value='' placeholder="">
                    </div>


                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('emp_id'); ?></label>
                        <input disabled="disabled" type="text" class="form-control" name="emp_id" id="exampleInputEmail1" placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('date'); ?></label>
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


<script type="text/javascript">
function openprint() {
    var url = 'pharmacist/dailys?date='+document.getElementById("printdate").value;     
  window.open(url, '_blank', 'height=800,width=800');
}
</script>



<script>
    $(document).ready(function () {
        $(".flashmessage").delay(3000).fadeOut(100);
    });
</script>

