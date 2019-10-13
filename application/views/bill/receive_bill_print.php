<script type="text/javascript"> 
    document.open();
    document.write();
    document.close();
    window.focus();
    window.print();
    window.close();
</script>



<style>

    @media print {
        @page { margin:0; }
        body { margin: 1cm; }
    }

	.hospital_copy {
		width: 330px;
		float: left;
	}
	.patient_copy {		
		width: 330px;
		float: right;
		margin-top: 0px;
		margin-bottom: -50px;
	}
	.hos_name {
		text-align: center;
		margin: 0;
	}
	.hos_adr {
		text-align: center;
		margin: 0;
		font-size: 14px;
	}
	.b_cir {
		text-align: center;
		width: 120px;
		border: 2px solid black;
		border-radius: 10px;
		margin-top: 5px;
		margin-left: 100px;
	}
	.p_head_info {
		font-size: 14px;
	}
	.tb_line {
		line-height: 1em;
	}
	.p_data_info {
		font-size: 14px;		
	}
	.cat_info {
		font-size: 14px;
	}
	.cat_tk {
		font-size: 14px;
	}
</style>

<?php

$id = $this->input->get('id');

 foreach ($r_bill as $bill) { 
	$total_tk[] = $bill->bill_cat_taka; 
	$total_taka[] = array_sum($total_tk);
	$total_tk = NULL; 
 }

	foreach ($bill_cumms as $bill_cumm) {
	  if (!empty($bill_cumm->nd_cummis_tk)) {
		$total_r_bill[] = $bill_cumm->nd_cummis_tk;
	  }
	}


	foreach ($app_tk as $ticketTaka) {
		if (!empty($ticketTaka->doctor_fee)) {
			$dcrr_f = $ticketTaka->doctor_fee;
			$hospp_f = $ticketTaka->hospital_fee;
			$total_tc_tk = $hospp_f + $dcrr_f;
			$total_dR_fEes[] = $total_tc_tk;
			$total_r_bill[] = $total_tc_tk; 
		}
	}


	$totalDrfEE = array_sum($total_dR_fEes);

	$total_r_bill[] = array_sum($total_taka);
		 
?>


