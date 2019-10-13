<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class usermgnt_model extends CI_model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }


    function getuser() {
        $this->db->join('nurse', 'nurse.emp_id = users.emp_id');
        $query = $this->db->get('users');
        return $query->result();
    }


    function getgroups() {
        $this->db->order_by('id', 'ASC');
        $query = $this->db->get('groups');
        return $query->result();
    }


    function getusergroups() {
        $query = $this->db->get('users_groups');
        return $query->result();
    }





    function getemp() {
        $this->db->order_by('eid', 'ASC');
        $this->db->where('status', 'active');
        $query = $this->db->get('nurse');
        return $query->result();
        }

    function insertuser($data) {
        $this->db->insert('users', $data);
    }



    function insertusergroup($data) {
        $this->db->insert('users_groups', $data);
    }

    function updateusergroup($ur_id, $data) {
        $this->db->where('id', $ur_id);
        $this->db->update('users_groups', $data);
    }


    function updateuserpass($emp_id, $data) {
        $this->db->where('emp_id', $emp_id);
        $this->db->update('users', $data);
    }


    function getusergroupbyid($id) {
        $this->db->where('emp_id', $id);
        $query = $this->db->get('users');
        return $query->row();
    }


    function getusergbyid($id) {
        $this->db->where('user_id', $id);
        $query = $this->db->get('users_groups');
        return $query->row();
    }


    function getuserssbyid($empid) {
        $this->db->where('emp_id', $empid);
        $query = $this->db->get('users');
        return $query->row();
    }




    function delete($id) {
        $this->db->where('emp_id', $id);
        $this->db->delete('users');
    }








//This Is Not Valueable
    function Updateincome($id, $data) {
        $this->db->where('emp_id', $id);
        $this->db->update('users', $data);
    }




//End Bracket
}
