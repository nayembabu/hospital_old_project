<!--sidebar end-->
<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">
        <!-- page start-->
        <section class="panel">

<style type="text/css">
    @media print {
        @page { margin:0; }
        body { margin: 1.6cm; }
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
                    <table cellpadding="1px" cellspacing="1px" border="1px solid black" style="float:left; display: inline-block;  margin: 7px 7px 7px 7px;" class="table table-striped table-hover table-bordered" id="editable-sample">
                        <thead>
                            <tr>
                                <th><?php echo lang('dpst_date'); ?></th>
                                <th><?php echo lang('acc_no'); ?></th>
                                <th><?php echo lang('amount'); ?></th>
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


                        <?php foreach ($bankdpss as $bankdp) { ?>
                            <tr class="">
                                <td> <?php echo $bankdp->date; ?></td>
                                <td> <?php
                                    $this->db->where('id', $bankdp->b_acc_no);
                                    $query = $this->db->get('bank_account');
                                    $eml = $query->row();
                                        if($query->num_rows > 0 ) {
                                            echo  $eml->accno;} ?></td>
                                <td align="right"> <?php echo $bankdp->amount;?>
                                    <?php $amount_per_category[] = $bankdp->amount;
                                            $total_income_by_category[] = array_sum($amount_per_category);
                                        $amount_per_category = NULL; 
                                        ?>
                                </td>

                            </tr>
                        <?php } ?>
                        </tbody>
                            <tr>
                                <td colspan="2" style="text-align: right;"><?php echo lang('total'); ?></td>
                                <td align="right" style="font-weight: bold; font-size: 18px;" >
                                    <?php echo array_sum($total_income_by_category); ?>
                                </td>

                            </tr>
                        </table>
                        <table cellpadding="1px" cellspacing="1px" border="1px solid black" style="float:left; display: inline-block;  margin: 7px 7px 7px 0px;" class="table table-striped table-hover table-bordered" id="editable-sample">
                            <thead>
                                <tr>
                                    <th><?php echo lang('wdst_date'); ?></th>
                                    <th><?php echo lang('acc_no'); ?></th>
                                    <th><?php echo lang('amount'); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                            <?php foreach ($bankwdss as $bankwd) { ?>
                                    <td> <?php echo $bankwd->date; ?></td>
                                    <td> <?php
                                    $this->db->where('id', $bankwd->b_acc_no);
                                    $query = $this->db->get('bank_account');
                                    $eml = $query->row();
                                        if($query->num_rows > 0 ) {
                                            echo  $eml->accno;} ?></td>
                                    <td align="right"> <?php echo $bankwd->amount; ?>
                                        <?php $amount_per_category[] = $bankwd->amount;
                                                $total_expen_by_category[] = array_sum($amount_per_category);
                                            $amount_per_category = NULL; 
                                            ?>
                                    </td>
                                </tr>
                            <?php } ?>
                            </tbody>
                                <tr>
                                    <td colspan="2" style="text-align: right;"><?php echo lang('total'); ?></td>
                                    <td align="right" style="font-weight: bold; font-size: 18px;" >
                                        <?php echo array_sum($total_expen_by_category); ?>
                                    </td>
                                </tr>
                        </table>
                    </div><br><br>

                    <!--
                    <table border="1px" style="margin-left: 240px;">
                        <tr>
                            <td><?php echo lang('bankdepos'); ?></td>
                            <td align="right"><?php $incomesum = array_sum($total_income_by_category);
                                    echo $incomesum; ?></td>
                        </tr>
                        <tr>
                            <td><?php echo lang('bankwith'); ?></td>
                            <td align="right"><?php $expensum = array_sum($total_expen_by_category); 
                                    echo $expensum; ?></td>
                        </tr>
                        <tr>
                            <td><?php echo lang('monthbank'); ?></td>
                            <td align="right" style="font-size: 24px; font-weight: bold;">
                                <?php
                                    $totalcash = $incomesum - $expensum;
                                    echo $totalcash;
                                    ?>
                            </td>
                        </tr>
                        <tr>
                            <td><?php echo lang('cashinhand'); ?></td>
                            <td align="right" style="font-size: 24px; font-weight: bold;">
                                <?php
                                //here Total Bank Amount
                                    ?>
                            </td>
                        </tr>
                    </table>-->
                    <br><br><br><br><br><br><br>
                        <div>
                            <span style="float: left; border-top: 2px solid black"><?php echo lang('ed'); ?></span>
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

