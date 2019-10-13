<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Bill extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('Ion_auth');
        $this->load->library('session');
        $this->load->library('Ciqrcode');
        $this->load->library('form_validation');
        $this->load->model('ion_auth_model');
        $this->load->library('upload');
        $this->load->library('Pdf');
        $language = $this->db->get('settings')->row()->language;
        $this->lang->load('system_syntax', $language);
        $this->load->model('settings_model');
        $this->load->model('doctor_model');
        $this->load->model('patient_model');
        $this->load->model('bill_model');


        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        } 

    }


    public function index() {
        $data['paitents'] = $this->bill_model->getpaitentsforbill();
        $data['doctors'] = $this->bill_model->getDoctor();
        $data['bill_cats'] = $this->bill_model->getbill_cat();
        $loginId = $this->ion_auth->user()->row()->emp_id;
        $data['user_P'] = $this->settings_model->get_log_user($loginId); 
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('bill/bill', $data);
        $this->load->view('home/footer');   // just the footer file     
    }



    public function printbill() {
        $id = $this->input->get('id');
       // $dr_id = $this->input->get('dr_id');
        $data['const_name'] = $this->bill_model->getconststst_name($id);
        $data['conndnd_name'] = $this->bill_model->getconndndnd_name($id);
        //$data['dr_name'] = $this->bill_model->getdr_name($dr_id);
        $data['paitents'] = $this->bill_model->getPatientById($id);
        $data['bills'] = $this->bill_model->getBillById($id);
        $data['advbill'] = $this->bill_model->getadvncBill($id);
        $this->load->view('bill/bill_print', $data);


        // // HTML to PDF
        // $html = $this->output->get_output();
        // $this->dompdf->loadHtml($html);
        // $this->dompdf->setPaper('A4', 'portrait');
        // $this->dompdf->render();        
        // $this->dompdf->stream("Bill.pdf", array("Attachment"=>0));
        // //Output Line

        
    }




    public function editBill() {

        $consultant = $this->input->post('consul');
        $consultantsec = $this->input->post('consul_sec');
        $anesthesiologist = $this->input->post('anesthe');
        $assistant = $this->input->post('assis');
        $time_this = time();
        $p_serial = $this->input->post('id');

        $post_id = array($this->input->post('cat_cid'));
        $post_val = array($this->input->post('cat_cvalue'));
        
        $data = [];
        foreach ($post_id as $key => $value) {
            foreach ($value as $key1 => $value1) {
                $data[] = [
                    'cat_serial'        => $post_id[$key][$key1],
                    'bill_taka'         => $post_val[$key][$key1]
                ];
            }
        }

        $this->bill_model->update_bill_rate($p_serial, $data);

        $i_data = array(
                    'id' => $p_serial,
                    'consultant_id' => $consultant,
                    'consul_sec_id' => $consultantsec,
                    'assistant_id' => $assistant,
                    'anes_id' => $anesthesiologist,
                    'dis_time' => $time_this
            );
        $this->bill_model->update_bill($p_serial, $i_data);
        
        $this->session->set_flashdata('feedback', 'Update Successfully'); 
        redirect('bill');

    }



