<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Project extends CI_Controller {

	public function view() {
        $arrSetData = array();
        $setMsgValue = array();
        $setMsgValue['alertDanger'] = '';
        $setMsgValue['msg'] = '';

        $this->load->model('projects');
        $projectDetails = $this->projects->getProjectList();

        if(is_array($projectDetails)) {
            $arrSetData['setProjectDetails'] = $projectDetails;
        }

		$this->load->view('header', $setMsgValue);
        $this->load->view('Project/list', $arrSetData);
        $this->load->view('footer');
	}

    public function add() {

        $setMsgValue = array();
        $setMsgValue['alertDanger'] = '';
        $setMsgValue['msg'] = '';

        if (!(int)$this->session->userdata('user')['id'] > 0) {
            redirect(base_url('Auth/login'));
        }

        $projectinfo = $this->input->post();
        $get = $this->input->get();

        $this->load->model('projects');

        if($projectinfo) {

            if((int)base64_decode($get['id']) > 0) {
                $projectId = $this->projects->edit();
            } else {
                $projectId = $this->projects->add();
            }

            if($projectId > 0) {
                $this->gitclone($projectId);

                redirect(base_url('Project/hook?id='.base64_encode($projectId)));
            }
        }

        if((int)base64_decode($get['id']) > 0) {
            $projectinfo = $this->projects->info();
        }

        $this->load->view('header', $setMsgValue);
        $this->load->view('Project/addedit', array("info" => $projectinfo[0]));
        $this->load->view('footer');
    }

    public function gitclone() {
        $post = $this->input->post();

        $project_name = str_replace(" ", "-", $post['project_name']);
        $git_username = $post['git_username'];
        $git_repository = $post['repository_name'];
        $git_password = $post['git_password'];
        $git_url = $post['git_url'];

        if (!file_exists('repository/$project_name/$git_repository')) {
            exec("mkdir -m 777 repository/$project_name/$git_repository");

            if ($post['repository_type'] == "public") {
                exec("git clone $git_url repository/$project_name/$git_repository");
            } else {
                $git_url_private = str_replace("github.com", $git_username.":".$git_password."@github.com", $git_url);
                exec("git clone $git_url_private repository/$project_name/$git_repository");
            }
        }
    }

    public function hook() {

        $setMsgValue = array();
        $setMsgValue['alertDanger'] = '';
        $setMsgValue['msg'] = '';

        $projectid = $this->input->get()['id'];
        $hookurl = BASE_URL."/".$projectid;

        $this->load->view('header', $setMsgValue);
        $this->load->view('Project/hook', array("hookurl" => $hookurl));
        $this->load->view('footer');
    }
}
