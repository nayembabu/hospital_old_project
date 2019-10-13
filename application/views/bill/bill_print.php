

<style type="text/css">
    @media print {
        @page { margin:0; }
        body { margin: 1cm; }
    }

</style>


<?php $advbltk = array(); foreach ($advbill as $adbl) {
	$advbltk[] = $adbl->adbbll_taka;
}
$ttladvtk = array_sum($advbltk); ?>












<br><br><br><br><br><br>
<div style="margin-left: 130px;">
<table>
	<tr>
		<th align="left"><?php echo lang('patient').' '.lang('name'); ?> </th>
		<td> : <?php echo strtoupper($paitents->ptnname); ?> </td>
	</tr>
<?php if (!empty($paitents->consultant_id)) { ?>
	<tr>
		<th align="left"><?php echo lang('consultant').' '.lang('name'); ?></th>
		<td class="consssst"> : <?php echo $const_name->drname; ?></td>
	</tr>
<?php } ?>
<?php if (!empty($paitents->consul_sec_id)) { ?>
	<tr>
		<th align="left"><?php echo lang('consultant').' '.lang('name'); ?></th>
		<td class="cons_secst"> :  <?php echo $conndnd_name->drname; ?></td>
	</tr>
<?php } ?>
	<tr>
		<th align="left"><?php echo lang('doctor').' '.lang('name'); ?></th>
		<td class="dr_n"> : <?php echo $paitents->drname; ?></td>
	</tr>
<?php if (!empty($paitents->assistant_id)) { ?>
	<tr>
		<th align="left"><?php echo lang('doctor').' '.lang('assistant').' '.lang('name'); ?></th>
		<td> : <?php echo $paitents->assistant_id;?></td>
	</tr>
<?php } ?>
<?php if (!empty($paitents->anes_id)) { ?>
	<tr>
		<th align="left"><?php echo lang('doctor').' '.lang('anesthesiologist').' '.lang('name'); ?></th>
		<td class="annesth"> : <?php echo $paitents->anes_id; ?></td>
	</tr>
<?php } ?>
	<tr>
		<th align="left"><?php echo lang('registration').' '.lang('no'); ?></th>
		<td> : <?php echo $paitents->reg_no; ?></td>
	</tr>

	<tr>
		<th align="left"><?php echo lang('patient').' '.lang('id'); ?></th>
		<td> : <?php echo $paitents->patient_id; ?></td>
	</tr>
		<tr>
		<th align="left"><?php echo lang('bed').' '.lang('no'); ?></th>
		<td> : <?php echo $paitents->b_num; ?></td>
	</tr>
	<tr>
		<th align="left"><?php echo lang('admission').' '.lang('date'); ?></th>
		<td> : <?php echo  date("D j-M-Y  h:i a ", $paitents->time_this); ?></td>
	</tr>
	<tr>
		<th align="left"><?php echo lang('discharge').' '.lang('date'); ?></th>
		<td> : <?php echo date("D j-M-Y  h:i a ", $paitents->dis_time); ?></td>
	</tr>
</table>

<br>

<table border="1px">
	<tr>
		<th style="font-size: 14px;" align="center">Cost Of Particulars</th>
		<th style="font-size: 14px;" align="center">Taka</th>
	</tr>
<?php foreach ($bills as $bill) { ?>
		<tr>
			<th style="font-size: 13px;" align="left" width="300px"><?php echo $bill->category; ?></th>
			<td style="font-size: 13px;" align="right" width="100px"><?php echo $bill->bill_taka;
				$total_tk[] = $bill->bill_taka; 
				$total_taka[] = array_sum($total_tk);
				$total_tk = NULL; ?></td>
		</tr>
<?php }
$ttltkkkk = array_sum($total_taka);
$totlpaid = $ttltkkkk - $ttladvtk;
 ?>
		<tr>
			<th align="right">Total Amount</th>
			<td style="font-weight: bold; font-size: 20px;" align="right"><?php echo $ttltkkkk; ?></td>
		</tr>
		<tr>
			<th align="right">Advance Paid</th>
			<td style="font-weight: bold; font-size: 15px;" align="right"><?php if (empty($ttladvtk)) {
				echo "0";
			}else echo $ttladvtk;  ?></td>
		</tr>
		<tr>
			<th align="right">Due Bill</th>
			<td style="font-weight: bold; font-size: 27px;" align="right"><?php echo $totlpaid; ?></td>
		</tr>
</table>

<br><br><br>


<div class="drnamer">
	
</div>
<br><br>


                        <div>
                            <span style="float: left; border-top: 2px solid black"><div style="font-weight: bold;"><?php echo $paitents->ename;
                                            ?></div>
                                <?php echo lang('prepared_by');
                                  ?></span>
                            <span style="float: left; margin-left: 110px; border-top: 2px solid black"><?php echo lang('reception'); ?></span>
                            <span style="float: left; margin-left: 90px; border-top: 2px solid black">Authority</span>
                        </div>


</div>






