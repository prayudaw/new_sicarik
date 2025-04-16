<?php
defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . '/core/BaseController.php';

class Home extends BaseController
{
    public function __construct()
    {
        parent::__construct();
        // $this->isLoggedIn();
        // $this->loginCheck();
    }

    public function index()
    {
        $data = array();
        $this->load->view('admin/home', $data);
    }
}
