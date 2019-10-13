<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Cashier extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('Ion_auth');
        $this->load->library('session');
        $this->load->library('form_validation');
        $this->load->model('ion_auth_model');
        $this->load->library('upload');
        $this->load->library('Pdf'); // for PDF view
        $language = $this->db->get('settings')->row()->language;
        $this->lang->load('system_syntax', $language);
        $this->load->model('settings_model');
        $this->load->model('cashier_model');
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        } 
        if (!$this->ion_auth->in_group(array('admin', 'Accountant'))) {
            redirect('home/permission');
        }
    }



// Daily Income Controller

    public function index() {
        $data = array();
        $data['incomes'] = $this->cashier_model->getincome();
        $data['cats'] = $this->cashier_model->getcat();
        $loginId = $this->ion_auth->user()->row()->emp_id;
        $data['user_P'] = $this->settings_model->get_log_user($loginId); 

        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('cashier/incom', $data);
        $this->load->view('home/footer');
    }

// Daily Income By Date
    public function daily() {
        $stdate = $this->input->post('date');
        $target = date('Y-m-d', strtotime($stdate));
        $data['incomes'] = $this->cashier_model->getincomedaily($target);
        $data['cats'] = $this->cashier_model->getcat();
        $loginId = $this->ion_auth->user()->row()->emp_id;
        $data['user_P'] = $this->settings_model->get_log_user($loginId); 

        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('cashier/dailyincome', $data);
        $this->load->view('home/footer'); // just the header file
    }

// Income Partucular/Category
    public function particular() {
        $data['cats'] = $this->cashier_model->getcat();
        $loginId = $this->ion_auth->user()->row()->emp_id;
        $data['user_P'] = $this->settings_model->get_log_user($loginId); 

        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('cashier/particular', $data);
        $this->load->view('home/footer'); // just the header file
    }


// Expense Partucular/Category
    public function exppart() {
        $data['exps'] = $this->cashier_model->getexcat();
        $loginId = $this->ion_auth->user()->row()->emp_id;
        $data['user_P'] = $this->settings_model->get_log_user($loginId); 

        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('cashier/exppart', $data);
        $this->load->view('home/footer'); // just the header file
    }


// add Income Partucular/Category
    public function incomepart() {
        $cat_name = $this->input->post('cat_name');
        $status = $this->input->post('status');
        $list = $this->input->post('list');
        $data = array(
                    'list' => $list,
                    'stus' => $status,
                    'category' => $cat_name
            );
        $this->cashier_model->insertincompart($data);
        $this->session->set_flashdata('feedback', 'Addedd Successfully');
            redirect('cashier/particular');
    }


//add Expense Partucular/Category
    public function addexppart() {
        $cat_name = $this->input->post('cat_name');
        $status = $this->input->post('status');
        $list = $this->input->post('list');
        $data = array(
                    'list' => $list,
                    'stus' => $status,
                    'category' => $cat_name
            );
        $this->cashier_model->insertexppart($data);
        $this->session->set_flashdata('feedback', 'Addedd Successfully');
            redirect('cashier/exppart');
    }




// Add Daily Income 
    public function Newentry() {
        $data = array();
        $emp_id = $this->input->post('user');
        $stdate = $this->input->post('date');
        $date = date('Y-m-d', strtotime($stdate));
        $time = time();
        $catid = $this->input->post('catid');
        $amount = $this->input->post('amount');
        $data = array(
                    'emp_id' => $emp_id,
                    'date' => $date,
                    'cat_id' => $catid,
                    'amount' => $amount,
                    'times' => $time
            );
        $data['cat'] = $this->cashier_model->insertincom($data);
        $this->session->set_flashdata('feedback', 'Addedd Successfully');
            redirect('cashier');
    }



// Edit Daily Income Ajax View 
    function editIncomeByJason() {
        $id = $this->input->get('id');
        $data['income'] = $this->cashier_model->getIncomeByIdex($id);
        echo json_encode($data);
    }


// Update Daily Income 
   function Updateincome() {
        $data = array();
        $id = $this->input->post('id');        
        $catid = $this->input->post('catid');
        $amount = $this->input->post('amount');
        $data = array(
                    'cat_id' => $catid,
                    'amount' => $amount
            );
        $data['income'] = $this->cashier_model->Updateincome($id, $data);
        $this->session->set_flashdata('feedback', 'Updated');
            redirect('cashier');
    }



//  Delete Income By Particular/Category
    function delete() {
        $id = $this->input->get('id');
        $this->cashier_model->delete($id);
        $this->session->set_flashdata('feedback', 'Deleted');
        redirect('cashier');
    }








