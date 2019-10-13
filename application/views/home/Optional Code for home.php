
<!--

All Optional Code

-->







<!--

            <div class="col-lg-3 col-sm-6">
                <?php if ($this->ion_auth->in_group('admin')) { ?>
                    <a href="finance/payment">
                    <?php } ?>
                    <section class="panel">
                        <div class="symbol blue">
                            <i class="fa fa-money"></i>
                        </div>
                        <div class="value">
                            <h1 class="">
                                <?php echo $this->db->count_all('payment'); ?>
                            </h1>
                            <p><?php echo lang('payment'); ?> <?php echo lang('invoice'); ?></p>
                        </div>
                    </section>
                    <?php if ($this->ion_auth->in_group('admin')) { ?>
                    </a>
                <?php } ?>
            </div>
            <div class="col-lg-3 col-sm-6">
                <?php if ($this->ion_auth->in_group('admin')) { ?>
                    <a href="appointment">
                    <?php } ?>
                    <section class="panel">
                        <div class="symbol yellow">
                            <i class="fa fa-plus-square-o"></i>
                        </div>
                        <div class="value">
                            <h1 class="">
                                <?php echo $this->db->count_all('appointment'); ?>
                            </h1>
                            <p><?php echo lang('appointment'); ?></p>
                        </div>
                    </section>
                    <?php if ($this->ion_auth->in_group('admin')) { ?>
                    </a>
                <?php } ?>
            </div>
            <div class="col-lg-3 col-sm-6">
                <?php if ($this->ion_auth->in_group('admin')) { ?>
                    <a href="report/operation">
                    <?php } ?>
                    <section class="panel">
                        <div class="symbol terques">
                            <i class="fa  fa-wheelchair"></i>
                        </div>
                        <div class="value">
                            <h1 class="">
                                <?php
                                echo $this->db
                                        ->where('report_type', 'operation')
                                        ->count_all_results('report');
                                ?>
                            </h1>
                            <p><?php echo lang('operation_report'); ?></p>
                        </div>
                    </section>
                    <?php if ($this->ion_auth->in_group('admin')) { ?>
                    </a>
                <?php } ?>
            </div>
            <div class="col-lg-3 col-sm-6">
                <?php if ($this->ion_auth->in_group('admin')) { ?>
                    <a href="report/birth">
                    <?php } ?>
                    <section class="panel">
                        <div class="symbol blue">
                            <i class="fa fa-smile-o"></i>
                        </div>
                        <div class="value">
                            <h1 class="">
                                <?php
                                echo $this->db
                                        ->where('report_type', 'birth')
                                        ->count_all_results('report');
                                ?>
                            </h1>
                            <p><?php echo lang('birth_report'); ?></p>
                        </div>
                    </section>
                    <?php if ($this->ion_auth->in_group('admin')) { ?>
                    </a>
                <?php } ?>
            </div>
            <div class="col-lg-3 col-sm-6">
                <?php if ($this->ion_auth->in_group('admin')) { ?>
                    <a href="donor">
                    <?php } ?>
                    <section class="panel">
                        <div class="symbol yellow">
                            <i class="fa fa-briefcase"></i>
                        </div>
                        <div class="value">
                            <h1 class="">
                                <?php echo $z = $this->db->count_all('donor'); ?>
                            </h1>
                            <p><?php echo lang('donor'); ?></p>
                        </div>
                    </section>
                    <?php if ($this->ion_auth->in_group('admin')) { ?>
                    </a>
                <?php } ?>
            </div>
            <div class="col-lg-3 col-sm-6">
                <?php if ($this->ion_auth->in_group('admin')) { ?>
                    <a href="bed">
                    <?php } ?>
                    <section class="panel">
                        <div class="symbol terques">
                            <i class="fa fa-home"></i>
                        </div>
                        <div class="value">
                            <h1 class=" count13">
                                <?php echo $z = $this->db->count_all('bed'); ?>
                            </h1>
                            <p><?php echo lang('total_bed'); ?></p>
                        </div>
                    </section>
                    <?php if ($this->ion_auth->in_group('admin')) { ?>
                    </a>
                <?php } ?>
            </div>
            <div class="col-lg-3 col-sm-6">
                <?php if ($this->ion_auth->in_group('admin')) { ?>
                    <a href="medicine">
                    <?php } ?>
                    <section class="panel">
                        <div class="symbol blue">
                            <i class="fa fa-medkit"></i>
                        </div>
                        <div class="value">
                            <h1 class="">
                                <?php echo $this->db->count_all('medicine'); ?>
                            </h1>
                            <p><?php echo lang('medicine'); ?></p>
                        </div>
                    </section>
                    <?php if ($this->ion_auth->in_group('admin')) { ?>
                    </a>
                <?php } ?>
            </div>
            <?php if ($this->ion_auth->in_group('admin')) { ?>
                <div class="col-lg-6 col-sm-6">    
                    <a href="finance/payment">
                        <section class="panel">
                            <div class="symbol terques">
                                <i class="fa fa-bar-chart-o"></i>
                            </div>
                            <div class="value">
                                <h1 class=" count14">
                                    <?php echo $settings->currency; ?> <?php echo number_format($sum[0]->gross_total, 2); ?>
                                </h1>
                                <p><?php echo lang('total_payment'); ?></p>
                            </div>
                        </section>         
                    </a>     
                </div>
            <?php } ?>
            <div class="col-lg-3 col-sm-6">
                <?php if ($this->ion_auth->in_group('admin')) { ?>
                    <a href="department">
                    <?php } ?>
                    <section class="panel">
                        <div class="symbol blue">
                            <i class="fa fa-dashboard"></i>
                        </div>
                        <div class="value">
                            <h1 class="">
                                <?php echo $this->db->count_all('department'); ?>
                            </h1>
                            <p><?php echo lang('departments'); ?></p>
                        </div>
                    </section>
                    <?php if ($this->ion_auth->in_group('admin')) { ?>
                    </a>
                <?php } ?>
            </div>
        </div>
        -->


