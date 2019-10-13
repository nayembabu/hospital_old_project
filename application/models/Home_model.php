<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Home_model extends CI_model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function getSum($field, $table) {
        $this->db->select_sum($field);
        $query = $this->db->get($table);
        return $query->result();
    }

    function getUser_Info($loginId) {
        $this->db->where('emp_id', $loginId);
        $sql = $this->db->get('nurse');
        return $sql->row();
    }

    function insertchat($data) {
        $this->db->insert('chat_sms', $data);
    }

    function getchatsms() {
        $this->db->order_by('chatid', DESC);
        $this->db->join('nurse', 'nurse.emp_id = chat_sms.emp_id');
        $query = $this->db->get('chat_sms', 20);
        return $query->result();
    }

    function getemp($empid) {
        $this->db->where('emp_id', $empid);
        $query = $this->db->get('nurse');
        return $query->row();
    }






}
