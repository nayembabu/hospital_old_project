<!DOCTYPE html>
<html lang="en">
    <head>
        <base href="<?php echo base_url(); ?>">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">
        <meta name="keyword" content="Php, Hospital, Clinic, Management, Software, Php, CodeIgniter, Hms, Accounting">
        <link rel="shortcut icon" href="<?php echo $this->db->get('settings')->row()->logo; ?> ">
        <title><?php echo $this->db->get('settings')->row()->system_vendor; ?> </title>

 




        <!-- Bootstrap core CSS -->
        <link href="include/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="include/bootstrap/css/bootstrap-reset.css" rel="stylesheet">
        <link href="include/bootstrap/css/bootstrap-grid.min.css" rel="stylesheet">
        <link href="include/bootstrap/css/bootstrap-reboot.min.css" rel="stylesheet">
        <!-- Bootstrap core CSS -->


        <!-- Bootstrap Date & Time Picker CSS -->        
        <link rel="stylesheet" href="include/bootstrap/bootstrap-datepicker/css/datepicker.css" />
<!--         <link rel="stylesheet" type="text/css" href="include/bootstrap/bootstrap-datetimepicker/css/datetimepicker.css" /> -->
        <link rel="stylesheet" type="text/css" href="include/bootstrap/bootstrap-timepicker/compiled/timepicker.css">
        <!-- Bootstrap Date & Time Picker CSS --> 


        <!-- Data-Table css-->
        <link href="include/assets/DataTables/datatables.min.css" rel="stylesheet" />
        <!-- Data-Table css--> 


        <!--Font Awsome CSS-->
        <link href="include/assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
        <link href="include/assets/fontawesome-free-5.8.2-web/css/all.min.css" rel="stylesheet" />        
        <link rel="stylesheet" type="text/css" href="include/assets/jquery-multi-select/css/multi-select.css" />

        <!--Font Awsome CSS-->

        
        <!-- Custom styles for this template -->
        <link href="include/css/style.css" rel="stylesheet">
        <link href="include/css/style-responsive.css" rel="stylesheet" />
        <link href="include/css/costum.css" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="include/assets/select2/css/select2.min.css"/>
        <!-- Custom styles for this template -->




        <!-- jQuery  for all page  -->
<!--         <link href="include/dropsearch/bootstrap-dropselect.css" rel="stylesheet">
        <script src="include/dropsearch/bootstrap-dropselect.js"></script> -->
        <!-- jQuery  for all page  -->




        <!-- jQuery  for all page  -->
        <script src="include/js/jquery-3.4.1.min.js"></script>
        <script src="include/js/jquery-1.8.3.min.js"></script>
        <!-- jQuery  for all page  -->







    </head>

    <body>

