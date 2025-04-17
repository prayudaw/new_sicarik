<?php
defined('BASEPATH') or exit('No direct script access allowed');


require APPPATH . '/core/BaseController.php';

class login_admin extends BaseController
{
    public function index()
    {
        $isLoggedIn = $this->session->userdata('isLoggedIn');
        if ($isLoggedIn == TRUE) {
            redirect('admin/home');
        }

        $data = array();

        $this->load->view('login_admin/view', $data);
    }

    public function auth()
    {
        $post = $this->input->post();
        $username = preg_replace('/\s+/', '', $post['username']);
        $pass = preg_replace('/\s+/', '', $post['password']);


        if ($username == 'admin' && $pass == '1234') {
            $timeout = 2000;
            $sessionArray = array(
                'Fullname' => 'admin',
                'isLoggedIn' => TRUE,
                'expires_time' => time() + $timeout
            );


            $this->session->set_userdata($sessionArray);
            $response = array(
                'status' => 1,
                'message' => 'Berhasil login',
            );
        } else {
            $response = array(
                'status' => 2,
                'message' => 'Username atau Password salah',
            );
        }

        echo json_encode($response);
    }


    public function logout()
    {
        $this->session->sess_destroy();
        redirect('login_admin');
    }
}