public function newbill() {

        $consultant = $this->input->post('consul');
        $consultantsec = $this->input->post('consul_sec');
        $anesthesiologist = $this->input->post('anesthe');
        $assistant = $this->input->post('assis');
        $time_this = time();
        $p_serial = $this->input->post('id');
        $p_status = $this->input->post('pStatus');
        $emp_id = $this->ion_auth->user()->row()->emp_id;


        $post_id = array($this->input->post('cat_cid'));
        $post_val = array($this->input->post('cat_cvalue'));

        
        $data = [];
        foreach ($post_id as $key => $value) {
            foreach ($value as $key1 => $value1) {
                $data[] = [
                    'p_serial'        => $p_serial,
                    'cat_serial'        => $post_id[$key][$key1],
                    'bill_taka'         => $post_val[$key][$key1]
                ];
            }
        }

        $this->bill_model->insert_bill($data);

        $i_data = array(
                    'id' => $p_serial,
                    'consultant_id' => $consultant,
                    'consul_sec_id' => $consultantsec,
                    'assistant_id' => $assistant,
                    'anes_id' => $anesthesiologist,
                    'dis_time' => $time_this,
                    'p_stus' => $p_status,
                    'blcrtemp' => $emp_id
            );
        $this->bill_model->update_bill($p_serial, $i_data);        

        $this->session->set_flashdata('feedback', 'Addedd Successfully'); 


        $link = "<script>window.open('bill/printbill?id=$p_serial','_blank', 'width=800,height=800,left=300,top=300');window.location.href = 'bill';</script>";
        echo $link;

    }


    public function bill_receive() {
        $data['paitents'] = $this->bill_model->getpaitentsforbill_receive();
        $data['ptnts'] = $this->bill_model->getptnforadvnc();
        $data['doctors'] = $this->bill_model->getDoctor();
        $data['bill_cats'] = $this->bill_model->getbill_cat();
        $loginId = $this->ion_auth->user()->row()->emp_id;
        $data['user_P'] = $this->settings_model->get_log_user($loginId); 
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('bill/bill_receive', $data);
        $this->load->view('home/footer');    // just the footer file
    }


    public function statmnt() {
        $data['user'] = $this->bill_model->getEmpUser();

        $loginId = $this->ion_auth->user()->row()->emp_id;
        $data['user_P'] = $this->settings_model->get_log_user($loginId); 

        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('bill/statmntView', $data);
        $this->load->view('home/footer');   // just the footer file
    }



    public function ptninfoforadvncajax() {
        $ptnniid = $this->input->get('ptnniid');
        $data['ptnninffo'] = $this->bill_model->getptnninfooo($ptnniid);
        echo json_encode($data);
    }


    public function advbll() {
        $ptniidd = $this->input->post('ptniidd');
        $advtk = $this->input->post('advtk');
        $nowtime = time();
        $ndate = date('Y-m-d', $nowtime);
        $emp_id = $this->ion_auth->user()->row()->emp_id;

        $fdata = array(
            'ptnss_iid' => $ptniidd,
            'adbbll_taka' => $advtk,
            'advn_date' => $ndate,
            'adv_time' => $nowtime,
            'blrcv_emp' => $emp_id
        );
        $this->bill_model->insertadvncbill($fdata);

        $rdata = array(
            'p_iid' => $ptniidd,
            'bill_cat_taka' => $advtk,
            'insert_date' => $ndate,
            'emp_id' => $emp_id,
            'bill_cat_id' => '41',
            'p_stas' => 'indoor'
        );
        $this->bill_model->insertrcvbill($rdata);

        $pndata = array(
            'brdate' => $ndate,
            'briddd' => $emp_id,
            'p_stus' => 'indoor'
        );
        $this->bill_model->updateptninfo($pndata, $ptniidd);

        $link = "<script>window.open('bill/advbprint?ptnid=$ptniidd','_blank', 'width=700,height=700,left=260,top=270');window.location.href = 'bill_receive';</script>";
        echo $link;

    }



    public function advbprint() {


        $ptnniid = $this->input->get('ptnid');
        $data['paitents'] = $this->bill_model->getptnninfooo($ptnniid);
        $data['rcvamnt'] = $this->bill_model->getadvtk($ptnniid);

        $this->load->view('bill/printadvbl', $data);
    }





    public function stmntUserID() {
         $emp_id = $this->input->get('emp_id');
         $tmp_date = $this->input->get('date');
         $qu_date = date('Y-m-d', strtotime($tmp_date));
         $data['b_cr_sum'] = $this->bill_model->cr_b_sum();
         $data['rcvbiiil'] = $this->bill_model->getrcvBillUsr($emp_id, $qu_date);
         $data['cmsbl'] = $this->bill_model->getcmsBlUr($emp_id, $qu_date);
         $data['ptninfo'] = $this->bill_model->getptninfoo($qu_date, $emp_id);
         $data['outptnsr'] = $this->bill_model->getoutptnsrc($qu_date, $emp_id);

        $this->load->view('bill/userwisestmnt', $data);


        // HTML to PDF
        $html = $this->output->get_output();
        $this->dompdf->loadHtml($html);
        $this->dompdf->setPaper('A4', 'portrait');
        $this->dompdf->render();        
        $this->dompdf->stream("Bill.pdf", array("Attachment"=>0));
        //Output Line

     } 




    public function out_ser() {

        $data['p_out_service'] = $this->bill_model->getOut_patient();
        $data['doctors'] = $this->bill_model->getDoctorforout();
        $data['bill_cats'] = $this->bill_model->getBlCts();
        $data['ooutPtnn'] = $this->bill_model->getAlloutP();
        $loginId = $this->ion_auth->user()->row()->emp_id;
        $data['user_P'] = $this->settings_model->get_log_user($loginId); 

        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('bill/out_ser', $data);
        $this->load->view('home/footer');   // just the footer file
    }


    public function receive_bill()
    {
        $time = time();
        $b_date = date('Y-m-d', $time);
        $emp_id = $this->ion_auth->user()->row()->emp_id;

        $bill_commis_tk = array($this->input->post('nd_cummis_tk'));

        $post_d = array($this->input->post('cat_cid'));
        $post_tk_val = array($this->input->post('cat_cvalue'));

        $bill_commis_no = array($this->input->post('nd_cummis_no'));
        $bill_commis = array($this->input->post('nd_cummis'));

        $p_id = $this->input->post('id');
        $p_stas = $this->input->post('p_stas');
        $p_name = $this->input->post('name');
        $dr_id = $this->input->post('dr_id_ap');
        $dcr_fee = $this->input->post('dr_tc_fee');
        $hos_fee = $this->input->post('hs_tc_fee');


        $constIddI = $this->input->post('conFrRrstId');
        $conssTdcfee = $this->input->post('conFrstTK');
        $conSsthosFee = $this->input->post('conFstHosTK');


        $connddIddI = $this->input->post('conNdddNiDi');
        $connDddcfee = $this->input->post('consNndDDTK');
        $conNnDhosFee = $this->input->post('consNddNCfFee');


        $drFrstTcccctID = $this->input->post('drFrstTcccctID');
        $drFrstTctDrFee = $this->input->post('drFrstTctDrFee');
        $hospTctDrFee = $this->input->post('hospTctDrFee');

        $data = [];
        foreach ($post_tk_val as $key => $value) {
            foreach ($value as $key1 => $value1) {
                $data[] = [
                    'bill_cat_taka'        => $post_tk_val[$key][$key1],
                    'bill_cat_id'        => $post_d[$key][$key1],
                    'insert_date'         => $b_date,
                    'emp_id'        => $emp_id,
                    'p_iid'        => $p_id,
                    'p_stas'        => $p_stas
                ];
            }
        }

        $this->bill_model->insert_receive_bill($data);




            $c_data = [];
            foreach ($post_tk_val as $keys => $valuess) {
                foreach ($valuess as $keys1 => $values1) {
                    $c_data[] = [
                        'nd_cummis_tk'        => $bill_commis_tk[$keys][$keys1],
                        'nd_cummis_no'        => $bill_commis_no[$keys][$keys1],
                        'nd_cummis'        => $bill_commis[$keys][$keys1],
                        'a_date'         => $b_date,
                        'p_iid'        => $p_id,
                        'p_stas'        => $p_stas,
                        'emp_id'        => $emp_id
                    ];
                }
            }
        $this->bill_model->insert_bill_cumms($c_data);


        $data = array(
            'ok'         => '1', 
            'brdate'     => $b_date,
            'briddd'     => $emp_id,
            'bllrcvtime' => $time
        );
        $this->bill_model->p_end($p_id, $data);




        if (!empty($hos_fee)) {
            $data = array(
                'serial' => 'indoor',
                'patient' => $p_name,
                'dr_id' => $dr_id,
                'ap_date' => $b_date,
                'thisdate' => $b_date,
                'emp_id' => $emp_id,
                'doctor_fee' => $dcr_fee,
                'hospital_fee' => $hos_fee,
                'print' => 'printed',
                'paid' => 'paid', 
                'a_p_iid' => $p_id
            );
            $this->bill_model->app_ins($data);
        }


        if (!empty($conSsthosFee)) {
            $data = array(
                'serial' => 'indoor',
                'patient' => $p_name,
                'dr_id' => $constIddI,
                'ap_date' => $b_date,
                'thisdate' => $b_date,
                'emp_id' => $emp_id,
                'doctor_fee' => $conssTdcfee,
                'hospital_fee' => $conSsthosFee,
                'print' => 'printed',
                'paid' => 'paid', 
                'a_p_iid' => $p_id
            );
            $this->bill_model->app_ins($data);
        }



        if (!empty($conNnDhosFee)) {
            $data = array(
                'serial' => 'indoor',
                'patient' => $p_name,
                'dr_id' => $connddIddI,
                'ap_date' => $b_date,
                'thisdate' => $b_date,
                'emp_id' => $emp_id,
                'doctor_fee' => $connDddcfee,
                'hospital_fee' => $conNnDhosFee,
                'print' => 'printed',
                'paid' => 'paid', 
                'a_p_iid' => $p_id
            );
            $this->bill_model->app_ins($data);
        }


        if (!empty($drFrstTctDrFee)) {
            $data = array(
                'serial' => 'indoor',
                'patient' => $p_name,
                'dr_id' => $dr_id,
                'ap_date' => $b_date,
                'thisdate' => $b_date,
                'emp_id' => $emp_id,
                'doctor_fee' => $drFrstTctDrFee,
                'hospital_fee' => $hospTctDrFee,
                'print' => 'printed',
                'paid' => 'paid', 
                'a_p_iid' => $p_id
            );
            $this->bill_model->app_ins($data);
        }


        $link = "<script>window.open('bill/print_receive_bill?id=$p_id&dr_id=$dr_id','_blank', 'width=800,height=800,left=300,top=300');window.location.href = 'bill_receive';</script>";
        echo $link;




       $this->session->set_flashdata('feedback', 'Bill Received'); 
//       redirect('bill/bill_receive');

    }