<input type="hidden" id="user_emp_id" name="" value="<?php echo $this->ion_auth->user()->row()->emp_id?>">




        <section id="container" class="">
            <!--header start-->
            <header class="header white-bg">
                <div class="sidebar-toggle-box">
                    <div data-original-title="Toggle Navigation" data-placement="right" class="fas fa-dedent fa-bars tooltips"></div>
                </div>
                <!--logo start-->
                <?php
                $settings_title = $this->db->get('settings')->row()->title;
                $settings_title = explode(' ', $settings_title);
                ?>

                    <div class="msg_box" style="right:10px" rel="skp">
                        <div class="msg_head"><center>Chat </center></div>
                        <div class="msg_wrap" style="display: none;">
                            <div class="msg_body" id="msg_body">
                                <div class="msg_push"></div>
                            </div>
                            <div class="msg_footer">
                                    <input type="text" id="chat" class="msg_input" name="chat" placeholder="Type Your Massage" >
                                    <input type="submit" class="msg_submit" name="" value="send">
                            </div>
                        </div>
                        
                    </div>




                <a href="" class="logo">
                    <strong>
                        <?php echo $settings_title[0]; ?>
                        <span>
                            <?php
                            if (!empty($settings_title[1])) {
                                echo $settings_title[1];
                            }
                            ?>
                        </span>
                    </strong>
                </a>
                <!--logo end-->
                <div class="nav notify-row" id="top_menu">

                    <!--  notification start -->
                    <ul class="nav top-menu">

                    <!--<marquee style="font-size: 20px; font-family: times new roman; font-weight: bold; color: #4F9BB5;" ><?php echo strtoupper('Eid Ul Fitar 2019 Gretings'); ?></marquee>-->


                        <!-- Bed Notification start -->
                        <!--
                        <?php if ($this->ion_auth->in_group(array('admin', 'Doctor', 'Nurse'))) { ?> 
                            <li class="dropdown">
                                <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                    <i class="fa fa-hdd-o"></i>
                                    <span class="badge bg-success">  



                                        <?php
                                        $query = $this->db->get('bed')->result();
                                        $available_bed = 0;
                                        foreach ($query as $bed) {
                                            $last_a_time = explode('-', $bed->last_a_time);
                                            $last_d_time = explode('-', $bed->last_d_time);
                                            if (!empty($last_d_time[1])) {
                                                $last_d_h_am_pm = explode(' ', $last_d_time[1]);
                                                $last_d_h = explode(':', $last_d_h_am_pm[1]);
                                                if ($last_d_h_am_pm[2] == 'AM') {
                                                    $last_d_m = ($last_d_h[0] * 60 * 60) + ($last_d_h[1] * 60);
                                                } else {
                                                    $last_d_m = (12 * 60 * 60) + ($last_d_h[0] * 60 * 60) + ($last_d_h[1] * 60);
                                                }
                                                $last_d_time_s = strtotime($last_d_time[0]) + $last_d_m;
                                                if (time() > $last_d_time_s) {
                                                    $available_bed = $available_bed + 1;
                                                }
                                            } else {
                                                $available_bed = $available_bed + 1;
                                            }
                                        }
                                        echo $available_bed;
                                        ?>

                                    </span>
                                </a>
                                <ul class="dropdown-menu extended tasks-bar">
                                    <div class="notify-arrow notify-arrow-green"></div>
                                    <li>
                                        <p class="green">
                                            <?php
                                            if (!empty($query)) {
                                                echo $available_bed;
                                            } else {
                                                $available_bed = 0;
                                                echo $available_bed;
                                            }
                                            ?> 
                                            <?php
                                            if ($available_bed <= 1) {
                                                echo lang('bed_is_available');
                                            } else {
                                                echo lang('beds_are_available');
                                            }
                                            ?>
                                        </p>
                                    </li>
                                    <?php ?>
                                    <li class="external">
                                        <a href="bed/bedAllotment"><p class="green"><?php
                                                if ($available_bed > 0) {
                                                    echo lang('add_a_allotment');
                                                } else {
                                                    echo lang('no_bed_is_available_for_allotment');
                                                }
                                                ?></p></a>
                                    </li>
                                </ul>
                            </li>
                        <?php } ?>-->
                        <!-- Bed notification end -->
                        <!-- Payment notification start-->
                        <!--
                        <?php if ($this->ion_auth->in_group(array('admin', 'Accountant'))) { ?> 
                            <li id="header_inbox_bar" class="dropdown">
                                <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                    <i class="fa fa-money"></i>
                                    <span class="badge bg-important"> 
                                        <?php
                                        $query = $this->db->get('payment');
                                        $query = $query->result();
                                        foreach ($query as $payment) {
                                            $payment_date = date('y/m/d', $payment->date);
                                            if ($payment_date == date('y/m/d')) {
                                                $payment_number[] = '1';
                                            }
                                        }
                                        if (!empty($payment_number)) {
                                            echo $payment_number = array_sum($payment_number);
                                        } else {
                                            $payment_number = 0;
                                            echo $payment_number;
                                        }
                                        ?>        
                                    </span>
                                </a>
                                <ul class="dropdown-menu extended inbox">
                                    <div class="notify-arrow notify-arrow-red"></div>
                                    <li>
                                        <p class="red"> <?php
                                            echo $payment_number . ' ';
                                            if ($payment_number <= 1) {
                                                echo lang('payment_today');
                                            } else {
                                                echo lang('payments_today');
                                            }
                                            ?></p>
                                    </li>
                                    <li>
                                        <a href="finance/payment"><p class="green"> <?php echo lang('see_all_payments'); ?></p></a>
                                    </li>
                                </ul>
                            </li>
                        <?php } ?>-->
                        <!-- payment notification end -->  
                        <!-- patient notification start-->
                        <!--
                        <?php if ($this->ion_auth->in_group(array('admin', 'Accountant', 'Doctor', 'Nurse', 'Laboratorist'))) { ?> 
                            <li id="header_notification_bar" class="dropdown">
                                <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                    <i class="fa fa-user"></i>
                                    <span class="badge bg-warning">   
                                        <?php
                                        $this->db->where('add_date', date('m/d/y'));
                                        $query = $this->db->get('patient');
                                        $query = $query->result();
                                        foreach ($query as $patient) {
                                            $patient_number[] = '1';
                                        }
                                        if (!empty($patient_number)) {
                                            echo $patient_number = array_sum($patient_number);
                                        } else {
                                            $patient_number = 0;
                                            echo $patient_number;
                                        }
                                        ?>
                                    </span>
                                </a>
                                <ul class="dropdown-menu extended notification">
                                    <div class="notify-arrow notify-arrow-yellow"></div>
                                    <li>
                                        <p class="yellow"><?php
                                            echo $patient_number . ' ';
                                            if ($patient_number <= 1) {
                                                echo lang('patient_registerred_today');
                                            } else {
                                                echo lang('patients_registerred_today');
                                            }
                                            ?> </p>
                                    </li>    
                                    <li>
                                        <a href="patient"><p class="green"><?php echo lang('see_all_patients'); ?></p></a>
                                    </li>
                                </ul>
                            </li>
                        <?php } ?>-->
                        <!-- patient notification end -->  
                        <!-- donor notification start-->
                        <!--
                        <?php if ($this->ion_auth->in_group(array('admin', 'Doctor', 'Nurse', 'Laboratorist', 'Patient'))) { ?> 
                            <li id="header_notification_bar" class="dropdown">
                                <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                    <i class="fa fa-user"></i>
                                    <span class="badge bg-success">       
                                        <?php
                                        $this->db->where('add_date', date('m/d/y'));
                                        $query = $this->db->get('donor');
                                        $query = $query->result();
                                        foreach ($query as $donor) {
                                            $donor_number[] = '1';
                                        }
                                        if (!empty($donor_number)) {
                                            echo $donor_number = array_sum($donor_number);
                                        } else {
                                            $donor_number = 0;
                                            echo $donor_number;
                                        }
                                        ?>
                                    </span>
                                </a>
                                <ul class="dropdown-menu extended notification">
                                    <div class="notify-arrow notify-arrow-yellow"></div>
                                    <li>
                                        <p class="green"><?php
                                            echo $donor_number . ' ';
                                            if ($donor_number <= 1) {
                                                echo lang('donor_registerred_today');
                                            } else {
                                                echo lang('donors_registerred_today');
                                            }
                                            ?> </p>
                                    </li>
                                    <li>
                                        <a href="donor"><p class="green"><?php echo lang('see_all_donors'); ?></p></a>
                                    </li>
                                </ul>
                            </li>
                        <?php } ?>--> 
                        <!-- donor notification end -->  
                        <!-- medicine notification start-->
                        <!--
                        <?php if ($this->ion_auth->in_group(array('admin', 'Pharmacist', 'Doctor'))) { ?> 
                            <li id="header_notification_bar" class="dropdown">
                                <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                    <i class="fa fa-medkit"></i>
                                    <span class="badge bg-success">                          
                                        <?php
                                        $this->db->where('add_date', date('m/d/y'));
                                        $query = $this->db->get('medicine');
                                        $query = $query->result();
                                        foreach ($query as $medicine) {
                                            $medicine_number[] = '1';
                                        }
                                        if (!empty($medicine_number)) {
                                            echo $medicine_number = array_sum($medicine_number);
                                        } else {
                                            $medicine_number = 0;
                                            echo $medicine_number;
                                        }
                                        ?>
                                    </span>
                                </a>
                                <ul class="dropdown-menu extended notification">
                                    <div class="notify-arrow notify-arrow-yellow"></div>
                                    <li>
                                        <p class="yellow"><?php
                                            echo $medicine_number . ' ';
                                            if ($medicine_number <= 1) {
                                                echo lang('medicine_registerred_today');
                                            } else {
                                                echo lang('medicines_registered_today');
                                            }
                                            ?> </p>
                                    </li>
                                    <li>
                                        <a href="medicine"><p class="green"><?php echo lang('see_all_medicines'); ?></p></a>
                                    </li>
                                </ul>
                            </li>
                        <?php } ?> -->
                        <!-- medicine notification end -->  
                        <!-- report notification start-->
                        <!--
                        <?php if ($this->ion_auth->in_group(array('admin', 'Doctor', 'Laboratorist', 'Nurse'))) { ?> 
                            <li id="header_notification_bar" class="dropdown">
                                <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                    <i class="fa fa-hospital-o"></i>
                                    <span class="badge bg-success">                         
                                        <?php
                                        $this->db->where('add_date', date('m/d/y'));
                                        $query = $this->db->get('report');
                                        $query = $query->result();
                                        foreach ($query as $report) {
                                            $report_number[] = '1';
                                        }
                                        if (!empty($report_number)) {
                                            echo $report_number = array_sum($report_number);
                                        } else {
                                            $report_number = 0;
                                            echo $report_number;
                                        }
                                        ?>
                                    </span>
                                </a>
                                <ul class="dropdown-menu extended notification">
                                    <div class="notify-arrow notify-arrow-yellow"></div>
                                    <li>
                                        <p class="yellow"><?php
                                            echo $report_number . ' ';
                                            if ($report_number <= 1) {
                                                echo lang('report_added_today');
                                            } else {
                                                echo lang('reports_added_today');
                                            }
                                            ?> </p>
                                    </li>
                                    <li>
                                        <a href="report"><p class="green"><?php echo lang('see_all_reports'); ?></p></a>
                                    </li>
                                </ul>
                            </li>
                        <?php } ?>
                        <?php if ($this->ion_auth->in_group('Patient')) { ?> 
                            <li id="header_notification_bar" class="dropdown">
                                <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                    <i class="fa fa-hospital-o"></i>
                                    <span class="badge bg-success">                         
                                        <?php
                                        $query = $this->db->get('report');
                                        $query = $query->result();
                                        foreach ($query as $report) {
                                            if ($this->ion_auth->user()->row()->id == explode('*', $report->patient)[1]) {
                                                $report_number[] = '1';
                                            }
                                        }
                                        if (!empty($report_number)) {
                                            echo $report_number = array_sum($report_number);
                                        } else {
                                            $report_number = 0;
                                            echo $report_number;
                                        }
                                        ?>
                                    </span>
                                </a>
                                <ul class="dropdown-menu extended notification">
                                    <div class="notify-arrow notify-arrow-yellow"></div>
                                    <li>
                                        <p class="yellow"><?php
                                            echo $report_number . ' ';
                                            if ($report_number <= 1) {
                                                echo lang('report_is_available_for_you');
                                            } else {
                                                echo lang('reports_are_available_for_you');
                                            }
                                            ?> </p>
                                    </li>
                                    <li>
                                        <a href="report/myreports"><p class="green"><?php echo lang('see_your_reports'); ?></p></a>
                                    </li>
                                </ul>
                            </li>
                        <?php } ?>-->
                        <!-- report notification end -->
                    </ul>
                </div>





                <div class="top-nav ">
                    <?php
                    $message = $this->session->flashdata('feedback');
                    if (!empty($message)) {
                        ?>
                        <div class="flashmessage pull-left"><i class="fas fa-check"></i> <?php echo $message; ?></div>
                    <?php } ?> 
                    <ul class="nav pull-right top-menu">
                        <!-- user login dropdown start-->
                        <li class="dropdown">
                            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                <img alt="" src="<?php echo $user_P->img_url?>" width="40" height="43">
                                <span style="font-size: 18px;" class="username">
                                     <?php echo  $user_P->ename;?>
                                </span>
                                <b class="caret"></b>
                            </a>
                            <ul class="dropdown-menu extended logout">
                                <div class="log-arrow-up"></div>
                                <?php if (!$this->ion_auth->in_group('admin')) { ?> 
                                    <li><a href=""><i class="fas fa-dashboard"></i> <?php echo lang('dashboard'); ?></a></li>
                                <?php } ?>
                                <li><a href="profile"><i class=" fas fa-suitcase"></i><?php echo lang('profile'); ?></a></li>
                                <?php if ($this->ion_auth->in_group('admin')) { ?> 
                                    <li><a href="settings"><i class="fas fa-cog"></i> <?php echo lang('settings'); ?></a></li>
                                <?php } ?>

                                <li><a><i class="fa fa-user"></i> <?php echo $this->ion_auth->get_users_groups()->row()->name ?></a></li>
                                <li><a href="auth/logout"><i class="fa fa-key"></i> <?php echo lang('log_out'); ?></a></li>
                            </ul>
                        </li>
                        
                    </ul>
                </div>