// Daily Expense Controller
    public function expen() {
        $stdate = $this->input->post('date');
        $target = date('Y-m-d', strtotime($stdate));
        if (empty($stdate)) {
        $data['expens'] = $this->cashier_model->getexpenyes($target);
        }else{
        $data['expens'] = $this->cashier_model->getexpendaily($target);
        }
        $data['cats'] = $this->cashier_model->getexp();
        $loginId = $this->ion_auth->user()->row()->emp_id;
        $data['user_P'] = $this->settings_model->get_log_user($loginId); 

        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('cashier/expense', $data);
        $this->load->view('home/footer'); // just the header file
    }


//add Daily Expense
    public function Newexpen() {
        $data = array();
        $emp_id = $this->input->post('user');
        $stdate = $this->input->post('date');
        $date = date('Y-m-d', strtotime($stdate));
        $time = time();
        $catid = $this->input->post('catid');
        $amount = $this->input->post('amount');
        $data = array(
                    'emp_id' => $emp_id,
                    'date' => $date,
                    'cat_id' => $catid,
                    'amount' => $amount,
                    'times' => $time
            );
        $data['cat'] = $this->cashier_model->insertexpen($data);
        $this->session->set_flashdata('feedback', 'Added Successfully');
            redirect('cashier/expen');
    }


//Edit Daily Expense ajax view
    function editexpenByJason() {
        $id = $this->input->get('id');
        $data['expen'] = $this->cashier_model->getExpenByIdex($id);
        echo json_encode($data);
    }


//Update Daily Expense
   function Updateexpen() {
        $data = array();
        $id = $this->input->post('id');        
        $catid = $this->input->post('catid');
        $amount = $this->input->post('amount');
        $data = array(
                    'cat_id' => $catid,
                    'amount' => $amount
            );
        $data['expen'] = $this->cashier_model->Updateexpen($id, $data);
            redirect('cashier/expen');
    }

//Delete Expense By Particular
    function deleteexp() {
        $id = $this->input->get('id');
        $this->cashier_model->deleteexpen($id);
        $this->session->set_flashdata('feedback', 'Deleted');
        redirect('cashier/expen');
    }









// Daily Statement 
    public function dailyst() {
        $stdate = $this->input->post('date');
        $target = date('Y-m-d', strtotime($stdate));
        //Income Model
        $data['incomes'] = $this->cashier_model->getincomedaily($target);
        //Expense Model
        $data['expens'] = $this->cashier_model->getexpendaily($target);
        $loginId = $this->ion_auth->user()->row()->emp_id;
        $data['user_P'] = $this->settings_model->get_log_user($loginId); 

        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('cashier/dailystatement', $data);
        $this->load->view('home/footer'); // just the header file
    }


// Daily Statement Print View
    public function dailyprint() {
        $data = array();
        $target = $this->input->get('date');
        $stdate = '2018-12-30';
        //Daily Income
        $data['incomes'] = $this->cashier_model->getincomedaily($target);
        //Daily Bank Deposite
        $data['bankds'] = $this->cashier_model->bankdepdate($target);
        //Daily Bank Withdraw
        $data['bankws'] = $this->cashier_model->bankwithdate($target);
        //Daily Expense
        $data['expens'] = $this->cashier_model->getexpendaily($target);
        //Income Sum First to input get
        $data['tisumss'] = $this->cashier_model->tidatewise($stdate, $target);
        //Bank Withdraw Sum First to input get
        $data['tbwsums'] = $this->cashier_model->tbwdatewise($stdate, $target);
        //Expense Sum First to input get
        $data['tesums'] = $this->cashier_model->tedatewise($stdate, $target);
        //Bank Deposite Sum First to input get
        $data['tbdsums'] = $this->cashier_model->tbddatewise($stdate, $target);
        $this->load->view('cashier/dailyprint', $data);




        // HTML to PDF
      //  $html = $this->output->get_output();
      //  $this->dompdf->loadHtml($html);
      //  $this->dompdf->setPaper('A4', 'portrait');
      //  $this->dompdf->render();        
      //  $this->dompdf->stream("Daily_Statement_$stdate.pdf", array("Attachment"=>0)); //Output Line
        


    }








