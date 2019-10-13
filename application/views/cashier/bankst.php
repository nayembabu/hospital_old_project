<!--sidebar end-->
<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">
        <!-- page start-->
        <section class="panel">
            <header class="panel-heading">
              <i class="fa fa-money"></i> <?php echo lang('diexpen'); ?>
            </header>




<!--this is emp_id <?php echo $this->ion_auth->user()->row()->emp_id;?>-->


            <div class="panel-body">
                <div class="adv-table editable-table ">



                        <a data-toggle="modal" href="#myModal">
                            <div class="btn-group">
                                <button id="" class="btn green">
                                    <i class="fa fa-plus-circle"></i> <?php echo lang('add_bankacc'); ?>
                                </button>
                            </div>
                        </a>

                    <div align="center" style="margin: 85px;">





                        <form style="float: left;" role="form" class="formreport" action="" method="post" enctype="multipart/form-data">
                            <h1><?php echo lang('bstatement'); ?></h1>
                                <div class="input-group">
                                  <span class="input-group-addon" id="basic-addon3"><?php echo lang('date'); ?></span>
                                  <input required="required" type="text" name="date" id="inp_date" class="form-control dtpic" aria-describedby="basic-addon3">
                                </div><br>

                                <div class="form-group">
                                  <span class="input-group-addon" id="basic-addon3"><?php echo lang('accno'); ?></span>
                                    <select class="form-control form-control-lg" name="bankac" id="">
                            <?php foreach ($bankacc as $bankaccn) { ?>
                                        <option value="<?php echo $bankaccn->id; ?>">
                                            <?php echo  $bankaccn->accno;?>
                                        </option>
                             <?php } ?>
                                    </select>
                                </div><br>
                                <div class="form-group">
                                  <span class="input-group-addon" id="basic-addon3"><?php echo lang('transtype'); ?></span>
                                    <select class="form-control form-control-lg" name="boption" id="boption" onchange="changeformval();">
                                        <option value=""><?php echo lang('select'); ?></option>
                                        <option value="bdeposit"><?php echo lang('bdeposit'); ?></option>
                                        <option value="bwithdraw"><?php echo lang('bwithdraw'); ?></option>
                                    </select>
                                </div>
                                <div class="input-group">
                                  <span class="input-group-addon lanr" id="basic-addon3"></span>
                                  <input type="text" name="recipt" class="form-control" aria-describedby="basic-addon3">
                                </div><br>
                                <div class="input-group">
                                  <span class="input-group-addon" id="basic-addon3"><?php echo lang('amount'); ?></span>
                                  <input required="required" type="text" name="amount" class="form-control" aria-describedby="basic-addon3">
                                </div><br>
                                <div class="input-group">
                                  <input type="hidden" name="emp_id" class="form-control" aria-describedby="basic-addon3" value="<?php echo $this->ion_auth->user()->row()->emp_id;?>">
                                </div><br><br>
                                <button type="submit" name="submit" class="btn btn-info range_submit"><?php echo lang('submit'); ?></button>
                        </form>

                    <table style="width: 900px; display: none; " class="bankd table table-striped table-hover table-bordered" id="">
                        <thead>
                    <center  style="display: none;" class="bankd"><h1><?php echo lang('bdeposittoday'); ?></h1></center>
                            <tr>
                                <th><?php echo lang('d_memo_no'); ?></th>
                                <th><?php echo lang('amount'); ?></th>
                                <th style="width: 50px;" class="no-print"><?php echo lang('options'); ?></th>
                            </tr>
                        </thead>
                        <tbody>

                        <?php foreach ($bankds as $bankd) { ?>
                            <tr class="">
                                <td> <?php echo $bankd->recit_no; ?></td>
                                <td> <?php echo $bankd->amount; ?>
                                    <?php $amount_per_category[] = $bankd->amount;
                                            $total_income_by_category[] = array_sum($amount_per_category);
                                        $amount_per_category = NULL; 
                                        ?>
                                </td>


                                <td class="no-print">
                                    <button type="button" class="btn btn-info btn-xs btn_width editbutton" title="<?php echo lang('edit'); ?>" data-toggle="modal" data-id-d="<?php echo $bankd->id; ?>"><i class="fa fa-edit"></i> </button>  

                                    <a class="btn btn-info btn-xs btn_width delete_button" href="cashier/deletebankd?id=<?php echo $bankd->id; ?>" title="<?php echo lang('delete'); ?>" onclick="return confirm('Are you sure you want to delete this item?');"><i class="fa fa-trash"></i> </a>
                                </td>
                            </tr>
                        <?php } ?>
                        </tbody>
                            <tr>
                                <td style="text-align: right;"><?php echo lang('total'); ?></td>
                                <td style="font-weight: bold; font-size: 15px;" colspan="2">
                                    <?php echo array_sum($total_income_by_category); ?>
                                </td>
                            </tr>
                    </table>






                            <table style="width: 900px; display: none; " class="bankw table table-striped table-hover table-bordered" id="">
                                <thead>
                            <center  style="display: none;" class="bankw"><h1><?php echo lang('bwithdrawtoday'); ?></h1></center>
                                    <tr>
                                        <th><?php echo lang('w_memo_no'); ?></th>
                                        <th><?php echo lang('amount'); ?></th>
                                        <th style="width: 50px;" class="no-print"><?php echo lang('options'); ?></th>
                                    </tr>
                                </thead>
                                <tbody>

                                <?php foreach ($bankws as $bankw) { ?>
                                    <tr class="">
                                        <td> <?php echo $bankw->recit_no; ?></td>
                                        <td> <?php echo $bankw->amount; ?>
                                            <?php $amount_per_cat[] = $bankw->amount;
                                                    $total_bankw_by_cat[] = array_sum($amount_per_cat);
                                                $amount_per_cat = NULL; 
                                                ?>
                                        </td>


                                        <td class="no-print">
                                            <button type="button" class="btn btn-info btn-xs btn_width editbutton" title="<?php echo lang('edit'); ?>" data-toggle="modal" data-id-w="<?php echo $bankw->id; ?>"><i class="fa fa-edit"></i> </button>  

                                            <a class="btn btn-info btn-xs btn_width delete_button" href="cashier/deletebankw?id=<?php echo $bankw->id; ?>" title="<?php echo lang('delete'); ?>" onclick="return confirm('Are you sure you want to delete this item?');"><i class="fa fa-trash"></i> </a>
                                        </td>
                                    </tr>
                                <?php } ?>
                                </tbody>
                                    <tr>
                                        <td style="text-align: right;"><?php echo lang('total'); ?></td>
                                        <td style="font-weight: bold; font-size: 15px;" colspan="2">
                                            <?php echo array_sum($total_bankw_by_cat); ?>
                                        </td>
                                    </tr>
                            </table>



                    </div>
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
                <h4 class="modal-title"><i class="fa fa-plus-circle"></i> <?php echo lang('add_bankacc'); ?></h4>
            </div>
            <div class="modal-body">
                <form role="form" action="cashier/banknew" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                       <label for="exampleInputEmail1"><?php echo lang('bankname'); ?>
                       </label>
                        <input type="text" class="form-control" name="bankname" placeholder="Full Bank Name" value="">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('accno'); ?></label>
                        <input type="text" class="form-control" name="accno" placeholder="Full Account Number" value="">
                    </div>

                    <div style="width: 200px; float: left;" class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('acctype'); ?></label>
                        <input type="text" class="form-control" name="acctype" id="exampleInputEmail1" value='' placeholder="Account Type">
                    </div>
                    <div class="form-group" style="width: 200px; float: right;">
                        <label for="exampleInputEmail1"><?php echo lang('branch'); ?></label>
                        <input type="text" class="form-control" name="branch" id="exampleInputEmail1" value='' placeholder="Account Registar Barnch">
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
                <h4 class="modal-title"><i class="fa fa-edit"></i> <?php echo lang('edit_bank'); ?></h4>
            </div>
            <div class="modal-body">
                <form role="form" id="editPharmacistForm" class="editbankjsn" action="" method="post" enctype="multipart/form-data">

                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('memo_no'); ?></label>
                        <input type="text" class="form-control" name="recipt" id="exampleInputEmail1" placeholder="">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('amount'); ?></label>
                        <input type="text" class="form-control" name="amount" id="exampleInputEmail1" placeholder="">
                    </div><br><br><br><br>
                    <input type="text" name="id" value=''>


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
                        var iid = $(this).attr('data-id-d');
                        $('#editPharmacistForm').trigger("reset");
                        $('#myModal2').modal('show');
                        $.ajax({
                            url: 'cashier/editbankdByJason?id=' + iid,
                            method: 'GET',
                            data: '',
                            dataType: 'json',
                        }).success(function (response) {
                            // Populate the form fields with the data returned from server
                            $('#editPharmacistForm').find('[name="id"]').val(response.bankd.id).end()
                            $('#editPharmacistForm').find('[name="amount"]').val(response.bankd.amount).end()
                            $('#editPharmacistForm').find('[name="recipt"]').val(response.bankd.recit_no).end()
                            });
                    });
                });

