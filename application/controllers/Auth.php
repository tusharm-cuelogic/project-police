<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Auth extends CI_Controller {

	public function login()
	{
        $post = $this->input->post();

        if ($post) {

            if(isset($post['username']) && isset($post['password'])) {

                $where['username'] = $post['username'];
                $where['password'] = $post['password'];

                $this->load->model('users');
                $isUserPresent = $this->users->isUserPresent($where);
                var_dump($isUserPresent);
            }
        }

        $data['hello'] = "Hello World!!!!";
		$this->load->view('header');
        $this->load->view('Auth/login', $data);
        $this->load->view('footer');
	}
}
