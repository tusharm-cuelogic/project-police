<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Projects extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

    function add() {

        $projectInfo = $this->input->post();
        $sql = $this->db->insert_string('project', $projectInfo);
        $this->db->query($sql);
        $lastid = $this->db->insert_id();

        return (int)$lastid;
    }

    function info() {

        $projectId = base64_decode($this->input->get()['id']);
        $sql = "select project_name,
                        repository_name,
                        project_language,
                        project_framework,
                        repository_type,
                        git_username,
                        controller_directory,
                        model_directory,
                        exclude_directory,
                        git_url,
                        git_password
                from project
                where id='".$projectId."'";
        $result = $this->db->query($sql);
        if($result)return $result->result_array();
    }

    function edit() {

        $projectInfo = $this->input->post();
        $projectId = base64_decode($this->input->get()['id']);

        $query = $this->db->update_string(
            'project', $projectInfo,
            "id = '$projectId'");
        $result = $this->db->query($query);

        if ($result) {
            return (int)$projectId;
        }
    }

    function getProjectList() {

        $this->db->select('id ,created, repository_name, repository_type, commit_errors')->from('project');

        $query = $this->db->get();

        if($query->num_rows() > 0) {
            return $query->result();
        }
    }

}
