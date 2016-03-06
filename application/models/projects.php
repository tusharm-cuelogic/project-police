<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Projects extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

    function add() {

        $arrSetValue = array();
        $projectInfo = $this->input->post();


        $arrSetValue = array(
            'project_name' =>  $projectInfo['project_name'],
            'repository_name' =>  $projectInfo['repository_name'],
            'git_url' =>  $projectInfo['git_url'],
            'project_language' =>  $projectInfo['project_language'],
            'project_framework' =>  $projectInfo['project_framework'],
            'controller_directory' =>  $projectInfo['controller_directory'],
            'model_directory' =>  $projectInfo['model_directory'],
            'exclude_directory' =>  $projectInfo['exclude_directory'],
            'repository_type' =>  $projectInfo['repository_type'],
            'git_username' =>  $projectInfo['git_username'],
            'git_password' =>  base64_encode($projectInfo['git_password']),
        );
        if ($projectInfo['repository_type'] == "public") {
            $arrSetValue['git_username'] =  "";
            $arrSetValue['git_password'] =  "";
        }

        $sql = $this->db->insert_string('project', $arrSetValue);
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

        $arrSetValue = array();
        $projectInfo = $this->input->post();
        $projectId = base64_decode($this->input->get()['id']);

        $arrSetValue = array(
            'project_name' =>  $projectInfo['project_name'],
            'repository_name' =>  $projectInfo['repository_name'],
            'git_url' =>  $projectInfo['git_url'],
            'project_language' =>  $projectInfo['project_language'],
            'project_framework' =>  $projectInfo['project_framework'],
            'controller_directory' =>  $projectInfo['controller_directory'],
            'model_directory' =>  $projectInfo['model_directory'],
            'exclude_directory' =>  $projectInfo['exclude_directory'],
            'repository_type' =>  $projectInfo['repository_type'],
            'git_username' =>  $projectInfo['git_username'],
            'git_password' =>  base64_encode($projectInfo['git_password']),
        );
        if ($projectInfo['repository_type'] == "public") {
            $arrSetValue['git_username'] =  "";
            $arrSetValue['git_password'] =  "";
        }

        $query = $this->db->update_string(
            'project', $arrSetValue,
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

    function updateCommitInfo($result) {
        
        $resultResponse = json_decode($result);
        
        $projectid = (int)base64_decode($this->input->get()['id']);
        $modelResponse = json_decode($resultResponse[0]);
        $contorllerResponse = json_decode($resultResponse[1]);

        $updateData = array(
                "wrong_action" => (int)$contorllerResponse->duplicate_return,
                "query_count" => (int)$contorllerResponse->queries_in_controller,
                "unwanted_module" => (int)$contorllerResponse->queries_in_controller,
            );
        
        $query = $this->db->update_string(
            'commits', $arrSetValue,
            "projectid = '$projectid'");
        $result = $this->db->query($query);

        $query = $this->db->update_string(
            'project', $arrSetValue,
            "id = '$projectid'");
        $result = $this->db->query($query);
    }

}
