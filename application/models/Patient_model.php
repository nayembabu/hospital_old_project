<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Patient_model extends CI_model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    function insertPatient($data) {
        $this->db->insert('patient', $data);
    }

    function getPatient() {
        $this->db->order_by('p_n_id', 'desc');
        $this->db->where('ok', 0);
        $this->db->join('nurse', 'nurse.emp_id = patient.emp_id', 'left');
        $this->db->join('doctor', 'doctor.dr_id = patient.dr_id', 'left');
        $query = $this->db->get('patient');
        return $query->result();
    }

    function getfullpatient($st_date, $last_date) {
        $this->db->where('add_date >=', $st_date);
        $this->db->where('add_date <=', $last_date);
        $this->db->join('doctor', 'doctor.dr_id = patient.dr_id', 'left');
        $this->db->order_by('p_n_id', 'DESC');
        $sql = $this->db->get('patient');
        return $sql->result();
    }

    function getAppinfoById($id) {
        $this->db->where('p_n_id', $id);
        $query = $this->db->get('appointment');
        return $query->row();
    }

    function getbed() {
        $this->db->order_by('b_num', 'ASC');
        $query = $this->db->get('bed');
        return $query->result();
    }

    function getDoctorById($dr_id) {
        $this->db->where('dr_id', $dr_id);
        $query = $this->db->get('doctor');
        return $query->row();
    }

    function getPatientById($id) {
        $this->db->where('p_n_id', $id);
        $query = $this->db->get('patient');
        return $query->row();
    }

    function get_patient_forSearch($p_id) {
        $this->db->like('patient_id', $p_id);
        $sql = $this->db->get('patient');
        return $sql->result();
    }

    function get_ptn_number() {
        $this->db->order_by('p_n_id', 'DESC');
        $this->db->limit(1);
        $sql = $this->db->get('patient');
        return $sql->row();
    }

    function get_p_by_ids($p_ids) {
        $this->db->where('p_n_id', $p_ids);
        $sql = $this->db->get('patient');
        return $sql->row();
    }

    function updateNowBed($last_bed_id, $bed_update_data) {
        $this->db->where('b_a_id', $last_bed_id);
        $this->db->update('bed_allocation', $bed_update_data);
    }

    function update_P_Beds($p_ids, $c_data) {
        $this->db->where('p_n_id', $p_ids);
        $this->db->update('patient', $c_data);
    }

    function get_previous_bed($p_ids, $now_bed_no) {
        $this->db->where('ptn_iid', $p_ids);
        $this->db->where('bed_cat_i', $now_bed_no);
        $sql = $this->db->get('bed_allocation');
        return $sql->row(); 
    }

    function updatePatient($id, $data) {
        $this->db->where('p_n_id', $id);
        $this->db->update('patient', $data);
    }

    function insert_b_a($bed_allocate) {
        $this->db->insert('bed_allocation', $bed_allocate);
    }

    function updatePatientData($id, $data) {
        $this->db->where('p_n_id', $id);
        $this->db->update('patient', $data);
    }

    function delete($id) {
        $this->db->where('p_n_id', $id);
        $this->db->delete('patient');
    }

}
