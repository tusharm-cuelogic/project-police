<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

    function isUserPresent($where_filters) {

        $this->db->select('id')->from('user')->where($where_filters);

        $query = $this->db->get();

        return $query->num_rows;
    }
}