<!--
                <div>
                    <h2 style="font-family: solaimanlipi;">সার্ভার উন্নয়নের কাজ চলছে কোন সমস্যা হলে জানাবেন।</h2>
                </div>-->
            </header>
            <!--header end-->
            <!--sidebar start-->






            <!--sidebar start-->
            <aside>
                <div style="background: <?php echo '#'. $this->db->get('cstyle')->row()->navcolor; ?>" id="sidebar"  class="nav-collapse">
                    <!-- sidebar menu start-->
                    <ul class="sidebar-menu" id="nav-accordion">
                        <li style="background: <?php echo '#'. $this->db->get('cstyle')->row()->navcolor; ?>; color: #000; font-weight: bold;">
                            <a href=""> 
                                <i class="fa fa-home"></i>
                                <span><?php echo lang('dashboard'); ?></span>
                            </a>
                        </li>
                        <?php if ($this->ion_auth->in_group('admin')) { ?>
                            <li style="background: <?php echo '#'. $this->db->get('cstyle')->row()->navcolor; ?>">
                                <a href="department">
                                    <i class="fa fa-sitemap"></i>
                                    <span><?php echo lang('departments'); ?></span>
                                </a>
                            </li>
                        <?php } ?>
                        <?php if ($this->ion_auth->in_group(array('admin'))) { ?>
                            <li> <li  style="background: <?php echo '#'. $this->db->get('cstyle')->row()->navcolor; ?>" class="sub-menu">
                                <a href="javascript:;" >
                                    <i class="fa fa-user-md"></i>
                                    <span><?php echo lang('doctor'); ?></span>
                                </a>
                                <ul class="sub">
                                    <li><a href="doctor"><i class="fa fa-user"></i><?php echo lang('list_of_doctors'); ?></a></li>
                                    <li><a href="appointment/treatmentReport"><i class="fa fa-money"></i><?php echo lang('treatment_history'); ?></a></li>
                                    <li><a href="doctor/drfee"><i class="fa fa-money"></i><?php echo lang('dr_fee'); ?></a></li>
                                </ul>
                            </li>
                        <?php } ?>


                        <?php if ($this->ion_auth->in_group(array('admin'))) { ?>
                            <li> <li  style="background: <?php echo '#'. $this->db->get('cstyle')->row()->navcolor; ?>" class="sub-menu">
                                <a href="javascript:;" >
                                    <i class="fa fa-info-circle"></i>
                                    <span><?php echo lang('bed'); ?></span>
                                </a>
                                <ul class="sub">
                                    <li><a href="bed"><i class="fa fa-check"></i><?php echo lang('bed'); ?></a></li>
                                </ul>
                            </li>
                        <?php } ?>





                        <?php if ($this->ion_auth->in_group(array('admin', 'Accountant', 'Supervisor'))) { ?>
                            <li> <li style="background: <?php echo '#'. $this->db->get('cstyle')->row()->navcolor; ?>" class="sub-menu">
                                <a href="javascript:;" >
                                    <i class="fa fa-wheelchair"></i> 
                                    <span><?php echo lang('patient'); ?></span>
                                </a>
                                <ul class="sub"> 
                                    <li><a href="patient"><i class="fa fa-user"></i><?php echo lang('patient_list'); ?></a></li>

                                    <li><a href="patient/admitreport"><i class="fa fa-user"></i>Admission Report</a></li>
                                </ul>
                            </li>
                        <?php } ?>



                        <?php if ($this->ion_auth->in_group(array('admin', 'Accountant', 'Receptionist', 'Sr_Receptionist'))) { ?>
                            <li> <li  style="background: <?php echo '#'. $this->db->get('cstyle')->row()->navcolor; ?>" class="sub-menu">
                                <a href="javascript:;" >
                                    <i class="fa fa-info-circle"></i>
                                    <span><?php echo lang('reception'); ?></span>
                                </a>
                                <ul class="sub">
                                    <li><a href="reception"><i class="fa fa-check"></i><?php echo lang('ticket'); ?></a></li>
                                    <li><a href="reception/print_total"><i class="fa fa-check"></i><?php echo lang('print').' '.lang('total').' '.lang('ticket'); ?></a></li>

                        <?php if ($this->ion_auth->in_group(array('admin', 'Accountant'))) { ?>
                                    <li><a href="bill"><i class="fa fa-dollar"></i><?php echo lang('create').' '.lang('bill'); ?></a></li>
                            <?php } ?>

                                    <li><a href="bill/bill_receive"><i class="fa fa-search-dollar"></i><?php echo lang('receive').' '.lang('bill'); ?></a></li>

                                    <li><a href="bill/out_ser"><i class="fa fa-dollar"></i><?php echo lang('out').' '.lang('service').' '.lang('bill'); ?></a></li>

                                    <li><a href="bill/statmnt"><i class="fa fa-dollar"></i><?php echo lang('bill').' '.lang('statement'); ?></a></li>


                        <?php if ($this->ion_auth->in_group(array('admin', 'Accountant'))) { ?>
                                    <li><a href="reception/allticket"><i class="fa fa-check"></i><?php echo lang('all').' '.lang('ticket'); ?></a></li>



                                    <li><a href="labrcv/addnew"><i class="fa fa-dollar"></i><?php echo lang('add').' '.lang('test'); ?></a></li>




                        <?php }?>
                                </ul>
                            </li>
                        <?php } ?>


                        <!--
                        <?php if ($this->ion_auth->in_group(array('admin'))) { ?>
                            <li> <li style="background: <?php echo '#'. $this->db->get('cstyle')->row()->navcolor; ?>" class="sub-menu">
                                <a href="javascript:;" >
                                    <i class="fa fa-stethoscope"></i> 
                                    <span><?php echo lang('appointment'); ?></span>
                                </a>
                                <ul class="sub"> 
                                    <li><a href="appointment"><i class="fa fa-list-alt"></i><?php echo lang('all'); ?></a></li>
                                    <li><a href="appointment/addNew"><i class="fa fa-plus-circle"></i><?php echo lang('add'); ?></a></li>
                                    <li><a href="appointment/todays"><i class="fa fa-list-alt"></i><?php echo lang('todays'); ?></a></li>
                                    <li><a href="appointment/upcoming"><i class="fa fa-list-alt"></i><?php echo lang('upcoming'); ?></a></li>
                                </ul>
                            </li>
                        <?php } ?>
                        -->                        
                        <?php if ($this->ion_auth->in_group(array('admin'))) { ?>
                            <li> <li style="background: <?php echo '#'. $this->db->get('cstyle')->row()->navcolor; ?>" class="sub-menu">
                                <a href="javascript:;" >
                                    <i class="fa fa-users"></i>
                                    <span><?php echo lang('human_resources'); ?></span>
                                </a>
                                <ul class="sub">
                                    <li><a href="nurse"><i class="fa fa-user"></i><?php echo lang('emp'); ?></a></li>
                                    <li><a href="nurse/info"><i class="fa fa-info"></i><?php echo lang('empinfo'); ?></a></li>
                                    <li><a href="nurse/nursebnInfo"><i class="fa fa-money"></i>Bangla Entry</a></li>
                                    <li><a href="pharmacist/alup"><i class="fa fa-upload"></i><?php echo lang('uploadattn'); ?></a></li>
                                    <li><a href="pharmacist"><i class="fa fa-th-list "></i><?php echo lang('attend'); ?></a></li>
                                    <li><a href="pharmacist/job_card"><i class="fa fa-align-justify"></i><?php echo lang('job_card'); ?></a></li>
                                    <li><a href="pharmacist/monthly"><i class="fa fa-arrows-alt"></i><?php echo lang('month_attn'); ?></a></li>
                                    <li><a href="pharmacist/salary"><i class="fa fa-money"></i><?php echo lang('sallary'); ?></a></li>
                                </ul>
                            </li>
                        <?php } ?>


                        <?php if ($this->ion_auth->in_group(array('admin', 'Accountant'))) { ?>
                            <li> <li style="background: <?php echo '#'. $this->db->get('cstyle')->row()->navcolor; ?>" class="sub-menu">
                                <a href="javascript:;" >
                                    <i class="fa fa-money"></i>
                                    <span><?php echo lang('account'); ?></span>
                                </a>
                                <ul class="sub">
                                    <li><a href="cashier"><i class="fa fa-donate"></i><?php echo lang('income'); ?></a></li>
                                    <li><a href="cashier/expen"><i class="fa fa-file-invoice-dollar"></i><?php echo lang('expense'); ?></a></li>
                                    <li><a href="cashier/dailyst"><i class="fa fa-list-ol"></i><?php echo lang('diexpen'); ?></a></li>
                                    <li><a href="cashier/bank"><i class="fa fa-list"></i><?php echo lang('bstatement'); ?></a></li>
                                    <li><a href="cashier/miest"><i class="fa fa-bars"></i><?php echo lang('monthlystatement'); ?></a></li>
                                    <li><a href="cashier/particular"><i class="fa fa-list"></i><?php echo lang('add').' '.lang('income').' '.lang('category'); ?></a></li>
                                    <li><a href="cashier/exppart"><i class="fa fa-list"></i><?php echo lang('add').' '.lang('expense').' '.lang('category'); ?></a></li>
                                </ul>
                            </li>
                        <?php } ?>



                    <!--
                        <?php if ($this->ion_auth->in_group('admin')) { ?>
                            <li style="background: <?php echo '#'. $this->db->get('cstyle')->row()->navcolor; ?>" class="sub-menu">
                                <a href="javascript:;" >
                                    <i class="fa fa-dollar"></i>
                                    <span><?php echo lang('financial_activities'); ?></span>
                                </a>
                                <ul class="sub">
                                    <li><a  href="finance/payment"><i class="fa fa-money"></i> <?php echo lang('payments'); ?></a></li>
                                    <li><a  href="finance/addPaymentView"><i class="fa fa-plus-circle"></i><?php echo lang('add_payment'); ?></a></li>
                                    <li><a  href="finance/paymentCategory"><i class="fa fa-edit"></i><?php echo lang('payment_procedures'); ?></a></li>
                                    <li><a  href="finance/expense"><i class="fa fa-money"></i><?php echo lang('expense'); ?></a></li>
									<li><a  href="finance/income"><i class="fa fa-money"></i><?php echo lang('income'); ?></a></li>
									
                                    <li><a  href="finance/addExpenseView"><i class="fa fa-plus-circle"></i><?php echo lang('add_expense'); ?></a></li>
									<li><a  href="finance/addIncomeView"><i class="fa fa-plus-circle"></i><?php echo lang('add_income'); ?></a></li>
									
                                    <li><a  href="finance/expenseCategory"><i class="fa fa-edit"></i><?php echo lang('expense_categories'); ?> </a></li>
									 <li><a  href="finance/incomeCategory"><i class="fa fa-edit"></i><?php echo lang('income_categories'); ?> </a></li>
                                </ul>
                            </li> 
                        <?php } ?>
                    


                        <?php if ($this->ion_auth->in_group('admin')) { ?>
                            <li>
                                <a href="appointment/calendar" >
                                    <i class="fa fa-calendar"></i>
                                    <span> <?php echo lang('calendar'); ?> </span>
                                </a>
                            </li>
                            <li style="background: <?php echo '#'. $this->db->get('cstyle')->row()->navcolor; ?>" class="sub-menu">
                                <a href="javascript:;" >
                                    <i class="fa fa-dollar"></i>
                                    <span><?php echo lang('financial_activities'); ?></span>
                                </a>
                                <ul class="sub">
                                    <li><a  href="finance/payment"><i class="fa fa-money"></i> <?php echo lang('payments'); ?></a></li>
                                    <li><a  href="finance/addPaymentView"><i class="fa fa-plus-circle"></i><?php echo lang('add_payment'); ?></a></li>
                                </ul>
                            </li> 
                        <?php } ?>



                        <?php if ($this->ion_auth->in_group(array('admin'))) { ?>
                            <li style="background: <?php echo '#'. $this->db->get('cstyle')->row()->navcolor; ?>; font-weight: bold; ">
                                <a href="prescription/all" >
                                    <i class="fa fa-stethoscope"></i>
                                    <span> <?php echo lang('prescription'); ?> </span>
                                </a>
                            </li>
                        <?php } ?>

                        <?php
                        if ($this->ion_auth->in_group(array('admin'))) {
                            ?>
                            <li>
                                <a href="finance/UserActivityReport">
                                    <i class="fa fa-dashboard"></i>
                                    <span><?php echo lang('user_activity_report'); ?></span>
                                </a>
                            </li>
                            <?php
                        }
                        ?>
                    -->


                        <?php if ($this->ion_auth->in_group(array('admin', 'Laboratorist'))) { ?>
                            <li> <li  style="background: <?php echo '#'. $this->db->get('cstyle')->row()->navcolor; ?>" class="sub-menu">
                                <a href="javascript:;" >
                                    <i class="fa fa-flask "></i>
                                    <span><?php echo lang('pathology'); ?></span>
                                </a>
                                <ul class="sub">
                                    <li><a href="pathology"><i class="fa fa-user"></i><?php echo lang('user'); ?></a></li>
                                </ul>
                            </li>
                        <?php } ?>



                        <?php if ($this->ion_auth->in_group(array('admin'))) { ?>
                            <li> <li  style="background: <?php echo '#'. $this->db->get('cstyle')->row()->navcolor; ?>" class="sub-menu">
                                <a href="javascript:;" >
                                    <i class="fa fa-x-ray "></i>
                                    <span>X-RAY</span>
                                </a>
                                <ul class="sub">
                                    <li><a href="xray"><i class="fa fa-x-ray"></i>Index</a></li>
                                </ul>
                            </li>
                        <?php } ?>








                        <?php if ($this->ion_auth->in_group(array('admin'))) { ?>
                            <li> <li  style="background: <?php echo '#'. $this->db->get('cstyle')->row()->navcolor; ?>" class="sub-menu">
                                <a href="javascript:;" >
                                    <i class="fa fa-user"></i>
                                    <span><?php echo lang('user_mgnt'); ?></span>
                                </a>
                                <ul class="sub">
                                    <li><a href="usermgnt"><i class="fa fa-user"></i><?php echo lang('user'); ?></a></li>
                                </ul>
                            </li>
                        <?php } ?>



                    <!--
                        <?php if ($this->ion_auth->in_group(array('admin'))) { ?>
                            <li>
                                <a href="prescription">
                                    <i class="fa fa-dashboard"></i>
                                    <span><?php echo lang('prescription'); ?></span>
                                </a>
                            </li>
                        <?php } ?>
                        <?php if ($this->ion_auth->in_group(array('admin'))) { ?>
                            <li style="background: <?php echo '#'. $this->db->get('cstyle')->row()->navcolor; ?>" class="sub-menu">
                                <a href="javascript:;" >
                                    <i class="fa  fa-medkit"></i>
                                    <span><?php echo lang('medicine'); ?></span>
                                </a>
                                <ul class="sub">
                                    <li><a  href="medicine"><i class="fa fa-medkit"></i><?php echo lang('medicine_list'); ?></a></li>
                                    <li><a  href="medicine/addMedicineView"><i class="fa fa-plus-circle"></i><?php echo lang('add_medicine'); ?></a></li>
                                    <li><a  href="medicine/medicineCategory"><i class="fa fa-edit"></i><?php echo lang('medicine_category'); ?></a></li>
                                    <li><a  href="medicine/addCategoryView"><i class="fa fa-plus-circle"></i><?php echo lang('add_medicine_category'); ?></a></li>
                                    <li><a  href="medicine/medicineStockAlert"><i class="fa fa-plus-circle"></i><?php echo lang('medicine_stock_alert'); ?></a></li>

                                </ul>
                            </li>
                        <?php } ?>
                        <?php if ($this->ion_auth->in_group(array('admin'))) { ?>
                            <li style="background: <?php echo '#'. $this->db->get('cstyle')->row()->navcolor; ?>" class="sub-menu">
                                <a href="javascript:;" >
                                    <i class="fa fa-dollar"></i>
                                    <span><?php echo lang('pharmacy'); ?></span>
                                </a>
                                <ul class="sub">
                                    <li><a  href="finance/pharmacy/payment"><i class="fa fa-money"></i> <?php echo lang('sales'); ?></a></li>
                                    <li><a  href="finance/pharmacy/addPaymentView"><i class="fa fa-plus-circle"></i><?php echo lang('add_new_sale'); ?></a></li>
                                    
									<li><a  href="finance/pharmacy/expense"><i class="fa fa-money"></i><?php echo lang('expense'); ?></a></li>
								 <li><a  href="finance/pharmacy/income"><i class="fa fa-money"></i><?php echo lang('income'); ?></a></li>
									 
                                    
									 <li><a  href="finance/pharmacy/addExpenseView"><i class="fa fa-plus-circle"></i><?php echo lang('add_expense'); ?></a></li>
									 <li><a  href="finance/pharmacy/addIncomeView"><i class="fa fa-plus-circle"></i><?php echo lang('add_income'); ?></a></li>
									 
                                    <li><a  href="finance/pharmacy/expenseCategory"><i class="fa fa-edit"></i><?php echo lang('expense_categories'); ?> </a></li>
									 <li><a  href="finance/pharmacy/incomeCategory"><i class="fa fa-edit"></i><?php echo lang('income_categories'); ?> </a></li>
									
                                    <li><a  href="finance/pharmacy/financialReport"><i class="fa fa-book"></i><?php echo lang('pharmacy'); ?> <?php echo lang('report'); ?> </a></li>
                                </ul>
                            </li> 
                        <?php } ?>
                        <?php if ($this->ion_auth->in_group(array('admin'))) { ?>
                            <li style="background: <?php echo '#'. $this->db->get('cstyle')->row()->navcolor; ?>" class="sub-menu">
                                <a href="javascript:;" >
                                    <i class="fa  fa-user"></i>
                                    <span><?php echo lang('donor') ?></span>
                                </a>
                                <ul class="sub">
                                    <li><a  href="donor"><i class="fa fa-user"></i><?php echo lang('donor_list'); ?></a></li>
                                    <li><a  href="donor/addDonorView"><i class="fa fa-plus-circle"></i><?php echo lang('add_donor'); ?></a></li>
                                    <li><a  href="donor/bloodBank"><i class="fa fa-tint"></i><?php echo lang('blood_bank'); ?></a></li>
                                </ul>
                            </li>
                        <?php } ?>
                        <?php if ($this->ion_auth->in_group(array('admin'))) { ?>
                            <li style="background: <?php echo '#'. $this->db->get('cstyle')->row()->navcolor; ?>" class="sub-menu">
                                <a href="javascript:;" >
                                    <i class="fa  fa-hdd-o"></i>
                                    <span><?php echo lang('bed'); ?></span>
                                </a>
                                <ul class="sub">
                                    <li><a  href="bed"><i class="fa fa-hdd-o"></i><?php echo lang('bed_list'); ?></a></li>
                                    <li><a  href="bed/addBedView"><i class="fa fa-plus-circle"></i><?php echo lang('add_bed'); ?></a></li>
                                    <li><a  href="bed/bedCategory"><i class="fa fa-edit"></i><?php echo lang('bed_category'); ?></a></li>
                                    <li><a  href="bed/bedAllotment"><i class="fa fa-plus-square-o"></i><?php echo lang('bed_allotments'); ?></a></li>
                                    <li><a  href="bed/addAllotmentView"><i class="fa fa-plus-circle"></i><?php echo lang('add_allotment'); ?></a></li>
                                </ul>
                            </li>
                        <?php } ?>
                        <?php if ($this->ion_auth->in_group(array('admin'))) { ?>
                            <li style="background: <?php echo '#'. $this->db->get('cstyle')->row()->navcolor; ?>" class="sub-menu">
                                <a href="javascript:;" >
                                    <i class="fa  fa-hospital-o"></i>
                                    <span><?php echo lang('report'); ?></span>
                                </a>
                                <ul class="sub">
                                    <?php if ($this->ion_auth->in_group(array('admin'))) { ?>
                                        <li><a  href="finance/financialReport"><i class="fa fa-book"></i><?php echo lang('financial_report'); ?></a></li>
                                        <li> <a href="finance/AllUserActivityReport">  <i class="fa fa-dashboard"></i>   <span><?php echo lang('user_activity_report'); ?></span> </a></li>
                                    <?php } ?>
                                    <li><a href="patient/diagnosticReport"> <i class="fa fa-book"></i> <span><?php echo lang('diagnostic_report'); ?></span></a> </li>
                                    <li><a  href="report/birth"><i class="fa fa-smile-o"></i><?php echo lang('birth_report'); ?></a></li>
                                    <li><a  href="report/operation"><i class="fa fa-wheelchair"></i><?php echo lang('operation_report'); ?></a></li>
                                    <li><a  href="report/expire"><i class="fa fa-minus-square-o"></i><?php echo lang('expire_report'); ?></a></li>
                                    <?php if ($this->ion_auth->in_group(array('admin'))) { ?>
                                        <li><a  href="finance/doctorsCommission"><i class="fa fa-edit"></i><?php echo lang('doctors_commission'); ?> </a></li>
                                    <?php } ?>
                                </ul>
                            </li>
                        <?php } ?>
                        <?php if ($this->ion_auth->in_group(array('admin'))) { ?>
                            <li style="background: <?php echo '#'. $this->db->get('cstyle')->row()->navcolor; ?>" class="sub-menu">
                                <a href="javascript:;" >
                                    <i class="fa fa-envelope-o"></i>
                                    <span><?php echo lang('sms'); ?></span>
                                </a>
                                <ul class="sub">
                                    <li><a  href="sms/sendView"><i class="fa fa-location-arrow"></i><?php echo lang('write_message'); ?></a></li>
                                    <li><a  href="sms/sent"><i class="fa fa-list-alt"></i><?php echo lang('sent_messages'); ?></a></li>
                                    <?php if ($this->ion_auth->in_group(array('admin'))) { ?>
                                        <li><a  href="sms/settings"><i class="fa fa-gear"></i><?php echo lang('sms_settings'); ?></a></li>
                                    <?php } ?>
                                </ul>
                            </li> 
                        <?php } ?>
                    -->

                        <?php if ($this->ion_auth->in_group(array('admin'))) { ?>

                            <li> <li style="background: <?php echo '#'. $this->db->get('cstyle')->row()->navcolor; ?>" class="sub-menu">
                                <a href="javascript:;" >
                                    <i class="fa fa-cogs"></i>
                                    <span><?php echo lang('settings'); ?></span>
                                </a>
                                <ul class="sub">
                                    <li><a href="settings"><i class="fa fa-gear"></i><?php echo lang('system_settings'); ?></a></li>
                                    <li><a href="settings/language"><i class="fa fa-wrench"></i><?php echo lang('language'); ?></a></li>
                                    <li><a href="settings/backups"><i class="fa fa-smile-o"></i><?php echo lang('backup_database'); ?></a></li>
                                </ul>
                            </li>
                        <?php } ?>


                    <!--
                        <?php if ($this->ion_auth->in_group('admin')) { ?>

                            <li style="background: <?php echo '#'. $this->db->get('cstyle')->row()->navcolor; ?>" class="sub-menu">
                                <a href="javascript:;" >
                                    <i class="fa  fa-hospital-o"></i>
                                    <span><?php echo lang('payments'); ?></span>
                                </a>
                                <ul class="sub">
                                    <li>
                                        <a href="finance/payment" >
                                            <i class="fa fa-money"></i>
                                            <span> <?php echo lang('payments'); ?> </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="finance/addPaymentView" >
                                            <i class="fa fa-plus-circle"></i>
                                            <span> <?php echo lang('add_payment'); ?> </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="finance/paymentCategory" >
                                            <i class="fa fa-edit"></i>
                                            <span> <?php echo lang('payment_procedures'); ?> </span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li>
							//
                                <a href="finance/expense" >
                                    <i class="fa fa-money"></i>
                                    <span> <?php echo lang('expense'); ?> </span>
                                </a>
                            </li>
							
							  <li>
                                <a href="finance/income" >
                                    <i class="fa fa-money"></i>
                                    <span> <?php echo lang('income'); ?> </span>
                                </a>
                            </li>
							
							
							
							
                            <li>
                                <a href="finance/addExpenseView" >
                                    <i class="fa fa-plus-circle"></i>
                                    <span> <?php echo lang('add_expense'); ?> </span>
                                </a>
                            </li>
							
							<li>
                                <a href="finance/addIncomeView" >
                                    <i class="fa fa-plus-circle"></i>
                                    <span> <?php echo lang('add_income'); ?> </span>
                                </a>
                            </li>

							
							
                            <li>
                                <a href="finance/expenseCategory" >
                                    <i class="fa fa-edit"></i>
                                    <span> <?php echo lang('expense_categories'); ?> </span>
                                </a>
                            </li>
							<li>
                                <a href="finance/incomeCategory" >
                                    <i class="fa fa-edit"></i>
                                    <span> <?php echo lang('income_categories'); ?> </span>
                                </a>
                            </li>
							
                            <li>
                                <a href="finance/doctorsCommission" >
                                    <i class="fa fa-edit"></i>
                                    <span> <?php echo lang('doctors_commission'); ?> </span>
                                </a>
                            </li>
                            <li>
                                <a href="finance/financialReport" >
                                    <i class="fa fa-book"></i>
                                    <span> <?php echo lang('financial_report'); ?> </span>
                                </a>
                            </li>
                        <?php } ?>

                        <?php if ($this->ion_auth->in_group('Pharmacist')) { ?>
                            <li>
                                <a href="medicine" >
                                    <i class="fa fa-medkit"></i>
                                    <span> <?php echo lang('medicine_list'); ?> </span>
                                </a>
                            </li>
                            <li>
                                <a href="medicine/addMedicineView" >
                                    <i class="fa fa-plus-circle"></i>
                                    <span> <?php echo lang('add_medicine'); ?> </span>
                                </a>
                            </li>
                            <li>
                                <a href="medicine/medicineCategory" >
                                    <i class="fa fa-medkit"></i>
                                    <span> <?php echo lang('medicine_category'); ?> </span>
                                </a>
                            </li>
                            <li>
                                <a href="medicine/addCategoryView" >
                                    <i class="fa fa-plus-circle"></i>
                                    <span> <?php echo lang('add_medicine_category'); ?> </span>
                                </a>
                            </li>
                        <?php } ?>
                        <?php if ($this->ion_auth->in_group('Nurse')) { ?>
                            <li>
                                <a href="bed" >
                                    <i class="fa fa-hdd-o"></i>
                                    <span> <?php echo lang('bed_list'); ?> </span>
                                </a>
                            </li>
                            <li>
                                <a href="bed/bedCategory" >
                                    <i class="fa fa-edit"></i>
                                    <span> <?php echo lang('bed_category'); ?> </span>
                                </a>
                            </li>
                            <li>
                                <a href="bed/bedAllotment" >
                                    <i class="fa fa-plus-square-o"></i>
                                    <span> <?php echo lang('bed_allotments'); ?> </span>
                                </a>
                            </li>
                            <li>
                                <a href="donor" >
                                    <i class="fa fa-medkit"></i>
                                    <span> <?php echo lang('donor'); ?> </span>
                                </a>
                            </li>
                            <li>
                                <a href="donor/bloodBank" >
                                    <i class="fa fa-tint"></i>
                                    <span> <?php echo lang('blood_bank'); ?> </span>
                                </a>
                            </li>
                        <?php } ?>
                    -->







