<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Nurse extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('Ion_auth');
        $this->load->library('session');
        $this->load->library('form_validation');
        $this->load->model('nurse_model');
        $this->load->library('upload');
        $language = $this->db->get('settings')->row()->language;
        $this->lang->load('system_syntax', $language);
        $this->load->model('ion_auth_model');
        $this->load->library('Pdf');
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        if (!$this->ion_auth->in_group(array('admin', 'Accountant'))) {
            redirect('home/permission');
        }
    }

    public function index() {
        $data['nurses'] = $this->nurse_model->getNurse();
        $loginId = $this->ion_auth->user()->row()->emp_id;
        $data['user_P'] = $this->settings_model->get_log_user($loginId); 

        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('nurse/nurse', $data);
        $this->load->view('home/footer'); // just the header file
    }


    public function updateNursebnInfo()
    {
        $nameBn      = $this->input->post('bnname');
        $fatherBn    = $this->input->post('bnfthname');
        $motherBn    = $this->input->post('bnmothname');
        $hwnameBn    = $this->input->post('bnhusname');
        $hwnameEn    = $this->input->post('husname');
        $desgnBn     = $this->input->post('bndesgntn');
        $marstus     = $this->input->post('marstaus');
        $edu         = $this->input->post('eduqulify');
        $dobrt       = $this->input->post('dobirth');
        $jbname      = $this->input->post('emenam');
        $jmblno      = $this->input->post('emembl');
        $jbrel       = $this->input->post('emereltn');
        $pdivdd      = $this->input->post('pdiviid');
        $pdsdd       = $this->input->post('pdisiid');
        $pupdd       = $this->input->post('pupaiid');
        $ppoffce     = $this->input->post('ppost_office');
        $pvlnam      = $this->input->post('pvill_nam');
        $phmnam      = $this->input->post('bhom_nam');
        $sdvdd       = $this->input->post('sdividd');
        $sdsdd       = $this->input->post('sdisiidd');
        $supdd       = $this->input->post('suipiidd');
        $spooffc     = $this->input->post('sPostOffice');
        $svlnam      = $this->input->post('sVillNam');
        $shmnam      = $this->input->post('sHomNam');
        $bnPhn       = $this->input->post('bnphone');
        $rlgn        = $this->input->post('rlgn');
        $id          = $this->input->post('id');

        $data = array(
            'embn_name'         => $nameBn,
            'bn_fatherNam'      => $fatherBn,
            'embnHus_name'      => $hwnameBn,
            'emMother_nam'      => $motherBn,
            'bn_Phome'          => $phmnam,
            'bn_Pvill_name'     => $pvlnam,
            'embn_Ppost'        => $ppoffce,
            'emPupiid'          => $pupdd,
            'emPdsiid'          => $pdsdd,
            'emPdviid'          => $pdivdd,
            'bn_Shome'          => $shmnam,
            'bn_Svill_name'     => $svlnam,
            'embn_Spost'        => $spooffc,
            'emSupiid'          => $supdd,
            'emSdsiid'          => $sdsdd,
            'emSdviid'          => $sdvdd,
            'emHus_name'        => $hwnameEn
            );
        $this->nurse_model->updEmpInf($id, $data);


        $e_data = array(
            'bn_desig'          => $desgnBn
            );
        $this->nurse_model->eupdEmpInf($id, $e_data);


        $exxData = array(
            'em_birth'          => $dobrt, 
            'emp_e_name'        => $jbname,
            'emp_e_mobile'      => $jmblno,
            'emp_e_relat'       => $jbrel,
            'marital_stus'      => $marstus,
            'emp_edu_que'       => $edu,
            'relaigion'         => $rlgn,
            'emp_id'            => $id
            );
        $this->nurse_model->exxupdEmpInf($exxData);


        redirect('nurse/nursebnInfo');
    }

    public function print_empInfo()
    {
        $emp_id = $this->input->get('emp_id');
        $data['eMain'] = $this->nurse_model->empMain($emp_id);
        $data['forsthaye'] = $this->nurse_model->fsthaddr($emp_id);
        $data['empOffc'] = $this->nurse_model->empOffcInfo($emp_id);
        $data['empextrInfo'] = $this->nurse_model->empexeInf($emp_id);

        $this->load->view('nurse/print_emp', $data);


    }

    public function info() {
        $data['nurses'] = $this->nurse_model->getNurse();
        $loginId = $this->ion_auth->user()->row()->emp_id;
        $data['user_P'] = $this->settings_model->get_log_user($loginId); 

        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('nurse/info', $data);
        $this->load->view('home/footer'); // just the header file
    }




    public function addNewView() {
        $loginId = $this->ion_auth->user()->row()->emp_id;
        $data['user_P'] = $this->settings_model->get_log_user($loginId); 

        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('nurse/add_new');
        $this->load->view('home/footer'); // just the header file
    }

    public function addNew() {
        $id = $this->input->post('id');
        $name = $this->input->post('name');
        $password = $this->input->post('password');
        $email = $this->input->post('email');
        $address = $this->input->post('address');
        $phone = $this->input->post('phone');

        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        // Validating Name Field
        $this->form_validation->set_rules('name', 'Name', 'trim|required|max_length[100]|xss_clean');
        // Validating Password Field
        if (empty($id)) {
            $this->form_validation->set_rules('password', 'Password', 'trim|max_length[100]|xss_clean');
        }
        // Validating Email Field
        $this->form_validation->set_rules('email', 'Email', 'trim|required|max_length[100]|xss_clean');
        // Validating Address Field   
        $this->form_validation->set_rules('address', 'Address', 'trim|required|max_length[500]|xss_clean');
        // Validating Phone Field           
        $this->form_validation->set_rules('phone', 'Phone', 'trim|required|max_length[50]|xss_clean');

        if ($this->form_validation->run() == FALSE) {
            if (!empty($id)) {
                $data = array();
                $data['nurse'] = $this->nurse_model->getNurseById($id);
                $this->load->view('home/dashboard'); // just the header file
                $this->load->view('nurse/add_new', $data);
                $this->load->view('home/footer'); // just the footer file
            } else {
                $data = array();
                $data['setval'] = 'setval';
                $this->load->view('home/dashboard'); // just the header file
                $this->load->view('nurse/add_new', $data);
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
                'upload_path' => "./uploads/emp/",
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
                $img_url = "uploads/emp/" . $path['file_name'];
                $data = array();
                $data = array(
                    'img_url' => $img_url,
                    'ename' => $name,
                    'email' => $email,
                    'address' => $address,
                    'phone' => $phone
                );
            } else {
                //$error = array('error' => $this->upload->display_errors());
                $data = array();
                $data = array(
                    'ename' => $name,
                    'email' => $email,
                    'address' => $address,
                    'phone' => $phone
                );
            }
            $username = $this->input->post('name');
            if (empty($id)) {     // Adding New Nurse
                if ($this->ion_auth->email_check($email)) {
                    $this->session->set_flashdata('feedback', 'This Email Address Is Already Registered');
                    redirect('nurse/addNewView');
                } else {
                    $dfg = 6;
                    $this->ion_auth->register($username, $password, $email, $dfg);
                    $ion_user_id = $this->db->get_where('users', array('email' => $email))->row()->id;
                    $this->nurse_model->insertNurse($data);
                    $nurse_user_id = $this->db->get_where('nurse', array('email' => $email))->row()->id;
                    $id_info = array('ion_user_id' => $ion_user_id);
                    $this->nurse_model->updateNurse($nurse_user_id, $id_info);
                    $this->session->set_flashdata('feedback', 'Added');
                }
            } else { // Updating Nurse
                $ion_user_id = $this->db->get_where('nurse', array('id' => $id))->row()->ion_user_id;
                if (empty($password)) {
                    $password = $this->db->get_where('users', array('id' => $ion_user_id))->row()->password;
                } else {
                    $password = $this->ion_auth_model->hash_password($password);
                }
                $this->nurse_model->updateIonUser($username, $email, $password, $ion_user_id);
                $this->nurse_model->updateNurse($id, $data);
                $this->session->set_flashdata('feedback', 'Updated');
            }
            // Loading View
            redirect('nurse');
        }
    }

    function getNurse() {
        $data['nurses'] = $this->nurse_model->get_nurse();
        $this->load->view('nurse/nurse', $data);
    }

    function editNurse() {
        $data = array();
        $id = $this->input->get('id');
        $data['nurse'] = $this->nurse_model->getNurseById($id);
        $loginId = $this->ion_auth->user()->row()->emp_id;
        $data['user_P'] = $this->settings_model->get_log_user($loginId); 

        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('nurse/add_new', $data);
        $this->load->view('home/footer'); // just the footer file
    }



