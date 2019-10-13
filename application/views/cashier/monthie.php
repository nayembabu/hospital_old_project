<!-- <script type="text/javascript"> 
    document.open();
    document.write();
    document.close();
    window.focus();
    window.print();
    window.close();
</script>
 -->



<!--sidebar end-->
<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">
        <!-- page start-->
        <section class="panel">


<style type="text/css">
    @media print {
        @page { margin:0; }
        body { font-size: 14px;}
        td { font-size: 14px; }
        
    }
</style>






<!--this is emp_id <?php echo $this->ion_auth->user()->row()->emp_id;?>-->

            <div class="panel-body">
                <div class="adv-table editable-table ">

                <center>

                    <h1 style="font-size: 50px; margin: 0; padding: 0;"><?php echo $this->db->get('settings')->row()->system_vendor; ?></h1>
                    <p style="margin: 0; padding: 0; font-size: 25px;"><?php echo $this->db->get('settings')->row()->address; ?></p>
                    <p style="margin: 0; padding: 0; font-size: 20px;"><?php echo lang('month_payment_receive_report'); ?></p>
                    <?php  $monthNum = $this->input->get('month');
                     	   $year = $this->input->get('year');
						$month = date('F', mktime(0, 0, 0, $monthNum, 10));
                        ?>
                    <p  style="margin: 0; padding: 0; font-size: 25px;"><?php echo lang('month').": ".$month."  ".$year; ?></p>
                   <br>
                   <div style="border: 3px black solid; display: inline-block;">
                    <table cellpadding="0" cellspacing="0" border="1px solid black" style="display: inline-block; float:left; margin: 7px 15px 7px 7px;" class="table table-striped table-hover table-bordered" id="editable-sample">
                        <thead>
                            <tr>
                                <th><?php echo lang('income_catagory'); ?></th>
                                <th><?php echo lang('amount'); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($income_catagorys as $income_cat) { ?>
                            <tr class="">
                                <td> <?php echo $income_cat->category; ?></td>
                                <!-- start loop -->
                                <td align="right">
                                	<?php
                                        foreach ($incomes as $income) {

                                        	if (($income_cat->id == $income->cat_id)) {
                                                $amount_per_category[] = $income->amount;

                                            }
                                        }
                                        if (!empty($amount_per_category)) {
                                            $total_income_by_category[] = array_sum($amount_per_category);
                                            echo array_sum($amount_per_category);
                                        } else {
                                            echo '0';
                                        }

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
                        </table>
                        <table cellpadding="0" cellspacing="0" border="1px solid black" style="float:left; display: inline-block;  margin: 7px 7px 7px 0px;" class="table table-striped table-hover table-bordered" id="editable-sample">
                            <thead>
                                <tr>
                                    <th><?php echo lang('expense_catagory'); ?></th>
                                    <th><?php echo lang('amount'); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                        <?php foreach ($expense_catagorys as $expense_cat) { ?>
                            <tr class="">
                                <td> <?php echo $expense_cat->category; ?></td>
                                <!-- start loop -->
                                <td align="right">
                                	<?php
                                        foreach ($expens as $expen) {

                                        	if (($expense_cat->id == $expen->cat_id)) {
                                                $amount_per_exps[] = $expen->amount;

                                            }
                                        }
                                        if (!empty($amount_per_exps)) {
                                            $total_expen_by_category[] = array_sum($amount_per_exps);
                                            echo array_sum($amount_per_exps);
                                        } else {
                                            echo '0';
                                        }

                                        $amount_per_exps = NULL;
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
                        </table>
                    </div><br>
                    <table cellpadding="0" cellspacing="0" border="1px" style="margin: 10px 0 0 260px;">
                        
                        <tr>
                            <td><?php echo lang('monthincome'); ?></td>
                            <td style="font-size: 18px; font-weight: bold;" align="right">
                                <?php $incomesum = array_sum($total_income_by_category);
                                    echo $incomesum; ?>
                            </td>
                        </tr>
                        <tr>
                            <td><?php echo lang('monthexpense'); ?></td>
                            <td style="font-size: 18px; font-weight: bold; " align="right">
                                <?php $expensum = array_sum($total_expen_by_category); 
                                    echo $expensum; ?>
                            </td>
                        </tr>
                        <tr>
                            <td><?php echo lang('totalmonthincome'); ?></td>
                            <td align="right" style="font-size: 24px; font-weight: bold;">
                                <?php
                                    $totalcash = $incomesum - $expensum;
                                    echo $totalcash;
                                    ?>
                            </td>
                        </tr>
                    </table>
                    <br><br>
                        <div>
                            <span style="float: left; border-top: 2px solid black;  margin-left: 25px;"><?php echo lang('ed'); ?></span>
                            <span style="float: left; margin-left: 100px; border-top: 2px solid black"><?php echo lang('manager'); ?></span>
                            <span style="float: left; border-top: 2px solid black;margin-left: 100px;"><?php echo lang('c.account'); ?></span>
                            <span style="float: left; margin-left: 100px; border-top: 2px solid black"><div style="font-weight: bold;"><?php
                                    $this->db->where('emp_id', $this->ion_auth->user()->row()->emp_id);
                                    $query = $this->db->get('nurse');
                                    $eml = $query->row();
                                        if($query->num_rows > 0 ) {
                                            echo  $eml->ename;}
                                            ?></div>
                                    
                                <?php
                                    $this->db->where('emp_id', $this->ion_auth->user()->row()->emp_id);
                                    $query = $this->db->get('empinfo');
                                    $eml = $query->row();
                                        if($query->num_rows > 0 ) {
                                            echo  $eml->desig;}
                                  ?></span>
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



<script>
    $(document).ready(function () {
        $(".flashmessage").delay(3000).fadeOut(100);
    });
</script>

