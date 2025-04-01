<?php
class BaseController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('login_model');
    }

    public function isLoggedIn()
    {
        $isLoggedIn = $this->session->userdata('isLoggedIn');
        if (!isset($isLoggedIn) || $isLoggedIn !== TRUE) {
            redirect('login');
        } else {
        }
    }

    public function loginCheck()
    {
        $exp_time = $this->session->userdata("expires_time");
        if (time() < $exp_time) {
            return true;
        } else {
            $this->session->sess_destroy();
            redirect('login');
            return false;
        }
    }

    public function insert_log_login($data)
    {
        $this->login_model->insert_login_log($data);
    }
}
