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

                <form style="margin: -25px -15px -32px -16px; padding: 0" role="form" class="f_report" action="cashier/dailyst" method="post" enctype="multipart/form-data">
                        <div align="center" class="form-group">
                            
                                <div class="input-group input-large" data-date="13/07/2018" data-date-format="mm/dd/yyyy">
                                    <input type="text" class="form-control dtpic" name="date" value="" placeholder="<?php echo lang('date'); ?>">
                                   
                                <button type="submit" name="submit" class="btn btn-info range_submit"><?php echo lang('submit'); ?></button>

                                </div>
                            </div>
                         </form><br><br>
                <center>

                <?php if (!empty($incomes) && !empty($expens)) {?>
                    <table style="display: inline-block; margin: 7px 15px 7px 7px; width: 20%" class="table table-striped table-hover table-bordered">
                        <thead>
                            <tr>
                                <th><?php echo lang('income_catagory'); ?></th>
                                <th><?php echo lang('amount'); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($incomes as $income) { ?>
                            <tr class="">
                                <td> <?php echo $income->category; ?></td>
                                <td align="right"> <?php echo $income->amount;?>
                                    <?php $amount_per_category[] = $income->amount;
                                            $amount_per_incategory[] = $income->amount;
                                        $countincat = count($amount_per_incategory);
                                            $total_income_by_category[] = array_sum($amount_per_category);
                                        $amount_per_category = NULL; 
                                        ?>
                                </td>

                            </tr>
                        <?php } ?>
                        </tbody>
                            <tr>
                                <td style="text-align: right;"><?php echo lang('total'); ?></td>
                                <td align="right" style="font-weight: bold; font-size: 18px;" >
                                    <?php echo array_sum($total_income_by_category); ?>
                                </td>

                            </tr>
                            <tr>
                                <td colspan="2" style="font-weight: bold; font-size: 14px;">Total <?php echo $countincat; ?> Catagory</td>
                            </tr>
                        </table>
                        <table style="display: inline-block;  margin: 7px 7px 7px 0px; width: 20%" class="table table-striped table-hover table-bordered">
                            <thead>
                                <tr>
                                    <th><?php echo lang('expense_catagory'); ?></th>
                                    <th><?php echo lang('amount'); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                            <?php foreach ($expens as $expen) { ?>
                                    <td> <?php echo $expen->category; ?></td>
                                    <td align="right"> <?php echo $expen->amount; ?>
                                        <?php $amount_per_category[] = $expen->amount;
                                            $amount_per_excategory[] = $expen->amount;
                                        $countexcat = count($amount_per_excategory);
                                                $total_expen_by_category[] = array_sum($amount_per_category);
                                            $amount_per_category = NULL; 
                                            ?>
                                    </td>
                                </tr>
                            <?php } ?>
                            </tbody>
                                <tr>
                                    <td style="text-align: right;"><?php echo lang('total'); ?></td>
                                    <td align="right" style="font-weight: bold; font-size: 18px;" >
                                        <?php echo array_sum($total_expen_by_category); ?>
                                    </td>
                                </tr>
                            <tr>
                                <td colspan="2" style="font-weight: bold; font-size: 14px;">Total <?php echo $countexcat; ?> Catagory</td>
                            </tr>
                        </table>
                    </div>
                </center>
                    <br><br><br><br>
                        <center><button class="btn btn-primary" onclick="window.open('cashier/dailyprint?date=<?php echo $income->date;?>', '_blank', 'height=800,width=800')">Print Statement</button></center> 
                    <?php } ?>
                       






                </div>
            </div>
        </section>
        <!-- page end-->
    </section>
</section>
<!--main content end-->
<!--footer start-->



<script>
    $(document).ready(function () {
        $(".flashmessage").delay(3000).fadeOut(100);
    });
</script>

