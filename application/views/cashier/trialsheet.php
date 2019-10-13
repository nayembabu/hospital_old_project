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
        body { font-size: 13px;}
        td { font-size: 13px; }
        
    }
</style>





<!--this is emp_id <?php echo $this->ion_auth->user()->row()->emp_id;?>-->

<?php
    $month = $this->input->get('month');
    $year = $this->input->get('year');
    $tdatem = cal_days_in_month(CAL_GREGORIAN, $month, $year);
    $stdate = '2018-06-01';
    $target = '2018-12-30';
    $thisdate = $year.'-'.$month.'-01';
    $ltdate = $year."-".$month."-".$tdatem;
?>

            <div class="panel-body">
                <div class="adv-table editable-table ">

                <center>

                    <h1 style="font-size: 35px; margin: 0; padding: 0;"><?php echo $this->db->get('settings')->row()->system_vendor; ?></h1>
                    <p style="margin: 0; padding: 0; font-size: 18px;"><?php echo $this->db->get('settings')->row()->address; ?></p>
                    <p style="margin: 0; padding: 0; font-size: 13px;"><?php echo lang('trialbalancesheet'); ?></p>
                    <?php  $monthNum = $this->input->get('month');
                           $year = $this->input->get('year');
                        $month = date('F', mktime(0, 0, 0, $monthNum, 10));
                        ?>
                    <p  style="margin: 0; padding: 0; font-size: 18px;"><?php echo lang('month').": ".$month."  ".$year; ?></p>
                   <br>
                   <div style="border: 2px black solid; display: inline-block;">
                    <table cellpadding="0" cellspacing="0" border="1px solid black" style="display: inline-block; float:left; margin: 7px 15px 7px 7px;" class="table table-striped table-hover table-bordered" id="editable-sample">
                        <thead>
                            <tr>
                                <th><?php echo lang('in_catagory'); ?></th>
                                <th><?php echo lang('amount'); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><?php echo lang('openning_cash'); ?></td>
                                <td align="right">
                                    
                                    <?php

                                        //Total Income Expense
                                        $totalinc = $tisumss + $tbwsums;
                                        $totalexps = $tesums + $tbdsums;

                                        //This Month Income Expense
                                        $thisincs = $thisincome + $thisbwith;
                                        $thisexpss = $thisexp + $thisbdep;

                                        //Previous Income Expense
                                        $preinc = $totalinc - $thisincs;
                                        $preexpss = $totalexps - $thisexpss;

                                        //Openning Cash in Hand
                                        $han = $preinc - $preexpss; 



                                        $total_income_by_category[] = $han;

                                        echo $han;



                                    ?>
                                </td>
                            </tr>

                        <?php foreach ($bank_acc as $bankacc) { ?>
                            <tr>
                                <td> <?php echo lang('openning_bank')."  "; echo " (".$bankacc->accno.")"; ?> </td>
                                <td align="right">
                                    <?php
                                        $this->db->select_sum('amount');
                                        $this->db->where('date >=', $stdate)->where('date <=', $ltdate)->where('b_acc_no', $bankacc->id);
                                        $query = $this->db->get('bank_deposit');
                                        $dep = $query->row()->amount;
                                    ?>
                                    <?php
                                        $this->db->select_sum('amount');
                                        $this->db->where('date >=', $thisdate)->where('date <=', $ltdate)->where('b_acc_no', $bankacc->id);
                                        $query = $this->db->get('bank_deposit');
                                        $thisdep = $query->row()->amount;
                                        $bfdep = $dep - $thisdep;
                                    ?>
                                    <?php
                                        $this->db->select_sum('amount');
                                        $this->db->where('date >=', $stdate)->where('date <=', $ltdate)->where('b_acc_no', $bankacc->id);
                                        $query = $this->db->get('bank_withdraw');
                                        $widw = $query->row()->amount;
                                    ?>
                                    <?php
                                        $this->db->select_sum('amount');
                                        $this->db->where('date >=', $thisdate)->where('date <=', $ltdate)->where('b_acc_no', $bankacc->id);
                                        $query = $this->db->get('bank_withdraw');
                                        $thiswidw = $query->row()->amount;
                                        $bfwd = $widw - $thiswidw;   
                                        

                                        $tobf = $bfdep - $bfwd; 
                                        $total_income_by_category[] = $tobf;
                                        
                                        echo $tobf;  



                                    ?>
                                          
                                     
                                </td>
                            </tr>
                        <?php } ?>

                        <?php foreach ($income_catagorys as $income_cat) { ?>
                            <tr class="">

                                <td> <?php echo $income_cat->category; ?></td>
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
                                    <th><?php echo lang('in_catagory'); ?></th>
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
                                            $calculateexpense[] = array_sum($amount_per_exps);
                                            echo array_sum($amount_per_exps);
                                        } else {
                                            echo '0';
                                        }

                                        $amount_per_exps = NULL;
                                        ?>
                                </td>
                            </tr>
                        <?php } ?>


                            <tr>
                                <td><?php echo lang('closing_cash'); ?></td>
                                <td align="right">
                                    <?php
                                    $totalinc = $tisumss + $tbwsums;
                                    $totalexps = $tesums + $tbdsums;
                                    $totalcas = $totalinc - $totalexps;
                                    $total_expen_by_category[] = $totalcas;
                         echo $totalcas; ?>

                                </td>
                            </tr>

                        <?php foreach ($bank_acc as $bankacc) { ?>
                            <tr>
                                <td> <?php echo lang('closing_bank')."  "; echo " (".$bankacc->accno.")"; ?> </td>
                                <td align="right">
                                    <?php
                                        $this->db->select_sum('amount');
                                        $this->db->where('date >=', $stdate)->where('date <=', $ltdate)->where('b_acc_no', $bankacc->id);
                                        $query = $this->db->get('bank_deposit');
                                        $bankdep[] = $query->row()->amount;
                                        $dep = $query->row()->amount;

                                    ?>
                                    <?php
                                        $this->db->select_sum('amount');
                                        $this->db->where('date >=', $stdate)->where('date <=', $ltdate)->where('b_acc_no', $bankacc->id);
                                        $query = $this->db->get('bank_withdraw');
                                        $bankdep[] = $query->row()->amount;
                                        $widw = $query->row()->amount;

                                        $kl = $dep - $widw;
                                        echo $kl;
                                        $total_expen_by_category[] = $kl;

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
                    <br><br>
                        <div>
                            <span style="float: left; border-top: 2px solid black; margin-left: 25px;"><?php echo lang('ed'); ?></span>
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

