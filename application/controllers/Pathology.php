<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class pathology extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('Ion_auth');
        $this->load->library('session');
        $this->load->library('form_validation');
        $this->load->model('pathology_model');
        $this->load->library('upload');
        $language = $this->db->get('settings')->row()->language;
        $this->lang->load('system_syntax', $language);
        $this->load->model('ion_auth_model');
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        if (!$this->ion_auth->in_group(array('admin', 'Accountant', 'Laboratorist'))) {
            redirect('home/permission');
        }
    }

    public function index() {

        $this->load->view('home/dashboard'); // just the header file
        $this->load->view('pathology');
        $this->load->view('home/footer'); // just the header file
    }
































    // public function index() {

    //     $data['doctors'] = $this->doctor_model->updateDoctor();
    //     $this->load->view('home/dashboard'); // just the header file
    //     $this->load->view('doctor', $data);
    //     $this->load->view('home/footer'); // just the header file
    // }

    // public function addfee() {

    //     $dr_id = $this->input->post('dr_id');
    //     $dr_firsttime = $this->input->post('dr_firsttime');
    //     $dr_sectime = $this->input->post('dr_sectime');
    //     $hospital_first = $this->input->post('hospital_first');
    //     $hospital_sec = $this->input->post('hospital_sec');

    //             $data = array();
    //             $data = array(
    //                 'dr_id' => $dr_id,
    //                 'dr_firsttime' => $dr_firsttime,
    //                 'dr_sectime' => $dr_sectime,
    //                 'hospital_first' => $hospital_first,
    //                 'hospital_sec' => $hospital_sec
    //             );

    //         $this->doctor_model->insertDoctorfee($data);
    //     $this->session->set_flashdata('feedback', 'Added');
    //         redirect('doctor/drfee');
    //     }

    // function editDoctorByJason() {
    //     $id = $this->input->get('id');
    //     $data['doctor'] = $this->doctor_model->getDoctorById($id);
    //     echo json_encode($data);
    // }




}

/* End of file Pathology.php */
/* Location: ./application/modules/pathology/controllers/pathology.php */