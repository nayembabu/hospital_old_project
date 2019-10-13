

<style type="text/css">
    * {
        font-size: 14px;
    }
</style>



                <center>
                    <h1 style="font-size: 50px; margin: 0; padding: 0;"><?php echo $this->db->get('settings')->row()->system_vendor; ?></h1>
                    <p style="margin: 0; padding: 0; font-size: 25px;"><?php echo $this->db->get('settings')->row()->address; ?></p>
                    <p style="margin: 0; padding: 0; font-size: 25px;"><?php echo lang('indoor').' '.lang('statement'); ?></p>
                    <p style="margin: 0; padding: 0; font-size: 25px;"><?php echo 'Date: '.date('d-F-Y', strtotime($date)); ?></p>
                   <br>
                </center><br>



                <table border="1px">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Doctor's Name</th>
                        <th>Bed No</th>
                        <th>Employee</th>
                        <th>Created Bill</th>
                        <th>Discount</th>
                        <th>Bill Commission</th>
                        <th>Receive Bill</th>
                    </tr>
                    <?php foreach ($cnt_opt as $cnt) { ?>
                        <tr>
                            <td><?php echo $cnt->patient_id; ?></td>
                            <td><?php echo $cnt->ptnname; ?></td>
                            <td style="font-size: 10px;"><?php echo $cnt->drname; ?></td>
                            <td><?php echo $cnt->b_num; ?></td>
                            <td><?php echo $cnt->ename; ?></td>


                        <?php foreach ($b_cr_sum as $bill_sum) {
                            if (($cnt->id == $bill_sum->p_serial)) {
                                $tl_cr_b_sum[] = $bill_sum->bill_taka;
                            }
                        } ?>


                        <?php foreach ($b_com_sum as $com_sum) {
                            if (($cnt->id == $com_sum->p_iid)) {
                                $b_cums_tk[] = $com_sum->nd_cummis_tk;
                            }
                        } ?>

                        <?php foreach ($b_recv_sum as $recv_sum) {
                            if (($cnt->id == $recv_sum->p_iid)) {
                                $bill_rrr_taka[] = $recv_sum->bill_cat_taka;
                                $bilRcvTKk[] = $recv_sum->bill_cat_taka;
                            }
                        } ?>

                        <?php $recev_bill = array_sum($b_cums_tk) + array_sum($bill_rrr_taka);
                                        $bil_discnt = array_sum($tl_cr_b_sum) - $recev_bill; ?>



                            <td align="right">
                        <?php
                            if (!empty($tl_cr_b_sum)) {
                                $total_cr_bill[] = array_sum($tl_cr_b_sum);
                                echo array_sum($tl_cr_b_sum);
                            } else {
                                echo '0';
                            }
                            $tl_cr_b_sum = NULL; ?>
                            </td>


                            <td align="right">
                            <?php echo $bil_discnt; ?></td>

                            <td align="right">
                        <?php
                            if (!empty($b_cums_tk)) {
                                $bill_cums_tk[] = array_sum($b_cums_tk);
                                echo array_sum($b_cums_tk);
                            } else {
                                echo '0';
                            }
                            $b_cums_tk = NULL; ?>

                            </td>



                            <td align="right">
                        <?php
                            if (!empty($bill_rrr_taka)) {
                                $bill_ccccccc_taka[] = array_sum($bill_rrr_taka);
                                echo array_sum($bill_rrr_taka);
                            } else {
                                echo '0';
                            }
                            $bill_rrr_taka = NULL; ?>

                            </td>

                        </tr>
                    <?php } ?>
                        <tr>
                            <th colspan="8" align="right">Total Received Taka</th>
                            <td align="right" style="font-size: 20px; font-weight: bold;"><?php echo array_sum($bill_ccccccc_taka);?></td>
                        </tr>
                </table>

<center><h2>Out Service Statement</h2></center>

                <table border="1px">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Services Date</th>
                        <th>Employee</th>
                        <th>Created Bill</th>
                        <th>Bill Commission</th>
                        <th>Receive Bill</th>
                    </tr>
                    <?php foreach ($out_p_r as $out_p_sl) { ?>
                        <tr>
                            <td><?php echo $out_p_sl->out_p_iid; ?></td>                    
                            <td><?php echo $out_p_sl->out_p_name; ?></td>
                            <td><?php echo $out_p_sl->add_date; ?></td> 
                            <td><?php echo $out_p_sl->ename; ?></td> 
                        <?php foreach ($b_com_sum as $commisn_sum) { 

                            if (($out_p_sl->out_p_iid == $commisn_sum->out_p_iid)) {
                                $out_bll_cumm[] = $commisn_sum->nd_cummis_tk;
                            }

                         } ?>
                        <?php foreach ($b_recv_sum as $recevd_sum) { 

                            if (($out_p_sl->out_p_iid == $recevd_sum->out_p_iid)) {
                                $out_bll_rcv_tk[] = $recevd_sum->bill_cat_taka;
                            }

                         } ?>

                         <?php $ouuuuuuu[] = array_sum($out_bll_cumm) + array_sum($out_bll_rcv_tk);
                            $out_cr_bill = array_sum($out_bll_cumm) + array_sum($out_bll_rcv_tk);
                            ?>



                            <td><?php echo $out_cr_bill;?></td>

                            <td align="right">                              
                            <?php
                                if (!empty($out_bll_cumm)) {
                                    $bill_ccccccc_taka[] = array_sum($out_bll_cumm);
                                    echo array_sum($out_bll_cumm);
                                } else {
                                    echo '0';
                                }
                                $out_bll_cumm = NULL; ?>
                            </td>



                            <td align="right">                              
                            <?php
                                if (!empty($out_bll_rcv_tk)) {
                                    $out_bl_taka[] = array_sum($out_bll_rcv_tk);
                                    echo array_sum($out_bll_rcv_tk);
                                } else {
                                    echo '0';
                                }
                                $out_bll_rcv_tk = NULL; ?>
                            </td>
                        </tr>
                    <?php } ?>
                        <tr>
                            <th colspan="6" align="right">Total Received Taka</th>
                            <td align="right" style="font-size: 20px; font-weight: bold;"><?php echo array_sum($out_bl_taka);?></td>
                        </tr>
                </table>

<?php
    $indrttll = array_sum($bilRcvTKk);
    $outsrtll = array_sum($out_bl_taka);
    $ttlstmt = $indrttll + $outsrtll;
?>


<table border="1px">
    <tr>
        <th >Total Indoor Taka</th>
        <td align="right"><?php echo $indrttll;?></td>
    </tr>

    <tr>
        <th>Total Out Services Taka</th>
        <td align="right"><?php echo $outsrtll;?></td>
    </tr>
    <tr>
        <th>Total Todays Received Bill </th>
        <td style="font-size: 25px; font-weight: bold;"><?php echo $ttlstmt; ?></td>
    </tr>

</table> 


                <br><br><br><br>
            <div>
                <h4 style="float: left; margin: 0; border-top: 2px solid black;">Reception</h4>
                <h4 style="float: left; margin: 0 0 0 100px; border-top: 2px solid black;">Accountant</h4>
                <h4 style="float: left; margin: 0 0 0 100px; border-top: 2px solid black;">Manager</h4>
                <h4 style="float: left; margin: 0 0 0 150px; border-top: 2px solid black;">Managing Partner</h4>
            </div>



