<base href="<?php echo base_url();?>">


		<style type="text/css">

		    @media print {
				@page {
					margin: 0;
				}				
		        body { margin: 0.5cm; }
		    }
		    .sys_logo_image {
		    	float: left;
		    	margin: 0 30px 0 0;
		    }
		    .sys_name {
		    	font-size: 37px;
		    }
		    .address {
		    	margin: -30 0 0 100px;
		    	font-size: 18px;
		    }
		</style>



			<img width="70px" height="70px" class="sys_logo_image" src="<?php echo $this->db->get('settings')->row()->logo; ?>">

			<h2 class="sys_name"><?php echo $this->db->get('settings')->row()->system_vendor;  ?></h2>
			<p class="address"><?php echo $this->db->get('settings')->row()->address;  ?>
			<br><?php echo $this->db->get('settings')->row()->phone;  ?> </p><br>
	<center style="border: 2px solid black; width: 150px; font-size: 20px; font-weight: bold; border-radius: 50px; margin-left: 200px; ">
		Patient Memo
	</center><br>
	<table style="float: left;">
		<tr>
			<td>ID No </td>
			<td>: <?php echo $patient_info->lab_rgstr_iidd; ?></td>
		</tr>
		<tr>
			<td>Name</td>
			<td>: <?php echo strtoupper($patient_info->labpnname); ?></td>
		</tr>
		<tr>
			<td>Gender</td>
			<td>: <?php if ($patient_info->gndr == 'm') {
					echo "Male";
				}elseif ($patient_info->gndr == 'f') {
					echo 'Female'; 
				} ?>,  <span>Age: <?php echo $patient_info->labpn_age; ?></span></td>
		</tr>
		<tr>
			<td>Mobile No</td>
			<td>: <?php echo $patient_info->ptnmbl; ?></td>
		</tr>
	</table>

	<div style="float: left;">
		Refd. By : <?php echo strtoupper($patient_info->drname); ?><br>	<?php echo $patient_info->profile; ?>
	</div><br><br><br><br><br><br>

	<table>
		<tr>
			<th>Department</th>
			<th>Test Name</th>
			<th>Amount (Tk)</th>
		</tr>
	<?php foreach ($labtest_forprint as $test_prints) {
		$test_taka[] = $test_prints->rate; ?>
		<tr>
			<td><?php echo $test_prints->dep_name; ?></td>
			<td width="350px"><?php echo $test_prints->inv_name; ?></td>
			<td align="right"><?php echo $test_prints->rate; ?></td>
		</tr>
	<?php } ?>
		<tr>
			<td colspan="2" align="right">Sub Total</td>
			<td align="right"><?php echo array_sum($test_taka); ?></td>
		</tr>
		<tr>
			<td colspan="2" align="right">Discount</td>
			<td align="right"><?php echo $patient_info->ttl_dscnt_tk; ?></td>
		</tr>
		<tr>
			<td colspan="2" align="right">Receive</td>
			<td align="right" style="font-weight: bold; font-size: 18px;"><?php echo $patient_info->rcv_tak; ?></td>
		</tr>
	<?php if ($patient_info->ttl_due != 0) { ?>
		<tr>
			<td colspan="2" align="right">DUE</td>
			<td align="right"><?php echo $patient_info->ttl_due; ?></td>
		</tr>
	<?php } ?>
	</table>


	<div style="transform: rotate(320deg); position: absolute; margin: -40px 0 0 150px; font-weight: bold; color: black; font-size: 35px;">
		PAID
	</div>







<!-- 

<?php foreach ($department as $dept) {
	
	foreach ($labtest_forprint as $labtest) {
		if ($dept->dep_name == $labtest->dep_name) {
			echo $labtest->dep_name;
		}
	}

} ?>

 -->













