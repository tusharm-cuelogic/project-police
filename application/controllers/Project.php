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

        $post = $this->input->post();

        if($post) {
            $this->load->model('projects');
            $projectId = $this->projects->addedit();

            if($projectId > 0) {
                $this->gitclone();
            }
        }

        $this->load->view('header', $setMsgValue);
        $this->load->view('Project/addedit');
        $this->load->view('footer');
    }

    public function gitclone() {
        $post = $this->input->post();
    }
}
