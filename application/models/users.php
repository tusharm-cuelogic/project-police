<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

    function isUserPresent($where_filters) {

        $this->db->select('id ,username, first_name, last_name')->from('user')->where($where_filters);

        $query = $this->db->get();

        if($query->num_rows() > 0) {
            return $query->result();
	    }
    }
}
