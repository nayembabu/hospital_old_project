
<style type="text/css">
    * {
        margin-top: 8px;
        padding: 0;
        font-size: 18px;
    }
    .dptnam {
        width: 180px;
    }
    .ttlbllss {
        width: 120px;
    }
</style>


                <?php 
                    foreach ($in_cum_bill as $cumb) {
                        if ($cumb->p_stas == 'indoor' || $cumb->p_stas == 'out_ser' || $cumb->p_stas == 'obsn' ) {
                            $indbCum[] = $cumb->nd_cummis_tk;
                        }else if ($cumb->p_stas == 'dntlser') {
                            $dntlCum[] = $cumb->nd_cummis_tk;
                        }else  if ($rbl->p_stas == 'dnc' || $rbl->p_stas == 'nvd' || $rbl->p_stas == 'ot' ) { 
                            $otbCum[] = $cumb->nd_cummis_tk;
                        }
                        if ($cumb->p_stas == 'out_ser') {
                            $outcum[] = $cumb->nd_cummis_tk;
                        }
                    }

                    foreach ($in_r_bill as $rbl) {
                        if ($rbl->p_stas == 'indoor' || $rbl->p_stas == 'out_ser' || $rbl->p_stas == 'obsn' ) {
                            $RBcl[] = $rbl->bill_cat_taka;
                                        $ttlindbll[] = $tlindbl->bill_taka;  
                        }else if ($rbl->p_stas == 'dntlser') {
                            $dntlarbil[] = $rbl->bill_cat_taka;
                        }else if ($rbl->p_stas == 'dnc' || $rbl->p_stas == 'nvd' || $rbl->p_stas == 'ot' ) {
                            $otindrbil[] = $rbl->bill_cat_taka;                          
                        }

                        if ($cumb->p_stas == 'out_ser') {
                            $outRbl[] = $cumb->nd_cummis_tk;
                        }

                    }


                    foreach ($cnt_opt as $ptnbill) {
                        if ($ptnbill->p_stus == 'indoor' || $rbl->p_stus == 'out_ser' || $rbl->p_stus == 'obsn' ) {
                        foreach ($in_ttl_bill as $tlindbl) {
                            if ($ptnbill->id == $tlindbl->p_serial) {
                                $indttlbil[] = $tlindbl->bill_taka;
                            }
                        }
                            
                        }else {
                        foreach ($in_ttl_bill as $tlindbl) {
                            if ($ptnbill->id == $tlindbl->p_serial) {
                                $ootttlbil[] = $tlindbl->bill_taka;
                            }
                        }

                        }

                    }

                    $ttlindcum = array_sum($indbCum);
                    $otttlindbbbbl = array_sum($ootttlbil);

                    $ttlotcum = array_sum($otbCum);
                    $totalindr = array_sum($RBcl);

                    $ottotal = array_sum($otindrbil);
                    $indttlbl = array_sum($indttlbil);

                    $talindbl = $ttlindbllb + $out_bill;



                     $outcumm = array_sum($outcum);
                     $outrbil = array_sum($outRbl);
                     $totalcrbllll = $indttlbl + $outcumm + $outrbil;



                     $inddisc = $totalcrbllll - ($totalindr + $ttlindcum);
                     $ootdisc = $otttlindbbbbl - ($ottotal + $ttlotcum);



                     $dntlcumttl = array_sum($dntlCum);
                     $dntlrcvbll = array_sum($dntlarbil);
                     $ttldntltk = $dntlrcvbll + $dntlcumttl;





                ?>

                <center>
                    <h1 style="font-size: 50px; margin: 0; padding: 0;"><?php echo $this->db->get('settings')->row()->system_vendor; ?></h1>
                    <p style="margin: 0; padding: 0; font-size: 20px;"><?php echo $this->db->get('settings')->row()->address; ?></p>
                    <p style="margin: 0; padding: 0; font-size: 16px;">Phone: <?php echo $this->db->get('settings')->row()->phone; ?></p>
                    <p style="margin: 10px 0 10px 0; padding: 0; font-size: 25px; "><?php echo lang('indoor').' '.lang('statement'); ?></p>
                    <p style="margin: 0; padding: 0; font-size: 25px;"><?php echo 'Date: '.date('d-F-Y', strtotime($date)); ?></p>
                   <br>
                </center>



                

                <table border="1px">
                    <tr>
                        <th class="dptnam" align="center">Department Name</th>
                        <th class="ttlbllss" align="center">Total Bill</th>
                        <th align="center">Total Discount</th>
                        <th align="center">Total Cumission</th>
                        <th align="center">Received Amount</th>
                    </tr>
                    <tr>
                        <td>INDOOR</td>
                        <td align="right"><?php if ($indttlbl == '') {
                            echo "0";
                        }else echo $totalcrbllll.'/='; ?></td>
                        <td align="right" ><?php if ($inddisc == '') {
                            echo "0";
                        }else echo $inddisc.'/='; ?></td>
                        <td align="right"><?php if ($ttlindcum == '') {
                            echo "0 ";
                        }else echo $ttlindcum.'/= '; ?></td>
                        <td align="right"><?php if ($totalindr == '') {
                            echo "0 ";
                        }else echo $totalindr.'/= '; ?></td>
                    </tr>
                    <tr>
                        <td>O.T</td>
                        <td align="right"><?php if ($otttlindbbbbl <= '') {
                            echo "0";
                        }else echo $otttlindbbbbl.'/=';?></td>
                        <td align="right"><?php if ($ootdisc <= '') {
                            echo "0";
                        }else echo $ootdisc.'/='; ?></td>
                        <td align="right"><?php if ($ttlotcum <= '') {
                            echo "0 ";
                        }else echo $ttlotcum.'/= '; ?></td>
                        <td align="right"><?php if ($ottotal <= '') {
                            echo "0 ";
                        }else echo $ottotal.'/= '; ?></td>
                    </tr>
                    <tr>
                        <td>DENTAL S.CHARGE</td>
                        <td align="right"><?php if ($ttldntltk == '') {
                            echo "0";
                        }else echo $ttldntltk.'/=';?></td>
                        <td align="right">0</td>
                        <td align="right"><?php if ($dntlcumttl == '') {
                            echo "0";
                        }else echo $dntlcumttl.'/=';?></td>
                        <td align="right"><?php if ($dntlrcvbll == '') {
                            echo "0";
                        }else echo $dntlrcvbll.'/=';?></td>
                    </tr>
                    <tr>
                        <td colspan="4" align="right">Todays Total Indoor Statement</td>
                        <td align="right" style="font-size: 24px; font-weight: bold;"><?php echo $ottotal + $totalindr + $dntlrcvbll.'/='; ?></td>
                    </tr>
                </table>        






                <br><br><br><br><br><br><br><br><br><br><br>
            <div>
                <h4 style="float: left; margin: 0; border-top: 2px solid black;">Reception</h4>
                <h4 style="float: left; margin: 0 0 0 100px; border-top: 2px solid black;">Accountant</h4>
                <h4 style="float: left; margin: 0 0 0 100px; border-top: 2px solid black;">Manager</h4>
                <h4 style="float: left; margin: 0 0 0 150px; border-top: 2px solid black;">Managing Partner</h4>
            </div>









