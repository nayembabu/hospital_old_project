<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Doctor_model extends CI_model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    function insertDoctor($data) {
        $this->db->insert('doctor', $data);
    }

    function insertDoctorfee($data) {
        $this->db->insert('dr_fee', $data);
    }

    function getDoctor() {
        $this->db->join('department', 'doctor.department = department.dept_id', 'left');
        $query = $this->db->get('doctor');
        return $query->result();
    }

    function getDoctorforDrfee() {
        $this->db->order_by('atid', 'DESC');
        $query = $this->db->get('doctor');
        return $query->result();
    }

    function getDoctorfeeById($id) {
        $this->db->where('dr_fee_id', $id);
        $this->db->join('doctor', 'dr_fee.dr_id = doctor.dr_id');
        $query = $this->db->get('dr_fee');
        return $query->row();
    }

    function drfee() {
        $this->db->join('doctor', 'dr_fee.dr_id = doctor.dr_id');
        $query = $this->db->get('dr_fee');
        return $query->result();
    }

    function getDoctorById($id) {
        $this->db->where('atid', $id);
        $this->db->join('department', 'doctor.department = department.dept_id', 'left');
        $query = $this->db->get('doctor');
        return $query->row();
    }

    function updateDoctor($dr_main_id, $data) {
        $this->db->where('atid', $dr_main_id);
        $this->db->update('doctor', $data);
    }

    function delete($id) {
        $this->db->where('atid', $id);
        $this->db->delete('doctor');
    }

    function get_doctor_dr_id() {
        $this->db->limit(1);
        $this->db->order_by('dr_id', 'DESC');
        $sql = $this->db->get('doctor');
        return $sql->row();
    }

    function updateDoctorfee($dr_fee_id, $data) {
        $this->db->where('dr_fee_id', $dr_fee_id);
        $this->db->update('dr_fee', $data);
    }
    
    function delete_fee($id) {
        $this->db->where('dr_fee_id', $id);
        $this->db->delete('dr_fee');
    }

}