<!--
        <aside class="calendar_ui">
            <section class="">
                <div class="">
                    <div id="calendar" class="has-toolbar calendar_view"></div>
                </div>
            </section>
        </aside>

        <style>

            table{
                box-shadow: none;
            }

            .fc-head{

                box-shadow: 0 2px 5px 0 rgba(0, 0, 0, .16), 0 2px 10px 0 rgba(0, 0, 0, .12);

            }

            .panel-body{
                background: #fff;
            }

            thead{
                background: #fff;
            }

            .panel-body {
                background: #fff;
            }

        </style>






        <div class="row state-overview" style="padding: 23px 19px;">
            <div class="col-lg-3 col-sm-6">
                <?php if ($this->ion_auth->in_group('admin')) { ?>
                    <a href="doctor">
                    <?php } ?>
                    <section class="panel">
                        <div class="symbol terques">
                            <i class="fa fa-stethoscope"></i>
                        </div>
                        <div class="value"> 
                            <h1 class="">
                                <?php echo $this->db->count_all('doctor'); ?>
                            </h1>
                            <p><?php echo lang('doctor'); ?></p>
                        </div>
                    </section>
                    <?php if (!$this->ion_auth->in_group('admin')) { ?>
                    </a>
                <?php } ?>
            </div>
            <div class="col-lg-3 col-sm-6">
                <?php if ($this->ion_auth->in_group('admin')) { ?>
                    <a href="patient">
                    <?php } ?>
                    <section class="panel">
                        <div class="symbol blue">
                            <i class="fa fa-users"></i>
                        </div>
                        <div class="value">
                            <h1 class="">
                                <?php echo $this->db->count_all('patient'); ?>
                            </h1>
                            <p><?php echo lang('patient'); ?></p>
                        </div>
                    </section>
                    <?php if ($this->ion_auth->in_group('admin')) { ?>
                    </a>
                <?php } ?>
            </div>
            <div class="col-lg-3 col-sm-6">
                <?php if ($this->ion_auth->in_group('admin')) { ?>
                    <a href="nurse">
                    <?php } ?>
                    <section class="panel">
                        <div class="symbol yellow">
                            <i class="fa fa-user"></i>
                        </div>
                        <div class="value">
                            <h1 class="">
                                <?php
                                
                                 $query = $this->db->where('status', 'active')->get('nurse');
                                 $total = $query->num_rows;
                                 echo $total;
                                 //$this->db->count_all('nurse'); ?>
                            </h1>
                            <p><?php echo lang('emp'); ?></p>
                        </div>
                    </section>
                    <?php if ($this->ion_auth->in_group('admin')) { ?>
                    </a>
                <?php } ?>
            </div>
            <div class="col-lg-3 col-sm-6">
                <?php if ($this->ion_auth->in_group('admin')) { ?>
                    <a href="pharmacist">
                    <?php } ?>
                    <section class="panel">
                        <div class="symbol terques">
                            <i class="fa  fa-medkit"></i>
                        </div>
                        <div class="value">
                            <h1 class="">
                                <?php echo $this->db->count_all('pharmacist'); ?>
                            </h1>
                            <p><?php echo lang('pharmacist'); ?></p>
                        </div>
                    </section>
                    <?php if ($this->ion_auth->in_group('admin')) { ?>
                    </a>
                <?php } ?>
            </div>
            <div class="col-lg-3 col-sm-6">
                <?php if ($this->ion_auth->in_group('admin')) { ?>
                    <a href="patient/caseList">
                    <?php } ?>
                    <section class="panel">
                        <div class="symbol blue">
                            <i class="fa fa-medkit"></i>
                        </div>
                        <div class="value">
                            <h1 class="">
                                <?php echo $this->db->count_all('medical_history'); ?>
                            </h1>
                            <p><?php echo lang('case_history'); ?></p>
                        </div>
                    </section>
                    <?php if ($this->ion_auth->in_group('admin')) { ?>
                    </a>
                <?php } ?>
            </div>
            <div class="col-lg-3 col-sm-6">
                <?php if ($this->ion_auth->in_group('admin')) { ?>
                    <a href="patient/documents">
                    <?php } ?>
                    <section class="panel">
                        <div class="symbol yellow">
                            <i class="fa fa-file"></i>
                        </div>
                        <div class="value">
                            <h1 class="">
                                <?php echo $this->db->count_all('patient_material'); ?>
                            </h1>
                            <p><?php echo lang('documents'); ?></p>
                        </div>
                    </section>
                    <?php if ($this->ion_auth->in_group('admin')) { ?>
                    </a>
                <?php } ?>
            </div>
            -->
