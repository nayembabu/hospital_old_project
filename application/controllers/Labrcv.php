<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Labrcv extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('Ion_auth');
        $this->load->library('session');
        $this->load->library('form_validation');
        $this->load->model('labrcv_model');
        $this->load->library('upload');
        $this->load->library('Pdf');
        $language = $this->db->get('settings')->row()->language;
        $this->lang->load('system_syntax', $language);
        $this->load->model('ion_auth_model');
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        if (!$this->ion_auth->in_group(array('admin', 'Accountant', 'Receptionist'))) {
            redirect('home/permission');
        }
    }

    public function index() {
        $data['ptNInfo'] = $this->labrcv_model->getptninfo();
        $loginId = $this->ion_auth->user()->row()->emp_id;
        $data['user_P'] = $this->settings_model->get_log_user($loginId); 

        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('labrcv/index', $data);
        $this->load->view('home/footer'); // just the header file
    }


    public function addnew() {
        $data['doctor'] = $this->labrcv_model->getdoctor();        
        $data['labtest'] = $this->labrcv_model->getlabtest();
        $loginId = $this->ion_auth->user()->row()->emp_id;
        $data['user_P'] = $this->settings_model->get_log_user($loginId); 
  
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('labrcv/addnw', $data);
        $this->load->view('home/footer'); // just the header file
    }

    public function testbill() {
        $tstiid = $this->input->get('tstiid');
        $data['tstinfo'] = $this->labrcv_model->gettestforrate($tstiid);
        echo json_encode($data);
    }

    public function search_patientByID() {
        $serch_Idi = $this->input->get('id');
        $data = $this->labrcv_model->getPatienbyid($serch_Idi);
        echo json_encode($data);
    }

    public function newtest() {    	

        $newlabiidi = 0; // Check last id and inchement    
        $getid = $this->labrcv_model->getlabtstiid();
        $thsyer = date('Y', time());
        $thsmnth = date('m', time());

        if ($thsyer != $getid->thsyear) {
            $newlabiidi = date('y',time()).'00000001';
        }else {
            $newlabiidi = $getid->lab_rgstr_iidd + 1;
        } // Check last id and inchement



        $emp_id         = $this->ion_auth->user()->row()->emp_id;
        $patnname       = $this->input->post('ptnname');
        $patnage        = $this->input->post('ptnage').' '.$this->input->post('ymd');
        $sex            = $this->input->post('gender');
        $drid           = $this->input->post('dctr_id');
        $ttrate         = $this->input->post('ttlrattte');
        $dscntamnt      = $this->input->post('discnt');
        $ttlrcvtaka     = $this->input->post('ttlrcvamnt');
        $outdrnam       = $this->input->post('optdrname');
        $outdrdegre     = $this->input->post('optdrdgre');
        $duerfr         = $this->input->post('hsprfrname');
        $ptnmblno       = $this->input->post('ptnmblno');
        $discntrfstxs   = $this->input->post('discntrfstxs');
        $thistims       = time();
        $thssdateee     = date('Y-m-d', time());

        $dscntamtk = $ttrate - $dscntamnt;
        $dscnt123 = $dscntamtk * 100 / $ttrate;
        $dscntprcntgs = 100 - $dscnt123;

        $ttlduetk = $dscntamtk - $ttlrcvtaka;

        $tstidid        = array($this->input->post('test_iiddd'));
        $tstyp          = array($this->input->post('testtypss'));
        $tstamntk       = array($this->input->post('testtakk'));


        $data = array(
            'lab_rgstr_iidd'        => $newlabiidi, 
            'labpnname'             => $patnname, 
            'labpn_age'             => $patnage, 
            'lbpdr_id'              => $drid, 
            'outdr_name'            => $outdrnam, 
            'outdr_degree'          => $outdrdegre, 
            'gndr'                  => $sex, 
            'ptnmbl'                => $ptnmblno, 
            'emp_id'                => $emp_id, 
            'this_tim'              => $thistims, 
            'this_date'             => $thssdateee, 
            'thsyear'               => $thsyer, 
            'thshmnth'              => $thsmnth,
            'ttl_bill_tk'           => $ttrate, 
            'ttl_dscnt_tk'          => $dscntamnt, 
            'ttl_dscnt_prsnt'       => $dscntprcntgs, 
            'dscnt_name'            => $discntrfstxs, 
            'ttl_due'               => $ttlduetk, 
            'rcv_tak'               => $ttlrcvtaka, 
            'duerfrtxt'             => $duerfr
        );
        $this->labrcv_model->insert_labrcvptn($data);        


        $f_data = [];
        foreach ($tstamntk as $key => $value) {
            foreach ($value as $key1 => $value1) {
                $f_data[] = [
                    'tstamnttaka'       => $tstamntk[$key][$key1],
                    'tstiiddid'         => $tstidid[$key][$key1],
                    'tsttype'           => $tstyp[$key][$key1], 
                    'labptnididid'      => $newlabiidi, 
                    'thssdate'          => $thssdateee, 
                    'thsstimess'        => $thistims
                ];
            }
        }

        $this->labrcv_model->insert_rcvtstinfo($f_data);        

        $this->session->set_flashdata('feedback', 'Test Added'); 




        $link = "<script>window.open('print_memo?labrcvid=$newlabiidi','_blank', 'width=700,height=700,left=260,top=270');window.location.href = 'addnew';</script>";
        echo $link;



    	
    }


    public function print_memo()
    {
        $labrcvidii = $this->input->get('labrcvid');
        $data['patient_info'] = $this->labrcv_model->getLabPatient($labrcvidii);        
        $data['labtest_forprint'] = $this->labrcv_model->getLabTestforP($labrcvidii);        
        $data['department'] = $this->labrcv_model->getLabDepartment();   
        $this->load->view('labrcv/memoprint', $data); 


/*
        // HTML to PDF
        $html = $this->output->get_output();
        $this->dompdf->loadHtml($html);
        $this->dompdf->setPaper('A4', 'portrait');
        $this->dompdf->render();        
        $this->dompdf->stream("Patient_memo.pdf", array("Attachment"=>0));
        //Output Line


*/

    }





















// END Bracket
}







