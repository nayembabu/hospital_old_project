

<style type="text/css">
    * {
        font-size: 13px;
    }
    .sttd {
        width: 150px;
    }
    .tktd {
        width: 150px;
    }
    .ttltktd {
        font-weight: bold;
        font-size: 15px;
    }
    .empnem {
        font-size: 16px;
    }
</style>
 



<!--this is emp_id <?php echo $this->ion_auth->user()->row()->emp_id;?>-->


                <center>
                    <h1 style="font-size: 30px; margin: -25px 0 0 0; padding: 0;"><?php echo $this->db->get('settings')->row()->system_vendor; ?></h1>
                    <p style="margin: 0; padding: 0; font-size: 20px;"><?php echo $this->db->get('settings')->row()->address; ?></p>
                    <p style="margin: 0; padding: 0; font-size: 20px;">User wise Daily Indoor Statement</p>
                    <p style="margin: 0; padding: 0; font-size: 20px;"><?php echo 'Date: '.date('d-F-Y', strtotime($date)); ?></p>
                   <br>
                </center><br>

<!--                        <th><?php echo $b_t_sum; ?></th> -->


    
<?php foreach ($empusr as $empu) { ?>
    <?php foreach ($b_recv_sum as $brcv) {
        if ($empu->emp_id == $brcv->emp_id) {
            if ($brcv->p_stas == 'indoor' || $brcv->p_stas == 'out_ser' || $brcv->p_stas == 'obsn' ) {
                $indbrcv[] = $brcv->bill_cat_taka;
            }else  if ($brcv->p_stas == 'dnc' || $brcv->p_stas == 'nvd' || $brcv->p_stas == 'ot' ) { 
                $otbrcv[] = $brcv->bill_cat_taka;
            }else if ($brcv->p_stas == 'dntlser') {
                $dntlrcv[] = $brcv->bill_cat_taka;
            }
        }
    }

    $indblrc = array_sum($indbrcv);
    $otblrc = array_sum($otbrcv);
    $dntlblrc = array_sum($dntlrcv);

    $ttlrcbl = $indblrc + $otblrc + $dntlblrc;

    $ttlsum[] = $ttlrcbl;

    $indbrcv = NULL;
    $otbrcv = NULL;
    $dntlrcv = NULL;

?>

    <table border="1px">
        <tr>
            <th colspan="2" align="center" class="empnem"><?php echo $empu->ename; ?></th>
        </tr>
        <tr>
            <td class="sttd">Indoor</td>
            <td align="right" class="tktd"><?php echo $indblrc; ?></td>
        </tr>
        <tr>
            <td class="sttd">O.T</td>
            <td align="right" class="tktd"><?php echo $otblrc; ?></td>
        </tr>
        <tr>
            <td class="sttd">Dental</td>
            <td align="right" class="tktd"><?php echo $dntlblrc; ?></td>
        </tr>
        <tr>
            <td class="sttd" align="right" >Total Amount</td>
            <td align="right" class="tktd ttltktd"><?php echo $ttlrcbl; ?></td>
        </tr>        
    </table>
<?php } ?>
<br>
<table border="1px">
    <tr>
        <td class="sttd ttltktd" align="right" >Total Received Taka</td>
        <td align="right" class="tktd ttltktd"><?php echo array_sum($ttlsum);?></td>
    </tr>
</table>

