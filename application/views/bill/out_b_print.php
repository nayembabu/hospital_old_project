

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

$total_r_bill[] = array_sum($total_taka);
$hos_to_bill = array_sum($total_r_bill);

 ?>











<div class="hospital_copy">
	<h4 class="b_cir">Hospital Copy</h4>
	<table class="tb_line">
		<tr>
			<th align="left" class="p_head_info"><?php echo lang('patient').' '.lang('name'); ?> </th>
			<td class="p_data_info"> : <?php echo strtoupper($paitents->out_p_name); ?> </td>
		</tr>
	<?php if (!empty($paitents->dr_name)) { ?>
		<tr>
			<th align="text" class="p_head_info"><?php echo lang('doctor').' '.lang('name'); ?></th>
			<td class="dr_n p_data_info"> : <?php echo strtoupper($paitents->dr_name); ?></td>
		</tr>
	<?php } ?>
		<tr>
			<th align="left" class="p_head_info"><?php echo lang('patient').' '.lang('id'); ?></th>
			<td class="p_data_info"> : <?php echo $paitents->out_p_iid; ?></td>
		</tr>
		<tr>
			<th align="left" class="p_head_info"><?php echo lang('date'); ?></th>
			<td class="p_data_info"> : <?php echo date("D j-M-Y ", $paitents->th_time); ?></td>
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
				<td style="font-weight: bold; font-size: 25px;" align="right"><?php
				 echo $hos_to_bill; ?></td>
			</tr>
	<?php foreach ($bill_cumms as $bill_cumm) { ?>
		<?php if (!empty($bill_cumm->nd_cummis_tk)) { ?>
			<tr>
				<th class="cat_info"><?php echo $bill_cumm->nd_cummis; ?></th>
				<td align="right" class="cat_tk"><?php
				 echo $bill_cumm->nd_cummis_tk;?></td>
			</tr>
		<?php } ?>
	<?php } ?>
	<?php foreach ($r_bill as $bill) { ?>
			<tr>
				<th align="left" width="200px" class="cat_info"><?php echo $bill->category; ?></th>
				<td align="right" width="70px" class="cat_tk"><?php echo $bill->bill_cat_taka; ?></td>
			</tr>
	<?php } ?>
			<tr>
				<th align="right" class="cat_info">Total Amount</th>
				<td style="font-weight: bold; font-size: 20px;" align="right"><?php echo array_sum($total_taka);
																 ?></td>
			</tr>
	</table>

	<br><br><br>


    <div>
        <span style="float: left; border-top: 2px solid black"><div style="font-weight: bold;"><?php
                 echo  $paitents->ename;
                        ?></div>
            <?php echo lang('receive_by');
              ?></span>
    </div>


</div>












<div class="patient_copy">
	<h1 class="hos_name"><?php echo $this->db->get('settings')->row()->system_vendor; ?></h1>
	<h3 class="hos_adr"><?php echo $this->db->get('settings')->row()->address; ?></h3>
	<h4 class="b_cir">Out Patient Bill</h4>

	<table class="tb_line">
		<tr>
			<th align="left" class="p_head_info"><?php echo lang('patient').' '.lang('name'); ?> </th>
			<td class="p_data_info"> : <?php echo strtoupper($paitents->out_p_name); ?> </td>
		</tr>
	<?php if (!empty($paitents->dr_name)) { ?>
		<tr>
			<th align="text" class="p_head_info"><?php echo lang('doctor').' '.lang('name'); ?></th>
			<td class="dr_n p_data_info"> : <?php echo strtoupper($paitents->dr_name); ?></td>
		</tr>
	<?php } ?>
		<tr>
			<th align="left" class="p_head_info"><?php echo lang('patient').' '.lang('id'); ?></th>
			<td class="p_data_info"> : <?php echo $paitents->out_p_iid; ?></td>
		</tr>
		<tr>
			<th align="left" class="p_head_info"><?php echo lang('date'); ?></th>
			<td class="p_data_info"> : <?php echo date("D j-M-Y ", $paitents->th_time); ?></td>
		</tr>
	</table>
	<br>

	<table border="1px">
		<tr>
			<th align="center">Cost Of Particulars</th>
			<th align="center">Taka</th>
		</tr>

	<?php foreach ($r_bill as $bill) { ?>
			<tr>
				<th align="left" width="200px" class="cat_info"><?php echo $bill->category; ?></th>
				<td align="right" width="70px" class="cat_tk"><?php echo $hos_to_bill;?></td>
			</tr>
	<?php } ?>
			<tr>
				<th>Please Pay Taka</th>
				<td style="font-weight: bold; font-size: 25px;" align="right"><?php echo $hos_to_bill; ?></td>
			</tr>
	</table>
<br>
	Inwords: <?php echo getStringOfAmount($hos_to_bill).' Taka Only'; ?>
	<br><br><br><br><br>


    <div>
        <span style="float: right; border-top: 2px solid black"><div style="font-weight: bold;"><?php
                echo  $paitents->ename;
                        ?></div>
            <?php echo lang('receive_by');
              ?></span>
    </div>


</div>






