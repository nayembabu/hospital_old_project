<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Patient extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('Ion_auth');
        $this->load->library('session');
        $this->load->library('form_validation');
        $this->load->model('patient_model');
        $this->load->library('upload');
        $this->load->library('Pdf');
        $language = $this->db->get('settings')->row()->language;
        $this->lang->load('system_syntax', $language);
        $this->load->model('donor_model');
        $this->load->model('doctor_model');
        $this->load->model('settings_model');
        $this->load->model('ion_auth_model');
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        if (!$this->ion_auth->in_group(array('admin', 'Nurse', 'Accountant', 'Doctor', 'Supervisor'))) {
            redirect('home');
        }
    }

    public function index() {
        $loginId = $this->ion_auth->user()->row()->emp_id;

        $data['doctors'] = $this->doctor_model->getDoctor();
        $data['patients'] = $this->patient_model->getPatient();
        $data['settings'] = $this->settings_model->getSettings();
        $data['beds'] = $this->patient_model->getbed();
        $data['user_P'] = $this->settings_model->get_log_user($loginId); 

        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('patient/patient', $data);
        $this->load->view('home/footer'); // just the header file
    }

    public function admitreport() {
        
        $loginId = $this->ion_auth->user()->row()->emp_id;
        $data['user_P'] = $this->settings_model->get_log_user($loginId); 

        $this->load->view('home/dashboard', $data); // just the header file   
        $this->load->view('patient/simple_view');
        $this->load->view('home/footer'); // just the header file
    }

    public function reports_P() {

        $date_opt = $this->input->get('st_date');
        $data['patient_data'] = $this->patient_model->get_d_patient($st_date);
        $this->load->view('patient/p_report', $data);

        // HTML to PDF
        $html = $this->output->get_output();
        $this->dompdf->loadHtml($html);
        $this->dompdf->setPaper('A4', 'portrait');
        $this->dompdf->render();        
        $this->dompdf->stream("Daily_Patient_Report.pdf", array("Attachment"=>0));
        //Output Line
    }

    public function report_p_m() {

        $st_date = date('Y-m-d', strtotime($this->input->get('st_date')));
        $last_date = date('Y-m-d', strtotime($this->input->get('last_date')));
        $data['patient_data'] = $this->patient_model->getfullpatient($st_date, $last_date);
        $data['s_date'] = date('d-M-Y', strtotime($st_date));
        $data['l_date'] = date('d-M-Y', strtotime($last_date));
        $this->load->view('patient/p_report', $data);

        // HTML to PDF
        $html = $this->output->get_output();
        $this->dompdf->loadHtml($html);
        $this->dompdf->setPaper('A4', 'portrait');
        $this->dompdf->render();        
        $this->dompdf->stream("Patient_Report.pdf", array("Attachment"=>0));
        //Output Line
    }

    public function printchart() {
        $id = $this->input->get('id');
        $dr_id = $this->input->get('dr_id');
        $data['doctor_data'] = $this->patient_model->getDoctorById($dr_id);
        $data['paitents_data'] = $this->patient_model->getPatientById($id);
        $this->load->view('patient/m_chart', $data);

        // HTML to PDF
        $html = $this->output->get_output();
        $this->dompdf->loadHtml($html);
        $this->dompdf->setPaper('A4', 'portrait');
        $this->dompdf->render();        
        $this->dompdf->stream("Medical_Chart.pdf", array("Attachment"=>0)); //Output Line
   
    }

    public function addpatient() {
        $this_tim = time();
        $date_time = $this->input->post('date').' '.$this->input->post('time');
        $tmp_date = $this->input->post('date');
        $this_time = strtotime($date_time);
        $emp_id = $this->ion_auth->user()->row()->emp_id;
        $name = $this->input->post('name');
        $ptn_cuss = $this->input->post('ptn_cause');
        $f_name = $this->input->post('f_name');
        $app_id = $this->input->post('app_id');
        $dr_id = $this->input->post('dr_id');
        $reg_no = $this->input->post('reg_no');
        $address = $this->input->post('address');
        $mobile = $this->input->post('mobile');
        $sex = $this->input->post('sex');
        $rel_actv = $this->input->post('actv');
        $b_num = $this->input->post('b_num');
        $add_date = date('Y-m-d', strtotime($tmp_date));
        $age = $this->input->post('age');
        $rand1 = rand(100, 1000000);
        $rand2 = rand(10, 1000);
        $rand3 = rand(10, 100000);
        $patient_id = $rand1 + $rand2 + $rand3;
        $id_ptns = $this->patient_model->get_ptn_number();
        $increment_ids = $id_ptns->p_n_id+1;

        $data = array(
                'ptnname'       => $name,
                'f_s_name'      => $f_name,
                'dr_id'         => $dr_id,
                'pn_address'    => $address,
                'mobile'        => $mobile,
                'sex'           => $sex,
                'age'           => $age,
                'reg_no'        => $reg_no,
                'time_this'     => $this_time,
                'Patient_cause' => $ptn_cuss,
                'patient_id'    => $patient_id,
                'emp_id'        => $emp_id,
                'b_num'         => $b_num,
                'add_date'      => $add_date,
                'rel_with_ptn'  => $rel_actv
            );
        $this->patient_model->insertPatient($data);

        $bed_allocate = array(
            'patient_id'    => $patient_id,
            'admit_time'    => $this_time,
            'bed_cat_i'     => $b_num,
            'bed_no'        => $b_num,
            'ptn_iid'       => $increment_ids
            );
        $this->patient_model->insert_b_a($bed_allocate);
        $this->session->set_flashdata('feedback', 'Paitient Admitted');
            // Loading View
                redirect('patient');
        }




    public function editPatientData() {
        $date_time = $this->input->post('date').' '.$this->input->post('time');
        $this_time = strtotime($date_time);

        $name = $this->input->post('name');
        $f_name = $this->input->post('father');
        $dr_id = $this->input->post('doctor_p');
        $reg_no = $this->input->post('reg_no');
        $address = $this->input->post('address');
        $mobile = $this->input->post('phone');
        $sex = $this->input->post('sex');
        $age = $this->input->post('age');
        $id = $this->input->post('id');
        $data = array();
        if ($this->ion_auth->in_group(array('admin'))) {
        $data = array(
                    'ptnname'       => $name,
                    'f_s_name'      => $f_name,
                    'dr_id'         => $dr_id,
                    'pn_address'    => $address,
                    'mobile'        => $mobile,
                    'sex'           => $sex,
                    'age'           => $age,
                    'reg_no'        => $reg_no,
                    'time_this'     => $this_time
            );
        }else{
            $data = array(
                        'ptnname'       => $name,
                        'f_s_name'      => $f_name,
                        'dr_id'         => $dr_id,
                        'pn_address'    => $address,
                        'mobile'        => $mobile,
                        'sex'           => $sex,
                        'age'           => $age,
                        'reg_no'        => $reg_no,
                        'time_this'     => $this_time
                );
        }
        $this->patient_model->updatePatientData($id, $data);
        $this->session->set_flashdata('feedback', 'Updated');
            // Loading View
                redirect('patient');
        }

        function search_patientByID() {
            $p_id = $this->input->get('id');
            $data = $this->patient_model->get_patient_forSearch($p_id);
            echo json_encode($data);
        }







    function getPatient() {
        $data['patient'] = $this->patient_model->get_patient();
        $this->load->view('patient/patient', $data);
    }

    function editPatient() {
        $data = array();
        $id = $this->input->get('id');
        $data['patient'] = $this->patient_model->getPatientById($id);
        $data['doctors'] = $this->doctor_model->getDoctor();
        $data['groups'] = $this->donor_model->getBloodBank();
        
        $loginId = $this->ion_auth->user()->row()->emp_id;
        $data['user_P'] = $this->settings_model->get_log_user($loginId); 

        $this->load->view('home/dashboard', $data); // just the header file
        
        $this->load->view('patient/add_new', $data);
        $this->load->view('home/footer'); // just the footer file
    }

    function editPatientByJason() {
        $id = $this->input->get('id');
        $data['patient'] = $this->patient_model->getPatientById($id);
        echo json_encode($data);
    }

 
    function getinfoByJason() {
        $id = $this->input->get('id');
        $data['appointments'] = $this->patient_model->getAppinfoById($id);
        echo json_encode($data);
    }

    function editBed_data() {
        $p_ids = $this->input->post('p_id_for_bed'); 
        $p_bed_s = $this->input->post('b_num');
        $last_patient = $this->patient_model->get_p_by_ids($p_ids);
        $now_bed_no = $last_patient->b_num;
        $p_rand_id = $last_patient->patient_id;
        $this_time = time();
        $query_last_bed = $this->patient_model->get_previous_bed($p_ids, $now_bed_no);
        $last_bed_id = $query_last_bed->b_a_id;
        $now_time = time();

        $bed_update_data = array(
            'discharge_time' => $now_time, 
        );
        $this->patient_model->updateNowBed($last_bed_id, $bed_update_data);
        $c_data = array(
            'b_num' => $p_bed_s, 
        );
        $this->patient_model->update_P_Beds($p_ids, $c_data);

        $bed_allocate = array(
            'patient_id'    => $p_rand_id,
            'admit_time'    => $this_time,
            'bed_cat_i'     => $p_bed_s,
            'bed_no'        => $p_bed_s,
            'ptn_iid'       => $p_ids
            );
        $this->patient_model->insert_b_a($bed_allocate);
        $this->session->set_flashdata('feedback', 'Bed Updated');
            // Loading View
        redirect('patient');
    }

   function patientDetails() {
        $data = array();
        $id = $this->input->get('id');
        $data['patient'] = $this->patient_model->getPatientById($id);
        
        $loginId = $this->ion_auth->user()->row()->emp_id;
        $data['user_P'] = $this->settings_model->get_log_user($loginId); 

        $this->load->view('home/dashboard', $data); // just the header file
        
        $this->load->view('patient/details', $data);
        $this->load->view('home/footer'); // just the footer file
    }

    function report() {
        $data = array();
        $id = $this->input->get('id');
        $data['settings'] = $this->settings_model->getSettings();
        $data['payment'] = $this->finance_model->getPaymentById($id);
        
        $loginId = $this->ion_auth->user()->row()->emp_id;
        $data['user_P'] = $this->settings_model->get_log_user($loginId); 

        $this->load->view('home/dashboard', $data); // just the header file
        
        $this->load->view('patient/diagnostic_report_details', $data);
        $this->load->view('home/footer'); // just the footer file
    }

    function addDiagnosticReport() {
        $id = $this->input->post('id');
        $invoice = $this->input->post('invoice');
        $patient = $this->input->post('patient');
        $report = $this->input->post('report');

        $date = time();

        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');


        // Validating Name Field
        $this->form_validation->set_rules('invoice', 'Invoice', 'trim|required|min_length[1]|max_length[100]|xss_clean');
        // Validating Password Field

        $this->form_validation->set_rules('report', 'Report', 'trim|min_length[1]|max_length[10000]|xss_clean');


        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('feedback', 'Validation Error !');
            redirect('patient/report?id=' . $invoice);
        } else {

            //$error = array('error' => $this->upload->display_errors());
            $data = array();
            $data = array(
                'invoice' => $invoice,
                'date' => $date,
                'report' => $report
            );

            if (empty($id)) {     // Adding New department
                $this->patient_model->insertDiagnosticReport($data);
                $this->session->set_flashdata('feedback', 'Added');
            } else { // Updating department
                $this->patient_model->updateDiagnosticReport($id, $data);
                $this->session->set_flashdata('feedback', 'Updated');
            }
            // Loading View
            redirect('patient/report?id=' . $invoice);
        }
    }

    function patientPayments() {
        $data['doctors'] = $this->doctor_model->getDoctor();
        $data['groups'] = $this->donor_model->getBloodBank();
        $data['patients'] = $this->patient_model->getPatient();
        $data['settings'] = $this->settings_model->getSettings();
        
        $loginId = $this->ion_auth->user()->row()->emp_id;
        $data['user_P'] = $this->settings_model->get_log_user($loginId); 

        $this->load->view('home/dashboard', $data); // just the header file
        
        $this->load->view('patient/patient_payments', $data);
        $this->load->view('home/footer'); // just the header file
    }

    function caseList() {
        $data['patients'] = $this->patient_model->getPatient();
        $data['medical_histories'] = $this->patient_model->getMedicalHistory();
        
        $loginId = $this->ion_auth->user()->row()->emp_id;
        $data['user_P'] = $this->settings_model->get_log_user($loginId); 

        $this->load->view('home/dashboard', $data); // just the header file
        
        $this->load->view('patient/case_list', $data);
        $this->load->view('home/footer'); // just the footer file
    }

    function documents() {
        $data['patients'] = $this->patient_model->getPatient();
        $data['files'] = $this->patient_model->getPatientMaterial();
        
        $loginId = $this->ion_auth->user()->row()->emp_id;
        $data['user_P'] = $this->settings_model->get_log_user($loginId); 

        $this->load->view('home/dashboard', $data); // just the header file
        
        $this->load->view('patient/documents', $data);
        $this->load->view('home/footer'); // just the footer file
    }

    function addMedicalHistory() {
        $id = $this->input->post('id');
        $patient_id = $this->input->post('patient_id');

        $date = $this->input->post('date');
        $description = $this->input->post('description');
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');

        $redirect = $this->input->post('redirect');
        if (empty($redirect)) {
            $redirect = 'patient/medicalHistory?id=' . $patient_id;
        }

        // Validating Name Field
        $this->form_validation->set_rules('date', 'Date', 'trim|required|min_length[5]|max_length[100]|xss_clean');
        // Validating Password Field

        $this->form_validation->set_rules('description', 'Description', 'trim|required|min_length[5]|max_length[10000]|xss_clean');


        if ($this->form_validation->run() == FALSE) {
            if (!empty($id)) {
                redirect("patient/editMedicalHistory?id=$id");
            } else {
                $this->load->view('home/dashboard'); // just the header file
                $this->load->view('patient/add_new');
                $this->load->view('home/footer'); // just the header file
            }
        } else {

            //$error = array('error' => $this->upload->display_errors());
            $data = array();
            $data = array(
                'patient_id' => $patient_id,
                'date' => $date,
                'description' => $description
            );

            if (empty($id)) {     // Adding New department
                $this->patient_model->insertMedicalHistory($data);
                $this->session->set_flashdata('feedback', 'Added');
            } else { // Updating department
                $this->patient_model->updateMedicalHistory($id, $data);
                $this->session->set_flashdata('feedback', 'Updated');
            }
            // Loading View
            redirect($redirect);
        }
    }

    public function diagnosticReport() {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        if ($this->ion_auth->in_group(array('Patient'))) {
            $current_user = $this->ion_auth->get_user_id();
            $patient_user_id = $this->patient_model->getPatientByIonUserId($current_user)->id;
            $data['payments'] = $this->finance_model->getPaymentByPatientId($patient_user_id);
        } else {
            $data['payments'] = $this->finance_model->getPayment();
        }

        $data['settings'] = $this->settings_model->getSettings();
        
        $loginId = $this->ion_auth->user()->row()->emp_id;
        $data['user_P'] = $this->settings_model->get_log_user($loginId); 

        $this->load->view('home/dashboard', $data); // just the header file
        
        $this->load->view('patient/diagnostic_report', $data);
        $this->load->view('home/footer'); // just the header file
    }

    function medicalHistory() {
        $data = array();
        $id = $this->input->get('id');
        $data['patient'] = $this->patient_model->getPatientById($id);
        $data['patients'] = $this->patient_model->getPatient();
        $data['prescriptions'] = $this->prescription_model->getPrescriptionByPatientId($id);
        $data['medical_histories'] = $this->patient_model->getMedicalHistoryByPatientId($id);
        $data['patient_materials'] = $this->patient_model->getPatientMaterialByPatientId($id);
        $this->load->view('home/dashboard'); // just the header file
        $this->load->view('patient/medical_history', $data);
        $this->load->view('home/footer'); // just the footer file
    }

    function editMedicalHistoryByJason() {
        $id = $this->input->get('id');
        $data['medical_history'] = $this->patient_model->getMedicalHistoryById($id);
        echo json_encode($data);
    }

    function patientMaterial() {
        $data = array();
        $id = $this->input->get('patient');
        $data['settings'] = $this->settings_model->getSettings();
        $data['patient'] = $this->patient_model->getPatientById($id);
        $data['patient_materials'] = $this->patient_model->getPatientMaterialByPatientId($id);
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('patient/patient_material', $data);
        $this->load->view('home/footer'); // just the footer file
    }

    function addPatientMaterial() {
        $title = $this->input->post('title');
        $patient_id = $this->input->post('patient');
        $img_url = $this->input->post('img_url');
        $date = time();
        $redirect = $this->input->post('redirect');
        if (empty($redirect)) {
            $redirect = "patient/medicalHistory?id=" . $patient_id;
        }
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');

        // Validating Patient Field
        $this->form_validation->set_rules('patient', 'Patient', 'trim|required|min_length[1]|max_length[100]|xss_clean');


        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('feedback', 'Validation Error !');
            redirect($redirect);
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
                'upload_path' => "./uploads/",
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
                $img_url = "uploads/" . $path['file_name'];
                $data = array();
                $data = array(
                    'date' => $date,
                    'title' => $title,
                    'url' => $img_url,
                    'patient' => $patient_id,
                );
            } else {
                $data = array();
                $data = array(
                    'date' => $date,
                    'title' => $title,
                    'patient' => $patient_id,
                );
                $this->session->set_flashdata('feedback', 'Upload Error !');
            }

            $this->patient_model->insertPatientMaterial($data);
            $this->session->set_flashdata('feedback', 'Added');


            redirect($redirect);
        }
    }

    function deleteCaseHistory() {
        $id = $this->input->get('id');
        $redirect = $this->input->get('redirect');
        $case_history = $this->patient_model->getMedicalHistoryById($id);
        $this->patient_model->deleteMedicalHistory($id);
        $this->session->set_flashdata('feedback', 'Deleted');
        if ($redirect == 'case') {
            redirect('patient/caseList');
        } else {
            redirect("patient/MedicalHistory?id=" . $case_history->patient_id);
        }
    }

    function deletePatientMaterial() {
        $id = $this->input->get('id');
        $redirect = $this->input->get('redirect');
        $patient_material = $this->patient_model->getPatientMaterialById($id);
        $path = $patient_material->url;
        if (!empty($path)) {
            unlink($path);
        }
        $this->patient_model->deletePatientMaterial($id);
        $this->session->set_flashdata('feedback', 'Deleted');
        if ($redirect == 'documents') {
            redirect('patient/documents');
        } else {
            redirect("patient/MedicalHistory?id=" . $patient_material->patient);
        }
    }

    function delete() {
        $data = array();
        $id = $this->input->get('id');
        $this->patient_model->delete($id);
        $this->session->set_flashdata('feedback', 'Deleted');
        redirect('patient');
    }



