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

    function getBedByid($id) {
        $this->db->where('bed_Idi', $id);
        $sql = $this->db->get('bed');
        return $sql->row();
    }

    function updatebed($bed_id, $data) {
        $this->db->where('bed_Idi', $bed_id);
        $this->db->update('bed');
    }

    function delete_bed($id) {
        $this->db->where('bed_Idi', $id);
        $this->db->delete('bed');
    }

}