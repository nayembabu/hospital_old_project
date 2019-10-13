<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Receptionist_model extends CI_model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    function getticketadmin($thisdate) {
        $this->db->where('thisdate', $thisdate);
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get('appointment');
        return $query->result();
    }




    function getTicketByDate($thisdate) {
        $this->db->where('ap_date', $thisdate);
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get('appointment');
        return $query->result();
    }




    function getAllTicket() {
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get('appointment');
        return $query->result();
    }


    function getticket($thisdate, $emp_id) {
        $this->db->where('thisdate', $thisdate);
        $this->db->where('emp_id', $emp_id);
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get('appointment');
        return $query->result();
    }


    function getdoctor() {
        $this->db->where('stus', 'active');
        $this->db->join('dr_fee', 'dr_fee.dr_id = doctor.dr_id');
        $query = $this->db->get('doctor');
        return $query->result();
    }

    function getUsers() {
        $this->db->join('nurse', 'nurse.emp_id = users.emp_id');
        $query = $this->db->get('users');
        return $query->result();
    }

    function getticketcount($emp_id, $dr_id, $t_date) {
        $this->db->where('emp_id', $emp_id);
        $this->db->where('dr_id', $dr_id);
        $this->db->where('ap_date', $t_date);
        $query = $this->db->get('appointment');
        return $query->result();
    }



    function get_dr_count($dr_id, $t_date) {
        $this->db->where('dr_id', $dr_id);
        $this->db->where('ap_date', $t_date);
        $query = $this->db->get('appointment');
        return $query->result();
    }




    function getEmpticket($t_date) {
        $this->db->where('ap_date', $t_date);
        $query = $this->db->get('appointment');
        return $query->result();
    }



    function getEmptckt($emp_id, $t_date) {
        $this->db->where('emp_id', $emp_id);
        $this->db->where('ap_date', $t_date);
        $query = $this->db->get('appointment');
        return $query->result();
    }



    function getDrinfo() {
        $query = $this->db->get('doctor');
        return $query->result();
    }




    function insertappoint($data) {
        $this->db->insert('appointment', $data);
    }


    function getdefeeById($dr_id) {
        $this->db->where('dr_id', $dr_id);
        $query = $this->db->get('dr_fee');
        return $query->row();
    }


    function getdrById($dr_id) {
        $this->db->where('dr_id', $dr_id);
        $query = $this->db->get('doctor');
        return $query->row();
    }




    function getAppById($ap_id) {
        $this->db->where('id', $ap_id);
        $query = $this->db->get('appointment');
        return $query->row();
    }





    function getticketById($tc_id) {
        $this->db->where('id', $tc_id);
        $query = $this->db->get('appointment');
        return $query->row();
    }
    
    function editticketprint($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('appointment', $data);
    }



    function updateAppointTicket($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('appointment', $data);
    }


    function deleteticket($id) {
        $this->db->where('id', $id);
        $this->db->delete('appointment');
    }





























    function insertReceptionist($data) {
        $this->db->insert('receptionist', $data);
    }

    function getReceptionist() {
        $query = $this->db->get('receptionist');
        return $query->result();
    }

    function getReceptionistById($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('receptionist');
        return $query->row();
    }
    
    function getReceptionistByIonUserId($id) {
        $this->db->where('ion_user_id', $id);
        $query = $this->db->get('receptionist');
        return $query->row();
    }

    function updateReceptionist($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('receptionist', $data);
    }

    function delete($id) {
        $this->db->where('id', $id);
        $this->db->delete('receptionist');
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
