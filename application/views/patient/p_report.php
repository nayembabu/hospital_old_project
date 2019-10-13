

<html>
    <head>
        <style>
            /** 
                Set the margins of the page to 0, so the footer and the header
                can be of the full height and width !
             **/
            @page {
                margin: 0cm 0cm;
            }

            /** Define now the real margins of every page in the PDF **/
            body {
                margin-top: 3.5cm;
                margin-left: 1cm;
                margin-right: 1cm;
                margin-bottom: 1cm;
            }

            /** Define the header rules **/
            header {
                position: fixed;
                top: 0cm;
                left: 0cm;
                right: 0cm;

                /** Extra personal styles **/
                color: black;
                text-align: center;
            }

            /** Define the footer rules **/
            footer {
                position: fixed; 
                bottom: 0cm; 
                left: 0cm; 
                right: 0cm;
                height: 0.5cm;

                /** Extra personal styles **/
                color: black;
                text-align: center;
                font-size: 12px;
            }
        </style>
    </head>
    <body>
        <!-- Define header and footer blocks before your content -->
        <header>
       	    <h1 style="font-size: 40px; margin: 0; "><?php echo $this->db->get('settings')->row()->system_vendor; ?></h1>
			<p style="font-size: 20px; margin: 0;"><?php echo $this->db->get('settings')->row()->address; ?></p>
			<p style="font-size: 20px; margin: 0;">Admition Patient Report</p>
			<p style="font-size: 15px; margin: 0 0 0 0;">Date : <?php echo $s_date; ?> to <?php echo $l_date;?></p>
<hr>
        </header>

        <footer>
        	<hr>

        </footer>

        <!-- Wrap the content of your PDF inside a main tag -->
        <main>


			<table border="1px" style="font-size: 12px;">
				<tr>
					<th>SL No</th>
					<th>Patient ID</th>
					<th>Patient Name</th>
					<th>Doctor Name</th>
					<th>Admission Date Time</th>
					<th>Discharge Date Time</th>
					<th>Bed / Cabin No</th>
					<th>Patient Causes</th>
					<th>Full Address</th>
					<th>Mobile No</th>
				</tr>
			<?php $i = 1; foreach ($patient_data as $p_data) { ?>
				<tr>
					<td><?php echo $i;?></td>
					<td><?php echo $p_data->patient_id;?></td>
					<td><?php echo strtoupper($p_data->ptnname);?></td>
					<td><?php echo strtoupper($p_data->drname);?></td>
					<td><?php echo date('d-M-y h:m a', $p_data->time_this);?></td>
					<td><?php echo date('d-M-y h:m a', $p_data->dis_time);?></td>
					<td><?php echo $p_data->b_num;?></td>
					<td><?php echo $p_data->Patient_cause;?></td>
					<td><?php echo $p_data->address;?></td>
					<td><?php echo $p_data->mobile; $i += 1;?></td>
				</tr>
			<?php } ?>
			</table>

        </main>
    </body>
</html>


















