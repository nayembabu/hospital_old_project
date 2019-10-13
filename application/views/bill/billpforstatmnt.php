





		<table border="1px">
			<?php foreach ($empuser as $user) { ?>
				<tr>
					<td> <?php echo $user->ename; ?> </td>
				</tr>
			<?php } ?>
		</table>


<table>
	<?php foreach ($allRRBill as $bill) { ?>
		<tr>
			<td><?php echo $bill->bill_cat_taka; ?></td>
		</tr>
	<?php } ?>
</table>