<!--
                        <?php if ($this->ion_auth->in_group('Patient')) { ?>
                            <li>
                                <a href="donor" >
                                    <i class="fa fa-user"></i>
                                    <span><?php echo lang('donor'); ?></span>
                                </a>
                            </li>
                            <li>
                                <a href="report/myreports" >
                                    <i class="fa fa-user"></i>
                                    <span> <?php echo lang('my_report'); ?> </span>
                                </a>
                            </li>
                            <li>
                                <a href="patient/calendar" >
                                    <i class="fa fa-user"></i>
                                    <span> <?php echo lang('appointment'); ?> <?php echo lang('calendar'); ?> </span>
                                </a>
                            </li>

                        <?php } ?>

                        <?php if ($this->ion_auth->in_group('im')) { ?>
                            <li>
                                <a href="patient/addNewView" >
                                    <i class="fa fa-user"></i>
                                    <span> <?php echo lang('add_patient'); ?> </span>
                                </a>
                            </li>
                            <li>
                                <a href="finance/addPaymentView" >
                                    <i class="fa fa-user"></i>
                                    <span> <?php echo lang('add_payment'); ?>  </span>
                                </a>
                            </li>
                        <?php } ?>
                        <li>
                            <a href="profile" >
                                <i class="fa fa-user"></i>
                                <span> <?php echo lang('profile'); ?> </span>
                            </a>
                        </li>-->

                        <!--multi level menu start-->

                        <!--multi level menu end-->

                    </ul>
                    <!-- sidebar menu end-->
                </div>
            </aside>
            <!--sidebar end-->








