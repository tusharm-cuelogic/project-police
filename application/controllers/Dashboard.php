<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function home()
	{
		$this->load->view('header');
        $this->load->view('Dashboard/dashboard');
        $this->load->view('footer');
	}
}
