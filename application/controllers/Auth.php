<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Auth extends CI_Controller {

	public function login()
	{
        $post = $this->input->post();

        $data['hello'] = "Hello World!!!!";
		$this->load->view('header');
        $this->load->view('Auth/login', $data);
        $this->load->view('footer');
	}
}
