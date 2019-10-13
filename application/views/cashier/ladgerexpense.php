<!--sidebar end-->
<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">
        <!-- page start-->
        <section class="panel">

<style type="text/css">
    @media print {
        @page { margin:0; }
        body { margin: 1.6cm; }
    }
</style>





<!--this is emp_id <?php echo $this->ion_auth->user()->row()->emp_id;?>-->

            <div class="panel-body">
                <div class="adv-table editable-table ">

                <center>

                    <h1 style="font-size: 50px; margin: 0; padding: 0;"><?php echo $this->db->get('settings')->row()->system_vendor; ?></h1>
                    <p style="margin: 0; padding: 0; font-size: 25px;"><?php echo $this->db->get('settings')->row()->address; ?></p>
                    <p style="margin: 0; padding: 0; font-size: 20px;"><?php echo lang('monthly_ladger_book'); ?></p>
                    <?php   $c_id = $this->input->get('ciid');
                            $monthNum = $this->input->get('month');
                     	    $year = $this->input->get('year');
						    $month = date('F', mktime(0, 0, 0, $monthNum, 10));
                            $this->db->where('id', $c_id);
                            $query = $this->db->get('expense_category');
                            $eml = $query->row();
                        ?>
                    <p  style="margin: 0; padding: 0; font-size: 25px;"><?php echo lang('month').": ".$month."  ".$year; ?></p><p  style="margin: 0; padding: 0; font-size: 25px;"><?php echo lang('expense_catagory').": ".$eml->category; ?></p>
                   <br>
                   <div style="border: 3px black solid; display: inline-block;">
                    <table cellpadding="0" cellspacing="0" border="1px solid black" style="display: inline-block; float:left; margin: 7px 15px 7px 7px;" class="table table-striped table-hover table-bordered" id="editable-sample">
                        <thead>
                            <tr>
                                <th><?php echo lang('date'); ?></th>
                                <th><?php echo lang('amount'); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($exladgers as $exladger) { ?>
                            <tr>
                                <td><?php echo $exladger->date;?></td>
                                <td align="right"><?php $tti[] = $exladger->amount;
                                            echo $exladger->amount;?></td>
                            </tr>
                        <?php } ?>
                        </tbody>
                            <tr>
                                <td style="text-align: right;"><?php echo lang('total'); ?></td>
                                <td align="right" style="font-weight: bold; font-size: 18px;" >
                                    <?php echo array_sum($tti); ?>
                                </td>

                            </tr>
                        </table>
                    </div><br>
                </center>






                </div>
            </div>
        </section>
        <!-- page end-->
    </section>
</section>
<!--main content end-->
<!--footer start-->



<script>
    $(document).ready(function () {
        $(".flashmessage").delay(3000).fadeOut(100);
    });
</script>