//Update Employee Basic Information

    function updateNurse() {
        $data = array();
        $id = $this->input->get('id');
        $id = $this->input->post('id');
        $name = $this->input->post('name');
        $father = $this->input->post('father');
        $mother = $this->input->post('mother');
        $address = $this->input->post('address');
        $blood = $this->input->post('blood');
        $phone = $this->input->post('phone');
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
                'upload_path' => "./uploads/emp/",
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
                $img_url = "uploads/emp/" . $path['file_name'];
                $data = array();
                $data = array(
                            'ename' => $name,
                            'father' => $father,
                            'mother' => $mother,
                            'address' => $address,
                            'blood' => $blood,
                            'phone' => $phone, 
                            'img_url' => $img_url,                   
                    );
            } else {
                    $data = array();
                    $data = array(
                        'ename' => $name,
                        'father' => $father,
                        'mother' => $mother,
                        'address' => $address,
                        'blood' => $blood,
                        'phone' => $phone, 
                    );
            }
       $this->nurse_model->updateNurse($id, $data);
            redirect('nurse');
    }









    public function nursebnInfo()
    {        
        $data['nurses'] = $this->nurse_model->getempInfo();
        $data['dvbnnam'] = $this->nurse_model->gedvtion();
        $loginId = $this->ion_auth->user()->row()->emp_id;
        $data['user_P'] = $this->settings_model->get_log_user($loginId); 

        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('nurse/bn_nrs_info', $data);
        $this->load->view('home/footer'); // just the footer file
    }


    public function getdsbyjson()
    {
        $dvid = $this->input->get('dvid');
        $data = $this->nurse_model->gedstion($dvid);
        echo json_encode($data);
    }

    public function getupnbyjson()
    {
        $dsid = $this->input->get('dsid');
        $data = $this->nurse_model->geupiidd($dsid);
        echo json_encode($data);
    }