// Edit Receive Bill
    public function editReceiveBill()
    {
        $time = time();
        $b_date = date('Y-m-d', $time);
        $emp_id = $this->ion_auth->user()->row()->emp_id;

        $bill_commis_tk = array($this->input->post('nd_cummis_tk'));

        $post_d = array($this->input->post('cat_cid'));
        $post_tk_val = array($this->input->post('cat_cvalue'));

        $bill_commis_no = array($this->input->post('nd_cummis_no'));
        $bill_commis = array($this->input->post('nd_cummis'));

        $p_id = $this->input->post('id');
        $p_stas = $this->input->post('p_stas');
        $p_name = $this->input->post('name');
        $dr_id = $this->input->post('dr_id_ap');
        $dcr_fee = $this->input->post('dr_tc_fee');
        $hos_fee = $this->input->post('hs_tc_fee');

        $constIddI = $this->input->post('conFrRrstId');
        $conssTdcfee = $this->input->post('conFrstTK');
        $conSsthosFee = $this->input->post('conFstHosTK');

        $connddIddI = $this->input->post('conNdddNiDi');
        $connDddcfee = $this->input->post('consNndDDTK');
        $conNnDhosFee = $this->input->post('consNddNCfFee');

        $drFrstTcccctID = $this->input->post('drFrstTcccctID');
        $drFrstTctDrFee = $this->input->post('drFrstTctDrFee');
        $hospTctDrFee = $this->input->post('hospTctDrFee');

        $data = [];
        foreach ($post_tk_val as $key => $value) {
            foreach ($value as $key1 => $value1) {
                $data[] = [
                    'bill_cat_taka'        => $post_tk_val[$key][$key1],
                    'bill_cat_id'        => $post_d[$key][$key1]
                ];
            }
        }
        $this->bill_model->update_receive_bill($p_id, $data);



            $c_data = [];
            foreach ($post_tk_val as $keys => $valuess) {
                foreach ($valuess as $keys1 => $values1) {
                    $c_data[] = [
                        'nd_cummis_tk'        => $bill_commis_tk[$keys][$keys1],
                        'nd_cummis_no'        => $bill_commis_no[$keys][$keys1],
                        'nd_cummis'        => $bill_commis[$keys][$keys1]
                    ];
                }
            }
        $this->bill_model->update_bill_cumms($p_id, $c_data);



        if (!empty($hos_fee)) {
            $apData = array(
                'patient' => $p_name,
                'dr_id' => $dr_id,
                'doctor_fee' => $dcr_fee,
                'hospital_fee' => $hos_fee
            );
            $this->bill_model->app_updt($p_id, $apData);
        }


        if (!empty($conSsthosFee)) {
            $apData = array(
                'patient' => $p_name,
                'dr_id' => $constIddI,
                'doctor_fee' => $conssTdcfee,
                'hospital_fee' => $conSsthosFee
            );
            $this->bill_model->app_updt($p_id, $apData);
        }


        if (!empty($conNnDhosFee)) {
            $apData = array(
                'patient' => $p_name,
                'dr_id' => $connddIddI,
                'doctor_fee' => $connDddcfee,
                'hospital_fee' => $conNnDhosFee
            );
            $this->bill_model->app_updt($p_id, $apData);
        }


        if (!empty($drFrstTctDrFee)) {
            $apData = array(
                'patient' => $p_name,
                'dr_id' => $dr_id,
                'doctor_fee' => $drFrstTctDrFee,
                'hospital_fee' => $hospTctDrFee
            );
            $this->bill_model->app_updt($p_id, $apData);
        }

        
       $this->session->set_flashdata('feedback', 'Bill Updated'); 
       redirect('bill/bill_receive');

    }
