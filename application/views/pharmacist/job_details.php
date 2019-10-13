
                <center>
                    <h1 style="font-size: 30px; margin: 0; padding: 0;"><?php echo $this->db->get('settings')->row()->system_vendor; ?></h1>
                    <p style="margin: 0; padding: 0; font-size: 15px;"><?php echo $this->db->get('settings')->row()->address; ?></p>
                    <p style="margin: 0; padding: 0; font-size: 15px;"><?php echo lang('job_card'); ?></p>
                                        <?php  $emp_id = $this->input->get('emp_id');
                            $month =  $this->input->get('month');
                            $year =  $this->input->get('year');
                        ?>
                    <p style="margin: 0 0 0 65px; padding: 0; font-size: 18px; float: left;"><?php 
                                    $this->db->where('emp_id', $emp_id);
                                    $query = $this->db->get('nurse');
                                    $eml = $query->row();
                                    echo lang('emp').": ".$eml->ename; ?></p>
                    <p style="float: right; margin: 0 60px 0 0; padding: 0; font-size: 18px;"><?php
                                    $this->db->where('emp_id', $emp_id);
                                    $query = $this->db->get('empinfo');
                                    $inf = $query->row();
                                    echo lang('dasign').": ".$inf->desig; ?></p>
                   <br><br>
                    <table border="1px" align="center">
                        <thead>
                            <tr>
                                <th><?php echo lang('date'); ?></th>
                                <th><?php echo lang('intime'); ?></th>
                                <th><?php echo lang('outtime'); ?></th>
                                <th><?php echo lang('total'); echo lang('hours'); ?></th>
                            </tr>
                        </thead>
                        <tbody>


                        <?php foreach ($job_cards as $job_card) { ?>
                            <tr class="">
                                <td><?php echo $job_card->date; ?></td>
                                <td><?php echo $job_card->intim; ?></td>
                                <td><?php echo $job_card->outtim; ?></td>
                                <td>
                                <?php if (empty($job_card->intim) || empty($job_card->outtim)) {
                                        echo "A";
                                    }else {
                                        $in = $job_card->intim;
                                        $out = $job_card->outtim; 
                                        $cal = $out-$in; 
                                        $calcu[] = $cal;
                                        echo  $cal, lang('hours');
                                      }?>
                                 </td>
                            </tr>
                        <?php } ?>

                        </tbody>

                        <tr>
                            <th><?php echo lang('present'); ?></th>
                            <td><?php echo $job_count.' '.lang('days') ; ?></td>
                        </tr>
                        <tr>
                            <th><?php echo lang('total'). ' ' . lang('hours'); ?></th>
                            <td><?php echo array_sum($calcu).' '.lang('hours'); ?></td>
                        </tr>
                        <tr>
                            <th><?php echo lang('absence'); ?></th>
                            <td><?php
                                $days = cal_days_in_month(CAL_GREGORIAN, $month, $year);
                                $absen = $days - $job_count;
                                echo $absen.' '.lang('days') ;
                                ?>
                            </td>
                        </tr>           
                        </table>
                        <br>
                    </div>
                </center>