<div class="hospital_copy">
	<h4 class="b_cir">Hospital Copy</h4>
	<table class="tb_line">
		<tr>
			<th align="left" class="p_head_info"><?php echo lang('patient').' '.lang('name'); ?> </th>
			<td class="p_data_info"> : <?php echo strtoupper($paitents->ptnname); ?> </td>
		</tr>
	<?php if (!empty($paitents->consultant_id)) { ?>
		<tr>
			<th align="left" class="p_head_info"><?php echo lang('consultant').' '.lang('name'); ?></th>
			<td class="cons p_data_info"> : <?php echo $pacon->drname; ?></td>
		</tr>
	<?php } ?>
	<?php if (!empty($paitents->consul_sec_id)) { ?>
		<tr>
			<th align="left" class="p_head_info"><?php echo lang('consultant').' '.lang('name'); ?></th>
			<td class="cons_sec p_data_info"> :<?php echo $connnd->drname; ?> </td>
		</tr>
	<?php } ?>
		<tr>
			<th align="left" class="p_head_info"><?php echo lang('doctor').' '.lang('name'); ?></th>
			<td class="dr_n p_data_info"> : <?php echo $dr_name->drname; ?></td>
		</tr>
		<tr>
			<td colspan="2" style="border: 1px solid black; height: 25px;">T. No</td>
		</tr>
	<?php if (!empty($paitents->assistant_id)) { ?>
		<tr>
			<th align="left" class="p_head_info"><?php echo lang('assistant').' '.lang('name'); ?></th>
			<td class="p_data_info"> : <?php echo $paitents->assistant_id;?></td>
		</tr>
	<?php } ?>
	<?php if (!empty($paitents->anes_id)) { ?>
		<tr>
			<th align="left" class="p_head_info"><?php echo lang('anesthesiologist').' '.lang('name'); ?></th>
			<td class="annesth p_data_info"> : <?php echo $paitents->anes_id; ?></td>
		</tr>
	<?php } ?>
		<tr>
			<th align="left" class="p_head_info"><?php echo lang('registration').' '.lang('no'); ?></th>
			<td class="p_data_info"> : <?php echo $paitents->reg_no; ?></td>
		</tr>
		<tr>
			<th align="left" class="p_head_info"><?php echo lang('patient').' '.lang('id'); ?></th>
			<td class="p_data_info"> : <?php echo $paitents->patient_id; ?></td>
		</tr>
			<tr>
			<th align="left" class="p_head_info"><?php echo lang('bed').' '.lang('no'); ?></th>
			<td class="p_data_info"> : <?php echo $paitents->b_num; ?></td>
		</tr>
		<tr>
			<th align="left" class="p_head_info"><?php echo lang('admission').' '.lang('date'); ?></th>
			<td class="p_data_info"> : <?php echo  date("D j-M-Y  h:i a ", $paitents->time_this); ?></td>
		</tr>
		<tr>
			<th align="left" class="p_head_info"><?php echo lang('discharge').' '.lang('date'); ?></th>
			<td class="p_data_info"> : <?php echo date("D j-M-Y  h:i a ", $paitents->dis_time); ?></td>
		</tr>
	</table>

	<br>

	<table border="1px">
		<tr>
			<th align="center">Cost Of Particulars</th>
			<th align="center">Taka</th>
		</tr>
			<tr>
				<th>Total Receive Bill</th>
				<td style="font-weight: bold; font-size: 25px;" align="right"><?php echo array_sum($total_r_bill); ?></td>
			</tr>
	<?php foreach ($bill_cumms as $bill_cumm) { ?>
		<?php if (!empty($bill_cumm->nd_cummis_tk)) { ?>
			<tr>
				<th class="cat_info"><?php echo $bill_cumm->nd_cummis; ?></th>
				<td align="right" class="cat_tk"><?php
				 echo $bill_cumm->nd_cummis_tk; ?></td>
			</tr>
		<?php } ?>
	<?php } ?>
	<?php foreach ($app_tk as $ticketTaka) { ?>
		<?php if (!empty($ticketTaka->doctor_fee)) { ?>
			<tr>
				<th style="font-size: 12px; " class="cat_info"><?php echo $ticketTaka->drname; ?></th>
				<td align="right" class="cat_tk"><?php

				echo $ticketTaka->hospital_fee + $ticketTaka->doctor_fee;
					 ?>
				</td>
			</tr>
		<?php } ?>
	<?php } ?>
			<tr>
				<th align="right" class="cat_info">Total Amount</th>
				<td style="font-weight: bold;" align="right"><?php echo array_sum($total_taka); ?></td>
			</tr>
	<?php foreach ($r_bill as $bill) { ?>
			<tr>
				<th align="left" width="200px" class="cat_info"><?php echo $bill->category; ?></th>
				<td align="right" width="70px" class="cat_tk"><?php echo $bill->bill_cat_taka; ?></td>
			</tr>
	<?php } ?>
			<tr>
				<th align="right" class="cat_info">Total Amount</th>
				<td style="font-weight: bold; font-size: 20px;" align="right"><?php echo array_sum($total_taka); ?></td>
			</tr>

	</table>

	<br><br><br>


    <div>
        <span style="float: left; border-top: 2px solid black"><div style="font-weight: bold;"><?php
                
                        echo  $pnts->ename;
                        ?></div>
            <?php echo lang('receive_by');
              ?></span>
    </div>


</div>










		<div class="ptnqrcode" style="position: absolute; margin: 52px 0px 0 393px ">
			<img width="90px" height="90px" src="<?php echo base_url(); ?>uploads/qrcode/indoor/<?php echo $id; ?>.png">
		</div>