// Daily Bank Statement Entry


    //Edit Bank Deposite ajax View
    function editbankdByJason() {
        $id = $this->input->get('id');
        $data['bankd'] = $this->cashier_model->getBankdByIdex($id);
        echo json_encode($data);
    }

    // Daily Bank
    public function bank() {
        $data = array();


        //Bank Deposite
        $data['bankds'] = $this->cashier_model->bankdep();
        //Bank Account
        $data['bankacc'] = $this->cashier_model->bankacc();
        //Bank Withdraw
        $data['bankws'] = $this->cashier_model->bankwith();
        $loginId = $this->ion_auth->user()->row()->emp_id;
        $data['user_P'] = $this->settings_model->get_log_user($loginId); 

        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('cashier/bankst', $data);
        $this->load->view('home/footer'); // just the header file
    }



    //Add Daily Bank Deposite
    public function bdps() {
        $data = array();
        $stdate = $this->input->post('date');
        $date = date('Y-m-d', strtotime($stdate));
        $recipt = $this->input->post('recipt');
        $amount = $this->input->post('amount');
        $emp_id = $this->input->post('emp_id');
        $bankac = $this->input->post('bankac');
        $time = time();
        $data = array(
                    'emp_id' => $emp_id,
                    'date' => $date,
                    'recit_no' => $recipt,
                    'amount' => $amount,
                    'b_acc_no' => $bankac,
                    'time' => $time
            );
        $data['bankd'] = $this->cashier_model->insertbankd($data);
        $this->session->set_flashdata('feedback', 'Added Successfully');
            redirect('cashier/bank');
    }


    //Add Bank Account
    public function banknew() {
        $data = array();
        $accno = $this->input->post('accno');
        $acctype = $this->input->post('acctype');
        $bankname = $this->input->post('bankname');
        $branch = $this->input->post('branch');
        $data = array(
                    'accno' => $accno,
                    'acctype' => $acctype,
                    'bankname' => $bankname,
                    'branch' => $branch
            );
        $data['bankacc'] = $this->cashier_model->insertbankacc($data);
        $this->session->set_flashdata('feedback', 'Added Successfully');
            redirect('cashier/bank');
    }


    //Add Bank Withdraw
    public function bwthd() {
        $data = array();
        $stdate = $this->input->post('date');
        $date = date('Y-m-d', strtotime($stdate));
        $recipt = $this->input->post('recipt');
        $amount = $this->input->post('amount');
        $bankac = $this->input->post('bankac');
        $emp_id = $this->input->post('emp_id');
        $time = time();
        $data = array(
                    'emp_id' => $emp_id,
                    'date' => $date,
                    'recit_no' => $recipt,
                    'amount' => $amount,
                    'b_acc_no' => $bankac,
                    'time' => $time
            );
        $data['bankw'] = $this->cashier_model->insertbankw($data);
        $this->session->set_flashdata('feedback', 'Added Successfully');
            redirect('cashier/bank');
    }


    //Edit Bank Withdraw Ajax View
    function editbankwByJason() {
        $id = $this->input->get('id');
        $data['bankw'] = $this->cashier_model->getBankwByIdex($id);
        echo json_encode($data);
    }





// Bank Statement Update


    //Update Bank Deposite
    public function updbdps() {
        $data = array();
        $id = $this->input->post('id');
        $id = $this->input->get('id');
        $recipt = $this->input->post('recipt');
        $amount = $this->input->post('amount');
        $data = array(
                    'recit_no' => $recipt,
                    'amount' => $amount
            );
        $data['bankd'] = $this->cashier_model->updbdpmodel($id, $data);
        $this->session->set_flashdata('feedback', 'Updated');
            redirect('cashier/bank');
    }


    //Update Bank Withdraw
    public function updbwthd() {
        $data = array();
        $id = $this->input->post('id');
        $id = $this->input->get('id');
        $recipt = $this->input->post('recipt');
        $amount = $this->input->post('amount');
        $data = array(
                    'recit_no' => $recipt,
                    'amount' => $amount
            );
        $data['bankw'] = $this->cashier_model->updbwdmodel($id, $data);
        $this->session->set_flashdata('feedback', 'Updated');
            redirect('cashier/bank');
    }


    //delete Bank Withdraw by Id
    function deletebankw() {
        $id = $this->input->get('id');
        $this->cashier_model->deletebankw($id);
        $this->session->set_flashdata('feedback', 'Deleted');
        redirect('cashier/bank');
    }


    //delete Bank Deposite by Id
    function deletebankd() {
        $id = $this->input->get('id');
        $this->cashier_model->deletebankd($id);
        $this->session->set_flashdata('feedback', 'Deleted');
        redirect('cashier/bank');
    }



    //delete Income Particular by Id
    function inpartdelete() {
        $id = $this->input->get('id');
        $this->cashier_model->deleteincomepart($id);
        $this->session->set_flashdata('feedback', 'Deleted');
        redirect('cashier/particular');
    }


    //delete Expense Particular by Id
    function exppartdelete() {
        $id = $this->input->get('id');
        $this->cashier_model->deleteexpenpart($id);
        $this->session->set_flashdata('feedback', 'Deleted');
        redirect('cashier/exppart');
    }