// Edit Receive Bill





    public function add_out_patient() {
        $dr_name = $this->input->post('dr_id');
        $o_p_name = $this->input->post('out_p_name');
        $p_age = $this->input->post('age');

        $pStss = $this->input->post('stssas');

        $ser_c_num = array($this->input->post('ser_cat_iid'));
        $ser_tk = array($this->input->post('ser_tk'));

        $com_name = array($this->input->post('comms_name'));
        $com_tk = array($this->input->post('ser_comms_tk'));

        $emp_id = $this->ion_auth->user()->row()->emp_id;

        $temp_time = time();
        $tmp_date = date('Y-m-d', $temp_time);

        $rand1 = rand(10, 10000000);
        $rand2 = rand(100, 10000);
        $rand3 = rand(10, 10000);
        $rand4 = rand(1, 100);



        $outptnddi = $this->bill_model->getOut_patientiid();

        $outPtnId = $outptnddi->id + 1;



        $out_p_id = $rand1 + $rand2 + $rand3 + $rand4;

            $data = [];
            foreach ($ser_tk as $keys => $val) {
                foreach ($val as $key1 => $valu1) {
                    $data[] = [
                        'bill_cat_id'     => $ser_c_num[$keys][$key1],
                        'bill_cat_taka'   => $ser_tk[$keys][$key1],
                        'insert_date'     => $tmp_date,
                        'out_p_iid'       => $outPtnId,
                        'p_stas'          => $pStss,
                        'emp_id'          => $emp_id
                    ];
                }
            }
        $this->bill_model->insert_receive_bill($data);

            $c_data = [];
            foreach ($ser_tk as $keys => $val) {
                foreach ($val as $key1 => $valu1) {
                    $c_data[] = [
                        'nd_cummis_tk'          => $com_tk[$keys][$key1],
                        'nd_cummis_no'          => $ser_c_num[$keys][$key1],
                        'nd_cummis'             => $com_name[$keys][$key1],
                        'a_date'                => $tmp_date,
                        'out_p_iid'             => $outPtnId,
                        'p_stas'                => $pStss
                    ];
                }
            }
        $this->bill_model->insert_bill_cumms($c_data);

        $out_data = array(
                    'out_p_iid'         => $outPtnId,
                    'out_p_name'        => $o_p_name,
                    'age'               => $p_age,
                    'th_time'           => $temp_time,
                    'dr_name'           => $dr_name,
                    'add_date'          => $tmp_date,
                    'p_stas'            => $pStss,
                    'emp_id'            => $emp_id
            );
        $this->bill_model->insert_out_p($out_data);

        $this->session->set_flashdata('feedback', 'Addedd Successfully'); 
        redirect('bill/out_ser');
    }

    public function add_dntlsrvc() {
        $dr_name = $this->input->post('dr_id');
        $o_p_name = $this->input->post('out_p_name');
        $p_age = $this->input->post('age');

        $ser_c_num = $this->input->post('dntlsc');
        $ser_tk = $this->input->post('hss_tak');

        $com_name = $this->input->post('cums_nem');
        $com_tk = $this->input->post('dntldrtaka');

        $emp_id = $this->ion_auth->user()->row()->emp_id;



        $outptnddi = $this->bill_model->getOut_patientiid();

        $outPtnId = $outptnddi->id + 1;

        $temp_time = time();
        $tmp_date = date('Y-m-d', $temp_time);

        $rand1 = rand(10, 10000000);
        $rand2 = rand(100, 10000);
        $rand3 = rand(10, 10000);
        $rand4 = rand(1, 100);
        $out_p_id222220 = $rand1 + $rand2 + $rand3 + $rand4;

        $out_p_id = $outPtnId;

            $data = array(
                        'bill_cat_id'     => $ser_c_num,
                        'bill_cat_taka'   => $ser_tk,
                        'insert_date'     => $tmp_date,
                        'out_p_iid'       => $out_p_id,
                        'p_stas'          => 'dntlser',
                        'emp_id'          => $emp_id
                    );
        $this->bill_model->insert_rrcv_bill($data);

            $c_data = array(
                        'nd_cummis_tk'          => $com_tk,
                        'nd_cummis_no'          => $ser_c_num,
                        'nd_cummis'             => $com_name,
                        'a_date'                => $tmp_date,
                        'out_p_iid'             => $out_p_id,
                        'p_stas'                => 'dntlser'
                    );
        $this->bill_model->insert_bl_cums($c_data);

        $out_data = array(
                    'out_p_iid'         => $out_p_id,
                    'out_p_name'        => $o_p_name,
                    'age'               => $p_age,
                    'th_time'           => $temp_time,
                    'dr_name'           => $dr_name,
                    'add_date'          => $tmp_date,
                    'p_stas'            => 'dntlser',
                    'emp_id'            => $emp_id
            );
        $this->bill_model->insert_out_p($out_data);


        $this->session->set_flashdata('feedback', 'Addedd Successfully'); 
        redirect('bill/out_ser');
    }

    public function optstmntview() {
        $monthss    = $this->input->get('mnt');
        $years      = $this->input->get('year');
        $optsn      = $this->input->get('opts');


        $data['opt_vew'] = $this->bill_model->getoptstsntvew($monthss, $years, $optsn);
        $data['opt_vw'] = $this->bill_model->getoptinblcum($monthss, $years);
        $data['opt_v'] = $this->bill_model->getoptoutptn($monthss, $years);






        $this->load->view('bill/alloptsstatement', $data);


    }













    public function print_receive_bill() {
        $id = $this->input->get('id');
        $dr_id = $this->input->get('dr_id');
        $data['dr_name'] = $this->bill_model->getdr_name($dr_id);
        $data['paitents'] = $this->bill_model->getPatientById($id);
        $data['pnts'] = $this->bill_model->getPatientfor_rbp($id);
        $data['pacon'] = $this->bill_model->getconnam($id);
        $data['connnd'] = $this->bill_model->getconnndnam($id);
        $data['bills'] = $this->bill_model->getBillById($id);
        $data['r_bill'] = $this->bill_model->getRcBillById($id);
        $data['bill_cumms'] = $this->bill_model->getBillCummsById($id);
        $data['app_tk'] = $this->bill_model->getAppTkById($id);
        $data['creat_b_sum'] = $this->bill_model->creat_bill_sum($id);
        $data['receiv_b_sum'] = $this->bill_model->receiv_bill_sum($id);
        $data['b_commis_sum'] = $this->bill_model->bill_cummis_sum($id);
        $this->load->view('bill/receive_bill_print', $data);








        // // HTML to PDF
        // $html = $this->output->get_output();
        // $this->dompdf->loadHtml($html);
        // $this->dompdf->setPaper('A4', 'portrait');
        // $this->dompdf->render();        
        // $this->dompdf->stream("Bill.pdf", array("Attachment"=>0));
        // //Output Line
    }


    public function print_out_bill() {
        $out_p_id = $this->input->get('id');
        $data['paitents'] = $this->bill_model->getOutPatientBy_id($out_p_id);
        $data['r_bill'] = $this->bill_model->getRcOutBillById($out_p_id);
        $data['bill_cumms'] = $this->bill_model->getOutBillCummsById($out_p_id);
        $this->load->view('bill/out_b_print', $data);

        // // HTML to PDF
        // $html = $this->output->get_output();
        // $this->dompdf->loadHtml($html);
        // $this->dompdf->setPaper('A4', 'portrait');
        // $this->dompdf->render();        
        // $this->dompdf->stream("Bill.pdf", array("Attachment"=>0));
        // //Output Line
    }


    public function print_indoor_statement() {
        $optss = $this->input->get('optss');
        $id_date = $this->input->get('date');
        $data['date'] = $this->input->get('date');
        $qu_date = date('Y-m-d', strtotime($id_date));
        $data['b_cr_sum'] = $this->bill_model->cr_b_sum();
        $data['b_com_sum'] = $this->bill_model->b_coms();
        $data['b_recv_sum'] = $this->bill_model->b_recv($qu_date);
        $data['empusr'] = $this->bill_model->getUsrEmp();
        $data['b_t_sum'] = $this->bill_model->bill_total_sumOpt($optss, $qu_date);
        $data['cnt_opt'] = $this->bill_model->contb_opt($optss, $qu_date);
        $this->load->view('bill/indoor_statem', $data);


        // HTML to PDF
        $html = $this->output->get_output();
        $this->dompdf->loadHtml($html);
        $this->dompdf->setPaper('A4', 'portrait');
        $this->dompdf->render();        
        $this->dompdf->stream("indoor_statement".'-'.$id_date.".pdf", array("Attachment"=>0));
        //Output Line
    }



    public function satssum()
    { 
        $id_date = $this->input->get('date');
        $qu_date = date('Y-m-d', strtotime($id_date));
        $data['date'] = date('d-m-Y',strtotime($qu_date));
        $data['in_ttl_bill'] = $this->bill_model->bill_total_summar();
        $data['in_cum_bill'] = $this->bill_model->bill_cumm_summar($qu_date);
        $data['in_r_bill'] = $this->bill_model->bill_recv_bill($qu_date);
        $data['out_bill'] = $this->bill_model->bill_outsr_bill($qu_date);
        $data['cnt_opt'] = $this->bill_model->patientForStatemnt($qu_date);



        $this->load->view('bill/stas_sum', $data);


        // HTML to PDF
        $html = $this->output->get_output();
        $this->dompdf->loadHtml($html);
        $this->dompdf->setPaper('A4', 'portrait');
        $this->dompdf->render();        
        $this->dompdf->stream("indoor_statement".'_'.$id_date.".pdf", array("Attachment"=>0));
        //Output Line
    }




    public function statementSums()
    { 
        $id_date = $this->input->get('date');
        $last_Date = $this->input->get('lastdate');
        $qu_date = date('Y-m-d', strtotime($id_date));
        $lAst_Dates = date('Y-m-d', strtotime($last_Date));
        $data['date'] = date('d-m-Y',strtotime($qu_date));
        $data['last_date'] = date('d-m-Y',strtotime($lAst_Dates));
        $data['in_ttl_bill'] = $this->bill_model->bill_total_summar();

        $data['in_cum_bill'] = $this->bill_model->bill_cumm_sums($qu_date, $lAst_Dates);
        $data['in_r_bill'] = $this->bill_model->bill_recv_bils($qu_date, $lAst_Dates);
        $data['out_bill'] = $this->bill_model->bill_out_bills($qu_date, $lAst_Dates);
        $data['cnt_opt'] = $this->bill_model->patientForStatemntss($qu_date, $lAst_Dates);



        $this->load->view('bill/stas_sum', $data);


        // HTML to PDF
        $html = $this->output->get_output();
        $this->dompdf->loadHtml($html);
        $this->dompdf->setPaper('A4', 'portrait');
        $this->dompdf->render();        
        $this->dompdf->stream("indoor_statement".'_'.$id_date.".pdf", array("Attachment"=>0));
        //Output Line
    }



    public function print_full_statement() {
         $id_date = $this->input->get('date');
         $data['date'] = $this->input->get('date');
         $qu_date = date('Y-m-d', strtotime($id_date));
         $data['b_cr_sum'] = $this->bill_model->cr_b_sum();
         $data['b_com_sum'] = $this->bill_model->b_coms();
         $data['b_recv_sum'] = $this->bill_model->b_recv($qu_date);
         $data['out_p_r'] = $this->bill_model->out_patient($qu_date);
         $data['b_t_sum'] = $this->bill_model->billForStatmnt($qu_date);
         $data['cnt_opt'] = $this->bill_model->patientForStatemnt($qu_date);
         $data['pat_consst'] = $this->bill_model->patientForConssst($qu_date);
         $this->load->view('bill/daily_ind_statmnt', $data);


        // HTML to PDF
        $html = $this->output->get_output();
        $this->dompdf->loadHtml($html);
        $this->dompdf->setPaper('A4', 'portrait');
        $this->dompdf->render();        
        $this->dompdf->stream("indoor_statement".'-'.$id_date.".pdf", array("Attachment"=>0));
        //Output Line
    }



    function dr_name() {
        $dr_id = $this->input->get('dr_id');
        $data['dr_id_name'] = $this->bill_model->getdr_name($dr_id);
        echo json_encode($data);
    }



    function dr_con_name() {
        $dr_id = $this->input->get('conssst');
        $data['con_id_name'] = $this->bill_model->getdr_name($dr_id);
        echo json_encode($data);
    }



    function dr_t_fee() {
        $dr_id = $this->input->get('dr_id');
        $data['dr_id_fee'] = $this->bill_model->get_dr_fee($dr_id);
        echo json_encode($data);
    }



    function bill_rate() {
        $p_id = $this->input->get('p_id');
        $data = $this->bill_model->getBill_rates($p_id);
        echo json_encode($data);

    }



    function bill_cat_rate() {
        $cat_id = $this->input->get('cat_id');
        $data['cat_rat'] = $this->bill_model->getBill_cat_rat($cat_id);
        echo json_encode($data);
    }




    function bill_ratess() {
        $p_id = $this->input->get('p_id');
        $data = $this->bill_model->getBill_rate_r($p_id);
        echo json_encode($data);
    }



    function bed_bill() {
        $bed_no = $this->input->get('bed_no');
        $data['bed_no_tk'] = $this->bill_model->getbed_taka($bed_no);
        echo json_encode($data);
    }




    function bill_ok() {
        $p_id = $this->input->get('ok');
        $data = array(
            'ok' => '1' 
        );
        $this->bill_model->p_end($p_id, $data);
    }


    function getDoctorByAllId() {
        $cons = $this->input->get('con');
        $data['con_name'] = $this->bill_model->getcon_name($cons);
        echo json_encode($data);
    }


    function getuserByJason() {
        $empid = $this->input->get('uid');
        $data['ugroup'] = $this->bill_model->getuserssbyid($empid);
        echo json_encode($data);
    }


