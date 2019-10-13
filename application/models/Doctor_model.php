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
        $this->db->where('stus', 'active');
        $query = $this->db->get('doctor');
        return $query->result();
    }

    function drfee() {
        $this->db->join('doctor', 'dr_fee.dr_id = doctor.dr_id');
        $query = $this->db->get('dr_fee');
        return $query->result();
    }


    function getDoctorById($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('doctor');
        return $query->row();
    }

    function updateDoctor($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('doctor', $data);
    }

    function delete($id) {
        $this->db->where('id', $id);
        $this->db->delete('doctor');
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