// Monthly Income Expense Statement 


    //Monthly View Page
    public function miest() {
        $data['cats'] = $this->cashier_model->getcat();
        $data['catexs'] = $this->cashier_model->getexcat();
        $loginId = $this->ion_auth->user()->row()->emp_id;
        $data['user_P'] = $this->settings_model->get_log_user($loginId); 

        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('cashier/monthlyincomeexpense', $data);
        $this->load->view('home/footer'); // just the header file
    }


    //Monthly Income Expense Print
    public function mieprint() {
        $month = $this->input->get('month');
        $year = $this->input->get('year');
        //Get Monthly Income
        $data['incomes'] = $this->cashier_model->getincomemonthly($month, $year);
        //Get Monthly Expense
        $data['expens'] = $this->cashier_model->getexpenmonthly($month, $year);
        //Income Catagory
        $data['income_catagorys'] = $this->cashier_model->getcatwr();
        //Expense Catagory
        $data['expense_catagorys'] = $this->cashier_model->getexcatwr();
        $this->load->view('cashier/monthie', $data);
    }


    //Monthly Trial Sheet
    public function trialprint() {
        $month = $this->input->get('month');
        $year = $this->input->get('year');
        $tdatem = cal_days_in_month(CAL_GREGORIAN, $month, $year);
        $stdate = '2018-06-01';
        $target = '2018-12-30';
        $ltdate = $year."-".$month."-".$tdatem;
        //income Expense Total
        $data['incomes'] = $this->cashier_model->getincomemonthly($month, $year);
        $data['expens'] = $this->cashier_model->getexpenmonthly($month, $year);
        //Catagory
        $data['income_catagorys'] = $this->cashier_model->getcat();
        $data['expense_catagorys'] = $this->cashier_model->getexcat();
        //Bank Account No
        $data['bank_acc'] = $this->cashier_model->getbankaccn();
        // Total Income Expense
        $data['tisumsstr'] = $this->cashier_model->tidatewisetr($stdate, $ltdate);
        $data['tesumstr'] = $this->cashier_model->tedatewisetr($stdate, $ltdate);
        //Total Bank Deposite And Withdraw From 2018-06-01 to this month
        $data['tbdsumstr'] = $this->cashier_model->tbddatewisetr($stdate, $ltdate);
        $data['tbwsumstr'] = $this->cashier_model->tbwdatewisetr($stdate, $ltdate);
        //Total Deposite And Withdraw for this month
        $data['tbankdep'] = $this->cashier_model->monbankdep($month, $year);
        $data['tbankwd'] = $this->cashier_model->monbanked($month, $year);
        //cash in hand
        $data['tisumss'] = $this->cashier_model->trtidatewise($target, $ltdate);
        $data['tbwsums'] = $this->cashier_model->trtbwdatewise($target, $ltdate);
        $data['tesums'] = $this->cashier_model->trtedatewise($target, $ltdate);
        $data['tbdsums'] = $this->cashier_model->trtbddatewise($target, $ltdate);
        // This Month Statement of Total Amount
        $data['thisincome'] = $this->cashier_model->thisincome($month, $year);
        $data['thisbwith'] = $this->cashier_model->thisbankwdr($month, $year);
        $data['thisexp'] = $this->cashier_model->thisexpense($month, $year);
        $data['thisbdep'] = $this->cashier_model->thisbankdeposite($month, $year);
        $this->load->view('cashier/trialsheet', $data);
    }




// Monthly Ladger Page
    public function iladg() {
        $ciid = $this->input->get('ciid');
        $month = $this->input->get('month');
        $year = $this->input->get('year');
        $data['inladgers'] = $this->cashier_model->getincomeladger($ciid, $month, $year);
        $this->load->view('cashier/ladgerpage', $data);
    }

    public function eladg() {
        $ciid = $this->input->get('ciid');
        $month = $this->input->get('month');
        $year = $this->input->get('year');
        $data['exladgers'] = $this->cashier_model->getexpladger($ciid, $month, $year);
        $this->load->view('cashier/ladgerexpense', $data);
    }






// Monthly Bank Statement
    public function bankstat() {
        $month = $this->input->get('month');
        $year = $this->input->get('year');
        $data['bankdpss'] = $this->cashier_model->monbankdep($month, $year);
        $data['bankwdss'] = $this->cashier_model->monbanked($month, $year);
        $this->load->view('cashier/banksheet', $data);
    }


//End Bracket
}