// Bill New
    function getBillcatByJson() {
        $data = $this->bill_model->getBillCat();
        echo json_encode($data);
    }


    function editPatientByJason() {
        $id = $this->input->get('id');
        $data['patient'] = $this->bill_model->getPatientByI($id);

        // $data['drIdNamm'] = $this->bill_model->getPdRIIId($id);
        // $data['conSStNamm'] = $this->bill_model->getPConssst($id);
        // $data['conNNddNam'] = $this->bill_model->getpConNddd($id);
        
        echo json_encode($data);
    }



    function editPatientByIIIId() {
        $id = $this->input->get('id');
        $data['patient'] = $this->bill_model->getPatientByI($id);
        $data['drIdNamm'] = $this->bill_model->getPdRIIId($id);
        $data['conSStNamm'] = $this->bill_model->getPConssst($id);
        $data['conNNddNam'] = $this->bill_model->getpConNddd($id);        


        $data['dr_tckt_fee'] = $this->bill_model->getDrtctFeess($id);
        $data['const_tckt_feeee'] = $this->bill_model->getconSTTtctFeess($id);        
        $data['connd_tckt_feeee'] = $this->bill_model->getconNDDtctFeess($id);        


        echo json_encode($data);
    }


    function getUserEmpFbill() {
        $data['empuser'] = $this->bill_model->getUserEmp();
        $data['allRRBill'] = $this->bill_model->getreceivBill();
        $this->load->view('bill/billpforstatmnt', $data);
    }



    function billdelete() {
        $id[] = $this->input->get('id');
        foreach ($id as $p_id) {
         $this->bill_model->delete($id);   
        }
        $this->session->set_flashdata('feedback', 'Deleted');
        redirect('bill');
    }














//End Bracket
}
