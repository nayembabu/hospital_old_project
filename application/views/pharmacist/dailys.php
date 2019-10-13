
                <center>
                    <h1 style="font-size: 35px; margin: 0; padding: 0;"><?php echo $this->db->get('settings')->row()->system_vendor; ?></h1>
                    <p style="margin: 0; padding: 0; font-size: 15px;"><?php echo $this->db->get('settings')->row()->address; ?></p>
                    <p style="margin: 0; padding: 0; font-size: 15px;"><?php echo lang('daily_attendance_report'); ?></p><br>
                    <?php  $date = $this->input->get('date');
                        $str = strtotime($date);
                        $today = date('l', $str);
                        ?>
                    <p style="margin: 0 0 0 65px; padding: 0; font-size: 18px; float: left;"><?php echo lang('date').": ".date('d-M-Y', $str); ?></p>
                    <p style="float: right; margin: 0 60px 0 0; padding: 0; font-size: 18px;"><?php echo lang('day').": ".$today; ?></p>
                   <br><br>
                    <table border="1px" align="center">
                        <thead>
                            <tr>
                                <th><?php echo lang('id'); ?></th>
                                <th><?php echo lang('emp'); ?></th>
                                <th><?php echo lang('intime'); ?></th>
                                <th><?php echo lang('outtime'); ?></th>
                                <th><?php echo lang('total'); echo lang('hours'); ?></th>
                            </tr>
                        </thead>
                        <tbody>


                        <?php foreach ($emps as $emp) { ?>
                            <tr class="">
                                <td> <?php echo $emp->eid; ?></td>
                                <td align="right"> <?php echo $emp->ename;?></td>

                        <?php foreach ($pharmacists as $pharmacist) {
                            if ($emp->emp_id == $pharmacist->emp_id) { ?>
                                <td><?php echo $in = $pharmacist->intim; ?></td>
                                <td><?php echo $out = $pharmacist->outtim; ?></td>
                                <td>
                                <?php if (empty($pharmacist->intim) || empty($pharmacist->outtim)) {
                                        echo "A";
                                    }else {
                                        $in = $pharmacist->intim;
                                        $out = $pharmacist->outtim; 
                                        $cal = $out-$in; 
                                        echo  $cal, lang('hours');
                                      }?>
                                 </td>
                            </tr>
                          <?php } ?>
                        <?php } ?>
                        <?php } ?>
                        </tbody>
                        </table>
                    </div><br>
                    <br><br><br><br><br><br><br>
                        <div>
                            <span style="float: left; margin-left: 500px; border-top: 2px solid black"><?php echo lang('manager'); ?></span>
                            
                        </div>
                </center>