/**
    public function addNew() {
        $id = $this->input->post('id');
        $redirect = $this->input->get('redirect');
        $name = $this->input->post('name');
        $password = $this->input->post('password');
        $doctor = $this->input->post('doctor');
        $address = $this->input->post('address');
        $phone = $this->input->post('phone');
        $sex = $this->input->post('sex');
        $birthdate = $this->input->post('birthdate');
        $bloodgroup = $this->input->post('bloodgroup');
        $patient_id = $this->input->post('p_id');
        if (empty($patient_id)) {
            $patient_id = rand(10000, 1000000);
        }
        if ((empty($id))) {
            $add_date = date('m/d/y');
        } else {
            $add_date = $this->db->get_where('patient', array('id' => $id))->row()->add_date;
        }


        $email = $this->input->post('email');
        if (empty($email)) {
            $email = 'patient' . $patient_id . '@rajbari-bazar.com';
        }



        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');

        // Validating Name Field
        $this->form_validation->set_rules('name', 'Name', 'trim|required|min_length[2]|max_length[100]|xss_clean');
        // Validating Password Field
        if (empty($id)) {
            $this->form_validation->set_rules('password', 'Password', 'trim|min_length[5]|max_length[100]|xss_clean');
        }
        // Validating Email Field
        $this->form_validation->set_rules('email', 'Email', 'trim|min_length[5]|max_length[100]|xss_clean');
        // Validating Doctor Field
        $this->form_validation->set_rules('doctor', 'Doctor', 'trim|min_length[2]|max_length[100]|xss_clean');
        // Validating Address Field   
        $this->form_validation->set_rules('address', 'Address', 'trim|required|min_length[2]|max_length[500]|xss_clean');
        // Validating Phone Field           
        $this->form_validation->set_rules('phone', 'Phone', 'trim|required|min_length[2]|max_length[50]|xss_clean');
        // Validating Email Field
        $this->form_validation->set_rules('sex', 'Sex', 'trim|min_length[2]|max_length[100]|xss_clean');
        // Validating Address Field   
        $this->form_validation->set_rules('birthdate', 'Birth Date', 'trim|min_length[2]|max_length[500]|xss_clean');
        // Validating Phone Field           
        $this->form_validation->set_rules('bloodgroup', 'Blood Group', 'trim|min_length[1]|max_length[10]|xss_clean');


        if ($this->form_validation->run() == FALSE) {
            if (!empty($id)) {
                 $this->session->set_flashdata('feedback', 'Validation Error !');
                redirect("patient/editPatient?id=$id");
            } else {
                $data = array();
                $data['setval'] = 'setval';
                $data['doctors'] = $this->doctor_model->getDoctor();
                $data['groups'] = $this->donor_model->getBloodBank();
                $this->load->view('home/dashboard'); // just the header file
                $this->load->view('add_new', $data);
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
                'upload_path' => "./uploads/",
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
                $img_url = "uploads/" . $path['file_name'];
                $data = array();
                $data = array(
                    'patient_id' => $patient_id,
                    'img_url' => $img_url,
                    'name' => $name,
                    'email' => $email,
                    'address' => $address,
                    'doctor' => $doctor,
                    'phone' => $phone,
                    'sex' => $sex,
                    'birthdate' => $birthdate,
                    'bloodgroup' => $bloodgroup,
                    'add_date' => $add_date
                );
            } else {
                //$error = array('error' => $this->upload->display_errors());
                $data = array();
                $data = array(
                    'patient_id' => $patient_id,
                    'name' => $name,
                    'email' => $email,
                    'doctor' => $doctor,
                    'address' => $address,
                    'phone' => $phone,
                    'sex' => $sex,
                    'birthdate' => $birthdate,
                    'bloodgroup' => $bloodgroup,
                    'add_date' => $add_date
                );
            }

            $username = $this->input->post('name');

            if (empty($id)) {     // Adding New Patient
                if ($this->ion_auth->email_check($email)) {
                    $this->session->set_flashdata('feedback', 'This Email Address Is Already Registered');
                    redirect('patient/addNewView');
                } else {
                    $dfg = 5;
                    $this->ion_auth->register($username, $password, $email, $dfg);
                    $ion_user_id = $this->db->get_where('users', array('email' => $email))->row()->id;
                    $this->patient_model->insertPatient($data);
                    $patient_user_id = $this->db->get_where('patient', array('email' => $email))->row()->id;
                    $id_info = array('ion_user_id' => $ion_user_id);
                    $this->patient_model->updatePatient($patient_user_id, $id_info);
                    $this->session->set_flashdata('feedback', 'Added');
                }
                //    }
            } else { // Updating Patient
                $ion_user_id = $this->db->get_where('patient', array('id' => $id))->row()->ion_user_id;
                if (empty($password)) {
                    $password = $this->db->get_where('users', array('id' => $ion_user_id))->row()->password;
                } else {
                    $password = $this->ion_auth_model->hash_password($password);
                }
                $this->patient_model->updateIonUser($username, $email, $password, $ion_user_id);
                $this->patient_model->updatePatient($id, $data);
                $this->session->set_flashdata('feedback', 'Updated');
            }
            // Loading View
            if (!empty($redirect)) {
                redirect('finance/addPaymentView');
            } else {
                redirect('patient');
            }
        }
    }
**/





//End Bracket
}

/* End of file patient.php */
    /* Location: ./application/modules/patient/controllers/patient.php */
    