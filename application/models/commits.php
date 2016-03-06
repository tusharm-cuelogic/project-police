<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Commits extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

    function getCommitsList($intProjectId) {

        $sql = "SELECT pushid, username, issue_count, pushed_date, duplicate_count,
                        query_count, wrong_action, unwanted_module
                FROM commits
                WHERE projectid='".$intProjectId."'
                ORDER BY pushed_date DESC ";
        $result = $this->db->query($sql);
        if($result)return $result->result_array();
    }

    function getCommitsUniqueList() {

        $sql = "SELECT cs.pushid,
                       cs.projectid,
                       cs.username,
                       cs.issue_count,
                       cs.pushed_date,
                       pt.  project_name
                FROM commits as cs
                LEFT JOIN
                    project as pt
                ON
                    cs.projectid = pt.id
                WHERE 1
                GROUP BY cs.projectid
                ORDER BY cs.id DESC";

        $result = $this->db->query($sql);

        if($result)return $result->result_array();
    }

    function addCommit($commitInfo) {
        $sql = $this->db->insert_string('commits', $commitInfo);
        $this->db->query($sql);
        $lastid = $this->db->insert_id();

        return (int)$lastid;
    }

    function checkCommitExists($projectid) {
        $projectId = base64_decode($this->input->get()['id']);
        $sql = "select id from commits where projectid='".$projectId."'";
        $result = $this->db->query($sql);
        if($result)return $result->result_array();
    }

    function updateCommitInfo($commitInfo, $commitid) {
        $query = $this->db->update_string(
            'commits', $commitInfo,
            "id = '$commitid'");
        $result = $this->db->query($query);

        if ($result) {
            return $result;
        }
    }
}
