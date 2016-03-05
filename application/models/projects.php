<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Projects extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

    function addedit() {

        $projectInfo = $this->input->post();
        $sql = $this->db->insert_string('project', $projectInfo);
        $this->db->query($sql);
        $lastid = $this->db->insert_id();

        return (int)$lastid;
    }

    function getProjectList() {

        $this->db->select('id ,created, repository_name, repository_type, commit_errors')->from('project');

        $query = $this->db->get();

        if($query->num_rows() > 0) {
            return $query->result();
        }
    }
}
