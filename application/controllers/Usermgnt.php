<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Usermgnt extends CI_Controller {

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
        $this->load->model('usermgnt_model');
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
    }


    public function index() {
        $data['userents'] = $this->usermgnt_model->getuser();
        $data['emps'] = $this->usermgnt_model->getemp();
        $data['groups'] = $this->usermgnt_model->getgroups();
        $data['usergroups'] = $this->usermgnt_model->getusergroups();

        $loginId = $this->ion_auth->user()->row()->emp_id;
        $data['user_P'] = $this->settings_model->get_log_user($loginId); 

        $this->load->view('home/dashboard', $data); // just the header file
        
        $this->load->view('usermgnt/usermgnt', $data);
        $this->load->view('home/footer');
    }

    public function Neweuser() {
        $data = array();
        $emp_id = $this->input->post('emp_id');
        $time = time();
        $utype = $this->input->post('utype');
        $pass = $this->input->post('password');
        $password = $this->ion_auth_model->hash_password($pass);
        $active = '1';
        $data = array(
                    'emp_id' => $emp_id,
                    'created_on' => $time,
                    'utype' => $utype,
                    'password' => $password,
                    'active' => $active
            );
        $this->usermgnt_model->insertuser($data);
        $this->session->set_flashdata('feedback', 'Addedd Successfully');            
        redirect('usermgnt');
    }



    public function addusergroup() {
        $id = $this->input->post('emp');
        $group_id = $this->input->post('group_id');
        $data = array(
                    'user_id' => $id,
                    'group_id' => $group_id
            );
        $this->usermgnt_model->insertusergroup($data);
        $this->session->set_flashdata('feedback', 'Addedd Success');            
        redirect('usermgnt');
    }





    public function editusergroup() {
        $id = $this->input->post('emp_uid');
        $group_id = $this->input->post('group_uiid');
        $ur_id = $this->input->post('ugr_id');
        $data = array(
                    'user_id' => $id,
                    'group_id' => $group_id
            );
        $this->usermgnt_model->updateusergroup($ur_id, $data);
        $this->session->set_flashdata('feedback', 'Update Success');            
        redirect('usermgnt');
    }






    public function editupassword() {
        $emp_id = $this->input->post('id');
        $pass = $this->input->post('password');
        $password = $this->ion_auth_model->hash_password($pass);
        $data = array(
                    'password' => $password
            );
        $this->usermgnt_model->updateuserpass($emp_id, $data);
        $this->session->set_flashdata('feedback', 'Update Success');            
        redirect('usermgnt');
    }




    function addusergroupByJason() {
        $id = $this->input->get('id');
        $data['usergros'] = $this->usermgnt_model->getusergroupbyid($id);
        echo json_encode($data);
    }





    function editusergroupByJason() {
        $id = $this->input->get('id');
        $data['usergrops'] = $this->usermgnt_model->getusergbyid($id);
        echo json_encode($data);
    }




    function getuserByJason() {
        $empid = $this->input->get('uid');
        $data['ugroup'] = $this->usermgnt_model->getuserssbyid($empid);
        echo json_encode($data);
    }




    function delete() {
        $id = $this->input->get('id');
        $this->usermgnt_model->delete($id);
        $this->session->set_flashdata('feedback', 'Deleted');
        redirect('usermgnt');
    }




//End Bracket
}
