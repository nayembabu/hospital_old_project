<script type="text/javascript"> 
    document.open();
    document.write();
    document.close();
    window.focus();
    window.print();
    window.close();
</script>







<!--sidebar end-->
<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">
        <!-- page start-->
        <section class="panel">

<style type="text/css">
    @media print {
        @page { margin:0; }
        body { margin: 1cm; }
    }
</style>









<!--this is emp_id <?php echo $this->ion_auth->user()->row()->emp_id;?>-->

            <div class="panel-body">
                <div class="adv-table editable-table ">

                <center>

                    <h1 style="font-size: 50px; margin: 0; padding: 0;"><?php echo $this->db->get('settings')->row()->system_vendor; ?></h1>
                    <p style="margin: 0; padding: 0; font-size: 25px;"><?php echo $this->db->get('settings')->row()->address; ?></p>
                    <p style="margin: 0; padding: 0; font-size: 20px;"><?php echo lang('payment_receive_report'); ?></p><br>
                    <?php  $date = $this->input->get('date');
                        $str = strtotime($date);
                        ?>
                    <p style="margin: 0 0 0 65px; padding: 0; font-size: 18px; float: left;"><?php echo lang('date').": ".date('d-M-Y', $str); ?></p>
                    <p style="float: right; margin: 0 60px 0 0; padding: 0; font-size: 18px;"><?php echo lang('day').": ".date('l', $str); ?></p>
                   <br><br>
                   <div style="border: 3px black solid; display: inline-block;">
                    <table cellpadding="1px" cellspacing="1px" border="1px solid black" style="float:left; display: inline-block;  margin: 7px 7px 7px 7px;" class="table table-striped table-hover table-bordered" id="editable-sample">
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
                        </table>
                        <table cellpadding="1px" cellspacing="1px" border="1px solid black" style="float:left; display: inline-block;  margin: 7px 7px 7px 0px;" class="table table-striped table-hover table-bordered" id="editable-sample">
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
                        </table>
                    </div><br><br>
                    <table border="1px" style="margin-left: 240px;">
                        <?php foreach ($bankws as $bankw) { ?>
                                <?php $amount_per_bwd[] = $bankw->amount;
                                            $total_bankwd[] = array_sum($amount_per_bwd);
                                        $amount_per_bwd = NULL; 
                                        ?>
                        <?php } ?>
                        <?php foreach ($bankds as $bankd) { ?>
                                <?php $amount_per_cat[] = $bankd->amount;
                                            $total_bank_by_cat[] = array_sum($amount_per_cat);
                                        $amount_per_cat = NULL; 
                                        ?>
                        <?php } ?>
                        <?php
                                $bankdpsum = array_sum($total_bank_by_cat);
                                $bankwdsum = array_sum($total_bankwd);
                                $incomesum = array_sum($total_income_by_category);
                                $expensum = array_sum($total_expen_by_category);
                                    $grandtotalincome = $incomesum + $bankwdsum;
                                    $granincome = $grandtotalincome;
                                    $grandtotalexpense = $expensum + $bankdpsum;
                                    $granexpense = $grandtotalexpense;
                                    $totalinc = $tisumss + $tbwsums;
                                    $totalexps = $tesums + $tbdsums;
                                    $totalcas = $totalinc - $totalexps;
                                    $totalcash = $granincome - $granexpense;
                                    $yesbf = $totalcas - $totalcash;?>

                        <tr>
                            <td><?php echo lang('bf'); ?></td>
                            <td align="right" style="font-size: 24px; font-weight: bold;">
                                   <?php echo $yesbf;
                                    ?>
                            </td>
                        </tr>



                        <tr>
                            <td><?php echo lang('todayincome'); ?></td>
                            <td align="right"><?php
                                    echo $incomesum; ?></td>
                        </tr>
                        <tr>
                            <td><?php echo lang('todaybankwith'); ?></td>
                            <td align="right">
                        <?php 
                            echo $bankwdsum; ?>
                            </td>
                        </tr>
                        <tr>
                            <td><?php echo lang('totalincome'); ?></td>
                            <td style="font-size: 18px; font-weight: bold;" align="right">
                                <?php
                                    echo $granincome + $yesbf;
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td><?php echo lang('todayexpense'); ?></td>
                            <td align="right"><?php  
                                    echo $expensum; ?></td>
                        </tr>
                        <tr>
                            <td><?php echo lang('todaybankdepos'); ?></td>
                            <td align="right">
                        <?php 
                            echo $bankdpsum; ?>
                                
                            </td>
                        </tr>
                        <tr>
                            <td><?php echo lang('totalexpense'); ?></td>
                            <td style="font-size: 18px; font-weight: bold; " align="right">
                                <?php
                                    echo $granexpense;
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td><?php echo lang('cashinhand'); ?></td>
                            <td align="right" style="font-size: 24px; font-weight: bold;">
                                <?php
                                    echo $totalcas;
                                    ?>
                            </td>
                        </tr>
                    </table>
                    <br><br><br><br><br><br><br>
                        <div>
                            <span style="float: left; border-top: 2px solid black"><?php echo lang('ed'); ?></span>
                            <span style="float: left; margin-left: 100px; border-top: 2px solid black"><?php echo lang('manager'); ?></span>
                            <span style="float: left; border-top: 2px solid black;margin-left: 100px;"><?php echo lang('c.account'); ?></span>
                            <span style="float: left; margin-left: 65px; border-top: 2px solid black"><div style="font-weight: bold;"><?php
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

