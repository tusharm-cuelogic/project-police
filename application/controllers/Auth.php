<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Auth extends CI_Controller {

	public function login() {
        /**
         * Check value is set or not if not then redirect to login page
         */
        if ((int)$this->session->userdata('user')['id'] > 0) {
            redirect(base_url('Dashboard/home'));
        }

        $setMsgValue = array();
        $setMsgValue['alertDanger'] = '';
        $setMsgValue['msg'] = '';

        $post = $this->input->post();

        if ($post) {

            if(isset($post['username']) && isset($post['password'])) {

                $where['username'] = $post['username'];
                $where['password'] = $post['password'];

                $this->load->model('users');
                $isUserPresent = $this->users->isUserPresent($where);

                if($isUserPresent) {
                    $userInfo = array (
                                        'id' => $isUserPresent[0]->id,
                                        'username' => $isUserPresent[0]->username,
                                        'first_name' => $isUserPresent[0]->first_name,
                                        'last_name' => $isUserPresent[0]->last_name
                                    );
                    $this->session->set_userdata('user', $userInfo);
                    redirect(base_url('Dashboard/home'));
                } else {
                    $setMsgValue['alertDanger'] = 'alert-danger';
                    $setMsgValue['msg'] = 'Incorrect Username and Password.';
                }
            }
        }

		$this->load->view('header', $setMsgValue);
        $this->load->view('Auth/login');
        $this->load->view('footer');
	}

    public function logout() {
        $this->session->sess_destroy();
        redirect(base_url('Auth/login'));
    }
}
