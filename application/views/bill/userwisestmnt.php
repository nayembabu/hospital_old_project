


                <center>
                    <h1 style="font-size: 50px; margin: 0; padding: 0;"><?php echo $this->db->get('settings')->row()->system_vendor; ?></h1>
                    <p style="margin: 0; padding: 0; font-size: 25px;"><?php echo $this->db->get('settings')->row()->address; ?></p>
                    <p style="margin: 0; padding: 0; font-size: 25px;"><?php echo lang('indoor').' '.lang('statement'); ?></p>
                   <br>
                </center><br><br>


    <?php 
        foreach ($rcvbiiil as $rbl) {
            $trbl[] = $rbl->bill_cat_taka;
        }

        $rcvBl1 = array_sum($trbl);
        echo $rcvBl1;
     ?>

                <table border="1px">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Doctor's Name</th>
                        <th>Bed No</th>
                        <th>Created Bill</th>
                        <th>Discount</th>
                        <th>Bill Commission</th>
                        <th>Receive Bill</th>
                    </tr>
                    <?php foreach ($ptninfo as $pinf) { ?>
                        <tr>
                            <td><?php echo $pinf->patient_id; ?></td>
                            <td><?php echo $pinf->ptnname; ?></td>
                            <td><?php echo $pinf->drname; ?></td>
                            <td><?php echo $pinf->b_num; ?></td>
                            <td><?php 
                                foreach ($b_cr_sum as $crtbll) { 
                                    if ($crtbll->p_serial == $pinf->id) {
                                        $crtBill[] = $crtbll->bill_taka;
                                        $crBli[] = $crtbll->bill_taka;
                                    } 
                                }  

                                foreach ($cmsbl as $cbl) {
                                    if ($cbl->p_iid == $pinf->id) {
                                        $cmcbl[] = $cbl->nd_cummis_tk;
                                    }
                                }

                                foreach ($rcvbiiil as $rcvbl) {
                                    if ($rcvbl->p_iid == $pinf->id) {
                                        $rcvbll[] = $rcvbl->bill_cat_taka;
                                        $rcbl[] = $rcvbl->bill_cat_taka;
                                    }
                                }

                                echo array_sum($crtBill);
                                    $crtBill = NULL;

                                ?></td>
                            <td><?php
                                $pdiscnt = array_sum($crBli) - (array_sum($cmcbl) + array_sum($rcvbll));
                                echo $pdiscnt;
                                $crBli = NULL;
                                ?></td>
                            <td><?php 
                                echo array_sum($cmcbl);
                                    $cmcbl = NULL; ?>                                
                            </td>
                            <td><?php 
                                echo array_sum($rcvbll);
                                    $rcvbll = NULL; ?>                                
                            </td>
                        </tr>
                    <?php } ?>
                        <tr>
                            <td colspan="7">Total Receive Indoor Bill</td>
                            <td><?php echo array_sum($rcbl); ?></td>
                        </tr>
                </table>



                <table border="1px">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Services Date</th>
                        <th>Created Bill</th>
                        <th>Bill Commission</th>
                        <th>Receive Bill</th>
                    </tr>
                    <?php foreach ($outptnsr as $ops) { ?>
                        <tr>
                            <td><?php echo $ops->out_p_iid; ?></td>                    
                            <td><?php echo $ops->out_p_name; ?></td>
                            <td><?php echo $ops->add_date; ?></td> 
                        <?php foreach ($b_com_sum as $commisn_sum) { 

                            if (($ops->out_p_iid == $commisn_sum->out_p_iid)) {
                                $out_bll_cumm[] = $commisn_sum->nd_cummis_tk;
                            }

                         } ?>
                        <?php foreach ($b_recv_sum as $recevd_sum) { 

                            if (($ops->out_p_iid == $recevd_sum->out_p_iid)) {
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
                            <th colspan="5" align="right">Total Received Taka</th>
                            <td align="right"><?php echo array_sum($out_bl_taka);?></td>
                        </tr>




                </table>














