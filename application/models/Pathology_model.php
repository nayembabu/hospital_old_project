<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Pathology_model extends CI_model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }















    // function insertDoctor($data) {
    //     $this->db->insert('doctor', $data);
    // }

    // function updateDoctor($id, $data) {
    //     $this->db->where('id', $id);
    //     $this->db->update('doctor', $data);
    // }

    // function delete($id) {
    //     $this->db->where('id', $id);
    //     $this->db->delete('doctor');
    // }





}