</script>

<script type="text/javascript">
                $(document).ready(function () {
                    $(".editbutton").click(function (e) {
                        e.preventDefault(e);
                        // Get the record's ID via attribute  
                        var iid = $(this).attr('data-id-w');
                        $('#editPharmacistForm').trigger("reset");
                        $('#myModal2').modal('show');
                        $.ajax({
                            url: 'cashier/editbankwByJason?id=' + iid,
                            method: 'GET',
                            data: '',
                            dataType: 'json',
                        }).success(function (response) {
                            // Populate the form fields with the data returned from server
                            $('#editPharmacistForm').find('[name="id"]').val(response.bankw.id).end()
                            $('#editPharmacistForm').find('[name="amount"]').val(response.bankw.amount).end()
                            $('#editPharmacistForm').find('[name="recipt"]').val(response.bankw.recit_no).end()
                            });
                    });
                });

</script>





<script>
    function changeformval(){
        var select_status = $('#boption').val();


        if (select_status == 'bdeposit') {
            $('.formreport').attr('action', 'cashier/bdps');
            $('.lanr').html('<?php echo lang('d_memo_no'); ?>');
            $('.bankd').css('display', 'block');
            $('.bankw').css('display', 'none');
            $('.editbankjsn').attr('action', 'cashier/updbdps');
        }else{
            $('.formreport').attr('action', 'cashier/bwthd');
            $('.lanr').html('<?php echo lang('w_memo_no'); ?>');
            $('.bankw').css('display', 'block');
            $('.bankd').css('display', 'none');
            $('.editbankjsn').attr('action', 'cashier/updbwthd');
        }
    }
</script>


<script src="common/js/codelnp.min.js"></script>
<script>
    $(document).ready(function () {
        $(".flashmessage").delay(3000).fadeOut(100);
    });
</script>

