
                <center>
                    <h1 style="font-size: 45px; margin: 0; padding: 0;"><?php echo $this->db->get('settings')->row()->system_vendor; ?></h1>
                    <p style="margin: 0; padding: 0; font-size: 25px;"><?php echo $this->db->get('settings')->row()->address; ?></p>
                    <p style="margin: 0; padding: 0; font-size: 25px;"><?php echo lang('count_doctor_ticket'); ?></p>
                    
                    <br><br>
               </center>
                    <table border="1px">
                    	<tr>
                    		<th>Doctor</th>
                         <!--   <th>Total Patient</th>   -->
                    		<th>Doctor Fee</th>
                            <th>Hospital Fee</th>
                    	</tr>
                    <?php foreach ($dr_infos as $dr_info) { ?>

                         <tr>
                         	<td><?php echo $dr_info->drname; ?></td>

                              <td align="right">
                                   <?php
                                        foreach ($ticket_co as $co_ticket) {
                                             if ($dr_info->dr_id == $co_ticket->dr_id) {
                                                  $dr_f[] = $co_ticket->doctor_fee;
                                                  $hs_f[] =  $co_ticket->hospital_fee;
                                             }
                                        }

                                        if (!empty($dr_f)) {
                                             $dr_f_t[] = array_sum($dr_f);
                                            echo array_sum($dr_f);
                                        } else {
                                            echo '0';
                                        }

                                        $dr_f = NULL;

                                    ?>
                              </td>
                              <td align="right">
                                   <?php 
                                        if (!empty($hs_f)) {
                                             $hs_f_t[] = array_sum($hs_f);
                                            echo array_sum($hs_f);
                                        } else {
                                            echo '0';
                                        }
                                        $hs_f = NULL;
                                   ?>
                                        
                              </td>
                         </tr>
                    <?php } ?>
                    <tr>
                         <td align="right">Total TK</td>
                         <td align="right"><?php echo $c_to[] = array_sum($dr_f_t); ?></td>
                         <td align="right"><?php echo $c_to[] = array_sum($hs_f_t); ?></td>
                    </tr>
                    <tr>
                         <td align="right" colspan="2">
                              Total Sell
                         </td>
                         <td align="right">
                              <?php echo array_sum($c_to); ?>
                         </td>
                    </tr>
                    </table>
<br><br><br>

