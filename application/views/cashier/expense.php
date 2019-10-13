<!--sidebar end-->
<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">
        <!-- page start-->
        <section class="panel">
            <header class="panel-heading">
              <i class="fa fa-money"></i> <?php echo lang('dexpen'); ?>
            </header>







<!--this is emp_id <?php echo $this->ion_auth->user()->row()->emp_id;?>-->

            <div class="panel-body">
                <div class="adv-table editable-table ">

                <form style="margin: -25px -15px -32px -16px; padding: 0" role="form" class="f_report" action="cashier/expen" method="post" enctype="multipart/form-data">
                        <div align="center" class="form-group">
                            
                                <div class="input-group input-large" data-date="13/07/2018" data-date-format="mm/dd/yyyy">
                                    <input type="text" class="form-control  dtpic " name="date" value="" placeholder="<?php echo lang('date'); ?>">
                                   
                                <button type="submit" name="submit" class="btn btn-info range_submit"><?php echo lang('submit'); ?></button>

                                </div>
                            </div>
                         </form><br><br>
                        <a data-toggle="modal" href="#myModal">
                            <div class="btn-group">
                                <button id="" class="btn green">
                                    <i class="fa fa-plus-circle"></i> <?php echo lang('add_expense'); ?>
                                </button>
                            </div>
                        </a>
                        <button class="export no-print" onclick="javascript:window.print();">Print</button>
                    <div class="space15"></div>
                    <table style="width: 600px;" class="table table-striped table-hover table-bordered" id="editable-sample">
                        <thead>
                            <tr>
                                <th><?php echo lang('expense_catagory'); ?></th>
                                <th><?php echo lang('amount'); ?></th>
                                <th style="width: 50px;" class="no-print"><?php echo lang('options'); ?></th>
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


                        <?php foreach ($expens as $expen) { ?>
                            <tr class="">
                                <td> <?php echo $expen->category; ?></td>
                                <td> <?php echo $expen->amount; ?>
                                    <?php $amount_per_category[] = $expen->amount;
                                            $total_expen_by_category[] = array_sum($amount_per_category);
                                        $amount_per_category = NULL; 
                                        ?>
                                </td>


                                <td class="no-print">
                                    <button type="button" class="btn btn-info btn-xs btn_width editbutton" title="<?php echo lang('edit'); ?>" data-toggle="modal" data-id="<?php echo $expen->ide; ?>"><i class="fa fa-edit"></i> </button>  




                                    <a class="btn btn-info btn-xs btn_width delete_button" href="cashier/deleteexp?id=<?php echo $expen->ide; ?>" title="<?php echo lang('delete'); ?>" onclick="return confirm('Are you sure you want to delete this item?');"><i class="fa fa-trash"></i> </a>
                                </td>
                            </tr>
                        <?php } ?>
                        </tbody>
                            <tr>
                                <td style="text-align: right;"><?php echo lang('total'); ?></td>
                                <td style="font-weight: bold; font-size: 15px;" colspan="2">
                                    <?php echo array_sum($total_expen_by_category); ?>
                                </td>
                            </tr>
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
                <h4 class="modal-title"><i class="fa fa-plus-circle"></i> <?php echo lang('add_expense'); ?></h4>
            </div>
            <div class="modal-body">
                <form role="form" action="cashier/Newexpen" method="post" enctype="multipart/form-data">


                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('date'); ?></label>
                        <input required="required" type="text" class="form-control  dtpic " name="date" id="exampleInputEmail1" value='' placeholder="">
                    </div>


                    <div class="form-group">
                       <label for="exampleInputEmail1"><?php echo lang('expen_catagory'); ?>
                       </label>
                        <select required="required" class="form-control m-bot15 js-example-basic-single form-control-lg" name="catid">
                            <option value="">Select.....</option>
                            <?php foreach ($cats as $cat) { ?>
                                <option value="<?php echo $cat->id;?>">
                                    <?php echo $cat->category;?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('amount'); ?></label>
                        <input required="required" type="text" class="form-control" name="amount" id="exampleInputEmail1" value='' placeholder="">
                    </div><br><br>
                    <input type="hidden" name="user" value='<?php echo $this->ion_auth->user()->row()->emp_id;?>'>


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
                <h4 class="modal-title"><i class="fa fa-edit"></i> <?php echo lang('edit_expen'); ?></h4>
            </div>
            <div class="modal-body">
                <form role="form" id="editPharmacistForm" action="cashier/Updateexpen" method="post" enctype="multipart/form-data">



                    <div class="form-group">
                       <label for="exampleInputEmail1"><?php echo lang('expen_catagory'); ?>
                       </label>
                        <select class="form-control form-control-lg" name="catid">
                            <?php foreach ($cats as $cat) { ?>
                                <option value="<?php echo $cat->id;?>">
                                    <?php echo $cat->category;?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>


                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('amount'); ?></label>
                        <input type="text" class="form-control" name="amount" id="exampleInputEmail1" placeholder="">
                    </div><br><br><br><br>
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
                            url: 'cashier/editexpenByJason?id=' + iid,
                            method: 'GET',
                            data: '',
                            dataType: 'json',
                        }).success(function (response) {
                            // Populate the form fields with the data returned from server
                            $('#editPharmacistForm').find('[name="id"]').val(response.expen.ide).end()
                            $('#editPharmacistForm').find('[name="amount"]').val(response.expen.amount).end()
                            $('#editPharmacistForm').find('[name="catid"]').val(response.expen.cat_id).end()
                            });
                    });
                });

</script>
<script>
    $(document).ready(function () {
        $(".flashmessage").delay(3000).fadeOut(100);
    });
</script>

