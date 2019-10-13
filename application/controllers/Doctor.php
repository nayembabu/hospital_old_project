<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Doctor extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('Ion_auth');
        $this->load->library('session');
        $this->load->library('form_validation');
        $this->load->model('doctor_model');
        $this->load->library('upload');
        $this->load->model('department_model');
        $language = $this->db->get('settings')->row()->language;
        $this->lang->load('system_syntax', $language);
        $this->load->model('ion_auth_model');
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        if (!$this->ion_auth->in_group(array('admin', 'Accountant'))) {
            redirect('home/permission');
        }
    }

    public function index() {

        $data['doctors'] = $this->doctor_model->getDoctor();
        $data['departments'] = $this->department_model->getDepartment();
        $loginId = $this->ion_auth->user()->row()->emp_id;
        $data['user_P'] = $this->settings_model->get_log_user($loginId); 

        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('doctor/doctor', $data);
        $this->load->view('home/footer'); // just the header file
    }

    public function addNewView() {
        $data = array();
        $data['departments'] = $this->department_model->getDepartment();
        $loginId = $this->ion_auth->user()->row()->emp_id;
        $data['user_P'] = $this->settings_model->get_log_user($loginId); 

        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('doctor/add_new', $data);
        $this->load->view('home/footer'); // just the header file
    }

    public function addNew() {

        $name = $this->input->post('name');
        $dr_id = $this->input->post('dr_id');
        $chamber = $this->input->post('chamber');
        $phone = $this->input->post('phone');
        $gender = $this->input->post('gender');
        $department = $this->input->post('department');
        $day = $this->input->post('day');
        $starttime = $this->input->post('starttime');
        $endtime = $this->input->post('endtime');


        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');

        // Validating Name Field
        $this->form_validation->set_rules('name', 'Name', 'trim|required|min_length[5]|max_length[100]|xss_clean');
        // Validating Password Field        // Validating Phone Field           
        $this->form_validation->set_rules('phone', 'Phone', 'trim|required|min_length[5]|max_length[50]|xss_clean');

        if ($this->form_validation->run() == FALSE) {
            if (!empty($id)) {
                 $this->session->set_flashdata('feedback', 'Form Validation Error!');
                redirect('doctor' . $id);
            } else {
                $data = array();
                $data['setval'] = 'setval';
                $data['settings'] = $this->settings_model->getSettings();
                $this->load->view('home/dashboard', $data); // just the header file
                $this->load->view('doctor/add_new');
                $this->load->view('home/footer'); // just the header file
            }
        } else {
            $file_name = $_FILES['img_url']['name'];
            $file_name_pieces = explode('_', $file_name);
            $new_file_name = '';
            $count = 1;
            foreach ($file_name_pieces as $piece) {
                if ($count !== 1) {
                    $piece = ucfirst($piece);
                }

                $new_file_name .= $piece;
                $count++;
            }
            $config = array(
                'file_name' => $new_file_name,
                'upload_path' => "./uploads/dr/",
                'allowed_types' => "gif|jpg|png|jpeg|pdf",
                'overwrite' => False,
                'max_size' => "20480000", // Can be set to particular file size , here it is 2 MB(2048 Kb)
                'max_height' => "1768",
                'max_width' => "2024"
            );

            $this->load->library('Upload', $config);
            $this->upload->initialize($config);
 

            if ($this->upload->do_upload('img_url')) {
                $path = $this->upload->data();
                $img_url = "uploads/dr/" . $path['file_name'];
                $data = array();
                $data = array(
                    'img_url' => $img_url,
                    'drname' => $name,
                    'dr_id' => $dr_id,
                    'chamber' => $chamber,
                    'phone' => $phone,
                    'gender' => $gender,
                    'department' => $department
                );

            $this->doctor_model->insertDoctor($data);
            } else {
                //$error = array('error' => $this->upload->display_errors());
                $data = array();
                $data = array(
                    'drname' => $name,
                    'dr_id' => $dr_id,
                    'chamber' => $chamber,
                    'phone' => $phone,
                    'gender' => $gender,
                    'department' => $department
                );

            $this->doctor_model->insertDoctor($data);
            }         
            redirect('doctor');
        }
    }

    function getDoctor() {
        $data['doctors'] = $this->doctor_model->getDoctor();
        $this->load->view('doctor/doctor', $data);
    }


    function Drfee() {
        $data = array();
        $data['doctorfee'] = $this->doctor_model->drfee();
        $data['doctors'] = $this->doctor_model->getDoctor();
        $loginId = $this->ion_auth->user()->row()->emp_id;
        $data['user_P'] = $this->settings_model->get_log_user($loginId); 

        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('doctor/fee', $data);
        $this->load->view('home/footer'); // just the footer file
    }


    public function addfee() {

        $dr_id = $this->input->post('dr_id');
        $dr_firsttime = $this->input->post('dr_firsttime');
        $dr_sectime = $this->input->post('dr_sectime');
        $hospital_first = $this->input->post('hospital_first');
        $hospital_sec = $this->input->post('hospital_sec');

                $data = array();
                $data = array(
                    'dr_id' => $dr_id,
                    'dr_firsttime' => $dr_firsttime,
                    'dr_sectime' => $dr_sectime,
                    'hospital_first' => $hospital_first,
                    'hospital_sec' => $hospital_sec
                );

            $this->doctor_model->insertDoctorfee($data);
        $this->session->set_flashdata('feedback', 'Added');
            redirect('doctor/drfee');
        }


    function editDoctor() {
        $data = array();
        $data['departments'] = $this->department_model->getDepartment();
        $id = $this->input->get('id');
        $data['doctor'] = $this->doctor_model->getDoctorById($id);
        $loginId = $this->ion_auth->user()->row()->emp_id;
        $data['user_P'] = $this->settings_model->get_log_user($loginId); 

        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('doctor/add_new', $data);
        $this->load->view('home/footer'); // just the footer file
    }

    function editDoctorByJason() {
        $id = $this->input->get('id');
        $data['doctor'] = $this->doctor_model->getDoctorById($id);
        echo json_encode($data);
    }

    function delete() {
        $data = array();
        $id = $this->input->get('id');
        $user_data = $this->db->get_where('doctor', array('id' => $id))->row();
        $path = $user_data->img_url;

        if (!empty($path)) {
            unlink($path);
        }
        $ion_user_id = $user_data->ion_user_id;
        $this->db->where('id', $ion_user_id);
        $this->db->delete('users');
        $this->doctor_model->delete($id);
        $this->session->set_flashdata('feedback', 'Deleted');
        redirect('doctor');
    }

}

/* End of file doctor.php */
/* Location: ./application/modules/doctor/controllers/doctor.php */