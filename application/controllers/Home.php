<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Home extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('Ion_auth');
        $this->load->library('session');
        $this->load->library('form_validation');
        $this->load->model('ion_auth_model');
        $this->load->library('upload');
        $language = $this->db->get('settings')->row()->language;
        $this->lang->load('system_syntax', $language);
        $this->load->model('settings_model');
        $this->load->model('home_model');

        
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        } 
    }

    public function index() {

        $data = array();
        $loginId = $this->ion_auth->user()->row()->emp_id;
        $data['user_P'] = $this->settings_model->get_log_user($loginId); 
        $data['settings'] = $this->settings_model->getSettings();
        $data['sum'] = $this->home_model->getSum('gross_total', 'payment'); // just the header file
        $this->load->view('home/dashboard', $data);
        $this->load->view('home/home', $data);
        $this->load->view('home/footer');
        /**
        if ($this->ion_auth->in_group(array('Accountant', 'Receptionist'))) {
            redirect('finance/addPaymentView');
        }
        if ($this->ion_auth->in_group(array('Patient'))) {
            $user_id = $this->ion_auth->get_user_id();
            $patient_id = $this->db->get_where('patient', array('ion_user_id' => $user_id))->row()->id;
            redirect('patient/medicalHistory?id='.$patient_id); 
        }**/
    }



    public function editchat() {
        $chat = $this->input->get('chat');
        $time = time();
        $data = array( 
            'chat' => $chat,
            'emp_id' => $this->ion_auth->user()->row()->emp_id,
            'timestamp' => $time
        );
        $this->home_model->insertchat($data);
    }


    public function getchatByJason() {
        $data = $this->home_model->getchatsms();
        echo json_encode($data);
    }




   public function getempByJason() {
        $empid = $this->input->get('empid');
        $data['emps'] = $this->home_model->getemp($empid);
        echo json_encode($data);
    }





    public function permission() {
        $empid = $this->ion_auth->user()->row()->emp_id;
        $data['emps'] = $this->home_model->getemp($empid);
        $this->load->view('home/permission', $data);
    }

}

/* End of file home.php */
/* Location: ./application/controllers/home.php */
