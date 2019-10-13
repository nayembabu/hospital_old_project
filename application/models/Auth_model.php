<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Auth_model extends CI_model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }


    function buying() {
        $query = $this->db->get('buysellpur');
        return $query->result();
    }



}
?>