<div class="patient_copy">
	<h1 class="hos_name"><?php echo $this->db->get('settings')->row()->system_vendor; ?></h1>
	<h3 class="hos_adr"><?php echo $this->db->get('settings')->row()->address; ?></h3>
	<h4 class="b_cir">Patient Bill</h4>
	<br><br>
	<table class="tb_line">
		<tr>
			<th align="left" class="p_head_info"><?php echo lang('patient').' '.lang('name'); ?> </th>
			<td class="p_data_info"> : <?php echo strtoupper($paitents->ptnname); ?> </td>
		</tr>
	<?php if (!empty($paitents->consultant_id)) { ?>
		<tr>
			<th align="left" class="p_head_info"><?php echo lang('consultant').' '.lang('name'); ?></th>
			<td class="cons p_data_info"> :  <?php echo $pacon->drname; ?></td>
		</tr>
	<?php } ?>
	<?php if (!empty($paitents->consul_sec_id)) { ?>
		<tr>
			<th align="left" class="p_head_info"><?php echo lang('consultant').' '.lang('name'); ?></th>
			<td class="cons_sec p_data_info"> : <?php echo $connnd->drname; ?> </td>
		</tr>
	<?php } ?>
		<tr>
			<th align="left" class="p_head_info"><?php echo lang('doctor').' '.lang('name'); ?></th>
			<td class="dr_n p_data_info"> : <?php echo $dr_name->drname; ?></td>
		</tr>
	<?php if (!empty($paitents->assistant_id)) { ?>
		<tr>
			<th align="left" class="p_head_info"><?php echo lang('doctor').' '.lang('assistant').' '.lang('name'); ?></th>
			<td class="p_data_info"> : <?php echo $paitents->assistant_id;?></td>
		</tr>
	<?php } ?>
	<?php if (!empty($paitents->anes_id)) { ?>
		<tr>
			<th align="left" class="p_head_info"><?php echo lang('doctor').' '.lang('anesthesiologist').' '.lang('name'); ?></th>
			<td class="annesth p_data_info"> : <?php echo $paitents->anes_id; ?></td>
		</tr>
	<?php } ?>
		<tr>
			<th align="left" class="p_head_info"><?php echo lang('patient').' '.lang('id'); ?></th>
			<td class="p_data_info"> : <?php echo $paitents->patient_id; ?></td>
		</tr>
			<tr>
			<th align="left" class="p_head_info"><?php echo lang('bed').' '.lang('no'); ?></th>
			<td class="p_data_info"> : <?php echo $paitents->b_num; ?></td>
		</tr>
		<tr>
			<th align="left" class="p_head_info"><?php echo lang('admission').' '.lang('date'); ?></th>
			<td class="p_data_info"> : <?php echo date("D j-M-Y  h:i a ", $paitents->time_this); ?></td>
		</tr>
		<tr>
			<th align="left" class="p_head_info"><?php echo lang('discharge').' '.lang('date'); ?></th>
			<td class="p_data_info"> : <?php echo date("D j-M-Y  h:i a ", $paitents->dis_time); ?></td>
		</tr>
	</table>

	<br>

	<table border="1px">
		<tr>
			<th align="center">Cost Of Particulars</th>
			<th align="center">Taka</th>
		</tr>
	<?php foreach ($bills as $bill) { ?>
			<tr>
				<th align="left" width="200px" class="cat_info"><?php echo $bill->category; ?></th>
				<td align="right" width="70px" class="cat_tk"><?php echo $bill->bill_taka;
					$b_total_tk[] = $bill->bill_taka; 
					$b_total_taka[] = array_sum($b_total_tk);
					$b_total_tk = NULL; ?></td>
			</tr>
	<?php } ?>
			<tr>
				<th align="right" class="cat_info">Total Bill</th>
				<td style="font-weight: bold;" align="right"><?php echo array_sum($b_total_taka);
															$bill_total_r_bill = array_sum($b_total_taka);
																 ?></td>
			</tr>
			<tr>
				<th>Discount</th>
				<td align="right">
					<?php 
						$total_receive = $receiv_b_sum + $b_commis_sum + $totalDrfEE;
						$disc = $creat_b_sum - $total_receive;
						echo $disc;
					 ?>
				</td>
			</tr>
			<tr>
				<th>Please Pay Taka</th>
				<td style="font-weight: bold; font-size: 25px;" align="right"><?php $bill_pay = $bill_total_r_bill - $disc; echo $bill_pay; ?></td>
			</tr>
	</table>
<br>
	Inwords: <?php echo getStringOfAmount($bill_pay).' Taka Only'; ?>
	<br><br>


    <div>
        <span style="float: right; border-top: 2px solid black"><div style="font-weight: bold;"><?php
                  echo  $pnts->ename;        ?></div>
            <?php echo lang('receive_by');
              ?></span>
    </div>


</div>




<?php


    $params['data'] = $this->db->get('settings')->row()->system_vendor."\r \n Patient Name : ".strtoupper($paitents->ptnname)."\r \n Doctor Name : ".strtoupper($dr_name->drname)."\r \n Admition :".date("D j-M-Y  h:i a ", $paitents->time_this)."\r \n Discharge :".date("D j-M-Y  h:i a ", $paitents->dis_time)."\r \n Paid bill-> ".$bill_pay.'/-';

    $params['level'] = 'M';
    $params['size'] = 4;
    $params['savename'] = FCPATH.'uploads/qrcode/indoor/'.$id.'.png';
    $this->ciqrcode->generate($params);
    


?>



