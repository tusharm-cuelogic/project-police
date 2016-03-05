<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function home()
	{
        $setMsgValue = array();
        $setMsgValue['alertDanger'] = '';
        $setMsgValue['msg'] = '';

		$this->load->view('header', $setMsgValue);
        $this->load->view('Dashboard/dashboard');
        $this->load->view('footer');
	}
}
