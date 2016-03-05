<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Projects extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

    function add() {
        $sql = "Select * from user";
        $result = $this->db->query($sql);
        return $result->result();
    }
}
