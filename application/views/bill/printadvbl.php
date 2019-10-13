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
			<td class="dr_n p_data_info"> : <?php echo $paitents->drname; ?></td>
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
	</table>

	<br>

	<table border="1px">
		<tr>
			<th align="center">Cost Of Particulars</th>
			<th align="center">Taka</th>
		</tr>
		<tr>
			<td><?php echo $rcvamnt->category; ?></td>
			<td><?php echo $rcvamnt->bill_cat_taka; ?></td>
		</tr>
		<tr>
			<th align="right" class="cat_info">Total Amount</th>
			<td style="font-weight: bold; font-size: 20px;" align="right"><?php echo array_sum($total_taka); ?></td>
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
	<h4 class="b_cir">Patient Bill</h4>
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
			<td class="dr_n p_data_info"> : <?php echo $paitents->drname; ?></td>
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
			<td class="p_data_info"> : <?php echo  date("D j-M-Y  h:i a ", $paitents->time_this); ?></td>
		</tr>
	</table>

	<br>

	<table border="1px">
		<tr>
			<th align="center">Cost Of Particulars</th>
			<th align="center">Taka</th>
		</tr>
		<tr>
			<td><?php echo $rcvamnt->category; ?></td>
			<td><?php echo $rcvamnt->bill_cat_taka; ?></td>
		</tr>
		<tr>
			<th>Please Pay Taka</th>
			<td style="font-weight: bold; font-size: 25px;" align="right"><?php $bill_pay = $rcvamnt->bill_cat_taka; echo $bill_pay; ?></td>
		</tr>
	</table>
<br>
	Inwords: <?php echo getStringOfAmount($bill_pay).' Taka Only'; ?>
	<br><br>


    <div>
        <span style="float: right; border-top: 2px solid black"><div style="font-weight: bold;"><?php
                  echo  $paitents->ename;        ?></div>
            <?php echo lang('receive_by');
              ?></span>
    </div>


</div>






