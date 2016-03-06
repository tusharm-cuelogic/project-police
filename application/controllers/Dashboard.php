<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function home()
	{
        $arrSetData = array();
        $setMsgValue = array();
        $setMsgValue['alertDanger'] = '';
        $setMsgValue['msg'] = '';

        /**
         * Display the graph details
         */
		$this->load->model('projects');
        $projectDetails = $this->projects->getProjectList();

        if(is_array($projectDetails)) {
            $arrSetData['setProjectDetails'] = $projectDetails;
        }


        $this->load->model('commits');
        $commitsDetails = $this->commits->getCommitsUniqueList();

        if(is_array($commitsDetails)) {
            $arrSetData['setCommitsDetails'] = $commitsDetails;
        }

        $this->load->view('header', $setMsgValue);
        $this->load->view('Dashboard/dashboard', $arrSetData);
        $this->load->view('footer');
	}

    public function commits()
    {
        $arrSetData = array();
        $setMsgValue = array();
        $setMsgValue['alertDanger'] = '';
        $setMsgValue['msg'] = '';

        $get = $this->input->get();
        $intProjectId = base64_decode($get['id']);

        if($intProjectId) {
            /**
            * Display the commits details
            */
            $this->load->model('commits');
            $commitsDetails = $this->commits->getCommitsList($intProjectId);

            if(is_array($commitsDetails)) {
                $arrSetData['setCommitsDetails'] = $commitsDetails;
            }
        }

        $this->load->view('header', $setMsgValue);
        $this->load->view('commits/commits', $arrSetData);
        $this->load->view('footer');
    }
}
