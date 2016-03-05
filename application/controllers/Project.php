<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Project extends CI_Controller {

	public function view()
	{
		$this->load->view('header');
        $this->load->view('Project/list');
        $this->load->view('footer');
	}

    public function addedit()
    {
        $this->load->view('header');
        $this->load->view('Project/addedit');
        $this->load->view('footer');
    }
}