//Update Employee Office Information

    function updateNurseInfo() {
        $data = array();
        $id = $this->input->get('id');
        $id = $this->input->post('id');
        $salary = $this->input->post('salary');
        $design = $this->input->post('design');
        $jndddd = $this->input->post('jndtt');
        $offday = $this->input->post('offday');
                $data = array(
                            'sallary' => $salary,
                            'desig' => $design,
                            'offday' => $offday,
                            'joindate' => $jndddd                   
                    );
        $this->nurse_model->updateNurseInfo($id, $data);
            redirect('nurse/info');
    }


    function editInfoByJason() {
        $id = $this->input->get('id');
        $data['nurse'] = $this->nurse_model->getInfoById($id);
        echo json_encode($data);
    }

    function editNurseByJason() {
        $id = $this->input->get('id');
        $data['nurse'] = $this->nurse_model->getNurseById($id);
        $data['nInf'] = $this->nurse_model->getInfoById($id);
        echo json_encode($data);
    }

    function delete() {
        $data = array();
        $id = $this->input->get('emp_id');
        $this->db->delete('nurse');
        $this->nurse_model->delete($id);
        $this->session->set_flashdata('feedback', 'Deleted');
        redirect('nurse');
    }

}

/* End of file nurse.php */
/* Location: ./application/modules/nurse/controllers/nurse.php */





