<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Nurse_model extends CI_model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    function insertNurse($data) {
        $this->db->insert('nurse', $data);
    }

    function getNurse() {
        $this->db->where('status', 'active');
        $this->db->join('empinfo', 'nurse.emp_id = empinfo.emp_id');
        $query = $this->db->get('nurse');
        return $query->result();
    }

    function getempInfo() {
        $this->db->where('status', 'active');
        $this->db->join('empinfo', 'nurse.emp_id = empinfo.emp_id');
        $query = $this->db->get('nurse');
        return $query->result();
    }

    function gedvtion() {
        $query = $this->db->get('divisions');
        return $query->result();
    }

    function gedstion($dvid) {
        $this->db->where('division_id', $dvid);
        $query = $this->db->get('districts');
        return $query->result();        
    }

    function geupiidd($dsid) {
        $this->db->where('district_id', $dsid);
        $query = $this->db->get('upazilas');
        return $query->result();        
    }

    function getInfoById($id) {
        $this->db->where('emp_id', $id);
        $query = $this->db->get('empinfo');
        return $query->row();
    }

    function getNurseById($id) {
        $this->db->where('emp_id', $id);
        $query = $this->db->get('nurse');
        return $query->row();
    }

    function updateNurse($id, $data) {
        $this->db->where('emp_id', $id);
        $this->db->update('nurse', $data);
    }

    function updateNurseInfo($id, $data) {
        $this->db->where('emp_id', $id);
        $this->db->update('empinfo', $data);
    }





    function updEmpInf($id, $data) {
        $this->db->where('emp_id', $id);
        $this->db->update('nurse', $data);
    }

    function eupdEmpInf($id, $e_data) {
        $this->db->where('emp_id', $id);
        $this->db->update('empinfo', $e_data);
    }

    function exxupdEmpInf($exxData) {
        $this->db->insert('emp_oth_info', $exxData);
    }






    function empMain($emp_id) {
        $this->db->where('emp_id', $emp_id);
        $this->db->join('divisions', 'divisions.dv_id = nurse.emPdviid', 'left');
        $this->db->join('districts', 'districts.ds_id = nurse.emPdsiid', 'left');
        $this->db->join('upazilas', 'upazilas.up_id = nurse.emPupiid', 'left');
        $query = $this->db->get('nurse');
        return $query->row();
    }


    function fsthaddr($emp_id) {
        $this->db->where('emp_id', $emp_id);
        $this->db->join('divisions', 'divisions.dv_id = nurse.emSdviid', 'left');
        $this->db->join('districts', 'districts.ds_id = nurse.emSdsiid', 'left');
        $this->db->join('upazilas', 'upazilas.up_id = nurse.emSupiid', 'left');
        $query = $this->db->get('nurse');
        return $query->row();
    }

    function empOffcInfo($emp_id) {
        $this->db->where('emp_id', $emp_id);
        $query = $this->db->get('empinfo');
        return $query->row();
    }

    function empexeInf($emp_id) {
        $this->db->where('emp_id', $emp_id);
        $query = $this->db->get('emp_oth_info');
        return $query->row();
    }










    function delete($id) {
        $this->db->where('id', $id);
        $this->db->delete('nurse');
    }

    function updateIonUser($username, $email, $password, $ion_user_id) {
        $uptade_ion_user = array(
            'username' => $username,
            'email' => $email,
            'password' => $password
        );
        $this->db->where('id', $ion_user_id);
        $this->db->update('users', $uptade_ion_user);
    }

}
