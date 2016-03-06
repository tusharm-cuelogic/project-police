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
        #print_r($result);
        
        $resultResponse = json_decode($result);
        
        #print_r($resultResponse);
        $projectid = (int)base64_decode($this->input->get()['id']);
        $modelResponse = ($resultResponse[0] != "") ? json_decode($resultResponse[0]) : 0;
        $contorllerResponse = ($resultResponse[1] != "") ? json_decode($resultResponse[1]) : 0;

        $updateData = array(
                "wrong_action" => ($contorllerResponse) ? (int)$contorllerResponse->duplicate_return : 0,
                "query_count" => ($contorllerResponse) ? (int)$contorllerResponse->queries_in_controller : 0,
                "unwanted_module" => ($modelResponse) ? (int)$modelResponse->unwanted_module : 0,
            );
        
        $totalCount = $updateData["wrong_action"] + $updateData["query_count"] + $updateData["unwanted_module"];
        
        // $query = $this->db->update_string(
        //     'commits', $arrSetValue,
        //     "projectid = '$projectid'");
        // $result = $this->db->query($query);
        
        $UpdateQuery = "UPDATE project 
                        SET commit_errors = commit_errors + $totalCount
                        WHERE id = $projectid";
        $result = $this->db->query($UpdateQuery);
    }

}
