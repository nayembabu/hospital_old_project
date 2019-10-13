<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Bed_model extends CI_model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }


    function getbed() {
        $query = $this->db->get('bed');
        return $query->result();
    }

    function insertbed($data) {
        $this->db->insert('bed', $data);
    }





/**
    function insert($data) {
        $this->db->insert('table', $data);
    }

    function get() {
        $query = $this->db->get('table');
        return $query->result();
    }

    function update($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('table', $data);
    }

    function delete($id) {
        $this->db->where('id', $id);
        $this->db->delete('table');
    }
**/


}