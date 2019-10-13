
                <center>
                    <h1 style="font-size: 45px; margin: 0; padding: 0;"><?php echo $this->db->get('settings')->row()->system_vendor; ?></h1>
                    <p style="margin: 0; padding: 0; font-size: 25px;"><?php echo $this->db->get('settings')->row()->address; ?></p>
                    <p style="margin: 0; padding: 0; font-size: 25px;"><?php echo lang('count_doctor_ticket'); ?></p>
                    <p style="margin: 0; padding: 0; font-size: 25px;"><?php echo lang('doctor').' '.lang('name'); ?>: 
                         <?php
                              $dr_id = $this->input->get('dr_id');
                              $this->db->where('dr_id', $dr_id);
                              $query = $this->db->get('doctor');
                              $dr_name = $query->row();
                              echo $dr_name->drname;
                          ?>
                    </p>
                    <br><br>
               </center>
                    <table border="1px">
                    	<tr>
                              <th>Serial</th>
                    		<th>Patient Name</th>
                    		<th>Doctor Fee</th>
                              <th>Hospital Fee</th>
                    	</tr>
                    <?php foreach ($ticket_count as $c_ticket) { ?>
                         <tr>
                              <td><?php echo $c_ticket->serial; ?></td>
                              <td><?php echo $c_ticket->patient; ?></td>
                              <td align="right"><?php echo $dr_f[] = $c_ticket->doctor_fee; ?></td>
                              <td align="right"><?php echo $hs_f[] = $c_ticket->hospital_fee; ?></td>
                         </tr>
                    <?php } ?>
                    <tr>
                         <td align="right" colspan="2">Total TK</td>
                         <td align="right"><?php echo $c_to[] = array_sum($dr_f); ?></td>
                         <td align="right"><?php echo $c_to[] = array_sum($hs_f); ?></td>
                    </tr>
                    <tr>
                         <td align="right" colspan="4"> Total Sell
                              <?php echo array_sum($c_to); ?>
                         </td>
                    </tr>
                    </table>
<br><br><br>


<center>
     <?php
          $this->db->where('emp_id', $this->ion_auth->user()->row()->emp_id);
          $query = $this->db->get('nurse');
          $eml = $query->row();
              if($query->num_rows > 0 ) {
                  echo  $eml->ename;} 
     ?>

</center>